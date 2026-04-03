<?php
/**
 * Default page template
 * For pages that don't use a custom template
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title('—', true, 'right'); ?> don't weight</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{--sky:#38BDF8;--sky-deep:#0EA5E9;--sky-dark:#0284C7;--ink:#0C0A09;--charcoal:#1C1917;--slate:#44403C;--cream:#FAFAF9;--warm:#F5F5F4;--stone:#E7E5E4;--white:#FFFFFF;--display:-apple-system,BlinkMacSystemFont,'Inter','SF Pro Display','Helvetica Neue',sans-serif;--body:-apple-system,BlinkMacSystemFont,'Inter','SF Pro Display','SF Pro Text','Helvetica Neue',sans-serif}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:var(--body);background:var(--cream);color:var(--ink);font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased}
.nav{position:fixed;top:0;left:0;right:0;z-index:100;height:56px;display:flex;align-items:center;justify-content:space-between;padding:0 clamp(16px,4vw,48px);background:rgba(255,255,255,.96);backdrop-filter:blur(20px);border-bottom:1px solid rgba(0,0,0,.04)}
.nav-logo{font-family:var(--display);font-size:22px;font-weight:800;color:var(--ink);text-decoration:none;letter-spacing:-.8px;line-height:.9;white-space:nowrap;flex-shrink:0}
.nav-logo i{color:var(--sky-deep);font-style:normal;font-weight:500}
.nav-btn{background:var(--sky);color:var(--white);border:none;border-radius:100px;padding:10px 24px;font-family:var(--body);font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;transition:background .2s}
.nav-btn:hover{background:var(--sky-deep)}
.content{max-width:720px;margin:0 auto;padding:100px 24px 80px}
.content h1{font-family:var(--display);font-size:clamp(28px,4vw,40px);font-weight:700;letter-spacing:-.8px;margin-bottom:24px}
.content h2{font-family:var(--display);font-size:24px;font-weight:700;margin:32px 0 12px;letter-spacing:-.3px}
.content p{margin-bottom:16px;color:var(--charcoal);line-height:1.8}
.content ul,.content ol{margin:0 0 16px 24px;color:var(--charcoal)}
.content li{margin-bottom:8px;line-height:1.7}
.content a{color:var(--sky-deep);text-decoration:underline}
</style>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<nav class="nav">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo">don't <i>weight</i></a>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-btn">Start now</a>
</nav>
<div class="content">
<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
        echo '<h1>' . get_the_title() . '</h1>';
        the_content();
    }
}
?>
</div>
<?php wp_footer(); ?>
</body>
</html>
