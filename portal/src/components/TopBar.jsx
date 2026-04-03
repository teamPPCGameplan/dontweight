import { useState, useRef, useEffect } from 'react'
import { Bell, ChevronDown, LogOut, Settings, User } from 'lucide-react'
import { useNavigate } from 'react-router-dom'
import { useAuth } from '../hooks/useAuth'

export default function TopBar() {
  const { profile, signOut } = useAuth()
  const navigate = useNavigate()
  const [dropdownOpen, setDropdownOpen] = useState(false)
  const dropRef = useRef(null)

  useEffect(() => {
    function handleClick(e) {
      if (dropRef.current && !dropRef.current.contains(e.target)) setDropdownOpen(false)
    }
    document.addEventListener('mousedown', handleClick)
    return () => document.removeEventListener('mousedown', handleClick)
  }, [])

  const initials = profile
    ? `${profile.first_name?.[0] || ''}${profile.last_name?.[0] || ''}`.toUpperCase()
    : '?'

  return (
    <header className="sticky top-0 z-30 bg-dark-card/80 backdrop-blur-md border-b border-border">
      <div className="flex items-center justify-between h-16 px-4 md:px-8">
        {/* Mobile logo */}
        <div className="md:hidden text-lg tracking-tight">
          <span className="font-bold text-ink">don't</span>{' '}
          <span className="italic font-light text-gold">weight</span>
        </div>

        {/* Spacer for desktop */}
        <div className="hidden md:block" />

        <div className="flex items-center gap-3">
          <button className="relative p-2 rounded-full hover:bg-warm transition-colors" aria-label="Notifications">
            <Bell size={18} className="text-slate" />
          </button>

          <div className="relative" ref={dropRef}>
            <button
              onClick={() => setDropdownOpen(!dropdownOpen)}
              className="flex items-center gap-2 p-1.5 pr-3 rounded-full hover:bg-warm transition-colors"
              aria-label="Account menu"
              aria-expanded={dropdownOpen}
            >
              <div className="w-8 h-8 rounded-full bg-gold/15 text-gold flex items-center justify-center text-xs font-bold">
                {initials}
              </div>
              <span className="hidden sm:block text-sm font-medium text-ink">
                {profile?.first_name || 'Account'}
              </span>
              <ChevronDown size={14} className="text-slate" />
            </button>

            {dropdownOpen && (
              <div className="absolute right-0 top-full mt-2 w-48 bg-dark-card rounded-xl border border-border shadow-lg py-1 animate-fade-in">
                <button
                  onClick={() => { navigate('/settings'); setDropdownOpen(false) }}
                  className="flex items-center gap-2 w-full px-4 py-2.5 text-sm text-slate hover:bg-warm hover:text-ink transition-colors"
                >
                  <Settings size={16} /> Settings
                </button>
                <button
                  onClick={() => { signOut(); setDropdownOpen(false) }}
                  className="flex items-center gap-2 w-full px-4 py-2.5 text-sm text-red-400 hover:bg-red-500/10 transition-colors"
                >
                  <LogOut size={16} /> Sign out
                </button>
              </div>
            )}
          </div>
        </div>
      </div>
    </header>
  )
}
