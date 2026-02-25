<?php
// $active_page: 'home' | 'cs2' | 'gta' | 'fivem' | 'rdr2' | 'r6'
$active_page = $active_page ?? 'home';
$base_url    = '/';

function nav_active(string $page, string $active): string {
    return $page === $active ? ' class="active"' : '';
}
?>
<nav id="navbar">
  <a href="<?= $base_url ?>" class="nav-logo">
    TG<span>Modz</span>
    <span class="logo-badge">Verified</span>
  </a>

  <ul class="nav-links" id="navLinks">
    <li><a href="<?= $base_url ?>#products"<?= nav_active('home', $active_page) ?>>Products</a></li>
    <li><a href="<?= $base_url ?>#why-us">Why Us</a></li>
    <li><a href="<?= $base_url ?>#reviews">Reviews</a></li>
    <li><a href="<?= $base_url ?>#faq">FAQ</a></li>
    <li><a href="https://discord.gg/tgmodz" class="nav-cta" target="_blank" rel="noopener">Join Discord</a></li>
  </ul>

  <button class="hamburger" id="hamburger" aria-label="Toggle menu" aria-expanded="false">
    <span></span><span></span><span></span>
  </button>
</nav>
