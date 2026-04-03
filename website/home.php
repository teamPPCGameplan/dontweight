<?php
/**

 * Description: Blog listing page for Don't Weight
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blog — Weight Management Insights | don't weight</title>
<meta name="description" content="Evidence-based articles on weight management, healthy living, and clinician-led care. Written by medical professionals, for real people.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<?php wp_head(); ?>
<style>
:root{
  --sky:#38BDF8;--sky-deep:#0EA5E9;--sky-dark:#0284C7;--sky-pale:#E0F2FE;--sky-wash:#F0F9FF;
  --white:#FFFFFF;--cream:#FAFAF9;--warm:#F5F5F4;--stone:#E7E5E4;
  --ink:#0C0A09;--charcoal:#1C1917;--slate:#44403C;
  --coral:#F97316;--coral-light:#FDBA74;
  --display:-apple-system,BlinkMacSystemFont,'Inter','SF Pro Display','Helvetica Neue',sans-serif;
  --body:-apple-system,BlinkMacSystemFont,'Inter','SF Pro Display','SF Pro Text','Helvetica Neue',sans-serif;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{background:var(--white);color:var(--ink);font-family:var(--body);font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased}

/* NAV */
.nav{position:fixed;top:0;left:0;right:0;z-index:100;height:56px;padding-top:2px;display:flex;align-items:center;justify-content:space-between;padding:0 clamp(16px,4vw,48px);background:rgba(255,255,255,.96);backdrop-filter:blur(20px);border-bottom:1px solid rgba(0,0,0,.04)}
.nav-logo{font-family:var(--display);font-size:22px;font-weight:800;color:var(--ink);text-decoration:none;letter-spacing:-.8px;white-space:nowrap;flex-shrink:0;line-height:1}.nav-logo i{color:var(--sky);font-style:italic;font-weight:300}
.nav-mid{display:flex;gap:32px;list-style:none}.nav-mid a{color:var(--slate);text-decoration:none;font-size:13px;font-weight:500}.nav-mid a.active{color:var(--sky-deep);font-weight:600}
.nav-r{display:flex;align-items:center;gap:16px}.nav-login{color:var(--ink);text-decoration:none;font-size:13px;font-weight:600}
.nav-btn{background:var(--sky);color:#fff;border:none;border-radius:100px;padding:10px 24px;font-family:var(--body);font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;white-space:nowrap}
.burger{display:none;background:none;border:none;cursor:pointer;width:32px;height:32px;position:relative;z-index:102}.burger span{display:block;width:20px;height:1.5px;background:var(--ink);position:absolute;left:6px;transition:transform .3s,opacity .2s}.burger span:nth-child(1){top:10px}.burger span:nth-child(2){top:16px}.burger span:nth-child(3){top:22px}
.mobile-menu{position:fixed;inset:0;z-index:101;background:var(--white);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:24px;opacity:0;pointer-events:none;transition:opacity .3s}.mobile-menu.open{opacity:1;pointer-events:all}.mobile-menu a{font-size:22px;font-weight:600;color:var(--ink);text-decoration:none}.mobile-menu .mm-cta{background:var(--sky);color:#fff;border:none;border-radius:100px;padding:16px 48px;font-size:16px;font-weight:700;cursor:pointer}.mm-close{position:absolute;top:16px;right:20px;background:none;border:none;font-size:32px;color:var(--ink);cursor:pointer}

/* BLOG HEADER */
.blog-header{padding:120px clamp(20px,4vw,56px) 48px;text-align:center;background:linear-gradient(180deg,var(--white) 0%,var(--sky-wash) 100%)}
.blog-header h1{font-family:var(--display);font-size:clamp(32px,5vw,56px);font-weight:700;letter-spacing:-1.5px;color:var(--ink);margin-bottom:12px}
.blog-header p{font-size:15px;color:var(--slate);max-width:480px;margin:0 auto}

/* BLOG GRID */
.blog-grid{max-width:1000px;margin:0 auto;padding:clamp(32px,5vw,56px) clamp(16px,4vw,56px);display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:28px}

/* BLOG CARD */
.blog-card{background:var(--white);border:1px solid var(--stone);border-radius:20px;overflow:hidden;transition:all .3s;text-decoration:none;color:inherit;display:flex;flex-direction:column}
.blog-card:hover{border-color:var(--sky);box-shadow:0 12px 36px rgba(56,189,248,.10);transform:translateY(-4px)}
.blog-card-img{width:100%;aspect-ratio:16/10;background:var(--sky-pale);overflow:hidden}
.blog-card-img img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
.blog-card:hover .blog-card-img img{transform:scale(1.05)}
.blog-card-img .no-img{width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--sky-wash),var(--sky-pale));font-family:var(--display);font-size:48px;color:var(--sky);opacity:.4}
.blog-card-body{padding:24px;flex:1;display:flex;flex-direction:column}
.blog-card-date{font-size:11px;color:var(--sky-deep);font-weight:600;letter-spacing:.5px;text-transform:uppercase;margin-bottom:8px}
.blog-card-body h2{font-family:var(--display);font-size:20px;font-weight:700;line-height:1.25;letter-spacing:-.3px;color:var(--ink);margin-bottom:10px}
.blog-card-body p{font-size:13px;color:var(--slate);line-height:1.7;flex:1}
.blog-card-read{display:inline-flex;align-items:center;gap:6px;margin-top:16px;font-size:13px;font-weight:600;color:var(--sky-deep)}
.blog-card-read svg{transition:transform .2s}
.blog-card:hover .blog-card-read svg{transform:translateX(3px)}

/* FOOTER */
.blog-footer{background:var(--ink);padding:48px clamp(20px,4vw,56px) 28px;color:rgba(255,255,255,.60);text-align:center}
.blog-footer a{color:var(--sky);text-decoration:none}
.blog-footer p{font-size:12px;margin-top:8px}

/* PAGINATION */
.blog-pagination{text-align:center;padding:0 20px 48px;display:flex;justify-content:center;gap:8px}
.blog-pagination a,.blog-pagination span{padding:10px 18px;border-radius:100px;font-size:13px;font-weight:600;text-decoration:none;transition:all .2s}
.blog-pagination a{color:var(--ink);border:1px solid var(--stone)}
.blog-pagination a:hover{border-color:var(--sky);color:var(--sky-deep)}
.blog-pagination span.current{background:var(--sky);color:var(--white);border:1px solid var(--sky)}

@media(max-width:960px){.nav-mid{display:none}.burger{display:block}.nav-login{display:none}}
@media(max-width:600px){.nav-btn{padding:8px 14px;font-size:11px}.nav-r{gap:8px}}
@media(max-width:480px){.nav-logo{font-size:18px}.nav-btn{padding:6px 10px;font-size:10px}}
@media(max-width:600px){
  .blog-grid{grid-template-columns:1fr;gap:16px}
  .blog-card-body{padding:18px}
  .blog-card-body h2{font-size:17px}
}
</style>
</head>
<body>

<!-- NAV -->
<?php include(get_template_directory() . '/header.php'); ?>


<!-- HEADER -->
<header class="blog-header">
  <h1>The <i style="color:var(--sky-deep);font-style:italic;font-weight:400">Journal</i></h1>
  <p>Evidence-based insights on GLP-1 medication, weight management, and living well. Written by clinicians, for real people.</p>
</header>

<!-- BLOG GRID -->
<div class="blog-grid">
  <?php
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $blog_query = new WP_Query(array(
      'post_type'      => 'post',
      'post_status'    => 'publish',
      'posts_per_page' => 9,
      'paged'          => $paged,
  ));
  
  if ($blog_query->have_posts()) :
      while ($blog_query->have_posts()) : $blog_query->the_post();
  ?>
  <a href="<?php the_permalink(); ?>" class="blog-card">
    <div class="blog-card-img">
      <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail('blog-card'); ?>
      <?php else : ?>
        <div class="no-img"><span style="font-family:var(--display);font-size:18px;font-weight:600;color:var(--ink);opacity:.25">don't <i style="color:var(--sky);font-style:italic;font-weight:400">weight</i></span></div>
      <?php endif; ?>
    </div>
    <div class="blog-card-body">
      <div class="blog-card-date"><?php echo get_the_date('j M Y'); ?></div>
      <h2><?php the_title(); ?></h2>
      <p><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
      <span class="blog-card-read">Read more <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-7-7l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
    </div>
  </a>
  <?php
      endwhile;
  else :
  ?>
  <div style="grid-column:1/-1;text-align:center;padding:80px 20px">
    <p style="font-size:18px;color:var(--slate);font-weight:500">No posts yet. Check back soon.</p>
  </div>
  <?php endif; ?>
</div>

<!-- PAGINATION -->
<?php if ($blog_query->max_num_pages > 1) : ?>
<div class="blog-pagination">
  <?php
  echo paginate_links(array(
      'total'     => $blog_query->max_num_pages,
      'current'   => $paged,
      'prev_text' => '&larr;',
      'next_text' => '&rarr;',
  ));
  ?>
</div>
<?php endif; wp_reset_postdata(); ?>

<!-- FOOTER -->
<footer class="blog-footer">
  <a href="<?php echo home_url(); ?>" style="font-family:var(--display);font-size:18px;font-weight:600;color:var(--white)">don't <span style="color:var(--sky)">weight</span></a>
  <p>&copy; <?php echo date('Y'); ?> Don't Weight Ltd. CQC Registered. All rights reserved.</p>
</footer>

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
