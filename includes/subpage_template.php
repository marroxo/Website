<?php
// Required variables before including this file:
// $page_title, $page_desc, $active_page, $game_slug, $game_name
// $game_icon, $game_color (CSS color), $game_tagline, $game_description
// $products (array of product data)
require __DIR__ . '/head.php';

// Per-game accent color override
$accent = $game_color ?? 'var(--blue)';
?>
<style>
/* ── Per-game accent ─────────────────────────────────────────────── */
.sub-accent { color: <?= $accent ?>; }
.sub-btn-primary {
  background: <?= $accent ?>;
  color: #fff;
  padding: 14px 32px; border-radius: 10px; font-weight: 700; font-size: 0.95rem;
  text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
  transition: all 0.3s; border: none; cursor: pointer; min-height: 50px;
  box-shadow: 0 4px 20px <?= $accent ?>44;
}
.sub-btn-primary:hover { filter: brightness(0.88); transform: translateY(-2px); }
.sub-hero-badge {
  display: inline-flex; align-items: center; gap: 8px;
  background: <?= $accent ?>18; border: 1px solid <?= $accent ?>44;
  padding: 6px 16px; border-radius: 50px;
  font-size: 0.78rem; font-weight: 600; color: <?= $accent ?>;
  margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.5px;
}
.product-buy-sub {
  background: <?= $accent ?>;
  color: #fff; padding: 10px 18px; border-radius: 8px;
  font-weight: 600; font-size: 0.78rem; text-decoration: none;
  transition: all 0.3s; border: none; cursor: pointer;
  min-height: 38px; display: inline-flex; align-items: center;
}
.product-buy-sub:hover { filter: brightness(0.88); transform: translateY(-1px); }
</style>
</head>
<body>

<?php require __DIR__ . '/nav.php'; ?>

<!-- ── SUBDOMAIN HERO ─────────────────────────────────────────────────────── -->
<section class="sub-hero">
  <div class="container">
    <div class="sub-hero-inner">
      <div class="sub-hero-breadcrumb">
        <a href="/">TGModz</a>
        <span>&#8250;</span>
        <span><?= htmlspecialchars($game_name) ?></span>
      </div>
      <div class="sub-hero-badge">
        <span aria-hidden="true"><?= $game_icon ?></span>
        <?= htmlspecialchars($game_name) ?> Software
      </div>
      <h1><?= htmlspecialchars($game_tagline) ?> <span class="highlight"><?= htmlspecialchars($game_name) ?></span> Software</h1>
      <p><?= htmlspecialchars($game_description) ?></p>
      <div style="display:flex;gap:14px;flex-wrap:wrap;margin-top:8px;">
        <a href="https://discord.gg/tgmodz" class="sub-btn-primary" target="_blank" rel="noopener">
          Shop on Discord &rarr;
        </a>
        <a href="/" class="btn-secondary">&#8592; All Products</a>
      </div>
    </div>
  </div>
</section>

<!-- ── TRUST BAR ─────────────────────────────────────────────────────────── -->
<div class="trust-bar">
  <div class="container">
    <div class="trust-items">
      <div class="trust-item reveal">
        <div class="trust-icon" aria-hidden="true">⚡</div>
        <div><strong>Instant Delivery</strong><br>Email Within Seconds</div>
      </div>
      <div class="trust-item reveal stagger-1">
        <div class="trust-icon" aria-hidden="true">✓</div>
        <div><strong>Authorized Reseller</strong><br>Developer Verified</div>
      </div>
      <div class="trust-item reveal stagger-2">
        <div class="trust-icon" aria-hidden="true">🔒</div>
        <div><strong>Secure Checkout</strong><br>SSL &amp; PCI Compliant</div>
      </div>
      <div class="trust-item reveal stagger-3">
        <div class="trust-icon" aria-hidden="true">💬</div>
        <div><strong>24/7 Support</strong><br>Discord Live Help</div>
      </div>
    </div>
  </div>
</div>

<!-- ── PRODUCTS ───────────────────────────────────────────────────────────── -->
<section class="products" id="products">
  <div class="container">
    <div class="section-header center">
      <div class="section-label reveal"><?= htmlspecialchars($game_name) ?> Products</div>
      <h2 class="section-title reveal stagger-1">All <?= htmlspecialchars($game_name) ?> Software</h2>
      <p class="section-sub reveal stagger-2">Every product is authorized, instantly delivered, and backed by our 24/7 support team.</p>
    </div>

    <div class="products-grid">
      <?php foreach ($products as $i => $p):
        $stagger = ($i % 8) + 1;
        $badge_class = $p['badge_class'] ?? '';
        $badge_label = $p['badge_label'] ?? '';
      ?>
      <div class="product-card reveal stagger-<?= $stagger ?>">
        <div class="product-img">
          <span class="product-game-icon" aria-hidden="true"><?= $game_icon ?></span>
          <?php if ($badge_class && $badge_label): ?>
            <span class="product-badge <?= htmlspecialchars($badge_class) ?>"><?= htmlspecialchars($badge_label) ?></span>
          <?php endif; ?>
        </div>
        <div class="product-info">
          <div class="product-game"><?= htmlspecialchars($game_name) ?></div>
          <div class="product-name"><?= htmlspecialchars($p['name']) ?></div>
          <div class="product-meta">
            <span class="product-stars" aria-label="<?= $p['rating'] ?> stars"><?= str_repeat('★', (int)$p['rating']) ?><?= $p['rating'] < 5 ? '☆' : '' ?></span>
            <span><?= htmlspecialchars($p['rating']) ?></span>
            <span class="product-sold">&middot; <?= htmlspecialchars($p['sold']) ?> sold</span>
          </div>
          <div class="product-bottom">
            <div class="product-price">
              $<?= htmlspecialchars($p['price']) ?>
              <?php if (!empty($p['old_price'])): ?>
                <span class="old">$<?= htmlspecialchars($p['old_price']) ?></span>
              <?php endif; ?>
            </div>
            <a href="https://discord.gg/tgmodz" class="product-buy-sub" target="_blank" rel="noopener">Buy Now</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="view-all-row reveal">
      <a href="https://discord.gg/tgmodz" class="btn-secondary" target="_blank" rel="noopener">
        View More on Discord &rarr;
      </a>
    </div>
  </div>
</section>

<!-- ── OTHER CATEGORIES ───────────────────────────────────────────────────── -->
<section class="categories" style="background:var(--bg);">
  <div class="container">
    <div class="section-header center">
      <div class="section-label reveal">Other Games</div>
      <h2 class="section-title reveal stagger-1">Browse Other Categories</h2>
    </div>
    <div class="categories-grid">
      <?php
      $all_cats = [
        'cs2'   => ['icon'=>'🎯','name'=>'CS2'],
        'gta'   => ['icon'=>'🏎️','name'=>'GTA V'],
        'fivem' => ['icon'=>'🌐','name'=>'FiveM'],
        'r6'    => ['icon'=>'🔫','name'=>'R6 Siege'],
        'rdr2'  => ['icon'=>'🤠','name'=>'RDR2'],
      ];
      $si = 1;
      foreach ($all_cats as $slug => $cat):
        if ($slug === $game_slug) continue;
      ?>
      <a href="/<?= $slug ?>" class="cat-btn reveal stagger-<?= $si++ ?>">
        <span class="cat-icon" aria-hidden="true"><?= $cat['icon'] ?></span>
        <span class="cat-name"><?= htmlspecialchars($cat['name']) ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── DISCORD CTA ────────────────────────────────────────────────────────── -->
<section class="discord-cta">
  <div class="container">
    <div class="discord-box reveal">
      <h2>Need Help Choosing <span style="color:var(--blue)"><?= htmlspecialchars($game_name) ?></span> Software?</h2>
      <p>Join our Discord community and our experts will help you pick the perfect product for your needs.</p>
      <a href="https://discord.gg/tgmodz" class="btn-discord" target="_blank" rel="noopener">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.317 4.37a19.791 19.791 0 00-4.885-1.515.074.074 0 00-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 00-5.487 0 12.64 12.64 0 00-.617-1.25.077.077 0 00-.079-.037A19.736 19.736 0 003.677 4.37a.07.07 0 00-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 00.031.057 19.9 19.9 0 005.993 3.03.078.078 0 00.084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 00-.041-.106 13.107 13.107 0 01-1.872-.892.077.077 0 01-.008-.128 10.2 10.2 0 00.372-.292.074.074 0 01.077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 01.078.01c.12.098.246.198.373.292a.077.077 0 01-.006.127 12.299 12.299 0 01-1.873.892.077.077 0 00-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 00.084.028 19.839 19.839 0 006.002-3.03.077.077 0 00.032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 00-.031-.03z"/></svg>
        Ask in Discord
      </a>
      <div class="discord-members"><strong>8,500+</strong> members &amp; experts ready to help</div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/footer.php'; ?>

</body>
</html>
