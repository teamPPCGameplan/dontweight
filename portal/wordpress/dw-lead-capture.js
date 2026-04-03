/**
 * Don't Weight — Lead Capture Script
 *
 * This script intercepts form submissions on the WordPress site and sends
 * lead data to the portal's capture-lead Netlify function for storage in Supabase.
 *
 * INSTALLATION:
 * Add this script to the WordPress site via:
 * 1. Theme's footer (before </body>), OR
 * 2. Google Tag Manager custom HTML tag, OR
 * 3. Yoast SEO > Integrations or a header/footer plugin
 * 4. WordPress Customizer > Additional JS
 *
 * This works alongside the PHP plugin (dw-notifications.php).
 * If you only want client-side lead capture without the PHP plugin,
 * this script alone will capture leads to Supabase.
 */

(function() {
  'use strict';

  var CAPTURE_URL = 'https://dontweight-portal.netlify.app/.netlify/functions/capture-lead';

  // Get UTM params from URL or sessionStorage
  function getUtmParams() {
    var params = new URLSearchParams(window.location.search);
    var keys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'];
    var data = {};
    keys.forEach(function(key) {
      var val = params.get(key) || sessionStorage.getItem(key);
      if (val) {
        data[key] = val;
        sessionStorage.setItem(key, val);
      }
    });
    return data;
  }

  // Send lead data to Supabase
  function captureLead(leadData) {
    var utm = getUtmParams();
    var payload = Object.assign({}, leadData, utm, {
      page_url: window.location.href,
    });

    fetch(CAPTURE_URL, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload),
    }).catch(function(err) {
      console.warn('Lead capture failed:', err);
    });
  }

  // ============================================
  // Hook into Consultation Form (step 2 - personal details)
  // ============================================
  function hookConsultationForm() {
    // The consultation form is multi-step. We capture lead data when the user
    // moves past the personal details step (step 2).
    // Look for the "Continue" button in step 2 or the form submission.

    var consultForm = document.getElementById('consultationForm') ||
                      document.querySelector('[data-form="consultation"]');

    if (!consultForm) return;

    // Observer to detect step changes and capture data at step 2
    var captured = false;
    var observer = new MutationObserver(function() {
      if (captured) return;

      // Try to find personal detail fields
      var firstNameEl = consultForm.querySelector('[name="first_name"], [name="firstName"], #firstName, #first_name');
      var lastNameEl = consultForm.querySelector('[name="last_name"], [name="lastName"], #lastName, #last_name');
      var emailEl = consultForm.querySelector('[name="email"], #email, [type="email"]');
      var phoneEl = consultForm.querySelector('[name="phone"], #phone, [type="tel"]');

      if (firstNameEl && firstNameEl.value && emailEl && emailEl.value) {
        // Data is filled in, capture on next step
        var nextBtns = consultForm.querySelectorAll('button[type="button"], .btn-next, [data-action="next"]');
        nextBtns.forEach(function(btn) {
          btn.addEventListener('click', function() {
            if (captured) return;
            if (firstNameEl.value && emailEl.value) {
              captured = true;
              captureLead({
                first_name: firstNameEl.value,
                last_name: lastNameEl ? lastNameEl.value : '',
                email: emailEl.value,
                phone: phoneEl ? phoneEl.value : '',
                source: 'consultation',
              });
            }
          }, { once: true });
        });
      }
    });

    observer.observe(consultForm, { childList: true, subtree: true, attributes: true });
  }

  // ============================================
  // Hook into Contact Form
  // ============================================
  function hookContactForm() {
    var contactForm = document.getElementById('contactForm') ||
                      document.querySelector('[data-form="contact"]');

    if (!contactForm) return;

    contactForm.addEventListener('submit', function(e) {
      var firstNameEl = contactForm.querySelector('[name="first_name"], [name="firstName"]');
      var lastNameEl = contactForm.querySelector('[name="last_name"], [name="lastName"]');
      var emailEl = contactForm.querySelector('[name="email"], [type="email"]');

      if (firstNameEl && emailEl && firstNameEl.value && emailEl.value) {
        captureLead({
          first_name: firstNameEl.value,
          last_name: lastNameEl ? lastNameEl.value : '',
          email: emailEl.value,
          source: 'contact',
        });
      }
    });
  }

  // ============================================
  // Hook into Schedule/Video Call Form
  // ============================================
  function hookScheduleForm() {
    var scheduleForm = document.getElementById('scheduleForm') ||
                       document.querySelector('[data-form="schedule"]');

    if (!scheduleForm) return;

    scheduleForm.addEventListener('submit', function(e) {
      var nameEl = scheduleForm.querySelector('[name="name"]');
      var emailEl = scheduleForm.querySelector('[name="email"], [type="email"]');

      if (nameEl && emailEl && nameEl.value && emailEl.value) {
        var nameParts = nameEl.value.split(' ');
        captureLead({
          first_name: nameParts[0] || '',
          last_name: nameParts.slice(1).join(' ') || '',
          email: emailEl.value,
          source: 'video-call',
        });
      }
    });
  }

  // ============================================
  // Hook into Start/Landing Page Eligibility Checker
  // ============================================
  function hookEligibilityChecker() {
    var checkerForm = document.getElementById('checkerForm');
    if (!checkerForm) return;

    // The eligibility checker might not have name/email fields by default.
    // If a lead capture step is added after the BMI check, hook into it here.
    // For now, capture from any email fields that appear after the check.

    var resultDiv = document.getElementById('checkerResult');
    if (resultDiv) {
      var observer = new MutationObserver(function() {
        var emailEl = resultDiv.querySelector('[type="email"], [name="email"]');
        var nameEl = resultDiv.querySelector('[name="first_name"], [name="name"]');
        if (emailEl && nameEl) {
          var submitBtn = resultDiv.querySelector('button[type="submit"], .btn-submit');
          if (submitBtn) {
            submitBtn.addEventListener('click', function() {
              if (emailEl.value) {
                var nameParts = (nameEl.value || '').split(' ');
                captureLead({
                  first_name: nameParts[0] || '',
                  last_name: nameParts.slice(1).join(' ') || '',
                  email: emailEl.value,
                  source: 'eligibility-checker',
                });
              }
            }, { once: true });
          }
        }
      });
      observer.observe(resultDiv, { childList: true, subtree: true });
    }
  }

  // ============================================
  // Universal: Intercept all AJAX calls to admin-ajax.php
  // This catches form submissions regardless of form ID
  // ============================================
  function interceptAjaxForms() {
    var originalFetch = window.fetch;
    window.fetch = function() {
      var url = arguments[0];
      var options = arguments[1] || {};

      // Check if this is an admin-ajax.php call
      if (typeof url === 'string' && url.indexOf('admin-ajax.php') !== -1 && options.body) {
        try {
          var formData;
          if (options.body instanceof FormData) {
            formData = options.body;
          } else if (typeof options.body === 'string') {
            formData = new URLSearchParams(options.body);
          }

          if (formData) {
            var email = formData.get('email');
            var firstName = formData.get('first_name') || formData.get('firstName') || '';
            var lastName = formData.get('last_name') || formData.get('lastName') || '';
            var name = formData.get('name') || '';
            var action = formData.get('action') || '';

            // If we have an email, capture the lead
            if (email) {
              if (!firstName && name) {
                var parts = name.split(' ');
                firstName = parts[0];
                lastName = parts.slice(1).join(' ');
              }

              var source = 'website';
              if (action.indexOf('contact') !== -1) source = 'contact';
              else if (action.indexOf('consult') !== -1) source = 'consultation';
              else if (action.indexOf('schedule') !== -1 || action.indexOf('book') !== -1) source = 'video-call';
              else if (action.indexOf('eligib') !== -1 || action.indexOf('check') !== -1) source = 'eligibility-checker';

              captureLead({
                first_name: firstName,
                last_name: lastName,
                email: email,
                phone: formData.get('phone') || '',
                source: source,
              });
            }
          }
        } catch (err) {
          // Silently fail - don't break the original form submission
        }
      }

      return originalFetch.apply(this, arguments);
    };

    // Also intercept XMLHttpRequest for jQuery.ajax
    var originalXHROpen = XMLHttpRequest.prototype.open;
    var originalXHRSend = XMLHttpRequest.prototype.send;

    XMLHttpRequest.prototype.open = function(method, url) {
      this._dwUrl = url;
      return originalXHROpen.apply(this, arguments);
    };

    XMLHttpRequest.prototype.send = function(body) {
      if (this._dwUrl && this._dwUrl.indexOf('admin-ajax.php') !== -1 && body) {
        try {
          var params;
          if (body instanceof FormData) {
            params = body;
          } else if (typeof body === 'string') {
            params = new URLSearchParams(body);
          }

          if (params) {
            var email = params.get('email');
            var firstName = params.get('first_name') || params.get('firstName') || '';
            var lastName = params.get('last_name') || params.get('lastName') || '';
            var name = params.get('name') || '';

            if (email) {
              if (!firstName && name) {
                var parts = name.split(' ');
                firstName = parts[0];
                lastName = parts.slice(1).join(' ');
              }

              var action = params.get('action') || '';
              var source = 'website';
              if (action.indexOf('contact') !== -1) source = 'contact';
              else if (action.indexOf('consult') !== -1) source = 'consultation';
              else if (action.indexOf('schedule') !== -1 || action.indexOf('book') !== -1) source = 'video-call';

              captureLead({
                first_name: firstName,
                last_name: lastName,
                email: email,
                phone: params.get('phone') || '',
                source: source,
              });
            }
          }
        } catch (err) {
          // Silently fail
        }
      }

      return originalXHRSend.apply(this, arguments);
    };
  }

  // ============================================
  // Initialize on DOM ready
  // ============================================
  function init() {
    getUtmParams(); // Store UTM params from current URL
    hookConsultationForm();
    hookContactForm();
    hookScheduleForm();
    hookEligibilityChecker();
    interceptAjaxForms();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
