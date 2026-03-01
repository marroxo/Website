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
          <a href="/#faq">FAQ</a>
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

// Stat counter animation — only fires for elements with data-target attribute
(function(){
  function parseTarget(text) {
    text = text.trim();
    var suffix = '';
    var prefix = '';
    if (text.charAt(0) === '$') { prefix = '$'; text = text.slice(1); }
    if (text.slice(-2) === 'K+') { suffix = 'K+'; text = text.slice(0, -2); }
    else if (text.slice(-1) === '+') { suffix = '+'; text = text.slice(0, -1); }
    else if (text.slice(-1) === '★') { suffix = '★'; text = text.slice(0, -1); }
    var num = parseFloat(text);
    return isNaN(num) ? null : { num: num, prefix: prefix, suffix: suffix };
  }
  function animateCounter(el, target, duration) {
    var t = parseTarget(target);
    if (!t) return;
    var isDecimal = (t.num % 1 !== 0);
    var start = null;
    function step(ts) {
      if (!start) start = ts;
      var progress = Math.min((ts - start) / duration, 1);
      var ease = 1 - Math.pow(1 - progress, 3);
      var current = t.num * ease;
      el.textContent = t.prefix + (isDecimal ? current.toFixed(1) : Math.round(current)) + t.suffix;
      if (progress < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }
  // Only select elements with an explicit data-target — skips non-numeric stats like "24/7" and "Est."
  var statEls = document.querySelectorAll('[data-target].stat-n, [data-target].hstat-n');
  if (!statEls.length) return;
  var io2 = new IntersectionObserver(function(entries){
    entries.forEach(function(e){
      if (e.isIntersecting) {
        animateCounter(e.target, e.target.getAttribute('data-target'), 1800);
        io2.unobserve(e.target);
      }
    });
  }, { threshold: 0.5 });
  statEls.forEach(function(el){ io2.observe(el); });
})();

// FAQ accordion — button references cached at setup to avoid querySelector on every click
(function(){
  var items = document.querySelectorAll('.faq-item');
  if (!items.length) return;
  var faqPairs = [];
  items.forEach(function(item){
    var btn = item.querySelector('.faq-q');
    if (btn) faqPairs.push({ item: item, btn: btn });
  });
  faqPairs.forEach(function(pair){
    pair.btn.addEventListener('click', function(){
      var isOpen = pair.item.classList.contains('open');
      faqPairs.forEach(function(p){
        p.item.classList.remove('open');
        p.btn.setAttribute('aria-expanded', 'false');
      });
      if (!isOpen) {
        pair.item.classList.add('open');
        pair.btn.setAttribute('aria-expanded', 'true');
      }
    });
  });
})();
</script>
</body>
</html>
