<?php
/**
 * Template Name: Treatments — Landing Page
 * Description: Conversion-focused treatments page for ads landing
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Weight Loss Treatments — Clinician-Prescribed | Don't Weight</title>
<meta name="description" content="Explore clinician-prescribed weight loss treatments. Check your eligibility in 2 minutes. Free next-day delivery. CQC registered, MHRA approved. Pause or cancel anytime.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=optional" rel="stylesheet">
<?php wp_head(); ?>
<style>
:root{--sky:#38BDF8;--sky-deep:#0EA5E9;--sky-dark:#0284C7;--sky-pale:#E0F2FE;--sky-wash:#F0F9FF;--white:#FFFFFF;--cream:#FAFAF9;--warm:#F5F5F4;--stone:#E7E5E4;--ink:#0C0A09;--charcoal:#1C1917;--slate:#44403C;--coral:#F97316;--display:-apple-system,BlinkMacSystemFont,'Inter',sans-serif;--body:-apple-system,BlinkMacSystemFont,'Inter',sans-serif}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}html{scroll-behavior:smooth}body{background:var(--white);color:var(--ink);font-family:var(--body);font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased}
.nav{position:fixed;top:0;left:0;right:0;z-index:100;height:56px;padding-top:2px;display:flex;align-items:center;justify-content:space-between;padding:0 clamp(16px,4vw,48px);background:#fff;backdrop-filter:blur(20px);border-bottom:1px solid rgba(0,0,0,.04)}
.nav-logo{font-family:var(--display);font-size:22px;font-weight:800;color:var(--ink);text-decoration:none;letter-spacing:-.8px;white-space:nowrap;flex-shrink:0;line-height:1}.nav-logo i{color:var(--sky);font-style:italic;font-weight:300}
.nav-mid{display:flex;gap:32px;list-style:none}.nav-mid a{color:var(--slate);text-decoration:none;font-size:13px;font-weight:500}.nav-mid a.active{color:var(--sky-deep);font-weight:600}
.nav-r{display:flex;align-items:center;gap:16px}.nav-login{color:var(--ink);text-decoration:none;font-size:13px;font-weight:600}
.nav-btn{background:var(--sky);color:#fff;border:none;border-radius:100px;padding:10px 24px;font-family:var(--body);font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;white-space:nowrap}
.burger{display:none;background:none;border:none;cursor:pointer;width:32px;height:32px;position:relative;z-index:102}.burger span{display:block;width:20px;height:1.5px;background:var(--ink);position:absolute;left:6px;transition:transform .3s,opacity .2s}.burger span:nth-child(1){top:10px}.burger span:nth-child(2){top:16px}.burger span:nth-child(3){top:22px}
.mobile-menu{position:fixed;inset:0;z-index:101;background:var(--white);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:24px;opacity:0;pointer-events:none;transition:opacity .3s}.mobile-menu.open{opacity:1;pointer-events:all}.mobile-menu a{font-size:22px;font-weight:600;color:var(--ink);text-decoration:none}.mobile-menu .mm-cta{background:var(--sky);color:#fff;border:none;border-radius:100px;padding:16px 48px;font-size:16px;font-weight:700;cursor:pointer}.mm-close{position:absolute;top:16px;right:20px;background:none;border:none;font-size:32px;color:var(--ink);cursor:pointer}

/* HERO */
.tx-hero{padding:clamp(72px,14vw,140px) clamp(16px,4vw,48px) clamp(32px,6vw,72px);text-align:center;background:linear-gradient(180deg,var(--white) 0%,var(--sky-wash) 50%,var(--white) 100%)}

/* TREATMENT CARDS */
.tx-cards{display:grid;grid-template-columns:repeat(2,1fr);gap:24px}
.tx-card{background:var(--white);border:1.5px solid var(--stone);border-radius:24px;padding:clamp(16px,2.5vw,40px);position:relative;transition:all .3s;display:flex;flex-direction:column}
.tx-card:hover{border-color:var(--sky);box-shadow:0 12px 36px rgba(56,189,248,.10)}
.tx-card.featured{border:2px solid var(--sky)}
.tx-badge{position:absolute;top:-10px;left:50%;transform:translateX(-50%);background:var(--coral);color:#fff;padding:4px 16px;border-radius:100px;font-size:9px;font-weight:700;letter-spacing:.5px;text-transform:uppercase}
.tx-pct{width:64px;height:64px;border-radius:50%;background:var(--sky-pale);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-family:var(--display);font-size:22px;font-weight:700;color:var(--sky-dark)}
.tx-doses{display:flex;gap:5px;margin-bottom:20px;flex-wrap:wrap}
.tx-dose{flex:1;min-width:0;background:var(--cream);border:1.5px solid var(--stone);border-radius:10px;padding:8px 4px;text-align:center;cursor:pointer;transition:all .2s;font-size:11px;font-weight:600;color:var(--slate)}
.tx-dose:hover{border-color:var(--sky)}
.tx-dose.active{border-color:var(--sky-deep);background:var(--sky-wash);color:var(--sky-dark)}
.tx-dose small{display:block;font-size:9px;font-weight:400;margin-top:2px}
.tx-price{font-family:var(--display);font-size:clamp(28px,3.5vw,36px);font-weight:700;color:var(--ink);letter-spacing:-1px}
.tx-order{display:block;width:100%;background:var(--ink);color:#fff;border:none;border-radius:100px;padding:14px;font-family:var(--body);font-size:14px;font-weight:600;cursor:pointer;text-align:center;text-decoration:none;margin-top:auto}
.tx-card.featured .tx-order{background:var(--sky)}

/* STEPS */
.tx-steps{display:grid;grid-template-columns:repeat(4,1fr);gap:24px;max-width:800px;margin:40px auto 0}
.tx-step{text-align:center}
.tx-step-num{width:48px;height:48px;border-radius:50%;background:var(--sky);color:#fff;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-family:var(--display);font-size:20px;font-weight:700}

/* TRUST */
.tx-trust{padding:40px;background:var(--ink);color:#fff}
.tx-trust-inner{display:flex;justify-content:center;gap:clamp(24px,4vw,56px);flex-wrap:wrap;max-width:800px;margin:0 auto}
.tx-trust-item h3{font-family:var(--display);font-size:clamp(24px,3vw,36px);font-weight:700;color:var(--sky);margin-bottom:4px;letter-spacing:-1px;text-align:center}
.tx-trust-item p{font-size:11px;color:rgba(255,255,255,.6);text-align:center}

/* FINAL CTA */
.tx-final{padding:clamp(48px,7vw,80px) clamp(20px,6vw,80px);background:linear-gradient(160deg,var(--sky) 0%,var(--sky-deep) 50%,var(--sky-dark) 100%);text-align:center;color:#fff}
.tx-final h2{font-family:var(--display);font-size:clamp(28px,4vw,48px);font-weight:700;letter-spacing:-1.5px;margin-bottom:12px}

/* QUIZ MODAL */
.ov{position:fixed;inset:0;z-index:1000;background:rgba(12,10,9,.45);backdrop-filter:blur(12px);display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .3s;padding:20px}.ov.on{opacity:1;pointer-events:all}
.qm{background:#fff;border-radius:24px;width:100%;max-width:460px;padding:clamp(24px,4vw,36px);position:relative;transform:translateY(16px);transition:transform .4s;max-height:88vh;overflow-y:auto;box-shadow:0 32px 80px rgba(0,0,0,.18)}.ov.on .qm{transform:translateY(0)}
.qx{position:absolute;top:18px;right:18px;background:var(--warm);border:none;color:var(--slate);width:34px;height:34px;border-radius:50%;cursor:pointer;font-size:16px;display:flex;align-items:center;justify-content:center}
.qprog{display:flex;gap:4px;margin-bottom:32px}.qd{height:3px;flex:1;border-radius:100px;background:var(--warm);transition:background .3s}.qd.done{background:var(--sky)}
.qs{display:none}.qs.on{display:block}
.qsl{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--sky-deep);font-weight:700;margin-bottom:10px}
.qq{font-family:var(--display);font-size:clamp(18px,2.5vw,22px);font-weight:700;line-height:1.2;margin-bottom:18px;letter-spacing:-.3px}
.qopts{display:flex;flex-direction:column;gap:8px}
.qo{background:var(--cream);border:1.5px solid var(--stone);border-radius:12px;padding:12px 14px;cursor:pointer;display:flex;align-items:center;justify-content:space-between;font-size:13px;transition:.2s}.qo:hover{border-color:var(--sky)}.qo.sel{border-color:var(--sky-deep);background:var(--sky-pale)}
.qchk{width:20px;height:20px;border-radius:50%;border:2px solid var(--stone);flex-shrink:0;display:flex;align-items:center;justify-content:center}.qo.sel .qchk{background:var(--sky);border-color:var(--sky)}.qo.sel .qchk::after{content:'\2713';color:#fff;font-size:10px;font-weight:700}
.qi{width:100%;background:var(--cream);border:1.5px solid var(--stone);border-radius:10px;padding:11px 14px;font-family:var(--body);font-size:14px;outline:none;margin-bottom:8px}.qi:focus{border-color:var(--sky)}
.qir{display:flex;gap:10px}.qir .qi{flex:1}
.qnav{display:flex;gap:10px;margin-top:24px}
.qback{background:var(--warm);border:none;color:var(--slate);border-radius:100px;padding:13px 22px;font-size:13px;cursor:pointer}
.qnext{flex:1;background:var(--sky);color:#fff;border:none;border-radius:100px;padding:12px;font-size:13px;font-weight:600;cursor:pointer}
.qres{text-align:center}.qring{width:72px;height:72px;border-radius:50%;background:var(--sky-pale);border:3px solid var(--sky);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:28px}
.qrt{font-family:var(--display);font-size:22px;font-weight:700;margin-bottom:8px}.qrsub{color:var(--slate);font-size:13px;line-height:1.6;margin-bottom:18px}
.qrcta{width:100%;background:var(--sky);color:#fff;border:none;border-radius:100px;padding:14px;font-size:14px;font-weight:600;cursor:pointer}
.qerr{color:#EF4444;font-size:13px;font-weight:500;margin-top:12px;min-height:18px}
.unit-btn{background:none;border:none;padding:8px 16px;border-radius:100px;font-size:13px;font-weight:500;color:var(--slate);cursor:pointer}.unit-btn.active{background:#fff;color:var(--ink);font-weight:600;box-shadow:0 1px 4px rgba(0,0,0,.08)}

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
@media(max-width:480px){.nav-logo{font-size:18px}.nav-btn{padding:6px 10px;font-size:10px}}
@media(max-width:700px){
  .tx-hero{padding:80px 16px 32px}
  .tx-trust{padding:28px 16px}
  .tx-trust-inner{gap:16px}
  .tx-trust-item h3{font-size:22px}
  .tx-final{padding:40px 16px}
  .ft-top{grid-template-columns:1fr 1fr;gap:28px}
  .ft-top>div:first-child{grid-column:1/-1}
  .ft-bot{flex-direction:column;text-align:center}
}
@media(max-width:520px){
  .tx-cards{grid-template-columns:1fr;gap:24px}
  .tx-steps{grid-template-columns:1fr 1fr}
  .tx-doses{flex-wrap:wrap}
  .tx-dose{flex:0 0 calc(33.33% - 4px)}
}
@media(max-width:420px){
  .tx-dose{flex:0 0 calc(50% - 4px)}
  .ft-top{grid-template-columns:1fr}
}
</style>
</head>
<body>

<!-- NAV -->
<?php include(get_template_directory() . '/header.php'); ?>

<!-- HERO -->
<section class="tx-hero">
  <div style="display:inline-flex;align-items:center;gap:8px;background:var(--sky-wash);border:1px solid var(--sky-pale);padding:6px 16px;border-radius:100px;margin-bottom:24px;font-size:11px;font-weight:600;color:var(--ink)">
    <span style="width:6px;height:6px;border-radius:50%;background:#22C55E;display:inline-block"></span>
    CQC Registered &middot; MHRA Approved &middot; UK Clinicians
  </div>
  <h1 style="font-family:var(--display);font-size:clamp(32px,5.5vw,64px);font-weight:700;letter-spacing:-2px;line-height:1.05;margin-bottom:16px;max-width:700px;margin-left:auto;margin-right:auto">Clinician-prescribed <span style="color:var(--sky-deep)">weight loss</span> medication</h1>
  <p style="font-size:clamp(14px,1.3vw,18px);color:var(--slate);max-width:520px;margin:0 auto 24px;line-height:1.7">Mounjaro &amp; Wegovy. Choose your treatment, check eligibility in 2 minutes. Delivered to your door &mdash; free, next day.</p>
  <div style="font-size:clamp(10px,1vw,13px);font-weight:700;color:var(--sky-deep);letter-spacing:clamp(3px,.5vw,7px);text-transform:uppercase;margin-bottom:20px">Your weight shouldn't wait</div>
  <div style="margin-bottom:20px"><a href="#treatments" style="background:var(--sky);color:#fff;border-radius:100px;padding:18px 48px;font-family:var(--body);font-size:16px;font-weight:700;text-decoration:none;display:inline-block;box-shadow:0 4px 24px rgba(56,189,248,.3)" onclick="document.getElementById('treatments').scrollIntoView({behavior:'smooth'});return false">View treatments &amp; pricing &darr;</a></div>
  <div style="font-size:12px;color:var(--sky-deep);font-weight:600">&#x1F4E6; Free Next Day Delivery <span style="font-weight:400;color:var(--slate)">on first order</span></div>
</section>

<!-- TREATMENTS -->
<section style="padding:clamp(32px,6vw,80px) clamp(16px,4vw,48px);background:var(--cream)" id="treatments"><div style="max-width:920px;margin:0 auto">
  <div style="text-align:center;margin-bottom:clamp(32px,4vw,48px)">
    <div style="font-size:10px;letter-spacing:2.5px;text-transform:uppercase;color:var(--sky-deep);font-weight:700;margin-bottom:8px">Choose Your Treatment</div>
    <h2 style="font-family:var(--display);font-size:clamp(24px,3vw,36px);font-weight:700;letter-spacing:-.8px;margin-bottom:8px">Clinically-proven <span style="color:var(--sky-deep)">medications</span></h2>
    <p style="font-size:14px;color:var(--slate);max-width:480px;margin:0 auto">Your prescribing clinician will confirm the best option during your video consultation.</p>
  </div>

  <div class="tx-cards">
    <!-- MOUNJARO -->
    <div class="tx-card featured">
      <div class="tx-badge">Recommended</div>
      <div style="text-align:center;margin-bottom:24px">
        <div class="tx-pct">23%</div>
        <h3 style="font-family:var(--display);font-size:24px;font-weight:700;margin-bottom:4px">Mounjaro</h3>
        <div style="font-size:12px;font-weight:600;color:var(--sky-deep);margin-bottom:8px">Most effective &mdash; Tirzepatide</div>
      </div>
      <p style="font-size:13px;color:var(--slate);line-height:1.6;margin-bottom:20px;text-align:center">Dual GIP/GLP-1. Up to 23% body weight loss in clinical trials. The most effective weight loss medication available in the UK.</p>
      <div style="font-size:11px;font-weight:600;margin-bottom:8px">Select your dose:</div>
      <div class="tx-doses" id="mounjaroDoses">
        <div class="tx-dose active" onclick="selectDose('mounjaro',this,150,170)">2.5mg<small>Starter</small></div>
        <div class="tx-dose" onclick="selectDose('mounjaro',this,185,0)">5mg</div>
        <div class="tx-dose" onclick="selectDose('mounjaro',this,250,0)">7.5mg</div>
        <div class="tx-dose" onclick="selectDose('mounjaro',this,275,0)">10mg</div>
        <div class="tx-dose" onclick="selectDose('mounjaro',this,285,0)">12.5mg</div>
        <div class="tx-dose" onclick="selectDose('mounjaro',this,310,0)">15mg<small>Maximum</small></div>
      </div>
      <div style="text-align:center;margin-bottom:2px"><span class="tx-from" id="mounjaroFrom" style="font-size:14px;color:var(--slate)">from </span><span class="tx-price" id="mounjaroPrice">&pound;35</span><span style="font-size:12px;color:var(--slate)">/week</span></div>
      <p id="mounjaroMonthly" style="font-size:11px;color:var(--slate);text-align:center;margin-bottom:2px">&pound;150/month</p>
      <p class="tx-then" id="mounjaroThen" style="font-size:11px;color:var(--slate);text-align:center;margin-bottom:4px">then &pound;39/week (&pound;170/mo) &middot; 2.5mg</p>
      <p style="font-size:10px;color:var(--slate);text-align:center;margin-bottom:20px">Includes medication, clinician review &amp; free next day delivery on first order</p>
      <button class="tx-order" onclick="openQ()" style="background:var(--sky)">Check eligibility &amp; order &rarr;</button>
      <p style="font-size:10px;color:var(--slate);text-align:center;margin-top:10px">&#10003; Refundable if not eligible &nbsp;&middot;&nbsp; &#10003; Monthly supply &nbsp;&middot;&nbsp; &#10003; Pause or cancel anytime</p>
    </div>

    <!-- WEGOVY -->
    <div class="tx-card">
      <div style="text-align:center;margin-bottom:24px;margin-top:12px">
        <div class="tx-pct">15%</div>
        <h3 style="font-family:var(--display);font-size:24px;font-weight:700;margin-bottom:4px">Wegovy</h3>
        <div style="font-size:12px;font-weight:600;color:var(--sky-deep);margin-bottom:8px">Proven &amp; trusted &mdash; Semaglutide (Ozempic)</div>
      </div>
      <p style="font-size:13px;color:var(--slate);line-height:1.6;margin-bottom:20px;text-align:center">GLP-1. Up to 15% body weight loss in clinical trials. Well-established safety profile trusted by millions worldwide.</p>
      <div style="font-size:11px;font-weight:600;margin-bottom:8px">Select your dose:</div>
      <div class="tx-doses" id="wegovyDoses">
        <div class="tx-dose active" onclick="selectDose('wegovy',this,114,139)">0.25mg<small>Starter</small></div>
        <div class="tx-dose" onclick="selectDose('wegovy',this,139,0)">0.5mg</div>
        <div class="tx-dose" onclick="selectDose('wegovy',this,139,0)">1mg</div>
        <div class="tx-dose" onclick="selectDose('wegovy',this,190,0)">1.7mg</div>
        <div class="tx-dose" onclick="selectDose('wegovy',this,215,0)">2.4mg<small>Maximum</small></div>
      </div>
      <div style="text-align:center;margin-bottom:2px"><span class="tx-from" id="wegovyFrom" style="font-size:14px;color:var(--slate)">from </span><span class="tx-price" id="wegovyPrice">&pound;26</span><span style="font-size:12px;color:var(--slate)">/week</span></div>
      <p id="wegovyMonthly" style="font-size:11px;color:var(--slate);text-align:center;margin-bottom:2px">&pound;114/month</p>
      <p class="tx-then" id="wegovyThen" style="font-size:11px;color:var(--slate);text-align:center;margin-bottom:4px">then &pound;32/week (&pound;139/mo) &middot; 0.25mg starter</p>
      <p style="font-size:10px;color:var(--slate);text-align:center;margin-bottom:20px">Includes medication, clinician review &amp; free next day delivery on first order</p>
      <button class="tx-order" onclick="openQ()">Check eligibility &amp; order &rarr;</button>
      <p style="font-size:10px;color:var(--slate);text-align:center;margin-top:10px">&#10003; Refundable if not eligible &nbsp;&middot;&nbsp; &#10003; Monthly supply &nbsp;&middot;&nbsp; &#10003; Pause or cancel anytime</p>
    </div>
  </div>

  <div style="max-width:600px;margin:40px auto 0;background:var(--white);border:1px solid var(--stone);border-radius:16px;padding:24px 28px">
    <div style="font-size:12px;font-weight:700;color:var(--sky-deep);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:12px">Every treatment includes</div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;font-size:13px;color:var(--charcoal)">
      <div>&#10003; Free next-day delivery</div><div>&#10003; UK clinician review</div>
      <div>&#10003; Video consultation</div><div>&#10003; Ongoing support</div>
      <div>&#10003; Discreet packaging</div><div>&#10003; 30-day guarantee</div>
    </div>
  </div>
</div></section>

<!-- PROCESS -->
<section style="padding:clamp(32px,6vw,80px) clamp(16px,4vw,56px);background:var(--white)">
  <div style="text-align:center;margin-bottom:40px">
    <div style="font-size:10px;letter-spacing:2.5px;text-transform:uppercase;color:var(--sky-deep);font-weight:700;margin-bottom:8px">How It Works</div>
    <h2 style="font-family:var(--display);font-size:clamp(24px,3vw,36px);font-weight:700;letter-spacing:-.8px;margin-bottom:8px">Four steps to <span style="color:var(--sky-deep)">starting</span></h2>
  </div>
  <div class="tx-steps">
    <div class="tx-step"><div class="tx-step-num">1</div><h4 style="font-size:15px;font-weight:700;margin-bottom:6px">2-min questionnaire</h4><p style="font-size:12px;color:var(--slate)">Quick health check. No GP referral needed.</p></div>
    <div class="tx-step"><div class="tx-step-num">2</div><h4 style="font-size:15px;font-weight:700;margin-bottom:6px">Video consultation</h4><p style="font-size:12px;color:var(--slate)">Short call with a UK-registered clinician.</p></div>
    <div class="tx-step"><div class="tx-step-num">3</div><h4 style="font-size:15px;font-weight:700;margin-bottom:6px">Get approved</h4><p style="font-size:12px;color:var(--slate)">Right medication and dose prescribed.</p></div>
    <div class="tx-step"><div class="tx-step-num">4</div><h4 style="font-size:15px;font-weight:700;margin-bottom:6px">Next-day delivery</h4><p style="font-size:12px;color:var(--slate)">Free, discreet packaging to your door.</p></div>
  </div>
  <div style="text-align:center;margin-top:40px"><button onclick="openQ()" style="background:var(--sky);color:#fff;border:none;border-radius:100px;padding:16px 40px;font-family:var(--body);font-size:15px;font-weight:700;cursor:pointer">Am I eligible? &rarr;</button></div>
</section>

<!-- HEALTH CHECK ADD-ON — positioned as recommended programme add-on -->
<section style="padding:clamp(48px,6vw,72px) clamp(20px,5vw,56px);background:var(--cream)">
  <div style="max-width:800px;margin:0 auto;text-align:center">
    <div style="display:inline-block;background:var(--sky);color:#fff;padding:5px 16px;border-radius:100px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:16px">Recommended add-on</div>
    <h2 style="font-family:var(--display);font-size:clamp(24px,3vw,36px);font-weight:700;letter-spacing:-.8px;margin-bottom:10px">Add a health check to your programme</h2>
    <p style="font-size:14px;color:var(--slate);max-width:560px;margin:0 auto 12px;line-height:1.6">We believe medication and monitoring belong together. Track what matters inside your body, not just the number on the scale.</p>
    <p style="font-size:12px;color:var(--sky-deep);font-weight:600;margin-bottom:36px">Results within 48 hours on all packages</p>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;max-width:800px;margin:0 auto;align-items:stretch">
      <!-- Baseline -->
      <div style="background:var(--white);border:1.5px solid var(--stone);border-radius:16px;padding:28px 20px;text-align:center;display:flex;flex-direction:column">
        <div style="width:44px;height:44px;border-radius:12px;background:var(--sky-wash);display:flex;align-items:center;justify-content:center;margin:0 auto 12px"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--sky-deep)" stroke-width="2" stroke-linecap="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6"/><path d="M16 13H8m8 4H8m2-8H8"/></svg></div>
        <h3 style="font-size:15px;font-weight:700;margin-bottom:4px">Baseline</h3>
        <div style="font-family:var(--display);font-size:28px;font-weight:700;letter-spacing:-1px;margin-bottom:4px">&pound;149</div>
        <p style="font-size:11px;color:var(--slate);line-height:1.5;margin-bottom:4px">London or St Albans clinic + personalised GP report</p>
        <p style="font-size:10px;color:var(--sky-deep);font-weight:600;margin-bottom:16px">Ideal before starting treatment</p>
        <a href="<?php echo home_url('/dw360/#pricing'); ?>" style="display:block;background:var(--ink);color:#fff;border-radius:100px;padding:12px;font-size:13px;font-weight:700;text-decoration:none;margin-top:auto">Book &rarr;</a>
      </div>
      <!-- Standard -->
      <div style="background:var(--white);border:2px solid var(--sky);border-radius:16px;padding:28px 20px;text-align:center;position:relative;display:flex;flex-direction:column">
        <div style="position:absolute;top:-10px;left:50%;transform:translateX(-50%);background:var(--sky);color:#fff;padding:3px 14px;border-radius:100px;font-size:9px;font-weight:700;letter-spacing:.5px">Recommended</div>
        <div style="width:44px;height:44px;border-radius:12px;background:var(--sky-wash);display:flex;align-items:center;justify-content:center;margin:0 auto 12px"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--sky-deep)" stroke-width="2" stroke-linecap="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg></div>
        <h3 style="font-size:15px;font-weight:700;margin-bottom:4px">Standard</h3>
        <div style="font-family:var(--display);font-size:28px;font-weight:700;letter-spacing:-1px;margin-bottom:4px">&pound;599</div>
        <p style="font-size:11px;color:var(--slate);line-height:1.5;margin-bottom:4px">Ultrasound, ECG, bloods + GP consultation</p>
        <p style="font-size:10px;color:var(--sky-deep);font-weight:600;margin-bottom:16px">In-person or video &middot; London or St Albans clinic</p>
        <a href="<?php echo home_url('/dw360/#pricing'); ?>" style="display:block;background:var(--sky);color:#fff;border-radius:100px;padding:12px;font-size:13px;font-weight:700;text-decoration:none;margin-top:auto">Book &rarr;</a>
      </div>
      <!-- Premium -->
      <div style="background:var(--white);border:1.5px solid var(--stone);border-radius:16px;padding:28px 20px;text-align:center;display:flex;flex-direction:column">
        <div style="width:44px;height:44px;border-radius:12px;background:var(--sky-wash);display:flex;align-items:center;justify-content:center;margin:0 auto 12px"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--sky-deep)" stroke-width="2" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg></div>
        <h3 style="font-size:15px;font-weight:700;margin-bottom:4px">Premium</h3>
        <div style="font-family:var(--display);font-size:28px;font-weight:700;letter-spacing:-1px;margin-bottom:4px">&pound;999</div>
        <p style="font-size:11px;color:var(--slate);line-height:1.5;margin-bottom:4px">Everything in Standard + full lipid, inflammation &amp; nutrition</p>
        <p style="font-size:10px;color:var(--sky-deep);font-weight:600;margin-bottom:16px">In-person or video &middot; London or St Albans clinic</p>
        <a href="<?php echo home_url('/dw360/#pricing'); ?>" style="display:block;background:var(--ink);color:#fff;border-radius:100px;padding:12px;font-size:13px;font-weight:700;text-decoration:none;margin-top:auto">Book &rarr;</a>
      </div>
    </div>

    <p style="font-size:12px;color:var(--slate);margin-top:20px">Save up to &pound;200/year with an annual programme. <a href="<?php echo home_url('/dw360/#pricing'); ?>" style="color:var(--sky-deep);font-weight:600">See annual packages &rarr;</a></p>
  </div>
</section>

<!-- TRUST -->
<div class="tx-trust">
  <div class="tx-trust-inner">
    <div class="tx-trust-item"><h3>CQC</h3><p>Registered clinic</p></div>
    <div class="tx-trust-item"><h3>MHRA</h3><p>Approved medications</p></div>
    <div class="tx-trust-item"><h3>UK</h3><p>Clinician-prescribed</p></div>
    <div class="tx-trust-item"><h3>Free</h3><p>Next-day delivery</p></div>
  </div>
</div>

<!-- FINAL CTA -->
<div class="tx-final">
  <h2 style="font-family:var(--display);font-size:clamp(28px,4vw,48px);font-weight:700;letter-spacing:-1.5px;margin-bottom:12px">Don&rsquo;t weight.</h2>
  <p style="font-size:13px;color:rgba(255,255,255,.7);margin-bottom:28px">2-minute questionnaire. Video consultation. Medication at your door next day.</p>
  <a href="#" onclick="openQ();return false" style="background:#fff;color:var(--sky-dark);border-radius:100px;padding:16px 44px;font-family:var(--body);font-size:15px;font-weight:700;text-decoration:none;display:inline-block">Check your eligibility &rarr;</a>
  <p style="margin-top:14px;font-size:12px;color:rgba(255,255,255,.6)">100% money-back guarantee if not approved.</p>
  <p style="margin-top:8px;font-size:11px;color:rgba(255,255,255,.5)">Monthly supply &mdash; pause or cancel anytime. No minimum commitment.</p>
</div>


<!-- FOOTER -->
<?php include(get_template_directory() . '/footer.php'); ?>

<!-- ELIGIBILITY SCREENER -->
<div class="ov" id="ov" onclick="if(event.target===this)closeQ()">
  <div class="qm">
    <button class="qx" onclick="closeQ()">&times;</button>
    <div style="font-size:11px;letter-spacing:1.5px;text-transform:uppercase;color:var(--sky-deep);font-weight:700;margin-bottom:6px">Eligibility Check</div>
    <div style="font-size:13px;color:var(--charcoal);margin-bottom:6px">2-minute assessment &middot; 100% confidential</div>
    <div style="margin-bottom:20px"><a href="<?php echo home_url('/treatments/'); ?>" style="font-size:12px;color:var(--sky-deep);text-decoration:none;font-weight:500">View full pricing &amp; doses &rarr;</a></div>
    <div class="qprog" id="qp"><div class="qd done"></div><div class="qd"></div><div class="qd"></div><div class="qd"></div><div class="qd"></div></div>

    <!-- Step 1: Age + Gender -->
    <div class="qs on" id="q1">
      <div class="qsl">Step 1 of 5</div>
      <div class="qq">Let&rsquo;s start with a few basics</div>
      <div style="font-size:13px;color:var(--charcoal);margin-bottom:10px;font-weight:500">Date of birth</div>
      <div class="qir" style="margin-bottom:20px">
        <input class="qi" id="iDobD" type="number" placeholder="DD" min="1" max="31" style="flex:.8">
        <input class="qi" id="iDobM" type="number" placeholder="MM" min="1" max="12" style="flex:.8">
        <input class="qi" id="iDobY" type="number" placeholder="YYYY" min="1930" max="2010" style="flex:1.4">
      </div>
      <div style="font-size:13px;color:var(--charcoal);margin-bottom:10px;font-weight:500">Biological sex (required for clinical assessment)</div>
      <div class="qopts" id="q1sex">
        <div class="qo" onclick="sel(this)"><span>Female</span><div class="qchk"></div></div>
        <div class="qo" onclick="sel(this)"><span>Male</span><div class="qchk"></div></div>
      </div>
      <div class="qerr" id="e1"></div>
      <div class="qnav"><button class="qnext" onclick="goStep1()">Continue &rarr;</button></div>
    </div>

    <!-- Step 2: Height + Weight -->
    <div class="qs" id="q2">
      <div class="qsl">Step 2 of 5</div>
      <div class="qq">Your height and weight</div>
      <p style="color:var(--charcoal);font-size:13px;margin-bottom:16px">We use this to calculate your BMI and assess clinical eligibility.</p>
      <div style="display:flex;gap:4px;margin-bottom:18px;background:var(--warm);border-radius:100px;padding:3px;width:fit-content">
        <button class="unit-btn active" id="ubMetric" onclick="setUnits('metric')" type="button">Metric (cm/kg)</button>
        <button class="unit-btn" id="ubImperial" onclick="setUnits('imperial')" type="button">Imperial (ft/st)</button>
      </div>
      <div id="metricFields" class="qir">
        <input class="qi" id="iHeight" type="number" placeholder="Height (cm)" min="100" max="250">
        <input class="qi" id="iWeight" type="number" placeholder="Weight (kg)" min="40" max="350">
      </div>
      <div id="imperialFields" class="qir" style="display:none;flex-wrap:wrap;gap:10px">
        <div style="display:flex;gap:8px;flex:1;min-width:140px">
          <input class="qi" id="iFt" type="number" placeholder="Feet" min="4" max="7" style="flex:1">
          <input class="qi" id="iIn" type="number" placeholder="Inches" min="0" max="11" style="flex:1">
        </div>
        <div style="display:flex;gap:8px;flex:1;min-width:140px">
          <input class="qi" id="iSt" type="number" placeholder="Stone" min="5" max="50" style="flex:1">
          <input class="qi" id="iLbs" type="number" placeholder="Lbs" min="0" max="13" style="flex:1">
        </div>
      </div>
      <div id="bmiDisplay" style="margin-top:12px;font-size:14px;color:var(--sky-deep);font-weight:600;display:none"></div>
      <div class="qerr" id="e2"></div>
      <div class="qnav"><button class="qback" onclick="go(1)">&larr;</button><button class="qnext" onclick="goStep2()">Continue &rarr;</button></div>
    </div>

    <!-- Step 3: Ethnicity -->
    <div class="qs" id="q3">
      <div class="qsl">Step 3 of 5</div>
      <div class="qq">What is your ethnic background?</div>
      <p style="color:var(--charcoal);font-size:13px;margin-bottom:16px">UK clinical guidelines use adjusted BMI thresholds for certain ethnic groups who face higher health risks at lower BMIs.</p>
      <div class="qopts" id="q3eth">
        <div class="qo" onclick="sel(this)" data-adj="0"><span>White</span><div class="qchk"></div></div>
        <div class="qo" onclick="sel(this)" data-adj="1"><span>South Asian</span><div class="qchk"></div></div>
        <div class="qo" onclick="sel(this)" data-adj="1"><span>Chinese or other Asian</span><div class="qchk"></div></div>
        <div class="qo" onclick="sel(this)" data-adj="1"><span>Black African or African-Caribbean</span><div class="qchk"></div></div>
        <div class="qo" onclick="sel(this)" data-adj="1"><span>Middle Eastern</span><div class="qchk"></div></div>
        <div class="qo" onclick="sel(this)" data-adj="0"><span>Mixed or other</span><div class="qchk"></div></div>
      </div>
      <div class="qerr" id="e3"></div>
      <div class="qnav"><button class="qback" onclick="go(2)">&larr;</button><button class="qnext" onclick="goStep3()">Continue &rarr;</button></div>
    </div>

    <!-- Step 4: Weight-related conditions -->
    <div class="qs" id="q4">
      <div class="qsl">Step 4 of 5</div>
      <div class="qq">Do you have any of the following conditions?</div>
      <p style="color:var(--charcoal);font-size:13px;margin-bottom:16px">Select all that apply. This information is confidential and helps determine your eligibility.</p>
      <div class="qopts" id="q4opts">
        <div class="qo" onclick="selCondition(this)" data-comorbid="1"><span>Type 2 diabetes</span><div class="qchk"></div></div>
        <div class="qo" onclick="selCondition(this)" data-comorbid="1"><span>High blood pressure (hypertension)</span><div class="qchk"></div></div>
        <div class="qo" onclick="selCondition(this)" data-comorbid="1"><span>High cholesterol (dyslipidaemia)</span><div class="qchk"></div></div>
        <div class="qo" onclick="selCondition(this)" data-comorbid="1"><span>Obstructive sleep apnoea</span><div class="qchk"></div></div>
        <div class="qo" onclick="selCondition(this)" data-comorbid="1"><span>Non-alcoholic fatty liver disease</span><div class="qchk"></div></div>
        <div class="qo" onclick="selCondition(this)" data-comorbid="1"><span>Polycystic ovary syndrome (PCOS)</span><div class="qchk"></div></div>
        <div class="qo" onclick="selNone(this,'q4opts')" data-comorbid="0"><span>None of the above</span><div class="qchk"></div></div>
      </div>
      <div class="qerr" id="e4"></div>
      <div class="qnav"><button class="qback" onclick="go(3)">&larr;</button><button class="qnext" onclick="goStep4()">Continue &rarr;</button></div>
    </div>

    <!-- Step 5: Contraindications -->
    <div class="qs" id="q5">
      <div class="qsl">Step 5 of 5</div>
      <div class="qq">Important safety questions</div>
      <p style="color:var(--charcoal);font-size:13px;margin-bottom:16px">Do any of the following apply to you?</p>
      <div class="qopts" id="q5contra">
        <div class="qo" onclick="selCondition(this)" data-block="1"><span>Pregnant, breastfeeding, or planning pregnancy</span><div class="qchk"></div></div>
        <div class="qo" onclick="selCondition(this)" data-block="1"><span>Personal or family history of medullary thyroid cancer</span><div class="qchk"></div></div>
        <div class="qo" onclick="selCondition(this)" data-block="1"><span>History of pancreatitis</span><div class="qchk"></div></div>
        <div class="qo" onclick="selCondition(this)" data-block="1"><span>Current or recent eating disorder</span><div class="qchk"></div></div>
        <div class="qo" onclick="selCondition(this)" data-block="1"><span>Type 1 diabetes</span><div class="qchk"></div></div>
        <div class="qo" onclick="selNone(this,'q5contra')" data-block="0"><span>None of the above</span><div class="qchk"></div></div>
      </div>
      <div class="qerr" id="e5"></div>
      <div class="qnav"><button class="qback" onclick="go(4)">&larr;</button><button class="qnext" onclick="goStep5()">Check my eligibility &rarr;</button></div>
    </div>

    <!-- Result: ELIGIBLE -->
    <div class="qs" id="qR">
      <div class="qres">
        <div class="qring" style="border-color:var(--sky);color:var(--sky-dark)">&#10003;</div>
        <div class="qrt">Great news &mdash; you may be eligible.</div>
        <p class="qrsub">Your BMI is <strong id="rBmi"></strong>. Based on your answers, you meet the initial criteria for GLP-1 treatment.</p>
        <div style="background:var(--sky-wash);border-radius:12px;padding:16px;margin-bottom:24px;font-size:13px;color:var(--charcoal);line-height:1.8;text-align:left">
          <strong>To proceed, enter your details below and continue to the full medical consultation:</strong><br>
          &bull; Personal details and medical history<br>
          &bull; Safety screening and consent<br>
          &bull; ID verification and GP details<br><br>
          A UK-registered clinician will review everything within 24 hours. If your application is not approved, you will receive a full refund.
        </div>
        <input class="qi" id="leadFname" type="text" placeholder="First name" style="margin-bottom:8px">
        <input class="qi" id="leadLname" type="text" placeholder="Last name" style="margin-bottom:8px">
        <input class="qi" id="leadEmail" type="email" placeholder="Email address" style="margin-bottom:4px">
        <div style="font-size:11px;color:var(--slate);margin-bottom:8px;line-height:1.5">By continuing, you agree to receive communication from don&rsquo;t weight about your consultation. We never share your data.</div>
        <div style="font-size:11px;color:var(--slate);margin-bottom:16px">&#10003; Monthly supply &nbsp;&middot;&nbsp; &#10003; Pause or cancel anytime &nbsp;&middot;&nbsp; &#10003; Refundable if not eligible</div>
        <div class="qerr" id="eR"></div>
        <button class="qrcta" onclick="goToConsultation()">Continue to consultation &rarr;</button>
      </div>
    </div>

    <!-- Result: NOT ELIGIBLE -->
    <div class="qs" id="qX">
      <div class="qres">
        <div class="qring" style="border-color:#EF4444;background:#FEF2F2">&#10007;</div>
        <div class="qrt">We&rsquo;re unable to proceed at this time.</div>
        <p class="qrsub" id="rejectMsg"></p>
        <div style="background:var(--cream);border-radius:12px;padding:16px;margin-bottom:20px;font-size:13px;color:var(--charcoal);line-height:1.7;text-align:left">
          <strong>What you can do:</strong><br>
          &bull; Speak with your GP about weight management options<br>
          &bull; Ask about NHS specialist weight management services<br>
          &bull; Contact us if you believe your circumstances have changed
        </div>
        <button class="qrcta" onclick="closeQ()" style="background:var(--charcoal)">Close</button>
        <button class="qrcta" onclick="goBack()" style="background:var(--sky);margin-top:8px">&larr; Go back</button>
      </div>
    </div>
  </div>

<script>
function toggleMobileMenu(){document.getElementById('mobileMenu').classList.toggle('open')}
function closeMobileMenu(){document.getElementById('mobileMenu').classList.remove('open')}
function selectDose(med,el,price,thenPrice){el.parentElement.querySelectorAll('.tx-dose').forEach(function(d){d.classList.remove('active')});el.classList.add('active');var weekly=Math.round(price/4.33);document.getElementById(med+'Price').innerHTML='&pound;'+weekly;var monthlyEl=document.getElementById(med+'Monthly');if(monthlyEl){monthlyEl.textContent='\u00a3'+price+'/month'}var thenEl=document.getElementById(med+'Then');if(thenEl){if(thenPrice){var tw=Math.round(thenPrice/4.33);thenEl.textContent='then \u00a3'+tw+'/week (\u00a3'+thenPrice+'/mo)';thenEl.style.display='block'}else{thenEl.style.display='none'}}var fromEl=document.getElementById(med+'From');if(fromEl){fromEl.style.display=thenPrice?'inline':'none'}}
function openQ(){var o=document.getElementById('ov');if(o){o.classList.add('on');document.body.style.overflow='hidden'}}
function closeQ(){var o=document.getElementById('ov');if(o){o.classList.remove('on');document.body.style.overflow=''}}
var cur=1,patientBmi=0,isAdjusted=false,hasComorbid=false,useImperial=false;
function go(s){document.getElementById('q'+cur).classList.remove('on');cur=s;document.getElementById('q'+cur).classList.add('on');document.querySelectorAll('.qd').forEach(function(d,i){d.classList.toggle('done',i<s)})}
function showErr(id,msg){document.getElementById(id).textContent=msg;setTimeout(function(){document.getElementById(id).textContent=''},4000)}
function sel(el){el.parentElement.querySelectorAll('.qo').forEach(function(o){o.classList.remove('sel')});el.classList.add('sel')}
function selCondition(el){el.classList.toggle('sel');var n=el.parentElement.querySelector('[data-block="0"]');if(n)n.classList.remove('sel')}
function selNone(el,cid){document.getElementById(cid).querySelectorAll('.qo').forEach(function(o){o.classList.remove('sel')});el.classList.add('sel')}
function goBack(){go(cur>1?cur-1:1)}
function reject(msg){document.getElementById('rejectMsg').innerHTML=msg;document.getElementById('q'+cur).classList.remove('on');document.getElementById('qX').classList.add('on');document.querySelectorAll('.qd').forEach(function(d){d.classList.add('done')})}
function eligible(){document.getElementById('rBmi').textContent=patientBmi.toFixed(1);document.getElementById('q'+cur).classList.remove('on');document.getElementById('qR').classList.add('on');document.querySelectorAll('.qd').forEach(function(d){d.classList.add('done')})}
function goStep1(){var d=document.getElementById('iDobD').value,m=document.getElementById('iDobM').value,y=document.getElementById('iDobY').value,sex=document.getElementById('q1sex').querySelector('.qo.sel');if(!d||!m||!y||!sex){showErr('e1','Please complete all fields.');return}var age=new Date().getFullYear()-parseInt(y);if(age<18){reject('Must be 18+.');return}go(2)}
function setUnits(t){useImperial=(t==='imperial');document.getElementById('metricFields').style.display=useImperial?'none':'flex';document.getElementById('imperialFields').style.display=useImperial?'flex':'none';document.getElementById('ubMetric').classList.toggle('active',!useImperial);document.getElementById('ubImperial').classList.toggle('active',useImperial)}
function goStep2(){var h,w;if(useImperial){var ft=parseFloat(document.getElementById('iFt').value)||0,inch=parseFloat(document.getElementById('iIn').value)||0,st=parseFloat(document.getElementById('iSt').value)||0,lbs=parseFloat(document.getElementById('iLbs').value)||0;if(!ft){showErr('e2','Enter valid height.');return}if(!st){showErr('e2','Enter valid weight.');return}h=(ft*12+inch)*2.54;w=(st*14+lbs)*0.453592}else{h=parseFloat(document.getElementById('iHeight').value);w=parseFloat(document.getElementById('iWeight').value);if(!h||!w){showErr('e2','Enter valid height and weight.');return}}patientBmi=w/((h/100)*(h/100));if(patientBmi<22){reject('BMI '+patientBmi.toFixed(1)+' is below threshold.');return}go(3)}
function goStep3(){var e=document.getElementById('q3eth').querySelector('.qo.sel');if(!e){showErr('e3','Select ethnic background.');return}isAdjusted=e.getAttribute('data-adj')==='1';go(4)}
function goStep4(){var s=document.querySelectorAll('#q4opts .qo.sel');if(!s.length){showErr('e4','Select at least one.');return}hasComorbid=Array.from(s).some(function(e){return e.getAttribute('data-comorbid')==='1'});var t30=isAdjusted?27.5:30,t27=isAdjusted?24.5:27;if(patientBmi>=t30){go(5);return}if(patientBmi>=t27&&hasComorbid){go(5);return}reject('BMI '+patientBmi.toFixed(1)+' requires weight-related condition.')}
function goStep5(){var s=document.querySelectorAll('#q5contra .qo.sel');if(!s.length){showErr('e5','Select at least one.');return}if(Array.from(s).some(function(e){return e.getAttribute('data-block')==='1'})){reject('Contraindication detected. Consult your GP.');return}eligible()}
function goToConsultation(){var fn=document.getElementById('leadFname').value.trim(),ln=document.getElementById('leadLname').value.trim(),em=document.getElementById('leadEmail').value.trim();if(!fn||!ln){showErr('eR','Enter your name.');return}if(!em||!em.includes('@')){showErr('eR','Enter valid email.');return}var fd=new FormData();fd.append('action','dw_submit_app');fd.append('nonce',typeof dwAjax!=='undefined'?dwAjax.nonce:'');fd.append('first_name',fn);fd.append('last_name',ln);fd.append('email',em);fd.append('bmi',patientBmi.toFixed(1));fd.append('stage','eligibility');var u=typeof dwAjax!=='undefined'?dwAjax.url:'/wp-admin/admin-ajax.php';fetch(u,{method:'POST',body:fd}).catch(function(){});window.location.href='<?php echo dontweight_consultation_url(); ?>?fn='+fn+'&ln='+ln+'&em='+encodeURIComponent(em)+'&bmi='+patientBmi.toFixed(1)}
</script>
<?php echo dontweight_get_ajax_script(); ?>
<?php wp_footer(); ?>
</body>
</html>
