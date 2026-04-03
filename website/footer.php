<?php
/**
 * Shared Footer
 * Include in page templates: <?php include(get_template_directory() . '/footer.php'); ?>
 */
?>
<style>
footer.dw-footer{background:#0c0a09;color:#fff;font-family:var(--body,'Inter',sans-serif)}
footer.dw-footer .ft{max-width:1100px;margin:0 auto;padding:clamp(40px,6vw,64px) clamp(20px,4vw,48px) 24px}
footer.dw-footer .ft-top{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:32px;margin-bottom:32px}
footer.dw-footer .ft-brand{font-family:var(--display,'Inter',sans-serif);font-size:20px;font-weight:700;color:#fff;text-decoration:none;letter-spacing:-0.6px;display:block;margin-bottom:8px}
footer.dw-footer .ft-brand i{color:var(--sky,#38bdf8);font-style:italic;font-weight:400}
footer.dw-footer .ft-tag{font-size:12px;color:rgba(255,255,255,.4);line-height:1.6;max-width:260px}
footer.dw-footer .ft-col h5{font-size:10px;font-weight:700;color:rgba(255,255,255,.3);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:12px}
footer.dw-footer .ft-col ul{list-style:none;padding:0;margin:0}
footer.dw-footer .ft-col li{margin-bottom:6px}
footer.dw-footer .ft-col a{color:rgba(255,255,255,.55);text-decoration:none;font-size:13px;transition:color .2s}
footer.dw-footer .ft-col a:hover{color:#fff}
footer.dw-footer .ft-bot{border-top:1px solid rgba(255,255,255,.06);padding-top:18px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px}
footer.dw-footer .ft-bot p{font-size:11px;color:rgba(255,255,255,.25);margin:0}
footer.dw-footer .ft-badges{display:flex;gap:10px}
footer.dw-footer .ft-badge{font-size:10px;color:rgba(255,255,255,.3);border:1px solid rgba(255,255,255,.08);padding:4px 10px;border-radius:20px}
@media(max-width:768px){footer.dw-footer .ft-top{grid-template-columns:1fr 1fr;gap:24px}footer.dw-footer .ft-bot{flex-direction:column;align-items:flex-start}}
@media(max-width:480px){footer.dw-footer .ft-top{grid-template-columns:1fr}}
</style>
<footer class="dw-footer" style="background:#0c0a09;">
  <div class="ft">
    <div class="ft-top">
      <div>
        <a href="<?php echo home_url(); ?>" class="ft-brand">don't <i>weight</i></a>
        <p class="ft-tag">Clinician-led weight management. Personalised for you at every stage.</p>
      </div>
      <div class="ft-col">
        <h5>Programme</h5>
        <ul>
          <li><a href="/treatments/">Treatments</a></li>
          <li><a href="/health-checks/">Health Checks</a></li>
          <li><a href="/about/">About Us</a></li>
          <li><a href="/#calculator">Weight Calculator</a></li>
          <li><a href="/blog/">The Journal</a></li>
        </ul>
      </div>
      <div class="ft-col">
        <h5>Legal</h5>
        <ul>
          <li><a href="/privacy-policy/">Privacy Policy</a></li>
          <li><a href="/terms/">Terms &amp; Conditions</a></li>
          <li><a href="/complaints/">Complaints Procedure</a></li>
          <li><a href="/cookie-policy/">Cookie Policy</a></li>
          <li><a href="/contact/">Contact Us</a></li>
        </ul>
      </div>
      <div class="ft-col">
        <h5>Contact</h5>
        <ul>
          <li><a href="mailto:hello@dontweight.co.uk">hello@dontweight.co.uk</a></li>
          <li><a href="mailto:support@dontweight.co.uk">support@dontweight.co.uk</a></li>
          <li><a href="mailto:pharmacy@dontweight.co.uk">pharmacy@dontweight.co.uk</a></li>
        </ul>
      </div>
    </div>
    <div class="ft-bot">
      <p>&copy; <?php echo date('Y'); ?> Don't Weight Ltd. All rights reserved.</p>
      <div class="ft-badges">
        <span class="ft-badge">CQC Registered</span>
        <span class="ft-badge">MHRA Approved</span>
        <span class="ft-badge">ICO Compliant</span>
      </div>
    </div>
  </div>
</footer>