import { useState } from 'react'
import { Link } from 'react-router-dom'
import { Pause, X, RefreshCw, ArrowRight, Shield, Truck, Package, MapPin, Calendar, CreditCard, Clock, CheckCircle2 } from 'lucide-react'
import { useAuth } from '../hooks/useAuth'
import { supabase } from '../lib/supabase'
import { useSubscription } from '../hooks/useSubscription'
import { useDeliveries } from '../hooks/useDeliveries'
import { getTreatmentInfo, formatPrice } from '../data/treatments'
import StatusBadge from '../components/StatusBadge'
import DeliveryTracker from '../components/DeliveryTracker'
import DoseSelector from '../components/DoseSelector'
import Modal from '../components/Modal'
import { api } from '../lib/api'
import { CardSkeleton } from '../components/LoadingSpinner'

export default function Subscription() {
  const { user, getToken } = useAuth()
  const { subscription, loading, refetch } = useSubscription()
  const { deliveries, latest: latestDelivery, loading: deliveryLoading } = useDeliveries()
  const [showDose, setShowDose] = useState(false)
  const [showPause, setShowPause] = useState(false)
  const [showCancel, setShowCancel] = useState(false)
  const [cancelStep, setCancelStep] = useState(0)
  const [cancelReason, setCancelReason] = useState('')
  const [processing, setProcessing] = useState(false)
  const [actionError, setActionError] = useState('')
  const [doseRequested, setDoseRequested] = useState(false)
  const [wantsDoseConsultation, setWantsDoseConsultation] = useState(false)

  const treatment = subscription ? getTreatmentInfo(subscription.treatment) : null

  async function handleAction(action, data = {}) {
    setProcessing(true)
    setActionError('')
    try {
      const token = await getToken()
      await api.manageSubscription({
        action,
        subscriptionId: subscription.stripe_subscription_id,
        ...data,
      }, token)
      await refetch()
      setProcessing(false)
      return true
    } catch (err) {
      setActionError(err.message || 'Something went wrong. Please try again.')
      setProcessing(false)
      return false
    }
  }

  async function handleDoseChange(dose) {
    setProcessing(true)
    setActionError('')
    try {
      let content = `Dose change request: Patient requests dose change to ${dose.dose} (${dose.id}). Please review and approve.`
      if (wantsDoseConsultation) {
        content += '\nPatient has also requested a video consultation to discuss this dose change.'
      }
      await supabase.from('messages').insert({
        user_id: user.id,
        sender_role: 'client',
        sender_name: 'Patient',
        content,
      })
      setDoseRequested(true)
      setProcessing(false)
    } catch (err) {
      setActionError(err.message || 'Something went wrong. Please try again.')
      setProcessing(false)
    }
  }

  async function handlePause() {
    const success = await handleAction('pause')
    if (success) setShowPause(false)
  }

  async function handleCancel() {
    const success = await handleAction('cancel', { reason: cancelReason })
    if (success) {
      setShowCancel(false)
      setCancelStep(0)
    }
  }

  async function handleResume() {
    await handleAction('resume')
  }

  if (loading) return (
    <div className="max-w-4xl mx-auto space-y-6">
      <CardSkeleton />
      <CardSkeleton />
    </div>
  )

  return (
    <div className="max-w-4xl mx-auto space-y-6 animate-fade-in">
      <h1 className="text-2xl font-bold text-ink tracking-tight">Your Order</h1>

      {actionError && (
        <div role="alert" className="bg-red-500/10 border border-red-500/30 text-red-400 text-sm rounded-xl p-3">
          {actionError}
        </div>
      )}

      {/* Current plan */}
      {subscription ? (
        <div className="bg-dark-card rounded-[16px] border border-border p-6">
          <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
              <h2 className="text-lg font-bold text-ink">{treatment?.treatment} {treatment?.dose}</h2>
              <p className="text-sm text-slate">{formatPrice(subscription.price_monthly)}/month</p>
            </div>
            <StatusBadge status={subscription.status} />
          </div>

          {subscription.current_period_end && (
            <div className="flex flex-wrap gap-6 text-sm text-slate mb-6">
              <div>
                <span className="text-[10px] font-semibold uppercase tracking-wide block mb-0.5">Next payment</span>
                {new Date(subscription.current_period_end).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' })}
              </div>
              <div>
                <span className="text-[10px] font-semibold uppercase tracking-wide block mb-0.5">Amount</span>
                {formatPrice(subscription.price_monthly)}
              </div>
            </div>
          )}

          <div className="flex flex-wrap gap-2">
            {subscription.status === 'active' && (
              <>
                <button onClick={() => setShowDose(true)} className="flex items-center gap-1.5 px-4 py-2 text-sm font-semibold text-gold border border-gold/30 rounded-full hover:bg-gold/10 transition-all duration-300">
                  <RefreshCw size={14} /> Change dose
                </button>
                <button onClick={() => setShowPause(true)} className="flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-amber-400 border border-amber-500/30 rounded-full hover:bg-amber-500/10 transition-all duration-300">
                  <Pause size={14} /> Pause
                </button>
                <button onClick={() => { setShowCancel(true); setCancelStep(0) }} className="flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-red-400 border border-red-500/30 rounded-full hover:bg-red-500/10 transition-all duration-300">
                  <X size={14} /> Cancel
                </button>
              </>
            )}
            {subscription.status === 'cancelling' && (
              <div className="flex items-center gap-3">
                <span className="text-xs text-amber-400 bg-amber-500/10 border border-amber-500/20 px-3 py-1.5 rounded-full">Cancels at end of billing period</span>
                <button onClick={handleResume} disabled={processing} className="flex items-center gap-1.5 bg-emerald-500 text-white px-5 py-2 text-sm font-semibold rounded-full hover:bg-emerald-400 transition-all duration-300 disabled:opacity-60">
                  <RefreshCw size={14} /> Keep my treatment
                </button>
              </div>
            )}
            {(subscription.status === 'paused' || subscription.status === 'cancelled') && (
              <button onClick={handleResume} disabled={processing} className="flex items-center gap-1.5 bg-emerald-500 text-white px-5 py-2 text-sm font-semibold rounded-full hover:bg-emerald-400 transition-all duration-300 disabled:opacity-60">
                <RefreshCw size={14} /> Reactivate treatment
              </button>
            )}
          </div>
        </div>
      ) : (
        <div className="bg-dark-card rounded-[16px] border border-border p-6 md:p-8">
          <div className="text-center mb-6">
            <h2 className="text-xl font-bold text-ink mb-2">Start your weight loss journey</h2>
            <p className="text-sm text-slate max-w-md mx-auto">Clinician-led treatment with GLP-1 medication, monthly delivery, and ongoing support.</p>
          </div>
          <div className="grid sm:grid-cols-2 gap-3 mb-6">
            {[
              'Clinician-prescribed GLP-1 medication',
              'Free tracked delivery every month',
              'Unlimited clinician messaging',
              'Video consultations at no extra cost',
              'AI assistant for quick questions',
              '100% money-back guarantee',
            ].map((item) => (
              <div key={item} className="flex items-center gap-2 text-sm text-ink">
                <div className="w-5 h-5 rounded-full bg-emerald-500/15 flex items-center justify-center shrink-0">
                  <span className="text-emerald-400 text-xs">&#10003;</span>
                </div>
                {item}
              </div>
            ))}
          </div>
          <div className="text-center">
            <Link to="/video-calls" className="inline-flex items-center gap-2 bg-gold text-dark px-6 py-3 text-sm font-semibold rounded-full hover:bg-gold-light transition-all hover:-translate-y-0.5">
              Request a video consultation <ArrowRight size={14} />
            </Link>
            <p className="text-[11px] text-slate mt-3">30-day money-back guarantee</p>
          </div>
        </div>
      )}

      {/* Order details */}
      {subscription && (
        <div className="bg-dark-card rounded-[16px] border border-border p-6">
          <div className="flex items-center justify-between mb-4">
            <h2 className="text-sm font-semibold text-slate uppercase tracking-wide">Order Details</h2>
            <span className="text-[10px] font-semibold uppercase tracking-wide text-slate bg-warm px-2.5 py-1 rounded-full">
              Monthly treatment
            </span>
          </div>
          <div className="space-y-4">
            <div className="flex items-start gap-3 bg-warm/50 rounded-xl p-4">
              <div className="w-10 h-10 rounded-xl bg-gold/10 flex items-center justify-center shrink-0">
                <Package size={18} className="text-gold" />
              </div>
              <div className="flex-1 min-w-0">
                <p className="text-sm font-semibold text-ink">{treatment?.treatment} {treatment?.dose}</p>
                <p className="text-xs text-slate mt-0.5">GLP-1 weight loss medication · Monthly supply</p>
                <div className="flex flex-wrap gap-x-4 gap-y-1 mt-2">
                  <span className="text-xs text-slate flex items-center gap-1">
                    <CreditCard size={11} /> {formatPrice(subscription.price_monthly)}/month
                  </span>
                  {subscription.created_at && (
                    <span className="text-xs text-slate flex items-center gap-1">
                      <Calendar size={11} /> Patient since {new Date(subscription.created_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })}
                    </span>
                  )}
                  {subscription.current_period_end && (
                    <span className="text-xs text-slate flex items-center gap-1">
                      <Clock size={11} /> Renews {new Date(subscription.current_period_end).toLocaleDateString('en-GB', { day: 'numeric', month: 'short' })}
                    </span>
                  )}
                </div>
              </div>
            </div>

            <div className="grid grid-cols-2 gap-2">
              {[
                { label: 'Free tracked delivery', desc: 'Every month to your door' },
                { label: 'Clinician messaging', desc: 'Unlimited, replies within 2hrs' },
                { label: 'Video consultations', desc: 'At no extra cost' },
                { label: 'AI health assistant', desc: '24/7 instant answers' },
              ].map((item) => (
                <div key={item.label} className="flex items-start gap-2 bg-warm/30 rounded-lg p-2.5">
                  <span className="w-1.5 h-1.5 rounded-full bg-emerald-400 shrink-0 mt-1.5" />
                  <div>
                    <p className="text-xs font-medium text-ink">{item.label}</p>
                    <p className="text-[11px] text-slate">{item.desc}</p>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      )}

      {/* Delivery tracking */}
      {subscription && (
        <div className="bg-dark-card rounded-[16px] border border-border p-6">
          <div className="flex items-center justify-between mb-4">
            <h2 className="text-sm font-semibold text-slate uppercase tracking-wide">Delivery Tracking</h2>
            {latestDelivery?.status === 'in_transit' && (
              <span className="flex items-center gap-1 text-xs text-gold font-medium">
                <Truck size={12} /> In transit
              </span>
            )}
          </div>
          {deliveryLoading ? (
            <CardSkeleton />
          ) : latestDelivery ? (
            <div className="space-y-4">
              <DeliveryTracker delivery={latestDelivery} />
              {latestDelivery.tracking_number && (
                <div className="flex items-center gap-2 bg-warm/30 rounded-lg px-3 py-2">
                  <MapPin size={13} className="text-gold shrink-0" />
                  <span className="text-xs text-slate">Tracking:</span>
                  <span className="text-xs text-ink font-medium truncate">{latestDelivery.tracking_number}</span>
                </div>
              )}
              {deliveries.length > 1 && (
                <div className="border-t border-border pt-4">
                  <h3 className="text-xs font-semibold text-slate uppercase tracking-wide mb-3">
                    Previous Deliveries ({deliveries.length - 1})
                  </h3>
                  <div className="space-y-2">
                    {deliveries.slice(1, 6).map((d) => (
                      <div key={d.id} className="flex items-center justify-between bg-warm/30 rounded-lg px-3 py-2.5">
                        <div className="flex items-center gap-2">
                          <Package size={13} className="text-slate" />
                          <span className="text-xs text-ink">
                            {new Date(d.created_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })}
                          </span>
                        </div>
                        <span className={`text-[10px] font-semibold uppercase tracking-wide px-2 py-0.5 rounded-full ${
                          d.status === 'delivered' ? 'bg-emerald-500/15 text-emerald-400' :
                          d.status === 'in_transit' ? 'bg-gold/10 text-gold' :
                          d.status === 'failed' ? 'bg-red-500/15 text-red-400' :
                          'bg-slate/10 text-slate'
                        }`}>
                          {d.status?.replace(/_/g, ' ') || 'Processing'}
                        </span>
                      </div>
                    ))}
                    {deliveries.length > 6 && (
                      <p className="text-[11px] text-slate text-center pt-1">
                        + {deliveries.length - 6} earlier {deliveries.length - 6 === 1 ? 'delivery' : 'deliveries'}
                      </p>
                    )}
                  </div>
                </div>
              )}
            </div>
          ) : (
            <div className="text-center py-8">
              <div className="w-12 h-12 rounded-full bg-warm flex items-center justify-center mx-auto mb-3">
                <Truck size={22} className="text-slate" />
              </div>
              <p className="text-sm font-medium text-ink">No deliveries yet</p>
              <p className="text-xs text-slate mt-1 max-w-xs mx-auto">Your first delivery will arrive within 2-3 working days after your prescription is approved.</p>
            </div>
          )}
        </div>
      )}

      {/* Health check add-ons */}
      <div className="bg-dark-card rounded-[16px] border border-border p-6">
        <h2 className="text-sm font-semibold text-slate uppercase tracking-wide mb-4">Health Check Add-ons</h2>
        <p className="text-sm text-slate mb-4">Monitor your health with comprehensive blood tests, reviewed by our clinicians.</p>
        <Link to="/health-checks" className="inline-flex items-center gap-2 text-sm text-gold font-semibold hover:underline">
          View packages <ArrowRight size={14} />
        </Link>
      </div>

      {/* Guarantee and delivery info */}
      <div className="grid sm:grid-cols-2 gap-4">
        <div className="bg-dark-card rounded-[16px] border border-border p-5 flex items-start gap-3">
          <div className="w-9 h-9 rounded-xl bg-emerald-500/10 flex items-center justify-center shrink-0">
            <Shield size={16} className="text-emerald-400" />
          </div>
          <div>
            <p className="text-sm font-semibold text-ink">100% money-back guarantee</p>
            <p className="text-xs text-slate mt-0.5">Not happy within 14 days of your first delivery? Full refund, no questions asked.</p>
          </div>
        </div>
        <div className="bg-dark-card rounded-[16px] border border-border p-5 flex items-start gap-3">
          <div className="w-9 h-9 rounded-xl bg-gold/10 flex items-center justify-center shrink-0">
            <Truck size={16} className="text-gold" />
          </div>
          <div>
            <p className="text-sm font-semibold text-ink">Free next-day delivery</p>
            <p className="text-xs text-slate mt-0.5">All treatments delivered via Royal Mail tracked, directly to your door.</p>
          </div>
        </div>
      </div>

      {/* Change dose modal */}
      <Modal open={showDose} onClose={() => { setShowDose(false); setDoseRequested(false); setWantsDoseConsultation(false) }} title="Request dose change" wide>
        {doseRequested ? (
          <div className="text-center py-4">
            <div className="w-14 h-14 rounded-2xl bg-emerald-500/10 flex items-center justify-center mx-auto mb-3">
              <CheckCircle2 size={28} className="text-emerald-400" />
            </div>
            <p className="text-sm font-semibold text-ink mb-2">Dose change request sent</p>
            <p className="text-xs text-slate max-w-sm mx-auto">Your dose change request has been sent to your clinician for approval. They will review it during your next consultation.</p>
          </div>
        ) : (
          <>
            <p className="text-sm text-slate mb-2">Select your preferred dose below. Your clinician will review and approve the change.</p>
            <p className="text-xs text-amber-400 bg-amber-500/10 border border-amber-500/20 rounded-xl px-3 py-2 mb-4">Note: First orders must be a starter dose. Higher doses require clinician approval after a video consultation.</p>
            <label className="flex items-center gap-3 cursor-pointer bg-warm/30 rounded-xl px-4 py-3 mb-4">
              <input
                type="checkbox"
                checked={wantsDoseConsultation}
                onChange={(e) => setWantsDoseConsultation(e.target.checked)}
                className="w-4 h-4 rounded border-border text-gold focus:ring-gold accent-gold cursor-pointer"
              />
              <div>
                <p className="text-sm font-medium text-ink">I'd also like a video consultation to discuss this</p>
                <p className="text-xs text-slate mt-0.5">Recommended for dose increases</p>
              </div>
            </label>
            <DoseSelector currentDoseId={subscription?.treatment} onSelect={handleDoseChange} />
            {processing && <p className="text-sm text-gold mt-4 text-center animate-pulse-gold">Sending request...</p>}
          </>
        )}
      </Modal>

      {/* Pause modal */}
      <Modal open={showPause} onClose={() => setShowPause(false)} title="Pause your treatment">
        <p className="text-sm text-slate mb-4">
          Your treatment will be paused at the end of your current billing period. You won't be charged until you resume. Your portal access will remain active.
        </p>
        <div className="flex gap-2">
          <button onClick={handlePause} disabled={processing} className="flex-1 bg-amber-500 text-dark font-semibold py-2.5 rounded-full hover:bg-amber-400 transition-colors disabled:opacity-60">
            {processing ? 'Pausing...' : 'Confirm pause'}
          </button>
          <button onClick={() => setShowPause(false)} className="flex-1 border border-border text-ink font-medium py-2.5 rounded-full hover:bg-warm transition-colors">
            Keep my treatment
          </button>
        </div>
      </Modal>

      {/* Cancel modal */}
      <Modal open={showCancel} onClose={() => { setShowCancel(false); setCancelStep(0) }} title="Cancel treatment">
        {cancelStep === 0 && (
          <>
            <p className="text-sm text-slate mb-4">We're sorry to see you go. Can you tell us why you're cancelling?</p>
            <div className="space-y-2 mb-4">
              {['Too expensive', 'Side effects', 'Not seeing results', 'Switching to another provider', 'No longer need medication', 'Other'].map((reason) => (
                <button
                  key={reason}
                  onClick={() => { setCancelReason(reason); setCancelStep(1) }}
                  className={`w-full text-left px-4 py-2.5 rounded-xl border text-sm transition-colors ${
                    cancelReason === reason ? 'border-gold bg-gold/10' : 'border-border hover:bg-warm'
                  }`}
                >
                  {reason}
                </button>
              ))}
            </div>
          </>
        )}
        {cancelStep === 1 && (
          <>
            <p className="text-sm text-slate mb-2">Are you sure you want to cancel?</p>
            <p className="text-sm text-slate mb-4">You'll lose access to your medication and portal features at the end of your current billing period.</p>
            <div className="flex gap-2">
              <button onClick={handleCancel} disabled={processing} className="flex-1 bg-red-500 text-white font-semibold py-2.5 rounded-full hover:bg-red-400 transition-colors disabled:opacity-60">
                {processing ? 'Cancelling...' : 'Yes, cancel'}
              </button>
              <button onClick={() => { setShowCancel(false); setCancelStep(0) }} className="flex-1 border border-border text-ink font-medium py-2.5 rounded-full hover:bg-warm transition-colors">
                Keep my treatment
              </button>
            </div>
          </>
        )}
      </Modal>
    </div>
  )
}
