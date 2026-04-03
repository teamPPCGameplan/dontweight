-- ============================================================
-- Identity Verification for Don't Weight Portal
-- Run this in Supabase SQL Editor
-- ============================================================

-- 1. Create identity_documents table
CREATE TABLE IF NOT EXISTS identity_documents (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  user_id UUID REFERENCES auth.users(id) ON DELETE CASCADE NOT NULL,
  document_type TEXT NOT NULL CHECK (document_type IN ('passport', 'driving_licence')),
  file_path TEXT NOT NULL,
  status TEXT NOT NULL DEFAULT 'pending' CHECK (status IN ('pending', 'approved', 'rejected')),
  reviewed_by UUID REFERENCES auth.users(id),
  reviewed_at TIMESTAMPTZ,
  rejection_reason TEXT,
  created_at TIMESTAMPTZ DEFAULT NOW(),
  updated_at TIMESTAMPTZ DEFAULT NOW()
);

-- 2. Add id_verified flag to profiles
ALTER TABLE profiles ADD COLUMN IF NOT EXISTS id_verified BOOLEAN DEFAULT FALSE;
ALTER TABLE profiles ADD COLUMN IF NOT EXISTS id_verified_at TIMESTAMPTZ;

-- 3. Enable RLS
ALTER TABLE identity_documents ENABLE ROW LEVEL SECURITY;

-- 4. Patient can view their own documents
CREATE POLICY "Users can view own documents"
  ON identity_documents FOR SELECT
  TO authenticated
  USING (user_id = auth.uid());

-- 5. Patient can upload (insert) their own documents
CREATE POLICY "Users can upload own documents"
  ON identity_documents FOR INSERT
  TO authenticated
  WITH CHECK (user_id = auth.uid());

-- 6. Clinicians can view all documents (for review)
CREATE POLICY "Clinicians can view all documents"
  ON identity_documents FOR SELECT
  TO authenticated
  USING (is_clinician());

-- 7. Clinicians can update document status (approve/reject)
CREATE POLICY "Clinicians can review documents"
  ON identity_documents FOR UPDATE
  TO authenticated
  USING (is_clinician())
  WITH CHECK (is_clinician());

-- 8. Service role full access (for webhooks/functions)
CREATE POLICY "Service role full access on identity_documents"
  ON identity_documents FOR ALL
  TO service_role
  USING (true);

-- 9. Create private storage bucket for ID documents
INSERT INTO storage.buckets (id, name, public)
VALUES ('identity-documents', 'identity-documents', false)
ON CONFLICT (id) DO NOTHING;

-- 10. Storage policies - patients can upload to their own folder only
CREATE POLICY "Users can upload own ID"
  ON storage.objects FOR INSERT
  TO authenticated
  WITH CHECK (
    bucket_id = 'identity-documents' AND
    (storage.foldername(name))[1] = auth.uid()::text
  );

-- 11. Patients can view their own uploaded files
CREATE POLICY "Users can view own ID files"
  ON storage.objects FOR SELECT
  TO authenticated
  USING (
    bucket_id = 'identity-documents' AND
    (storage.foldername(name))[1] = auth.uid()::text
  );

-- 12. Clinicians can view all ID files (for review)
CREATE POLICY "Clinicians can view all ID files"
  ON storage.objects FOR SELECT
  TO authenticated
  USING (
    bucket_id = 'identity-documents' AND
    is_clinician()
  );

-- 13. Index for quick lookups
CREATE INDEX IF NOT EXISTS idx_identity_documents_user_id ON identity_documents(user_id);
CREATE INDEX IF NOT EXISTS idx_identity_documents_status ON identity_documents(status);
