<?php
/**
 * POST /cart/add
 * Adds a product (+ optional variation) to the session cart.
 */
require_once __DIR__ . '/../config/cart.php';
require_once __DIR__ . '/../config/db.php';

header('Content-Type: application/json');

$product_id   = (int)($_POST['product_id']   ?? 0);
$variation_id = (int)($_POST['variation_id'] ?? 0) ?: null;
$qty          = max(1, (int)($_POST['qty'] ?? 1));

if (!$product_id) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Missing product_id']);
    exit;
}

try {
    $product = db_row(
        "SELECT p.*, c.icon AS cat_icon FROM products p
         LEFT JOIN categories c ON c.id = p.category_id
         WHERE p.id = ? AND p.is_active = 1", [$product_id]
    );

    if (!$product) {
        http_response_code(404);
        echo json_encode(['ok' => false, 'error' => 'Product not found']);
        exit;
    }

    $price          = null;
    $variation_name = null;

    if ($variation_id) {
        $var = db_row(
            "SELECT * FROM product_variations WHERE id = ? AND product_id = ?",
            [$variation_id, $product_id]
        );
        if (!$var) {
            http_response_code(400);
            echo json_encode(['ok' => false, 'error' => 'Invalid variation']);
            exit;
        }
        $price          = (float)($var['sale_price'] ?: $var['price']);
        $variation_name = $var['name'];
    } else {
        $price = (float)($product['sale_price'] ?: $product['price']);
    }

    cart_add(
        $product_id,
        $variation_id,
        $product['name'],
        $variation_name,
        $price,
        $product['slug'],
        $product['cat_icon'] ?? '🎮',
        $product['image_url'] ?? null,
        $qty
    );

    echo json_encode([
        'ok'         => true,
        'cart_count' => cart_count(),
        'cart_total' => cart_total(),
        'message'    => htmlspecialchars($product['name']) . ' added to cart!',
    ]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Server error']);
}
