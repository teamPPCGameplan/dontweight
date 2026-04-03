# Don't Weight — Full Project

UK's premier clinician-led weight loss clinic. Website + patient portal + database.

## Project Structure

```
dontweight/
├── website/          WordPress theme (dontweight-theme-v72)
├── portal/           React patient portal (Netlify)
├── database/         Supabase schema, migrations & email templates
└── docs/             Project documentation & handover notes
```

## Website (WordPress on Kinsta)
- **Live**: https://dontweight.co.uk
- **Admin**: https://dontweight.co.uk/wp-admin/
- **Hosting**: Kinsta (MyKinsta dashboard: my.kinsta.com)
- **Theme version**: 2.4.0 (baseline)
- **Theme folder**: dontweight-theme-v72

## Patient Portal (React on Netlify)
- **Live**: https://app.dontweight.co.uk
- **Stack**: React + Vite + Tailwind CSS + Supabase + Stripe
- **Deploy**: `cd portal && npm install && npx vite build && npx netlify deploy --prod --dir=dist`

## Database (Supabase)
- **Project**: https://supabase.com/dashboard/project/rcutpmafwgrckmmqpnrt
- **Schema**: See `database/schema.sql`
- **Email templates**: See `database/email-templates/`

## Deployment Notes
- Always pull live files from server before editing (never edit from stale local copies)
- Clear Kinsta Cache after WordPress theme changes
- Portal deploys to Netlify automatically or via CLI
- Version number in `website/style.css` tracks every change
