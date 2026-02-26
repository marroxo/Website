<?php
require_once __DIR__ . '/../config/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_start();
}

$order = $_SESSION['last_order'] ?? null;

$page_title  = 'Order Placed — TGModz';
$page_desc   = 'Your order has been placed. Contact us on Discord to complete payment.';
$active_page = 'home';
require __DIR__ . '/../includes/head.php';
?>
<body>
<?php require __DIR__ . '/../includes/nav.php'; ?>

<section style="padding:140px 4% 80px;">
  <div style="max-width:680px;margin:0 auto;">

    <?php if ($order): ?>

      <div class="success-box">
        <div class="success-icon">✓</div>
        <h1 style="font-family:'Bebas Neue',sans-serif;font-size:2.5rem;letter-spacing:0.05em;text-align:center;margin-bottom:0.5rem;">Order Placed!</h1>
        <p style="color:var(--text2);text-align:center;margin-bottom:2rem;">Thanks <strong style="color:var(--text);"><?= htmlspecialchars($order['name']) ?></strong>! Your order has been received.</p>

        <div class="order-id-box">
          <div class="oid-label">Your Order ID</div>
          <div class="oid-value" id="orderIdVal">#<?= htmlspecialchars((string)$order['id']) ?></div>
          <button class="oid-copy" onclick="copyOrderId()">Copy</button>
        </div>

        <div class="next-steps">
          <div style="font-weight:700;font-size:1rem;margin-bottom:1.25rem;">What happens next?</div>
          <div class="step-row">
            <div class="step-num-sm">1</div>
            <div><strong style="color:var(--text);">Join our Discord</strong><br><span>Open a ticket and send your Order ID above</span></div>
          </div>
          <div class="step-row">
            <div class="step-num-sm">2</div>
            <div><strong style="color:var(--text);">Complete Payment</strong><br><span>We accept crypto, PayPal, and bank transfer</span></div>
          </div>
          <div class="step-row">
            <div class="step-num-sm">3</div>
            <div><strong style="color:var(--text);">Receive Your License Key</strong><br>
              <span>Sent to <strong style="color:var(--blue-hi);"><?= htmlspecialchars($order['email']) ?></strong> after payment confirms</span>
            </div>
          </div>
        </div>

        <div class="order-summary">
          <div style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:var(--text3);margin-bottom:1rem;">Order Summary</div>
          <?php foreach ($order['items'] as $item): ?>
          <div class="os-row">
            <span>
              <?= htmlspecialchars($item['product_name']) ?>
              <?php if ($item['variation_name']): ?>
                <small style="color:var(--blue-hi);"> — <?= htmlspecialchars($item['variation_name']) ?></small>
              <?php endif; ?>
              × <?= $item['qty'] ?>
            </span>
            <span>$<?= number_format($item['price'] * $item['qty'], 2) ?></span>
          </div>
          <?php endforeach; ?>
          <div class="os-total">
            <span>Total Due</span>
            <span style="font-family:'Bebas Neue',sans-serif;font-size:1.4rem;letter-spacing:0.04em;color:var(--blue-hi);">$<?= number_format($order['total'], 2) ?></span>
          </div>
        </div>

        <div class="success-actions">
          <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener" class="btn-discord">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 00-4.885-1.515.074.074 0 00-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 00-5.487 0 12.64 12.64 0 00-.617-1.25.077.077 0 00-.079-.037A19.736 19.736 0 003.677 4.37a.07.07 0 00-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 00.031.057 19.9 19.9 0 005.993 3.03.078.078 0 00.084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 00-.041-.106 13.107 13.107 0 01-1.872-.892.077.077 0 01-.008-.128 10.2 10.2 0 00.372-.292.074.074 0 01.077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 01.078.01c.12.098.246.198.373.292a.077.077 0 01-.006.127 12.299 12.299 0 01-1.873.892.077.077 0 00-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 00.084.028 19.839 19.839 0 006.002-3.03.077.077 0 00.032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 00-.031-.03z"/></svg>
            Open Discord &amp; Pay
          </a>
          <a href="/" class="btn-sec" style="flex:1;justify-content:center;">Continue Shopping</a>
        </div>
      </div>

    <?php else: ?>
      <div class="success-box" style="text-align:center;">
        <div style="font-size:3rem;margin-bottom:1rem;">🛒</div>
        <h1 style="font-family:'Bebas Neue',sans-serif;font-size:2rem;letter-spacing:0.05em;margin-bottom:0.75rem;">No Order Found</h1>
        <p style="color:var(--text2);margin-bottom:1.5rem;">This page is only valid right after placing an order.</p>
        <a href="/" class="btn-primary">Back to Shop</a>
      </div>
    <?php endif; ?>

  </div>
</section>

<style>
.success-box{background:var(--surface);border:1px solid var(--border2);border-radius:20px;padding:48px;}
.success-icon{width:72px;height:72px;border-radius:50%;background:var(--green-dim);color:var(--green);font-size:2rem;display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;font-weight:700;}
.order-id-box{background:var(--bg);border:2px dashed var(--border2);border-radius:12px;padding:20px;text-align:center;margin-bottom:2rem;display:flex;flex-direction:column;align-items:center;gap:8px;}
.oid-label{font-size:0.72rem;text-transform:uppercase;letter-spacing:1.5px;color:var(--text3);}
.oid-value{font-family:'Bebas Neue',sans-serif;font-size:2.2rem;letter-spacing:0.06em;color:var(--blue-hi);}
.oid-copy{background:var(--surface2);border:1px solid var(--border);color:var(--text);padding:8px 20px;border-radius:6px;cursor:pointer;font-weight:600;font-size:0.82rem;transition:all 0.2s;font-family:'Outfit',sans-serif;}
.oid-copy:hover{border-color:var(--blue);color:var(--blue-hi);}
.next-steps{margin-bottom:1.75rem;}
.step-row{display:flex;align-items:flex-start;gap:14px;margin-bottom:14px;font-size:0.88rem;color:var(--text2);}
.step-num-sm{width:28px;height:28px;border-radius:50%;background:var(--blue-dim);color:var(--blue-hi);font-weight:800;font-size:0.8rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.order-summary{background:var(--surface2);border:1px solid var(--border);border-radius:12px;padding:20px;margin-bottom:1.75rem;}
.os-row{display:flex;justify-content:space-between;font-size:0.85rem;color:var(--text2);margin-bottom:8px;gap:8px;}
.os-row span:last-child{flex-shrink:0;font-weight:600;color:var(--text);}
.os-total{display:flex;justify-content:space-between;align-items:center;font-weight:700;border-top:1px solid var(--border);padding-top:12px;margin-top:8px;font-size:1rem;}
.success-actions{display:flex;gap:12px;flex-wrap:wrap;}
.success-actions>*{flex:1;justify-content:center;}
@media(max-width:640px){.success-box{padding:28px 20px;}}
</style>
<script>
function copyOrderId() {
  navigator.clipboard.writeText(document.getElementById('orderIdVal').textContent.trim()).then(() => {
    const btn = document.querySelector('.oid-copy');
    btn.textContent = 'Copied!';
    setTimeout(() => btn.textContent = 'Copy', 2000);
  });
}
</script>

<?php require __DIR__ . '/../includes/footer.php'; ?>
</body>
