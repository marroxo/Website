<footer>
  <div class="footer-inner">
    <div class="footer-top">

      <div class="footer-brand">
        <div class="footer-logo">TG<em>MODZ</em></div>
        <p class="footer-tagline">Your trusted authorized reseller of premium gaming software since 2021. Instant delivery, verified products, 100k+ happy customers.</p>
      </div>

      <div class="footer-col">
        <h4>Shop</h4>
        <div class="footer-links">
          <a href="/shop">All Products</a>
          <a href="/product/neverlose-cs2">CS2 Cheats</a>
          <a href="/product/cherax-gta5">GTA V Mods</a>
          <a href="/product/susano-fivem">FiveM Menus</a>
          <a href="/product/ethereal-spoofer">HWID Spoofers</a>
        </div>
      </div>

      <div class="footer-col">
        <h4>Support</h4>
        <div class="footer-links">
          <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener">Discord Server</a>
          <a href="#">FAQ</a>
          <a href="#">How to Purchase</a>
          <a href="#">Refund Policy</a>
        </div>
      </div>

      <div class="footer-col">
        <h4>Legal</h4>
        <div class="footer-links">
          <a href="#">Terms of Service</a>
          <a href="#">Privacy Policy</a>
          <a href="#">Cookie Policy</a>
        </div>
      </div>

    </div>

    <div class="footer-bottom">
      <p class="footer-copy">© <?= date('Y') ?> TGModz. All rights reserved. TGModz is an authorized reseller.</p>
      <div class="footer-payments">
        <span class="payment-badge">Visa</span>
        <span class="payment-badge">Mastercard</span>
        <span class="payment-badge">PayPal</span>
        <span class="payment-badge">Bitcoin</span>
        <span class="payment-badge">Ethereum</span>
        <span class="payment-badge">Litecoin</span>
      </div>
    </div>
  </div>
</footer>

<script>
// Scroll reveal
(function(){
  var els = document.querySelectorAll('.reveal');
  if (!els.length) return;
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(e){
      if (e.isIntersecting) {
        e.target.classList.add('visible');
        io.unobserve(e.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
  els.forEach(function(el){ io.observe(el); });
})();
</script>
</body>
</html>
