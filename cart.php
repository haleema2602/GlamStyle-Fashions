<?php  
$pageTitle = "My Cart | GlamStyle Fashion";
include 'header.php';
include 'dbconfig.php';
?>

<!-- (CSS same as before...) -->
 <style>
  body {
      .about-section h2 {
    font-weight: 700;
    color: #5a189a;
    margin-bottom: 1rem;
    /* Removed pink underline */
  }
}
</style>

<div class="container-fluid p-5 text-center bg-light">
  <div class="container about-section mb-4" data-aos="fade-right">
    <h2 class="text-center mb-1">MY CART</h2>
    
<!-- Back to Dashboard Button -->
    <div class="text-start mb-4">
      <a href="userdashboard.php" class="btn btn-primary btn-sm">← Back to Dashboard</a>
    </div>

    <?php
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
        echo "<div class='alert alert-info text-center'>Your cart is empty.</div>";
    } else {
        $ids = array_column($_SESSION['cart'], 'id');
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        try {
            $stmt = $conn->prepare("SELECT id, title, description, quantity, price, image FROM products WHERE id IN ($placeholders)");
            $stmt->execute($ids);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        }

        $total = 0;
        ?>
        <form action="buynow.php" method="POST">
            <div class="row">
                <?php
                foreach ($products as $item) {
                    $itemId = $item['id'];
                    $cartItem = array_filter($_SESSION['cart'], fn($c) => $c['id'] == $itemId);
                    $cartItem = array_values($cartItem)[0];

                    $selectedQuantity = $cartItem['quantity'];
                    $price = floatval($item['price']);
                    $subtotal = $price * $selectedQuantity;
                    $total += $subtotal;
                    ?>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <img src="<?= htmlspecialchars($item['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['title']) ?>" style="height: 200px; object-fit: contain;">
                            <div class="card-body">
                                <h5 class="card-title text-dark"><?= htmlspecialchars($item['title']) ?></h5>
                                <p class="card-text text-dark"><strong>Price:</strong> ₹<?= number_format($price, 2) ?></p>
                                <p class="card-text text-dark"><strong>Selected Quantity:</strong> <?= $selectedQuantity ?></p>
                                <p class="card-text text-dark"><strong>Available Stock:</strong> <?= htmlspecialchars($item['quantity']) ?></p>
                                <p class="card-text text-dark"><strong>Subtotal:</strong> ₹<?= number_format($subtotal, 2) ?></p>

                                <a href="removefromcart.php?id=<?= htmlspecialchars($itemId) ?>" class="btn btn-outline-danger mt-2">Remove From Cart</a>

                                <input type="hidden" name="product_ids[]" value="<?= htmlspecialchars($itemId) ?>">
                                <input type="hidden" name="quantities[]" value="<?= htmlspecialchars($selectedQuantity) ?>">
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="row">
                <div class="col-12 mt-4">
                    <h4>Total: ₹<?= number_format($total, 2) ?></h4>
                    <button type="submit" class="btn btn-checkout mt-3">Proceed to Buy Now</button>
                </div>
            </div>
        </form>
    <?php } ?>
  </div>
</div>

<?php include 'footer.php'; ?>