import { useEffect, useCallback } from 'react'
import { X } from 'lucide-react'

export default function Modal({ open, onClose, title, children, wide = false }) {
  const handleKeyDown = useCallback((e) => {
    if (e.key === 'Escape') onClose()
  }, [onClose])

  useEffect(() => {
    if (open) {
      document.body.style.overflow = 'hidden'
      document.addEventListener('keydown', handleKeyDown)
    } else {
      document.body.style.overflow = ''
    }
    return () => {
      document.body.style.overflow = ''
      document.removeEventListener('keydown', handleKeyDown)
    }
  }, [open, handleKeyDown])

  if (!open) return null

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-4 animate-fade-in" role="dialog" aria-modal="true" aria-label={title}>
      <div className="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity duration-300" onClick={onClose} />
      <div className={`relative bg-dark-card rounded-[16px] border border-border shadow-2xl w-full ${wide ? 'max-w-2xl' : 'max-w-md'} max-h-[90vh] overflow-y-auto animate-slide-up transition-all duration-300`}>
        <div className="flex items-center justify-between p-6 pb-4">
          <h2 className="text-lg font-bold text-ink tracking-tight">{title}</h2>
          <button onClick={onClose} className="p-2 rounded-xl bg-warm hover:bg-warm/80 border border-border hover:border-gold/30 transition-all duration-200 group" aria-label="Close">
            <X size={16} className="text-slate group-hover:text-ink transition-colors" />
          </button>
        </div>
        <div className="px-6 pb-6">{children}</div>
      </div>
    </div>
  )
}
