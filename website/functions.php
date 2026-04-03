<?php
/**
 * Don't Weight Theme Functions
 * 
 * Minimal theme — landing page and consultation form are
 * self-contained page templates with inline CSS/JS.
 */

// Theme setup
function dontweight_setup() {
    // Page title tag support
    add_theme_support('title-tag');
    
    // Featured images (for future blog/portal)
    add_theme_support('post-thumbnails');
    
    // HTML5 markup
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));
    
    // Register nav menu (for future use)
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'dontweight'),
        'footer'  => __('Footer Menu', 'dontweight'),
    ));
}
add_action('after_setup_theme', 'dontweight_setup');

// Remove WordPress admin bar on frontend for cleaner display
add_filter('show_admin_bar', '__return_false');

// Remove unnecessary head clutter
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');

// Remove emoji scripts (not needed)
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Remove block library CSS on frontend (not using Gutenberg blocks)
function dontweight_remove_block_css() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'dontweight_remove_block_css', 100);

// Custom page template redirect: if front page is set to "Home" page, use our template
function dontweight_front_page_template($template) {
    if (is_front_page() && is_page()) {
        $custom = locate_template('page-home.php');
        if ($custom) return $custom;
    }
    return $template;
}
add_filter('template_include', 'dontweight_front_page_template');

// Add theme settings page for Stripe keys and Cal.com URL
function dontweight_settings_init() {
    register_setting('dontweight_options', 'dontweight_stripe_pk');
    register_setting('dontweight_options', 'dontweight_stripe_sk');
    register_setting('dontweight_options', 'dontweight_first_month_coupon');
    register_setting('dontweight_options', 'dontweight_calcom_url');
    register_setting('dontweight_options', 'dontweight_company_name');
    register_setting('dontweight_options', 'dontweight_gphc_number');
    register_setting('dontweight_options', 'dontweight_cqc_number');
    register_setting('dontweight_options', 'dontweight_ico_number');
}
add_action('admin_init', 'dontweight_settings_init');

function dontweight_settings_page() {
    add_menu_page(
        "Don't Weight Settings",
        "Don't Weight",
        'manage_options',
        'dontweight-settings',
        'dontweight_settings_html',
        'dashicons-heart',
        3
    );
}
add_action('admin_menu', 'dontweight_settings_page');

function dontweight_settings_html() {
    if (!current_user_can('manage_options')) return;
    
    if (isset($_GET['settings-updated'])) {
        add_settings_error('dontweight_messages', 'dontweight_message', 'Settings saved.', 'updated');
    }
    settings_errors('dontweight_messages');
    ?>
    <div class="wrap">
        <h1>Don't Weight — Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('dontweight_options'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="dontweight_stripe_pk">Stripe Publishable Key</label></th>
                    <td><input type="text" id="dontweight_stripe_pk" name="dontweight_stripe_pk" value="<?php echo esc_attr(get_option('dontweight_stripe_pk')); ?>" class="regular-text" placeholder="pk_test_..."></td>
                </tr>
                <tr>
                    <th scope="row"><label for="dontweight_stripe_sk">Stripe Secret Key</label></th>
                    <td><input type="text" id="dontweight_stripe_sk" name="dontweight_stripe_sk" value="<?php echo esc_attr(get_option('dontweight_stripe_sk')); ?>" class="regular-text" placeholder="sk_test_..."></td>
                </tr>
                <tr>
                    <th scope="row"><label for="dontweight_first_month_coupon">First Month Coupon ID</label></th>
                    <td><input type="text" id="dontweight_first_month_coupon" name="dontweight_first_month_coupon" value="<?php echo esc_attr(get_option('dontweight_first_month_coupon')); ?>" class="regular-text" placeholder="e.g. WEGOVY_FIRST_MONTH">
                    <p class="description">Stripe coupon ID for Wegovy 0.25mg first month discount (£25 off). Create in Stripe Dashboard → Coupons.</p></td>
                </tr>
                <tr>
                    <th scope="row"><label for="dontweight_calcom_url">Cal.com Booking URL</label></th>
                    <td><input type="url" id="dontweight_calcom_url" name="dontweight_calcom_url" value="<?php echo esc_attr(get_option('dontweight_calcom_url')); ?>" class="regular-text" placeholder="https://cal.com/dontweight/video-consultation"></td>
                </tr>
                <tr><td colspan="2"><hr><h2>Company Details</h2></td></tr>
                <tr>
                    <th scope="row"><label for="dontweight_company_name">Company Legal Name</label></th>
                    <td><input type="text" id="dontweight_company_name" name="dontweight_company_name" value="<?php echo esc_attr(get_option('dontweight_company_name', "Don't Weight Ltd")); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="dontweight_gphc_number">GPhC Registration Number</label></th>
                    <td><input type="text" id="dontweight_gphc_number" name="dontweight_gphc_number" value="<?php echo esc_attr(get_option('dontweight_gphc_number')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="dontweight_cqc_number">CQC Registration Number</label></th>
                    <td><input type="text" id="dontweight_cqc_number" name="dontweight_cqc_number" value="<?php echo esc_attr(get_option('dontweight_cqc_number')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="dontweight_ico_number">ICO Registration Number</label></th>
                    <td><input type="text" id="dontweight_ico_number" name="dontweight_ico_number" value="<?php echo esc_attr(get_option('dontweight_ico_number')); ?>" class="regular-text"></td>
                </tr>
            </table>
            <?php submit_button('Save Settings'); ?>
        </form>
    </div>
    <?php
}

// Helper: get consultation page URL
function dontweight_consultation_url() {
    $page = get_page_by_path('consultation');
    return $page ? get_permalink($page) : home_url('/consultation/');
}

// Blog support — custom excerpt length
function dontweight_excerpt_length($length) { return 30; }
add_filter('excerpt_length', 'dontweight_excerpt_length');

function dontweight_excerpt_more($more) { return '&hellip;'; }
add_filter('excerpt_more', 'dontweight_excerpt_more');

// Blog image sizes
add_image_size('blog-card', 600, 400, true);
add_image_size('blog-hero', 1200, 600, true);

// Create 3 starter blog posts on theme activation
function dontweight_create_starter_posts() {
    if (get_option('dontweight_starter_posts_version') >= 3) return;
    
    // Delete default "Hello world!" post
    $hello = get_page_by_title('Hello world!', OBJECT, 'post');
    if ($hello) { wp_delete_post($hello->ID, true); }
    
    $posts = array(
        array(
            'title' => 'Mounjaro vs Wegovy: Which GLP-1 Is Right for You?',
            'content' => '<p>If you\'re exploring clinician-prescribed weight loss medication in the UK, you\'ve likely come across two names: <strong>Mounjaro</strong> (tirzepatide) and <strong>Wegovy</strong> (semaglutide). Both are GLP-1 receptor agonists, both are MHRA-approved, and both have impressive clinical trial results. But they work differently — and the right choice depends on your body, your goals, and your medical history.</p>

<h2>How They Work</h2>
<p>Wegovy mimics a single gut hormone called GLP-1. It slows gastric emptying, reduces appetite, and helps regulate blood sugar. Mounjaro goes further — it\'s a dual agonist, targeting both GLP-1 and GIP receptors. This dual mechanism is why clinical trials consistently show higher average weight loss with Mounjaro.</p>

<h2>What the Trials Show</h2>
<p>The SURMOUNT trials found Mounjaro patients lost an average of 22.5% of their body weight at the highest dose, compared to roughly 15% with Wegovy in the STEP trials. However, individual results vary enormously. Some people respond brilliantly to semaglutide and less well to tirzepatide, and vice versa.</p>

<h2>Side Effects</h2>
<p>Both medications share similar GI side effects — nausea, constipation, and occasionally diarrhoea, especially during dose titration. Most people find these settle within 4-6 weeks. Your prescribing clinician will start you on a low dose and increase gradually to minimise discomfort.</p>

<h2>Cost and Availability</h2>
<p>In the UK, both are available through private clinics like Don\'t Weight. Mounjaro tends to be slightly more expensive due to its newer patent status. Your clinician will help you weigh up the clinical evidence against practical considerations like budget and treatment timeline.</p>

<h2>The Bottom Line</h2>
<p>There\'s no universally "better" option. The right medication is the one your clinician recommends based on your BMI, medical history, and how your body responds. That\'s why we always start with a proper clinical assessment — not a one-size-fits-all prescription.</p>',
            'excerpt' => 'Both are MHRA-approved GLP-1 medications with strong clinical evidence. Here\'s how they compare and what your clinician considers when recommending one.',
        ),
        array(
            'title' => 'What Actually Happens During a GLP-1 Weight Loss Consultation',
            'content' => '<p>One of the most common questions we get is: "What happens when I start?" If you\'ve never spoken to a prescribing clinician about weight loss medication, the process can feel opaque. Here\'s exactly what to expect.</p>

<h2>Step 1: The Eligibility Screener (2 Minutes)</h2>
<p>Before you speak to anyone, our online screener checks the basics: your BMI, any existing conditions, current medications, and pregnancy status. This isn\'t a formality — it\'s a genuine safety gate. If GLP-1 medication isn\'t appropriate for you, we\'ll tell you straight away rather than waste your time.</p>

<h2>Step 2: Clinical Review</h2>
<p>A UK-registered prescribing clinician reviews your full submission. They\'re looking at your complete picture: weight history, metabolic markers, lifestyle factors, and contraindications. This is a proper medical assessment, not a rubber stamp.</p>

<h2>Step 3: Prescription and Dispensing</h2>
<p>If approved, your prescription is sent to a GPhC-registered pharmacy. Your medication arrives in temperature-controlled packaging, typically within 1-2 working days. The first dose is always the lowest available — your body needs time to adjust.</p>

<h2>Step 4: Dose Titration</h2>
<p>Over the first 8-12 weeks, your dose gradually increases. This is where most of the side effects happen (and settle). Your clinician monitors your progress and adjusts the plan based on how you\'re responding — both in terms of weight loss and tolerability.</p>

<h2>What We Don\'t Do</h2>
<p>We don\'t promise specific weight loss numbers. We don\'t prescribe without proper assessment. We don\'t disappear after dispensing — ongoing clinical oversight is part of the service. And we never prescribe to anyone with a BMI under 27, regardless of willingness to pay.</p>',
            'excerpt' => 'From the 2-minute eligibility check to your first injection — here\'s the full process, no surprises.',
        ),
        array(
            'title' => 'GLP-1 Medications and Exercise: What the Research Actually Says',
            'content' => '<p>There\'s a persistent myth that GLP-1 medications are a "shortcut" that replaces diet and exercise. The reality is more nuanced — and more interesting.</p>

<h2>The Muscle Mass Question</h2>
<p>One genuine concern with rapid weight loss from any method is lean muscle loss. Studies on semaglutide found that roughly 40% of weight lost was lean mass — which sounds alarming until you realise this ratio is similar to diet-only weight loss. The key variable isn\'t the medication; it\'s whether you\'re doing resistance training alongside it.</p>

<h2>What Exercise Does That Medication Can\'t</h2>
<p>GLP-1 medications primarily reduce appetite and slow gastric emptying. They don\'t build cardiovascular fitness, improve bone density, or increase muscle strength. Exercise does all of those things. The combination of medication and regular physical activity consistently produces better outcomes than either alone.</p>

<h2>Practical Recommendations</h2>
<p>You don\'t need to become a gym enthusiast. The clinical evidence supports moderate activity: 150 minutes per week of brisk walking, plus 2 sessions of resistance training (bodyweight exercises count). The resistance work is particularly important for preserving muscle during weight loss.</p>

<h2>Energy and Appetite</h2>
<p>Many patients report an unexpected benefit: as the medication reduces food noise and compulsive eating patterns, they actually have more energy and motivation to exercise. The medication isn\'t replacing the work — it\'s removing a barrier that made the work feel impossible.</p>

<h2>Our Approach</h2>
<p>We prescribe medication as part of a holistic programme. That doesn\'t mean we hand you a gym plan and expect compliance. It means we have honest conversations about realistic, sustainable movement that fits your actual life — not an idealised version of it.</p>',
            'excerpt' => 'GLP-1 medication isn\'t a replacement for exercise — but the relationship between them is more interesting than the headlines suggest.',
        ),
        array(
            'title' => 'The Wegovy Era: Why the UK Is Finally Talking About Weight Honestly',
            'content' => '<p>Something shifted in 2024. For decades, the conversation around weight in the UK was stuck in a loop of shame, willpower mythology, and fad diets that worked for six weeks then failed for sixty. Then GLP-1 medications went mainstream — and suddenly, the country started having a different kind of conversation.</p>

<h2>The Science Caught Up</h2>
<p>What changed isn\'t just the availability of new drugs. It\'s that the science finally became impossible to ignore. Obesity is a chronic metabolic condition, not a character flaw. The hormones that regulate hunger, satiety, and fat storage operate largely outside conscious control. GLP-1 receptor agonists work because they address the biology directly — reducing appetite signals in the brain, slowing gastric emptying, and improving insulin sensitivity.</p>

<h2>The Numbers Are Striking</h2>
<p>Clinical trials for tirzepatide (Mounjaro) showed average weight loss of 22.5% of body weight at the highest dose. For semaglutide (Wegovy), it\'s around 15%. To put that in context: a 100kg person losing 22kg isn\'t just a cosmetic change. It\'s a transformation in cardiovascular risk, joint health, sleep quality, energy levels, and mental wellbeing.</p>

<h2>The Stigma Problem</h2>
<p>The backlash was predictable. "It\'s cheating." "Just eat less." "You\'ll gain it all back." These responses reveal more about our cultural relationship with weight than they do about the medication. Nobody tells a diabetic that insulin is cheating. The stigma around weight loss medication is rooted in the false belief that weight is purely a choice — and that belief is crumbling under the weight of evidence.</p>

<h2>What This Means for You</h2>
<p>If you\'ve been struggling with your weight despite genuine effort, you\'re not failing. Your biology is working against you, and there are now clinically proven tools to change the equation. The question isn\'t whether these medications work — the evidence is overwhelming. The question is whether they\'re right for your specific situation, and that\'s what a proper clinical assessment determines.</p>',
            'excerpt' => 'GLP-1 medications didn\'t just change the treatment landscape — they changed the conversation. Here\'s why that matters.',
        ),
        array(
            'title' => 'Beyond the Scale: 7 Health Benefits of Losing 10% of Your Body Weight',
            'content' => '<p>Most people think about weight loss in terms of how they look. But clinically, the most significant changes happen inside your body — and many of them kick in well before you reach your "goal weight." Losing just 10% of your body weight triggers a cascade of measurable health improvements.</p>

<h2>1. Blood Pressure Drops</h2>
<p>For every kilogram of weight lost, systolic blood pressure drops by approximately 1 mmHg. Lose 10kg and you\'re looking at a reduction equivalent to adding a blood pressure medication — without the prescription. For many people, this is enough to move from "borderline hypertension" back into the normal range.</p>

<h2>2. Blood Sugar Stabilises</h2>
<p>Weight loss of 5-10% significantly improves insulin sensitivity. For people with prediabetes, this can be the difference between developing Type 2 diabetes and avoiding it entirely. The SURMOUNT trials showed tirzepatide reduced the risk of progression to Type 2 diabetes by 94% in people with prediabetes.</p>

<h2>3. Joint Pain Reduces</h2>
<p>Every kilogram of body weight puts roughly 4kg of force through your knees when walking. Lose 10kg and that\'s 40kg less pressure on every step. People with knee osteoarthritis frequently report dramatic pain reduction after modest weight loss — often enough to delay or avoid joint replacement surgery.</p>

<h2>4. Sleep Improves</h2>
<p>Excess weight is the single biggest risk factor for obstructive sleep apnoea. Weight loss reduces the fat deposits around the airway that cause obstruction. Many patients on GLP-1 medication report sleeping better within weeks — before they\'ve even lost significant weight — likely due to reduced inflammation and improved metabolic function.</p>

<h2>5. Energy Increases</h2>
<p>This one sounds counterintuitive — you\'re eating less, so shouldn\'t you have less energy? In practice, most people experience the opposite. Better sleep, reduced inflammation, improved blood sugar regulation, and less physical strain all contribute to significantly higher daily energy levels.</p>

<h2>6. Liver Health Improves</h2>
<p>Non-alcoholic fatty liver disease (NAFLD) affects roughly 1 in 3 UK adults. Weight loss of 10% or more can reverse liver inflammation and even fibrosis. Recent trials specifically studying GLP-1 medications for liver disease have shown remarkable results — this is an active area of research with new data emerging regularly.</p>

<h2>7. Mental Health Benefits</h2>
<p>The relationship between weight and mental health is complex and bidirectional. But the clinical data is clear: people who lose weight through GLP-1 medication report improvements in anxiety, depression symptoms, self-confidence, and overall quality of life. Part of this is physical — reduced inflammation affects brain chemistry. Part of it is the psychological relief of finally having something that works.</p>

<h2>The Takeaway</h2>
<p>You don\'t need to lose 30kg to see meaningful health improvements. A 10% reduction — which for most people on GLP-1 medication happens within the first 3-4 months — delivers measurable, clinically significant benefits across nearly every organ system. The scale number matters less than what\'s happening inside.</p>',
            'excerpt' => 'You don\'t need to hit a goal weight to see real health changes. Losing just 10% triggers improvements across blood pressure, blood sugar, joints, sleep, and more.',
        ),
        array(
            'title' => 'What to Eat on Mounjaro or Wegovy: A No-Nonsense UK Guide',
            'content' => '<p>One of the first questions people ask after starting GLP-1 medication is "what should I eat?" The honest answer is less dramatic than the internet makes it sound — but there are some practical things worth knowing.</p>

<h2>Your Appetite Will Change</h2>
<p>The most immediate effect of both Mounjaro and Wegovy is reduced appetite. Most people find they\'re simply not as hungry, and the mental "food noise" — that constant background hum of thinking about what to eat next — gets significantly quieter. This is the medication working as intended. Don\'t fight it, but don\'t skip meals entirely either.</p>

<h2>Protein First</h2>
<p>This is the single most important dietary adjustment. When you\'re eating less overall, you need to make sure a higher proportion of what you eat is protein. Aim for 1.2-1.6g per kg of body weight daily. Why? Protein preserves muscle mass during weight loss, keeps you feeling fuller for longer, and has the highest thermic effect of any macronutrient — meaning your body uses more energy to digest it.</p>

<p>Practical UK sources: chicken breast, tinned tuna, eggs, Greek yoghurt (Fage 0% is brilliant), cottage cheese, lean mince, prawns, tofu, edamame beans. If you\'re struggling to hit your target, a simple whey protein shake fills the gap.</p>

<h2>Smaller Portions, More Often</h2>
<p>GLP-1 medications slow gastric emptying — food sits in your stomach longer. This means large meals can feel uncomfortable, and you\'re more likely to experience nausea if you overeat. Most people find three smaller meals plus one or two protein-rich snacks works better than traditional three large meals.</p>

<h2>What to Avoid (and Why)</h2>
<p>High-fat, greasy foods tend to worsen nausea. Sugary drinks are empty calories your reduced appetite budget can\'t afford. Alcohol hits harder on GLP-1 medication — your tolerance drops noticeably, and the calories add up fast. Ultra-processed foods are worth minimising not because of any dramatic toxicity but because they\'re calorie-dense and nutrient-poor — and when you\'re eating less, every meal needs to count.</p>

<h2>Hydration Matters More Than You Think</h2>
<p>Reduced appetite often means reduced fluid intake too, and GLP-1 medications can cause constipation. Aim for 2 litres of water daily minimum. Herbal teas, sparkling water, and sugar-free squash all count. Coffee is fine — in fact, caffeine has a mild appetite-suppressing effect that complements the medication.</p>

<h2>A Typical Day</h2>
<p><strong>Breakfast:</strong> Two eggs scrambled on one slice of wholemeal toast, or Greek yoghurt with berries and a sprinkle of granola.</p>
<p><strong>Lunch:</strong> Chicken salad with mixed leaves, cucumber, cherry tomatoes, and a drizzle of olive oil. Or a tuna and sweetcorn jacket potato (half portion).</p>
<p><strong>Dinner:</strong> Salmon fillet with roasted vegetables and a small portion of brown rice. Or lean beef stir-fry with plenty of veg.</p>
<p><strong>Snacks:</strong> Protein shake, handful of almonds, apple with peanut butter, cottage cheese with cucumber.</p>

<h2>Don\'t Overcomplicate It</h2>
<p>You don\'t need a meal plan, a special cookbook, or a subscription box. The medication handles the hard part — reducing the drive to overeat. Your job is to make sure what you do eat is reasonably nutritious, protein-rich, and enjoyable. Sustainable beats perfect, every time.</p>',
            'excerpt' => 'GLP-1 medication changes your appetite — here\'s how to eat well with it. Protein-first, practical UK portions, and a realistic daily plan.',
        ),
    );
    
    foreach ($posts as $post_data) {
        $existing = get_page_by_title($post_data['title'], OBJECT, 'post');
        if (!$existing) {
            wp_insert_post(array(
                'post_title'   => $post_data['title'],
                'post_content' => $post_data['content'],
                'post_excerpt' => $post_data['excerpt'],
                'post_status'  => 'publish',
                'post_type'    => 'post',
                'post_author'  => 1,
            ));
        }
    }
    
    // Create Blog page if it doesn't exist
    $blog_page = get_page_by_path('blog');
    if (!$blog_page) {
        $blog_id = wp_insert_post(array(
            'post_title'  => 'Blog',
            'post_name'   => 'blog',
            'post_status' => 'publish',
            'post_type'   => 'page',
            'post_author' => 1,
        ));
    } else {
        $blog_id = $blog_page->ID;
    }
    
    // Set Blog page as the Posts page in WP settings
    if ($blog_id && !get_option('page_for_posts')) {
        update_option('page_for_posts', $blog_id);
        update_option('show_on_front', 'page');
    }
    
    // Also ensure front page is set if Home page exists
    $home_page = get_page_by_path('home');
    if (!$home_page) {
        $home_page = get_page_by_title('Home');
    }
    if ($home_page && !get_option('page_on_front')) {
        update_option('page_on_front', $home_page->ID);
        update_option('show_on_front', 'page');
    }
    
    // Create DW360 page if it doesn't exist
    $dw360_page = get_page_by_path('dw360');
    if (!$dw360_page) {
        wp_insert_post(array(
            'post_title'    => 'DW360 Health Check',
            'post_name'     => 'dw360',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => 1,
            'page_template' => 'page-dw360.php',
        ));
    }
    
    update_option('dontweight_starter_posts_version', 3);
}
add_action('after_switch_theme', 'dontweight_create_starter_posts');
add_action('admin_init', 'dontweight_create_starter_posts');

// ═══════════════════════════════════════════
// APPLICATION STORAGE + EMAIL NOTIFICATION
// ═══════════════════════════════════════════

// Custom post type for applications
function dontweight_register_applications() {
    register_post_type('dw_application', array(
        'labels' => array(
            'name'          => 'Applications',
            'singular_name' => 'Application',
            'menu_name'     => 'Applications',
            'all_items'     => 'All Applications',
            'add_new'       => 'Add New',
            'add_new_item'  => 'Add New Application',
            'edit_item'     => 'View Application',
            'view_item'     => 'View Application',
            'search_items'  => 'Search Applications',
        ),
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-clipboard',
        'menu_position'=> 4,
        'supports'     => array('title', 'editor', 'custom-fields'),
        'capability_type' => 'post',
    ));
}
add_action('init', 'dontweight_register_applications');

// AJAX handler — saves application + sends email
function dontweight_submit_application() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'dw_submit_app')) {
        wp_send_json_error('Security check failed.', 403);
    }
    
    $data = array();
    $fields = array('first_name','last_name','email','phone','bmi','dob','gender',
                     'height_cm','weight_kg','ethnicity','conditions','medications',
                     'prev_medication','treatment_choice','stage','answers');
    
    foreach ($fields as $f) {
        $data[$f] = isset($_POST[$f]) ? sanitize_text_field($_POST[$f]) : '';
    }
    // 'answers' can be longer text
    if (isset($_POST['answers'])) {
        $data['answers'] = sanitize_textarea_field($_POST['answers']);
    }
    
    $stage = $data['stage'] ?: 'eligibility';
    $name = trim($data['first_name'] . ' ' . $data['last_name']);
    if (!$name) $name = 'Unknown';
    
    // Build readable content
    $content = "=== Application Details ===\n\n";
    $content .= "Name: {$name}\n";
    $content .= "Email: {$data['email']}\n";
    $content .= "Phone: {$data['phone']}\n";
    $content .= "BMI: {$data['bmi']}\n";
    $content .= "Date of Birth: {$data['dob']}\n";
    $content .= "Gender: {$data['gender']}\n";
    $content .= "Height: {$data['height_cm']}cm\n";
    $content .= "Weight: {$data['weight_kg']}kg\n";
    $content .= "Ethnicity: {$data['ethnicity']}\n";
    $content .= "Conditions: {$data['conditions']}\n";
    $content .= "Current Medications: {$data['medications']}\n";
    $content .= "Previous Weight Loss Medication: {$data['prev_medication']}\n";
    $content .= "Treatment Choice: {$data['treatment_choice']}\n";
    $content .= "Stage: {$stage}\n";
    $content .= "\n=== Full Answers ===\n\n";
    $content .= $data['answers'];
    
    // Save as custom post
    $post_id = wp_insert_post(array(
        'post_type'    => 'dw_application',
        'post_title'   => $name . ' — ' . $data['email'] . ' (' . date('j M Y H:i') . ')',
        'post_content' => $content,
        'post_status'  => 'publish',
    ));
    
    if ($post_id) {
        // Save key fields as meta for easy filtering
        foreach ($data as $key => $val) {
            if ($val) update_post_meta($post_id, '_dw_' . $key, $val);
        }
        update_post_meta($post_id, '_dw_submitted', current_time('mysql'));
        update_post_meta($post_id, '_dw_ip', $_SERVER['REMOTE_ADDR'] ?? '');
    }
    
    // Send email notification
    $to = 'hello@dontweight.co.uk';
    $subject = "[Don't Weight] New {$stage} application — {$name}";
    
    $email_body = "New application received:\n\n";
    $email_body .= "Name: {$name}\n";
    $email_body .= "Email: {$data['email']}\n";
    $email_body .= "Phone: {$data['phone']}\n";
    $email_body .= "BMI: {$data['bmi']}\n";
    $email_body .= "Treatment: {$data['treatment_choice']}\n";
    $email_body .= "Stage: {$stage}\n\n";
    $email_body .= "--- Full Details ---\n\n";
    $email_body .= $content;
    $email_body .= "\n\nView in WordPress: " . admin_url("post.php?post={$post_id}&action=edit");
    
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    wp_mail($to, $subject, $email_body, $headers);
    
    wp_send_json_success(array(
        'message' => 'Application submitted successfully.',
        'id'      => $post_id,
    ));
}
add_action('wp_ajax_dw_submit_app', 'dontweight_submit_application');
add_action('wp_ajax_nopriv_dw_submit_app', 'dontweight_submit_application');

// Pass AJAX URL and nonce to frontend
function dontweight_ajax_vars() {
    if (is_front_page() || is_page('consultation') || is_page('home') || is_page('treatments') || is_page('dw360')) {
        echo '<script>var dwAjax={url:"' . admin_url('admin-ajax.php') . '",nonce:"' . wp_create_nonce('dw_submit_app') . '"};</script>';
    }
}
add_action('wp_head', 'dontweight_ajax_vars');

// Also output for standalone templates that bypass wp_head
function dontweight_get_ajax_script() {
    return '<script>var dwAjax={url:"' . admin_url('admin-ajax.php') . '",nonce:"' . wp_create_nonce('dw_submit_app') . '"};</script>';
}

// Admin columns for applications
function dontweight_app_columns($columns) {
    return array(
        'cb'         => '<input type="checkbox">',
        'title'      => 'Applicant',
        'dw_email'   => 'Email',
        'dw_bmi'     => 'BMI',
        'dw_treatment'=> 'Treatment',
        'dw_stage'   => 'Stage',
        'date'       => 'Date',
    );
}
add_filter('manage_dw_application_posts_columns', 'dontweight_app_columns');

function dontweight_app_column_data($column, $post_id) {
    switch ($column) {
        case 'dw_email':
            echo esc_html(get_post_meta($post_id, '_dw_email', true));
            break;
        case 'dw_bmi':
            echo esc_html(get_post_meta($post_id, '_dw_bmi', true));
            break;
        case 'dw_treatment':
            echo esc_html(get_post_meta($post_id, '_dw_treatment_choice', true));
            break;
        case 'dw_stage':
            $stage = get_post_meta($post_id, '_dw_stage', true);
            $colors = array('eligibility' => '#F59E0B', 'consultation' => '#3B82F6', 'payment' => '#10B981');
            $color = $colors[$stage] ?? '#6B7280';
            echo '<span style="background:' . $color . ';color:#fff;padding:2px 10px;border-radius:100px;font-size:11px;font-weight:600">' . esc_html(ucfirst($stage)) . '</span>';
            break;
    }
}
add_action('manage_dw_application_posts_custom_column', 'dontweight_app_column_data', 10, 2);

// ═══════════════════════════════════════════
// STRIPE CHECKOUT INTEGRATION
// ═══════════════════════════════════════════

function dontweight_create_checkout_session() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'dw_stripe_checkout')) {
        wp_send_json_error('Security check failed.', 403);
    }
    
    $sk = get_option('dontweight_stripe_sk', '');
    if (!$sk) {
        wp_send_json_error('Stripe not configured. Please add your keys in Settings → Don\'t Weight.', 500);
    }
    
    $checkout_type = sanitize_text_field($_POST['checkout_type'] ?? 'treatment');
    $product_id    = sanitize_text_field($_POST['treatment'] ?? 'mounjaro');
    $email         = sanitize_email($_POST['email'] ?? '');
    $name          = sanitize_text_field($_POST['name'] ?? '');
    
    // ─── TREATMENT SUBSCRIPTIONS ───
    // Monthly recurring. Wegovy 0.25mg has discounted first month (coupon applied in Stripe).
    // All amounts in pence. 'ongoing' = recurring price. 'first' = first month if different.
    $treatments = array(
        'mounjaro'     => array('ongoing' => 17000, 'first' => 15000, 'name' => 'Mounjaro 2.5mg — Monthly Treatment'),
        'mounjaro-5'   => array('ongoing' => 18500, 'first' => 18500, 'name' => 'Mounjaro 5mg — Monthly Treatment'),
        'mounjaro-7.5' => array('ongoing' => 25000, 'first' => 25000, 'name' => 'Mounjaro 7.5mg — Monthly Treatment'),
        'mounjaro-10'  => array('ongoing' => 27500, 'first' => 27500, 'name' => 'Mounjaro 10mg — Monthly Treatment'),
        'mounjaro-12.5'=> array('ongoing' => 28500, 'first' => 28500, 'name' => 'Mounjaro 12.5mg — Monthly Treatment'),
        'mounjaro-15'  => array('ongoing' => 31000, 'first' => 31000, 'name' => 'Mounjaro 15mg — Monthly Treatment'),
        'wegovy'       => array('ongoing' => 13900, 'first' => 11400, 'name' => 'Wegovy 0.25mg — Monthly Treatment'),
        'wegovy-0.5'   => array('ongoing' => 13900, 'first' => 13900, 'name' => 'Wegovy 0.5mg — Monthly Treatment'),
        'wegovy-1'     => array('ongoing' => 13900, 'first' => 13900, 'name' => 'Wegovy 1mg — Monthly Treatment'),
        'wegovy-1.7'   => array('ongoing' => 19000, 'first' => 19000, 'name' => 'Wegovy 1.7mg — Monthly Treatment'),
        'wegovy-2.4'   => array('ongoing' => 21500, 'first' => 21500, 'name' => 'Wegovy 2.4mg — Monthly Treatment'),
    );
    
    // ─── HEALTH CHECK ONE-OFF PAYMENTS ───
    $healthchecks = array(
        'hc-baseline'        => array('amount' => 14900, 'name' => 'Health Check — Baseline'),
        'hc-baseline-annual' => array('amount' => 24900, 'name' => 'Health Check — Baseline Annual (2× visits)'),
        'hc-standard'        => array('amount' => 59900, 'name' => 'Health Check — Standard'),
        'hc-premium'         => array('amount' => 99900, 'name' => 'Health Check — Premium'),
        'hc-standard-annual' => array('amount' => 100000, 'name' => 'Health Check — Standard Annual (2× visits)'),
        'hc-premium-annual'  => array('amount' => 180000, 'name' => 'Health Check — Premium Annual (2× visits)'),
    );
    
    $headers = array(
        'Authorization' => 'Basic ' . base64_encode($sk . ':'),
        'Content-Type'  => 'application/x-www-form-urlencoded',
    );
    
    if ($checkout_type === 'healthcheck') {
        // ─── ONE-OFF PAYMENT for health checks ───
        $hc = $healthchecks[$product_id] ?? $healthchecks['hc-standard'];
        $success_url = home_url('/dw360/?booked=1&session_id={CHECKOUT_SESSION_ID}');
        $cancel_url  = home_url('/dw360/?cancelled=1');
        
        $body = array(
            'payment_method_types[]' => 'card',
            'mode' => 'payment',
            'success_url' => $success_url,
            'cancel_url'  => $cancel_url,
            'line_items[0][price_data][currency]' => 'gbp',
            'line_items[0][price_data][product_data][name]' => $hc['name'],
            'line_items[0][price_data][unit_amount]' => $hc['amount'],
            'line_items[0][quantity]' => 1,
        );
        
        if ($email) $body['customer_email'] = $email;
        if ($name) $body['metadata[patient_name]'] = $name;
        $body['metadata[product]'] = $product_id;
        $body['metadata[type]'] = 'healthcheck';
        
    } else {
        // ─── SUBSCRIPTION for treatments ───
        $t = $treatments[$product_id] ?? $treatments['mounjaro'];
        $success_url = home_url('/consultation/?paid=1&session_id={CHECKOUT_SESSION_ID}');
        $cancel_url  = home_url('/consultation/?cancelled=1');
        
        $body = array(
            'payment_method_types[]' => 'card',
            'mode' => 'subscription',
            'success_url' => $success_url,
            'cancel_url'  => $cancel_url,
            'line_items[0][price_data][currency]' => 'gbp',
            'line_items[0][price_data][product_data][name]' => $t['name'],
            'line_items[0][price_data][unit_amount]' => $t['ongoing'],
            'line_items[0][price_data][recurring][interval]' => 'month',
            'line_items[0][quantity]' => 1,
            'subscription_data[metadata][treatment]' => $product_id,
        );
        
        // Apply first-month discount coupon if first month differs from ongoing
        if ($t['first'] < $t['ongoing']) {
            $coupon_id = get_option('dontweight_first_month_coupon', '');
            if ($coupon_id) {
                $body['discounts[0][coupon]'] = $coupon_id;
            }
        }
        
        if ($email) $body['customer_email'] = $email;
        if ($name) $body['metadata[patient_name]'] = $name;
        $body['metadata[product]'] = $product_id;
        $body['metadata[type]'] = 'treatment';
    }
    
    $response = wp_remote_post('https://api.stripe.com/v1/checkout/sessions', array(
        'headers' => $headers,
        'body'    => $body,
        'timeout' => 30,
    ));
    
    if (is_wp_error($response)) {
        wp_send_json_error('Payment service unavailable. Please try again.', 500);
    }
    
    $data = json_decode(wp_remote_retrieve_body($response), true);
    
    if (isset($data['url'])) {
        wp_send_json_success(array('url' => $data['url']));
    } else {
        $err = $data['error']['message'] ?? 'Unknown error';
        wp_send_json_error($err, 500);
    }
}
add_action('wp_ajax_dw_stripe_checkout', 'dontweight_create_checkout_session');
add_action('wp_ajax_nopriv_dw_stripe_checkout', 'dontweight_create_checkout_session');

// Output Stripe nonce for consultation and health check pages
function dontweight_stripe_vars() {
    if (is_page('consultation') || is_page('dw360')) {
        $pk = get_option('dontweight_stripe_pk', '');
        echo '<script>var dwStripe={pk:"' . esc_js($pk) . '",ajaxUrl:"' . admin_url('admin-ajax.php') . '",nonce:"' . wp_create_nonce('dw_stripe_checkout') . '"};</script>';
    }
}
add_action('wp_head', 'dontweight_stripe_vars');
// ═══════════════════════════════════════════

function dontweight_customizer($wp_customize) {
    // Section
    $wp_customize->add_section('dw_carousel', array(
        'title'    => 'Member Carousel',
        'priority' => 30,
        'description' => 'Manage the member photos carousel on the homepage. Upload images via Media Library, then paste the URL here. Set name, location, and weight lost for each.',
    ));
    
    // Up to 8 members
    $defaults = array(
        array('Sarah, 34', 'Bristol', '-18kg'),
        array('Tom, 28', 'Manchester', '-26kg'),
        array('Charlotte, 31', 'Brighton', '-16kg'),
        array('Marcus, 55', 'London', '-22kg'),
        array('Lisa, 42', 'Reading', '-20kg+'),
        array('Brian, 63', 'Exeter', '-19kg'),
        array('Mei, 39', 'Edinburgh', '-15kg'),
        array('Hannah, 64', 'Oxford', '-21kg'),
    );
    
    for ($i = 1; $i <= 8; $i++) {
        $d = $defaults[$i-1];
        
        // Image
        $wp_customize->add_setting("dw_member_{$i}_image", array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "dw_member_{$i}_image", array(
            'label'   => "Member {$i} — Photo",
            'section' => 'dw_carousel',
        )));
        
        // Name
        $wp_customize->add_setting("dw_member_{$i}_name", array('default' => $d[0], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("dw_member_{$i}_name", array(
            'label'   => "Member {$i} — Name & Age",
            'section' => 'dw_carousel',
            'type'    => 'text',
            'description' => 'e.g. "Sarah, 34"',
        ));
        
        // Location
        $wp_customize->add_setting("dw_member_{$i}_location", array('default' => $d[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("dw_member_{$i}_location", array(
            'label'   => "Member {$i} — Location",
            'section' => 'dw_carousel',
            'type'    => 'text',
        ));
        
        // Weight lost
        $wp_customize->add_setting("dw_member_{$i}_lost", array('default' => $d[2], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("dw_member_{$i}_lost", array(
            'label'   => "Member {$i} — Weight Lost",
            'section' => 'dw_carousel',
            'type'    => 'text',
            'description' => 'e.g. "-18kg"',
        ));
    }
}
add_action('customize_register', 'dontweight_customizer');

// Helper: get carousel members as array
function dontweight_get_members() {
    $members = array();
    $img_dir = get_template_directory_uri() . '/img/';
    
    // Defaults — used when no customizer values are saved
    $defaults = array(
        1 => array('name' => 'Sarah, 38',        'location' => 'Bristol',    'lost' => '-18kg',  'image' => 'sarah-34-bristol.jpg'),
        2 => array('name' => 'Tom, 28',         'location' => 'Manchester', 'lost' => '-26kg',  'image' => 'tom-28-manchester.jpg'),
        3 => array('name' => 'Charlotte, 31',   'location' => 'Brighton',   'lost' => '-18kg',  'image' => 'charlotte-31-brighton.jpg'),
        4 => array('name' => 'Marcus, 45',      'location' => 'London',     'lost' => '-22kg',  'image' => 'marcus-55-london.jpg'),
        5 => array('name' => 'Lisa, 42',        'location' => 'Reading',    'lost' => '-20kg+', 'image' => 'lisa-42-reading.jpg'),
        6 => array('name' => 'Brian, 63',       'location' => 'Exeter',     'lost' => '-19kg',  'image' => 'brian-63-exeter.jpg'),
        7 => array('name' => 'Mei, 39',         'location' => 'Edinburgh',  'lost' => '-15kg',  'image' => 'mei-39-edinburgh.jpg'),
        8 => array('name' => 'Hannah, 64',    'location' => 'Oxford',     'lost' => '-21kg',  'image' => 'hannah-35-oxford.jpg'),
    );
    
    for ($i = 1; $i <= 8; $i++) {
        $d = $defaults[$i];
        $name     = get_theme_mod("dw_member_{$i}_name",     $d['name']);
        $location = get_theme_mod("dw_member_{$i}_location", $d['location']);
        $lost     = get_theme_mod("dw_member_{$i}_lost",     $d['lost']);
        $image    = get_theme_mod("dw_member_{$i}_image",    '');
        
        // Use fallback image if no custom one set
        if (!$image) {
            $image = $img_dir . $d['image'];
        }
        
        if ($image && $name) {
            $members[] = array(
                'image'    => $image,
                'name'     => $name,
                'location' => $location,
                'lost'     => $lost,
            );
        }
    }
    
    return $members;
}

// ═══════════════════════════════════════════════════════════════
// AUTO-CREATE LEGAL & CONTACT PAGES ON THEME ACTIVATION
// ═══════════════════════════════════════════════════════════════
function dontweight_create_legal_pages() {
    if (get_option('dontweight_legal_pages_v1')) return;

    $pages = array(

        // ── PRIVACY POLICY ──
        'privacy-policy' => array(
            'title' => 'Privacy Policy',
            'content' => '
<h2>Introduction</h2>
<p>Don\'t Weight Ltd ("we", "us", "our") is committed to protecting your personal data. This Privacy Policy explains how we collect, use, store and protect information when you use our website dontweight.co.uk and our services.</p>
<p>We are the data controller for the purposes of the UK General Data Protection Regulation (UK GDPR) and the Data Protection Act 2018. Our registered address is Don\'t Weight Ltd, registered in England &amp; Wales.</p>

<h2>Information We Collect</h2>
<h3>Information you provide directly</h3>
<ul>
<li><strong>Account &amp; consultation data:</strong> name, email address, date of birth, biological sex, height, weight, BMI, ethnicity, and medical history provided during your eligibility assessment</li>
<li><strong>Health data:</strong> information about existing medical conditions, current medications, allergies, and treatment preferences (this is special category data under UK GDPR)</li>
<li><strong>Contact information:</strong> email address, phone number, postal address for delivery</li>
<li><strong>Payment information:</strong> processed securely by our third-party payment provider — we do not store full card details</li>
</ul>

<h3>Information collected automatically</h3>
<ul>
<li><strong>Device &amp; usage data:</strong> IP address, browser type, operating system, pages visited, time spent on site</li>
<li><strong>Cookies:</strong> see our <a href="/cookie-policy/">Cookie Policy</a> for full details</li>
<li><strong>Analytics data:</strong> anonymised usage patterns to improve our service</li>
</ul>

<h2>How We Use Your Information</h2>
<p>We process your personal data for the following purposes:</p>
<ul>
<li><strong>Healthcare provision:</strong> to assess your eligibility for treatment, prescribe medication, and provide ongoing clinical care (legal basis: performance of a contract and vital interests)</li>
<li><strong>Regulatory compliance:</strong> to meet our obligations under CQC regulations, MHRA requirements, and pharmacy legislation (legal basis: legal obligation)</li>
<li><strong>Communication:</strong> to send you treatment updates, appointment reminders, and important safety information (legal basis: legitimate interest and/or consent)</li>
<li><strong>Service improvement:</strong> to analyse anonymised data and improve our platform (legal basis: legitimate interest)</li>
<li><strong>Marketing:</strong> only with your explicit consent, which you can withdraw at any time</li>
</ul>

<h2>Special Category Data</h2>
<p>Health data is classified as special category data under UK GDPR. We process this data under Article 9(2)(h) — for the purposes of preventive or occupational medicine, medical diagnosis, and the provision of health care treatment. Your health data is only accessible to our registered clinicians and authorised clinical staff.</p>

<h2>Data Sharing</h2>
<p>We may share your data with:</p>
<ul>
<li><strong>Prescribing clinicians:</strong> UK-registered doctors and pharmacists who review your consultation</li>
<li><strong>Pharmacy partners:</strong> to dispense and deliver your medication</li>
<li><strong>Payment processors:</strong> to process transactions securely</li>
<li><strong>Regulatory bodies:</strong> CQC, MHRA, GPhC, or the ICO if required by law</li>
<li><strong>Your GP:</strong> only with your explicit consent, or where required for patient safety</li>
</ul>
<p>We will never sell your personal data to third parties.</p>

<h2>Data Retention</h2>
<p>We retain your health records for a minimum of 10 years from the date of your last consultation, in line with NHS and regulatory guidance. Account data is retained for the duration of your account plus 2 years. You may request deletion of non-medical data at any time.</p>

<h2>Your Rights</h2>
<p>Under UK GDPR, you have the right to:</p>
<ul>
<li>Access your personal data (Subject Access Request)</li>
<li>Rectify inaccurate data</li>
<li>Request erasure (where not overridden by legal retention requirements)</li>
<li>Restrict or object to processing</li>
<li>Data portability</li>
<li>Withdraw consent at any time</li>
<li>Lodge a complaint with the Information Commissioner\'s Office (ICO)</li>
</ul>

<h2>Data Security</h2>
<p>We implement appropriate technical and organisational measures to protect your data, including encryption in transit (TLS 1.2+), encrypted storage, access controls, regular security audits, and staff training on data protection.</p>

<h2>International Transfers</h2>
<p>Your data is primarily stored and processed within the UK and EEA. Where any data is processed outside the UK, we ensure appropriate safeguards are in place as required by UK GDPR.</p>

<h2>Contact Us</h2>
<p>For any data protection enquiries or to exercise your rights:</p>
<ul>
<li>Email: <a href="mailto:privacy@dontweight.co.uk">privacy@dontweight.co.uk</a></li>
<li>Post: Data Protection Officer, Don\'t Weight Ltd</li>
</ul>
<p>You also have the right to complain to the Information Commissioner\'s Office: <a href="https://ico.org.uk" target="_blank" rel="noopener">ico.org.uk</a></p>
'),

        // ── TERMS & CONDITIONS ──
        'terms' => array(
            'title' => 'Terms & Conditions',
            'content' => '
<h2>About These Terms</h2>
<p>These Terms and Conditions ("Terms") govern your use of the dontweight.co.uk website and all services provided by Don\'t Weight Ltd ("we", "us", "our"). By using our website or services, you agree to be bound by these Terms. If you do not agree, please do not use our services.</p>

<h2>Our Services</h2>
<p>Don\'t Weight provides an online platform connecting patients with UK-registered prescribing clinicians for the purpose of weight management consultations and, where clinically appropriate, the prescribing of MHRA-approved medications. We are registered with the Care Quality Commission (CQC) and comply with all applicable UK healthcare regulations.</p>
<p>Our services are available to UK residents aged 18 and over. By using our services, you confirm that you meet these eligibility criteria.</p>

<h2>Medical Disclaimer</h2>
<p>Our platform facilitates access to clinician-prescribed weight loss medication. All prescribing decisions are made by independent, UK-registered clinicians based on their professional medical judgement. We do not guarantee that you will be prescribed medication — eligibility is determined by clinical assessment.</p>
<p>Our service does not replace your GP or NHS care. We strongly recommend maintaining regular contact with your GP, and we may contact your GP with your consent where clinically appropriate.</p>

<h2>Eligibility &amp; Accuracy</h2>
<p>You must provide accurate, truthful, and complete information during your consultation. Providing false or misleading health information may endanger your safety and will result in termination of your account. All clinical decisions rely on the accuracy of the information you provide.</p>

<h2>Prescriptions &amp; Medication</h2>
<ul>
<li>All prescriptions are issued by UK-registered prescribers at their sole clinical discretion</li>
<li>Medications are dispensed by registered UK pharmacies and delivered to your specified UK address</li>
<li>You must follow the dosage and administration instructions provided by your clinician</li>
<li>You must report any side effects or adverse reactions promptly via our support channels</li>
<li>Medications are prescribed for your personal use only and must not be shared with others</li>
</ul>

<h2>Pricing &amp; Payment</h2>
<p>All prices are displayed in GBP and include applicable VAT. Payment is taken at the point of order. We reserve the right to update pricing — any changes will not affect existing orders.</p>
<ul>
<li>If you are found not to be clinically eligible after payment, you will receive a full refund</li>
<li>Refunds for medications that have been dispensed and dispatched are not available due to pharmaceutical regulations</li>
<li>You may pause or cancel your subscription at any time with no penalty</li>
</ul>

<h2>Cancellation &amp; Refunds</h2>
<p>You may cancel your treatment plan at any time by contacting <a href="mailto:support@dontweight.co.uk">support@dontweight.co.uk</a>. Refunds are processed in accordance with the Consumer Contracts Regulations 2013, subject to pharmaceutical dispensing regulations. Once medication has been dispensed by our pharmacy, it cannot be returned or refunded.</p>

<h2>Your Responsibilities</h2>
<p>You agree to:</p>
<ul>
<li>Provide accurate health and personal information</li>
<li>Attend follow-up consultations as recommended by your clinician</li>
<li>Report any changes to your health, medications, or circumstances</li>
<li>Use medications only as prescribed</li>
<li>Keep your account credentials secure</li>
<li>Not share prescribed medication with any other person</li>
</ul>

<h2>Intellectual Property</h2>
<p>All content on dontweight.co.uk — including text, graphics, logos, images, and software — is the property of Don\'t Weight Ltd and is protected by UK and international copyright law. You may not reproduce, distribute, or create derivative works without our written permission.</p>

<h2>Limitation of Liability</h2>
<p>To the fullest extent permitted by law, Don\'t Weight Ltd shall not be liable for any indirect, incidental, or consequential damages arising from your use of our services. Nothing in these Terms excludes or limits our liability for death or personal injury caused by negligence, fraud, or any liability which cannot be excluded by law.</p>

<h2>Changes to These Terms</h2>
<p>We may update these Terms from time to time. Material changes will be communicated via email or prominent notice on our website. Continued use of our services after changes constitutes acceptance of the updated Terms.</p>

<h2>Governing Law</h2>
<p>These Terms are governed by the laws of England and Wales. Any disputes shall be subject to the exclusive jurisdiction of the courts of England and Wales.</p>

<h2>Contact</h2>
<p>For questions about these Terms, please contact <a href="mailto:hello@dontweight.co.uk">hello@dontweight.co.uk</a>.</p>
'),

        // ── COMPLAINTS PROCEDURE ──
        'complaints' => array(
            'title' => 'Complaints Procedure',
            'content' => '
<h2>Our Commitment</h2>
<p>At Don\'t Weight, we are committed to providing a high-quality service. However, we recognise that sometimes things may not meet your expectations. We take all complaints seriously and view them as an opportunity to improve. This procedure outlines how to raise a concern and what you can expect from us.</p>

<h2>How to Make a Complaint</h2>
<p>You can submit a complaint through any of the following channels:</p>
<ul>
<li><strong>Email:</strong> <a href="mailto:complaints@dontweight.co.uk">complaints@dontweight.co.uk</a></li>
<li><strong>Post:</strong> Complaints Team, Don\'t Weight Ltd</li>
<li><strong>Website:</strong> via our <a href="/contact/">Contact Us</a> page</li>
</ul>
<p>When making a complaint, please include:</p>
<ul>
<li>Your full name and account email address</li>
<li>A clear description of the issue</li>
<li>The date(s) the issue occurred</li>
<li>Any relevant correspondence or reference numbers</li>
<li>The outcome you are seeking</li>
</ul>

<h2>Our Process</h2>
<h3>Stage 1: Acknowledgement (within 2 working days)</h3>
<p>We will acknowledge your complaint in writing within 2 working days of receipt. Your complaint will be assigned a unique reference number and a dedicated complaints handler.</p>

<h3>Stage 2: Investigation (within 10 working days)</h3>
<p>Your complaint will be thoroughly investigated. This may involve reviewing your account records, consulting with clinical staff, and gathering any relevant evidence. We aim to provide a full written response within 10 working days. If more time is needed, we will inform you of the revised timeline.</p>

<h3>Stage 3: Resolution</h3>
<p>Our written response will include:</p>
<ul>
<li>A summary of your complaint</li>
<li>Our findings from the investigation</li>
<li>Any actions we have taken or plan to take</li>
<li>Details of how to escalate if you remain dissatisfied</li>
</ul>

<h2>Escalation</h2>
<p>If you are not satisfied with our response, you may escalate your complaint to:</p>
<ul>
<li><strong>Care Quality Commission (CQC):</strong> for concerns about the quality and safety of our regulated services — <a href="https://www.cqc.org.uk" target="_blank" rel="noopener">cqc.org.uk</a></li>
<li><strong>General Pharmaceutical Council (GPhC):</strong> for concerns about pharmacy services — <a href="https://www.pharmacyregulation.org" target="_blank" rel="noopener">pharmacyregulation.org</a></li>
<li><strong>Parliamentary and Health Service Ombudsman:</strong> for unresolved NHS-related complaints — <a href="https://www.ombudsman.org.uk" target="_blank" rel="noopener">ombudsman.org.uk</a></li>
<li><strong>Information Commissioner\'s Office (ICO):</strong> for data protection concerns — <a href="https://ico.org.uk" target="_blank" rel="noopener">ico.org.uk</a></li>
</ul>

<h2>Confidentiality</h2>
<p>All complaints are handled in strict confidence. Information is shared only with those directly involved in investigating and resolving your complaint. Complaints data is retained in accordance with our <a href="/privacy-policy/">Privacy Policy</a>.</p>

<h2>Learning from Complaints</h2>
<p>We review all complaints regularly to identify patterns and opportunities for improvement. Anonymised complaint data is reviewed by our clinical governance team to drive continuous improvement in our services.</p>
'),

        // ── COOKIE POLICY ──
        'cookie-policy' => array(
            'title' => 'Cookie Policy',
            'content' => '
<h2>What Are Cookies</h2>
<p>Cookies are small text files placed on your device when you visit a website. They help us understand how you use our site, remember your preferences, and improve your experience. This policy explains which cookies we use and how you can manage them.</p>

<h2>Cookies We Use</h2>

<h3>Strictly Necessary Cookies</h3>
<p>These cookies are essential for the website to function properly. They cannot be switched off. They include:</p>
<ul>
<li><strong>Session cookies:</strong> to maintain your session while browsing the site</li>
<li><strong>Security cookies:</strong> to protect against cross-site request forgery</li>
<li><strong>Cookie consent:</strong> to remember your cookie preferences</li>
</ul>

<h3>Functional Cookies</h3>
<p>These cookies enable enhanced functionality and personalisation:</p>
<ul>
<li><strong>Preference cookies:</strong> to remember your settings (e.g., unit preferences in our calculator)</li>
<li><strong>Authentication cookies:</strong> to keep you signed in during your session</li>
</ul>

<h3>Analytics Cookies</h3>
<p>These cookies help us understand how visitors interact with our website by collecting anonymous information:</p>
<ul>
<li><strong>Google Analytics:</strong> to measure page views, session duration, and traffic sources (anonymised IP)</li>
<li><strong>Performance monitoring:</strong> to identify and fix technical issues</li>
</ul>

<h3>Marketing Cookies</h3>
<p>These cookies are used to deliver relevant advertisements and track campaign effectiveness. They are only set with your explicit consent:</p>
<ul>
<li><strong>Meta Pixel:</strong> for measuring ad performance on Facebook and Instagram</li>
<li><strong>Google Ads:</strong> for conversion tracking and remarketing</li>
</ul>

<h2>Managing Cookies</h2>
<p>You can manage your cookie preferences at any time. Most web browsers allow you to control cookies through their settings. You can:</p>
<ul>
<li>Delete all cookies from your browser</li>
<li>Block all cookies or specific types</li>
<li>Set your browser to alert you when cookies are being set</li>
</ul>
<p>Please note that blocking strictly necessary cookies may affect the functionality of our website.</p>

<h3>Browser Settings</h3>
<p>To manage cookies in your browser, visit your browser\'s help pages. Common browsers:</p>
<ul>
<li><strong>Chrome:</strong> Settings &gt; Privacy and security &gt; Cookies</li>
<li><strong>Safari:</strong> Preferences &gt; Privacy</li>
<li><strong>Firefox:</strong> Settings &gt; Privacy &amp; Security</li>
<li><strong>Edge:</strong> Settings &gt; Cookies and site permissions</li>
</ul>

<h2>Third-Party Cookies</h2>
<p>Some cookies are placed by third-party services that appear on our pages. We do not control these cookies. Please refer to the relevant third party\'s privacy policy for more information.</p>

<h2>Changes to This Policy</h2>
<p>We may update this Cookie Policy from time to time. Any changes will be posted on this page with an updated "last updated" date.</p>

<h2>Contact</h2>
<p>If you have questions about our use of cookies, please contact us at <a href="mailto:privacy@dontweight.co.uk">privacy@dontweight.co.uk</a>.</p>
'),

        // ── CONTACT US ──
        'contact' => array(
            'title' => 'Contact Us',
            'content' => '
<h2>Get in Touch</h2>
<p>We\'re here to help. Whether you have a question about our treatments, need support with your account, or want to provide feedback, our team is available to assist you.</p>

<h2>General Enquiries</h2>
<p>For general questions about our services, eligibility, or how don\'t weight works:</p>
<ul>
<li><strong>Email:</strong> <a href="mailto:hello@dontweight.co.uk">hello@dontweight.co.uk</a></li>
<li>We aim to respond within 24 hours on working days.</li>
</ul>

<h2>Patient Support</h2>
<p>If you are an existing patient and need help with your treatment, account, or have a clinical question:</p>
<ul>
<li><strong>Email:</strong> <a href="mailto:support@dontweight.co.uk">support@dontweight.co.uk</a></li>
<li>Our care team is available 7 days a week.</li>
</ul>

<h2>Pharmacy</h2>
<p>For questions about your medication, delivery status, or prescription:</p>
<ul>
<li><strong>Email:</strong> <a href="mailto:pharmacy@dontweight.co.uk">pharmacy@dontweight.co.uk</a></li>
</ul>

<h2>Complaints</h2>
<p>If you\'d like to raise a complaint, please see our <a href="/complaints/">Complaints Procedure</a> or email:</p>
<ul>
<li><strong>Email:</strong> <a href="mailto:complaints@dontweight.co.uk">complaints@dontweight.co.uk</a></li>
</ul>

<h2>Data Protection</h2>
<p>For data protection enquiries, subject access requests, or to exercise your rights under UK GDPR:</p>
<ul>
<li><strong>Email:</strong> <a href="mailto:privacy@dontweight.co.uk">privacy@dontweight.co.uk</a></li>
</ul>

<h2>Press &amp; Partnerships</h2>
<p>For media enquiries, partnership opportunities, or business development:</p>
<ul>
<li><strong>Email:</strong> <a href="mailto:hello@dontweight.co.uk">hello@dontweight.co.uk</a></li>
</ul>

<h2>Registered Office</h2>
<p>Don\'t Weight Ltd<br>Registered in England &amp; Wales<br>CQC Registered &middot; MHRA Approved</p>
'),
    );

    foreach ($pages as $slug => $data) {
        $existing = get_page_by_path($slug);
        if (!$existing) {
            wp_insert_post(array(
                'post_title'     => $data['title'],
                'post_name'      => $slug,
                'post_content'   => $data['content'],
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'post_author'    => 1,
                'page_template'  => 'page-legal.php',
            ));
        }
    }

    update_option('dontweight_legal_pages_v1', true);
}
add_action('after_switch_theme', 'dontweight_create_legal_pages');
// Also run on init to catch fresh installs
add_action('init', 'dontweight_create_legal_pages');

// Auto-create Ads Landing Page (/start/)
function dontweight_create_start_page() {
    if (get_option('dontweight_start_page_v1')) return;
    $existing = get_page_by_path('start');
    if (!$existing) {
        wp_insert_post(array(
            'post_title'    => 'Start',
            'post_name'     => 'start',
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => 1,
            'page_template' => 'page-ads-landing.php',
        ));
    }
    update_option('dontweight_start_page_v1', true);
}
add_action('after_switch_theme', 'dontweight_create_start_page');
add_action('init', 'dontweight_create_start_page');

// ── AI Chatbot Widget ──
function dontweight_chatbot_widget() {
    // Don't load on admin pages or wp-login
    if (is_admin()) return;
    
    wp_enqueue_script(
        'dw-chatbot-widget',
        'https://app.dontweight.co.uk/chatbot-widget.js',
        array(),
        '1.0.0',
        true // Load in footer
    );
}
add_action('wp_enqueue_scripts', 'dontweight_chatbot_widget');
