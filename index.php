<?php
$page_title  = 'TGModz — Premium Gaming Software Store | Est. 2021';
$page_desc   = 'TGModz — authorized reseller of premium game enhancement software. Trusted by 100,000+ gamers since 2021. Instant delivery, 24/7 support, verified products.';
$active_page = 'home';

$products     = require __DIR__ . '/data/products.php';
$product_list = array_values($products);

include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/nav.php';
?>

<!-- ─── HERO ─────────────────────────────────────────────────────────────── -->
<div class="hero">
  <!-- Left: content -->
  <div class="hero-content">
    <div class="hero-eyebrow">
      <span class="hero-dot"></span>
      &nbsp;100,000+ Gamers Served Since 2021
    </div>

    <h1 class="hero-headline">
      DOMINATE<br>
      EVERY <span class="accent">MATCH</span>
    </h1>

    <p class="hero-sub">
      Premium game enhancement software — authorized, instantly delivered, and constantly updated. The competitive edge trusted by 100K+ serious gamers.
    </p>

    <div class="hero-ctas">
      <a href="/shop" class="btn btn-primary btn-lg">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
        Explore Gear
      </a>
      <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener" class="btn btn-outline btn-lg">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 00-4.885-1.515.074.074 0 00-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 00-5.487 0 12.64 12.64 0 00-.617-1.25.077.077 0 00-.079-.037A19.736 19.736 0 003.677 4.37a.07.07 0 00-.032.027C.533 9.046-.32 13.58.099 18.057c.002.022.015.04.036.05a19.859 19.859 0 005.993 3.03.077.077 0 00.084-.028 14.09 14.09 0 001.226-1.994.076.076 0 00-.041-.106 13.107 13.107 0 01-1.872-.892.077.077 0 01-.008-.128 10.2 10.2 0 00.372-.292.074.074 0 01.077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 01.078.01c.12.098.246.198.373.292a.077.077 0 01-.006.127 12.299 12.299 0 01-1.873.892.077.077 0 00-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 00.084.028 19.839 19.839 0 006.002-3.03.077.077 0 00.036-.05c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 00-.031-.03z"/></svg>
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
  </div>

  <!-- Right: product ranking panel -->
  <div class="hero-visual">
    <div class="hero-panel">
      <div class="hero-panel-header">
        <span class="hero-panel-title">Top Selling — <?= date('M Y') ?></span>
        <span class="hero-panel-live">
          <span class="hero-dot" style="width:5px;height:5px;"></span>
          Live
        </span>
      </div>
      <?php foreach ($product_list as $i => $p): ?>
      <a href="/product/<?= $p['slug'] ?>" class="hero-panel-row">
        <div class="hpr-num <?= $i === 0 ? 'top' : '' ?>"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></div>
        <div class="hpr-info">
          <div class="hpr-game"><?= htmlspecialchars($p['game']) ?></div>
          <div class="hpr-name"><?= htmlspecialchars($p['name']) ?></div>
        </div>
        <div class="hpr-right">
          <div class="hpr-price">$<?= number_format($p['price_from'], 2) ?></div>
          <span class="badge <?= $p['badge_class'] ?>"><?= $p['badge'] ?></span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<!-- ─── TICKER ────────────────────────────────────────────────────────────── -->
<div class="ticker-wrap">
  <div class="ticker-track">
    <?php
    $ticker_items = [
      ['Instant Delivery', 'Keys sent in seconds'],
      ['100K+ Customers', 'Trusted worldwide'],
      ['Always Undetected', 'Monitored 24/7'],
      ['Authorized Reseller', 'Official partner'],
      ['24/7 Discord Support', 'Real humans, fast replies'],
      ['Secure Payments', 'Crypto & cards accepted'],
      ['Free Updates', 'Included in every plan'],
      ['Est. 2021', '4+ years of excellence'],
    ];
    // Render twice for seamless loop
    for ($r = 0; $r < 2; $r++):
      foreach ($ticker_items as $t):
    ?>
    <div class="ticker-item">
      <span class="ticker-dot">●</span>
      <strong><?= $t[0] ?></strong>
      — <?= $t[1] ?>
    </div>
    <?php endforeach; endfor; ?>
  </div>
</div>

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

<!-- ─── FEATURE HIGHLIGHTS ────────────────────────────────────────────────── -->
<section class="section">
  <div class="section-inner">
    <div class="section-head reveal">
      <div>
        <div class="label">Why TGModz</div>
        <h2>BUILT FOR SERIOUS GAMERS</h2>
      </div>
    </div>
    <div class="feature-grid">
      <div class="feature-card reveal">
        <div class="feature-num">01</div>
        <div class="feature-icon">⚡</div>
        <div class="feature-title">Instant Digital Delivery</div>
        <p class="feature-desc">License keys and download links sent within seconds of payment — via email and Discord. No waiting, no delays.</p>
      </div>
      <div class="feature-card reveal" style="transition-delay:.06s">
        <div class="feature-num">02</div>
        <div class="feature-icon">🛡️</div>
        <div class="feature-title">Verified & Always Safe</div>
        <p class="feature-desc">Every product is tested, reviewed, and actively monitored by our team. We only list software that we'd use ourselves.</p>
      </div>
      <div class="feature-card reveal" style="transition-delay:.12s">
        <div class="feature-num">03</div>
        <div class="feature-icon">🔄</div>
        <div class="feature-title">Constant Updates</div>
        <p class="feature-desc">All tools are continuously updated to stay ahead of anti-cheat patches. Your license always gets the latest build.</p>
      </div>
      <div class="feature-card reveal" style="transition-delay:.18s">
        <div class="feature-num">04</div>
        <div class="feature-icon">💬</div>
        <div class="feature-title">24/7 Expert Support</div>
        <p class="feature-desc">Real humans on Discord around the clock. Setup help, troubleshooting, refunds — we've got you covered.</p>
      </div>
      <div class="feature-card reveal" style="transition-delay:.24s">
        <div class="feature-num">05</div>
        <div class="feature-icon">🔒</div>
        <div class="feature-title">Secure Transactions</div>
        <p class="feature-desc">Encrypted checkout with crypto, card, and PayPal. Your payment data is never stored or shared.</p>
      </div>
      <div class="feature-card reveal" style="transition-delay:.30s">
        <div class="feature-num">06</div>
        <div class="feature-icon">🎯</div>
        <div class="feature-title">Zero Input Lag</div>
        <p class="feature-desc">Precision-engineered for competitive play — smooth performance, no frame drops, no footprint.</p>
      </div>
    </div>
  </div>
</section>

<div class="glow-line"></div>

<!-- ─── FEATURED PRODUCTS ─────────────────────────────────────────────────── -->
<section class="section">
  <div class="section-inner">
    <div class="section-head reveal">
      <div>
        <div class="label">Featured Products</div>
        <h2>OUR TOP PICKS</h2>
      </div>
      <a href="/shop" class="view-all">View all →</a>
    </div>

    <div class="products-grid">
      <?php foreach ($product_list as $p): ?>
      <a href="/product/<?= $p['slug'] ?>" class="prod-card reveal">
        <div class="prod-img-wrap" style="background:linear-gradient(160deg,<?= htmlspecialchars($p['game_color']) ?>18 0%,var(--surface2) 100%);">
          <?php if (!empty($p['image_url'])): ?>
            <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" loading="lazy">
          <?php else: ?>
            <div class="prod-img-placeholder"><?= $p['game_icon'] ?></div>
          <?php endif; ?>
          <div class="prod-img-overlay"></div>
          <div class="prod-badge-wrap"><span class="badge <?= $p['badge_class'] ?>"><?= $p['badge'] ?></span></div>
          <?php if ($p['in_stock']): ?><div class="prod-stock-dot"></div><?php endif; ?>
        </div>
        <div class="prod-body">
          <div class="prod-game"><?= htmlspecialchars($p['game']) ?> · <?= htmlspecialchars($p['category']) ?></div>
          <div class="prod-name"><?= htmlspecialchars($p['name']) ?></div>
          <div class="prod-tagline"><?= htmlspecialchars($p['tagline']) ?></div>
          <div class="prod-foot">
            <div class="prod-price-wrap">
              <span class="prod-from">From</span>
              <span class="prod-price">$<?= number_format($p['price_from'], 2) ?></span>
              <?php if ($p['price_orig'] > $p['price_from']): ?>
              <span class="prod-orig">$<?= number_format($p['price_orig'], 2) ?></span>
              <?php endif; ?>
            </div>
            <span class="prod-buy"><?= htmlspecialchars($p['cta_text'] ?? 'Buy Now') ?></span>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<div class="glow-line"></div>

<!-- ─── CATEGORIES ────────────────────────────────────────────────────────── -->
<section class="section" style="padding-top:60px;padding-bottom:60px;">
  <div class="section-inner">
    <div class="section-head reveal">
      <div>
        <div class="label">Browse by Game</div>
        <h2>GAME CATEGORIES</h2>
      </div>
    </div>
    <div class="cats-grid reveal">
      <?php
      $cats = [
        ['icon'=>'🎯','name'=>'CS2',          'slug'=>'neverlose-cs2',     'product'=>true],
        ['icon'=>'🏎️','name'=>'GTA V',         'slug'=>'cherax-gta5',       'product'=>true],
        ['icon'=>'🌐','name'=>'FiveM',         'slug'=>'susano-fivem',      'product'=>true],
        ['icon'=>'🛡️','name'=>'HWID Spoofer',  'slug'=>'ethereal-spoofer',  'product'=>true],
        ['icon'=>'🤖','name'=>'ARC Raiders',   'slug'=>'kernaim-arc-raiders','product'=>true],
        ['icon'=>'🏆','name'=>'Fortnite',      'slug'=>'shop',              'product'=>false],
        ['icon'=>'💥','name'=>'Call of Duty',  'slug'=>'shop',              'product'=>false],
        ['icon'=>'🎮','name'=>'Roblox',        'slug'=>'shop',              'product'=>false],
        ['icon'=>'🔫','name'=>'R6 Siege',      'slug'=>'shop',              'product'=>false],
        ['icon'=>'🤠','name'=>'RDR2',          'slug'=>'shop',              'product'=>false],
        ['icon'=>'⚡','name'=>'Marvel Rivals', 'slug'=>'shop',              'product'=>false],
        ['icon'=>'🎯','name'=>'Rust',          'slug'=>'shop',              'product'=>false],
      ];
      foreach ($cats as $cat):
        $href = $cat['product'] ? '/product/' . $cat['slug'] : '/' . $cat['slug'];
      ?>
      <a href="<?= $href ?>" class="cat-card">
        <div class="cat-icon"><?= $cat['icon'] ?></div>
        <div class="cat-name"><?= $cat['name'] ?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ─── HOW IT WORKS ──────────────────────────────────────────────────────── -->
<section class="section" style="padding-top:0;padding-bottom:80px;">
  <div class="section-inner">
    <div class="section-head reveal">
      <div>
        <div class="label">Simple Process</div>
        <h2>HOW IT WORKS</h2>
      </div>
    </div>
    <div class="steps-grid">
      <div class="step reveal">
        <div class="step-num">01</div>
        <div class="step-icon">🛒</div>
        <div class="step-title">Choose Your Product</div>
        <p class="step-desc">Browse our catalogue and pick the software that fits your game and budget. Every product is verified and tested before listing.</p>
      </div>
      <div class="step reveal" style="transition-delay:.08s">
        <div class="step-num">02</div>
        <div class="step-icon">💳</div>
        <div class="step-title">Complete Payment</div>
        <p class="step-desc">Pay securely with crypto, card, or PayPal. All transactions are encrypted and your information is never stored.</p>
      </div>
      <div class="step reveal" style="transition-delay:.16s">
        <div class="step-num">03</div>
        <div class="step-icon">⚡</div>
        <div class="step-title">Instant Delivery</div>
        <p class="step-desc">Receive your license key or download link instantly via email or Discord. Full setup guide included with every purchase.</p>
      </div>
    </div>
  </div>
</section>

<div class="glow-line"></div>

<!-- ─── FAQ ──────────────────────────────────────────────────────────────── -->
<section id="faq" class="section">
  <div class="section-inner">
    <div class="section-head reveal">
      <div>
        <div class="label">Got Questions?</div>
        <h2>FREQUENTLY ASKED</h2>
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
          <p>Our team monitors all products continuously. In the rare event a product is temporarily detected, the developers issue a patch rapidly. Your subscription is automatically extended for any downtime exceeding 48 hours.</p>
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

<!-- ─── STATS BAR ─────────────────────────────────────────────────────────── -->
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
    <div class="section-head reveal">
      <div>
        <div class="label">Customer Reviews</div>
        <h2>WHAT PLAYERS SAY</h2>
      </div>
      <div style="display:flex;align-items:center;gap:.5rem;font-family:'DM Mono',monospace;font-size:.65rem;letter-spacing:.08em;text-transform:uppercase;color:var(--text3);">
        <span style="color:var(--gold);">★★★★★</span>
        &nbsp;<strong style="color:var(--text);">4.8</strong>&nbsp;on Trustpilot
      </div>
    </div>
    <div class="reviews-grid">
      <div class="review-card reveal">
        <div class="review-stars">★★★★★</div>
        <p class="review-text">"Neverlose CS2 is absolutely insane. Setup took less than 5 minutes and it's been undetected for 3 months straight. TGModz support responded in under 10 minutes on Discord."</p>
        <div class="review-author">
          <div class="review-ava">🎯</div>
          <div>
            <div class="review-name">xSniperKing</div>
            <div class="review-meta">CS2 · Verified Purchase</div>
          </div>
        </div>
      </div>
      <div class="review-card reveal" style="transition-delay:.08s">
        <div class="review-stars">★★★★★</div>
        <p class="review-text">"Cherax GTA 5 is the best mod menu I've ever used. Money drop works perfectly, the UI is clean and easy to navigate. Been using TGModz for 2 years and never had a single issue."</p>
        <div class="review-author">
          <div class="review-ava">🏎️</div>
          <div>
            <div class="review-name">GTA_Legend99</div>
            <div class="review-meta">GTA V · Verified Purchase</div>
          </div>
        </div>
      </div>
      <div class="review-card reveal" style="transition-delay:.16s">
        <div class="review-stars">★★★★★</div>
        <p class="review-text">"The Ethereal Spoofer saved me after getting hardware banned in Warzone. Works perfectly, easy setup, and TGModz had me back in game within 30 minutes of purchase."</p>
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
    <div class="cta-banner reveal">
      <div class="cta-banner-text">
        <div class="label">Ready to Dominate?</div>
        <h2>START WINNING<br>TODAY</h2>
        <p>Join over 100,000 gamers who trust TGModz for their competitive edge. Instant delivery, 24/7 support, verified products.</p>
      </div>
      <div class="cta-banner-actions">
        <a href="/shop" class="btn btn-primary btn-lg">Browse All Products</a>
        <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener" class="btn btn-outline btn-lg">Join Our Discord</a>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
