<?php
/**
 * Template Name: DW360 Health Check
 * Description: Premium quarterly health screening for weight loss patients
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/favicon.svg">
<title>Weight Loss Health Check — Clinical Screening | Don't Weight</title>
<meta name="description" content="A thorough weight loss health check designed for patients on GLP-1 medication. Blood panel, liver and gallbladder ultrasound, echocardiogram, prescribing pharmacist and doctor reviews. From £279. CQC-registered London private clinic. Open to all GLP-1 patients.">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=optional" rel="stylesheet">
<?php wp_head(); ?>
<style>
.dw-lpug-bar{display:none!important;}.dw-rec-badge{display:none!important;}
:root{
  --sky:#38BDF8;--sky-deep:#0EA5E9;--sky-dark:#0284C7;--sky-pale:#E0F2FE;--sky-wash:#F0F9FF;
  --white:#FFFFFF;--cream:#FAFAF9;--warm:#F5F5F4;--stone:#E7E5E4;
  --ink:#0C0A09;--charcoal:#1C1917;--slate:#44403C;
  --gold:#D4A843;--gold-light:#F5ECD4;
  --display:-apple-system,BlinkMacSystemFont,'Inter','SF Pro Display','Helvetica Neue',sans-serif;
  --body:-apple-system,BlinkMacSystemFont,'Inter','SF Pro Display','SF Pro Text','Helvetica Neue',sans-serif;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{background:var(--white);color:var(--ink);font-family:var(--body);font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased}

/* NAV */
.nav{position:fixed;top:0;left:0;right:0;z-index:100;height:56px;padding-top:2px;display:flex;align-items:center;justify-content:space-between;padding:0 clamp(16px,4vw,48px);background:#fff;backdrop-filter:blur(20px);border-bottom:1px solid rgba(0,0,0,.04)}
.nav-logo{font-family:var(--display);font-size:22px;font-weight:800;color:var(--ink);text-decoration:none;letter-spacing:-.8px;line-height:.9;white-space:nowrap;flex-shrink:0}
.nav-logo i{color:var(--sky);font-style:italic;font-weight:300;letter-spacing:-.2px}
.nav-mid{display:flex;gap:32px;list-style:none}
.nav-mid a{color:var(--slate);text-decoration:none;font-size:13px;font-weight:500;transition:color .2s}
.nav-mid a.active{color:var(--sky-deep);font-weight:600}
.nav-r{display:flex;align-items:center;gap:16px}
.nav-login{color:var(--ink);text-decoration:none;font-size:13px;font-weight:600}
.nav-btn{background:var(--sky);color:var(--white);border:none;border-radius:100px;padding:10px 24px;font-family:var(--body);font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;transition:background .2s}
.burger{display:none;background:none;border:none;cursor:pointer;width:32px;height:32px;position:relative;z-index:102}
.burger span{display:block;width:20px;height:1.5px;background:var(--ink);position:absolute;left:6px;transition:transform .3s,opacity .2s}
.burger span:nth-child(1){top:10px}.burger span:nth-child(2){top:16px}.burger span:nth-child(3){top:22px}
.burger.open span:nth-child(1){top:16px;transform:rotate(45deg)}.burger.open span:nth-child(2){opacity:0}.burger.open span:nth-child(3){top:16px;transform:rotate(-45deg)}
.mobile-menu{position:fixed;inset:0;z-index:101;background:var(--white);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:24px;opacity:0;pointer-events:none;transition:opacity .3s}
.mobile-menu.open{opacity:1;pointer-events:all}
.mobile-menu a{font-family:var(--display);font-size:22px;font-weight:600;color:var(--ink);text-decoration:none}
.mobile-menu .mm-cta{background:var(--sky);color:var(--white);border:none;border-radius:100px;padding:16px 48px;font-family:var(--body);font-size:16px;font-weight:700;cursor:pointer;text-decoration:none}
.mm-close{position:absolute;top:max(16px,env(safe-area-inset-top,16px));right:20px;background:var(--warm);border:none;font-size:32px;color:var(--ink);cursor:pointer;width:48px;height:48px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:background .2s;z-index:102}

/* HERO */
.hc-hero{padding:clamp(100px,14vw,140px) clamp(20px,6vw,80px) clamp(48px,6vw,72px);text-align:center;background:linear-gradient(180deg,var(--white) 0%,var(--sky-wash) 50%,var(--white) 100%)}
.hc-badge{display:inline-flex;align-items:center;gap:8px;background:var(--gold-light);border:1px solid var(--gold);padding:6px 18px;border-radius:100px;margin-bottom:24px;font-size:11px;font-weight:700;color:var(--gold);letter-spacing:1px;text-transform:uppercase}
.hc-hero h1{font-family:var(--display);font-size:clamp(32px,5.5vw,64px);font-weight:700;letter-spacing:-2px;line-height:1.05;color:var(--ink);margin-bottom:16px}
.hc-hero h1 em{font-style:normal;color:var(--sky-deep)}
.hc-hero .hc-sub{font-size:clamp(14px,1.3vw,18px);color:var(--slate);max-width:580px;margin:0 auto 32px;line-height:1.7}
.hc-cta{background:var(--sky);color:var(--white);border:none;border-radius:100px;padding:18px 48px;font-family:var(--body);font-size:16px;font-weight:700;cursor:pointer;text-decoration:none;display:inline-block;transition:all .2s;box-shadow:0 4px 24px rgba(56,189,248,.25)}
.hc-cta:hover{background:var(--sky-deep);transform:translateY(-2px)}
.hc-price{margin-top:16px;font-size:13px;color:var(--slate)}
.hc-price strong{color:var(--ink);font-size:18px}

/* WHY SECTION */
.hc-why{padding:clamp(48px,6vw,80px) clamp(20px,6vw,80px);background:var(--cream)}
.hc-why-inner{max-width:800px;margin:0 auto}
.hc-section-label{font-size:10px;letter-spacing:2.5px;text-transform:uppercase;color:var(--sky-deep);font-weight:700;margin-bottom:8px;text-align:center}
.hc-section-title{font-family:var(--display);font-size:clamp(24px,3vw,36px);font-weight:700;letter-spacing:-.8px;color:var(--ink);margin-bottom:12px;text-align:center;line-height:1.15}
.hc-section-title em{font-style:normal;color:var(--sky-deep)}
.hc-section-desc{font-size:15px;color:var(--slate);max-width:560px;margin:0 auto 40px;text-align:center;line-height:1.7}
.hc-risks{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:16px}
.hc-risk{background:var(--white);border:1px solid var(--stone);border-radius:16px;padding:24px;transition:all .3s}
.hc-risk:hover{border-color:var(--sky);box-shadow:0 8px 28px rgba(56,189,248,.08);transform:translateY(-2px)}
.hc-risk-icon{width:52px;height:52px;border-radius:16px;background:linear-gradient(135deg,#0EA5E9 0%,#38BDF8 100%);display:flex;align-items:center;justify-content:center;margin-bottom:16px;box-shadow:0 4px 14px rgba(14,165,233,.25)}
.hc-risk h3{font-family:var(--display);font-size:16px;font-weight:700;color:var(--ink);margin-bottom:6px;letter-spacing:-.2px}
.hc-risk p{font-size:12px;color:var(--charcoal);line-height:1.65}
.hc-risk .hc-stat{font-size:11px;color:var(--sky-deep);font-weight:600;margin-top:8px}

/* WHAT'S INCLUDED */
.hc-included{padding:clamp(48px,6vw,80px) clamp(20px,6vw,80px);background:var(--white)}
.hc-inc-inner{max-width:900px;margin:0 auto}
.hc-inc-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:24px;margin-bottom:40px}
.hc-inc-col h3{font-family:var(--display);font-size:18px;font-weight:700;color:var(--ink);margin-bottom:16px;letter-spacing:-.3px;display:flex;align-items:center;gap:10px}
.hc-inc-col h3 span{width:32px;height:32px;border-radius:50%;background:var(--sky);color:var(--white);display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0}
.hc-inc-item{display:flex;align-items:flex-start;gap:10px;margin-bottom:12px;font-size:13px;color:var(--charcoal);line-height:1.5}
.hc-inc-item::before{content:'✓';color:var(--sky-deep);font-weight:700;flex-shrink:0;margin-top:1px}
.hc-inc-item strong{color:var(--ink);font-weight:600}

/* QUARTERLY PROGRAMME */
.hc-quarterly{padding:clamp(48px,6vw,80px) clamp(20px,6vw,80px);background:linear-gradient(160deg,var(--sky) 0%,var(--sky-deep) 50%,var(--sky-dark) 100%);color:var(--white);text-align:center}
.hc-quarterly h2{font-family:var(--display);font-size:clamp(24px,3vw,36px);font-weight:700;letter-spacing:-.8px;margin-bottom:12px}
.hc-quarterly p{font-size:15px;color:rgba(255,255,255,.8);max-width:520px;margin:0 auto 36px;line-height:1.7}
.hc-timeline{display:flex;justify-content:center;gap:clamp(16px,3vw,40px);flex-wrap:wrap;margin-bottom:36px}
.hc-quarter{background:rgba(255,255,255,.85);border:1px solid rgba(255,255,255,.4);border-radius:20px;padding:24px 20px;min-width:180px;text-align:center}
.hc-quarter.featured{background:rgba(255,255,255,.92);border-color:rgba(255,255,255,.6)}
.hc-quarter h4{font-size:14px;font-weight:700;margin-bottom:4px;color:#0C0A09}
.hc-quarter p{font-size:11px;color:rgba(0,0,0,.7);margin:0;line-height:1.5}
.hc-quarter .hc-q-label{font-size:9px;letter-spacing:1.5px;text-transform:uppercase;color:rgba(0,0,0,.5);margin-bottom:8px;font-weight:700}

/* PRICING */
.hc-pricing{padding:clamp(48px,6vw,80px) clamp(20px,6vw,80px);background:var(--cream)}
.hc-price-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:24px;max-width:960px;margin:0 auto}.hc-price-annual{display:grid;grid-template-columns:repeat(2,1fr);gap:24px;max-width:960px;margin:24px auto 0}.hc-annual-label{text-align:center;font-size:11px;font-weight:700;color:var(--sky-deep);letter-spacing:2px;text-transform:uppercase;margin:32px 0 8px}
.hc-price-card{background:var(--white);border:1.5px solid var(--stone);border-radius:20px;padding:32px;text-align:center;position:relative;transition:all .3s}
.hc-price-card:hover{border-color:var(--sky);box-shadow:0 12px 36px rgba(56,189,248,.10)}
.hc-price-card.featured{border:2px solid var(--sky)}
.hc-price-card .hc-pc-badge{position:absolute;top:-10px;left:50%;transform:translateX(-50%);background:var(--gold);color:var(--white);padding:4px 16px;border-radius:100px;font-size:9px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;white-space:nowrap}
.hc-price-card h3{font-family:var(--display);font-size:15px;font-weight:600;margin-bottom:4px;color:var(--slate)}
.hc-price-card .hc-pc-price{font-family:var(--display);font-size:clamp(36px,4vw,48px);font-weight:700;color:var(--ink);margin:12px 0 4px}
.hc-price-card .hc-pc-price span{font-size:16px;color:var(--slate);font-weight:400}
.hc-price-card .hc-pc-per{font-size:12px;color:var(--slate);margin-bottom:20px}
.hc-pc-list{text-align:left;margin-bottom:24px}
.hc-pc-list div{font-size:12px;color:var(--charcoal);padding:6px 0;border-bottom:1px solid var(--warm);display:flex;align-items:center;gap:8px;line-height:1.4}
.hc-pc-list div::before{content:'✓';color:var(--sky-deep);font-weight:700;flex-shrink:0}
.hc-pc-btn{display:block;width:100%;padding:14px;border-radius:100px;font-family:var(--body);font-size:14px;font-weight:700;cursor:pointer;transition:all .2s;text-decoration:none;text-align:center}
.hc-pc-btn-primary{background:var(--ink);color:var(--white);border:none}
.hc-pc-btn-primary:hover{background:var(--charcoal)}
.hc-pc-btn-outline{background:none;color:var(--ink);border:1.5px solid var(--stone)}
.hc-pc-btn-outline:hover{border-color:var(--sky);color:var(--sky-deep)}

/* FOOTER */
.hc-footer{background:var(--ink);padding:48px clamp(20px,4vw,56px) 28px;color:rgba(255,255,255,.60);text-align:center}
.hc-footer a{color:var(--sky);text-decoration:none}
.hc-footer p{font-size:12px;margin-top:8px}

/* RESPONSIVE */
@media(max-width:960px){.nav-mid{display:none}.burger{display:block}}
@media(max-width:600px){
  .hc-inc-grid{grid-template-columns:1fr}
  .hc-packages-grid{grid-template-columns:1fr !important}
  .hc-price-grid,.hc-price-annual{grid-template-columns:1fr !important}
  .hc-pkg-pair{grid-template-columns:1fr !important}
  .hc-pkg-pair{grid-template-columns:1fr !important}
  .hc-risks{grid-template-columns:1fr 1fr}
  .hc-timeline{flex-direction:column;align-items:center}
  .hc-why-grid{grid-template-columns:1fr 1fr !important}
  .nav-login{display:none}
  .nav-btn{padding:7px 14px;font-size:11px}
}
</style>
</head>
<body>

<!-- NAV -->
<?php include(get_template_directory() . '/header.php'); ?>

<!-- HERO -->
<header class="hc-hero">
  <div class="hc-badge">★ Medical-grade GLP-1 monitoring &mdash; the Don't Weight standard</div>
  <h1>The Weight Loss <em>Health Check</em></h1>
  <p class="hc-sub">Weight loss medication deserves proper clinical care. Our health checks give you a clear baseline of your body before you start, and structured monitoring as it changes &mdash; blood panels, ultrasound, cardiology. Every result is reviewed by a prescribing pharmacist and a doctor.</p>
  <a href="#pricing" class="hc-cta">Choose your health check &darr;</a>
  <div class="hc-price"><strong>&pound;279</strong> Baseline &middot; <strong>&pound;699</strong> 360 &middot; <strong>&pound;979</strong> Premium <span style="display:block;font-size:11px;font-weight:400;opacity:.7;margin-top:4px">Medication cost separate &mdash; your clinician will discuss this with you during your consultation</span></div>
</header>

<!-- LPUG BADGE -->
<div class="dw-lpug-badge" style="width:100%;background:linear-gradient(135deg,#F8FAFC,#EFF6FF);padding:40px 20px;box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;">
  <div style="max-width:900px;margin:0 auto;display:flex;flex-direction:column;align-items:center;text-align:center;">
    <div style="width:56px;height:56px;border-radius:50%;background:linear-gradient(135deg,#1A1A2E,#2D2B55);display:flex;align-items:center;justify-content:center;margin-bottom:16px;border:2px solid rgba(255,255,255,0.1);box-shadow:0 4px 16px rgba(26,26,46,0.2);"><span style="color:#fff;font-size:13px;font-weight:800;letter-spacing:0.5px;">LPUG</span></div>
    <div style="font-size:17px;font-weight:700;color:#0F172A;margin-bottom:8px;letter-spacing:-0.2px;">Health checks delivered by <strong>London Private Ultrasound Group</strong></div>
    <div style="font-size:14px;color:#334155;line-height:1.65;max-width:740px;margin-bottom:20px;">Our imaging and diagnostics are delivered through <a href="https://londonsono.com" target="_blank" rel="noopener" style="color:#334155;font-weight:600;text-decoration:underline;text-decoration-color:#38BDF8;text-underline-offset:2px;">London Private Ultrasound Group</a> &mdash; an established CQC-registered private diagnostic clinic, using hospital-grade equipment and experienced UK sonographers. Your results are reviewed by qualified UK clinicians.</div>
    <div style="display:flex;flex-wrap:wrap;gap:10px;justify-content:center;">
      <span style="background:#fff;border:1px solid #E2E8F0;border-radius:20px;padding:6px 16px;font-size:12px;font-weight:600;color:#334155;letter-spacing:0.3px;">CQC Registered</span>
      <span style="background:#fff;border:1px solid #E2E8F0;border-radius:20px;padding:6px 16px;font-size:12px;font-weight:600;color:#334155;letter-spacing:0.3px;">GMC &amp; GPhC Clinicians</span>
      <span style="background:#fff;border:1px solid #E2E8F0;border-radius:20px;padding:6px 16px;font-size:12px;font-weight:600;color:#334155;letter-spacing:0.3px;">Hospital-grade imaging</span>
    </div>
  </div>
</div>

<!-- WHY THIS MATTERS -->
<section class="hc-why">
  <div class="hc-why-inner">
    <div class="hc-section-label">Why It Matters</div>
    <h2 class="hc-section-title">Weight loss medication is <em>powerful.</em><br>Monitoring it properly is <em>essential.</em></h2>
    <p class="hc-section-desc">GLP-1 medications like Mounjaro and Wegovy transform your metabolism &mdash; and that transformation affects your liver, gallbladder, glucose control, lipids and cardiovascular system. Proper care means prescribing the medication <strong>and</strong> monitoring what it does to your body. At Don&rsquo;t Weight, the two come together by design.</p>
    
    <div class="hc-risks">
      <div class="hc-risk">
        <div class="hc-risk-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2L8 8.5C6.5 11 6 12.5 6 14a6 6 0 0012 0c0-1.5-.5-3-2-5.5L12 2z" fill="white" opacity=".9"/><circle cx="14" cy="13" r="2" fill="white" opacity=".5"/></svg></div>
        <h3>Gallbladder</h3>
        <p>Rapid weight loss increases gallstone risk significantly. Most patients never get screened until symptoms appear — by which point surgery may be needed.</p>
        <div class="hc-stat">Up to 30% of rapid weight loss patients develop gallstones</div>
      </div>
      <div class="hc-risk">
        <div class="hc-risk-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><ellipse cx="7" cy="12" rx="5" ry="3.5" fill="white" opacity=".9"/><ellipse cx="17" cy="12" rx="5" ry="3.5" fill="white" opacity=".9"/><rect x="11" y="8" width="2" height="8" rx="1" fill="white" opacity=".6"/></svg></div>
        <h3>Thyroid</h3>
        <p>All GLP-1 medications carry a thyroid monitoring advisory. Regular ultrasound screening catches changes early, when they're most treatable.</p>
        <div class="hc-stat">Thyroid nodules found in ~7% of routine scans</div>
      </div>
      <div class="hc-risk">
        <div class="hc-risk-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 9C4 6 6.5 4 10 4c1.5 0 2.5.5 2.5.5S13 4 14.5 4C18 4 20 6 20 9c0 4-2.5 8-8 10C6.5 17 4 13 4 9z" fill="white" opacity=".9"/><path d="M12 6c0 3 2 5 2 8" stroke="white" stroke-width="1.5" stroke-linecap="round" opacity=".5"/></svg></div>
        <h3>Liver</h3>
        <p>Fatty liver disease affects 1 in 3 overweight adults. GLP-1 medication can reverse it — but tracking that improvement via ultrasound provides real clinical evidence of your progress.</p>
        <div class="hc-stat">NAFLD present in ~30% of patients at baseline</div>
      </div>
      <div class="hc-risk">
        <div class="hc-risk-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 13c2-4 4-5 6-4s3 4 6 3 4-4 6-3" stroke="white" stroke-width="2.5" stroke-linecap="round"/><circle cx="7" cy="10" r="3" fill="white" opacity=".7"/></svg></div>
        <h3>Pancreas</h3>
        <p>Pancreatitis is a known (rare) side effect of GLP-1 medication. Baseline and ongoing pancreatic assessment provides early warning and peace of mind.</p>
        <div class="hc-stat">Pancreatic enzymes checked + ultrasound imaging</div>
      </div>
      <div class="hc-risk">
        <div class="hc-risk-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="10" width="18" height="7" rx="3.5" fill="white" opacity=".9" transform="rotate(-35 12 13.5)"/><line x1="7.5" y1="16.5" x2="16.5" y2="7.5" stroke="#0EA5E9" stroke-width="1.5" stroke-linecap="round" opacity=".4"/></svg></div>
        <h3>Nutrient Deficiencies</h3>
        <p>Eating less means absorbing fewer vitamins and minerals. B12, iron, vitamin D, and folate all commonly drop on GLP-1 medication — often without obvious symptoms until levels are critically low.</p>
        <div class="hc-stat">Vitamin D deficiency in ~40% of UK adults</div>
      </div>
      <div class="hc-risk">
        <div class="hc-risk-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 19C12 19 4 13 4 8.5a4.5 4.5 0 019-1 4.5 4.5 0 019 1C22 13 14 19 12 19z" fill="white" opacity=".9"/><polyline points="4,12 7,12 9,9.5 11,14.5 13,10.5 15,12 18,12" stroke="#0EA5E9" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none" opacity=".5"/></svg></div>
        <h3>Cardiovascular</h3>
        <p>Weight loss dramatically improves heart health — but you need the data to prove it. Full lipid panel, blood pressure, and inflammatory markers track your real cardiovascular improvement.</p>
        <div class="hc-stat">Measurable CV improvements from 5% weight loss</div>
      </div>
    </div>
  </div>
</section>

<!-- MID CTA -->
<div style="background:var(--sky);padding:32px clamp(20px,6vw,80px);text-align:center">
  <p style="font-size:clamp(16px,2vw,20px);font-weight:700;color:white;margin-bottom:16px">Ready to know what&rsquo;s actually happening inside your body?</p>
  <a href="#pricing" style="display:inline-block;background:white;color:var(--sky-dark);border-radius:100px;padding:14px 36px;font-size:15px;font-weight:700;text-decoration:none;transition:all .2s">See packages &amp; pricing &darr;</a>
</div>

<!-- PRICING -->
<section class="hc-pricing" id="pricing">
  <div class="hc-section-label">Packages &amp; Pricing</div>
  <h2 class="hc-section-title" style="margin-bottom:8px">The complete <em>GLP-1 medical standard</em></h2>
  <p class="hc-section-desc" style="margin-bottom:12px">Three levels of screening, each built around what a prescribing pharmacist and doctor actually need to see before and during GLP-1 treatment. Every package includes full clinical oversight &mdash; no automated forms, no chatbots.</p>

  <!-- SALES WRAP: Why this is different -->
  <div style="max-width:1000px;margin:0 auto 32px;display:grid;grid-template-columns:repeat(3,1fr);gap:16px" class="hc-pkg-pair">
    <div style="background:var(--sky-wash);border:1px solid var(--sky-pale);border-radius:14px;padding:20px 22px">
      <div style="width:36px;height:36px;border-radius:10px;background:var(--sky);display:flex;align-items:center;justify-content:center;margin-bottom:12px"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg></div>
      <h3 style="font-size:14px;font-weight:700;margin-bottom:4px;color:var(--ink)">Every package includes two clinicians</h3>
      <p style="font-size:12px;color:var(--charcoal);line-height:1.6;margin:0">An initial 1-to-1 with a prescribing pharmacist, then a final strategic review with a doctor. No shortcuts, no AI triage.</p>
    </div>
    <div style="background:var(--sky-wash);border:1px solid var(--sky-pale);border-radius:14px;padding:20px 22px">
      <div style="width:36px;height:36px;border-radius:10px;background:var(--sky);display:flex;align-items:center;justify-content:center;margin-bottom:12px"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 14"/></svg></div>
      <h3 style="font-size:14px;font-weight:700;margin-bottom:4px;color:var(--ink)">Specialist diagnostics &mdash; no waiting list</h3>
      <p style="font-size:12px;color:var(--charcoal);line-height:1.6;margin:0">Advanced liver and gallbladder scans, echocardiogram and full metabolic bloods &mdash; delivered in a single appointment at our CQC-registered London private clinic. The same screening depth specialist services offer, without the months-long wait.</p>
    </div>
    <div style="background:var(--sky-wash);border:1px solid var(--sky-pale);border-radius:14px;padding:20px 22px">
      <div style="width:36px;height:36px;border-radius:10px;background:var(--sky);display:flex;align-items:center;justify-content:center;margin-bottom:12px"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg></div>
      <h3 style="font-size:14px;font-weight:700;margin-bottom:4px;color:var(--ink)">Everything under one clinical roof</h3>
      <p style="font-size:12px;color:var(--charcoal);line-height:1.6;margin:0">Bloods, ultrasound, echocardiogram and both clinician reviews &mdash; one appointment, one continuous medical record. No referrals, no chasing results between clinics.</p>
    </div>
  </div>

  <!-- SINGLE 3-COLUMN COMPARISON TABLE -->
  <div style="max-width:1000px;margin:0 auto 28px;overflow-x:auto;-webkit-overflow-scrolling:touch">
    <table style="width:100%;border-collapse:collapse;font-size:13px;min-width:580px">
      <thead><tr>
        <th style="text-align:left;padding:18px 16px;background:var(--ink);color:white;border-radius:12px 0 0 0;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;width:34%">What&rsquo;s included</th>
        <th style="text-align:center;padding:18px 12px 14px;background:var(--ink);color:rgba(255,255,255,.85);font-size:12px;font-weight:700;width:22%">Baseline<br><span style="font-size:22px;color:white;display:block;margin-top:4px">&pound;279</span><span style="font-size:9px;font-weight:400;color:rgba(255,255,255,.5);display:block;margin-top:2px">+ medication cost</span></th>
        <th style="text-align:center;padding:18px 12px 14px;background:var(--ink);color:rgba(255,255,255,.85);font-size:12px;font-weight:700;width:22%;position:relative"><span style="position:absolute;top:-2px;left:50%;transform:translateX(-50%);background:#38BDF8;color:#fff;font-size:9px;font-weight:700;padding:2px 12px;border-radius:0 0 10px 10px;letter-spacing:1px;text-transform:uppercase">Recommended</span>360<br><span style="font-size:22px;color:white;display:block;margin-top:4px">&pound;699</span><span style="font-size:9px;font-weight:400;color:rgba(255,255,255,.5);display:block;margin-top:2px">+ medication cost</span></th>
        <th style="text-align:center;padding:18px 12px 14px;background:var(--sky);color:white;border-radius:0 12px 0 0;font-size:12px;font-weight:700;width:22%">Premium<br><span style="font-size:22px;display:block;margin-top:4px">&pound;979</span><span style="font-size:9px;font-weight:400;color:rgba(255,255,255,.75);display:block;margin-top:2px">+ medication cost</span></th>
      </tr></thead>
      <tbody>
        <!-- Blood panel -->
        <tr><td style="padding:10px 16px;border-bottom:1px solid var(--warm);font-weight:700;color:var(--sky-dark);font-size:10px;letter-spacing:1px;text-transform:uppercase;background:var(--sky-wash);border-left:3px solid var(--sky)" colspan="4">Blood panel</td></tr>
        <tr><td style="padding:9px 16px;border-bottom:1px solid var(--warm)">Liver panel &mdash; ALT, AST, ALP, GGT, Bilirubin, Albumin, Globulin</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--sky-deep);font-weight:700">&#10003;</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--sky-deep);font-weight:700">&#10003;</td><td style="text-align:center;border-bottom:1px solid var(--warm);background:var(--sky-wash);color:var(--sky-deep);font-weight:700">&#10003;</td></tr>
        <tr><td style="padding:9px 16px;border-bottom:1px solid var(--warm)">Glycaemic control &mdash; HbA1c and fasting glucose</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--sky-deep);font-weight:700">&#10003;</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--sky-deep);font-weight:700">&#10003;</td><td style="text-align:center;border-bottom:1px solid var(--warm);background:var(--sky-wash);color:var(--sky-deep);font-weight:700">&#10003;</td></tr>
        <tr><td style="padding:9px 16px;border-bottom:1px solid var(--warm)">Advanced lipid panel &mdash; Triglycerides, Cholesterol, HDL, LDL</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--sky-deep);font-weight:700">&#10003;</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--sky-deep);font-weight:700">&#10003;</td><td style="text-align:center;border-bottom:1px solid var(--warm);background:var(--sky-wash);color:var(--sky-deep);font-weight:700">&#10003;</td></tr>
        <tr><td style="padding:9px 16px;border-bottom:1px solid var(--warm)">Systemic markers &mdash; Kidney function, Haematology, CRP</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--sky-deep);font-weight:700">&#10003;</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--sky-deep);font-weight:700">&#10003;</td><td style="text-align:center;border-bottom:1px solid var(--warm);background:var(--sky-wash);color:var(--sky-deep);font-weight:700">&#10003;</td></tr>

        <!-- Ultrasound imaging -->
        <tr><td style="padding:10px 16px;border-bottom:1px solid var(--warm);font-weight:700;color:#0EA5E9;font-size:10px;letter-spacing:1px;text-transform:uppercase;background:#E0F2FE;border-left:3px solid #0EA5E9" colspan="4">Ultrasound imaging</td></tr>
        <tr><td style="padding:9px 16px;border-bottom:1px solid var(--warm)">Advanced liver scan &mdash; full explanation and quantified liver health</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--stone)">&mdash;</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--sky-deep);font-weight:700">&#10003;</td><td style="text-align:center;border-bottom:1px solid var(--warm);background:var(--sky-wash);color:var(--sky-deep);font-weight:700">&#10003;</td></tr>
        <tr><td style="padding:9px 16px;border-bottom:1px solid var(--warm)">Gallbladder scan</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--stone)">&mdash;</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--sky-deep);font-weight:700">&#10003;</td><td style="text-align:center;border-bottom:1px solid var(--warm);background:var(--sky-wash);color:var(--sky-deep);font-weight:700">&#10003;</td></tr>
        <tr><td style="padding:9px 16px;border-bottom:1px solid var(--warm)">Echocardiogram &mdash; detailed ultrasound of heart structure and function</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--stone)">&mdash;</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--stone)">&mdash;</td><td style="text-align:center;border-bottom:1px solid var(--warm);background:var(--sky-wash);color:var(--sky-deep);font-weight:700">&#10003;</td></tr>

        <!-- Consultations -->
        <tr><td style="padding:10px 16px;border-bottom:1px solid var(--warm);font-weight:700;color:#0284C7;font-size:10px;letter-spacing:1px;text-transform:uppercase;background:#E0F2FE;border-left:3px solid #0284C7" colspan="4">Consultations &amp; clinical review</td></tr>
        <tr><td style="padding:9px 16px;border-bottom:1px solid var(--warm)">Initial 1-to-1 with prescribing pharmacist &mdash; establish starting point, tailor scans and package</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--sky-deep);font-weight:700">&#10003;</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--sky-deep);font-weight:700">&#10003;</td><td style="text-align:center;border-bottom:1px solid var(--warm);background:var(--sky-wash);color:var(--sky-deep);font-weight:700">&#10003;</td></tr>
        <tr><td style="padding:9px 16px;border-bottom:1px solid var(--warm)">Strategic final review &mdash; Doctor consultation, notes, metabolic optimisation and treatment plan</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--sky-deep);font-weight:700">&#10003;</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--sky-deep);font-weight:700">&#10003;</td><td style="text-align:center;border-bottom:1px solid var(--warm);background:var(--sky-wash);color:var(--sky-deep);font-weight:700">&#10003;</td></tr>
        <tr><td style="padding:9px 16px;border-bottom:1px solid var(--warm)">Cardiologist appointment</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--stone)">&mdash;</td><td style="text-align:center;border-bottom:1px solid var(--warm);color:var(--stone)">&mdash;</td><td style="text-align:center;border-bottom:1px solid var(--warm);background:var(--sky-wash);color:var(--sky-deep);font-weight:700">&#10003;</td></tr>

        <tr>
          <td style="padding:16px;background:var(--cream);border-radius:0 0 0 12px;font-weight:700">Book now</td>
          <td style="text-align:center;padding:12px 8px;background:var(--cream)"><button onclick="bookHC('hc-baseline')" style="background:var(--ink);color:#fff;border:none;border-radius:100px;padding:12px 16px;font-family:var(--body);font-size:12px;font-weight:700;cursor:pointer;width:100%">&pound;279 &rarr;</button></td>
          <td style="text-align:center;padding:12px 8px;background:var(--cream)"><button onclick="bookHC('hc-standard')" style="background:var(--ink);color:#fff;border:none;border-radius:100px;padding:12px 16px;font-family:var(--body);font-size:12px;font-weight:700;cursor:pointer;width:100%">&pound;699 &rarr;</button></td>
          <td style="text-align:center;padding:12px 8px;background:var(--sky-wash);border-radius:0 0 12px 0"><button onclick="bookHC('hc-premium')" style="background:var(--sky);color:#fff;border:none;border-radius:100px;padding:12px 16px;font-family:var(--body);font-size:12px;font-weight:700;cursor:pointer;width:100%">&pound;979 &rarr;</button></td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Post-table medication cost note -->
  <div style="max-width:1000px;margin:0 auto 32px;padding:16px 22px;background:var(--cream);border-radius:14px;font-size:12px;color:var(--charcoal);line-height:1.65;text-align:center">
    <strong style="color:var(--ink)">A note on medication cost.</strong> The package price covers your full clinical screening, imaging and two clinician reviews. GLP-1 weight loss medication (Mounjaro or Wegovy) is priced separately and confirmed with your prescribing pharmacist during your initial consultation &mdash; dose-dependent and fully transparent.
  </div>

  <!-- Sales reinforcement -->
  <div style="max-width:920px;margin:32px auto;background:var(--ink);color:#fff;border-radius:20px;padding:clamp(28px,4vw,40px);text-align:center">
    <div style="font-size:10px;letter-spacing:2px;text-transform:uppercase;color:rgba(56,189,248,.9);font-weight:700;margin-bottom:10px">The way GLP-1 should be done</div>
    <h3 style="font-family:var(--display);font-size:clamp(20px,2.6vw,26px);font-weight:700;letter-spacing:-.5px;margin-bottom:10px;color:#fff">Weight loss medication deserves proper clinical care.</h3>
    <p style="font-size:14px;line-height:1.7;color:rgba(255,255,255,.75);max-width:620px;margin:0 auto">Our health checks sit alongside every Don&rsquo;t Weight treatment plan &mdash; but they are also available on their own to anyone taking GLP-1 medication who wants proper medical oversight alongside their prescription. The focus is simple: real clinicians, real imaging, real baselines.</p>
  </div>

  <p style="text-align:center;font-size:11px;color:var(--slate);margin-top:16px;max-width:560px;margin-left:auto;margin-right:auto">Full refund if not clinically eligible. Cancel before your appointment at any time.</p>

  <!-- ══════════════════════════════════════════════════════════ -->
  <!-- SEMBLE BOOKING AREA — one iframe visible at a time         -->
  <!-- ══════════════════════════════════════════════════════════ -->
  <div id="hc-booking" style="max-width:980px;margin:48px auto 0;scroll-margin-top:80px">

    <!-- Wrap-up / how-it-works -->
    <div id="hc-booking-wrap" style="display:none;background:var(--sky-wash);border:1px solid var(--sky-pale);border-radius:14px;padding:20px 22px;margin-bottom:18px">
      <p style="font-size:14px;font-weight:700;color:var(--ink);margin:0 0 10px;letter-spacing:-.2px">To book your health check &mdash; choose a date below</p>
      <ul style="margin:0;padding:0;list-style:none;font-size:13px;color:var(--charcoal);line-height:1.65">
        <li style="display:flex;gap:10px;margin-bottom:8px">
          <span style="color:var(--sky-deep);font-weight:700;flex-shrink:0">&#10003;</span>
          <span>Pick a date and time that suits you. Bloods, imaging and clinician reviews are all arranged into a single appointment window.</span>
        </li>
        <li style="display:flex;gap:10px;margin-bottom:8px">
          <span style="color:var(--sky-deep);font-weight:700;flex-shrink:0">&#10003;</span>
          <span>You pay for the screening package only. If you are a Don&rsquo;t Weight treatment patient, your medication cost is billed separately by your prescribing pharmacist.</span>
        </li>
        <li style="display:flex;gap:10px;margin-bottom:0">
          <span style="color:var(--sky-deep);font-weight:700;flex-shrink:0">&#10003;</span>
          <span><strong>Full refund</strong> if we find you are not clinically suitable or if you cancel before your appointment.</span>
        </li>
      </ul>
    </div>

    <!-- BASELINE iframe slot -->
    <div id="hc-baseline-area" style="display:none;margin-top:8px">
      <div style="background:var(--cream);border-radius:14px;padding:12px 16px;margin-bottom:12px;font-size:13px;color:var(--charcoal)">
        <strong style="color:var(--ink)">Selected package:</strong> Baseline Health Check &mdash; &pound;279 <span style="color:var(--slate);font-size:12px">(+ medication cost if on treatment)</span>
      </div>
      <div style="background:var(--white);border:2px solid var(--sky);border-radius:16px;padding:4px;min-height:650px;box-shadow:0 4px 24px rgba(56,189,248,.12)">
        <!-- ════════════════════════════════════════════════════════ -->
        <!-- PASTE BASELINE SEMBLE IFRAME CODE BELOW THIS LINE ONLY   -->
        <!-- ════════════════════════════════════════════════════════ -->

        <!-- SEMBLE_BASELINE_IFRAME_HERE -->

        <!-- ════════════════════════════════════════════════════════ -->
        <!-- END BASELINE SEMBLE IFRAME                               -->
        <!-- ════════════════════════════════════════════════════════ -->
      </div>
    </div>

    <!-- 360 iframe slot -->
    <div id="hc-standard-area" style="display:none;margin-top:8px">
      <div style="background:var(--cream);border-radius:14px;padding:12px 16px;margin-bottom:12px;font-size:13px;color:var(--charcoal)">
        <strong style="color:var(--ink)">Selected package:</strong> 360 Health Check &mdash; &pound;699 <span style="color:var(--slate);font-size:12px">(+ medication cost if on treatment)</span>
      </div>
      <div style="background:var(--white);border:2px solid var(--sky);border-radius:16px;padding:4px;min-height:650px;box-shadow:0 4px 24px rgba(56,189,248,.12)">
        <!-- ════════════════════════════════════════════════════════ -->
        <!-- PASTE 360 SEMBLE IFRAME CODE BELOW THIS LINE ONLY         -->
        <!-- ════════════════════════════════════════════════════════ -->

        <!-- SEMBLE_STANDARD_IFRAME_HERE -->

        <!-- ════════════════════════════════════════════════════════ -->
        <!-- END 360 SEMBLE IFRAME                                    -->
        <!-- ════════════════════════════════════════════════════════ -->
      </div>
    </div>

    <!-- PREMIUM iframe slot -->
    <div id="hc-premium-area" style="display:none;margin-top:8px">
      <div style="background:var(--cream);border-radius:14px;padding:12px 16px;margin-bottom:12px;font-size:13px;color:var(--charcoal)">
        <strong style="color:var(--ink)">Selected package:</strong> Premium Health Check &mdash; &pound;979 <span style="color:var(--slate);font-size:12px">(+ medication cost if on treatment)</span>
      </div>
      <div style="background:var(--white);border:2px solid var(--sky);border-radius:16px;padding:4px;min-height:650px;box-shadow:0 4px 24px rgba(56,189,248,.12)">
        <!-- ════════════════════════════════════════════════════════ -->
        <!-- PASTE PREMIUM SEMBLE IFRAME CODE BELOW THIS LINE ONLY    -->
        <!-- ════════════════════════════════════════════════════════ -->

        <!-- SEMBLE_PREMIUM_IFRAME_HERE -->

        <!-- ════════════════════════════════════════════════════════ -->
        <!-- END PREMIUM SEMBLE IFRAME                                -->
        <!-- ════════════════════════════════════════════════════════ -->
      </div>
    </div>

    <div style="text-align:center;margin-top:16px;padding:14px 20px;background:var(--cream);border-radius:12px;display:none" id="hc-booking-help">
      <p style="font-size:13px;color:var(--charcoal);line-height:1.6;margin:0">Need help booking? Call us on <a href="tel:+442071013377" style="color:var(--sky-deep);font-weight:700;text-decoration:none">+44 20 7101 3377</a> or email <a href="mailto:hello@dontweight.co.uk" style="color:var(--sky-deep);font-weight:700;text-decoration:none">hello@dontweight.co.uk</a></p>
    </div>
  </div>
</section>

<!-- PREMIUM ANNUAL CONCIERGE PROGRAMME -->
<section style="padding:clamp(48px,6vw,80px) clamp(20px,5vw,56px);background:linear-gradient(160deg, #0C0A09 0%, #1C1917 100%);color:#fff">
  <div style="max-width:900px;margin:0 auto;text-align:center">
    <div style="display:inline-block;background:rgba(56,189,248,.15);border:1px solid rgba(56,189,248,.35);color:#7DD3FC;padding:6px 18px;border-radius:100px;font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;margin-bottom:20px">Annual Concierge Programme</div>
    <h2 style="font-family:var(--display);font-size:clamp(28px,4vw,42px);font-weight:700;letter-spacing:-1.2px;line-height:1.1;margin-bottom:16px;color:#fff">Two checks a year.<br>One dedicated clinical team.</h2>
    <p style="font-size:clamp(14px,1.3vw,16px);color:rgba(255,255,255,.72);line-height:1.7;max-width:620px;margin:0 auto 32px">The annual programme gives you <strong style="color:#fff">two full health checks every 12 months</strong> &mdash; your baseline at the start of treatment, and a progress review six months later &mdash; coordinated end-to-end by a dedicated medical concierge. Bloods, imaging, clinician reviews and follow-up: all arranged for you.</p>

    <!-- Three tiers with new prices -->
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;max-width:780px;margin:0 auto 36px" class="hc-pkg-pair">
      <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:20px 16px;text-align:left">
        <div style="font-size:11px;font-weight:700;color:rgba(56,189,248,.9);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:8px">Baseline Annual</div>
        <div style="font-family:var(--display);font-size:26px;font-weight:700;color:#fff;margin-bottom:2px">&pound;499<span style="font-size:13px;font-weight:400;color:rgba(255,255,255,.5)">/year</span></div>
        <div style="font-size:11px;color:rgba(255,255,255,.55);margin-bottom:6px">2 &times; Baseline Health Check</div>
        <div style="font-size:11px;color:#7DD3FC;font-weight:600">You save &pound;59 vs single-check</div>
      </div>
      <div style="background:rgba(56,189,248,.08);border:1.5px solid rgba(56,189,248,.5);border-radius:14px;padding:20px 16px;text-align:left;position:relative">
        <div style="position:absolute;top:-8px;left:50%;transform:translateX(-50%);background:#38BDF8;color:#0C0A09;font-size:9px;font-weight:700;padding:2px 10px;border-radius:12px;letter-spacing:1px;text-transform:uppercase;white-space:nowrap">Most popular</div>
        <div style="font-size:11px;font-weight:700;color:#38BDF8;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:8px">360 Annual</div>
        <div style="font-family:var(--display);font-size:26px;font-weight:700;color:#fff;margin-bottom:2px">&pound;1,199<span style="font-size:13px;font-weight:400;color:rgba(255,255,255,.5)">/year</span></div>
        <div style="font-size:11px;color:rgba(255,255,255,.55);margin-bottom:6px">2 &times; 360 Health Check</div>
        <div style="font-size:11px;color:#7DD3FC;font-weight:600">You save &pound;199 vs single-check</div>
      </div>
      <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:20px 16px;text-align:left">
        <div style="font-size:11px;font-weight:700;color:rgba(56,189,248,.9);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:8px">Premium Annual</div>
        <div style="font-family:var(--display);font-size:26px;font-weight:700;color:#fff;margin-bottom:2px">&pound;1,759<span style="font-size:13px;font-weight:400;color:rgba(255,255,255,.5)">/year</span></div>
        <div style="font-size:11px;color:rgba(255,255,255,.55);margin-bottom:6px">2 &times; Premium Health Check</div>
        <div style="font-size:11px;color:#7DD3FC;font-weight:600">You save &pound;199 vs single-check</div>
      </div>
    </div>

    <!-- Concierge — contact us to arrange -->
    <div style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-radius:18px;padding:clamp(24px,3vw,32px);max-width:680px;margin:0 auto">
      <p style="font-size:14px;color:rgba(255,255,255,.72);line-height:1.7;margin:0 0 20px">The Annual Programme is arranged individually with our medical concierge team &mdash; we match you to the right package, schedule both visits, and coordinate all results. <strong style="color:#fff">Please contact us to join the programme</strong>; bookings are not automated for our annual patients.</p>
      <div style="display:flex;gap:12px;flex-wrap:wrap;justify-content:center">
        <a href="tel:+442071013377" style="display:inline-flex;align-items:center;gap:10px;background:#38BDF8;color:#0C0A09;border-radius:100px;padding:14px 26px;font-family:var(--body);font-size:14px;font-weight:700;text-decoration:none;transition:all .2s">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
          +44 20 7101 3377
        </a>
        <a href="mailto:hello@dontweight.co.uk?subject=Annual%20Health%20Check%20Programme" style="display:inline-flex;align-items:center;gap:10px;background:transparent;color:#fff;border:1.5px solid rgba(255,255,255,.3);border-radius:100px;padding:14px 26px;font-family:var(--body);font-size:14px;font-weight:600;text-decoration:none;transition:all .2s">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          hello@dontweight.co.uk
        </a>
      </div>
      <p style="font-size:11px;color:rgba(255,255,255,.45);margin-top:20px;line-height:1.6">Our concierge will reply within one working day to arrange your first appointment, discuss your preferred dates, and answer any questions. No forms, no waiting rooms, no hold music.</p>
    </div>
  </div>
</section>

<!-- BIANNUAL TRACKING -->
<section class="hc-quarterly">
  <h2>Your body changes on treatment.<br>We track it properly.</h2>
  <p>A single health check gives you a baseline. Repeating it 6 months in is how you prove the medication is actually helping &mdash; and catch anything it isn't. Most of our patients return for a second check as part of long-term, responsible GLP-1 care.</p>

  <div class="hc-timeline">
    <div class="hc-quarter featured">
      <div class="hc-q-label">Check 1 &mdash; Baseline</div>
      <h4>Before or at the start of treatment</h4>
      <p>A full clinical snapshot of your liver, metabolism, lipids, glycaemic control and (Premium) heart. Your prescribing pharmacist uses this to tailor your starting dose and treatment plan.</p>
    </div>
    <div class="hc-quarter">
      <div class="hc-q-label">Check 2 &mdash; 6 months in</div>
      <h4>Track what&rsquo;s changed</h4>
      <p>Liver fat regression quantified. Lipids and HbA1c compared to baseline. Gallbladder, thyroid, cardiovascular markers reviewed against your starting point &mdash; so your doctor has the data to keep optimising your plan.</p>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section style="padding:clamp(48px,6vw,80px) clamp(20px,6vw,80px);background:var(--white)">
  <div style="max-width:800px;margin:0 auto;text-align:center">
    <div class="hc-section-label">How It Works</div>
    <h2 class="hc-section-title">From booking to <em>results</em></h2>
    <p class="hc-section-desc">Simple, concierge-led. We handle the scheduling so you don't have to.</p>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:24px;margin-top:40px;text-align:center">
      <div>
        <div style="width:48px;height:48px;border-radius:50%;background:var(--sky);color:#fff;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-family:var(--display);font-size:20px;font-weight:700">1</div>
        <h4 style="font-size:14px;font-weight:700;margin-bottom:6px">Choose your package</h4>
        <p style="font-size:12px;color:var(--slate);line-height:1.6">Single check or annual programme. Select your preferred days &amp; times.</p>
      </div>
      <div>
        <div style="width:48px;height:48px;border-radius:50%;background:var(--sky);color:#fff;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-family:var(--display);font-size:20px;font-weight:700">2</div>
        <h4 style="font-size:14px;font-weight:700;margin-bottom:6px">Complete payment</h4>
        <p style="font-size:12px;color:var(--slate);line-height:1.6">Secure checkout. Your spot is reserved instantly.</p>
      </div>
      <div>
        <div style="width:48px;height:48px;border-radius:50%;background:var(--sky);color:#fff;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-family:var(--display);font-size:20px;font-weight:700">3</div>
        <h4 style="font-size:14px;font-weight:700;margin-bottom:6px">Concierge contacts you</h4>
        <p style="font-size:12px;color:var(--slate);line-height:1.6">Our team calls or emails within 2 hours to confirm your exact appointment time.</p>
      </div>
      <div>
        <div style="width:48px;height:48px;border-radius:50%;background:var(--sky);color:#fff;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-family:var(--display);font-size:20px;font-weight:700">4</div>
        <h4 style="font-size:14px;font-weight:700;margin-bottom:6px">Attend &amp; get results</h4>
        <p style="font-size:12px;color:var(--slate);line-height:1.6">45-minute clinic visit. Full results reviewed and sent within 48 hours.</p>
      </div>
    </div>
  </div>
</section>

<!-- BOOKING MODAL -->
<div class="bk-overlay" id="bkOverlay">
  <div class="bk-modal">
    <button class="bk-close" onclick="closeBooking()">&times;</button>
    
    <!-- Step 1: Details -->
    <div class="bk-step active" id="bkStep1">
      <div style="text-align:center;margin-bottom:24px">
        <div style="font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--sky-deep);font-weight:700;margin-bottom:6px">Health Check</div>
        <h3 style="font-family:var(--display);font-size:22px;font-weight:700;color:var(--ink);margin-bottom:4px" id="bkTitle">Health Check &mdash; &pound;699</h3>
        <p style="font-size:12px;color:var(--slate)">Step 1 of 2 — Your details</p>
      </div>
      <input class="bk-input" type="text" id="bkFname" placeholder="First name">
      <input class="bk-input" type="text" id="bkLname" placeholder="Last name">
      <input class="bk-input" type="email" id="bkEmail" placeholder="Email address">
      <input class="bk-input" type="tel" id="bkPhone" placeholder="Phone number">
      <div class="bk-note">Are you currently taking GLP-1 medication?</div>
      <div style="display:flex;gap:8px;margin-bottom:16px">
        <button class="bk-opt" id="bkGlp1Yes" onclick="selGlp('yes')">Yes</button>
        <button class="bk-opt" id="bkGlp1No" onclick="selGlp('no')">No, but interested</button>
      </div>
      <div class="bk-note" style="margin-top:4px">Preferred days <span style="font-weight:400;color:var(--slate)">(select all that apply)</span></div>
      <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:14px" id="bkDays">
        <button class="bk-opt" onclick="togglePref(this)">Mon</button>
        <button class="bk-opt" onclick="togglePref(this)">Tue</button>
        <button class="bk-opt" onclick="togglePref(this)">Wed</button>
        <button class="bk-opt" onclick="togglePref(this)">Thu</button>
        <button class="bk-opt" onclick="togglePref(this)">Fri</button>
        <button class="bk-opt" onclick="togglePref(this)">Sat</button>
      </div>
      <div class="bk-note">Preferred time</div>
      <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:16px" id="bkTimes">
        <button class="bk-opt" onclick="selTime(this)">Morning<br><span style="font-size:9px;font-weight:400">8am–12pm</span></button>
        <button class="bk-opt" onclick="selTime(this)">Afternoon<br><span style="font-size:9px;font-weight:400">12pm–5pm</span></button>
        <button class="bk-opt" onclick="selTime(this)">Evening<br><span style="font-size:9px;font-weight:400">5pm–7pm</span></button>
      </div>
      <div class="bk-err" id="bkErr1"></div>
      <button class="bk-submit" onclick="goToPayment()">Continue to payment &rarr;</button>
      <div style="text-align:center;font-size:10px;color:var(--slate);margin-top:12px;line-height:1.5">Your details are encrypted and never shared. Our concierge will contact you within 2 hours to confirm your appointment based on your preferences.</div>
    </div>
    
    <!-- Step 2: Payment -->
    <div class="bk-step" id="bkStep2">
      <div style="text-align:center;margin-bottom:24px">
        <div style="font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--sky-deep);font-weight:700;margin-bottom:6px">Almost There</div>
        <h3 style="font-family:var(--display);font-size:22px;font-weight:700;color:var(--ink);margin-bottom:4px">Secure Payment</h3>
        <p style="font-size:12px;color:var(--slate)">Step 2 of 2 — 100% refundable before your appointment</p>
      </div>
      
      <div style="background:var(--sky-wash);border-radius:12px;padding:16px;margin-bottom:20px;display:flex;justify-content:space-between;align-items:center">
        <div>
          <div style="font-size:14px;font-weight:700;color:var(--ink)" id="bkSummaryTitle">360 Health Check</div>
          <div style="font-size:11px;color:var(--slate)">London clinic &middot; full screening, two clinician reviews</div>
        </div>
        <div style="font-family:var(--display);font-size:24px;font-weight:700;color:var(--ink)" id="bkSummaryPrice">&pound;699</div>
      </div>
      
      <div id="bkStripeContainer">
        <!-- STRIPE CHECKOUT BUTTON — replace with real Stripe when keys added -->
        <button class="bk-submit" id="bkPayBtn" onclick="processBookingPayment()" style="background:var(--ink)">
          Pay securely &mdash; <span id="bkPayAmount">&pound;699</span>
        </button>
      </div>
      
      <div style="text-align:center;margin-top:16px">
        <div style="display:flex;align-items:center;justify-content:center;gap:8px;font-size:11px;color:var(--slate);margin-bottom:8px">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke="#0EA5E9" stroke-width="2" stroke-linecap="round"/></svg>
          256-bit SSL encrypted &middot; Powered by Stripe
        </div>
        <div style="font-size:10px;color:var(--slate)">100% refund if you cancel before your appointment</div>
      </div>
    </div>
    
    <!-- Step 3: Confirmation -->
    <div class="bk-step" id="bkStep3">
      <div style="text-align:center">
        <div style="width:64px;height:64px;border-radius:50%;background:var(--sky-pale);border:2px solid var(--sky);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:28px;color:var(--sky-dark)">&#10003;</div>
        <h3 style="font-family:var(--display);font-size:22px;font-weight:700;color:var(--ink);margin-bottom:8px">You're booked!</h3>
        <p style="font-size:14px;color:var(--slate);max-width:320px;margin:0 auto 24px;line-height:1.7">Our weight loss concierge will contact you within 2 hours to arrange your preferred appointment time.</p>
        
        <div style="background:var(--cream);border-radius:14px;padding:20px;text-align:left;font-size:13px;color:var(--charcoal);line-height:1.8;margin-bottom:24px">
          <strong>What happens next:</strong><br><br>
          <span style="color:var(--sky-deep);font-weight:600">1.</span> Confirmation email sent to <strong id="bkConfirmEmail"></strong><br>
          <span style="color:var(--sky-deep);font-weight:600">2.</span> Our concierge calls you to book your slot<br>
          <span style="color:var(--sky-deep);font-weight:600">3.</span> Attend your 45-minute appointment<br>
          <span style="color:var(--sky-deep);font-weight:600">4.</span> Clinician-reviewed results within 48 hours
        </div>
        
        <a href="<?php echo home_url(); ?>" style="color:var(--sky-deep);font-size:13px;font-weight:600;text-decoration:none">&larr; Back to Don't Weight</a>
      </div>
    </div>
  </div>
</div>

<style>
/* Booking modal */
.bk-overlay{position:fixed;inset:0;z-index:1000;background:rgba(12,10,9,.45);backdrop-filter:blur(12px);display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .3s;padding:20px}
.bk-overlay.open{opacity:1;pointer-events:all}
.bk-modal{background:var(--white);border-radius:24px;width:100%;max-width:440px;padding:clamp(24px,4vw,36px);position:relative;max-height:88vh;overflow-y:auto;box-shadow:0 32px 80px rgba(0,0,0,.18)}
.bk-close{position:absolute;top:16px;right:16px;background:var(--warm);border:none;color:var(--slate);width:34px;height:34px;border-radius:50%;cursor:pointer;font-size:18px;display:flex;align-items:center;justify-content:center}
.bk-step{display:none}.bk-step.active{display:block}
.bk-input{width:100%;padding:14px 16px;border:1.5px solid var(--stone);border-radius:12px;font-family:var(--body);font-size:14px;margin-bottom:10px;transition:border-color .2s;outline:none;background:var(--white)}
.bk-input:focus{border-color:var(--sky)}
.bk-note{font-size:12px;color:var(--slate);font-weight:600;margin-bottom:8px}
.bk-opt{flex:1;padding:10px;border:1.5px solid var(--stone);border-radius:10px;background:var(--white);font-family:var(--body);font-size:12px;font-weight:600;color:var(--slate);cursor:pointer;transition:all .2s;text-align:center;line-height:1.4}
.bk-opt.sel,.bk-opt.selected{border-color:var(--sky);background:var(--sky-wash);color:var(--sky-deep)}
.bk-err{color:#EF4444;font-size:12px;font-weight:500;margin-bottom:8px;min-height:16px}
.bk-submit{width:100%;padding:16px;border:none;border-radius:100px;background:var(--sky);color:var(--white);font-family:var(--body);font-size:15px;font-weight:700;cursor:pointer;transition:all .2s}
.bk-submit:hover{background:var(--sky-deep);transform:translateY(-1px)}
@media(max-width:600px){.bk-modal{border-radius:20px;padding:20px 16px;max-height:85vh}}
</style>

<!-- FINAL CTA -->
<section style="padding:clamp(48px,6vw,80px) clamp(20px,6vw,80px);text-align:center;background:var(--white)">
  <h2 style="font-family:var(--display);font-size:clamp(24px,3.5vw,40px);font-weight:700;letter-spacing:-1px;color:var(--ink);margin-bottom:12px;line-height:1.1">Your medication is working.<br>Make sure <em style="font-style:normal;color:var(--sky-deep)">everything else</em> is too.</h2>
  <p style="font-size:14px;color:var(--slate);max-width:440px;margin:0 auto 28px;line-height:1.7">The Weight Loss Health Check is available now at our London clinic. Open to all — not just Don't Weight patients.</p>
  <a href="#pricing" class="hc-cta" style="margin-right:12px">Book now</a>
  <a href="<?php echo home_url('/treatments/#treatments'); ?>" style="color:var(--charcoal);font-size:14px;font-weight:500;text-decoration:none;border-bottom:1.5px solid var(--stone);padding-bottom:2px">Explore treatments</a>
</section>

<!-- FOOTER -->
<?php include(get_template_directory() . '/footer.php'); ?>

<script>
function toggleMobileMenu(){document.getElementById('mobileMenu').classList.toggle('open');document.querySelector('.burger').classList.toggle('open');document.body.style.overflow=document.getElementById('mobileMenu').classList.contains('open')?'hidden':''}
function closeMobileMenu(){document.getElementById('mobileMenu').classList.remove('open');document.querySelector('.burger').classList.remove('open');document.body.style.overflow=''}

// Open booking modal for selected health check plan
function bookHC(productId){
  if(typeof openBooking==='function'){ openBooking(productId); return; }
  var pricing=document.getElementById('pricing');
  if(pricing) pricing.scrollIntoView({behavior:'smooth',block:'end'});
}

// Booking form
let bookingPlan='single';
let bookingGlp='';
let bookingDays=[];
let bookingTime='';

function togglePref(el){
  el.classList.toggle('selected');
  var day=el.textContent.trim();
  if(el.classList.contains('selected')){bookingDays.push(day)}else{bookingDays=bookingDays.filter(function(d){return d!==day})}
}
function selTime(el){
  document.querySelectorAll('#bkTimes .bk-opt').forEach(function(b){b.classList.remove('selected')});
  el.classList.add('selected');
  bookingTime=el.firstChild.textContent.trim();
}

function openBooking(plan){
  var planLabels={'hc-baseline':'Baseline Health Check','hc-standard':'360 Health Check','hc-premium':'Premium Health Check'};
  var planPrices={'hc-baseline':'£279','hc-standard':'£699','hc-premium':'£979'};
  bookingPlan=plan;
  document.getElementById('bkOverlay').classList.add('open');
  document.body.style.overflow='hidden';
  var lbl=planLabels[plan]||'Health Check';
  var pr=planPrices[plan]||'£699';
  document.getElementById('bkTitle').innerHTML=lbl+' &mdash; '+pr;
  document.getElementById('bkSummaryTitle').textContent=lbl;
  document.getElementById('bkSummaryPrice').innerHTML=pr;
  document.getElementById('bkPayAmount').innerHTML=pr;
  // Reset
  document.querySelectorAll('.bk-step').forEach(s=>s.classList.remove('active'));
  document.getElementById('bkStep1').classList.add('active');
}

function closeBooking(){
  document.getElementById('bkOverlay').classList.remove('open');
  document.body.style.overflow='';
}

function selGlp(val){
  bookingGlp=val;
  document.getElementById('bkGlp1Yes').classList.toggle('sel',val==='yes');
  document.getElementById('bkGlp1No').classList.toggle('sel',val==='no');
}

function goToPayment(){
  const fn=document.getElementById('bkFname').value.trim();
  const ln=document.getElementById('bkLname').value.trim();
  const em=document.getElementById('bkEmail').value.trim();
  const ph=document.getElementById('bkPhone').value.trim();
  
  if(!fn||!ln){document.getElementById('bkErr1').textContent='Please enter your first and last name.';return}
  if(!em||!em.includes('@')){document.getElementById('bkErr1').textContent='Please enter a valid email.';return}
  if(!ph||ph.length<8){document.getElementById('bkErr1').textContent='Please enter your phone number.';return}
  
  document.getElementById('bkErr1').textContent='';
  
  // Save details via AJAX (same endpoint as main app)
  const fd=new FormData();
  fd.append('action','dw_submit_app');
  fd.append('nonce',typeof dwAjax!=='undefined'?dwAjax.nonce:'');
  fd.append('first_name',fn);
  fd.append('last_name',ln);
  fd.append('email',em);
  fd.append('phone',ph);
  fd.append('stage','dw360_booking');
  fd.append('treatment_choice','DW360 '+bookingPlan);
  fd.append('answers','Plan: '+bookingPlan+' | GLP-1: '+bookingGlp+' | Days: '+(bookingDays.length?bookingDays.join(', '):'Any')+' | Time: '+(bookingTime||'Any')+' | Price: '+(bookingPlan==='annual'?'£1,396':'£499'));
  
  const ajaxUrl=typeof dwAjax!=='undefined'?dwAjax.url:'/wp-admin/admin-ajax.php';
  fetch(ajaxUrl,{method:'POST',body:fd}).catch(()=>{});
  
  // Go to payment step
  document.querySelectorAll('.bk-step').forEach(s=>s.classList.remove('active'));
  document.getElementById('bkStep2').classList.add('active');
}

function processBookingPayment(){
  const btn=document.getElementById('bkPayBtn');
  btn.disabled=true;
  btn.innerHTML='<span style="display:inline-block;width:18px;height:18px;border:2px solid rgba(255,255,255,.3);border-top-color:#fff;border-radius:50%;animation:spin .6s linear infinite"></span> Processing...';
  
  // ═══════════════════════════════════════════════════════
  // STRIPE INTEGRATION — Replace this with real Stripe Checkout:
  //
  // const stripe = Stripe('pk_live_YOUR_KEY');
  // stripe.redirectToCheckout({
  //   lineItems: [{
  //     price: bookingPlan==='annual' ? 'price_ANNUAL_ID' : 'price_SINGLE_ID',
  //     quantity: 1
  //   }],
  //   mode: 'payment',
  //   successUrl: window.location.href + '?paid=1',
  //   cancelUrl: window.location.href,
  //   customerEmail: document.getElementById('bkEmail').value,
  // });
  // ═══════════════════════════════════════════════════════
  
  // Simulated payment (remove when Stripe is live)
  setTimeout(function(){
    btn.innerHTML='&#10003; Payment successful';
    btn.style.background='#22C55E';
    
    // Send payment confirmation
    const fd=new FormData();
    fd.append('action','dw_submit_app');
    fd.append('nonce',typeof dwAjax!=='undefined'?dwAjax.nonce:'');
    fd.append('first_name',document.getElementById('bkFname').value);
    fd.append('last_name',document.getElementById('bkLname').value);
    fd.append('email',document.getElementById('bkEmail').value);
    fd.append('phone',document.getElementById('bkPhone').value);
    fd.append('stage','dw360_paid');
    fd.append('treatment_choice','DW360 '+bookingPlan+' — PAID');
    fd.append('answers','PAYMENT CONFIRMED | Plan: '+bookingPlan+' | Days: '+(bookingDays.length?bookingDays.join(', '):'Any')+' | Time: '+(bookingTime||'Any')+' | Amount: '+(bookingPlan==='annual'?'£1,396':'£499'));
    const ajaxUrl=typeof dwAjax!=='undefined'?dwAjax.url:'/wp-admin/admin-ajax.php';
    fetch(ajaxUrl,{method:'POST',body:fd}).catch(()=>{});
    
    setTimeout(function(){
      document.getElementById('bkConfirmEmail').textContent=document.getElementById('bkEmail').value;
      document.querySelectorAll('.bk-step').forEach(s=>s.classList.remove('active'));
      document.getElementById('bkStep3').classList.add('active');
    },800);
  },1500);
}
</script>
<style>@keyframes spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}</style>
<?php echo dontweight_get_ajax_script(); ?>
<?php wp_footer(); ?>
</body>
</html>
