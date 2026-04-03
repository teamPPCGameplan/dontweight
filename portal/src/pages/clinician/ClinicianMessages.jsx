import { useState, useEffect } from 'react'
import { Link } from 'react-router-dom'
import { MessageSquare, Send } from 'lucide-react'
import { supabase } from '../../lib/supabase'
import MessageBubble from '../../components/MessageBubble'
import { Skeleton } from '../../components/LoadingSpinner'

export default function ClinicianMessages() {
  const [patients, setPatients] = useState([])
  const [selectedPatient, setSelectedPatient] = useState(null)
  const [messages, setMessages] = useState([])
  const [loading, setLoading] = useState(true)
  const [msgText, setMsgText] = useState('')
  const [sending, setSending] = useState(false)

  useEffect(() => { fetchPatients() }, [])

  async function fetchPatients() {
    setLoading(true)
    // Get patients who have sent messages
    const { data } = await supabase
      .from('profiles')
      .select('*, messages(count)')
      .eq('role', 'client')
      .order('created_at', { ascending: false })
    setPatients(data || [])
    setLoading(false)
  }

  async function selectPatient(patient) {
    setSelectedPatient(patient)
    const { data } = await supabase
      .from('messages')
      .select('*')
      .eq('user_id', patient.id)
      .order('created_at', { ascending: true })
    setMessages(data || [])

    // Mark as read
    await supabase
      .from('messages')
      .update({ is_read: true })
      .eq('user_id', patient.id)
      .eq('sender_role', 'client')
      .eq('is_read', false)
  }

  async function handleSend(e) {
    e.preventDefault()
    if (!msgText.trim() || !selectedPatient) return
    setSending(true)
    await supabase.from('messages').insert({
      user_id: selectedPatient.id,
      sender_role: 'clinician',
      sender_name: 'Your Clinician',
      content: msgText.trim(),
    })
    setMsgText('')
    const { data } = await supabase.from('messages').select('*').eq('user_id', selectedPatient.id).order('created_at', { ascending: true })
    setMessages(data || [])
    setSending(false)
  }

  return (
    <div className="max-w-6xl mx-auto animate-fade-in">
      <h1 className="text-2xl font-bold text-ink tracking-tight mb-6">Patient Messages</h1>

      <div className="bg-dark-card rounded-[16px] border border-border flex h-[calc(100vh-14rem)] overflow-hidden">
        {/* Patient list */}
        <div className="w-72 border-r border-border overflow-y-auto shrink-0 hidden md:block">
          {loading ? (
            <div className="p-4 space-y-3">
              {Array.from({ length: 5 }).map((_, i) => <Skeleton key={i} className="h-14 rounded-xl" />)}
            </div>
          ) : (
            <div className="divide-y divide-border/50">
              {patients.map((p) => (
                <button
                  key={p.id}
                  onClick={() => selectPatient(p)}
                  className={`w-full text-left p-4 hover:bg-warm transition-colors ${
                    selectedPatient?.id === p.id ? 'bg-gold/10' : ''
                  }`}
                >
                  <p className="text-sm font-medium text-ink">{p.first_name} {p.last_name}</p>
                  <p className="text-xs text-slate truncate">{p.email}</p>
                </button>
              ))}
            </div>
          )}
        </div>

        {/* Chat area */}
        <div className="flex-1 flex flex-col">
          {selectedPatient ? (
            <>
              <div className="p-4 border-b border-border flex items-center justify-between">
                <div>
                  <p className="text-sm font-bold text-ink">{selectedPatient.first_name} {selectedPatient.last_name}</p>
                  <Link to={`/clinician/patients/${selectedPatient.id}`} className="text-xs text-gold hover:underline">
                    View patient profile
                  </Link>
                </div>
              </div>

              <div className="flex-1 overflow-y-auto p-4 space-y-1">
                {messages.map((msg) => (
                  <MessageBubble key={msg.id} message={msg} isOwn={msg.sender_role === 'clinician'} />
                ))}
              </div>

              <form onSubmit={handleSend} className="p-4 border-t border-border flex gap-2">
                <input
                  type="text"
                  value={msgText}
                  onChange={(e) => setMsgText(e.target.value)}
                  placeholder="Reply to patient..."
                  className="flex-1 px-4 py-2.5 border border-border rounded-full text-sm focus:outline-none focus:border-gold bg-dark text-ink"
                />
                <button type="submit" disabled={sending} className="bg-gold text-dark p-2.5 rounded-full hover:bg-gold-light disabled:opacity-40">
                  <Send size={16} />
                </button>
              </form>
            </>
          ) : (
            <div className="flex flex-col items-center justify-center h-full text-center">
              <MessageSquare size={40} className="text-stone mb-3" />
              <p className="text-sm text-slate">Select a patient to view their messages</p>
            </div>
          )}
        </div>
      </div>
    </div>
  )
}
