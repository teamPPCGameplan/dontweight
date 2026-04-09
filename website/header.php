<?php
/**
 * Shared Navigation Header
 * Include in page templates: <?php include(get_template_directory() . '/header.php'); ?>
 */
?>
<style>
.dw-lpug-bar{display:none!important;}
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
    <li><a href="/blog/" <?php if(is_page('blog') || is_singular('post')) echo 'class="active"'; ?>>Blog</a></li>
  </ul>
  <div class="nav-r">
    <a href="https://app.dontweight.co.uk" class="nav-login">Log in</a>
    <a href="/contact/" class="nav-cta">Contact</a>
    <button class="burger" onclick="toggleMobileMenu()" aria-label="Open menu">
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
  <a href="/blog/">Blog</a>
  <a href="https://app.dontweight.co.uk">Log in</a>
  <a href="/contact/">Contact</a>
</div>