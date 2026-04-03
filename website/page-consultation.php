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
<title>Medical Consultation — Check Your Eligibility | Don't Weight</title>
<meta name="description" content="Complete your free weight loss consultation in minutes. Reviewed by UK-registered clinicians within 24 hours. Confidential, secure, and no obligation.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=optional" rel="stylesheet">
<style>
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
<div class="dw-lpug-bar" style="height:auto;padding:6px 20px;background:#1A1A2E;color:#fff;font-size:12px;text-align:center;letter-spacing:0.5px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;line-height:1.4;box-sizing:border-box;width:100%;">A <strong>London Private Ultrasound Group</strong> clinic <span style="display:inline-block;margin:0 10px;opacity:0.4;">&middot;</span> Established healthcare provider</div>

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
    <div class="section-card">
      <h2>Personal Details</h2>
      <div class="sec-sub">As they appear on your photo ID.</div>

      <div class="field-row">
        <div class="field"><label>First name <span class="req">*</span></label><input type="text" id="fname" placeholder="First name"></div>
        <div class="field"><label>Last name <span class="req">*</span></label><input type="text" id="lname" placeholder="Last name"></div>
      </div>
      <div class="field-row">
        <div class="field"><label>Date of birth <span class="req">*</span></label><input type="date" id="dob"></div>
        <div class="field"><label>Biological sex <span class="req">*</span></label>
          <select id="sex"><option value="">Select...</option><option>Female</option><option>Male</option></select>
        </div>
      </div>
      <div class="field"><label>Email address <span class="req">*</span></label><input type="email" id="email" placeholder="your@email.com"></div>
      <div class="field"><label>Phone number <span class="req">*</span></label><input type="tel" id="phone" placeholder="07xxx xxxxxx"></div>
      <div class="field"><label>Home address <span class="req">*</span></label><input type="text" id="addr1" placeholder="Address line 1" style="margin-bottom:8px"><input type="text" id="addr2" placeholder="Address line 2 (optional)" style="margin-bottom:8px">
        <div class="field-row"><div class="field" style="margin-bottom:0"><input type="text" id="city" placeholder="City"></div><div class="field" style="margin-bottom:0"><input type="text" id="postcode" placeholder="Postcode"></div></div>
      </div>
    </div>
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
      <div class="treat-select-card" id="sel-mounjaro" onclick="selectTreat('mounjaro')" style="border:2px solid var(--sky);background:var(--sky-wash);border-radius:16px;padding:24px;margin-bottom:14px;cursor:pointer;position:relative;transition:all .2s">
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
            <div style="font-size:12px;color:var(--slate);margin-top:2px">then from &pound;175/month</div>
            <div style="font-size:10px;color:var(--slate);margin-top:1px">(dosage dependent)</div>
          </div>
        </div>
        <div style="margin-top:12px;font-size:12px;color:var(--charcoal);line-height:1.6">Includes: medication, clinical review, personalised plan, free next-day delivery, ongoing clinician support.</div>
        <div class="treat-check" style="position:absolute;top:16px;right:16px;width:26px;height:26px;border-radius:50%;border:2.5px solid var(--sky-dark);display:flex;align-items:center;justify-content:center;background:var(--sky-dark);color:#fff;font-size:12px;font-weight:700">&#10003;</div>
      </div>

      <!-- Wegovy -->
      <div class="treat-select-card" id="sel-wegovy" onclick="selectTreat('wegovy')" style="border:2px solid var(--stone);background:var(--white);border-radius:16px;padding:24px;margin-bottom:20px;cursor:pointer;position:relative;transition:all .2s">
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
        <div class="treat-check" style="position:absolute;top:16px;right:16px;width:26px;height:26px;border-radius:50%;border:2.5px solid var(--stone);display:flex;align-items:center;justify-content:center;background:transparent;color:transparent;font-size:12px;font-weight:700">&#10003;</div>
      </div>

      <div style="background:var(--cream);border-radius:12px;padding:16px;font-size:12px;color:var(--charcoal);line-height:1.7;margin-bottom:12px">
        <strong>How pricing works:</strong> All prices shown are starting prices. Your exact monthly cost depends on your prescribed dosage, which your pharmacist will determine based on your clinical needs. As your dose increases during treatment (a normal part of the titration process), your monthly cost may increase. You will always be informed of the exact cost before each prescription is dispensed. Treatment can be cancelled at any time with no further charges.
      </div>

      <div style="font-size:12px;color:var(--slate);line-height:1.6">
        <strong>Refund policy:</strong> If your consultation is reviewed and treatment is not approved, you will receive a full refund within 5 working days. If you are approved and wish to cancel before your medication is dispatched, you may do so at no cost.
      </div>
    </div>
    <div class="err" id="err6"></div>
    <div class="nav-btns"><button class="btn-back" onclick="prevS(6)">&larr; Back</button><button class="btn-next" onclick="nextS(6)">Continue to verification &rarr;</button></div>
  </div>

  <!-- STEP_7_UPLOADS -->
  <div class="step" id="s7">
    <div class="section-card">
      <h2>Identity Verification</h2>
      <div class="sec-sub">Required by GPhC regulations before any prescription can be issued.</div>

      <div class="info-banner">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" stroke="#0284C7" stroke-width="2" stroke-linecap="round"/></svg>
        <span>Your documents are encrypted, stored securely, and reviewed only by our clinical team. Never shared with third parties.</span>
      </div>

      <div class="field">
        <label>Photo ID <span class="req">*</span></label>
        <div class="field-note" style="margin-bottom:10px">Upload a clear photo of your passport, driving licence, or national identity card. Must show your full name and photo.</div>
        <div class="upload-zone" id="uz1">
          <input type="file" accept="image/*,.pdf" onchange="handleUpload(this,'uz1','p1')">
          <div class="uz-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none"><path d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" stroke="#0EA5E9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <div class="uz-title">Upload photo ID</div>
          <div class="uz-sub">JPG, PNG or PDF, max 10MB</div>
        </div>
        <div class="upload-preview" id="p1"></div>
      </div>

      

      <div class="field">
        <label>GP practice details <span class="req">*</span></label>
        <div class="field-note" style="margin-bottom:10px">GPhC regulations require us to verify your information with your GP or clinical records. Please provide your GP practice name and address.</div>
        <input type="text" id="gpName" placeholder="GP practice name">
        <input type="text" id="gpAddr" placeholder="GP practice address or postcode" style="margin-top:8px">
      </div>

      
      <div class="field" style="margin-top:16px">
        <label>Can we contact your GP? <span class="req">*</span></label>
        <div class="field-note" style="margin-bottom:10px">GPhC regulations may require us to verify your medical history or notify your GP about your treatment. This is standard practice for prescription medication.</div>
        <div class="yn-row">
          <button type="button" class="yn-btn" onclick="this.classList.add('sel-yes');this.nextElementSibling.classList.remove('sel-no');document.getElementById('gpConsent').value='yes'" id="gpConsentYes">Yes, that's fine</button>
          <button type="button" class="yn-btn" onclick="this.classList.add('sel-no');this.previousElementSibling.classList.remove('sel-yes');document.getElementById('gpConsent').value='no'" id="gpConsentNo">I'd prefer not</button>
        </div>
        <input type="hidden" id="gpConsent" value="">
        <div class="field-note" style="margin-top:8px;color:var(--sky-dark)">We will always discuss this with you first before contacting your GP.</div>
      </div>

<div class="warning-banner">
        <strong>Live video consultation</strong> &mdash; GPhC regulations for weight management medication require your prescribing clinician to verify your identity and assess you via a live video or in-person consultation. After you submit this form, our team will contact you within 24 hours to arrange a short video call (typically 5&ndash;10 minutes) with your prescribing pharmacist.
      </div>
    </div>
    <div class="err" id="err7"></div>
    <div class="nav-btns"><button class="btn-back" onclick="prevS(7)">&larr; Back</button><button class="btn-submit" onclick="submitAll()">Submit for clinical review &rarr;</button></div>
  </div>

  <!-- STEP 8: Payment -->
  <div class="step" id="s8">
    <div class="section-card">
      <h2>Payment</h2>
      <div class="sec-sub">Review your order and complete payment to proceed.</div>

      <div class="info-banner">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke="#0284C7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <span><strong>100% refund guarantee:</strong> If your application is not approved by our clinical team, you will receive a full refund within 5 working days. No questions asked.</span>
      </div>

      <!-- Order Summary -->
      <div style="background:var(--cream);border-radius:16px;padding:24px;margin-bottom:20px">
        <div style="font-size:11px;letter-spacing:1.5px;text-transform:uppercase;color:var(--sky-deep);font-weight:700;margin-bottom:16px">Order Summary</div>

        <div id="paymentSummary" style="display:flex;justify-content:space-between;align-items:center;padding-bottom:16px;border-bottom:1px solid var(--stone);margin-bottom:16px">
          <div>
            <div style="font-family:var(--display);font-size:18px;font-weight:700;color:var(--ink)" id="payTreatName">Mounjaro</div>
            <div style="font-size:13px;color:var(--slate);margin-top:2px">First month &mdash; medication, clinical review, delivery</div>
          </div>
          <div style="font-family:var(--display);font-size:24px;font-weight:700;color:var(--ink)" id="payAmount">&pound;150</div>
        </div>

        <div style="display:flex;justify-content:space-between;align-items:center;padding-bottom:12px;border-bottom:1px solid var(--stone);margin-bottom:12px">
          <span style="font-size:13px;color:var(--charcoal)">Delivery</span>
          <span style="font-size:13px;color:var(--green);font-weight:600">FREE</span>
        </div>

        <div style="display:flex;justify-content:space-between;align-items:center">
          <span style="font-size:15px;font-weight:700;color:var(--ink)">Total due today</span>
          <span style="font-family:var(--display);font-size:22px;font-weight:700;color:var(--ink)" id="payTotal">&pound;150</span>
        </div>
      </div>

      <div style="font-size:12px;color:var(--slate);line-height:1.6;margin-bottom:20px">
        <strong>What you&rsquo;re paying for:</strong> Your initial treatment month including medication, clinical review, personalised plan, free next-day delivery, and ongoing clinician support. Recurring payments begin after your first month at the standard dosage rate.
      </div>

      <!-- Stripe Checkout Button (placeholder until keys are added) -->
      <div id="stripe-checkout-area">
        <button id="stripePayBtn" onclick="processPayment()" style="width:100%;background:var(--sky);color:#fff;border:none;border-radius:100px;padding:18px;font-family:var(--body);font-size:16px;font-weight:700;cursor:pointer;transition:all .2s;box-shadow:0 4px 16px rgba(56,189,248,.2);display:flex;align-items:center;justify-content:center;gap:10px">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
          Pay securely &rarr;
        </button>
        <div style="display:flex;align-items:center;justify-content:center;gap:8px;margin-top:14px">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke="#A8A29E" stroke-width="1.5" stroke-linecap="round"/></svg>
          <span style="font-size:11px;color:var(--slate)">Payments secured by Stripe. 256-bit SSL encryption.</span>
        </div>
      </div>

      <div style="margin-top:16px;display:flex;gap:8px;justify-content:center;opacity:.4">
        <span style="font-size:10px;padding:4px 10px;border:1px solid var(--stone);border-radius:4px">Visa</span>
        <span style="font-size:10px;padding:4px 10px;border:1px solid var(--stone);border-radius:4px">Mastercard</span>
        <span style="font-size:10px;padding:4px 10px;border:1px solid var(--stone);border-radius:4px">Amex</span>
        <span style="font-size:10px;padding:4px 10px;border:1px solid var(--stone);border-radius:4px">Apple Pay</span>
        <span style="font-size:10px;padding:4px 10px;border:1px solid var(--stone);border-radius:4px">Google Pay</span>
      </div>
    </div>
    <div class="err" id="err8"></div>
    <div class="nav-btns"><button class="btn-back" onclick="prevS(8)">&larr; Back</button></div>
  </div>

  <!-- STEP 9: Book Video Consultation -->
  <div class="step" id="s9">
    <div class="section-card">
      <div style="text-align:center;margin-bottom:24px">
        <div style="width:64px;height:64px;border-radius:50%;background:var(--green-bg);border:2px solid var(--green);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:28px;color:var(--green)">&#10003;</div>
        <h2>Payment received</h2>
        <p style="color:var(--slate);font-size:14px;margin-top:6px">Now book your video consultation with our pharmacist.</p>
      </div>

      <div class="info-banner">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" stroke="#0284C7" stroke-width="2"/><path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" stroke="#0284C7" stroke-width="2"/></svg>
        <span><strong>Required by GPhC:</strong> A live video consultation is mandatory before any weight management medication can be prescribed. This is a short 10&ndash;15 minute call.</span>
      </div>

      <div style="background:var(--cream);border-radius:16px;padding:20px;margin-bottom:20px">
        <div style="font-size:13px;color:var(--charcoal);line-height:1.7">
          <strong>What to expect:</strong><br>
          &bull; Your pharmacist will verify your identity (have your photo ID ready)<br>
          &bull; Brief clinical assessment and review of your medical history<br>
          &bull; Discuss your treatment plan and answer any questions<br>
          &bull; Consultation via Google Meet (link sent in confirmation email)
        </div>
      </div>

      <!-- Cal.com Embed -->
      <div style="border:1px solid var(--stone);border-radius:16px;overflow:hidden;min-height:500px">
        <div style="width:100%;height:600px;overflow:auto" id="my-cal-inline-video-consultation"></div>
      </div>

      <div style="text-align:center;margin-top:20px">
        <button onclick="skipBooking()" style="background:none;border:none;color:var(--slate);font-size:13px;cursor:pointer;text-decoration:underline;font-family:var(--body)">I&rsquo;ll book later &mdash; skip for now</button>
        <p style="font-size:11px;color:var(--slate);margin-top:6px">Our team will contact you within 24 hours if you don&rsquo;t book now.</p>
      </div>
    </div>
  </div>

  <!-- STEP 10: Confirmation -->
  <div class="step" id="s10">
    <div class="section-card">
      <div class="success-screen">
        <div class="success-icon">&#10003;</div>
        <h2>You&rsquo;re all set!</h2>
        <p>Your consultation has been submitted, payment received, and your video consultation is being arranged.</p>
        <div class="next-steps">
          <strong>What happens next:</strong><br><br>
          1. <strong>Video consultation</strong> &mdash; your pharmacist will meet you at your booked time via Google Meet. Have your photo ID ready.<br>
          2. <strong>Clinical review</strong> &mdash; your prescribing pharmacist will review all your information and the video assessment<br>
          3. <strong>If approved</strong> &mdash; your medication will be dispatched from a registered UK pharmacy the following day via free next-day delivery<br>
          4. <strong>If not approved</strong> &mdash; you will receive a full refund within 5 working days<br><br>
          <strong>Check your email</strong> at <span id="confirmEmail" style="color:var(--sky-deep);font-weight:600"></span> for booking confirmation and Google Meet link.
        </div>
        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;margin-top:24px">
          <a href="<?php echo esc_url(home_url('/')); ?>" style="display:inline-block;background:var(--sky);color:#fff;border:none;border-radius:100px;padding:14px 36px;font-family:var(--body);font-size:14px;font-weight:600;text-decoration:none;transition:background .2s">Return to homepage</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div style="background:var(--ink);padding:24px;text-align:center;font-size:11px;color:rgba(255,255,255,.35);margin-top:40px">
  &copy; 2026 Don't Weight Ltd. Registered in England &amp; Wales. GPhC-registered prescribing pharmacists.
</div>

<script>
// Stripe configuration — injected directly since this is a standalone template
var dwStripe={
  pk:"<?php echo esc_js(get_option('dontweight_stripe_pk', '')); ?>",
  ajaxUrl:"<?php echo admin_url('admin-ajax.php'); ?>",
  nonce:"<?php echo wp_create_nonce('dw_stripe_checkout'); ?>"
};

let step=1;
const totalSteps=5;

function showStep(n){
  document.querySelectorAll('.step').forEach(s=>s.classList.remove('active'));
  document.getElementById('s'+n).classList.add('active');
  
  // Map form steps to 4 progress phases
  // Steps 1-2: Your Details | Steps 3-5: Medical History | Steps 6-8: Treatment & Pay | Steps 9-10: Book Call
  const phaseMap={1:1,2:1,3:2,4:2,5:2,6:3,7:3,8:3,9:4,10:4};
  const phase=phaseMap[n]||1;
  
  // Update step numbers
  for(let i=1;i<=4;i++){
    const num=document.querySelector('#sl'+i+' .step-num');
    num.classList.remove('active','done');
    if(i<phase)num.classList.add('done');
    if(i===phase)num.classList.add('active');
  }
  
  // Fill progress lines
  const subSteps={1:[1,2],2:[3,4,5],3:[6,7,8],4:[9,10]};
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
    7:'One more step after this',
    8:'Nearly there — payment',
    9:'Final step — book your call!',
    10:'All done!'
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

  step=current+1;
  showStep(step);
}

function prevS(current){step=current-1;showStep(step)}

function submitAll(){
  // Collect all consultation form data
  const fields=['fname','lname','dob','sex','email','phone','addr2','postcode',
    'conditions','medications','allergies','surgeries','family','lifestyle',
    'weightDuration','prevMed','prevMedDetails','pregnant','thyroid',
    'pancreatitis','eating','contraception'];
  
  const allData={};
  fields.forEach(f=>{
    const el=document.getElementById(f);
    if(el) allData[f]=el.value||el.textContent||'';
  });
  
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
  fd.append('treatment_choice',selectedTreat||'');
  fd.append('stage','consultation');
  fd.append('conditions',allData.conditions||'');
  fd.append('medications',allData.medications||'');
  fd.append('prev_medication',allData.prevMed||'');
  fd.append('answers',answerLines.join('\n'));
  
  const ajaxUrl=typeof dwAjax!=='undefined'?dwAjax.url:'/wp-admin/admin-ajax.php';
  fetch(ajaxUrl,{method:'POST',body:fd}).catch(()=>{});
  
  step=8;
  showStep(8);
  updatePaymentSummary();
}

// Update payment summary based on selected treatment
function tickAll(el){
  var master=document.getElementById('cAll');
  var boxes=document.querySelectorAll('.consent-cb');
  boxes.forEach(function(b){b.checked=master.checked;});
}

function updatePaymentSummary(){
  const name=selectedTreat==='mounjaro'?'Mounjaro':'Wegovy';
  const price=selectedTreat==='mounjaro'?150:114;
  document.getElementById('payTreatName').textContent=name;
  document.getElementById('payAmount').innerHTML='&pound;'+price;
  document.getElementById('payTotal').innerHTML='&pound;'+price;
}

// Payment processing — Stripe Checkout
function processPayment(){
  const btn=document.getElementById('stripePayBtn');
  btn.disabled=true;
  btn.innerHTML='<span style="display:inline-block;width:18px;height:18px;border:2px solid rgba(255,255,255,.3);border-top-color:#fff;border-radius:50%;animation:spin .6s linear infinite"></span> Connecting to payment...';

  const email=document.getElementById('email').value||'';
  const name=(document.getElementById('fname').value||'')+' '+(document.getElementById('lname').value||'');
  
  const fd=new FormData();
  fd.append('action','dw_stripe_checkout');
  fd.append('nonce',typeof dwStripe!=='undefined'?dwStripe.nonce:'');
  fd.append('treatment',selectedTreat||'mounjaro');
  fd.append('email',email);
  fd.append('name',name.trim());
  
  const ajaxUrl=typeof dwStripe!=='undefined'?dwStripe.ajaxUrl:'/wp-admin/admin-ajax.php';
  
  fetch(ajaxUrl,{method:'POST',body:fd})
    .then(r=>r.json())
    .then(data=>{
      if(data.success && data.data.url){
        window.location.href=data.data.url;
      } else {
        btn.disabled=false;
        btn.innerHTML='Pay securely &rarr;';
        alert('Payment setup failed: '+(data.data||'Please try again.'));
      }
    })
    .catch(err=>{
      btn.disabled=false;
      btn.innerHTML='Pay securely &rarr;';
      alert('Connection error. Please try again.');
    });
}

// Load Cal.com embed
function loadCalEmbed(){
  if(window.calLoaded)return;
  window.calLoaded=true;
  (function(C,A,L){let p=function(a,ar){a.q.push(ar)};let d=C.document;C.Cal=C.Cal||function(){let cal=C.Cal;let ar=arguments;if(!cal.loaded){cal.ns={};cal.q=cal.q||[];d.head.appendChild(d.createElement("script")).src=A;cal.loaded=true}if(ar[0]===L){const api=function(){p(api,arguments)};const namespace=ar[1];api.q=api.q||[];if(typeof namespace==="string"){cal.ns[namespace]=cal.ns[namespace]||api;p(cal.ns[namespace],ar);p(cal,["initNamespace",namespace])}else p(cal,ar);return}p(cal,ar)}})(window,"https://app.cal.com/embed/embed.js","init");
  Cal("init","video-consultation",{origin:"https://app.cal.com"});
  Cal.ns["video-consultation"]("inline",{
    elementOrSelector:"#my-cal-inline-video-consultation",
    config:{"layout":"month_view","useSlotsViewOnSmallScreen":"true"},
    calLink:"dontweight/video-consultation",
  });
  Cal.ns["video-consultation"]("ui",{"hideEventTypeDetails":false,"layout":"month_view"});
}

// Skip booking
function skipBooking(){
  const em=document.getElementById('email').value||'your email';
  document.getElementById('confirmEmail').textContent=em;
  step=10;
  showStep(10);
}

// Treatment selection
let selectedTreat='mounjaro'; // default
function selectTreat(treat){
  selectedTreat=treat;
  const mCard=document.getElementById('sel-mounjaro');
  const oCard=document.getElementById('sel-wegovy');
  if(treat==='mounjaro'){
    mCard.style.borderColor='var(--sky)';mCard.style.background='var(--sky-wash)';
    mCard.querySelector('.treat-check').style.cssText='position:absolute;top:16px;right:16px;width:26px;height:26px;border-radius:50%;border:2.5px solid var(--sky-dark);display:flex;align-items:center;justify-content:center;background:var(--sky-dark);color:#fff;font-size:12px;font-weight:700';
    oCard.style.borderColor='var(--stone)';oCard.style.background='var(--white)';
    oCard.querySelector('.treat-check').style.cssText='position:absolute;top:16px;right:16px;width:26px;height:26px;border-radius:50%;border:2.5px solid var(--stone);display:flex;align-items:center;justify-content:center;background:transparent;color:transparent;font-size:12px;font-weight:700';
  } else {
    oCard.style.borderColor='var(--sky)';oCard.style.background='var(--sky-wash)';
    oCard.querySelector('.treat-check').style.cssText='position:absolute;top:16px;right:16px;width:26px;height:26px;border-radius:50%;border:2.5px solid var(--sky-dark);display:flex;align-items:center;justify-content:center;background:var(--sky-dark);color:#fff;font-size:12px;font-weight:700';
    mCard.style.borderColor='var(--stone)';mCard.style.background='var(--white)';
    mCard.querySelector('.treat-check').style.cssText='position:absolute;top:16px;right:16px;width:26px;height:26px;border-radius:50%;border:2.5px solid var(--stone);display:flex;align-items:center;justify-content:center;background:transparent;color:transparent;font-size:12px;font-weight:700';
  }
}

function ynToggle(btn,fieldId){
  const row=btn.parentElement;
  row.querySelectorAll('.yn-btn').forEach(b=>{b.classList.remove('sel-yes','sel-no')});
  const isYes=btn.textContent==='Yes';
  btn.classList.add(isYes?'sel-yes':'sel-no');
  const detail=document.getElementById(fieldId+'-detail');
  if(isYes){detail.classList.add('open')}else{detail.classList.remove('open')}
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

// Listen for Cal.com booking completion
window.addEventListener('message',function(e){
  try{
    if(e.data&&e.data.type&&e.data.type.indexOf('cal')>-1){
      if(e.data.type==='__]]cal:eventTypeSelected'||e.data.type==='cal:bookingSuccessful'||(e.data.data&&e.data.data.type==='booking_successful')){
        setTimeout(function(){
          const em=document.getElementById('email').value||'your email';
          document.getElementById('confirmEmail').textContent=em;
          step=10;
          showStep(10);
        },2000);
      }
    }
  }catch(err){}
});
</script>
<?php echo dontweight_get_ajax_script(); ?>
<?php wp_footer(); ?>
</body>
</html>
