<?php
/**
 * Template Name: About Us
 * Description: About Don't Weight — brand-aligned, mobile-first
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About Us — Don't Weight | Clinician-Led Weight Management</title>
<meta name="description" content="Meet the team behind Don't Weight. UK-registered clinicians combining evidence-based prescribing with comprehensive health monitoring. CQC registered. MHRA approved.">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<?php wp_head(); ?>
<style>
:root{--sky:#38BDF8;--sky-deep:#0EA5E9;--sky-dark:#0284C7;--sky-pale:#E0F2FE;--sky-wash:#F0F9FF;--white:#FFFFFF;--cream:#FAFAF9;--warm:#F5F5F4;--stone:#E7E5E4;--ink:#0C0A09;--charcoal:#1C1917;--slate:#44403C;--display:'DM Sans',-apple-system,sans-serif;--body:'DM Sans',-apple-system,sans-serif}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}html{scroll-behavior:smooth}body{background:var(--white);color:var(--ink);font-family:var(--body);font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased}
.nav{position:fixed;top:0;left:0;right:0;z-index:100;height:56px;display:flex;align-items:center;justify-content:space-between;padding:0 clamp(16px,4vw,48px);background:#fff;backdrop-filter:blur(20px);border-bottom:1px solid rgba(0,0,0,.04)}
.nav-logo{font-family:var(--display);font-size:22px;font-weight:700;color:var(--ink);text-decoration:none;letter-spacing:-.8px}.nav-logo i{color:var(--sky);font-style:italic;font-weight:400}
.nav-mid{display:flex;gap:32px;list-style:none}.nav-mid a{color:var(--slate);text-decoration:none;font-size:13px;font-weight:500;transition:color .2s}.nav-mid a:hover,.nav-mid a.active{color:var(--sky-deep);font-weight:600}
.nav-r{display:flex;align-items:center;gap:16px}
.nav-login{color:var(--ink);text-decoration:none;font-size:13px;font-weight:600}
.nav-btn{background:var(--sky);color:#fff;border:none;border-radius:100px;padding:10px 24px;font-family:var(--body);font-size:13px;font-weight:600;cursor:pointer;text-decoration:none}
.burger{display:none;background:none;border:none;cursor:pointer;width:32px;height:32px;position:relative;z-index:102}.burger span{display:block;width:20px;height:1.5px;background:var(--ink);position:absolute;left:6px;transition:transform .3s,opacity .2s}.burger span:nth-child(1){top:10px}.burger span:nth-child(2){top:16px}.burger span:nth-child(3){top:22px}
.mobile-menu{position:fixed;inset:0;z-index:101;background:var(--white);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:24px;opacity:0;pointer-events:none;transition:opacity .3s}.mobile-menu.open{opacity:1;pointer-events:all}.mobile-menu a{font-size:22px;font-weight:600;color:var(--ink);text-decoration:none}.mobile-menu .mm-cta{background:var(--sky);color:#fff;border:none;border-radius:100px;padding:16px 48px;font-size:16px;font-weight:700;cursor:pointer}.mm-close{position:absolute;top:16px;right:20px;background:none;border:none;font-size:32px;color:var(--ink);cursor:pointer}
@media(max-width:960px){.nav-mid{display:none}.burger{display:block}.nav-login{display:none}}
@media(max-width:600px){.nav-btn{padding:8px 14px;font-size:11px}}

.sec{padding:clamp(56px,8vw,96px) clamp(20px,5vw,56px)}
.sec-inner{max-width:900px;margin:0 auto}
.label{font-size:10px;font-weight:700;color:var(--sky-deep);letter-spacing:2.5px;text-transform:uppercase;margin-bottom:12px}
.sec h2{font-family:var(--display);font-size:clamp(26px,3.5vw,40px);font-weight:700;line-height:1.1;letter-spacing:-1px;margin-bottom:16px}
.sec h2 span{color:var(--sky-deep)}

/* HERO */
.ab-hero{padding:clamp(100px,14vw,140px) clamp(20px,5vw,56px) clamp(56px,7vw,80px);background:var(--ink);text-align:center;position:relative;overflow:hidden}
.ab-hero::before{content:'';position:absolute;top:-120px;right:-120px;width:500px;height:500px;border-radius:50%;background:radial-gradient(circle,rgba(56,189,248,.1) 0%,transparent 70%)}
.ab-hero h1{font-family:var(--display);font-size:clamp(32px,5.5vw,60px);font-weight:700;color:var(--white);line-height:1.06;margin-bottom:20px;letter-spacing:-2px;max-width:700px;margin-left:auto;margin-right:auto;position:relative;z-index:1}
.ab-hero h1 span{color:var(--sky)}
.ab-hero-sub{font-size:clamp(15px,1.3vw,18px);color:rgba(255,255,255,.6);max-width:520px;margin:0 auto 40px;line-height:1.7;position:relative;z-index:1}
.ab-stats{display:flex;justify-content:center;gap:clamp(24px,5vw,56px);flex-wrap:wrap;position:relative;z-index:1}
.ab-stat h3{font-family:var(--display);font-size:clamp(24px,3.5vw,40px);font-weight:700;color:var(--sky);letter-spacing:-1px;margin-bottom:4px}
.ab-stat p{font-size:11px;color:rgba(255,255,255,.4)}

/* GRID SECTIONS */
.ab-grid{display:grid;grid-template-columns:1fr 1fr;gap:clamp(32px,5vw,64px);align-items:center}
.ab-quote{background:var(--sky-wash);border:1px solid var(--sky-pale);border-radius:20px;padding:clamp(28px,4vw,40px)}
.ab-quote blockquote{font-family:var(--display);font-size:clamp(17px,1.8vw,22px);font-weight:400;font-style:italic;color:var(--ink);line-height:1.6;margin-bottom:16px}
.ab-quote cite{font-size:12px;color:var(--slate);font-weight:600;letter-spacing:1px;text-transform:uppercase;font-style:normal}

/* CARDS */
.ab-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.ab-card{background:var(--white);border:1px solid var(--stone);border-radius:16px;padding:28px 24px;transition:all .3s}
.ab-card:hover{border-color:var(--sky);box-shadow:0 8px 28px rgba(56,189,248,.08);transform:translateY(-2px)}
.ab-card-icon{width:44px;height:44px;border-radius:12px;background:var(--sky);display:flex;align-items:center;justify-content:center;margin-bottom:16px}
.ab-card h3{font-size:15px;font-weight:700;margin-bottom:6px}
.ab-card p{font-size:13px;color:var(--slate);line-height:1.6}

/* HEALTH CHECK HIGHLIGHT */
.ab-hc{background:var(--ink);position:relative;overflow:hidden}
.ab-hc::before{content:'';position:absolute;top:0;right:0;width:400px;height:100%;background:radial-gradient(ellipse at right,rgba(56,189,248,.06) 0%,transparent 60%)}
.ab-hc h2{color:var(--white)}.ab-hc h2 span{color:var(--sky)}
.ab-hc p{color:rgba(255,255,255,.6)}
.ab-hc-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:32px}
.ab-hc-stat{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:24px 20px;text-align:center}
.ab-hc-stat h4{font-family:var(--display);font-size:clamp(24px,3vw,32px);font-weight:700;color:var(--sky);margin-bottom:6px;letter-spacing:-1px}
.ab-hc-stat p{font-size:12px;color:rgba(255,255,255,.5);line-height:1.5}

/* CREDENTIALS */
.ab-cred-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
.ab-cred{background:var(--sky-wash);border:1px solid var(--sky-pale);border-radius:14px;padding:24px 20px;display:flex;gap:14px;align-items:flex-start}
.ab-cred-icon{width:36px;height:36px;border-radius:10px;background:var(--sky);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.ab-cred h4{font-size:13px;font-weight:700;margin-bottom:4px}
.ab-cred p{font-size:12px;color:var(--slate);line-height:1.5}

/* FINAL CTA */
.ab-final{text-align:center;background:linear-gradient(160deg,var(--sky) 0%,var(--sky-deep) 50%,var(--sky-dark) 100%);color:#fff}
.ab-final h2{font-family:var(--display);font-size:clamp(24px,3.5vw,40px);font-weight:700;letter-spacing:-1px;margin-bottom:10px;color:#fff}
.ab-final p{font-size:14px;color:rgba(255,255,255,.7);margin-bottom:24px;max-width:420px;margin-left:auto;margin-right:auto}
.ab-btn-w{background:#fff;color:var(--sky-dark);border:none;border-radius:100px;padding:14px 32px;font-family:var(--body);font-size:14px;font-weight:700;text-decoration:none;display:inline-block;transition:all .2s}.ab-btn-w:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,0,0,.15)}

/* FOOTER */
.ft{max-width:1100px;margin:0 auto;padding:clamp(40px,6vw,64px) clamp(20px,4vw,48px) 24px}
.ft-top{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:32px;margin-bottom:32px}
.ft-brand{font-family:var(--display);font-size:20px;font-weight:700;color:var(--white);text-decoration:none;letter-spacing:-.6px;display:block;margin-bottom:8px}.ft-brand i{color:var(--sky);font-style:italic;font-weight:400}
.ft-tag{font-size:12px;color:rgba(255,255,255,.4);line-height:1.6;max-width:260px}
.ft-col h5{font-size:10px;font-weight:700;color:rgba(255,255,255,.3);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:12px}
.ft-col ul{list-style:none}.ft-col li{margin-bottom:6px}.ft-col a{color:rgba(255,255,255,.55);text-decoration:none;font-size:13px;transition:color .2s}.ft-col a:hover{color:var(--sky)}
.ft-bot{border-top:1px solid rgba(255,255,255,.06);padding-top:20px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px}
.ft-bot p{font-size:11px;color:rgba(255,255,255,.25)}.ft-badges{display:flex;gap:8px}.ft-badge{font-size:9px;color:rgba(255,255,255,.25);border:1px solid rgba(255,255,255,.08);border-radius:100px;padding:3px 10px}

@media(max-width:768px){.ab-grid{grid-template-columns:1fr}.ab-cards,.ab-cred-grid,.ab-hc-stats{grid-template-columns:1fr}.ft-top{grid-template-columns:1fr 1fr;gap:24px}}
@media(max-width:600px){.ab-hero h1{font-size:32px;letter-spacing:-1.2px}.ab-stats{gap:20px}.ab-cred-grid{grid-template-columns:1fr}}

.ab-founder{padding:80px 24px;background:#fafaf9}
.ab-founder-inner{max-width:960px;margin:0 auto;display:flex;align-items:center;gap:60px}
.ab-founder-img{flex:0 0 320px}
.ab-founder-img img{width:100%;border-radius:20px;object-fit:cover;aspect-ratio:3/4}
.ab-founder-text{flex:1}
.ab-founder-label{font-size:12px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#38bdf8;display:block;margin-bottom:12px}
.ab-founder-text h2{font-size:32px;font-weight:800;color:#0c0a09;margin:0 0 6px}
.ab-founder-role{font-size:15px;color:#78716c;font-weight:500;margin:0 0 20px}
.ab-founder-text p{font-size:16px;line-height:1.7;color:#44403c;margin:0 0 14px}
@media(max-width:768px){.ab-founder-inner{flex-direction:column;gap:32px;text-align:center}.ab-founder-img{flex:0 0 auto;max-width:280px;margin:0 auto}}

.ab-clinic{padding:80px 24px;background:#fff}
.ab-clinic-inner{max-width:800px;margin:0 auto}
.ab-clinic-label{font-size:12px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#38bdf8;display:block;margin-bottom:12px}
.ab-clinic h2{font-size:28px;font-weight:800;color:#0c0a09;margin:0 0 20px}
.ab-clinic p{font-size:16px;line-height:1.75;color:#44403c;margin:0 0 16px}
.ab-clinic-why{padding:60px 24px;background:#f0f9ff}
.ab-clinic-why-inner{max-width:800px;margin:0 auto}
.ab-clinic-why h3{font-size:22px;font-weight:700;color:#0c0a09;margin:0 0 20px}
.ab-clinic-why ul{list-style:none;padding:0;margin:0 0 20px}
.ab-clinic-why li{font-size:15px;line-height:1.7;color:#44403c;padding:8px 0 8px 28px;position:relative}
.ab-clinic-why li::before{content:'\2713';position:absolute;left:0;color:#38bdf8;font-weight:700}
.ab-ali-detail{padding:60px 24px;background:#fafaf9}
.ab-ali-detail-inner{max-width:800px;margin:0 auto}
.ab-ali-detail h3{font-size:22px;font-weight:700;color:#0c0a09;margin:0 0 16px}
.ab-ali-detail p{font-size:16px;line-height:1.75;color:#44403c;margin:0 0 16px}
.ab-ali-detail ul{list-style:none;padding:0;margin:0 0 20px}
.ab-ali-detail li{font-size:15px;line-height:1.7;color:#44403c;padding:6px 0 6px 28px;position:relative}
.ab-ali-detail li::before{content:'\2022';position:absolute;left:8px;color:#38bdf8;font-weight:700;font-size:18px}
.ab-mission{padding:60px 24px;background:#fff}
.ab-mission-inner{max-width:800px;margin:0 auto;text-align:center}
.ab-mission h3{font-size:22px;font-weight:700;color:#0c0a09;margin:0 0 16px}
.ab-mission p{font-size:16px;line-height:1.75;color:#44403c;margin:0 0 16px}
.ab-mission-services{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-top:24px;text-align:left}
.ab-mission-service{background:#f0f9ff;border-radius:12px;padding:16px 20px;font-size:14px;font-weight:600;color:#0c0a09}
</style>
</head>
<body>

<?php include(get_template_directory() . '/header.php'); ?>

<!-- HERO -->
<section class="ab-hero">
  <div class="label" style="color:var(--sky);text-align:center">About Don't Weight</div>
  <h1>Medication and monitoring. <span>Together.</span></h1>
  <p class="ab-hero-sub">The UK's first weight management programme that combines clinician-prescribed treatment with structured health monitoring. Because your body deserves more than just a prescription.</p>
  <div class="ab-stats">
    <div class="ab-stat"><h3>23%</h3><p>Avg. weight loss (Mounjaro)</p></div>
    <div class="ab-stat"><h3>&lt;24h</h3><p>Clinician approval</p></div>
    <div class="ab-stat"><h3>4.8</h3><p>Google rating</p></div>
    <div class="ab-stat"><h3>7 day</h3><p>Support team</p></div>
  </div>
</section>

<!-- MISSION -->
<section class="sec" style="background:var(--white)">
  <div class="sec-inner">
    <div class="ab-grid">
      <div>
        <div class="label">Our mission</div>
        <h2>Prescribe well. <span>Monitor better.</span></h2>
        <p style="font-size:14px;color:var(--slate);line-height:1.8;margin-bottom:14px">GLP-1 medications like Mounjaro and Wegovy are transforming lives. But rapid weight loss triggers real physiological changes in your liver, gallbladder, thyroid, pancreas, and cardiovascular system.</p>
        <p style="font-size:14px;color:var(--slate);line-height:1.8;margin-bottom:14px">Most clinics hand you a prescription and move on. We built something different: clinician-prescribed treatment, expert ongoing support, and the UK's first health screening designed specifically for patients on weight loss medication.</p>
        <p style="font-size:14px;color:var(--slate);line-height:1.8">Because knowing your weight dropped is good. Knowing your liver fat reversed, your heart health improved, and your thyroid is clear? That's proper medicine.</p>
      </div>
      <div class="ab-quote">
        <blockquote>&ldquo;We don't just prescribe the medication. We track what it's doing to your body &mdash; the things that don't show up on a scale.&rdquo;</blockquote>
        <cite>Clinical team, Don't Weight</cite>
      </div>
    </div>
  </div>
</section>

<!-- WHAT MAKES US DIFFERENT -->
<section class="sec" style="background:var(--cream)">
  <div class="sec-inner">
    <div style="text-align:center;margin-bottom:40px">
      <div class="label">Why different</div>
      <h2>More than a <span>prescription</span></h2>
      <p style="font-size:14px;color:var(--slate);max-width:480px;margin:0 auto">Three things that set us apart from every other weight loss clinic in the UK.</p>
    </div>
    <div class="ab-cards">
      <div class="ab-card">
        <div class="ab-card-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg></div>
        <h3>CQC registered</h3>
        <p>Every prescription issued by a UK-registered clinician following a full medical review. Same standard as your NHS GP.</p>
      </div>
      <div class="ab-card">
        <div class="ab-card-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
        <h3>Dedicated care team</h3>
        <p>You're not a ticket in a queue. Your care team is available 7 days a week for questions, side effects, and dose changes.</p>
      </div>
      <div class="ab-card">
        <div class="ab-card-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg></div>
        <h3>Clinical monitoring built in</h3>
        <p>The UK's first health screening for weight loss patients. Blood tests, ultrasound, ECG and GP review. Progress you can actually see.</p>
      </div>
    </div>
  </div>
</section>

<!-- HEALTH CHECK HIGHLIGHT -->
<section class="sec ab-hc">
  <div class="sec-inner" style="position:relative;z-index:1">
    <div style="text-align:center;margin-bottom:36px">
      <div class="label" style="color:var(--sky)">The dw health check</div>
      <h2>Monitoring isn't optional. <span>It's duty of care.</span></h2>
      <p style="max-width:560px;margin:0 auto">Rapid weight loss changes your body at a cellular level. We built a structured screening programme so you have clinical evidence of what's improving, and early warning of anything that needs attention.</p>
    </div>
    <div class="ab-hc-stats">
      <div class="ab-hc-stat"><h4>30%</h4><p>of rapid weight loss patients develop gallstones, usually silently</p></div>
      <div class="ab-hc-stat"><h4>7%</h4><p>thyroid nodule detection rate in routine scans, caught early</p></div>
      <div class="ab-hc-stat"><h4>1 in 3</h4><p>patients have fatty liver at baseline, GLP-1 can reverse it</p></div>
    </div>
    <div style="text-align:center;margin-top:32px">
      <a href="<?php echo home_url('/health-checks/'); ?>" style="display:inline-block;background:var(--sky);color:#fff;border-radius:100px;padding:14px 32px;font-size:14px;font-weight:700;text-decoration:none;transition:background .2s">Explore health checks &rarr;</a>
    </div>
  </div>
</section>

<!-- CREDENTIALS -->
<section class="sec" style="background:var(--white)">
  <div class="sec-inner">
    <div style="text-align:center;margin-bottom:36px">
      <div class="label">Regulation, compliance</div>
      <h2>You're in <span>safe hands</span></h2>
      <p style="font-size:14px;color:var(--slate);max-width:460px;margin:0 auto">Full UK regulatory oversight. Your safety and care are our absolute priority.</p>
    </div>
    <div class="ab-cred-grid">
      <div class="ab-cred"><div class="ab-cred-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg></div><div><h4>CQC Registered</h4><p>Care Quality Commission oversight, same as your NHS GP.</p></div></div>
      <div class="ab-cred"><div class="ab-cred-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div><div><h4>MHRA Approved</h4><p>All medications fully approved by the MHRA.</p></div></div>
      <div class="ab-cred"><div class="ab-cred-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div><div><h4>UK Clinicians</h4><p>GPhC-registered prescribers. Video consultation required.</p></div></div>
      <div class="ab-cred"><div class="ab-cred-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg></div><div><h4>ICO Compliant</h4><p>UK GDPR compliant. Data stored securely on UK servers.</p></div></div>
      <div class="ab-cred"><div class="ab-cred-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4l3 3v5a1 1 0 01-1 1h-2"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div><div><h4>Registered Pharmacy</h4><p>GPhC-registered pharmacy. Discreet, tamper-proof packaging.</p></div></div>
      <div class="ab-cred"><div class="ab-cred-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg></div><div><h4>UK Based</h4><p>Registered in England &amp; Wales. All operations UK-based.</p></div></div>
    </div>
  </div>
</section>


<!-- FOUNDER -->
<section class="ab-founder">
  <div class="ab-founder-inner">
    <div class="ab-founder-img">
      <img src="https://dontweight.co.uk/wp-content/uploads/2026/03/ali-aghaei-dont-weight-2.jpeg" alt="Ali Aghaei — Founder of Don't Weight" loading="lazy">
    </div>
    <div class="ab-founder-text">
      <span class="ab-founder-label">Meet the Founder</span>
      <h2>Ali Aghaei</h2>
      <p class="ab-founder-role">Founder &amp; Clinical Director</p>
      <p>I started <strong>Don’t</strong> <em style="color:var(--sky)">Weight</em> because I believe everyone deserves access to proper, clinician-led weight management. Having worked across the NHS and private sector, I saw an opportunity to build something better — a service that combines the latest treatments with genuine clinical care and ongoing support.</p>
      <p>Our approach is different. Every patient gets a dedicated clinician, evidence-based treatment, and ongoing support that actually fits their life. We combine the latest GLP-1 therapies with real clinical oversight — not a one-size-fits-all prescription.</p>
      <p>This isn’t about quick fixes. It’s about building something that lasts — for your health, your confidence, and your future.</p>
    </div>
  </div>
</section>


<!-- THE CLINIC -->
<section class="ab-clinic">
  <div class="ab-clinic-inner">
    <span class="ab-clinic-label">The Clinic</span>
    <h2>Medical weight loss. Done properly.</h2>
    <p><strong>Don’t</strong> <em style="color:var(--sky)">Weight</em> is the specialist weight management arm of London Private Ultrasound and UK Health Check. We deliver safe, evidence-based programmes for patients across London and the UK who want to lose weight under genuine clinical supervision.</p>
    <p>Every patient gets a detailed consultation, full medical history review, and where needed, blood tests, health screening, and diagnostic assessment — before we prescribe anything. Because the right treatment starts with understanding your health first.</p>
    <p>Our team supports you before, during, and after treatment. We monitor progress, review side effects, adjust medication when needed, and provide ongoing support to help you achieve results that last.</p>
  </div>
</section>

<!-- WHY CHOOSE US -->
<section class="ab-clinic-why">
  <div class="ab-clinic-why-inner">
    <h3>Why patients choose <strong>Don’t</strong> <em style="color:var(--sky)">Weight</em></h3>
    <ul>
      <li>Medical-led programmes supervised by experienced healthcare professionals</li>
      <li>Thorough assessment before prescribing any medication</li>
      <li>Focus on patient safety, effectiveness, and long-term outcomes</li>
      <li>Access to blood tests, health checks, ultrasound scans, and diagnostics through London Private Ultrasound</li>
      <li>Support for obesity, diabetes, pre-diabetes, PCOS, metabolic syndrome, and weight-related conditions</li>
      <li>Ongoing follow-up appointments and personalised treatment adjustments</li>
      <li>Same-day appointments available in London</li>
      <li>No GP referral required</li>
    </ul>
  </div>
</section>

<!-- ALI DETAILED BIO -->
<section class="ab-ali-detail">
  <div class="ab-ali-detail-inner">
    <h3>More about Ali Aghaei</h3>
    <p>Ali is a GPhC-registered pharmacist with a specialist focus on diabetes, obesity, metabolic health, and medical weight management. He founded <strong>Don’t</strong> <em style="color:var(--sky)">Weight</em> to bridge the gap between accessible treatment and proper clinical oversight.</p>
    <p>His experience spans:</p>
    <ul>
      <li>Prescription weight loss treatment and GLP-1 therapies</li>
      <li>Type 2 diabetes and insulin resistance management</li>
      <li>Obesity-related health conditions</li>
      <li>Medication management and optimisation</li>
      <li>Lifestyle and nutrition guidance</li>
    </ul>
    <p>Ali’s philosophy is simple: every patient deserves an individualised plan based on their medical history, current health, goals, and risk profile. No shortcuts, no generic protocols.</p>
    <p>Through Don’t Weight, Ali works closely with the wider team at London Private Ultrasound to offer a complete service — including blood testing, health screening, and diagnostic investigations where needed.</p>
  </div>
</section>

<!-- OUR MISSION -->
<section class="ab-mission">
  <div class="ab-mission-inner">
    <h3>Our mission</h3>
    <p>To provide safe, accessible, and patient-centred medical weight loss treatment backed by clinical expertise and advanced diagnostics.</p>
    <p>As part of London Private Ultrasound, we go far beyond medication alone:</p>
    <div class="ab-mission-services">
      <div class="ab-mission-service">Private blood tests</div>
      <div class="ab-mission-service">Diagnostic ultrasound scans</div>
      <div class="ab-mission-service">Comprehensive health check-ups</div>
      <div class="ab-mission-service">Diabetes &amp; metabolic assessment</div>
      <div class="ab-mission-service">Ongoing medical monitoring</div>
    </div>
  </div>
</section>

<!-- FINAL CTA -->
<section class="sec ab-final">
  <h2>Ready to start?</h2>
  <p>Free consultation, no commitment. Your clinician reviews your profile within 24 hours.</p>
  <a href="<?php echo home_url('/consultation/'); ?>" class="ab-btn-w">Start free consultation &rarr;</a>
</section>

<!-- FOOTER -->
<?php include(get_template_directory() . '/footer.php'); ?>

<script>
function toggleMobileMenu(){document.getElementById('mobileMenu').classList.toggle('open');document.body.style.overflow=document.getElementById('mobileMenu').classList.contains('open')?'hidden':''}
function closeMobileMenu(){document.getElementById('mobileMenu').classList.remove('open');document.body.style.overflow=''}
</script>
<?php wp_footer(); ?>
</body>
</html>
