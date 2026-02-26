<?php
require_once __DIR__ . '/../config/auth.php';

if (!auth_check()) {
    header('Location: /auth/login?next=/account');
    exit;
}

$user   = auth_user();
$orders = db_rows(
    "SELECT o.*, GROUP_CONCAT(oi.product_name ORDER BY oi.id SEPARATOR ', ') AS products
     FROM orders o
     LEFT JOIN order_items oi ON oi.order_id = o.id
     WHERE o.user_id = ?
     GROUP BY o.id
     ORDER BY o.created_at DESC",
    [$user['id']]
);

$page_title  = 'My Account — TGModz';
$page_desc   = 'View your orders and downloads.';
$active_page = 'home';
require __DIR__ . '/../includes/head.php';
?>
<body>
<?php require __DIR__ . '/../includes/nav.php'; ?>

<section style="padding:120px 0 80px;">
  <div class="container" style="max-width:900px">

    <div class="acct-header">
      <div>
        <h1>My Account</h1>
        <p style="color:var(--text2)"><?= htmlspecialchars($user['email']) ?></p>
      </div>
      <a href="/auth/logout" class="btn-secondary" style="align-self:flex-start">Sign Out</a>
    </div>

    <h2 class="acct-section-title">Order History</h2>

    <?php if (!$orders): ?>
      <div class="empty-orders">
        <div style="font-size:3rem;margin-bottom:16px">🛒</div>
        <p>You haven't placed any orders yet.</p>
        <a href="/" class="btn-primary" style="margin-top:20px">Start Shopping</a>
      </div>
    <?php else: ?>
      <div class="orders-list">
        <?php foreach ($orders as $order): ?>
          <div class="order-row">
            <div class="or-info">
              <div class="or-products"><?= htmlspecialchars($order['products'] ?: 'Order #' . $order['id']) ?></div>
              <div class="or-date"><?= date('M j, Y', strtotime($order['created_at'])) ?></div>
            </div>
            <div class="or-right">
              <div class="or-total">$<?= number_format($order['total'], 2) ?></div>
              <span class="or-status status-<?= $order['status'] ?>"><?= ucfirst($order['status']) ?></span>
              <?php if ($order['status'] === 'paid'): ?>
                <a href="/account/order?id=<?= $order['id'] ?>" class="or-view">View</a>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</section>

<style>
.acct-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:40px; }
.acct-header h1 { font-family:'Space Grotesk',sans-serif; font-size:2rem; }
.acct-section-title { font-family:'Space Grotesk',sans-serif; font-size:1.2rem; font-weight:700; margin-bottom:16px; color:var(--text2); text-transform:uppercase; letter-spacing:1px; }
.empty-orders { background:var(--card); border:1px solid var(--border); border-radius:16px; padding:60px; text-align:center; color:var(--text2); }
.orders-list { display:flex; flex-direction:column; gap:12px; }
.order-row { background:var(--card); border:1px solid var(--border); border-radius:12px; padding:20px 24px; display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap; transition:border-color 0.2s; }
.order-row:hover { border-color:var(--border2); }
.or-products { font-weight:600; margin-bottom:4px; }
.or-date { font-size:0.8rem; color:var(--text3); }
.or-right { display:flex; align-items:center; gap:14px; flex-wrap:wrap; }
.or-total { font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:1.1rem; }
.or-status { font-size:0.72rem; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; padding:4px 10px; border-radius:6px; }
.status-paid     { background:var(--green-lo); color:var(--green); }
.status-pending  { background:var(--blue-lo); color:var(--blue); }
.status-failed   { background:rgba(239,68,68,0.1); color:var(--red); }
.status-refunded { background:rgba(99,102,241,0.1); color:var(--indigo); }
.or-view { color:var(--blue); font-size:0.82rem; font-weight:600; text-decoration:none; }
.or-view:hover { text-decoration:underline; }
</style>

<?php require __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
