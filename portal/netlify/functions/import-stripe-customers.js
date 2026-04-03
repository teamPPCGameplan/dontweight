import Stripe from 'stripe'
import { createClient } from '@supabase/supabase-js'

const stripe = new Stripe(process.env.STRIPE_SECRET_KEY)
const supabase = createClient(process.env.VITE_SUPABASE_URL, process.env.SUPABASE_SERVICE_KEY)

// Map price amounts to treatment info (actual Stripe pricing in pence)
const priceMap = {
  // Current Mounjaro prices
  15000: { treatment: 'mounjaro-2.5mg', dose: '2.5mg' },
  17000: { treatment: 'mounjaro-2.5mg', dose: '2.5mg' },
  18500: { treatment: 'mounjaro-5mg', dose: '5mg' },
  25000: { treatment: 'mounjaro-7.5mg', dose: '7.5mg' },
  27500: { treatment: 'mounjaro-10mg', dose: '10mg' },
  28500: { treatment: 'mounjaro-12.5mg', dose: '12.5mg' },
  31000: { treatment: 'mounjaro-15mg', dose: '15mg' },
  // Current Wegovy prices
  11400: { treatment: 'wegovy-0.25mg', dose: '0.25mg' },
  13900: { treatment: 'wegovy-0.5mg', dose: '0.5mg' },
  14900: { treatment: 'wegovy-0.25mg', dose: '0.25mg' },
  16900: { treatment: 'wegovy-1mg', dose: '1mg' },
  19900: { treatment: 'wegovy-1.7mg', dose: '1.7mg' },
  22900: { treatment: 'wegovy-2.4mg', dose: '2.4mg' },
}

export async function handler(event) {
  // Only allow POST with a secret key for security
  if (event.httpMethod !== 'POST') {
    return { statusCode: 405, body: 'Method not allowed' }
  }

  // Simple API key protection — set ADMIN_SECRET in Netlify env vars
  const adminSecret = event.headers['x-admin-secret']
  if (adminSecret !== process.env.ADMIN_SECRET) {
    return { statusCode: 403, body: JSON.stringify({ error: 'Forbidden. Set x-admin-secret header.' }) }
  }

  const results = { created: [], skipped: [], errors: [] }

  try {
    // Pre-fetch all existing Supabase users once (instead of per-customer)
    const allUsers = []
    let page = 1
    let fetchMore = true
    while (fetchMore) {
      const { data: { users: batch } } = await supabase.auth.admin.listUsers({ page, perPage: 1000 })
      if (batch && batch.length > 0) {
        allUsers.push(...batch)
        page++
        if (batch.length < 1000) fetchMore = false
      } else {
        fetchMore = false
      }
    }
    // Build a lookup map by email for O(1) lookups
    const usersByEmail = new Map()
    for (const u of allUsers) {
      if (u.email) usersByEmail.set(u.email.toLowerCase(), u)
    }

    // Fetch all Stripe customers with active subscriptions
    let hasMore = true
    let startingAfter = undefined

    while (hasMore) {
      const params = { limit: 100, expand: ['data.subscriptions'] }
      if (startingAfter) params.starting_after = startingAfter

      const customers = await stripe.customers.list(params)

      for (const customer of customers.data) {
        const email = customer.email
        if (!email) {
          results.skipped.push({ id: customer.id, reason: 'No email' })
          continue
        }

        try {
          // Check if user already exists in Supabase (O(1) lookup)
          const existingUser = usersByEmail.get(email.toLowerCase()) || null

          if (existingUser) {
            results.skipped.push({ email, reason: 'Already exists' })

            // But still check if they have a subscription record
            const activeSub = customer.subscriptions?.data?.find(
              (s) => s.status === 'active' || s.status === 'trialing'
            )
            if (activeSub) {
              const { data: existingSub } = await supabase
                .from('subscriptions')
                .select('id')
                .eq('stripe_subscription_id', activeSub.id)
                .single()

              if (!existingSub) {
                const amount = activeSub.items?.data?.[0]?.price?.unit_amount || 0
                const treatmentInfo = priceMap[amount] || { treatment: 'unknown', dose: '' }

                await supabase.from('subscriptions').insert({
                  user_id: existingUser.id,
                  stripe_subscription_id: activeSub.id,
                  stripe_customer_id: customer.id,
                  treatment: activeSub.metadata?.treatment || treatmentInfo.treatment,
                  dose: activeSub.metadata?.dose || treatmentInfo.dose,
                  status: 'active',
                  price_monthly: amount,
                  current_period_start: new Date(activeSub.current_period_start * 1000).toISOString(),
                  current_period_end: new Date(activeSub.current_period_end * 1000).toISOString(),
                })
              }
            }
            continue
          }

          // Create new Supabase user
          const nameParts = (customer.name || '').split(' ')
          const firstName = nameParts[0] || ''
          const lastName = nameParts.slice(1).join(' ') || ''

          const tempPassword = crypto.randomUUID() + '-Aa1!'
          const { data: newUser, error: createError } = await supabase.auth.admin.createUser({
            email,
            password: tempPassword,
            email_confirm: true,
            user_metadata: { first_name: firstName, last_name: lastName },
          })

          if (createError) {
            results.errors.push({ email, error: createError.message })
            continue
          }

          // Create profile
          await supabase.from('profiles').upsert({
            id: newUser.user.id,
            email,
            first_name: firstName || null,
            last_name: lastName || null,
            role: 'client',
          })

          // Create subscription record for active subscription
          const activeSub = customer.subscriptions?.data?.find(
            (s) => s.status === 'active' || s.status === 'trialing'
          )

          if (activeSub) {
            const amount = activeSub.items?.data?.[0]?.price?.unit_amount || 0
            const treatmentInfo = priceMap[amount] || { treatment: 'unknown', dose: '' }

            await supabase.from('subscriptions').insert({
              user_id: newUser.user.id,
              stripe_subscription_id: activeSub.id,
              stripe_customer_id: customer.id,
              treatment: activeSub.metadata?.treatment || treatmentInfo.treatment,
              dose: activeSub.metadata?.dose || treatmentInfo.dose,
              status: 'active',
              price_monthly: amount,
              current_period_start: new Date(activeSub.current_period_start * 1000).toISOString(),
              current_period_end: new Date(activeSub.current_period_end * 1000).toISOString(),
            })
          }

          // Send password reset so they can set their password
          await supabase.auth.admin.generateLink({
            type: 'recovery',
            email,
            options: {
              redirectTo: `${process.env.URL || 'https://dontweight-portal.netlify.app'}/dashboard`,
            },
          })

          // Add to lookup map so we don't re-create on duplicate emails
          usersByEmail.set(email.toLowerCase(), newUser.user)

          results.created.push({ email, name: customer.name })
        } catch (err) {
          results.errors.push({ email, error: err.message })
        }
      }

      hasMore = customers.has_more
      if (customers.data.length > 0) {
        startingAfter = customers.data[customers.data.length - 1].id
      }
    }

    return {
      statusCode: 200,
      body: JSON.stringify({
        summary: {
          created: results.created.length,
          skipped: results.skipped.length,
          errors: results.errors.length,
        },
        details: results,
      }, null, 2),
    }
  } catch (err) {
    return {
      statusCode: 500,
      body: JSON.stringify({ error: err.message }),
    }
  }
}
