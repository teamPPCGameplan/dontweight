# Don't Weight - Complete System Guide

**Last updated:** April 2026
**Prepared for:** Don't Weight Ltd
**Document type:** Platform documentation for business owners and administrators

---

## Table of Contents

1. [System Overview](#1-system-overview)
2. [Access Credentials & Logins](#2-access-credentials--logins)
3. [Patient Journey Flow](#3-patient-journey-flow)
4. [Clinician Portal Guide](#4-clinician-portal-guide)
5. [Patient Portal Guide](#5-patient-portal-guide)
6. [WordPress Admin Guide](#6-wordpress-admin-guide)
7. [Database Structure (Supabase)](#7-database-structure-supabase)
8. [Payment Flow (Stripe)](#8-payment-flow-stripe)
9. [Deployment Guide](#9-deployment-guide)
10. [How to Create Accounts](#10-how-to-create-accounts)
11. [Ongoing Maintenance](#11-ongoing-maintenance)
12. [Tech Stack Summary](#12-tech-stack-summary)
13. [Cost Structure](#13-cost-structure)

---

## 1. System Overview

The Don't Weight platform is made up of several connected services that work together to deliver weight-loss treatment online. Here is how everything fits together:

```
 PATIENT VISITS WEBSITE
         |
         v
+------------------------------+         +----------------------------+
|                              |         |                            |
|   WORDPRESS WEBSITE          |         |   PATIENT PORTAL           |
|   dontweight.co.uk           |         |   app.dontweight.co.uk     |
|                              |         |                            |
|   Hosted on: Kinsta          |         |   Hosted on: Netlify       |
|                              |         |   Built with: React        |
|   - Homepage & quiz          |         |                            |
|   - Treatment pages          |         |   - Patient dashboard      |
|   - Consultation form        |         |   - Weight tracking        |
|   - Health check info        |         |   - Messaging              |
|   - Blog & content           |         |   - Delivery tracking      |
|   - Chatbot widget           |         |   - Clinician dashboard    |
|                              |         |   - Subscription mgmt      |
+--------+---------------------+         +-------------+--------------+
         |                                             |
         |  (payment)                                  |  (data)
         v                                             v
+------------------------------+         +----------------------------+
|                              |         |                            |
|   STRIPE                     |         |   SUPABASE                 |
|   Payment processing         |         |   Database & authentication|
|                              |         |                            |
|   - Checkout sessions        |         |   - User accounts          |
|   - Payment records          |         |   - Patient records        |
|   - Refunds                  |         |   - Messages               |
|                              |         |   - Deliveries             |
+------------------------------+         |   - Weight logs            |
                                         |   - Subscriptions          |
+------------------------------+         +----------------------------+
|                              |
|   GOOGLE WORKSPACE           |
|   Email & communication      |         +----------------------------+
|                              |         |                            |
|   - hello@dontweight.co.uk   |         |   SEMBLE                   |
|   - support@dontweight.co.uk |         |   Health check bookings    |
|   - pharmacy@dontweight.co.uk|         |                            |
|                              |         |   - Baseline health check  |
+------------------------------+         |   - Standard health check  |
                                         |   - Premium health check   |
                                         +----------------------------+
```

**How the pieces connect:**

- The **WordPress website** is the public-facing site where patients learn about treatments and apply.
- When a patient pays, **Stripe** processes the payment and notifies WordPress via a "webhook" (an automatic message between systems).
- Once approved, the patient gets access to the **Patient Portal**, which is a separate web application.
- The portal reads and writes all its data to **Supabase** (the database).
- **Google Workspace** handles all email communication.
- **Semble** handles health check appointment bookings.
- The **chatbot widget** is served from the portal (app.dontweight.co.uk/chatbot-widget.js) and embedded on the main website.

---

## 2. Access Credentials & Logins

Below is every platform you need to manage Don't Weight. **Passwords are not listed here for security reasons.** Use your existing credentials or contact the account owner for access.

| Platform | What It Does | Login URL |
|---|---|---|
| **Kinsta** | WordPress hosting, server management, backups, cache | https://my.kinsta.com |
| **WordPress Admin** | Website content, pages, patient applications, forms | https://dontweight.co.uk/wp-admin/ |
| **Supabase** | Database, user authentication, real-time features | https://supabase.com/dashboard/project/rcutpmafwgrckmmqpnrt |
| **Netlify** | Portal hosting, deployments, domain settings | https://app.netlify.com |
| **Stripe** | Payments, checkout, refunds | https://dashboard.stripe.com |
| **Google Workspace** | Email accounts | https://admin.google.com |
| **Semble** | Health check appointment booking | https://app.semble.io |
| **Domain Registrar** | DNS settings, domain renewal | Check with account owner |

**Email accounts managed via Google Workspace:**
- `hello@dontweight.co.uk` - Main contact and notifications
- `support@dontweight.co.uk` - Patient support
- `pharmacy@dontweight.co.uk` - Pharmacy communications

> **Note:** Keep a secure, separate record of all passwords (e.g., in a password manager like 1Password or LastPass). Never store passwords in this document or in plain text files.

---

## 3. Patient Journey Flow

This is the complete path a patient follows from first visit to receiving treatment:

```
    STEP 1: DISCOVERY
    Patient visits dontweight.co.uk
              |
              v
    STEP 2: ELIGIBILITY QUIZ
    Takes BMI check + medical screening on homepage
              |
         +----+----+
         |         |
    NOT ELIGIBLE   ELIGIBLE
    (shown advice) |
                   v
    STEP 3: CONSULTATION FORM
    Redirected to /consultation/ page
              |
              v
    STEP 4: MEDICAL HISTORY
    Fills in:
    - Personal details (name, DOB, address)
    - Medical history & conditions
    - Current medications & allergies
    - Selects treatment (Mounjaro or Wegovy)
              |
              v
    STEP 5: PAYMENT
    Pays via Stripe checkout
    (secure card payment page)
              |
              v
    STEP 6: APPLICATION SAVED
    - Saved as "dw_application" in WordPress
    - Email sent to hello@dontweight.co.uk
    - Confirmation email sent to patient
              |
              v
    STEP 7: CLINICAL REVIEW
    Clinician reviews the application
    Checks medical history & suitability
              |
              v
    STEP 8: VIDEO CONSULTATION
    Video call arranged with clinician
    Identity verified during call
              |
              v
    STEP 9: PORTAL ACCESS
    Patient gets login for app.dontweight.co.uk
    Can track treatment, message clinician
              |
              v
    STEP 10: TREATMENT DISPATCHED
    Medication sent via pharmacy
    Patient tracks delivery in portal:

    Order Received --> Clinical Review --> Approved
         --> With Pharmacy --> Dispatched --> Delivered
```

---

## 4. Clinician Portal Guide

The clinician portal is where clinical staff manage patients, review applications, and handle treatment delivery.

### Logging In

1. Go to **app.dontweight.co.uk/login**
2. Log in with your clinician email (e.g., clinician@dontweight.co.uk)
3. The system automatically detects your clinician role and shows the clinician dashboard

### Dashboard Overview

When you log in, you will see:
- **Key statistics** - Total patients, unread messages, pending deliveries
- **Recent patients** - Quick access to recently active patients
- **Unread messages** - Messages that need your attention

### Patient List

- View all registered patients in a searchable, filterable list
- Search by name or email
- Filter by treatment status

### Patient Detail View

Click on any patient to see their full record:

- **Identity Verification** - A toggle/tick box. Mark this as verified after completing the video consultation and confirming the patient's identity.

- **Weight Progress Chart** - Visual chart showing the patient's weight over time. Patients log their own weight; you can monitor trends here.

- **Messaging** - Real-time chat with the patient. Messages appear instantly (no need to refresh). You can see message history and respond directly.

- **Delivery Management** - This is where you manage medication orders:
  - **Create a new order** - Click to start a new delivery for the patient
  - **Advance status** - Move an order through the pipeline:
    1. Order Received
    2. Clinical Review
    3. Approved
    4. With Pharmacy
    5. Dispatched
    6. Delivered
  - **Add tracking number** - Enter the Royal Mail (or other carrier) tracking number once dispatched

- **Clinician Notes** - Private notes only visible to clinicians. Patients cannot see these. Use them for clinical observations, follow-up reminders, etc.

### Creating New Clinician Accounts

See [Section 10: How to Create Accounts](#10-how-to-create-accounts) for step-by-step instructions.

---

## 5. Patient Portal Guide

The patient portal is where patients manage their treatment after being approved.

### Logging In

1. Go to **app.dontweight.co.uk/login**
2. Enter the email and password provided when your account was created
3. You will see your personal dashboard

### Dashboard

Your main screen shows:
- **Treatment overview** - Your current treatment, dose, and status
- **Delivery status** - Where your medication is in the delivery process
- **Recent messages** - Any messages from your clinician

### Weight Tracking

- **Log your weight** - Enter your current weight at any time
- **View chart** - See your weight trend over time on an interactive chart
- **Export CSV** - Download your weight history as a spreadsheet file

### Messages

- **Real-time chat** - Send and receive messages with your clinician
- Messages appear instantly without refreshing the page
- You will see a notification when you have unread messages

### Subscription Management

- View your current treatment plan and dose
- **Request a dose change** - Ask your clinician to adjust your dose
- **Pause treatment** - Temporarily pause your subscription
- **Stop treatment** - Cancel your subscription

### Health Checks

- Book health check appointments through the integrated Semble system
- Three packages available:
  - **Baseline Health Check** - Basic blood work
  - **Standard Health Check** - Comprehensive panel
  - **Premium Health Check** - Full comprehensive assessment
- Clicking "Book Now" opens the Semble booking page

### Settings

- Update your profile information
- Manage notification preferences
- Change your password

---

## 6. WordPress Admin Guide

WordPress powers the main public website. Here is how to manage it.

### Accessing the Admin Panel

Go to **https://dontweight.co.uk/wp-admin/** and log in with your WordPress credentials.

### Patient Applications

Patient applications are stored as a custom type called `dw_application`.

- **Where to find them:** WP Admin sidebar --> Applications
- **Each application stores:**
  - Full name, email, phone number
  - Date of birth
  - BMI (calculated from quiz)
  - Medical history
  - Current medications
  - Allergies
  - Treatment choice (Mounjaro or Wegovy)
  - Full address
  - Payment status

### Email Notifications

When a patient submits an application:
- An email is **automatically sent to hello@dontweight.co.uk** with the application details
- A **confirmation email is sent to the patient**
- Email is configured through WP Mail SMTP using Google Workspace

> **Important:** If emails stop working, check WP Admin --> WP Mail SMTP --> Settings to ensure the Google Workspace connection is still active.

### Key Website Pages

Each page on the website has its own template file in the WordPress theme. If a developer needs to make changes, these are the files they will need:

| Page | URL Path | Template File |
|---|---|---|
| Homepage | `/` | `page-home.php` |
| Treatments | `/treatments/` | `page-treatments.php` |
| Health Checks (DW360) | `/dw360/` | `page-dw360.php` |
| Consultation Form | `/consultation/` | `page-consultation.php` |
| About Us | `/about/` | `page-about.php` |
| Contact | `/contact/` | `page-contact.php` |
| Ads Landing Page | `/ads-landing/` | `page-ads-landing.php` |

**Theme name:** `dontweight-theme-v72`

### Clearing the Cache

After making any changes to theme files (design, layout, code), you **must** clear the cache:

1. In WP Admin, look for **"Kinsta Cache"** in the left sidebar
2. Click **"Clear All Caches"**
3. Wait 30 seconds, then check the live site

> **Important:** If you skip this step, your changes may not appear on the live site. Kinsta caches pages aggressively for performance, so clearing is essential after every update.

---

## 7. Database Structure (Supabase)

Supabase is the database that stores all portal data. You can view and manage it at:
**https://supabase.com/dashboard/project/rcutpmafwgrckmmqpnrt**

Here is what each table stores:

| Table | Purpose | Key Fields |
|---|---|---|
| **profiles** | User accounts (patients and clinicians) | email, first_name, last_name, phone, date_of_birth, role (`client` or `clinician`), id_verified |
| **subscriptions** | Treatment plans and payment links | treatment, dose, status (active/paused/cancelled), Stripe IDs, price |
| **messages** | Patient-clinician messaging | user_id, sender_role, content, is_read, created_at |
| **deliveries** | Medication order tracking | status (order_received through delivered), tracking_number, carrier, medication_name, medication_details |
| **weight_logs** | Patient weight entries | user_id, weight_kg, logged_at, note |
| **progress_photos** | Patient progress photos | user_id, photo_url, caption |
| **video_calls** | Consultation appointments | user_id, scheduled_at, duration_minutes, status |
| **health_check_bookings** | Health check reservations | user_id, package (baseline/standard/premium), appointment_date, status |
| **identity_documents** | ID verification uploads | user_id, document_type (passport/driving_licence), status (pending/approved/rejected) |
| **ai_chats** | Chatbot conversation history | user_id, role (user/assistant), content |
| **leads** | Marketing leads from website forms | email, source, utm data, consent flags, converted status |

### Delivery Status Pipeline

Deliveries move through these stages in order:

```
Order Received --> Clinical Review --> Approved --> With Pharmacy --> Dispatched --> Delivered
```

Each stage is updated by a clinician through the portal interface.

### User Roles

There are two roles in the system:
- **`client`** - A patient. Can only see their own data.
- **`clinician`** - A staff member. Can see all patients' data.

The role is set in the `profiles` table. The database enforces these permissions automatically (through "Row Level Security" policies), so a patient can never accidentally see another patient's information.

---

## 8. Payment Flow (Stripe)

Here is how payments work from start to finish:

```
    Patient selects treatment on consultation form
                    |
                    v
    WordPress creates a Stripe "checkout session"
    (a secure payment page hosted by Stripe)
                    |
                    v
    Patient enters card details on Stripe's page
                    |
                    v
    Payment successful
                    |
                    v
    Stripe sends a "webhook" (automatic notification) to:
    https://dontweight.co.uk/wp-json/dontweight/v1/stripe-webhook
                    |
                    v
    WordPress receives the webhook and:
    - Saves the payment record
    - Emails the team (hello@dontweight.co.uk)
    - Emails the patient (confirmation)
```

### Managing Payments in Stripe

Log in to **https://dashboard.stripe.com** to:
- **View all payments** - See transaction history, amounts, dates
- **Issue refunds** - Click on any payment to process a full or partial refund
- **View customer records** - See a patient's full payment history
- **Manage subscriptions** - View, pause, or cancel recurring payments

> **Important:** The Stripe webhook endpoint **must be configured** in Stripe for payments to work correctly. If you ever need to reconfigure it:
> 1. Go to Stripe Dashboard --> Developers --> Webhooks
> 2. Add endpoint: `https://dontweight.co.uk/wp-json/dontweight/v1/stripe-webhook`
> 3. Select the events to listen for (at minimum: `checkout.session.completed`)
> 4. Save and copy the webhook signing secret into your WordPress configuration

---

## 9. Deployment Guide

This section explains how to push changes to the live website and portal.

### WordPress (Main Website)

The website runs on WordPress, hosted by Kinsta.

**Option A: Edit via WordPress Admin (easiest)**
1. Log in to https://dontweight.co.uk/wp-admin/
2. Go to Appearance --> Theme File Editor
3. Select the file you want to edit from the right sidebar
4. Make your changes
5. Click "Update File"
6. Go to Kinsta Cache (left sidebar) --> Clear All Caches
7. Check the live site to confirm changes

**Option B: Edit via SFTP/SSH (for developers)**
1. Log in to https://my.kinsta.com
2. Go to Sites --> Don't Weight --> Info
3. Find SFTP/SSH credentials
4. Connect with an SFTP client (e.g., FileZilla) or SSH
5. Navigate to the theme directory
6. Upload modified files
7. Clear Kinsta Cache

> **Important:** Always make a backup before editing theme files. Kinsta keeps 14 days of daily backups that can be restored from MyKinsta --> Sites --> Don't Weight --> Backups.

### Portal (React App)

The patient portal is a React application hosted on Netlify.

**To deploy updates:**
1. Navigate to the portal code directory
2. Build the app: `npm run build` (or `npx vite build`)
3. Deploy: `netlify deploy --prod --dir=dist`
4. Or, if connected to a Git repository, simply push your code and Netlify will deploy automatically

**Netlify Site ID:** `d78e09ed-c249-4daa-ab12-6a4e329a6a42`

The portal is served at **app.dontweight.co.uk**, which is configured as a custom domain in Netlify.

---

## 10. How to Create Accounts

### Create a New Clinician Account

1. Go to **Supabase Dashboard**: https://supabase.com/dashboard/project/rcutpmafwgrckmmqpnrt
2. Click **Authentication** in the left sidebar
3. Click **Users** --> **Add User**
4. Enter the clinician's email address and a temporary password
5. Tick **"Auto confirm"** (so they can log in immediately)
6. Click **Create User**
7. Now go to **Table Editor** in the left sidebar
8. Click on the **profiles** table
9. Find the row for the new user (search by email)
10. Click on the **role** field and change it from `client` to `clinician`
11. Click **Save**

The new clinician can now log in at **app.dontweight.co.uk/login** and will see the clinician dashboard.

### Create a New Patient Account

**Automatic (normal process):**
Patients create their own accounts through the consultation flow on the website. No manual action needed.

**Manual (if needed):**
1. Follow the same steps as for a clinician above
2. But in step 10, leave the role as `client` (or set it to `client` if it is not already)
3. Fill in their first_name, last_name, and other profile details

---

## 11. Ongoing Maintenance

### What Runs Automatically

| Service | What It Handles | What to Monitor |
|---|---|---|
| **Kinsta** | WordPress hosting, SSL certificate, daily backups (14 days), server performance | MyKinsta dashboard for uptime and performance alerts |
| **Netlify** | Portal hosting, SSL certificate, CDN (content delivery), automatic deployments | Netlify dashboard for deploy status |
| **Supabase** | Database, user login system, real-time messaging | Supabase dashboard for database health and usage |
| **Stripe** | Payment processing, PCI compliance | Stripe dashboard for failed payments, disputes |
| **Google Workspace** | Email delivery, spam filtering | Google Admin console for email health |

### DNS Configuration

Your domain name settings must point to the correct services:

- **dontweight.co.uk** --> Points to Kinsta (WordPress website)
- **app.dontweight.co.uk** --> Points to Netlify (Patient portal)

> **Important:** If you ever change your domain registrar or hosting provider, these DNS records must be updated or the sites will go offline. Contact your developer before making DNS changes.

### Regular Checks (Recommended Monthly)

- [ ] Verify the website loads correctly on mobile and desktop
- [ ] Check Stripe dashboard for any failed payments or disputes
- [ ] Review Supabase usage to ensure you are within your plan limits
- [ ] Confirm Kinsta backups are running (MyKinsta --> Backups)
- [ ] Test the patient journey end-to-end (quiz --> form --> payment)
- [ ] Check that emails are being sent and received
- [ ] Review Google Workspace for any delivery issues

### WordPress Updates

- WordPress core, plugins, and themes may need periodic updates
- Always create a backup before updating (Kinsta does daily backups, but create a manual one before major changes)
- Test the site after any update to ensure nothing has broken

---

## 12. Tech Stack Summary

| Component | Purpose | Hosted On | Login URL | Technology |
|---|---|---|---|---|
| Main Website | Public site, quiz, consultation form | Kinsta | https://dontweight.co.uk/wp-admin/ | WordPress + custom theme |
| Patient Portal | Patient & clinician dashboards | Netlify | https://app.dontweight.co.uk/login | React + Vite + Tailwind CSS |
| Database | All portal data and user accounts | Supabase | https://supabase.com/dashboard/project/rcutpmafwgrckmmqpnrt | PostgreSQL |
| Payments | Card processing and subscriptions | Stripe | https://dashboard.stripe.com | Stripe Checkout |
| Email | All business email | Google Workspace | https://admin.google.com | Gmail / Google Workspace |
| Bookings | Health check appointments | Semble | https://app.semble.io | Semble |
| Hosting Dashboard | Server management, backups | Kinsta | https://my.kinsta.com | Kinsta |
| Portal Hosting | Deploy management, CDN | Netlify | https://app.netlify.com | Netlify |

---

## 13. Cost Structure

Below are the services that have recurring costs. Prices are approximate and may vary based on your plan and usage.

| Service | What You Pay For | Typical Monthly Cost | Notes |
|---|---|---|---|
| **Kinsta** | WordPress hosting | ~$35 - $70/month | Depends on plan tier and traffic. Includes SSL, CDN, backups. |
| **Netlify** | Portal hosting | Free - $19/month | Free tier is generous. Pro plan if you need more bandwidth or team features. |
| **Supabase** | Database & authentication | Free - $25/month | Free tier includes 500MB database, 50,000 monthly active users. Pro plan for more. |
| **Stripe** | Payment processing | 1.4% + 20p per transaction (UK cards) | No monthly fee. You pay per transaction. Higher rates for non-UK cards. |
| **Google Workspace** | Email accounts | ~$5.75/user/month | Per email account (hello@, support@, pharmacy@, etc.) |
| **Domain** | dontweight.co.uk renewal | ~$10 - $15/year | Annual renewal. Check your registrar for exact price. |
| **Semble** | Booking system | Varies | Check your Semble plan for current pricing. |

**Estimated total monthly running cost:** ~$80 - $150/month (excluding Stripe transaction fees and Semble)

> **Important:** Keep all payment methods up to date on each platform to avoid service interruptions. If a payment fails, the service may suspend your account, taking parts of the platform offline.

---

## Semble Booking Links

For reference, these are the direct booking URLs for health checks:

- **Baseline Health Check:** https://app.semble.io/book/don-t-weight-ltd/baseline-health-check
- **Standard Health Check:** https://app.semble.io/book/don-t-weight-ltd/standard-health-check
- **Premium Health Check:** https://app.semble.io/book/don-t-weight-ltd/comprehensive-health-check

---

## Glossary of Technical Terms

| Term | What It Means |
|---|---|
| **WordPress** | A popular website-building platform. Your main website runs on it. |
| **React** | A programming framework used to build the patient portal. |
| **Supabase** | An online database service that stores all portal data and handles logins. |
| **Netlify** | A hosting service that serves the patient portal to visitors. |
| **Kinsta** | A premium WordPress hosting service that runs your main website. |
| **Stripe** | An online payment processing service. Handles all card payments securely. |
| **DNS** | Domain Name System. The "address book" of the internet that tells browsers where to find your website. |
| **SSL** | Secure Sockets Layer. The technology that makes your site show "https://" and the padlock icon. Both Kinsta and Netlify handle this automatically. |
| **CDN** | Content Delivery Network. Copies of your site stored around the world so it loads fast everywhere. |
| **Webhook** | An automatic message sent from one system to another when something happens (e.g., Stripe tells WordPress when a payment succeeds). |
| **SFTP** | Secure File Transfer Protocol. A way to upload files directly to your server. |
| **API** | Application Programming Interface. How different software systems talk to each other. |
| **RLS** | Row Level Security. A database feature that ensures patients can only see their own data. |
| **Cache** | A saved copy of your website pages for faster loading. Must be cleared after changes. |

---

*This document contains everything needed to understand, manage, and hand over the Don't Weight platform. For developer-specific technical details, refer to the codebase in the project repository.*
