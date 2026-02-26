<?php
$page_title  = 'Checkout Cancelled — TGModz';
$page_desc   = '';
$active_page = 'home';
require __DIR__ . '/../includes/head.php';
?>
<body>
<?php require __DIR__ . '/../includes/nav.php'; ?>
<section style="padding:160px 0 80px;text-align:center">
  <div class="container">
    <div style="font-size:3rem;margin-bottom:20px">🛒</div>
    <h1 style="font-family:'Space Grotesk',sans-serif;font-size:2rem;margin-bottom:12px">Checkout Cancelled</h1>
    <p style="color:var(--text2);max-width:480px;margin:0 auto 32px;line-height:1.7">
      No payment was taken. Ready when you are — your items are still here.
    </p>
    <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap">
      <a href="/" class="btn-primary">Back to Shop</a>
      <a href="<?= DISCORD_URL ?? 'https://discord.gg/tgmodz' ?>" class="btn-secondary" target="_blank" rel="noopener">Need Help?</a>
    </div>
  </div>
</section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
