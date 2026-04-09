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
<link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/favicon.svg">
<title>About Us — Don't Weight | Private Medical Weight Loss Clinic London</title>
<meta name="description" content="Don't Weight is a CQC-registered medical weight loss clinic in London, part of London Private Ultrasound Group. Clinician-led GLP-1 treatment with full medical assessment and health screening.">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=optional" rel="stylesheet">
<?php wp_head(); ?>
<style>
.dw-lpug-bar{display:none!important;}
:root{--sky:#38BDF8;--sky-deep:#0EA5E9;--sky-dark:#0284C7;--sky-pale:#E0F2FE;--sky-wash:#F0F9FF;--white:#FFFFFF;--cream:#FAFAF9;--warm:#F5F5F4;--stone:#E7E5E4;--ink:#0C0A09;--charcoal:#1C1917;--slate:#44403C;--display:'DM Sans',-apple-system,sans-serif;--body:'DM Sans',-apple-system,sans-serif}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}html{scroll-behavior:smooth}body{background:var(--white);color:var(--ink);font-family:var(--body);font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased}
.nav{position:fixed;top:0;left:0;right:0;z-index:100;height:56px;display:flex;align-items:center;justify-content:space-between;padding:0 clamp(16px,4vw,48px);background:#fff;backdrop-filter:blur(20px);border-bottom:1px solid rgba(0,0,0,.04)}
.nav-logo{font-family:var(--display);font-size:22px;font-weight:700;color:var(--ink);text-decoration:none;letter-spacing:-.8px}.nav-logo i{color:var(--sky);font-style:italic;font-weight:400}
.nav-mid{display:flex;gap:32px;list-style:none}.nav-mid a{color:var(--slate);text-decoration:none;font-size:13px;font-weight:500;transition:color .2s}.nav-mid a:hover,.nav-mid a.active{color:var(--sky-deep);font-weight:600}
.nav-r{display:flex;align-items:center;gap:16px}
.nav-login{color:var(--ink);text-decoration:none;font-size:13px;font-weight:600}
.nav-btn{background:var(--sky);color:#fff;border:none;border-radius:100px;padding:10px 24px;font-family:var(--body);font-size:13px;font-weight:600;cursor:pointer;text-decoration:none}
.burger{display:none;background:none;border:none;cursor:pointer;width:32px;height:32px;position:relative;z-index:102}.burger span{display:block;width:20px;height:1.5px;background:var(--ink);position:absolute;left:6px;transition:transform .3s,opacity .2s}.burger span:nth-child(1){top:10px}.burger span:nth-child(2){top:16px}.burger span:nth-child(3){top:22px}
.mobile-menu{position:fixed;inset:0;z-index:101;background:var(--white);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:24px;opacity:0;pointer-events:none;transition:opacity .3s}.mobile-menu.open{opacity:1;pointer-events:all}.mobile-menu a{font-size:22px;font-weight:600;color:var(--ink);text-decoration:none}.mobile-menu .mm-cta{background:var(--sky);color:#fff;border:none;border-radius:100px;padding:16px 48px;font-size:16px;font-weight:700;cursor:pointer}.mm-close{position:absolute;top:max(16px,env(safe-area-inset-top,16px));right:20px;background:var(--warm);border:none;font-size:32px;color:var(--ink);cursor:pointer;width:48px;height:48px;display:flex;align-items:center;justify-content:center;border-radius:50%;z-index:102}
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

@media(max-width:768px){.ab-grid{grid-template-columns:1fr}.ab-cards,.ab-cred-grid,.ab-hc-stats{grid-template-columns:1fr}.ab-cond-grid{grid-template-columns:1fr!important}.ft-top{grid-template-columns:1fr 1fr;gap:24px}}
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
  <div class="label" style="color:var(--sky);text-align:center">Private Medical Weight Loss Clinic</div>
  <h1>Medication and monitoring. <span>Together.</span></h1>
  <p class="ab-hero-sub">A CQC-registered weight management clinic combining clinician-prescribed treatment with full medical assessment, blood tests, and structured health monitoring. Part of London Private Ultrasound Group.</p>
  <div class="ab-stats" style="display:flex;justify-content:center;gap:clamp(10px,2vw,16px);flex-wrap:wrap;margin-top:20px">
    <span style="font-size:11px;color:var(--slate);border:1px solid var(--stone);padding:6px 14px;border-radius:20px">CQC Regulated</span>
    <span style="font-size:11px;color:var(--slate);border:1px solid var(--stone);padding:6px 14px;border-radius:20px">MHRA Approved</span>
    <span style="font-size:11px;color:var(--slate);border:1px solid var(--stone);padding:6px 14px;border-radius:20px">4.8★ Google</span>
    <span style="font-size:11px;color:var(--slate);border:1px solid var(--stone);padding:6px 14px;border-radius:20px">Transparent Pricing</span>
  </div>
</section>

<!-- MISSION -->
<section class="sec" style="background:var(--white)">
  <div class="sec-inner">
    <div class="ab-grid">
      <div>
        <div class="label">Our approach</div>
        <h2>Full medical assessment. <span>Then treatment.</span></h2>
        <p style="font-size:14px;color:var(--slate);line-height:1.8;margin-bottom:14px">Unlike many online weight loss providers, we don&rsquo;t prescribe medication based on a questionnaire alone. Before starting treatment, every patient undergoes a detailed consultation, medical history review, and where appropriate, blood tests, health screening, and diagnostic assessment.</p>
        <p style="font-size:14px;color:var(--slate);line-height:1.8;margin-bottom:14px">GLP-1 medications like Mounjaro and Wegovy are transforming lives. But rapid weight loss triggers real changes in your liver, gallbladder, thyroid, and cardiovascular system. That&rsquo;s why we monitor what&rsquo;s happening inside &mdash; not just what the scale says.</p>
        <p style="font-size:14px;color:var(--slate);line-height:1.8">This allows us to ensure that weight loss medication is both safe and suitable for each individual, and to catch anything that needs attention early.</p>
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
      <p style="font-size:14px;color:var(--slate);max-width:520px;margin:0 auto">What separates a medically supervised weight loss programme from an online prescription service.</p>
    </div>
    <div class="ab-cards">
      <div class="ab-card">
        <div class="ab-card-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg></div>
        <h3>Careful assessment first</h3>
        <p>Full medical history review and clinical consultation before prescribing anything. We assess eligibility, check for contraindications, and identify underlying conditions like insulin resistance or thyroid issues.</p>
      </div>
      <div class="ab-card">
        <div class="ab-card-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
        <h3>Ongoing clinical support</h3>
        <p>Your clinician monitors your progress, reviews side effects, and adjusts medication when needed. Care team available 7 days a week. Not a one-size-fits-all prescription.</p>
      </div>
      <div class="ab-card">
        <div class="ab-card-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg></div>
        <h3>Integrated diagnostics</h3>
        <p>Access to blood tests, ultrasound scans, ECG, and comprehensive health checks through London Private Ultrasound. We track what the medication is doing to your body, not just your weight.</p>
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

<!-- CONDITIONS WE SUPPORT -->
<section class="sec" style="background:var(--cream)">
  <div class="sec-inner">
    <div style="text-align:center;margin-bottom:36px">
      <div class="label">Who we help</div>
      <h2>Specialist support for <span>complex conditions</span></h2>
      <p style="font-size:14px;color:var(--slate);max-width:520px;margin:0 auto">We treat the person, not just the number on the scale. Our clinicians have experience across a range of weight-related and metabolic conditions.</p>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px" class="ab-cond-grid">
      <div style="background:var(--white);border:1px solid var(--stone);border-radius:14px;padding:20px 18px">
        <h4 style="font-size:14px;font-weight:700;color:var(--ink);margin-bottom:6px">Obesity &amp; weight management</h4>
        <p style="font-size:12px;color:var(--slate);line-height:1.6">Evidence-based treatment for patients with a BMI of 30+ or 27+ with weight-related health conditions.</p>
      </div>
      <div style="background:var(--white);border:1px solid var(--stone);border-radius:14px;padding:20px 18px">
        <h4 style="font-size:14px;font-weight:700;color:var(--ink);margin-bottom:6px">Type 2 diabetes</h4>
        <p style="font-size:12px;color:var(--slate);line-height:1.6">GLP-1 therapies that help manage blood sugar and support weight loss simultaneously.</p>
      </div>
      <div style="background:var(--white);border:1px solid var(--stone);border-radius:14px;padding:20px 18px">
        <h4 style="font-size:14px;font-weight:700;color:var(--ink);margin-bottom:6px">Insulin resistance</h4>
        <p style="font-size:12px;color:var(--slate);line-height:1.6">Targeted treatment for patients whose insulin resistance is contributing to weight gain.</p>
      </div>
      <div style="background:var(--white);border:1px solid var(--stone);border-radius:14px;padding:20px 18px">
        <h4 style="font-size:14px;font-weight:700;color:var(--ink);margin-bottom:6px">PCOS</h4>
        <p style="font-size:12px;color:var(--slate);line-height:1.6">Weight management support for polycystic ovary syndrome, where hormonal imbalance makes losing weight harder.</p>
      </div>
      <div style="background:var(--white);border:1px solid var(--stone);border-radius:14px;padding:20px 18px">
        <h4 style="font-size:14px;font-weight:700;color:var(--ink);margin-bottom:6px">Metabolic syndrome</h4>
        <p style="font-size:12px;color:var(--slate);line-height:1.6">Clinician-led treatment addressing the cluster of conditions that increase heart disease, stroke, and diabetes risk.</p>
      </div>
      <div style="background:var(--white);border:1px solid var(--stone);border-radius:14px;padding:20px 18px">
        <h4 style="font-size:14px;font-weight:700;color:var(--ink);margin-bottom:6px">Pre-diabetes</h4>
        <p style="font-size:12px;color:var(--slate);line-height:1.6">Early intervention with weight loss treatment to help prevent progression to type 2 diabetes.</p>
      </div>
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
      <p class="ab-founder-role">Founder &amp; Clinical Director, GPhC-Registered Pharmacist</p>
      <p>I started <strong>Don’t</strong> <em style="color:var(--sky)">Weight</em> because I believe everyone deserves access to proper, clinician-led weight management. Having worked across the NHS and private sector, I saw too many patients receiving prescriptions with minimal follow-up &mdash; and an opportunity to build something better.</p>
      <p>As part of London Private Ultrasound Group, we can offer what most weight loss clinics can&rsquo;t: full diagnostic capability alongside treatment. Blood tests, health screening, ultrasound &mdash; everything under one roof. Every patient gets a dedicated clinician, evidence-based treatment, and ongoing support that actually fits their life.</p>
      <p>This isn’t about quick fixes. It’s about safe, medically supervised weight loss with the clinical infrastructure to support you at every stage.</p>
    </div>
  </div>
</section>


<!-- THE CLINIC -->
<section class="ab-clinic">
  <div class="ab-clinic-inner">
    <span class="ab-clinic-label">The Clinic</span>
    <h2>Medical weight loss. Done properly.</h2>
    <p><strong>Don’t</strong> <em style="color:var(--sky)">Weight</em> is the specialist medical weight loss division of London Private Ultrasound Group and UK Health Check. We provide safe, evidence-based weight management programmes for patients across London and the UK who want to lose weight under the supervision of qualified healthcare professionals.</p>
    <p>Every patient gets a detailed consultation, full medical history review, and where needed, blood tests, health screening, and diagnostic assessment &mdash; before we prescribe anything. This allows us to ensure that treatment is both safe and suitable for each individual, and to identify any underlying conditions that may affect weight loss.</p>
    <p>We specialise in modern prescription weight loss treatments, including MHRA-approved GLP-1 medications used for obesity, insulin resistance, and type 2 diabetes-related weight gain. Our programmes are designed for patients who want expert clinical guidance rather than a one-size-fits-all approach.</p>
    <p>Our integrated approach helps identify conditions that may be contributing to weight gain or affecting treatment response &mdash; including thyroid problems, hormonal imbalance, fatty liver disease, PCOS, and other metabolic disorders. As part of London Private Ultrasound Group, we have direct access to diagnostic investigations that most weight loss clinics simply cannot offer.</p>
  </div>
</section>

<!-- WHY CHOOSE US -->
<section class="ab-clinic-why">
  <div class="ab-clinic-why-inner">
    <h3>Why patients choose <strong>Don’t</strong> <em style="color:var(--sky)">Weight</em></h3>
    <ul>
      <li>Medical-led weight loss programmes supervised by experienced UK healthcare professionals</li>
      <li>Careful clinical assessment before prescribing any medication &mdash; not just a questionnaire</li>
      <li>Focus on patient safety, treatment effectiveness, and long-term sustainable results</li>
      <li>Direct access to private blood tests, health checks, ultrasound scans, and diagnostic imaging through London Private Ultrasound Group</li>
      <li>Specialist support for patients with obesity, type 2 diabetes, pre-diabetes, PCOS, metabolic syndrome, and insulin resistance</li>
      <li>Ongoing follow-up consultations and personalised dose and treatment adjustments</li>
      <li>Same-day appointments available at our London clinic</li>
      <li>No GP referral required &mdash; self-refer directly</li>
      <li>Discreet next-day delivery from a GPhC-registered UK pharmacy</li>
      <li>Every medication MHRA-approved and clinician-prescribed</li>
    </ul>
  </div>
</section>

<!-- ALI DETAILED BIO -->
<section class="ab-ali-detail">
  <div class="ab-ali-detail-inner">
    <h3>More about Ali Aghaei</h3>
    <p>Ali is a GPhC-registered pharmacist with a specialist focus on diabetes, obesity, metabolic health, and medical weight management. He founded <strong>Don’t</strong> <em style="color:var(--sky)">Weight</em> to bridge the gap between accessible treatment and proper clinical oversight &mdash; and plays a leading role in developing the clinic&rsquo;s safe, medically supervised approach to weight management.</p>
    <p>His clinical experience spans:</p>
    <ul>
      <li>Prescription weight loss treatment and GLP-1 therapies (Mounjaro, Wegovy)</li>
      <li>Type 2 diabetes and insulin resistance management</li>
      <li>Obesity-related health conditions and metabolic syndrome</li>
      <li>Medication management, optimisation, and dose titration</li>
      <li>Lifestyle, nutrition, and behavioural support</li>
    </ul>
    <p>Ali&rsquo;s clinical focus is to ensure that every patient receives an individualised treatment plan based on their medical history, current health, goals, and risk factors. Unlike many commercial weight loss services that prescribe medication with limited follow-up, his approach prioritises comprehensive, ongoing care &mdash; every patient is assessed carefully before treatment begins, monitored during treatment, and reviewed regularly.</p>
    <p>Through Don’t Weight, Ali works closely with the wider clinical team at London Private Ultrasound Group to provide a complete service &mdash; including blood testing, health screening, and diagnostic investigations where needed. His goal is to help patients lose weight safely, improve their long-term health, reduce the risk of obesity-related disease, and achieve results they can maintain.</p>
  </div>
</section>

<!-- OUR MISSION -->
<section class="ab-mission">
  <div class="ab-mission-inner">
    <h3>Our mission</h3>
    <p>To provide safe, accessible, and patient-centred medical weight loss treatment backed by clinical expertise and advanced diagnostics.</p>
    <p>As part of London Private Ultrasound Group, we go far beyond weight loss medication alone. Our integrated approach helps identify and address underlying health conditions that affect weight &mdash; giving patients and their clinicians the full picture.</p>
    <div class="ab-mission-services">
      <div class="ab-mission-service">Private blood tests</div>
      <div class="ab-mission-service">Diagnostic ultrasound scans</div>
      <div class="ab-mission-service">Comprehensive health check-ups</div>
      <div class="ab-mission-service">Diabetes &amp; metabolic assessment</div>
      <div class="ab-mission-service">Thyroid &amp; hormonal screening</div>
      <div class="ab-mission-service">Fatty liver assessment</div>
      <div class="ab-mission-service">Cardiovascular health monitoring</div>
      <div class="ab-mission-service">Ongoing clinical follow-up</div>
      <div class="ab-mission-service">Weight management nutrition guidance</div>
    </div>
  </div>
</section>

<!-- FINAL CTA -->
<section class="sec ab-final">
  <h2>Ready to start?</h2>
  <p>Free consultation, no commitment. Your clinician reviews your profile within 24 hours.</p>
  <a href="<?php echo home_url('/#calculator'); ?>" class="ab-btn-w">Check your eligibility &rarr;</a>
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
