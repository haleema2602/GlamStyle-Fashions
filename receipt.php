<?php
include 'header.php';
include 'dbconfig.php'; // Your PDO DB connection

// 1. Get order ID from GET request
$order_id = isset($_GET['order_id']) ? (int) $_GET['order_id'] : 0;

if ($order_id <= 0) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Invalid order ID.</div></div>";
    exit;
}

try {
    // 2. Fetch order details
    $stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->execute([$order_id]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        echo "<div class='container mt-5'><div class='alert alert-warning'>Order not found.</div></div>";
        exit;
    }

    // 3. Fetch ordered items and product details
    $stmt = $conn->prepare("
        SELECT oi.quantity, oi.subtotal, p.title, p.price
        FROM order_items oi
        JOIN product p ON oi.product_id = p.id
        WHERE oi.orders_id = ?
    ");
    $stmt->execute([$order_id]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Error: " . htmlspecialchars($e->getMessage()) . "</div></div>";
    exit;
}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Receipt - Order #<?= htmlspecialchars($order_id) ?></h4>
        </div>
        <div class="card-body">
            <p><strong>Order Date:</strong> <?= htmlspecialchars($order['order_date']) ?></p>
            <p><strong>Payment Method:</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
            <p><strong>Payment Status:</strong> <?= htmlspecialchars($order['payment_status']) ?></p>
            <p><strong>Order Status:</strong> <?= htmlspecialchars($order['order_status']) ?></p>

            <h5 class="mt-4">Items:</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Unit Price (₹)</th>
                        <th>Quantity</th>
                        <th>Subtotal (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['title']) ?></td>
                            <td>₹<?= number_format($item['price'], 2) ?></td>
                            <td><?= (int) $item['quantity'] ?></td>
                            <td>₹<?= number_format($item['subtotal'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h5 class="text-end">Total: ₹<?= number_format($order['total_amount'], 2) ?></h5>

            <div class="text-center mt-4">
                <!-- <a href="productcatalog.php" class="btn btn-primary">Continue Shopping</a> -->
                <button class="btn btn-secondary" onclick="window.print()">Print Receipt</button>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>