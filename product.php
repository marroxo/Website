<?php
$products = require __DIR__ . '/data/products.php';

$uri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$slug = basename(rtrim($uri, '/'));

if (!isset($products[$slug]) && isset($_GET['slug'])) {
    $slug = preg_replace('/[^a-z0-9\-]/', '', strtolower($_GET['slug']));
}

if (!isset($products[$slug])) {
    header('Location: /shop');
    exit;
}

$p = $products[$slug];

$page_title  = $p['name'] . ' — TGModz';
$page_desc   = $p['description'];
$active_page = 'shop';

$savings = $p['price_orig'] > 0
    ? round((($p['price_orig'] - $p['price_from']) / $p['price_orig']) * 100)
    : 0;

include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/nav.php';
?>

<!-- ─── BREADCRUMB ────────────────────────────────────────────────────────── -->
<div class="prod-detail-wrap">
  <div class="prod-detail-breadcrumb">
    <a href="/">Home</a>
    <span>/</span>
    <a href="/shop">Shop</a>
    <span>/</span>
    <span><?= htmlspecialchars($p['name']) ?></span>
  </div>

  <!-- ─── PRODUCT HERO ────────────────────────────────────────────────────── -->
  <div class="prod-detail-hero">
    <!-- Image -->
    <div class="prod-detail-img">
      <?php if (!empty($p['image_url'])): ?>
        <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
      <?php else: ?>
        <div class="prod-detail-img-placeholder"
             style="background:linear-gradient(135deg,<?= $p['game_color'] ?>18,<?= $p['game_color'] ?>06);">
          <?= $p['game_icon'] ?>
        </div>
      <?php endif; ?>
    </div>

    <!-- Meta -->
    <div class="prod-detail-meta">
      <div class="prod-detail-meta-badges">
        <span class="badge <?= $p['badge_class'] ?>"><?= $p['badge'] ?></span>
        <span class="prod-cat-badge"><?= htmlspecialchars($p['category']) ?></span>
        <?php if ($savings > 0): ?>
        <span class="prod-save-badge">Save <?= $savings ?>%</span>
        <?php endif; ?>
      </div>

      <div class="prod-detail-game"><?= htmlspecialchars($p['game']) ?></div>
      <h1 class="prod-detail-name"><?= htmlspecialchars($p['name']) ?></h1>
      <div class="prod-detail-tagline"><?= htmlspecialchars($p['tagline']) ?></div>
      <p class="prod-detail-desc"><?= htmlspecialchars($p['description']) ?></p>

      <?php if ($p['in_stock']): ?>
      <div class="prod-status">
        <div class="prod-status-dot"></div>
        In Stock — <?= $p['sold_today'] ?> sold today
      </div>
      <?php endif; ?>

      <!-- Price box -->
      <div class="prod-price-box">
        <div>
          <div class="prod-price-box-label">Starting from</div>
          <div class="prod-price-box-big">$<?= number_format($p['price_from'], 2) ?></div>
        </div>
        <?php if ($p['price_orig'] > $p['price_from']): ?>
        <div>
          <div class="prod-price-box-orig">$<?= number_format($p['price_orig'], 2) ?></div>
          <div class="prod-price-box-save">Save $<?= number_format($p['price_orig'] - $p['price_from'], 2) ?></div>
        </div>
        <?php endif; ?>
      </div>

      <!-- CTAs -->
      <div class="prod-cta-row">
        <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener" class="btn btn-primary btn-lg" style="flex:1;justify-content:center;min-width:160px;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
          Buy Now on Discord
        </a>
        <a href="/shop" class="btn btn-outline">Back to Shop</a>
      </div>

      <!-- Trust mini -->
      <div class="trust-mini">
        <div class="trust-mini-item"><span>⚡</span>&nbsp;<strong>Instant</strong>&nbsp;delivery</div>
        <div class="trust-mini-item"><span>🔒</span>&nbsp;<strong>Secure</strong>&nbsp;payment</div>
        <div class="trust-mini-item"><span>💬</span>&nbsp;<strong>24/7</strong>&nbsp;support</div>
        <div class="trust-mini-item"><span>✅</span>&nbsp;<strong>Authorized</strong>&nbsp;seller</div>
      </div>
    </div>
  </div>
</div>

<div class="glow-line"></div>

<!-- ─── FEATURES + PLANS ──────────────────────────────────────────────────── -->
<div class="prod-features-layout">

  <!-- Features -->
  <div class="reveal">
    <div class="section-sub-label">What You Get</div>
    <div class="section-sub-h2">FEATURES</div>
    <div class="features-list">
      <?php foreach ($p['features'] as $feat): ?>
      <div class="feature-item">
        <div class="feature-check">✓</div>
        <span><?= htmlspecialchars($feat) ?></span>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Pricing plans -->
  <div class="reveal" style="transition-delay:.08s">
    <div class="section-sub-label">Choose Your Plan</div>
    <div class="section-sub-h2">PRICING</div>
    <div class="plans-grid">
      <?php foreach ($p['plans'] as $plan): ?>
      <div class="plan-card <?= !empty($plan['popular']) ? 'popular' : '' ?>">
        <?php if (!empty($plan['popular'])): ?>
          <div class="plan-popular-badge">Most Popular</div>
        <?php endif; ?>
        <div class="plan-name"><?= htmlspecialchars($plan['name']) ?></div>
        <div class="plan-price">
          <sup style="font-size:1rem;font-family:'DM Sans',sans-serif;font-weight:700;vertical-align:super;">$</sup><?= number_format(floor($plan['price']), 0) ?><sup style="font-size:.85rem;font-family:'DM Sans',sans-serif;font-weight:700;vertical-align:super;">.<?= str_pad((int)(($plan['price'] - floor($plan['price'])) * 100), 2, '0') ?></sup>
        </div>
        <div class="plan-period"><?= $plan['name'] === 'Lifetime' ? 'one time' : 'per period' ?></div>
        <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener" class="plan-btn">Get This Plan</a>
      </div>
      <?php endforeach; ?>
    </div>
    <p class="plans-note">All prices in USD. License keys delivered instantly via Discord or email. Renewals are optional — cancel any time.</p>
  </div>
</div>

<!-- ─── MORE PRODUCTS ──────────────────────────────────────────────────────── -->
<?php
$others = array_values(array_filter($products, fn($prod) => $prod['slug'] !== $slug));
if (!empty($others)):
?>
<div class="glow-line"></div>
<section class="section">
  <div class="section-inner">
    <div class="section-head reveal">
      <div>
        <div class="label">Keep Exploring</div>
        <h2>MORE PRODUCTS</h2>
      </div>
      <a href="/shop" class="view-all">View all →</a>
    </div>
    <div class="products-grid">
      <?php foreach ($others as $op): ?>
      <a href="/product/<?= $op['slug'] ?>" class="prod-card reveal">
        <div class="prod-img-wrap" style="background:linear-gradient(160deg,<?= htmlspecialchars($op['game_color']) ?>18 0%,var(--surface2) 100%);">
          <?php if (!empty($op['image_url'])): ?>
            <img src="<?= htmlspecialchars($op['image_url']) ?>" alt="<?= htmlspecialchars($op['name']) ?>" loading="lazy">
          <?php else: ?>
            <div class="prod-img-placeholder"><?= $op['game_icon'] ?></div>
          <?php endif; ?>
          <div class="prod-img-overlay"></div>
          <div class="prod-badge-wrap"><span class="badge <?= $op['badge_class'] ?>"><?= $op['badge'] ?></span></div>
          <?php if ($op['in_stock']): ?><div class="prod-stock-dot"></div><?php endif; ?>
        </div>
        <div class="prod-body">
          <div class="prod-game"><?= htmlspecialchars($op['game']) ?> · <?= htmlspecialchars($op['category']) ?></div>
          <div class="prod-name"><?= htmlspecialchars($op['name']) ?></div>
          <div class="prod-tagline"><?= htmlspecialchars($op['tagline']) ?></div>
          <div class="prod-foot">
            <div class="prod-price-wrap">
              <span class="prod-from">From</span>
              <span class="prod-price">$<?= number_format($op['price_from'], 2) ?></span>
            </div>
            <span class="prod-buy">Buy Now</span>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
