import Stripe from 'stripe'
import { createClient } from '@supabase/supabase-js'
import { sendNotification } from './send-notification.js'

const stripe = new Stripe(process.env.STRIPE_SECRET_KEY)
const supabase = createClient(process.env.VITE_SUPABASE_URL, process.env.SUPABASE_SERVICE_KEY)

// Map Stripe price/product metadata to treatment info
function parseTreatmentFromSubscription(subscription) {
  // Try to get treatment info from subscription metadata or item description
  const item = subscription.items?.data?.[0]
  const metadata = subscription.metadata || {}
  const itemMetadata = item?.price?.metadata || {}
  const productName = item?.price?.nickname || item?.description || ''
  const amount = item?.price?.unit_amount || 0

  // Check metadata first (if set on Stripe)
  if (metadata.treatment) {
    return { treatment: metadata.treatment, dose: metadata.dose || '', pricePence: amount }
  }
  if (itemMetadata.treatment) {
    return { treatment: itemMetadata.treatment, dose: itemMetadata.dose || '', pricePence: amount }
  }

  // Try matching by price ID first (most reliable)
  const priceId = item?.price?.id
  const priceIdMap = {
    'price_1TG7ZzRvWiaT0xusN7LIEuy1': { treatment: 'mounjaro-2.5mg', dose: '2.5mg' },
    'price_1TG7ZzRvWiaT0xusC430jCBS': { treatment: 'mounjaro-5mg', dose: '5mg' },
    'price_1TG7a0RvWiaT0xus4VZLc6dw': { treatment: 'mounjaro-7.5mg', dose: '7.5mg' },
    'price_1TG7a1RvWiaT0xusXiFZdB5e': { treatment: 'mounjaro-10mg', dose: '10mg' },
    'price_1TG7a1RvWiaT0xusoIf1IMCK': { treatment: 'mounjaro-12.5mg', dose: '12.5mg' },
    'price_1TG7a2RvWiaT0xusoYCyjDxQ': { treatment: 'mounjaro-15mg', dose: '15mg' },
    'price_1TG7b8RvWiaT0xusq6uqsal4': { treatment: 'wegovy-0.25mg', dose: '0.25mg' },
    'price_1TG7aaRvWiaT0xussfxNvUFH': { treatment: 'wegovy-0.5mg', dose: '0.5mg' },
    'price_1TG7abRvWiaT0xus8pjfOgN2': { treatment: 'wegovy-1mg', dose: '1mg' },
    'price_1TG7abRvWiaT0xuszy0IWscg': { treatment: 'wegovy-1.7mg', dose: '1.7mg' },
    'price_1TG7acRvWiaT0xusN7Ge7kgx': { treatment: 'wegovy-2.4mg', dose: '2.4mg' },
    // Test
    'price_1TGdRDRvWiaT0xusRdu1MPdz': { treatment: 'test-subscription', dose: 'test' },
  }
  if (priceId && priceIdMap[priceId]) {
    return { ...priceIdMap[priceId], pricePence: amount }
  }

  // Fallback: guess from price amount
  const priceMap = {
    // Mounjaro prices
    15000: { treatment: 'mounjaro-2.5mg', dose: '2.5mg' },
    17000: { treatment: 'mounjaro-2.5mg', dose: '2.5mg' },
    18500: { treatment: 'mounjaro-5mg', dose: '5mg' },
    25000: { treatment: 'mounjaro-7.5mg', dose: '7.5mg' },
    27500: { treatment: 'mounjaro-10mg', dose: '10mg' },
    28500: { treatment: 'mounjaro-12.5mg', dose: '12.5mg' },
    31000: { treatment: 'mounjaro-15mg', dose: '15mg' },
    // Wegovy prices
    11400: { treatment: 'wegovy-0.25mg', dose: '0.25mg' },
    13900: { treatment: 'wegovy-0.5mg', dose: '0.5mg' },
    16900: { treatment: 'wegovy-1mg', dose: '1mg' },
    19900: { treatment: 'wegovy-1.7mg', dose: '1.7mg' },
    22900: { treatment: 'wegovy-2.4mg', dose: '2.4mg' },
    // Wegovy updated prices (if changed)
    14900: { treatment: 'wegovy-0.25mg', dose: '0.25mg' },
  }

  return priceMap[amount] || { treatment: productName || 'unknown', dose: '', pricePence: amount }
}

export async function handler(event) {
  if (event.httpMethod !== 'POST') {
    return { statusCode: 405, body: 'Method not allowed' }
  }

  const sig = event.headers['stripe-signature']
  let stripeEvent

  try {
    stripeEvent = stripe.webhooks.constructEvent(
      event.body,
      sig,
      process.env.STRIPE_WEBHOOK_SECRET
    )
  } catch (err) {
    return { statusCode: 400, body: `Webhook Error: ${err.message}` }
  }

  try {
    switch (stripeEvent.type) {
      // ============================================
      // NEW PURCHASE — Auto-create portal account
      // ============================================
      case 'checkout.session.completed': {
        const session = stripeEvent.data.object
        const customerEmail = session.customer_details?.email || session.customer_email
        const customerName = session.customer_details?.name || ''
        const stripeCustomerId = session.customer
        const subscriptionId = session.subscription

        if (!customerEmail) {
          console.error('checkout.session.completed: No customer email found', session.id)
          return { statusCode: 500, body: 'Missing customer email' }
        }

        // 1. Check if a Supabase auth user already exists
        //    Use profiles table as proxy since listUsers filter syntax is unreliable
        const { data: existingProfile } = await supabase
          .from('profiles')
          .select('id')
          .eq('email', customerEmail.toLowerCase())
          .maybeSingle()
        const existingUser = existingProfile || null

        let userId

        if (existingUser) {
          // User already has a portal account
          userId = existingUser.id
        } else {
          // 2. Create a new Supabase auth user with a random password
          //    They'll set their own password via the invite email
          const tempPassword = crypto.randomUUID() + '-Aa1!' // Meets password requirements
          const { data: newUser, error: createError } = await supabase.auth.admin.createUser({
            email: customerEmail,
            password: tempPassword,
            email_confirm: true, // Auto-confirm email since they already verified via Stripe
            user_metadata: {
              first_name: customerName.split(' ')[0] || '',
              last_name: customerName.split(' ').slice(1).join(' ') || '',
            },
          })

          if (createError) {
            console.error('Failed to create user for', customerEmail, createError)
            // Return 500 so Stripe retries the webhook
            return { statusCode: 500, body: 'Failed to create user account' }
          }

          userId = newUser.user.id

          // 3. Create profile record
          const nameParts = customerName.split(' ')
          await supabase.from('profiles').upsert({
            id: userId,
            email: customerEmail,
            first_name: nameParts[0] || null,
            last_name: nameParts.slice(1).join(' ') || null,
            role: 'client',
          })

          // 4. Send invite email so they can set their password and log in
          await supabase.auth.admin.inviteUserByEmail(customerEmail, {
            redirectTo: `${process.env.URL || 'https://app.dontweight.co.uk'}/dashboard`,
            data: {
              first_name: customerName.split(' ')[0] || '',
              last_name: customerName.split(' ').slice(1).join(' ') || '',
            },
          })

          // Send admin notification about new signup
          const nameParts2 = customerName.split(' ')
          sendNotification('newSignup', {
            first_name: nameParts2[0] || '',
            last_name: nameParts2.slice(1).join(' ') || '',
            email: customerEmail,
          }).catch(() => {})

          // Send welcome email to the patient
          sendNotification('welcomePatient', {
            first_name: nameParts2[0] || 'there',
            email: customerEmail,
          }).catch(() => {})
        }

        // 5. If this was a subscription checkout, create the subscription record
        if (subscriptionId) {
          const subscription = await stripe.subscriptions.retrieve(subscriptionId, {
            expand: ['items.data.price'],
          })
          const treatmentInfo = parseTreatmentFromSubscription(subscription)

          // Check if subscription already exists
          const { data: existingSub } = await supabase
            .from('subscriptions')
            .select('id')
            .eq('stripe_subscription_id', subscriptionId)
            .single()

          if (!existingSub) {
            await supabase.from('subscriptions').insert({
              user_id: userId,
              stripe_subscription_id: subscriptionId,
              stripe_customer_id: stripeCustomerId,
              treatment: treatmentInfo.treatment,
              dose: treatmentInfo.dose,
              status: 'active',
              price_monthly: treatmentInfo.pricePence,
              current_period_start: new Date(subscription.current_period_start * 1000).toISOString(),
              current_period_end: new Date(subscription.current_period_end * 1000).toISOString(),
            })
            // Send admin notification about new subscription
            sendNotification('newSubscription', {
              email: customerEmail,
              name: customerName,
              treatment: treatmentInfo.treatment,
              dose: treatmentInfo.dose,
              price_monthly: treatmentInfo.pricePence,
            }).catch(() => {})

            // Send order confirmation to the patient
            const patientName = customerName.split(' ')
            sendNotification('orderConfirmation', {
              first_name: patientName[0] || 'there',
              email: customerEmail,
              treatment: treatmentInfo.treatment.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase()),
              dose: treatmentInfo.dose,
              price_monthly: treatmentInfo.pricePence,
            }).catch(() => {})
          }
        }

        // Also mark this lead as converted if they exist in the leads table
        await supabase
          .from('leads')
          .update({ converted: true, converted_at: new Date().toISOString() })
          .eq('email', customerEmail.toLowerCase().trim())

        break
      }

      // ============================================
      // Subscription updated
      // ============================================
      case 'customer.subscription.updated': {
        const sub = stripeEvent.data.object
        await supabase
          .from('subscriptions')
          .update({
            status: sub.cancel_at_period_end ? 'cancelling' : sub.status === 'active' ? 'active' : sub.status === 'paused' ? 'paused' : sub.status,
            current_period_start: new Date(sub.current_period_start * 1000).toISOString(),
            current_period_end: new Date(sub.current_period_end * 1000).toISOString(),
          })
          .eq('stripe_subscription_id', sub.id)
        break
      }

      // ============================================
      // Subscription deleted / cancelled
      // ============================================
      case 'customer.subscription.deleted': {
        const sub = stripeEvent.data.object
        await supabase
          .from('subscriptions')
          .update({ status: 'cancelled' })
          .eq('stripe_subscription_id', sub.id)
        break
      }

      // ============================================
      // Payment succeeded
      // ============================================
      case 'invoice.payment_succeeded': {
        const invoice = stripeEvent.data.object
        if (invoice.subscription) {
          await supabase
            .from('subscriptions')
            .update({ status: 'active' })
            .eq('stripe_subscription_id', invoice.subscription)
        }
        break
      }

      // ============================================
      // Payment failed
      // ============================================
      case 'invoice.payment_failed': {
        const invoice = stripeEvent.data.object
        if (invoice.subscription) {
          await supabase
            .from('subscriptions')
            .update({ status: 'past_due' })
            .eq('stripe_subscription_id', invoice.subscription)
        }
        break
      }
    }
  } catch (err) {
    return { statusCode: 500, body: 'Internal error' }
  }

  return { statusCode: 200, body: JSON.stringify({ received: true }) }
}
