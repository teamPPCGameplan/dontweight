<?php
/**
 * Template Name: Ads Landing Page
 * Description: High-converting Google/Meta Ads landing page — ASA + MHRA compliant
 * Version: 2.0
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Free Weight Loss Consultation — UK Clinicians | don't weight</title>
<meta name="description" content="Check if you qualify for clinician-prescribed weight management in 2 minutes. CQC registered, MHRA approved. Free eligibility check.">
<meta name="robots" content="noindex, nofollow">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=optional" rel="stylesheet">
<?php wp_head(); ?>
<style>
:root{--sky:#38BDF8;--sky-deep:#0EA5E9;--sky-dark:#0284C7;--sky-pale:#E0F2FE;--sky-wash:#F0F9FF;--white:#FFFFFF;--cream:#FAFAF9;--warm:#F5F5F4;--stone:#E7E5E4;--ink:#0C0A09;--charcoal:#1C1917;--slate:#44403C;--green:#22C55E;--display:'DM Sans',-apple-system,sans-serif;--body:'DM Sans',-apple-system,sans-serif}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}html{scroll-behavior:smooth}body{background:var(--white);color:var(--ink);font-family:var(--body);font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased;overflow-x:hidden}
.lp-nav{position:fixed;top:0;left:0;right:0;z-index:100;height:56px;display:flex;align-items:center;justify-content:space-between;padding:0 clamp(16px,4vw,48px);background:rgba(255,255,255,.97);backdrop-filter:blur(20px);border-bottom:1px solid rgba(0,0,0,.04)}
.lp-logo{font-family:var(--display);font-size:22px;font-weight:700;color:var(--ink);text-decoration:none;letter-spacing:-.8px}.lp-logo i{color:var(--sky);font-style:italic;font-weight:400}
.lp-nav-cta{background:var(--sky);color:#fff;border:none;border-radius:100px;padding:10px 24px;font-family:var(--body);font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;transition:background .2s}.lp-nav-cta:hover{background:var(--sky-deep)}
.lp-hero{padding:clamp(90px,14vw,140px) clamp(20px,5vw,56px) clamp(48px,6vw,64px);text-align:center;background:linear-gradient(180deg,var(--white) 0%,var(--sky-wash) 100%)}
.lp-badge{display:inline-flex;align-items:center;gap:8px;background:var(--white);border:1px solid var(--sky-pale);padding:7px 16px;border-radius:100px;font-size:12px;font-weight:600;color:var(--ink);margin-bottom:clamp(20px,3vw,28px);box-shadow:0 2px 8px rgba(56,189,248,.08)}
.lp-badge .dot{width:7px;height:7px;border-radius:50%;background:var(--green)}
.lp-hero h1{font-family:var(--display);font-size:clamp(32px,5.5vw,56px);font-weight:700;line-height:1.08;letter-spacing:-1.5px;color:var(--ink);margin-bottom:clamp(14px,2vw,20px);max-width:640px;margin-left:auto;margin-right:auto}
.lp-hero h1 span{color:var(--sky-deep)}
.lp-sub{font-size:clamp(15px,1.3vw,18px);color:var(--slate);max-width:460px;margin:0 auto clamp(24px,3vw,32px);line-height:1.6;font-weight:500}
.lp-cta{display:inline-flex;align-items:center;gap:10px;background:var(--sky);color:#fff;border:none;border-radius:100px;padding:16px 40px;font-family:var(--body);font-size:16px;font-weight:700;cursor:pointer;transition:all .25s;box-shadow:0 6px 24px rgba(56,189,248,.25);text-decoration:none}.lp-cta:hover{background:var(--sky-deep);transform:translateY(-2px);box-shadow:0 12px 36px rgba(56,189,248,.30)}
.lp-note{font-size:12px;color:var(--slate);margin-top:14px;font-weight:500}
.lp-trust{padding:clamp(20px,3vw,32px) clamp(20px,5vw,56px);background:var(--white);border-top:1px solid var(--stone);border-bottom:1px solid var(--stone)}
.lp-trust-inner{max-width:700px;margin:0 auto;display:flex;justify-content:center;gap:clamp(24px,4vw,48px);flex-wrap:wrap}
.lp-trust-item{display:flex;align-items:center;gap:10px;font-size:13px;font-weight:600;color:var(--ink)}
.lp-ti{width:32px;height:32px;border-radius:8px;background:var(--sky-wash);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.lp-checker{padding:clamp(48px,6vw,72px) clamp(20px,5vw,56px);background:var(--cream)}
.lp-checker-inner{max-width:480px;margin:0 auto;text-align:center}
.lp-checker-card{background:var(--white);border:1.5px solid var(--stone);border-radius:20px;padding:clamp(28px,4vw,40px);box-shadow:0 8px 32px rgba(0,0,0,.04)}
.lp-unit-toggle{display:flex;gap:4px;background:var(--warm);border-radius:100px;padding:3px;margin:0 auto 20px;width:fit-content}
.lp-unit-btn{background:none;border:none;padding:8px 20px;border-radius:100px;font-family:var(--body);font-size:12px;font-weight:600;cursor:pointer;color:var(--slate);transition:all .2s}
.lp-unit-btn.active{background:var(--white);color:var(--ink);box-shadow:0 1px 4px rgba(0,0,0,.08)}
.lp-input{width:100%;background:var(--warm);border:1.5px solid var(--stone);border-radius:12px;padding:14px 16px;font-family:var(--body);font-size:15px;margin-bottom:12px;outline:none;transition:border-color .2s}.lp-input:focus{border-color:var(--sky)}
.lp-check-btn{width:100%;background:var(--ink);color:#fff;border:none;border-radius:100px;padding:16px;font-family:var(--body);font-size:15px;font-weight:700;cursor:pointer;transition:all .2s;margin-top:8px}.lp-check-btn:hover{background:var(--charcoal)}
.lp-check-skip{display:block;margin-top:14px;font-size:13px;color:var(--slate);text-decoration:underline;cursor:pointer}
.lp-check-legal{font-size:11px;color:var(--slate);margin-top:16px;line-height:1.5}.lp-check-legal a{color:var(--sky-deep)}
.lp-result-num{font-family:var(--display);font-size:48px;font-weight:700;color:var(--sky-deep);letter-spacing:-2px;margin:16px 0 4px}
.lp-section{padding:clamp(48px,6vw,72px) clamp(20px,5vw,56px)}
.lp-section-label{font-size:10px;letter-spacing:2.5px;text-transform:uppercase;color:var(--sky-deep);font-weight:700;text-align:center;margin-bottom:8px}
.lp-section-title{font-family:var(--display);font-size:clamp(22px,3vw,32px);font-weight:700;text-align:center;letter-spacing:-.6px;margin-bottom:clamp(28px,4vw,40px)}
.lp-steps{display:grid;grid-template-columns:repeat(3,1fr);gap:clamp(16px,3vw,28px);max-width:720px;margin:0 auto}
.lp-step{text-align:center;padding:24px 16px;background:var(--white);border:1px solid var(--stone);border-radius:16px;transition:all .3s}.lp-step:hover{border-color:var(--sky);box-shadow:0 8px 24px rgba(56,189,248,.08)}
.lp-step-num{width:40px;height:40px;border-radius:50%;background:var(--sky);color:#fff;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-family:var(--display);font-size:16px;font-weight:700}
.lp-step h3{font-size:15px;font-weight:700;margin-bottom:6px}.lp-step p{font-size:12px;color:var(--slate);line-height:1.5}
.lp-why-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:14px;max-width:640px;margin:0 auto}
.lp-why-card{background:var(--sky-wash);border:1px solid var(--sky-pale);border-radius:14px;padding:clamp(18px,2.5vw,24px);transition:all .3s}.lp-why-card:hover{background:var(--sky-pale);transform:translateY(-2px)}
.lp-why-card h4{font-size:14px;font-weight:700;margin-bottom:6px;display:flex;align-items:center;gap:8px}.lp-why-card p{font-size:12px;color:var(--slate);line-height:1.5}
.lp-icon{width:28px;height:28px;border-radius:8px;background:var(--sky);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.lp-icon svg{width:14px;height:14px;fill:none;stroke:#fff;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.lp-social{padding:clamp(48px,6vw,72px) clamp(20px,5vw,56px);background:var(--ink);color:#fff;text-align:center}
.lp-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;max-width:600px;margin:0 auto clamp(28px,4vw,40px)}
.lp-stat h3{font-family:var(--display);font-size:clamp(24px,3.5vw,36px);font-weight:700;color:var(--sky);margin-bottom:4px;letter-spacing:-1px}.lp-stat p{font-size:10px;color:rgba(255,255,255,.5)}
.lp-quote{font-style:italic;font-size:clamp(16px,1.8vw,20px);max-width:500px;margin:0 auto 16px;line-height:1.5;color:rgba(255,255,255,.85)}
.lp-author{font-size:12px;color:rgba(255,255,255,.45)}
.lp-price{padding:clamp(40px,5vw,56px) clamp(20px,5vw,56px);background:var(--sky-wash);text-align:center}
.lp-price-card{max-width:400px;margin:0 auto;background:var(--white);border:1.5px solid var(--sky-pale);border-radius:20px;padding:clamp(28px,4vw,36px);box-shadow:0 4px 20px rgba(56,189,248,.08)}
.lp-price-num{font-family:var(--display);font-size:42px;font-weight:700;color:var(--ink);letter-spacing:-2px}.lp-price-num span{font-size:16px;font-weight:500;color:var(--slate)}
.lp-price-per{font-size:13px;color:var(--slate);margin-bottom:20px}
.lp-price-includes{text-align:left;margin-bottom:20px;list-style:none}.lp-price-includes li{font-size:13px;color:var(--slate);margin-bottom:6px;padding-left:20px;position:relative}.lp-price-includes li::before{content:'✓';position:absolute;left:0;color:var(--sky-deep);font-weight:700;font-size:12px}
.lp-final{padding:clamp(48px,7vw,80px) clamp(20px,5vw,56px);text-align:center;background:linear-gradient(160deg,var(--sky) 0%,var(--sky-deep) 50%,var(--sky-dark) 100%);color:#fff}
.lp-final h2{font-family:var(--display);font-size:clamp(24px,3.5vw,40px);font-weight:700;letter-spacing:-1px;margin-bottom:12px}
.lp-final p{font-size:14px;color:rgba(255,255,255,.75);margin-bottom:24px;max-width:400px;margin-left:auto;margin-right:auto}
.lp-cta-white{background:#fff;color:var(--sky-dark);border:none;border-radius:100px;padding:16px 40px;font-family:var(--body);font-size:15px;font-weight:700;cursor:pointer;transition:all .2s;box-shadow:0 4px 16px rgba(0,0,0,.1);text-decoration:none;display:inline-block}.lp-cta-white:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(0,0,0,.15)}
.lp-footer{background:var(--charcoal);padding:24px clamp(20px,5vw,56px);text-align:center;color:rgba(255,255,255,.35);font-size:10px}.lp-footer a{color:rgba(255,255,255,.45);text-decoration:underline}.lp-footer-links{display:flex;justify-content:center;gap:16px;flex-wrap:wrap;margin-bottom:8px}
@media(max-width:768px){.lp-steps{grid-template-columns:1fr;gap:12px;max-width:340px}.lp-why-grid{grid-template-columns:1fr}.lp-stats{grid-template-columns:1fr 1fr;gap:14px}}
@media(max-width:600px){.lp-hero{padding:80px 20px 40px}.lp-hero h1{font-size:34px;letter-spacing:-1.2px}.lp-cta{width:100%;justify-content:center;padding:18px 28px;border-radius:14px}.lp-nav-cta{padding:8px 16px;font-size:12px}.lp-trust-inner{gap:16px}.lp-trust-item{font-size:11px}}
@keyframes fadeUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}.anim{opacity:0;animation:fadeUp .5s ease forwards}.d1{animation-delay:.1s}.d2{animation-delay:.2s}.d3{animation-delay:.3s}.d4{animation-delay:.35s}
</style>
</head>
<body>
<nav class="lp-nav"><a href="<?php echo home_url(); ?>" class="lp-logo">don't <i>weight</i></a><a href="#checker" class="lp-nav-cta">Check eligibility</a></nav>

<section class="lp-hero">
  <div class="lp-badge anim"><span class="dot"></span>CQC Registered &middot; MHRA Approved</div>
  <h1 class="anim d1">The UK's most trusted <span>weight management</span> programme</h1>
  <p class="lp-sub anim d2">See how much you could lose. Free eligibility check &mdash; takes 30 seconds. No commitment.</p>
  <div class="anim d3"><a href="#checker" class="lp-cta" style="background:var(--ink);box-shadow:0 6px 24px rgba(0,0,0,.15);padding:20px 48px;font-size:18px">Check my eligibility &mdash; it's free &rarr;</a></div>
  <div class="anim d4" style="display:flex;align-items:center;justify-content:center;gap:20px;flex-wrap:wrap;margin-top:20px">
    <span style="font-size:12px;color:var(--slate);font-weight:600">4.8★ Google</span>
    <span style="font-size:12px;color:var(--slate)">&#183;</span>
    <span style="font-size:12px;color:var(--slate);font-weight:600">CQC Registered</span>
    <span style="font-size:12px;color:var(--slate)">&#183;</span>
    <span style="font-size:12px;color:var(--slate);font-weight:600">Results in 24h</span>
    <span style="font-size:12px;color:var(--slate)">&#183;</span>
    <span style="font-size:12px;color:var(--slate);font-weight:600">Free delivery</span>
  </div>
</section>

<section class="lp-checker" id="checker"><div class="lp-checker-inner">
  <div class="lp-section-label">Free Assessment</div>
  <h2 style="font-family:var(--display);font-size:clamp(22px,3vw,30px);font-weight:700;letter-spacing:-.5px;text-align:center;margin-bottom:6px">See what you could lose</h2>
  <p style="font-size:14px;color:var(--slate);text-align:center;margin-bottom:24px">Takes 30 seconds. No payment. No obligation.</p>
  <div class="lp-checker-card" id="checkerForm">
    <div class="lp-unit-toggle"><button class="lp-unit-btn active" onclick="setU('metric',this)">Metric</button><button class="lp-unit-btn" onclick="setU('imperial',this)">Imperial</button></div>
    <div id="metricF"><input class="lp-input" id="lpHeight" type="number" placeholder="Height (cm)" min="100" max="250"><input class="lp-input" id="lpWeight" type="number" placeholder="Weight (kg)" min="40" max="300"></div>
    <div id="imperialF" style="display:none"><div style="display:flex;gap:8px;margin-bottom:12px"><input class="lp-input" id="lpFt" type="number" placeholder="Feet" min="4" max="7" style="margin-bottom:0"><input class="lp-input" id="lpIn" type="number" placeholder="Inches" min="0" max="11" style="margin-bottom:0"></div><div style="display:flex;gap:8px"><input class="lp-input" id="lpSt" type="number" placeholder="Stone" min="5" max="50" style="margin-bottom:0"><input class="lp-input" id="lpLbs" type="number" placeholder="Lbs" min="0" max="13" style="margin-bottom:0"></div></div>
    <input class="lp-input" id="lpEmail" type="email" placeholder="Email address" style="margin-top:12px">
    <button class="lp-check-btn" onclick="checkE()">Check if I qualify &rarr;</button>
    <a class="lp-check-skip" href="<?php echo home_url('/consultation/'); ?>">Skip &mdash; go straight to full consultation</a>
    <p class="lp-check-legal">We'll use your details to check eligibility. By entering I agree to the <a href="<?php echo home_url('/terms/'); ?>">Terms</a> &amp; <a href="<?php echo home_url('/privacy-policy/'); ?>">Privacy Policy</a>.</p>
  </div>
  <div class="lp-checker-card" id="checkerResult" style="display:none;text-align:center">
    <div style="font-size:14px;color:var(--slate);margin-bottom:4px">Based on clinical data, you could lose up to</div>
    <div class="lp-result-num" id="resKg">&mdash;</div>
    <div style="font-size:16px;color:var(--slate);margin-bottom:4px">in 10 months</div>
    <div style="font-size:12px;color:var(--sky-deep);font-weight:600;margin-bottom:20px">Approximately <span id="resPct">&mdash;</span> of your body weight</div>
    <svg id="rGraph" viewBox="0 0 360 150" style="width:100%;height:auto;margin-bottom:20px" xmlns="http://www.w3.org/2000/svg">
      <defs><linearGradient id="gF" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#38BDF8" stop-opacity=".12"/><stop offset="100%" stop-color="#38BDF8" stop-opacity=".01"/></linearGradient></defs>
      <line x1="40" y1="20" x2="340" y2="20" stroke="#E7E5E4" stroke-width=".5"/><line x1="40" y1="55" x2="340" y2="55" stroke="#E7E5E4" stroke-width=".5"/><line x1="40" y1="90" x2="340" y2="90" stroke="#E7E5E4" stroke-width=".5"/>
      <text id="gY1" x="36" y="24" font-size="9" fill="#A8A29E" text-anchor="end" font-family="DM Sans,sans-serif"></text>
      <text id="gY2" x="36" y="59" font-size="9" fill="#A8A29E" text-anchor="end" font-family="DM Sans,sans-serif"></text>
      <text id="gY3" x="36" y="94" font-size="9" fill="#A8A29E" text-anchor="end" font-family="DM Sans,sans-serif"></text>
      <text x="55" y="125" font-size="9" fill="#A8A29E" text-anchor="middle" font-family="DM Sans,sans-serif">Now</text>
      <text x="130" y="125" font-size="9" fill="#A8A29E" text-anchor="middle" font-family="DM Sans,sans-serif">3 mo</text>
      <text x="210" y="125" font-size="9" fill="#A8A29E" text-anchor="middle" font-family="DM Sans,sans-serif">6 mo</text>
      <text x="330" y="125" font-size="9" fill="#0EA5E9" text-anchor="middle" font-family="DM Sans,sans-serif" font-weight="600">10 mo</text>
      <path id="gA" d="" fill="url(#gF)"/><path id="gL" d="" fill="none" stroke="#0EA5E9" stroke-width="2.5" stroke-linecap="round"/>
      <circle id="gD1" cx="55" cy="20" r="4" fill="#0EA5E9" opacity=".4"/><circle id="gD2" cx="330" cy="90" r="5" fill="#0EA5E9" stroke="#fff" stroke-width="2"/>
      <rect id="gB" x="270" y="64" width="52" height="22" rx="6" fill="#0EA5E9"/><text id="gBT" x="296" y="79" font-size="11" fill="white" text-anchor="middle" font-family="DM Sans,sans-serif" font-weight="700"></text>
    </svg>
    <div style="font-size:11px;color:var(--slate);margin-bottom:20px;line-height:1.5">Results based on clinical trial averages. Individual results vary.</div>
    <a href="<?php echo home_url('/consultation/'); ?>" class="lp-check-btn" style="display:block;text-align:center;text-decoration:none;color:#fff;background:var(--sky)">Start my consultation &rarr;</a>
    <div style="font-size:11px;color:var(--slate);margin-top:10px">From just <strong>&pound;3.80/day</strong> &middot; Cancel anytime &middot; Refund if not eligible</div>
  </div>
</div></section>

<section class="lp-section" style="background:var(--white)"><div class="lp-section-label">How It Works</div><h2 class="lp-section-title">Getting started is simple</h2><div class="lp-steps">
  <div class="lp-step"><div class="lp-step-num">1</div><h3>Quick assessment</h3><p>Answer a few health questions. 2 minutes, completely free.</p></div>
  <div class="lp-step"><div class="lp-step-num">2</div><h3>Clinician review</h3><p>A UK-registered clinician reviews your profile within 24 hours.</p></div>
  <div class="lp-step"><div class="lp-step-num">3</div><h3>Treatment delivered</h3><p>If approved, your plan arrives next day. Free delivery.</p></div>
</div></section>

<section class="lp-section" style="background:var(--cream)"><div class="lp-section-label">Why don't weight</div><h2 class="lp-section-title">Most programmes stop at medication. We don't.</h2><div class="lp-why-grid">
  <div class="lp-why-card"><h4><div class="lp-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M8 12l3 3 5-5"/></svg></div>Personalised</h4><p>Your clinician recommends the best approach for your body, goals, and history.</p></div>
  <div class="lp-why-card"><h4><div class="lp-icon"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>Evidence-based</h4><p>MHRA approved treatments prescribed by UK-registered professionals.</p></div>
  <div class="lp-why-card"><h4><div class="lp-icon"><svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg></div>7-day support</h4><p>Your care team is available every day. Check-ins at every stage.</p></div>
  <div class="lp-why-card"><h4><div class="lp-icon"><svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg></div>Confidential</h4><p>Encrypted data, discreet packaging. Nobody needs to know.</p></div>
</div></section>

<section class="lp-social"><div class="lp-section-label" style="color:var(--sky)">Trusted by Thousands</div><h2 class="lp-section-title" style="color:#fff">Real people. Real results.</h2><div class="lp-stats">
  <div class="lp-stat"><h3>4.8</h3><p>Google rating</p></div><div class="lp-stat"><h3>24h</h3><p>Clinician review</p></div><div class="lp-stat"><h3>96%</h3><p>Recommend us</p></div><div class="lp-stat"><h3>7 day</h3><p>Care support</p></div>
</div><blockquote class="lp-quote">&ldquo;The support from my care team made all the difference. I finally feel like myself again.&rdquo;</blockquote><p class="lp-author">Sarah M. &mdash; Bristol</p></section>

<section class="lp-price"><div class="lp-section-label">Transparent Pricing</div><h2 class="lp-section-title">No hidden fees. Ever.</h2><div class="lp-price-card">
  <div style="font-size:13px;color:var(--slate);margin-bottom:4px">Treatment plans from</div>
  <div class="lp-price-num">&pound;3.80 <span>/day</span></div>
  <div class="lp-price-per">Billed monthly &middot; Pause or cancel anytime</div>
  <ul class="lp-price-includes"><li>Clinician consultation &amp; ongoing reviews</li><li>Personalised treatment plan</li><li>Free next-day delivery</li><li>7-day clinical support team</li><li>Full refund if not eligible</li></ul>
  <a href="#checker" class="lp-check-btn" style="display:block;text-align:center;text-decoration:none;color:#fff">Check my eligibility &rarr;</a>
</div></section>

<section class="lp-final"><h2>Your weight shouldn't wait.</h2><p>Free eligibility check. No obligation. Clinician review within 24 hours.</p><a href="#checker" class="lp-cta-white">See what I could lose &rarr;</a><p style="margin-top:12px;font-size:11px;color:rgba(255,255,255,.55)">Takes 30 seconds &middot; 100% confidential</p></section>

<footer class="lp-footer"><div class="lp-footer-links"><a href="<?php echo home_url('/privacy-policy/'); ?>">Privacy Policy</a><a href="<?php echo home_url('/terms/'); ?>">Terms</a><a href="<?php echo home_url('/cookie-policy/'); ?>">Cookies</a><a href="<?php echo home_url('/complaints/'); ?>">Complaints</a></div><p>&copy; <?php echo date('Y'); ?> Don't Weight Ltd. CQC Registered. MHRA Approved.</p><p style="margin-top:4px;font-size:9px;color:rgba(255,255,255,.2)">Treatment prescribed only where clinically appropriate. Individual results vary.</p></footer>

<script>
function setU(u,b){document.querySelectorAll('.lp-unit-btn').forEach(x=>x.classList.remove('active'));b.classList.add('active');document.getElementById('metricF').style.display=u==='metric'?'block':'none';document.getElementById('imperialF').style.display=u==='imperial'?'block':'none'}
function checkE(){
  var h,w;
  if(document.getElementById('metricF').style.display!=='none'){h=parseFloat(document.getElementById('lpHeight').value);w=parseFloat(document.getElementById('lpWeight').value)}
  else{var ft=parseFloat(document.getElementById('lpFt').value)||0,inc=parseFloat(document.getElementById('lpIn').value)||0,st=parseFloat(document.getElementById('lpSt').value)||0,lbs=parseFloat(document.getElementById('lpLbs').value)||0;h=(ft*30.48)+(inc*2.54);w=(st*6.35029)+(lbs*0.453592)}
  if(!h||h<100||!w||w<40){alert('Please enter your height and weight.');return}
  var bmi=w/((h/100)*(h/100)),pct=bmi>=35?.20:bmi>=30?.18:bmi>=27?.15:.12,kg=Math.round(w*pct),tw=Math.round(w-kg);
  document.getElementById('checkerForm').style.display='none';document.getElementById('checkerResult').style.display='block';
  document.getElementById('resKg').textContent=kg+' kg';document.getElementById('resPct').textContent=Math.round(pct*100)+'%';
  var y1=20,y3=95,eY=y1+(pct/.25)*(y3-y1);if(eY>y3)eY=y3;var m1=y1+(eY-y1)*.35,m2=y1+(eY-y1)*.7;
  var l='M55,'+y1+' C100,'+m1+' 180,'+m2+' 330,'+eY;
  document.getElementById('gL').setAttribute('d',l);document.getElementById('gA').setAttribute('d',l+' L330,110 L55,110 Z');
  document.getElementById('gD1').setAttribute('cy',y1);document.getElementById('gD2').setAttribute('cy',eY);
  document.getElementById('gB').setAttribute('y',eY-26);document.getElementById('gBT').setAttribute('y',eY-12);document.getElementById('gBT').textContent='-'+Math.round(pct*100)+'%';
  document.getElementById('gY1').textContent=w+'kg';document.getElementById('gY2').textContent=Math.round(w-(kg*.5))+'kg';document.getElementById('gY3').textContent=tw+'kg';
  document.getElementById('checkerResult').scrollIntoView({behavior:'smooth',block:'center'});
}
</script>
<?php wp_footer(); ?>
</body>
</html>
