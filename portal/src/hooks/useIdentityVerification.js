import { useState, useEffect } from 'react'
import { supabase } from '../lib/supabase'
import { useAuth } from './useAuth'

export function useIdentityVerification() {
  const { user } = useAuth()
  const [document, setDocument] = useState(null)
  const [loading, setLoading] = useState(true)
  const [uploading, setUploading] = useState(false)
  const [error, setError] = useState('')

  useEffect(() => {
    if (user) fetchDocument()
  }, [user])

  async function fetchDocument() {
    setLoading(true)
    try {
      const { data, error: fetchErr } = await supabase
        .from('identity_documents')
        .select('*')
        .eq('user_id', user.id)
        .order('created_at', { ascending: false })
        .limit(1)
        .maybeSingle()
      if (fetchErr) throw fetchErr
      setDocument(data)
    } catch (err) {
      // Table may not exist yet — silently handle
    }
    setLoading(false)
  }

  async function uploadDocument(file, documentType) {
    setUploading(true)
    setError('')
    try {
      // Validate file
      const maxSize = 10 * 1024 * 1024 // 10MB
      if (file.size > maxSize) {
        throw new Error('File is too large. Maximum size is 10MB.')
      }
      const allowed = ['image/jpeg', 'image/png', 'image/webp', 'application/pdf']
      if (!allowed.includes(file.type)) {
        throw new Error('Please upload a JPG, PNG, or PDF file.')
      }

      // Upload to private bucket
      const ext = file.name.split('.').pop()
      const filePath = `${user.id}/${Date.now()}.${ext}`

      const { error: uploadErr } = await supabase.storage
        .from('identity-documents')
        .upload(filePath, file, { upsert: false })
      if (uploadErr) throw uploadErr

      // Create database record
      const { data, error: insertErr } = await supabase
        .from('identity_documents')
        .insert({
          user_id: user.id,
          document_type: documentType,
          file_path: filePath,
          status: 'pending',
        })
        .select()
        .single()
      if (insertErr) throw insertErr

      setDocument(data)
      return data
    } catch (err) {
      setError(err.message || 'Upload failed. Please try again.')
      throw err
    } finally {
      setUploading(false)
    }
  }

  const status = document?.status || 'not_uploaded'
  const isVerified = status === 'approved'
  const isPending = status === 'pending'
  const isRejected = status === 'rejected'
  const needsUpload = status === 'not_uploaded' || status === 'rejected'

  return {
    document,
    status,
    isVerified,
    isPending,
    isRejected,
    needsUpload,
    loading,
    uploading,
    error,
    uploadDocument,
    refetch: fetchDocument,
  }
}
