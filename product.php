<?php
$products = require __DIR__ . '/data/products.php';

// Resolve slug from URL: /product/{slug}
$uri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$slug = basename(rtrim($uri, '/'));

// Fallback to query string for dev/testing: /product.php?slug=neverlose-cs2
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

// Savings %
$savings = $p['price_orig'] > 0
    ? round((($p['price_orig'] - $p['price_from']) / $p['price_orig']) * 100)
    : 0;

include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/nav.php';
?>

<!-- ─── BREADCRUMB ────────────────────────────────────────────────────────── -->
<div style="padding:1.25rem 5%;max-width:1280px;margin:0 auto;">
  <div class="prod-detail-breadcrumb">
    <a href="/">Home</a>
    <span>/</span>
    <a href="/shop">Shop</a>
    <span>/</span>
    <span style="color:var(--text2);"><?= htmlspecialchars($p['name']) ?></span>
  </div>
</div>

<!-- ─── PRODUCT HERO ──────────────────────────────────────────────────────── -->
<div style="padding:0 5% 3rem;max-width:1280px;margin:0 auto;">
  <div class="prod-detail-hero" style="padding:0;">
    <!-- Image -->
    <div class="prod-detail-img">
      <?php if (!empty($p['image_url'])): ?>
        <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
      <?php else: ?>
        <div class="prod-detail-img-placeholder"
             style="background:linear-gradient(135deg,<?= $p['game_color'] ?>22,<?= $p['game_color'] ?>06);">
          <span style="position:relative;z-index:1;"><?= $p['game_icon'] ?></span>
        </div>
      <?php endif; ?>
    </div>

    <!-- Meta -->
    <div class="prod-detail-meta">
      <div style="display:flex;align-items:center;gap:.6rem;margin-bottom:1rem;flex-wrap:wrap;">
        <span class="badge <?= $p['badge_class'] ?>"><?= $p['badge'] ?></span>
        <span style="font-size:.7rem;background:var(--blue-dim);border:1px solid var(--border2);color:var(--blue-hi);padding:2px 8px;border-radius:3px;letter-spacing:.06em;text-transform:uppercase;font-weight:700;"><?= htmlspecialchars($p['category']) ?></span>
        <?php if ($savings > 0): ?>
        <span style="font-size:.7rem;background:var(--gold-dim);border:1px solid rgba(245,158,11,.25);color:var(--gold);padding:2px 8px;border-radius:3px;font-weight:700;">SAVE <?= $savings ?>%</span>
        <?php endif; ?>
      </div>

      <div class="prod-detail-game"><?= htmlspecialchars($p['game']) ?></div>
      <h1 class="prod-detail-name"><?= htmlspecialchars($p['name']) ?></h1>
      <div class="prod-detail-tagline"><?= htmlspecialchars($p['tagline']) ?></div>
      <p class="prod-detail-desc"><?= htmlspecialchars($p['description']) ?></p>

      <!-- Status -->
      <?php if ($p['in_stock']): ?>
      <div class="prod-status">
        <div class="prod-status-dot"></div>
        In Stock — <?= $p['sold_today'] ?> sold today
      </div>
      <?php endif; ?>

      <!-- Price -->
      <div style="display:flex;align-items:baseline;gap:.75rem;margin-bottom:1.5rem;">
        <div>
          <div style="font-size:.68rem;color:var(--text3);margin-bottom:2px;text-transform:uppercase;letter-spacing:.1em;">Starting from</div>
          <div style="font-family:'Bebas Neue',sans-serif;font-size:2.8rem;letter-spacing:.04em;color:var(--blue-hi);line-height:1;">
            $<?= number_format($p['price_from'], 2) ?>
          </div>
        </div>
        <?php if ($p['price_orig'] > $p['price_from']): ?>
        <div>
          <div style="font-size:.7rem;color:var(--text3);text-decoration:line-through;">$<?= number_format($p['price_orig'], 2) ?></div>
          <div style="font-size:.7rem;color:var(--green);font-weight:600;">Save $<?= number_format($p['price_orig'] - $p['price_from'], 2) ?></div>
        </div>
        <?php endif; ?>
      </div>

      <!-- CTA buttons -->
      <div style="display:flex;gap:.75rem;flex-wrap:wrap;margin-bottom:1.75rem;">
        <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener" class="btn btn-primary btn-lg" style="flex:1;justify-content:center;min-width:160px;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
          Buy Now
        </a>
        <a href="/shop" class="btn btn-outline" style="flex:0;">Back to Shop</a>
      </div>

      <!-- Trust mini bar -->
      <div style="display:flex;gap:1rem;flex-wrap:wrap;padding:1rem;background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);">
        <div style="display:flex;align-items:center;gap:.4rem;font-size:.75rem;color:var(--text2);">
          <span style="color:var(--green);">⚡</span> Instant delivery
        </div>
        <div style="display:flex;align-items:center;gap:.4rem;font-size:.75rem;color:var(--text2);">
          <span style="color:var(--blue-hi);">🔒</span> Secure payment
        </div>
        <div style="display:flex;align-items:center;gap:.4rem;font-size:.75rem;color:var(--text2);">
          <span style="color:var(--gold);">💬</span> 24/7 support
        </div>
        <div style="display:flex;align-items:center;gap:.4rem;font-size:.75rem;color:var(--text2);">
          <span style="color:var(--green);">✅</span> Authorized seller
        </div>
      </div>
    </div>
  </div>
</div>

<div class="glow-line" style="margin:0;"></div>

<!-- ─── FEATURES + PLANS ──────────────────────────────────────────────────── -->
<div style="max-width:1280px;margin:0 auto;padding:3rem 5%;display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:start;" class="prod-features-layout">

  <!-- Features -->
  <div class="reveal">
    <div class="tag">What You Get</div>
    <h2 class="heading" style="margin-bottom:1.5rem;">FEATURES</h2>
    <div class="features-grid">
      <?php foreach ($p['features'] as $feat): ?>
      <div class="feature-item">
        <div class="feature-check">✓</div>
        <span><?= htmlspecialchars($feat) ?></span>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Pricing plans -->
  <div class="reveal" style="transition-delay:.1s">
    <div class="tag">Choose Your Plan</div>
    <h2 class="heading" style="margin-bottom:1.5rem;">PRICING</h2>
    <div class="plans-grid" style="grid-template-columns:repeat(auto-fill,minmax(160px,1fr));">
      <?php foreach ($p['plans'] as $plan): ?>
      <div class="plan-card <?= !empty($plan['popular']) ? 'popular' : '' ?>">
        <?php if (!empty($plan['popular'])): ?>
          <div class="plan-popular-badge">Most Popular</div>
        <?php endif; ?>
        <div class="plan-name"><?= htmlspecialchars($plan['name']) ?></div>
        <div class="plan-price"><sup>$</sup><?= number_format(floor($plan['price']), 0) ?><sup style="font-size:.9rem;vertical-align:super;font-family:'Outfit',sans-serif;font-weight:700;">.<?= str_pad((int)(($plan['price'] - floor($plan['price'])) * 100), 2, '0') ?></sup></div>
        <div class="plan-period"><?= $plan['name'] === 'Lifetime' ? 'one time' : 'per period' ?></div>
        <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener" class="plan-btn">Get This Plan</a>
      </div>
      <?php endforeach; ?>
    </div>
    <p style="font-size:.75rem;color:var(--text3);margin-top:1rem;line-height:1.6;">All prices in USD. License keys delivered instantly via Discord or email. Renewals are optional — cancel any time.</p>
  </div>
</div>

<style>
@media (max-width: 768px) {
  .prod-features-layout { grid-template-columns: 1fr !important; }
}
</style>

<!-- ─── MORE PRODUCTS ──────────────────────────────────────────────────────── -->
<?php
$others = array_filter($products, fn($prod) => $prod['slug'] !== $slug);
if (!empty($others)):
?>
<div class="glow-line" style="margin:0;"></div>
<section class="section">
  <div class="section-inner">
    <div class="section-header reveal">
      <div>
        <div class="tag">Keep Exploring</div>
        <h2 class="heading">MORE PRODUCTS</h2>
      </div>
      <a href="/shop" class="view-all">View all →</a>
    </div>
    <div class="products-grid">
      <?php foreach (array_values($others) as $op): ?>
      <a href="/product/<?= $op['slug'] ?>" class="prod-card reveal">
        <div class="prod-thumb">
          <?php if (!empty($op['image_url'])): ?>
            <img src="<?= htmlspecialchars($op['image_url']) ?>" alt="<?= htmlspecialchars($op['name']) ?>" loading="lazy">
          <?php else: ?>
            <div class="prod-thumb-placeholder" style="background:linear-gradient(135deg,<?= htmlspecialchars($op['game_color']) ?>20,<?= htmlspecialchars($op['game_color']) ?>08);">
              <span style="position:relative;z-index:1;"><?= $op['game_icon'] ?></span>
            </div>
          <?php endif; ?>
          <span class="prod-badge"><span class="badge <?= $op['badge_class'] ?>"><?= $op['badge'] ?></span></span>
          <?php if ($op['in_stock']): ?><div class="prod-stock-dot"></div><?php endif; ?>
        </div>
        <div class="prod-body">
          <div class="prod-game"><?= htmlspecialchars($op['game']) ?> · <?= htmlspecialchars($op['category']) ?></div>
          <div class="prod-name"><?= htmlspecialchars($op['name']) ?></div>
          <div class="prod-desc"><?= htmlspecialchars($op['tagline']) ?></div>
          <div class="prod-foot">
            <div class="prod-price-wrap">
              <span class="prod-from">From</span>
              <span class="prod-price">$<?= number_format($op['price_from'], 2) ?></span>
            </div>
            <button class="prod-buy">Buy Now</button>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
