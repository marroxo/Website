<?php
/**
 * TGModz Installer
 * Visit /install.php once to create tables and import products.
 * DELETE this file after running it!
 */

// Simple security check - change this token before running
define('INSTALL_TOKEN', 'tgmodz-install-2026');

require_once __DIR__ . '/config/config.php';

$token_ok = ($_GET['token'] ?? '') === INSTALL_TOKEN;
$step     = $_GET['step'] ?? 'home';
$error    = '';
$success  = '';

// ── Category map: WooCommerce category name → slug, icon, color ──────────────
$cat_map = [
    'CS2 Mod Menus'          => ['slug'=>'cs2',           'name'=>'CS2 Mod Menus',      'icon'=>'🎯', 'color'=>'#3b82f6', 'sort'=>1],
    'GTA V'                  => ['slug'=>'gta',           'name'=>'GTA V',              'icon'=>'🏎️', 'color'=>'#f97316', 'sort'=>2],
    'FIVEM MOD MENUS'        => ['slug'=>'fivem',         'name'=>'FiveM Mod Menus',    'icon'=>'🌐', 'color'=>'#06b6d4', 'sort'=>3],
    'Rainbow Six Siege'      => ['slug'=>'r6',            'name'=>'Rainbow Six Siege',  'icon'=>'🔫', 'color'=>'#22c55e', 'sort'=>4],
    'RDR2 Mod Menus'         => ['slug'=>'rdr2',          'name'=>'RDR2 Mod Menus',     'icon'=>'🤠', 'color'=>'#a855f7', 'sort'=>5],
    'Game-Ready Accounts'    => ['slug'=>'accounts',      'name'=>'Game Accounts',      'icon'=>'🎮', 'color'=>'#6366f1', 'sort'=>6],
    'HWID Spoofer'           => ['slug'=>'spoofer',       'name'=>'HWID Spoofer',       'icon'=>'🛡️', 'color'=>'#ef4444', 'sort'=>7],
    'Fortnite'               => ['slug'=>'fortnite',      'name'=>'Fortnite',           'icon'=>'🏆', 'color'=>'#9333ea', 'sort'=>8],
    'Escape from Tarkov'     => ['slug'=>'tarkov',        'name'=>'Escape From Tarkov', 'icon'=>'🔫', 'color'=>'#65a30d', 'sort'=>9],
    'Marvel Rivals'          => ['slug'=>'marvel-rivals', 'name'=>'Marvel Rivals',      'icon'=>'⚡', 'color'=>'#dc2626', 'sort'=>10],
    'Call of Duty'           => ['slug'=>'cod',           'name'=>'Call of Duty',       'icon'=>'💥', 'color'=>'#b45309', 'sort'=>11],
    'ARC Raiders'            => ['slug'=>'arc-raiders',   'name'=>'ARC Raiders',        'icon'=>'🤖', 'color'=>'#0891b2', 'sort'=>12],
    'Roblox'                 => ['slug'=>'roblox',        'name'=>'Roblox',             'icon'=>'🎮', 'color'=>'#dc2626', 'sort'=>13],
    'Minecraft'              => ['slug'=>'minecraft',     'name'=>'Minecraft',          'icon'=>'⛏️', 'color'=>'#16a34a', 'sort'=>14],
    'Dead By Daylight'       => ['slug'=>'dbd',           'name'=>'Dead By Daylight',   'icon'=>'💀', 'color'=>'#7c3aed', 'sort'=>15],
    'Discord Bots'           => ['slug'=>'discord-bots',  'name'=>'Discord Bots',       'icon'=>'🤖', 'color'=>'#5865f2', 'sort'=>16],
    'VPN'                    => ['slug'=>'vpn',           'name'=>'VPN',                'icon'=>'🔒', 'color'=>'#0284c7', 'sort'=>17],
    'Spotify Premium Yearly' => ['slug'=>'spotify',       'name'=>'Spotify Premium',    'icon'=>'🎵', 'color'=>'#1db954', 'sort'=>18],
    'Rust'                   => ['slug'=>'rust',          'name'=>'Rust',               'icon'=>'🔥', 'color'=>'#c2410c', 'sort'=>19],
    'Battlefield'            => ['slug'=>'battlefield',   'name'=>'Battlefield',        'icon'=>'💣', 'color'=>'#854d0e', 'sort'=>20],
    'Sea of Thieves'         => ['slug'=>'sea-of-thieves','name'=>'Sea of Thieves',     'icon'=>'⚓', 'color'=>'#1d4ed8', 'sort'=>21],
    'Uncategorized'          => ['slug'=>'other',         'name'=>'Other',              'icon'=>'🎮', 'color'=>'#64748b', 'sort'=>99],
];

// Featured WC parent IDs (one from each main category for homepage)
$featured_wc_ids = [957, 24451, 1684, 2780, 14597, 25892, 101788, 95166, 100598, 24859, 1598, 135730];

function make_slug(string $name): string {
    $s = strtolower($name);
    $s = preg_replace('/[^a-z0-9\s\-]/', '', $s);
    $s = preg_replace('/[\s\-]+/', '-', trim($s));
    return substr($s, 0, 200);
}

function parse_parent_id(string $parent): ?int {
    if (preg_match('/^id:(\d+)$/', trim($parent), $m)) {
        return (int)$m[1];
    }
    return null;
}

function variation_label(string $full_name, string $parent_name): string {
    $label = trim(str_replace($parent_name, '', $full_name), ' -–');
    return $label ?: $full_name;
}

if ($token_ok && $step === 'run') {
    try {
        // Connect directly (don't use db() wrapper which needs tables)
        $dsn = sprintf('mysql:host=%s;port=%s;charset=utf8mb4', DB_HOST, DB_PORT);
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);

        // Create DB if not exists
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $pdo->exec("USE `" . DB_NAME . "`");

        // Drop & recreate tables
        $pdo->exec("SET FOREIGN_KEY_CHECKS=0");
        foreach (['order_items','orders','users','product_variations','products','categories'] as $t) {
            $pdo->exec("DROP TABLE IF EXISTS `$t`");
        }
        $pdo->exec("SET FOREIGN_KEY_CHECKS=1");

        $sql = file_get_contents(__DIR__ . '/sql/setup.sql');
        foreach (array_filter(array_map('trim', explode(';', $sql))) as $stmt) {
            if ($stmt) $pdo->exec($stmt);
        }

        // ── Insert categories ────────────────────────────────────────────────
        $cat_ids = []; // wc_cat_name => db_id
        foreach ($cat_map as $wc_name => $c) {
            $pdo->prepare("INSERT INTO categories (name,slug,icon,color,sort_order) VALUES (?,?,?,?,?)")
                ->execute([$c['name'], $c['slug'], $c['icon'], $c['color'], $c['sort']]);
            $cat_ids[$wc_name] = $pdo->lastInsertId();
        }

        // ── Parse CSV ────────────────────────────────────────────────────────
        $csv_path = __DIR__ . '/wc-product-export.csv';
        $fh = fopen($csv_path, 'r');
        $headers = fgetcsv($fh);
        // Strip BOM from first header
        $headers[0] = ltrim($headers[0], "\xEF\xBB\xBF\xFF\xFE");

        $rows = [];
        while (($row = fgetcsv($fh)) !== false) {
            if (count($row) === count($headers)) {
                $rows[] = array_combine($headers, $row);
            }
        }
        fclose($fh);

        // ── First pass: parent products & simples ────────────────────────────
        $wc_to_db = []; // wc_id => db product id
        $wc_names = []; // wc_id => product name

        $ins_product = $pdo->prepare("
            INSERT INTO products
              (wc_id, category_id, name, slug, type, price, sale_price,
               short_description, description, image_url, is_in_stock,
               is_featured, badge_label, badge_class, sort_order)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
        ");

        $slug_counts = [];

        foreach ($rows as $row) {
            $type = strtolower($row['Type']);
            if (str_contains($type, 'variation') && str_contains($row['Parent'], 'id:')) {
                continue; // handle in second pass
            }
            if (str_contains($type, 'variable')) $prod_type = 'variable';
            elseif (str_contains($type, 'external')) $prod_type = 'external';
            else $prod_type = 'simple';

            $wc_id    = (int)$row['ID'];
            $name     = trim($row['Name']);
            $cats_raw = trim($row['Categories']);
            $price    = $row['Regular price'] !== '' ? (float)$row['Regular price'] : null;
            $sale     = $row['Sale price']    !== '' ? (float)$row['Sale price']    : null;
            $stock    = strtolower($row['In stock?']) === '1' || strtolower($row['In stock?']) === 'yes';
            $img      = trim($row['Images'] ?? '');
            $short    = strip_tags(trim($row['Short description'] ?? ''));
            $desc     = strip_tags(trim($row['Description'] ?? ''));

            // Determine category
            $cat_id = null;
            foreach (array_keys($cat_map) as $wc_cat) {
                if (str_contains($cats_raw, $wc_cat)) {
                    $cat_id = $cat_ids[$wc_cat];
                    break;
                }
            }
            if (!$cat_id && $cats_raw) {
                $cat_id = $cat_ids['Uncategorized'] ?? null;
            }

            // Unique slug
            $base_slug = make_slug($name);
            $slug = $base_slug;
            $slug_counts[$base_slug] = ($slug_counts[$base_slug] ?? 0) + 1;
            if ($slug_counts[$base_slug] > 1) {
                $slug = $base_slug . '-' . $slug_counts[$base_slug];
            }

            $is_featured = in_array($wc_id, $featured_wc_ids) ? 1 : 0;

            $ins_product->execute([
                $wc_id, $cat_id, $name, $slug, $prod_type,
                $price, $sale,
                $short ?: null, $desc ?: null, $img ?: null,
                $stock ? 1 : 0,
                $is_featured,
                null, null,
                0,
            ]);
            $db_id = $pdo->lastInsertId();
            $wc_to_db[$wc_id] = $db_id;
            $wc_names[$wc_id] = $name;
        }

        // ── Second pass: variations ──────────────────────────────────────────
        $ins_var = $pdo->prepare("
            INSERT INTO product_variations
              (product_id, wc_id, name, price, sale_price, is_in_stock, sort_order)
            VALUES (?,?,?,?,?,?,?)
        ");

        $var_sort = [];
        foreach ($rows as $row) {
            $type = strtolower($row['Type']);
            if (!str_contains($type, 'variation')) continue;
            $parent_wc = parse_parent_id($row['Parent']);
            if (!$parent_wc || !isset($wc_to_db[$parent_wc])) continue;

            $price = $row['Regular price'] !== '' ? (float)$row['Regular price'] : null;
            if ($price === null) continue;

            $wc_id     = (int)$row['ID'];
            $db_parent = $wc_to_db[$parent_wc];
            $parent_nm = $wc_names[$parent_wc] ?? '';
            $label     = variation_label($row['Name'], $parent_nm);
            $sale      = $row['Sale price'] !== '' ? (float)$row['Sale price'] : null;
            $stock     = strtolower($row['In stock?']) === '1' || strtolower($row['In stock?']) === 'yes';
            $sort      = $var_sort[$db_parent] = ($var_sort[$db_parent] ?? 0) + 1;

            $ins_var->execute([$db_parent, $wc_id, $label, $price, $sale, $stock ? 1 : 0, $sort]);
        }

        // ── Count results ────────────────────────────────────────────────────
        $n_cats  = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
        $n_prods = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
        $n_vars  = $pdo->query("SELECT COUNT(*) FROM product_variations")->fetchColumn();

        $success = "✅ Install complete! Created {$n_cats} categories, {$n_prods} products, {$n_vars} variations.";
    } catch (Throwable $e) {
        $error = "❌ Error: " . htmlspecialchars($e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>TGModz Installer</title>
<style>
  body { font-family: monospace; background: #060b18; color: #e8edf5; padding: 40px; }
  h1 { color: #3b82f6; }
  .box { background: #0d1530; border: 1px solid #1e3a5f; border-radius: 10px; padding: 24px; max-width: 600px; }
  .btn { background: #3b82f6; color: #fff; padding: 12px 28px; border-radius: 8px; text-decoration: none; display: inline-block; font-weight: bold; margin-top: 16px; }
  .error   { color: #ef4444; padding: 16px; background: rgba(239,68,68,0.1); border-radius: 8px; margin: 16px 0; }
  .success { color: #22c55e; padding: 16px; background: rgba(34,197,94,0.1); border-radius: 8px; margin: 16px 0; }
  .warn    { color: #f97316; padding: 12px; background: rgba(249,115,22,0.1); border-radius: 8px; margin: 16px 0; }
  code { background: #111d3e; padding: 2px 6px; border-radius: 4px; }
</style>
</head>
<body>
<h1>🛠 TGModz Installer</h1>
<div class="box">
<?php if (!$token_ok): ?>
  <p>Please provide the install token in the URL:</p>
  <code>http://yoursite.com/install.php?token=<?= INSTALL_TOKEN ?>&step=home</code>
<?php elseif ($success): ?>
  <div class="success"><?= $success ?></div>
  <p>✅ Your database is ready. Next steps:</p>
  <ol>
    <li>Add your Stripe API keys to <code>config/config.php</code></li>
    <li>Set your <code>BASE_URL</code></li>
    <li><strong>Delete this file</strong> — <code>install.php</code></li>
  </ol>
  <a href="/" class="btn">Go to Homepage</a>
<?php elseif ($error): ?>
  <div class="error"><?= $error ?></div>
  <a href="?token=<?= INSTALL_TOKEN ?>&step=home" class="btn">Try Again</a>
<?php else: ?>
  <p>This will:</p>
  <ul>
    <li>Create/reset the <code><?= DB_NAME ?></code> database</li>
    <li>Create all tables</li>
    <li>Import all <?= count(array_filter(file(__DIR__.'/wc-product-export.csv'))) - 1 ?> products from the WooCommerce CSV</li>
  </ul>
  <div class="warn">⚠️ This will DROP and recreate all existing tables.</div>
  <a href="?token=<?= INSTALL_TOKEN ?>&step=run" class="btn">Run Install</a>
<?php endif; ?>
</div>
</body>
</html>
