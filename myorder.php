<?php
$pageTitle = "My Orders | GlamStyle Fashion";
include 'header.php';
include 'dbconfig.php';

// Replace this with session-based user ID after login is implemented
$user_id = 1;

// Fetch all orders for this user
$stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid p-5 text-center" style="background-color: mistyrose;">
    <div class="container about-section mb-4" data-aos="fade-right">
        <h2 class="text-center mb-4">MY ORDERS</h2>
        <hr class="mx-auto" style="width: 120px; border: 2px solid pink;">
    </div>
</div>

<div class="container mb-5">
    <?php if (count($orders) > 0): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($orders as $order): ?>
                <div class="col">
                    <div class="card h-100 shadow rounded">
                        <img src="<?= htmlspecialchars($order['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($order['title']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($order['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($order['description']) ?></p>
                            <p class="text-success fw-bold">Price: ₹<?= htmlspecialchars($order['price']) ?></p>
                            <p class="text-muted">Shipping: <?= htmlspecialchars($order['shipping_method']) ?></p>
                            <p class="text-muted small">Order ID: #<?= $order['id'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center mt-4">You have not placed any orders yet.</div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>