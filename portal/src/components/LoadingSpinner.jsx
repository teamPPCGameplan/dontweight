export default function LoadingSpinner() {
  return (
    <div className="flex items-center justify-center min-h-screen bg-cream">
      <div className="flex flex-col items-center gap-4">
        <div className="w-10 h-10 border-3 border-stone border-t-gold rounded-full animate-spin" />
        <p className="text-sm text-slate font-medium">Loading...</p>
      </div>
    </div>
  )
}

export function Skeleton({ className = '' }) {
  return <div className={`skeleton ${className}`} />
}

export function CardSkeleton() {
  return (
    <div className="bg-dark-card rounded-[16px] border border-border p-6">
      <Skeleton className="h-4 w-32 mb-4" />
      <Skeleton className="h-8 w-48 mb-2" />
      <Skeleton className="h-4 w-64" />
    </div>
  )
}
