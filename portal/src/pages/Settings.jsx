import { useState } from 'react'
import { Save, Check, Trash2, Loader2 } from 'lucide-react'
import { useAuth } from '../hooks/useAuth'
import { useProfile } from '../hooks/useProfile'
import Modal from '../components/Modal'

export default function Settings() {
  const { profile, signOut } = useAuth()
  const { updateProfile, updateEmail, updatePassword, saving } = useProfile()

  const [form, setForm] = useState({
    first_name: profile?.first_name || '',
    last_name: profile?.last_name || '',
    phone: profile?.phone || '',
    date_of_birth: profile?.date_of_birth || '',
    height_cm: profile?.height_cm || '',
  })
  const [newEmail, setNewEmail] = useState('')
  const [newPassword, setNewPassword] = useState('')
  const [confirmPassword, setConfirmPassword] = useState('')
  const [saved, setSaved] = useState(false)
  const [error, setError] = useState('')
  const [showDelete, setShowDelete] = useState(false)

  async function handleSaveProfile(e) {
    e.preventDefault()
    setError('')
    try {
      await updateProfile(form)
      setSaved(true)
      setTimeout(() => setSaved(false), 2000)
    } catch (err) {
      setError(err.message)
    }
  }

  async function handleChangeEmail(e) {
    e.preventDefault()
    setError('')
    try {
      await updateEmail(newEmail)
      setNewEmail('')
      setSaved(true)
      setTimeout(() => setSaved(false), 2000)
    } catch (err) {
      setError(err.message)
    }
  }

  async function handleChangePassword(e) {
    e.preventDefault()
    setError('')
    if (newPassword !== confirmPassword) {
      setError('Passwords do not match')
      return
    }
    if (newPassword.length < 8) {
      setError('Password must be at least 8 characters')
      return
    }
    try {
      await updatePassword(newPassword)
      setNewPassword('')
      setConfirmPassword('')
      setSaved(true)
      setTimeout(() => setSaved(false), 2000)
    } catch (err) {
      setError(err.message)
    }
  }

  const inputClass = "w-full px-4 py-2.5 bg-dark border border-border rounded-xl text-sm text-ink focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold/20"

  return (
    <div className="max-w-2xl mx-auto space-y-6 animate-fade-in">
      <h1 className="text-2xl font-bold text-ink tracking-tight">Settings</h1>

      {error && (
        <div className="bg-red-500/10 border border-red-500/30 text-red-400 text-sm rounded-xl p-3">{error}</div>
      )}

      {saved && (
        <div className="bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 text-sm rounded-xl p-3 flex items-center gap-2">
          <Check size={14} /> Changes saved successfully
        </div>
      )}

      {/* Profile */}
      <div className="bg-dark-card rounded-[16px] border border-border p-6">
        <h2 className="text-sm font-semibold text-slate uppercase tracking-wide mb-4">Profile Information</h2>
        <form onSubmit={handleSaveProfile} className="space-y-4">
          <div className="grid sm:grid-cols-2 gap-4">
            <div>
              <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">First name</label>
              <input type="text" value={form.first_name} onChange={(e) => setForm({ ...form, first_name: e.target.value })} className={inputClass} />
            </div>
            <div>
              <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">Last name</label>
              <input type="text" value={form.last_name} onChange={(e) => setForm({ ...form, last_name: e.target.value })} className={inputClass} />
            </div>
          </div>
          <div>
            <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">Phone</label>
            <input type="tel" value={form.phone} onChange={(e) => setForm({ ...form, phone: e.target.value })} placeholder="+44 7XXX XXXXXX" className={inputClass} />
          </div>
          <div>
            <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">Date of birth</label>
            <input type="date" value={form.date_of_birth} onChange={(e) => setForm({ ...form, date_of_birth: e.target.value })} className={inputClass} />
          </div>
          <div>
            <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">Height (cm)</label>
            <input type="number" value={form.height_cm} onChange={(e) => setForm({ ...form, height_cm: e.target.value })} placeholder="e.g. 175" min="100" max="250" className={inputClass} />
            <p className="text-[11px] text-slate mt-1">Used to calculate your BMI on the weight tracker</p>
          </div>
          <button type="submit" disabled={saving} className="flex items-center gap-1.5 bg-gold text-dark px-5 py-2.5 text-sm font-semibold rounded-full hover:bg-gold-light transition-colors disabled:opacity-60">
            {saving ? <Loader2 size={14} className="animate-spin" /> : <Save size={14} />}
            {saving ? 'Saving...' : 'Save changes'}
          </button>
        </form>
      </div>

      {/* Change email */}
      <div className="bg-dark-card rounded-[16px] border border-border p-6">
        <h2 className="text-sm font-semibold text-slate uppercase tracking-wide mb-4">Change Email</h2>
        <form onSubmit={handleChangeEmail} className="space-y-4">
          <div>
            <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">New email address</label>
            <input type="email" value={newEmail} onChange={(e) => setNewEmail(e.target.value)} required placeholder="new@example.com" className={inputClass} />
          </div>
          <button type="submit" disabled={saving} className="bg-gold text-dark px-5 py-2.5 text-sm font-semibold rounded-full hover:bg-gold-light transition-colors disabled:opacity-60">
            Update email
          </button>
        </form>
      </div>

      {/* Change password */}
      <div className="bg-dark-card rounded-[16px] border border-border p-6">
        <h2 className="text-sm font-semibold text-slate uppercase tracking-wide mb-4">Change Password</h2>
        <form onSubmit={handleChangePassword} className="space-y-4">
          <div>
            <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">New password</label>
            <input type="password" value={newPassword} onChange={(e) => setNewPassword(e.target.value)} required minLength={8} autoComplete="new-password" className={inputClass} />
          </div>
          <div>
            <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">Confirm password</label>
            <input type="password" value={confirmPassword} onChange={(e) => setConfirmPassword(e.target.value)} required autoComplete="new-password" className={inputClass} />
          </div>
          <button type="submit" disabled={saving} className="bg-gold text-dark px-5 py-2.5 text-sm font-semibold rounded-full hover:bg-gold-light transition-colors disabled:opacity-60">
            Update password
          </button>
        </form>
      </div>

      {/* Danger zone */}
      <div className="bg-dark-card rounded-[16px] border border-red-500/30 p-6">
        <h2 className="text-sm font-semibold text-red-400 uppercase tracking-wide mb-2">Danger Zone</h2>
        <p className="text-sm text-slate mb-4">If you wish to delete your account and all associated data, please contact our support team.</p>
        <button onClick={() => setShowDelete(true)} className="flex items-center gap-1.5 text-sm font-medium text-red-400 border border-red-500/30 px-4 py-2 rounded-full hover:bg-red-500/10 transition-colors">
          <Trash2 size={14} /> Delete my account
        </button>
      </div>

      <Modal open={showDelete} onClose={() => setShowDelete(false)} title="Delete account">
        <p className="text-sm text-slate mb-4">
          To delete your account and all associated data, please contact{' '}
          <a href="mailto:support@dontweight.co.uk" className="text-gold underline">support@dontweight.co.uk</a>.
        </p>
        <p className="text-sm text-slate mb-4">
          Our team will process your request and confirm once all your data has been permanently removed.
        </p>
        <div className="flex gap-2">
          <a href="mailto:support@dontweight.co.uk" className="flex-1 bg-gold text-dark font-semibold py-2.5 rounded-full hover:bg-gold-light transition-colors text-center">
            Email support
          </a>
          <button onClick={() => setShowDelete(false)} className="flex-1 border border-border text-ink font-medium py-2.5 rounded-full hover:bg-warm transition-colors">
            Cancel
          </button>
        </div>
      </Modal>
    </div>
  )
}
