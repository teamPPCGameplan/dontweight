import { useState, useEffect } from 'react'
import { Link } from 'react-router-dom'
import { Users, MessageSquare, AlertTriangle, ArrowRight, CreditCard } from 'lucide-react'
import { supabase } from '../../lib/supabase'
import { CardSkeleton } from '../../components/LoadingSpinner'
import StatusBadge from '../../components/StatusBadge'

export default function ClinicianDashboard() {
  const [stats, setStats] = useState(null)
  const [recentActivity, setRecentActivity] = useState([])
  const [recentSubs, setRecentSubs] = useState([])
  const [loading, setLoading] = useState(true)

  useEffect(() => { fetchData() }, [])

  async function fetchData() {
    setLoading(true)

    const [
      { count: totalPatients },
      { count: unreadMessages },
      { count: activeSubscriptions },
      { count: pendingIdReviews },
      { data: recentSubsData }
    ] = await Promise.all([
      supabase.from('profiles').select('*', { count: 'exact', head: true }).eq('role', 'client'),
      supabase.from('messages').select('*', { count: 'exact', head: true }).eq('sender_role', 'client').eq('is_read', false),
      supabase.from('subscriptions').select('*', { count: 'exact', head: true }).eq('status', 'active'),
      supabase.from('identity_documents').select('*', { count: 'exact', head: true }).eq('status', 'pending'),
      supabase.from('subscriptions').select('*, profiles!subscriptions_user_id_fkey(first_name, last_name, email)').eq('status', 'active').order('created_at', { ascending: false }).limit(5),
    ])

    setStats({
      totalPatients: totalPatients || 0,
      unreadMessages: unreadMessages || 0,
      activeSubscriptions: activeSubscriptions || 0,
      pendingIdReviews: pendingIdReviews || 0,
    })
    setRecentSubs(recentSubsData || [])

    const { data: recent } = await supabase
      .from('messages')
      .select('*, profiles!messages_user_id_fkey(first_name, last_name)')
      .eq('sender_role', 'client')
      .order('created_at', { ascending: false })
      .limit(10)
    setRecentActivity(recent || [])
    setLoading(false)
  }

  return (
    <div className="max-w-6xl mx-auto space-y-6 animate-fade-in">
      <h1 className="text-2xl font-bold text-ink tracking-tight">Clinician Dashboard</h1>

      {/* Stats */}
      {loading ? (
        <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
          {Array.from({ length: 4 }).map((_, i) => <CardSkeleton key={i} />)}
        </div>
      ) : (
        <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <div className="bg-dark-card rounded-[16px] border border-border p-6">
            <Users size={20} className="text-gold mb-2" />
            <p className="text-3xl font-bold text-ink">{stats?.totalPatients}</p>
            <p className="text-xs text-slate uppercase tracking-wide font-semibold mt-1">Active patients</p>
          </div>
          <div className="bg-dark-card rounded-[16px] border border-border p-6">
            <MessageSquare size={20} className="text-coral mb-2" />
            <p className="text-3xl font-bold text-ink">{stats?.unreadMessages}</p>
            <p className="text-xs text-slate uppercase tracking-wide font-semibold mt-1">Unread messages</p>
          </div>
          <div className="bg-dark-card rounded-[16px] border border-border p-6">
            <CreditCard size={20} className="text-emerald-400 mb-2" />
            <p className="text-3xl font-bold text-ink">{stats?.activeSubscriptions}</p>
            <p className="text-xs text-slate uppercase tracking-wide font-semibold mt-1">Active treatments</p>
          </div>
          <div className="bg-dark-card rounded-[16px] border border-border p-6">
            <AlertTriangle size={20} className="text-amber-500 mb-2" />
            <p className="text-3xl font-bold text-ink">{stats?.pendingIdReviews}</p>
            <p className="text-xs text-slate uppercase tracking-wide font-semibold mt-1">Pending ID reviews</p>
          </div>
        </div>
      )}

      {/* Quick links */}
      <div className="flex gap-3">
        <Link to="/clinician/patients" className="flex items-center gap-2 bg-gold text-dark px-5 py-2.5 text-sm font-semibold rounded-full hover:bg-gold-light transition-colors">
          <Users size={14} /> View all patients
        </Link>
        <Link to="/clinician/messages" className="flex items-center gap-2 border border-border text-ink px-5 py-2.5 text-sm font-medium rounded-full hover:bg-warm transition-colors">
          <MessageSquare size={14} /> Messages
        </Link>
      </div>

      {/* Recent subscribers */}
      {recentSubs?.length > 0 && (
        <div className="bg-dark-card rounded-[16px] border border-border overflow-hidden">
          <div className="p-4 border-b border-border">
            <h2 className="text-sm font-semibold text-slate uppercase tracking-wide">Recent patients</h2>
          </div>
          <div className="divide-y divide-border/50">
            {recentSubs.map((sub) => (
              <Link key={sub.id} to={`/clinician/patients/${sub.user_id}`} className="flex items-center justify-between p-4 hover:bg-warm/50 transition-colors">
                <div>
                  <p className="text-sm font-medium text-ink">
                    {sub.profiles?.first_name} {sub.profiles?.last_name}
                  </p>
                  <p className="text-xs text-slate">{sub.treatment} — {sub.dose}</p>
                </div>
                <div className="text-right">
                  <StatusBadge status={sub.status} />
                  <p className="text-[10px] text-slate mt-1">
                    {new Date(sub.created_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'short' })}
                  </p>
                </div>
              </Link>
            ))}
          </div>
        </div>
      )}

      {/* Recent activity */}
      <div className="bg-dark-card rounded-[16px] border border-border overflow-hidden">
        <div className="p-4 border-b border-border flex items-center justify-between">
          <h2 className="text-sm font-semibold text-slate uppercase tracking-wide">Recent patient messages</h2>
          <Link to="/clinician/messages" className="text-xs text-gold hover:underline flex items-center gap-1">
            View all <ArrowRight size={12} />
          </Link>
        </div>
        <div className="divide-y divide-border/50">
          {recentActivity.map((msg) => (
            <Link key={msg.id} to={`/clinician/patients/${msg.user_id}`} className="flex items-center justify-between p-4 hover:bg-warm/50 transition-colors">
              <div>
                <p className="text-sm font-medium text-ink">
                  {msg.profiles?.first_name} {msg.profiles?.last_name}
                </p>
                <p className="text-xs text-slate truncate max-w-md">{msg.content}</p>
              </div>
              <span className="text-[10px] text-slate">
                {new Date(msg.created_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'short' })}
              </span>
            </Link>
          ))}
          {recentActivity.length === 0 && !loading && (
            <p className="p-4 text-sm text-slate">No recent messages.</p>
          )}
        </div>
      </div>
    </div>
  )
}
