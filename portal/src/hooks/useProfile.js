import { useState } from 'react'
import { supabase } from '../lib/supabase'
import { useAuth } from './useAuth'

export function useProfile() {
  const { user } = useAuth()
  const [saving, setSaving] = useState(false)

  async function updateProfile(updates) {
    if (!user) return
    setSaving(true)
    const { error } = await supabase
      .from('profiles')
      .update(updates)
      .eq('id', user.id)
    setSaving(false)
    if (error) throw error
  }

  async function updateEmail(newEmail) {
    const { error } = await supabase.auth.updateUser({ email: newEmail })
    if (error) throw error
  }

  async function updatePassword(newPassword) {
    const { error } = await supabase.auth.updateUser({ password: newPassword })
    if (error) throw error
  }

  return { updateProfile, updateEmail, updatePassword, saving }
}
