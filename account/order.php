<?php
require_once __DIR__ . '/../config/auth.php';

if (!auth_check()) {
    header('Location: /auth/login?next=/account');
    exit;
}

$user     = auth_user();
$order_id = (int)($_GET['id'] ?? 0);
$order    = $order_id ? db_row(
    "SELECT * FROM orders WHERE id = ? AND user_id = ?",
    [$order_id, $user['id']]
) : null;

if (!$order) {
    header('Location: /account');
    exit;
}

$items = db_rows("SELECT * FROM order_items WHERE order_id = ?", [$order['id']]);

$page_title  = 'Order #' . $order['id'] . ' — TGModz';
$page_desc   = '';
$active_page = 'home';
require __DIR__ . '/../includes/head.php';
?>
<body>
<?php require __DIR__ . '/../includes/nav.php'; ?>

<section style="padding:120px 0 80px;">
  <div class="container" style="max-width:700px">
    <div style="margin-bottom:24px">
      <a href="/account" style="color:var(--text3);text-decoration:none;font-size:0.85rem">← Back to Orders</a>
    </div>
    <h1 style="font-family:'Space Grotesk',sans-serif;font-size:1.8rem;margin-bottom:4px">Order #<?= $order['id'] ?></h1>
    <p style="color:var(--text3);font-size:0.82rem;margin-bottom:32px"><?= date('M j, Y \a\t g:ia', strtotime($order['created_at'])) ?></p>

    <?php foreach ($items as $item): ?>
      <div style="background:var(--card);border:1px solid var(--border);border-radius:14px;padding:24px;margin-bottom:16px">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:16px">
          <div>
            <div style="font-weight:700;font-size:1.05rem"><?= htmlspecialchars($item['product_name']) ?></div>
            <?php if ($item['variation_name']): ?>
              <div style="font-size:0.82rem;color:var(--cyan);margin-top:4px"><?= htmlspecialchars($item['variation_name']) ?></div>
            <?php endif; ?>
          </div>
          <div style="font-family:'Space Grotesk',sans-serif;font-weight:700;color:var(--blue)">
            $<?= number_format($item['price'], 2) ?>
          </div>
        </div>

        <?php if ($item['license_key']): ?>
          <div style="background:var(--bg);border:1px solid var(--border2);border-radius:10px;padding:16px">
            <div style="font-size:0.7rem;text-transform:uppercase;letter-spacing:1px;color:var(--text3);margin-bottom:8px">License Key</div>
            <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap">
              <code id="k-<?= $item['id'] ?>" style="font-size:0.95rem;color:var(--green);flex:1;word-break:break-all">
                <?= htmlspecialchars($item['license_key']) ?>
              </code>
              <button class="lb-copy" onclick="copyKey('k-<?= $item['id'] ?>',this)">Copy</button>
            </div>
          </div>
        <?php else: ?>
          <div style="color:var(--text3);font-size:0.85rem">
            🔑 Your key has been emailed to <strong><?= htmlspecialchars($order['email']) ?></strong>.
            Can't find it? <a href="<?= DISCORD_URL ?>" target="_blank" style="color:var(--blue)">Open a Discord ticket</a>.
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>

    <div style="text-align:right;padding-top:8px;border-top:1px solid var(--border);margin-top:8px">
      <span style="color:var(--text2);font-size:0.85rem">Total: </span>
      <span style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1.2rem">$<?= number_format($order['total'], 2) ?></span>
    </div>

  </div>
</section>

<style>
.lb-copy { background:var(--surface2);border:1px solid var(--border);color:var(--text);padding:8px 16px;border-radius:6px;cursor:pointer;font-size:0.82rem;font-weight:600;transition:all 0.2s; }
.lb-copy:hover { border-color:var(--blue);color:var(--blue); }
</style>
<script>
function copyKey(id,btn){navigator.clipboard.writeText(document.getElementById(id).textContent.trim()).then(()=>{btn.textContent='Copied!';setTimeout(()=>btn.textContent='Copy',2000)});}
</script>
<?php require __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
