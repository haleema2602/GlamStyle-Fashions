<?php
include 'header.php';
include 'dbconfig.php';

$payment_id = $_GET['payment_id'] ?? '';
$title = $_GET['title'] ?? 'Unknown';
$price = $_GET['price'] ?? 0;

if (!empty($payment_id)) {
    // Save to DB
    $stmt = $conn->prepare("INSERT INTO payments (payment_id, status) VALUES (?, 'Success')");
    $stmt->execute([$payment_id]);

    echo "<div class='container py-5'>
            <h3 class='text-success'>Payment Successful!</h3>
            <p><strong>Payment ID:</strong> $payment_id</p>
            <p><strong>Product:</strong> $title</p>
            <p><strong>Amount Paid:</strong> ₹$price</p>
          </div>";
} else {
    echo "<div class='container py-5'><h3 class='text-danger'>Payment failed or cancelled!</h3></div>";
}
?>
