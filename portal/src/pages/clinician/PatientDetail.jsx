import { useState, useEffect } from 'react'
import { useParams, Link } from 'react-router-dom'
import { ArrowLeft, Send, Shield, CheckCircle2, XCircle, Clock, ExternalLink, Plus, ChevronRight, Truck } from 'lucide-react'
import { supabase } from '../../lib/supabase'
import { useAuth } from '../../hooks/useAuth'
import { api } from '../../lib/api'
import { getTreatmentInfo, formatPrice } from '../../data/treatments'
import WeightChart from '../../components/WeightChart'
import StatusBadge from '../../components/StatusBadge'
import DeliveryTracker from '../../components/DeliveryTracker'
import MessageBubble from '../../components/MessageBubble'
import { CardSkeleton, Skeleton } from '../../components/LoadingSpinner'

export default function PatientDetail() {
  const { id } = useParams()
  const { user } = useAuth()
  const [patient, setPatient] = useState(null)
  const [subscription, setSubscription] = useState(null)
  const [weightLogs, setWeightLogs] = useState([])
  const [messages, setMessages] = useState([])
  const [deliveries, setDeliveries] = useState([])
  const [idDoc, setIdDoc] = useState(null)
  const [idDocUrl, setIdDocUrl] = useState(null)
  const [notes, setNotes] = useState('')
  const [msgText, setMsgText] = useState('')
  const [rejectReason, setRejectReason] = useState('')
  const [loading, setLoading] = useState(true)
  const [sending, setSending] = useState(false)
  const [reviewingId, setReviewingId] = useState(false)
  const [verifyingManual, setVerifyingManual] = useState(false)
  const [savingNotes, setSavingNotes] = useState(false)
  const [notesSaved, setNotesSaved] = useState(false)

  useEffect(() => { fetchAll() }, [id])

  async function fetchAll() {
    setLoading(true)
    const [profileRes, subRes, weightRes, msgRes, delivRes, idDocRes] = await Promise.all([
      supabase.from('profiles').select('*').eq('id', id).single(),
      supabase.from('subscriptions').select('*').eq('user_id', id).order('created_at', { ascending: false }).limit(1).single(),
      supabase.from('weight_logs').select('*').eq('user_id', id).order('logged_at', { ascending: true }),
      supabase.from('messages').select('*').eq('user_id', id).order('created_at', { ascending: true }),
      supabase.from('deliveries').select('*').eq('user_id', id).order('created_at', { ascending: false }),
      supabase.from('identity_documents').select('*').eq('user_id', id).order('created_at', { ascending: false }).limit(1).maybeSingle(),
    ])
    setPatient(profileRes.data)
    setNotes(profileRes.data?.clinician_notes || '')
    setSubscription(subRes.data)
    setWeightLogs(weightRes.data || [])
    setMessages(msgRes.data || [])
    setDeliveries(delivRes.data || [])
    if (idDocRes.data) {
      setIdDoc(idDocRes.data)
      // Get signed URL for the document
      const { data: urlData } = await supabase.storage
        .from('identity-documents')
        .createSignedUrl(idDocRes.data.file_path, 3600)
      if (urlData) setIdDocUrl(urlData.signedUrl)
    }
    setLoading(false)
  }

  async function handleApproveId() {
    setReviewingId(true)
    await supabase.from('identity_documents').update({
      status: 'approved',
      reviewed_by: user.id,
      reviewed_at: new Date().toISOString(),
    }).eq('id', idDoc.id)
    await supabase.from('profiles').update({
      id_verified: true,
      id_verified_at: new Date().toISOString(),
    }).eq('id', id)
    await fetchAll()
    setReviewingId(false)
  }

  async function handleRejectId() {
    setReviewingId(true)
    await supabase.from('identity_documents').update({
      status: 'rejected',
      reviewed_by: user.id,
      reviewed_at: new Date().toISOString(),
      rejection_reason: rejectReason || 'Document not clear enough. Please re-upload.',
    }).eq('id', idDoc.id)
    await fetchAll()
    setReviewingId(false)
    setRejectReason('')
  }

  async function handleManualVerify(checked) {
    setVerifyingManual(true)
    if (checked) {
      await supabase.from('profiles').update({
        id_verified: true,
        id_verified_at: new Date().toISOString(),
      }).eq('id', id)
    } else {
      await supabase.from('profiles').update({
        id_verified: false,
        id_verified_at: null,
      }).eq('id', id)
    }
    await fetchAll()
    setVerifyingManual(false)
  }

  async function handleSaveNotes() {
    setSavingNotes(true)
    await supabase.from('profiles').update({ clinician_notes: notes }).eq('id', id)
    setSavingNotes(false)
    setNotesSaved(true)
    setTimeout(() => setNotesSaved(false), 2000)
  }

  async function handleSendMessage(e) {
    e.preventDefault()
    if (!msgText.trim()) return
    setSending(true)
    await supabase.from('messages').insert({
      user_id: id,
      sender_role: 'clinician',
      sender_name: 'Your Clinician',
      content: msgText.trim(),
    })
    setMsgText('')
    const { data } = await supabase.from('messages').select('*').eq('user_id', id).order('created_at', { ascending: true })
    setMessages(data || [])
    setSending(false)
  }

  const treatment = subscription ? getTreatmentInfo(subscription.treatment) : null

  if (loading) return (
    <div className="max-w-6xl mx-auto space-y-6">
      <CardSkeleton />
      <div className="grid md:grid-cols-2 gap-6"><CardSkeleton /><CardSkeleton /></div>
    </div>
  )

  return (
    <div className="max-w-6xl mx-auto space-y-6 animate-fade-in">
      <Link to="/clinician/patients" className="inline-flex items-center gap-1 text-sm text-gold hover:underline">
        <ArrowLeft size={14} /> Back to patients
      </Link>

      {/* Patient header */}
      <div className="bg-dark-card rounded-[16px] border border-border p-6">
        <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div>
            <h1 className="text-xl font-bold text-ink">{patient?.first_name} {patient?.last_name}</h1>
            <p className="text-sm text-slate">{patient?.email} · {patient?.phone || 'No phone'}</p>
            {patient?.date_of_birth && (
              <p className="text-xs text-slate mt-1">DOB: {new Date(patient.date_of_birth).toLocaleDateString('en-GB')}</p>
            )}
          </div>
          {subscription && (
            <div className="text-right">
              <p className="text-sm font-medium text-ink">{treatment?.treatment} {treatment?.dose}</p>
              <StatusBadge status={subscription.status} />
            </div>
          )}
        </div>
      </div>

      {/* ID Verification */}
      {idDoc && idDoc.status === 'pending' && (
        <div className="bg-amber-500/10 border border-amber-500/20 rounded-[16px] p-6">
          <div className="flex items-center gap-2 mb-4">
            <Shield size={18} className="text-amber-400" />
            <h2 className="text-sm font-semibold text-ink">ID Verification — Pending Review</h2>
          </div>
          <div className="flex flex-col sm:flex-row gap-4">
            {idDocUrl && (
              <a href={idDocUrl} target="_blank" rel="noopener noreferrer" className="inline-flex items-center gap-1.5 text-sm text-gold hover:underline">
                <ExternalLink size={14} /> View uploaded {idDoc.document_type === 'driving_licence' ? 'driving licence' : 'passport'}
              </a>
            )}
            <div className="flex gap-2">
              <button onClick={handleApproveId} disabled={reviewingId} className="flex items-center gap-1.5 px-4 py-2 text-sm font-semibold bg-emerald-500 text-white rounded-full hover:bg-emerald-400 transition-colors disabled:opacity-60">
                <CheckCircle2 size={14} /> Approve
              </button>
              <button onClick={() => setRejectReason(rejectReason || ' ')} disabled={reviewingId} className="flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-red-400 border border-red-500/30 rounded-full hover:bg-red-500/10 transition-colors disabled:opacity-60">
                <XCircle size={14} /> Reject
              </button>
            </div>
          </div>
          {rejectReason && (
            <div className="mt-3 flex gap-2">
              <input
                type="text"
                value={rejectReason.trim()}
                onChange={(e) => setRejectReason(e.target.value)}
                placeholder="Reason for rejection..."
                className="flex-1 px-3 py-2 border border-border rounded-xl text-sm bg-dark text-ink focus:outline-none focus:border-gold"
              />
              <button onClick={handleRejectId} disabled={reviewingId} className="bg-red-500 text-white px-4 py-2 text-sm font-semibold rounded-full hover:bg-red-400 disabled:opacity-60">
                Confirm reject
              </button>
            </div>
          )}
        </div>
      )}
      {idDoc && idDoc.status === 'approved' && (
        <div className="bg-emerald-500/10 border border-emerald-500/20 rounded-[16px] p-4 flex items-center gap-3">
          <CheckCircle2 size={18} className="text-emerald-400" />
          <p className="text-sm text-ink font-medium">ID verified — {idDoc.document_type === 'driving_licence' ? 'Driving licence' : 'Passport'} approved</p>
        </div>
      )}
      {!idDoc && !patient?.id_verified && (
        <div className="bg-dark-card border border-border rounded-[16px] p-4 flex items-center gap-3">
          <Clock size={18} className="text-slate" />
          <p className="text-sm text-slate">No ID document uploaded — identity can be verified during video consultation</p>
        </div>
      )}

      {/* Manual identity verification checkbox */}
      <div className="bg-dark-card border border-border rounded-[16px] p-5">
        <div className="flex items-center gap-2 mb-3">
          <Shield size={18} className="text-gold" />
          <h2 className="text-sm font-semibold text-ink">Identity Verification</h2>
        </div>
        <label className="flex items-center gap-3 cursor-pointer">
          <input
            type="checkbox"
            checked={patient?.id_verified || false}
            onChange={(e) => handleManualVerify(e.target.checked)}
            disabled={verifyingManual}
            className="w-5 h-5 rounded border-border text-gold focus:ring-gold accent-gold cursor-pointer"
          />
          <div>
            <p className="text-sm font-medium text-ink">
              Identity Verified (verified during video consultation)
            </p>
            {patient?.id_verified && patient?.id_verified_at && (
              <p className="text-xs text-emerald-400 mt-0.5">
                Verified on {new Date(patient.id_verified_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' })}
              </p>
            )}
            {!patient?.id_verified && (
              <p className="text-xs text-slate mt-0.5">
                Tick this box after verifying the patient's identity during a video consultation
              </p>
            )}
          </div>
        </label>
        {verifyingManual && <p className="text-xs text-gold mt-2 animate-pulse-gold">Updating...</p>}
      </div>

      <div className="grid md:grid-cols-2 gap-6">
        {/* Weight chart */}
        <div className="bg-dark-card rounded-[16px] border border-border p-6">
          <h2 className="text-sm font-semibold text-slate uppercase tracking-wide mb-4">Weight Progress</h2>
          <WeightChart data={weightLogs} height={250} />
        </div>

        {/* Messages */}
        <div className="bg-dark-card rounded-[16px] border border-border flex flex-col" style={{ maxHeight: 400 }}>
          <div className="p-4 border-b border-border">
            <h2 className="text-sm font-semibold text-slate uppercase tracking-wide">Messages</h2>
          </div>
          <div className="flex-1 overflow-y-auto p-4 space-y-1">
            {messages.map((msg) => (
              <MessageBubble key={msg.id} message={msg} isOwn={msg.sender_role === 'clinician'} />
            ))}
          </div>
          <form onSubmit={handleSendMessage} className="p-3 border-t border-border flex gap-2">
            <input
              type="text"
              value={msgText}
              onChange={(e) => setMsgText(e.target.value)}
              placeholder="Reply..."
              className="flex-1 px-3 py-2 border border-border rounded-full text-sm focus:outline-none focus:border-gold bg-dark text-ink"
            />
            <button type="submit" disabled={sending} className="bg-gold text-dark p-2 rounded-full hover:bg-gold-light disabled:opacity-40">
              <Send size={14} />
            </button>
          </form>
        </div>

        {/* Delivery management */}
        <DeliveryManagement
          deliveries={deliveries}
          patientId={id}
          subscription={subscription}
          treatment={treatment}
          onUpdate={fetchAll}
        />

        {/* Clinician notes */}
        <div className="bg-dark-card rounded-[16px] border border-border p-6">
          <h2 className="text-sm font-semibold text-slate uppercase tracking-wide mb-4">Clinician Notes</h2>
          <textarea
            value={notes}
            onChange={(e) => setNotes(e.target.value)}
            placeholder="Private notes about this patient (not visible to patient)..."
            rows={5}
            className="w-full px-4 py-3 border border-border rounded-xl text-sm resize-none focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/20 bg-dark text-ink"
          />
          <div className="flex items-center justify-between mt-3">
            <p className="text-[10px] text-slate">These notes are only visible to clinicians.</p>
            <div className="flex items-center gap-2">
              {notesSaved && <span className="text-xs text-emerald-400">✓ Saved</span>}
              <button onClick={handleSaveNotes} disabled={savingNotes} className="bg-gold text-dark px-4 py-1.5 text-xs font-semibold rounded-full hover:bg-gold-light disabled:opacity-60 transition-colors">
                {savingNotes ? 'Saving...' : 'Save notes'}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

const STATUS_FLOW = ['order_received', 'clinical_review', 'approved', 'with_pharmacy', 'dispatched', 'delivered']
const STATUS_LABELS = {
  order_received: 'Order Received',
  clinical_review: 'In Clinical Review',
  approved: 'Clinician Approved',
  with_pharmacy: 'With Pharmacy',
  dispatched: 'Dispatched',
  delivered: 'Delivered',
}

function DeliveryManagement({ deliveries, patientId, subscription, treatment, onUpdate }) {
  const [creating, setCreating] = useState(false)
  const [updating, setUpdating] = useState(false)
  const [trackingInput, setTrackingInput] = useState('')
  const [showCreate, setShowCreate] = useState(false)
  const [medName, setMedName] = useState('')
  const [medDetails, setMedDetails] = useState('')

  const latest = deliveries[0]

  function normalizeStatus(s) {
    if (s === 'processing') return 'order_received'
    if (s === 'in_transit') return 'dispatched'
    return s
  }

  function getNextStatus(current) {
    const norm = normalizeStatus(current)
    const idx = STATUS_FLOW.indexOf(norm)
    if (idx < 0 || idx >= STATUS_FLOW.length - 1) return null
    return STATUS_FLOW[idx + 1]
  }

  async function getToken() {
    const { data } = await supabase.auth.getSession()
    return data?.session?.access_token
  }

  async function handleAdvance() {
    if (!latest) return
    const next = getNextStatus(latest.status)
    if (!next) return
    setUpdating(true)
    try {
      const token = await getToken()
      await api.updateDelivery({
        deliveryId: latest.id,
        action: 'advance',
        trackingNumber: trackingInput.trim() || undefined,
      }, token)
    } catch (e) {
      // Fallback to direct Supabase if API fails
      const updates = { status: next }
      if (next === 'dispatched') {
        updates.dispatched_at = new Date().toISOString()
        if (trackingInput.trim()) updates.tracking_number = trackingInput.trim()
      }
      if (next === 'delivered') updates.delivered_at = new Date().toISOString()
      await supabase.from('deliveries').update(updates).eq('id', latest.id)
    }
    setTrackingInput('')
    setUpdating(false)
    onUpdate()
  }

  async function handleAddTracking() {
    if (!latest || !trackingInput.trim()) return
    setUpdating(true)
    try {
      const token = await getToken()
      await api.updateDelivery({
        deliveryId: latest.id,
        action: 'addTracking',
        trackingNumber: trackingInput.trim(),
      }, token)
    } catch (e) {
      await supabase.from('deliveries').update({ tracking_number: trackingInput.trim() }).eq('id', latest.id)
    }
    setTrackingInput('')
    setUpdating(false)
    onUpdate()
  }

  async function handleCreateDelivery() {
    setCreating(true)
    const name = medName.trim() || (treatment ? `${treatment.treatment} ${treatment.dose}` : 'Medication')
    await supabase.from('deliveries').insert({
      user_id: patientId,
      subscription_id: subscription?.id || null,
      status: 'order_received',
      medication_name: name,
      medication_details: medDetails.trim() || null,
    })
    setMedName('')
    setMedDetails('')
    setShowCreate(false)
    setCreating(false)
    onUpdate()
  }

  const nextStatus = latest ? getNextStatus(latest.status) : null
  const needsTracking = nextStatus === 'dispatched'

  return (
    <div className="bg-dark-card rounded-[16px] border border-border p-6">
      <div className="flex items-center justify-between mb-4">
        <h2 className="text-sm font-semibold text-slate uppercase tracking-wide">Order & Delivery</h2>
        <button
          onClick={() => setShowCreate(!showCreate)}
          className="flex items-center gap-1 text-xs font-semibold text-gold hover:text-gold-light transition-colors"
        >
          <Plus size={14} /> New order
        </button>
      </div>

      {/* Create new delivery */}
      {showCreate && (
        <div className="bg-warm/40 rounded-xl p-4 mb-4 space-y-3">
          <input
            type="text"
            value={medName}
            onChange={(e) => setMedName(e.target.value)}
            placeholder={treatment ? `${treatment.treatment} ${treatment.dose}` : 'Medication name'}
            className="w-full px-3 py-2 border border-border rounded-lg text-sm bg-dark text-ink focus:outline-none focus:border-gold"
          />
          <input
            type="text"
            value={medDetails}
            onChange={(e) => setMedDetails(e.target.value)}
            placeholder="Details (e.g. Strength: 2.5mg, Quantity: 1 Pen)"
            className="w-full px-3 py-2 border border-border rounded-lg text-sm bg-dark text-ink focus:outline-none focus:border-gold"
          />
          <div className="flex gap-2">
            <button
              onClick={handleCreateDelivery}
              disabled={creating}
              className="bg-gold text-dark px-4 py-2 text-xs font-semibold rounded-full hover:bg-gold-light disabled:opacity-60 transition-colors"
            >
              {creating ? 'Creating...' : 'Create order'}
            </button>
            <button onClick={() => setShowCreate(false)} className="text-xs text-slate hover:text-ink transition-colors px-3">
              Cancel
            </button>
          </div>
        </div>
      )}

      {/* Current delivery tracker */}
      {latest ? (
        <div className="space-y-4">
          <DeliveryTracker delivery={latest} />

          {/* Clinician actions */}
          {nextStatus && (
            <div className="border-t border-border pt-4">
              <p className="text-xs text-slate mb-3">
                Current: <strong className="text-ink">{STATUS_LABELS[normalizeStatus(latest.status)]}</strong>
                {' → '}Next: <strong className="text-gold">{STATUS_LABELS[nextStatus]}</strong>
              </p>

              {/* Tracking input for dispatch step */}
              {needsTracking && (
                <input
                  type="text"
                  value={trackingInput}
                  onChange={(e) => setTrackingInput(e.target.value)}
                  placeholder="Tracking number (e.g. FI916404356GB)"
                  className="w-full px-3 py-2 border border-border rounded-lg text-sm bg-dark text-ink focus:outline-none focus:border-gold mb-3"
                />
              )}

              <button
                onClick={handleAdvance}
                disabled={updating || (needsTracking && !trackingInput.trim())}
                className="flex items-center gap-2 bg-gold text-dark px-5 py-2 text-sm font-semibold rounded-full hover:bg-gold-light disabled:opacity-60 transition-colors"
              >
                {updating ? 'Updating...' : (
                  <>
                    {nextStatus === 'dispatched' ? <Truck size={14} /> : <ChevronRight size={14} />}
                    Mark as {STATUS_LABELS[nextStatus]}
                  </>
                )}
              </button>
            </div>
          )}

          {/* Add/update tracking number for dispatched orders */}
          {normalizeStatus(latest.status) === 'dispatched' && !latest.tracking_number && (
            <div className="border-t border-border pt-4">
              <p className="text-xs text-slate mb-2">Add tracking number:</p>
              <div className="flex gap-2">
                <input
                  type="text"
                  value={trackingInput}
                  onChange={(e) => setTrackingInput(e.target.value)}
                  placeholder="e.g. FI916404356GB"
                  className="flex-1 px-3 py-2 border border-border rounded-lg text-sm bg-dark text-ink focus:outline-none focus:border-gold"
                />
                <button
                  onClick={handleAddTracking}
                  disabled={updating || !trackingInput.trim()}
                  className="bg-gold text-dark px-4 py-2 text-xs font-semibold rounded-full hover:bg-gold-light disabled:opacity-60 transition-colors"
                >
                  Save
                </button>
              </div>
            </div>
          )}
        </div>
      ) : (
        <div className="text-center py-6">
          <Truck size={24} className="text-slate mx-auto mb-2" />
          <p className="text-sm text-slate">No orders yet</p>
        </div>
      )}

      {/* Previous deliveries */}
      {deliveries.length > 1 && (
        <div className="border-t border-border mt-4 pt-4">
          <h3 className="text-xs font-semibold text-slate uppercase tracking-wide mb-3">
            Previous Orders ({deliveries.length - 1})
          </h3>
          <div className="space-y-2">
            {deliveries.slice(1, 6).map((d) => (
              <div key={d.id} className="flex items-center justify-between bg-warm/30 rounded-lg px-3 py-2.5">
                <div>
                  <p className="text-xs font-medium text-ink">{d.medication_name || 'Medication'}</p>
                  <p className="text-[10px] text-slate">
                    {new Date(d.created_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })}
                  </p>
                </div>
                <span className={`text-[10px] font-semibold uppercase tracking-wide px-2 py-0.5 rounded-full ${
                  d.status === 'delivered' ? 'bg-emerald-500/15 text-emerald-400' :
                  d.status === 'dispatched' ? 'bg-gold/10 text-gold' :
                  'bg-slate/10 text-slate'
                }`}>
                  {STATUS_LABELS[normalizeStatus(d.status)] || d.status?.replace(/_/g, ' ')}
                </span>
              </div>
            ))}
          </div>
        </div>
      )}
    </div>
  )
}
