<?php
$pageTitle = "Product Details | GlamStyle Fashion";
include 'header.php';
include 'dbconfig.php';

// Sample product list — must match product.php exactly

  
try {
    $stmt = $conn->prepare("SELECT img, price, title, description FROM products");
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Optional: Print or inspect the array
    // echo "<pre>"; print_r($products); echo "</pre>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Get the product title from the URL
$selectedProductTitle = isset($_GET['product']) ? urldecode($_GET['product']) : null;

// Find product
$selectedProduct = null;
foreach ($products as $product) {
    if ($product['title'] === $selectedProductTitle) {
        $selectedProduct = $product;
        break;
    }
}
?>

<div class="container py-5">
  <?php if ($selectedProduct): ?>
    <div class="row">
      <div class="col-md-6">
        <img src="<?= $selectedProduct['img'] ?>" class="img-fluid border rounded shadow" alt="<?= $selectedProduct['title'] ?>">
      </div>
      <div class="col-md-6">
        <h2><?= $selectedProduct['title'] ?></h2>
        <p class="text-muted"><?= $selectedProduct['desc'] ?></p>
        <h4 class="text-danger"><?= $selectedProduct['price'] ?></h4>
        <a href="cart.php" class="btn btn-dark mt-3">Add to Cart</a>
        <a href="addtowishlist.php" class="btn btn-outline-secondary mt-3 ms-2">Add to Wishlist</a>
      </div>
    </div>
  <?php else: ?>
    <div class="alert alert-warning text-center">
      Product not found.
    </div>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
