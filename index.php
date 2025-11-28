<?php 
$pageTitle = "Home | GlamStyle Fashions";
include 'header.php'; 
?>

<!-- Hero Section -->
<header class="bg-danger text-white text-center py-5" style="background-color: palevioletred !important;">
    <div class="container">
        <h1 class="display-4">Welcome to GlamStyle Fashion</h1>
        <p class="lead">Unleash Your Style | Discover Trends | Shop the Look</p>
        <a href="aboutus.php" class="btn btn-light btn-lg">Explore Our Styles</a>
    </div>
</header>

<?php include 'homeCarousel.php'; ?>

<!-- About Section -->
<section id="about" class="py-5" style="background-color: #f8d7da;">
    <div class="container">
        <h2 class="text-center text-dark">About GlamStyle</h2>
        <p class="lead text-center text-dark">
            At GlamStyle Fashion, we believe style is a form of self-expression. From urban streetwear to elegant classics, we offer something for every fashion-forward individual.
        </p>
    </div>
</section>

<!-- Why Choose Us / Features Section -->
<section class="py-5">
    <div class="container">
        <h3 class="text-center text-danger mb-4">Why Shop With Us?</h3>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-star-fill display-5 text-danger mb-3"></i>
                        <h5 class="card-title">Latest Trends</h5>
                        <p class="card-text">Stay ahead with our hand-picked collections curated from the latest global fashion trends.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-truck display-5 text-danger mb-3"></i>
                        <h5 class="card-title">Fast Delivery</h5>
                        <p class="card-text">Reliable and swift shipping ensures your fashion finds reach your doorstep on time.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-bag-heart display-5 text-danger mb-3"></i>
                        <h5 class="card-title">Customer Satisfaction</h5>
                        <p class="card-text">Our fashion consultants are here to support you for a delightful shopping experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
