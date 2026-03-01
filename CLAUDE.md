# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Running Locally

```bash
php -S 0.0.0.0:3001 router.php
```

## Deploying

```bash
bash ~/deploy.sh
```

The deploy script pulls from `marroxo/Website` (main branch), ensures PHP is installed, and restarts the PM2 process named `"tgmodz"` on port 3001. The GitHub token is stored at `~/.tgmodz_ghtoken`.

## Architecture

**No database, no framework, no build step.** Product data lives entirely in `data/products.php` as a PHP associative array keyed by slug.

### Routing

`router.php` is the PHP built-in server entry point. It handles:
- Static files (CSS, images) — served directly
- `/` and `/shop` — exact matches to `index.php` / `shop.php`
- `/product/{slug}` — matched via regex `#^/product/[a-z0-9\-]+$#`, served by `product.php`
- Everything else — 404, redirects to homepage

### Page Structure

Every page follows this pattern:
```php
include 'includes/head.php';   // Set $page_title, $page_desc, $active_page before this
include 'includes/nav.php';
// page content
include 'includes/footer.php'; // Contains all client-side JS (scroll reveal, counters, FAQ accordion)
```

### Product Data (`data/products.php`)

Returns an associative array. Each entry has: `slug`, `name`, `game`, `game_slug`, `game_color`, `game_icon`, `category`, `tagline`, `description`, `badge`, `badge_class`, `image_url`, `price_from`, `price_orig`, `in_stock`, `sold_today`, `rating`, `review_count`, `cta_text`, `features[]`, `plans[]`.

To add a product: add an entry to `data/products.php`. It will automatically appear in the shop, on the homepage featured grid, and be routable at `/product/{slug}`.

### Styling (`assets/css/main.css`)

Design uses CSS custom properties defined at `:root`. Key variables: `--blue-hi`, `--gold`, `--green`, `--surface`, `--surface2`, `--glass-bg`, `--glass-blur`, `--glass-border`. Glassmorphism is the primary aesthetic. All interactive JS (hamburger menu, navbar scroll effect) is in `includes/nav.php` and `includes/footer.php`.

### Security

- All output uses `htmlspecialchars()`
- URL slugs validated with `preg_replace('/[^a-z0-9\-]/', '', strtolower(...))`
- No database, no file uploads — attack surface is minimal
