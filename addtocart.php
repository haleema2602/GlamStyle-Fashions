<?php
session_start();
include 'dbconfig.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: product.php");
    exit();
}

$productId = intval($_GET['id']);

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if product is already in cart
$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['id'] == $productId) {
        $item['quantity'] += 1; // increase quantity if exists
        $found = true;
        break;
    }
}

if (!$found) {
    // Get product details from DB
    $stmt = $conn->prepare("SELECT id, title, price FROM products WHERE id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $product['quantity'] = 1; // default quantity
        $_SESSION['cart'][] = $product;
    }
}

header("Location: cart.php");
exit();
?>