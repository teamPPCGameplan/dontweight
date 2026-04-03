-- Migration: Enhanced delivery pipeline with 5-step order tracking
-- Run this on your Supabase SQL editor

-- 1. Drop old check constraint and add expanded one
ALTER TABLE deliveries DROP CONSTRAINT IF EXISTS deliveries_status_check;
ALTER TABLE deliveries ADD CONSTRAINT deliveries_status_check
  CHECK (status IN ('processing', 'order_received', 'clinical_review', 'approved', 'with_pharmacy', 'dispatched', 'in_transit', 'delivered'));

-- 2. Add new columns for medication info
ALTER TABLE deliveries ADD COLUMN IF NOT EXISTS medication_name text;
ALTER TABLE deliveries ADD COLUMN IF NOT EXISTS medication_details text;
ALTER TABLE deliveries ADD COLUMN IF NOT EXISTS price_display text;

-- 3. Update default status
ALTER TABLE deliveries ALTER COLUMN status SET DEFAULT 'order_received';

-- 4. Migrate existing 'processing' records to 'order_received'
UPDATE deliveries SET status = 'order_received' WHERE status = 'processing';

-- 5. Add clinician insert/update policies (if they don't exist)
DO $$
BEGIN
  IF NOT EXISTS (
    SELECT 1 FROM pg_policies WHERE tablename = 'deliveries' AND policyname = 'Clinicians can create deliveries'
  ) THEN
    CREATE POLICY "Clinicians can create deliveries" ON deliveries FOR INSERT WITH CHECK (
      EXISTS (SELECT 1 FROM profiles WHERE id = auth.uid() AND role = 'clinician')
    );
  END IF;

  IF NOT EXISTS (
    SELECT 1 FROM pg_policies WHERE tablename = 'deliveries' AND policyname = 'Clinicians can update deliveries'
  ) THEN
    CREATE POLICY "Clinicians can update deliveries" ON deliveries FOR UPDATE USING (
      EXISTS (SELECT 1 FROM profiles WHERE id = auth.uid() AND role = 'clinician')
    );
  END IF;
END $$;
