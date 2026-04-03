import { useState, useEffect } from 'react'
import { Link } from 'react-router-dom'
import { Search } from 'lucide-react'
import { supabase } from '../../lib/supabase'
import { getTreatmentInfo } from '../../data/treatments'
import StatusBadge from '../../components/StatusBadge'
import { Skeleton } from '../../components/LoadingSpinner'

export default function PatientList() {
  const [patients, setPatients] = useState([])
  const [loading, setLoading] = useState(true)
  const [search, setSearch] = useState('')
  const [filterStatus, setFilterStatus] = useState('all')

  useEffect(() => { fetchPatients() }, [])

  async function fetchPatients() {
    setLoading(true)
    const { data: profiles } = await supabase
      .from('profiles')
      .select('*, subscriptions(*)')
      .eq('role', 'client')
      .order('created_at', { ascending: false })
    setPatients(profiles || [])
    setLoading(false)
  }

  const filtered = patients.filter((p) => {
    const matchSearch = !search || `${p.first_name} ${p.last_name} ${p.email}`.toLowerCase().includes(search.toLowerCase())
    const sub = p.subscriptions?.[0]
    const matchStatus = filterStatus === 'all' || sub?.status === filterStatus
    return matchSearch && matchStatus
  })

  return (
    <div className="max-w-6xl mx-auto space-y-6 animate-fade-in">
      <h1 className="text-2xl font-bold text-ink tracking-tight">Patients</h1>

      {/* Filters */}
      <div className="flex flex-col sm:flex-row gap-3">
        <div className="relative flex-1">
          <Search size={16} className="absolute left-3 top-1/2 -translate-y-1/2 text-slate" />
          <input
            type="text"
            value={search}
            onChange={(e) => setSearch(e.target.value)}
            placeholder="Search by name or email..."
            className="w-full pl-10 pr-4 py-2.5 border border-border rounded-xl text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/20 bg-dark text-ink"
          />
        </div>
        <select
          value={filterStatus}
          onChange={(e) => setFilterStatus(e.target.value)}
          className="px-4 py-2.5 border border-border rounded-xl text-sm bg-dark-card text-ink focus:outline-none focus:border-gold"
        >
          <option value="all">All statuses</option>
          <option value="active">Active</option>
          <option value="paused">Paused</option>
          <option value="cancelled">Cancelled</option>
        </select>
      </div>

      {/* Table */}
      <div className="bg-dark-card rounded-[16px] border border-border overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead className="bg-warm">
              <tr>
                <th className="text-left px-4 py-3 text-xs font-semibold text-slate uppercase tracking-wide">Patient</th>
                <th className="text-left px-4 py-3 text-xs font-semibold text-slate uppercase tracking-wide">Treatment</th>
                <th className="text-left px-4 py-3 text-xs font-semibold text-slate uppercase tracking-wide">Status</th>
                <th className="text-left px-4 py-3 text-xs font-semibold text-slate uppercase tracking-wide">Joined</th>
              </tr>
            </thead>
            <tbody>
              {loading ? (
                Array.from({ length: 5 }).map((_, i) => (
                  <tr key={i} className="border-t border-border/50">
                    <td className="px-4 py-3"><Skeleton className="h-5 w-32" /></td>
                    <td className="px-4 py-3"><Skeleton className="h-5 w-24" /></td>
                    <td className="px-4 py-3"><Skeleton className="h-5 w-16" /></td>
                    <td className="px-4 py-3"><Skeleton className="h-5 w-20" /></td>
                  </tr>
                ))
              ) : filtered.length === 0 ? (
                <tr><td colSpan="4" className="px-4 py-8 text-center text-slate">No patients found.</td></tr>
              ) : (
                filtered.map((p) => {
                  const sub = p.subscriptions?.[0]
                  const treatment = sub ? getTreatmentInfo(sub.treatment) : null
                  return (
                    <tr key={p.id} className="border-t border-border/50 hover:bg-warm/50 transition-colors">
                      <td className="px-4 py-3">
                        <Link to={`/clinician/patients/${p.id}`} className="hover:text-gold">
                          <p className="font-medium text-ink">{p.first_name} {p.last_name}</p>
                          <p className="text-xs text-slate">{p.email}</p>
                        </Link>
                      </td>
                      <td className="px-4 py-3 text-ink">
                        {treatment ? `${treatment.treatment} ${treatment.dose}` : '—'}
                      </td>
                      <td className="px-4 py-3">
                        {sub ? <StatusBadge status={sub.status} /> : <span className="text-xs text-slate">No plan</span>}
                      </td>
                      <td className="px-4 py-3 text-slate">
                        {new Date(p.created_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })}
                      </td>
                    </tr>
                  )
                })
              )}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  )
}
