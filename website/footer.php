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
          <li><a href="/blog/">Blog</a></li>
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
          <li>
            <a href="tel:+442071013377" class="dw-phone-mobile">+44 20 7101 3377</a>
            <span class="dw-phone-desktop">+44 20 7101 3377</span>
            <style>.dw-phone-mobile{display:none}.dw-phone-desktop{display:inline;opacity:.6}@media(max-width:768px){.dw-phone-mobile{display:inline}.dw-phone-desktop{display:none}}</style>
          </li>
        </ul>
        <div style="margin-top:14px;display:flex;gap:10px;align-items:center">
          <a href="https://www.instagram.com/dontweight.co.uk/" target="_blank" rel="noopener" aria-label="Instagram" style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:8px;border:1px solid rgba(255,255,255,.1);color:rgba(255,255,255,.5);transition:all .2s" onmouseover="this.style.color='#fff';this.style.borderColor='rgba(255,255,255,.3)'" onmouseout="this.style.color='rgba(255,255,255,.5)';this.style.borderColor='rgba(255,255,255,.1)'"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor" stroke="none"/></svg></a>
          <a href="https://wa.me/447445897994?text=Hi%2C%20I%27d%20like%20to%20enquire%20about%20weight%20loss%20treatment%20with%20Don%27t%20Weight." target="_blank" rel="noopener" aria-label="WhatsApp" style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:8px;border:1px solid rgba(255,255,255,.1);color:rgba(255,255,255,.5);transition:all .2s" onmouseover="this.style.color='#25d366';this.style.borderColor='rgba(37,211,102,.3)'" onmouseout="this.style.color='rgba(255,255,255,.5)';this.style.borderColor='rgba(255,255,255,.1)'"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg></a>
        </div>
      </div>
    </div>
    <div style="border-top:1px solid rgba(255,255,255,.06);padding:16px 0;margin-bottom:8px;display:flex;align-items:center;justify-content:center;gap:12px;flex-wrap:wrap">
      <span style="font-size:11px;color:rgba(255,255,255,.35)">Part of</span>
      <a href="https://londonsono.com" target="_blank" rel="noopener" style="font-size:11px;color:rgba(255,255,255,.55);font-weight:600;text-decoration:none;border-bottom:1px solid rgba(56,189,248,.3)">London Private Ultrasound Group</a>
    </div>
    <div class="ft-bot">
      <p>&copy; <?php echo date('Y'); ?> don't weight — a trading name of Ultrasound London Limited. All rights reserved.</p>
      <div class="ft-badges">
        <span class="ft-badge">CQC Registered</span>
        <span class="ft-badge">MHRA Approved</span>
        <span class="ft-badge">ICO Compliant</span>
      </div>
    </div>
  </div>
</footer>