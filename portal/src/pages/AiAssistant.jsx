import { useState, useRef, useEffect } from 'react'
import { Send, Bot, AlertTriangle } from 'lucide-react'
import { useAuth } from '../hooks/useAuth'
import { api } from '../lib/api'
import { supabase } from '../lib/supabase'

const quickQuestions = [
  'What treatments do you offer?',
  'How much does it cost?',
  'How do I start a subscription?',
  'How do I cancel or pause my plan?',
  'Common side effects',
  'How do I book a health check?',
  'What\'s included in my plan?',
  'How do I book a video call?',
]

export default function AiAssistant() {
  const { user, getToken } = useAuth()
  const [messages, setMessages] = useState([])
  const [input, setInput] = useState('')
  const [loading, setLoading] = useState(false)
  const [historyLoaded, setHistoryLoaded] = useState(false)
  const bottomRef = useRef(null)

  useEffect(() => { loadHistory() }, [])

  useEffect(() => {
    bottomRef.current?.scrollIntoView({ behavior: 'smooth' })
  }, [messages])

  async function loadHistory() {
    try {
      const { data } = await supabase
        .from('ai_chats')
        .select('*')
        .eq('user_id', user.id)
        .order('created_at', { ascending: true })
        .limit(50)
      setMessages(data?.map((m) => ({ role: m.role, content: m.content })) || [])
    } catch (err) {
      // Silently handle - chat starts fresh
    }
    setHistoryLoaded(true)
  }

  async function sendMessage(text) {
    if (!text.trim()) return
    const userMsg = { role: 'user', content: text.trim() }
    const updated = [...messages, userMsg]
    setMessages(updated)
    setInput('')
    setLoading(true)

    try {
      const token = await getToken()
      const res = await api.aiChat({ messages: updated.slice(-20) }, token)
      const assistantMsg = { role: 'assistant', content: res.reply }
      setMessages([...updated, assistantMsg])
    } catch {
      setMessages([...updated, { role: 'assistant', content: 'Sorry, I had trouble responding. Please try again.' }])
    }
    setLoading(false)
  }

  function handleSubmit(e) {
    e.preventDefault()
    sendMessage(input)
  }

  return (
    <div className="max-w-2xl mx-auto animate-fade-in">
      <div className="bg-dark-card rounded-[16px] border border-border flex flex-col h-[calc(100vh-12rem)] md:h-[calc(100vh-10rem)]">
        {/* Header */}
        <div className="p-4 border-b border-border">
          <div className="flex items-center gap-2 mb-2">
            <div className="w-8 h-8 rounded-full bg-gold/15 flex items-center justify-center">
              <Bot size={16} className="text-gold" />
            </div>
            <h1 className="text-lg font-bold text-ink">AI Health Assistant</h1>
          </div>
          <div className="flex items-start gap-2 bg-amber-500/10 border border-amber-500/30 rounded-xl p-3">
            <AlertTriangle size={14} className="text-amber-400 mt-0.5 shrink-0" />
            <p className="text-xs text-amber-300">
              This is an AI assistant, not a clinician. For medical advice, dosing changes, or concerns, please message your clinician directly.
            </p>
          </div>
        </div>

        {/* Chat area */}
        <div className="flex-1 overflow-y-auto p-4">
          {messages.length === 0 && historyLoaded && (
            <div className="flex flex-col items-center justify-center h-full text-center">
              <Bot size={40} className="text-stone mb-3" />
              <p className="text-sm text-slate mb-4">
                Ask me about don't weight, our treatments, pricing, health checks, or how things work.
              </p>
              <div className="grid grid-cols-2 gap-2 w-full max-w-sm">
                {quickQuestions.map((q) => (
                  <button
                    key={q}
                    onClick={() => sendMessage(q)}
                    className="px-3 py-2 text-xs font-medium text-gold bg-gold/5 border border-gold/20 rounded-xl hover:bg-gold/10 hover:-translate-y-0.5 hover:shadow-sm transition-all duration-300 text-left"
                  >
                    {q}
                  </button>
                ))}
              </div>
            </div>
          )}

          {messages.map((msg, i) => (
            <div key={i} className={`flex ${msg.role === 'user' ? 'justify-end' : 'justify-start'} mb-3 animate-fade-in`}>
              {msg.role === 'assistant' && (
                <div className="w-6 h-6 rounded-full bg-gold/15 flex items-center justify-center mr-2 mt-1 shrink-0">
                  <Bot size={12} className="text-gold" />
                </div>
              )}
              <div className={`max-w-[80%] px-4 py-2.5 rounded-2xl shadow-sm ${
                msg.role === 'user'
                  ? 'bg-gold text-dark rounded-br-md'
                  : 'bg-warm text-ink rounded-bl-md border border-border/50'
              }`}>
                <p className="text-sm leading-relaxed whitespace-pre-wrap">{msg.content}</p>
              </div>
            </div>
          ))}

          {loading && (
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

        {/* Input */}
        <form onSubmit={handleSubmit} className="p-4 border-t border-border flex gap-2">
          <input
            type="text"
            value={input}
            onChange={(e) => setInput(e.target.value)}
            placeholder="Ask me anything about your health journey..."
            disabled={loading}
            className="flex-1 px-4 py-2.5 bg-dark border border-border rounded-full text-sm text-ink focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold/20 disabled:opacity-50"
          />
          <button
            type="submit"
            disabled={loading || !input.trim()}
            className="bg-gold text-dark p-2.5 rounded-full hover:bg-gold-light transition-all duration-200 active:scale-95 disabled:opacity-40"
            aria-label="Send message"
          >
            <Send size={16} />
          </button>
        </form>
      </div>
    </div>
  )
}
