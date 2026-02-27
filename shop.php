<?php
$page_title  = 'Shop — TGModz | Premium Gaming Software';
$page_desc   = 'Browse our full catalogue of premium game enhancement software. CS2, GTA V, FiveM, HWID Spoofers and more. Instant delivery.';
$active_page = 'shop';

$products = require __DIR__ . '/data/products.php';
$all      = array_values($products);

// Filter by game (passed via ?game=slug)
$filter   = isset($_GET['game']) ? preg_replace('/[^a-z0-9\-]/', '', strtolower($_GET['game'])) : 'all';

$filtered = $filter === 'all'
    ? $all
    : array_values(array_filter($all, fn($p) => $p['game_slug'] === $filter));

$games = [
  'all'          => 'All Games',
  'cs2'          => 'CS2',
  'gta'          => 'GTA V',
  'fivem'        => 'FiveM',
  'spoofer'      => 'HWID Spoofer',
  'arc-raiders'  => 'ARC Raiders',
];

include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/nav.php';
?>

<!-- ─── PAGE HERO ─────────────────────────────────────────────────────────── -->
<section class="shop-hero">
  <div class="shop-hero-bg"></div>
  <!-- Glow orbs -->
  <div class="hero-orb hero-orb-a" style="width:380px;height:380px;top:-80px;left:-60px;filter:blur(90px);animation-duration:16s;"></div>
  <div class="hero-orb hero-orb-b" style="width:300px;height:300px;top:20px;right:-40px;filter:blur(80px);animation-duration:20s;"></div>
  <div class="hero-scan"></div>

  <div style="position:relative;z-index:1;">
    <div class="tag">TGModz Store</div>
    <h1 class="heading" style="font-size:clamp(2.5rem,7vw,5rem);margin-bottom:.75rem;">THE SHOP</h1>
    <p class="subtext" style="max-width:520px;margin:0 auto 0;">
      <?= count($all) ?> premium products · instant delivery · always verified
    </p>

    <!-- Filters -->
    <div class="shop-filters" style="margin-top:1.75rem;">
      <?php foreach ($games as $slug => $label): ?>
      <a href="<?= $slug === 'all' ? '/shop' : '/shop?game='.$slug ?>"
         class="filter-btn <?= $filter === $slug ? 'active' : '' ?>">
        <?= htmlspecialchars($label) ?>
        <?php if ($slug !== 'all'): ?>
          <span style="opacity:.6;font-size:.7em;margin-left:3px;">(<?= count(array_filter($all, fn($p) => $p['game_slug'] === $slug)) ?>)</span>
        <?php else: ?>
          <span style="opacity:.6;font-size:.7em;margin-left:3px;">(<?= count($all) ?>)</span>
        <?php endif; ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<div class="glow-line"></div>

<!-- ─── PRODUCTS GRID ─────────────────────────────────────────────────────── -->
<div class="shop-grid-wrap section-glow">
  <div class="shop-grid-inner">

    <?php if (empty($filtered)): ?>
    <div style="text-align:center;padding:5rem 0;color:var(--text2);">
      <div style="font-size:3rem;margin-bottom:1rem;">🔍</div>
      <h3 style="font-size:1.2rem;margin-bottom:.5rem;color:var(--text);">No products found</h3>
      <p style="font-size:.9rem;">Try a different filter or <a href="/shop" style="color:var(--blue-hi);">view all products</a>.</p>
    </div>
    <?php else: ?>

    <!-- Sort / count bar -->
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:.75rem;">
      <p style="font-size:.8rem;color:var(--text2);">
        Showing <strong style="color:var(--text);"><?= count($filtered) ?></strong>
        <?= count($filtered) === 1 ? 'product' : 'products' ?>
        <?php if ($filter !== 'all'): ?> in <strong style="color:var(--blue-hi);"><?= htmlspecialchars($games[$filter] ?? $filter) ?></strong><?php endif; ?>
      </p>
      <div style="display:flex;align-items:center;gap:.5rem;font-size:.78rem;color:var(--text3);">
        <span class="hero-dot" style="width:6px;height:6px;"></span>
        All products in stock
      </div>
    </div>

    <div class="shop-products-grid">
      <?php foreach ($filtered as $p):
        $discount = ($p['price_orig'] > $p['price_from'])
          ? round((($p['price_orig'] - $p['price_from']) / $p['price_orig']) * 100)
          : 0;
        $rating = $p['rating'] ?? 4.8;
        $review_count = $p['review_count'] ?? 0;
        $stars_full = floor($rating);
        $stars_half = ($rating - $stars_full) >= 0.5 ? 1 : 0;
        $star_str = str_repeat('★', $stars_full) . ($stars_half ? '½' : '') . str_repeat('☆', 5 - $stars_full - $stars_half);
      ?>
      <a href="/product/<?= $p['slug'] ?>" class="prod-card reveal">
        <!-- Game color accent bar -->
        <div class="prod-accent" style="background:linear-gradient(90deg,<?= htmlspecialchars($p['game_color']) ?>,<?= htmlspecialchars($p['game_color']) ?>40)"></div>

        <div class="prod-thumb">
          <?php if (!empty($p['image_url'])): ?>
            <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" loading="lazy">
          <?php else: ?>
            <div class="prod-thumb-placeholder" style="background:linear-gradient(135deg,<?= htmlspecialchars($p['game_color']) ?>22,<?= htmlspecialchars($p['game_color']) ?>0a);">
              <span style="position:relative;z-index:1;"><?= $p['game_icon'] ?></span>
            </div>
          <?php endif; ?>
          <div class="prod-thumb-overlay"></div>
          <span class="prod-badge"><span class="badge <?= $p['badge_class'] ?>"><?= $p['badge'] ?></span></span>
          <?php if ($p['in_stock']): ?><div class="prod-stock-dot"></div><?php endif; ?>
          <?php if ($discount > 0): ?><span class="prod-discount">-<?= $discount ?>%</span><?php endif; ?>
        </div>

        <div class="prod-body">
          <!-- Game pill + category -->
          <div class="prod-meta">
            <span class="prod-game-pill" style="background:<?= htmlspecialchars($p['game_color']) ?>18;border-color:<?= htmlspecialchars($p['game_color']) ?>38;color:<?= htmlspecialchars($p['game_color']) ?>">
              <?= $p['game_icon'] ?> <?= htmlspecialchars($p['game']) ?>
            </span>
            <span class="prod-category-label"><?= htmlspecialchars($p['category']) ?></span>
          </div>

          <div class="prod-name"><?= htmlspecialchars($p['name']) ?></div>

          <!-- Star rating -->
          <div class="prod-rating">
            <span class="prod-stars"><?= str_repeat('★', $stars_full) ?><?= $stars_half ? '★' : '' ?><?= str_repeat('☆', max(0, 5 - $stars_full - $stars_half)) ?></span>
            <span class="prod-rating-num"><?= number_format($rating, 1) ?></span>
            <?php if ($review_count > 0): ?><span class="prod-rating-count">(<?= $review_count ?>)</span><?php endif; ?>
          </div>

          <!-- Features preview -->
          <div class="prod-feats">
            <?php foreach (array_slice($p['features'], 0, 3) as $feat): ?>
            <span class="prod-feat-tag"><?= htmlspecialchars($feat) ?></span>
            <?php endforeach; ?>
            <?php if (count($p['features']) > 3): ?>
            <span class="prod-feat-more">+<?= count($p['features']) - 3 ?> more</span>
            <?php endif; ?>
          </div>

          <div class="prod-foot">
            <div class="prod-price-wrap">
              <span class="prod-from">From</span>
              <span class="prod-price">$<?= number_format($p['price_from'], 2) ?></span>
              <?php if ($p['price_orig'] > $p['price_from']): ?>
              <span class="prod-orig">$<?= number_format($p['price_orig'], 2) ?></span>
              <?php endif; ?>
            </div>
            <div class="prod-sold-today">
              <span class="prod-sold-dot"></span>
              <?= $p['sold_today'] ?> sold today
            </div>
          </div>

          <button class="prod-buy">View Plans &rarr;</button>
        </div>
      </a>
      <?php endforeach; ?>
    </div>

    <?php endif; ?>
  </div>
</div>

<!-- ─── WHY TGMODZ ────────────────────────────────────────────────────────── -->
<section class="section" style="padding-top:20px;">
  <div class="section-inner">
    <div class="section-header reveal" style="margin-bottom:2rem;">
      <div>
        <div class="tag">Why Choose Us</div>
        <h2 class="heading">THE TGMODZ DIFFERENCE</h2>
      </div>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:2px;background:var(--border);border-radius:var(--radius-lg);overflow:hidden;">
      <?php
      $whys = [
        ['icon'=>'⚡','title'=>'Instant Delivery','desc'=>'License keys and download links sent immediately after payment — no waiting.'],
        ['icon'=>'🔒','title'=>'Always Undetected','desc'=>'All products are monitored and updated around the clock to stay ahead of anti-cheat.'],
        ['icon'=>'✅','title'=>'Authorized Reseller','desc'=>'TGModz is an officially authorized reseller for every product in our catalogue.'],
        ['icon'=>'💬','title'=>'24/7 Support','desc'=>'Our Discord support team is online around the clock to help with any issues.'],
        ['icon'=>'💰','title'=>'Best Prices','desc'=>'Competitive pricing across all plans, with frequent sales and loyalty rewards.'],
        ['icon'=>'🔄','title'=>'Regular Updates','desc'=>'Free updates for the duration of your subscription — no extra charges.'],
      ];
      foreach ($whys as $w): ?>
      <div class="step reveal" style="background:var(--surface);">
        <div class="step-icon"><?= $w['icon'] ?></div>
        <div class="step-title"><?= $w['title'] ?></div>
        <p class="step-desc"><?= $w['desc'] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
