<?php
/**
 * Generic category page — loaded by router.php for any game slug.
 * Expects: $game_slug (set by caller)
 */

require_once __DIR__ . '/config/db.php';

$game_slug = $game_slug ?? ltrim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');

// Load category from DB
$category = db_row("SELECT * FROM categories WHERE slug = ? AND is_active = 1", [$game_slug]);

if (!$category) {
    http_response_code(404);
    $page_title  = '404 — TGModz';
    $page_desc   = '';
    $active_page = 'home';
    require __DIR__ . '/includes/head.php';
    ?>
    <body>
    <?php require __DIR__ . '/includes/nav.php'; ?>
    <section style="padding:160px 0 80px;text-align:center">
      <div class="container">
        <div class="sh" style="font-size:3rem;margin-bottom:12px;">Category Not Found</div>
        <p style="color:var(--text2);margin-bottom:32px">We couldn't find that category. Browse all our games below.</p>
        <a href="/#categories" class="btn-primary">Browse All</a>
      </div>
    </section>
    <?php require __DIR__ . '/includes/footer.php'; ?>
    </body>
    <?php exit;
}

// Load products for this category
$products = db_rows("
    SELECT p.*,
           (SELECT MIN(COALESCE(pv.sale_price, pv.price)) FROM product_variations pv WHERE pv.product_id = p.id AND pv.is_in_stock = 1) AS min_var_price,
           (SELECT MIN(pv.price) FROM product_variations pv WHERE pv.product_id = p.id AND pv.is_in_stock = 1) AS min_var_orig
    FROM products p
    WHERE p.category_id = ? AND p.is_active = 1
    ORDER BY p.is_featured DESC, p.sort_order, p.name
", [$category['id']]);

// Other categories for the bottom strip
$other_cats = db_rows(
    "SELECT * FROM categories WHERE slug != ? AND is_active = 1 ORDER BY sort_order, id LIMIT 12",
    [$game_slug]
);

$accent      = $category['color'] ?? '#3b82f6';
$page_title  = $category['name'] . ' Software — TGModz | Authorized Gaming Software';
$page_desc   = 'Shop authorized ' . $category['name'] . ' software at TGModz. Instant delivery and 24/7 Discord support.';
$active_page = $game_slug;
$extra_css   = "
:root { --accent: {$accent}; }
.accent-btn{background:var(--accent);color:#fff;padding:0.85rem 1.9rem;border-radius:6px;font-weight:700;font-size:0.9rem;text-decoration:none;display:inline-flex;align-items:center;gap:0.5rem;transition:all 0.2s;border:none;cursor:pointer;letter-spacing:0.04em;text-transform:uppercase;font-family:'Outfit',sans-serif;box-shadow:0 0 20px {$accent}40;}
.accent-btn:hover{filter:brightness(1.1);transform:translateY(-2px);box-shadow:0 0 36px {$accent}60;}
.accent-badge{display:inline-flex;align-items:center;gap:8px;background:{$accent}18;border:1px solid {$accent}44;padding:6px 16px;border-radius:100px;font-size:0.72rem;font-weight:700;color:{$accent};text-transform:uppercase;letter-spacing:0.08em;}
";

require __DIR__ . '/includes/head.php';
?>
<body>
<?php require __DIR__ . '/includes/nav.php'; ?>

<!-- HERO -->
<section style="padding:100px 4% 60px;background:var(--bg2);border-bottom:1px solid var(--border);position:relative;overflow:hidden;">
  <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 50% 0%,<?= $accent ?>12,transparent 60%);pointer-events:none;"></div>
  <div style="max-width:1300px;margin:0 auto;position:relative;z-index:1;">
    <div style="font-size:0.82rem;color:var(--text3);display:flex;align-items:center;gap:8px;margin-bottom:1.5rem;">
      <a href="/" style="color:var(--text3);text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='var(--blue-hi)'" onmouseout="this.style.color='var(--text3)'">TGModz</a>
      <span>›</span>
      <span style="color:var(--text2);"><?= htmlspecialchars($category['name']) ?></span>
    </div>
    <div class="accent-badge" style="margin-bottom:1.25rem;">
      <span><?= $category['icon'] ?></span>
      <?= htmlspecialchars($category['name']) ?>
    </div>
    <h1 style="font-family:'Bebas Neue',sans-serif;font-size:clamp(2.5rem,5vw,4rem);letter-spacing:0.05em;line-height:1;margin-bottom:1rem;">
      Authorized <span style="color:<?= $accent ?>;"><?= htmlspecialchars($category['name']) ?></span> Software
    </h1>
    <p style="font-size:1rem;color:var(--text2);max-width:560px;line-height:1.7;font-weight:300;margin-bottom:1.75rem;">
      Browse our full selection of authorized <?= htmlspecialchars($category['name']) ?> software. Every product is developer-verified and delivered instantly to your email.
    </p>
    <div style="display:flex;gap:14px;flex-wrap:wrap;">
      <a href="#products" class="accent-btn">Browse Products ↓</a>
      <a href="/#categories" class="btn-sec">← All Categories</a>
    </div>
  </div>
</section>

<!-- TRUST BAR -->
<div class="trust-bar">
  <div class="trust-inner">
    <div class="ti"><div class="ti-icon">⚡</div><span><strong>Instant</strong> Delivery</span></div>
    <div class="ti-sep"></div>
    <div class="ti"><div class="ti-icon">✓</div><span><strong>Authorized</strong> Reseller</span></div>
    <div class="ti-sep"></div>
    <div class="ti"><div class="ti-icon">🔒</div><span><strong>Secure</strong> Checkout</span></div>
    <div class="ti-sep"></div>
    <div class="ti"><div class="ti-icon">💬</div><span><strong>24/7</strong> Discord Support</span></div>
  </div>
</div>

<!-- PRODUCTS -->
<section class="section" id="products" style="border-top:1px solid var(--border);">
  <div class="section-inner">
    <div class="section-head">
      <div>
        <div class="tag"><?= htmlspecialchars($category['name']) ?></div>
        <div class="sh">All <?= htmlspecialchars($category['name']) ?> Software</div>
        <div class="sd">Every product is authorized, instantly delivered, and backed by 24/7 Discord support.</div>
      </div>
      <?php if (count($products) > 0): ?>
        <div style="font-size:0.82rem;color:var(--text3);"><?= count($products) ?> product<?= count($products) !== 1 ? 's' : '' ?> available</div>
      <?php endif; ?>
    </div>

    <?php if (!$products): ?>
      <div style="text-align:center;padding:80px 0;background:var(--surface);border:1px solid var(--border);border-radius:16px;">
        <div style="font-size:4rem;margin-bottom:1rem;"><?= $category['icon'] ?></div>
        <div class="sh" style="font-size:1.5rem;margin-bottom:0.75rem;">Coming Soon</div>
        <p style="color:var(--text2);margin-bottom:1.5rem;">No products available in this category right now.<br>Join our Discord for updates.</p>
        <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener" class="accent-btn">Ask on Discord</a>
      </div>
    <?php else: ?>
      <div class="prods-grid">
        <?php
        $thumb_bgs = ['linear-gradient(135deg,#050d1f,#030b18)','linear-gradient(135deg,#050f0d,#030b09)','linear-gradient(135deg,#100508,#0a0306)','linear-gradient(135deg,#0d0c05,#080803)','linear-gradient(135deg,#050d18,#030a12)','linear-gradient(135deg,#100f05,#0a0a03)','linear-gradient(135deg,#050a10,#030710)','linear-gradient(135deg,#0f0510,#080309)'];
        foreach ($products as $i => $p):
          $price    = (float)($p['min_var_price'] ?? $p['sale_price'] ?? $p['price'] ?? 0);
          $orig     = (float)($p['min_var_orig']  ?? $p['price'] ?? 0);
          $in_stock = !empty($p['is_in_stock']);
          $save_pct = ($orig > 0 && $orig > $price) ? round((1 - $price/$orig)*100) : 0;
          $bg       = $thumb_bgs[$i % count($thumb_bgs)];
          $badge_l  = $p['badge_label'] ?? null;
          $badge_c  = $p['badge_class'] ?? 'badge-new';
        ?>
        <a href="<?= $in_stock ? '/product/'.urlencode($p['slug']) : '#' ?>" class="prod">
          <div class="prod-thumb" style="background:<?= $bg ?>;">
            <?php if (!empty($p['image_url'])): ?>
              <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" loading="lazy">
            <?php else: ?><?= $category['icon'] ?><?php endif; ?>
            <?php if ($badge_l): ?><div class="prod-badge <?= htmlspecialchars($badge_c) ?>"><?= htmlspecialchars($badge_l) ?></div><?php endif; ?>
            <?php if (!$in_stock): ?><div class="prod-badge" style="background:rgba(55,65,81,0.9);color:var(--text2);top:auto;bottom:8px;">OUT OF STOCK</div><?php endif; ?>
          </div>
          <div class="prod-body">
            <div class="prod-game"><?= htmlspecialchars($category['name']) ?></div>
            <div class="prod-name"><?= htmlspecialchars($p['name']) ?></div>
            <?php if (!empty($p['short_description'])): ?>
              <div class="prod-social"><?= htmlspecialchars(substr($p['short_description'], 0, 70)) ?>...</div>
            <?php endif; ?>
            <div class="prod-foot">
              <div class="prod-pricing">
                <?php if ($orig > 0 && $orig > $price): ?><div><span class="prod-orig">$<?= number_format($orig, 2) ?></span><?php if ($save_pct): ?><span class="prod-save">-<?= $save_pct ?>%</span><?php endif; ?></div><?php endif; ?>
                <div class="prod-price"><?= $price > 0 ? '$'.number_format($price,2) : '—' ?></div>
              </div>
              <?php if ($in_stock): ?>
                <button class="prod-btn" style="background:<?= $accent ?>;" onclick="event.preventDefault();window.location='/product/<?= urlencode($p['slug']) ?>'">Buy Now</button>
              <?php else: ?>
                <span class="prod-btn" style="opacity:0.4;cursor:not-allowed;">Sold Out</span>
              <?php endif; ?>
            </div>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- OTHER CATEGORIES -->
<?php if ($other_cats): ?>
<section class="section" style="background:var(--bg2);border-top:1px solid var(--border);border-bottom:1px solid var(--border);">
  <div class="section-inner">
    <div style="text-align:center;margin-bottom:2rem;">
      <div class="tag">Other Games</div>
      <div class="sh">Browse Other Categories</div>
    </div>
    <div class="cat-grid">
      <?php foreach ($other_cats as $c): ?>
      <a href="/<?= htmlspecialchars($c['slug']) ?>" class="cat-card">
        <div class="cat-icon-wrap" style="background:<?= htmlspecialchars($c['color'] ?? 'var(--blue)') ?>18;border-color:<?= htmlspecialchars($c['color'] ?? 'var(--blue)') ?>33;"><?= $c['icon'] ?></div>
        <div class="cat-name"><?= htmlspecialchars($c['name']) ?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- DISCORD CTA -->
<div class="discord-section">
  <div class="discord-card">
    <div>
      <div class="dc-tag">Community</div>
      <div class="dc-title">Need Help with <?= htmlspecialchars($category['name']) ?> Software?</div>
      <div class="dc-desc">Join our Discord community and our experts will help you pick the perfect product for your needs and budget.</div>
    </div>
    <div class="dc-right">
      <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener" class="btn-discord">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 00-4.885-1.515.074.074 0 00-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 00-5.487 0 12.64 12.64 0 00-.617-1.25.077.077 0 00-.079-.037A19.736 19.736 0 003.677 4.37a.07.07 0 00-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 00.031.057 19.9 19.9 0 005.993 3.03.078.078 0 00.084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 00-.041-.106 13.107 13.107 0 01-1.872-.892.077.077 0 01-.008-.128 10.2 10.2 0 00.372-.292.074.074 0 01.077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 01.078.01c.12.098.246.198.373.292a.077.077 0 01-.006.127 12.299 12.299 0 01-1.873.892.077.077 0 00-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 00.084.028 19.839 19.839 0 006.002-3.03.077.077 0 00.032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 00-.031-.03z"/></svg>
        Ask in Discord
      </a>
      <div class="dc-members"><strong>8,500+</strong> members already inside</div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
</body>
