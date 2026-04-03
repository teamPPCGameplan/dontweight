import { Package, Stethoscope, CheckCircle2, Building2, Truck, MapPin } from 'lucide-react'

const steps = [
  { key: 'order_received', label: 'Order Received', icon: Package },
  { key: 'clinical_review', label: 'Clinical Review', icon: Stethoscope },
  { key: 'approved', label: 'Clinician Approved', icon: CheckCircle2 },
  { key: 'with_pharmacy', label: 'With Pharmacy', icon: Building2 },
  { key: 'dispatched', label: 'Dispatched', icon: Truck },
]

// Map legacy statuses
function normalizeStatus(status) {
  if (status === 'processing') return 'order_received'
  if (status === 'in_transit') return 'dispatched'
  if (status === 'delivered') return 'delivered'
  return status
}

const stepOrder = { order_received: 0, clinical_review: 1, approved: 2, with_pharmacy: 3, dispatched: 4, delivered: 5 }

export default function DeliveryTracker({ delivery, compact }) {
  if (!delivery) {
    return (
      <p className="text-sm text-slate">No deliveries yet.</p>
    )
  }

  const normalised = normalizeStatus(delivery.status)
  const currentIdx = stepOrder[normalised] ?? 0
  const isDelivered = normalised === 'delivered'

  return (
    <div>
      {/* Medication info */}
      {delivery.medication_name && !compact && (
        <div className="flex items-center gap-3 mb-4 bg-warm/40 rounded-xl px-4 py-3">
          <div className="w-10 h-10 rounded-xl bg-gold/10 flex items-center justify-center shrink-0">
            <Package size={18} className="text-gold" />
          </div>
          <div className="flex-1 min-w-0">
            <p className="text-sm font-semibold text-ink">{delivery.medication_name}</p>
            {delivery.medication_details && (
              <p className="text-xs text-slate">{delivery.medication_details}</p>
            )}
          </div>
          {delivery.price_display && (
            <p className="text-sm font-bold text-ink shrink-0">{delivery.price_display}</p>
          )}
        </div>
      )}

      {/* Pipeline steps */}
      <div className="flex items-start justify-between gap-0 mb-4">
        {steps.map((step, i) => {
          const isComplete = i < currentIdx || isDelivered
          const isCurrent = i === currentIdx && !isDelivered
          const Icon = step.icon
          return (
            <div key={step.key} className="flex-1 flex flex-col items-center relative">
              {i > 0 && (
                <div className={`absolute top-4 right-1/2 w-full h-0.5 transition-colors ${
                  isComplete || isCurrent ? 'bg-emerald-400' : 'bg-border'
                }`} />
              )}
              <div className={`relative z-10 w-8 h-8 rounded-full flex items-center justify-center transition-all ${
                isComplete ? 'bg-emerald-500 text-white' :
                isCurrent ? 'bg-gold text-dark ring-4 ring-gold/20' :
                'bg-warm text-slate border border-border'
              }`}>
                {isComplete ? <CheckCircle2 size={16} /> : <Icon size={14} />}
              </div>
              <span className={`text-[9px] sm:text-[10px] mt-1.5 font-medium text-center leading-tight max-w-[70px] ${
                isComplete ? 'text-emerald-400' :
                isCurrent ? 'text-gold' :
                'text-slate'
              }`}>
                {step.label}
              </span>
            </div>
          )
        })}
      </div>

      {/* Delivered badge */}
      {isDelivered && (
        <div className="flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/20 rounded-xl px-4 py-2.5 mb-3">
          <CheckCircle2 size={16} className="text-emerald-400 shrink-0" />
          <p className="text-sm font-semibold text-emerald-400">Delivered</p>
          {delivery.delivered_at && (
            <span className="text-xs text-slate ml-auto">
              {new Date(delivery.delivered_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'short' })}
            </span>
          )}
        </div>
      )}

      {/* Tracking number */}
      {delivery.tracking_number && (
        <div className="flex items-center gap-2 bg-warm/40 rounded-xl px-4 py-2.5">
          <MapPin size={13} className="text-gold shrink-0" />
          <span className="text-xs text-slate">Tracking:</span>
          <a
            href={`https://www.royalmail.com/track-your-item#/tracking-results/${delivery.tracking_number}`}
            target="_blank"
            rel="noopener noreferrer"
            className="text-xs text-gold hover:underline font-semibold truncate"
          >
            {delivery.tracking_number}
          </a>
        </div>
      )}

      {delivery.estimated_delivery && !isDelivered && (
        <p className="text-xs text-slate mt-2">
          Estimated delivery: {new Date(delivery.estimated_delivery).toLocaleDateString('en-GB', { weekday: 'long', day: 'numeric', month: 'long' })}
        </p>
      )}
    </div>
  )
}
