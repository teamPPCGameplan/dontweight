import { useState } from 'react'
import { useNavigate, useLocation } from 'react-router-dom'
import { Mail, Lock, ArrowRight, Loader2, Eye, EyeOff, Star, Shield, Users } from 'lucide-react'
import { useAuth } from '../hooks/useAuth'

export default function Login() {
  const { signIn, signInWithMagicLink, resetPassword } = useAuth()
  const navigate = useNavigate()
  const location = useLocation()
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [mode, setMode] = useState('password')
  const [showPassword, setShowPassword] = useState(false)
  const [loading, setLoading] = useState(false)
  const [error, setError] = useState('')
  const [magicSent, setMagicSent] = useState(false)
  const [resetSent, setResetSent] = useState(false)

  const from = location.state?.from?.pathname || '/dashboard'

  async function handleSubmit(e) {
    e.preventDefault()
    setError('')

    if (!email.trim()) { setError('Please enter your email address.'); return }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { setError('Please enter a valid email address.'); return }
    if (mode === 'password' && !password) { setError('Please enter your password.'); return }

    setLoading(true)

    try {
      if (mode === 'reset') {
        await resetPassword(email)
        setResetSent(true)
      } else if (mode === 'magic') {
        await signInWithMagicLink(email)
        setMagicSent(true)
      } else {
        await signIn(email, password)
        navigate(from, { replace: true })
      }
    } catch (err) {
      const msg = err.message || ''
      if (msg.includes('sending magic link') || msg.includes('sending confirmation') || msg.includes('Error sending magic link email')) {
        setError('We couldn\'t send the login link. This email may not be registered, or there\'s a temporary issue. Please try signing in with a password instead, or start a consultation to create an account.')
      } else if (msg.includes('sending recovery') || msg.includes('Error sending recovery') || msg.includes('reset password')) {
        setError('We couldn\'t send the reset link. This email may not be registered, or there\'s a temporary issue. Please try again later or start a consultation to create an account.')
      } else if (mode === 'reset' && (msg.includes('not found') || msg.includes('user not found'))) {
        setError('No account found with this email. Please check the address or start a consultation to sign up.')
      } else if (mode === 'magic' && (msg.includes('not found') || msg.includes('user not found'))) {
        setError('No account found with this email. Please check the address or start a consultation to sign up.')
      } else if (msg.includes('Invalid login credentials')) {
        setError('Incorrect email or password. Please try again or use the forgot password option.')
      } else if (msg.includes('rate limit') || msg.includes('too many requests') || msg.includes('429')) {
        setError('Too many attempts. Please wait a few minutes before trying again.')
      } else {
        setError(msg || 'Something went wrong. Please try again.')
      }
    } finally {
      setLoading(false)
    }
  }

  return (
    <div className="min-h-screen relative flex items-center justify-center p-4 overflow-hidden">
      {/* Animated gradient background */}
      <div className="absolute inset-0 bg-cream" />
      <div
        className="absolute inset-0 opacity-30"
        style={{
          background: 'radial-gradient(ellipse at 20% 50%, rgba(198,163,118,0.3) 0%, transparent 50%), radial-gradient(ellipse at 80% 20%, rgba(198,163,118,0.15) 0%, transparent 50%), radial-gradient(ellipse at 50% 80%, rgba(198,163,118,0.2) 0%, transparent 50%)',
          animation: 'pulse 8s ease-in-out infinite alternate',
        }}
      />
      <style>{`
        @keyframes gradientShift {
          0% { background-position: 0% 50%; }
          50% { background-position: 100% 50%; }
          100% { background-position: 0% 50%; }
        }
        @keyframes floatOrb {
          0%, 100% { transform: translate(0, 0) scale(1); }
          33% { transform: translate(30px, -20px) scale(1.05); }
          66% { transform: translate(-20px, 15px) scale(0.95); }
        }
      `}</style>
      {/* Floating orbs for depth */}
      <div className="absolute top-1/4 left-1/4 w-64 h-64 rounded-full bg-gold/5 blur-3xl" style={{ animation: 'floatOrb 12s ease-in-out infinite' }} />
      <div className="absolute bottom-1/4 right-1/4 w-48 h-48 rounded-full bg-gold/8 blur-3xl" style={{ animation: 'floatOrb 15s ease-in-out infinite reverse' }} />

      <div className="w-full max-w-md relative z-10">
        {/* Logo */}
        <div className="text-center mb-8">
          <a href="https://dontweight.co.uk" className="inline-block group">
            <h1 className="text-3xl tracking-tight mb-2">
              <span className="font-bold text-ink">don't</span>{' '}
              <span className="italic font-light text-gold">weight</span>
            </h1>
          </a>
          <p className="text-sm text-slate">Patient Portal</p>
        </div>

        {/* Card */}
        <div className="bg-dark-card rounded-[20px] border border-border p-8 shadow-xl shadow-black/30 backdrop-blur-sm">
          {magicSent || resetSent ? (
            <div className="text-center py-4 animate-fade-in">
              <div className="w-14 h-14 bg-gradient-to-br from-gold/20 to-gold/5 rounded-full flex items-center justify-center mx-auto mb-4 ring-1 ring-gold/20">
                <Mail size={24} className="text-gold" />
              </div>
              <h2 className="text-lg font-bold text-ink mb-2">Check your email</h2>
              <p className="text-sm text-slate mb-4">
                {resetSent ? (
                  <>We've sent a password reset link to<br /><strong className="text-ink">{email}</strong>.<br />Click the link to set a new password.</>
                ) : (
                  <>We've sent a login link to<br /><strong className="text-ink">{email}</strong>.<br />Click the link to sign in.</>
                )}
              </p>
              <button
                onClick={() => { setMagicSent(false); setResetSent(false); setMode('password') }}
                className="text-sm text-gold hover:underline transition-all duration-200 hover:text-gold-light"
              >
                Back to login
              </button>
            </div>
          ) : (
            <>
              <h2 className="text-lg font-bold text-ink mb-6">Sign in to your account</h2>

              <form onSubmit={handleSubmit} className="space-y-4">
                <div>
                  <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">
                    Email address
                  </label>
                  <div className="relative">
                    <Mail size={16} className="absolute left-3 top-1/2 -translate-y-1/2 text-slate" />
                    <input
                      type="email"
                      value={email}
                      onChange={(e) => { setEmail(e.target.value); setError('') }}
                      placeholder="you@example.com"
                      autoComplete="email"
                      className="w-full pl-10 pr-4 py-2.5 bg-dark-card border border-border rounded-xl text-sm text-ink placeholder:text-slate/50 focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/20 transition-all duration-200"
                    />
                  </div>
                </div>

                {mode === 'password' && (
                  <div className="animate-fade-in">
                    <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">
                      Password
                    </label>
                    <div className="relative">
                      <Lock size={16} className="absolute left-3 top-1/2 -translate-y-1/2 text-slate" />
                      <input
                        type={showPassword ? 'text' : 'password'}
                        value={password}
                        onChange={(e) => { setPassword(e.target.value); setError('') }}
                        placeholder="Enter your password"
                        autoComplete="current-password"
                        className="w-full pl-10 pr-10 py-2.5 bg-dark-card border border-border rounded-xl text-sm text-ink placeholder:text-slate/50 focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/20 transition-all duration-200"
                      />
                      <button
                        type="button"
                        onClick={() => setShowPassword(!showPassword)}
                        className="absolute right-3 top-1/2 -translate-y-1/2 text-slate hover:text-ink transition-all duration-200"
                        aria-label={showPassword ? 'Hide password' : 'Show password'}
                      >
                        {showPassword ? <EyeOff size={16} /> : <Eye size={16} />}
                      </button>
                    </div>
                  </div>
                )}

                <button
                  type="submit"
                  disabled={loading}
                  className="w-full bg-gold text-dark font-semibold py-2.5 rounded-full hover:bg-gold-light transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-gold/20 active:translate-y-0 flex items-center justify-center gap-2 disabled:opacity-60 disabled:hover:translate-y-0 disabled:hover:shadow-none"
                >
                  {loading ? (
                    <Loader2 size={16} className="animate-spin" />
                  ) : (
                    <>
                      {mode === 'reset' ? 'Send reset link' : mode === 'magic' ? 'Send login link' : 'Sign in'}
                      <ArrowRight size={16} />
                    </>
                  )}
                </button>
              </form>

              {error && (
                <div className="bg-red-500/10 border border-red-500/30 text-red-400 text-sm rounded-xl p-3 mt-4 animate-fade-in">
                  {error}
                </div>
              )}

              <div className="mt-4 text-center space-y-2">
                {mode === 'password' && (
                  <button
                    onClick={() => { setMode('reset'); setError('') }}
                    className="text-sm text-gold underline underline-offset-2 cursor-pointer block mx-auto hover:text-gold-light transition-all duration-200"
                  >
                    Forgot password?
                  </button>
                )}
                <button
                  onClick={() => { setMode(mode === 'password' ? 'magic' : 'password'); setError('') }}
                  className="text-sm text-gold hover:underline underline-offset-2 transition-all duration-200 hover:text-gold-light"
                >
                  {mode === 'password' ? 'Email me a login link instead' : 'Sign in with password'}
                </button>
              </div>
            </>
          )}
        </div>

        {/* Trust stats row */}
        <div className="mt-6 flex items-center justify-center gap-3 text-[11px]">
          <div className="flex items-center gap-1.5 text-slate">
            <Users size={12} className="text-gold/70" />
            <span>14,000+ members</span>
          </div>
          <span className="text-border">|</span>
          <div className="flex items-center gap-1.5 text-slate">
            <Star size={12} className="text-gold/70 fill-gold/70" />
            <span>4.8 Google rating</span>
          </div>
          <span className="text-border">|</span>
          <div className="flex items-center gap-1.5 text-slate">
            <Shield size={12} className="text-gold/70" />
            <span>CQC regulated</span>
          </div>
        </div>

        {/* Footer */}
        <div className="text-center mt-4 space-y-3">
          <a
            href="https://dontweight.co.uk/#calculator"
            target="_blank"
            rel="noopener noreferrer"
            className="inline-flex items-center gap-2 bg-gold/10 hover:bg-gold/20 border border-gold/20 hover:border-gold/40 text-gold font-medium text-sm px-5 py-2.5 rounded-full transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-gold/10 group"
          >
            New patient? Start your consultation
            <ArrowRight size={14} className="transition-transform duration-300 group-hover:translate-x-1" />
          </a>
          <div className="flex items-center justify-center gap-4 text-[11px] text-slate">
            <span>UK prescribers</span>
            <span className="text-border">|</span>
            <span>100% money-back guarantee</span>
          </div>
        </div>
      </div>
    </div>
  )
}
