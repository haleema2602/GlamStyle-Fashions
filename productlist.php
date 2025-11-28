<?php
$pageTitle = "Product | GlamStyle Fashion";
include 'header.php';
?>

<div class="container-fluid p-5 text-pink text-center" style="background-color: mistyrose !important;">
  <div class="container about-section mb-4" data-aos="fade-right">
    <h2 class="text-center mb-1">PRODUCTS</h2>
    <hr class="mx-auto my-4" style="width: 80%;">

    <?php
    $products = [
    ["img" => "img/product-4.jpg", "price" => 850.00, "title" => "Elegant Vision Spectacles", "desc" => "Redefine your style with these lightweight, high-fashion spectacles. Designed for comfort and clarity, they offer a perfect blend of trend and function for everyday elegance.", "quantity" => 1],
    ["img" => "img/product-5.jpg", "price" => 350.00, "title" => "T-shirt", "desc" => "Comfort meets style in this soft, breathable T-shirt. Perfect for casual outings or layering, it’s designed to keep you looking cool and feeling comfortable all day.", "quantity" => 1],
    ["img" => "img/product-6.jpg", "price" => 499.00, "title" => "HeadPhones", "desc" => "Experience crystal-clear sound and deep bass with these high-performance headphones. Designed for comfort and built for style, they deliver immersive audio whether you're working, gaming, or relaxing.", "quantity" => 1],
    ["img" => "img/product-7.jpg", "price" => 1400.00, "title" => "Purse", "desc" => "Compact and stylish.", "quantity" => 1],
    ["img" => "img/product-8.jpg", "price" => 1900.00, "title" => "Earrings", "desc" => "Shine with these classic earrings, perfect for both everyday glam and evening elegance.", "quantity" => 1],
    ["img" => "img/product-9.jpg", "price" => 1500.00, "title" => "High-heels Elegance", "desc" => "Elevate your style.", "quantity" => 1],
    ["img" => "img/product-10.jpg", "price" => 100.00, "title" => "Precision Glide Wireless Mouse", "desc" => "Navigate with accuracy and ease using this ergonomic wireless mouse. With smooth tracking, fast response, and a comfortable grip, it's perfect for work, gaming, or everyday use.", "quantity" => 1],
    ["img" => "img/product-11.jpg", "price" => 6500.00, "title" => "Earpods", "desc" => "Wireless audio freedom.", "quantity" => 1],
    ["img" => "img/product-12.jpg", "price" => 2320.00, "title" => "Sony Alpha a6400 – Style Meets Speed", "desc" => "Mirrorless power with lightning-fast autofocus, perfect for capturing runway looks and behind-the-scenes glam.", "quantity" => 1],
    ["img" => "img/product-13.jpg", "price" => 11450.00, "title" => "Laptop", "desc" => "Work and entertainment.", "quantity" => 1],
    ["img" => "img/product-14.jpg", "price" => 780.00, "title" => "Hoody", "desc" => "Stay warm in style.", "quantity" => 1],
    ["img" => "img/product-15.jpg", "price" => 7480.00, "title" => "PS-4", "desc" => "Next-gen gaming fun.", "quantity" => 1],
    ["img" => "img/product-16.jpg", "price" => 11670.00, "title" => "Phones", "desc" => "Latest mobile tech.", "quantity" => 1],
    ["img" => "img/product-17.jpg", "price" => 2900.00, "title" => "Stylish Elegance-Shoes", "desc" => "Trendy and comfortable.", "quantity" => 1],
    ["img" => "img/product-18.jpg", "price" => 1890.00, "title" => "Jacket", "desc" => "Perfect for cooler days.", "quantity" => 1]
];



    // Display 3 products per row
    echo '<div class="row">';
    foreach ($products as $index => $product) {
      echo '
      <div class="col-md-4 mb-3">
        <div class="card h-550 shadow-sm">
          <img src="' . $product["img"] . '" class="card-img-top" alt="' . $product["title"] . '">
          <div class="card-body">
            <h5 class="card-title">' . $product["title"] . '</h5>
            <p class="card-text">' . $product["desc"] . '</p>
            <p class="card-text text-success"><strong>' . $product["price"] . '</strong></p>
             <a href="product-details.php?product=' . urlencode($product["title"]) . '" class="btn btn-outline-secondary btn-sm mb-2">View Details</a><br>
              <a href="addtocart.php?product=' . urlencode($product["title"]) . '" class="btn btn-dark btn-sm me-2">Add to Cart</a>
              <a href="buynow.php?product=' . urlencode($product["title"]) . '" class="btn btn-success btn-sm">Buy Now</a>
          </div>
        </div>
      </div>';

      if (($index + 1) % 3 == 0 && $index + 1 < count($products)) {
        echo '</div><div class="row">';
      }
    }
    echo '</div>'; // Close final row
    ?>
  </div>
</div>

<?php include 'footer.php'; ?>
