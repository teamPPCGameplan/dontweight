<?php
/**
 * Plugin Name: Don't Weight — Email Notifications & Lead Capture
 * Description: Sends email notifications on form submissions and captures leads to Supabase for retargeting.
 * Version: 1.0.0
 * Author: Don't Weight Team
 *
 * INSTALLATION:
 * 1. Upload this file to wp-content/mu-plugins/dw-notifications.php on dontweight.co.uk
 *    (mu-plugins are auto-activated, no need to activate in dashboard)
 *    OR upload to wp-content/plugins/dw-notifications/ and activate in WP admin
 *
 * 2. Alternatively, paste the code below into the theme's functions.php or use
 *    a Code Snippets plugin.
 *
 * This plugin:
 * - Hooks into the existing AJAX form handlers (contactForm, consultationForm, scheduleForm)
 * - Sends email notifications to hello@dontweight.co.uk
 * - Captures lead data (first name, last name, email) to the portal's Supabase-backed API
 * - Works with the existing custom theme templates (page-contact.php, page-consultation.php, etc.)
 */

if (!defined('ABSPATH')) exit;

// ============================================
// CONFIGURATION
// ============================================
define('DW_NOTIFICATION_EMAIL', 'hello@dontweight.co.uk');
define('DW_NOTIFICATION_FROM', 'Don\'t Weight <hello@dontweight.co.uk>');
define('DW_LEAD_CAPTURE_URL', 'https://dontweight-portal.netlify.app/.netlify/functions/capture-lead');

// ============================================
// CONFIGURE WORDPRESS SMTP (Google Workspace)
// ============================================
add_action('phpmailer_init', function($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = 'smtp.gmail.com';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = 587;
    $phpmailer->SMTPSecure = 'tls';
    $phpmailer->Username   = 'hello@dontweight.co.uk';
    $phpmailer->Password   = 'alldontweight@2026';
    $phpmailer->From       = 'hello@dontweight.co.uk';
    $phpmailer->FromName   = "Don't Weight";
});

// Set default "From" for all WordPress emails
add_filter('wp_mail_from', function() {
    return 'hello@dontweight.co.uk';
});
add_filter('wp_mail_from_name', function() {
    return "Don't Weight";
});

// Enable HTML emails by default
add_filter('wp_mail_content_type', function() {
    return 'text/html';
});

// ============================================
// AJAX HANDLER: Contact Form
// ============================================
add_action('wp_ajax_dw_contact_form', 'dw_handle_contact_form');
add_action('wp_ajax_nopriv_dw_contact_form', 'dw_handle_contact_form');

function dw_handle_contact_form() {
    $first_name = sanitize_text_field($_POST['first_name'] ?? '');
    $last_name  = sanitize_text_field($_POST['last_name'] ?? '');
    $email      = sanitize_email($_POST['email'] ?? '');
    $subject    = sanitize_text_field($_POST['subject'] ?? 'General enquiry');
    $message    = sanitize_textarea_field($_POST['message'] ?? '');

    if (empty($email) || empty($first_name) || empty($last_name)) {
        wp_send_json_error(['message' => 'Please fill in all required fields.']);
        return;
    }

    // Send email notification
    $email_subject = "Contact Form: {$subject} — from {$first_name} {$last_name}";
    $email_body = dw_email_template('Contact Form Submission', [
        'Name'    => "{$first_name} {$last_name}",
        'Email'   => "<a href='mailto:{$email}'>{$email}</a>",
        'Subject' => $subject,
    ], "<h3 style='margin-top:16px;font-size:14px;'>Message</h3><p style='white-space:pre-wrap;'>{$message}</p>");

    wp_mail(DW_NOTIFICATION_EMAIL, $email_subject, $email_body);

    // Capture lead to Supabase
    dw_capture_lead([
        'first_name' => $first_name,
        'last_name'  => $last_name,
        'email'      => $email,
        'source'     => 'contact',
        'page_url'   => wp_get_referer() ?: home_url('/contact/'),
        'subject'    => $subject,
        'message'    => $message,
    ]);

    wp_send_json_success(['message' => 'Message sent! We\'ll be in touch within a few hours.']);
}

// ============================================
// AJAX HANDLER: Consultation Form
// ============================================
add_action('wp_ajax_dw_consultation_form', 'dw_handle_consultation_form');
add_action('wp_ajax_nopriv_dw_consultation_form', 'dw_handle_consultation_form');

function dw_handle_consultation_form() {
    $first_name    = sanitize_text_field($_POST['first_name'] ?? '');
    $last_name     = sanitize_text_field($_POST['last_name'] ?? '');
    $email         = sanitize_email($_POST['email'] ?? '');
    $phone         = sanitize_text_field($_POST['phone'] ?? '');
    $date_of_birth = sanitize_text_field($_POST['date_of_birth'] ?? '');
    $sex           = sanitize_text_field($_POST['sex'] ?? '');
    $address       = sanitize_text_field($_POST['address'] ?? '');
    $city          = sanitize_text_field($_POST['city'] ?? '');
    $postcode      = sanitize_text_field($_POST['postcode'] ?? '');
    $treatment     = sanitize_text_field($_POST['treatment'] ?? '');

    // Collect medical questionnaire data
    $questionnaire = [
        'medical_conditions'   => sanitize_text_field($_POST['medical_conditions'] ?? ''),
        'conditions_detail'    => sanitize_textarea_field($_POST['conditions_detail'] ?? ''),
        'medications'          => sanitize_text_field($_POST['medications'] ?? ''),
        'medications_detail'   => sanitize_textarea_field($_POST['medications_detail'] ?? ''),
        'allergies'            => sanitize_text_field($_POST['allergies'] ?? ''),
        'allergies_detail'     => sanitize_textarea_field($_POST['allergies_detail'] ?? ''),
        'surgeries'            => sanitize_text_field($_POST['surgeries'] ?? ''),
        'surgeries_detail'     => sanitize_textarea_field($_POST['surgeries_detail'] ?? ''),
        'family_history'       => sanitize_text_field($_POST['family_history'] ?? ''),
        'family_history_detail'=> sanitize_textarea_field($_POST['family_history_detail'] ?? ''),
        'smoking_alcohol'      => sanitize_text_field($_POST['smoking_alcohol'] ?? ''),
        'smoking_alcohol_detail'=> sanitize_textarea_field($_POST['smoking_alcohol_detail'] ?? ''),
        'weight_concern_duration' => sanitize_text_field($_POST['weight_concern_duration'] ?? ''),
        'previous_medication'  => sanitize_text_field($_POST['previous_medication'] ?? ''),
        'pregnant'             => sanitize_text_field($_POST['pregnant'] ?? ''),
        'thyroid_cancer'       => sanitize_text_field($_POST['thyroid_cancer'] ?? ''),
        'pancreatitis'         => sanitize_text_field($_POST['pancreatitis'] ?? ''),
        'eating_disorder'      => sanitize_text_field($_POST['eating_disorder'] ?? ''),
        'sex'                  => $sex,
        'address'              => $address,
        'city'                 => $city,
        'postcode'             => $postcode,
    ];

    if (empty($email) || empty($first_name) || empty($last_name)) {
        wp_send_json_error(['message' => 'Please fill in all required fields.']);
        return;
    }

    // Send email notification
    $email_subject = "New Consultation: {$first_name} {$last_name}" . ($treatment ? " — {$treatment}" : '');
    $fields = [
        'Name'          => "{$first_name} {$last_name}",
        'Email'         => "<a href='mailto:{$email}'>{$email}</a>",
        'Phone'         => $phone,
        'DOB'           => $date_of_birth,
        'Treatment'     => $treatment ?: 'TBD',
        'Address'       => trim("{$address}, {$city} {$postcode}", ', '),
    ];

    $extra_html = '<div style="margin-top:16px;padding-top:16px;border-top:1px solid #e5e3df;">'
        . '<h3 style="font-size:14px;margin-top:0;">Medical Questionnaire</h3>'
        . '<pre style="background:#faf9f7;padding:12px;border-radius:8px;font-size:12px;white-space:pre-wrap;">'
        . esc_html(json_encode(array_filter($questionnaire), JSON_PRETTY_PRINT))
        . '</pre></div>';

    $alert_html = '<div style="margin-bottom:16px;padding:12px;background:#fff3cd;border-radius:8px;font-size:13px;color:#856404;">'
        . 'This consultation requires clinical review before treatment can proceed.</div>';

    $email_body = dw_email_template('New Consultation Submission', $fields, $alert_html . $extra_html);
    wp_mail(DW_NOTIFICATION_EMAIL, $email_subject, $email_body);

    // Capture lead to Supabase
    dw_capture_lead([
        'first_name'         => $first_name,
        'last_name'          => $last_name,
        'email'              => $email,
        'phone'              => $phone,
        'source'             => 'consultation',
        'page_url'           => home_url('/consultation/'),
        'date_of_birth'      => $date_of_birth,
        'treatment'          => $treatment,
        'questionnaire_data' => $questionnaire,
        'consent_data_processing' => true,
    ]);

    wp_send_json_success(['message' => 'Consultation submitted for clinical review.']);
}

// ============================================
// AJAX HANDLER: Video Call Booking
// ============================================
add_action('wp_ajax_dw_schedule_form', 'dw_handle_schedule_form');
add_action('wp_ajax_nopriv_dw_schedule_form', 'dw_handle_schedule_form');

function dw_handle_schedule_form() {
    $name   = sanitize_text_field($_POST['name'] ?? '');
    $email  = sanitize_email($_POST['email'] ?? '');
    $phone  = sanitize_text_field($_POST['phone'] ?? '');
    $day    = sanitize_text_field($_POST['day'] ?? '');
    $time   = sanitize_text_field($_POST['time'] ?? '');
    $reason = sanitize_text_field($_POST['reason'] ?? '');
    $other  = sanitize_textarea_field($_POST['other_reason'] ?? '');

    if (empty($email) || empty($name)) {
        wp_send_json_error(['message' => 'Please fill in all required fields.']);
        return;
    }

    // Split name into first/last
    $name_parts = explode(' ', $name, 2);
    $first_name = $name_parts[0];
    $last_name  = $name_parts[1] ?? '';

    // Send email notification
    $email_subject = "Video Call Booking: {$name} — {$day} at {$time}";
    $email_body = dw_email_template('Video Call Booking', [
        'Name'   => $name,
        'Email'  => "<a href='mailto:{$email}'>{$email}</a>",
        'Phone'  => $phone ?: 'Not provided',
        'Day'    => $day,
        'Time'   => $time,
        'Reason' => $reason . ($other ? " — {$other}" : ''),
    ]);

    wp_mail(DW_NOTIFICATION_EMAIL, $email_subject, $email_body);

    // Capture lead to Supabase
    dw_capture_lead([
        'first_name' => $first_name,
        'last_name'  => $last_name,
        'email'      => $email,
        'phone'      => $phone,
        'source'     => 'video-call',
        'page_url'   => wp_get_referer() ?: home_url('/contact/'),
        'day'        => $day,
        'time'       => $time,
        'reason'     => $reason . ($other ? " — {$other}" : ''),
    ]);

    wp_send_json_success(['message' => 'Video call booked successfully.']);
}

// ============================================
// AJAX HANDLER: Eligibility Checker (Start page)
// Captures lead when someone enters their details
// ============================================
add_action('wp_ajax_dw_eligibility_check', 'dw_handle_eligibility_check');
add_action('wp_ajax_nopriv_dw_eligibility_check', 'dw_handle_eligibility_check');

function dw_handle_eligibility_check() {
    $first_name = sanitize_text_field($_POST['first_name'] ?? '');
    $last_name  = sanitize_text_field($_POST['last_name'] ?? '');
    $email      = sanitize_email($_POST['email'] ?? '');
    $phone      = sanitize_text_field($_POST['phone'] ?? '');

    if (!empty($email) && !empty($first_name)) {
        // Capture lead for retargeting (no email notification for eligibility checks)
        dw_capture_lead([
            'first_name' => $first_name,
            'last_name'  => $last_name ?: '',
            'email'      => $email,
            'phone'      => $phone,
            'source'     => 'eligibility-checker',
            'page_url'   => home_url('/start/'),
            'utm_source'  => sanitize_text_field($_POST['utm_source'] ?? ''),
            'utm_medium'  => sanitize_text_field($_POST['utm_medium'] ?? ''),
            'utm_campaign' => sanitize_text_field($_POST['utm_campaign'] ?? ''),
        ]);
    }

    wp_send_json_success(['message' => 'OK']);
}

// ============================================
// HELPER: Send lead data to Supabase via Netlify function
// ============================================
function dw_capture_lead($data) {
    // Fire and forget — non-blocking
    $args = [
        'body'      => json_encode($data),
        'headers'   => ['Content-Type' => 'application/json'],
        'timeout'   => 5,
        'blocking'  => false,
        'sslverify' => true,
    ];

    wp_remote_post(DW_LEAD_CAPTURE_URL, $args);
}

// ============================================
// HELPER: Email HTML template
// ============================================
function dw_email_template($title, $fields, $extra_html = '') {
    $rows = '';
    foreach ($fields as $label => $value) {
        if (empty($value)) continue;
        $rows .= "<tr>
            <td style='padding:8px 0;color:#666;width:140px;'>{$label}</td>
            <td style='padding:8px 0;color:#1a1a1a;font-weight:500;'>{$value}</td>
        </tr>";
    }

    return "
    <div style='font-family:DM Sans,Arial,sans-serif;max-width:600px;margin:0 auto;background:#faf9f7;padding:32px;'>
        <div style='text-align:center;margin-bottom:24px;'>
            <h1 style='font-size:24px;margin:0;'>
                <span style='font-weight:700;color:#1a1a1a;'>don't</span>
                <span style='font-style:italic;font-weight:300;color:#4a90d9;'> weight</span>
            </h1>
        </div>
        <div style='background:white;border:1px solid #e5e3df;border-radius:16px;padding:24px;'>
            <h2 style='color:#1a1a1a;font-size:18px;margin-top:0;'>{$title}</h2>
            <table style='width:100%;border-collapse:collapse;font-size:14px;'>
                {$rows}
            </table>
            {$extra_html}
        </div>
        <p style='text-align:center;color:#999;font-size:12px;margin-top:16px;'>
            This is an automated notification from the Don't Weight website.
        </p>
    </div>";
}

// ============================================
// HOOK: Intercept existing form AJAX actions
// If the theme already has AJAX handlers, these
// will run in addition to (or instead of) them.
// ============================================

/**
 * If the theme's forms use different AJAX action names,
 * update the add_action hooks above to match. Common patterns:
 *
 * add_action('wp_ajax_nopriv_submit_contact', 'dw_handle_contact_form');
 * add_action('wp_ajax_nopriv_submit_consultation', 'dw_handle_consultation_form');
 *
 * To find the exact action names, search the theme's JavaScript for:
 *   action: 'something'
 * in any $.ajax() or fetch() calls to admin-ajax.php
 */

// ============================================
// ENQUEUE: Add UTM capture script to frontend
// ============================================
add_action('wp_footer', function() {
    ?>
    <script>
    // Capture UTM parameters from URL for lead tracking
    (function() {
        var params = new URLSearchParams(window.location.search);
        var utmKeys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'];
        utmKeys.forEach(function(key) {
            var val = params.get(key);
            if (val) {
                sessionStorage.setItem(key, val);
            }
        });

        // Make UTM data available for AJAX form submissions
        window.dwGetUtmParams = function() {
            var data = {};
            utmKeys.forEach(function(key) {
                var val = sessionStorage.getItem(key);
                if (val) data[key] = val;
            });
            return data;
        };
    })();
    </script>
    <?php
});
