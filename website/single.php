<?php
/**
 * Single Post Template — Don't Weight Blog
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/favicon.svg">
<title><?php the_title(); ?> — Blog | don't weight</title>
<meta name="description" content="<?php echo esc_attr(wp_trim_words(get_the_excerpt(), 25, '...')); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<?php wp_head(); ?>
<style>
:root{
  --sky:#38BDF8;--sky-deep:#0EA5E9;--sky-dark:#0284C7;--sky-pale:#E0F2FE;--sky-wash:#F0F9FF;
  --white:#FFFFFF;--cream:#FAFAF9;--warm:#F5F5F4;--stone:#E7E5E4;
  --ink:#0C0A09;--charcoal:#1C1917;--slate:#44403C;
  --display:-apple-system,BlinkMacSystemFont,'Inter','SF Pro Display','Helvetica Neue',sans-serif;
  --body:-apple-system,BlinkMacSystemFont,'Inter','SF Pro Display','SF Pro Text','Helvetica Neue',sans-serif;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{background:var(--white);color:var(--ink);font-family:var(--body);font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased}

/* NAV */
.nav{position:fixed;top:0;left:0;right:0;z-index:100;height:56px;padding-top:2px;display:flex;align-items:center;justify-content:space-between;padding:0 clamp(16px,4vw,48px);background:rgba(255,255,255,.96);backdrop-filter:blur(20px);border-bottom:1px solid rgba(0,0,0,.04)}
.nav-logo{font-family:var(--display);font-size:22px;font-weight:800;color:var(--ink);text-decoration:none;letter-spacing:-.8px;line-height:.9;white-space:nowrap;flex-shrink:0}
.nav-logo i{color:var(--sky);font-style:italic;font-weight:300;letter-spacing:-.2px}
.nav-mid{display:flex;gap:32px;list-style:none}
.nav-mid a{color:var(--slate);text-decoration:none;font-size:13px;font-weight:500;transition:color .2s}
.nav-mid a:hover{color:var(--ink)}
.nav-mid a.active{color:var(--sky-deep);font-weight:600}
.nav-r{display:flex;align-items:center;gap:16px}
.nav-login{color:var(--ink);text-decoration:none;font-size:13px;font-weight:600}
.nav-btn{background:var(--sky);color:var(--white);border:none;border-radius:100px;padding:10px 24px;font-family:var(--body);font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;transition:background .2s}
.nav-btn:hover{background:var(--sky-deep)}
.burger{display:none;background:none;border:none;cursor:pointer;width:32px;height:32px;position:relative;z-index:102}
.burger span{display:block;width:20px;height:1.5px;background:var(--ink);position:absolute;left:6px;transition:transform .3s,opacity .2s}
.burger span:nth-child(1){top:10px}.burger span:nth-child(2){top:16px}.burger span:nth-child(3){top:22px}
.burger.open span:nth-child(1){top:16px;transform:rotate(45deg)}.burger.open span:nth-child(2){opacity:0}.burger.open span:nth-child(3){top:16px;transform:rotate(-45deg)}
.mobile-menu{position:fixed;inset:0;z-index:101;background:var(--white);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:24px;opacity:0;pointer-events:none;transition:opacity .3s}
.mobile-menu.open{opacity:1;pointer-events:all}
.mobile-menu a{font-family:var(--display);font-size:22px;font-weight:600;color:var(--ink);text-decoration:none}
.mobile-menu .mm-cta{background:var(--sky);color:var(--white);border:none;border-radius:100px;padding:16px 48px;font-family:var(--body);font-size:16px;font-weight:700;cursor:pointer;text-decoration:none}
.mm-close{position:absolute;top:max(16px,env(safe-area-inset-top,16px));right:20px;background:var(--warm);border:none;font-size:32px;color:var(--ink);cursor:pointer;width:48px;height:48px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:background .2s;z-index:102}
.mm-close:hover{background:var(--warm)}

/* ARTICLE */
.post-header{padding:120px clamp(20px,6vw,80px) 40px;max-width:720px;margin:0 auto;text-align:center}
.post-back{display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:600;color:var(--sky-deep);text-decoration:none;margin-bottom:24px;transition:gap .2s}
.post-back:hover{gap:10px}
.post-meta{font-size:11px;color:var(--sky-deep);font-weight:600;letter-spacing:.5px;text-transform:uppercase;margin-bottom:12px}
.post-header h1{font-family:var(--display);font-size:clamp(28px,4vw,44px);font-weight:700;line-height:1.15;letter-spacing:-1px;color:var(--ink);margin-bottom:16px}
.post-header .post-excerpt{font-size:16px;color:var(--slate);line-height:1.7;max-width:560px;margin:0 auto}

/* FEATURED IMAGE */
.post-hero{max-width:900px;margin:0 auto 48px;padding:0 clamp(16px,4vw,56px)}
.post-hero img{width:100%;border-radius:20px;display:block}

/* CONTENT */
.post-content{max-width:680px;margin:0 auto;padding:0 clamp(20px,6vw,80px) 64px}
.post-content p{font-size:16px;color:var(--charcoal);line-height:1.85;margin-bottom:24px}
.post-content h2{font-family:var(--display);font-size:clamp(20px,2.5vw,26px);font-weight:700;letter-spacing:-.5px;color:var(--ink);margin:40px 0 16px;line-height:1.2}
.post-content h3{font-family:var(--display);font-size:18px;font-weight:600;color:var(--ink);margin:28px 0 12px}
.post-content strong{font-weight:600;color:var(--ink)}
.post-content ul,.post-content ol{margin:0 0 24px 20px;color:var(--charcoal)}
.post-content li{margin-bottom:8px;line-height:1.7}
.post-content blockquote{border-left:3px solid var(--sky);padding:16px 24px;margin:32px 0;background:var(--sky-wash);border-radius:0 12px 12px 0;font-style:italic;color:var(--slate)}
.post-content a{color:var(--sky-deep);text-decoration:underline;text-underline-offset:2px}
.post-content img{max-width:100%;border-radius:12px;margin:24px 0}

/* CTA BANNER */
.post-cta{max-width:680px;margin:0 auto 64px;padding:0 clamp(20px,6vw,80px)}
.post-cta-inner{background:linear-gradient(135deg,var(--sky) 0%,var(--sky-deep) 100%);border-radius:20px;padding:clamp(28px,4vw,40px);text-align:center;color:var(--white)}
.post-cta-inner h3{font-family:var(--display);font-size:22px;font-weight:700;margin-bottom:8px;letter-spacing:-.3px}
.post-cta-inner p{font-size:14px;color:rgba(255,255,255,.8);margin-bottom:20px}
.post-cta-inner a{background:var(--white);color:var(--sky-dark);border-radius:100px;padding:14px 36px;font-weight:700;font-size:14px;text-decoration:none;display:inline-block;transition:transform .2s}
.post-cta-inner a:hover{transform:translateY(-2px)}

/* RELATED */
.related{max-width:900px;margin:0 auto;padding:0 clamp(16px,4vw,56px) 64px}
.related h3{font-family:var(--display);font-size:20px;font-weight:700;letter-spacing:-.3px;margin-bottom:20px;color:var(--ink)}
.related-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:20px}
.related-card{border:1px solid var(--stone);border-radius:16px;padding:20px;text-decoration:none;color:inherit;transition:all .3s}
.related-card:hover{border-color:var(--sky);transform:translateY(-2px)}
.related-card h4{font-family:var(--display);font-size:15px;font-weight:700;color:var(--ink);margin-bottom:6px;line-height:1.3}
.related-card p{font-size:12px;color:var(--slate);line-height:1.6}

/* FOOTER */
.post-footer{background:var(--ink);padding:48px clamp(20px,4vw,56px) 28px;color:rgba(255,255,255,.60);text-align:center}
.post-footer a{color:var(--sky);text-decoration:none}
.post-footer p{font-size:12px;margin-top:8px}

@media(max-width:960px){.nav-mid{display:none}.burger{display:block}}
@media(max-width:600px){
  .post-content p{font-size:15px;line-height:1.8}
  .post-hero img{border-radius:12px}
  .related-grid{grid-template-columns:1fr}
  .nav-login{display:none}
  .nav-btn{padding:7px 14px;font-size:11px}
}
</style>
</head>
<body>

<!-- NAV -->
<?php include(get_template_directory() . '/header.php'); ?>

<?php while (have_posts()) : the_post(); ?>

<!-- ARTICLE HEADER -->
<header class="post-header">
  <a href="<?php echo home_url('/blog/'); ?>" class="post-back">&larr; Back to Blog</a>
  <div class="post-meta"><?php echo get_the_date('j F Y'); ?> &middot; <?php echo ceil(str_word_count(get_the_content()) / 250); ?> min read</div>
  <h1><?php the_title(); ?></h1>
  <?php if (has_excerpt()) : ?>
    <p class="post-excerpt"><?php echo get_the_excerpt(); ?></p>
  <?php endif; ?>
</header>

<?php if (has_post_thumbnail()) : ?>
<div class="post-hero">
  <?php the_post_thumbnail('blog-hero'); ?>
</div>
<?php endif; ?>

<!-- CONTENT -->
<article class="post-content">
  <?php the_content(); ?>
</article>

<!-- CTA BANNER -->
<div class="post-cta">
  <div class="post-cta-inner">
    <h3>Ready to start?</h3>
    <p>Check if you qualify for clinician-prescribed GLP-1 medication in 30 seconds.</p>
    <a href="<?php echo home_url(); ?>">Check your eligibility &rarr;</a>
  </div>
</div>

<!-- RELATED POSTS -->
<?php
$related = new WP_Query(array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post__not_in'   => array(get_the_ID()),
    'orderby'        => 'rand',
));
if ($related->have_posts()) :
?>
<div class="related">
  <h3>Keep reading</h3>
  <div class="related-grid">
    <?php while ($related->have_posts()) : $related->the_post(); ?>
    <a href="<?php the_permalink(); ?>" class="related-card">
      <h4><?php the_title(); ?></h4>
      <p><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
    </a>
    <?php endwhile; ?>
  </div>
</div>
<?php endif; wp_reset_postdata(); ?>

<?php endwhile; ?>

<!-- FOOTER -->
<?php include(get_template_directory() . '/footer.php'); ?>

<script>
function toggleMobileMenu(){
  document.getElementById('mobileMenu').classList.toggle('open');
  document.querySelector('.burger').classList.toggle('open');
  document.body.style.overflow=document.getElementById('mobileMenu').classList.contains('open')?'hidden':'';
}
function closeMobileMenu(){
  document.getElementById('mobileMenu').classList.remove('open');
  document.querySelector('.burger').classList.remove('open');
  document.body.style.overflow='';
}
</script>
<?php wp_footer(); ?>
</body>
</html>
