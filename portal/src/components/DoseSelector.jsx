import { treatments, formatPrice } from '../data/treatments'

const STARTER_DOSES = ['mounjaro-2.5mg', 'wegovy-0.25mg']

export default function DoseSelector({ currentDoseId, onSelect }) {
  return (
    <div className="space-y-6">
      <div className="bg-amber-500/10 border border-amber-500/20 rounded-xl px-3 py-2">
        <p className="text-xs text-amber-400 font-medium">Note: First-time patients must start with a starter dose. Higher doses require clinician approval.</p>
      </div>
      {Object.entries(treatments).map(([key, treatment]) => (
        <div key={key}>
          <h3 className="text-sm font-semibold text-ink mb-3">{treatment.name}</h3>
          <div className="grid grid-cols-2 gap-2">
            {treatment.doses.map((dose) => {
              const isActive = dose.id === currentDoseId
              const isStarter = STARTER_DOSES.includes(dose.id)
              return (
                <button
                  key={dose.id}
                  onClick={() => onSelect(dose)}
                  className={`p-3 rounded-xl border text-left transition-all duration-300 hover:-translate-y-0.5 ${
                    isActive
                      ? 'border-gold bg-gold/10 shadow-md shadow-gold/10 ring-1 ring-gold/20'
                      : 'border-border bg-dark-card hover:shadow-sm hover:border-stone'
                  }`}
                >
                  <div className="flex items-center justify-between">
                    <span className="text-sm font-semibold text-ink block">{dose.dose}</span>
                    <div className="flex items-center gap-1">
                      {isStarter && (
                        <span className="text-[10px] font-semibold text-emerald-400 bg-emerald-500/15 px-2 py-0.5 rounded-full">Starter</span>
                      )}
                      {isActive && (
                        <span className="text-[10px] font-semibold text-gold bg-gold/15 px-2 py-0.5 rounded-full">Current</span>
                      )}
                    </div>
                  </div>
                  <span className={`text-xs ${isActive ? 'text-gold' : 'text-slate'}`}>{formatPrice(dose.pricePence)}/mo</span>
                </button>
              )
            })}
          </div>
        </div>
      ))}
    </div>
  )
}
