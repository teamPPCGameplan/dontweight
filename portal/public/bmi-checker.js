/**
 * don't weight — Quick BMI Eligibility Checker (Premium Edition)
 * Minimalist, elegant 30-second check: measurements → details → instant result
 * Opens as modal overlay — triggered exclusively from chatbot widget
 * Embed: <script src="https://app.dontweight.co.uk/bmi-checker.js" defer></script>
 */
(function () {
  'use strict'

  const CAPTURE_URL = 'https://app.dontweight.co.uk/.netlify/functions/capture-lead'
  const CONSULT_URL = 'https://cal.com/dontweight/video-consultation'
  const TREATMENTS_URL = 'https://dontweight.co.uk/treatments/'

  // ── Styles — clean, monochrome with subtle brand accent ──
  const style = document.createElement('style')
  style.textContent = `
    #dw-bmi-overlay {
      position: fixed;
      inset: 0;
      background: rgba(12,10,9,.55);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      z-index: 100000;
      display: none;
      align-items: center;
      justify-content: center;
      animation: dwBmiFadeIn .2s ease-out;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    #dw-bmi-overlay.open { display: flex; }
    @keyframes dwBmiFadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    #dw-bmi-modal {
      background: #fff;
      border-radius: 20px;
      width: 400px;
      max-width: calc(100vw - 32px);
      max-height: calc(100vh - 48px);
      overflow-y: auto;
      box-shadow: 0 24px 64px rgba(0,0,0,.18), 0 0 0 1px rgba(0,0,0,.04);
      animation: dwBmiSlideUp .3s cubic-bezier(.22,1,.36,1);
      position: relative;
    }
    @keyframes dwBmiSlideUp {
      from { opacity: 0; transform: translateY(16px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .dw-bmi-close {
      position: absolute;
      top: 14px;
      right: 14px;
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: rgba(255,255,255,.9);
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      color: #78716C;
      transition: all .15s;
      z-index: 2;
    }
    .dw-bmi-close:hover { background: #fff; color: #1C1917; }

    .dw-bmi-header {
      background: #1C1917;
      padding: 28px 28px 22px;
      border-radius: 20px 20px 0 0;
      text-align: center;
      color: #fff;
    }
    .dw-bmi-header h2 {
      font-size: 20px;
      font-weight: 700;
      margin: 0 0 4px;
      letter-spacing: -.2px;
    }
    .dw-bmi-header p {
      font-size: 13px;
      opacity: .6;
      margin: 0;
      font-weight: 400;
    }
    .dw-bmi-header .dw-bmi-timer {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      background: rgba(255,255,255,.1);
      padding: 4px 14px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 500;
      margin-top: 12px;
      letter-spacing: .2px;
    }

    .dw-bmi-body {
      padding: 24px 28px 28px;
    }

    .dw-bmi-step {
      display: none;
      animation: dwBmiStepIn .25s ease-out;
    }
    .dw-bmi-step.active { display: block; }
    @keyframes dwBmiStepIn {
      from { opacity: 0; transform: translateX(12px); }
      to { opacity: 1; transform: translateX(0); }
    }

    .dw-bmi-progress {
      display: flex;
      gap: 5px;
      margin-bottom: 20px;
    }
    .dw-bmi-progress span {
      flex: 1;
      height: 3px;
      border-radius: 2px;
      background: #E7E5E4;
      transition: background .3s;
    }
    .dw-bmi-progress span.done { background: #1C1917; }
    .dw-bmi-progress span.current { background: #44403C; }

    .dw-bmi-label {
      font-size: 13px;
      font-weight: 600;
      color: #1C1917;
      margin: 0 0 4px;
      display: block;
    }
    .dw-bmi-sublabel {
      font-size: 11.5px;
      color: #A8A29E;
      margin: 0 0 14px;
      display: block;
    }

    .dw-bmi-input-row {
      display: flex;
      gap: 10px;
      margin-bottom: 14px;
    }
    .dw-bmi-field {
      flex: 1;
      position: relative;
    }
    .dw-bmi-field input, .dw-bmi-field select {
      width: 100%;
      padding: 12px 14px;
      border: 1px solid #E7E5E4;
      border-radius: 10px;
      font-size: 15px;
      font-family: inherit;
      color: #1C1917;
      background: #FAFAF9;
      outline: none;
      transition: border-color .15s, box-shadow .15s;
      box-sizing: border-box;
    }
    .dw-bmi-field input:focus, .dw-bmi-field select:focus {
      border-color: #44403C;
      box-shadow: 0 0 0 3px rgba(28,25,23,.06);
    }
    .dw-bmi-field input::placeholder { color: #D6D3D1; }
    .dw-bmi-field .dw-bmi-unit {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 12px;
      color: #A8A29E;
      font-weight: 500;
      pointer-events: none;
    }

    .dw-bmi-toggle {
      display: flex;
      background: #F5F5F4;
      border-radius: 8px;
      padding: 2px;
      margin-bottom: 14px;
    }
    .dw-bmi-toggle button {
      flex: 1;
      padding: 7px;
      border: none;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 500;
      cursor: pointer;
      background: transparent;
      color: #A8A29E;
      transition: all .2s;
      font-family: inherit;
    }
    .dw-bmi-toggle button.active {
      background: #fff;
      color: #1C1917;
      box-shadow: 0 1px 3px rgba(0,0,0,.06);
    }

    .dw-bmi-btn {
      width: 100%;
      padding: 13px;
      border: none;
      border-radius: 12px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      font-family: inherit;
      transition: all .2s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }
    .dw-bmi-btn-primary {
      background: #1C1917;
      color: #fff;
    }
    .dw-bmi-btn-primary:hover {
      background: #292524;
    }
    .dw-bmi-btn-primary:disabled {
      opacity: .4;
      cursor: default;
    }
    .dw-bmi-btn-secondary {
      background: transparent;
      color: #57534E;
      border: 1px solid #E7E5E4;
      margin-top: 8px;
    }
    .dw-bmi-btn-secondary:hover {
      background: #FAFAF9;
      border-color: #D6D3D1;
    }

    /* Result */
    .dw-bmi-result {
      text-align: center;
      padding: 4px 0;
    }
    .dw-bmi-result-icon {
      width: 56px;
      height: 56px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 14px;
      font-size: 24px;
    }
    .dw-bmi-result-icon.eligible {
      background: #F0FDF4;
      border: 1px solid #BBF7D0;
    }
    .dw-bmi-result-icon.not-eligible {
      background: #FFFBEB;
      border: 1px solid #FDE68A;
    }
    .dw-bmi-result h3 {
      font-size: 18px;
      font-weight: 700;
      margin: 0 0 6px;
      color: #1C1917;
      letter-spacing: -.2px;
    }
    .dw-bmi-result p {
      font-size: 13px;
      color: #78716C;
      line-height: 1.55;
      margin: 0 0 6px;
    }
    .dw-bmi-result .dw-bmi-number {
      font-size: 32px;
      font-weight: 700;
      color: #1C1917;
      display: block;
      margin: 4px 0 2px;
      letter-spacing: -.5px;
    }
    .dw-bmi-result .dw-bmi-category {
      font-size: 11px;
      font-weight: 600;
      padding: 3px 12px;
      border-radius: 20px;
      display: inline-block;
      margin-bottom: 14px;
      text-transform: uppercase;
      letter-spacing: .5px;
    }
    .dw-bmi-result .eligible-cat {
      background: #F0FDF4;
      color: #166534;
      border: 1px solid #BBF7D0;
    }
    .dw-bmi-result .not-eligible-cat {
      background: #FFFBEB;
      color: #92400E;
      border: 1px solid #FDE68A;
    }
    .dw-bmi-result .dw-bmi-trust {
      display: flex;
      justify-content: center;
      gap: 16px;
      margin: 14px 0;
      font-size: 11px;
      color: #A8A29E;
    }
    .dw-bmi-result .dw-bmi-trust strong {
      color: #1C1917;
      font-size: 13px;
      display: block;
    }

    .dw-bmi-error {
      color: #DC2626;
      font-size: 12px;
      margin-top: -6px;
      margin-bottom: 10px;
      display: none;
    }

    /* Sex selection */
    .dw-bmi-sex-row {
      display: flex;
      gap: 10px;
      margin-bottom: 14px;
    }
    .dw-bmi-sex-btn {
      flex: 1;
      padding: 12px;
      border: 1px solid #E7E5E4;
      border-radius: 10px;
      background: #FAFAF9;
      cursor: pointer;
      text-align: center;
      transition: all .2s;
      font-family: inherit;
    }
    .dw-bmi-sex-btn:hover { border-color: #D6D3D1; }
    .dw-bmi-sex-btn.selected {
      border-color: #1C1917;
      background: #fff;
    }
    .dw-bmi-sex-btn .icon { font-size: 18px; display: block; margin-bottom: 2px; }
    .dw-bmi-sex-btn .label { font-size: 12px; font-weight: 600; color: #1C1917; }

    /* Callback confirmation */
    .dw-bmi-callback-confirm {
      text-align: center;
      padding: 20px 0;
    }
    .dw-bmi-callback-confirm .dw-bmi-confirm-icon {
      width: 56px;
      height: 56px;
      border-radius: 50%;
      background: #F0FDF4;
      border: 1px solid #BBF7D0;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 14px;
      font-size: 24px;
    }
    .dw-bmi-callback-confirm h3 {
      font-size: 18px;
      font-weight: 700;
      margin: 0 0 6px;
      color: #1C1917;
      letter-spacing: -.2px;
    }
    .dw-bmi-callback-confirm p {
      font-size: 13px;
      color: #78716C;
      line-height: 1.55;
      margin: 0;
    }

    /* Exit intent overlay */
    .dw-bmi-exit-overlay {
      position: absolute;
      inset: 0;
      background: rgba(255,255,255,.97);
      border-radius: 20px;
      z-index: 3;
      display: flex;
      align-items: center;
      justify-content: center;
      animation: dwBmiFadeIn .2s ease-out;
    }
    .dw-bmi-exit-content {
      padding: 32px 28px;
      text-align: center;
      width: 100%;
      box-sizing: border-box;
    }
    .dw-bmi-exit-content h3 {
      font-size: 18px;
      font-weight: 700;
      margin: 0 0 8px;
      color: #1C1917;
      letter-spacing: -.2px;
    }
    .dw-bmi-exit-content p {
      font-size: 13px;
      color: #78716C;
      line-height: 1.55;
      margin: 0 0 18px;
    }
    .dw-bmi-exit-content .dw-bmi-no-thanks {
      display: inline-block;
      margin-top: 12px;
      font-size: 13px;
      color: #A8A29E;
      cursor: pointer;
      border: none;
      background: none;
      font-family: inherit;
      text-decoration: underline;
      transition: color .15s;
    }
    .dw-bmi-exit-content .dw-bmi-no-thanks:hover {
      color: #78716C;
    }

    @media (max-width: 480px) {
      #dw-bmi-modal { border-radius: 16px; margin: 16px; }
      .dw-bmi-header { padding: 24px 20px 18px; border-radius: 16px 16px 0 0; }
      .dw-bmi-body { padding: 20px; }
      .dw-bmi-exit-overlay { border-radius: 16px; }
    }
  `
  document.head.appendChild(style)

  // ── State ──
  let currentStep = 1
  let unitSystem = 'metric'
  let selectedSex = null
  let bmiResult = null
  let exitIntentShown = false
  let lastEligibleCategory = null

  // ── Create overlay ──
  const overlay = document.createElement('div')
  overlay.id = 'dw-bmi-overlay'
  overlay.innerHTML = `
    <div id="dw-bmi-modal">
      <button class="dw-bmi-close" aria-label="Close">&times;</button>
      <div class="dw-bmi-header">
        <h2>Quick Eligibility Check</h2>
        <p>Find out if you qualify for prescribed weight loss treatment</p>
        <span class="dw-bmi-timer">\u23F1 30 seconds</span>
      </div>
      <div class="dw-bmi-body">

        <!-- Step 1: Height & Weight -->
        <div class="dw-bmi-step active" id="dw-bmi-step1">
          <div class="dw-bmi-progress">
            <span class="current"></span><span></span><span></span>
          </div>
          <label class="dw-bmi-label">Your measurements</label>
          <span class="dw-bmi-sublabel">We use this to calculate your BMI</span>

          <div class="dw-bmi-toggle" id="dw-unit-toggle">
            <button class="active" data-unit="metric">Metric (kg / cm)</button>
            <button data-unit="imperial">Imperial (st / ft)</button>
          </div>

          <!-- Metric inputs -->
          <div id="dw-metric-inputs">
            <div class="dw-bmi-input-row">
              <div class="dw-bmi-field">
                <input type="number" id="dw-height-cm" placeholder="Height" min="100" max="250" inputmode="numeric" />
                <span class="dw-bmi-unit">cm</span>
              </div>
              <div class="dw-bmi-field">
                <input type="number" id="dw-weight-kg" placeholder="Weight" min="30" max="300" inputmode="numeric" />
                <span class="dw-bmi-unit">kg</span>
              </div>
            </div>
          </div>

          <!-- Imperial inputs -->
          <div id="dw-imperial-inputs" style="display:none;">
            <div class="dw-bmi-input-row">
              <div class="dw-bmi-field">
                <input type="number" id="dw-height-ft" placeholder="Height" min="3" max="8" inputmode="numeric" />
                <span class="dw-bmi-unit">ft</span>
              </div>
              <div class="dw-bmi-field">
                <input type="number" id="dw-height-in" placeholder="" min="0" max="11" inputmode="numeric" />
                <span class="dw-bmi-unit">in</span>
              </div>
            </div>
            <div class="dw-bmi-input-row">
              <div class="dw-bmi-field">
                <input type="number" id="dw-weight-st" placeholder="Weight" min="4" max="50" inputmode="numeric" />
                <span class="dw-bmi-unit">st</span>
              </div>
              <div class="dw-bmi-field">
                <input type="number" id="dw-weight-lb" placeholder="" min="0" max="13" inputmode="numeric" />
                <span class="dw-bmi-unit">lb</span>
              </div>
            </div>
          </div>

          <div class="dw-bmi-sex-row">
            <button class="dw-bmi-sex-btn" data-sex="female">
              <span class="icon">\u2640\uFE0F</span>
              <span class="label">Female</span>
            </button>
            <button class="dw-bmi-sex-btn" data-sex="male">
              <span class="icon">\u2642\uFE0F</span>
              <span class="label">Male</span>
            </button>
          </div>

          <p class="dw-bmi-error" id="dw-bmi-error1"></p>
          <button class="dw-bmi-btn dw-bmi-btn-primary" id="dw-bmi-next1">Calculate my BMI \u2192</button>
        </div>

        <!-- Step 2: Contact details -->
        <div class="dw-bmi-step" id="dw-bmi-step2">
          <div class="dw-bmi-progress">
            <span class="done"></span><span class="current"></span><span></span>
          </div>
          <label class="dw-bmi-label">Your details</label>
          <span class="dw-bmi-sublabel">So our clinicians can prepare your consultation</span>

          <div class="dw-bmi-input-row">
            <div class="dw-bmi-field">
              <input type="text" id="dw-bmi-fname" placeholder="First name" maxlength="50" autocomplete="given-name" />
            </div>
            <div class="dw-bmi-field">
              <input type="text" id="dw-bmi-lname" placeholder="Last name" maxlength="50" autocomplete="family-name" />
            </div>
          </div>
          <div class="dw-bmi-input-row">
            <div class="dw-bmi-field">
              <input type="email" id="dw-bmi-email" placeholder="Email address" maxlength="100" autocomplete="email" />
            </div>
          </div>
          <div class="dw-bmi-input-row">
            <div class="dw-bmi-field">
              <input type="date" id="dw-bmi-dob" max="2008-01-01" />
            </div>
          </div>

          <p class="dw-bmi-error" id="dw-bmi-error2"></p>
          <button class="dw-bmi-btn dw-bmi-btn-primary" id="dw-bmi-next2">See my result \u2192</button>
        </div>

        <!-- Step 3: Result -->
        <div class="dw-bmi-step" id="dw-bmi-step3">
          <div class="dw-bmi-progress">
            <span class="done"></span><span class="done"></span><span class="done"></span>
          </div>
          <div class="dw-bmi-result" id="dw-bmi-result-area"></div>
        </div>

      </div>
    </div>
  `
  document.body.appendChild(overlay)

  // ── Elements ──
  const closeBtn = overlay.querySelector('.dw-bmi-close')

  // ── Unit toggle ──
  const unitBtns = overlay.querySelectorAll('#dw-unit-toggle button')
  unitBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      unitSystem = btn.dataset.unit
      unitBtns.forEach(b => b.classList.remove('active'))
      btn.classList.add('active')
      document.getElementById('dw-metric-inputs').style.display = unitSystem === 'metric' ? 'block' : 'none'
      document.getElementById('dw-imperial-inputs').style.display = unitSystem === 'imperial' ? 'block' : 'none'
    })
  })

  // ── Sex selection ──
  const sexBtns = overlay.querySelectorAll('.dw-bmi-sex-btn')
  sexBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      selectedSex = btn.dataset.sex
      sexBtns.forEach(b => b.classList.remove('selected'))
      btn.classList.add('selected')
    })
  })

  // ── BMI Calculation ──
  function getHeightCm() {
    if (unitSystem === 'metric') {
      return parseFloat(document.getElementById('dw-height-cm').value) || 0
    }
    const ft = parseFloat(document.getElementById('dw-height-ft').value) || 0
    const inches = parseFloat(document.getElementById('dw-height-in').value) || 0
    return (ft * 30.48) + (inches * 2.54)
  }

  function getWeightKg() {
    if (unitSystem === 'metric') {
      return parseFloat(document.getElementById('dw-weight-kg').value) || 0
    }
    const st = parseFloat(document.getElementById('dw-weight-st').value) || 0
    const lb = parseFloat(document.getElementById('dw-weight-lb').value) || 0
    return (st * 6.35029) + (lb * 0.453592)
  }

  function calculateBMI(heightCm, weightKg) {
    if (heightCm <= 0 || weightKg <= 0) return 0
    const heightM = heightCm / 100
    return weightKg / (heightM * heightM)
  }

  function getBMICategory(bmi) {
    if (bmi < 18.5) return { label: 'Underweight', eligible: false }
    if (bmi < 25) return { label: 'Healthy weight', eligible: false }
    if (bmi < 27) return { label: 'Overweight', eligible: false }
    if (bmi < 30) return { label: 'Overweight', eligible: true, partial: true }
    if (bmi < 35) return { label: 'Obese Class I', eligible: true }
    if (bmi < 40) return { label: 'Obese Class II', eligible: true }
    return { label: 'Obese Class III', eligible: true }
  }

  // ── Callback form HTML helper ──
  function getCallbackFormHTML() {
    return `
      <div class="dw-bmi-input-row">
        <div class="dw-bmi-field">
          <input type="tel" class="dw-bmi-callback-phone" placeholder="Phone number" autocomplete="tel" required />
        </div>
      </div>
      <div class="dw-bmi-input-row">
        <div class="dw-bmi-field">
          <select class="dw-bmi-callback-time">
            <option value="Morning (9-12)">Morning (9-12)</option>
            <option value="Afternoon (12-5)">Afternoon (12-5)</option>
            <option value="Evening (5-8)">Evening (5-8)</option>
          </select>
        </div>
      </div>
      <p class="dw-bmi-error dw-bmi-callback-error"></p>
      <button class="dw-bmi-btn dw-bmi-btn-primary dw-bmi-callback-submit">Request callback \u2192</button>
    `
  }

  // ── Callback confirmation HTML helper ──
  function getCallbackConfirmHTML() {
    return `
      <div class="dw-bmi-callback-confirm">
        <div class="dw-bmi-confirm-icon">\u2713</div>
        <h3>We'll call you back! \u2713</h3>
        <p>A clinician will call you during your preferred time slot.</p>
      </div>
    `
  }

  // ── Submit callback request ──
  function submitCallbackForm(container, onSuccess) {
    var phoneInput = container.querySelector('.dw-bmi-callback-phone')
    var timeSelect = container.querySelector('.dw-bmi-callback-time')
    var errEl = container.querySelector('.dw-bmi-callback-error')
    var submitBtn = container.querySelector('.dw-bmi-callback-submit')

    submitBtn.addEventListener('click', function () {
      var phone = phoneInput.value.trim()
      if (!phone || phone.length < 7) {
        errEl.textContent = 'Please enter a valid phone number'
        errEl.style.display = 'block'
        return
      }
      errEl.style.display = 'none'
      submitBtn.disabled = true
      submitBtn.textContent = 'Sending\u2026'

      var callbackData = {
        first_name: document.getElementById('dw-bmi-fname').value.trim(),
        last_name: document.getElementById('dw-bmi-lname').value.trim(),
        email: document.getElementById('dw-bmi-email').value.trim(),
        phone: phone,
        source: 'callback-request',
        page_url: window.location.href,
        questionnaire_data: {
          bmi: Math.round(bmiResult * 10) / 10,
          callback_time: timeSelect.value,
          request_type: 'callback',
        },
      }

      fetch(CAPTURE_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(callbackData),
      })
        .then(function () { onSuccess() })
        .catch(function () { onSuccess() })
    })
  }

  // ── Step 1: Validate & calculate ──
  document.getElementById('dw-bmi-next1').addEventListener('click', () => {
    const err = document.getElementById('dw-bmi-error1')
    const heightCm = getHeightCm()
    const weightKg = getWeightKg()

    if (heightCm < 100 || heightCm > 250) {
      err.textContent = 'Please enter a valid height'
      err.style.display = 'block'
      return
    }
    if (weightKg < 30 || weightKg > 300) {
      err.textContent = 'Please enter a valid weight'
      err.style.display = 'block'
      return
    }
    if (!selectedSex) {
      err.textContent = 'Please select your biological sex'
      err.style.display = 'block'
      return
    }

    err.style.display = 'none'
    bmiResult = calculateBMI(heightCm, weightKg)
    goToStep(2)
  })

  // ── Step 2: Validate contact & show result ──
  document.getElementById('dw-bmi-next2').addEventListener('click', () => {
    const err = document.getElementById('dw-bmi-error2')
    const fname = document.getElementById('dw-bmi-fname').value.trim()
    const lname = document.getElementById('dw-bmi-lname').value.trim()
    const email = document.getElementById('dw-bmi-email').value.trim()
    const dob = document.getElementById('dw-bmi-dob').value

    if (!fname || !lname) {
      err.textContent = 'Please enter your full name'
      err.style.display = 'block'
      return
    }
    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      err.textContent = 'Please enter a valid email address'
      err.style.display = 'block'
      return
    }
    if (!dob) {
      err.textContent = 'Please enter your date of birth'
      err.style.display = 'block'
      return
    }

    const dobDate = new Date(dob)
    const age = Math.floor((Date.now() - dobDate.getTime()) / (365.25 * 24 * 60 * 60 * 1000))
    if (age < 18) {
      err.textContent = 'You must be 18 or older to use this service'
      err.style.display = 'block'
      return
    }

    err.style.display = 'none'

    const category = getBMICategory(bmiResult)
    lastEligibleCategory = category
    const leadData = {
      first_name: fname,
      last_name: lname,
      email: email,
      date_of_birth: dob,
      source: 'bmi-checker',
      page_url: window.location.href,
      questionnaire_data: {
        bmi: Math.round(bmiResult * 10) / 10,
        bmi_category: category.label,
        eligible: category.eligible,
        sex: selectedSex,
        height_cm: Math.round(getHeightCm()),
        weight_kg: Math.round(getWeightKg() * 10) / 10,
      },
    }

    fetch(CAPTURE_URL, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(leadData),
    }).catch(() => {})

    showResult(category)
    goToStep(3)
  })

  function showResult(category) {
    const area = document.getElementById('dw-bmi-result-area')
    const bmi = Math.round(bmiResult * 10) / 10

    if (category.eligible) {
      area.innerHTML = `
        <div class="dw-bmi-result-icon eligible">\u2713</div>
        <h3>You're likely eligible</h3>
        <span class="dw-bmi-number">${bmi}</span>
        <span class="dw-bmi-category eligible-cat">${category.label}</span>
        <p>Based on your BMI, you ${category.partial ? 'may qualify with a weight-related health condition' : 'meet the clinical criteria'} for prescribed GLP-1 treatment. Book a <strong>video consultation</strong> with one of our UK clinicians. 30-day money-back guarantee.</p>
        <div class="dw-bmi-trust">
          <span><strong>14,000+</strong>members</span>
          <span><strong>4.8\u2605</strong>Google</span>
          <span><strong>CQC</strong>regulated</span>
        </div>
        <button class="dw-bmi-btn dw-bmi-btn-primary" id="dw-bmi-book-consult">Book consultation \u2192</button>
        <button class="dw-bmi-btn dw-bmi-btn-secondary" id="dw-bmi-callback-btn">Not sure? Request a callback \u2192</button>
      `
      // Book consultation handler
      document.getElementById('dw-bmi-book-consult').addEventListener('click', function () {
        window.open(CONSULT_URL, '_blank')
      })
      // Show callback form handler
      document.getElementById('dw-bmi-callback-btn').addEventListener('click', function () {
        showInlineCallbackForm(area)
      })
    } else {
      area.innerHTML = `
        <div class="dw-bmi-result-icon not-eligible">\u2139</div>
        <h3>Thanks for checking</h3>
        <span class="dw-bmi-number">${bmi}</span>
        <span class="dw-bmi-category not-eligible-cat">${category.label}</span>
        <p>GLP-1 medications are prescribed for patients with a BMI of 30+ (or 27+ with a weight-related condition). If you have type 2 diabetes, high blood pressure or PCOS, you may still qualify.</p>
        <button class="dw-bmi-btn dw-bmi-btn-primary" id="dw-bmi-callback-btn-ne">Request a callback \u2192</button>
        <button class="dw-bmi-btn dw-bmi-btn-secondary" id="dw-bmi-health-checks">Explore health checks</button>
      `
      // Callback form for not-eligible users
      document.getElementById('dw-bmi-callback-btn-ne').addEventListener('click', function () {
        showInlineCallbackForm(area)
      })
      document.getElementById('dw-bmi-health-checks').addEventListener('click', function () {
        window.location.href = 'https://dontweight.co.uk/health-checks/'
      })
    }
  }

  // ── Show inline callback form (replaces the result area) ──
  function showInlineCallbackForm(container) {
    container.innerHTML = `
      <div class="dw-bmi-result-icon eligible">\u260E</div>
      <h3>Request a callback</h3>
      <p style="margin-bottom:16px;">Leave your number and a clinician will call you back — no obligation.</p>
      ${getCallbackFormHTML()}
    `
    submitCallbackForm(container, function () {
      container.innerHTML = getCallbackConfirmHTML()
    })
  }

  // ── Exit-intent overlay ──
  function showExitIntent() {
    if (exitIntentShown) return false
    if (currentStep !== 3) return false
    if (!lastEligibleCategory || !lastEligibleCategory.eligible) return false

    exitIntentShown = true

    var modal = document.getElementById('dw-bmi-modal')
    var exitDiv = document.createElement('div')
    exitDiv.className = 'dw-bmi-exit-overlay'
    exitDiv.innerHTML = `
      <div class="dw-bmi-exit-content">
        <h3>Not ready to book?</h3>
        <p>Leave your number and a clinician will call you back \u2014 no obligation.</p>
        ${getCallbackFormHTML()}
        <button class="dw-bmi-no-thanks">No thanks, close</button>
      </div>
    `
    modal.appendChild(exitDiv)

    // Wire up the callback form inside exit intent
    var exitContent = exitDiv.querySelector('.dw-bmi-exit-content')
    submitCallbackForm(exitContent, function () {
      exitContent.innerHTML = getCallbackConfirmHTML() +
        '<button class="dw-bmi-btn dw-bmi-btn-secondary" style="margin-top:16px;" id="dw-bmi-exit-close-after">Close</button>'
      document.getElementById('dw-bmi-exit-close-after').addEventListener('click', function () {
        forceCloseBMIChecker()
      })
    })

    // "No thanks, close" handler
    exitDiv.querySelector('.dw-bmi-no-thanks').addEventListener('click', function () {
      forceCloseBMIChecker()
    })

    return true
  }

  function removeExitIntent() {
    var exitEl = document.querySelector('.dw-bmi-exit-overlay')
    if (exitEl) exitEl.remove()
  }

  function goToStep(step) {
    currentStep = step
    overlay.querySelectorAll('.dw-bmi-step').forEach(s => s.classList.remove('active'))
    document.getElementById('dw-bmi-step' + step).classList.add('active')
  }

  // ── Open / Close ──
  function hideChatWidgets() {
    // Hide Tawk.to, Tidio, crisp, or any common chat widget
    document.querySelectorAll('[class*="tawk"], [id*="tawk"], [class*="tidio"], [id*="tidio"], [class*="crisp"], iframe[title*="chat"], .dw-chat-toggle, .dw-chat-bubble, #chat-widget-container').forEach(function(el) {
      el.style.setProperty('display', 'none', 'important')
    })
    // Also hide the chatbot widget bubble from chatbot-widget.js
    var chatBubble = document.querySelector('.dw-chat-toggle') || document.querySelector('[onclick*="openDWChat"]')
    if (chatBubble) chatBubble.style.setProperty('display', 'none', 'important')
    // Hide any bottom-right fixed elements that look like chat
    document.querySelectorAll('div[style*="position: fixed"][style*="bottom"]').forEach(function(el) {
      if (el.id === 'dw-bmi-overlay') return
      var rect = el.getBoundingClientRect()
      if (rect.bottom > window.innerHeight - 100 && rect.right > window.innerWidth - 100) {
        el.dataset.dwHidden = '1'
        el.style.setProperty('display', 'none', 'important')
      }
    })
  }

  function showChatWidgets() {
    document.querySelectorAll('[data-dw-hidden="1"]').forEach(function(el) {
      el.style.removeProperty('display')
      delete el.dataset.dwHidden
    })
    document.querySelectorAll('.dw-chat-toggle, .dw-chat-bubble, [onclick*="openDWChat"]').forEach(function(el) {
      el.style.removeProperty('display')
    })
    document.querySelectorAll('[class*="tawk"], [id*="tawk"], [class*="tidio"], [id*="tidio"]').forEach(function(el) {
      el.style.removeProperty('display')
    })
  }

  function openBMIChecker() {
    overlay.classList.add('open')
    document.body.style.overflow = 'hidden'
    currentStep = 1
    goToStep(1)
    hideChatWidgets()
  }

  function forceCloseBMIChecker() {
    removeExitIntent()
    overlay.classList.remove('open')
    document.body.style.overflow = ''
    showChatWidgets()
  }

  function closeBMIChecker() {
    // If on step 3 with eligible result, show exit intent once before closing
    if (currentStep === 3 && lastEligibleCategory && lastEligibleCategory.eligible && !exitIntentShown) {
      if (showExitIntent()) return
    }
    forceCloseBMIChecker()
  }

  closeBtn.addEventListener('click', closeBMIChecker)
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) closeBMIChecker()
  })
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && overlay.classList.contains('open')) closeBMIChecker()
  })

  // ── Expose globally — chatbot triggers this ──
  window.openDWBMIChecker = openBMIChecker

})()
