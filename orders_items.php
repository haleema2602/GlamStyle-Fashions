<?php
$pageTitle = "My Orders | GlamStyle Fashion";
include 'header.php';
?>

<div class="container-fluid p-5 text-pink text-center" style="background-color: mistyrose !important">
  <div class="container about-section mb-4" data-aos="fade-right">
    <h2 class="text-center mb-4">MY ORDERS</h2>
    <hr class="mx-auto my-4" style="width: 80%;">

    <?php
    // Product catalog (simulated database)
    $products = [
      ["img" => "img/product-1.jpg", "price" => "₹200.00", "title" => "Chic Summer Top", "desc" => "Light & breezy, perfect for sunny days."],
      ["img" => "img/product-2.jpg", "price" => "₹500.00", "title" => "Elegant Evening Frock", "desc" => "Perfect for a night out."],
      ["img" => "img/product-3.jpg", "price" => "₹999.00", "title" => "Smart Watch", "desc" => "Stay connected in style with this sleek smartwatch."],
      ["img" => "img/product-4.jpg", "price" => "₹850.00", "title" => "Elegant Vision Spectacles", "desc" => "Redefine your style with these lightweight spectacles."],
      ["img" => "img/product-5.jpg", "price" => "₹350.00", "title" => "T-shirt", "desc" => "Comfort meets style in this soft, breathable T-shirt."],
      ["img" => "img/product-6.jpg", "price" => "₹499.00", "title" => "HeadPhones", "desc" => "Experience crystal-clear sound and deep bass."],
      ["img" => "img/product-7.jpg", "price" => "₹1400.00", "title" => "Purse", "desc" => "Compact and stylish."],
      ["img" => "img/product-8.jpg", "price" => "₹1900.00", "title" => "Earrings", "desc" => "Shine with these classic earrings."],
      ["img" => "img/product-9.jpg", "price" => "₹1500.00", "title" => "High-heels Elegance", "desc" => "Elevate your style."],
      ["img" => "img/product-10.jpg", "price" => "₹100.00", "title" => "Precision Glide Wireless Mouse", "desc" => "Navigate with accuracy and ease using this mouse."],
      ["img" => "img/product-11.jpg", "price" => "₹6500.00", "title" => "Earpods", "desc" => "Wireless audio freedom."],
      ["img" => "img/product-12.jpg", "price" => "₹2320.00", "title" => "Sony Alpha a6400 – Style Meets Speed", "desc" => "Mirrorless power with lightning-fast autofocus."],
      ["img" => "img/product-13.jpg", "price" => "₹11450.00", "title" => "Laptop", "desc" => "Work and entertainment."],
      ["img" => "img/product-14.jpg", "price" => "₹780.00", "title" => "Hoody", "desc" => "Stay warm in style."],
      ["img" => "img/product-15.jpg", "price" => "₹7480.00", "title" => "PS-4", "desc" => "Next-gen gaming fun."],
      ["img" => "img/product-16.jpg", "price" => "₹11670.00", "title" => "Phones", "desc" => "Latest mobile tech."],
      ["img" => "img/product-17.jpg", "price" => "₹2900.00", "title" => "Stylish Elegance-Shoes", "desc" => "Trendy and comfortable."],
      ["img" => "img/product-18.jpg", "price" => "₹1890.00", "title" => "Jacket", "desc" => "Perfect for cooler days."],
    ];

    // Collect titles from session (cart + wishlist)
    $orderedTitles = [];

    if (!empty($_SESSION['cart'])) {
      foreach ($_SESSION['cart'] as $item) {
        $orderedTitles[] = $item['title'];
      }
    }

    if (!empty($_SESSION['wishlist'])) {
      foreach ($_SESSION['wishlist'] as $item) {
        $orderedTitles[] = $item['title'];
      }
    }

    // Unique order titles
    $orderedTitles = array_unique($orderedTitles);

    // Filter products by order titles
    $orderedProducts = array_filter($products, function ($product) use ($orderedTitles) {
      return in_array($product['title'], $orderedTitles);
    });

    // Display results
    if (empty($orderedProducts)) {
      echo '<p class="text-muted">No orders found from cart or wishlist.</p>';
    } else {
      echo '<div class="row">';
      foreach ($orderedProducts as $product) {
        ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 border-success shadow-sm">
            <img src="<?= $product['img'] ?>" class="card-img-top" alt="<?= $product['title'] ?>">
            <div class="card-body">
              <h5 class="card-title"><?= $product['title'] ?></h5>
              <p class="card-text"><?= $product['desc'] ?></p>
              <h6 class="text-success"><?= $product['price'] ?></h6>
              <p class="text-muted">Order Status: <strong>Shipped</strong></p>
            </div>
          </div>
        </div>
        <?php
      }
      echo '</div>';
    }
    ?>
  </div>
</div>

<?php include 'footer.php'; ?>
