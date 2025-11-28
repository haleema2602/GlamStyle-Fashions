<?php
$pageTitle = "Cancel Orders | GlamStyle Fashions";
include 'header.php';
include 'dbconfig.php';

// Handle Cancel/Delete Order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order_id'])) {
    $cancelId = $_POST['cancel_order_id'];
    try {
        $cancelStmt = $conn->prepare("DELETE FROM orders WHERE id = :id");
        $cancelStmt->execute(['id' => $cancelId]);
        echo "<div class='alert alert-success text-center'>Order cancelled successfully.</div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger text-center'>Error cancelling order: " . $e->getMessage() . "</div>";
    }
}

// Fetch all orders
try {
    $stmt = $conn->prepare("SELECT * FROM orders ORDER BY order_date DESC");
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("<div class='alert alert-danger'>Error fetching orders: " . $e->getMessage() . "</div>");
}
?>

<div class="container-fluid p-5 text-center bg-light">
  <div= data-aos="fade-right">
    <h2 class="text-center mb-1"style="color: #5a189a;">CANCEL ORDERS</h2>
    


    
      
    <!-- Back to Dashboard Button -->
    <div class="text-start mb-4">
      <a href="userdashboard.php" class="btn btn-primary btn-sm">← Back to Dashboard</a>
    </div>

    <?php if (count($orders) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>id</th>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Customer Name</th>
                        <th>Size</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Payment</th>
                        <th>Payment ID</th>
                        <th>Order Date</th>
                        <th>Cancel</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $index => $order): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($order['product_title']) ?></td>
                            <td>
                                <img src="<?= htmlspecialchars($order['product_image']) ?>" style="width: 60px; height: 60px; object-fit: cover;" alt="Product">
                            </td>
                            <td>₹<?= number_format($order['product_price'], 2) ?></td>
                            <td><?= htmlspecialchars($order['customer_name']) ?></td>
                               <td><?= htmlspecialchars($order['size']) ?></td>
                            <td><?= htmlspecialchars($order['customer_contact']) ?></td>
                            <td><?= nl2br(htmlspecialchars($order['customer_address'])) ?></td>
                            <td><?= htmlspecialchars($order['payment_method']) ?></td>
                               <td><?= htmlspecialchars($order['payment_id']) ?></td>
                            <td><?= date('d-M-Y h:i A', strtotime($order['order_date'])) ?></td>
                            <td>
                                <form method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                    <input type="hidden" name="cancel_order_id" value="<?= $order['id'] ?>">
                                    <button type="submit" class="btn btn-warning btn-sm">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">No orders found to cancel.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
