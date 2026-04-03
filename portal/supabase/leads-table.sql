-- DON'T WEIGHT — Leads table for retargeting campaigns
-- Run this in the Supabase SQL editor (https://supabase.com/dashboard/project/rcutpmafwgrckmmqpnrt/sql)

-- Leads table: captures contact info from questionnaire/consultation forms
-- for email retargeting campaigns (separate from authenticated portal users)
create table if not exists leads (
  id uuid primary key default gen_random_uuid(),
  first_name text,
  last_name text,
  email text not null,
  phone text,
  source text default 'website',  -- 'website', 'consultation', 'contact', 'start-page', 'portal'
  page_url text,                   -- which page they came from
  utm_source text,
  utm_medium text,
  utm_campaign text,
  questionnaire_data jsonb,        -- store any additional questionnaire answers
  consent_marketing boolean default false,
  consent_data_processing boolean default false,
  ip_address text,
  user_agent text,
  converted boolean default false, -- true when they become a paying customer
  converted_at timestamptz,
  created_at timestamptz default now()
);

-- Index for email lookups and deduplication
create unique index if not exists leads_email_unique on leads (lower(email));

-- Index for retargeting queries
create index if not exists leads_source_idx on leads (source);
create index if not exists leads_created_at_idx on leads (created_at desc);
create index if not exists leads_converted_idx on leads (converted);

-- RLS policies
alter table leads enable row level security;

-- Service role can do everything (used by Netlify functions)
create policy "Service role full access" on leads
  for all
  using (true)
  with check (true);

-- Clinicians can view all leads
create policy "Clinicians can view leads" on leads
  for select
  using (
    exists (select 1 from profiles where id = auth.uid() and role = 'clinician')
  );

-- Allow anonymous inserts (for the website form capture endpoint)
create policy "Anyone can insert leads" on leads
  for insert
  with check (true);
