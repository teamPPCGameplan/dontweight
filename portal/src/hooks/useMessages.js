import { useState, useEffect } from 'react'
import { supabase } from '../lib/supabase'
import { useAuth } from './useAuth'

export function useMessages(userId = null) {
  const { user, isClinic } = useAuth()
  const [messages, setMessages] = useState([])
  const [loading, setLoading] = useState(true)

  const targetUserId = userId || user?.id

  useEffect(() => {
    if (!targetUserId) return
    fetchMessages()

    const channel = supabase
      .channel(`messages-${targetUserId}`)
      .on('postgres_changes', {
        event: 'INSERT',
        schema: 'public',
        table: 'messages',
        filter: `user_id=eq.${targetUserId}`,
      }, (payload) => {
        setMessages((prev) => [...prev, payload.new])
      })
      .subscribe()

    return () => supabase.removeChannel(channel)
  }, [targetUserId])

  async function fetchMessages() {
    setLoading(true)
    const { data } = await supabase
      .from('messages')
      .select('*')
      .eq('user_id', targetUserId)
      .order('created_at', { ascending: true })
    setMessages(data || [])
    setLoading(false)
  }

  async function sendMessage(content) {
    const { error } = await supabase.from('messages').insert({
      user_id: targetUserId,
      sender_role: isClinic ? 'clinician' : 'client',
      sender_name: isClinic ? 'Your Clinician' : 'You',
      content,
    })
    if (error) throw error
  }

  async function markAsRead() {
    const unreadRole = isClinic ? 'client' : 'clinician'
    await supabase
      .from('messages')
      .update({ is_read: true })
      .eq('user_id', targetUserId)
      .eq('sender_role', unreadRole)
      .eq('is_read', false)
  }

  const unreadCount = messages.filter(
    (m) => !m.is_read && m.sender_role !== (isClinic ? 'clinician' : 'client')
  ).length

  return { messages, loading, sendMessage, markAsRead, unreadCount, refetch: fetchMessages }
}
