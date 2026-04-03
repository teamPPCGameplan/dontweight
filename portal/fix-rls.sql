-- DON'T WEIGHT PORTAL - FIX RLS POLICIES
-- Run this ENTIRE script in one go in Supabase SQL Editor

-- Step 1: Create helper function
CREATE OR REPLACE FUNCTION is_clinician()
RETURNS boolean AS $$
  SELECT EXISTS (
    SELECT 1 FROM profiles WHERE id = auth.uid() AND role = 'clinician'
  );
$$ LANGUAGE sql SECURITY DEFINER STABLE;

-- Step 2: Drop ALL existing policies
DROP POLICY IF EXISTS "Users can view own profile" ON profiles;
DROP POLICY IF EXISTS "Users can update own profile" ON profiles;
DROP POLICY IF EXISTS "Clinicians can view all profiles" ON profiles;
DROP POLICY IF EXISTS "Users can view own subscriptions" ON subscriptions;
DROP POLICY IF EXISTS "Clinicians can view all subscriptions" ON subscriptions;
DROP POLICY IF EXISTS "Users can view own weight logs" ON weight_logs;
DROP POLICY IF EXISTS "Users can insert own weight logs" ON weight_logs;
DROP POLICY IF EXISTS "Users can delete own weight logs" ON weight_logs;
DROP POLICY IF EXISTS "Clinicians can view all weight logs" ON weight_logs;
DROP POLICY IF EXISTS "Users can view own photos" ON progress_photos;
DROP POLICY IF EXISTS "Users can upload own photos" ON progress_photos;
DROP POLICY IF EXISTS "Users can delete own photos" ON progress_photos;
DROP POLICY IF EXISTS "Clinicians can view all photos" ON progress_photos;
DROP POLICY IF EXISTS "Users can view own messages" ON messages;
DROP POLICY IF EXISTS "Users can send messages" ON messages;
DROP POLICY IF EXISTS "Users can update own messages" ON messages;
DROP POLICY IF EXISTS "Clinicians can view all messages" ON messages;
DROP POLICY IF EXISTS "Clinicians can insert messages" ON messages;
DROP POLICY IF EXISTS "Clinicians can update messages" ON messages;
DROP POLICY IF EXISTS "Users can view own video calls" ON video_calls;
DROP POLICY IF EXISTS "Users can book video calls" ON video_calls;
DROP POLICY IF EXISTS "Clinicians can view all video calls" ON video_calls;
DROP POLICY IF EXISTS "Users can view own health checks" ON health_check_bookings;
DROP POLICY IF EXISTS "Users can book health checks" ON health_check_bookings;
DROP POLICY IF EXISTS "Clinicians can view all health checks" ON health_check_bookings;
DROP POLICY IF EXISTS "Users can view own deliveries" ON deliveries;
DROP POLICY IF EXISTS "Clinicians can view all deliveries" ON deliveries;
DROP POLICY IF EXISTS "Users can view own AI chats" ON ai_chats;
DROP POLICY IF EXISTS "Users can insert AI chats" ON ai_chats;

-- Step 3: Recreate all policies properly
CREATE POLICY "Users can view own profile" ON profiles FOR SELECT USING (auth.uid() = id);
CREATE POLICY "Users can update own profile" ON profiles FOR UPDATE USING (auth.uid() = id);
CREATE POLICY "Clinicians can view all profiles" ON profiles FOR SELECT USING (is_clinician());
CREATE POLICY "Users can view own subscriptions" ON subscriptions FOR SELECT USING (auth.uid() = user_id);
CREATE POLICY "Clinicians can view all subscriptions" ON subscriptions FOR SELECT USING (is_clinician());
CREATE POLICY "Users can view own weight logs" ON weight_logs FOR SELECT USING (auth.uid() = user_id);
CREATE POLICY "Users can insert own weight logs" ON weight_logs FOR INSERT WITH CHECK (auth.uid() = user_id);
CREATE POLICY "Users can delete own weight logs" ON weight_logs FOR DELETE USING (auth.uid() = user_id);
CREATE POLICY "Clinicians can view all weight logs" ON weight_logs FOR SELECT USING (is_clinician());
CREATE POLICY "Users can view own photos" ON progress_photos FOR SELECT USING (auth.uid() = user_id);
CREATE POLICY "Users can upload own photos" ON progress_photos FOR INSERT WITH CHECK (auth.uid() = user_id);
CREATE POLICY "Users can delete own photos" ON progress_photos FOR DELETE USING (auth.uid() = user_id);
CREATE POLICY "Clinicians can view all photos" ON progress_photos FOR SELECT USING (is_clinician());
CREATE POLICY "Users can view own messages" ON messages FOR SELECT USING (auth.uid() = user_id);
CREATE POLICY "Users can send messages" ON messages FOR INSERT WITH CHECK (auth.uid() = user_id);
CREATE POLICY "Users can update own messages" ON messages FOR UPDATE USING (auth.uid() = user_id);
CREATE POLICY "Clinicians can view all messages" ON messages FOR SELECT USING (is_clinician());
CREATE POLICY "Clinicians can insert messages" ON messages FOR INSERT WITH CHECK (is_clinician());
CREATE POLICY "Clinicians can update messages" ON messages FOR UPDATE USING (is_clinician());
CREATE POLICY "Users can view own video calls" ON video_calls FOR SELECT USING (auth.uid() = user_id);
CREATE POLICY "Users can book video calls" ON video_calls FOR INSERT WITH CHECK (auth.uid() = user_id);
CREATE POLICY "Clinicians can view all video calls" ON video_calls FOR SELECT USING (is_clinician());
CREATE POLICY "Users can view own health checks" ON health_check_bookings FOR SELECT USING (auth.uid() = user_id);
CREATE POLICY "Users can book health checks" ON health_check_bookings FOR INSERT WITH CHECK (auth.uid() = user_id);
CREATE POLICY "Clinicians can view all health checks" ON health_check_bookings FOR SELECT USING (is_clinician());
CREATE POLICY "Users can view own deliveries" ON deliveries FOR SELECT USING (auth.uid() = user_id);
CREATE POLICY "Clinicians can view all deliveries" ON deliveries FOR SELECT USING (is_clinician());
CREATE POLICY "Users can view own AI chats" ON ai_chats FOR SELECT USING (auth.uid() = user_id);
CREATE POLICY "Users can insert AI chats" ON ai_chats FOR INSERT WITH CHECK (auth.uid() = user_id);

-- Step 4: Storage policies
DROP POLICY IF EXISTS "Users can upload own photos to storage" ON storage.objects;
DROP POLICY IF EXISTS "Anyone can view progress photos" ON storage.objects;
DROP POLICY IF EXISTS "Users can upload photos" ON storage.objects;
DROP POLICY IF EXISTS "Users can view photos" ON storage.objects;
DROP POLICY IF EXISTS "Users can update own photos" ON storage.objects;

CREATE POLICY "Users can upload photos" ON storage.objects FOR INSERT
  WITH CHECK (bucket_id = 'progress-photos' AND auth.uid() IS NOT NULL);
CREATE POLICY "Users can view photos" ON storage.objects FOR SELECT
  USING (bucket_id = 'progress-photos');
CREATE POLICY "Users can update own photos" ON storage.objects FOR UPDATE
  USING (bucket_id = 'progress-photos' AND auth.uid() IS NOT NULL);
