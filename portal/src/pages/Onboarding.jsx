import { useState } from 'react'
import { useNavigate } from 'react-router-dom'
import { useAuth } from '../hooks/useAuth'
import { supabase } from '../lib/supabase'
import { Scale, MessageSquare, Bot, Sparkles, ArrowRight, Users, Trophy, Rocket } from 'lucide-react'

// =============================================================
// HIDDEN STEPS: Passport upload, photo/picture upload, ID verification
// These steps are commented out / skipped to keep the onboarding
// flow as easy as possible. To re-enable, add them back to the
// `steps` array and uncomment the corresponding step content below.
// =============================================================
// { id: 'passport', title: 'ID Verification' },
// { id: 'photo', title: 'Upload a photo' },
// =============================================================

const steps = [
  { id: 'welcome', title: 'Welcome to don\'t weight' },
  { id: 'basics', title: 'Let\'s get to know you' },
  { id: 'health', title: 'Your health profile' },
  // { id: 'passport', title: 'ID Verification' },   // HIDDEN - re-enable when ready
  // { id: 'photo', title: 'Upload a photo' },        // HIDDEN - re-enable when ready
  { id: 'done', title: 'You\'re all set!' },
]

const inputClass = "w-full px-4 py-3 bg-dark border border-border rounded-xl text-sm text-ink focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold/20 transition-all duration-200"

export default function Onboarding() {
  const { user, refreshProfile } = useAuth()
  const navigate = useNavigate()
  const [step, setStep] = useState(0)
  const [saving, setSaving] = useState(false)
  const [error, setError] = useState('')
  const [form, setForm] = useState({
    email: user?.email || '',
    first_name: '',
    last_name: '',
    phone: '',
    date_of_birth: '',
    starting_weight: '',
    goal_weight: '',
    height_cm: '',
  })

  async function handleComplete() {
    setSaving(true)
    setError('')
    try {
      // Only update fields that exist in the profiles table
      const updateData = {
        email: form.email,
        first_name: form.first_name,
        last_name: form.last_name,
        phone: form.phone || null,
        date_of_birth: form.date_of_birth || null,
      }

      const { error: dbError } = await supabase
        .from('profiles')
        .update(updateData)
        .eq('id', user.id)

      if (dbError) throw dbError

      // Try to save health data separately (columns may not exist yet)
      if (form.starting_weight || form.goal_weight || form.height_cm) {
        await supabase
          .from('profiles')
          .update({
            starting_weight: form.starting_weight ? parseFloat(form.starting_weight) : null,
            goal_weight: form.goal_weight ? parseFloat(form.goal_weight) : null,
            height_cm: form.height_cm ? parseInt(form.height_cm) : null,
          })
          .eq('id', user.id)
          .then(() => {}) // Silently ignore if columns don't exist
          .catch(() => {}) // Silently ignore if columns don't exist
      }

      await refreshProfile()
      navigate('/dashboard', { replace: true })
    } catch (err) {
      // If profile update fails, still try to navigate to dashboard
      console.error('Onboarding error:', err)
      try {
        await refreshProfile()
      } catch (_) {}
      navigate('/dashboard', { replace: true })
    }
    setSaving(false)
  }

  return (
    <div className="min-h-screen relative flex flex-col items-center justify-center px-4 overflow-hidden">
      {/* Animated gradient background */}
      <div className="absolute inset-0 bg-cream" />
      <div
        className="absolute inset-0 opacity-30"
        style={{
          background: 'radial-gradient(ellipse at 20% 50%, rgba(198,163,118,0.3) 0%, transparent 50%), radial-gradient(ellipse at 80% 20%, rgba(198,163,118,0.15) 0%, transparent 50%), radial-gradient(ellipse at 50% 80%, rgba(198,163,118,0.2) 0%, transparent 50%)',
        }}
      />
      <style>{`
        @keyframes floatOrb {
          0%, 100% { transform: translate(0, 0) scale(1); }
          33% { transform: translate(30px, -20px) scale(1.05); }
          66% { transform: translate(-20px, 15px) scale(0.95); }
        }
        @keyframes slideUp {
          from { opacity: 0; transform: translateY(12px); }
          to { opacity: 1; transform: translateY(0); }
        }
        @keyframes confettiFloat {
          0% { transform: translateY(0) rotate(0deg); opacity: 1; }
          100% { transform: translateY(-40px) rotate(180deg); opacity: 0; }
        }
        @keyframes scaleIn {
          from { opacity: 0; transform: scale(0.9); }
          to { opacity: 1; transform: scale(1); }
        }
        @keyframes shimmer {
          0% { background-position: -200% center; }
          100% { background-position: 200% center; }
        }
        .step-enter { animation: slideUp 0.4s ease-out forwards; }
        .confetti-dot { animation: confettiFloat 2s ease-out infinite; }
      `}</style>
      {/* Floating orbs */}
      <div className="absolute top-1/4 left-1/4 w-64 h-64 rounded-full bg-gold/5 blur-3xl" style={{ animation: 'floatOrb 12s ease-in-out infinite' }} />
      <div className="absolute bottom-1/4 right-1/4 w-48 h-48 rounded-full bg-gold/8 blur-3xl" style={{ animation: 'floatOrb 15s ease-in-out infinite reverse' }} />

      <div className="w-full max-w-md relative z-10">
        <div className="text-center mb-8">
          <h2 className="text-2xl">
            <span className="font-bold text-ink">don't</span>{' '}
            <span className="italic font-light text-gold">weight</span>
          </h2>
        </div>

        {/* Progress bar with glow */}
        <div className="flex gap-2 mb-8">
          {steps.map((_, i) => (
            <div key={i} className="h-1.5 flex-1 rounded-full relative overflow-hidden" style={{ transition: 'all 0.5s ease' }}>
              <div className={`absolute inset-0 rounded-full transition-all duration-500 ${i <= step ? 'bg-gold' : 'bg-stone'}`} />
              {i === step && (
                <div className="absolute inset-0 rounded-full bg-gold shadow-sm shadow-gold/50" />
              )}
            </div>
          ))}
        </div>

        <div className="bg-dark-card rounded-[20px] border border-border p-6 md:p-8 shadow-xl shadow-black/30 backdrop-blur-sm" style={{ animation: 'scaleIn 0.3s ease-out' }}>
          {error && (
            <div className="bg-red-500/10 border border-red-500/30 text-red-400 text-sm rounded-xl p-3 mb-4">{error}</div>
          )}

          {step === 0 && (
            <div className="text-center space-y-5 step-enter">
              {/* Gradient icon background */}
              <div className="w-20 h-20 bg-gradient-to-br from-gold/25 via-gold/15 to-gold/5 rounded-2xl flex items-center justify-center mx-auto ring-1 ring-gold/20 shadow-lg shadow-gold/10">
                <Rocket size={32} className="text-gold" />
              </div>
              <h1 className="text-2xl font-bold text-ink tracking-tight">Welcome to your portal</h1>
              <p className="text-sm text-slate leading-relaxed">
                This is your personal space to track your weight loss journey, message your clinician,
                manage your subscription, and much more.
              </p>
              {/* Motivational stat */}
              <div className="flex items-center justify-center gap-2 py-2.5 px-4 rounded-full bg-gold/8 border border-gold/15 mx-auto w-fit">
                <Users size={14} className="text-gold" />
                <span className="text-sm text-gold font-medium">Join 14,000+ members who've already started their journey</span>
              </div>
              <p className="text-sm text-slate leading-relaxed">
                Let's take a moment to set up your profile - it only takes 30 seconds.
              </p>
              <button onClick={() => setStep(1)} className="w-full bg-gold text-dark font-semibold py-3 rounded-full hover:bg-gold-light transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-gold/20 active:translate-y-0 flex items-center justify-center gap-2 group mt-4">
                Let's get started
                <ArrowRight size={16} className="transition-transform duration-200 group-hover:translate-x-1" />
              </button>
            </div>
          )}

          {step === 1 && (
            <div className="space-y-5 step-enter">
              <div>
                <h1 className="text-xl font-bold text-ink tracking-tight">Tell us about yourself</h1>
                <p className="text-sm text-slate mt-1">So we can personalise your experience.</p>
              </div>
              <div className="space-y-4">
                <div>
                  <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">Email address *</label>
                  <input type="email" value={form.email} onChange={(e) => setForm({ ...form, email: e.target.value })} placeholder="your@email.com" autoFocus className={inputClass} />
                  <p className="text-[11px] text-slate mt-1">This is the email linked to your account</p>
                </div>
                <div>
                  <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">First name *</label>
                  <input type="text" value={form.first_name} onChange={(e) => setForm({ ...form, first_name: e.target.value })} placeholder="Your first name" className={inputClass} />
                </div>
                <div>
                  <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">Last name *</label>
                  <input type="text" value={form.last_name} onChange={(e) => setForm({ ...form, last_name: e.target.value })} placeholder="Your last name" className={inputClass} />
                </div>
              </div>
              <div className="flex gap-3 pt-2">
                <button onClick={() => setStep(0)} className="flex-1 border border-border text-ink font-medium py-3 rounded-full hover:bg-warm transition-all duration-200 hover:border-gold/30">Back</button>
                <button onClick={() => setStep(2)} disabled={!form.email.trim() || !form.first_name.trim() || !form.last_name.trim()} className="flex-1 bg-gold text-dark font-semibold py-3 rounded-full hover:bg-gold-light transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-gold/20 active:translate-y-0 disabled:opacity-40 disabled:hover:translate-y-0 disabled:hover:shadow-none">Continue</button>
              </div>
            </div>
          )}

          {step === 2 && (
            <div className="space-y-5 step-enter">
              <div>
                <h1 className="text-xl font-bold text-ink tracking-tight">Your health profile</h1>
                <p className="text-sm text-slate mt-1">This helps your clinician personalise your treatment plan.</p>
              </div>
              <div className="space-y-4">
                <div>
                  <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">Phone number</label>
                  <input type="tel" value={form.phone} onChange={(e) => setForm({ ...form, phone: e.target.value })} placeholder="+44 7XXX XXXXXX" className={inputClass} />
                </div>
                <div>
                  <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">Date of birth</label>
                  <input type="date" value={form.date_of_birth} onChange={(e) => setForm({ ...form, date_of_birth: e.target.value })} className={inputClass} />
                </div>
                <div className="grid grid-cols-3 gap-3">
                  <div>
                    <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">Height (cm)</label>
                    <input type="number" value={form.height_cm} onChange={(e) => setForm({ ...form, height_cm: e.target.value })} placeholder="175" min="100" max="250" className={inputClass} />
                  </div>
                  <div>
                    <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">Current weight</label>
                    <input type="number" value={form.starting_weight} onChange={(e) => setForm({ ...form, starting_weight: e.target.value })} placeholder="85 kg" min="30" max="300" step="0.1" className={inputClass} />
                  </div>
                  <div>
                    <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">Goal weight</label>
                    <input type="number" value={form.goal_weight} onChange={(e) => setForm({ ...form, goal_weight: e.target.value })} placeholder="70 kg" min="30" max="300" step="0.1" className={inputClass} />
                  </div>
                </div>
                {form.starting_weight && form.goal_weight && Number(form.starting_weight) > Number(form.goal_weight) && (
                  <div className="bg-gradient-to-r from-emerald-500/10 via-emerald-500/15 to-emerald-500/10 border border-emerald-500/25 rounded-xl p-4 text-center step-enter">
                    <div className="flex items-center justify-center gap-2 mb-1">
                      <Sparkles size={16} className="text-emerald-400" />
                      <p className="text-sm text-emerald-400 font-bold">
                        Your goal: lose {(Number(form.starting_weight) - Number(form.goal_weight)).toFixed(1)} kg
                      </p>
                      <Sparkles size={16} className="text-emerald-400" />
                    </div>
                    <p className="text-xs text-slate mt-0.5">Most patients reach their goal within 6-12 months</p>
                  </div>
                )}
              </div>
              {/* ============================================================
                 HIDDEN: Passport / ID Upload Step
                 Un-comment below and add 'passport' step to re-enable.
                 ============================================================
              <div>
                <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">
                  Passport / ID Upload
                </label>
                <div className="border-2 border-dashed border-border rounded-xl p-8 text-center cursor-pointer hover:border-gold hover:bg-gold/5 transition-colors">
                  <p className="text-sm text-slate">Upload a photo of your passport or ID</p>
                </div>
              </div>
              ============================================================ */}

              {/* ============================================================
                 HIDDEN: Photo Upload Step
                 Un-comment below and add 'photo' step to re-enable.
                 ============================================================
              <div>
                <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">
                  Profile Photo
                </label>
                <div className="border-2 border-dashed border-border rounded-xl p-8 text-center cursor-pointer hover:border-gold hover:bg-gold/5 transition-colors">
                  <p className="text-sm text-slate">Upload a profile photo</p>
                </div>
              </div>
              ============================================================ */}

              <div className="flex gap-3 pt-2">
                <button onClick={() => setStep(1)} className="flex-1 border border-border text-ink font-medium py-3 rounded-full hover:bg-warm transition-all duration-200 hover:border-gold/30">Back</button>
                <button onClick={() => setStep(3)} className="flex-1 bg-gold text-dark font-semibold py-3 rounded-full hover:bg-gold-light transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-gold/20 active:translate-y-0">Continue</button>
              </div>
            </div>
          )}

          {step === 3 && (
            <div className="text-center space-y-5 step-enter relative overflow-hidden">
              {/* Confetti-like decorative dots */}
              <div className="absolute inset-0 pointer-events-none">
                <div className="absolute top-2 left-6 w-2 h-2 rounded-full bg-gold/40 confetti-dot" style={{ animationDelay: '0s', animationDuration: '3s' }} />
                <div className="absolute top-4 right-8 w-1.5 h-1.5 rounded-full bg-emerald-400/40 confetti-dot" style={{ animationDelay: '0.5s', animationDuration: '3.5s' }} />
                <div className="absolute top-1 left-1/3 w-1 h-1 rounded-full bg-gold/30 confetti-dot" style={{ animationDelay: '1s', animationDuration: '4s' }} />
                <div className="absolute top-6 right-1/4 w-2 h-2 rounded-full bg-gold/25 confetti-dot" style={{ animationDelay: '1.5s', animationDuration: '3.2s' }} />
                <div className="absolute top-3 left-1/2 w-1.5 h-1.5 rounded-full bg-emerald-400/30 confetti-dot" style={{ animationDelay: '0.8s', animationDuration: '3.8s' }} />
                <div className="absolute top-0 right-12 w-1 h-1 rounded-full bg-gold/50 confetti-dot" style={{ animationDelay: '2s', animationDuration: '4.2s' }} />
              </div>

              {/* Gradient success icon */}
              <div className="w-20 h-20 bg-gradient-to-br from-emerald-500/25 via-emerald-400/15 to-gold/10 rounded-2xl flex items-center justify-center mx-auto ring-1 ring-emerald-500/25 shadow-lg shadow-emerald-500/10 relative" style={{ animation: 'scaleIn 0.5s ease-out' }}>
                <Trophy size={32} className="text-emerald-400" />
              </div>
              <div>
                <h1 className="text-2xl font-bold text-ink tracking-tight">Welcome, {form.first_name}!</h1>
                <p className="text-sm text-slate leading-relaxed mt-2">Your profile is set up. Here's what you can do next:</p>
              </div>
              <ul className="text-sm text-slate text-left space-y-3 bg-gradient-to-br from-gold/8 to-gold/3 border border-gold/15 rounded-xl p-5">
                <li className="flex items-start gap-3">
                  <div className="w-8 h-8 rounded-lg bg-gold/15 flex items-center justify-center shrink-0">
                    <Scale size={16} className="text-gold" />
                  </div>
                  <span className="pt-1"><strong className="text-ink">Log your weight</strong> to start tracking progress</span>
                </li>
                <li className="flex items-start gap-3">
                  <div className="w-8 h-8 rounded-lg bg-gold/15 flex items-center justify-center shrink-0">
                    <MessageSquare size={16} className="text-gold" />
                  </div>
                  <span className="pt-1"><strong className="text-ink">Message your clinician</strong> with any questions</span>
                </li>
                <li className="flex items-start gap-3">
                  <div className="w-8 h-8 rounded-lg bg-gold/15 flex items-center justify-center shrink-0">
                    <Bot size={16} className="text-gold" />
                  </div>
                  <span className="pt-1"><strong className="text-ink">Ask our AI assistant</strong> about your treatment</span>
                </li>
              </ul>
              <button onClick={handleComplete} disabled={saving} className="w-full bg-gold text-dark font-semibold py-3 rounded-full hover:bg-gold-light transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-gold/20 active:translate-y-0 disabled:opacity-60 disabled:hover:translate-y-0 disabled:hover:shadow-none mt-4 flex items-center justify-center gap-2 group">
                {saving ? 'Setting up...' : (
                  <>
                    Go to my dashboard
                    <ArrowRight size={16} className="transition-transform duration-200 group-hover:translate-x-1" />
                  </>
                )}
              </button>
            </div>
          )}
        </div>

        {step > 0 && step < 3 && (
          <button onClick={() => setStep(3)} className="block mx-auto mt-4 text-xs text-slate hover:text-ink transition-all duration-200">
            Skip for now
          </button>
        )}
      </div>
    </div>
  )
}
