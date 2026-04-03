import { useState } from 'react'
import { Video, Calendar, Clock, Shield, CheckCircle2, MessageSquare } from 'lucide-react'
import { useAuth } from '../hooks/useAuth'
import { supabase } from '../lib/supabase'

export default function VideoCalls() {
  const { user } = useAuth()
  const [requesting, setRequesting] = useState(false)
  const [requested, setRequested] = useState(false)
  const [error, setError] = useState('')
  const [preferredDate, setPreferredDate] = useState('')
  const [preferredTime, setPreferredTime] = useState('')
  const [wantsDoseChange, setWantsDoseChange] = useState(false)

  function getMinDate() {
    const d = new Date()
    d.setDate(d.getDate() + 1)
    return d.toISOString().split('T')[0]
  }

  function isValid() {
    if (!preferredDate || !preferredTime) return false
    const chosen = new Date(`${preferredDate}T${preferredTime}`)
    const cutoff = new Date(Date.now() + 24 * 60 * 60 * 1000)
    return chosen >= cutoff
  }

  async function handleRequestConsultation() {
    if (!isValid()) {
      setError('Please select a date and time at least 24 hours from now.')
      return
    }
    setRequesting(true)
    setError('')
    try {
      const dateStr = new Date(`${preferredDate}T${preferredTime}`).toLocaleString('en-GB', {
        weekday: 'long', day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit',
      })
      let content = `Video consultation request: Patient would like a video consultation.\nPreferred date/time: ${dateStr}`
      if (wantsDoseChange) {
        content += '\nNote: Patient would also like to discuss a dose change during this consultation.'
      }
      await supabase.from('messages').insert({
        user_id: user.id,
        sender_role: 'client',
        sender_name: 'Patient',
        content,
      })
      setRequested(true)
    } catch (err) {
      setError(err.message || 'Something went wrong. Please try again.')
    }
    setRequesting(false)
  }

  return (
    <div className="max-w-4xl mx-auto space-y-6 animate-fade-in">
      {/* Header */}
      <div>
        <h1 className="text-2xl font-bold text-ink tracking-tight">Video Consultations</h1>
        <p className="text-sm text-slate mt-1">Request a video consultation with your clinician</p>
      </div>

      {/* Info cards */}
      <div className="grid sm:grid-cols-4 gap-3">
        {[
          { icon: Calendar, label: 'Flexible scheduling', desc: 'Your clinician will arrange a suitable time' },
          { icon: Clock, label: '15 minute session', desc: 'Focused consultation with your clinician' },
          { icon: Video, label: 'Secure video call', desc: 'Private, encrypted video connection' },
          { icon: Shield, label: 'Included with your treatment', desc: 'Video consultations included with your treatment' },
        ].map((item) => {
          const Icon = item.icon
          return (
            <div key={item.label} className="bg-dark-card rounded-[16px] border border-border p-4 flex items-start gap-3">
              <div className="w-9 h-9 rounded-xl bg-gold/10 flex items-center justify-center shrink-0">
                <Icon size={16} className="text-gold" />
              </div>
              <div>
                <p className="text-sm font-semibold text-ink">{item.label}</p>
                <p className="text-xs text-slate mt-0.5">{item.desc}</p>
              </div>
            </div>
          )
        })}
      </div>

      {/* Request consultation */}
      <div className="bg-dark-card rounded-[16px] border border-border p-6">
        <div className="flex items-center gap-2 mb-4">
          <div className="w-8 h-8 rounded-full bg-gold/15 flex items-center justify-center">
            <Video size={16} className="text-gold" />
          </div>
          <div>
            <h2 className="text-sm font-semibold text-ink">Request a video consultation</h2>
            <p className="text-xs text-slate">Your clinician will confirm or suggest an alternative time</p>
          </div>
        </div>

        {error && (
          <div className="bg-red-500/10 border border-red-500/30 text-red-400 text-sm rounded-xl p-3 mb-4">
            {error}
          </div>
        )}

        {requested ? (
          <div className="text-center py-8">
            <div className="w-14 h-14 rounded-2xl bg-emerald-500/10 flex items-center justify-center mx-auto mb-3">
              <CheckCircle2 size={28} className="text-emerald-400" />
            </div>
            <p className="text-sm font-semibold text-ink mb-2">Request sent -- awaiting clinician approval</p>
            <p className="text-xs text-slate max-w-sm mx-auto">
              Your consultation request has been sent. Your clinician will be in touch shortly to confirm or suggest an alternative time.
            </p>
          </div>
        ) : (
          <div className="space-y-4">
            <div className="grid sm:grid-cols-2 gap-3">
              <div>
                <label className="block text-xs font-semibold text-slate uppercase tracking-wide mb-1.5">Preferred date</label>
                <input
                  type="date"
                  value={preferredDate}
                  onChange={(e) => setPreferredDate(e.target.value)}
                  min={getMinDate()}
                  className="w-full px-3 py-2.5 border border-border rounded-xl text-sm bg-dark text-ink focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/20"
                />
              </div>
              <div>
                <label className="block text-xs font-semibold text-slate uppercase tracking-wide mb-1.5">Preferred time</label>
                <input
                  type="time"
                  value={preferredTime}
                  onChange={(e) => setPreferredTime(e.target.value)}
                  className="w-full px-3 py-2.5 border border-border rounded-xl text-sm bg-dark text-ink focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/20"
                />
              </div>
            </div>

            <label className="flex items-center gap-3 cursor-pointer bg-warm/30 rounded-xl px-4 py-3">
              <input
                type="checkbox"
                checked={wantsDoseChange}
                onChange={(e) => setWantsDoseChange(e.target.checked)}
                className="w-4 h-4 rounded border-border text-gold focus:ring-gold accent-gold cursor-pointer"
              />
              <div>
                <p className="text-sm font-medium text-ink">I'd like to discuss a dose change</p>
                <p className="text-xs text-slate mt-0.5">Tick this if you want to discuss adjusting your medication dose during the consultation</p>
              </div>
            </label>

            <div className="text-center pt-2">
              <button
                onClick={handleRequestConsultation}
                disabled={requesting || !preferredDate || !preferredTime}
                className="inline-flex items-center gap-2 bg-gold text-dark px-6 py-3 text-sm font-semibold rounded-full hover:bg-gold-light transition-all hover:-translate-y-0.5 disabled:opacity-60"
              >
                <Video size={14} /> {requesting ? 'Sending request...' : 'Request consultation'}
              </button>
              <p className="text-[11px] text-slate mt-2">Must be at least 24 hours from now</p>
            </div>
          </div>
        )}
      </div>

      {/* How it works */}
      <div className="bg-dark-card rounded-[16px] border border-border p-5">
        <h3 className="text-sm font-semibold text-ink mb-2">How it works</h3>
        <div className="space-y-3">
          {[
            { step: '1', text: 'Choose your preferred date, time, and whether you want to discuss a dose change' },
            { step: '2', text: 'Your clinician will confirm or suggest an alternative time' },
            { step: '3', text: 'You\'ll receive a link to join the secure video call' },
          ].map((item) => (
            <div key={item.step} className="flex items-start gap-3">
              <div className="w-6 h-6 rounded-full bg-gold/15 flex items-center justify-center shrink-0">
                <span className="text-xs font-bold text-gold">{item.step}</span>
              </div>
              <p className="text-sm text-slate">{item.text}</p>
            </div>
          ))}
        </div>
      </div>
    </div>
  )
}
