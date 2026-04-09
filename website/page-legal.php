<?php
/**
 * Template Name: Legal Page
 * Description: Branded legal/policy pages for Don't Weight
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/favicon.svg">
<title><?php the_title(); ?> — don't weight</title>
<meta name="description" content="<?php echo esc_attr(the_title('', '', false)); ?> for don't weight, CQC-registered medical weight loss clinic in London. UK clinician-led service.">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<?php wp_head(); ?>
<style>
:root{--sky:#38BDF8;--sky-deep:#0EA5E9;--sky-dark:#0284C7;--sky-pale:#E0F2FE;--sky-wash:#F0F9FF;--white:#FFFFFF;--cream:#FAFAF9;--warm:#F5F5F4;--stone:#E7E5E4;--ink:#0C0A09;--charcoal:#1C1917;--slate:#44403C;--display:-apple-system,BlinkMacSystemFont,'Inter',sans-serif;--body:-apple-system,BlinkMacSystemFont,'Inter',sans-serif}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}html{scroll-behavior:smooth}body{background:var(--white);color:var(--ink);font-family:var(--body);font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased}

/* NAV */
.nav{position:fixed;top:0;left:0;right:0;z-index:100;height:56px;padding-top:2px;display:flex;align-items:center;justify-content:space-between;padding:0 clamp(16px,4vw,48px);background:rgba(255,255,255,.96);backdrop-filter:blur(20px);border-bottom:1px solid rgba(0,0,0,.04)}
.nav-logo{font-family:var(--display);font-size:22px;font-weight:800;color:var(--ink);text-decoration:none;letter-spacing:-.8px;white-space:nowrap;flex-shrink:0;line-height:1}.nav-logo i{color:var(--sky);font-style:italic;font-weight:300}
.nav-mid{display:flex;gap:32px;list-style:none}.nav-mid a{color:var(--slate);text-decoration:none;font-size:13px;font-weight:500}.nav-mid a.active{color:var(--sky-deep);font-weight:600}
.nav-r{display:flex;align-items:center;gap:16px}.nav-login{color:var(--ink);text-decoration:none;font-size:13px;font-weight:600}
.nav-btn{background:var(--sky);color:#fff;border:none;border-radius:100px;padding:10px 24px;font-family:var(--body);font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;white-space:nowrap}
.burger{display:none;background:none;border:none;cursor:pointer;width:32px;height:32px;position:relative;z-index:102}.burger span{display:block;width:20px;height:1.5px;background:var(--ink);position:absolute;left:6px;transition:transform .3s,opacity .2s}.burger span:nth-child(1){top:10px}.burger span:nth-child(2){top:16px}.burger span:nth-child(3){top:22px}
.mobile-menu{position:fixed;inset:0;z-index:101;background:var(--white);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:24px;opacity:0;pointer-events:none;transition:opacity .3s}.mobile-menu.open{opacity:1;pointer-events:all}.mobile-menu a{font-size:22px;font-weight:600;color:var(--ink);text-decoration:none}.mobile-menu .mm-cta{background:var(--sky);color:#fff;border:none;border-radius:100px;padding:16px 48px;font-size:16px;font-weight:700;cursor:pointer}.mm-close{position:absolute;top:max(16px,env(safe-area-inset-top,16px));right:20px;background:var(--warm);border:none;font-size:32px;color:var(--ink);cursor:pointer;width:48px;height:48px;display:flex;align-items:center;justify-content:center;border-radius:50%;z-index:102}

/* CONTENT */
.legal-header{padding:120px clamp(20px,4vw,56px) 48px;text-align:center;background:linear-gradient(180deg,var(--white) 0%,var(--sky-wash) 100%)}
.legal-header h1{font-family:var(--display);font-size:clamp(28px,4vw,44px);font-weight:700;letter-spacing:-1px;color:var(--ink);margin-bottom:8px}
.legal-header p{font-size:14px;color:var(--slate)}
.legal-body{max-width:720px;margin:0 auto;padding:clamp(32px,5vw,56px) clamp(16px,4vw,56px) clamp(48px,6vw,80px)}
.legal-body h2{font-family:var(--display);font-size:20px;font-weight:700;letter-spacing:-.3px;color:var(--ink);margin:36px 0 12px;padding-top:12px;border-top:1px solid var(--stone)}
.legal-body h2:first-child{border-top:none;margin-top:0;padding-top:0}
.legal-body h3{font-family:var(--display);font-size:16px;font-weight:700;color:var(--ink);margin:24px 0 8px}
.legal-body p{margin-bottom:14px;color:var(--charcoal);line-height:1.8;font-size:14px}
.legal-body ul,.legal-body ol{margin:0 0 16px 24px;color:var(--charcoal)}
.legal-body li{margin-bottom:6px;line-height:1.7;font-size:14px}
.legal-body a{color:var(--sky-deep)}
.legal-body strong{color:var(--ink)}

/* FOOTER */
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
.ft-badge{background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);border-radius:100px;padding:4px 12px;font-size:11px;color:rgba(255,255,255,.45);font-weight:500}
.ft-badges{display:flex;gap:8px;flex-wrap:wrap}

@media(max-width:960px){.nav-mid{display:none}.burger{display:block}.nav-login{display:none}}
@media(max-width:600px){.nav-btn{padding:8px 14px;font-size:11px}.nav-r{gap:8px}.ft-top{flex-direction:column;gap:20px}}
@media(max-width:480px){.nav-logo{font-size:18px}}
</style>
</head>
<body>

<!-- NAV -->
<?php include(get_template_directory() . '/header.php'); ?>

<!-- HEADER -->
<header class="legal-header">
  <h1><?php the_title(); ?></h1>
  <p>Last updated: <?php echo get_the_modified_date('j F Y'); ?></p>
</header>

<!-- CONTENT -->
<div class="legal-body">
  <?php
  if (have_posts()) {
    while (have_posts()) {
      the_post();
      the_content();
    }
  }
  ?>
</div>

<!-- FOOTER -->
<?php include(get_template_directory() . '/footer.php'); ?>

<script>
function toggleMobileMenu(){document.getElementById('mobileMenu').classList.toggle('open');document.querySelector('.burger').classList.toggle('open');document.body.style.overflow=document.getElementById('mobileMenu').classList.contains('open')?'hidden':''}
function closeMobileMenu(){document.getElementById('mobileMenu').classList.remove('open');document.querySelector('.burger').classList.remove('open');document.body.style.overflow=''}
</script>
<?php wp_footer(); ?>
</body>
</html>
