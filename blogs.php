<?php  
$pageTitle = "Blogs | GlamStyle Fashion"; 
include 'header.php'; 
include 'dbconfig.php'; // Make sure this file contains your PDO connection as $conn
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


<div class="container-fluid p-5 text-center" bg-light>
  <div class="container about-section mb-4" data-aos="fade-right">
    <h2 class="text-center mb-1">BLOGS LATEST NEWS</h2>
    


    <!-- Back to Dashboard Button -->
    <div class="text-start mb-4">
      <a href="userdashboard.php" class="btn btn-primary btn-sm">← Back to Dashboard</a>
    </div>
    <div class="row">
      <?php
      try {
          $stmt = $conn->prepare("SELECT image, title, description FROM blogs ORDER BY created_at DESC");
          $stmt->execute();
          $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
          echo "<p class='text-danger'>Error: " . $e->getMessage() . "</p>";
      }
      
      foreach ($blogs as $blog) {
      ?>
        <div class="col-12 col-sm-6 col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="<?= htmlspecialchars($blog['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($blog['title']) ?>" 
                 style="height: 300px; object-fit: cover; border-bottom: 1px solid #ccc;">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($blog['title']) ?></h5>
              <p class="card-text"><?= htmlspecialchars($blog['description']) ?></p>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>

    
  </div> <!-- CLOSES .container -->
</div> <!-- CLOSES .container-fluid -->

<?php include 'footer.php'; ?>  