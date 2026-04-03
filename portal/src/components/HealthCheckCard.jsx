import { Check, Star } from 'lucide-react'
import { formatPrice } from '../data/treatments'

export default function HealthCheckCard({ pkg, onBook, onSubscribeAnnual }) {
  return (
    <div className={`relative bg-dark-card rounded-[16px] border p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg ${
      pkg.popular ? 'border-gold shadow-sm shadow-gold/10 hover:shadow-gold/15' : 'border-border hover:border-stone hover:shadow-stone/5'
    }`}>
      {pkg.popular && (
        <div className="absolute -top-3 left-1/2 -translate-x-1/2 bg-gold text-dark text-[10px] font-semibold uppercase tracking-wide px-3 py-1 rounded-full flex items-center gap-1">
          <Star size={10} /> Most popular
        </div>
      )}

      <h3 className="text-lg font-bold text-ink">{pkg.name}</h3>

      {/* Pricing */}
      <div className="mt-2 mb-1">
        <p className="text-2xl font-bold text-gold">{formatPrice(pkg.pricePence)}</p>
        <p className="text-xs text-slate">One-off initial assessment</p>
      </div>
      {pkg.annualPricePence && (
        <div className="mb-3">
          <p className="text-sm font-semibold text-ink">
            + {formatPrice(pkg.annualPricePence)}<span className="text-xs font-normal text-slate">/year ongoing</span>
          </p>
        </div>
      )}

      <p className="text-sm text-slate mb-4">{pkg.description}</p>

      <ul className="space-y-2 mb-6">
        {pkg.includes.map((item) => (
          <li key={item} className="flex items-start gap-2 text-sm text-ink">
            <Check size={14} className="text-gold mt-0.5 shrink-0" />
            {item}
          </li>
        ))}
      </ul>

      <div className="space-y-2">
        <button
          onClick={() => onBook(pkg)}
          className={`w-full py-2.5 rounded-full font-semibold text-sm transition-colors ${
            pkg.popular
              ? 'bg-gold text-dark hover:bg-gold-light'
              : 'bg-dark-card text-ink border border-border hover:bg-warm'
          }`}
        >
          Book initial assessment - {formatPrice(pkg.pricePence)}
        </button>
        {pkg.annualPricePence && onSubscribeAnnual && (
          <button
            onClick={() => onSubscribeAnnual(pkg)}
            className="w-full py-2.5 rounded-full font-medium text-sm text-gold border border-gold/30 hover:bg-gold/10 transition-colors"
          >
            Subscribe annually - {formatPrice(pkg.annualPricePence)}/yr
          </button>
        )}
      </div>
    </div>
  )
}
