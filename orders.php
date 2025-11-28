<?php  
$pageTitle = "All Orders History | GlamStyle Fashions";
include 'header.php';
include 'dbconfig.php';

$orders = [];
$errorMsg = '';

try {
    $stmt = $conn->prepare("SELECT * FROM orders ORDER BY id DESC");
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$orders) {
        $errorMsg = "No orders found.";
    }
} catch (PDOException $e) {
    $errorMsg = "Error fetching orders: " . $e->getMessage();
}
?>

<!-- ===== Custom CSS Style ===== -->
<style>
    body {
        background-color: #fdfdff;
        font-family: 'Segoe UI', sans-serif;
    }

    h2 {
        font-weight: 700;
        color: #d63384;
        border-bottom: 3px solid #d63384;
        display: inline-block;
        padding-bottom: 5px;
        margin-bottom: 25px;
    }

    .table {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .table thead {
        background-color: #343a40;
        color: #fff;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .table img {
        border: 2px solid #dee2e6;
        padding: 3px;
    }

    .alert-warning {
        background-color: #ffe0ed;
        color: #d63384;
        font-weight: bold;
    }

    .container {
        max-width: 1200px;
    }

    @media (max-width: 768px) {
        h2 {
            font-size: 24px;
        }

        .table td, .table th {
            font-size: 14px;
        }
    }
</style>

<!-- ===== Page Content ===== -->
<div class="container my-5">
    <h2 class="text-center">All Orders History</h2>

    <?php if ($errorMsg): ?>
        <div class="alert alert-warning text-center"><?= htmlspecialchars($errorMsg) ?></div>
    <?php endif; ?>

    <?php if ($orders): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Order Id</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Product</th>
                        <th>Price (₹)</th>
                        <th>Payment</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= $order['id'] ?></td>
                            <td><?= htmlspecialchars($order['customer_name']) ?></td>
                            <td><?= htmlspecialchars($order['customer_contact']) ?></td>
                            <td><?= htmlspecialchars($order['customer_address']) ?></td>
                            <td>
                                <img src="<?= htmlspecialchars($order['product_image']) ?>" alt="<?= htmlspecialchars($order['product_title']) ?>" style="width:60px; height:60px; object-fit:cover; border-radius:5px;"><br>
                                <?= htmlspecialchars($order['product_title']) ?>
                            </td>
                            <td>₹<?= number_format($order['product_price'], 2) ?></td>
                            <td><?= htmlspecialchars($order['payment_method']) ?></td>
                            <td><?= date('d M Y, h:i A', strtotime($order['order_date'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?> 
