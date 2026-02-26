<?php
require_once __DIR__ . '/../config/cart.php';
require_once __DIR__ . '/../config/auth.php';

$items = cart_items();
$total = cart_total();

$page_title  = 'Your Cart — TGModz';
$page_desc   = 'Review your cart and place your order.';
$active_page = 'home';
require __DIR__ . '/../includes/head.php';
?>
<body>
<?php require __DIR__ . '/../includes/nav.php'; ?>

<section style="padding:100px 4% 80px;">
  <div style="max-width:1000px;margin:0 auto;">

    <div style="font-family:'Bebas Neue',sans-serif;font-size:2.5rem;letter-spacing:0.05em;margin-bottom:2rem;">Your Cart</div>

    <?php if (empty($items)): ?>

      <div style="background:var(--surface);border:1px solid var(--border);border-radius:20px;padding:80px;text-align:center;">
        <div style="font-size:4rem;margin-bottom:1.25rem;">🛒</div>
        <div style="font-family:'Bebas Neue',sans-serif;font-size:2rem;letter-spacing:0.05em;margin-bottom:0.75rem;">Cart Is Empty</div>
        <p style="color:var(--text2);margin-bottom:1.75rem;">Browse our catalog and add some products to get started.</p>
        <a href="/#categories" class="btn-primary">Browse Products</a>
      </div>

    <?php else: ?>

      <div class="cart-layout">

        <!-- Items -->
        <div style="display:flex;flex-direction:column;gap:10px;" id="cartItems">
          <?php foreach ($items as $key => $item): ?>
          <div class="cart-item" id="item-<?= htmlspecialchars($key) ?>">
            <div style="width:64px;height:64px;background:var(--surface2);border-radius:10px;display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0;">
              <?php if (!empty($item['image_url'])): ?>
                <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="" style="width:100%;height:100%;object-fit:cover;opacity:0.8;">
              <?php else: ?>
                <span style="font-size:1.75rem;"><?= $item['cat_icon'] ?? '🎮' ?></span>
              <?php endif; ?>
            </div>
            <div style="flex:1;min-width:0;">
              <a href="/product/<?= urlencode($item['slug'] ?? '') ?>" style="font-weight:700;font-size:0.92rem;color:var(--text);display:block;margin-bottom:3px;transition:color 0.2s;" onmouseover="this.style.color='var(--blue-hi)'" onmouseout="this.style.color='var(--text)'"><?= htmlspecialchars($item['product_name']) ?></a>
              <?php if ($item['variation_name']): ?>
                <div style="font-size:0.75rem;color:var(--blue-hi);margin-bottom:2px;"><?= htmlspecialchars($item['variation_name']) ?></div>
              <?php endif; ?>
              <div style="font-family:'Bebas Neue',sans-serif;font-size:1.1rem;letter-spacing:0.04em;color:var(--blue-hi);">$<?= number_format($item['price'], 2) ?></div>
            </div>
            <div style="display:flex;align-items:center;gap:8px;">
              <button class="qty-btn" onclick="changeQty('<?= addslashes($key) ?>', -1)">−</button>
              <span id="qty-<?= htmlspecialchars($key) ?>" style="font-weight:700;font-size:1rem;min-width:24px;text-align:center;"><?= $item['qty'] ?></span>
              <button class="qty-btn" onclick="changeQty('<?= addslashes($key) ?>', 1)">+</button>
            </div>
            <div id="sub-<?= htmlspecialchars($key) ?>" style="font-family:'Bebas Neue',sans-serif;font-size:1.15rem;letter-spacing:0.04em;color:var(--blue);text-align:right;flex-shrink:0;min-width:80px;">
              $<?= number_format($item['price'] * $item['qty'], 2) ?>
            </div>
            <button onclick="removeItem('<?= addslashes($key) ?>')" style="background:none;border:none;color:var(--text3);cursor:pointer;font-size:1.1rem;padding:4px;transition:color 0.2s;line-height:1;flex-shrink:0;" onmouseover="this.style.color='var(--red)'" onmouseout="this.style.color='var(--text3)'">✕</button>
          </div>
          <?php endforeach; ?>
        </div>

        <!-- Summary -->
        <div class="cart-summary-box">
          <div style="font-weight:700;font-size:1rem;margin-bottom:1.25rem;color:var(--text);">Order Summary</div>

          <div style="display:flex;flex-direction:column;gap:8px;margin-bottom:1rem;">
            <?php foreach ($items as $item): ?>
            <div style="display:flex;justify-content:space-between;font-size:0.82rem;color:var(--text2);gap:8px;">
              <span><?= htmlspecialchars($item['product_name']) ?><?= $item['variation_name'] ? ' ('.htmlspecialchars($item['variation_name']).')' : '' ?> × <?= $item['qty'] ?></span>
              <span style="flex-shrink:0;font-weight:600;color:var(--text);">$<?= number_format($item['price'] * $item['qty'], 2) ?></span>
            </div>
            <?php endforeach; ?>
          </div>

          <div style="border-top:1px solid var(--border);margin:1rem 0;"></div>

          <div style="display:flex;justify-content:space-between;font-weight:700;font-size:1.1rem;margin-bottom:1.5rem;">
            <span>Total</span>
            <span id="cartTotal" style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:0.04em;color:var(--blue-hi);">$<?= number_format($total, 2) ?></span>
          </div>

          <a href="/checkout" class="btn-primary" style="width:100%;justify-content:center;font-size:1rem;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
            Place Order
          </a>

          <div style="display:flex;flex-direction:column;gap:6px;margin-top:1.25rem;">
            <span style="font-size:0.75rem;color:var(--text2);">🔒 Secure &amp; Private</span>
            <span style="font-size:0.75rem;color:var(--text2);">⚡ Instant Delivery After Payment</span>
            <span style="font-size:0.75rem;color:var(--text2);">💬 Pay via Discord</span>
          </div>

          <a href="/" style="display:block;margin-top:1rem;text-align:center;font-size:0.82rem;color:var(--text3);text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='var(--blue-hi)'" onmouseout="this.style.color='var(--text3)'">← Continue Shopping</a>
        </div>

      </div>

    <?php endif; ?>
  </div>
</section>

<style>
.cart-layout{display:grid;grid-template-columns:1fr 320px;gap:24px;align-items:start;}
@media(max-width:900px){.cart-layout{grid-template-columns:1fr;}}
.cart-item{display:grid;grid-template-columns:64px 1fr 110px 90px 32px;align-items:center;gap:14px;background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:16px 20px;transition:border-color 0.2s;}
.cart-item:hover{border-color:var(--border2);}
.qty-btn{background:var(--surface2);border:1px solid var(--border);color:var(--text);width:30px;height:30px;border-radius:6px;cursor:pointer;font-size:1.1rem;line-height:1;transition:all 0.2s;font-family:'Outfit',sans-serif;}
.qty-btn:hover{border-color:var(--blue);color:var(--blue);}
.cart-summary-box{background:var(--surface);border:1px solid var(--border2);border-radius:16px;padding:1.75rem;position:sticky;top:80px;}
@media(max-width:640px){
  .cart-item{grid-template-columns:48px 1fr 32px;gap:10px;}
  .cart-item>div:nth-child(3){display:none;}
  .cart-item>div:nth-child(4){display:none;}
}
</style>

<script>
async function postJSON(url, data) {
  var fd = new FormData();
  Object.entries(data).forEach(function([k,v]){ fd.append(k, v); });
  var r = await fetch(url, {method:'POST', body:fd});
  return r.json();
}

async function changeQty(key, delta) {
  var el  = document.getElementById('qty-' + key);
  if (!el) return;
  var cur = parseInt(el.textContent);
  var nxt = Math.max(0, cur + delta);
  var res = await postJSON('/cart/update', {key: key, qty: nxt});
  if (!res.ok) return;
  if (nxt === 0) {
    var row = document.getElementById('item-' + key);
    if (row) row.remove();
    if (res.cart_count === 0) location.reload();
  } else {
    location.reload();
  }
  updateBadge(res.cart_count);
}

async function removeItem(key) {
  var res = await postJSON('/cart/remove', {key: key});
  if (res.ok) {
    var row = document.getElementById('item-' + key);
    if (row) row.remove();
    document.getElementById('cartTotal').textContent = '$' + res.cart_total;
    updateBadge(res.cart_count);
    if (res.cart_count === 0) location.reload();
  }
}

function updateBadge(count) {
  var b = document.querySelector('.cart-badge');
  if (b) { b.textContent = count; b.style.display = count > 0 ? 'inline-flex' : 'none'; }
}
</script>

<?php require __DIR__ . '/../includes/footer.php'; ?>
</body>
