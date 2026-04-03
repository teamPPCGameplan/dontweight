/**
 * don't weight — AI Assistant Chat Widget (Premium Edition)
 * Brand-matched: white/cream + sky blue + charcoal
 * Features: proactive greeting, gradient shine header, trust badges,
 *           premium welcome screen, sparkle footer, slide-in animations,
 *           gradient border, arrow-hover CTAs, pulsing bubble glow
 * Embed on any page: <script src="https://app.dontweight.co.uk/chatbot-widget.js" defer></script>
 */
(function () {
  'use strict'

  const API_URL = 'https://app.dontweight.co.uk/.netlify/functions/website-chat'

  // ── Landing page takeover for /join and /join-now ──
  var lpPath = window.location.pathname.replace(/\/+$/, '')
  if (lpPath === '/join' || lpPath === '/join-now') {
    var lpUrl = lpPath === '/join'
      ? 'https://app.dontweight.co.uk/join.html'
      : 'https://app.dontweight.co.uk/join-b.html'
    // Replace entire page with full-screen iframe
    document.documentElement.innerHTML = '<html><head><meta name="viewport" content="width=device-width,initial-scale=1"><style>*{margin:0;padding:0;}html,body{height:100%;overflow:hidden;}iframe{width:100%;height:100%;border:none;}</style></head><body><iframe src="' + lpUrl + '" allow="payment *"></iframe></body></html>'
    return // Stop executing rest of widget
  }

  // ── Inject premium CSS enhancements for the main site ──
  if (!document.getElementById('dw-enhance-css')) {
    const enhanceCss = document.createElement('link')
    enhanceCss.id = 'dw-enhance-css'
    enhanceCss.rel = 'stylesheet'
    enhanceCss.href = 'https://app.dontweight.co.uk/dw-enhance.css?v=2'
    document.head.appendChild(enhanceCss)
  }

  // ── Inject quick BMI checker ──
  if (!document.getElementById('dw-bmi-script')) {
    const bmiScript = document.createElement('script')
    bmiScript.id = 'dw-bmi-script'
    bmiScript.src = 'https://app.dontweight.co.uk/bmi-checker.js?v=2'
    bmiScript.defer = true
    document.head.appendChild(bmiScript)
  }

  // ── Inject FAQ sections on treatments & health-checks pages ──
  if (!document.getElementById('dw-faq-script')) {
    const faqScript = document.createElement('script')
    faqScript.id = 'dw-faq-script'
    faqScript.src = 'https://app.dontweight.co.uk/dw-faq-inject.js?v=1'
    faqScript.defer = true
    document.head.appendChild(faqScript)
  }

  // ── Fix mobile hamburger menu (openMobileMenu missing from WP theme) ──
  if (typeof window.openMobileMenu === 'undefined') {
    window.openMobileMenu = function() {
      var mm = document.getElementById('mobileMenu')
      if (mm) { mm.style.opacity = '1'; mm.style.pointerEvents = 'auto'; mm.classList.add('open') }
    }
  }
  if (typeof window.closeMobileMenu === 'undefined') {
    window.closeMobileMenu = function() {
      var mm = document.getElementById('mobileMenu')
      if (mm) { mm.style.opacity = '0'; mm.style.pointerEvents = 'none'; mm.classList.remove('open') }
    }
  }

  // ── Add monthly prices under daily prices on treatment cards ──
  function addMonthlyPrices() {
    document.querySelectorAll('.treat-card').forEach(function(card) {
      if (card.querySelector('.dw-monthly-price')) return
      const divs = card.querySelectorAll('div')
      for (let i = 0; i < divs.length; i++) {
        const text = divs[i].textContent.trim()
        if (text.includes('/day') && text.includes('£')) {
          const match = text.match(/£([\d.]+)/)
          if (match) {
            const daily = parseFloat(match[1])
            const monthly = Math.round(daily * 30.44)
            const monthlyEl = document.createElement('div')
            monthlyEl.className = 'dw-monthly-price'
            monthlyEl.style.cssText = 'font-size:13px;color:#6B7280;margin-top:2px;'
            monthlyEl.textContent = '≈ £' + monthly + '/month'
            divs[i].parentElement.insertBefore(monthlyEl, divs[i].nextSibling)
          }
          break
        }
      }
    })
  }

  // ── Safety: ensure body is always visible (WP theme loading can get stuck) ──
  setTimeout(function() {
    if (document.body && getComputedStyle(document.body).display === 'none') {
      document.body.style.display = ''
    }
  }, 2000)

  // ── Health checks: move Recommended to Standard + add scroll indicator ──
  function fixHealthCheckCards() {
    if (!window.location.pathname.includes('/health-checks')) return

    // Add Recommended badge to Standard column in the comparison table
    var table = document.querySelector('.hc-pricing table')
    if (table) {
      var ths = table.querySelectorAll('th')
      ths.forEach(function(th) {
        // Hide existing Recommended text in Baseline column
        if (th.textContent.includes('Baseline')) {
          var spans = th.querySelectorAll('span, div, p')
          spans.forEach(function(s) {
            if (s.textContent.trim() === 'Recommended' || s.textContent.trim() === 'RECOMMENDED') {
              s.style.display = 'none'
            }
          })
        }
        // Rename Standard → 360 in the table header
        if (th.textContent.includes('Standard')) {
          var walker = document.createTreeWalker(th, NodeFilter.SHOW_TEXT, null, false)
          var node
          while (node = walker.nextNode()) {
            if (node.textContent.includes('Standard')) {
              node.textContent = node.textContent.replace('Standard', '360')
            }
          }
        }
        // Give ALL header columns equal top padding so they align
        if (th.textContent.includes('Baseline') || th.textContent.includes('360') || th.textContent.includes('Premium')) {
          th.style.position = 'relative'
          th.style.paddingTop = '32px'
        }
        // Add badge to 360 column only — sits in the extra padding space
        if (th.textContent.includes('360') && !th.querySelector('.dw-rec-badge')) {
          var badge = document.createElement('div')
          badge.className = 'dw-rec-badge'
          badge.style.cssText = 'position:absolute;top:8px;left:50%;transform:translateX(-50%);background:#38BDF8;color:#fff;font-size:10px;font-weight:700;padding:3px 10px;border-radius:12px;letter-spacing:1px;text-transform:uppercase;white-space:nowrap;z-index:2;'
          badge.textContent = 'RECOMMENDED'
          th.appendChild(badge)
        }
      })
    }

    // Add mobile scroll indicator for the comparison table
    if (window.innerWidth <= 768) {
      var tableWrapper = table ? table.parentElement : null
      if (tableWrapper && !tableWrapper.querySelector('.dw-scroll-hint')) {
        var hint = document.createElement('div')
        hint.className = 'dw-scroll-hint'
        hint.style.cssText = 'text-align:center;padding:12px 0 4px;font-size:13px;color:#38BDF8;font-weight:600;animation:dw-scroll-bounce 1.5s ease-in-out infinite;'
        hint.innerHTML = 'Swipe to compare all packages \u2192'
        tableWrapper.insertBefore(hint, table)

        if (!document.getElementById('dw-scroll-hint-style')) {
          var s = document.createElement('style')
          s.id = 'dw-scroll-hint-style'
          s.textContent = '@keyframes dw-scroll-bounce{0%,100%{transform:translateX(0)}50%{transform:translateX(8px)}}'
          document.head.appendChild(s)
        }

        tableWrapper.addEventListener('scroll', function() {
          if (hint.parentElement) hint.style.opacity = '0'
        }, { once: true })
      }
    }
  }

  // ── LPUG branding: site-wide top bar ──
  function injectLPUGTopBar() {
    if (document.querySelector('.dw-lpug-bar')) return
    var bar = document.createElement('div')
    bar.className = 'dw-lpug-bar'
    bar.innerHTML = 'A <strong>London Private Ultrasound Group</strong> clinic <span style="display:inline-block;margin:0 10px;opacity:0.4;">·</span> Established healthcare provider'
    bar.style.cssText = 'height:auto;padding:6px 20px;background:#1A1A2E;color:#fff;font-size:12px;text-align:center;letter-spacing:0.5px;font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,sans-serif;line-height:1.4;box-sizing:border-box;width:100%;'
    if (!document.getElementById('dw-lpug-bar-style')) {
      var s = document.createElement('style')
      s.id = 'dw-lpug-bar-style'
      s.textContent = '@media(max-width:768px){.dw-lpug-bar{font-size:11px!important;}}'
      document.head.appendChild(s)
    }
    if (document.body.firstChild) {
      document.body.insertBefore(bar, document.body.firstChild)
    } else {
      document.body.appendChild(bar)
    }
  }

  // ── LPUG branding: health checks page partnership badge ──
  function injectLPUGHealthCheckBadge() {
    if (!window.location.pathname.includes('/health-checks')) return
    if (document.querySelector('.dw-lpug-badge')) return

    var badge = document.createElement('div')
    badge.className = 'dw-lpug-badge'
    badge.innerHTML = '<div style="max-width:900px;margin:0 auto;display:flex;flex-direction:column;align-items:center;text-align:center;">' +
      '<div style="width:56px;height:56px;border-radius:50%;background:linear-gradient(135deg,#1A1A2E,#2D2B55);display:flex;align-items:center;justify-content:center;margin-bottom:16px;border:2px solid rgba(255,255,255,0.1);box-shadow:0 4px 16px rgba(26,26,46,0.2);"><span style="color:#fff;font-size:13px;font-weight:800;letter-spacing:0.5px;">LPUG</span></div>' +
      '<div style="font-size:17px;font-weight:700;color:#0F172A;margin-bottom:8px;letter-spacing:-0.2px;">Health checks performed by <strong>London Private Ultrasound Group</strong></div>' +
      '<div style="font-size:14px;color:#334155;line-height:1.65;max-width:740px;margin-bottom:20px;">Our comprehensive health screening is delivered by <a href="https://londonsono.com" target="_blank" rel="noopener" style="color:#334155;font-weight:600;text-decoration:underline;text-decoration-color:#38BDF8;text-underline-offset:2px;">London Private Ultrasound Group\u2019s</a> experienced sonographers and clinical team, using state-of-the-art diagnostic equipment.</div>' +
      '<div style="display:flex;flex-wrap:wrap;gap:10px;justify-content:center;">' +
        '<span style="background:#fff;border:1px solid #E2E8F0;border-radius:20px;padding:6px 16px;font-size:12px;font-weight:600;color:#334155;letter-spacing:0.3px;">CQC Registered</span>' +
        '<span style="background:#fff;border:1px solid #E2E8F0;border-radius:20px;padding:6px 16px;font-size:12px;font-weight:600;color:#334155;letter-spacing:0.3px;">GMC Certified Clinicians</span>' +
        '<span style="background:#fff;border:1px solid #E2E8F0;border-radius:20px;padding:6px 16px;font-size:12px;font-weight:600;color:#334155;letter-spacing:0.3px;">NHS-Trained Sonographers</span>' +
      '</div>' +
    '</div>'
    badge.style.cssText = 'width:100%;background:linear-gradient(135deg,#F8FAFC,#EFF6FF);padding:40px 20px;box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,sans-serif;'

    var hero = document.querySelector('.hc-hero')
    if (hero && hero.nextSibling) {
      hero.parentNode.insertBefore(badge, hero.nextSibling)
    } else {
      var firstSection = document.querySelector('section')
      if (firstSection && firstSection.nextSibling) {
        firstSection.parentNode.insertBefore(badge, firstSection.nextSibling)
      } else if (firstSection) {
        firstSection.parentNode.appendChild(badge)
      }
    }
  }

  // ── LPUG branding: homepage badge below health check promo ──
  function injectLPUGHomepageBadge() {
    if (window.location.pathname !== '/' && window.location.pathname !== '/index.html') return
    if (document.querySelector('.dw-lpug-home')) return

    var grid = document.querySelector('.hc-promo-grid')
    if (!grid) return
    var section = grid.closest('section') || grid.parentElement

    var line = document.createElement('div')
    line.className = 'dw-lpug-home'
    line.innerHTML = 'Health checks delivered by <a href="https://londonsono.com" target="_blank" rel="noopener" style="color:#1E293B;font-weight:700;text-decoration:underline;text-decoration-color:#38BDF8;text-underline-offset:2px;">London Private Ultrasound Group</a> \u2014 CQC registered, NHS-trained sonographers'
    line.style.cssText = 'padding:16px 20px;font-size:13px;color:#334155;text-align:center;font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,sans-serif;line-height:1.5;'

    if (section && section.nextSibling) {
      section.parentNode.insertBefore(line, section.nextSibling)
    } else if (section) {
      section.parentNode.appendChild(line)
    }
  }

  // ── Semble booking form on health-checks page ──
  function injectSembleBooking() {
    if (!window.location.pathname.includes('/health-checks')) return
    if (document.querySelector('.dw-semble-section')) return

    var section = document.createElement('div')
    section.className = 'dw-semble-section'
    section.id = 'book-online'
    section.style.cssText = 'width:100%;background:linear-gradient(180deg,#FAFBFC 0%,#F0F9FF 100%);padding:60px 20px;box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif;'
    section.innerHTML =
      '<div style="max-width:960px;margin:0 auto;text-align:center;">' +
        '<div style="display:inline-block;background:#E0F2FE;color:#0284C7;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:6px 16px;border-radius:20px;margin-bottom:16px;">BOOK ONLINE</div>' +
        '<h2 style="font-size:32px;font-weight:800;color:#0F172A;margin:0 0 12px;letter-spacing:-0.5px;">Book Your Health Check</h2>' +
        '<p style="font-size:16px;color:#475569;margin:0 0 8px;line-height:1.6;">Select your preferred location and health check package below.</p>' +
        '<p style="font-size:14px;color:#64748B;margin:0 0 24px;line-height:1.5;">Results within 24 hours. All reports reviewed by a qualified clinician.</p>' +
        '<div style="background:#fff;border-radius:16px;box-shadow:0 4px 24px rgba(0,0,0,0.06);border:1px solid #E2E8F0;overflow:hidden;max-width:900px;margin:0 auto;">' +
          '<iframe src="https://online-booking.semble.io/?token=1154525539a981e026728e5e0f7a40f52e212da5" width="100%" height="800" frameborder="0" scrolling="auto" allow="payment *" style="display:block;border:none;"></iframe>' +
        '</div>' +
        // Clinic addresses below iframe
        '<div style="display:flex;flex-wrap:wrap;gap:16px;justify-content:center;margin-top:24px;">' +
          '<a href="https://www.google.com/maps/search/?api=1&query=27+Welbeck+Street+London+W1G+8EN" target="_blank" rel="noopener" style="display:flex;align-items:flex-start;gap:12px;background:#fff;border:1px solid #E2E8F0;border-radius:12px;padding:16px 20px;text-decoration:none;min-width:260px;text-align:left;transition:all .2s;box-shadow:0 1px 3px rgba(0,0,0,0.04);" onmouseover="this.style.borderColor=\'#38BDF8\';this.style.boxShadow=\'0 4px 12px rgba(56,189,248,0.15)\'" onmouseout="this.style.borderColor=\'#E2E8F0\';this.style.boxShadow=\'0 1px 3px rgba(0,0,0,0.04)\'">' +
            '<div style="width:36px;height:36px;border-radius:10px;background:#E0F2FE;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0284C7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>' +
            '<div>' +
              '<div style="font-size:14px;font-weight:700;color:#0F172A;margin-bottom:2px;">Central London</div>' +
              '<div style="font-size:12px;color:#475569;line-height:1.5;">27 Welbeck Street<br>London W1G 8EN</div>' +
              '<div style="font-size:11px;color:#0284C7;font-weight:600;margin-top:4px;">View on Google Maps \u2192</div>' +
            '</div>' +
          '</a>' +
          '<a href="https://www.google.com/maps/search/?api=1&query=54-56+Victoria+Street+St+Albans+AL1+3HZ" target="_blank" rel="noopener" style="display:flex;align-items:flex-start;gap:12px;background:#fff;border:1px solid #E2E8F0;border-radius:12px;padding:16px 20px;text-decoration:none;min-width:260px;text-align:left;transition:all .2s;box-shadow:0 1px 3px rgba(0,0,0,0.04);" onmouseover="this.style.borderColor=\'#38BDF8\';this.style.boxShadow=\'0 4px 12px rgba(56,189,248,0.15)\'" onmouseout="this.style.borderColor=\'#E2E8F0\';this.style.boxShadow=\'0 1px 3px rgba(0,0,0,0.04)\'">' +
            '<div style="width:36px;height:36px;border-radius:10px;background:#E0F2FE;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0284C7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>' +
            '<div>' +
              '<div style="font-size:14px;font-weight:700;color:#0F172A;margin-bottom:2px;">St Albans</div>' +
              '<div style="font-size:12px;color:#475569;line-height:1.5;">54\u201356 Victoria Street<br>St Albans AL1 3HZ</div>' +
              '<div style="font-size:11px;color:#0284C7;font-weight:600;margin-top:4px;">View on Google Maps \u2192</div>' +
            '</div>' +
          '</a>' +
        '</div>' +
        '<p style="font-size:12px;color:#94A3B8;margin-top:16px;">Powered by London Private Ultrasound Group \u00B7 CQC Registered</p>' +
      '</div>'

    // Insert INSIDE .hc-pricing, between the table (child 3) and annual cards (child 4)
    var pricing = document.querySelector('.hc-pricing')
    if (pricing) {
      // Find the annual div — it's the child containing "Save with Annual" or "Two checks per year"
      var annualDiv = null
      for (var i = 0; i < pricing.children.length; i++) {
        var child = pricing.children[i]
        if (child.textContent.includes('Two checks per year') || child.textContent.includes('SAVE WITH ANNUAL')) {
          annualDiv = child
          break
        }
      }
      if (annualDiv) {
        pricing.insertBefore(section, annualDiv)
      } else {
        // Fallback: append at end of pricing
        pricing.appendChild(section)
      }
    } else {
      var faq = document.querySelector('.dw-faq-section') || document.querySelector('footer')
      if (faq) {
        faq.parentNode.insertBefore(section, faq)
      }
    }

    // Rewire any "Book" / CTA buttons on the page to scroll to the Semble form
    setTimeout(function() {
      var links = document.querySelectorAll('a[href*="book"], a[href*="Book"], .hc-pricing a, .hc-hero a')
      links.forEach(function(link) {
        // Rewire booking CTAs and price buttons
        var text = (link.textContent || '').toLowerCase()
        if (text.includes('book') || text.includes('choose') || text.includes('get started') || text.match(/£\d+/)) {
          link.addEventListener('click', function(e) {
            e.preventDefault()
            var target = document.getElementById('book-online')
            if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' })
          })
        }
      })
    }, 200)
  }

  // ── Rewire homepage health check CTA to /health-checks/#pricing ──
  function fixHomepageHCButton() {
    if (window.location.pathname !== '/' && window.location.pathname !== '/index.html') return
    var grid = document.querySelector('.hc-promo-grid')
    if (!grid) return
    var links = grid.querySelectorAll('a')
    links.forEach(function(link) {
      var text = (link.textContent || '').toLowerCase()
      if (text.includes('book') || text.includes('health check') || text.includes('get started')) {
        link.href = '/health-checks/#book-online'
      }
    })
  }

  function runPageFixes() {
    addMonthlyPrices()
    fixHealthCheckCards()
    injectLPUGTopBar()
    injectLPUGHealthCheckBadge()
    injectLPUGHomepageBadge()
    injectSembleBooking()
    fixHomepageHCButton()
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function() { setTimeout(runPageFixes, 600) })
  } else {
    setTimeout(runPageFixes, 600)
  }

  // ── Fix broken links: redirect /dw360/ → /health-checks/ ──
  function fixBrokenLinks() {
    // Redirect if currently on /dw360/
    if (window.location.pathname.includes('/dw360')) {
      window.location.href = '/health-checks/' + window.location.hash
      return
    }
    // Fix any links pointing to /dw360/
    document.querySelectorAll('a[href*="/dw360"]').forEach(function(a) {
      a.href = a.href.replace(/\/dw360\/?/, '/health-checks/')
    })
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', fixBrokenLinks)
  } else {
    fixBrokenLinks()
  }

  // ── Inject health-check storyboard journey on hero ──
  // ── Inject health-check storyboard on HOMEPAGE dark panel ──
  function injectHealthCheckVisual() {
    if (window.location.pathname !== '/' && window.location.pathname !== '/index.html') return
    if (document.querySelector('.dw-hc-visual')) return
    // Find the dark panel: second child of .hc-promo-grid
    const grid = document.querySelector('.hc-promo-grid')
    if (!grid || grid.children.length < 2) return
    const darkPanel = grid.children[1]
    if (!darkPanel) return

    const style = document.createElement('style')
    style.textContent = `
      .dw-hc-visual { width:100%; background:linear-gradient(145deg,#0C0A09 0%,#1A1816 100%); border-radius:20px; padding:0; color:#F5F5F4; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif; overflow:hidden; box-shadow:0 8px 32px rgba(0,0,0,.3); border:1px solid rgba(255,255,255,.06); }

      /* Progress bar */
      .dw-sb-progress { display:flex; gap:4px; padding:24px 28px 0; }
      .dw-sb-pip { flex:1; height:3px; border-radius:3px; background:rgba(255,255,255,.12); transition:all .4s ease; cursor:pointer; }
      .dw-sb-pip.active { background:linear-gradient(90deg,#38BDF8,#0EA5E9); }
      .dw-sb-pip.done { background:#0EA5E9; }
      .dw-sb-pip:hover { background:rgba(14,165,233,.5); transform:scaleY(1.5); }

      /* Main frame */
      .dw-sb-frame { padding:28px 28px 24px; min-height:310px; display:flex; flex-direction:column; }
      .dw-sb-step { font-size:10px; letter-spacing:3px; text-transform:uppercase; color:rgba(255,255,255,.45); font-weight:600; margin-bottom:8px; }
      .dw-sb-icon-wrap { width:72px; height:72px; border-radius:20px; display:flex; align-items:center; justify-content:center; margin-bottom:20px; position:relative; overflow:hidden; }
      .dw-sb-icon-wrap::after { content:''; position:absolute; inset:0; border-radius:20px; border:1px solid rgba(255,255,255,.08); }
      .dw-sb-icon { font-size:36px; position:relative; z-index:1; }
      .dw-sb-title { font-size:22px; font-weight:700; color:#F5F5F4; margin-bottom:8px; letter-spacing:-.3px; }
      .dw-sb-desc { font-size:13.5px; color:rgba(255,255,255,.6); line-height:1.6; margin-bottom:20px; flex:1; }
      .dw-sb-highlight { display:inline-block; background:rgba(14,165,233,.15); color:#38BDF8; font-weight:600; padding:2px 8px; border-radius:6px; font-size:12.5px; }

      /* Stats row */
      .dw-sb-stats { display:flex; gap:12px; margin-top:auto; }
      .dw-sb-stat-pill { background:rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.08); border-radius:10px; padding:10px 14px; flex:1; text-align:center; }
      .dw-sb-stat-val { font-size:16px; font-weight:700; color:#F5F5F4; }
      .dw-sb-stat-val span { color:#38BDF8; }
      .dw-sb-stat-lbl { font-size:9px; letter-spacing:1.5px; text-transform:uppercase; color:rgba(255,255,255,.4); margin-top:2px; }

      /* Navigation */
      .dw-sb-nav { display:flex; align-items:center; justify-content:space-between; padding:0 28px 20px; }
      .dw-sb-nav-btn { width:36px; height:36px; border-radius:50%; border:1px solid rgba(255,255,255,.1); background:rgba(255,255,255,.05); color:rgba(255,255,255,.5); display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all .2s; font-size:16px; }
      .dw-sb-nav-btn:hover { background:rgba(14,165,233,.15); border-color:#0EA5E9; color:#38BDF8; }
      .dw-sb-counter { font-size:11px; color:rgba(255,255,255,.4); letter-spacing:1px; }

      /* CTA */
      .dw-sb-cta { display:block; margin:0 28px 24px; padding:14px; text-align:center; background:linear-gradient(135deg,#38BDF8,#0EA5E9); color:#fff; font-weight:700; font-size:14px; border-radius:14px; text-decoration:none; transition:all .2s; letter-spacing:.3px; border:none; cursor:pointer; }
      .dw-sb-cta:hover { transform:translateY(-1px); box-shadow:0 8px 24px rgba(14,165,233,.35); }

      /* Animations */
      .dw-sb-fade-in { animation: dw-sb-fadein .45s ease-out; }
      @keyframes dw-sb-fadein { 0%{opacity:0;transform:translateY(12px)} 100%{opacity:1;transform:translateY(0)} }
      .dw-sb-icon-pulse { animation: dw-sb-ipulse 2s ease-in-out infinite; }
      @keyframes dw-sb-ipulse { 0%,100%{transform:scale(1)} 50%{transform:scale(1.08)} }

      @media(max-width:480px) {
        .dw-hc-visual { border-radius:16px; border-width:2px; }
        .dw-sb-frame { padding:22px 22px 18px; min-height:260px; }
        .dw-sb-title { font-size:19px; }
      }
    `
    document.head.appendChild(style)

    const steps = [
      { step:'Step 1', icon:'\u{1F4C5}', iconBg:'rgba(56,189,248,.12)', title:'Book Online', desc:'Choose Baseline, 360 or Premium and pick a slot that works for you. No GP referral needed \u2014 takes 60 seconds.', highlight:'60 seconds to book', stats:[{val:'3',lbl:'Packages'},{val:'\u00A3149',lbl:'From'}] },
      { step:'Step 2', icon:'\u{1F3E5}', iconBg:'rgba(16,185,129,.12)', title:'Visit Our Clinic', desc:'Walk into our London or St Albans clinic. Our clinical team welcomes you and explains every step of the assessment.', highlight:'No referral needed', stats:[{val:'2',lbl:'Locations'},{val:'45',unit:'min',lbl:'Session'}] },
      { step:'Step 3', icon:'\u{1F50D}', iconBg:'rgba(168,85,247,.12)', title:'Targeted Ultrasound', desc:'Focused scan of liver, gallbladder, thyroid, pancreas and aorta \u2014 the key organs affected by GLP-1 medication.', highlight:'8+ organs checked', stats:[{val:'8<span>+</span>',lbl:'Organs'},{val:'4',lbl:'Ultrasounds'}] },
      { step:'Step 4', icon:'\u{1FA78}', iconBg:'rgba(239,68,68,.12)', title:'Bloods & ECG', desc:'Full blood panel (HbA1c, lipids, kidney, liver), nutrient levels (B12, D, Ferritin) and resting 12-lead ECG \u2014 all in one appointment.', highlight:'25+ biomarkers', stats:[{val:'25<span>+</span>',lbl:'Biomarkers'},{val:'ECG',lbl:'Included'}] },
      { step:'Step 5', icon:'\u{1F4CB}', iconBg:'rgba(245,158,11,.12)', title:'Clear Results', desc:'Receive a jargon-free report within 24 hours with traffic-light scoring. Our clinician summarises findings and flags anything that needs attention.', highlight:'24-hour turnaround', stats:[{val:'24',unit:'hrs',lbl:'Results'},{val:'\u2705',lbl:'Clinician Review'}] },
      { step:'Step 6', icon:'\u{1F6E1}\uFE0F', iconBg:'rgba(56,189,248,.12)', title:'Stay Protected', desc:'Catch gallstones, fatty liver, thyroid nodules and nutrient deficiencies early \u2014 before symptoms appear. 30% of rapid weight loss patients develop issues.', highlight:'Early detection saves lives', stats:[{val:'30<span>%</span>',lbl:'At Risk'},{val:'\u221E',lbl:'Peace of Mind'}] },
    ]

    let current = 0
    const panel = document.createElement('div')
    panel.className = 'dw-hc-visual'

    function render() {
      const s = steps[current]
      const unitHtml = s.stats[1].unit ? `<small style="font-size:10px;color:#9CA3AF;font-weight:400">${s.stats[1].unit}</small>` : ''
      const unitHtml0 = s.stats[0].unit ? `<small style="font-size:10px;color:#9CA3AF;font-weight:400">${s.stats[0].unit}</small>` : ''
      panel.innerHTML = `
        <div class="dw-sb-progress">${steps.map((_,i) => `<div class="dw-sb-pip ${i < current ? 'done' : ''} ${i === current ? 'active' : ''}" data-i="${i}"></div>`).join('')}</div>
        <div class="dw-sb-frame dw-sb-fade-in">
          <div class="dw-sb-step">${s.step} of ${steps.length}</div>
          <div class="dw-sb-icon-wrap" style="background:${s.iconBg}">
            <span class="dw-sb-icon dw-sb-icon-pulse">${s.icon}</span>
          </div>
          <div class="dw-sb-title">${s.title}</div>
          <div class="dw-sb-desc">${s.desc}</div>
          <div class="dw-sb-highlight">${s.highlight}</div>
          <div class="dw-sb-stats" style="margin-top:16px">
            <div class="dw-sb-stat-pill"><div class="dw-sb-stat-val">${s.stats[0].val}${unitHtml0}</div><div class="dw-sb-stat-lbl">${s.stats[0].lbl}</div></div>
            <div class="dw-sb-stat-pill"><div class="dw-sb-stat-val">${s.stats[1].val}${unitHtml}</div><div class="dw-sb-stat-lbl">${s.stats[1].lbl}</div></div>
          </div>
        </div>
        <div class="dw-sb-nav">
          <div class="dw-sb-nav-btn" data-dir="prev">\u2190</div>
          <div class="dw-sb-counter">${current+1} / ${steps.length}</div>
          <div class="dw-sb-nav-btn" data-dir="next">\u2192</div>
        </div>
        ${current === steps.length - 1 ? '<a class="dw-sb-cta" href="https://dontweight.co.uk/health-checks/#pricing">Book Your Health Check \u2192</a>' : ''}
      `
      panel.querySelectorAll('.dw-sb-pip').forEach(p => {
        p.addEventListener('click', () => { current = parseInt(p.dataset.i); render(); resetAuto() })
      })
      panel.querySelectorAll('.dw-sb-nav-btn').forEach(b => {
        b.addEventListener('click', () => {
          if (b.dataset.dir === 'next') current = (current + 1) % steps.length
          else current = (current - 1 + steps.length) % steps.length
          render(); resetAuto()
        })
      })
    }

    let autoTimer = setInterval(() => { current = (current + 1) % steps.length; render() }, 4000)
    function resetAuto() { clearInterval(autoTimer); autoTimer = setInterval(() => { current = (current + 1) % steps.length; render() }, 4000) }

    render()
    // Replace the dark panel content with our storyboard
    darkPanel.innerHTML = ''
    darkPanel.style.background = 'rgba(12,10,9,.85)'
    darkPanel.style.backdropFilter = 'blur(12px)'
    darkPanel.style.borderRadius = '24px'
    darkPanel.appendChild(panel)
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => setTimeout(injectHealthCheckVisual, 800))
  } else {
    setTimeout(injectHealthCheckVisual, 800)
  }

  // ── Fix WordPress content: punctuation & text corrections ──
  function fixWordPressText() {
    const walker = document.createTreeWalker(
      document.body,
      NodeFilter.SHOW_TEXT,
      null,
      false
    )
    const corrections = [
      [/,\s+and\s/g, ' and '],       // Remove comma before "and"
      [/\u2014/g, '\u2013'],          // Em dash → en dash
      [/\b2.minutes?\b/gi, '1-minute'],   // 2-minute → 1-minute (eligibility checker)
      [/your monthly cost may increase/gi, 'your monthly cost may increase (from month 2)'],
      [/\bLondon clinic\b/g, 'London or St Albans clinic'],  // Add St Albans location
      [/\bHome blood kit\b/gi, 'London or St Albans clinic'],  // Replace home kit with clinic locations
      [/Always free\.?/gi, ''],  // Remove "Always free" text
      [/\bfree video consultation\b/gi, 'video consultation'],
      [/\bfree consultation\b/gi, 'consultation'],
      [/\bfree video call\b/gi, 'video call'],
      [/\bBook Free Consultation\b/g, 'Book Consultation'],
      [/\bStart Free Consultation\b/g, 'Start Consultation'],
      [/\(Standard\)/g, '(360)'],  // Rename Standard → 360
      [/\bStandard Annual\b/g, '360 Annual'],
      [/\bStandard Check\b/g, '360 Check'],
      [/48h/g, '24h'],  // Results turnaround
    ]
    let node
    while ((node = walker.nextNode())) {
      let text = node.nodeValue
      let changed = false
      for (const [find, replace] of corrections) {
        const updated = text.replace(find, replace)
        if (updated !== text) {
          text = updated
          changed = true
        }
      }
      if (changed) node.nodeValue = text
    }
  }
  // Run after DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', fixWordPressText)
  } else {
    setTimeout(fixWordPressText, 500)
  }

  // ── Rename "The Journal" → "Blog" in navigation + update slug ──
  function renameJournalToBlog() {
    document.querySelectorAll('a').forEach(function(a) {
      if (a.textContent.trim() === 'The Journal') {
        a.textContent = 'Blog'
        if (a.href && a.href.includes('/journal')) {
          a.href = a.href.replace('/journal', '/blog')
        }
      }
    })
    // Also fix page title if on journal/blog page
    if (window.location.pathname.includes('/journal') || window.location.pathname.includes('/blog')) {
      document.querySelectorAll('h1, h2').forEach(function(h) {
        if (h.textContent.trim() === 'The Journal') h.textContent = 'Blog'
      })
    }
    // Redirect /journal → /blog
    if (window.location.pathname.replace(/\/+$/, '') === '/journal') {
      window.location.replace('/blog/')
    }
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', renameJournalToBlog)
  } else {
    setTimeout(renameJournalToBlog, 100)
  }

  // ── Replace dot with scale icon in hero "losing." text ──
  function addScaleIcon() {
    var losingText = document.getElementById('losingText')
    if (!losingText) return
    var spans = losingText.querySelectorAll('span')
    var lastSpan = spans[spans.length - 1]
    if (lastSpan && lastSpan.textContent === '.') {
      lastSpan.textContent = ''
      var scaleEl = document.createElement('span')
      scaleEl.innerHTML = ' &#9878;&#xFE0E;'
      scaleEl.style.cssText = 'font-size:0.75em;vertical-align:middle;display:inline-block;filter:grayscale(1) brightness(0.2);animation:scaleSwing 1s ease-in-out 1.8s both, scaleWobble 2s ease-in-out 2.8s infinite;'
      losingText.parentElement.appendChild(scaleEl)
      // Add the animation keyframes
      if (!document.getElementById('dw-scale-anim')) {
        var style = document.createElement('style')
        style.id = 'dw-scale-anim'
        style.textContent = '@keyframes scaleSwing { 0% { opacity:0; transform:scale(0.5) rotate(-15deg); } 50% { opacity:1; transform:scale(1.1) rotate(5deg); } 70% { transform:scale(0.95) rotate(-3deg); } 100% { opacity:1; transform:scale(1) rotate(0deg); } } @keyframes scaleWobble { 0%, 100% { transform:rotate(0deg); } 15% { transform:rotate(5deg); } 30% { transform:rotate(-4deg); } 45% { transform:rotate(3deg); } 60% { transform:rotate(-2deg); } 75% { transform:rotate(1deg); } }'
        document.head.appendChild(style)
      }
    }
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', addScaleIcon)
  } else {
    setTimeout(addScaleIcon, 300)
  }

  // ── Inject dose restriction notice on /treatments/ page ──
  function injectDoseRestrictionNotice() {
    if (!window.location.pathname.includes('/treatments')) return
    if (document.querySelector('.dw-dose-notice')) return

    const notice = document.createElement('div')
    notice.className = 'dw-dose-notice'
    notice.innerHTML = '\u2695\uFE0F New patients start on the lowest available dose. Higher doses require clinical evidence of prior use and clinician approval during your consultation.'
    notice.style.cssText = 'background:#F0F9FF;border-left:3px solid #0EA5E9;padding:12px 16px;font-size:13px;color:#334155;border-radius:8px;margin:16px auto;max-width:1200px;line-height:1.5;box-sizing:border-box;'

    // Try to insert after treatment cards, or before FAQ section, or before footer
    const treatCards = document.querySelectorAll('.treat-card')
    if (treatCards.length > 0) {
      const lastCard = treatCards[treatCards.length - 1]
      const cardParent = lastCard.closest('section') || lastCard.closest('.treat-cards') || lastCard.parentElement
      if (cardParent && cardParent.parentElement) {
        cardParent.parentElement.insertBefore(notice, cardParent.nextSibling)
        return
      }
    }

    const faqSection = document.querySelector('.dw-injected-faq')
    if (faqSection) {
      faqSection.parentNode.insertBefore(notice, faqSection)
      return
    }

    const footer = document.querySelector('.dw-footer') || document.querySelector('footer')
    if (footer) {
      footer.parentNode.insertBefore(notice, footer)
    }
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => setTimeout(injectDoseRestrictionNotice, 1000))
  } else {
    setTimeout(injectDoseRestrictionNotice, 1000)
  }

  // ── State (with session persistence) ──
  let isOpen = false
  let messages = []
  let isLoading = false
  let hasGreeted = false
  let toastDismissed = false

  // Restore conversation from sessionStorage
  try {
    const saved = sessionStorage.getItem('dw-chat-messages')
    if (saved) messages = JSON.parse(saved)
  } catch {}

  function saveMessages() {
    try { sessionStorage.setItem('dw-chat-messages', JSON.stringify(messages.slice(-30))) } catch {}
  }

  // ── Quick prompts (action-oriented) ──
  const quickPrompts = [
    { label: '\u{1F680} Check my eligibility (30 sec)', text: 'Am I eligible for weight loss treatment?' },
    { label: '\u{1F48A} Explore treatments', text: 'What treatments do you offer and how much do they cost?' },
    { label: '\u{1F4CB} How it works', text: 'How does don\'t weight work? Walk me through the steps.' },
    { label: '\u{1F3E5} DW 360 Health Checks', text: 'Tell me about your DW 360 health check packages' },
    { label: '\u{1F4DE} Book a consultation', text: 'How do I book a video consultation with a clinician?' },
    { label: '\u2B50 See real results', text: 'What kind of results do your members get?' },
  ]

  // ── CTA buttons to append after AI responses ──
  const ctaButtons = {
    treatments: { label: 'View Treatments', url: 'https://dontweight.co.uk/treatments/' },
    eligibility: { label: 'Check Eligibility (30 sec)', url: '#', action: 'bmi' },
    healthChecks: { label: 'View Health Check Packages', url: 'https://dontweight.co.uk/health-checks/' },
    consultation: { label: 'Book Consultation', url: 'https://cal.com/dontweight/video-consultation' },
    portal: { label: 'Log In to Portal', url: 'https://app.dontweight.co.uk' },
    contact: { label: 'Email Us', url: 'mailto:hello@dontweight.co.uk' },
  }

  function detectCTAs(text) {
    const lower = text.toLowerCase()
    const ctas = []
    if (lower.includes('treatment') || lower.includes('mounjaro') || lower.includes('wegovy') || lower.includes('medication'))
      ctas.push(ctaButtons.treatments)
    if (lower.includes('eligible') || lower.includes('bmi') || lower.includes('30 seconds') || lower.includes('eligib'))
      ctas.push(ctaButtons.eligibility)
    if (lower.includes('health check') || lower.includes('dw 360') || lower.includes('blood test') || lower.includes('ultrasound') || lower.includes('biomarker'))
      ctas.push(ctaButtons.healthChecks)
    if (lower.includes('consult') || lower.includes('video call') || lower.includes('book') || lower.includes('clinician'))
      ctas.push(ctaButtons.consultation)
    if (lower.includes('portal') || lower.includes('log in') || lower.includes('sign in') || lower.includes('app.dontweight'))
      ctas.push(ctaButtons.portal)
    if (lower.includes('email') || lower.includes('hello@') || lower.includes('contact'))
      ctas.push(ctaButtons.contact)
    // Smart fallback: only show eligibility CTA if the topic is relevant (not for existing patient queries)
    if (ctas.length === 0) {
      const isExistingPatientQuery = lower.includes('cancel') || lower.includes('pause') || lower.includes('side effect') || lower.includes('injection') || lower.includes('dose')
      if (!isExistingPatientQuery) ctas.push(ctaButtons.eligibility)
    }
    return ctas.slice(0, 3) // max 3 CTAs
  }

  // ── Create styles ──
  const style = document.createElement('style')
  style.textContent = `
    /* ── Bubble with prominent glow pulse ── */
    #dw-chat-bubble {
      position: fixed;
      bottom: 24px;
      right: 24px;
      width: 64px;
      height: 64px;
      border-radius: 50%;
      background: linear-gradient(135deg, #38BDF8, #0EA5E9);
      box-shadow: 0 6px 24px rgba(56,189,248,.45), 0 0 0 0 rgba(56,189,248,.35);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 99999;
      transition: transform .2s, box-shadow .2s;
      animation: dw-glow-pulse 2.2s ease-in-out infinite;
      border: 2px solid rgba(255,255,255,.3);
      outline: none;
    }
    #dw-chat-bubble:hover {
      transform: scale(1.12);
      box-shadow: 0 8px 36px rgba(56,189,248,.55), 0 0 24px rgba(56,189,248,.3);
    }
    #dw-chat-bubble svg { width: 28px; height: 28px; fill: #fff; }
    #dw-chat-bubble .dw-close-icon { display: none; }
    #dw-chat-bubble.open .dw-chat-icon { display: none; }
    #dw-chat-bubble.open .dw-close-icon { display: block; }
    #dw-chat-bubble.open { animation: none; }

    @keyframes dw-glow-pulse {
      0%, 100% { box-shadow: 0 6px 24px rgba(56,189,248,.45), 0 0 0 0 rgba(56,189,248,.4); }
      50% { box-shadow: 0 6px 28px rgba(56,189,248,.55), 0 0 0 20px rgba(56,189,248,0); }
    }

    /* ── Proactive greeting toast ── */
    #dw-chat-toast {
      position: fixed;
      bottom: 98px;
      right: 24px;
      background: #fff;
      border: 1px solid #E7E5E4;
      border-radius: 16px;
      padding: 14px 18px;
      box-shadow: 0 8px 32px rgba(0,0,0,.12), 0 2px 8px rgba(0,0,0,.06);
      z-index: 99999;
      display: none;
      max-width: 260px;
      cursor: pointer;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      animation: dw-toast-in .4s cubic-bezier(.34,1.56,.64,1) forwards;
      transition: transform .15s;
    }
    #dw-chat-toast:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 40px rgba(0,0,0,.16), 0 2px 8px rgba(0,0,0,.06);
    }
    #dw-chat-toast.dw-toast-hide {
      animation: dw-toast-out .3s ease-in forwards;
      pointer-events: none;
    }
    #dw-chat-toast::after {
      content: '';
      position: absolute;
      bottom: -6px;
      right: 28px;
      width: 12px;
      height: 12px;
      background: #fff;
      border-right: 1px solid #E7E5E4;
      border-bottom: 1px solid #E7E5E4;
      transform: rotate(45deg);
    }
    #dw-chat-toast .dw-toast-text {
      font-size: 13.5px;
      color: #1C1917;
      font-weight: 600;
      line-height: 1.4;
    }
    #dw-chat-toast .dw-toast-sub {
      font-size: 11px;
      color: #0284C7;
      font-weight: 600;
      margin-top: 4px;
    }
    @keyframes dw-toast-in {
      0% { opacity: 0; transform: translateY(12px) scale(.9); }
      100% { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes dw-toast-out {
      0% { opacity: 1; transform: translateY(0) scale(1); }
      100% { opacity: 0; transform: translateY(8px) scale(.92); }
    }

    /* ── Badge ── */
    #dw-chat-badge {
      position: absolute;
      top: -2px;
      right: -2px;
      width: 20px;
      height: 20px;
      background: #EF4444;
      border-radius: 50%;
      color: #fff;
      font-size: 11px;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      border: 2px solid #fff;
    }

    /* ── Chat window with gradient border ── */
    #dw-chat-window {
      position: fixed;
      bottom: 100px;
      right: 24px;
      width: 390px;
      max-width: calc(100vw - 32px);
      height: 560px;
      max-height: calc(100vh - 140px);
      border-radius: 20px;
      z-index: 99998;
      display: none;
      flex-direction: column;
      overflow: hidden;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      animation: dw-slide-up .35s cubic-bezier(.34,1.56,.64,1);
      /* Gradient border effect */
      background: linear-gradient(135deg, #38BDF8, #BAE6FD, #0EA5E9, #38BDF8);
      padding: 2px;
      box-shadow: 0 20px 60px rgba(0,0,0,.12), 0 8px 24px rgba(0,0,0,.08);
    }
    #dw-chat-window.open { display: flex; }
    #dw-chat-window-inner {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      background: #FFFFFF;
      border-radius: 18px;
    }

    @keyframes dw-slide-up {
      from { opacity: 0; transform: translateY(20px) scale(.94); }
      to { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* ── Header with gradient shine animation ── */
    .dw-chat-header {
      background: linear-gradient(135deg, #38BDF8, #0EA5E9, #0284C7);
      padding: 16px 20px;
      display: flex;
      align-items: center;
      gap: 12px;
      position: relative;
      overflow: hidden;
    }
    .dw-chat-header::after {
      content: '';
      position: absolute;
      top: -50%;
      left: -75%;
      width: 50%;
      height: 200%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,.18), transparent);
      transform: skewX(-20deg);
      animation: dw-shine 4.5s ease-in-out infinite;
    }
    @keyframes dw-shine {
      0%, 100% { left: -75%; }
      50% { left: 130%; }
    }
    .dw-chat-avatar {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background: rgba(255,255,255,.2);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }
    .dw-chat-avatar svg { width: 22px; height: 22px; }
    .dw-chat-header-info { position: relative; z-index: 1; }
    .dw-chat-header-info h3 {
      color: #fff;
      font-size: 15px;
      font-weight: 700;
      margin: 0;
      letter-spacing: -.2px;
    }
    .dw-chat-header-info .dw-status {
      color: rgba(255,255,255,.85);
      font-size: 11px;
      margin: 2px 0 0;
      display: flex;
      align-items: center;
      gap: 5px;
    }
    .dw-chat-header-info .dw-status .dw-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: #4ADE80;
      display: inline-block;
    }
    .dw-chat-header-info .dw-trust {
      color: rgba(255,255,255,.6);
      font-size: 9.5px;
      margin: 3px 0 0;
      letter-spacing: .3px;
      font-weight: 500;
    }

    /* ── Messages area ── */
    .dw-chat-messages {
      flex: 1;
      overflow-y: auto;
      padding: 16px;
      display: flex;
      flex-direction: column;
      gap: 10px;
      scroll-behavior: smooth;
      background: #FAF9F6;
    }
    .dw-chat-messages::-webkit-scrollbar { width: 4px; }
    .dw-chat-messages::-webkit-scrollbar-track { background: transparent; }
    .dw-chat-messages::-webkit-scrollbar-thumb { background: #D6D3D1; border-radius: 2px; }

    /* ── Bubbles with slide-in animations ── */
    .dw-msg {
      max-width: 82%;
      padding: 10px 14px;
      border-radius: 16px;
      font-size: 13.5px;
      line-height: 1.55;
      word-break: break-word;
    }
    .dw-msg.assistant {
      background: #fff;
      color: #1C1917;
      align-self: flex-start;
      border-bottom-left-radius: 6px;
      border: 1px solid #E7E5E4;
      box-shadow: 0 1px 3px rgba(0,0,0,.04);
      animation: dw-slide-left .35s cubic-bezier(.25,.46,.45,.94);
    }
    .dw-msg.user {
      background: linear-gradient(135deg, #38BDF8, #0EA5E9);
      color: #fff;
      align-self: flex-end;
      border-bottom-right-radius: 6px;
      font-weight: 500;
      animation: dw-slide-right .35s cubic-bezier(.25,.46,.45,.94);
    }
    @keyframes dw-slide-left {
      from { opacity: 0; transform: translateX(-16px) translateY(4px); }
      to { opacity: 1; transform: translateX(0) translateY(0); }
    }
    @keyframes dw-slide-right {
      from { opacity: 0; transform: translateX(16px) translateY(4px); }
      to { opacity: 1; transform: translateX(0) translateY(0); }
    }
    .dw-msg a {
      color: #0284C7;
      text-decoration: underline;
      text-underline-offset: 2px;
    }
    .dw-msg.user a { color: #fff; }

    /* ── CTA buttons with arrow animation on hover ── */
    .dw-cta-row {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
      margin-top: 8px;
      align-self: flex-start;
      animation: dw-slide-left .4s cubic-bezier(.25,.46,.45,.94);
    }
    .dw-cta-link {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      background: linear-gradient(135deg, #38BDF8, #0EA5E9);
      color: #fff !important;
      font-size: 12px;
      font-weight: 600;
      padding: 8px 15px;
      border-radius: 20px;
      text-decoration: none !important;
      transition: all .2s;
      box-shadow: 0 2px 10px rgba(56,189,248,.25);
    }
    .dw-cta-link .dw-arrow {
      display: inline-block;
      transition: transform .25s cubic-bezier(.25,.46,.45,.94);
    }
    .dw-cta-link:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(56,189,248,.4);
      background: linear-gradient(135deg, #0EA5E9, #0284C7);
    }
    .dw-cta-link:hover .dw-arrow {
      transform: translateX(4px);
    }
    .dw-cta-link.dw-cta-secondary {
      background: #fff;
      color: #0284C7 !important;
      border: 1.5px solid #BAE6FD;
      box-shadow: none;
    }
    .dw-cta-link.dw-cta-secondary:hover {
      background: #F0F9FF;
      border-color: #38BDF8;
      box-shadow: 0 4px 12px rgba(56,189,248,.15);
    }

    /* ── Typing indicator ── */
    .dw-typing {
      display: flex;
      gap: 5px;
      padding: 12px 16px;
      align-self: flex-start;
      background: #fff;
      border: 1px solid #E7E5E4;
      border-radius: 16px;
      border-bottom-left-radius: 6px;
      animation: dw-slide-left .3s ease-out;
    }
    .dw-typing span {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: #BAE6FD;
      animation: dw-bounce .6s ease-in-out infinite alternate;
    }
    .dw-typing span:nth-child(2) { animation-delay: .15s; }
    .dw-typing span:nth-child(3) { animation-delay: .3s; }
    @keyframes dw-bounce {
      to { transform: translateY(-4px); background: #38BDF8; }
    }

    /* ── Quick prompts ── */
    .dw-quick-prompts {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
      padding: 0 16px 12px;
      background: #FAF9F6;
    }
    .dw-quick-btn {
      background: #F0F9FF;
      border: 1px solid #BAE6FD;
      color: #0284C7;
      font-size: 12px;
      font-weight: 500;
      padding: 7px 12px;
      border-radius: 20px;
      cursor: pointer;
      transition: all .15s;
      font-family: inherit;
      white-space: nowrap;
    }
    .dw-quick-btn:hover {
      background: #E0F2FE;
      border-color: #38BDF8;
      transform: translateY(-1px);
      box-shadow: 0 2px 6px rgba(56,189,248,.15);
    }

    /* ── Input area ── */
    .dw-chat-input-area {
      padding: 12px 16px;
      border-top: 1px solid #E7E5E4;
      display: flex;
      gap: 8px;
      align-items: center;
      background: #fff;
    }
    .dw-chat-input {
      flex: 1;
      background: #FAF9F6;
      border: 1px solid #D6D3D1;
      border-radius: 24px;
      padding: 10px 16px;
      color: #1C1917;
      font-size: 13.5px;
      font-family: inherit;
      outline: none;
      transition: border-color .15s, box-shadow .15s;
    }
    .dw-chat-input::placeholder { color: #A8A29E; }
    .dw-chat-input:focus { border-color: #38BDF8; box-shadow: 0 0 0 3px rgba(56,189,248,.1); }
    .dw-chat-send {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: linear-gradient(135deg, #38BDF8, #0EA5E9);
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform .15s, opacity .15s;
      flex-shrink: 0;
    }
    .dw-chat-send:hover { transform: scale(1.06); }
    .dw-chat-send:disabled { opacity: .4; cursor: default; transform: none; }
    .dw-chat-send svg { width: 16px; height: 16px; fill: #fff; }

    /* ── Footer with sparkle icon ── */
    .dw-chat-footer {
      text-align: center;
      padding: 6px 16px 10px;
      font-size: 10px;
      color: #A8A29E;
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 4px;
    }
    .dw-chat-footer a { color: #0284C7; text-decoration: none; }
    .dw-sparkle {
      display: inline-flex;
      animation: dw-sparkle-twinkle 3s ease-in-out infinite;
    }
    @keyframes dw-sparkle-twinkle {
      0%, 100% { opacity: .6; transform: scale(1) rotate(0deg); }
      50% { opacity: 1; transform: scale(1.2) rotate(12deg); }
    }

    /* ── Welcome screen (premium) ── */
    .dw-welcome {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 24px 20px;
      text-align: center;
    }
    .dw-welcome-icon {
      width: 64px;
      height: 64px;
      border-radius: 50%;
      background: linear-gradient(135deg, #E0F2FE, #BAE6FD);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 16px;
      box-shadow: 0 4px 16px rgba(56,189,248,.15);
    }
    .dw-welcome h2 {
      color: #1C1917;
      font-size: 19px;
      font-weight: 700;
      margin: 0 0 6px;
    }
    .dw-welcome p {
      color: #57534E;
      font-size: 13px;
      margin: 0 0 4px;
      line-height: 1.5;
    }
    .dw-welcome .dw-stat-line {
      color: #0284C7;
      font-weight: 600;
      font-size: 12.5px;
      margin: 8px 0 0;
    }
    .dw-stats-row {
      display: flex;
      gap: 8px;
      margin: 12px 0 4px;
      justify-content: center;
      flex-wrap: wrap;
    }
    .dw-stat-chip {
      background: #F0F9FF;
      border: 1px solid #BAE6FD;
      border-radius: 12px;
      padding: 5px 10px;
      font-size: 11px;
      color: #0369A1;
      font-weight: 600;
    }
    .dw-welcome-cta {
      margin-top: 14px;
      background: linear-gradient(135deg, #38BDF8, #0EA5E9);
      color: #fff;
      font-size: 14px;
      font-weight: 700;
      padding: 12px 28px;
      border-radius: 28px;
      border: none;
      cursor: pointer;
      font-family: inherit;
      box-shadow: 0 4px 16px rgba(56,189,248,.3);
      transition: all .2s;
      animation: dw-cta-pulse 2.5s ease-in-out infinite;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    .dw-welcome-cta:hover {
      transform: translateY(-2px) scale(1.03);
      box-shadow: 0 8px 24px rgba(56,189,248,.45);
    }
    @keyframes dw-cta-pulse {
      0%, 100% { box-shadow: 0 4px 16px rgba(56,189,248,.3), 0 0 0 0 rgba(56,189,248,.25); }
      50% { box-shadow: 0 4px 16px rgba(56,189,248,.3), 0 0 0 10px rgba(56,189,248,0); }
    }
    .dw-welcome .dw-highlight {
      color: #0284C7;
      font-weight: 600;
      font-size: 12px;
      margin-top: 10px;
      background: #F0F9FF;
      padding: 6px 14px;
      border-radius: 20px;
      border: 1px solid #BAE6FD;
    }
    .dw-welcome .dw-brand {
      margin-top: 12px;
      font-size: 11px;
      color: #A8A29E;
    }
    .dw-welcome .dw-brand strong { color: #1C1917; font-weight: 700; }
    .dw-welcome .dw-brand em { color: #0EA5E9; font-style: italic; font-weight: 300; }

    /* ── Mobile ── */
    @media (max-width: 480px) {
      #dw-chat-window {
        bottom: 0;
        right: 0;
        width: 100vw;
        max-width: 100vw;
        height: 100vh;
        max-height: 100vh;
        border-radius: 0;
      }
      #dw-chat-window-inner { border-radius: 0; }
      #dw-chat-bubble { bottom: 16px; right: 16px; width: 56px; height: 56px; }
      #dw-chat-bubble svg { width: 24px; height: 24px; }
      #dw-chat-toast { right: 16px; bottom: 82px; }
    }
  `
  document.head.appendChild(style)

  // ── Create bubble ──
  const bubble = document.createElement('button')
  bubble.id = 'dw-chat-bubble'
  bubble.setAttribute('aria-label', 'Chat with our AI assistant')
  bubble.innerHTML = `
    <svg class="dw-chat-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2z" fill="#fff" opacity="0.95"/>
      <circle cx="8" cy="10" r="1.3" fill="#0EA5E9"/>
      <circle cx="12" cy="10" r="1.3" fill="#38BDF8"/>
      <circle cx="16" cy="10" r="1.3" fill="#0EA5E9"/>
    </svg>
    <svg class="dw-close-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path d="M18.3 5.7a1 1 0 00-1.4 0L12 10.6 7.1 5.7a1 1 0 00-1.4 1.4L10.6 12l-4.9 4.9a1 1 0 101.4 1.4L12 13.4l4.9 4.9a1 1 0 001.4-1.4L13.4 12l4.9-4.9a1 1 0 000-1.4z"/>
    </svg>
    <span id="dw-chat-badge" style="display:none">1</span>
  `
  document.body.appendChild(bubble)

  // ── Create proactive greeting toast ──
  const toast = document.createElement('div')
  toast.id = 'dw-chat-toast'
  toast.innerHTML = `
    <div class="dw-toast-text">\u{1F44B} Need help finding the right treatment?</div>
    <div class="dw-toast-sub">Check eligibility in 30 seconds \u2192</div>
  `
  document.body.appendChild(toast)

  // ── Create chat window ──
  const chatWindow = document.createElement('div')
  chatWindow.id = 'dw-chat-window'
  chatWindow.innerHTML = `
    <div id="dw-chat-window-inner">
      <div class="dw-chat-header">
        <div class="dw-chat-avatar">
          <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
          </svg>
        </div>
        <div class="dw-chat-header-info">
          <h3><strong>don't</strong> <em style="font-weight:300;font-style:italic;opacity:.85;">weight</em></h3>
          <p class="dw-status"><span class="dw-dot"></span> Online \u00B7 Replies instantly</p>
          <p class="dw-trust">CQC Registered \u00B7 MHRA Approved</p>
        </div>
      </div>
      <div class="dw-chat-messages" id="dw-chat-messages"></div>
      <div class="dw-quick-prompts" id="dw-quick-prompts"></div>
      <div class="dw-chat-input-area">
        <input class="dw-chat-input" id="dw-chat-input" placeholder="Ask me anything..." maxlength="500" />
        <button class="dw-chat-send" id="dw-chat-send" aria-label="Send message">
          <svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
        </button>
      </div>
      <div class="dw-chat-footer">
        <span class="dw-sparkle"><svg width="11" height="11" viewBox="0 0 24 24" fill="#0EA5E9" xmlns="http://www.w3.org/2000/svg"><path d="M12 0L14.59 8.41L23 11L14.59 13.59L12 22L9.41 13.59L1 11L9.41 8.41L12 0Z"/></svg></span>
        Powered by AI \u00B7 <a href="https://dontweight.co.uk" target="_blank"><strong>don't</strong> <em>weight</em></a> \u00B7 Not medical advice
      </div>
    </div>
  `
  document.body.appendChild(chatWindow)

  const messagesEl = document.getElementById('dw-chat-messages')
  const inputEl = document.getElementById('dw-chat-input')
  const sendBtn = document.getElementById('dw-chat-send')
  const promptsEl = document.getElementById('dw-quick-prompts')
  const badge = document.getElementById('dw-chat-badge')

  // ── Show welcome + quick prompts (premium) ──
  function showWelcome() {
    messagesEl.innerHTML = `
      <div class="dw-welcome">
        <div class="dw-welcome-icon" style="width:48px;height:48px;">
          <svg width="28" height="20" viewBox="0 0 50 20" xmlns="http://www.w3.org/2000/svg">
            <text x="2" y="17" font-family="system-ui,-apple-system,sans-serif" font-size="18" font-weight="800" fill="#0EA5E9" letter-spacing="-1">dw</text>
          </svg>
        </div>
        <h2 style="font-size:16px;margin:0 0 4px;">Welcome \u{1F44B}</h2>
        <p style="font-size:12.5px;margin:0 0 8px;">Your personal health concierge. Check eligibility, explore treatments or book a consultation.</p>
        <div class="dw-stats-row">
          <span class="dw-stat-chip">\u{1F465} 14,000+ members</span>
          <span class="dw-stat-chip">\u2B50 4.8 rating</span>
        </div>
        <button class="dw-welcome-cta" id="dw-welcome-cta">\u{1F680} Check my eligibility \u2192</button>
        <p class="dw-brand"><strong>don't</strong> <em>weight</em> \u00B7 CQC registered \u00B7 clinician-led</p>
      </div>
    `
    renderQuickPrompts()

    // Attach "Check eligibility" CTA handler → open BMI checker
    var ctaBtn = document.getElementById('dw-welcome-cta')
    if (ctaBtn) {
      ctaBtn.addEventListener('click', function () {
        if (window.openDWBMIChecker) {
          window.openDWBMIChecker()
        } else {
          sendMessage('Am I eligible for weight loss treatment?')
        }
      })
    }
  }

  function renderQuickPrompts() {
    if (messages.length > 0) {
      promptsEl.style.display = 'none'
      return
    }
    promptsEl.style.display = 'flex'
    promptsEl.innerHTML = quickPrompts.map(p =>
      `<button class="dw-quick-btn" data-text="${p.text.replace(/"/g, '&quot;')}">${p.label}</button>`
    ).join('')

    promptsEl.querySelectorAll('.dw-quick-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        sendMessage(btn.dataset.text)
      })
    })
  }

  // ── Render messages ──
  function renderMessages() {
    if (messages.length === 0) {
      showWelcome()
      return
    }
    promptsEl.style.display = 'none'
    let html = ''
    messages.forEach((m, i) => {
      const content = formatMessage(m.content)
      html += `<div class="dw-msg ${m.role}">${content}</div>`
      // Add CTA buttons after assistant messages
      if (m.role === 'assistant') {
        const ctas = detectCTAs(m.content)
        if (ctas.length > 0) {
          html += '<div class="dw-cta-row">'
          ctas.forEach((cta, ci) => {
            const cls = ci === 0 ? 'dw-cta-link' : 'dw-cta-link dw-cta-secondary'
            if (cta.action === 'bmi') {
              html += `<a href="#" onclick="event.preventDefault();if(window.openDWBMIChecker)window.openDWBMIChecker();" class="${cls}">${cta.label} <span class="dw-arrow">\u2192</span></a>`
            } else {
              html += `<a href="${cta.url}" target="_blank" rel="noopener noreferrer" class="${cls}">${cta.label} <span class="dw-arrow">\u2192</span></a>`
            }
          })
          html += '</div>'
        }
      }
    })

    if (isLoading) {
      html += `
        <div class="dw-typing">
          <span></span><span></span><span></span>
        </div>
      `
    }

    messagesEl.innerHTML = html
    messagesEl.scrollTop = messagesEl.scrollHeight
  }

  function formatMessage(text) {
    // Convert URLs to links
    text = text.replace(
      /(https?:\/\/[^\s<)]+)/g,
      '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>'
    )
    // Convert **bold** to <strong>
    text = text.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
    // Convert line breaks
    text = text.replace(/\n/g, '<br>')
    return text
  }

  // ── Send message ──
  async function sendMessage(text) {
    if (!text.trim() || isLoading) return

    messages.push({ role: 'user', content: text.trim() })
    inputEl.value = ''
    isLoading = true
    sendBtn.disabled = true
    renderMessages()

    try {
      const res = await fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          messages: messages.slice(-16),
        }),
      })

      const data = await res.json()
      messages.push({ role: 'assistant', content: data.reply })
    } catch {
      messages.push({
        role: 'assistant',
        content: 'Sorry, I\'m having trouble connecting. Please try again, or email us at hello@dontweight.co.uk',
      })
    }

    isLoading = false
    sendBtn.disabled = false
    saveMessages()
    renderMessages()
    inputEl.focus()
  }

  // ── Dismiss toast helper ──
  function dismissToast() {
    if (toastDismissed) return
    toastDismissed = true
    toast.classList.add('dw-toast-hide')
    setTimeout(function () {
      toast.style.display = 'none'
      toast.classList.remove('dw-toast-hide')
    }, 300)
  }

  // ── Toggle chat ──
  function toggleChat() {
    isOpen = !isOpen
    bubble.classList.toggle('open', isOpen)
    chatWindow.classList.toggle('open', isOpen)
    badge.style.display = 'none'
    dismissToast()

    if (isOpen) {
      if (messages.length === 0) showWelcome()
      inputEl.focus()
    }
  }

  // ── Proactive toast: show after 8s, auto-hide after 15s ──
  function showProactiveToast() {
    if (isOpen || toastDismissed) return
    toast.style.display = 'block'
    // Auto-dismiss after 15 seconds
    setTimeout(function () {
      if (!toastDismissed) dismissToast()
    }, 15000)
  }

  // Toast click opens the chat
  toast.addEventListener('click', function () {
    dismissToast()
    if (!isOpen) toggleChat()
  })

  // ── Show notification badge after delay ──
  function showBadge() {
    if (!isOpen && !hasGreeted) {
      badge.style.display = 'flex'
      hasGreeted = true
    }
  }

  // ── Event listeners ──
  bubble.addEventListener('click', toggleChat)

  sendBtn.addEventListener('click', () => {
    sendMessage(inputEl.value)
  })

  inputEl.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault()
      sendMessage(inputEl.value)
    }
  })

  // Close on Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && isOpen) toggleChat()
  })

  // Show welcome on first load
  showWelcome()

  // Show notification badge after 5 seconds
  setTimeout(showBadge, 5000)

  // Show proactive greeting toast after 8 seconds
  setTimeout(showProactiveToast, 8000)
})()
