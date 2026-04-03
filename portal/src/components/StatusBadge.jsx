const variants = {
  active: 'bg-emerald-500/15 text-emerald-400 border-emerald-500/30',
  paused: 'bg-amber-500/15 text-amber-400 border-amber-500/30',
  cancelling: 'bg-amber-500/15 text-amber-400 border-amber-500/30',
  cancelled: 'bg-red-500/15 text-red-400 border-red-500/30',
  past_due: 'bg-red-500/15 text-red-400 border-red-500/30',
  scheduled: 'bg-gold/15 text-gold border-gold/30',
  completed: 'bg-emerald-500/15 text-emerald-400 border-emerald-500/30',
  processing: 'bg-amber-500/15 text-amber-400 border-amber-500/30',
  dispatched: 'bg-gold/15 text-gold border-gold/30',
  in_transit: 'bg-gold/15 text-gold border-gold/30',
  delivered: 'bg-emerald-500/15 text-emerald-400 border-emerald-500/30',
  booked: 'bg-gold/15 text-gold border-gold/30',
}

export default function StatusBadge({ status }) {
  const classes = variants[status] || 'bg-stone/50 text-slate border-stone'
  const label = status?.replace(/_/g, ' ') || 'unknown'

  return (
    <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold uppercase tracking-wide border ${classes}`}>
      {label}
    </span>
  )
}
