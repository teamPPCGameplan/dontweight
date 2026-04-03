/**
 * don't weight — FAQ Section Injector
 * Adds SEO-optimized FAQ sections to /treatments/ and /health-checks/ pages
 * With FAQ schema markup for Google rich results
 */
(function () {
  'use strict'

  const path = window.location.pathname

  const treatmentsFAQs = [
    {
      q: 'What is Mounjaro (tirzepatide)?',
      a: 'Mounjaro is an MHRA-approved weekly injection containing tirzepatide, a dual-action medication that targets both GIP and GLP-1 receptors to reduce appetite and regulate blood sugar. In clinical trials, patients lost up to <strong>23% of their body weight</strong> \u2013 making it the most effective weight loss medication currently available. At Don\u2019t Weight, Mounjaro starts from just \u00A34.99 per day.'
    },
    {
      q: 'What is Wegovy (semaglutide)?',
      a: 'Wegovy is an MHRA-approved weekly injection containing semaglutide, a GLP-1 receptor agonist that reduces hunger and helps you feel full sooner. Clinical trials demonstrated up to <strong>15% body weight loss</strong> and it has an extensive safety profile backed by years of real-world use. Wegovy starts from \u00A33.80 per day with next-day delivery.'
    },
    {
      q: 'Mounjaro vs Wegovy \u2013 which is better for weight loss?',
      a: 'Both are highly effective MHRA-approved treatments. Mounjaro targets two receptors (GIP and GLP-1) and achieved up to 23% weight loss in trials, whilst Wegovy targets GLP-1 alone and achieved up to 15%. The best choice depends on your medical history and goals \u2013 our clinicians will recommend the right treatment during your <strong>video consultation</strong>.'
    },
    {
      q: 'How much weight can I realistically expect to lose?',
      a: 'Clinical trials show up to 23% body weight loss with Mounjaro and up to 15% with Wegovy. For a 15-stone person, that could mean losing 2\u20133.5 stone. Individual results vary, but our <strong>14,000+ members</strong> rate us 4.8 on Google with 98% satisfaction.'
    },
    {
      q: 'What are the common side effects?',
      a: 'The most common side effects are mild nausea, reduced appetite and occasional stomach discomfort, particularly during early weeks or dose increases. These typically settle as your body adjusts. Our clinicians monitor you throughout and can adjust dosing to minimise side effects.'
    },
    {
      q: 'How do the injections work? Do they hurt?',
      a: 'Both come in pre-filled injection pens \u2013 you click the pen against your stomach, thigh or upper arm once a week. The needle is very fine and most patients describe it as a small pinch that takes seconds. No mixing, no measuring. We provide full guidance during your consultation.'
    },
    {
      q: 'How long will I need to take the medication?',
      a: 'Most patients see significant results within 3\u20136 months. There is <strong>no minimum commitment</strong> \u2013 you can pause or cancel anytime. We also support you with a gradual step-down plan when you\u2019re ready to stop, to help maintain results long-term.'
    },
    {
      q: 'Can I start on a higher dose?',
      a: 'New patients must begin on the lowest available dose \u2014 Mounjaro 2.5mg or Wegovy 0.25mg. Higher doses require <strong>clinical evidence of prior use</strong> and approval from our prescribing clinician. This ensures safe titration and allows your body to adjust gradually, minimising side effects. If you have documented history of GLP-1 use from another provider, bring this to your consultation.'
    },
    {
      q: 'Can I get GLP-1 injections on the NHS?',
      a: 'GLP-1 medications are available on the NHS in limited circumstances, but waiting lists are long and eligibility is strict (typically BMI 35+ with conditions). Don\u2019t Weight offers a faster, CQC-registered route with video consultations, next-day delivery and a <strong>30-day money-back guarantee</strong>.'
    },
    {
      q: 'Are these medications safe?',
      a: 'Both Mounjaro and Wegovy are approved by the MHRA following extensive clinical trials (SURMOUNT and STEP trials). Every prescription at Don\u2019t Weight is issued by a <strong>GPhC-registered clinician</strong>, and we are fully CQC registered.'
    },
    {
      q: 'What happens if I stop taking the medication?',
      a: 'Some weight regain can occur after stopping, which is why our clinicians help you build sustainable habits during treatment and create a personalised step-down plan. Many patients find the behavioural changes they\u2019ve made stick well beyond the medication itself.'
    }
  ]

  const healthChecksFAQs = [
    {
      q: 'Why do I need a health check on GLP-1 medication?',
      a: 'Rapid weight loss can put additional strain on your body. Research shows <strong>30% of rapid weight loss patients develop gallstones</strong>, 1 in 3 present with fatty liver, and 7% are found to have thyroid nodules \u2013 often with no symptoms. A DW 360 Health Check catches these issues early.'
    },
    {
      q: 'What does the DW 360 Health Check include?',
      a: 'Three tiers designed for weight loss patients: <strong>Baseline (\u00A3149, in-clinic)</strong> covers essential in-person blood tests with a personalised GP report. <strong>360 (\u00A3599, in-clinic)</strong> adds comprehensive ultrasound imaging, ECG and clinical review. <strong>Premium (\u00A3999, in-clinic)</strong> is our most thorough assessment with advanced diagnostics, full lipid panel, nutrients and GP follow-up. All available at our London or St Albans clinic.'
    },
    {
      q: 'How often should I get a health check?',
      a: 'We recommend a baseline check before or shortly after starting GLP-1 treatment, then follow-up every 3\u20136 months depending on your progress. Given that <strong>40% of UK adults are vitamin D deficient</strong> and rapid weight loss affects nutrient absorption, regular monitoring is essential.'
    },
    {
      q: 'Do I need to be a Don\u2019t Weight patient to book?',
      a: 'No. Our DW 360 Health Checks are <strong>open to ALL GLP-1 patients</strong>, regardless of where your medication is prescribed \u2013 whether you\u2019re with us, another provider, or the NHS.'
    },
    {
      q: 'What happens if something concerning is found?',
      a: 'Our clinical team contacts you promptly to discuss findings and recommended next steps. This may include further investigation, specialist referral, or treatment adjustments. <strong>Early detection</strong> is the entire point \u2013 conditions like gallstones and fatty liver are far easier to manage when caught early.'
    },
    {
      q: 'How long do results take?',
      a: 'Results are returned within <strong>24 hours</strong>. You\u2019ll receive a clear, jargon-free report along with a clinician\u2019s summary explaining what your results mean and any actions needed.'
    },
    {
      q: 'Where is the clinic?',
      a: 'Our health checks are performed by <strong><a href="https://londonsono.com" target="_blank" rel="noopener" style="color:#0284C7;text-decoration:underline;">London Private Ultrasound Group</a></strong> at two clinic locations. Choose whichever is most convenient when you book online.' +
        '<br><br>' +
        '<strong>\u{1F4CD} Central London</strong><br>' +
        '<a href="https://www.google.com/maps/search/?api=1&query=27+Welbeck+Street+London+W1G+8EN" target="_blank" rel="noopener" style="color:#0284C7;">27 Welbeck Street, London W1G 8EN \u2192</a>' +
        '<br><br>' +
        '<strong>\u{1F4CD} St Albans</strong><br>' +
        '<a href="https://www.google.com/maps/search/?api=1&query=54-56+Victoria+Street+St+Albans+AL1+3HZ" target="_blank" rel="noopener" style="color:#0284C7;">54\u201356 Victoria Street, St Albans AL1 3HZ \u2192</a>' +
        '<br><br>' +
        'Everything takes place in a single appointment \u2014 no need to visit multiple locations. Results are reviewed by a qualified clinician and delivered within 24 hours.'
    }
  ]

  function buildFAQSection(faqs, title) {
    const section = document.createElement('section')
    section.className = 'dw-injected-faq'
    section.setAttribute('itemscope', '')
    section.setAttribute('itemtype', 'https://schema.org/FAQPage')

    let html = `<h2>${title}</h2>`
    faqs.forEach((faq, i) => {
      html += `
        <div class="dw-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <button class="dw-faq-q" itemprop="name" onclick="this.parentElement.classList.toggle('open')">
            ${faq.q}
            <span class="dw-faq-icon">+</span>
          </button>
          <div class="dw-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <p itemprop="text">${faq.a}</p>
          </div>
        </div>
      `
    })

    section.innerHTML = html
    return section
  }

  function injectFAQs() {
    // Only inject on treatments or health-checks pages
    if (path.includes('/treatments')) {
      const footer = document.querySelector('.dw-footer') || document.querySelector('footer')
      if (footer && !document.querySelector('.dw-injected-faq')) {
        const faqSection = buildFAQSection(treatmentsFAQs, 'Frequently Asked Questions')
        footer.parentNode.insertBefore(faqSection, footer)
      }
    }

    if (path.includes('/health-checks')) {
      const footer = document.querySelector('.dw-footer') || document.querySelector('footer')
      if (footer && !document.querySelector('.dw-injected-faq')) {
        const faqSection = buildFAQSection(healthChecksFAQs, 'Frequently Asked Questions')
        footer.parentNode.insertBefore(faqSection, footer)
      }
    }
  }

  // Inject when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', injectFAQs)
  } else {
    injectFAQs()
  }
})()
