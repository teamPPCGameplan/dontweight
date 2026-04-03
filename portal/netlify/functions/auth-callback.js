export async function handler(event) {
  // Supabase handles auth callbacks via the client-side SDK
  // This function exists as a landing endpoint for magic link redirects
  const token_hash = event.queryStringParameters?.token_hash
  const type = event.queryStringParameters?.type

  return {
    statusCode: 302,
    headers: {
      Location: `/dashboard${token_hash ? `?token_hash=${token_hash}&type=${type}` : ''}`,
    },
  }
}
