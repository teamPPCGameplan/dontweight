<?php
/**
 * 404 Page
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/favicon.svg">
<title>Page Not Found — don't weight</title>
<meta name="description" content="This page doesn't exist. Visit dontweight.co.uk for clinician-led weight management, free eligibility checks, and expert medical support.">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:-apple-system,BlinkMacSystemFont,'Inter',sans-serif;background:#FAFAF9;color:#0C0A09;display:flex;align-items:center;justify-content:center;min-height:100vh;text-align:center;padding:40px}
.wrap{max-width:480px}
h1{font-size:120px;font-weight:700;color:#38BDF8;line-height:1;letter-spacing:-6px;margin-bottom:16px}
h2{font-size:28px;font-weight:700;letter-spacing:-.5px;margin-bottom:12px}
p{color:#44403C;font-size:16px;line-height:1.7;margin-bottom:32px}
a{display:inline-block;background:#38BDF8;color:#fff;border-radius:100px;padding:16px 40px;text-decoration:none;font-weight:600;font-size:15px;transition:background .2s}
a:hover{background:#0EA5E9}
</style>
</head>
<body>
<div class="wrap">
<h1>404</h1>
<h2>Page not found</h2>
<p>The page you're looking for doesn't exist or has been moved. Let's get you back on track.</p>
<a href="<?php echo esc_url(home_url('/')); ?>">Back to homepage</a>
</div>
</body>
</html>
