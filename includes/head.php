<?php
// Usage: set $page_title, $page_desc, $active_page before including
$page_title = $page_title ?? 'TGModz — Premium Gaming Software';
$page_desc  = $page_desc  ?? 'TGModz — authorized reseller of premium game enhancement software. Trusted by 100,000+ gamers since 2021.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?></title>
<meta name="description" content="<?= htmlspecialchars($page_desc) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="dns-prefetch" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
