import { Link } from 'react-router-dom'
import {
  Camera, Video, HeartPulse, Bot, Settings, HelpCircle, LogOut, ChevronRight,
} from 'lucide-react'
import { useAuth } from '../hooks/useAuth'

const items = [
  { to: '/photos', icon: Camera, label: 'Progress Photos' },
  { to: '/video-calls', icon: Video, label: 'Video Calls' },
  { to: '/health-checks', icon: HeartPulse, label: 'Health Checks' },
  { to: '/ai-assistant', icon: Bot, label: 'AI Assistant' },
  { to: '/settings', icon: Settings, label: 'Settings' },
]

export default function More() {
  const { signOut } = useAuth()

  return (
    <div className="max-w-md mx-auto space-y-2 animate-fade-in">
      <h1 className="text-2xl font-bold text-ink tracking-tight mb-4">More</h1>

      {items.map((item) => {
        const Icon = item.icon
        return (
          <Link
            key={item.to}
            to={item.to}
            className="flex items-center gap-3 bg-dark-card rounded-xl border border-border p-4 hover:bg-warm transition-colors group"
          >
            <Icon size={20} className="text-gold" />
            <span className="text-sm font-medium text-ink flex-1">{item.label}</span>
            <ChevronRight size={16} className="text-slate group-hover:text-gold transition-colors" />
          </Link>
        )
      })}

      <a
        href="mailto:hello@dontweight.co.uk"
        className="flex items-center gap-3 bg-dark-card rounded-xl border border-border p-4 hover:bg-warm transition-colors group"
      >
        <HelpCircle size={20} className="text-slate" />
        <span className="text-sm font-medium text-ink flex-1">Contact Support</span>
        <ChevronRight size={16} className="text-slate group-hover:text-gold transition-colors" />
      </a>

      <button
        onClick={signOut}
        className="flex items-center gap-3 w-full bg-dark-card rounded-xl border border-red-500/30 p-4 hover:bg-red-500/10 transition-colors mt-4"
      >
        <LogOut size={20} className="text-red-400" />
        <span className="text-sm font-medium text-red-400">Sign out</span>
      </button>
    </div>
  )
}
