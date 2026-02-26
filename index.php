<?php
$page_title  = 'TGModz — Premium Gaming Software Store | Est. 2021';
$page_desc   = 'TGModz — authorized reseller of premium game enhancement software. Trusted by 100,000+ gamers since 2021. Instant delivery, 24/7 support, verified products.';
$active_page = 'home';

// ── Load data from DB ─────────────────────────────────────────────────────────
$use_db = true;
try {
    require_once __DIR__ . '/config/db.php';
    $categories     = db_rows("SELECT * FROM categories WHERE is_active=1 ORDER BY sort_order,id");
    $featured_prods = db_rows("
        SELECT p.*, c.icon AS cat_icon, c.name AS cat_name, c.slug AS cat_slug,
               (SELECT MIN(COALESCE(pv.sale_price, pv.price)) FROM product_variations pv WHERE pv.product_id = p.id AND pv.is_in_stock = 1) AS min_var_price,
               (SELECT MIN(pv.price) FROM product_variations pv WHERE pv.product_id = p.id) AS min_var_orig
        FROM products p
        LEFT JOIN categories c ON c.id = p.category_id
        WHERE p.is_featured = 1 AND p.is_active = 1
        ORDER BY p.sort_order, p.id LIMIT 8
    ");
} catch (Throwable $e) {
    $use_db = false;
    $categories = $featured_prods = [];
}

// Fallback static data
if (!$use_db || !$featured_prods) {
    $featured_prods = [
        ['id'=>0,'name'=>'Midnight CS2 Enhancement','slug'=>'midnight-cs2-mod-menu','cat_name'=>'Counter-Strike 2','cat_icon'=>'🎯','badge_label'=>'HOT','badge_class'=>'badge-hot','min_var_price'=>9.63,'min_var_orig'=>15.00,'is_in_stock'=>1,'sold_count'=>'47 sold today'],
        ['id'=>0,'name'=>'Fortitude GTA V Software','slug'=>'fortitude-gta-5','cat_name'=>'GTA V','cat_icon'=>'🏎️','badge_label'=>'POPULAR','badge_class'=>'badge-pop','min_var_price'=>19.99,'min_var_orig'=>32.00,'is_in_stock'=>1,'sold_count'=>'31 sold today'],
        ['id'=>0,'name'=>'Neverlose CS2 Software','slug'=>'neverlose-cs2','cat_name'=>'Counter-Strike 2','cat_icon'=>'🎯','badge_label'=>'HOT','badge_class'=>'badge-hot','min_var_price'=>18.50,'min_var_orig'=>28.00,'is_in_stock'=>1,'sold_count'=>'12 sold today'],
        ['id'=>0,'name'=>'Susano FiveM Enhancement','slug'=>'susano-fivem','cat_name'=>'FiveM','cat_icon'=>'🌐','badge_label'=>'NEW','badge_class'=>'badge-new','min_var_price'=>14.38,'min_var_orig'=>22.00,'is_in_stock'=>1,'sold_count'=>'22 sold today'],
        ['id'=>0,'name'=>"Kiddion's Mod Menu",'slug'=>'kiddions-mod-menu','cat_name'=>'GTA V','cat_icon'=>'🏎️','badge_label'=>'POPULAR','badge_class'=>'badge-pop','min_var_price'=>7.99,'min_var_orig'=>13.00,'is_in_stock'=>1,'sold_count'=>'38 sold today'],
        ['id'=>0,'name'=>'redEngine LUA Executor','slug'=>'redengine-fivem-lua-executor','cat_name'=>'FiveM','cat_icon'=>'🔴','badge_label'=>'HOT','badge_class'=>'badge-hot','min_var_price'=>11.93,'min_var_orig'=>18.00,'is_in_stock'=>1,'sold_count'=>'9 sold today'],
    ];
}
if (!$use_db || !$categories) {
    $categories = [
        ['slug'=>'cs2',    'name'=>'CS2',          'icon'=>'🎯','color'=>'#3b82f6'],
        ['slug'=>'gta',    'name'=>'GTA V',         'icon'=>'🏎️','color'=>'#f97316'],
        ['slug'=>'fivem',  'name'=>'FiveM',         'icon'=>'🌐','color'=>'#06b6d4'],
        ['slug'=>'r6',     'name'=>'R6 Siege',      'icon'=>'🔫','color'=>'#22c55e'],
        ['slug'=>'rdr2',   'name'=>'RDR2',          'icon'=>'🤠','color'=>'#a855f7'],
        ['slug'=>'accounts','name'=>'Game Accounts','icon'=>'🎮','color'=>'#6366f1'],
        ['slug'=>'spoofer','name'=>'HWID Spoofer',  'icon'=>'🛡️','color'=>'#ef4444'],
        ['slug'=>'fortnite','name'=>'Fortnite',     'icon'=>'🏆','color'=>'#9333ea'],
        ['slug'=>'tarkov', 'name'=>'Tarkov',        'icon'=>'🎯','color'=>'#65a30d'],
        ['slug'=>'cod',    'name'=>'Call of Duty',  'icon'=>'💥','color'=>'#b45309'],
        ['slug'=>'marvel-rivals','name'=>'Marvel Rivals','icon'=>'⚡','color'=>'#dc2626'],
        ['slug'=>'arc-raiders','name'=>'ARC Raiders','icon'=>'🤖','color'=>'#0891b2'],
    ];
}

require __DIR__ . '/includes/head.php';
?>
<body>
<?php require __DIR__ . '/includes/nav.php'; ?>

<style>
@keyframes beam{0%,100%{opacity:0;transform:scaleY(0.3);}50%{opacity:0.35;transform:scaleY(1);}}
@keyframes slideIn{from{opacity:0;transform:translateX(-20px);}to{opacity:1;transform:translateX(0);}}
@keyframes fadeUp{from{opacity:0;transform:translateY(30px);}to{opacity:1;transform:translateY(0);}}
.hero-showcase-card{background:var(--surface);border:1px solid var(--border2);border-radius:16px;padding:1.5rem;position:relative;overflow:hidden;}
.hero-showcase-card::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,var(--blue),transparent);opacity:0.7;}
.showcase-row{display:flex;align-items:center;gap:1rem;padding:0.85rem 1rem;background:var(--surface2);border:1px solid var(--border);border-radius:10px;text-decoration:none;color:inherit;transition:all 0.2s;}
.showcase-row:hover{border-color:rgba(59,130,246,0.25);background:rgba(59,130,246,0.05);}
@media(max-width:900px){.hero-right-col{display:none!important;} .hero-grid{grid-template-columns:1fr!important;}}
</style>

<!-- ── HERO ── -->
<section style="position:relative;min-height:100vh;display:flex;align-items:center;padding:80px 4% 60px;overflow:hidden;">
  <div style="position:absolute;inset:0;background:var(--bg);">
    <div style="position:absolute;width:1px;height:300px;left:15%;top:10%;background:linear-gradient(to bottom,transparent,var(--blue),transparent);animation:beam 4s ease-in-out infinite;opacity:0.35;"></div>
    <div style="position:absolute;width:1px;height:200px;left:40%;top:25%;background:linear-gradient(to bottom,transparent,var(--blue),transparent);animation:beam 4s ease-in-out 1.5s infinite;opacity:0.35;"></div>
    <div style="position:absolute;width:1px;height:260px;left:68%;top:8%;background:linear-gradient(to bottom,transparent,var(--blue),transparent);animation:beam 4s ease-in-out 0.8s infinite;opacity:0.35;"></div>
    <div style="position:absolute;width:1px;height:180px;left:88%;top:35%;background:linear-gradient(to bottom,transparent,var(--blue),transparent);animation:beam 4s ease-in-out 2.2s infinite;opacity:0.35;"></div>
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 70% 60% at 60% 40%,rgba(59,130,246,0.09) 0%,transparent 60%),radial-gradient(ellipse 50% 50% at 15% 65%,rgba(29,78,216,0.06) 0%,transparent 50%);"></div>
    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(59,130,246,0.035) 1px,transparent 1px),linear-gradient(90deg,rgba(59,130,246,0.035) 1px,transparent 1px);background-size:50px 50px;mask-image:radial-gradient(ellipse 90% 90% at 50% 50%,black,transparent);-webkit-mask-image:radial-gradient(ellipse 90% 90% at 50% 50%,black,transparent);"></div>
  </div>

  <div class="hero-grid" style="position:relative;z-index:1;width:100%;display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;max-width:1300px;margin:0 auto;">
    <!-- LEFT -->
    <div>
      <div style="display:inline-flex;align-items:center;gap:0.5rem;background:var(--surface);border:1px solid var(--border2);border-radius:4px;padding:0.3rem 0.75rem;font-size:0.72rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:var(--text2);margin-bottom:1.5rem;animation:slideIn 0.7s ease both;">
        Est. <span style="color:var(--blue);margin-left:4px;">2021</span>&nbsp;&nbsp;·&nbsp;&nbsp;Official Authorized Reseller
      </div>
      <h1 style="font-family:'Bebas Neue',sans-serif;font-size:clamp(3.5rem,7vw,6rem);line-height:0.95;letter-spacing:0.04em;margin-bottom:1.5rem;animation:slideIn 0.7s 0.1s ease both;">
        Premium<br>
        <span style="-webkit-text-stroke:2px var(--blue);color:transparent;letter-spacing:0.06em;display:block;">Gaming</span>
        <span style="color:var(--blue-hi);font-size:0.6em;letter-spacing:0.12em;display:block;">Software Store</span>
      </h1>
      <p style="font-size:1rem;color:var(--text2);line-height:1.75;max-width:460px;margin-bottom:2rem;font-weight:300;animation:slideIn 0.7s 0.2s ease both;">
        Authorized reseller of top-tier game enhancement software for GTA V, FiveM, CS2, RDR2 and more. Instant digital delivery — no waiting, no hassle.
      </p>
      <div style="display:flex;gap:0.875rem;flex-wrap:wrap;margin-bottom:0.75rem;animation:slideIn 0.7s 0.3s ease both;">
        <a href="#products" class="btn-main">Shop Now — Instant Delivery →</a>
        <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener" class="btn-sec">Join Discord</a>
      </div>
      <div style="font-size:0.76rem;color:var(--text3);margin-bottom:2rem;animation:slideIn 0.7s 0.35s ease both;">
        <span style="color:var(--green);">✓</span> Buyer Protection &nbsp;·&nbsp; <span style="color:var(--green);">✓</span> Key within seconds &nbsp;·&nbsp; <span style="color:var(--green);">✓</span> SSL encrypted
      </div>
      <div style="display:flex;gap:2.25rem;animation:slideIn 0.7s 0.4s ease both;">
        <div><div style="font-family:'Bebas Neue',sans-serif;font-size:2rem;letter-spacing:0.04em;line-height:1;">100<span style="color:var(--blue-hi);">K+</span></div><div style="font-size:0.72rem;color:var(--text3);text-transform:uppercase;letter-spacing:0.08em;margin-top:0.2rem;">Orders Delivered</div></div>
        <div><div style="font-family:'Bebas Neue',sans-serif;font-size:2rem;letter-spacing:0.04em;line-height:1;">4.8<span style="color:var(--blue-hi);">★</span></div><div style="font-size:0.72rem;color:var(--text3);text-transform:uppercase;letter-spacing:0.08em;margin-top:0.2rem;">Trustpilot</div></div>
        <div><div style="font-family:'Bebas Neue',sans-serif;font-size:2rem;letter-spacing:0.04em;line-height:1;">8.5<span style="color:var(--blue-hi);">K+</span></div><div style="font-size:0.72rem;color:var(--text3);text-transform:uppercase;letter-spacing:0.08em;margin-top:0.2rem;">Discord Members</div></div>
      </div>
    </div>

    <!-- RIGHT — showcase card -->
    <div class="hero-right-col" style="animation:fadeUp 0.9s 0.3s ease both;">
      <div class="hero-showcase-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
          <div style="font-size:0.72rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:var(--text2);">🔥 Popular Right Now</div>
          <div style="display:flex;align-items:center;gap:0.4rem;font-size:0.7rem;color:var(--green);font-weight:600;letter-spacing:0.05em;">
            <span style="width:6px;height:6px;border-radius:50%;background:var(--green);box-shadow:0 0 8px var(--green);animation:pulse 2s infinite;display:inline-block;"></span>LIVE
          </div>
        </div>
        <style>@keyframes pulse{0%,100%{opacity:1;}50%{opacity:0.3;}}</style>
        <div style="display:flex;flex-direction:column;gap:8px;">
          <?php foreach (array_slice($featured_prods, 0, 4) as $sp):
            $price = (float)($sp['min_var_price'] ?? $sp['sale_price'] ?? $sp['price'] ?? 0);
            $icon  = $sp['cat_icon'] ?? '🎮';
          ?>
          <a href="/product/<?= urlencode($sp['slug']) ?>" class="showcase-row">
            <div style="width:42px;height:42px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0;background:var(--surface);"><?= $icon ?></div>
            <div style="flex:1;min-width:0;">
              <div style="font-weight:600;font-size:0.88rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?= htmlspecialchars($sp['name']) ?></div>
              <div style="font-size:0.73rem;color:var(--text2);margin-top:0.15rem;"><?= htmlspecialchars($sp['cat_name'] ?? '') ?></div>
            </div>
            <div style="text-align:right;flex-shrink:0;">
              <div style="font-family:'Bebas Neue',sans-serif;font-size:1.1rem;letter-spacing:0.04em;color:var(--blue-hi);">$<?= number_format($price, 2) ?></div>
              <div style="display:inline-block;padding:0.1rem 0.4rem;background:var(--green-dim);color:var(--green);font-size:0.63rem;font-weight:600;border-radius:3px;letter-spacing:0.06em;margin-top:0.15rem;">INSTANT</div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
        <div style="margin-top:1.25rem;padding-top:1.25rem;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;">
          <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.75rem;color:var(--text2);">
            <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            SSL Secured · Instant Delivery
          </div>
          <a href="#products" style="font-size:0.78rem;color:var(--blue-hi);font-weight:600;text-decoration:none;">View all →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TRUST BAR -->
<div class="trust-bar">
  <div class="trust-inner">
    <div class="ti"><div class="ti-icon">🔒</div><span><strong>SSL Secured</strong> Checkout</span></div>
    <div class="ti-sep"></div>
    <div class="ti"><div class="ti-icon">⭐</div><span><strong>4.8/5</strong> on Trustpilot</span></div>
    <div class="ti-sep"></div>
    <div class="ti"><div class="ti-icon">📦</div><span><strong>100,000+</strong> Orders Delivered</span></div>
    <div class="ti-sep"></div>
    <div class="ti"><div class="ti-icon">⚡</div><span><strong>Instant</strong> Digital Delivery</span></div>
    <div class="ti-sep"></div>
    <div class="ti"><div class="ti-icon">🛡️</div><span><strong>Buyer</strong> Protection</span></div>
    <div class="ti-sep"></div>
    <div class="ti"><div class="ti-icon">🏅</div><span><strong>Official</strong> Authorized Reseller</span></div>
  </div>
</div>

<!-- PAYMENT MARQUEE -->
<div class="payment-strip">
  <div class="payment-inner">
    <div class="payment-title">Secure Payments</div>
    <div class="payment-marquee">
      <div class="payment-track">
        <?php $pms = ['VISA','MASTERCARD','AMEX','APPLE PAY','GOOGLE PAY','CRYPTO','SSL ENCRYPTED','3D SECURE','PCI COMPLIANT','PAYPAL','CASHAPP','LITECOIN'];
        foreach ([$pms,$pms] as $row) foreach ($row as $pm) echo '<div class="pm">'.htmlspecialchars($pm).'</div>'; ?>
      </div>
    </div>
  </div>
</div>

<!-- CATEGORIES -->
<section class="section" id="categories" style="border-top:1px solid var(--border);">
  <div class="section-inner">
    <div class="section-head">
      <div>
        <div class="tag">Browse by Game</div>
        <div class="sh">All Categories</div>
        <div class="sd">50+ products across 15+ games. Authorized, instant, and developer-verified.</div>
      </div>
    </div>
    <div class="cat-grid">
      <?php foreach ($categories as $c): ?>
      <a href="/<?= htmlspecialchars($c['slug']) ?>" class="cat-card">
        <div class="cat-icon-wrap" style="background:<?= htmlspecialchars($c['color'] ?? 'var(--blue)') ?>18;border-color:<?= htmlspecialchars($c['color'] ?? 'var(--blue)') ?>33;"><?= $c['icon'] ?></div>
        <div class="cat-name"><?= htmlspecialchars($c['name']) ?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="section how-bg">
  <div class="section-inner">
    <div style="text-align:center;margin-bottom:2.5rem;">
      <div class="tag">Simple Process</div>
      <div class="sh">How It Works</div>
      <div class="sd" style="max-width:520px;margin:0 auto;">Get your software up and running in under 2 minutes — from browse to in-game.</div>
    </div>
    <div class="steps-grid">
      <div class="step"><div class="step-num">01</div><div class="step-icon">🛒</div><div class="step-title">Browse & Select</div><div class="step-desc">Choose the product for your game. Every listing shows the price, platform, and license type upfront — no hidden details.</div></div>
      <div class="step"><div class="step-num">02</div><div class="step-icon">💳</div><div class="step-title">Pay via Discord</div><div class="step-desc">After adding to cart, you'll receive a Discord invite. Our team processes payment securely — card, crypto, PayPal or CashApp.</div></div>
      <div class="step"><div class="step-num">03</div><div class="step-icon">⚡</div><div class="step-title">Get Your Key Instantly</div><div class="step-desc">Your license key and full setup guide land the moment payment clears — automatically, zero waiting required.</div></div>
    </div>
  </div>
</section>

<!-- BEST SELLERS -->
<section class="section" id="products" style="border-top:1px solid var(--border);">
  <div class="section-inner">
    <div class="section-head">
      <div>
        <div class="tag">Most Popular</div>
        <div class="sh">Best Sellers</div>
        <div class="sd">Our most purchased products — tried, tested and loved by thousands.</div>
      </div>
      <a href="#categories" class="btn-sec" style="padding:0.6rem 1.25rem;font-size:0.82rem;border-radius:6px;">View All →</a>
    </div>
    <div class="prods-grid">
      <?php
      $thumb_bgs = ['linear-gradient(135deg,#050d1f,#030b18)','linear-gradient(135deg,#050f0d,#030b09)','linear-gradient(135deg,#100508,#0a0306)','linear-gradient(135deg,#0d0c05,#080803)','linear-gradient(135deg,#050d18,#030a12)','linear-gradient(135deg,#100f05,#0a0a03)','linear-gradient(135deg,#050a10,#030710)','linear-gradient(135deg,#0f0510,#080309)'];
      foreach ($featured_prods as $i => $p):
        $price    = (float)($p['min_var_price'] ?? $p['sale_price'] ?? $p['price'] ?? 0);
        $orig     = (float)($p['min_var_orig']  ?? $p['price'] ?? 0);
        $in_stock = !empty($p['is_in_stock']);
        $save_pct = ($orig > 0 && $orig > $price) ? round((1 - $price/$orig)*100) : 0;
        $icon     = $p['cat_icon'] ?? '🎮';
        $bg       = $thumb_bgs[$i % count($thumb_bgs)];
        $badge_l  = $p['badge_label'] ?? null;
        $badge_c  = $p['badge_class'] ?? 'badge-new';
        $sold     = $p['sold_count'] ?? null;
      ?>
      <a href="<?= $in_stock ? '/product/'.urlencode($p['slug']) : '#' ?>" class="prod">
        <div class="prod-thumb" style="background:<?= $bg ?>;">
          <?php if (!empty($p['image_url'])): ?>
            <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" loading="lazy">
          <?php else: ?><?= $icon ?><?php endif; ?>
          <?php if ($badge_l): ?><div class="prod-badge <?= htmlspecialchars($badge_c) ?>"><?= htmlspecialchars($badge_l) ?></div><?php endif; ?>
        </div>
        <div class="prod-body">
          <div class="prod-game"><?= htmlspecialchars($p['cat_name'] ?? '') ?></div>
          <div class="prod-name"><?= htmlspecialchars($p['name']) ?></div>
          <?php if ($sold): ?><div class="prod-social"><em>🔥 <?= htmlspecialchars($sold) ?></em></div><?php endif; ?>
          <div class="prod-foot">
            <div class="prod-pricing">
              <?php if ($orig > 0 && $orig > $price): ?><div><span class="prod-orig">$<?= number_format($orig, 2) ?></span><?php if ($save_pct): ?><span class="prod-save">-<?= $save_pct ?>%</span><?php endif; ?></div><?php endif; ?>
              <div class="prod-price"><?= $price > 0 ? '$'.number_format($price,2) : '—' ?></div>
            </div>
            <?php if ($in_stock): ?>
              <button class="prod-btn" onclick="event.preventDefault();window.location='/product/<?= urlencode($p['slug']) ?>'">Buy Now</button>
            <?php else: ?>
              <span class="prod-btn" style="opacity:0.45;cursor:not-allowed;">Sold Out</span>
            <?php endif; ?>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- WHY US -->
<section class="section why-bg" style="border-top:1px solid var(--border);border-bottom:1px solid var(--border);">
  <div class="section-inner">
    <div class="section-head">
      <div>
        <div class="tag">Why TGModz</div>
        <div class="sh">Trusted Since 2021</div>
        <div class="sd">Over 4 years serving the gaming community with verified, officially licensed digital software.</div>
      </div>
    </div>
    <div class="why-grid">
      <div class="why-card"><div class="why-num">01</div><div class="why-icon">⚡</div><div class="why-title">Instant License Delivery</div><div class="why-desc">License keys and setup instructions hit your inbox the moment payment clears. Automated, reliable, zero waiting time.</div></div>
      <div class="why-card"><div class="why-num">02</div><div class="why-icon">🏅</div><div class="why-title">Official Authorized Reseller</div><div class="why-desc">Every product is sold with full developer authorization — verifiable directly in each product's official Discord server.</div></div>
      <div class="why-card"><div class="why-num">03</div><div class="why-icon">🔒</div><div class="why-title">Secure Payment Processing</div><div class="why-desc">All transactions processed securely. PCI-compliant checkout with card, crypto, PayPal or CashApp available.</div></div>
      <div class="why-card"><div class="why-num">04</div><div class="why-icon">💰</div><div class="why-title">Best Market Prices</div><div class="why-desc">We negotiate directly with developers to bring you the sharpest prices available anywhere. Maximum value, guaranteed.</div></div>
      <div class="why-card"><div class="why-num">05</div><div class="why-icon">💬</div><div class="why-title">24/7 Expert Support</div><div class="why-desc">Our team is always live on Discord. Pre-sale questions or post-purchase help — someone's there around the clock.</div></div>
      <div class="why-card"><div class="why-num">06</div><div class="why-icon">🛡️</div><div class="why-title">Buyer Protection Guarantee</div><div class="why-desc">If your key doesn't work, we replace it or refund you — no questions asked. Our fair policy is always honoured.</div></div>
    </div>
  </div>
</section>

<!-- STATS -->
<div class="stats-section">
  <div class="stats-grid" style="max-width:1300px;margin:0 auto;">
    <div class="stat-box"><div class="stat-n">100<em>K+</em></div><div class="stat-l">Orders Delivered</div><div class="stat-sub">Since 2021</div></div>
    <div class="stat-box"><div class="stat-n">50<em>+</em></div><div class="stat-l">Products</div><div class="stat-sub">Across 15+ games</div></div>
    <div class="stat-box"><div class="stat-n">4.8<em>★</em></div><div class="stat-l">Trustpilot Rating</div><div class="stat-sub">Hundreds of reviews</div></div>
    <div class="stat-box"><div class="stat-n">8.5<em>K+</em></div><div class="stat-l">Discord Members</div><div class="stat-sub">Live community</div></div>
  </div>
</div>

<!-- TRUSTPILOT -->
<section class="section" style="border-top:1px solid var(--border);">
  <div class="section-inner">
    <div class="tp-banner">
      <div class="tp-left">
        <div>
          <div class="tp-logo-big"><em>★</em> Trustpilot</div>
          <div class="tp-score-big">4.8</div>
          <div class="tp-score-label">out of 5.0 · Hundreds of verified reviews</div>
        </div>
        <div class="tp-divider"></div>
        <div class="tp-copy">
          <strong>Real reviews from real customers.</strong>
          <span>Every review on Trustpilot is independently verified. We don't cherry-pick — you can read them all.</span>
        </div>
      </div>
      <a href="https://trustpilot.com" target="_blank" rel="noopener" class="btn-tp">Read All Reviews →</a>
    </div>
  </div>
</section>

<!-- REVIEWS -->
<section class="section" style="background:var(--bg2);border-top:1px solid var(--border);border-bottom:1px solid var(--border);">
  <div class="section-inner">
    <div style="text-align:center;margin-bottom:2rem;">
      <div class="tag">Customer Reviews</div>
      <div class="sh">What People Say</div>
    </div>
    <div class="reviews-grid">
      <div class="review"><div class="review-stars">★★★★★</div><div class="review-text">"Bought Midnight CS2 on a Thursday night, key was in my inbox before I even closed the tab. Activated first try, no issues. These guys are legit."</div><div class="review-author"><div class="review-ava">🎮</div><div><div class="review-name">xKrakenGG</div><div class="review-meta">Counter-Strike 2 · Jan 2026</div><div class="review-verified">✓ Verified Purchase</div></div></div></div>
      <div class="review"><div class="review-stars">★★★★★</div><div class="review-text">"Third time buying from TGModz. Prices are the best I've found anywhere and the keys always work. Discord support sorted my setup question in about 5 minutes."</div><div class="review-author"><div class="review-ava">🏙️</div><div><div class="review-name">FiveMDevRL</div><div class="review-meta">FiveM Tool · Dec 2025</div><div class="review-verified">✓ Verified Purchase</div></div></div></div>
      <div class="review"><div class="review-stars">★★★★★</div><div class="review-text">"Was skeptical at first but the Trustpilot reviews convinced me. Paid with crypto, got the key in under a minute. Will be back for more products."</div><div class="review-author"><div class="review-ava">🛡️</div><div><div class="review-name">ShadowModder</div><div class="review-meta">GTA V Tool · Nov 2025</div><div class="review-verified">✓ Verified Purchase</div></div></div></div>
    </div>
  </div>
</section>

<!-- RESELLER STRIP -->
<div class="reseller-strip">
  <div class="reseller-inner">
    <div class="reseller-text">
      <div class="reseller-icon">🏅</div>
      <div class="reseller-copy">
        <strong>Official Authorized Digital Software Reseller</strong>
        <span>TGModz sells all products with full developer authorization — verifiable in each product's official Discord server</span>
      </div>
    </div>
    <div class="reseller-badges">
      <div class="rbadge"><em>✓</em> Developer Verified</div>
      <div class="rbadge"><em>✓</em> SSL Encrypted</div>
      <div class="rbadge"><em>✓</em> Est. 2021</div>
      <div class="rbadge"><em>✓</em> 100K+ Orders</div>
    </div>
  </div>
</div>

<!-- FAQ -->
<section class="section faq-bg" id="faq">
  <div class="section-inner">
    <div style="text-align:center;margin-bottom:2.5rem;">
      <div class="tag">FAQ</div>
      <div class="sh">Common Questions</div>
    </div>
    <div class="faq-list">
      <div class="faq-item open"><button class="faq-q" onclick="toggleFaq(this)">What happens after I place an order?<div class="faq-icon">−</div></button><div class="faq-a">After placing your order, you'll receive a Discord invite link. Our team will process your payment securely there and immediately deliver your license key and full setup guide.</div></div>
      <div class="faq-item"><button class="faq-q" onclick="toggleFaq(this)">What payment methods do you accept?<div class="faq-icon">+</div></button><div class="faq-a">We accept Visa, Mastercard, Amex, Apple Pay, Google Pay, and cryptocurrency. PayPal and CashApp are available through our Discord. All transactions are SSL encrypted and PCI compliant.</div></div>
      <div class="faq-item"><button class="faq-q" onclick="toggleFaq(this)">How do I know TGModz is legitimate?<div class="faq-icon">+</div></button><div class="faq-a">We have been operating since 2021 and have processed over 100,000 successful orders. We are an officially authorized reseller — verifiable in each product's developer Discord. We maintain a 4.8-star rating on Trustpilot.</div></div>
      <div class="faq-item"><button class="faq-q" onclick="toggleFaq(this)">Are the products lifetime or subscription-based?<div class="faq-icon">+</div></button><div class="faq-a">Both options are available depending on the product. Each product page clearly states whether it is lifetime or subscription-based with the billing cycle and price shown.</div></div>
      <div class="faq-item"><button class="faq-q" onclick="toggleFaq(this)">Can I get a refund?<div class="faq-icon">+</div></button><div class="faq-a">Non-delivered keys, wrong products, and non-functional software are all covered by our Buyer Protection. Contact our Discord support team — we resolve issues fast, usually within minutes.</div></div>
      <div class="faq-item"><button class="faq-q" onclick="toggleFaq(this)">How many products do you carry?<div class="faq-icon">+</div></button><div class="faq-a">We carry 50+ products across 15+ popular game titles including CS2, GTA V, FiveM, R6 Siege, RDR2, Fortnite, Tarkov, and more. Join our Discord for new product announcements.</div></div>
    </div>
  </div>
</section>

<!-- DISCORD CTA -->
<div class="discord-section">
  <div class="discord-card">
    <div>
      <div class="dc-tag">Community</div>
      <div class="dc-title">Join Our Discord Server</div>
      <div class="dc-desc">24/7 order support, exclusive discounts, product advice and regular giveaways — all in one place. Thousands of gamers already inside.</div>
    </div>
    <div class="dc-right">
      <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener" class="btn-discord">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 00-4.885-1.515.074.074 0 00-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 00-5.487 0 12.64 12.64 0 00-.617-1.25.077.077 0 00-.079-.037A19.736 19.736 0 003.677 4.37a.07.07 0 00-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 00.031.057 19.9 19.9 0 005.993 3.03.078.078 0 00.084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 00-.041-.106 13.107 13.107 0 01-1.872-.892.077.077 0 01-.008-.128 10.2 10.2 0 00.372-.292.074.074 0 01.077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 01.078.01c.12.098.246.198.373.292a.077.077 0 01-.006.127 12.299 12.299 0 01-1.873.892.077.077 0 00-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 00.084.028 19.839 19.839 0 006.002-3.03.077.077 0 00.032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 00-.031-.03z"/></svg>
        Join Discord — It's Free
      </a>
      <div class="dc-members"><strong>8,500+</strong> members already inside</div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
</body>
