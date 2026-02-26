<?php
$active_page = $active_page ?? '';
?>
<div class="announce">
  🎮 New products added weekly — <a href="/shop">Browse the full catalogue →</a>
</div>

<nav id="navbar">
  <a href="/" class="nav-logo">TG<em>MODZ</em><span class="nav-logo-badge">Est. 2021</span></a>

  <ul class="nav-links">
    <li><a href="/"     class="<?= $active_page === 'home'  ? 'active' : '' ?>">Home</a></li>
    <li><a href="/shop" class="<?= $active_page === 'shop'  ? 'active' : '' ?>">Shop</a></li>
    <li><a href="https://discord.gg/tgmodz" target="_blank" rel="noopener">Discord</a></li>
    <li><a href="#">FAQ</a></li>
  </ul>

  <div class="nav-right">
    <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener" class="pill pill-ghost">Join Discord</a>
    <a href="/shop" class="pill pill-blue">Shop Now</a>
  </div>

  <button class="hamburger" id="hamburgerBtn" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<div class="mobile-nav" id="mobileNav">
  <a href="/"     class="<?= $active_page === 'home' ? 'active' : '' ?>">Home</a>
  <a href="/shop" class="<?= $active_page === 'shop' ? 'active' : '' ?>">Shop</a>
  <a href="https://discord.gg/tgmodz" target="_blank" rel="noopener">Discord</a>
  <a href="#">FAQ</a>
  <div class="mobile-btns">
    <a href="/shop" class="pill pill-blue">Shop Now</a>
  </div>
</div>

<script>
(function(){
  var btn = document.getElementById('hamburgerBtn');
  var nav = document.getElementById('mobileNav');
  btn.addEventListener('click', function(){
    nav.classList.toggle('open');
  });
  // Close on outside click
  document.addEventListener('click', function(e){
    if (!nav.contains(e.target) && !btn.contains(e.target)) {
      nav.classList.remove('open');
    }
  });
})();
</script>
