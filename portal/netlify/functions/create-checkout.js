import Stripe from 'stripe'
import { createClient } from '@supabase/supabase-js'

const stripe = new Stripe(process.env.STRIPE_SECRET_KEY)
const supabase = createClient(process.env.VITE_SUPABASE_URL, process.env.SUPABASE_SERVICE_KEY)

// Allowlist of valid Don't Weight Stripe price IDs
const ALLOWED_PRICE_IDS = new Set([
  // Mounjaro
  'price_1TG7ZzRvWiaT0xusN7LIEuy1', // 2.5mg
  'price_1TG7ZzRvWiaT0xusC430jCBS', // 5mg
  'price_1TG7a0RvWiaT0xus4VZLc6dw', // 7.5mg
  'price_1TG7a1RvWiaT0xusXiFZdB5e', // 10mg
  'price_1TG7a1RvWiaT0xusoIf1IMCK', // 12.5mg
  'price_1TG7a2RvWiaT0xusoYCyjDxQ', // 15mg
  // Wegovy
  'price_1TG7b8RvWiaT0xusq6uqsal4', // 0.25mg
  'price_1TG7aaRvWiaT0xussfxNvUFH', // 0.5mg
  'price_1TG7abRvWiaT0xus8pjfOgN2', // 1mg
  'price_1TG7abRvWiaT0xuszy0IWscg', // 1.7mg
  'price_1TG7acRvWiaT0xusN7Ge7kgx', // 2.4mg
  // Health Checks
  'price_1TG7b9RvWiaT0xus5M81KSKX', // Standard initial £599
  'price_1TG7b9RvWiaT0xus1e37XZGC', // Standard annual £1000/yr
  'price_1TG7bARvWiaT0xusbRFtVo8Z', // Premium initial £999
  'price_1TG7bARvWiaT0xusLu4Vd46V', // Premium annual £1700/yr
  // Test
  'price_1TGdRDRvWiaT0xusRdu1MPdz', // £1/month test
])

function isValidPriceId(priceId) {
  return typeof priceId === 'string' && ALLOWED_PRICE_IDS.has(priceId)
}

export async function handler(event) {
  if (event.httpMethod !== 'POST') {
    return { statusCode: 405, body: 'Method not allowed' }
  }

  // Verify auth
  const token = event.headers.authorization?.replace('Bearer ', '')
  if (!token) return { statusCode: 401, body: JSON.stringify({ message: 'Unauthorized' }) }

  const { data: { user }, error: authError } = await supabase.auth.getUser(token)
  if (authError || !user) return { statusCode: 401, body: JSON.stringify({ message: 'Unauthorized' }) }

  try {
    const { priceId, mode, successUrl, cancelUrl } = JSON.parse(event.body)

    if (!priceId || !isValidPriceId(priceId)) {
      return { statusCode: 400, body: JSON.stringify({ message: 'Invalid price ID' }) }
    }

    // Validate redirect URLs to prevent open redirect attacks
    const baseUrl = process.env.URL || 'https://dontweight-portal.netlify.app'
    function isSafeUrl(url) {
      if (!url) return false
      try {
        const parsed = new URL(url)
        const allowed = new URL(baseUrl)
        return parsed.origin === allowed.origin
      } catch { return false }
    }

    // Get or create Stripe customer
    const { data: profile } = await supabase.from('profiles').select('*').eq('id', user.id).single()
    const { data: sub } = await supabase.from('subscriptions').select('stripe_customer_id').eq('user_id', user.id).not('stripe_customer_id', 'is', null).limit(1).single()

    let customerId = sub?.stripe_customer_id
    if (!customerId) {
      const customer = await stripe.customers.create({
        email: user.email,
        name: `${profile?.first_name || ''} ${profile?.last_name || ''}`.trim(),
        metadata: { supabase_user_id: user.id },
      })
      customerId = customer.id
    }

    const validModes = ['payment', 'subscription']
    const checkoutMode = validModes.includes(mode) ? mode : 'subscription'

    const sessionParams = {
      customer: customerId,
      mode: checkoutMode,
      line_items: [{ price: priceId, quantity: 1 }],
      success_url: isSafeUrl(successUrl) ? successUrl : `${baseUrl}/dashboard?checkout=success`,
      cancel_url: isSafeUrl(cancelUrl) ? cancelUrl : `${baseUrl}/dashboard`,
      metadata: { user_id: user.id },
    }

    // For subscriptions, allow promotion codes
    if (mode === 'subscription') {
      sessionParams.allow_promotion_codes = true
    }

    const session = await stripe.checkout.sessions.create(sessionParams)

    return {
      statusCode: 200,
      body: JSON.stringify({ url: session.url }),
    }
  } catch (err) {
    return {
      statusCode: 500,
      body: JSON.stringify({ message: 'Failed to create checkout session' }),
    }
  }
}
