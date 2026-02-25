<div class="payment-strip">
  <div class="container">
    <div class="payment-inner">
      <span>Accepted Payments</span>
      <div class="payment-icons">
        <span class="pay-icon">VISA</span>
        <span class="pay-icon">MASTERCARD</span>
        <span class="pay-icon">AMEX</span>
        <span class="pay-icon">APPLE PAY</span>
        <span class="pay-icon">GOOGLE PAY</span>
        <span class="pay-icon">CRYPTO</span>
      </div>
    </div>
  </div>
</div>

<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="brand-name">TG<span>Modz</span></div>
        <p>Authorized digital software reseller trusted by over 100,000 gamers since 2021. Premium game enhancement tools delivered instantly.</p>
      </div>
      <div class="footer-col">
        <h4>Products</h4>
        <a href="/cs2">CS2 Software</a>
        <a href="/gta">GTA V Software</a>
        <a href="/fivem">FiveM Tools</a>
        <a href="/r6">R6 Siege Utilities</a>
        <a href="/rdr2">RDR2 Mods</a>
      </div>
      <div class="footer-col">
        <h4>Support</h4>
        <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener">Discord Server</a>
        <a href="/#faq">FAQ</a>
        <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener">Open a Ticket</a>
        <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener">Refund Policy</a>
      </div>
      <div class="footer-col">
        <h4>Company</h4>
        <a href="/">About Us</a>
        <a href="/">Terms of Service</a>
        <a href="/">Privacy Policy</a>
        <a href="https://trustpilot.com" target="_blank" rel="noopener">Trustpilot Reviews</a>
      </div>
    </div>
    <div class="footer-bottom">
      <span>&copy; 2021&ndash;2026 TGModz. All rights reserved.</span>
      <div class="footer-badges">
        <span class="footer-badge">SSL Secured</span>
        <span class="footer-badge">PCI Compliant</span>
        <span class="footer-badge">3D Secure</span>
      </div>
    </div>
  </div>
</footer>

<script>
// ── NAV SCROLL ──────────────────────────────────────────────────────────────
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 40);
}, { passive: true });

// ── MOBILE NAV ──────────────────────────────────────────────────────────────
const hamburger = document.getElementById('hamburger');
const navLinks  = document.getElementById('navLinks');

hamburger.addEventListener('click', () => {
  const isOpen = navLinks.classList.toggle('open');
  hamburger.classList.toggle('open', isOpen);
  hamburger.setAttribute('aria-expanded', isOpen);
  document.body.style.overflow = isOpen ? 'hidden' : '';
});

navLinks.querySelectorAll('a').forEach(a => {
  a.addEventListener('click', () => {
    navLinks.classList.remove('open');
    hamburger.classList.remove('open');
    hamburger.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
  });
});

// Close nav on outside click
document.addEventListener('click', (e) => {
  if (!navbar.contains(e.target) && navLinks.classList.contains('open')) {
    navLinks.classList.remove('open');
    hamburger.classList.remove('open');
    hamburger.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
  }
});

// ── FAQ TOGGLE ──────────────────────────────────────────────────────────────
function toggleFaq(el) {
  const item = el.parentElement;
  const wasOpen = item.classList.contains('open');
  document.querySelectorAll('.faq-item.open').forEach(i => i.classList.remove('open'));
  if (!wasOpen) item.classList.add('open');
}

// ── SCROLL REVEAL ───────────────────────────────────────────────────────────
const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      revealObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

// ── COUNTER ANIMATION ───────────────────────────────────────────────────────
function animateCounters() {
  document.querySelectorAll('.stat-num[data-target]').forEach(counter => {
    const target   = +counter.dataset.target;
    const suffix   = counter.dataset.suffix || '';
    const duration = 2000;
    const start    = performance.now();

    function update(now) {
      const progress = Math.min((now - start) / duration, 1);
      const eased    = 1 - Math.pow(1 - progress, 3);
      let current    = Math.floor(eased * target);

      if (target >= 1000) {
        counter.textContent = (current / 1000).toFixed(0) + 'K+' + suffix;
      } else if (target < 10) {
        counter.textContent = current.toFixed(1).replace(/\.0$/, '') + '+' + suffix;
      } else {
        counter.textContent = current + '+' + suffix;
      }
      if (progress < 1) requestAnimationFrame(update);
    }
    requestAnimationFrame(update);
  });
}

const statsSection = document.querySelector('.stats');
if (statsSection) {
  new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounters();
        entry.target._statsObserver?.unobserve(entry.target);
      }
    });
  }, { threshold: 0.3 }).observe(statsSection);
}
</script>
