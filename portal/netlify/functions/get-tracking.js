import { createClient } from '@supabase/supabase-js'

const supabase = createClient(process.env.VITE_SUPABASE_URL, process.env.SUPABASE_SERVICE_KEY)

export async function handler(event) {
  if (event.httpMethod !== 'GET') {
    return { statusCode: 405, body: 'Method not allowed' }
  }

  const token = event.headers.authorization?.replace('Bearer ', '')
  if (!token) return { statusCode: 401, body: JSON.stringify({ message: 'Unauthorized' }) }

  const { data: { user }, error: authError } = await supabase.auth.getUser(token)
  if (authError || !user) return { statusCode: 401, body: JSON.stringify({ message: 'Unauthorized' }) }

  const trackingNumber = event.queryStringParameters?.tracking
  if (!trackingNumber) {
    return { statusCode: 400, body: JSON.stringify({ message: 'Tracking number required' }) }
  }

  try {
    // In production, this would call Royal Mail API or similar
    // For now, return the delivery record from Supabase
    const { data: delivery } = await supabase
      .from('deliveries')
      .select('*')
      .eq('tracking_number', trackingNumber)
      .single()

    return {
      statusCode: 200,
      body: JSON.stringify({
        tracking_number: trackingNumber,
        status: delivery?.status || 'unknown',
        carrier: delivery?.carrier || 'Royal Mail',
        estimated_delivery: delivery?.estimated_delivery,
        tracking_url: `https://www.royalmail.com/track-your-item#/tracking-results/${trackingNumber}`,
      }),
    }
  } catch (err) {
    return {
      statusCode: 500,
      body: JSON.stringify({ message: 'Unable to fetch tracking info' }),
    }
  }
}
