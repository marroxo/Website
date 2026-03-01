<?php
$page_title  = 'Shop — TGModz | Premium Gaming Software';
$page_desc   = 'Browse our full catalogue of premium game enhancement software. CS2, GTA V, FiveM, HWID Spoofers and more. Instant delivery.';
$active_page = 'shop';

$products = require __DIR__ . '/data/products.php';
$all      = array_values($products);

$filter = isset($_GET['game']) ? preg_replace('/[^a-z0-9\-]/', '', strtolower($_GET['game'])) : 'all';

$filtered = $filter === 'all'
    ? $all
    : array_values(array_filter($all, fn($p) => $p['game_slug'] === $filter));

$games = [
  'all'         => 'All Games',
  'cs2'         => 'CS2',
  'gta'         => 'GTA V',
  'fivem'       => 'FiveM',
  'spoofer'     => 'HWID Spoofer',
  'arc-raiders' => 'ARC Raiders',
];

include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/nav.php';
?>

<!-- ─── SHOP HERO ──────────────────────────────────────────────────────────── -->
<div class="shop-hero">
  <div class="label">TGModz Store</div>
  <h1 style="font-family:'Bebas Neue',sans-serif;font-size:clamp(3rem,8vw,6rem);letter-spacing:.04em;line-height:.9;color:var(--text);margin-bottom:.75rem;">
    THE SHOP
  </h1>
  <p style="font-family:'DM Mono',monospace;font-size:.72rem;letter-spacing:.1em;text-transform:uppercase;color:var(--text3);">
    <?= count($all) ?> premium products &nbsp;·&nbsp; instant delivery &nbsp;·&nbsp; always verified
  </p>

  <div class="shop-filters">
    <?php foreach ($games as $slug => $label): ?>
    <a href="<?= $slug === 'all' ? '/shop' : '/shop?game=' . $slug ?>"
       class="filter-btn <?= $filter === $slug ? 'active' : '' ?>">
      <?= htmlspecialchars($label) ?>
      <span style="opacity:.5;font-size:.85em;margin-left:3px;">(<?= $slug === 'all' ? count($all) : count(array_filter($all, fn($p) => $p['game_slug'] === $slug)) ?>)</span>
    </a>
    <?php endforeach; ?>
  </div>
</div>

<div class="glow-line"></div>

<!-- ─── PRODUCTS GRID ──────────────────────────────────────────────────────── -->
<div class="shop-grid-wrap">
  <div class="shop-grid-inner">

    <?php if (empty($filtered)): ?>
    <div style="text-align:center;padding:5rem 0;color:var(--text2);">
      <div style="font-family:'Bebas Neue',sans-serif;font-size:5rem;color:var(--text4);line-height:1;margin-bottom:1rem;">404</div>
      <p style="font-family:'Barlow Condensed',sans-serif;font-size:1rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--text2);margin-bottom:.5rem;">No products found</p>
      <p style="font-size:.82rem;">Try a different filter or <a href="/shop" style="color:var(--accent);">view all products</a>.</p>
    </div>
    <?php else: ?>

    <div class="shop-count-bar" style="margin-top:2rem;">
      <p class="shop-count">
        Showing <strong><?= count($filtered) ?></strong>
        <?= count($filtered) === 1 ? 'product' : 'products' ?>
        <?php if ($filter !== 'all'): ?> in <em><?= htmlspecialchars($games[$filter] ?? $filter) ?></em><?php endif; ?>
      </p>
      <div class="shop-live">
        <span class="hero-dot" style="width:5px;height:5px;"></span>
        All products in stock
      </div>
    </div>

    <div class="shop-products-grid">
      <?php foreach ($filtered as $p): ?>
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
            <span class="prod-buy">Buy Now</span>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>

    <?php endif; ?>
  </div>
</div>

<div class="glow-line"></div>

<!-- ─── WHY TGMODZ ────────────────────────────────────────────────────────── -->
<section class="section" style="padding-top:60px;">
  <div class="section-inner">
    <div class="section-head reveal">
      <div>
        <div class="label">Why Choose Us</div>
        <h2>THE TGMODZ DIFFERENCE</h2>
      </div>
    </div>
    <div class="why-grid">
      <?php
      $whys = [
        ['icon'=>'⚡','title'=>'Instant Delivery',     'desc'=>'License keys and download links sent immediately after payment — no waiting.'],
        ['icon'=>'🔒','title'=>'Always Undetected',    'desc'=>'All products are monitored and updated around the clock to stay ahead of anti-cheat.'],
        ['icon'=>'✅','title'=>'Authorized Reseller',  'desc'=>'TGModz is an officially authorized reseller for every product in our catalogue.'],
        ['icon'=>'💬','title'=>'24/7 Support',         'desc'=>'Our Discord support team is online around the clock to help with any issues.'],
        ['icon'=>'💰','title'=>'Best Prices',          'desc'=>'Competitive pricing across all plans, with frequent sales and loyalty rewards.'],
        ['icon'=>'🔄','title'=>'Regular Updates',      'desc'=>'Free updates for the duration of your subscription — no extra charges.'],
      ];
      foreach ($whys as $w): ?>
      <div class="why-card reveal">
        <div class="why-icon"><?= $w['icon'] ?></div>
        <div class="why-title"><?= $w['title'] ?></div>
        <p class="why-desc"><?= $w['desc'] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
