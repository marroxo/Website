<?php
$page_title  = 'TGModz — Premium Gaming Software Store | Est. 2021';
$page_desc   = 'TGModz — authorized reseller of premium game enhancement software. Trusted by 100,000+ gamers since 2021. Instant delivery, 24/7 support, verified products.';
$active_page = 'home';

$products = require __DIR__ . '/data/products.php';
$featured  = array_values($products);        // all 5 as featured
$product_list = array_values($products);     // for product cards

include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/nav.php';
?>

<!-- ─── HERO ─────────────────────────────────────────────────────────────── -->
<section class="hero">
  <!-- Background layers -->
  <div class="hero-bg"></div>
  <div class="hero-grid"></div>
  <div class="hero-scan"></div>

  <!-- Animated glow orbs -->
  <div class="hero-orb hero-orb-a"></div>
  <div class="hero-orb hero-orb-b"></div>
  <div class="hero-orb hero-orb-c"></div>

  <!-- Floating product spotlight card (desktop only) -->
  <div class="hero-visual">
    <div class="hero-visual-card">
      <span class="hvc-badge"><span class="badge badge-hot">HOT</span></span>
      <div class="hvc-header">
        <span class="hvc-live-dot"></span>
        <span class="hvc-label">Live — Top Product</span>
      </div>
      <div class="hvc-name">Neverlose CS2</div>
      <div class="hvc-game">Counter-Strike 2 · Enhancement</div>
      <div class="hvc-price-row">
        <span class="hvc-price">$18.50</span>
        <span class="hvc-period">/ month</span>
      </div>
      <div class="hvc-stats">
        <div class="hvc-stat"><span>12</span> sold today</div>
        <div class="hvc-stat"><span>4.9★</span> rated</div>
      </div>
      <a href="/product/neverlose-cs2" class="hvc-cta">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 001.99-1.79l1.44-8.21H6"/></svg>
        Explore Gear
      </a>
    </div>
  </div>

  <!-- Hero content -->
  <div class="hero-eyebrow">
    <span class="hero-dot"></span>
    &nbsp;100,000+ Gamers Served Since 2021
  </div>

  <h1>
    DOMINATE<br>
    EVERY <span class="accent">MATCH</span>
  </h1>

  <p class="hero-sub">
    Premium game enhancement software — authorized, instantly delivered, and constantly updated. The competitive edge trusted by 100K+ serious gamers.
  </p>

  <div class="hero-ctas">
    <a href="/shop" class="btn btn-primary btn-lg">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
      Explore Gear
    </a>
    <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener" class="btn btn-outline btn-lg">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 00-4.885-1.515.074.074 0 00-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 00-5.487 0 12.64 12.64 0 00-.617-1.25.077.077 0 00-.079-.037A19.736 19.736 0 003.677 4.37a.07.07 0 00-.032.027C.533 9.046-.32 13.58.099 18.057c.002.022.015.04.036.05a19.859 19.859 0 005.993 3.03.077.077 0 00.084-.028 14.09 14.09 0 001.226-1.994.076.076 0 00-.041-.106 13.107 13.107 0 01-1.872-.892.077.077 0 01-.008-.128 10.2 10.2 0 00.372-.292.074.074 0 01.077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 01.078.01c.12.098.246.198.373.292a.077.077 0 01-.006.127 12.299 12.299 0 01-1.873.892.077.077 0 00-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 00.084.028 19.839 19.839 0 006.002-3.03.077.077 0 00.036-.05c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 00-.031-.03z"/></svg>
      Join Discord
    </a>
  </div>

  <div class="hero-stats">
    <div class="hstat">
      <div class="hstat-n" data-target="100K+">100K+</div>
      <div class="hstat-l">Customers</div>
    </div>
    <div class="hstat">
      <div class="hstat-n" data-target="4.8★">4.8★</div>
      <div class="hstat-l">Trustpilot</div>
    </div>
    <div class="hstat">
      <div class="hstat-n">Est.</div>
      <div class="hstat-l">2021</div>
    </div>
    <div class="hstat">
      <div class="hstat-n">24/7</div>
      <div class="hstat-l">Support</div>
    </div>
  </div>
</section>

<!-- ─── TRUST BAR ─────────────────────────────────────────────────────────── -->
<div class="trust-bar">
  <div class="trust-inner">
    <div class="ti">
      <div class="ti-icon">⚡</div>
      <span><strong>Instant Delivery</strong> — Keys sent immediately</span>
    </div>
    <div class="ti-sep"></div>
    <div class="ti">
      <div class="ti-icon">🔒</div>
      <span><strong>Verified Products</strong> — All products tested</span>
    </div>
    <div class="ti-sep"></div>
    <div class="ti">
      <div class="ti-icon">💬</div>
      <span><strong>24/7 Support</strong> — Via Discord</span>
    </div>
    <div class="ti-sep"></div>
    <div class="ti">
      <div class="ti-icon">🛡️</div>
      <span><strong>Secure Payments</strong> — Crypto &amp; cards</span>
    </div>
    <div class="ti-sep"></div>
    <div class="ti">
      <div class="ti-icon">🔄</div>
      <span><strong>Regular Updates</strong> — Always undetected</span>
    </div>
  </div>
</div>

<!-- ─── LIVE SALES TICKER ──────────────────────────────────────────────────── -->
<div class="live-ticker" aria-label="Recent sales activity">
  <div class="live-ticker-label">
    <span class="live-ticker-dot"></span>
    LIVE
  </div>
  <div class="live-ticker-track-wrap">
    <div class="live-ticker-track ticker-track-base">
      <span class="lti"><span class="lti-icon">🎯</span> <strong>xSniperKing</strong> purchased <span class="lti-prod">Neverlose CS2</span> <span class="lti-time">2m ago</span></span>
      <span class="lti-sep">·</span>
      <span class="lti"><span class="lti-icon">🏎️</span> <strong>GTA_Legend99</strong> purchased <span class="lti-prod">Cherax GTA5</span> <span class="lti-time">5m ago</span></span>
      <span class="lti-sep">·</span>
      <span class="lti"><span class="lti-icon">🛡️</span> <strong>SpooferPro</strong> purchased <span class="lti-prod">Ethereal Spoofer</span> <span class="lti-time">8m ago</span></span>
      <span class="lti-sep">·</span>
      <span class="lti"><span class="lti-icon">🌐</span> <strong>FiveM_King</strong> purchased <span class="lti-prod">Susano FiveM</span> <span class="lti-time">11m ago</span></span>
      <span class="lti-sep">·</span>
      <span class="lti"><span class="lti-icon">🤖</span> <strong>ArcPlayer</strong> purchased <span class="lti-prod">Kernaim ARC Raiders</span> <span class="lti-time">14m ago</span></span>
      <span class="lti-sep">·</span>
      <span class="lti"><span class="lti-icon">🎯</span> <strong>HeadshotOnly</strong> purchased <span class="lti-prod">Neverlose CS2</span> <span class="lti-time">17m ago</span></span>
      <span class="lti-sep">·</span>
      <span class="lti"><span class="lti-icon">🏎️</span> <strong>GodMode_GTA</strong> purchased <span class="lti-prod">Cherax GTA5</span> <span class="lti-time">21m ago</span></span>
      <span class="lti-sep">·</span>
      <!-- Duplicate for seamless loop -->
      <span class="lti"><span class="lti-icon">🎯</span> <strong>xSniperKing</strong> purchased <span class="lti-prod">Neverlose CS2</span> <span class="lti-time">2m ago</span></span>
      <span class="lti-sep">·</span>
      <span class="lti"><span class="lti-icon">🏎️</span> <strong>GTA_Legend99</strong> purchased <span class="lti-prod">Cherax GTA5</span> <span class="lti-time">5m ago</span></span>
      <span class="lti-sep">·</span>
      <span class="lti"><span class="lti-icon">🛡️</span> <strong>SpooferPro</strong> purchased <span class="lti-prod">Ethereal Spoofer</span> <span class="lti-time">8m ago</span></span>
      <span class="lti-sep">·</span>
      <span class="lti"><span class="lti-icon">🌐</span> <strong>FiveM_King</strong> purchased <span class="lti-prod">Susano FiveM</span> <span class="lti-time">11m ago</span></span>
      <span class="lti-sep">·</span>
      <span class="lti"><span class="lti-icon">🤖</span> <strong>ArcPlayer</strong> purchased <span class="lti-prod">Kernaim ARC Raiders</span> <span class="lti-time">14m ago</span></span>
    </div>
  </div>
</div>

<!-- ─── FEATURE HIGHLIGHTS ────────────────────────────────────────────────── -->
<section class="section section-glow" style="padding-top:72px;padding-bottom:60px;">
  <div class="section-inner">
    <div class="section-header reveal">
      <div>
        <div class="tag">Why TGModz</div>
        <h2 class="heading">BUILT FOR SERIOUS GAMERS</h2>
        <p class="subtext" style="margin-top:.5rem">Everything you need for a competitive edge, delivered with zero friction.</p>
      </div>
    </div>
    <div class="feature-hl-grid">

      <div class="feature-hl-card reveal">
        <div class="fhl-icon-wrap fhl-blue">⚡</div>
        <div class="fhl-title">Instant Digital Delivery</div>
        <p class="fhl-desc">License keys and download links sent within seconds of payment — via email and Discord. No waiting, no delays.</p>
      </div>

      <div class="feature-hl-card reveal" style="transition-delay:.08s">
        <div class="fhl-icon-wrap fhl-green">🛡️</div>
        <div class="fhl-title">Verified & Always Safe</div>
        <p class="fhl-desc">Every product is tested, reviewed, and actively monitored by our team. We only list software that we'd use ourselves.</p>
      </div>

      <div class="feature-hl-card reveal" style="transition-delay:.16s">
        <div class="fhl-icon-wrap fhl-cyan">🔄</div>
        <div class="fhl-title">Constant Updates</div>
        <p class="fhl-desc">All tools are continuously updated to stay ahead of anti-cheat patches. Your license always gets the latest build.</p>
      </div>

      <div class="feature-hl-card reveal" style="transition-delay:.24s">
        <div class="fhl-icon-wrap fhl-purple">💬</div>
        <div class="fhl-title">24/7 Expert Support</div>
        <p class="fhl-desc">Real humans on Discord around the clock. Setup help, troubleshooting, refunds — we've got you covered.</p>
      </div>

      <div class="feature-hl-card reveal" style="transition-delay:.32s">
        <div class="fhl-icon-wrap fhl-gold">🔒</div>
        <div class="fhl-title">Secure Transactions</div>
        <p class="fhl-desc">Encrypted checkout with crypto, card, and PayPal support. Your payment data is never stored or shared.</p>
      </div>

      <div class="feature-hl-card reveal" style="transition-delay:.4s">
        <div class="fhl-icon-wrap fhl-red">🎯</div>
        <div class="fhl-title">Zero Input Lag</div>
        <p class="fhl-desc">Our enhancement tools are precision-engineered for competitive play — smooth performance, no frame drops, tear-free rendering.</p>
      </div>

    </div>
  </div>
</section>

<div class="glow-line"></div>

<!-- ─── FEATURED PRODUCTS ─────────────────────────────────────────────────── -->
<section class="section section-glow">
  <div class="section-inner">
    <div class="section-header reveal">
      <div>
        <div class="tag">Featured Products</div>
        <h2 class="heading">OUR TOP PICKS</h2>
        <p class="subtext" style="margin-top:.5rem">Hand-picked, always-undetected, instant delivery.</p>
      </div>
      <a href="/shop" class="view-all">View all →</a>
    </div>

    <div class="products-grid">
      <?php foreach ($product_list as $p):
        $cta = htmlspecialchars($p['cta_text'] ?? 'START CHEATING NOW!');
      ?>
      <a href="/product/<?= $p['slug'] ?>" class="prod-card reveal">
        <!-- Corner bracket decorations -->
        <span class="prod-corner prod-corner-tl"></span>
        <span class="prod-corner prod-corner-tr"></span>
        <span class="prod-corner prod-corner-bl"></span>
        <span class="prod-corner prod-corner-br"></span>

        <!-- Full-bleed game artwork -->
        <div class="prod-img-wrap" style="background:linear-gradient(160deg,<?= htmlspecialchars($p['game_color']) ?>22 0%,#06070e 100%);">
          <?php if (!empty($p['image_url'])): ?>
            <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" loading="lazy">
          <?php else: ?>
            <div class="prod-img-placeholder">
              <span class="prod-img-icon"><?= $p['game_icon'] ?></span>
            </div>
          <?php endif; ?>
          <div class="prod-img-overlay"></div>

          <!-- Badge + stock dot -->
          <span class="prod-badge"><span class="badge <?= $p['badge_class'] ?>"><?= $p['badge'] ?></span></span>
          <?php if ($p['in_stock']): ?><div class="prod-stock-dot"></div><?php endif; ?>

          <!-- Game logo at top -->
          <div class="prod-game-logo">
            <?= $p['game_icon'] ?> <?= htmlspecialchars($p['game']) ?>
          </div>

          <!-- Name + price + pills overlaid at bottom -->
          <div class="prod-overlay">
            <div class="prod-overlay-name"><?= htmlspecialchars($p['name']) ?></div>
            <span class="prod-overlay-price-label">Starting price</span>
            <div class="prod-overlay-price-row">
              <span class="prod-overlay-from">from</span>
              <span class="prod-overlay-price">$<?= number_format($p['price_from'], 2) ?></span>
              <?php if ($p['price_orig'] > $p['price_from']): ?>
              <span class="prod-overlay-orig">$<?= number_format($p['price_orig'], 2) ?></span>
              <?php endif; ?>
            </div>
            <div class="prod-pills">
              <span class="prod-pill"><span class="prod-pill-icon">⚡</span> Instant Delivery</span>
              <span class="prod-pill"><span class="prod-pill-icon">🛡</span> Undetected</span>
            </div>
          </div>
        </div>

        <!-- CTA button -->
        <div class="prod-cta">
          <button class="prod-cta-btn"><?= $cta ?> <span class="prod-cta-arrow">→</span></button>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<div class="glow-line"></div>

<!-- ─── CATEGORIES ────────────────────────────────────────────────────────── -->
<section class="section" style="padding-top:60px;">
  <div class="section-inner">
    <div class="section-header reveal">
      <div>
        <div class="tag">Browse by Game</div>
        <h2 class="heading">GAME CATEGORIES</h2>
      </div>
    </div>
    <div class="cats-grid reveal">
      <?php
      $cats = [
        ['icon'=>'🎯','name'=>'CS2',          'color'=>'#3b82f6','slug'=>'neverlose-cs2'],
        ['icon'=>'🏎️','name'=>'GTA V',         'color'=>'#f97316','slug'=>'cherax-gta5'],
        ['icon'=>'🌐','name'=>'FiveM',         'color'=>'#06b6d4','slug'=>'susano-fivem'],
        ['icon'=>'🛡️','name'=>'HWID Spoofer',  'color'=>'#a855f7','slug'=>'ethereal-spoofer'],
        ['icon'=>'🤖','name'=>'ARC Raiders',   'color'=>'#0891b2','slug'=>'kernaim-arc-raiders'],
        ['icon'=>'🏆','name'=>'Fortnite',      'color'=>'#9333ea','slug'=>'shop'],
        ['icon'=>'💥','name'=>'Call of Duty',  'color'=>'#b45309','slug'=>'shop'],
        ['icon'=>'🎮','name'=>'Roblox',        'color'=>'#ef4444','slug'=>'shop'],
        ['icon'=>'🔫','name'=>'R6 Siege',      'color'=>'#22c55e','slug'=>'shop'],
        ['icon'=>'🤠','name'=>'RDR2',          'color'=>'#d97706','slug'=>'shop'],
        ['icon'=>'⚡','name'=>'Marvel Rivals', 'color'=>'#dc2626','slug'=>'shop'],
        ['icon'=>'🎯','name'=>'Rust',          'color'=>'#65a30d','slug'=>'shop'],
      ];
      foreach ($cats as $cat):
      ?>
      <a href="/<?= $cat['slug'] !== 'shop' ? 'product/'.$cat['slug'] : 'shop' ?>" class="cat-card">
        <div class="cat-icon" style="background:<?= $cat['color'] ?>18; border:1px solid <?= $cat['color'] ?>28;">
          <?= $cat['icon'] ?>
        </div>
        <div class="cat-name"><?= $cat['name'] ?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ─── HOW IT WORKS ──────────────────────────────────────────────────────── -->
<section class="section">
  <div class="section-inner">
    <div class="section-header reveal">
      <div>
        <div class="tag">Simple Process</div>
        <h2 class="heading">HOW IT WORKS</h2>
        <p class="subtext" style="margin-top:.5rem">Up and running in under 5 minutes.</p>
      </div>
    </div>
    <div class="steps-grid">
      <div class="step reveal">
        <div class="step-num">01</div>
        <div class="step-icon">🛒</div>
        <div class="step-title">Choose Your Product</div>
        <p class="step-desc">Browse our catalogue and pick the software that fits your game and budget. Every product is verified and tested before listing.</p>
      </div>
      <div class="step reveal" style="transition-delay:.1s">
        <div class="step-num">02</div>
        <div class="step-icon">💳</div>
        <div class="step-title">Complete Payment</div>
        <p class="step-desc">Pay securely with crypto, card, or PayPal. All transactions are encrypted and your information is never stored.</p>
      </div>
      <div class="step reveal" style="transition-delay:.2s">
        <div class="step-num">03</div>
        <div class="step-icon">⚡</div>
        <div class="step-title">Instant Delivery</div>
        <p class="step-desc">Receive your license key or download link instantly via email or Discord. Full setup guide included with every purchase.</p>
      </div>
    </div>
  </div>
</section>

<!-- ─── FAQ ─────────────────────────────────────────────────────────────────── -->
<section id="faq" class="section" style="padding-top:60px;padding-bottom:60px;">
  <div class="section-inner">
    <div class="section-header reveal">
      <div>
        <div class="tag">Got Questions?</div>
        <h2 class="heading">FREQUENTLY ASKED</h2>
        <p class="subtext" style="margin-top:.5rem">Everything you need to know before purchasing.</p>
      </div>
    </div>
    <div class="faq-list">

      <div class="faq-item reveal">
        <button class="faq-q" aria-expanded="false">
          <span>Is TGModz an authorized reseller?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-a">
          <p>Yes. TGModz is an officially authorized reseller for every product in our catalogue. We work directly with developers to offer genuine licenses at competitive prices — you're never buying from an untrusted third party.</p>
        </div>
      </div>

      <div class="faq-item reveal">
        <button class="faq-q" aria-expanded="false">
          <span>How quickly do I receive my license after purchase?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-a">
          <p>Instantly. License keys and download links are delivered to your email and Discord within seconds of payment confirmation. No manual processing, no delays — automated 24/7.</p>
        </div>
      </div>

      <div class="faq-item reveal">
        <button class="faq-q" aria-expanded="false">
          <span>Are the products undetected by anti-cheat?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-a">
          <p>All products in our catalogue are actively monitored and updated around the clock. We only list software that passes our internal testing and verification. When an anti-cheat update drops, developers push fixes rapidly — your subscription always gets the latest safe build.</p>
        </div>
      </div>

      <div class="faq-item reveal">
        <button class="faq-q" aria-expanded="false">
          <span>What payment methods do you accept?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-a">
          <p>We accept Visa, Mastercard, PayPal, Bitcoin, Ethereum, and Litecoin. All transactions are encrypted — your payment information is never stored or shared.</p>
        </div>
      </div>

      <div class="faq-item reveal">
        <button class="faq-q" aria-expanded="false">
          <span>What happens if a product goes detected?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-a">
          <p>Our team monitors all products continuously. In the rare event a product is temporarily detected, the developers issue a patch rapidly. Your subscription is automatically extended for any downtime exceeding 48 hours. Contact our Discord support team for any concerns.</p>
        </div>
      </div>

      <div class="faq-item reveal">
        <button class="faq-q" aria-expanded="false">
          <span>Do you offer refunds?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-a">
          <p>Yes — we offer refunds on a case-by-case basis. If a product doesn't work as advertised, contact our Discord support team within 24 hours of purchase. Refunds are typically processed within 1–3 business days. Note: refunds are not available after a license has been activated.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<div class="glow-line"></div>

<!-- ─── STATS ─────────────────────────────────────────────────────────────── -->
<div class="stats-bar">
  <div class="stats-inner">
    <div class="stat-box">
      <div class="stat-n" data-target="100K+">100K+</div>
      <div class="stat-l">Happy Customers</div>
    </div>
    <div class="stat-box">
      <div class="stat-n" data-target="50+">50+</div>
      <div class="stat-l">Products Listed</div>
    </div>
    <div class="stat-box">
      <div class="stat-n" data-target="4.8★">4.8★</div>
      <div class="stat-l">Trustpilot Rating</div>
    </div>
    <div class="stat-box">
      <div class="stat-n">24/7</div>
      <div class="stat-l">Discord Support</div>
    </div>
  </div>
</div>

<!-- ─── REVIEWS ────────────────────────────────────────────────────────────── -->
<section class="section">
  <div class="section-inner">
    <div class="section-header reveal">
      <div>
        <div class="tag">Customer Reviews</div>
        <h2 class="heading">WHAT PLAYERS SAY</h2>
      </div>
      <div style="display:flex;align-items:center;gap:.5rem;font-size:.82rem;color:var(--text2);">
        <span style="color:var(--gold);letter-spacing:.05em;">★★★★★</span>
        <strong style="color:var(--text);">4.8</strong> on Trustpilot
      </div>
    </div>
    <div class="reviews-grid">
      <div class="review-card reveal">
        <div class="review-stars">★★★★★</div>
        <p class="review-text">"Neverlose CS2 is absolutely insane. Setup took less than 5 minutes and it's been undetected for 3 months straight. TGModz support is also top tier — they responded in under 10 minutes on Discord."</p>
        <div class="review-author">
          <div class="review-ava">🎯</div>
          <div>
            <div class="review-name">xSniperKing</div>
            <div class="review-meta">CS2 · Verified Purchase</div>
          </div>
        </div>
      </div>
      <div class="review-card reveal" style="transition-delay:.1s">
        <div class="review-stars">★★★★★</div>
        <p class="review-text">"Cherax GTA 5 is the best mod menu I've ever used. Money drop works perfectly, the UI is clean and easy to navigate. Been using TGModz for 2 years now and never had a single issue."</p>
        <div class="review-author">
          <div class="review-ava">🏎️</div>
          <div>
            <div class="review-name">GTA_Legend99</div>
            <div class="review-meta">GTA V · Verified Purchase</div>
          </div>
        </div>
      </div>
      <div class="review-card reveal" style="transition-delay:.2s">
        <div class="review-stars">★★★★★</div>
        <p class="review-text">"The Ethereal Spoofer saved me after getting hardware banned in Warzone. Works perfectly, easy setup, and TGModz had me back in game within 30 minutes of purchase. Highly recommend."</p>
        <div class="review-author">
          <div class="review-ava">🛡️</div>
          <div>
            <div class="review-name">SpooferPro</div>
            <div class="review-meta">HWID Spoofer · Verified Purchase</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ─── CTA BANNER ────────────────────────────────────────────────────────── -->
<section class="section" style="padding-top:0;padding-bottom:80px;">
  <div class="section-inner">
    <div class="reveal" style="background:linear-gradient(135deg,var(--surface) 0%,var(--surface2) 100%);border:1px solid var(--border2);border-radius:var(--radius-lg);padding:3rem 2.5rem;text-align:center;position:relative;overflow:hidden;">
      <div style="position:absolute;inset:0;background:radial-gradient(ellipse 80% 120% at 50% 50%,rgba(59,130,246,.07),transparent 70%);pointer-events:none;"></div>
      <div style="position:relative;z-index:1;">
        <div class="tag">Ready to Dominate?</div>
        <h2 class="heading" style="font-size:clamp(1.8rem,4vw,3rem);margin-bottom:.75rem;">START WINNING TODAY</h2>
        <p class="subtext" style="margin:0 auto 2rem;max-width:480px;">Join over 100,000 gamers who trust TGModz for their competitive edge. Instant delivery, 24/7 support.</p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
          <a href="/shop" class="btn btn-primary btn-lg">Browse All Products</a>
          <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener" class="btn btn-outline btn-lg">Join Our Discord</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
