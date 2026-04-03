import { createClient } from '@supabase/supabase-js'
import { sendNotification } from './send-notification.js'

const supabase = createClient(process.env.VITE_SUPABASE_URL, process.env.SUPABASE_SERVICE_KEY)

export async function handler(event) {
  // Allow CORS from WordPress site and portal only
  const allowedOrigins = [
    'https://dontweight.co.uk',
    'https://www.dontweight.co.uk',
    'https://dontweight-portal.netlify.app',
  ]
  const origin = event.headers.origin || ''
  const corsOrigin = allowedOrigins.includes(origin) ? origin : allowedOrigins[0]
  const headers = {
    'Access-Control-Allow-Origin': corsOrigin,
    'Access-Control-Allow-Headers': 'Content-Type, X-Api-Key',
    'Access-Control-Allow-Methods': 'POST, OPTIONS',
    'Content-Type': 'application/json',
  }

  if (event.httpMethod === 'OPTIONS') {
    return { statusCode: 204, headers }
  }

  if (event.httpMethod !== 'POST') {
    return { statusCode: 405, headers, body: 'Method not allowed' }
  }

  try {
    const body = JSON.parse(event.body)
    const {
      first_name,
      last_name,
      email,
      phone,
      source,
      page_url,
      utm_source,
      utm_medium,
      utm_campaign,
      questionnaire_data,
      consent_marketing,
      consent_data_processing,
      // Contact form fields
      subject,
      message,
      // Consultation form fields
      date_of_birth,
      treatment,
      // Video call booking fields
      day,
      time,
      reason,
    } = body

    // Validate required fields
    if (!email || typeof email !== 'string' || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.trim())) {
      return {
        statusCode: 400,
        headers,
        body: JSON.stringify({ message: 'A valid email address is required' }),
      }
    }

    if (!first_name || !last_name || String(first_name).length > 100 || String(last_name).length > 100) {
      return {
        statusCode: 400,
        headers,
        body: JSON.stringify({ message: 'First name and last name are required' }),
      }
    }

    // Get IP and user agent for analytics
    const ip_address = event.headers['x-forwarded-for']?.split(',')[0]?.trim() ||
                       event.headers['x-nf-client-connection-ip'] || null
    const user_agent = event.headers['user-agent'] || null

    // Build questionnaire data object if extra fields provided
    const extraData = {}
    if (date_of_birth) extraData.date_of_birth = date_of_birth
    if (treatment) extraData.treatment = treatment
    if (subject) extraData.subject = subject
    if (message) extraData.message = message
    if (day) extraData.day = day
    if (time) extraData.time = time
    if (reason) extraData.reason = reason

    const fullQuestionnaireData = questionnaire_data
      ? { ...questionnaire_data, ...extraData }
      : Object.keys(extraData).length > 0 ? extraData : null

    // Upsert lead (update if email already exists, insert if new)
    const { data: lead, error: insertError } = await supabase
      .from('leads')
      .upsert(
        {
          first_name,
          last_name,
          email: email.toLowerCase().trim(),
          phone: phone || null,
          source: source || 'website',
          page_url: page_url || null,
          utm_source: utm_source || null,
          utm_medium: utm_medium || null,
          utm_campaign: utm_campaign || null,
          questionnaire_data: fullQuestionnaireData,
          consent_marketing: consent_marketing || false,
          consent_data_processing: consent_data_processing || false,
          ip_address,
          user_agent,
        },
        {
          onConflict: 'leads_email_unique',
          ignoreDuplicates: false,
        }
      )
      .select()
      .single()

    if (insertError) {
      // If unique constraint fails, try an update instead
      if (insertError.code === '23505') {
        const { error: updateError } = await supabase
          .from('leads')
          .update({
            first_name,
            last_name,
            phone: phone || undefined,
            source: source || undefined,
            page_url: page_url || undefined,
            utm_source: utm_source || undefined,
            utm_medium: utm_medium || undefined,
            utm_campaign: utm_campaign || undefined,
            questionnaire_data: fullQuestionnaireData || undefined,
          })
          .eq('email', email.toLowerCase().trim())

        if (updateError) {
          return { statusCode: 500, headers, body: JSON.stringify({ message: 'Failed to update lead' }) }
        }
      } else {
        return {
          statusCode: 500,
          headers,
          body: JSON.stringify({ message: 'Failed to capture lead' }),
        }
      }
    }

    // Send email notification based on source type
    const notificationData = {
      first_name,
      last_name,
      email,
      phone,
      source,
      page_url,
      utm_source,
      utm_medium,
      utm_campaign,
      questionnaire_data: fullQuestionnaireData,
      subject,
      message,
      date_of_birth,
      treatment,
    }

    // Determine notification type
    let notificationType = 'newLead'
    if (source === 'contact' || subject) {
      notificationType = 'contactForm'
    } else if (source === 'consultation') {
      notificationType = 'consultationSubmission'
    }

    // Send notification asynchronously (don't block the response)
    sendNotification(notificationType, notificationData).catch(() => {})

    return {
      statusCode: 200,
      headers,
      body: JSON.stringify({
        success: true,
        message: 'Lead captured successfully',
      }),
    }
  } catch (err) {
    return {
      statusCode: 500,
      headers,
      body: JSON.stringify({ message: 'Internal error' }),
    }
  }
}
