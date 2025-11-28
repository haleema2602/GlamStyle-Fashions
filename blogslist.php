  <?php
$pageTitle = "Blogs | GlamStyle Fashion";
include 'header.php'; // Make sure this includes the Bootstrap CSS and navigation
?>

<div class="container-fluid p-5 text-white text-center" style="background-color: #f8c8dc;">
  <h2 class="mb-4">Latest Fashion Blogs</h2>
  <hr class="mx-auto" style="width: 80px; border: 2px solid #ff69b4;">
</div>

<div class="container my-5">
  <div class="row">
    <?php
    // Blog data (can later be fetched from database)
    $blogs = [
    ["img" => "img/blog-4.jpg", "title" =>"Wardrobe Building","desc"=>"Create a timeless and versatile wardrobe with our curated collection of essentials. From classic staples to trendy pieces, build a wardrobe that reflects your unique style and adapts to every season." ],
    ["img" => "img/blog-5.jpg", "title" => "Kids Wear","desc"=>"Bright, comfy, and full of fun! Our kids wear collection features playful designs, soft fabrics, and perfect fits made to keep up with every adventure your little one takes."],
    ["img" => "img/blog-6.jpg", "title" => "Shopping Basket","desc"=>"Sturdy, lightweight, and easy to carry this shopping basket is perfect for quick grocery runs or home organization. Designed with a strong handle and spacious interior for everyday convenience."],
    ["img" => "img/blog-7.jpg", "title" => "Stylish Wear","desc"=>"Turn heads with our latest collection of stylish wear where fashion meets comfort. From chic cuts to bold designs, each piece is crafted to express your unique style with confidence."],
    ["img" => "img/blog-8.jpg", "title" => "Footwear","desc"=>"Step out in style with our versatile footwear collection. Designed for comfort and crafted for trendsetters, these shoes are perfect for everyday wear, special occasions, and everything in between."],
    ["img" => "img/blog-9.jpg", "title" =>"T-Shirts","desc"=>"Soft, breathable, and effortlessly cool this T-shirt is your go to for everyday comfort with a perfect fit and stylish design, it's ideal for casual wear, lounging, or layering."],
    ["img" => "img/blog-10.jpg", "title" =>"Earrings","desc"=>"Delicate yet striking, our earrings are designed to add a touch of sparkle to any outfit. From classic studs to bold statement pieces, find the perfect pair for every occasion."],
    ["img" => "img/blog-11.jpg", "title" => "Dupatta","desc"=>"Elegant and timeless, this dupatta adds a perfect finishing touch to any ethnic outfit. Made with soft, flowing fabric and beautiful detailing."],      
    ["img" => "img/blog-12.jpg", "title" => "Shoes","desc"=>"Step into comfort and style with our premium shoe collection. Designed for everyday wear and special occasions, these shoes offer the perfect blend of durability, fit, and fashion-forward design."],
    
    ];

    foreach ($blogs as $blog) {
      ?>
    <div class="col-12 col-sm-6 col-md-4 mb-3">
          <div class="card h-200 shadow-sm">
            <img src="<?= $blog['img'] ?>" class="card-img-top" alt="<?= $blog['title'] ?>" 
                 style="height: 350px; object-fit: cover; border-bottom: 1px solid #ccc;">
            <div class="card-body">
              <h5 class="card-title"><?= $blog['title'] ?></h5>
              <p class="card-text"><?= $blog['desc'] ?></p>
               
    </div>
    </div>
        </div>
      <?php } ?>
    </div>
    </div>


<?php include 'footer.php'; ?>
