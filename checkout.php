<?php
$pageTitle = "Proceed to checkout | GlamStyle Fashion";
include 'header.php';
include 'dbconfig.php';

// If cart is empty
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    echo "<div class='container text-center py-5'><h4>Your cart is empty.</h4><a href='product.php' class='btn btn-primary mt-3'>Continue Shopping</a></div>";
    include 'footer.php';
    exit;
}
?>

<div class="container py-5">
    <h2 class="text-center mb-4">Checkout</h2>

    <form action="placeorder.php" method="POST">
        <div class="row">
            <!-- Shipping Address -->
            <div class="col-md-6">
                <h4>Shipping Information</h4>
                <div class="mb-3">
                    <label for="shipping" class="form-label">Shipping Address</label>
                    <textarea name="shipping" id="shipping" class="form-control" rows="3" required></textarea>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-md-6">
                <h4>Order Summary</h4>
                <ul class="list-group mb-3">
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $title = htmlspecialchars($item['title']);
                        $desc = htmlspecialchars($item['desc']);
                        $price = floatval($item['price']);
                        $qty = intval($item['quantity']);
                        $subtotal = $price * $qty;
                        $total += $subtotal;
                        echo "<li class='list-group-item d-flex justify-content-between lh-sm'>
                                <div>
                                    <h6 class='my-0'>$title × $qty</h6>
                                    <small class='text-muted'>$desc</small>
                                </div>
                                <span class='text-muted'>₹" . number_format($subtotal, 2) . "</span>
                              </li>";
                    }
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Total</strong>
                        <strong>₹<?= number_format($total, 2) ?></strong>
                    </li>
                </ul>
                <button type="submit" class="btn btn-success w-100">Place Order</button>
            </div>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
