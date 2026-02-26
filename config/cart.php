<?php
/**
 * Session-based cart helper.
 * No DB or login required — cart lives in $_SESSION['cart'].
 */

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_start();
}

// ── Internals ─────────────────────────────────────────────────────────────────

function _cart(): array {
    return $_SESSION['cart'] ?? ['items' => []];
}

function _cart_save(array $cart): void {
    $_SESSION['cart'] = $cart;
}

function _cart_key(int $product_id, ?int $variation_id): string {
    return $product_id . ':' . ($variation_id ?? 0);
}

// ── Public API ────────────────────────────────────────────────────────────────

function cart_add(
    int    $product_id,
    ?int   $variation_id,
    string $product_name,
    ?string $variation_name,
    float  $price,
    string $slug,
    string $cat_icon = '🎮',
    ?string $image_url = null,
    int    $qty = 1
): void {
    $cart = _cart();
    $key  = _cart_key($product_id, $variation_id);

    if (isset($cart['items'][$key])) {
        $cart['items'][$key]['qty'] += $qty;
    } else {
        $cart['items'][$key] = compact(
            'product_id', 'variation_id', 'product_name',
            'variation_name', 'price', 'slug', 'cat_icon', 'image_url', 'qty'
        );
    }
    _cart_save($cart);
}

function cart_remove(string $key): void {
    $cart = _cart();
    unset($cart['items'][$key]);
    _cart_save($cart);
}

function cart_update(string $key, int $qty): void {
    $cart = _cart();
    if ($qty <= 0) {
        unset($cart['items'][$key]);
    } elseif (isset($cart['items'][$key])) {
        $cart['items'][$key]['qty'] = $qty;
    }
    _cart_save($cart);
}

function cart_clear(): void {
    $_SESSION['cart'] = ['items' => []];
}

function cart_items(): array {
    return _cart()['items'];
}

function cart_count(): int {
    $total = 0;
    foreach (cart_items() as $item) {
        $total += $item['qty'];
    }
    return $total;
}

function cart_total(): float {
    $total = 0;
    foreach (cart_items() as $item) {
        $total += $item['price'] * $item['qty'];
    }
    return $total;
}

function cart_is_empty(): bool {
    return empty(cart_items());
}
