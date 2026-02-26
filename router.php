<?php
/**
 * TGModz PHP Router
 * Usage: php -S 0.0.0.0:3001 router.php
 */

$uri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri  = rawurldecode($uri);
$path = rtrim($uri, '/');

// ── 1. Serve real static files (CSS, images, fonts, etc.) ────────────────────
if ($uri !== '/' && is_file(__DIR__ . $uri)) {
    return false;
}

// ── 2. Exact routes ───────────────────────────────────────────────────────────
$routes = [
    ''      => __DIR__ . '/index.php',
    '/'     => __DIR__ . '/index.php',
    '/shop' => __DIR__ . '/shop.php',
];

if (isset($routes[$path])) {
    require $routes[$path];
    return true;
}

// ── 3. Product pages: /product/{slug} ────────────────────────────────────────
if (preg_match('#^/product/[a-z0-9\-]+$#', $path)) {
    require __DIR__ . '/product.php';
    return true;
}

// ── 4. Catch-all: homepage ────────────────────────────────────────────────────
http_response_code(404);
require __DIR__ . '/index.php';
return true;
