import { AreaChart, Area, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer } from 'recharts'

function CustomTooltip({ active, payload, label }) {
  if (!active || !payload?.length) return null
  return (
    <div className="bg-dark-card border border-border rounded-xl px-3 py-2 shadow-lg">
      <p className="text-xs text-slate">{label}</p>
      <p className="text-sm font-semibold text-gold">{payload[0].value} kg</p>
    </div>
  )
}

export default function WeightChart({ data, height = 280 }) {
  const chartData = data.map((log) => ({
    date: new Date(log.logged_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'short' }),
    weight: Number(log.weight_kg),
  }))

  if (!chartData.length) {
    return (
      <div className="flex items-center justify-center h-48 text-slate text-sm">
        No weight data yet. Log your first weigh-in to see your progress.
      </div>
    )
  }

  const weights = chartData.map((d) => d.weight)
  const min = Math.floor(Math.min(...weights) - 2)
  const max = Math.ceil(Math.max(...weights) + 2)

  return (
    <ResponsiveContainer width="100%" height={height}>
      <AreaChart data={chartData} margin={{ top: 8, right: 8, left: -16, bottom: 0 }}>
        <defs>
          <linearGradient id="goldGradient" x1="0" y1="0" x2="0" y2="1">
            <stop offset="5%" stopColor="#B4975A" stopOpacity={0.2} />
            <stop offset="95%" stopColor="#B4975A" stopOpacity={0} />
          </linearGradient>
        </defs>
        <CartesianGrid strokeDasharray="3 3" stroke="#2E2A25" strokeOpacity={0.5} />
        <XAxis dataKey="date" tick={{ fontSize: 11, fill: '#A8A29E' }} tickLine={false} axisLine={false} />
        <YAxis domain={[min, max]} tick={{ fontSize: 11, fill: '#A8A29E' }} tickLine={false} axisLine={false} />
        <Tooltip content={<CustomTooltip />} />
        <Area type="monotone" dataKey="weight" stroke="#B4975A" strokeWidth={2.5} fill="url(#goldGradient)" dot={{ fill: '#D4B87A', r: 3.5, strokeWidth: 0 }} activeDot={{ r: 5, fill: '#B4975A', strokeWidth: 2, stroke: '#1A1814' }} />
      </AreaChart>
    </ResponsiveContainer>
  )
}
