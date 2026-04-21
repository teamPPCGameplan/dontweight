<?php
/**
 * Template Name: Home — Landing Page
 * Description: Don't Weight landing page with eligibility screener
 */
// Standalone template — outputs full HTML, bypasses wp_head/wp_footer
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/favicon.svg">
<title>Don't Weight — Clinician-Led Weight Loss | Free Consultation</title>
<meta name="description" content="UK's clinician-led weight management service. Free 30-second eligibility check, personalised treatment plans, and ongoing medical support. CQC registered. Every body welcome.">
<link rel="canonical" href="https://dontweight.co.uk/">

<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="don't weight">
<meta property="og:title" content="Don't Weight — Clinician-Led Weight Loss | Free Consultation">
<meta property="og:description" content="UK's clinician-led weight management service. Free eligibility check, personalised treatment plans, ongoing medical support. CQC registered.">
<meta property="og:url" content="https://dontweight.co.uk/">
<meta property="og:image" content="https://dontweight.co.uk/wp-content/uploads/og-share.png">
<meta property="og:locale" content="en_GB">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Don't Weight — Clinician-Led Weight Loss">
<meta name="twitter:description" content="UK's clinician-led weight management. Free eligibility check, personalised plans, CQC registered.">
<meta name="twitter:image" content="https://dontweight.co.uk/wp-content/uploads/og-share.png">

<!-- Schema.org -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "MedicalBusiness",
      "name": "don't weight",
      "description": "Clinician-led weight management service offering GLP-1 treatments including Mounjaro and Wegovy with 1-to-1 video consultations",
      "url": "https://dontweight.co.uk",
      "telephone": "+442071013377",
      "email": "hello@dontweight.co.uk",
      "address": {
        "@type": "PostalAddress",
        "addressCountry": "GB",
        "addressLocality": "London"
      },
      "priceRange": "££",
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
          "opens": "09:00",
          "closes": "18:00"
        },
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": "Saturday",
          "opens": "10:00",
          "closes": "16:00"
        }
      ],
      "medicalSpecialty": "Bariatrics",
      "isAcceptingNewPatients": true
    },
    {
      "@type": "WebSite",
      "name": "don't weight",
      "url": "https://dontweight.co.uk",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://dontweight.co.uk/?s={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
  ]
}
</script>

<script>document.documentElement.classList.add('js-anim')</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=optional" rel="stylesheet">
<style>
.dw-lpug-bar{display:none!important;}
:root{
  /* THE BLUE — bright, alive, sky */
  --sky:#38BDF8;
  --sky-deep:#0EA5E9;
  --sky-dark:#0284C7;
  --sky-pale:#E0F2FE;
  --sky-wash:#F0F9FF;

  /* WARM BASE */
  --white:#FFFFFF;
  --cream:#FAFAF9;
  --warm:#F5F5F4;
  --stone:#E7E5E4;

  /* DARK */
  --ink:#0C0A09;
  --charcoal:#1C1917;
  --slate:#44403C;

  /* ACCENT — warm coral for energy */
  --coral:#F97316;
  --coral-light:#FDBA74;

  --display:-apple-system,BlinkMacSystemFont,'Inter','SF Pro Display','Helvetica Neue',sans-serif;
  --body:-apple-system,BlinkMacSystemFont,'Inter','SF Pro Display','SF Pro Text','Helvetica Neue',sans-serif;
}

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{background:var(--white);color:var(--ink);font-family:var(--body);font-size:16px;line-height:1.6;overflow-x:hidden;-webkit-font-smoothing:antialiased}

/* ════════════════════════════════════════
   NAV — slim, confident
   ════════════════════════════════════════ */
.nav{position:fixed;top:0;left:0;right:0;z-index:100;height:56px;padding-top:2px;display:flex;align-items:center;justify-content:space-between;padding:0 clamp(16px,4vw,48px);background:#fff;backdrop-filter:blur(20px);border-bottom:1px solid rgba(0,0,0,.04)}
.nav-logo{font-family:var(--display);font-size:22px;font-weight:800;color:var(--ink);text-decoration:none;letter-spacing:-.8px;line-height:.9;white-space:nowrap;flex-shrink:0}
.nav-logo i{color:var(--sky);font-style:italic;font-weight:300;letter-spacing:-.2px}
.nav-mid{display:flex;gap:32px;list-style:none}
.nav-mid a{color:var(--slate);text-decoration:none;font-size:13px;font-weight:500;transition:color .2s}
.nav-mid a:hover{color:var(--ink)}
.nav-r{display:flex;align-items:center;gap:16px}
.nav-login{color:var(--ink);text-decoration:none;font-size:13px;font-weight:600}
.nav-contact{color:var(--ink);text-decoration:none;font-size:13px;font-weight:500;border:1.5px solid var(--ink);border-radius:100px;padding:7px 18px;transition:all .2s}
.nav-contact:hover{background:var(--ink);color:var(--white)}
.nav-btn{background:var(--sky);color:var(--white);border:none;border-radius:100px;padding:10px 24px;font-family:var(--body);font-size:13px;font-weight:600;cursor:pointer;transition:background .2s,transform .15s}
.nav-btn:hover{background:var(--sky-deep);transform:translateY(-1px)}
.burger{display:none;background:none;border:none;cursor:pointer;width:32px;height:32px;position:relative;z-index:102}
.burger span{display:block;width:20px;height:1.5px;background:var(--ink);position:absolute;left:6px;transition:transform .3s,opacity .2s}
.burger span:nth-child(1){top:10px}
.burger span:nth-child(2){top:16px}
.burger span:nth-child(3){top:22px}
.burger.open span:nth-child(1){top:16px;transform:rotate(45deg)}
.burger.open span:nth-child(2){opacity:0}
.burger.open span:nth-child(3){top:16px;transform:rotate(-45deg)}
.mobile-menu{position:fixed;inset:0;z-index:101;background:var(--white);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:24px;opacity:0;pointer-events:none;transition:opacity .3s}
.mobile-menu.open{opacity:1;pointer-events:all}
.mobile-menu a{font-family:var(--display);font-size:22px;font-weight:600;color:var(--ink);text-decoration:none;letter-spacing:-.5px;transition:color .2s}
.mobile-menu a:hover{color:var(--sky)}
.mobile-menu .mm-cta{background:var(--sky);color:var(--white);border:none;border-radius:100px;padding:16px 48px;font-family:var(--body);font-size:16px;font-weight:700;cursor:pointer;margin-top:16px}
.mm-close{position:absolute;top:max(16px,env(safe-area-inset-top,16px));right:20px;background:var(--warm);border:none;font-size:32px;color:var(--ink);cursor:pointer;width:48px;height:48px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:background .2s;z-index:102}
.mm-close:hover{background:var(--warm)}

/* ════════════════════════════════════════
   HERO — the billboard
   ════════════════════════════════════════ */
.hero{min-height:auto;display:flex;flex-direction:column;justify-content:flex-start;align-items:center;text-align:center;padding:0;background:linear-gradient(180deg,#fff 0%,#f0f9ff 50%,#fff 100%);position:relative;overflow:visible}
.hero::before{display:none}

.hero-pill{display:block;font-size:11px;font-weight:500;color:var(--slate);margin-top:0;margin-bottom:0;letter-spacing:.3px}
.hero-pill .dot{display:none}
.hero-pill strong{display:none}

.hero-kicker{display:none}

.hero h1{font-family:var(--display);font-size:clamp(38px,7vw,80px);font-weight:700;line-height:1.06;letter-spacing:-2.5px;margin-bottom:32px;color:var(--ink);max-width:740px;text-shadow:1px 1px 0 rgba(0,0,0,.06),2px 2px 0 rgba(0,0,0,.04),3px 3px 6px rgba(0,0,0,.06)}
.hero h1 .highlight{color:var(--sky-deep);font-weight:600;display:inline-block}
.hero h1 .highlight span{display:inline-block;transition:transform 1.2s cubic-bezier(.25,.46,.45,.94),opacity 1s ease;transform-origin:bottom left}
.hero h1 .highlight.animate span{animation:shrinkLetter 2.5s cubic-bezier(.25,.46,.45,.94) forwards}
@keyframes shrinkLetter{0%{transform:scale(1)}100%{transform:scale(var(--end-scale))}}
.hero h1 .highlight span:nth-child(1){--end-scale:1}
.hero h1 .highlight span:nth-child(2){--end-scale:.92}
.hero h1 .highlight span:nth-child(3){--end-scale:.84}
.hero h1 .highlight span:nth-child(4){--end-scale:.76}
.hero h1 .highlight span:nth-child(5){--end-scale:.68}
.hero h1 .highlight span:nth-child(6){--end-scale:.60}
.hero h1 .highlight span:nth-child(7){--end-scale:.52}

.hero-sub{font-size:clamp(11px,1vw,13px);color:var(--slate);max-width:520px;line-height:1.7;margin-bottom:36px;font-weight:500;letter-spacing:.5px}

.hero-cta-row{display:flex;align-items:center;gap:16px;flex-wrap:wrap;justify-content:center;margin-bottom:40px}
.cta-main{background:var(--sky);color:var(--white);border:none;border-radius:100px;padding:18px 48px;font-family:var(--body);font-size:16px;font-weight:700;cursor:pointer;transition:all .25s;box-shadow:0 4px 24px rgba(56,189,248,.30)}
.cta-main:hover{background:var(--sky-deep);transform:translateY(-2px);box-shadow:0 12px 40px rgba(56,189,248,.40)}
.cta-sub{color:var(--charcoal);font-size:13px;font-weight:500;text-decoration:none;border-bottom:1.5px solid var(--stone);padding-bottom:2px;transition:border-color .2s}
.cta-sub:hover{border-color:var(--ink);color:var(--ink)}

/* Hero overlays — almost transparent dark cards spread across image */
.hero-ov{position:absolute;z-index:2;background:rgba(12,10,9,.22);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);border-radius:14px;padding:12px 14px;border:1px solid rgba(255,255,255,.06);box-shadow:0 4px 24px rgba(0,0,0,.08)}
.hov-label{font-size:8px;letter-spacing:1.5px;text-transform:uppercase;font-weight:700;margin-bottom:4px;color:var(--sky)}
.hov-big{font-family:var(--display);font-size:28px;font-weight:700;line-height:1;letter-spacing:-1px;color:var(--white)}
.hov-big span{font-size:12px;font-weight:400;margin-left:2px;color:rgba(255,255,255,.45)}
.hov-big-accent{color:var(--sky)}
.hov-sub{font-size:9px;margin-top:3px;font-weight:500;color:rgba(255,255,255,.45)}
.hov-divider{height:1px;background:rgba(255,255,255,.06);margin:6px 0}
.hov-lost{position:absolute;z-index:2;text-align:center;text-shadow:0 2px 16px rgba(0,0,0,.3)}
.hov-lost-num{font-family:var(--display);font-size:clamp(32px,5vw,52px);font-weight:700;color:var(--white);line-height:1;letter-spacing:-2px}
.hov-lost-unit{font-size:clamp(11px,1.3vw,15px);font-weight:600;color:rgba(255,255,255,.7);letter-spacing:1px;text-transform:uppercase}
.hov-lost-label{font-size:clamp(8px,0.9vw,10px);font-weight:700;color:rgba(255,255,255,.5);letter-spacing:2px;text-transform:uppercase;margin-bottom:2px}

/* Trust row */
.trust-row{display:flex;gap:clamp(20px,3vw,36px);align-items:center;justify-content:center;flex-wrap:wrap}

.trust-item{display:flex;align-items:center;gap:6px;font-size:12px;color:var(--slate);font-weight:500}
.trust-circled{position:relative}
.trust-circled::after{display:none}
.trust-circled.circled::after{display:none}
.trust-circled:nth-child(3)::after{display:none}
@keyframes circleIn{0%{opacity:0;transform:rotate(-2deg) scale(.85)}100%{opacity:1;transform:rotate(-2deg) scale(1)}}
@keyframes dragBounce{0%,100%{transform:translateY(0)}50%{transform:translateY(-6px)}}
.trust-icon{width:28px;height:28px;border-radius:8px;background:var(--sky-pale);display:flex;align-items:center;justify-content:center;font-size:12px}

/* ════════════════════════════════════════
   TREATMENTS — the selling section
   ════════════════════════════════════════ */
.treatments{padding:clamp(40px,5vw,60px) clamp(20px,4vw,56px);background:var(--cream)}
.section-head{text-align:center;margin-bottom:clamp(28px,4vw,40px)}
.section-label{font-size:10px;letter-spacing:2.5px;text-transform:uppercase;color:var(--sky-deep);font-weight:700;margin-bottom:8px}
.section-title{font-family:var(--display);font-size:clamp(24px,3vw,36px);font-weight:700;line-height:1.1;letter-spacing:-.8px;color:var(--ink);margin-bottom:8px}
.section-title em{font-style:normal;color:var(--sky-deep);font-weight:600}
.section-desc{font-size:14px;color:var(--slate);max-width:420px;margin:0 auto;font-weight:400}

.treat-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px;max-width:600px;margin:0 auto}
.treat-card{background:var(--white);border:1.5px solid var(--stone);border-radius:20px;padding:28px 24px;text-align:center;transition:all .3s;position:relative;display:flex;flex-direction:column}
.treat-card:hover{border-color:var(--sky);box-shadow:0 12px 36px rgba(56,189,248,.10);transform:translateY(-3px)}
.treat-card.featured{border:2px solid var(--sky)}
.treat-badge{position:absolute;top:-10px;left:50%;transform:translateX(-50%);background:var(--coral);color:var(--white);padding:4px 16px;border-radius:100px;font-size:9px;font-weight:700;letter-spacing:.5px;text-transform:uppercase}
.treat-pct{width:64px;height:64px;border-radius:50%;background:var(--sky-pale);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-family:var(--display);font-size:22px;font-weight:700;color:var(--sky-dark)}
.treat-card h3{font-family:var(--display);font-size:20px;font-weight:700;margin-bottom:4px;color:var(--ink);letter-spacing:-.3px}
.treat-label{font-size:11px;font-weight:600;color:var(--sky-deep);margin-bottom:10px}
.treat-card p{font-size:12px;color:var(--charcoal);margin-bottom:20px;line-height:1.6}
.treat-btn{display:block;width:100%;background:var(--ink);color:var(--white);border:none;border-radius:100px;padding:12px;font-family:var(--body);font-size:13px;font-weight:600;cursor:pointer;transition:background .2s;margin-top:auto;text-decoration:none;text-align:center}
.treat-btn:hover{background:var(--charcoal)}

/* ════════════════════════════════════════
   HOW — 3 steps, dead simple
   ════════════════════════════════════════ */
.how{padding:clamp(48px,6vw,72px) clamp(20px,4vw,56px);background:var(--white)}
.how-steps{display:grid;grid-template-columns:repeat(3,1fr);gap:clamp(16px,2.5vw,32px);max-width:800px;margin:0 auto}
.how-step{text-align:center;padding:0 8px}
.how-num{width:44px;height:44px;border-radius:50%;background:var(--sky);color:var(--white);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-family:var(--display);font-size:18px;font-weight:700}
.how-step h3{font-family:var(--display);font-size:17px;font-weight:700;margin-bottom:6px;color:var(--ink);letter-spacing:-.2px}
.how-step p{font-size:12px;color:var(--charcoal);line-height:1.6;font-weight:400}
.how-connector{display:none}

/* ════════════════════════════════════════
   PHOTO CAROUSEL
   ════════════════════════════════════════ */
.photo-track-wrap{overflow:hidden;position:relative}.photo-track-wrap::before,.photo-track-wrap::after{content:'';position:absolute;top:0;bottom:0;width:80px;z-index:2;pointer-events:none}.photo-track-wrap::before{left:0;background:linear-gradient(to right,#0EA5E9,transparent)}.photo-track-wrap::after{right:0;background:linear-gradient(to left,#38BDF8,transparent)}
.photo-track{display:flex;gap:14px;padding:8px 0;will-change:transform;align-items:flex-end}
@media(max-width:600px){.carousel-track{animation-duration:80s}}
@media(max-width:480px){.hero-img-wrap{margin-top:0 !important}}
@media(max-width:480px){.hero h1{font-size:14vw !important}}
.photo-card{border-radius:20px;overflow:hidden;transition:transform .4s cubic-bezier(.25,.46,.45,.94),box-shadow .4s;cursor:pointer;position:relative;background:rgba(255,255,255,.1)}
.photo-card:hover{transform:translateY(-6px) scale(1.02);box-shadow:0 20px 48px rgba(0,0,0,.20)}
.pc-lg{flex:0 0 240px}
.pc-md{flex:0 0 190px}
.pc-sm{flex:0 0 160px}
.photo-img{width:100%;aspect-ratio:3/4;display:block;position:relative;overflow:hidden}
.photo-img img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .5s}
.photo-card:hover .photo-img img{transform:scale(1.06)}
.photo-overlay{position:absolute;top:12px;left:12px;z-index:2}
.po-tag{background:rgba(255,255,255,.92);backdrop-filter:blur(8px);color:var(--ink);font-family:var(--display);font-size:13px;font-weight:700;padding:6px 12px;border-radius:100px;letter-spacing:-.3px}
.photo-info{position:absolute;bottom:0;left:0;right:0;padding:16px;background:linear-gradient(0deg,rgba(0,0,0,.6) 0%,transparent 100%);display:flex;justify-content:space-between;align-items:flex-end;z-index:2}
.photo-name{font-size:14px;font-weight:700;color:var(--white)}
.photo-stat{font-size:11px;font-weight:500;color:rgba(255,255,255,.7)}

/* ════════════════════════════════════════
   SOCIAL PROOF CAROUSEL
   ════════════════════════════════════════ */
.social{padding:clamp(48px,6vw,72px) 0;background:var(--cream);overflow:hidden}
.social .section-head{padding:0 clamp(20px,4vw,56px)}
.carousel-wrap{overflow:hidden;position:relative}
.carousel-wrap::before,.carousel-wrap::after{content:'';position:absolute;top:0;bottom:0;width:60px;z-index:2;pointer-events:none}
.carousel-wrap::before{left:0;background:linear-gradient(to right,var(--cream),transparent)}
.carousel-wrap::after{right:0;background:linear-gradient(to left,var(--cream),transparent)}
.carousel-track{display:flex;gap:14px;padding:16px 0;width:max-content;animation:reviewScroll 55s linear infinite}
.carousel-track:hover{animation-play-state:paused}
@keyframes reviewScroll{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
.review-card{flex:0 0 300px;background:var(--white);border:1px solid var(--stone);border-radius:18px;padding:28px;position:relative;transition:transform .4s cubic-bezier(.25,.46,.45,.94),box-shadow .4s}
.review-card:hover{transform:translateY(-4px);box-shadow:0 12px 28px rgba(0,0,0,.05)}
.review-stars{color:var(--coral);font-size:14px;letter-spacing:2px;margin-bottom:12px}
.review-text{font-family:var(--body);font-size:14px;font-weight:400;line-height:1.65;margin-bottom:18px;color:var(--ink)}
.review-text em{color:var(--sky-deep);font-style:normal;font-weight:600}
.review-meta{display:flex;align-items:center;gap:10px}
.review-av{width:36px;height:36px;border-radius:50%;background:var(--sky-pale);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;color:var(--sky-dark);border:1.5px solid var(--sky)}
.review-name{font-size:12px;font-weight:700;color:var(--ink)}
.review-result{font-size:11px;color:var(--sky-deep);font-weight:600}

/* ════════════════════════════════════════
   STATS — bold numbers
   ════════════════════════════════════════ */
.stats{padding:clamp(48px,6vw,72px) clamp(20px,4vw,56px);background:linear-gradient(135deg,#0C0A09 0%,#1C1917 100%);color:var(--white)}
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:clamp(16px,2vw,24px);max-width:900px;margin:0 auto;text-align:center}
.stat{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.06);border-radius:16px;padding:clamp(20px,2.5vw,28px) 16px;transition:border-color .3s,background .3s}
.stat:hover{border-color:rgba(56,189,248,.2);background:rgba(56,189,248,.04)}
.stat h3{font-family:var(--display);font-size:clamp(32px,4vw,48px);font-weight:800;background:linear-gradient(135deg,var(--sky),#7DD3FC);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;line-height:1;margin-bottom:8px;letter-spacing:-1.5px}
.stat p{font-size:11px;color:rgba(255,255,255,.50);font-weight:500;line-height:1.4;letter-spacing:.3px}

/* ════════════════════════════════════════
   FAQ
   ════════════════════════════════════════ */
.faq{padding:clamp(48px,6vw,72px) clamp(20px,4vw,56px);background:var(--white)}
.faq-inner{max-width:600px;margin:0 auto}
.faq-list{display:flex;flex-direction:column;gap:4px}
.faq-item{border:1px solid var(--stone);border-radius:12px;overflow:hidden;transition:border-color .2s}
.faq-item:hover{border-color:var(--sky)}
.faq-q{width:100%;background:none;border:none;padding:16px 20px;text-align:left;font-family:var(--body);font-size:14px;font-weight:600;color:var(--ink);cursor:pointer;display:flex;justify-content:space-between;align-items:center;gap:12px}
.faq-plus{width:22px;height:22px;border-radius:50%;background:var(--sky-pale);display:flex;align-items:center;justify-content:center;font-size:14px;color:var(--sky-dark);flex-shrink:0;transition:transform .3s,background .3s}
.faq-item.open .faq-plus{transform:rotate(45deg);background:var(--sky);color:var(--white)}
.faq-a{max-height:0;overflow:hidden;transition:max-height .4s ease,padding .3s;font-size:13px;color:var(--charcoal);line-height:1.8;font-weight:400;padding:0 20px}
.faq-item.open .faq-a{max-height:300px;padding:0 20px 18px}

/* ════════════════════════════════════════
   FINAL CTA
   ════════════════════════════════════════ */
.final-cta{padding:clamp(48px,7vw,80px) clamp(20px,6vw,80px);background:linear-gradient(160deg,var(--sky) 0%,var(--sky-deep) 50%,var(--sky-dark) 100%);text-align:center;color:var(--white);position:relative;overflow:hidden}
.final-cta::before{display:none}
.final-cta h2{font-family:var(--display);font-size:clamp(28px,4vw,48px);font-weight:700;letter-spacing:-1.5px;margin-bottom:12px;line-height:.95;position:relative;z-index:1}
.final-cta p{font-size:12px;color:rgba(255,255,255,.65);margin-bottom:28px;max-width:380px;margin-inline:auto;font-weight:400;position:relative;z-index:1}
.cta-white{background:var(--white);color:var(--sky-dark);border:none;border-radius:100px;padding:14px 40px;font-family:var(--body);font-size:14px;font-weight:700;cursor:pointer;transition:transform .2s,box-shadow .2s;box-shadow:0 2px 16px rgba(0,0,0,.08);position:relative;z-index:1}
.cta-white:hover{transform:translateY(-1px);box-shadow:0 6px 24px rgba(0,0,0,.12)}
.final-note{margin-top:14px;font-size:12px;color:rgba(255,255,255,.70);position:relative;z-index:1}

/* ════════════════════════════════════════
   FOOTER
   ════════════════════════════════════════ */
footer{background:var(--ink);padding:clamp(36px,5vw,56px) clamp(20px,4vw,56px) 28px;color:rgba(255,255,255,.60)}
.ft{max-width:840px;margin:0 auto}
.ft-top{display:flex;justify-content:space-between;flex-wrap:wrap;gap:32px;margin-bottom:36px}
.ft-brand{font-family:var(--display);font-size:20px;font-weight:800;color:var(--white);margin-bottom:10px;white-space:nowrap;text-decoration:none;display:inline-block}
.ft-brand i{color:var(--sky);font-style:normal;font-weight:500}
.ft-tag{font-size:13px;max-width:220px;line-height:1.7;color:rgba(255,255,255,.80)}
.ft-col h5{font-size:10px;letter-spacing:2px;text-transform:uppercase;margin-bottom:16px;color:rgba(255,255,255,.70)}
.ft-col ul{list-style:none;display:flex;flex-direction:column;gap:10px}
.ft-col a{color:rgba(255,255,255,.65);text-decoration:none;font-size:13px;transition:color .2s}
.ft-col a:hover{color:rgba(255,255,255,1)}
.ft-bot{border-top:1px solid rgba(255,255,255,.10);padding-top:24px;display:flex;justify-content:space-between;flex-wrap:wrap;gap:12px;font-size:11px}
.ft-badges{display:flex;gap:8px}
.ft-badge{padding:4px 14px;border:1px solid rgba(255,255,255,.18);border-radius:100px;font-size:10px;color:rgba(255,255,255,.80)}

/* ════════════════════════════════════════
   QUIZ MODAL
   ════════════════════════════════════════ */
.ov{position:fixed;inset:0;z-index:1000;background:rgba(12,10,9,.45);backdrop-filter:blur(12px);display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .3s;padding:20px}
.ov.on{opacity:1;pointer-events:all}
/* Hide chatbot widget when eligibility modal is open */
body.quiz-open #dw-chat-bubble,body.quiz-open #dw-chat-toast,body.quiz-open #dw-chat-window,body.quiz-open #dw-welcome-cta{display:none!important}
.qm{background:var(--white);border-radius:24px;width:100%;max-width:460px;padding:clamp(24px,4vw,36px);position:relative;transform:translateY(16px);transition:transform .4s;max-height:88vh;overflow-y:auto;box-shadow:0 32px 80px rgba(0,0,0,.18)}
.ov.on .qm{transform:translateY(0)}
.qx{position:absolute;top:18px;right:18px;background:var(--warm);border:none;color:var(--slate);width:34px;height:34px;border-radius:50%;cursor:pointer;font-size:16px;display:flex;align-items:center;justify-content:center}
.qx:hover{color:var(--ink)}
.qprog{display:flex;gap:4px;margin-bottom:32px}
.qd{height:3px;flex:1;border-radius:100px;background:var(--warm);transition:background .3s}
.qd.done{background:var(--sky)}
.qs{display:none}.qs.on{display:block}
.qsl{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--sky-deep);font-weight:700;margin-bottom:10px}
.qq{font-family:var(--display);font-size:clamp(18px,2.5vw,22px);font-weight:700;line-height:1.2;margin-bottom:18px;color:var(--ink);letter-spacing:-.3px}
.qopts{display:flex;flex-direction:column;gap:8px}
.qo{background:var(--cream);border:1.5px solid var(--stone);border-radius:12px;padding:12px 14px;cursor:pointer;display:flex;align-items:center;justify-content:space-between;font-size:13px;transition:border-color .2s,background .2s}
.qo:hover{border-color:var(--sky);background:var(--sky-pale)}
.qo.sel{border-color:var(--sky-deep);background:var(--sky-pale)}
.qchk{width:20px;height:20px;border-radius:50%;border:2px solid var(--stone);flex-shrink:0;display:flex;align-items:center;justify-content:center;transition:.2s}
.qo.sel .qchk{background:var(--sky);border-color:var(--sky)}
.qo.sel .qchk::after{content:'\2713';color:#fff;font-size:10px;font-weight:700}
.qi{width:100%;background:var(--cream);border:1.5px solid var(--stone);border-radius:10px;padding:11px 14px;font-family:var(--body);font-size:14px;outline:none;margin-bottom:8px}
.qi:focus{border-color:var(--sky)}
.qi::placeholder{color:rgba(0,0,0,.25)}
.qir{display:flex;gap:10px}
.qir .qi{flex:1}
.qnav{display:flex;gap:10px;margin-top:24px}
.qback{background:var(--warm);border:none;color:var(--slate);border-radius:100px;padding:13px 22px;font-family:var(--body);font-size:13px;cursor:pointer}
.qnext{flex:1;background:var(--sky);color:#fff;border:none;border-radius:100px;padding:12px;font-family:var(--body);font-size:13px;font-weight:600;cursor:pointer;transition:background .2s}
.qnext:hover{background:var(--sky-deep)}
.qres{text-align:center}
.qring{width:72px;height:72px;border-radius:50%;background:var(--sky-pale);border:3px solid var(--sky);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:28px}
.qrt{font-family:var(--display);font-size:22px;font-weight:700;margin-bottom:8px;letter-spacing:-.3px}
.qrsub{color:var(--slate);font-size:13px;line-height:1.6;margin-bottom:18px}
.qrpills{display:flex;flex-wrap:wrap;gap:6px;justify-content:center;margin-bottom:24px}
.qrp{background:var(--sky-pale);color:var(--sky-dark);border-radius:100px;padding:6px 16px;font-size:12px;font-weight:600}
.qrcta{width:100%;background:var(--sky);color:#fff;border:none;border-radius:100px;padding:14px;font-family:var(--body);font-size:14px;font-weight:600;cursor:pointer}
.qrn{color:var(--charcoal);font-size:11px;margin-top:10px;opacity:.6}
.qerr{color:#EF4444;font-size:13px;font-weight:500;margin-top:12px;min-height:18px}
.unit-btn{background:none;border:none;padding:8px 16px;border-radius:100px;font-family:var(--body);font-size:13px;font-weight:500;color:var(--slate);cursor:pointer;transition:all .2s}
.unit-btn.active{background:var(--white);color:var(--ink);font-weight:600;box-shadow:0 1px 4px rgba(0,0,0,.08)}
.calc-unit{background:none;border:none;padding:8px 20px;border-radius:100px;font-family:var(--body);font-size:13px;font-weight:500;color:var(--slate);cursor:pointer;transition:all .2s}
.calc-unit.active{background:var(--white);color:var(--ink);font-weight:600;box-shadow:0 1px 4px rgba(0,0,0,.08)}
#calcSlider::-webkit-slider-thumb{appearance:none;-webkit-appearance:none;width:36px;height:36px;border-radius:50%;background:var(--white);border:4px solid var(--sky);cursor:grab;box-shadow:0 0 0 8px rgba(56,189,248,.18),0 4px 12px rgba(0,0,0,.18);animation:sliderBounce 1.5s ease-in-out infinite;transition:box-shadow .2s}
#calcSlider::-webkit-slider-thumb:hover{box-shadow:0 0 0 12px rgba(56,189,248,.25),0 4px 16px rgba(0,0,0,.2);animation:none}
#calcSlider::-webkit-slider-thumb:active{cursor:grabbing;box-shadow:0 0 0 16px rgba(56,189,248,.3),0 4px 16px rgba(0,0,0,.2);animation:none;transform:scale(1.1)}
#calcSlider::-moz-range-thumb{width:36px;height:36px;border-radius:50%;background:var(--white);border:4px solid var(--sky);cursor:grab;box-shadow:0 0 0 8px rgba(56,189,248,.18),0 4px 12px rgba(0,0,0,.18);animation:sliderBounce 1.5s ease-in-out infinite}
#calcSlider::-moz-range-thumb:active{cursor:grabbing;animation:none}
@keyframes sliderBounce{0%,100%{box-shadow:0 0 0 8px rgba(56,189,248,.18),0 4px 12px rgba(0,0,0,.18);transform:scale(1)}50%{box-shadow:0 0 0 14px rgba(56,189,248,.3),0 4px 12px rgba(0,0,0,.18);transform:scale(1.08)}}
#calcSlider{cursor:pointer}

/* ════════════════════════════════════════
   BRAND MARQUEE — scrolling ticker
   ════════════════════════════════════════ */
.brand-marquee{background:var(--sky);padding:12px 0;overflow:hidden;position:relative}
.brand-marquee::before,.brand-marquee::after{content:'';position:absolute;top:0;bottom:0;width:40px;z-index:2;pointer-events:none}
.brand-marquee::before{left:0;background:linear-gradient(to right,var(--sky),transparent)}
.brand-marquee::after{right:0;background:linear-gradient(to left,var(--sky),transparent)}
.marquee-track{display:flex;gap:0;width:max-content;animation:marqueeScroll 20s linear infinite}
.marquee-track:hover{animation-play-state:paused}
@keyframes marqueeScroll{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
.marquee-item{display:flex;align-items:center;gap:8px;padding:0 28px;white-space:nowrap;font-size:12px;font-weight:600;color:var(--white);letter-spacing:1px;text-transform:uppercase}
.marquee-dot{width:4px;height:4px;border-radius:50%;background:rgba(255,255,255,.4);flex-shrink:0}

/* ════════════════════════════════════════
   ANIMATIONS
   ════════════════════════════════════════ */
.fu{opacity:1;transform:translateY(0);transition:opacity .6s ease,transform .6s ease}.js-anim .fu{opacity:0;transform:translateY(20px)}.js-anim .fu.in{opacity:1;transform:translateY(0)}

/* ════════════════════════════════════════
   RESPONSIVE
   ════════════════════════════════════════ */
@media(max-width:960px){
  .nav-mid{display:none}.burger{display:block}
  .treat-grid{grid-template-columns:1fr 1fr}
  .treat-card{max-width:none}
  .how-steps{grid-template-columns:1fr;gap:28px}
  .stats-grid{grid-template-columns:1fr 1fr}
  .res-split{grid-template-columns:1fr !important}
  .why-grid{grid-template-columns:1fr 1fr !important}
}
@media(max-width:600px){
  /* ══ MOBILE HERO — one tight centered block filling the fold ══ */
  .hero{min-height:100svh;min-height:100dvh;padding:0 !important;display:flex;flex-direction:column}
  .hero>div:first-child{
    min-height:100svh;min-height:100dvh;
    display:flex;flex-direction:column;
    align-items:center;justify-content:center;
    text-align:center;
    padding:56px 24px 32px !important;
    gap:0;
  }
  .hero-pill{font-size:9px !important;padding:6px 14px !important;margin-bottom:20px !important}
  .hero h1{font-size:13vw !important;letter-spacing:-3px !important;margin-bottom:8px !important;line-height:0.94 !important;max-width:100% !important}
  .fu[style*="Every body"]{margin-bottom:20px !important;margin-top:4px !important}
  .hero-sub{font-size:15px !important;max-width:300px !important;margin:0 auto 28px !important;line-height:1.5 !important}
  .hero-cta-row{flex-direction:column;width:100%;margin-bottom:0 !important;gap:12px !important}
  .cta-main{width:100%;padding:18px 28px;font-size:16px;border-radius:14px}
  .cta-sub{font-size:13px}
  .hero-trust-bottom{display:flex !important;flex-wrap:wrap;justify-content:center;gap:12px;margin-top:24px !important;font-size:11px !important}
  .hero-trust-bottom span{color:var(--slate) !important;font-weight:500 !important;font-size:11px !important}
  
  /* Image starts after the fold */
  .hero>div:last-child{overflow:visible;flex-shrink:0}
  .hero-img-wrap{margin-top:0 !important}

  /* Hide stat overlay cards on mobile */
  .hero-ov{display:none !important}
  .hov-lost{display:none !important}
  /* Show badges ON TOP of people (high up, not at bottom) */
  .hero-badges-row{display:flex !important;bottom:auto !important;top:clamp(10px,3vw,20px) !important}
  .hero-badges-row .hero-ov{display:flex !important;padding:5px 10px !important;border-radius:100px !important;font-size:8px}

  /* SECTIONS — tighter */
  .section-title{font-size:20px;letter-spacing:-.5px}
  .section-label{font-size:8px;letter-spacing:2px}
  .section-desc{font-size:11px}

  /* TREATMENTS */
  .treat-grid{grid-template-columns:1fr 1fr;gap:8px}
  .treat-card{padding:14px 10px;border-radius:12px}
  .treat-pct{width:36px;height:36px;font-size:13px;margin-bottom:6px}
  .treat-card h3{font-size:13px}
  .treat-label{font-size:8px;margin-bottom:4px}
  .treat-card p{font-size:9px;margin-bottom:8px;line-height:1.4}
  .treat-btn{padding:8px;font-size:10px}
  .treat-badge{font-size:7px;padding:2px 8px;top:-7px}

  /* HOW IT WORKS */
  .how-num{width:36px;height:36px;font-size:14px}
  .how-step h3{font-size:14px}
  .how-step p{font-size:11px}

  /* PHOTO CAROUSEL */
  .photo-card{border-radius:12px}
  .pc-lg{flex:0 0 160px}
  .pc-md{flex:0 0 130px}
  .pc-sm{flex:0 0 110px}
  .photo-name{font-size:10px}
  .photo-stat{font-size:8px}
  .photo-info{padding:8px 10px}
  .po-tag{font-size:9px;padding:3px 7px}
  .photo-overlay{top:8px;left:8px}

  /* STATS */
  .stats-grid{grid-template-columns:1fr 1fr;gap:8px}
  .stat h3{font-size:24px;letter-spacing:-.5px}
  .stat p{font-size:9px}

  /* REVIEWS */
  .review-card{flex:0 0 240px;padding:18px;border-radius:14px}
  .review-text{font-size:12px;margin-bottom:12px;line-height:1.6}
  .review-stars{font-size:12px;margin-bottom:8px}
  .review-name{font-size:10px}
  .review-result{font-size:9px}
  .review-av{width:28px;height:28px;font-size:11px}

  /* FAQ */
  .faq-q{font-size:12px;padding:12px 14px}
  .faq-a{font-size:11px}
  .faq-plus{width:20px;height:20px;font-size:12px}

  /* FINAL CTA */
  .final-cta{padding:36px 16px}
  .final-cta h2{font-size:24px;letter-spacing:-.8px}
  .final-cta p{font-size:12px;margin-bottom:18px}
  .cta-white{padding:12px 28px;font-size:13px}

  /* WHY US — smaller on mobile */
  .why-grid{grid-template-columns:1fr 1fr !important;gap:6px !important}
  .why-grid > div{padding:16px 12px !important;border-radius:12px !important}
  .why-grid h4{font-size:12px !important}
  .why-grid p{font-size:9px !important}
  .why-grid svg{width:18px !important;height:18px !important}

  /* SCREENER MODAL — fit mobile */
  .qm{max-width:100% !important;border-radius:20px !important;padding:20px 16px !important;max-height:85vh !important}
  .qq{font-size:18px !important;margin-bottom:14px !important}
  .qo{padding:10px 12px !important;font-size:12px !important}
  .qring{width:60px !important;height:60px !important;font-size:24px !important}

  /* FOOTER */
  .ft-top{flex-direction:column;gap:20px}
  .nav-login{display:none}
  .nav-btn{padding:7px 14px;font-size:11px}
}
</style>
<?php wp_head(); ?>
</head>
<body>

<!-- NAV -->
<?php include(get_template_directory() . '/header.php'); ?>

<!-- HERO -->
<section class="hero" style="padding:0;background:linear-gradient(180deg,#fff 0%,#f0f9ff 50%,#fff 100%);min-height:auto;overflow:visible">
  <div style="max-width:1100px;margin:0 auto;text-align:center;padding:clamp(70px,10vw,100px) clamp(16px,4vw,56px) 0">

    <div class="fu hero-pill" style="display:inline-flex;align-items:center;gap:8px;background:var(--sky-wash);border:1px solid var(--sky-pale);padding:6px 16px;border-radius:100px;margin-bottom:clamp(16px,2vw,24px)">
      <span style="font-size:clamp(10px,1vw,12px);font-weight:600;color:var(--ink);letter-spacing:.3px">CQC Registered &middot; MHRA Approved &middot; UK Clinicians</span>
    </div>

    <h1 class="fu" style="font-family:var(--display);font-size:clamp(40px,8vw,84px);font-weight:700;line-height:1.05;letter-spacing:clamp(-1.5px,-0.04em,-3px);color:var(--ink);margin-bottom:clamp(12px,2vw,20px);max-width:800px;margin-left:auto;margin-right:auto">Stop waiting.<br>Start <span class="highlight" id="losingText">losing.</span></h1>

    <div class="fu" style="margin-bottom:clamp(12px,2vw,18px)"><span style="font-size:clamp(10px,1vw,13px);font-weight:700;color:var(--sky-deep);letter-spacing:clamp(3px,0.5vw,7px);text-transform:uppercase">Every body welcome</span></div>

    <p class="hero-sub fu" style="font-size:clamp(16px,1.5vw,20px);color:var(--ink);max-width:500px;line-height:1.6;margin:0 auto clamp(24px,3vw,36px);font-weight:600">Clinician-prescribed weight loss medication, delivered to your door. Check if you qualify in 30 seconds.</p>

    <div class="hero-cta-row fu" style="justify-content:center;margin-bottom:0;gap:16px">
      <button class="cta-main" onclick="openQ()">Am I eligible? &rarr;</button>
      <a href="<?php echo home_url('/treatments/#treatments'); ?>" class="cta-sub">View available treatments</a>
    </div>

    <div class="fu hero-trust-bottom" style="font-size:12px;color:var(--slate);font-weight:500;margin-top:16px;display:flex;align-items:center;justify-content:center;gap:8px;flex-wrap:wrap">
      <span>4.8★ Google</span>
      <span style="color:var(--stone)">&middot;</span>
      <span>Trusted by thousands</span>
      <span style="color:var(--stone)">&middot;</span>
      <span>Free delivery</span>
    </div>
  </div>

  <!-- BIG HERO IMAGE — edge-to-edge within container -->
  <div class="hero-img-wrap" style="max-width:1100px;margin:clamp(24px,4vw,48px) auto 0;position:relative;padding:0 clamp(0px,2vw,24px)">
    <div style="border-radius:clamp(16px,2vw,28px) clamp(16px,2vw,28px) 0 0;overflow:hidden;position:relative">
      <?php $img = get_template_directory_uri() . '/img/'; ?>
      <img src="<?php echo esc_url($img . 'hero-group.png'); ?>" alt="Confident Don't Weight members celebrating together" 
           style="width:100%;height:auto;display:block;max-height:560px;object-fit:cover;object-position:center 30%;transform:scale(1.08);transform-origin:center 30%"
           loading="eager"
           fetchpriority="high">
      
      <!-- OVERLAYS -->
      <!-- Top-left: Satisfaction + goals + happiness -->
      <div class="hero-ov" style="left:clamp(10px,2.5vw,28px);top:clamp(10px,2.5vw,24px)">
        <div class="hov-label">Member Satisfaction</div>
        <div class="hov-big">98<span>/100</span></div>
        <div class="hov-divider"></div>
        <div style="font-size:8px;color:rgba(255,255,255,.4);font-weight:500">Goals Achieved</div>
        <div class="hov-big hov-big-accent" style="font-size:20px">87<span>%</span></div>
        <div class="hov-divider"></div>
        <div style="font-size:8px;color:rgba(255,255,255,.4);font-weight:500">Happiness Increase</div>
        <div class="hov-big" style="font-size:20px;color:#22C55E">+64<span>%</span></div>
      </div>

      <!-- Top-right: Chart with axis numbers -->
      <div class="hero-ov" style="right:clamp(10px,2.5vw,28px);top:clamp(10px,2.5vw,24px);min-width:clamp(100px,14vw,150px);max-width:180px">
        <div class="hov-label">Weight Loss Journey</div>
        <svg viewBox="0 0 160 65" style="width:100%;margin:6px 0" xmlns="http://www.w3.org/2000/svg">
          <line x1="25" y1="8" x2="155" y2="8" stroke="rgba(255,255,255,.04)" stroke-width=".5"/>
          <line x1="25" y1="22" x2="155" y2="22" stroke="rgba(255,255,255,.04)" stroke-width=".5"/>
          <line x1="25" y1="36" x2="155" y2="36" stroke="rgba(255,255,255,.04)" stroke-width=".5"/>
          <text x="22" y="11" font-size="5" fill="rgba(255,255,255,.25)" text-anchor="end" font-family="sans-serif">100kg</text>
          <text x="22" y="25" font-size="5" fill="rgba(255,255,255,.25)" text-anchor="end" font-family="sans-serif">90kg</text>
          <text x="22" y="39" font-size="5" fill="rgba(255,255,255,.25)" text-anchor="end" font-family="sans-serif">80kg</text>
          <path d="M30,10 C50,12 70,18 90,26 C110,34 130,40 150,44 L150,50 L30,50 Z" fill="rgba(56,189,248,.08)"/>
          <path d="M30,10 C50,12 70,18 90,26 C110,34 130,40 150,44" fill="none" stroke="var(--sky)" stroke-width="2" stroke-linecap="round"/>
          <circle cx="30" cy="10" r="2" fill="var(--sky)" opacity=".4"/>
          <circle cx="70" cy="18" r="2" fill="var(--sky)" opacity=".5"/>
          <circle cx="110" cy="34" r="2.5" fill="var(--sky)" opacity=".7"/>
          <circle cx="150" cy="44" r="3.5" fill="var(--sky)" stroke="rgba(255,255,255,.3)" stroke-width="1"/>
          <text x="30" y="58" font-size="5" fill="rgba(255,255,255,.25)" text-anchor="middle" font-family="sans-serif">Wk1</text>
          <text x="70" y="58" font-size="5" fill="rgba(255,255,255,.25)" text-anchor="middle" font-family="sans-serif">Mo1</text>
          <text x="110" y="58" font-size="5" fill="rgba(255,255,255,.25)" text-anchor="middle" font-family="sans-serif">Mo3</text>
          <text x="150" y="58" font-size="5" fill="var(--sky)" text-anchor="middle" font-family="sans-serif" font-weight="700">Mo6</text>
          <rect x="131" y="35" width="26" height="10" rx="3" fill="var(--sky)" opacity=".8"/>
          <text x="144" y="42.5" font-size="5.5" fill="white" text-anchor="middle" font-family="sans-serif" font-weight="700">-23%</text>
        </svg>
        <div style="display:flex;justify-content:space-between;align-items:flex-end">
          <div>
            <div style="font-size:7px;color:rgba(255,255,255,.35)">Avg. lost at 6 months</div>
            <div style="font-family:var(--display);font-size:18px;font-weight:700;color:var(--white);line-height:1;letter-spacing:-.5px">25<span style="font-size:9px;font-weight:400;color:rgba(255,255,255,.35)">kgs</span></div>
          </div>
          <div style="height:10px;width:44px;background:rgba(255,255,255,.08);border-radius:100px;overflow:hidden"><div style="height:100%;width:82%;background:var(--sky);border-radius:100px"></div></div>
        </div>
      </div>

      <!-- Centre floating: Lost 30 -->
      <div class="hov-lost" style="left:clamp(80px,15vw,200px);top:45%">
        <div class="hov-lost-label">Lost</div>
        <div class="hov-lost-num">30</div>
        <div class="hov-lost-unit">kgs</div>
      </div>

      <!-- Right floating: Lost 22 -->
      <div class="hov-lost" style="right:clamp(10px,4vw,50px);top:38%">
        <div class="hov-lost-label">Lost</div>
        <div class="hov-lost-num" style="font-size:clamp(24px,3.5vw,38px)">22</div>
        <div class="hov-lost-unit">kgs</div>
      </div>

      <!-- Bottom badges — centred together -->
      <div class="hero-badges-row" style="position:absolute;z-index:2;bottom:clamp(60px,14vw,120px);left:50%;transform:translateX(-50%);display:flex;gap:12px">
        <!-- Google 4.8 with drawn stars -->
        <div class="hero-ov" style="position:relative;padding:6px 14px;border-radius:100px;display:flex;align-items:center;gap:6px">
          <svg width="14" height="14" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.27-4.74 3.27-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
          <span style="font-size:12px;font-weight:700;color:var(--white)">4.8</span>
          <svg width="64" height="12" viewBox="0 0 64 12" xmlns="http://www.w3.org/2000/svg"><polygon points="6,0 7.9,3.8 12,4.4 9,7.3 9.7,11.4 6,9.5 2.3,11.4 3,7.3 0,4.4 4.1,3.8" fill="#FBBC05"/><polygon points="19,0 20.9,3.8 25,4.4 22,7.3 22.7,11.4 19,9.5 15.3,11.4 16,7.3 13,4.4 17.1,3.8" fill="#FBBC05"/><polygon points="32,0 33.9,3.8 38,4.4 35,7.3 35.7,11.4 32,9.5 28.3,11.4 29,7.3 26,4.4 30.1,3.8" fill="#FBBC05"/><polygon points="45,0 46.9,3.8 51,4.4 48,7.3 48.7,11.4 45,9.5 41.3,11.4 42,7.3 39,4.4 43.1,3.8" fill="#FBBC05"/><polygon points="58,0 59.9,3.8 64,4.4 61,7.3 61.7,11.4 58,9.5 54.3,11.4 55,7.3 52,4.4 56.1,3.8" fill="#FBBC05"/></svg>
          <span style="font-size:9px;font-weight:500;color:rgba(255,255,255,.4)">Google</span>
        </div>
        <!-- CQC badge -->
        <div class="hero-ov" style="position:relative;padding:6px 14px;border-radius:100px;display:flex;align-items:center;gap:5px">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke="var(--sky)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          <span style="font-size:10px;font-weight:700;color:var(--white);letter-spacing:.5px">CQC Registered</span>
        </div>
      </div>

      <!-- Bottom gradient into marquee -->
      <div style="position:absolute;bottom:0;left:0;right:0;height:clamp(60px,12vw,120px);background:linear-gradient(0deg,var(--sky) 0%,transparent 100%)"></div>
    </div>
  </div>
</section>

<!-- BRAND MARQUEE -->
<div style="background:var(--sky);padding:14px 0;overflow:hidden;position:relative">
  <div style="display:flex;gap:0;width:max-content;animation:marquee 25s linear infinite">
    <span style="font-size:11px;font-weight:700;color:var(--white);letter-spacing:3px;text-transform:uppercase;white-space:nowrap;padding:0 32px">The UK's Premier Clinician-Led Weight Loss Clinic</span>
    <span style="font-size:11px;color:rgba(255,255,255,.4);padding:0 4px">&middot;</span>
    <span style="font-size:11px;font-weight:700;color:var(--white);letter-spacing:3px;text-transform:uppercase;white-space:nowrap;padding:0 32px">CQC Registered</span>
    <span style="font-size:11px;color:rgba(255,255,255,.4);padding:0 4px">&middot;</span>
    <span style="font-size:11px;font-weight:700;color:var(--white);letter-spacing:3px;text-transform:uppercase;white-space:nowrap;padding:0 32px">Free Next Day Delivery On Your First Order</span>
    <span style="font-size:11px;color:rgba(255,255,255,.4);padding:0 4px">&middot;</span>
    <!-- duplicate for seamless loop -->
    <span style="font-size:11px;font-weight:700;color:var(--white);letter-spacing:3px;text-transform:uppercase;white-space:nowrap;padding:0 32px">The UK's Premier Clinician-Led Weight Loss Clinic</span>
    <span style="font-size:11px;color:rgba(255,255,255,.4);padding:0 4px">&middot;</span>
    <span style="font-size:11px;font-weight:700;color:var(--white);letter-spacing:3px;text-transform:uppercase;white-space:nowrap;padding:0 32px">CQC Registered</span>
    <span style="font-size:11px;color:rgba(255,255,255,.4);padding:0 4px">&middot;</span>
    <span style="font-size:11px;font-weight:700;color:var(--white);letter-spacing:3px;text-transform:uppercase;white-space:nowrap;padding:0 32px">Free Next Day Delivery On Your First Order</span>
    <span style="font-size:11px;color:rgba(255,255,255,.4);padding:0 4px">&middot;</span>
  </div>
</div>
<style>@keyframes marquee{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}</style>

<!-- WEIGHT LOSS CALCULATOR -->
<section id="calculator" style="padding:clamp(40px,5vw,64px) 0;background:var(--cream)">
  <div style="padding:0 clamp(20px,4vw,56px)">
    <div class="section-head" style="margin-bottom:40px;text-align:center">
      <div class="section-label fu">See Your Potential</div>
      <h2 class="section-title fu" style="max-width:600px;margin:0 auto 8px">What could you <em>lose?</em></h2>
    </div>

    <div class="fu" style="max-width:640px;margin:0 auto">
      <div style="background:var(--white);border:1px solid var(--stone);border-radius:24px;padding:clamp(24px,3.5vw,36px);position:relative">

        <!-- Unit toggle -->
        <div style="display:flex;gap:4px;margin-bottom:20px;background:var(--warm);border-radius:100px;padding:3px;width:fit-content">
          <button class="calc-unit active" id="cuKg" onclick="setCalcUnit('kg')" type="button">kg</button>
          <button class="calc-unit" id="cuSt" onclick="setCalcUnit('st')" type="button">stone</button>
        </div>

        <!-- Current weight display -->
        <div style="text-align:center;margin-bottom:14px">
          <span id="calcWeight" style="font-family:var(--display);font-size:clamp(36px,8vw,48px);font-weight:700;color:var(--ink);letter-spacing:-2px;line-height:1">130</span>
          <span id="calcUnit" style="font-size:clamp(14px,3vw,16px);color:var(--slate);font-weight:400;margin-left:3px">kg</span>
        </div>

        <!-- Slider -->
        <div style="position:relative;margin-bottom:28px;padding:12px 0">
          <input type="range" id="calcSlider" min="60" max="200" value="130" step="1"
            style="width:100%;appearance:none;-webkit-appearance:none;height:12px;border-radius:100px;background:linear-gradient(to right,var(--sky) 0%,var(--sky) 55%,var(--stone) 55%);outline:none;cursor:pointer;position:relative;z-index:2"
            oninput="updateCalc();moveHandle()">
          
          </div>
          <div style="display:flex;justify-content:space-between;margin-top:14px;font-size:10px;color:var(--slate)">
            <span id="calcMin">60 kg</span>
            <span id="calcMax">200 kg</span>
          </div>
          <div style="text-align:center;margin-top:6px">
            <span class="slide-hint" style="font-size:10px;color:var(--sky-deep);font-weight:600;animation:nudge 1.8s ease-in-out infinite">&#8592; Slide to explore &#8594;</span>
          </div>
        </div>
        <style>
        @keyframes nudge{0%,100%{opacity:.5;transform:scale(1)}50%{opacity:1;transform:scale(1.05)}}
        @keyframes handlePulse{0%,100%{box-shadow:0 0 0 8px rgba(56,189,248,.2),0 4px 14px rgba(0,0,0,.15)}50%{box-shadow:0 0 0 14px rgba(56,189,248,.35),0 4px 14px rgba(0,0,0,.15)}}
        </style>

        <!-- Results -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:16px">
          <div style="background:var(--sky-wash);border:1px solid rgba(14,165,233,.12);border-radius:12px;padding:14px 12px;text-align:center;position:relative">
            <div style="position:absolute;top:-8px;left:50%;transform:translateX(-50%);background:var(--coral);color:#fff;padding:2px 10px;border-radius:100px;font-size:8px;font-weight:700;letter-spacing:.5px">RECOMMENDED</div>
            <div style="font-size:11px;color:var(--sky-dark);font-weight:600;margin-bottom:6px">Mounjaro</div>
            <div id="calcMounjaro" style="font-family:var(--display);font-size:clamp(22px,4vw,28px);font-weight:700;color:var(--ink);letter-spacing:-1px;line-height:1;margin-bottom:4px">-20.7 kg</div>
            <div id="calcMounjaroTarget" style="font-size:clamp(11px,2vw,13px);font-weight:600;color:var(--sky-dark)">→ 69.3 kg</div>
          </div>
          <div style="background:var(--cream);border:1px solid var(--stone);border-radius:12px;padding:14px 12px;text-align:center">
            <div style="font-size:11px;color:var(--sky-dark);font-weight:600;margin-bottom:6px;margin-top:4px">Wegovy</div>
            <div id="calcWegovy" style="font-family:var(--display);font-size:clamp(22px,4vw,28px);font-weight:700;color:var(--ink);letter-spacing:-1px;line-height:1;margin-bottom:4px">-13.5 kg</div>
            <div id="calcWegovyTarget" style="font-size:clamp(11px,2vw,13px);font-weight:600;color:var(--sky-dark)">→ 76.5 kg</div>
          </div>
        </div>

        <button onclick="openQ()" style="width:100%;background:var(--sky);color:#fff;border:none;border-radius:100px;padding:14px;font-family:var(--body);font-size:14px;font-weight:600;cursor:pointer;transition:background .2s;box-shadow:0 4px 16px rgba(56,189,248,.2)">Check your eligibility &rarr;</button>

        <p style="text-align:center;font-size:10px;color:var(--slate);margin-top:10px;line-height:1.4">Results based on clinical trial averages. Individual results vary.</p>
      </div>
    </div>
  </div>
</section>

<!-- MEMBER PHOTOS — bold & branded -->
<section style="padding:clamp(40px,5vw,64px) 0;background:linear-gradient(160deg,#0EA5E9 0%,#38BDF8 40%,#7DD3FC 100%);overflow:hidden;position:relative">
  <div style="padding:0 clamp(20px,4vw,56px);margin-bottom:28px;position:relative;z-index:1">
    <div class="section-head" style="margin-bottom:0">
      <div class="fu" style="font-size:10px;letter-spacing:2.5px;text-transform:uppercase;color:rgba(255,255,255,.7);font-weight:700;margin-bottom:8px">Every Body Welcome</div>
      <h2 class="fu" style="font-family:var(--display);font-size:clamp(24px,3vw,36px);font-weight:700;color:var(--white);letter-spacing:-.8px;margin-bottom:6px">They didn&rsquo;t <i style="font-style:italic;font-weight:400">weight.</i></h2>
      <p class="fu" style="color:rgba(255,255,255,.8);font-size:14px">Neither should you.</p>
    </div>
  </div>
  <div class="photo-track-wrap" style="position:relative;z-index:1">
    
  <div class="photo-track" id="photoCarousel">
    <?php
    $members = dontweight_get_members();
    $sizes = array('pc-lg','pc-sm','pc-md','pc-lg','pc-sm','pc-md','pc-lg','pc-sm');
    if (!empty($members)):
      // 3 identical passes for seamless JS-based infinite scroll
      for ($pass = 0; $pass < 3; $pass++):
        foreach ($members as $i => $m):
          $sz = $sizes[$i % count($sizes)];
    ?>
    <div class="photo-card <?php echo $sz; ?>"><div class="photo-img"><img src="<?php echo esc_url($m['image']); ?>" alt="<?php echo esc_attr($m['name']); ?>" loading="lazy"></div><div class="photo-overlay"><span class="po-tag"><?php echo esc_html($m['lost']); ?></span></div><div class="photo-info"><span class="photo-name"><?php echo esc_html($m['name']); ?></span><span class="photo-stat"><?php echo esc_html($m['location']); ?></span></div></div>
    <?php endforeach; endfor;
    endif; ?>
  </div>
  </div>
</section>

<!-- TREATMENTS -->
<section class="treatments" id="treatments">
  <div class="section-head">
    <div class="section-label fu">Available Treatments</div>
    <h2 class="section-title fu">Clinically-proven <em>medications</em></h2>
    <p class="section-desc fu">Your clinician will recommend the best option for your body, goals, and health profile.</p>
    <p style="font-size:12px;color:var(--slate);margin-top:8px;display:inline-flex;align-items:center;gap:6px;background:rgba(56,189,248,.08);border:1px solid rgba(56,189,248,.15);padding:6px 14px;border-radius:20px"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--sky)"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>Transparent pricing — no hidden fees, dose & price adjusted by your clinician</p>
  </div>

  <div class="treat-grid" style="max-width:520px">
    <div class="treat-card featured fu">
      <div class="treat-badge">Recommended</div>
      <div class="treat-pct">23%</div>
      <h3>Mounjaro</h3>
      <div class="treat-label">Most effective</div>
      <p>Tirzepatide, dual GIP/GLP-1. Up to 23% weight loss in clinical trials.</p>
      <div style="font-family:var(--display);font-size:clamp(28px,4vw,36px);font-weight:700;color:var(--ink);margin-bottom:2px;letter-spacing:-1px;margin-top:auto"><span style="font-size:12px;font-weight:500;color:var(--slate);letter-spacing:0">from </span>&pound;4.99<span style="font-size:13px;font-weight:500;color:var(--slate)">/day</span></div>
      <div style="font-size:11px;color:var(--slate);margin-bottom:6px">2.5mg starter &middot; &pound;150/mo &middot; dose &amp; price adjusted by your clinician</div>
      <a href="<?php echo home_url('/treatments/#treatments'); ?>" class="treat-btn">Learn more &rarr;</a>
      <p style="font-size:10px;color:var(--slate);text-align:center;margin-top:8px">&#10003; Refundable if not eligible &nbsp;&middot;&nbsp; &#10003; No commitment</p>
    </div>
    <div class="treat-card fu">
      <div class="treat-pct">15%</div>
      <h3>Wegovy</h3>
      <div class="treat-label">Proven &amp; trusted</div>
      <p>Semaglutide (Ozempic), GLP-1. Up to 15% weight loss in clinical trials.</p>
      <div style="font-family:var(--display);font-size:clamp(28px,4vw,36px);font-weight:700;color:var(--ink);margin-bottom:2px;letter-spacing:-1px;margin-top:auto"><span style="font-size:12px;font-weight:500;color:var(--slate);letter-spacing:0">from </span>&pound;3.80<span style="font-size:13px;font-weight:500;color:var(--slate)">/day</span></div>
      <div style="font-size:11px;color:var(--slate);margin-bottom:6px">0.25mg starter &middot; &pound;114/mo &middot; dose &amp; price adjusted by your clinician</div>
      <a href="<?php echo home_url('/treatments/#treatments'); ?>" class="treat-btn">Learn more &rarr;</a>
      <p style="font-size:10px;color:var(--slate);text-align:center;margin-top:8px">&#10003; Refundable if not eligible &nbsp;&middot;&nbsp; &#10003; No commitment</p>
    </div>
  </div>
</section>

<!-- HEALTH CHECK PROMO — conversion-focused -->
<section style="padding:clamp(40px,5vw,64px) clamp(20px,4vw,56px);background:var(--cream)">
  <div class="fu" style="max-width:900px;margin:0 auto">

    <!-- Top bar — urgency strip -->
    <div style="background:var(--sky);border-radius:16px 16px 0 0;padding:10px 24px;display:flex;align-items:center;justify-content:center;gap:8px">
      <span style="width:6px;height:6px;border-radius:50%;background:#22C55E;display:inline-block;animation:pulse-dot 2s infinite"></span>
      <span style="font-size:11px;font-weight:700;color:var(--white);letter-spacing:1px;text-transform:uppercase">Recommended for Your Weight Loss Programme</span>
    </div>

    <!-- Main card -->
    <div style="background:var(--white);border:1px solid var(--stone);border-top:none;border-radius:0 0 16px 16px;overflow:hidden">
      
      <!-- Two-column layout -->
      <div style="display:grid;grid-template-columns:1fr 1fr;min-height:360px" class="hc-promo-grid">
        
        <!-- Left — the offer -->
        <div style="padding:clamp(24px,3.5vw,40px);display:flex;flex-direction:column;justify-content:center">
          <div style="display:inline-flex;align-items:center;gap:6px;margin-bottom:16px">
            <span style="background:var(--sky-pale);color:var(--sky-dark);padding:4px 12px;border-radius:100px;font-size:9px;font-weight:700;letter-spacing:1px;text-transform:uppercase">UK First</span>
            <span style="background:var(--warm);color:var(--slate);padding:4px 12px;border-radius:100px;font-size:9px;font-weight:700;letter-spacing:1px;text-transform:uppercase">Exclusive</span>
          </div>
          
          <h2 style="font-family:var(--display);font-size:clamp(22px,2.5vw,28px);font-weight:700;color:var(--ink);letter-spacing:-.5px;line-height:1.15;margin-bottom:12px">The Weight Loss<br><span style="color:var(--sky-deep)">Health Check</span></h2>
          
          <p style="font-size:clamp(12px,1.1vw,14px);color:var(--slate);line-height:1.7;margin-bottom:20px">The UK's first health screening built for patients on GLP-1 medication. Know what's happening inside &mdash; not just on the scale.</p>
          
          <!-- What's included -->
          <div style="margin-bottom:20px">
            <div style="font-size:9px;font-weight:700;color:var(--slate);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:8px">Standard includes</div>
            <div style="display:flex;flex-direction:column;gap:6px;margin-bottom:12px">
              <div style="display:flex;align-items:center;gap:8px"><div style="width:18px;height:18px;border-radius:5px;background:var(--sky-pale);display:flex;align-items:center;justify-content:center;flex-shrink:0"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="var(--sky-deep)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></div><span style="font-size:12px;color:var(--ink)">Full blood panel &mdash; liver, glycaemic, lipids, systemic</span></div>
              <div style="display:flex;align-items:center;gap:8px"><div style="width:18px;height:18px;border-radius:5px;background:var(--sky-pale);display:flex;align-items:center;justify-content:center;flex-shrink:0"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="var(--sky-deep)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></div><span style="font-size:12px;color:var(--ink)">Liver + gallbladder ultrasound (360 and Premium)</span></div>
              <div style="display:flex;align-items:center;gap:8px"><div style="width:18px;height:18px;border-radius:5px;background:var(--sky-pale);display:flex;align-items:center;justify-content:center;flex-shrink:0"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="var(--sky-deep)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></div><span style="font-size:12px;color:var(--ink)">Initial pharmacist consultation + Doctor final review</span></div>
            </div>
            <div style="background:var(--sky-wash);border:1px solid rgba(56,189,248,.2);border-radius:10px;padding:10px 12px">
              <div style="font-size:9px;font-weight:700;color:var(--sky-dark);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:6px">Premium also adds</div>
              <div style="display:flex;flex-direction:column;gap:5px">
                <div style="display:flex;align-items:center;gap:8px"><div style="width:16px;height:16px;border-radius:4px;background:var(--sky);display:flex;align-items:center;justify-content:center;flex-shrink:0"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></div><span style="font-size:11px;color:var(--sky-dark);font-weight:500">Echocardiogram &mdash; detailed ultrasound of the heart</span></div>
                <div style="display:flex;align-items:center;gap:8px"><div style="width:16px;height:16px;border-radius:4px;background:var(--sky);display:flex;align-items:center;justify-content:center;flex-shrink:0"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></div><span style="font-size:11px;color:var(--sky-dark);font-weight:500">Cardiologist appointment</span></div>
              </div>
            </div>
          </div>

          <!-- PRICING TIERS -->
          <div style="margin-bottom:16px">
            <div style="font-size:9px;color:var(--slate);font-weight:600;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:8px">Choose your package &middot; + medication cost</div>
            <div style="display:flex;gap:8px;flex-wrap:wrap">
              <div style="flex:1;min-width:95px;background:var(--cream);border:1.5px solid var(--stone);border-radius:12px;padding:12px 10px;text-align:center">
                <div style="font-family:var(--display);font-size:20px;font-weight:700;color:var(--ink);line-height:1;margin-bottom:2px">&pound;279</div>
                <div style="font-size:10px;color:var(--sky-dark);font-weight:700;margin-bottom:4px">Baseline</div>
                <div style="font-size:9px;color:var(--slate);line-height:1.4">Bloods + two clinician reviews</div>
              </div>
              <div style="flex:1;min-width:95px;background:var(--sky-wash);border:2px solid var(--sky);border-radius:12px;padding:12px 10px;text-align:center;position:relative">
                <div style="position:absolute;top:-8px;left:50%;transform:translateX(-50%);background:var(--sky);color:#fff;padding:2px 10px;border-radius:100px;font-size:8px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;white-space:nowrap">Recommended</div>
                <div style="font-family:var(--display);font-size:20px;font-weight:700;color:var(--ink);line-height:1;margin-bottom:2px">&pound;699</div>
                <div style="font-size:10px;color:var(--sky-dark);font-weight:700;margin-bottom:4px">360</div>
                <div style="font-size:9px;color:var(--slate);line-height:1.4">+ Liver &amp; gallbladder ultrasound</div>
              </div>
              <div style="flex:1;min-width:95px;background:var(--ink);border:1.5px solid var(--ink);border-radius:12px;padding:12px 10px;text-align:center">
                <div style="font-family:var(--display);font-size:20px;font-weight:700;color:#fff;line-height:1;margin-bottom:2px">&pound;979</div>
                <div style="font-size:10px;color:var(--sky);font-weight:700;margin-bottom:4px">Premium</div>
                <div style="font-size:9px;color:rgba(255,255,255,.65);line-height:1.4">+ Echocardiogram + Cardiologist</div>
              </div>
            </div>
          </div>
          
          <!-- CTA -->
          <a href="/health-checks/" style="display:block;width:100%;background:var(--sky);color:var(--white);border-radius:100px;padding:14px;font-family:var(--body);font-size:14px;font-weight:700;text-decoration:none;text-align:center;transition:all .2s;box-shadow:0 4px 16px rgba(56,189,248,.2)">Book your health check &rarr;</a>
        </div>
        
        <!-- Right — visual stats panel (dark) -->
        <div style="background:linear-gradient(160deg,var(--ink) 0%,var(--charcoal) 100%);padding:clamp(24px,3.5vw,40px);display:flex;flex-direction:column;justify-content:center;position:relative;overflow:hidden">
          <div style="position:absolute;top:-30px;right:-30px;width:140px;height:140px;border-radius:50%;background:rgba(56,189,248,.06)"></div>
          <div style="position:absolute;bottom:-40px;left:-20px;width:100px;height:100px;border-radius:50%;background:rgba(56,189,248,.04)"></div>
          
          <div style="position:relative;z-index:1">
            <div style="font-size:9px;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,.45);font-weight:700;margin-bottom:20px">What We Check</div>
            
            <!-- Organ icons row -->
            <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:20px">
              <div style="background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.08);border-radius:10px;padding:8px 10px;text-align:center;flex:1;min-width:56px">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M4 9C4 6 6.5 4 10 4c1.5 0 2.5.5 2.5.5S13 4 14.5 4C18 4 20 6 20 9c0 4-2.5 8-8 10C6.5 17 4 13 4 9z" fill="white" opacity=".8"/></svg>
                <div style="font-size:8px;color:rgba(255,255,255,.5);font-weight:500;margin-top:3px">Liver</div>
              </div>
              <div style="background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.08);border-radius:10px;padding:8px 10px;text-align:center;flex:1;min-width:56px">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 2L8 8.5C6.5 11 6 12.5 6 14a6 6 0 0012 0c0-1.5-.5-3-2-5.5L12 2z" fill="white" opacity=".8"/></svg>
                <div style="font-size:8px;color:rgba(255,255,255,.5);font-weight:500;margin-top:3px">Gallbladder</div>
              </div>
              <div style="background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.08);border-radius:10px;padding:8px 10px;text-align:center;flex:1;min-width:56px">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><ellipse cx="7" cy="12" rx="5" ry="3.5" fill="white" opacity=".8"/><ellipse cx="17" cy="12" rx="5" ry="3.5" fill="white" opacity=".8"/><rect x="11" y="8" width="2" height="8" rx="1" fill="white" opacity=".5"/></svg>
                <div style="font-size:8px;color:rgba(255,255,255,.5);font-weight:500;margin-top:3px">Thyroid</div>
              </div>
              <div style="background:rgba(56,189,248,.12);border:1px solid rgba(56,189,248,.25);border-radius:10px;padding:8px 10px;text-align:center;flex:1;min-width:56px">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 19C12 19 4 13 4 8.5a4.5 4.5 0 019-1 4.5 4.5 0 019 1C22 13 14 19 12 19z" fill="white" opacity=".9"/><polyline points="4,12 7,12 9,9.5 11,14.5 13,10.5 15,12 18,12" stroke="rgba(56,189,248,.8)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg>
                <div style="font-size:8px;color:var(--sky);font-weight:600;margin-top:3px">ECG</div>
              </div>
            </div>
            
            <!-- Key numbers -->
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:20px">
              <div style="background:rgba(56,189,248,.08);border:1px solid rgba(56,189,248,.15);border-radius:12px;padding:14px;text-align:center">
                <div style="font-family:var(--display);font-size:28px;font-weight:700;color:var(--sky);line-height:1">4+</div>
                <div style="font-size:9px;color:rgba(255,255,255,.5);margin-top:4px;text-transform:uppercase;letter-spacing:1px">Organs scanned</div>
              </div>
              <div style="background:rgba(56,189,248,.08);border:1px solid rgba(56,189,248,.15);border-radius:12px;padding:14px;text-align:center">
                <div style="font-family:var(--display);font-size:28px;font-weight:700;color:var(--sky);line-height:1">ECG</div>
                <div style="font-size:9px;color:rgba(255,255,255,.5);margin-top:4px;text-transform:uppercase;letter-spacing:1px">+ blood panel</div>
              </div>
            </div>
            
            <!-- Compact stats row -->
            <div style="display:flex;gap:16px;justify-content:center">
              <div style="text-align:center">
                <div style="font-family:var(--display);font-size:18px;font-weight:700;color:var(--white)">45<span style="font-size:10px;color:rgba(255,255,255,.4);font-weight:400">min</span></div>
                <div style="font-size:8px;color:rgba(255,255,255,.35);text-transform:uppercase;letter-spacing:1px">Appointment</div>
              </div>
              <div style="width:1px;background:rgba(255,255,255,.08)"></div>
              <div style="text-align:center">
                <div style="font-family:var(--display);font-size:18px;font-weight:700;color:var(--white)">48<span style="font-size:10px;color:rgba(255,255,255,.4);font-weight:400">hrs</span></div>
                <div style="font-size:8px;color:rgba(255,255,255,.35);text-transform:uppercase;letter-spacing:1px">Results</div>
              </div>
              <div style="width:1px;background:rgba(255,255,255,.08)"></div>
              <div style="text-align:center">
                <div style="font-family:var(--display);font-size:18px;font-weight:700;color:var(--white)">1<span style="font-size:10px;color:rgba(255,255,255,.4);font-weight:400">visit</span></div>
                <div style="font-size:8px;color:rgba(255,255,255,.35);text-transform:uppercase;letter-spacing:1px">Everything</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<style>
.hc-promo-grid{grid-template-columns:1fr 1fr}
@keyframes pulse-dot{0%,100%{opacity:1}50%{opacity:.4}}
@media(max-width:700px){.hc-promo-grid{grid-template-columns:1fr !important}}
</style>


<!-- HOW IT WORKS -->
<section class="how" id="how">
  <div class="section-head">
    <div class="section-label fu">How It Works</div>
    <h2 class="section-title fu">Three steps. <em>That's it.</em></h2>
  </div>
  <div class="how-steps">
    <div class="how-step fu">
      <div class="how-num">1</div>
      <h3>Apply online</h3>
      <p>Answer a short health questionnaire. Takes under 30 seconds. No GP referral needed.</p>
    </div>
    <div class="how-step fu">
      <div class="how-num">2</div>
      <h3>Get approved</h3>
      <p>A UK-registered clinician reviews your profile and conducts a short video consultation to confirm your suitability. Approved within 24 hours.</p>
    </div>
    <div class="how-step fu">
      <div class="how-num">3</div>
      <h3>Start losing</h3>
      <p>Your medication arrives next day in discreet packaging. Ongoing support from your care team, always.</p>
    </div>
  </div>
  <div style="text-align:center;margin-top:clamp(36px,4vw,52px)">
    <button onclick="openQ()" style="background:var(--sky);color:#fff;border:none;border-radius:100px;padding:14px 36px;font-family:var(--body);font-size:14px;font-weight:600;cursor:pointer;transition:background .2s,transform .2s;box-shadow:0 4px 16px rgba(56,189,248,.2)">Start your application &rarr;</button>
    <p style="font-size:11px;color:var(--slate);margin-top:10px">Takes 30 seconds. Followed by a short video consultation with your clinician.</p>
  </div>
</section>


<!-- RESULTS VISUAL -->
<section class="results-visual" style="padding:clamp(40px,5vw,64px) clamp(20px,4vw,56px);background:var(--ink);color:var(--white);overflow:hidden">
  <div style="max-width:840px;margin:0 auto">
    <div class="section-head" style="margin-bottom:clamp(28px,4vw,40px)">
      <div class="section-label fu" style="color:var(--sky)">The Numbers</div>
      <h2 style="font-family:var(--display);font-size:clamp(24px,3vw,36px);font-weight:700;line-height:1.1;letter-spacing:-.8px;color:var(--white);margin-bottom:16px" class="fu">What you can <em style="font-style:normal;color:var(--sky);font-weight:600">actually</em> expect.</h2>
      <p style="font-size:14px;color:rgba(255,255,255,.70);max-width:400px;margin:0 auto" class="fu">Real data from clinical trials and our member outcomes. Not promises &mdash; evidence.</p>
    </div>

    <!-- WEIGHT LOSS TIMELINE -->
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:clamp(20px,3vw,40px);align-items:center" class="res-split">
      <div class="fu">
        <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg" style="width:100%">
          <defs><linearGradient id="areafill" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#38BDF8" stop-opacity=".20"/><stop offset="1" stop-color="#38BDF8" stop-opacity="0"/></linearGradient></defs>
          <!-- Grid -->
          <line x1="40" y1="30" x2="380" y2="30" stroke="rgba(255,255,255,.06)" stroke-width="1"/>
          <line x1="40" y1="70" x2="380" y2="70" stroke="rgba(255,255,255,.06)" stroke-width="1"/>
          <line x1="40" y1="110" x2="380" y2="110" stroke="rgba(255,255,255,.06)" stroke-width="1"/>
          <line x1="40" y1="150" x2="380" y2="150" stroke="rgba(255,255,255,.06)" stroke-width="1"/>
          <!-- Y axis labels -->
          <text x="32" y="34" font-family="sans-serif" font-size="9" fill="rgba(255,255,255,.25)" text-anchor="end">0kg</text>
          <text x="32" y="74" font-family="sans-serif" font-size="9" fill="rgba(255,255,255,.25)" text-anchor="end">-5kg</text>
          <text x="32" y="114" font-family="sans-serif" font-size="9" fill="rgba(255,255,255,.25)" text-anchor="end">-10kg</text>
          <text x="32" y="154" font-family="sans-serif" font-size="9" fill="rgba(255,255,255,.25)" text-anchor="end">-15kg</text>
          <!-- Area -->
          <path d="M50,32 C90,34 130,50 170,72 C210,94 250,115 290,132 C330,148 360,155 375,158 L375,180 L50,180 Z" fill="url(#areafill)"/>
          <!-- Line -->
          <path d="M50,32 C90,34 130,50 170,72 C210,94 250,115 290,132 C330,148 360,155 375,158" fill="none" stroke="#38BDF8" stroke-width="3" stroke-linecap="round"/>
          <!-- Dots -->
          <circle cx="50" cy="32" r="4" fill="#38BDF8"/>
          <circle cx="110" cy="44" r="4" fill="#38BDF8"/>
          <circle cx="170" cy="72" r="4" fill="#38BDF8"/>
          <circle cx="230" cy="104" r="4" fill="#38BDF8"/>
          <circle cx="290" cy="132" r="4" fill="#38BDF8"/>
          <circle cx="375" cy="158" r="6" fill="#F97316" stroke="#0C0A09" stroke-width="2"/>
          <!-- Labels -->
          <text x="50" y="198" font-family="sans-serif" font-size="10" fill="rgba(255,255,255,.35)" text-anchor="middle">Wk 1</text>
          <text x="110" y="198" font-family="sans-serif" font-size="10" fill="rgba(255,255,255,.35)" text-anchor="middle">Wk 4</text>
          <text x="170" y="198" font-family="sans-serif" font-size="10" fill="rgba(255,255,255,.35)" text-anchor="middle">Wk 8</text>
          <text x="230" y="198" font-family="sans-serif" font-size="10" fill="rgba(255,255,255,.35)" text-anchor="middle">Mo 3</text>
          <text x="290" y="198" font-family="sans-serif" font-size="10" fill="rgba(255,255,255,.35)" text-anchor="middle">Mo 5</text>
          <text x="375" y="198" font-family="sans-serif" font-size="10" fill="#F97316" text-anchor="middle" font-weight="700">Mo 6</text>
          <!-- End badge -->
          <rect x="344" y="142" width="62" height="22" rx="6" fill="#F97316"/>
          <text x="375" y="157" font-family="sans-serif" font-size="11" fill="white" text-anchor="middle" font-weight="700">&minus;15kg</text>
          <!-- Title -->
          <text x="50" y="16" font-family="sans-serif" font-size="11" fill="rgba(255,255,255,.50)" font-weight="600">AVERAGE MEMBER WEIGHT LOSS</text>
        </svg>
      </div>
      <div class="fu">
        <div style="margin-bottom:28px">
          <div style="font-size:10px;color:rgba(255,255,255,.50);text-transform:uppercase;letter-spacing:2px;font-weight:700;margin-bottom:12px">By the numbers</div>
          <div style="display:flex;flex-direction:column;gap:12px">
            <div style="display:flex;justify-content:space-between;align-items:center;padding-bottom:16px;border-bottom:1px solid rgba(255,255,255,.06)">
              <span style="font-size:12px;color:rgba(255,255,255,.65)">Avg. loss at 3 months</span>
              <span style="font-family:var(--display);font-size:22px;font-weight:700;color:var(--sky)">8.4kg</span>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;padding-bottom:16px;border-bottom:1px solid rgba(255,255,255,.06)">
              <span style="font-size:12px;color:rgba(255,255,255,.65)">Avg. loss at 6 months</span>
              <span style="font-family:var(--display);font-size:22px;font-weight:700;color:var(--sky)">15kg</span>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;padding-bottom:16px;border-bottom:1px solid rgba(255,255,255,.06)">
              <span style="font-size:12px;color:rgba(255,255,255,.65)">Members who lost weight</span>
              <span style="font-family:var(--display);font-size:22px;font-weight:700;color:var(--sky)">87%</span>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center">
              <span style="font-size:12px;color:rgba(255,255,255,.65)">Member satisfaction</span>
              <span style="font-family:var(--display);font-size:22px;font-weight:700;color:#F97316">97%</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- WHY US + RESULTS — single unified section -->
<section style="padding:clamp(40px,5vw,60px) clamp(20px,4vw,56px);background:var(--ink)">
  <div style="max-width:960px;margin:0 auto">
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:clamp(16px,2.5vw,24px);text-align:center" class="why-grid">
      <div class="fu" style="padding:clamp(20px,3vw,32px) 16px">
        <div style="font-family:var(--display);font-size:clamp(32px,4vw,42px);font-weight:700;color:var(--sky);letter-spacing:-1.5px;line-height:1;margin-bottom:8px">23%</div>
        <p style="font-size:clamp(11px,1.2vw,13px);font-weight:600;color:var(--white);margin-bottom:4px">Average weight loss</p>
        <p style="font-size:10px;color:rgba(255,255,255,.45);line-height:1.4">Mounjaro clinical trials</p>
      </div>
      <div class="fu" style="padding:clamp(20px,3vw,32px) 16px;border-left:1px solid rgba(255,255,255,.08)">
        <div style="font-family:var(--display);font-size:clamp(32px,4vw,42px);font-weight:700;color:var(--sky);letter-spacing:-1.5px;line-height:1;margin-bottom:8px">4.8<span style="font-size:clamp(18px,2vw,24px);color:#FBBC05">★</span></div>
        <p style="font-size:clamp(11px,1.2vw,13px);font-weight:600;color:var(--white);margin-bottom:4px">Google rating</p>
        <p style="font-size:10px;color:rgba(255,255,255,.45);line-height:1.4">From verified patients</p>
      </div>
      <div class="fu" style="padding:clamp(20px,3vw,32px) 16px;border-left:1px solid rgba(255,255,255,.08)">
        <div style="display:flex;align-items:center;justify-content:center;gap:6px;margin-bottom:8px">
          <svg width="clamp(22px,3vw,28px)" height="clamp(22px,3vw,28px)" viewBox="0 0 24 24" fill="none"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke="var(--sky)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          <span style="font-family:var(--display);font-size:clamp(14px,1.6vw,17px);font-weight:700;color:var(--white);letter-spacing:.3px">CQC</span>
        </div>
        <p style="font-size:clamp(11px,1.2vw,13px);font-weight:600;color:var(--white);margin-bottom:4px">CQC Regulated</p>
        <p style="font-size:10px;color:rgba(255,255,255,.45);line-height:1.4">Same standard as your GP</p>
      </div>
      <div class="fu" style="padding:clamp(20px,3vw,32px) 16px;border-left:1px solid rgba(255,255,255,.08)">
        <div style="font-family:var(--display);font-size:clamp(32px,4vw,42px);font-weight:700;color:var(--sky);letter-spacing:-1.5px;line-height:1;margin-bottom:8px">48<span style="font-size:clamp(14px,1.6vw,18px);font-weight:500;color:rgba(255,255,255,.5)">hr</span></div>
        <p style="font-size:clamp(11px,1.2vw,13px);font-weight:600;color:var(--white);margin-bottom:4px">To first delivery</p>
        <p style="font-size:10px;color:rgba(255,255,255,.45);line-height:1.4">Free tracked Royal Mail</p>
      </div>
    </div>
    <!-- Trust badges row -->
    <div style="display:flex;justify-content:center;gap:clamp(12px,2vw,20px);flex-wrap:wrap;margin-top:clamp(20px,3vw,28px);padding-top:clamp(16px,2vw,20px);border-top:1px solid rgba(255,255,255,.06)">
      <span style="font-size:10px;color:rgba(255,255,255,.35);border:1px solid rgba(255,255,255,.08);padding:5px 12px;border-radius:20px">MHRA Approved</span>
      <span style="font-size:10px;color:rgba(255,255,255,.35);border:1px solid rgba(255,255,255,.08);padding:5px 12px;border-radius:20px">UK Clinicians</span>
      <span style="font-size:10px;color:rgba(255,255,255,.35);border:1px solid rgba(255,255,255,.08);padding:5px 12px;border-radius:20px">Free Delivery</span>
      <span style="font-size:10px;color:rgba(255,255,255,.35);border:1px solid rgba(255,255,255,.08);padding:5px 12px;border-radius:20px">Transparent Pricing</span>
    </div>
  </div>
</section>



<!-- SOCIAL PROOF CAROUSEL -->
<section class="social" id="reviews">
  <div class="section-head">
    <div class="section-label fu">Real Members</div>
    <h2 class="section-title fu">People like you, <em>winning.</em></h2>
  </div>
  <div class="carousel-wrap">
  <div class="carousel-track" id="carousel">
    <div class="review-card">
      <div class="review-stars">&starf;&starf;&starf;&starf;&starf;</div>
      <p class="review-text">&ldquo;I was sceptical, honestly. But <em>18kg down in 5 months</em> and I finally feel like myself. The clinician support made all the difference.&rdquo;</p>
      <div class="review-meta"><div class="review-av">S</div><div><div class="review-name">Sarah M.</div><div class="review-result">Lost 18kg &middot; Bristol</div></div></div>
    </div>
    <div class="review-card">
      <div class="review-stars">&starf;&starf;&starf;&starf;&starf;</div>
      <p class="review-text">&ldquo;Within 3 days my appetite just... changed. <em>12kg gone</em> and I actually enjoy eating now instead of fighting it.&rdquo;</p>
      <div class="review-meta"><div class="review-av">J</div><div><div class="review-name">James T.</div><div class="review-result">Lost 12kg &middot; London</div></div></div>
    </div>
    <div class="review-card">
      <div class="review-stars">&starf;&starf;&starf;&starf;&starf;</div>
      <p class="review-text">&ldquo;No judgment. No shame. Just <em>real medical support</em> that broke a cycle I&rsquo;d been stuck in for a decade.&rdquo;</p>
      <div class="review-meta"><div class="review-av">P</div><div><div class="review-name">Priya K.</div><div class="review-result">Lost 22kg &middot; Manchester</div></div></div>
    </div>
    <div class="review-card">
      <div class="review-stars">&starf;&starf;&starf;&starf;&starf;</div>
      <p class="review-text">&ldquo;My doctor said I needed to lose weight for years. Don&rsquo;t Weight made it actually <em>happen</em>. 14kg and counting.&rdquo;</p>
      <div class="review-meta"><div class="review-av">M</div><div><div class="review-name">Michael R.</div><div class="review-result">Lost 14kg &middot; Leeds</div></div></div>
    </div>
    <div class="review-card">
      <div class="review-stars">&starf;&starf;&starf;&starf;&starf;</div>
      <p class="review-text">&ldquo;I&rsquo;m a nurse &mdash; I know what works. This is the real deal. <em>9kg in 10 weeks</em> and my bloods are better than ever.&rdquo;</p>
      <div class="review-meta"><div class="review-av">A</div><div><div class="review-name">Aisha L.</div><div class="review-result">Lost 9kg &middot; Birmingham</div></div></div>
    </div>
    <div class="review-card">
      <div class="review-stars">&starf;&starf;&starf;&starf;&starf;</div>
      <p class="review-text">&ldquo;The name made me laugh, the results made me cry. <em>20kg lighter</em> and I actually want to be in photos again.&rdquo;</p>
      <div class="review-meta"><div class="review-av">D</div><div><div class="review-name">David C.</div><div class="review-result">Lost 20kg &middot; Edinburgh</div></div></div>
    </div>
    <!-- DUPLICATE SET for seamless loop -->
    <div class="review-card">
      <div class="review-stars">&starf;&starf;&starf;&starf;&starf;</div>
      <p class="review-text">&ldquo;I was sceptical, honestly. But <em>18kg down in 5 months</em> and I finally feel like myself. The clinician support made all the difference.&rdquo;</p>
      <div class="review-meta"><div class="review-av">S</div><div><div class="review-name">Sarah M.</div><div class="review-result">Lost 18kg &middot; Bristol</div></div></div>
    </div>
    <div class="review-card">
      <div class="review-stars">&starf;&starf;&starf;&starf;&starf;</div>
      <p class="review-text">&ldquo;Within 3 days my appetite just... changed. <em>12kg gone</em> and I actually enjoy eating now instead of fighting it.&rdquo;</p>
      <div class="review-meta"><div class="review-av">J</div><div><div class="review-name">James T.</div><div class="review-result">Lost 12kg &middot; London</div></div></div>
    </div>
    <div class="review-card">
      <div class="review-stars">&starf;&starf;&starf;&starf;&starf;</div>
      <p class="review-text">&ldquo;No judgment. No shame. Just <em>real medical support</em> that broke a cycle I&rsquo;d been stuck in for a decade.&rdquo;</p>
      <div class="review-meta"><div class="review-av">P</div><div><div class="review-name">Priya K.</div><div class="review-result">Lost 22kg &middot; Manchester</div></div></div>
    </div>
    <div class="review-card">
      <div class="review-stars">&starf;&starf;&starf;&starf;&starf;</div>
      <p class="review-text">&ldquo;My doctor said I needed to lose weight for years. Don&rsquo;t Weight made it actually <em>happen</em>. 14kg and counting.&rdquo;</p>
      <div class="review-meta"><div class="review-av">M</div><div><div class="review-name">Michael R.</div><div class="review-result">Lost 14kg &middot; Leeds</div></div></div>
    </div>
    <div class="review-card">
      <div class="review-stars">&starf;&starf;&starf;&starf;&starf;</div>
      <p class="review-text">&ldquo;I&rsquo;m a nurse &mdash; I know what works. This is the real deal. <em>9kg in 10 weeks</em> and my bloods are better than ever.&rdquo;</p>
      <div class="review-meta"><div class="review-av">A</div><div><div class="review-name">Aisha L.</div><div class="review-result">Lost 9kg &middot; Birmingham</div></div></div>
    </div>
    <div class="review-card">
      <div class="review-stars">&starf;&starf;&starf;&starf;&starf;</div>
      <p class="review-text">&ldquo;The name made me laugh, the results made me cry. <em>20kg lighter</em> and I actually want to be in photos again.&rdquo;</p>
      <div class="review-meta"><div class="review-av">D</div><div><div class="review-name">David C.</div><div class="review-result">Lost 20kg &middot; Edinburgh</div></div></div>
    </div>
  </div>
  </div>
</section>

<!-- FAQ -->
<section class="faq" id="faq">
  <div class="faq-inner">
    <div class="section-head">
      <div class="section-label fu">FAQ</div>
      <h2 class="section-title fu">Got questions? <em>Good.</em></h2>
    </div>
    <div class="faq-list">
      <div class="faq-item"><button class="faq-q" onclick="togFaq(this)"><span>What medications do you prescribe?</span><div class="faq-plus">+</div></button><div class="faq-a">We prescribe Mounjaro (tirzepatide) and Wegovy (semaglutide) &mdash; both MHRA-approved GLP-1 treatments. Your clinician will recommend the most appropriate medication based on your health profile, goals, and medical history.</div></div>
      <div class="faq-item"><button class="faq-q" onclick="togFaq(this)"><span>Am I eligible?</span><div class="faq-plus">+</div></button><div class="faq-a">Most adults with a BMI of 30+ (or 27+ with a weight-related health condition) are eligible. Our 30-second eligibility check confirms this instantly. A UK-registered clinician reviews every application.</div></div>
      <div class="faq-item"><button class="faq-q" onclick="togFaq(this)"><span>How does pricing work?</span><div class="faq-plus">+</div></button><div class="faq-a">All new patients start on the starter dose at a lower introductory price. After your video consultation, your clinician may adjust your dose based on your response and goals &mdash; the monthly price is then updated to reflect your prescribed dose. You always know your price before you&rsquo;re charged. See our <a href="/treatments/" style="color:var(--sky-deep)">treatments page</a> for full dose-by-dose pricing.</div></div>
      <div class="faq-item"><button class="faq-q" onclick="togFaq(this)"><span>What happens after my first month?</span><div class="faq-plus">+</div></button><div class="faq-a">Your clinician reviews your progress and may adjust your dose. Your treatment continues at the price for your prescribed dose &mdash; you&rsquo;ll always know the cost before your next order. There are no contracts or lock-in periods.</div></div>
      <div class="faq-item"><button class="faq-q" onclick="togFaq(this)"><span>How do dose increases work?</span><div class="faq-plus">+</div></button><div class="faq-a">Dose increases are always managed by your clinician based on your progress, tolerance, and clinical guidelines. You&rsquo;ll never be moved to a higher dose without a clinical review. If your dose changes, we&rsquo;ll confirm the new monthly price before your next payment.</div></div>
      <div class="faq-item"><button class="faq-q" onclick="togFaq(this)"><span>How fast will I see results?</span><div class="faq-plus">+</div></button><div class="faq-a">Most members notice reduced appetite within the first 1&ndash;2 weeks. Visible weight loss typically begins weeks 2&ndash;4. Clinical trial averages: 5&ndash;7% body weight by 3 months, and 15&ndash;23% by 12 months depending on medication. Individual results vary.</div></div>
      <div class="faq-item"><button class="faq-q" onclick="togFaq(this)"><span>Is it safe?</span><div class="faq-plus">+</div></button><div class="faq-a">All our medications are MHRA-approved and prescribed only by GPhC-registered UK clinicians after a full medical review. Your clinician monitors you throughout your treatment, adjusting your dose as needed. Common initial side effects like nausea and reduced appetite are mild and typically ease within the first few weeks.</div></div>
      <div class="faq-item"><button class="faq-q" onclick="togFaq(this)"><span>What are the common side effects?</span><div class="faq-plus">+</div></button><div class="faq-a">The most common side effects are mild nausea, reduced appetite, and occasional digestive discomfort. These are typically temporary and ease within the first 2&ndash;4 weeks as your body adjusts. Starting on a lower dose helps minimise side effects. Your clinician is available throughout your treatment if you have any concerns.</div></div>
      <div class="faq-item"><button class="faq-q" onclick="togFaq(this)"><span>Do I need a GP referral?</span><div class="faq-plus">+</div></button><div class="faq-a">No. You do not need a GP referral. Our UK-registered clinicians conduct a full independent medical review as part of your application. We may contact your GP with your consent if clinically necessary.</div></div>
      <div class="faq-item"><button class="faq-q" onclick="togFaq(this)"><span>How is the medication delivered?</span><div class="faq-plus">+</div></button><div class="faq-a">Your medication is dispatched via next-day delivery in discreet, temperature-controlled packaging. First orders include free next-day delivery. You&rsquo;ll receive tracking information by email.</div></div>
      <div class="faq-item"><button class="faq-q" onclick="togFaq(this)"><span>Do I have to commit long-term?</span><div class="faq-plus">+</div></button><div class="faq-a">Not at all. There are no contracts or lock-in periods. Every prescription is reviewed and approved by your clinician. If you&rsquo;d like to stop treatment at any point, simply let us know.</div></div>
    </div>
  </div>
</section>

<!-- FINAL CTA -->
<div class="final-cta">
  <h2 class="fu">Don&rsquo;t weight.</h2>
  <p class="fu">30-second application. Approved by tomorrow. Medication at your door the next day.</p>
  <button class="cta-white fu" onclick="openQ()">Start your programme &rarr;</button>
  <p class="final-note fu">Every prescription clinician-approved. No commitment.</p>
</div>

<!-- FOOTER -->
<?php include(get_template_directory() . '/footer.php'); ?>

<!-- ELIGIBILITY SCREENER -->
<div class="ov" id="ov" onclick="if(event.target===this)closeQ()">
  <div class="qm">
    <button class="qx" onclick="closeQ()">&times;</button>
    <div style="font-size:11px;letter-spacing:1.5px;text-transform:uppercase;color:var(--sky-deep);font-weight:700;margin-bottom:6px">Eligibility Check</div>
    <div style="font-size:13px;color:var(--charcoal);margin-bottom:6px">30-second assessment &middot; 100% confidential</div>
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
        <div style="font-size:11px;color:var(--slate);margin-bottom:16px">&#10003; Clinician-approved &nbsp;&middot;&nbsp; &#10003; No commitment &nbsp;&middot;&nbsp; &#10003; Refundable if not eligible</div>
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
</div>

<script>
// Mobile menu
function toggleMobileMenu(){
  const menu=document.getElementById('mobileMenu');
  const burger=document.querySelector('.burger');
  menu.classList.toggle('open');
  burger.classList.toggle('open');
  document.body.style.overflow=menu.classList.contains('open')?'hidden':'';
}
function closeMobileMenu(){
  document.getElementById('mobileMenu').classList.remove('open');
  document.querySelector('.burger').classList.remove('open');
  document.body.style.overflow='';
}

const obs=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting)e.target.classList.add('in')}),{threshold:.08});
document.querySelectorAll('.fu').forEach(el=>obs.observe(el));
setTimeout(()=>document.querySelectorAll('.hero .fu').forEach((el,i)=>setTimeout(()=>el.classList.add('in'),300+i*100)),0);

// Quiz state
let cur=1, patientBmi=0, hasComorbid=false, isAdjusted=false, useImperial=false;

function openQ(){document.getElementById('ov').classList.add('on');document.body.classList.add('quiz-open')}
function closeQ(){document.getElementById('ov').classList.remove('on');document.body.classList.remove('quiz-open')}
// Auto-open quiz if redirected from treatments page
if(new URLSearchParams(window.location.search).get('openQ')==='1'){setTimeout(openQ,400)}
function go(n){document.getElementById('q'+cur).classList.remove('on');cur=n;document.getElementById('q'+cur).classList.add('on');document.querySelectorAll('.qd').forEach((d,i)=>d.classList.toggle('done',i<n));clearErr()}
function sel(el,multi){if(!multi)el.parentElement.querySelectorAll('.qo').forEach(o=>o.classList.remove('sel'));el.classList.toggle('sel');clearErr()}
function selNone(el,groupId){document.querySelectorAll('#'+groupId+' .qo').forEach(o=>o.classList.remove('sel'));el.classList.add('sel');clearErr()}
function selCondition(el){const group=el.parentElement;group.querySelector('.qo:last-child').classList.remove('sel');el.classList.toggle('sel');clearErr()}
function clearErr(){document.querySelectorAll('.qerr').forEach(e=>e.textContent='')}
function showErr(id,msg){document.getElementById(id).textContent=msg}
function reject(msg){document.getElementById('rejectMsg').innerHTML=msg;document.getElementById('q'+cur).classList.remove('on');document.getElementById('qX').classList.add('on');document.querySelectorAll('.qd').forEach(d=>d.classList.add('done'))}
function eligible(){document.getElementById('rBmi').textContent=patientBmi.toFixed(1);document.getElementById('q'+cur).classList.remove('on');document.getElementById('qR').classList.add('on');document.querySelectorAll('.qd').forEach(d=>d.classList.add('done'))}
function goBack(){document.getElementById('qX').classList.remove('on');document.getElementById('q'+cur).classList.add('on');document.querySelectorAll('.qd').forEach((d,i)=>d.classList.toggle('done',i<cur))}

// Lead capture + redirect to consultation
function goToConsultation(){
  const fn=document.getElementById('leadFname').value.trim();
  const ln=document.getElementById('leadLname').value.trim();
  const em=document.getElementById('leadEmail').value.trim();
  if(!fn||!ln){showErr('eR','Please enter your first and last name.');return}
  if(!em||!em.includes('@')||!em.includes('.')){showErr('eR','Please enter a valid email address.');return}
  
  // Collect ALL quiz data
  const answers=[];
  document.querySelectorAll('.qo.sel').forEach(el=>answers.push(el.textContent.trim()));
  const sex=document.getElementById('q1sex').querySelector('.qo.sel');
  const dob=document.getElementById('iDobD').value+'/'+document.getElementById('iDobM').value+'/'+document.getElementById('iDobY').value;
  const eth=document.getElementById('q3eth')?document.getElementById('q3eth').querySelector('.qo.sel'):null;
  
  // Height/weight
  let heightCm='',weightKg='';
  if(useImperial){
    const ft=parseFloat(document.getElementById('iFt').value)||0;
    const inch=parseFloat(document.getElementById('iIn').value)||0;
    const st=parseFloat(document.getElementById('iSt').value)||0;
    const lbs=parseFloat(document.getElementById('iLbs').value)||0;
    heightCm=Math.round((ft*12+inch)*2.54);
    weightKg=Math.round((st*14+lbs)*0.453592);
  } else {
    heightCm=document.getElementById('iHeight').value;
    weightKg=document.getElementById('iWeight').value;
  }
  
  // Conditions
  const conditions=Array.from(document.querySelectorAll('#q4opts .qo.sel')).map(el=>el.querySelector('span').textContent).join(', ');
  const contras=Array.from(document.querySelectorAll('#q5contra .qo.sel')).map(el=>el.querySelector('span').textContent).join(', ');
  
  // Submit ALL data to server
  const fd=new FormData();
  fd.append('action','dw_submit_app');
  fd.append('nonce',typeof dwAjax!=='undefined'?dwAjax.nonce:'');
  fd.append('first_name',fn);
  fd.append('last_name',ln);
  fd.append('email',em);
  fd.append('bmi',patientBmi.toFixed(1));
  fd.append('dob',dob);
  fd.append('gender',sex?sex.querySelector('span').textContent:'');
  fd.append('height_cm',heightCm);
  fd.append('weight_kg',weightKg);
  fd.append('ethnicity',eth?eth.querySelector('span').textContent:'');
  fd.append('conditions',conditions);
  fd.append('stage','eligibility');
  fd.append('answers',answers.join(' | ')+' | Contraindications: '+contras);
  
  const ajaxUrl=typeof dwAjax!=='undefined'?dwAjax.url:'/wp-admin/admin-ajax.php';
  fetch(ajaxUrl,{method:'POST',body:fd}).catch(()=>{});
  
  // Redirect to consultation
  const params=new URLSearchParams({fn:fn,ln:ln,em:em,bmi:patientBmi.toFixed(1)});
  window.location.href='<?php echo esc_js(dontweight_consultation_url()); ?>?'+params.toString();
}

// Unit toggle
function setUnits(type){
  useImperial=(type==='imperial');
  document.getElementById('metricFields').style.display=useImperial?'none':'flex';
  document.getElementById('imperialFields').style.display=useImperial?'flex':'none';
  document.getElementById('ubMetric').classList.toggle('active',!useImperial);
  document.getElementById('ubImperial').classList.toggle('active',useImperial);
  document.getElementById('bmiDisplay').style.display='none';
}

// Step 1: DOB + Sex
function goStep1(){
  const d=document.getElementById('iDobD').value, m=document.getElementById('iDobM').value, y=document.getElementById('iDobY').value;
  const sex=document.getElementById('q1sex').querySelector('.qo.sel');
  if(!d||!m||!y||!sex){showErr('e1','Please enter your date of birth and select your biological sex.');return}
  if(d<1||d>31||m<1||m>12||y<1930||y>2010){showErr('e1','Please enter a valid date of birth.');return}
  const age=new Date().getFullYear()-parseInt(y);
  if(age<18){reject('GLP-1 weight loss medications are only available to adults aged 18 and over. Please speak with your GP about alternative options.');return}
  go(2);
}

// Step 2: Height + Weight + BMI (metric or imperial)
function goStep2(){
  let h,w;
  if(useImperial){
    const ft=parseFloat(document.getElementById('iFt').value)||0;
    const inch=parseFloat(document.getElementById('iIn').value)||0;
    const st=parseFloat(document.getElementById('iSt').value)||0;
    const lbs=parseFloat(document.getElementById('iLbs').value)||0;
    if(!ft||ft<4||ft>7){showErr('e2','Please enter a valid height in feet and inches.');return}
    if(!st||st<5||st>50){showErr('e2','Please enter a valid weight in stone and pounds.');return}
    h=(ft*12+inch)*2.54; // convert to cm
    w=(st*14+lbs)*0.453592; // convert to kg
  } else {
    h=parseFloat(document.getElementById('iHeight').value);
    w=parseFloat(document.getElementById('iWeight').value);
    if(!h||!w||h<100||h>250||w<30||w>350){showErr('e2','Please enter a valid height (100&ndash;250 cm) and weight (30&ndash;350 kg).');return}
  }
  patientBmi=w/((h/100)*(h/100));
  document.getElementById('bmiDisplay').style.display='block';
  document.getElementById('bmiDisplay').textContent='Your BMI: '+patientBmi.toFixed(1);
  if(patientBmi<22){reject('Based on the height and weight you provided, your BMI is '+patientBmi.toFixed(1)+'. GLP-1 medications are indicated for individuals with a BMI of 27 or above (with weight-related conditions) or 30 or above. We are unable to proceed with this assessment. Please consult your GP if you have concerns about your weight.');return}
  go(3);
}

// Step 3: Ethnicity
function goStep3(){
  const eth=document.getElementById('q3eth').querySelector('.qo.sel');
  if(!eth){showErr('e3','Please select your ethnic background.');return}
  isAdjusted=eth.getAttribute('data-adj')==='1';
  go(4);
}

// Step 4: Comorbidities + BMI check
function goStep4(){
  const selected=document.querySelectorAll('#q4opts .qo.sel');
  if(!selected.length){showErr('e4','Please select at least one option.');return}
  hasComorbid=Array.from(selected).some(el=>el.getAttribute('data-comorbid')==='1');
  // BMI eligibility check per NICE guidelines
  const bmiThreshold30=isAdjusted?27.5:30;
  const bmiThreshold27=isAdjusted?24.5:27;
  if(patientBmi>=bmiThreshold30){go(5);return}// BMI 30+ (or 27.5+ adjusted) = eligible regardless
  if(patientBmi>=bmiThreshold27&&hasComorbid){go(5);return}// BMI 27-30 with comorbidity = eligible
  if(patientBmi>=bmiThreshold27&&!hasComorbid){reject('Your BMI is '+patientBmi.toFixed(1)+'. For individuals with a BMI between '+(isAdjusted?'24.5':'27')+' and '+(isAdjusted?'27.5':'30')+', at least one weight-related health condition is required for GLP-1 treatment eligibility. Based on your answers, you do not currently meet this criteria. Please speak with your GP about other weight management options.');return}
  reject('Your BMI is '+patientBmi.toFixed(1)+'. GLP-1 medications are clinically indicated for adults with a BMI of '+(isAdjusted?'24.5':'27')+' or above (with a weight-related condition) or '+(isAdjusted?'27.5':'30')+' or above. We are unable to proceed at this time. Your GP can advise on alternative approaches to weight management.');return;
}

// Step 5: Contraindications — if passed, show result
function goStep5(){
  const selected=document.querySelectorAll('#q5contra .qo.sel');
  if(!selected.length){showErr('e5','Please select at least one option.');return}
  const blocked=Array.from(selected).some(el=>el.getAttribute('data-block')==='1');
  if(blocked){
    const items=Array.from(selected).filter(el=>el.getAttribute('data-block')==='1').map(el=>el.querySelector('span').textContent);
    reject('Based on your answers, you have indicated: <strong>'+items.join(', ')+'</strong>. These are contraindications for GLP-1 treatment, and we are unable to proceed with this assessment for safety reasons. Please consult your GP or specialist for personalised medical advice.');return;
  }
  eligible();
}

function togFaq(btn){const it=btn.parentElement,was=it.classList.contains('open');document.querySelectorAll('.faq-item').forEach(i=>i.classList.remove('open'));if(!was)it.classList.add('open')}

// Hand-drawn circles on scroll
const circleObs=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){const circles=e.target.querySelectorAll('.trust-circled');circles.forEach((c,i)=>setTimeout(()=>c.classList.add('circled'),i*500));circleObs.unobserve(e.target)}}),{threshold:.5});
const trustRow=document.querySelector('.trust-row');
if(trustRow)circleObs.observe(trustRow);

// Shrinking "losing." text effect
const losingEl=document.getElementById('losingText');
if(losingEl){
  const text=losingEl.textContent;
  losingEl.innerHTML=text.split('').map(c=>'<span>'+c+'</span>').join('');
  setTimeout(()=>losingEl.classList.add('animate'),800);
  setInterval(()=>{
    losingEl.classList.remove('animate');
    setTimeout(()=>losingEl.classList.add('animate'),100);
  },6000);
}

// Weight loss calculator
let calcUseStone=false;
function setCalcUnit(u){
  calcUseStone=(u==='st');
  document.getElementById('cuKg').classList.toggle('active',!calcUseStone);
  document.getElementById('cuSt').classList.toggle('active',calcUseStone);
  const slider=document.getElementById('calcSlider');
  if(calcUseStone){
    slider.min=9;slider.max=32;slider.step=1;
    const curKg=parseFloat(document.getElementById('calcWeight').textContent)||90;
    slider.value=Math.round(curKg/6.35029);
    document.getElementById('calcMin').textContent='9 st';
    document.getElementById('calcMax').textContent='32 st';
  } else {
    const curSt=parseInt(slider.value)||14;
    slider.min=60;slider.max=200;slider.step=1;
    slider.value=Math.round(curSt*6.35029);
    document.getElementById('calcMin').textContent='60 kg';
    document.getElementById('calcMax').textContent='200 kg';
  }
  updateCalc();
}
function updateCalc(){
  const slider=document.getElementById('calcSlider');
  const val=parseFloat(slider.value);
  const weightKg=calcUseStone?val*6.35029:val;
  const pct=(val-parseFloat(slider.min))/(parseFloat(slider.max)-parseFloat(slider.min))*100;
  slider.style.background='linear-gradient(to right,var(--sky) 0%,var(--sky) '+pct+'%,#E7E5E4 '+pct+'%)';
  const lossMounjaro=weightKg*0.23;
  const lossWegovy=weightKg*0.15;
  const targetMounjaro=weightKg-lossMounjaro;
  const targetWegovy=weightKg-lossWegovy;
  if(calcUseStone){
    const st=Math.floor(val);const lb=Math.round((val-st)*14);
    document.getElementById('calcWeight').textContent=st;
    document.getElementById('calcUnit').textContent='stone';
    document.getElementById('calcMounjaro').textContent='-'+Math.round(lossMounjaro/6.35029)+' st '+Math.round((lossMounjaro%6.35029)/0.4536)+' lb';
    document.getElementById('calcWegovy').textContent='-'+Math.round(lossWegovy/6.35029)+' st '+Math.round((lossWegovy%6.35029)/0.4536)+' lb';
    const tSt=Math.floor(targetMounjaro/6.35029);const tLb=Math.round((targetMounjaro%6.35029)/0.4536);
    const oSt=Math.floor(targetWegovy/6.35029);const oLb=Math.round((targetWegovy%6.35029)/0.4536);
    document.getElementById('calcMounjaroTarget').textContent='\u2192 '+tSt+' st '+tLb+' lb';
    document.getElementById('calcWegovyTarget').textContent='\u2192 '+oSt+' st '+oLb+' lb';
  } else {
    document.getElementById('calcWeight').textContent=Math.round(val);
    document.getElementById('calcUnit').textContent='kg';
    document.getElementById('calcMounjaro').textContent='-'+lossMounjaro.toFixed(1)+' kg';
    document.getElementById('calcWegovy').textContent='-'+lossWegovy.toFixed(1)+' kg';
    document.getElementById('calcMounjaroTarget').textContent='\u2192 '+targetMounjaro.toFixed(1)+' kg';
    document.getElementById('calcWegovyTarget').textContent='\u2192 '+targetWegovy.toFixed(1)+' kg';
  }
}
updateCalc();

// Carousels
// Review carousel: pure CSS infinite scroll (see .carousel-track keyframes)

// Photo carousel: JS-based smooth infinite scroll
(function(){
  var track=document.getElementById('photoCarousel');
  if(!track||!track.children.length)return;
  var speed=0.6; // px per frame
  var pos=0;
  var paused=false;
  // Calculate width of one set (total children / 3 sets)
  var totalCards=track.children.length;
  var oneSetCount=Math.round(totalCards/3);
  function getOneSetWidth(){
    var w=0;
    for(var i=0;i<oneSetCount&&i<track.children.length;i++){
      w+=track.children[i].offsetWidth+14; // 14px gap
    }
    return w;
  }
  var setWidth=0;
  // Wait for images to set dimensions
  setTimeout(function(){
    setWidth=getOneSetWidth();
    if(setWidth<=0)setWidth=track.scrollWidth/3;
    requestAnimationFrame(scroll);
  },500);
  function scroll(){
    if(!paused){
      pos-=speed;
      if(Math.abs(pos)>=setWidth){
        pos+=setWidth;
      }
      track.style.transform='translateX('+pos+'px)';
    }
    requestAnimationFrame(scroll);
  }
  track.addEventListener('mouseenter',function(){paused=true});
  track.addEventListener('mouseleave',function(){paused=false});
  track.addEventListener('touchstart',function(){paused=true},{passive:true});
  track.addEventListener('touchend',function(){setTimeout(function(){paused=false},2000)});
  // Recalculate on resize
  window.addEventListener('resize',function(){setWidth=getOneSetWidth();if(setWidth<=0)setWidth=track.scrollWidth/3;});
})();

// Hide "Slide to explore" on first interaction
document.getElementById('calcSlider').addEventListener('input',function(){
  var h=document.querySelector('.slide-hint');if(h)h.style.display='none';
  var dh=document.getElementById('dragHandle');if(dh)dh.style.animation='none';
},{once:true});

// Move visual drag handle with slider
function moveHandle(){
  var s=document.getElementById('calcSlider');
  var h=document.getElementById('dragHandle');
  if(!s||!h)return;
  var pct=(s.value-s.min)/(s.max-s.min)*100;
  h.style.left=pct+'%';
}
</script>
<?php echo dontweight_get_ajax_script(); ?>
<?php wp_footer(); ?>
</body>
</html>
