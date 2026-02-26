<?php
require_once __DIR__ . '/../config/cart.php';
require_once __DIR__ . '/../config/auth.php';

// Redirect if cart is empty
if (cart_is_empty()) {
    header('Location: /cart');
    exit;
}

$items  = cart_items();
$total  = cart_total();
$user   = auth_user();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name']  ?? '');
    $email = trim($_POST['email'] ?? '');
    $note  = trim($_POST['note']  ?? '');

    if (empty($name))  $errors[] = 'Please enter your name.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email address.';

    if (empty($errors)) {
        $order_id = null;
        try {
            require_once __DIR__ . '/../config/db.php';
            $existing = db_row("SELECT id FROM users WHERE email = ?", [strtolower($email)]);
            $uid = $existing ? $existing['id']
                : db_insert("INSERT INTO users (email, name, is_guest) VALUES (?,?,1)", [strtolower($email), $name]);

            $order_id = db_insert(
                "INSERT INTO orders (user_id, email, status, total) VALUES (?,?,?,?)",
                [$uid, $email, 'pending', $total]
            );
            foreach ($items as $item) {
                db_insert(
                    "INSERT INTO order_items (order_id, product_id, variation_id, product_name, variation_name, price) VALUES (?,?,?,?,?,?)",
                    [$order_id, $item['product_id'], $item['variation_id'],
                     $item['product_name'], $item['variation_name'] ?? null, $item['price']]
                );
            }
        } catch (Throwable $e) {
            $order_id = 'TGM-' . strtoupper(substr(md5(uniqid()), 0, 8));
        }

        $_SESSION['last_order'] = [
            'id'    => $order_id,
            'name'  => $name,
            'email' => $email,
            'note'  => $note,
            'items' => $items,
            'total' => $total,
        ];
        cart_clear();
        header('Location: /checkout/success');
        exit;
    }
}

$page_title  = 'Checkout — TGModz';
$page_desc   = 'Complete your order.';
$active_page = 'home';
require __DIR__ . '/../includes/head.php';
?>
<body>
<?php require __DIR__ . '/../includes/nav.php'; ?>

<section style="padding:100px 4% 80px;">
  <div style="max-width:960px;margin:0 auto;">

    <div style="font-family:'Bebas Neue',sans-serif;font-size:2.5rem;letter-spacing:0.05em;margin-bottom:2rem;">Checkout</div>

    <?php if ($errors): ?>
      <div class="form-error" style="margin-bottom:1.5rem;">
        <?php foreach ($errors as $e): ?><div><?= htmlspecialchars($e) ?></div><?php endforeach; ?>
      </div>
    <?php endif; ?>

    <div class="checkout-layout">

      <!-- LEFT: Form -->
      <div>
        <!-- Details -->
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:1.75rem;margin-bottom:1.25rem;">
          <div style="font-weight:700;font-size:1rem;margin-bottom:1.25rem;">Your Details</div>
          <form method="POST" id="checkoutForm">
            <div class="co-field">
              <label>Full Name</label>
              <input type="text" name="name" value="<?= htmlspecialchars($_POST['name'] ?? $user['name'] ?? '') ?>" placeholder="Your name" required autocomplete="name">
            </div>
            <div class="co-field">
              <label>Email Address <small style="color:var(--text3);font-weight:400;letter-spacing:0;text-transform:none;">— license key will be sent here</small></label>
              <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? $user['email'] ?? '') ?>" placeholder="you@example.com" required autocomplete="email">
            </div>
            <div class="co-field">
              <label>Order Note <small style="color:var(--text3);font-weight:400;text-transform:none;letter-spacing:0;">(optional)</small></label>
              <textarea name="note" rows="3" placeholder="Any special requests or instructions..."><?= htmlspecialchars($_POST['note'] ?? '') ?></textarea>
            </div>
          </form>
        </div>

        <!-- Payment info -->
        <div style="background:rgba(249,115,22,0.06);border:1px solid rgba(249,115,22,0.25);border-radius:16px;padding:1.75rem;">
          <div style="font-weight:700;font-size:1rem;margin-bottom:0.875rem;color:var(--orange);">💳 How to Pay</div>
          <p style="font-size:0.88rem;color:var(--text2);line-height:1.7;margin-bottom:1rem;">After placing your order, send your <strong style="color:var(--text);">Order ID</strong> to us on Discord and we'll arrange payment. We accept <strong style="color:var(--text);">crypto, PayPal, and bank transfer</strong>.</p>
          <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener" class="btn-discord" style="font-size:0.85rem;padding:0.7rem 1.5rem;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 00-4.885-1.515.074.074 0 00-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 00-5.487 0 12.64 12.64 0 00-.617-1.25.077.077 0 00-.079-.037A19.736 19.736 0 003.677 4.37a.07.07 0 00-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 00.031.057 19.9 19.9 0 005.993 3.03.078.078 0 00.084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 00-.041-.106 13.107 13.107 0 01-1.872-.892.077.077 0 01-.008-.128 10.2 10.2 0 00.372-.292.074.074 0 01.077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 01.078.01c.12.098.246.198.373.292a.077.077 0 01-.006.127 12.299 12.299 0 01-1.873.892.077.077 0 00-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 00.084.028 19.839 19.839 0 006.002-3.03.077.077 0 00.032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 00-.031-.03z"/></svg>
            Contact us on Discord
          </a>
        </div>
      </div>

      <!-- RIGHT: Summary -->
      <div style="background:var(--surface);border:1px solid var(--border2);border-radius:16px;padding:1.75rem;position:sticky;top:80px;">
        <div style="font-weight:700;font-size:1rem;margin-bottom:1.25rem;">Order Summary</div>

        <div style="display:flex;flex-direction:column;gap:8px;margin-bottom:1rem;">
          <?php foreach ($items as $item): ?>
          <div style="display:flex;justify-content:space-between;font-size:0.82rem;color:var(--text2);gap:8px;">
            <span>
              <?= htmlspecialchars($item['product_name']) ?>
              <?php if ($item['variation_name']): ?><br><small style="color:var(--blue-hi);"><?= htmlspecialchars($item['variation_name']) ?></small><?php endif; ?>
              × <?= $item['qty'] ?>
            </span>
            <span style="flex-shrink:0;font-weight:600;color:var(--text);">$<?= number_format($item['price'] * $item['qty'], 2) ?></span>
          </div>
          <?php endforeach; ?>
        </div>

        <div style="border-top:1px solid var(--border);margin:1rem 0;"></div>

        <div style="display:flex;justify-content:space-between;font-weight:700;font-size:1.1rem;margin-bottom:1.5rem;">
          <span>Total</span>
          <span style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:0.04em;color:var(--blue-hi);">$<?= number_format($total, 2) ?></span>
        </div>

        <button type="submit" form="checkoutForm" class="btn-primary" style="width:100%;justify-content:center;font-size:1rem;">
          ✓ Place Order
        </button>

        <div style="display:flex;flex-direction:column;gap:6px;margin-top:1rem;">
          <span style="font-size:0.75rem;color:var(--text2);">⚡ Order ID sent instantly</span>
          <span style="font-size:0.75rem;color:var(--text2);">💬 Pay via Discord</span>
          <span style="font-size:0.75rem;color:var(--text2);">🔑 License key after payment</span>
        </div>

        <a href="/cart" style="display:block;margin-top:1rem;text-align:center;font-size:0.82rem;color:var(--text3);transition:color 0.2s;" onmouseover="this.style.color='var(--blue-hi)'" onmouseout="this.style.color='var(--text3)'">← Back to Cart</a>
      </div>

    </div>
  </div>
</section>

<style>
.checkout-layout{display:grid;grid-template-columns:1fr 320px;gap:24px;align-items:start;}
@media(max-width:900px){.checkout-layout{grid-template-columns:1fr;}}
</style>

<?php require __DIR__ . '/../includes/footer.php'; ?>
</body>
