import { Link, useSearchParams, useNavigate } from 'react-router-dom'
import {
  Scale, MessageSquare, Video, HeartPulse, Camera, HelpCircle,
  TrendingDown, ArrowRight, Package, Shield, CheckCircle2, Sparkles,
  ClipboardCheck, Truck, Bot,
} from 'lucide-react'
import { useAuth } from '../hooks/useAuth'
import { useSubscription } from '../hooks/useSubscription'
import { useWeightLogs } from '../hooks/useWeightLogs'
import { useMessages } from '../hooks/useMessages'
import { useDeliveries } from '../hooks/useDeliveries'
import { getTreatmentInfo, formatPrice } from '../data/treatments'
import WeightChart from '../components/WeightChart'
import DeliveryTracker from '../components/DeliveryTracker'
import StatusBadge from '../components/StatusBadge'
import IdVerificationBanner from '../components/IdVerificationBanner'
import { CardSkeleton } from '../components/LoadingSpinner'

export default function Dashboard() {
  const { profile } = useAuth()
  const { subscription, loading: subLoading } = useSubscription()
  const { logs, stats, loading: weightLoading } = useWeightLogs()
  const { unreadCount } = useMessages()
  const { latest: latestDelivery, loading: deliveryLoading } = useDeliveries()
  const [searchParams, setSearchParams] = useSearchParams()

  const treatment = subscription ? getTreatmentInfo(subscription.treatment) : null
  const isNew = !stats.current && !subscription
  const checkoutSuccess = searchParams.get('checkout') === 'success'

  // Strip checkout param after showing the success banner
  if (checkoutSuccess) {
    setTimeout(() => {
      searchParams.delete('checkout')
      setSearchParams(searchParams, { replace: true })
    }, 10000) // Remove after 10 seconds
  }

  return (
    <div className="max-w-6xl mx-auto space-y-6 animate-fade-in pt-2">
      {/* Checkout success banner */}
      {checkoutSuccess && (
        <div className="bg-emerald-500/10 border border-emerald-500/30 rounded-[16px] p-5 flex items-start gap-3">
          <CheckCircle2 size={20} className="text-emerald-400 shrink-0 mt-0.5" />
          <div>
            <p className="text-sm font-semibold text-ink">Payment confirmed</p>
            <p className="text-sm text-slate mt-0.5">
              Your treatment is being prepared. You'll receive a confirmation email shortly.
              Your first delivery will arrive within 2-3 working days via Royal Mail.
            </p>
          </div>
        </div>
      )}

      {/* ID Verification */}
      <IdVerificationBanner />

      {/* Welcome */}
      <div className="bg-gradient-to-br from-dark-card via-dark-card to-gold/[0.03] rounded-[16px] border border-border p-6 md:p-8 relative overflow-hidden">
        <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-gold/[0.04] via-transparent to-transparent pointer-events-none" />
        <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <p className="text-xs font-semibold text-gold uppercase tracking-wider mb-1">
              {new Date().toLocaleDateString('en-GB', { weekday: 'long', day: 'numeric', month: 'long' })}
            </p>
            <h1 className="text-2xl font-bold text-ink tracking-tight">
              {isNew ? `Welcome, ${profile?.first_name || 'there'} 👋` : `Welcome back, ${profile?.first_name || 'there'}`}
            </h1>
            {treatment ? (
              <p className="text-sm text-slate mt-1">
                Currently on {treatment.treatment} {treatment.dose} — {formatPrice(treatment.pricePence)}/month
              </p>
            ) : (
              <p className="text-sm text-slate mt-1.5">Your personal weight management portal</p>
            )}
          </div>
          <div className="relative flex items-center gap-1.5 bg-emerald-500/10 border border-emerald-500/20 rounded-full px-3 py-1.5">
            <Shield size={13} className="text-emerald-400" />
            <span className="text-xs font-semibold text-emerald-400">100% money-back guarantee</span>
          </div>
        </div>
      </div>


      {/* Getting started guide for new clients */}
      {isNew && !subLoading && (
        <div className="bg-gold/5 border border-gold/15 rounded-[16px] p-6">
          <div className="flex items-center gap-2 mb-4">
            <Sparkles size={18} className="text-gold" />
            <h2 className="text-sm font-semibold text-ink">Get started with your journey</h2>
          </div>
          <div className="grid sm:grid-cols-3 gap-4">
            {[
              {
                step: '1',
                icon: ClipboardCheck,
                title: 'Book a consultation',
                desc: 'Speak with a clinician to find the right treatment for you',
                action: { label: 'Book now', to: '/video-calls' },
                done: false,
              },
              {
                step: '2',
                icon: Scale,
                title: 'Log your starting weight',
                desc: 'Track your progress from day one',
                action: { label: 'Log weight', to: '/weight' },
                done: stats.current != null,
              },
              {
                step: '3',
                icon: MessageSquare,
                title: 'Message your clinician',
                desc: 'Ask questions, share concerns, get support',
                action: { label: 'Send message', to: '/messages' },
                done: false,
              },
            ].map((item, idx) => {
              const Icon = item.icon
              return (
                <Link key={item.step} to={item.action.to} className="bg-dark-card rounded-xl border border-border p-5 hover:-translate-y-0.5 hover:border-gold/30 hover:shadow-lg transition-all duration-300 block animate-fade-in" style={{ animationDelay: `${idx * 100}ms`, animationFillMode: 'both' }}>
                  <div className="flex items-center gap-3 mb-3">
                    <div className={`w-10 h-10 rounded-xl flex items-center justify-center ${item.done ? 'bg-emerald-500/15' : 'bg-gold/10'}`}>
                      <Icon size={20} className={item.done ? 'text-emerald-400' : 'text-gold'} />
                    </div>
                    <div className={`w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold ${item.done ? 'bg-emerald-500/15 text-emerald-400' : 'bg-stone/50 text-slate'}`}>
                      {item.done ? <CheckCircle2 size={14} /> : item.step}
                    </div>
                  </div>
                  <p className="text-sm font-semibold text-ink mb-1">{item.title}</p>
                  <p className="text-xs text-slate leading-relaxed">{item.desc}</p>
                </Link>
              )
            })}
          </div>
        </div>
      )}

      <div className="grid md:grid-cols-2 gap-6">
        {/* Weight tracker */}
        <div className="bg-dark-card rounded-[16px] border border-border p-6 hover:shadow-lg hover:border-gold/30 hover:-translate-y-0.5 transition-all duration-300">
          <div className="flex items-center justify-between mb-4">
            <h2 className="text-sm font-semibold text-slate uppercase tracking-wide">Weight Tracker</h2>
            <Link to="/weight" className="text-xs text-gold hover:underline flex items-center gap-1">
              View all <ArrowRight size={12} />
            </Link>
          </div>

          {weightLoading ? (
            <CardSkeleton />
          ) : stats.current ? (
            <>
              <div className="flex items-baseline gap-4 mb-4">
                <div>
                  <span className="text-3xl font-bold text-ink">{stats.current}</span>
                  <span className="text-sm text-slate ml-1">kg</span>
                </div>
                {stats.totalLost && Number(stats.totalLost) > 0 && (
                  <div className="flex items-center gap-1 text-emerald-400 bg-emerald-500/15 px-2 py-0.5 rounded-full">
                    <TrendingDown size={14} />
                    <span className="text-xs font-semibold">-{stats.totalLost} kg</span>
                  </div>
                )}
              </div>
              <WeightChart data={logs.slice(-20)} height={200} />
            </>
          ) : (
            <div className="text-center py-6">
              <div className="w-14 h-14 rounded-2xl bg-gold/10 flex items-center justify-center mx-auto mb-3">
                <Scale size={28} className="text-gold" />
              </div>
              <p className="text-sm text-slate mb-3">Log your first weight to start tracking</p>
              <Link to="/weight" className="inline-flex items-center gap-1.5 bg-gold text-dark text-sm font-semibold px-4 py-2 rounded-full hover:bg-gold-light transition-colors">
                <Scale size={14} /> Log weight
              </Link>
            </div>
          )}
        </div>

        {/* Subscription */}
        <div className="bg-dark-card rounded-[16px] border border-border p-6 hover:shadow-lg hover:border-gold/30 hover:-translate-y-0.5 transition-all duration-300">
          <div className="flex items-center justify-between mb-4">
            <h2 className="text-sm font-semibold text-slate uppercase tracking-wide">Your Treatment</h2>
            {subscription && (
              <Link to="/order" className="text-xs text-gold hover:underline flex items-center gap-1">
                Manage <ArrowRight size={12} />
              </Link>
            )}
          </div>

          {subLoading ? (
            <CardSkeleton />
          ) : subscription ? (
            <div className="space-y-3">
              <div className="flex items-center justify-between">
                <div>
                  <p className="text-lg font-bold text-ink">{treatment?.treatment} {treatment?.dose}</p>
                  <p className="text-sm text-slate">{formatPrice(subscription.price_monthly)}/month</p>
                </div>
                <StatusBadge status={subscription.status} />
              </div>
              {subscription.current_period_end && (
                <p className="text-xs text-slate">
                  Next payment: {new Date(subscription.current_period_end).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' })}
                </p>
              )}
              <div className="flex gap-2 pt-2">
                <Link to="/order" className="text-xs text-gold hover:underline">Change dose</Link>
                <span className="text-stone">·</span>
                <Link to="/order" className="text-xs text-slate hover:underline">Pause</Link>
              </div>
            </div>
          ) : (
            <div className="text-center py-4">
              <div className="w-14 h-14 rounded-2xl bg-emerald-500/10 flex items-center justify-center mx-auto mb-3">
                <Package size={28} className="text-emerald-400" />
              </div>
              <p className="text-sm text-slate mb-1">No active treatment yet</p>
              <p className="text-xs text-slate mb-4">Start your weight loss journey with clinician-led treatment</p>
              <a href="https://cal.com/dontweight/video-consultation" target="_blank" rel="noopener noreferrer" className="inline-flex items-center gap-2 bg-gold text-dark text-sm font-semibold px-5 py-2 rounded-full hover:bg-gold-light transition-colors">
                Book a video consultation <ArrowRight size={14} />
              </a>
            </div>
          )}
        </div>

        {/* Delivery tracker */}
        <div className="bg-dark-card rounded-[16px] border border-border p-6 hover:shadow-lg hover:border-gold/30 hover:-translate-y-0.5 transition-all duration-300">
          <div className="flex items-center justify-between mb-4">
            <h2 className="text-sm font-semibold text-slate uppercase tracking-wide">Latest Delivery</h2>
            {latestDelivery && (
              <StatusBadge status={latestDelivery.status} />
            )}
          </div>
          {deliveryLoading ? <CardSkeleton /> : latestDelivery ? (
            <DeliveryTracker delivery={latestDelivery} />
          ) : (
            <div className="text-center py-4">
              <div className="w-14 h-14 rounded-2xl bg-violet-500/10 flex items-center justify-center mx-auto mb-3">
                <Truck size={28} className="text-violet-400" />
              </div>
              <p className="text-sm text-slate">No deliveries yet</p>
              <p className="text-xs text-slate mt-1">Your first delivery arrives 2-3 working days after purchase</p>
            </div>
          )}
        </div>

        {/* Messages */}
        <div className="bg-dark-card rounded-[16px] border border-border p-6 hover:shadow-lg hover:border-gold/30 hover:-translate-y-0.5 transition-all duration-300">
          <div className="flex items-center justify-between mb-4">
            <h2 className="text-sm font-semibold text-slate uppercase tracking-wide">Messages</h2>
            {unreadCount > 0 && (
              <span className="bg-coral text-white text-[10px] font-bold px-2 py-0.5 rounded-full">
                {unreadCount} new
              </span>
            )}
          </div>
          <p className="text-sm text-slate mb-4">
            {unreadCount > 0
              ? `You have ${unreadCount} unread message${unreadCount > 1 ? 's' : ''} from your clinician.`
              : 'Your clinician typically responds within 2 hours.'}
          </p>
          <Link
            to="/messages"
            className="inline-flex items-center gap-2 bg-gold text-dark text-sm font-semibold px-5 py-2 rounded-full hover:bg-gold-light transition-colors"
          >
            <MessageSquare size={14} /> Send a message
          </Link>
        </div>
      </div>

      {/* Health checks promotion */}
      <div className="bg-gradient-to-r from-gold/10 to-emerald-500/10 border border-gold/20 rounded-[16px] p-6">
        <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div className="flex items-start gap-3">
            <div className="w-10 h-10 rounded-xl bg-emerald-500/15 flex items-center justify-center shrink-0">
              <HeartPulse size={20} className="text-emerald-400" />
            </div>
            <div>
              <h2 className="text-sm font-semibold text-ink">Comprehensive health checks</h2>
              <p className="text-xs text-slate mt-1">
                Monitor 30-50+ biomarkers including liver, kidney, thyroid, cholesterol, and cancer markers.
                Full ultrasound, ECG, and GP or consultant review included.
              </p>
              <p className="text-xs text-gold font-medium mt-1">Unique to Don't Weight - not available with other providers</p>
            </div>
          </div>
          <Link
            to="/health-checks"
            className="inline-flex items-center gap-2 bg-emerald-500 text-white text-sm font-semibold px-5 py-2.5 rounded-full hover:bg-emerald-400 transition-colors shrink-0"
          >
            <HeartPulse size={14} /> View packages
          </Link>
        </div>
      </div>

      {/* Quick actions */}
      <div className="grid grid-cols-2 md:grid-cols-5 gap-3">
        {[
          { to: '/video-calls', icon: Video, label: 'Book video call', color: 'text-gold' },
          { to: '/health-checks', icon: HeartPulse, label: 'Health checks', color: 'text-emerald-400' },
          { to: '/ai-assistant', icon: Bot, label: 'AI assistant', color: 'text-violet-400' },
          { to: '/photos', icon: Camera, label: 'Progress photos', color: 'text-amber-400' },
          { href: 'mailto:hello@dontweight.co.uk', icon: HelpCircle, label: 'Contact support', color: 'text-slate' },
        ].map((action) => {
          const Icon = action.icon
          const Wrapper = action.href ? 'a' : Link
          const props = action.href ? { href: action.href } : { to: action.to }
          return (
            <Wrapper
              key={action.label}
              {...props}
              className="group bg-dark-card rounded-[16px] border border-border p-4 flex flex-col items-center gap-2 hover:-translate-y-0.5 hover:shadow-lg hover:border-gold/30 transition-all duration-300 text-center"
            >
              <div className="w-10 h-10 rounded-xl bg-warm flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <Icon size={20} className={`${action.color} group-hover:brightness-125 transition-all duration-300`} />
              </div>
              <span className="text-xs font-medium text-ink">{action.label}</span>
            </Wrapper>
          )
        })}
      </div>

      {/* Money-back guarantee footer */}
      <div className="bg-dark-card rounded-[16px] border border-border p-5 text-center hover:shadow-lg hover:border-gold/30 hover:-translate-y-0.5 transition-all duration-300">
        <div className="flex items-center justify-center gap-2 mb-2">
          <Shield size={16} className="text-gold" />
          <h3 className="text-sm font-semibold text-ink">100% money-back guarantee</h3>
        </div>
        <p className="text-xs text-slate max-w-lg mx-auto">
          Not satisfied with your treatment within 14 days of your first delivery?
          We'll refund you in full, no questions asked. Your health and happiness are our priority.
        </p>
      </div>
    </div>
  )
}
