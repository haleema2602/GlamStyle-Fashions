<?php
$pageTitle = "Manage Orders | GlamStyle Fashions";
include 'header.php';
include 'dbconfig.php';

// Handle Delete Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_order_id'])) {
    $deleteId = $_POST['delete_order_id'];
    try {
        $deleteStmt = $conn->prepare("DELETE FROM orders WHERE id = :id");
        $deleteStmt->execute(['id' => $deleteId]);
        header("Location: manageorders.php");
        exit;
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error deleting order: " . $e->getMessage() . "</div>";
    }
}

// Fetch all orders
try {
    $stmt = $conn->prepare("SELECT * FROM orders ORDER BY order_date DESC");
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching orders: " . $e->getMessage());
}
?>

<!-- Bootstrap + Google Fonts -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<!-- Custom CSS -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to right, #f9f9f9, #eef3fc);
    }
    h2 {
        color: #6f42c1;
        font-weight: bold;
    }
    .btn-primary {
        background-color: #6f42c1;
        border: none;
        font-weight: 500;
    }
    .btn-primary:hover {
        background-color: #5a32a3;
    }
    .table th, .table td {
        vertical-align: middle !important;
        font-size: 14px;
    }
    .table img {
        border-radius: 6px;
    }
    .delete-form {
        display: inline;
    }
</style>

<div class="container mt-5">
    <h2 class="text-center mb-4">Orders History</h2>

    <!-- Back to Dashboard Button -->
    <div class="mb-4 text-start">
        <a href="admindashboard.php" class="btn btn-primary">← Back to Dashboard</a>
    </div>

    <?php if (count($orders) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Id</th>
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
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($orders as $index => $order): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($order['product_title']) ?></td>
                            <td><img src="<?= htmlspecialchars($order['product_image']) ?>" alt="Product Image" style="width: 60px; height: 60px; object-fit: cover;"></td>
                            <td>₹<?= number_format($order['product_price'], 2) ?></td>
                            <td><?= htmlspecialchars($order['customer_name']) ?></td>
                            <td><?= htmlspecialchars($order['size']) ?></td>
                            <td><?= htmlspecialchars($order['customer_contact']) ?></td>
                            <td><?= nl2br(htmlspecialchars($order['customer_address'])) ?></td>
                            <td><?= htmlspecialchars($order['payment_method']) ?></td>
                            <td><?= htmlspecialchars($order['payment_id']) ?></td>
                            <td><?= date('d-M-Y h:i A', strtotime($order['order_date'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">No orders found.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
