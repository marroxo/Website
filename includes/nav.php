<?php
// $active_page: 'home' | category slug | etc.
$active_page = $active_page ?? 'home';
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/cart.php';
$_user       = auth_user();
$_cart_count = cart_count();
$_nav_items  = [
    ['href' => '/cs2',          'label' => 'CS2',    'slug' => 'cs2'],
    ['href' => '/gta',          'label' => 'GTA V',  'slug' => 'gta'],
    ['href' => '/fivem',        'label' => 'FiveM',  'slug' => 'fivem'],
    ['href' => '/r6',           'label' => 'R6',     'slug' => 'r6'],
    ['href' => '/rdr2',         'label' => 'RDR2',   'slug' => 'rdr2'],
    ['href' => '/#categories',  'label' => 'All Games', 'slug' => 'all'],
];
?>

<!-- ANNOUNCEMENT RIBBON -->
<div class="announce">
  🔥 <strong>Flash Sale — Up to 40% off select products today only.</strong> Use code <strong>TGDEAL</strong> at checkout. &nbsp;<a href="/#categories">Shop now →</a>
</div>

<!-- NAV -->
<nav id="navbar">
  <a href="/" class="nav-logo">TG<em>Modz</em><span class="logo-badge">Est. 2021</span></a>

  <ul class="nav-links" id="navLinks">
    <?php foreach ($_nav_items as $ni): ?>
      <li><a href="<?= $ni['href'] ?>" class="<?= ($active_page === $ni['slug'] || ($ni['slug'] === 'home' && $active_page === 'home')) ? 'active' : '' ?>"><?= $ni['label'] ?></a></li>
    <?php endforeach; ?>
    <li><a href="https://discord.gg/tgmodz" target="_blank" rel="noopener" style="color:#7B8AF0;">Support</a></li>
  </ul>

  <div class="nav-right">
    <?php if ($_user): ?>
      <a href="/account" class="pill pill-ghost">
        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
        <?= htmlspecialchars($_user['name'] ?: 'Account') ?>
      </a>
    <?php else: ?>
      <a href="/auth/login" class="pill pill-ghost">Sign In</a>
    <?php endif; ?>

    <a href="/cart" class="nav-cart-btn" title="Cart">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/>
      </svg>
      <?php if ($_cart_count > 0): ?>
        <span class="cart-badge"><?= $_cart_count ?></span>
      <?php endif; ?>
    </a>

    <a href="/#categories" class="pill pill-blue">Shop Now →</a>

    <button class="hamburger" id="hamburger" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<script>
(function(){
  var btn = document.getElementById('hamburger');
  var nav = document.getElementById('navLinks');
  if (!btn || !nav) return;
  btn.addEventListener('click', function(){
    nav.classList.toggle('open');
  });
  document.addEventListener('click', function(e){
    if (!nav.contains(e.target) && !btn.contains(e.target)) {
      nav.classList.remove('open');
    }
  });
})();
</script>
