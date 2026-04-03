import Stripe from 'stripe'

const stripe = new Stripe(process.env.STRIPE_SECRET_KEY)
const TEST_PRICE_ID = 'price_1TGdRDRvWiaT0xusRdu1MPdz'

const CORS_HEADERS = {
  'Access-Control-Allow-Origin': '*',
  'Access-Control-Allow-Headers': 'Content-Type',
  'Access-Control-Allow-Methods': 'POST, OPTIONS',
}

export async function handler(event) {
  if (event.httpMethod === 'OPTIONS') {
    return { statusCode: 204, headers: CORS_HEADERS, body: '' }
  }
  if (event.httpMethod !== 'POST') {
    return { statusCode: 405, headers: CORS_HEADERS, body: 'Method not allowed' }
  }

  try {
    const { email, name } = JSON.parse(event.body)
    if (!email) {
      return { statusCode: 400, headers: CORS_HEADERS, body: JSON.stringify({ message: 'Email required' }) }
    }

    // Find or create customer
    const existing = await stripe.customers.list({ email, limit: 1 })
    let customerId
    if (existing.data.length > 0) {
      customerId = existing.data[0].id
    } else {
      const customer = await stripe.customers.create({ email, name: name || '' })
      customerId = customer.id
    }

    const session = await stripe.checkout.sessions.create({
      customer: customerId,
      mode: 'subscription',
      line_items: [{ price: TEST_PRICE_ID, quantity: 1 }],
      success_url: 'https://app.dontweight.co.uk/dashboard?checkout=success',
      cancel_url: 'https://dontweight.co.uk',
      allow_promotion_codes: true,
      metadata: { test: 'true' },
    })

    return {
      statusCode: 200,
      headers: CORS_HEADERS,
      body: JSON.stringify({ url: session.url }),
    }
  } catch (err) {
    return {
      statusCode: 500,
      headers: CORS_HEADERS,
      body: JSON.stringify({ message: 'Failed to create test checkout' }),
    }
  }
}
