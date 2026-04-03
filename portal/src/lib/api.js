const API_BASE = '/.netlify/functions'

async function fetchAPI(endpoint, options = {}) {
  const { method = 'GET', body, token } = options
  const headers = { 'Content-Type': 'application/json' }
  if (token) headers['Authorization'] = `Bearer ${token}`

  const res = await fetch(`${API_BASE}/${endpoint}`, {
    method,
    headers,
    body: body ? JSON.stringify(body) : undefined,
  })

  if (!res.ok) {
    const error = await res.json().catch(() => ({ message: 'Something went wrong' }))
    throw new Error(error.message || `API error: ${res.status}`)
  }

  return res.json()
}

export const api = {
  createCheckout: (data, token) =>
    fetchAPI('create-checkout', { method: 'POST', body: data, token }),

  manageSubscription: (data, token) =>
    fetchAPI('manage-subscription', { method: 'POST', body: data, token }),

  aiChat: (data, token) =>
    fetchAPI('ai-chat', { method: 'POST', body: data, token }),

  getTracking: (trackingNumber, token) =>
    fetchAPI(`get-tracking?tracking=${trackingNumber}`, { token }),

  captureLead: (data) =>
    fetchAPI('capture-lead', { method: 'POST', body: data }),

  updateDelivery: (data, token) =>
    fetchAPI('update-delivery', { method: 'POST', body: data, token }),
}
