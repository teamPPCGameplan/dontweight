<?php
/**
 * Template Name: Contact & About
 * Description: Contact us, about the clinic, credentials, and schedule a call
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us | Don't Weight — UK Weight Management Clinic</title>
<meta name="description" content="Get in touch with Don't Weight. CQC registered, MHRA approved UK clinicians. Email us for general enquiries, patient support, or pharmacy questions.">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<?php wp_head(); ?>
<style>
:root{--sky:#38BDF8;--sky-deep:#0EA5E9;--sky-dark:#0284C7;--sky-pale:#E0F2FE;--sky-wash:#F0F9FF;--white:#FFFFFF;--cream:#FAFAF9;--warm:#F5F5F4;--stone:#E7E5E4;--ink:#0C0A09;--charcoal:#1C1917;--slate:#44403C;--coral:#F97316;--display:-apple-system,BlinkMacSystemFont,'Inter',sans-serif;--body:-apple-system,BlinkMacSystemFont,'Inter',sans-serif}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}html{scroll-behavior:smooth}body{background:var(--white);color:var(--ink);font-family:var(--body);font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased}
.nav{position:fixed;top:0;left:0;right:0;z-index:100;height:56px;display:flex;align-items:center;justify-content:space-between;padding:0 clamp(16px,4vw,48px);background:#fff;backdrop-filter:blur(20px);border-bottom:1px solid rgba(0,0,0,.04)}
.nav-logo{font-family:var(--display);font-size:22px;font-weight:800;color:var(--ink);text-decoration:none;letter-spacing:-.8px;white-space:nowrap;flex-shrink:0;line-height:1}.nav-logo i{color:var(--sky);font-style:italic;font-weight:300}
.nav-mid{display:flex;gap:32px;list-style:none}.nav-mid a{color:var(--slate);text-decoration:none;font-size:13px;font-weight:500;transition:color .2s}.nav-mid a:hover,.nav-mid a.active{color:var(--sky-deep);font-weight:600}
.nav-r{display:flex;align-items:center;gap:16px}
.nav-login{color:var(--ink);text-decoration:none;font-size:13px;font-weight:600}
.nav-btn{background:var(--sky);color:#fff;border:none;border-radius:100px;padding:10px 24px;font-family:var(--body);font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;white-space:nowrap}
.burger{display:none;background:none;border:none;cursor:pointer;width:32px;height:32px;position:relative;z-index:102}.burger span{display:block;width:20px;height:1.5px;background:var(--ink);position:absolute;left:6px;transition:transform .3s,opacity .2s}.burger span:nth-child(1){top:10px}.burger span:nth-child(2){top:16px}.burger span:nth-child(3){top:22px}
.mobile-menu{position:fixed;inset:0;z-index:101;background:var(--white);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:24px;opacity:0;pointer-events:none;transition:opacity .3s}.mobile-menu.open{opacity:1;pointer-events:all}.mobile-menu a{font-size:22px;font-weight:600;color:var(--ink);text-decoration:none}.mobile-menu .mm-cta{background:var(--sky);color:#fff;border:none;border-radius:100px;padding:16px 48px;font-size:16px;font-weight:700;cursor:pointer}.mm-close{position:absolute;top:16px;right:20px;background:none;border:none;font-size:32px;color:var(--ink);cursor:pointer}

/* PAGE */
.page-hero{padding:clamp(80px,12vw,120px) clamp(16px,4vw,48px) clamp(40px,5vw,64px);text-align:center;background:linear-gradient(180deg,var(--white) 0%,var(--sky-wash) 100%)}
.page-hero h1{font-family:var(--display);font-size:clamp(32px,5vw,56px);font-weight:700;letter-spacing:-1.5px;margin-bottom:16px}
.page-hero p{font-size:clamp(15px,1.5vw,18px);color:var(--slate);max-width:520px;margin:0 auto}

.section{padding:clamp(48px,6vw,80px) clamp(16px,4vw,48px)}
.container{max-width:1000px;margin:0 auto}
.section-label{font-size:10px;letter-spacing:2.5px;text-transform:uppercase;color:var(--sky-deep);font-weight:700;margin-bottom:10px}
.section-title{font-family:var(--display);font-size:clamp(22px,3vw,32px);font-weight:700;letter-spacing:-.5px;margin-bottom:8px}
.section-sub{font-size:14px;color:var(--slate);margin-bottom:40px;line-height:1.7}

/* CONTACT GRID */
.contact-grid{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start}
.contact-methods{display:flex;flex-direction:column;gap:20px}
.contact-card{background:var(--cream);border:1px solid var(--stone);border-radius:16px;padding:24px;display:flex;gap:16px;align-items:flex-start}
.contact-icon{width:48px;height:48px;background:linear-gradient(135deg,#0EA5E9 0%,#38BDF8 100%);border-radius:14px;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 4px 14px rgba(14,165,233,.25)}
.contact-card h4{font-size:14px;font-weight:700;margin-bottom:4px}
.contact-card p{font-size:13px;color:var(--slate);line-height:1.6}
.contact-card a{color:var(--sky-deep);text-decoration:none;font-weight:600;font-size:13px}
.contact-card a:hover{text-decoration:underline}

/* CONTACT FORM */
.form-card{background:var(--white);border:1.5px solid var(--stone);border-radius:20px;padding:clamp(24px,3vw,36px)}
.form-card h3{font-family:var(--display);font-size:20px;font-weight:700;margin-bottom:6px}
.form-card .sub{font-size:13px;color:var(--slate);margin-bottom:24px}
.field{margin-bottom:16px}
.field label{display:block;font-size:12px;font-weight:600;color:var(--charcoal);margin-bottom:6px;letter-spacing:.3px}
.field input,.field textarea,.field select{width:100%;background:var(--cream);border:1.5px solid var(--stone);border-radius:10px;padding:11px 14px;font-family:var(--body);font-size:14px;outline:none;transition:border .2s;color:var(--ink)}
.field input:focus,.field textarea:focus,.field select:focus{border-color:var(--sky)}
.field textarea{resize:vertical;min-height:100px}
.field select{appearance:none;cursor:pointer}
.field-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.submit-btn{width:100%;background:var(--sky);color:#fff;border:none;border-radius:100px;padding:14px;font-family:var(--body);font-size:14px;font-weight:600;cursor:pointer;margin-top:8px;transition:background .2s}
.submit-btn:hover{background:var(--sky-deep)}
.form-note{font-size:11px;color:var(--slate);text-align:center;margin-top:12px;line-height:1.6}
.form-success{display:none;background:var(--sky-wash);border:1px solid var(--sky-pale);border-radius:12px;padding:20px;text-align:center;font-size:14px;color:var(--sky-dark);font-weight:500}

/* CREDENTIALS */
.cred-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
.cred-card{background:var(--white);border:1px solid var(--stone);border-radius:16px;padding:28px 24px;text-align:center}
.cred-icon{width:56px;height:56px;border-radius:16px;background:linear-gradient(135deg,#0EA5E9 0%,#38BDF8 100%);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:0 4px 14px rgba(14,165,233,.25)}
.cred-card h4{font-size:15px;font-weight:700;margin-bottom:6px}
.cred-card p{font-size:12px;color:var(--slate);line-height:1.7}
.cred-badge{display:inline-block;background:var(--sky-pale);color:var(--sky-dark);font-size:11px;font-weight:700;padding:4px 12px;border-radius:100px;margin-top:10px}

/* SCHEDULE */
.schedule-card{background:var(--ink);border-radius:20px;padding:clamp(28px,4vw,48px);display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:center}
.schedule-card h2{font-family:var(--display);font-size:clamp(22px,3vw,32px);font-weight:700;color:#fff;letter-spacing:-.5px;margin-bottom:12px}
.schedule-card p{font-size:14px;color:rgba(255,255,255,.6);line-height:1.7;margin-bottom:24px}
.schedule-notes{display:flex;flex-direction:column;gap:10px;margin-bottom:24px}
.schedule-note{display:flex;gap:10px;align-items:flex-start;font-size:13px;color:rgba(255,255,255,.7)}
.schedule-note span:first-child{color:var(--sky);font-size:16px;flex-shrink:0;margin-top:1px}

/* Schedule form */
.schedule-form{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:24px}
.schedule-form .field label{color:rgba(255,255,255,.7)}
.schedule-form .field input,.schedule-form .field select,.schedule-form .field textarea{background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.15);color:#fff}
.schedule-form .field input::placeholder,.schedule-form .field textarea::placeholder{color:rgba(255,255,255,.35)}
.schedule-form .field input:focus,.schedule-form .field select,.schedule-form .field textarea:focus{border-color:var(--sky)}
.schedule-form .field select option{background:var(--ink);color:#fff}
.schedule-submit{width:100%;background:var(--sky);color:#fff;border:none;border-radius:100px;padding:14px;font-family:var(--body);font-size:14px;font-weight:600;cursor:pointer;transition:background .2s}
.schedule-submit:hover{background:var(--sky-deep)}
.required-note{font-size:11px;color:rgba(255,255,255,.4);margin-top:10px;text-align:center}

/* FOOTER */
.ft{max-width:1200px;margin:0 auto;padding:0 clamp(20px,4vw,48px)}
.ft-top{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:40px;padding:56px 0 40px;border-bottom:1px solid rgba(255,255,255,.08)}
.ft-brand{font-family:var(--display);font-size:22px;font-weight:800;color:#fff;text-decoration:none;letter-spacing:-.5px;display:inline-block;margin-bottom:12px;white-space:nowrap}
.ft-brand i{color:var(--sky);font-style:italic;font-weight:300}
.ft-tag{font-size:13px;color:rgba(255,255,255,.45);line-height:1.7;max-width:260px;margin-top:8px}
.ft-col h5{font-size:11px;font-weight:700;color:rgba(255,255,255,.35);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:16px}
.ft-col ul{list-style:none}.ft-col ul li{margin-bottom:10px}
.ft-col ul li a{color:rgba(255,255,255,.55);text-decoration:none;font-size:13px;transition:color .2s}.ft-col ul li a:hover{color:#fff}
.ft-bot{display:flex;justify-content:space-between;align-items:center;padding:24px 0;flex-wrap:wrap;gap:16px;font-size:12px;color:rgba(255,255,255,.3)}
.ft-badges{display:flex;gap:8px;flex-wrap:wrap}
.ft-badge{background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);border-radius:100px;padding:4px 12px;font-size:11px;color:rgba(255,255,255,.45);font-weight:500}

@media(max-width:960px){.nav-mid{display:none}.burger{display:block}.nav-login{display:none}}
@media(max-width:600px){.nav-btn{padding:8px 14px;font-size:11px}.nav-r{gap:8px}}
@media(max-width:480px){.nav-logo{font-size:18px}}
@media(max-width:768px){
  .contact-grid{grid-template-columns:1fr}
  .cred-grid{grid-template-columns:1fr 1fr}
  .schedule-card{grid-template-columns:1fr}
  .ft-top{grid-template-columns:1fr 1fr;gap:28px}
  .ft-top>div:first-child{grid-column:1/-1}
  .ft-bot{flex-direction:column;text-align:center}
}
@media(max-width:480px){
  .cred-grid{grid-template-columns:1fr}
  .field-row{grid-template-columns:1fr}
  .ft-top{grid-template-columns:1fr}
}
</style>
</head>
<body>

<!-- NAV -->
<?php include(get_template_directory() . '/header.php'); ?>

<!-- HERO -->
<section class="page-hero">
  <div style="display:inline-flex;align-items:center;gap:8px;background:var(--sky-wash);border:1px solid var(--sky-pale);padding:6px 16px;border-radius:100px;margin-bottom:20px;font-size:11px;font-weight:600;color:var(--ink)">
    <span style="width:6px;height:6px;border-radius:50%;background:#22C55E;display:inline-block"></span>
    CQC Registered &middot; MHRA Approved &middot; UK Clinicians
  </div>
  <h1>Get in touch</h1>
  <p>Questions about treatment, eligibility or your subscription? Our team is here to help — 7 days a week.</p>
</section>

<!-- CONTACT SECTION -->
<section class="section" style="background:var(--cream)">
  <div class="container">
    <div class="contact-grid">

      <!-- Left: Contact Methods -->
      <div>
        <div class="section-label">Reach us</div>
        <div class="section-title">We&rsquo;re here for you</div>
        <p class="section-sub">Our clinical team responds within a few hours. For urgent medical concerns, always contact 999 or NHS 111.</p>

        <div class="contact-methods">
          <div class="contact-card">
            <div class="contact-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"><rect x="2" y="4" width="20" height="16" rx="2.5" fill="white" opacity=".2" stroke="white" stroke-width="1.5"/><path d="M2 7l10 7 10-7" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
            <div>
              <h4>General enquiries</h4>
              <p>Questions about treatments, eligibility or pricing.</p>
              <a href="mailto:hello@dontweight.co.uk">hello@dontweight.co.uk</a>
            </div>
          </div>
          <div class="contact-card">
            <div class="contact-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="7" r="3.5" stroke="white" stroke-width="1.5"/><path d="M4 20v-1a5 5 0 015-5h6a5 5 0 015 5v1" stroke="white" stroke-width="1.5" stroke-linecap="round"/><path d="M17 9l1.5 1.5L21 8" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
            <div>
              <h4>Patient support</h4>
              <p>Existing patients — orders, doses, side effects.</p>
              <a href="mailto:support@dontweight.co.uk">support@dontweight.co.uk</a>
            </div>
          </div>
          <div class="contact-card">
            <div class="contact-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"><rect x="3" y="9.5" width="18" height="7" rx="3.5" fill="white" opacity=".2" stroke="white" stroke-width="1.5" transform="rotate(-35 12 13)"/><line x1="8.5" y1="16" x2="15.5" y2="9" stroke="white" stroke-width="1.5" stroke-linecap="round" opacity=".6"/><rect x="3" y="9.5" width="9" height="7" rx="3.5" fill="white" opacity=".4" transform="rotate(-35 12 13)"/></svg></div>
            <div>
              <h4>Pharmacy &amp; prescriptions</h4>
              <p>Prescription queries and medication questions.</p>
              <a href="mailto:pharmacy@dontweight.co.uk">pharmacy@dontweight.co.uk</a>
            </div>
          </div>
          <div class="contact-card">
            <div class="contact-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M6.5 4h3l1.5 4-2 1.5c1 2 2.5 3.5 4.5 4.5L15 12l4 1.5v3C19 18 17 20 15 20 9 20 4 15 4 9c0-2 2-4 2.5-5z" fill="white" opacity=".25" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
            <div>
              <h4>Phone</h4>
              <p>Mon–Fri 9am–6pm, Sat 10am–4pm</p>
              <a href="tel:+441234567890">+44 (0) 1234 567 890</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Right: Contact Form -->
      <div class="form-card">
        <h3>Send us a message</h3>
        <p class="sub">We&rsquo;ll get back to you within a few hours.</p>
        <div id="contactSuccess" class="form-success">✓ Message sent! We&rsquo;ll be in touch within a few hours.</div>
        <div id="contactForm">
          <div class="field-row">
            <div class="field">
              <label>First name *</label>
              <input type="text" id="cfFirst" placeholder="Jane">
            </div>
            <div class="field">
              <label>Last name *</label>
              <input type="text" id="cfLast" placeholder="Smith">
            </div>
          </div>
          <div class="field">
            <label>Email address *</label>
            <input type="email" id="cfEmail" placeholder="jane@example.com">
          </div>
          <div class="field">
            <label>Subject *</label>
            <select id="cfSubject">
              <option value="">Select a topic...</option>
              <option>Treatment enquiry</option>
              <option>Eligibility question</option>
              <option>Existing patient — support</option>
              <option>Prescription / pharmacy</option>
              <option>Billing / subscription</option>
              <option>Health Check enquiry</option>
              <option>Other</option>
            </select>
          </div>
          <div class="field">
            <label>Message *</label>
            <textarea id="cfMessage" placeholder="How can we help?"></textarea>
          </div>
          <button class="submit-btn" onclick="submitContact()">Send message &rarr;</button>
          <p class="form-note">We never share your data. By sending this message you agree to our <a href="/privacy-policy/" style="color:var(--sky-deep)">Privacy Policy</a>.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- CREDENTIALS -->
<section class="section" style="background:var(--white)">
  <div class="container">
    <div style="text-align:center;margin-bottom:40px">
      <div class="section-label">Our credentials</div>
      <div class="section-title">Regulated, approved &amp; trusted</div>
      <p style="font-size:14px;color:var(--slate);max-width:500px;margin:0 auto">don&rsquo;t weight operates under full UK regulatory oversight. Your safety and care are our priority.</p>
    </div>
    <div class="cred-grid">
      <div class="cred-card">
        <div class="cred-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"><rect x="3" y="11" width="2" height="8" rx="1" fill="white"/><rect x="7" y="9" width="2" height="10" rx="1" fill="white"/><rect x="11" y="7" width="2" height="12" rx="1" fill="white"/><rect x="15" y="9" width="2" height="10" rx="1" fill="white"/><rect x="19" y="11" width="2" height="8" rx="1" fill="white"/><rect x="2" y="19" width="20" height="2" rx="1" fill="white"/><path d="M12 3L2 9h20L12 3z" fill="white" opacity=".8"/></svg></div>
        <h4>CQC Registered</h4>
        <p>Registered with the Care Quality Commission — the independent regulator of health and social care in England.</p>
        <span class="cred-badge">CQC Registered</span>
      </div>
      <div class="cred-card">
        <div class="cred-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 2L4 6v6c0 5 3.5 9.5 8 11 4.5-1.5 8-6 8-11V6L12 2z" fill="white" opacity=".2" stroke="white" stroke-width="1.5" stroke-linejoin="round"/><path d="M8 12l3 3 5-5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        <h4>MHRA Approved</h4>
        <p>All medications we prescribe are fully approved by the Medicines and Healthcare products Regulatory Agency.</p>
        <span class="cred-badge">MHRA Approved</span>
      </div>
      <div class="cred-card">
        <div class="cred-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="7" r="4" stroke="white" stroke-width="1.5"/><path d="M4 21v-2a4 4 0 014-4h8a4 4 0 014 4v2" stroke="white" stroke-width="1.5" stroke-linecap="round"/><circle cx="19" cy="17" r="2" fill="white" opacity=".6"/><path d="M15 13.5c0 2 1.5 3.5 4 3.5" stroke="white" stroke-width="1.5" stroke-linecap="round"/></svg></div>
        <h4>UK-Registered Clinicians</h4>
        <p>All prescriptions are issued by GPhC-registered UK clinicians following a full medical review.</p>
        <span class="cred-badge">GPhC Registered</span>
      </div>
      <div class="cred-card">
        <div class="cred-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"><rect x="5" y="11" width="14" height="10" rx="2" fill="white" opacity=".25" stroke="white" stroke-width="1.5"/><path d="M8 11V7a4 4 0 018 0v4" stroke="white" stroke-width="1.5" stroke-linecap="round"/><circle cx="12" cy="16" r="1.5" fill="white"/></svg></div>
        <h4>ICO Compliant</h4>
        <p>Fully compliant with UK GDPR. Your personal and medical data is stored securely on UK servers.</p>
        <span class="cred-badge">ICO Registered</span>
      </div>
      <div class="cred-card">
        <div class="cred-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"><rect x="3" y="9" width="18" height="8" rx="4" fill="white" opacity=".2" stroke="white" stroke-width="1.5"/><line x1="12" y1="9" x2="12" y2="17" stroke="white" stroke-width="1.5" stroke-linecap="round"/><rect x="3" y="9" width="9" height="8" rx="4" fill="white" opacity=".4" transform="rotate(0)"/></svg></div>
        <h4>Registered Pharmacy</h4>
        <p>Medications are dispensed by a GPhC-registered pharmacy and delivered in tamper-proof, discreet packaging.</p>
        <span class="cred-badge">GPhC Pharmacy</span>
      </div>
      <div class="cred-card">
        <div class="cred-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" fill="white" opacity=".25" stroke="white" stroke-width="1.5"/><circle cx="12" cy="9" r="2.5" fill="white"/></svg></div>
        <h4>UK Based</h4>
        <p>Registered in England &amp; Wales. All operations, clinical staff, and data storage are based in the United Kingdom.</p>
        <span class="cred-badge">England &amp; Wales</span>
      </div>
    </div>
  </div>
</section>

<!-- SCHEDULE A VIDEO CALL -->
<section class="section" id="scheduleSection" style="background:var(--cream)">
  <div class="container">
    <div class="schedule-card">
      <div>
        <div style="font-size:10px;letter-spacing:2.5px;text-transform:uppercase;color:var(--sky);font-weight:700;margin-bottom:12px">Video Consultation</div>
        <h2>Schedule a call with our team</h2>
        <p>Have a question before you start? Speak directly with one of our clinicians or patient advisors on a short video call.</p>
        <div class="schedule-notes">
          <div class="schedule-note"><span>✓</span><span>15-minute calls — no obligation</span></div>
          <div class="schedule-note"><span>✓</span><span>Available Mon–Sat, 9am–6pm</span></div>
          <div class="schedule-note"><span>✓</span><span>Clinician or patient advisor</span></div>
          <div class="schedule-note"><span>✓</span><span>Google Meet or phone — your choice</span></div>
        </div>
      </div>

      <div style="display:flex;flex-direction:column;justify-content:center;align-items:flex-start;gap:24px">
        <!-- Cal.com popup trigger -->
        <button
          data-cal-link="dontweight/video-consultation"
          data-cal-config='{"layout":"month_view","overlayCalendar":true}'
          style="background:var(--sky);color:white;border:none;border-radius:100px;padding:18px 40px;font-family:var(--body);font-size:16px;font-weight:700;cursor:pointer;transition:background .2s;box-shadow:0 4px 24px rgba(56,189,248,.3)"
          onmouseover="this.style.background='var(--sky-deep)'"
          onmouseout="this.style.background='var(--sky)'">
          Book a video call &rarr;
        </button>
        <p style="font-size:12px;color:rgba(255,255,255,.4);margin:0">Opens a booking calendar &middot; Takes 2 minutes</p>
        <!-- Cal.com embed script -->
        <script type="text/javascript">
          (function(C,A,L){
            let p=function(a,ar){a.q.push(ar)};
            let d=C.document;
            C.Cal=C.Cal||function(){let cal=C.Cal;let ar=arguments;if(!cal.loaded){cal.ns={};cal.q=cal.q||[];d.head.appendChild(d.createElement("script")).src=A;cal.loaded=true}if(ar[0]===L){const api=function(){p(api,arguments)};const namespace=ar[1];api.q=api.q||[];if(typeof namespace==="string"){cal.ns[namespace]=cal.ns[namespace]||api;p(cal.ns[namespace],ar);p(cal,["initNamespace",namespace])}else p(cal,ar);return}p(cal,ar)};
          })(window,"https://app.cal.com/embed/embed.js","init");
          Cal("init", {origin:"https://cal.com"});
          Cal("ui", {
            styles:{branding:{brandColor:"#38BDF8"}},
            hideEventTypeDetails:false,
            layout:"month_view"
          });
        </script>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<?php include(get_template_directory() . '/footer.php'); ?>

<script>
function toggleMobileMenu(){document.getElementById('mobileMenu').classList.toggle('open')}
function closeMobileMenu(){document.getElementById('mobileMenu').classList.remove('open')}

// Show/hide "other reason" field
document.getElementById('sfReason').addEventListener('change', function(){
  document.getElementById('sfOtherField').style.display = this.value === 'Other — I\'ll explain below' ? 'block' : 'none';
});

function submitContact(){
  var first=document.getElementById('cfFirst').value.trim();
  var last=document.getElementById('cfLast').value.trim();
  var email=document.getElementById('cfEmail').value.trim();
  var subject=document.getElementById('cfSubject').value;
  var message=document.getElementById('cfMessage').value.trim();
  if(!first||!last||!email||!subject||!message){alert('Please fill in all required fields.');return;}
  if(!email.includes('@')){alert('Please enter a valid email address.');return;}

  var fd=new FormData();
  fd.append('action','dw_contact');
  fd.append('nonce',typeof dwAjax!=='undefined'?dwAjax.nonce:'');
  fd.append('first_name',first);fd.append('last_name',last);
  fd.append('email',email);fd.append('subject',subject);fd.append('message',message);
  var url=typeof dwAjax!=='undefined'?dwAjax.url:'/wp-admin/admin-ajax.php';
  fetch(url,{method:'POST',body:fd}).catch(function(){});

  document.getElementById('contactForm').style.display='none';
  document.getElementById('contactSuccess').style.display='block';
}

function submitSchedule(){
  var name=document.getElementById('sfName').value.trim();
  var email=document.getElementById('sfEmail').value.trim();
  var day=document.getElementById('sfDay').value;
  var time=document.getElementById('sfTime').value;
  var reason=document.getElementById('sfReason').value;
  var other=document.getElementById('sfOther').value.trim();
  if(!name||!email||!day||!time||!reason){alert('Please fill in all required fields including the reason for your call.');return;}
  if(reason==='Other — I\'ll explain below'&&!other){alert('Please describe the reason for your call.');return;}
  if(!email.includes('@')){alert('Please enter a valid email address.');return;}

  var fd=new FormData();
  fd.append('action','dw_schedule');
  fd.append('nonce',typeof dwAjax!=='undefined'?dwAjax.nonce:'');
  fd.append('name',name);fd.append('email',email);
  fd.append('phone',document.getElementById('sfPhone').value.trim());
  fd.append('day',day);fd.append('time',time);
  fd.append('reason',reason==='Other — I\'ll explain below'?other:reason);
  var url=typeof dwAjax!=='undefined'?dwAjax.url:'/wp-admin/admin-ajax.php';
  fetch(url,{method:'POST',body:fd}).catch(function(){});

  document.getElementById('scheduleForm').style.display='none';
  document.getElementById('scheduleSuccess').style.display='block';
}
</script>
<?php echo dontweight_get_ajax_script(); ?>
<?php wp_footer(); ?>
</body>
</html>
