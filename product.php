<?php
/**
 * Product detail page — shows product info + variation selector + Add to Cart
 * URL: /product/{slug}
 */

require_once __DIR__ . '/config/db.php';

$uri  = ltrim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');
$slug = preg_replace('#^product/#', '', $uri);

$product = db_row("
    SELECT p.*, c.name AS cat_name, c.slug AS cat_slug, c.icon AS cat_icon, c.color AS cat_color
    FROM products p
    LEFT JOIN categories c ON c.id = p.category_id
    WHERE p.slug = ? AND p.is_active = 1
    LIMIT 1
", [$slug]);

if (!$product) {
    http_response_code(404);
    $page_title  = '404 — Product Not Found — TGModz';
    $page_desc   = '';
    $active_page = 'home';
    require __DIR__ . '/includes/head.php';
    ?>
    <body>
    <?php require __DIR__ . '/includes/nav.php'; ?>
    <section style="padding:160px 0 80px;text-align:center">
      <div class="container">
        <div class="sh" style="font-size:2.5rem;margin-bottom:12px">Product Not Found</div>
        <p style="color:var(--text2);margin-bottom:32px">This product doesn't exist or has been removed.</p>
        <a href="/" class="btn-primary">Back to Shop</a>
      </div>
    </section>
    <?php require __DIR__ . '/includes/footer.php'; ?>
    </body>
    <?php exit;
}

// Load variations
$variations = db_rows(
    "SELECT * FROM product_variations WHERE product_id = ? ORDER BY sort_order, price",
    [$product['id']]
);

$accent = $product['cat_color'] ?? '#3b82f6';

$page_title  = $product['name'] . ' — TGModz';
$page_desc   = $product['short_description']
    ? strip_tags(substr($product['short_description'], 0, 160))
    : 'Buy ' . $product['name'] . ' at TGModz. Authorized reseller, instant delivery.';
$active_page = $product['cat_slug'] ?? 'home';
$extra_css   = "
:root{--accent:{$accent};}
.accent-btn{background:var(--accent);color:#fff;padding:1rem 2rem;border-radius:8px;font-weight:700;font-size:1rem;display:inline-flex;align-items:center;gap:10px;transition:all 0.25s;border:none;cursor:pointer;letter-spacing:0.04em;text-transform:uppercase;font-family:'Outfit',sans-serif;width:100%;justify-content:center;box-shadow:0 4px 24px {$accent}44;}
.accent-btn:hover{filter:brightness(1.1);transform:translateY(-2px);box-shadow:0 8px 36px {$accent}55;}
.accent-btn:disabled{opacity:0.45;cursor:not-allowed;transform:none;box-shadow:none;}
.var-option{display:flex;align-items:center;justify-content:space-between;padding:14px 18px;border:1px solid var(--border);border-radius:10px;cursor:pointer;transition:all 0.2s;background:var(--surface2);margin-bottom:10px;gap:12px;}
.var-option:hover{border-color:{$accent}88;background:var(--surface);}
.var-option.selected{border-color:{$accent};background:{$accent}12;}
.var-option.out-stock{opacity:0.45;cursor:not-allowed;}
.var-name{font-weight:600;font-size:0.95rem;}
.var-price{font-family:'Bebas Neue',sans-serif;font-size:1.2rem;letter-spacing:0.04em;color:{$accent};flex-shrink:0;}
.var-sale{text-decoration:line-through;color:var(--text3);font-size:0.8rem;margin-left:6px;font-weight:400;font-family:'Outfit',sans-serif;}
.var-badge{font-size:0.62rem;font-weight:700;text-transform:uppercase;padding:2px 7px;border-radius:4px;margin-left:8px;background:var(--red-dim);color:var(--red);border:1px solid rgba(239,68,68,0.25);}
.pd-simple-price{font-family:'Bebas Neue',sans-serif;font-size:3rem;letter-spacing:0.04em;color:{$accent};line-height:1;}
.pd-title{font-family:'Bebas Neue',sans-serif;font-size:clamp(2rem,4vw,3rem);letter-spacing:0.04em;line-height:1;margin-bottom:1rem;}
";

require __DIR__ . '/includes/head.php';
?>
<body>
<?php require __DIR__ . '/includes/nav.php'; ?>

<section style="padding:100px 4% 80px;">
  <div style="max-width:1100px;margin:0 auto;">

    <!-- Breadcrumb -->
    <div style="font-size:0.82rem;color:var(--text3);display:flex;align-items:center;gap:8px;margin-bottom:2rem;">
      <a href="/" style="color:var(--text3);transition:color 0.2s;" onmouseover="this.style.color='var(--blue-hi)'" onmouseout="this.style.color='var(--text3)'">TGModz</a>
      <span>›</span>
      <?php if ($product['cat_slug']): ?>
        <a href="/<?= htmlspecialchars($product['cat_slug']) ?>" style="color:var(--text3);transition:color 0.2s;" onmouseover="this.style.color='var(--blue-hi)'" onmouseout="this.style.color='var(--text3)'"><?= htmlspecialchars($product['cat_name']) ?></a>
        <span>›</span>
      <?php endif; ?>
      <span style="color:var(--text2);"><?= htmlspecialchars($product['name']) ?></span>
    </div>

    <div class="product-detail-grid">

      <!-- LEFT: Image + Trust -->
      <div class="pd-media">
        <div style="background:var(--surface2);border:1px solid var(--border2);border-radius:16px;aspect-ratio:1;display:flex;align-items:center;justify-content:center;overflow:hidden;margin-bottom:1.25rem;position:relative;">
          <?php if (!empty($product['image_url'])): ?>
            <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="width:100%;height:100%;object-fit:cover;">
          <?php else: ?>
            <div style="text-align:center;">
              <div style="font-size:5rem;opacity:0.7;"><?= $product['cat_icon'] ?? '🎮' ?></div>
              <div style="font-family:'Bebas Neue',sans-serif;font-size:1rem;letter-spacing:0.1em;color:var(--text3);margin-top:0.5rem;"><?= htmlspecialchars($product['cat_name'] ?? '') ?></div>
            </div>
          <?php endif; ?>
          <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,<?= $accent ?>,transparent);opacity:0.6;"></div>
        </div>

        <div style="display:flex;flex-direction:column;gap:8px;">
          <?php foreach (['⚡ Instant Email Delivery', '🏅 Developer Authorized', '💬 24/7 Discord Support', '🛡️ Buyer Protection Included'] as $ti): ?>
            <div style="display:flex;align-items:center;gap:10px;font-size:0.82rem;color:var(--text2);padding:10px 14px;background:var(--surface);border:1px solid var(--border);border-radius:8px;"><?= $ti ?></div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- RIGHT: Info + Buy -->
      <div class="pd-info">

        <?php if ($product['cat_name']): ?>
          <div style="font-size:0.7rem;text-transform:uppercase;letter-spacing:0.12em;color:<?= $accent ?>;font-weight:700;margin-bottom:0.75rem;">
            <?= $product['cat_icon'] ?> &nbsp;<?= htmlspecialchars($product['cat_name']) ?>
          </div>
        <?php endif; ?>

        <div class="pd-title"><?= htmlspecialchars($product['name']) ?></div>

        <?php if ($product['short_description']): ?>
          <p style="font-size:0.95rem;color:var(--text2);line-height:1.75;font-weight:300;margin-bottom:1.5rem;"><?= htmlspecialchars($product['short_description']) ?></p>
        <?php endif; ?>

        <?php if ($product['type'] === 'variable' && $variations): ?>

          <!-- Variation Selector -->
          <div style="margin-bottom:1.5rem;">
            <div style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:var(--text2);margin-bottom:0.875rem;">Select License Duration</div>
            <?php foreach ($variations as $v):
              $display  = $v['sale_price'] ? $v['sale_price'] : $v['price'];
              $is_sale  = !empty($v['sale_price']);
              $in_stock = !empty($v['is_in_stock']);
            ?>
            <label class="var-option<?= !$in_stock ? ' out-stock' : '' ?>" id="var-<?= $v['id'] ?>">
              <input type="radio" name="variation" value="<?= $v['id'] ?>"
                     data-price="<?= htmlspecialchars($display) ?>"
                     data-name="<?= htmlspecialchars($v['name']) ?>"
                     data-product="<?= $product['id'] ?>"
                     <?= !$in_stock ? 'disabled' : '' ?>
                     onchange="selectVariation(this)"
                     style="display:none;">
              <span class="var-name">
                <?= htmlspecialchars($v['name']) ?>
                <?php if (!$in_stock): ?><span class="var-badge">Out of Stock</span><?php endif; ?>
              </span>
              <span class="var-price">
                $<?= number_format((float)$display, 2) ?>
                <?php if ($is_sale): ?><span class="var-sale">$<?= number_format((float)$v['price'], 2) ?></span><?php endif; ?>
              </span>
            </label>
            <?php endforeach; ?>
          </div>

          <div id="selected-summary" style="display:none;padding:14px;background:var(--surface2);border:1px solid var(--border2);border-radius:10px;margin-bottom:1.25rem;font-size:0.88rem;color:var(--text2);">
            Selected: <strong id="sel-name" style="color:var(--text);"></strong> — <strong id="sel-price" style="color:<?= $accent ?>;font-family:'Bebas Neue',sans-serif;font-size:1.1rem;"></strong>
          </div>

          <button id="buy-btn" class="accent-btn" disabled onclick="doAddToCart()">
            Select a License Duration
          </button>

        <?php elseif ($product['type'] === 'simple'): ?>
          <?php
            $price    = $product['sale_price'] ?? $product['price'];
            $in_stock = !empty($product['is_in_stock']);
          ?>
          <div style="margin:1.5rem 0;">
            <div class="pd-simple-price">
              $<?= number_format((float)$price, 2) ?>
              <?php if ($product['sale_price'] && $product['price']): ?>
                <span style="text-decoration:line-through;color:var(--text3);font-size:1.4rem;font-weight:400;margin-left:12px;font-family:'Outfit',sans-serif;">$<?= number_format((float)$product['price'], 2) ?></span>
              <?php endif; ?>
            </div>
          </div>
          <?php if ($in_stock): ?>
            <button id="buy-btn-simple" class="accent-btn"
              onclick="doAddSimple(<?= $product['id'] ?>, null, <?= htmlspecialchars(json_encode($product['name'])) ?>, null, <?= (float)$price ?>)">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
              Add to Cart — $<?= number_format((float)$price, 2) ?>
            </button>
          <?php else: ?>
            <button class="accent-btn" disabled>Out of Stock</button>
          <?php endif; ?>

        <?php elseif ($product['type'] === 'external'): ?>
          <a href="https://discord.gg/tgmodz" class="accent-btn" target="_blank" rel="noopener">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 00-4.885-1.515.074.074 0 00-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 00-5.487 0 12.64 12.64 0 00-.617-1.25.077.077 0 00-.079-.037A19.736 19.736 0 003.677 4.37a.07.07 0 00-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 00.031.057 19.9 19.9 0 005.993 3.03.078.078 0 00.084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 00-.041-.106 13.107 13.107 0 01-1.872-.892.077.077 0 01-.008-.128 10.2 10.2 0 00.372-.292.074.074 0 01.077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 01.078.01c.12.098.246.198.373.292a.077.077 0 01-.006.127 12.299 12.299 0 01-1.873.892.077.077 0 00-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 00.084.028 19.839 19.839 0 006.002-3.03.077.077 0 00.032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 00-.031-.03z"/></svg>
            Purchase on Discord →
          </a>
        <?php endif; ?>

        <!-- Payment methods -->
        <div style="margin-top:1.25rem;display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
          <span style="font-size:0.7rem;color:var(--text3);text-transform:uppercase;letter-spacing:0.08em;">Accepted:</span>
          <?php foreach (['CRYPTO','PAYPAL','BANK TRANSFER','CASHAPP'] as $pm): ?>
            <span class="pay-icon" style="font-size:0.65rem;padding:3px 8px;"><?= $pm ?></span>
          <?php endforeach; ?>
        </div>

        <!-- Description -->
        <?php if ($product['description']): ?>
          <div style="margin-top:2rem;padding-top:1.5rem;border-top:1px solid var(--border);">
            <div style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--text2);margin-bottom:0.875rem;">About This Product</div>
            <div style="font-size:0.9rem;color:var(--text2);line-height:1.8;font-weight:300;">
              <?= nl2br(htmlspecialchars(substr($product['description'], 0, 800))) ?>
            </div>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</section>

<style>
.product-detail-grid{display:grid;grid-template-columns:1fr 1.2fr;gap:60px;align-items:start;}
.pd-media{position:sticky;top:80px;}
@media(max-width:900px){.product-detail-grid{grid-template-columns:1fr;} .pd-media{position:static;}}
</style>

<script>
let selectedVarId    = null;
let selectedVarPrice = null;
let selectedVarName  = null;

function selectVariation(input) {
  document.querySelectorAll('.var-option').forEach(function(el){ el.classList.remove('selected'); });
  document.getElementById('var-' + input.value).classList.add('selected');

  selectedVarId    = input.value;
  selectedVarPrice = input.dataset.price;
  selectedVarName  = input.dataset.name;

  document.getElementById('sel-name').textContent  = input.dataset.name;
  document.getElementById('sel-price').textContent = '$' + parseFloat(selectedVarPrice).toFixed(2);
  document.getElementById('selected-summary').style.display = 'block';

  var btn = document.getElementById('buy-btn');
  btn.disabled  = false;
  btn.innerHTML = cartIcon() + ' Add to Cart — $' + parseFloat(selectedVarPrice).toFixed(2);
}

function cartIcon() {
  return '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>';
}

function doAddToCart() {
  if (!selectedVarId) return;
  var pid = document.querySelector('[name="variation"]').dataset.product;
  postAddToCart(pid, selectedVarId);
}

function doAddSimple(pid, vid) {
  postAddToCart(pid, vid);
}

function postAddToCart(pid, vid) {
  var btn  = document.getElementById('buy-btn') || document.getElementById('buy-btn-simple');
  var orig = btn.innerHTML;
  btn.disabled  = true;
  btn.textContent = 'Adding…';

  var body = new URLSearchParams({ product_id: pid, qty: 1 });
  if (vid) body.append('variation_id', vid);

  fetch('/cart/add', { method: 'POST', body: body })
    .then(function(r){ return r.json(); })
    .then(function(data){
      if (data.ok) {
        btn.innerHTML = '✓ Added to Cart!';
        var badge = document.querySelector('.cart-badge');
        if (badge) { badge.textContent = data.cart_count; badge.style.display = 'inline-flex'; }
        setTimeout(function(){ btn.disabled = false; btn.innerHTML = orig; }, 2000);
      } else {
        btn.innerHTML = orig;
        btn.disabled  = false;
        alert(data.message || 'Could not add to cart.');
      }
    })
    .catch(function(){ btn.innerHTML = orig; btn.disabled = false; });
}
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
</body>
