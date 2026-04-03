import { useState } from 'react'
import { Scale, Plus, Download, TrendingDown, Target, CalendarDays, ArrowDown, ArrowUp } from 'lucide-react'
import { useWeightLogs } from '../hooks/useWeightLogs'
import { useAuth } from '../hooks/useAuth'
import WeightChart from '../components/WeightChart'
import Modal from '../components/Modal'
import { CardSkeleton } from '../components/LoadingSpinner'

export default function Weight() {
  const { logs, stats, loading, addLog } = useWeightLogs()
  const { profile } = useAuth()
  const [showModal, setShowModal] = useState(false)
  const [weight, setWeight] = useState('')
  const [unit, setUnit] = useState('kg')
  const [note, setNote] = useState('')
  const [logDate, setLogDate] = useState(new Date().toISOString().split('T')[0])
  const [saving, setSaving] = useState(false)
  const [saveError, setSaveError] = useState('')

  function toKg(value, fromUnit) {
    if (fromUnit === 'kg') return parseFloat(value)
    const parts = value.split('.')
    const stone = parseFloat(parts[0]) || 0
    const lbs = parseFloat(parts[1]) || 0
    return parseFloat(((stone * 14 + lbs) / 2.20462).toFixed(1))
  }

  async function handleLog(e) {
    e.preventDefault()
    setSaving(true)
    setSaveError('')
    try {
      const kg = unit === 'kg' ? parseFloat(weight) : toKg(weight, 'stone')
      if (isNaN(kg) || kg < 20 || kg > 500) {
        setSaveError('Please enter a valid weight.')
        setSaving(false)
        return
      }
      await addLog(kg, note, logDate)
      setShowModal(false)
      setWeight('')
      setNote('')
      setLogDate(new Date().toISOString().split('T')[0])
    } catch (err) {
      setSaveError(err.message || 'Failed to save. Please try again.')
    }
    setSaving(false)
  }

  function exportCSV() {
    const headers = 'Date,Weight (kg),Note\n'
    const rows = logs.map((l) =>
      `${new Date(l.logged_at).toLocaleDateString('en-GB')},${l.weight_kg},${l.note || ''}`
    ).join('\n')
    const blob = new Blob([headers + rows], { type: 'text/csv' })
    const url = URL.createObjectURL(blob)
    const a = document.createElement('a')
    a.href = url
    a.download = 'weight-log.csv'
    a.click()
    URL.revokeObjectURL(url)
  }

  const heightCm = profile?.height_cm
  const heightM = heightCm ? heightCm / 100 : null
  const bmi = stats.current && heightM
    ? (stats.current / (heightM * heightM)).toFixed(1)
    : null

  return (
    <div className="max-w-4xl mx-auto space-y-6 animate-fade-in">
      <div className="flex items-center justify-between">
        <h1 className="text-2xl font-bold text-ink tracking-tight">Weight Tracker</h1>
        <div className="flex gap-2">
          {logs.length > 0 && (
            <button onClick={exportCSV} className="flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-slate border border-border rounded-full hover:bg-warm transition-colors">
              <Download size={14} /> Export CSV
            </button>
          )}
          <button
            onClick={() => setShowModal(true)}
            className="flex items-center gap-1.5 bg-gold text-dark px-4 py-2 text-sm font-semibold rounded-full hover:bg-gold-light transition-colors"
          >
            <Plus size={14} /> Log weight
          </button>
        </div>
      </div>

      {/* Stats row */}
      {loading ? (
        <div className="grid grid-cols-2 md:grid-cols-5 gap-3">
          {Array.from({ length: 5 }).map((_, i) => <CardSkeleton key={i} />)}
        </div>
      ) : stats.current ? (
        <div className="grid grid-cols-2 md:grid-cols-5 gap-3">
          {[
            { label: 'Starting', value: `${stats.starting} kg`, icon: CalendarDays },
            { label: 'Current', value: `${stats.current} kg`, icon: Scale },
            { label: 'Total lost', value: stats.totalLost ? `${stats.totalLost} kg` : '--', highlight: true, icon: TrendingDown },
            { label: 'BMI (est.)', value: bmi || '--', icon: Target },
            { label: 'Entries', value: stats.entries, icon: Plus },
          ].map((stat) => {
            const StatIcon = stat.icon
            return (
              <div key={stat.label} className="bg-dark-card rounded-[16px] border border-border p-4 hover:shadow-lg hover:border-gold/30 hover:-translate-y-0.5 transition-all duration-300">
                <div className="flex items-center gap-1.5 mb-1">
                  <StatIcon size={10} className="text-slate" />
                  <p className="text-[10px] font-semibold text-slate uppercase tracking-wide">{stat.label}</p>
                </div>
                <p className={`text-xl font-bold ${stat.highlight ? 'text-emerald-400' : 'text-ink'}`}>{stat.value}</p>
                {stat.label === 'Total lost' && stats.totalLost > 0 && stats.starting && (
                  <p className="text-[10px] text-emerald-400 mt-0.5">
                    {((stats.totalLost / stats.starting) * 100).toFixed(1)}% of starting weight
                  </p>
                )}
              </div>
            )
          })}
        </div>
      ) : (
        <div className="bg-dark-card rounded-[16px] border border-border p-8 text-center">
          <div className="w-12 h-12 rounded-full bg-warm flex items-center justify-center mx-auto mb-3">
            <Scale size={22} className="text-slate" />
          </div>
          <p className="text-sm font-medium text-ink mb-1">Start tracking your weight</p>
          <p className="text-xs text-slate max-w-xs mx-auto mb-4">Log your first weigh-in to see your progress chart, stats, and trends over time.</p>
          <button
            onClick={() => setShowModal(true)}
            className="inline-flex items-center gap-1.5 bg-gold text-dark px-5 py-2.5 text-sm font-semibold rounded-full hover:bg-gold-light transition-colors"
          >
            <Plus size={14} /> Log your first weight
          </button>
        </div>
      )}

      {/* Chart */}
      <div className="bg-dark-card rounded-[16px] border border-border p-6 hover:shadow-lg hover:border-gold/30 transition-all duration-300">
        <h2 className="text-sm font-semibold text-slate uppercase tracking-wide mb-4">Progress</h2>
        {loading ? <CardSkeleton /> : <WeightChart data={logs} height={350} />}
      </div>

      {/* History table */}
      {logs.length > 0 && (
        <div className="bg-dark-card rounded-[16px] border border-border overflow-hidden">
          <div className="p-4 border-b border-border">
            <h2 className="text-sm font-semibold text-slate uppercase tracking-wide">All Entries</h2>
          </div>
          <div className="overflow-x-auto max-h-[500px] overflow-y-auto">
            <table className="w-full text-sm">
              <thead className="bg-warm sticky top-0 z-10">
                <tr>
                  <th className="text-left px-4 py-3 text-xs font-semibold text-slate uppercase tracking-wide">Date</th>
                  <th className="text-left px-4 py-3 text-xs font-semibold text-slate uppercase tracking-wide">Weight</th>
                  <th className="text-left px-4 py-3 text-xs font-semibold text-slate uppercase tracking-wide">Change</th>
                  <th className="text-left px-4 py-3 text-xs font-semibold text-slate uppercase tracking-wide">Note</th>
                </tr>
              </thead>
              <tbody>
                {[...logs].reverse().map((log, i, arr) => {
                  const prev = arr[i + 1]
                  const change = prev ? (log.weight_kg - prev.weight_kg).toFixed(1) : null
                  return (
                    <tr key={log.id} className="border-t border-border/50 hover:bg-warm/50">
                      <td className="px-4 py-3 text-ink">
                        {new Date(log.logged_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })}
                      </td>
                      <td className="px-4 py-3 font-medium text-ink">{log.weight_kg} kg</td>
                      <td className="px-4 py-3">
                        {change && (
                          <span className={`inline-flex items-center gap-1 font-medium ${Number(change) <= 0 ? 'text-emerald-400' : 'text-red-400'}`}>
                            {Number(change) <= 0 ? <ArrowDown size={12} className="text-emerald-400" /> : <ArrowUp size={12} className="text-red-400" />}
                            {Number(change) > 0 ? '+' : ''}{change} kg
                          </span>
                        )}
                      </td>
                      <td className="px-4 py-3 text-slate">{log.note || '--'}</td>
                    </tr>
                  )
                })}
              </tbody>
            </table>
          </div>
        </div>
      )}

      {/* Log weight modal */}
      <Modal open={showModal} onClose={() => setShowModal(false)} title="Log your weight">
        <form onSubmit={handleLog} className="space-y-4">
          {saveError && (
            <div className="bg-red-500/10 border border-red-500/30 text-red-400 text-sm rounded-xl p-3">
              {saveError}
            </div>
          )}

          <div className="flex gap-2 mb-4">
            {['kg', 'stone'].map((u) => (
              <button
                key={u}
                type="button"
                onClick={() => setUnit(u)}
                className={`px-4 py-1.5 rounded-full text-sm font-medium transition-all duration-300 ${
                  unit === u ? 'bg-gold text-dark shadow-md shadow-gold/20 scale-105' : 'bg-warm text-slate hover:bg-warm/80'
                }`}
              >
                {u === 'kg' ? 'Kilograms' : 'Stone & lbs'}
              </button>
            ))}
          </div>

          <div>
            <label htmlFor="weight-date" className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">Date</label>
            <input
              id="weight-date"
              type="date"
              value={logDate}
              onChange={(e) => setLogDate(e.target.value)}
              max={new Date().toISOString().split('T')[0]}
              className="w-full px-4 py-2.5 bg-dark border border-border rounded-xl text-sm text-ink focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold/20"
            />
          </div>

          <div>
            <label htmlFor="weight-input" className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">
              {unit === 'kg' ? 'Weight (kg)' : 'Weight (stone.lbs)'}
            </label>
            <input
              id="weight-input"
              type="number"
              step="0.1"
              value={weight}
              onChange={(e) => setWeight(e.target.value)}
              required
              autoFocus
              placeholder={unit === 'kg' ? '85.0' : '12.7'}
              className="w-full px-4 py-2.5 bg-dark border border-border rounded-xl text-sm text-ink focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold/20"
            />
            {unit === 'stone' && (
              <p className="text-[11px] text-slate mt-1">Enter as stone.lbs, e.g. 12.7 means 12 stone 7 lbs</p>
            )}
          </div>

          <div>
            <label htmlFor="weight-note" className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">
              Note (optional)
            </label>
            <input
              id="weight-note"
              type="text"
              value={note}
              onChange={(e) => setNote(e.target.value)}
              maxLength={120}
              placeholder="e.g. After breakfast, before gym"
              className="w-full px-4 py-2.5 bg-dark border border-border rounded-xl text-sm text-ink focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold/20"
            />
          </div>

          <button
            type="submit"
            disabled={saving}
            className="w-full bg-gold text-dark font-semibold py-2.5 rounded-full hover:bg-gold-light transition-colors disabled:opacity-60"
          >
            {saving ? 'Saving...' : 'Save weight'}
          </button>
        </form>
      </Modal>
    </div>
  )
}
