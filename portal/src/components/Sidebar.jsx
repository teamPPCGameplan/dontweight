import { NavLink } from 'react-router-dom'
import {
  LayoutDashboard, Scale, MessageSquare, CreditCard, Camera,
  Video, HeartPulse, Bot, Settings, HelpCircle,
  Users, ClipboardList, MoreHorizontal,
} from 'lucide-react'
import { useAuth } from '../hooks/useAuth'
import { useMessages } from '../hooks/useMessages'

const clientNav = [
  { to: '/dashboard', icon: LayoutDashboard, label: 'Dashboard' },
  { to: '/weight', icon: Scale, label: 'Weight' },
  { to: '/messages', icon: MessageSquare, label: 'Messages', badge: true },
  { to: '/order', icon: CreditCard, label: 'Your Order' },
  { to: '/photos', icon: Camera, label: 'Photos' },
  { to: '/video-calls', icon: Video, label: 'Video Calls' },
  { to: '/health-checks', icon: HeartPulse, label: 'Health Checks' },
  { to: '/ai-assistant', icon: Bot, label: 'AI Assistant' },
  { to: '/settings', icon: Settings, label: 'Settings' },
]

const clinicianNav = [
  { to: '/clinician/dashboard', icon: LayoutDashboard, label: 'Dashboard' },
  { to: '/clinician/patients', icon: Users, label: 'Patients' },
  { to: '/clinician/messages', icon: MessageSquare, label: 'Messages' },
]

const mobileNav = [
  { to: '/dashboard', icon: LayoutDashboard, label: 'Home' },
  { to: '/weight', icon: Scale, label: 'Weight' },
  { to: '/messages', icon: MessageSquare, label: 'Messages', badge: true },
  { to: '/order', icon: CreditCard, label: 'Order' },
  { to: '/more', icon: MoreHorizontal, label: 'More' },
]

function NavItem({ item, collapsed }) {
  const { unreadCount } = useMessages()
  const Icon = item.icon

  return (
    <NavLink
      to={item.to}
      className={({ isActive }) =>
        `flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 ${
          isActive
            ? 'bg-gold/10 text-gold border-l-2 border-gold shadow-sm shadow-gold/5'
            : 'text-slate hover:bg-warm hover:text-ink hover:translate-x-0.5 border-l-2 border-transparent'
        } ${collapsed ? 'justify-center' : ''}`
      }
    >
      <Icon size={20} />
      {!collapsed && <span>{item.label}</span>}
      {item.badge && unreadCount > 0 && (
        <span className={`bg-coral text-white text-[10px] font-bold rounded-full min-w-[18px] h-[18px] flex items-center justify-center ${collapsed ? 'absolute -top-1 -right-1' : 'ml-auto'}`}>
          {unreadCount}
        </span>
      )}
    </NavLink>
  )
}

export default function Sidebar({ collapsed }) {
  const { isClinic } = useAuth()
  const nav = isClinic ? clinicianNav : clientNav

  return (
    <>
      {/* Desktop sidebar */}
      <aside className={`hidden md:flex flex-col fixed top-0 left-0 h-full bg-dark-card border-r border-border z-40 transition-all ${
        collapsed ? 'w-16' : 'w-60'
      }`}>
        <div className={`p-4 ${collapsed ? 'px-2' : 'px-5'} pt-6`}>
          {collapsed ? (
            <span className="text-lg font-bold text-gold block text-center">dw</span>
          ) : (
            <div className="text-xl tracking-tight">
              <span className="font-bold text-ink">don't</span>{' '}
              <span className="italic font-light text-gold">weight</span>
            </div>
          )}
        </div>

        <nav className="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
          {nav.map((item) => (
            <NavItem key={item.to} item={item} collapsed={collapsed} />
          ))}
        </nav>

        {!collapsed && (
          <div className="p-4 border-t border-border">
            <a href="mailto:hello@dontweight.co.uk" className="text-xs text-slate hover:text-gold transition-colors">
              <HelpCircle size={14} className="inline mr-1" />
              Need help? Contact us
            </a>
          </div>
        )}
      </aside>

      {/* Mobile bottom tab bar */}
      <nav className="md:hidden fixed bottom-0 left-0 right-0 bg-dark-card border-t border-border z-40 safe-area-pb">
        <div className="flex items-center justify-around py-1">
          {(isClinic ? clinicianNav.slice(0, 4) : mobileNav).map((item) => {
            const Icon = item.icon
            return (
              <NavLink
                key={item.to}
                to={item.to}
                className={({ isActive }) =>
                  `flex flex-col items-center gap-0.5 py-2 px-3 text-[10px] font-medium transition-all duration-200 relative ${
                    isActive ? 'text-gold' : 'text-slate active:scale-95'
                  }`
                }
              >
                {({ isActive }) => (
                  <>
                    {isActive && (
                      <span className="absolute -top-0 left-1/2 -translate-x-1/2 w-6 h-0.5 bg-gold rounded-full" />
                    )}
                    <Icon size={20} className={isActive ? 'text-gold' : 'text-slate'} />
                    <span>{item.label}</span>
                  </>
                )}
              </NavLink>
            )
          })}
        </div>
      </nav>
    </>
  )
}
