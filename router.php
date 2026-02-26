<?php
/**
 * TGModz PHP Router
 * Usage: php -S 0.0.0.0:3001 router.php
 */

$uri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri  = rawurldecode($uri);
$path = rtrim($uri, '/');

// ── 1. Real static files ─────────────────────────────────────────────────────
if ($uri !== '/' && is_file(__DIR__ . $uri)) {
    return false;
}

// ── 2. Explicit route map ─────────────────────────────────────────────────────
$exact = [
    ''                  => __DIR__ . '/index.php',
    '/'                 => __DIR__ . '/index.php',

    // Auth
    '/auth/login'       => __DIR__ . '/auth/login.php',
    '/auth/register'    => __DIR__ . '/auth/register.php',
    '/auth/logout'      => __DIR__ . '/auth/logout.php',

    // Cart
    '/cart'             => __DIR__ . '/cart/index.php',
    '/cart/add'         => __DIR__ . '/cart/add.php',
    '/cart/update'      => __DIR__ . '/cart/update.php',
    '/cart/remove'      => __DIR__ . '/cart/remove.php',

    // Checkout
    '/checkout'         => __DIR__ . '/checkout/index.php',
    '/checkout/success' => __DIR__ . '/checkout/success.php',
    '/checkout/cancel'  => __DIR__ . '/checkout/cancel.php',

    // Account
    '/account'          => __DIR__ . '/account/index.php',
    '/account/order'    => __DIR__ . '/account/order.php',

    // Installer (remove after first use)
    '/install'          => __DIR__ . '/install.php',
];

if (isset($exact[$path])) {
    require $exact[$path];
    return true;
}

// ── 3. Product page: /product/{slug} ─────────────────────────────────────────
if (preg_match('#^/product/[^/]+$#', $path)) {
    require __DIR__ . '/product.php';
    return true;
}

// ── 4. Game category slugs ────────────────────────────────────────────────────
// Try DB first, fallback to legacy category files for the original 5
$category_slugs = [
    // Original (legacy files kept for reference)
    'cs2'           => __DIR__ . '/cs2/index.php',
    'gta'           => __DIR__ . '/gta/index.php',
    'fivem'         => __DIR__ . '/fivem/index.php',
    'r6'            => __DIR__ . '/r6/index.php',
    'rdr2'          => __DIR__ . '/rdr2/index.php',
    // All others handled by category.php
    'accounts'      => null,
    'spoofer'       => null,
    'fortnite'      => null,
    'tarkov'        => null,
    'marvel-rivals' => null,
    'cod'           => null,
    'arc-raiders'   => null,
    'roblox'        => null,
    'minecraft'     => null,
    'dbd'           => null,
    'discord-bots'  => null,
    'vpn'           => null,
    'spotify'       => null,
    'rust'          => null,
    'battlefield'   => null,
    'sea-of-thieves'=> null,
    'other'         => null,
];

$slug = ltrim($path, '/');
if (isset($category_slugs[$slug])) {
    $game_slug = $slug;
    $file = $category_slugs[$slug] ?? __DIR__ . '/category.php';
    require $file ?: __DIR__ . '/category.php';
    return true;
}

// ── 5. Subdomain routing ─────────────────────────────────────────────────────
$host      = preg_replace('/:\d+$/', '', $_SERVER['HTTP_HOST'] ?? '');
$parts     = explode('.', $host);
$subdomain = count($parts) >= 3 ? strtolower($parts[0]) : '';
if ($subdomain && isset($category_slugs[$subdomain])) {
    $game_slug = $subdomain;
    $file = $category_slugs[$subdomain] ?? null;
    require $file ?: __DIR__ . '/category.php';
    return true;
}

// ── 6. Fallback: homepage ─────────────────────────────────────────────────────
require __DIR__ . '/index.php';
return true;
