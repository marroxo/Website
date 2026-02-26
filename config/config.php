<?php
// ── TGModz Configuration ─────────────────────────────────────────────────────
// Copy this file to config/config.local.php and override values there,
// OR set environment variables on your server.

// Database
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'tgmodz');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_PORT', getenv('DB_PORT') ?: '3306');

// Site
define('BASE_URL',    rtrim(getenv('BASE_URL') ?: 'http://45.11.229.217:3001', '/'));
define('SITE_NAME',   'TGModz');
define('SITE_EMAIL',  getenv('SITE_EMAIL') ?: 'support@tgmodz.com');
define('DISCORD_URL', 'https://discord.gg/tgmodz');

// Sessions
define('SESSION_NAME', 'tgmodz_session');

// Override with local config if present
$local = __DIR__ . '/config.local.php';
if (file_exists($local)) require $local;
