import { useState, useEffect } from 'react'
import { supabase } from '../lib/supabase'
import { useAuth } from './useAuth'

export function useWeightLogs() {
  const { user } = useAuth()
  const [logs, setLogs] = useState([])
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    if (!user) return
    fetchLogs()
  }, [user])

  async function fetchLogs() {
    setLoading(true)
    const { data } = await supabase
      .from('weight_logs')
      .select('*')
      .eq('user_id', user.id)
      .order('logged_at', { ascending: true })
    setLogs(data || [])
    setLoading(false)
  }

  async function addLog(weightKg, note = '', date = null) {
    const row = {
      user_id: user.id,
      weight_kg: weightKg,
      note,
    }
    if (date) {
      row.logged_at = new Date(date + 'T12:00:00').toISOString()
    }
    const { error } = await supabase.from('weight_logs').insert(row)
    if (error) throw error
    await fetchLogs()
  }

  const stats = {
    current: logs.length ? logs[logs.length - 1].weight_kg : null,
    starting: logs.length ? logs[0].weight_kg : null,
    totalLost: logs.length >= 2
      ? (logs[0].weight_kg - logs[logs.length - 1].weight_kg).toFixed(1)
      : null,
    entries: logs.length,
  }

  return { logs, loading, addLog, stats, refetch: fetchLogs }
}
