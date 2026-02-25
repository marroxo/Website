<?php
/**
 * TGModz PHP Router
 * Used with: php -S 0.0.0.0:3001 router.php
 *
 * Handles:
 *   - Subdomain routing (cs2.domain.com → /cs2/index.php)
 *   - Path routing     (/cs2 → /cs2/index.php)
 *   - Static files     (.css, .js, .png, .ico, etc.)
 *   - Fallback         → /index.php
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rawurldecode($uri);

// ── 1. Serve real static files ───────────────────────────────────────────────
if ($uri !== '/' && is_file(__DIR__ . $uri)) {
    return false; // Let PHP built-in server handle the file
}

// ── 2. Subdomain routing ─────────────────────────────────────────────────────
$host      = $_SERVER['HTTP_HOST'] ?? '';
$host_base = preg_replace('/:\d+$/', '', $host); // strip port
$parts     = explode('.', $host_base);
$subdomain = count($parts) >= 3 ? strtolower($parts[0]) : '';

$subdomain_map = [
    'cs2'   => __DIR__ . '/cs2/index.php',
    'gta'   => __DIR__ . '/gta/index.php',
    'fivem' => __DIR__ . '/fivem/index.php',
    'r6'    => __DIR__ . '/r6/index.php',
    'rdr2'  => __DIR__ . '/rdr2/index.php',
];

if ($subdomain && isset($subdomain_map[$subdomain])) {
    require $subdomain_map[$subdomain];
    return true;
}

// ── 3. Path-based routing ────────────────────────────────────────────────────
$path = rtrim($uri, '/');

$path_map = [
    '/cs2'   => __DIR__ . '/cs2/index.php',
    '/gta'   => __DIR__ . '/gta/index.php',
    '/fivem' => __DIR__ . '/fivem/index.php',
    '/r6'    => __DIR__ . '/r6/index.php',
    '/rdr2'  => __DIR__ . '/rdr2/index.php',
];

if (isset($path_map[$path])) {
    require $path_map[$path];
    return true;
}

// ── 4. Index / fallback ──────────────────────────────────────────────────────
require __DIR__ . '/index.php';
return true;
