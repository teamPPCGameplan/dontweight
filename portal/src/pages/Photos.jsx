import { useState, useEffect } from 'react'
import { Camera, Plus, Upload, AlertCircle } from 'lucide-react'
import { supabase } from '../lib/supabase'
import { useAuth } from '../hooks/useAuth'
import Modal from '../components/Modal'
import { Skeleton } from '../components/LoadingSpinner'

const MAX_FILE_SIZE = 10 * 1024 * 1024 // 10MB

export default function Photos() {
  const { user } = useAuth()
  const [photos, setPhotos] = useState([])
  const [loading, setLoading] = useState(true)
  const [showUpload, setShowUpload] = useState(false)
  const [uploading, setUploading] = useState(false)
  const [caption, setCaption] = useState('')
  const [uploadError, setUploadError] = useState('')

  useEffect(() => { fetchPhotos() }, [])

  async function fetchPhotos() {
    setLoading(true)
    try {
      const { data, error } = await supabase
        .from('progress_photos')
        .select('*')
        .eq('user_id', user.id)
        .order('uploaded_at', { ascending: false })
      if (error) throw error
      setPhotos(data || [])
    } catch (err) {
      // Silently handle - user sees empty state
    }
    setLoading(false)
  }

  async function handleUpload(e) {
    const file = e.target.files?.[0]
    if (!file) return

    if (file.size > MAX_FILE_SIZE) {
      setUploadError('File is too large. Please upload an image under 10MB.')
      return
    }

    if (!file.type.startsWith('image/')) {
      setUploadError('Please select a valid image file.')
      return
    }

    setUploading(true)
    setUploadError('')

    try {
      const fileName = `${user.id}/${Date.now()}-${file.name}`
      const { error: uploadError } = await supabase.storage
        .from('progress-photos')
        .upload(fileName, file)
      if (uploadError) throw uploadError

      const { data: { publicUrl } } = supabase.storage
        .from('progress-photos')
        .getPublicUrl(fileName)

      await supabase.from('progress_photos').insert({
        user_id: user.id,
        photo_url: publicUrl,
        caption,
      })

      setCaption('')
      setShowUpload(false)
      await fetchPhotos()
    } catch (err) {
      setUploadError('Upload failed. Please try again.')
    }
    setUploading(false)
  }

  return (
    <div className="max-w-4xl mx-auto space-y-6 animate-fade-in">
      <div className="flex items-center justify-between">
        <h1 className="text-2xl font-bold text-ink tracking-tight">Progress Photos</h1>
        <button
          onClick={() => setShowUpload(true)}
          className="flex items-center gap-1.5 bg-gold text-dark px-4 py-2 text-sm font-semibold rounded-full hover:bg-gold-light transition-colors"
        >
          <Plus size={14} /> Upload photo
        </button>
      </div>

      {/* Before/After comparison */}
      {photos.length >= 2 && (
        <div className="bg-dark-card rounded-[16px] border border-border p-6">
          <h2 className="text-sm font-semibold text-slate uppercase tracking-wide mb-4">Your journey</h2>
          <div className="grid grid-cols-2 gap-4">
            <div>
              <p className="text-xs font-medium text-slate mb-2">First photo</p>
              <img
                src={photos[photos.length - 1].photo_url}
                alt="Starting"
                className="w-full aspect-[3/4] object-cover rounded-xl"
                loading="lazy"
              />
              <p className="text-xs text-slate mt-1">
                {new Date(photos[photos.length - 1].uploaded_at).toLocaleDateString('en-GB')}
              </p>
            </div>
            <div>
              <p className="text-xs font-medium text-slate mb-2">Most recent</p>
              <img
                src={photos[0].photo_url}
                alt="Current"
                className="w-full aspect-[3/4] object-cover rounded-xl"
                loading="lazy"
              />
              <p className="text-xs text-slate mt-1">
                {new Date(photos[0].uploaded_at).toLocaleDateString('en-GB')}
              </p>
            </div>
          </div>
        </div>
      )}

      {/* Photo grid */}
      {loading ? (
        <div className="grid grid-cols-2 md:grid-cols-3 gap-4">
          {Array.from({ length: 6 }).map((_, i) => (
            <Skeleton key={i} className="aspect-square rounded-xl" />
          ))}
        </div>
      ) : photos.length === 0 ? (
        <div className="bg-dark-card rounded-[16px] border border-border p-12 text-center">
          <Camera size={40} className="text-stone mx-auto mb-3" />
          <p className="text-sm text-slate">No photos yet. Upload your first progress photo to track your transformation.</p>
        </div>
      ) : (
        <div className="grid grid-cols-2 md:grid-cols-3 gap-4">
          {photos.map((photo) => (
            <div key={photo.id} className="relative group">
              <img
                src={photo.photo_url}
                alt={photo.caption || 'Progress photo'}
                className="w-full aspect-square object-cover rounded-xl"
                loading="lazy"
              />
              <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent rounded-b-xl p-3">
                <p className="text-xs text-white">
                  {new Date(photo.uploaded_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })}
                </p>
                {photo.caption && <p className="text-xs text-white/80 mt-0.5">{photo.caption}</p>}
              </div>
            </div>
          ))}
        </div>
      )}

      {/* Upload modal */}
      <Modal open={showUpload} onClose={() => { setShowUpload(false); setUploadError('') }} title="Upload progress photo">
        <div className="space-y-4">
          {uploadError && (
            <div className="flex items-center gap-2 bg-red-500/10 border border-red-500/30 text-red-400 text-sm rounded-xl p-3">
              <AlertCircle size={14} className="shrink-0" />
              {uploadError}
            </div>
          )}
          <div>
            <label className="text-xs font-semibold text-slate uppercase tracking-wide block mb-1.5">Caption (optional)</label>
            <input
              type="text"
              value={caption}
              onChange={(e) => setCaption(e.target.value)}
              placeholder="e.g. Week 4 front view"
              className="w-full px-4 py-2.5 bg-dark border border-border rounded-xl text-sm text-ink focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold/20"
            />
          </div>
          <label className="flex flex-col items-center justify-center border-2 border-dashed border-border rounded-xl p-8 cursor-pointer hover:border-gold hover:bg-gold/5 transition-colors">
            <Upload size={24} className="text-slate mb-2" />
            <span className="text-sm text-slate">{uploading ? 'Uploading...' : 'Choose a photo'}</span>
            <span className="text-xs text-slate/60 mt-1">Max 10MB</span>
            <input type="file" accept="image/*" onChange={handleUpload} className="hidden" disabled={uploading} />
          </label>
        </div>
      </Modal>
    </div>
  )
}
