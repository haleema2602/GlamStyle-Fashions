<?php 
$pageTitle = "Place Order | GlamStyle Fashions";
include 'dbconfig.php'; // Make sure this file initializes the $conn PDO object

function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productTitle        = clean_input($_POST['title'] ?? '');
    $productPrice        = floatval($_POST['price'] ?? 0);
    $productImage        = clean_input($_POST['image'] ?? '');
    $paymentMethod       = clean_input($_POST['payment'] ?? 'COD');
    $customerName        = clean_input($_POST['fullname'] ?? '');
    $customerContact     = clean_input($_POST['phone'] ?? '');
    $customerAddress     = clean_input($_POST['address'] ?? '');
    $razorpayPaymentId   = clean_input($_POST['razorpay_payment_id'] ?? '');
    $productSize         = clean_input($_POST['size'] ?? '');

    try {
        // Insert order into database
        $stmt = $conn->prepare("INSERT INTO orders 
            (product_title, product_price, product_image, customer_name, customer_contact, customer_address, payment_method, total_amount, payment_id, size)
            VALUES 
            (:product_title, :product_price, :product_image, :customer_name, :customer_contact, :customer_address, :payment_method, :total_amount, :payment_id, :size)");

        $stmt->execute([
            ':product_title'     => $productTitle,
            ':product_price'     => $productPrice,
            ':product_image'     => $productImage,
            ':customer_name'     => $customerName,
            ':customer_contact'  => $customerContact,
            ':customer_address'  => $customerAddress,
            ':payment_method'    => $paymentMethod,
            ':total_amount'      => $productPrice,
            ':payment_id'        => $razorpayPaymentId,
            ':size'              => $productSize
        ]);

        $orderSuccess = true;
    } catch (PDOException $e) {
        $orderSuccess = false;
        $errorMsg = "Database error: " . $e->getMessage();
    }
} else {
    $orderSuccess = false;
    $errorMsg = "Invalid request method.";
}
?>

<?php include 'header.php'; ?>

<div class="container my-5">
    <?php if ($orderSuccess): ?>
        <div class="alert alert-success text-center">
            <h4>✅ Order Placed Successfully!</h4>
            <p>Thank you, <?= htmlspecialchars($customerName) ?>. Your order has been placed!</p>
        </div>

        <div class="card mx-auto" style="max-width: 700px;">
            <div class="row g-0">
                <div class="col-md-4 p-3">
                    <img src="<?= htmlspecialchars($productImage) ?>" class="img-fluid rounded shadow" alt="Product Image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($productTitle) ?></h5>
                        <p><strong>Price:</strong> ₹<?= number_format($productPrice, 2) ?></p>
                        <p><strong>Size:</strong> <?= htmlspecialchars($productSize) ?></p>
                        <p><strong>Payment Method:</strong> <?= htmlspecialchars($paymentMethod) ?></p>
                        <?php if (!empty($razorpayPaymentId)): ?>
                            <p><strong>Payment ID:</strong> <?= htmlspecialchars($razorpayPaymentId) ?></p>
                        <?php endif; ?>
                        <hr>
                        <p><strong>Deliver to:</strong><br>
                           <?= htmlspecialchars($customerName) ?><br>
                           <?= htmlspecialchars($customerContact) ?><br>
                           <?= nl2br(htmlspecialchars($customerAddress)) ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger text-center">
            <h4>❌ Order Failed</h4>
            <p><?= $errorMsg ?></p>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
