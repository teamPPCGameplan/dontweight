import { useState, useRef, useEffect } from 'react'
import { Send, MessageSquare, Shield, Clock, Paperclip } from 'lucide-react'
import { useMessages } from '../hooks/useMessages'
import { useAuth } from '../hooks/useAuth'
import MessageBubble from '../components/MessageBubble'
import { Skeleton } from '../components/LoadingSpinner'

export default function Messages() {
  const { isClinic } = useAuth()
  const { messages, loading, sendMessage, markAsRead } = useMessages()
  const [text, setText] = useState('')
  const [sending, setSending] = useState(false)
  const [sendError, setSendError] = useState('')
  const bottomRef = useRef(null)

  useEffect(() => {
    bottomRef.current?.scrollIntoView({ behavior: 'smooth' })
  }, [messages])

  useEffect(() => {
    if (messages.length > 0) markAsRead()
  }, [messages.length, markAsRead])

  async function handleSend(e) {
    e.preventDefault()
    if (!text.trim()) return
    setSending(true)
    setSendError('')
    try {
      await sendMessage(text.trim())
      setText('')
    } catch (err) {
      setSendError('Failed to send message. Please try again.')
    }
    setSending(false)
  }

  return (
    <div className="max-w-2xl mx-auto animate-fade-in">
      <div className="bg-dark-card rounded-[16px] border border-border flex flex-col h-[calc(100vh-12rem)] md:h-[calc(100vh-10rem)]">
        {/* Header */}
        <div className="p-4 border-b border-border">
          <div className="flex items-center justify-between">
            <div>
              <h1 className="text-lg font-bold text-ink">Messages</h1>
              <p className="text-xs text-slate flex items-center gap-1">
                <Clock size={10} /> Your clinician typically responds within 2 hours
              </p>
            </div>
            <div className="flex items-center gap-1.5 text-[11px] text-emerald-400 font-medium bg-emerald-500/10 px-2.5 py-1 rounded-full">
              <span className="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse" />
              Secure
            </div>
          </div>
        </div>

        {/* Messages */}
        <div className="flex-1 overflow-y-auto p-4 space-y-1">
          {loading ? (
            <div className="space-y-3">
              {Array.from({ length: 4 }).map((_, i) => (
                <div key={i} className={`flex ${i % 2 === 0 ? 'justify-start' : 'justify-end'}`}>
                  <Skeleton className={`h-12 ${i % 2 === 0 ? 'w-48' : 'w-56'} rounded-2xl`} />
                </div>
              ))}
            </div>
          ) : messages.length === 0 ? (
            <div className="flex flex-col items-center justify-center h-full text-center px-4">
              <div className="w-14 h-14 rounded-full bg-gradient-to-br from-gold/15 to-emerald-500/10 flex items-center justify-center mb-4">
                <MessageSquare size={24} className="text-gold" />
              </div>
              <p className="text-sm font-semibold text-ink mb-1">Start a conversation with your clinician</p>
              <p className="text-xs text-slate mb-4 max-w-xs leading-relaxed">Ask about your treatment, side effects, dosing adjustments, or anything else. All messages are private and reviewed by your assigned clinician.</p>
              <div className="flex flex-wrap items-center justify-center gap-3">
                <div className="flex items-center gap-1.5 text-[11px] text-slate bg-warm rounded-full px-3 py-1.5">
                  <Shield size={10} /> End-to-end encrypted
                </div>
                <div className="flex items-center gap-1.5 text-[11px] text-slate bg-warm rounded-full px-3 py-1.5">
                  <Clock size={10} /> Replies within 2 hours
                </div>
              </div>
            </div>
          ) : (
            messages.map((msg) => (
              <MessageBubble
                key={msg.id}
                message={msg}
                isOwn={
                  isClinic
                    ? msg.sender_role === 'clinician'
                    : msg.sender_role === 'client'
                }
              />
            ))
          )}
          {sending && (
            <div className="flex justify-start mb-3">
              <div className="bg-warm rounded-2xl rounded-bl-md px-4 py-3">
                <div className="flex gap-1.5">
                  <div className="w-2 h-2 rounded-full bg-gold/40 animate-bounce" style={{ animationDelay: '0ms' }} />
                  <div className="w-2 h-2 rounded-full bg-gold/40 animate-bounce" style={{ animationDelay: '150ms' }} />
                  <div className="w-2 h-2 rounded-full bg-gold/40 animate-bounce" style={{ animationDelay: '300ms' }} />
                </div>
              </div>
            </div>
          )}
          <div ref={bottomRef} />
        </div>

        {/* Error */}
        {sendError && (
          <div className="px-4 pb-2" role="alert">
            <p className="text-xs text-red-400">{sendError}</p>
          </div>
        )}

        {/* Input */}
        <form onSubmit={handleSend} className="p-4 border-t border-border">
          <div className="flex gap-2">
            <input
              type="text"
              value={text}
              onChange={(e) => setText(e.target.value)}
              onKeyDown={(e) => {
                if (e.key === 'Enter' && !e.shiftKey && text.trim()) {
                  e.preventDefault()
                  handleSend(e)
                }
              }}
              placeholder="Type a message..."
              maxLength={2000}
              disabled={sending}
              aria-label="Message input"
              className="flex-1 px-4 py-2.5 bg-dark border border-border rounded-full text-sm text-ink focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold/20 disabled:opacity-50"
            />
            <button
              type="submit"
              disabled={sending || !text.trim()}
              className="bg-gold text-dark p-2.5 rounded-full hover:bg-gold-light transition-all duration-200 active:scale-95 disabled:opacity-40 shrink-0"
              aria-label="Send message"
            >
              {sending ? (
                <div className="w-4 h-4 border-2 border-dark/30 border-t-dark rounded-full animate-spin" />
              ) : (
                <Send size={16} />
              )}
            </button>
          </div>
          {text.length > 1800 && (
            <p className={`text-[10px] mt-1.5 ml-4 ${text.length >= 2000 ? 'text-red-400' : 'text-slate'}`}>
              {2000 - text.length} characters remaining
            </p>
          )}
        </form>
      </div>
    </div>
  )
}
