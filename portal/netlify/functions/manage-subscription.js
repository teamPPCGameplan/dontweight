import Stripe from 'stripe'
import { createClient } from '@supabase/supabase-js'

const stripe = new Stripe(process.env.STRIPE_SECRET_KEY)
const supabase = createClient(process.env.VITE_SUPABASE_URL, process.env.SUPABASE_SERVICE_KEY)

export async function handler(event) {
  if (event.httpMethod !== 'POST') {
    return { statusCode: 405, body: 'Method not allowed' }
  }

  const token = event.headers.authorization?.replace('Bearer ', '')
  if (!token) return { statusCode: 401, body: JSON.stringify({ message: 'Unauthorized' }) }

  const { data: { user }, error: authError } = await supabase.auth.getUser(token)
  if (authError || !user) return { statusCode: 401, body: JSON.stringify({ message: 'Unauthorized' }) }

  try {
    const { action, subscriptionId, newPriceId, newDoseId, reason } = JSON.parse(event.body)

    // Verify the authenticated user owns this subscription
    const { data: userSub, error: subError } = await supabase
      .from('subscriptions')
      .select('stripe_subscription_id')
      .eq('user_id', user.id)
      .eq('stripe_subscription_id', subscriptionId)
      .maybeSingle()

    if (subError || !userSub) {
      return { statusCode: 403, body: JSON.stringify({ message: 'You do not have permission to modify this subscription' }) }
    }

    switch (action) {
      case 'pause': {
        await stripe.subscriptions.update(subscriptionId, {
          pause_collection: { behavior: 'void' },
        })
        await supabase
          .from('subscriptions')
          .update({ status: 'paused' })
          .eq('stripe_subscription_id', subscriptionId)
        break
      }

      case 'resume': {
        await stripe.subscriptions.update(subscriptionId, {
          pause_collection: null,
        })
        await supabase
          .from('subscriptions')
          .update({ status: 'active' })
          .eq('stripe_subscription_id', subscriptionId)
        break
      }

      case 'cancel': {
        await stripe.subscriptions.update(subscriptionId, {
          cancel_at_period_end: true,
          metadata: { cancel_reason: reason || 'Not specified' },
        })
        await supabase
          .from('subscriptions')
          .update({ status: 'cancelling' })
          .eq('stripe_subscription_id', subscriptionId)
        break
      }

      case 'change_dose': {
        // Accept either a direct Stripe price ID or a lookup key
        const sub = await stripe.subscriptions.retrieve(subscriptionId)
        let targetPriceId = newPriceId

        // If a direct price ID was provided, use it
        if (targetPriceId && targetPriceId.startsWith('price_')) {
          // Direct Stripe price ID — use as-is
        } else if (newDoseId) {
          // Legacy: look up the new price in Stripe by the dose ID as lookup key
          const prices = await stripe.prices.list({ lookup_keys: [newDoseId], limit: 1 })
          if (prices.data.length === 0) {
            return { statusCode: 400, body: JSON.stringify({ message: 'Price not found for this dose' }) }
          }
          targetPriceId = prices.data[0].id
        } else {
          return { statusCode: 400, body: JSON.stringify({ message: 'No price or dose specified' }) }
        }

        // Verify the price exists
        const price = await stripe.prices.retrieve(targetPriceId)
        if (!price || !price.active) {
          return { statusCode: 400, body: JSON.stringify({ message: 'Price is not available' }) }
        }

        await stripe.subscriptions.update(subscriptionId, {
          items: [{
            id: sub.items.data[0].id,
            price: targetPriceId,
          }],
          proration_behavior: 'create_prorations',
        })

        await supabase
          .from('subscriptions')
          .update({
            treatment: newDoseId || price.metadata?.treatment || '',
            dose: price.metadata?.dose || '',
            price_monthly: price.unit_amount,
          })
          .eq('stripe_subscription_id', subscriptionId)
        break
      }

      default:
        return { statusCode: 400, body: JSON.stringify({ message: 'Invalid action' }) }
    }

    return {
      statusCode: 200,
      body: JSON.stringify({ success: true }),
    }
  } catch (err) {
    return {
      statusCode: 500,
      body: JSON.stringify({ message: err.message || 'Failed to update subscription' }),
    }
  }
}
