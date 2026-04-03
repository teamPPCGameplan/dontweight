import { useState, useEffect } from 'react'
import { supabase } from '../lib/supabase'
import { useAuth } from './useAuth'

export function useDeliveries() {
  const { user } = useAuth()
  const [deliveries, setDeliveries] = useState([])
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    if (!user) return
    fetchDeliveries()
  }, [user])

  async function fetchDeliveries() {
    setLoading(true)
    const { data } = await supabase
      .from('deliveries')
      .select('*')
      .eq('user_id', user.id)
      .order('created_at', { ascending: false })
    setDeliveries(data || [])
    setLoading(false)
  }

  const latest = deliveries[0] || null

  return { deliveries, latest, loading, refetch: fetchDeliveries }
}
