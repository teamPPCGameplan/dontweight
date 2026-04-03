import { Shield, CheckCircle2, Clock } from 'lucide-react'
import { useIdentityVerification } from '../hooks/useIdentityVerification'

export default function IdVerificationBanner() {
  const { isVerified, isPending } = useIdentityVerification()

  if (isVerified) {
    return (
      <div className="bg-emerald-500/10 border border-emerald-500/20 rounded-[16px] p-5 flex items-center gap-3">
        <div className="w-9 h-9 rounded-xl bg-emerald-500/15 flex items-center justify-center shrink-0">
          <CheckCircle2 size={16} className="text-emerald-400" />
        </div>
        <p className="text-sm font-semibold text-ink">Identity verified</p>
      </div>
    )
  }

  if (isPending) {
    return (
      <div className="bg-amber-500/10 border border-amber-500/20 rounded-[16px] p-5 flex items-start gap-3">
        <div className="w-9 h-9 rounded-xl bg-amber-500/15 flex items-center justify-center shrink-0">
          <Clock size={16} className="text-amber-400" />
        </div>
        <div>
          <p className="text-sm font-semibold text-ink">Identity verification pending</p>
          <p className="text-xs text-slate mt-0.5">
            Your clinician will verify your identity during your next video consultation.
          </p>
        </div>
      </div>
    )
  }

  // Default: needs verification
  return (
    <div className="bg-gold/5 border border-gold/15 rounded-[16px] p-5">
      <div className="flex items-start gap-3">
        <div className="w-9 h-9 rounded-xl bg-gold/15 flex items-center justify-center shrink-0">
          <Shield size={16} className="text-gold" />
        </div>
        <div>
          <p className="text-sm font-semibold text-ink">Identity verification required</p>
          <p className="text-xs text-slate mt-0.5">
            Your identity will be verified by your clinician during your video consultation. No document upload required.
          </p>
        </div>
      </div>
    </div>
  )
}
