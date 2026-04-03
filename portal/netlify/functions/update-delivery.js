import { createClient } from '@supabase/supabase-js'
import { sendNotification } from './send-notification.js'

const supabase = createClient(process.env.VITE_SUPABASE_URL, process.env.SUPABASE_SERVICE_KEY)

const STATUS_FLOW = ['order_received', 'clinical_review', 'approved', 'with_pharmacy', 'dispatched', 'delivered']

export async function handler(event) {
  if (event.httpMethod !== 'POST') {
    return { statusCode: 405, body: 'Method not allowed' }
  }

  // Verify clinician auth
  const token = event.headers.authorization?.replace('Bearer ', '')
  if (!token) return { statusCode: 401, body: JSON.stringify({ message: 'Unauthorized' }) }

  const { data: { user }, error: authError } = await supabase.auth.getUser(token)
  if (authError || !user) return { statusCode: 401, body: JSON.stringify({ message: 'Unauthorized' }) }

  // Check clinician role
  const { data: profile } = await supabase.from('profiles').select('role').eq('id', user.id).single()
  if (profile?.role !== 'clinician') {
    return { statusCode: 403, body: JSON.stringify({ message: 'Clinician access required' }) }
  }

  try {
    const { deliveryId, action, trackingNumber, carrier } = JSON.parse(event.body)

    if (!deliveryId || !action) {
      return { statusCode: 400, body: JSON.stringify({ message: 'Missing deliveryId or action' }) }
    }

    // Fetch delivery
    const { data: delivery, error: fetchError } = await supabase
      .from('deliveries')
      .select('*, profiles!deliveries_user_id_fkey(first_name, last_name, email), subscriptions(treatment, dose, price_monthly)')
      .eq('id', deliveryId)
      .single()

    if (fetchError || !delivery) {
      return { statusCode: 404, body: JSON.stringify({ message: 'Delivery not found' }) }
    }

    const patient = delivery.profiles
    const sub = delivery.subscriptions

    if (action === 'advance') {
      // Normalize legacy statuses
      let currentStatus = delivery.status
      if (currentStatus === 'processing') currentStatus = 'order_received'
      if (currentStatus === 'in_transit') currentStatus = 'dispatched'

      const currentIdx = STATUS_FLOW.indexOf(currentStatus)
      if (currentIdx < 0 || currentIdx >= STATUS_FLOW.length - 1) {
        return { statusCode: 400, body: JSON.stringify({ message: 'Cannot advance further' }) }
      }

      const nextStatus = STATUS_FLOW[currentIdx + 1]
      const updates = { status: nextStatus }

      if (nextStatus === 'dispatched') {
        updates.dispatched_at = new Date().toISOString()
        if (trackingNumber) updates.tracking_number = trackingNumber.trim()
        if (carrier) updates.carrier = carrier
      }
      if (nextStatus === 'delivered') {
        updates.delivered_at = new Date().toISOString()
      }

      const { error: updateError } = await supabase
        .from('deliveries')
        .update(updates)
        .eq('id', deliveryId)

      if (updateError) {
        return { statusCode: 500, body: JSON.stringify({ message: 'Failed to update delivery' }) }
      }

      // Send patient email based on new status
      if (patient?.email) {
        const emailData = {
          email: patient.email,
          first_name: patient.first_name || '',
          last_name: patient.last_name || '',
          treatment: sub?.treatment || delivery.medication_name || '',
          dose: sub?.dose || '',
          price_monthly: sub?.price_monthly || 0,
          tracking_number: updates.tracking_number || delivery.tracking_number || '',
          carrier: updates.carrier || delivery.carrier || 'Royal Mail',
          medication_name: delivery.medication_name || '',
          medication_details: delivery.medication_details || '',
        }

        const emailMap = {
          clinical_review: 'orderInReview',
          approved: 'orderApproved',
          with_pharmacy: null, // no email for this internal step
          dispatched: 'orderDispatched',
          delivered: 'orderDelivered',
        }

        const templateName = emailMap[nextStatus]
        if (templateName) {
          await sendNotification(templateName, emailData).catch(() => {})
        }
      }

      return {
        statusCode: 200,
        body: JSON.stringify({ status: nextStatus, message: `Status updated to ${nextStatus}` }),
      }
    }

    if (action === 'addTracking') {
      if (!trackingNumber?.trim()) {
        return { statusCode: 400, body: JSON.stringify({ message: 'Missing tracking number' }) }
      }
      await supabase.from('deliveries').update({
        tracking_number: trackingNumber.trim(),
        carrier: carrier || 'Royal Mail',
      }).eq('id', deliveryId)

      // Send tracking email to patient
      if (patient?.email && delivery.status === 'dispatched') {
        await sendNotification('orderDispatched', {
          email: patient.email,
          first_name: patient.first_name || '',
          tracking_number: trackingNumber.trim(),
          carrier: carrier || 'Royal Mail',
          treatment: sub?.treatment || delivery.medication_name || '',
          dose: sub?.dose || '',
        }).catch(() => {})
      }

      return {
        statusCode: 200,
        body: JSON.stringify({ message: 'Tracking number added' }),
      }
    }

    return { statusCode: 400, body: JSON.stringify({ message: 'Unknown action' }) }
  } catch (err) {
    return {
      statusCode: 500,
      body: JSON.stringify({ message: 'Internal error' }),
    }
  }
}
