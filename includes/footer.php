<!-- COMPLIANCE STRIP -->
<div class="compliance-strip">
  <span>🔒 3D Secure Encrypted Checkout</span>
  <span>💳 PCI-Compliant Payments</span>
  <span>🛡️ Buyer Protection on Every Order</span>
  <span>🏅 Trusted by 100,000+ Customers</span>
  <span>⭐ 4.8/5 on Trustpilot</span>
</div>

<!-- FOOTER -->
<footer>
  <div class="footer-inner">
    <div class="footer-top">
      <div>
        <a href="/" class="footer-logo">TG<em>Modz</em></a>
        <p class="footer-desc">Authorized digital software reseller trusted by over 100,000 gamers since 2021. Premium game enhancement tools delivered instantly to your inbox.</p>
        <div class="footer-disclaimer">
          TGModz is an authorized reseller. All products are sold with full developer authorization — verifiable in each product's official Discord server. We are not affiliated with the game publishers.
        </div>
      </div>

      <div class="footer-col">
        <div class="footer-col-title">Products</div>
        <ul>
          <li><a href="/cs2">CS2 Software</a></li>
          <li><a href="/gta">GTA V Mods</a></li>
          <li><a href="/fivem">FiveM Tools</a></li>
          <li><a href="/r6">R6 Siege Utilities</a></li>
          <li><a href="/rdr2">RDR2 Mods</a></li>
          <li><a href="/#categories">All Products</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <div class="footer-col-title">Support</div>
        <ul>
          <li><a href="https://discord.gg/tgmodz" target="_blank" rel="noopener">Discord Server</a></li>
          <li><a href="/#faq">FAQ</a></li>
          <li><a href="https://discord.gg/tgmodz" target="_blank" rel="noopener">Open a Ticket</a></li>
          <li><a href="https://discord.gg/tgmodz" target="_blank" rel="noopener">Refund Policy</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <div class="footer-col-title">Account</div>
        <ul>
          <li><a href="/account">My Orders</a></li>
          <li><a href="/auth/login">Sign In</a></li>
          <li><a href="/auth/register">Create Account</a></li>
          <li><a href="/cart">Cart</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="footer-copy">© 2021–<?= date('Y') ?> TGModz. All rights reserved. Est. 2021.</div>
      <div class="footer-legal">
        <a href="#">Terms</a>
        <a href="#">Privacy</a>
        <a href="#">Refunds</a>
        <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener">Discord</a>
      </div>
    </div>
  </div>
</footer>

<script>
/* ── FAQ TOGGLE ── */
function toggleFaq(btn) {
  var item = btn.parentElement;
  var icon = btn.querySelector('.faq-icon');
  var isOpen = item.classList.contains('open');
  document.querySelectorAll('.faq-item').forEach(function(i) {
    i.classList.remove('open');
    var ic = i.querySelector('.faq-icon');
    if (ic) ic.textContent = '+';
  });
  if (!isOpen) {
    item.classList.add('open');
    if (icon) icon.textContent = '−';
  }
}

/* ── SCROLL REVEAL ── */
(function(){
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(e){ if(e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.08 });
  document.querySelectorAll('.reveal, .why-card, .stat-box, .review, .step, .prod, .cat-card').forEach(function(el,i){
    el.classList.add('reveal');
    el.style.transitionDelay = (i * 0.04) + 's';
    io.observe(el);
  });
})();

/* ── STAT COUNTER ── */
(function(){
  function animateCount(el) {
    var target = parseInt(el.dataset.target, 10);
    var suffix = el.dataset.suffix || '';
    var duration = 1800;
    var start = performance.now();
    function step(now) {
      var progress = Math.min((now - start) / duration, 1);
      var value = Math.floor(progress * target);
      el.textContent = (value >= 1000 ? (value/1000).toFixed(0) + 'K' : value) + suffix;
      if (progress < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }
  var counters = document.querySelectorAll('[data-counter]');
  if (!counters.length) return;
  var io2 = new IntersectionObserver(function(entries){
    entries.forEach(function(e){
      if(e.isIntersecting){
        animateCount(e.target);
        io2.unobserve(e.target);
      }
    });
  }, { threshold: 0.3 });
  counters.forEach(function(el){ io2.observe(el); });
})();
</script>
</html>
