<?php  
$pageTitle = "About Us | GlamStyle Fashion";
include 'header.php'; 
?>

<!-- Google Fonts and Bootstrap -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Custom CSS -->
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #fff;
    color: #3a3a3a;
  }

  .container-fluid.bg-light {
    background: linear-gradient(135deg, #ffe6f0, #f3e5f5);
  }

  .container-fluid.bg-light h1 {
    color: #d63384;
    font-weight: 700;
  }

  .container-fluid.bg-light p.lead {
    font-size: 1.25rem;
    color: #6c757d;
  }

  .about-section {
    padding: 3rem 1rem;
  }

  .about-section h2 {
    font-weight: 700;
    color: #5a189a;
    margin-bottom: 1rem;
    /* Removed pink underline */
  }

  .about-section p {
    font-size: 1.05rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
  }

  /* Style for the values list */
  .about-section ul {
    font-size: 1.05rem;
    padding-left: 0;
    list-style: none;
  }

  .about-section ul li {
    margin-bottom: 0.8rem;
    display: flex;
    align-items: center;
  }

  .about-section ul li i {
    font-size: 1.3rem;
    margin-right: 0.75rem;
  }

  /* Team Section */
  .card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(214, 51, 132, 0.3);
  }

  .card-img-top {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    object-fit: cover;
    height: 250px;
    width: 100%;
  }

  .card-title {
    color: #d63384;
    font-weight: 700;
    margin-bottom: 0.3rem;
  }

  .card-text {
    color: #6c757d;
    font-weight: 500;
  }

  hr {
    border-color: #d63384;
    max-width: 80%;
  }

  /* Responsive adjustments */
  @media (max-width: 576px) {
    .card-img-top {
      height: 200px;
    }
  }
</style>

<div class="container-fluid bg-light py-5 text-center">
  <h1 class="display-5 fw-bold">Style Meets Elegance</h1>
  <p class="lead">At GlamStyle Fashion, we bring you the latest trends with timeless quality.</p>
</div>

<div class="container about-section mt-5" data-aos="fade-right">
  <div class="row">
    <div class="col-md-6">
      <h2>About Us</h2>
      <p>GlamStyle Fashion is your ultimate destination for trendy, stylish, and affordable clothing. We believe fashion is an expression of individuality, and our collections are designed to help you stand out with confidence. From everyday casuals to statement outfits, we cater to all your fashion needs.</p>
    </div>
    <div class="col-md-6">
      <h2>Our Mission</h2>
      <p>Our mission is to empower every individual through fashion. We aim to provide high-quality clothing that’s both fashionable and sustainable, inspiring self-expression and creativity in every outfit.</p>
    </div>
  </div>
</div>

<div class="container about-section" data-aos="fade-right">
  <div class="row">
    <div class="col-md-12">
      <h2>Our Vision</h2>
      <p>To become a global fashion leader by redefining style through innovation, inclusivity, and affordability. We envision a world where everyone can express themselves freely through fashion.</p>
    </div>
  </div>
</div>

<div class="container about-section" data-aos="fade-right">
  <div class="row">
    <div class="col-md-12">
      <h2>Our Values</h2>
      <ul>
        <li><i class="bi bi-heart-fill text-danger"></i><strong>Passion:</strong> We love fashion and it shows in everything we do.</li>
        <li><i class="bi bi-person-check text-success"></i><strong>Integrity:</strong> We’re honest, ethical, and always put our customers first.</li>
        <li><i class="bi bi-trophy text-warning"></i><strong>Excellence:</strong> We aim for top-tier quality in every piece.</li>
        <li><i class="bi bi-lightbulb-fill text-warning"></i><strong>Innovation:</strong> We embrace trends and set new ones.</li>
        <li><i class="bi bi-people-fill text-primary"></i><strong>Inclusivity:</strong> We celebrate all shapes, sizes, and styles.</li>
      </ul>
    </div>
  </div>
</div>

<!-- Team Section -->
<br><br>
<div class="container about-section mb-3" data-aos="fade-right">
  <h2 class="text-center mb-1">Meet Our Creative Team</h2>
  <hr class="mx-auto my-4">

  <div class="row justify-content-center justify-content-md-around mb-4">
    <div class="col-12 col-sm-6 col-md-4 mb-md-3">
      <div class="card w-75 mx-auto">
        <img src="img/AvaCollins.jpg" class="card-img-top pb-3" alt="Ava Collins">
        <div class="card-body">
          <h5 class="card-title">Ava Collins</h5>
          <p class="card-text">Creative Director</p>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 mb-md-3">
      <div class="card w-75 mx-auto mb-5">
        <img src="img/LiamBrooks.jpg" class="card-img-top rounded-circle mb-3 p-4" alt="Liam Brooks">
        <div class="card-body">
          <h5 class="card-title">Liam Brooks</h5>
          <p class="card-text">Lead Fashion Designer</p>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 mb-md-3">
      <div class="card w-75 mx-auto">
        <img src="img/SophiaJames.jpg" class="card-img-top rounded-circle mb-3 p-4" alt="Sophia James">
        <div class="card-body">
          <h5 class="card-title">Sophia James</h5>
          <p class="card-text">Marketing Head</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-12 col-sm-6 col-md-4 mb-5">
      <div class="card w-75 mx-auto">
        <img src="img/Noahbennett.jpg" class="card-img-top pb-3" alt="Noah Bennett">
        <div class="card-body">
          <h5 class="card-title">Noah Bennett</h5>
          <p class="card-text">E-Commerce Manager</p>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 mb-5">
      <div class="card w-75 mx-auto">
        <img src="img/EmmaClark.jpg" class="card-img-top" alt="Emma Clark">
        <div class="card-body">
          <h5 class="card-title">Emma Clark</h5>
          <p class="card-text">Customer Experience Lead</p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
