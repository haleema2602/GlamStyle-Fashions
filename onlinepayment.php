<?php
$pageTitle = "Online Payment | GlamStyle Fashions";
include 'header.php';
include 'dbconfig.php';

// Dummy payment status - in real case, integrate payment gateway
$paymentStatus = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $card_number = htmlspecialchars(trim($_POST["card_number"]));
    $expiry = htmlspecialchars(trim($_POST["expiry"]));
    $cvv = htmlspecialchars(trim($_POST["cvv"]));
    $amount = floatval($_POST["amount"]);

    if (!empty($name) && !empty($email) && !empty($card_number) && !empty($expiry) && !empty($cvv)) {
        // Simulate successful payment
        $paymentStatus = "success";

        // Insert payment record
        $stmt = $conn->prepare("INSERT INTO payments (name, email, card_number, expiry, amount, status, created_at)
                                VALUES (?, ?, ?, ?, ?, 'Success', NOW())");
        $stmt->execute([$name, $email, $card_number, $expiry, $amount]);
    } else {
        $paymentStatus = "failed";
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center">Online Payment</h2>
    <?php if ($paymentStatus == "success"): ?>
        <div class="alert alert-success">Payment Successful! Thank you for shopping with GlamStyle Fashions.</div>
    <?php elseif ($paymentStatus == "failed"): ?>
        <div class="alert alert-danger">Payment Failed! Please fill all fields correctly.</div>
    <?php endif; ?>

    <form method="POST" action="onlinepayment.php" class="mt-4">
        <div class="mb-3">
            <label for="name" class="form-label">Card Holder Name</label>
            <input type="text" class="form-control" name="name" required />
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email" required />
        </div>

        <div class="mb-3">
            <label for="card_number" class="form-label">Card Number</label>
            <input type="text" class="form-control" name="card_number" maxlength="16" required />
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="expiry" class="form-label">Expiry Date (MM/YY)</label>
                <input type="text" class="form-control" name="expiry" placeholder="MM/YY" required />
            </div>
            <div class="col-md-6 mb-3">
                <label for="cvv" class="form-label">CVV</label>
                <input type="password" class="form-control" name="cvv" maxlength="3" required />
            </div>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount (₹)</label>
            <input type="number" class="form-control" name="amount" required />
        </div>

        <button type="submit" class="btn btn-success w-100">Pay Now</button>
    </form>
</div>

<?php include 'footer.php'; ?>
