<?php
require_once __DIR__ . '/../config/cart.php';
header('Content-Type: application/json');

$key = $_POST['key'] ?? '';
if ($key === '') {
    http_response_code(400);
    echo json_encode(['ok' => false]);
    exit;
}

cart_remove($key);

echo json_encode([
    'ok'         => true,
    'cart_count' => cart_count(),
    'cart_total' => number_format(cart_total(), 2),
]);
