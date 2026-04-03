-- DON'T WEIGHT Portal — Supabase Schema
-- Run this in the Supabase SQL editor

-- Enable RLS
alter default privileges in schema public grant all on tables to postgres, anon, authenticated, service_role;

-- Profiles (extends auth.users)
create table if not exists profiles (
  id uuid references auth.users on delete cascade primary key,
  email text,
  first_name text,
  last_name text,
  phone text,
  date_of_birth date,
  role text default 'client' check (role in ('client', 'clinician')),
  avatar_url text,
  created_at timestamptz default now()
);

alter table profiles enable row level security;

create policy "Users can view own profile" on profiles for select using (auth.uid() = id);
create policy "Users can update own profile" on profiles for update using (auth.uid() = id);
create policy "Clinicians can view all profiles" on profiles for select using (
  exists (select 1 from profiles where id = auth.uid() and role = 'clinician')
);

-- Auto-create profile on signup
create or replace function handle_new_user()
returns trigger as $$
begin
  insert into public.profiles (id, email)
  values (new.id, new.email);
  return new;
end;
$$ language plpgsql security definer;

create or replace trigger on_auth_user_created
  after insert on auth.users
  for each row execute function handle_new_user();

-- Subscriptions
create table if not exists subscriptions (
  id uuid primary key default gen_random_uuid(),
  user_id uuid references profiles(id) on delete cascade,
  stripe_subscription_id text,
  stripe_customer_id text,
  treatment text,
  dose text,
  status text default 'active' check (status in ('active', 'paused', 'cancelled', 'past_due')),
  current_period_start timestamptz,
  current_period_end timestamptz,
  price_monthly integer,
  created_at timestamptz default now()
);

alter table subscriptions enable row level security;

create policy "Users can view own subscriptions" on subscriptions for select using (auth.uid() = user_id);
create policy "Clinicians can view all subscriptions" on subscriptions for select using (
  exists (select 1 from profiles where id = auth.uid() and role = 'clinician')
);

-- Weight logs
create table if not exists weight_logs (
  id uuid primary key default gen_random_uuid(),
  user_id uuid references profiles(id) on delete cascade,
  weight_kg numeric(5,1),
  logged_at timestamptz default now(),
  note text
);

alter table weight_logs enable row level security;

create policy "Users can view own weight logs" on weight_logs for select using (auth.uid() = user_id);
create policy "Users can insert own weight logs" on weight_logs for insert with check (auth.uid() = user_id);
create policy "Clinicians can view all weight logs" on weight_logs for select using (
  exists (select 1 from profiles where id = auth.uid() and role = 'clinician')
);

-- Progress photos
create table if not exists progress_photos (
  id uuid primary key default gen_random_uuid(),
  user_id uuid references profiles(id) on delete cascade,
  photo_url text,
  caption text,
  uploaded_at timestamptz default now()
);

alter table progress_photos enable row level security;

create policy "Users can view own photos" on progress_photos for select using (auth.uid() = user_id);
create policy "Users can upload own photos" on progress_photos for insert with check (auth.uid() = user_id);
create policy "Clinicians can view all photos" on progress_photos for select using (
  exists (select 1 from profiles where id = auth.uid() and role = 'clinician')
);

-- Messages
create table if not exists messages (
  id uuid primary key default gen_random_uuid(),
  user_id uuid references profiles(id) on delete cascade,
  sender_role text check (sender_role in ('client', 'clinician')),
  sender_name text,
  content text,
  is_read boolean default false,
  created_at timestamptz default now()
);

alter table messages enable row level security;

create policy "Users can view own messages" on messages for select using (auth.uid() = user_id);
create policy "Users can send messages" on messages for insert with check (auth.uid() = user_id);
create policy "Clinicians can view all messages" on messages for select using (
  exists (select 1 from profiles where id = auth.uid() and role = 'clinician')
);
create policy "Clinicians can insert messages" on messages for insert with check (
  exists (select 1 from profiles where id = auth.uid() and role = 'clinician')
);
create policy "Clinicians can update messages" on messages for update using (
  exists (select 1 from profiles where id = auth.uid() and role = 'clinician')
);

-- Enable realtime for messages
alter publication supabase_realtime add table messages;

-- Video call bookings
create table if not exists video_calls (
  id uuid primary key default gen_random_uuid(),
  user_id uuid references profiles(id) on delete cascade,
  scheduled_at timestamptz,
  duration_minutes integer default 15,
  status text default 'scheduled' check (status in ('scheduled', 'completed', 'cancelled')),
  notes text,
  created_at timestamptz default now()
);

alter table video_calls enable row level security;

create policy "Users can view own video calls" on video_calls for select using (auth.uid() = user_id);
create policy "Users can book video calls" on video_calls for insert with check (auth.uid() = user_id);
create policy "Clinicians can view all video calls" on video_calls for select using (
  exists (select 1 from profiles where id = auth.uid() and role = 'clinician')
);

-- Health check bookings
create table if not exists health_check_bookings (
  id uuid primary key default gen_random_uuid(),
  user_id uuid references profiles(id) on delete cascade,
  package text check (package in ('baseline', 'standard', 'premium')),
  stripe_payment_id text,
  status text default 'booked' check (status in ('booked', 'completed', 'cancelled')),
  appointment_date date,
  created_at timestamptz default now()
);

alter table health_check_bookings enable row level security;

create policy "Users can view own health checks" on health_check_bookings for select using (auth.uid() = user_id);
create policy "Clinicians can view all health checks" on health_check_bookings for select using (
  exists (select 1 from profiles where id = auth.uid() and role = 'clinician')
);

-- Deliveries
create table if not exists deliveries (
  id uuid primary key default gen_random_uuid(),
  user_id uuid references profiles(id) on delete cascade,
  subscription_id uuid references subscriptions(id),
  tracking_number text,
  carrier text default 'Royal Mail',
  status text default 'order_received' check (status in ('processing', 'order_received', 'clinical_review', 'approved', 'with_pharmacy', 'dispatched', 'in_transit', 'delivered')),
  medication_name text,
  medication_details text,
  price_display text,
  estimated_delivery date,
  dispatched_at timestamptz,
  delivered_at timestamptz,
  created_at timestamptz default now()
);

alter table deliveries enable row level security;

create policy "Users can view own deliveries" on deliveries for select using (auth.uid() = user_id);
create policy "Clinicians can view all deliveries" on deliveries for select using (
  exists (select 1 from profiles where id = auth.uid() and role = 'clinician')
);
create policy "Clinicians can create deliveries" on deliveries for insert with check (
  exists (select 1 from profiles where id = auth.uid() and role = 'clinician')
);
create policy "Clinicians can update deliveries" on deliveries for update using (
  exists (select 1 from profiles where id = auth.uid() and role = 'clinician')
);

-- AI chat history
create table if not exists ai_chats (
  id uuid primary key default gen_random_uuid(),
  user_id uuid references profiles(id) on delete cascade,
  role text check (role in ('user', 'assistant')),
  content text,
  created_at timestamptz default now()
);

alter table ai_chats enable row level security;

create policy "Users can view own AI chats" on ai_chats for select using (auth.uid() = user_id);
create policy "Users can insert AI chats" on ai_chats for insert with check (auth.uid() = user_id);

-- Storage bucket for progress photos
insert into storage.buckets (id, name, public) values ('progress-photos', 'progress-photos', true)
on conflict (id) do nothing;

create policy "Users can upload own photos to storage" on storage.objects for insert
  with check (bucket_id = 'progress-photos' and (storage.foldername(name))[1] = auth.uid()::text);

create policy "Anyone can view progress photos" on storage.objects for select
  using (bucket_id = 'progress-photos');
