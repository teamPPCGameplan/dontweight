<?php
/**
 * Shared Navigation Header
 * Include in page templates: <?php include(get_template_directory() . '/header.php'); ?>
 */
?>
<div class="dw-lpug-bar" style="height:auto;padding:6px 20px;background:#1A1A2E;color:#fff;font-size:12px;text-align:center;letter-spacing:0.5px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;line-height:1.4;box-sizing:border-box;width:100%;">A <strong>London Private Ultrasound Group</strong> clinic <span style="display:inline-block;margin:0 10px;opacity:0.4;">&middot;</span> Established healthcare provider</div>
<style>
@media(max-width:768px){.dw-lpug-bar{font-size:11px!important;}}
.nav-login,.nav-cta{font-size:13px;font-weight:600;padding:8px 20px;border-radius:999px;text-decoration:none;transition:all .2s}
.nav-login{color:#0c0a09;border:1.5px solid #0c0a09;background:#fff}
.nav-login:hover{background:#0c0a09;color:#fff}
.nav-cta{color:#fff;background:#38bdf8;border:1.5px solid #38bdf8}
.nav-cta:hover{background:#2da8e0;border-color:#2da8e0}
.nav{background:#fff !important;transition:background .3s}
</style>
<nav class="nav">
  <a href="https://dontweight.co.uk" class="nav-logo">don't <i>weight</i></a>
  <ul class="nav-mid">
    <li><a href="/" <?php if(is_front_page()) echo 'class="active"'; ?>>Home</a></li>
    <li><a href="/treatments/" <?php if(is_page('treatments')) echo 'class="active"'; ?>>Treatments</a></li>
    <li><a href="/health-checks/" <?php if(is_page('health-checks') || is_page('dw360')) echo 'class="active"'; ?>>Health Checks</a></li>
    <li><a href="/about/" <?php if(is_page('about')) echo 'class="active"'; ?>>About Us</a></li>
    <li><a href="/blog/" <?php if(is_page('blog') || is_singular('post')) echo 'class="active"'; ?>>The Journal</a></li>
  </ul>
  <div class="nav-r">
    <a href="https://app.dontweight.co.uk" class="nav-login">Log in</a>
    <a href="/contact/" class="nav-cta">Contact</a>
    <button class="burger" onclick="openMobileMenu()" aria-label="Open menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>
<div class="mobile-menu" id="mobileMenu">
  <button class="mm-close" onclick="closeMobileMenu()" aria-label="Close menu">&times;</button>
  <a href="/">Home</a>
  <a href="/treatments/">Treatments</a>
  <a href="/health-checks/">Health Checks</a>
  <a href="/about/">About Us</a>
  <a href="/blog/">The Journal</a>
  <a href="https://app.dontweight.co.uk">Log in</a>
  <a href="/contact/">Contact</a>
</div>