<?php 
$pageTitle = "Product | GlamStyle Fashion";
include 'header.php';
include 'dbconfig.php';
?>

<!-- CSS STYLING SECTION -->
<style>
  body {
    background-color: #f8f9fa;
  }

  .about-section h2 {
    font-weight: 700;
    color: #5a189a;
    margin-bottom: 1rem;
    
  }

  hr {
    width: 80px;
    border: 2px solid #d63384;
    margin: 1rem auto 2rem;
  }

  .card {
    border-radius: 15px;
    transition: transform 0.3s, box-shadow 0.3s;
    overflow: hidden;
    border: none;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(214, 51, 132, 0.2);
  }

  .card-img-top {
    height: 300px;
    object-fit: cover;
    border-bottom: 2px solid #d63384;
  }

  .card-title {
    font-weight: 600;
    color: #d63384;
  }

  .card-text {
    color: #555;
    font-size: 0.95rem;
    min-height: 70px;
  }

  .btn-success {
    background-color: #d63384;
    border: none;
  }

  .btn-success:hover {
    background-color: #c21868;
  }

  .rating {
    font-size: 1rem;
    color: #ffc107;
    letter-spacing: 1px;
  }

  @media (max-width: 768px) {
    .card-img-top {
      height: 200px;
    }
  }
</style>

    
<!-- PRODUCTS SECTION -->
<div class="container-fluid p-5 text-center" bg-light>
  <div class="container about-section mb-4" data-aos="fade-right">
        <h2 class="text-center mb-1">PRODUCTS</h2>
    
    <!-- Back to Dashboard Button -->
    <div class="mb-4 text-start">
        <a href="userdashboard.php" class="btn btn-primary">← Back to Dashboard</a>
    </div>

    <div class="row">
      <?php
      try {
        $stmt = $conn->prepare("SELECT id, image, price, title, description, quantity FROM products");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
      }

      foreach ($products as $index => $product) {
        echo '
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="' . htmlspecialchars($product["image"]) . '" class="card-img-top" alt="' . htmlspecialchars($product["title"]) . '">
            <div class="card-body">
              <h5 class="card-title">' . htmlspecialchars($product["title"]) . '</h5>
              <p class="card-text">' . htmlspecialchars($product["description"]) . '</p>
              <p class="card-text mb-1"><strong>₹' . htmlspecialchars($product["price"]) . '</strong></p>
              <p class="rating">★ ★ ★ ★ ☆</p>
              <a href="addtocart.php?id=' . urlencode($product["id"]) . '" class="btn btn-success btn-sm me-2">🛒 Add to Cart</a>
              <a href="buynow.php?title=' . urlencode($product["title"]) . '&price=' . urlencode($product["price"]) . '&img=' . urlencode($product["image"]) . '" class="btn btn-success btn-sm">⚡ Buy Now</a>
            </div>
          </div>
        </div>';

        // Create new row every 3 cards for layout
        if (($index + 1) % 3 == 0 && $index != count($products) - 1) {
          echo '</div><div class="row">';
        }
      }
      ?>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>   