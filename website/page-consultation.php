<?php
/**
 * Template Name: Consultation Form
 * Description: Don't Weight medical consultation — 7-step form with treatment selection
 */
// Standalone template — outputs full HTML, bypasses wp_head/wp_footer
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/favicon.svg">
<title>Medical Consultation — Check Your Eligibility | Don't Weight</title>
<meta name="description" content="Free medical weight loss consultation reviewed by UK clinicians within 24 hours. Confidential, secure, no obligation. CQC-registered clinic.">

<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="don't weight">
<meta property="og:title" content="Free Medical Consultation — Don't Weight">
<meta property="og:description" content="Free weight loss consultation reviewed by UK clinicians within 24 hours. Confidential, secure, no obligation. CQC-registered clinic.">
<meta property="og:url" content="https://dontweight.co.uk/consultation/">
<meta property="og:locale" content="en_GB">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="Free Medical Consultation — Don't Weight">
<meta name="twitter:description" content="Free weight loss consultation reviewed by UK clinicians within 24 hours. Confidential, secure, no obligation. CQC-registered clinic.">

<!-- JSON-LD Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "MedicalWebPage",
  "name": "Medical Weight Loss Consultation",
  "description": "Free medical weight loss consultation reviewed by UK-registered clinicians within 24 hours",
  "url": "https://dontweight.co.uk/consultation/",
  "lastReviewed": "2026-04-06",
  "medicalAudience": {
    "@type": "PatientAudience",
    "audienceType": "Patient"
  },
  "provider": {
    "@type": ["MedicalBusiness", "MedicalClinic"],
    "name": "don't weight",
    "url": "https://dontweight.co.uk"
  }
}
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=optional" rel="stylesheet">
<style>
.dw-lpug-bar{display:none!important;}
:root{
  --white:#FFFFFF;--cream:#FAFAF9;--warm:#F0EDE8;--stone:#E7E5E4;
  --sky:#38BDF8;--sky-deep:#0EA5E9;--sky-dark:#0284C7;--sky-pale:#E0F2FE;--sky-wash:#F0F9FF;
  --ink:#0C0A09;--charcoal:#1C1917;--slate:#44403C;
  --coral:#F97316;
  --red:#EF4444;--red-bg:#FEF2F2;
  --green:#22C55E;--green-bg:#F0FDF4;
  --display:-apple-system,BlinkMacSystemFont,'Inter','SF Pro Display','Helvetica Neue',sans-serif;--body:-apple-system,BlinkMacSystemFont,'Inter','SF Pro Display','SF Pro Text','Helvetica Neue',sans-serif;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{background:var(--cream);color:var(--ink);font-family:var(--body);font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased}
.top-bar{background:var(--white);border-bottom:1px solid var(--stone);padding:16px clamp(20px,4vw,48px);display:flex;align-items:center;justify-content:space-between}
.top-logo{font-family:var(--display);font-size:18px;font-weight:600;letter-spacing:-.3px;color:var(--ink);text-decoration:none}
.top-logo i{color:var(--sky-deep);font-style:normal;font-weight:500}
.top-secure{font-size:12px;color:var(--slate);display:flex;align-items:center;gap:6px}
.con-wrap{max-width:680px;margin:0 auto;padding:clamp(32px,5vw,56px) clamp(16px,4vw,32px)}
.con-head{margin-bottom:36px}
.con-head h1{font-family:var(--display);font-size:clamp(28px,3.5vw,36px);font-weight:700;color:var(--ink);margin-bottom:8px;letter-spacing:-.8px}
.con-head p{font-size:15px;color:var(--slate);line-height:1.7}
.con-progress{display:flex;align-items:center;gap:0;margin-bottom:8px;padding:0 4px}
.step-label{display:flex;flex-direction:column;align-items:center;gap:4px;flex-shrink:0}
.step-num{width:28px;height:28px;border-radius:50%;background:var(--stone);color:var(--slate);font-size:12px;font-weight:700;display:flex;align-items:center;justify-content:center;transition:all .3s}
.step-num.active{background:var(--sky);color:#fff}
.step-num.done{background:#22C55E;color:#fff}
.step-text{font-size:9px;color:var(--slate);font-weight:600;text-transform:uppercase;letter-spacing:.5px;white-space:nowrap}
.step-line{flex:1;height:3px;background:var(--stone);border-radius:100px;margin:0 6px;position:relative;margin-bottom:16px}
.step-line-fill{position:absolute;top:0;left:0;height:100%;background:var(--sky);border-radius:100px;transition:width .5s}
.step-encouragement{text-align:center;font-size:12px;color:var(--sky-deep);font-weight:600;margin-bottom:16px;min-height:18px;transition:opacity .3s}
.section-card{background:var(--white);border:1px solid var(--stone);border-radius:20px;padding:clamp(24px,3vw,36px);margin-bottom:20px}
.section-card h2{font-family:var(--display);font-size:22px;font-weight:700;color:var(--ink);margin-bottom:4px;letter-spacing:-.5px}
.section-card .sec-sub{font-size:13px;color:var(--slate);margin-bottom:24px}
.field{margin-bottom:18px}
.field label{display:block;font-size:13px;font-weight:600;color:var(--charcoal);margin-bottom:6px}
.field label .req{color:var(--red)}
.field input,.field select,.field textarea{width:100%;background:var(--cream);border:1.5px solid var(--stone);border-radius:12px;padding:13px 16px;font-family:var(--body);font-size:15px;color:var(--ink);outline:none;transition:border-color .2s}
.field input:focus,.field select:focus,.field textarea:focus{border-color:var(--sky)}
.field textarea{resize:vertical;min-height:80px}
.field-row{display:flex;gap:12px}
.field-row .field{flex:1}
.field-note{font-size:12px;color:var(--slate);margin-top:4px}
.opts{display:flex;flex-direction:column;gap:8px}
.opt{background:var(--cream);border:1.5px solid var(--stone);border-radius:12px;padding:14px 16px;cursor:pointer;display:flex;align-items:center;justify-content:space-between;font-size:14px;transition:border-color .2s,background .2s}
.opt:hover{border-color:var(--sky);background:var(--sky-pale)}
.opt.sel{border-color:var(--sky-deep);background:var(--sky-pale)}
.opt .chk{width:20px;height:20px;border-radius:50%;border:2px solid var(--stone);flex-shrink:0;display:flex;align-items:center;justify-content:center;transition:.2s}
.opt.sel .chk{background:var(--sky);border-color:var(--sky)}
.opt.sel .chk::after{content:'\2713';color:#fff;font-size:10px;font-weight:700}
.upload-zone{border:2px dashed var(--stone);border-radius:16px;padding:32px;text-align:center;cursor:pointer;transition:border-color .2s,background .2s;position:relative}
.upload-zone:hover{border-color:var(--sky);background:var(--sky-wash)}
.upload-zone input{position:absolute;inset:0;opacity:0;cursor:pointer}
.upload-zone .uz-icon{font-size:32px;margin-bottom:8px;color:var(--sky)}
.upload-zone .uz-title{font-size:14px;font-weight:600;color:var(--ink);margin-bottom:4px}
.upload-zone .uz-sub{font-size:12px;color:var(--slate)}
.upload-preview{margin-top:12px;display:flex;gap:8px;flex-wrap:wrap}
.upload-preview .thumb{width:64px;height:64px;border-radius:10px;background:var(--stone);display:flex;align-items:center;justify-content:center;font-size:10px;color:var(--slate);overflow:hidden}
.upload-preview .thumb img{width:100%;height:100%;object-fit:cover}
.consent-box{display:flex;gap:12px;align-items:flex-start;margin-bottom:14px}
.consent-box input[type=checkbox]{width:20px;height:20px;margin-top:2px;accent-color:var(--ink);flex-shrink:0}
.consent-box label{font-size:13px;color:var(--charcoal);line-height:1.6}
.nav-btns{display:flex;gap:12px;margin-top:32px}
.btn-back{background:var(--warm);border:none;color:var(--slate);border-radius:100px;padding:14px 28px;font-family:var(--body);font-size:14px;cursor:pointer}
.btn-next{flex:1;background:var(--sky);color:#fff;border:none;border-radius:100px;padding:16px;font-family:var(--body);font-size:15px;font-weight:600;cursor:pointer;transition:background .2s}
.btn-next:hover{background:var(--sky-deep)}
.btn-next:disabled{opacity:.5;cursor:not-allowed}
.btn-submit{flex:1;background:var(--ink);color:#fff;border:none;border-radius:100px;padding:16px;font-family:var(--body);font-size:15px;font-weight:600;cursor:pointer;transition:background .2s}
.btn-submit:hover{background:var(--charcoal)}
.err{color:var(--red);font-size:13px;font-weight:500;margin-top:8px;min-height:18px}
.yn-row{display:flex;gap:8px;margin-top:6px}
.yn-btn{flex:1;background:var(--cream);border:1.5px solid var(--stone);border-radius:12px;padding:13px;font-family:var(--body);font-size:15px;font-weight:500;color:var(--charcoal);cursor:pointer;transition:all .2s}
.yn-btn:hover{border-color:var(--sky)}
.yn-btn.sel-yes{background:var(--sky-pale);border-color:var(--sky);color:var(--sky-dark);font-weight:600}
.yn-btn.sel-no{background:var(--cream);border-color:var(--ink);color:var(--ink);font-weight:600}
.yn-detail{max-height:0;overflow:hidden;transition:max-height .3s ease,margin .3s ease;margin-top:0}
.yn-detail.open{max-height:200px;margin-top:10px}
.info-banner{background:var(--sky-pale);border:1px solid rgba(14,165,233,.15);border-radius:12px;padding:16px;font-size:13px;color:var(--sky-dark);line-height:1.6;margin-bottom:24px;display:flex;gap:10px;align-items:flex-start}
.info-banner svg{flex-shrink:0;margin-top:2px}
.warning-banner{background:#FEF3C7;border:1px solid #FCD34D;border-radius:12px;padding:16px;font-size:13px;color:#92400E;line-height:1.6;margin-bottom:24px}
.step{display:none}.step.active{display:block}
.success-screen{text-align:center;padding:40px 0}
.success-icon{width:80px;height:80px;border-radius:50%;background:var(--green-bg);border:3px solid var(--green);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:36px;color:var(--green)}
.success-screen h2{font-family:var(--display);font-size:28px;font-weight:700;margin-bottom:12px;letter-spacing:-.8px}
.success-screen p{font-size:15px;color:var(--slate);line-height:1.7;margin-bottom:24px;max-width:440px;margin-inline:auto}
.next-steps{background:var(--cream);border-radius:14px;padding:20px;text-align:left;font-size:13px;color:var(--charcoal);line-height:1.8;margin-bottom:24px}
.next-steps strong{color:var(--ink)}
@media(max-width:600px){
  .field-row{flex-direction:column;gap:0}
  .con-wrap{padding:24px 16px}
}
@keyframes spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
</style>
<?php wp_head(); ?>
</head>
<body>

<div class="top-bar">
  <a href="<?php echo esc_url(home_url('/')); ?>" class="top-logo">don't <i>weight</i></a>
  <div class="top-secure">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke="#0EA5E9" stroke-width="2" stroke-linecap="round"/></svg>
    Secure &amp; encrypted
  </div>
</div>

<div class="con-wrap">
  <div class="con-head">
    <h1>Medical Consultation</h1>
    <p>This information will be reviewed by a UK-registered clinician to determine whether GLP-1 treatment is clinically appropriate for you.</p>
  </div>

  <div class="con-progress" id="prog">
    <div class="step-label" id="sl1"><span class="step-num active">1</span><span class="step-text">Your Details</span></div>
    <div class="step-line"><div class="step-line-fill" id="progFill" style="width:0%"></div></div>
    <div class="step-label" id="sl2"><span class="step-num">2</span><span class="step-text">Medical History</span></div>
    <div class="step-line"><div class="step-line-fill" id="progFill2" style="width:0%"></div></div>
    <div class="step-label" id="sl3"><span class="step-num">3</span><span class="step-text">Treatment & Pay</span></div>
    <div class="step-line"><div class="step-line-fill" id="progFill3" style="width:0%"></div></div>
    <div class="step-label" id="sl4"><span class="step-num">4</span><span class="step-text">Book Call</span></div>
  </div>
  <div class="step-encouragement" id="stepMsg"></div>

  <!-- STEP 1: Welcome -->
  <div class="step active" id="s1">
    <div class="section-card" style="text-align:center">
      <div style="width:64px;height:64px;border-radius:50%;background:var(--sky-pale);border:2px solid var(--sky);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:28px;color:var(--sky-dark)">&#10003;</div>
      <h2>You passed the eligibility check</h2>
      <div class="sec-sub" style="max-width:440px;margin:8px auto 24px;text-align:center">Now we need some more information so our clinician can review your full medical profile and determine the right treatment for you.</div>

      <div style="background:var(--cream);border-radius:14px;padding:20px;text-align:left;font-size:13px;color:var(--charcoal);line-height:1.8;margin-bottom:24px">
        <strong>This consultation takes about 5&ndash;8 minutes and covers:</strong><br><br>
        <span style="color:var(--sky-deep);font-weight:600">1.</span> Personal &amp; contact details<br>
        <span style="color:var(--sky-deep);font-weight:600">2.</span> Medical history &amp; current medications<br>
        <span style="color:var(--sky-deep);font-weight:600">3.</span> Weight history &amp; safety screening<br>
        <span style="color:var(--sky-deep);font-weight:600">4.</span> Consent &amp; declarations<br>
        <span style="color:var(--sky-deep);font-weight:600">5.</span> Choose your treatment<br>
        <span style="color:var(--sky-deep);font-weight:600">6.</span> ID verification &amp; GP details<br>
        <span style="color:var(--sky-deep);font-weight:600">7.</span> Secure payment<br>
        <span style="color:var(--sky-deep);font-weight:600">8.</span> Book your video consultation
      </div>

      <div style="font-size:12px;color:var(--slate);line-height:1.6;margin-bottom:4px">All information is encrypted, confidential, and reviewed only by our clinical team.</div>
    </div>
    <div class="err" id="err1"></div>
    <div class="nav-btns"><button class="btn-next" onclick="nextS(1)">Begin consultation &rarr;</button></div>
  </div>

  <!-- STEP 2: Personal Details -->
  <div class="step" id="s2">
    <form id="personalForm" autocomplete="on" onsubmit="return false">
    <div class="section-card">
      <h2>Personal Details</h2>
      <div class="sec-sub">As they appear on your medical records.</div>

      <div class="field-row">
        <div class="field"><label>First name <span class="req">*</span></label><input type="text" id="fname" name="given-name" autocomplete="given-name" placeholder="First name"></div>
        <div class="field"><label>Last name <span class="req">*</span></label><input type="text" id="lname" name="family-name" autocomplete="family-name" placeholder="Last name"></div>
      </div>
      <div class="field-row">
        <div class="field"><label>Date of birth <span class="req">*</span></label><input type="date" id="dob" name="bday" autocomplete="bday"></div>
        <div class="field"><label>Biological sex <span class="req">*</span></label>
          <select id="sex" name="sex" autocomplete="sex"><option value="">Select...</option><option>Female</option><option>Male</option></select>
        </div>
      </div>
      <div class="field"><label>Email address <span class="req">*</span></label><input type="email" id="email" name="email" autocomplete="email" placeholder="your@email.com"></div>
      <div class="field"><label>Phone number <span class="req">*</span></label><input type="tel" id="phone" name="phone" autocomplete="tel" placeholder="07xxx xxxxxx"></div>
      <div class="field"><label>Home address <span class="req">*</span></label><input type="text" id="addr1" name="address-line1" autocomplete="address-line1" placeholder="Address line 1" style="margin-bottom:8px"><input type="text" id="addr2" name="address-line2" autocomplete="address-line2" placeholder="Address line 2 (optional)" style="margin-bottom:8px">
        <div class="field-row"><div class="field" style="margin-bottom:0"><input type="text" id="city" name="address-level2" autocomplete="address-level2" placeholder="City"></div><div class="field" style="margin-bottom:0"><input type="text" id="postcode" name="postal-code" autocomplete="postal-code" placeholder="Postcode"></div></div>
      </div>
    </div>
    </form>
    <div class="err" id="err2"></div>
    <div class="nav-btns"><button class="btn-back" onclick="prevS(2)">&larr; Back</button><button class="btn-next" onclick="nextS(2)">Continue &rarr;</button></div>
  </div>

  <!-- STEP 2: Medical History -->
  <div class="step" id="s3">
    <div class="section-card">
      <h2>Medical History</h2>
      <div class="sec-sub">Please answer honestly. All information is confidential and reviewed only by our clinical team.</div>

      <div class="info-banner">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" stroke="#0284C7" stroke-width="2" stroke-linecap="round"/></svg>
        <span>Providing accurate information is essential for your safety. Incomplete or inaccurate details may delay or prevent treatment.</span>
      </div>

      <div class="field">
        <label>Do you have any diagnosed medical conditions? <span class="req">*</span></label>
        <div class="yn-row">
          <button type="button" class="yn-btn" onclick="ynToggle(this,'conditions')">Yes</button>
          <button type="button" class="yn-btn" onclick="ynToggle(this,'conditions')">No</button>
        </div>
        <div class="yn-detail" id="conditions-detail">
          <textarea id="conditions" placeholder="Please list all conditions (e.g. Type 2 diabetes, high blood pressure, PCOS, sleep apnoea)"></textarea>
        </div>
      </div>

      <div class="field">
        <label>Are you currently taking any medications? <span class="req">*</span></label>
        <div class="yn-row">
          <button type="button" class="yn-btn" onclick="ynToggle(this,'medications')">Yes</button>
          <button type="button" class="yn-btn" onclick="ynToggle(this,'medications')">No</button>
        </div>
        <div class="yn-detail" id="medications-detail">
          <textarea id="medications" placeholder="List all prescription medications, over-the-counter drugs, supplements, and herbal remedies"></textarea>
        </div>
      </div>

      <div class="field">
        <label>Do you have any allergies? <span class="req">*</span></label>
        <div class="yn-row">
          <button type="button" class="yn-btn" onclick="ynToggle(this,'allergies')">Yes</button>
          <button type="button" class="yn-btn" onclick="ynToggle(this,'allergies')">No</button>
        </div>
        <div class="yn-detail" id="allergies-detail">
          <textarea id="allergies" placeholder="List all medication and food allergies"></textarea>
        </div>
      </div>

      <div class="field">
        <label>Have you had any surgeries or hospital admissions in the past 5 years? <span class="req">*</span></label>
        <div class="yn-row">
          <button type="button" class="yn-btn" onclick="ynToggle(this,'surgeries')">Yes</button>
          <button type="button" class="yn-btn" onclick="ynToggle(this,'surgeries')">No</button>
        </div>
        <div class="yn-detail" id="surgeries-detail">
          <textarea id="surgeries" placeholder="Please describe the surgery or admission, including dates"></textarea>
        </div>
      </div>

      <div class="field">
        <label>Do you have a family history of heart disease, stroke, or cancer? <span class="req">*</span></label>
        <div class="yn-row">
          <button type="button" class="yn-btn" onclick="ynToggle(this,'family')">Yes</button>
          <button type="button" class="yn-btn" onclick="ynToggle(this,'family')">No</button>
        </div>
        <div class="yn-detail" id="family-detail">
          <textarea id="family" placeholder="Please specify which conditions and which family members"></textarea>
        </div>
      </div>

      <div class="field">
        <label>Do you smoke or drink alcohol regularly? <span class="req">*</span></label>
        <div class="yn-row">
          <button type="button" class="yn-btn" onclick="ynToggle(this,'lifestyle')">Yes</button>
          <button type="button" class="yn-btn" onclick="ynToggle(this,'lifestyle')">No</button>
        </div>
        <div class="yn-detail" id="lifestyle-detail">
          <textarea id="lifestyle" placeholder="Please describe (e.g. 10 cigarettes/day, 14 units alcohol/week)"></textarea>
        </div>
      </div>
    </div>
    <div class="err" id="err3"></div>
    <div class="nav-btns"><button class="btn-back" onclick="prevS(3)">&larr; Back</button><button class="btn-next" onclick="nextS(3)">Continue &rarr;</button></div>
  </div>

  <!-- STEP 3: Weight History + Safety -->
  <div class="step" id="s4">
    <div class="section-card">
      <h2>Weight &amp; Treatment History</h2>
      <div class="sec-sub">Helps your clinician recommend the most appropriate treatment plan.</div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
        <div class="field"><label>Current weight (kg) <span class="req">*</span></label>
          <input type="number" id="weightKg" placeholder="e.g. 95" min="30" max="300" step="0.1" style="width:100%">
        </div>
        <div class="field"><label>Height (cm) <span class="req">*</span></label>
          <input type="number" id="heightCm" placeholder="e.g. 170" min="100" max="250" step="1" style="width:100%">
        </div>
      </div>

      <div class="field"><label>How long have you been concerned about your weight? <span class="req">*</span></label>
        <select id="weightDuration"><option value="">Select...</option><option>Less than 1 year</option><option>1-3 years</option><option>3-5 years</option><option>More than 5 years</option></select>
      </div>
      <div class="field"><label>Have you previously used any weight loss medication? <span class="req">*</span></label>
        <select id="prevMed" onchange="togglePrevMed()"><option value="">Select...</option><option>No, this is my first time</option><option>Yes - Mounjaro (tirzepatide)</option><option>Yes - Wegovy (semaglutide)</option><option>Yes - Saxenda (liraglutide)</option><option>Yes - Orlistat</option><option>Yes - Other</option></select>
      </div>
      <div class="field yn-detail" id="prevMedWrap">
        <label>Please provide details (dosage, duration, reason for stopping) <span class="req">*</span></label>
        <textarea id="prevMedDetails" placeholder="e.g. 'Wegovy 1.7mg for 4 months, stopped due to nausea'"></textarea>
      </div>

      <div class="warning-banner" style="margin-top:24px">
        <strong>Important safety questions</strong> &mdash; Please confirm:
      </div>

      <div class="field"><label>Are you pregnant, breastfeeding, or planning to become pregnant? <span class="req">*</span></label>
        <div class="yn-row">
          <button type="button" class="yn-btn" onclick="ynSafety(this,'pregnant')">Yes</button>
          <button type="button" class="yn-btn" onclick="ynSafety(this,'pregnant')">No</button>
        </div>
        <input type="hidden" id="pregnant" value="">
      </div>
      <div class="field"><label>Do you have a personal or family history of medullary thyroid carcinoma (MTC) or MEN 2? <span class="req">*</span></label>
        <div class="yn-row">
          <button type="button" class="yn-btn" onclick="ynSafety(this,'thyroid')">Yes</button>
          <button type="button" class="yn-btn" onclick="ynSafety(this,'thyroid')">No</button>
          <button type="button" class="yn-btn" onclick="ynSafety(this,'thyroid')">Not sure</button>
        </div>
        <input type="hidden" id="thyroid" value="">
      </div>
      <div class="field"><label>Have you ever been diagnosed with pancreatitis? <span class="req">*</span></label>
        <div class="yn-row">
          <button type="button" class="yn-btn" onclick="ynSafety(this,'pancreatitis')">Yes</button>
          <button type="button" class="yn-btn" onclick="ynSafety(this,'pancreatitis')">No</button>
        </div>
        <input type="hidden" id="pancreatitis" value="">
      </div>
      <div class="field"><label>Do you currently have or have you recently had an eating disorder? <span class="req">*</span></label>
        <div class="yn-row">
          <button type="button" class="yn-btn" onclick="ynSafety(this,'eating')">Yes</button>
          <button type="button" class="yn-btn" onclick="ynSafety(this,'eating')">No</button>
        </div>
        <input type="hidden" id="eating" value="">
      </div>
      <div class="field"><label>If you are female and of childbearing age, what contraception do you currently use?</label>
        <input type="text" id="contraception" placeholder="e.g. Combined pill, IUD, condoms, N/A">
        <div class="field-note">GLP-1 medications may reduce the effectiveness of oral contraceptives. Your clinician will advise.</div>
      </div>
    </div>
    <div class="err" id="err4"></div>
    <div class="nav-btns"><button class="btn-back" onclick="prevS(4)">&larr; Back</button><button class="btn-next" onclick="nextS(4)">Continue &rarr;</button></div>
  </div>

  <!-- STEP 4: Consent -->
  <div class="step" id="s5">
    <div class="section-card">
      <h2>Consent &amp; Declaration</h2>
      <div class="sec-sub">Please read and confirm the following before submitting.</div>

      <div style="background:var(--sky-wash);border:1px solid var(--sky-pale);border-radius:12px;padding:12px 16px;margin-bottom:18px;display:flex;align-items:center;gap:12px;cursor:pointer" onclick="tickAll(this)">
        <input type="checkbox" id="cAll" style="width:20px;height:20px;accent-color:var(--sky);flex-shrink:0" onchange="tickAll(this.parentElement)">
        <label for="cAll" style="font-size:14px;font-weight:600;color:var(--ink);cursor:pointer">Tick all declarations</label>
      </div>

      <div class="consent-box"><input type="checkbox" id="c1" class="consent-cb"><label for="c1">I confirm that all information I have provided is accurate and complete to the best of my knowledge. I understand that providing false or misleading information may affect my treatment and safety. <span style="color:var(--red)">*</span></label></div>

      <div class="consent-box"><input type="checkbox" id="c2" class="consent-cb"><label for="c2">I understand that a GPhC-registered prescribing pharmacist will review my information and determine whether GLP-1 medication is clinically appropriate. Approval is not guaranteed. <span style="color:var(--red)">*</span></label></div>

      <div class="consent-box"><input type="checkbox" id="c3" class="consent-cb"><label for="c3">I consent to Don't Weight storing and processing my personal and medical data in accordance with GDPR and UK data protection law, solely for the purpose of providing clinical care. <span style="color:var(--red)">*</span></label></div>

      <div class="consent-box"><input type="checkbox" id="c4" class="consent-cb"><label for="c4">I understand that GLP-1 medications may cause side effects and that I should report any adverse reactions to my prescribing clinician. I will read the patient information leaflet provided with my medication. <span style="color:var(--red)">*</span></label></div>

      <div class="consent-box"><input type="checkbox" id="c5" class="consent-cb"><label for="c5">I understand that payment is taken upon completing this consultation. If my application is not approved by the clinical team, I will receive a full refund within 5 working days. <span style="color:var(--red)">*</span></label></div>

      <div class="consent-box"><input type="checkbox" id="c6" class="consent-cb"><label for="c6">I agree to respond promptly to any follow-up questions from the clinical team if my application requires further clarification before a decision can be made. <span style="color:var(--red)">*</span></label></div>

      <div class="consent-box"><input type="checkbox" id="c7" class="consent-cb"><label for="c7">I understand that a live video consultation with my prescribing clinician is required before treatment can be approved, as per GPhC regulations for weight management medication. I agree to attend this consultation when arranged. <span style="color:var(--red)">*</span></label></div>
    </div>
    <div class="err" id="err5"></div>
    <div class="nav-btns"><button class="btn-back" onclick="prevS(5)">&larr; Back</button><button class="btn-next" onclick="nextS(5)">Continue &rarr;</button></div>
  </div>

  <!-- STEP 6: Treatment Selection + Payment -->
  <div class="step" id="s6">
    <div class="section-card">
      <h2>Choose Your Treatment</h2>
      <div class="sec-sub">Based on your profile, our clinical team recommends the following options. Your prescribing pharmacist will confirm the final treatment after reviewing your full consultation.</div>

      <div class="info-banner">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" stroke="#0284C7" stroke-width="2" stroke-linecap="round"/></svg>
        <span><strong>Refund guarantee:</strong> If your application is not approved by our clinical team, you will receive a full refund. No payment is retained for unsuccessful applications.</span>
      </div>

      <!-- Mounjaro -->
      <div class="treat-select-card" id="sel-mounjaro" onclick="selectTreat('mounjaro')" style="border:2px solid var(--sky);background:var(--sky-wash);border-radius:16px;padding:24px;margin-bottom:14px;cursor:pointer;position:relative;transition:all .2s;overflow:visible">
        <div style="position:absolute;top:-10px;left:20px;background:var(--coral);color:#fff;padding:4px 14px;border-radius:100px;font-size:10px;font-weight:700;letter-spacing:.5px;text-transform:uppercase">Recommended</div>
        <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:12px">
          <div style="flex:1;min-width:200px">
            <h3 style="font-family:var(--display);font-size:22px;font-weight:700;color:var(--ink);margin-bottom:4px;letter-spacing:-.5px">Mounjaro</h3>
            <div style="font-size:13px;color:var(--sky-dark);font-weight:600;margin-bottom:8px">Tirzepatide &mdash; dual GIP/GLP-1 receptor agonist</div>
            <p style="font-size:13px;color:var(--charcoal);line-height:1.6">The most effective GLP-1 treatment available. Up to 23% body weight loss in clinical trials. Once-weekly injection.</p>
          </div>
          <div style="text-align:right;min-width:120px">
            <div style="font-family:var(--display);font-size:28px;font-weight:700;color:var(--ink);letter-spacing:-1px">&pound;150</div>
            <div style="font-size:12px;color:var(--slate)">first month</div>
            <div style="font-size:12px;color:var(--slate);margin-top:2px">then from &pound;170/month</div>
            <div style="font-size:10px;color:var(--slate);margin-top:1px">(dosage dependent)</div>
          </div>
        </div>
        <div style="margin-top:12px;font-size:12px;color:var(--charcoal);line-height:1.6">Includes: medication, clinical review, personalised plan, free next-day delivery, ongoing clinician support.</div>
        <div class="treat-check" style="position:absolute;top:-13px;right:-13px;width:26px;height:26px;border-radius:50%;border:2.5px solid var(--sky-dark);display:flex;align-items:center;justify-content:center;background:var(--sky-dark);color:#fff;font-size:12px;font-weight:700">&#10003;</div>
      </div>

      <!-- Wegovy -->
      <div class="treat-select-card" id="sel-wegovy" onclick="selectTreat('wegovy')" style="border:2px solid var(--stone);background:var(--white);border-radius:16px;padding:24px;margin-bottom:20px;cursor:pointer;position:relative;transition:all .2s;overflow:visible">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:12px">
          <div style="flex:1;min-width:200px">
            <h3 style="font-family:var(--display);font-size:22px;font-weight:700;color:var(--ink);margin-bottom:4px;letter-spacing:-.5px">Wegovy</h3>
            <div style="font-size:13px;color:var(--sky-dark);font-weight:600;margin-bottom:8px">Semaglutide &mdash; GLP-1 receptor agonist</div>
            <p style="font-size:13px;color:var(--charcoal);line-height:1.6">A proven and trusted GLP-1 treatment. Up to 15% body weight loss in clinical trials. Once-weekly injection.</p>
          </div>
          <div style="text-align:right;min-width:120px">
            <div style="font-family:var(--display);font-size:28px;font-weight:700;color:var(--ink);letter-spacing:-1px">&pound;114</div>
            <div style="font-size:12px;color:var(--slate)">first month</div>
          </div>
        </div>
        <div style="margin-top:12px;font-size:12px;color:var(--charcoal);line-height:1.6">Includes: medication, clinical review, personalised plan, free next-day delivery, ongoing clinician support.</div>
        <div class="treat-check" style="position:absolute;top:-13px;right:-13px;width:26px;height:26px;border-radius:50%;border:2.5px solid var(--stone);display:flex;align-items:center;justify-content:center;background:transparent;color:transparent;font-size:12px;font-weight:700">&#10003;</div>
      </div>

      <!-- Dose selector (shown for patients switching provider) -->
      <div id="doseSelectArea" style="display:none;background:var(--cream);border-radius:16px;padding:20px;margin-bottom:16px">
        <div style="font-size:13px;font-weight:700;color:var(--ink);margin-bottom:4px">Select your dose</div>
        <div id="doseNote" style="font-size:11px;color:var(--sky-dark);margin-bottom:12px;font-weight:500"></div>
        <div id="doseOptions" style="display:flex;flex-wrap:wrap;gap:8px"></div>
      </div>

      <div style="background:var(--cream);border-radius:12px;padding:16px;font-size:12px;color:var(--charcoal);line-height:1.7;margin-bottom:12px">
        <strong>How pricing works:</strong> All prices shown are starting prices. Your exact monthly cost depends on your prescribed dosage, which your pharmacist will determine based on your clinical needs. You will always be informed of the exact cost before each prescription is dispensed. You can stop treatment at any time with no further charges.
      </div>

      <div style="font-size:12px;color:var(--slate);line-height:1.6">
        <strong>Refund policy:</strong> If your consultation is reviewed and treatment is not approved, you will receive a full refund within 5 working days. If you are approved and wish to cancel before your medication is dispatched, you may do so at no cost.
      </div>
    </div>
    <div class="err" id="err6"></div>
    <div class="nav-btns"><button class="btn-back" onclick="prevS(6)">&larr; Back</button><button class="btn-next" onclick="nextS(6)">Continue to payment &rarr;</button></div>
  </div>

  <!-- STEP 8: Book & Pay with Semble -->
  <div class="step" id="s8">
    <div class="section-card">

      <!-- Phone / help banner -->
      <div style="background:var(--sky-pale);border:1px solid var(--sky);border-radius:14px;padding:16px 20px;margin-bottom:24px;display:flex;align-items:center;gap:14px;flex-wrap:wrap">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0284C7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
        <div style="flex:1;min-width:220px">
          <div style="font-size:14px;font-weight:600;color:var(--ink);margin-bottom:2px">Any questions or doubts?</div>
          <div style="font-size:13px;color:var(--charcoal)">Call us on <a href="tel:+442071013377" style="color:var(--sky-deep);font-weight:700;text-decoration:none">+44 20 7101 3377</a> &mdash; our team is happy to help.</div>
        </div>
      </div>

      <h2>Book your appointment</h2>
      <div class="sec-sub">Please book your appointment with our clinician using the form below. You will be able to choose a time slot and pay securely in one step.</div>

      <div class="info-banner">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke="#0284C7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <span><strong>100% refund guarantee:</strong> If your application is not approved by our clinical team, you will receive a full refund within 5 working days.</span>
      </div>

      <!-- Wrap-up / how-it-works panel (shown above whichever iframe is active) -->
      <div id="semble-wrap" style="background:var(--sky-wash);border:1px solid var(--sky-pale);border-radius:14px;padding:20px 22px;margin-top:22px;margin-bottom:18px;display:none">
        <p style="font-size:14px;font-weight:700;color:var(--ink);margin:0 0 10px;letter-spacing:-.2px">To proceed &mdash; book your online consultation below</p>
        <ul style="margin:0;padding:0;list-style:none;font-size:13px;color:var(--charcoal);line-height:1.65">
          <li style="display:flex;gap:10px;margin-bottom:8px">
            <span style="color:var(--sky-deep);font-weight:700;flex-shrink:0">&#10003;</span>
            <span>Choose a date and time for your video consultation with our UK-registered clinician.</span>
          </li>
          <li style="display:flex;gap:10px;margin-bottom:8px">
            <span style="color:var(--sky-deep);font-weight:700;flex-shrink:0">&#10003;</span>
            <span>You will be charged for the clinically-appropriate <strong>starter dose</strong>. If a higher dose is recommended by your clinician during the consultation, the price difference will be adjusted with you directly before anything is dispensed.</span>
          </li>
          <li style="display:flex;gap:10px;margin-bottom:0">
            <span style="color:var(--sky-deep);font-weight:700;flex-shrink:0">&#10003;</span>
            <span><strong>100% refund guarantee:</strong> if you are not eligible, or if you decide not to proceed after your consultation, your payment will be refunded immediately and in full.</span>
          </li>
        </ul>
      </div>

      <!-- SEMBLE BOOKING IFRAME — shown based on selected treatment -->
      <!-- MOUNJARO iframe slot -->
      <div id="semble-mounjaro-area" style="display:none;margin-top:8px">
        <div style="background:var(--cream);border-radius:14px;padding:12px 16px;margin-bottom:12px;display:flex;align-items:center;gap:14px;flex-wrap:wrap">
          <img src="/wp-content/uploads/2026/04/Mounjaro.jpeg" alt="Mounjaro pens" loading="lazy" style="height:56px;width:auto;max-width:120px;object-fit:contain;flex-shrink:0">
          <div style="font-size:13px;color:var(--charcoal);line-height:1.4"><strong style="color:var(--ink)">Selected treatment:</strong> Mounjaro (Tirzepatide) &mdash; starter dose</div>
        </div>
        <div style="background:var(--white);border:2px solid var(--sky);border-radius:16px;padding:4px;min-height:650px;box-shadow:0 4px 24px rgba(56,189,248,.12)">
          <iframe src="https://online-booking.semble.io/?token=b0e756507669c936e11ff974f808546cc2f85482" width="100%" height="800" frameborder="0" scrolling="auto" allow="payment *" style="border:none;border-radius:12px;display:block;width:100%"></iframe>
        </div>
      </div>

      <!-- WEGOVY iframe slot -->
      <div id="semble-wegovy-area" style="display:none;margin-top:8px">
        <div style="background:var(--cream);border-radius:14px;padding:12px 16px;margin-bottom:12px;display:flex;align-items:center;gap:14px;flex-wrap:wrap">
          <img src="/wp-content/uploads/2026/04/wegovy.jpeg" alt="Wegovy pens" loading="lazy" style="height:56px;width:auto;max-width:120px;object-fit:contain;flex-shrink:0">
          <div style="font-size:13px;color:var(--charcoal);line-height:1.4"><strong style="color:var(--ink)">Selected treatment:</strong> Wegovy (Semaglutide) &mdash; starter dose</div>
        </div>
        <div style="background:var(--white);border:2px solid var(--sky);border-radius:16px;padding:4px;min-height:650px;box-shadow:0 4px 24px rgba(56,189,248,.12)">
          <iframe src="https://online-booking.semble.io/?token=d17e08266e35433bb6d733213b4728b61c3641c3" width="100%" height="800" frameborder="0" scrolling="auto" allow="payment *" style="border:none;border-radius:12px;display:block;width:100%"></iframe>
        </div>
      </div>

      <div style="text-align:center;margin-top:24px;padding:16px;background:var(--cream);border-radius:12px">
        <p style="font-size:13px;color:var(--charcoal);line-height:1.6;margin:0">Having trouble booking? Call us on <a href="tel:+442071013377" style="color:var(--sky-deep);font-weight:700;text-decoration:none">+44 20 7101 3377</a> or email <a href="mailto:hello@dontweight.co.uk" style="color:var(--sky-deep);font-weight:700;text-decoration:none">hello@dontweight.co.uk</a></p>
      </div>
    </div>
    <div class="err" id="err8"></div>
    <div class="nav-btns"><button class="btn-back" onclick="prevS(8)">&larr; Back</button></div>
  </div>

</div>

<div style="background:var(--ink);padding:24px;text-align:center;font-size:11px;color:rgba(255,255,255,.35);margin-top:40px">
  &copy; <?php echo date('Y'); ?> don't weight — a trading name of Ultrasound London Limited. All rights reserved. <a href="https://londonsono.com" style="color:rgba(255,255,255,.5);text-decoration:none">londonsono.com</a>
</div>

<script>
// (Stripe + Cal.com integrations removed — booking handled via Semble iframe on step 8)

let step=1;
const totalSteps=4;

function showStep(n){
  document.querySelectorAll('.step').forEach(s=>s.classList.remove('active'));
  document.getElementById('s'+n).classList.add('active');

  // Map form steps to 4 progress phases
  // 1-2: Your Details | 3-5: Medical History | 6: Choose Treatment | 8: Book Appointment
  const phaseMap={1:1,2:1,3:2,4:2,5:2,6:3,8:4};
  const phase=phaseMap[n]||1;

  // Update step numbers
  for(let i=1;i<=4;i++){
    const num=document.querySelector('#sl'+i+' .step-num');
    num.classList.remove('active','done');
    if(i<phase)num.classList.add('done');
    if(i===phase)num.classList.add('active');
  }

  // Fill progress lines
  const subSteps={1:[1,2],2:[3,4,5],3:[6],4:[8]};
  for(let i=1;i<=3;i++){
    const fill=document.getElementById('progFill'+(i>1?i:''));
    if(i<phase){fill.style.width='100%'}
    else if(i===phase){
      const sub=subSteps[phase];
      const pct=Math.round(((n-sub[0])/(sub.length))*100);
      fill.style.width=pct+'%';
    } else {fill.style.width='0%'}
  }
  
  // Encouragement messages
  const msgs={
    1:'Let\'s get started',
    2:'Step 1 of 4 — Your details',
    3:'Step 2 of 4 — Medical history',
    4:'Halfway there!',
    5:'Almost done with medical info',
    6:'Step 3 of 4 — Choose treatment',
    8:'Step 4 of 4 — Book your appointment'
  };
  const msgEl=document.getElementById('stepMsg');
  if(msgEl)msgEl.textContent=msgs[n]||'';
  
  window.scrollTo({top:0,behavior:'smooth'});
}

function nextS(current){
  const errId='err'+current;
  document.getElementById(errId).textContent='';

  // Step 1: Welcome - no validation
  // Step 2: Personal Details
  if(current===2){
    const f=document.getElementById('fname').value.trim();
    const l=document.getElementById('lname').value.trim();
    const d=document.getElementById('dob').value;
    const s=document.getElementById('sex').value;
    const e=document.getElementById('email').value.trim();
    const p=document.getElementById('phone').value.trim();
    const a=document.getElementById('addr1').value.trim();
    const c=document.getElementById('city').value.trim();
    const pc=document.getElementById('postcode').value.trim();
    if(!f||!l){document.getElementById(errId).textContent='Please enter your first and last name.';return}
    if(!d){document.getElementById(errId).textContent='Please enter your date of birth.';return}
    if(!s){document.getElementById(errId).textContent='Please select your biological sex.';return}
    if(!e||!e.includes('@')||!e.includes('.')){document.getElementById(errId).textContent='Please enter a valid email address.';return}
    if(!p||p.replace(/\D/g,'').length<10){document.getElementById(errId).textContent='Please enter a valid UK phone number.';return}
    if(!a||!c||!pc){document.getElementById(errId).textContent='Please enter your full address including postcode.';return}
  }
  // Step 3: Medical History - yes/no toggles
  if(current===3){
    const fields=['conditions','medications','allergies','surgeries','family','lifestyle'];
    for(const f of fields){
      const row=document.querySelector('#'+f+'-detail').previousElementSibling;
      const selected=row.querySelector('.sel-yes,.sel-no');
      if(!selected){document.getElementById(errId).textContent='Please answer all questions.';return}
      if(selected.classList.contains('sel-yes')){
        const ta=document.getElementById(f);
        if(!ta.value.trim()){document.getElementById(errId).textContent='Please provide details for the questions you answered Yes to.';return}
      }
    }
  }
  // Step 4: Weight & Safety
  if(current===4){
    const wKg=document.getElementById('weightKg').value;
    const hCm=document.getElementById('heightCm').value;
    if(!wKg||!hCm){document.getElementById(errId).textContent='Please enter your current weight and height.';return}
    if(parseFloat(wKg)<30||parseFloat(wKg)>300){document.getElementById(errId).textContent='Please enter a valid weight in kg.';return}
    if(parseFloat(hCm)<100||parseFloat(hCm)>250){document.getElementById(errId).textContent='Please enter a valid height in cm.';return}
    const wd=document.getElementById('weightDuration').value;
    const pm=document.getElementById('prevMed').value;
    const preg=document.getElementById('pregnant').value;
    const thy=document.getElementById('thyroid').value;
    const pan=document.getElementById('pancreatitis').value;
    const eat=document.getElementById('eating').value;
    if(!wd||!pm||!preg||!thy||!pan||!eat){document.getElementById(errId).textContent='Please answer all required safety questions.';return}
    if(preg==='Yes'){document.getElementById(errId).textContent='GLP-1 medications are contraindicated during pregnancy and breastfeeding. Please consult your GP.';return}
    if(thy==='Yes'){document.getElementById(errId).textContent='A history of medullary thyroid carcinoma or MEN 2 is a contraindication. Please consult your specialist.';return}
    if(pan==='Yes'){document.getElementById(errId).textContent='A history of pancreatitis requires specialist review before GLP-1 treatment can be considered.';return}
    if(eat==='Yes'){document.getElementById(errId).textContent='Active eating disorders require specialist support. GLP-1 medication is not appropriate at this time. Please speak with your GP.';return}
  }
  // Step 5: Consent
  if(current===5){
    const checks=['c1','c2','c3','c4','c5','c6','c7'];
    const allChecked=checks.every(id=>document.getElementById(id).checked);
    if(!allChecked){document.getElementById(errId).textContent='Please confirm all consent checkboxes to continue.';return}
  }
  // Step 6: Treatment selection - always valid (one is pre-selected)

  // Skip step 7 (removed)
  // When leaving step 6 (treatment selection), submit all medical data before showing payment
  if(current===6){
    submitAll(); // This sets step=8 and shows it
    return;
  }
  step = current + 1;
  showStep(step);
}

function prevS(current){
  // Skip step 7 (removed)
  step = current === 8 ? 6 : current - 1;
  showStep(step);
}

function submitAll(){
  // Collect all consultation form data
  const fields=['fname','lname','dob','sex','email','phone','addr1','addr2','city','postcode',
    'conditions','medications','allergies','surgeries','family','lifestyle',
    'weightKg','heightCm','weightDuration','prevMed','prevMedDetails','pregnant','thyroid',
    'pancreatitis','eating','contraception'];

  const allData={};
  fields.forEach(f=>{
    const el=document.getElementById(f);
    if(el) allData[f]=el.value||el.textContent||'';
  });

  // Calculate BMI from weight/height if available, fallback to URL param
  const wKg=parseFloat(allData.weightKg)||0;
  const hCm=parseFloat(allData.heightCm)||0;
  if(wKg>0&&hCm>0){
    allData.bmi=(wKg/((hCm/100)**2)).toFixed(1);
  } else {
    const urlParams=new URLSearchParams(window.location.search);
    allData.bmi=urlParams.get('bmi')||'';
  }

  // Consents
  for(let i=1;i<=7;i++){
    const c=document.getElementById('c'+i);
    allData['consent_'+i]=c&&c.checked?'Yes':'No';
  }

  // Build readable answers
  const answerLines=[];
  Object.keys(allData).forEach(k=>{ if(allData[k]) answerLines.push(k+': '+allData[k]); });

  // Submit to server
  const fd=new FormData();
  fd.append('action','dw_submit_app');
  fd.append('nonce',typeof dwAjax!=='undefined'?dwAjax.nonce:'');
  fd.append('first_name',allData.fname||'');
  fd.append('last_name',allData.lname||'');
  fd.append('email',allData.email||'');
  fd.append('phone',allData.phone||'');
  fd.append('dob',allData.dob||'');
  fd.append('gender',allData.sex||'');
  fd.append('weight_kg',allData.weightKg||'');
  fd.append('height_cm',allData.heightCm||'');
  fd.append('bmi',allData.bmi||'');
  fd.append('treatment_choice',selectedTreat||'');
  if(selectedTargetDose&&selectedTargetDose!==selectedTreat){
    fd.append('target_dose',selectedTargetDose);
  }
  fd.append('stage','consultation');
  fd.append('address',[(allData.addr1||''),(allData.addr2||''),(allData.city||''),(allData.postcode||'')].filter(Boolean).join(', '));
  fd.append('conditions',allData.conditions||'');
  fd.append('medications',allData.medications||'');
  fd.append('allergies',allData.allergies||'');
  fd.append('surgeries',allData.surgeries||'');
  fd.append('family_history',allData.family||'');
  fd.append('lifestyle',allData.lifestyle||'');
  fd.append('prev_medication',allData.prevMed||'');
  fd.append('prev_med_details',allData.prevMedDetails||'');
  fd.append('answers',answerLines.join('\n'));
  
  const ajaxUrl=typeof dwAjax!=='undefined'?dwAjax.url:'/wp-admin/admin-ajax.php';
  fetch(ajaxUrl,{method:'POST',body:fd}).catch(()=>{});

  // Also send to Supabase via portal capture-lead function
  var leadPayload={
    first_name:allData.fname||'',
    last_name:allData.lname||'',
    email:allData.email||'',
    phone:allData.phone||'',
    source:'consultation',
    page_url:window.location.href,
    date_of_birth:allData.dob||'',
    treatment:selectedTreat||'mounjaro',
    consent_data_processing:true,
    questionnaire_data:{
      sex:allData.sex||'',
      address:[(allData.addr1||''),(allData.addr2||''),(allData.city||''),(allData.postcode||'')].filter(Boolean).join(', '),
      medical_conditions:allData.conditions||'',
      medications:allData.medications||'',
      allergies:allData.allergies||'',
      surgeries:allData.surgeries||'',
      family_history:allData.family||'',
      smoking_alcohol:allData.lifestyle||'',
      weight_concern_duration:allData.weightDuration||'',
      previous_medication:allData.prevMed||'',
      previous_medication_details:allData.prevMedDetails||'',
      pregnant:allData.pregnant||'',
      thyroid_cancer:allData.thyroid||'',
      pancreatitis:allData.pancreatitis||'',
      eating_disorder:allData.eating||'',
      contraception:allData.contraception||'',
      target_dose:selectedTargetDose||''
    }
  };
  // Add UTM params if available
  var utmKeys=['utm_source','utm_medium','utm_campaign'];
  utmKeys.forEach(function(k){var v=sessionStorage.getItem(k);if(v)leadPayload[k]=v;});

  fetch('https://app.dontweight.co.uk/.netlify/functions/capture-lead',{
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body:JSON.stringify(leadPayload)
  }).catch(function(){});

  step=8;
  showStep(8);
  showSembleForTreatment();
}

// Show correct Semble iframe based on selected treatment (only one at a time)
function showSembleForTreatment(){
  const base = (selectedTreat||'mounjaro').startsWith('wegovy') ? 'wegovy' : 'mounjaro';
  const m = document.getElementById('semble-mounjaro-area');
  const w = document.getElementById('semble-wegovy-area');
  const wrap = document.getElementById('semble-wrap');
  if(m) m.style.display = (base === 'mounjaro') ? 'block' : 'none';
  if(w) w.style.display = (base === 'wegovy')   ? 'block' : 'none';
  if(wrap) wrap.style.display = 'block';
}

function tickAll(el){
  var master=document.getElementById('cAll');
  var boxes=document.querySelectorAll('.consent-cb');
  boxes.forEach(function(b){b.checked=master.checked;});
}

// (processPayment, submitVideoRequest, skip-booking helpers removed —
//  Semble iframe on step 8 handles both booking and payment.)

// Dose data
const doseData={
  mounjaro:[
    {id:'mounjaro',dose:'2.5mg',price:150,ongoing:170,starter:true},
    {id:'mounjaro-5',dose:'5mg',price:185,ongoing:185},
    {id:'mounjaro-7.5',dose:'7.5mg',price:250,ongoing:250},
    {id:'mounjaro-10',dose:'10mg',price:275,ongoing:275},
    {id:'mounjaro-12.5',dose:'12.5mg',price:285,ongoing:285},
    {id:'mounjaro-15',dose:'15mg',price:310,ongoing:310},
  ],
  wegovy:[
    {id:'wegovy',dose:'0.25mg',price:114,ongoing:139,starter:true},
    {id:'wegovy-0.5',dose:'0.5mg',price:139,ongoing:139},
    {id:'wegovy-1',dose:'1mg',price:169,ongoing:169},
    {id:'wegovy-1.7',dose:'1.7mg',price:199,ongoing:199},
    {id:'wegovy-2.4',dose:'2.4mg',price:229,ongoing:229},
  ]
};

let selectedTargetDose=null;

function renderDoseSelector(){
  const area=document.getElementById('doseSelectArea');
  const opts=document.getElementById('doseOptions');
  const note=document.getElementById('doseNote');
  const baseTreat=selectedTreat.startsWith('wegovy')?'wegovy':'mounjaro';
  const doses=doseData[baseTreat]||[];
  const starter=doses.find(d=>d.starter);

  area.style.display='block';
  note.innerHTML='All patients start on the starter dose (&pound;'+starter.price+'/mo). Switching provider? Your clinician can approve a higher dose after consultation. Price adjusts from your next order.';
  opts.innerHTML='';
  selectedTargetDose=null;
  // Always charge starter dose
  selectedTreat=starter.id;

  doses.forEach(d=>{
    const btn=document.createElement('button');
    btn.type='button';
    btn.innerHTML=d.dose+(d.starter?' <small style="color:var(--sky-dark)">(starter &mdash; &pound;'+d.price+'/mo)</small>':' <small style="color:var(--slate)">&pound;'+d.price+'/mo</small>');
    btn.style.cssText='padding:10px 16px;border-radius:100px;border:2px solid var(--stone);background:var(--white);font-family:var(--body);font-size:13px;font-weight:600;cursor:pointer;transition:all .2s;color:var(--charcoal)';
    btn.onclick=function(){
      opts.querySelectorAll('button').forEach(b=>{b.style.borderColor='var(--stone)';b.style.background='var(--white)';b.style.color='var(--charcoal)'});
      btn.style.borderColor='var(--sky)';btn.style.background='var(--sky-wash)';btn.style.color='var(--sky-dark)';
      selectedTargetDose=d.id;
      // Always charge starter price regardless of selection
      selectedTreat=starter.id;
    };
    if(d.starter)btn.click();
    opts.appendChild(btn);
  });
}

// Treatment selection
let selectedTreat='mounjaro'; // default
function selectTreat(treat){
  selectedTreat=treat;
  const mCard=document.getElementById('sel-mounjaro');
  const oCard=document.getElementById('sel-wegovy');
  if(treat==='mounjaro'||treat.startsWith('mounjaro')){
    mCard.style.borderColor='var(--sky)';mCard.style.background='var(--sky-wash)';
    mCard.querySelector('.treat-check').style.cssText='position:absolute;top:-13px;right:-13px;width:26px;height:26px;border-radius:50%;border:2.5px solid var(--sky-dark);display:flex;align-items:center;justify-content:center;background:var(--sky-dark);color:#fff;font-size:12px;font-weight:700';
    oCard.style.borderColor='var(--stone)';oCard.style.background='var(--white)';
    oCard.querySelector('.treat-check').style.cssText='position:absolute;top:-13px;right:-13px;width:26px;height:26px;border-radius:50%;border:2.5px solid var(--stone);display:flex;align-items:center;justify-content:center;background:transparent;color:transparent;font-size:12px;font-weight:700';
    selectedTreat='mounjaro';
  } else {
    oCard.style.borderColor='var(--sky)';oCard.style.background='var(--sky-wash)';
    oCard.querySelector('.treat-check').style.cssText='position:absolute;top:-13px;right:-13px;width:26px;height:26px;border-radius:50%;border:2.5px solid var(--sky-dark);display:flex;align-items:center;justify-content:center;background:var(--sky-dark);color:#fff;font-size:12px;font-weight:700';
    mCard.style.borderColor='var(--stone)';mCard.style.background='var(--white)';
    mCard.querySelector('.treat-check').style.cssText='position:absolute;top:-13px;right:-13px;width:26px;height:26px;border-radius:50%;border:2.5px solid var(--stone);display:flex;align-items:center;justify-content:center;background:transparent;color:transparent;font-size:12px;font-weight:700';
    selectedTreat='wegovy';
  }
  renderDoseSelector();
}

function ynToggle(btn,fieldId){
  const row=btn.parentElement;
  row.querySelectorAll('.yn-btn').forEach(b=>{b.classList.remove('sel-yes','sel-no')});
  const isYes=btn.textContent==='Yes';
  btn.classList.add(isYes?'sel-yes':'sel-no');
  const detail=document.getElementById(fieldId+'-detail');
  const textarea=document.getElementById(fieldId);
  if(isYes){
    detail.classList.add('open');
    // Clear "None reported" if switching to Yes
    if(textarea && textarea.value==='None reported') textarea.value='';
  } else {
    detail.classList.remove('open');
    // Record explicit "No" answer so clinician knows patient was asked
    if(textarea) textarea.value='None reported';
  }
}

function ynSafety(btn,fieldId){
  const row=btn.parentElement;
  row.querySelectorAll('.yn-btn').forEach(b=>{b.classList.remove('sel-yes','sel-no')});
  const val=btn.textContent;
  btn.classList.add(val==='No'?'sel-no':'sel-yes');
  document.getElementById(fieldId).value=val;
}

function togglePrevMed(){
  const val=document.getElementById('prevMed').value;
  const wrap=document.getElementById('prevMedWrap');
  if(val&&val!=='No, this is my first time'){wrap.classList.add('open')}else{wrap.classList.remove('open')}
}

function handleUpload(input,zoneId,previewId){
  const file=input.files[0];
  if(!file)return;
  const preview=document.getElementById(previewId);
  preview.innerHTML='';
  const thumb=document.createElement('div');
  thumb.className='thumb';
  if(file.type.startsWith('image/')){
    const img=document.createElement('img');
    img.src=URL.createObjectURL(file);
    thumb.appendChild(img);
  } else {
    thumb.textContent=file.name.substring(0,8)+'...';
  }
  preview.appendChild(thumb);
  const name=document.createElement('span');
  name.style.cssText='font-size:12px;color:var(--slate)';
  name.textContent=file.name+' ('+Math.round(file.size/1024)+'KB)';
  preview.appendChild(name);
}
// Pre-fill from URL params (passed from eligibility screener)
const params=new URLSearchParams(window.location.search);
if(params.get('fn'))document.getElementById('fname').value=params.get('fn');
if(params.get('ln'))document.getElementById('lname').value=params.get('ln');
if(params.get('em'))document.getElementById('email').value=params.get('em');

// Post-payment return handler — detect ?paid=1 and jump to booking step
if(params.get('paid')==='1'){
  try{
    var saved=JSON.parse(localStorage.getItem('dw_consultation_state')||'{}');
    // Only restore if saved within last 2 hours
    if(saved.timestamp && (Date.now()-saved.timestamp)<7200000){
      // Restore key fields for display
      if(saved.fname)document.getElementById('fname').value=saved.fname;
      if(saved.lname)document.getElementById('lname').value=saved.lname;
      if(saved.email)document.getElementById('email').value=saved.email;
      if(saved.phone)document.getElementById('phone').value=saved.phone;
      if(saved.treatment)selectedTreat=saved.treatment;
      if(saved.targetDose)selectedTargetDose=saved.targetDose;
    }
    localStorage.removeItem('dw_consultation_state');
  }catch(e){}
  // Jump straight to Step 9 (Cal.com booking)
  step=9;
  showStep(9);
}
// Handle cancelled payment return
if(params.get('cancelled')==='1'){
  try{
    var saved=JSON.parse(localStorage.getItem('dw_consultation_state')||'{}');
    if(saved.timestamp && (Date.now()-saved.timestamp)<7200000){
      if(saved.fname)document.getElementById('fname').value=saved.fname;
      if(saved.lname)document.getElementById('lname').value=saved.lname;
      if(saved.email)document.getElementById('email').value=saved.email;
      if(saved.phone)document.getElementById('phone').value=saved.phone;
      if(saved.treatment)selectedTreat=saved.treatment;
      if(saved.targetDose)selectedTargetDose=saved.targetDose;
    }
  }catch(e){}
  // Return to payment step so they can try again
  step=8;
  showStep(8);
  updatePaymentSummary();
}

// Cal.com embedded inline at Step 9 for video consultation scheduling after payment
</script>
<?php echo dontweight_get_ajax_script(); ?>
<?php wp_footer(); ?>
</body>
</html>
