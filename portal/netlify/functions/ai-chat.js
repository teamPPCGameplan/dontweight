import { createClient } from '@supabase/supabase-js'

const supabase = createClient(process.env.VITE_SUPABASE_URL, process.env.SUPABASE_SERVICE_KEY)

// Rate limiting per authenticated user (cost protection)
const userRateLimitMap = new Map()
const USER_RATE_LIMIT_WINDOW = 60000 // 1 minute
const USER_RATE_LIMIT_MAX = 8 // 8 messages per minute per user
const USER_DAILY_LIMIT = 100 // 100 messages per day per user
const userDailyMap = new Map()

function checkUserRateLimit(userId) {
  const now = Date.now()

  // Per-minute check
  const entry = userRateLimitMap.get(userId)
  if (!entry || now - entry.start > USER_RATE_LIMIT_WINDOW) {
    userRateLimitMap.set(userId, { start: now, count: 1 })
  } else {
    entry.count++
    if (entry.count > USER_RATE_LIMIT_MAX) return false
  }

  // Daily check
  const today = new Date().toDateString()
  const daily = userDailyMap.get(userId)
  if (!daily || daily.day !== today) {
    userDailyMap.set(userId, { day: today, count: 1 })
  } else {
    daily.count++
    if (daily.count > USER_DAILY_LIMIT) return false
  }

  return true
}

const SYSTEM_PROMPT = `You are the friendly AI assistant for **don't weight** (dontweight.co.uk), a UK CQC-registered, MHRA-approved weight management clinic.

## WHAT YOU CAN HELP WITH (ONLY these topics):
- **About don't weight**: We are an online weight management clinic offering evidence-based, clinician-led treatments. We are CQC-registered and MHRA-approved. Every body is welcome.
- **Our treatments**: We prescribe Mounjaro (tirzepatide) and Wegovy (semaglutide) — both are GLP-1 receptor agonists for weight management.
- **How it works**: Patients complete an online consultation, a prescriber reviews their case, medication is dispensed and delivered monthly via Royal Mail.
- **Pricing**: Mounjaro starts from £150/month (2.5mg starter, then £170/month ongoing). Wegovy starts from £114/month (0.25mg). Prices vary by dose.
- **Health checks**: We offer blood test packages — Baseline (£149), Standard (£599), and Premium (£999) — to monitor health during treatment.
- **Booking a video consultation**: Patients can book a 15-minute video call with their clinician through the portal.
- **Common side effects**: Nausea, reduced appetite, constipation, diarrhoea, injection site reactions. These usually settle within a few weeks.
- **General tips**: Staying hydrated, eating smaller meals, gentle exercise, and following clinician advice.
- **What's included**: Monthly prescription, clinician support via messaging, delivery, dose adjustments, and access to this patient portal.
- **Contact**: hello@dontweight.co.uk or message your clinician through the Messages section of the portal.

## RULES (STRICT):
- You are NOT a doctor or clinician. NEVER give specific medical advice, diagnose conditions, or recommend dose changes.
- If someone asks about dosing, medical concerns, or anything clinical, ALWAYS direct them to message their clinician via the portal's Messages section.
- ONLY answer questions related to the topics above. If someone asks about unrelated topics (politics, coding, general knowledge, etc.), politely say: "I can only help with questions about don't weight and our weight management services. Is there anything about your treatment or our clinic I can help with?"
- Be warm, supportive, and inclusive. Never use shame language about weight.
- Keep answers concise (2-4 sentences unless more detail is needed).
- Always use UK English spelling.`

export async function handler(event) {
  if (event.httpMethod !== 'POST') {
    return { statusCode: 405, body: 'Method not allowed' }
  }

  const token = event.headers.authorization?.replace('Bearer ', '')
  if (!token) return { statusCode: 401, body: JSON.stringify({ message: 'Unauthorized' }) }

  const { data: { user }, error: authError } = await supabase.auth.getUser(token)
  if (authError || !user) return { statusCode: 401, body: JSON.stringify({ message: 'Unauthorized' }) }

  // Rate limit per user (cost protection)
  if (!checkUserRateLimit(user.id)) {
    return {
      statusCode: 429,
      body: JSON.stringify({ message: 'You\'re sending messages too quickly. Please wait a moment and try again.' }),
    }
  }

  try {
    const { messages } = JSON.parse(event.body)

    // Limit input to prevent abuse
    if (!Array.isArray(messages) || messages.length > 20) {
      return { statusCode: 400, body: JSON.stringify({ message: 'Too many messages' }) }
    }
    for (const m of messages) {
      if (typeof m.content !== 'string' || m.content.length > 2000) {
        return { statusCode: 400, body: JSON.stringify({ message: 'Message too long' }) }
      }
    }

    const anthropicMessages = messages.map((m) => ({
      role: m.role,
      content: m.content,
    }))

    const response = await fetch('https://api.anthropic.com/v1/messages', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'x-api-key': process.env.ANTHROPIC_API_KEY,
        'anthropic-version': '2023-06-01',
      },
      body: JSON.stringify({
        model: 'claude-sonnet-4-20250514',
        max_tokens: 1024,
        system: SYSTEM_PROMPT,
        messages: anthropicMessages,
      }),
    })

    if (!response.ok) {
      const errBody = await response.text()
      throw new Error('AI service unavailable')
    }

    const data = await response.json()
    const reply = data.content[0]?.text || 'Sorry, I could not generate a response.'

    // Save to chat history
    const lastUserMsg = messages[messages.length - 1]
    await supabase.from('ai_chats').insert([
      { user_id: user.id, role: 'user', content: lastUserMsg.content },
      { user_id: user.id, role: 'assistant', content: reply },
    ])

    return {
      statusCode: 200,
      body: JSON.stringify({ reply }),
    }
  } catch (err) {
    return {
      statusCode: 500,
      body: JSON.stringify({ message: 'AI assistant is temporarily unavailable. Please try again.' }),
    }
  }
}
