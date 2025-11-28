<?php
session_start();
$isLoggedIn = isset($_SESSION ['username']);
$pageTitle = isset($pageTitle) ? $pageTitle : "Home | GlamStyle Fashion";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" >
  <title><?= $pageTitle ?></title>
 <link rel="icon" type="image/x-icon" href="img/fashionlogo.jpg"  >
  <link rel="stylesheet" href="css/app.css" />
  <!-- Bootstrap 5 CSS (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" >
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" >

  <?php if (isset($customLoginCss)): ?>
    <link rel="stylesheet" href="<?= $customLoginCss ?>">
  <?php endif; ?>
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>


  <!-- Navigation Bar -->
 <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: palevioletred;">

    <div class="container-fluid">
      <a href="index.php"> <img src="img/fashionlogo.jpg" style="width: 50px; border-radius: 50%; margin-right:10px;" alt="GlamStyle Logo"></a>
      <a class="navbar-brand" href="index.php">GlamStyle Fashion</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link <?= strpos($pageTitle, 'Home') !== false ? 'active' : '' ?>" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link <?= strpos($pageTitle, 'About') !== false ? 'active' : '' ?>" href="aboutus.php">About Us</a></li>
          <!-- <li class="nav-item"><a class="nav-link <?= strpos($pageTitle, 'Blogs') !== false ? 'active' : '' ?>" href="blogs.php">Blogs</a></li> -->
          <!-- <li class="nav-item"><a class="nav-link <?= strpos($pageTitle, 'Product') !== false ? 'active' : '' ?>" href="product.php">Product</a></li> -->
           <!-- <li class="nav-item"><a class="nav-link <?= strpos($pageTitle, 'Contact') !== false ? 'active' : '' ?>" href="contactUs.php">Contact Us</a></li>  -->
          <!-- <li class="nav-item"><a class="nav-link <?= strpos($pageTitle, 'Cart') !== false ? 'active' : '' ?>" href="cart.php">Cart</a></li>
          <!-<li class="nav-item"><a class="nav-link <?= strpos($pageTitle, 'orders') !== false ? 'active' : '' ?>" href="orders.php">Orders</a></li> -->

          <?php if ($isLoggedIn): ?>
            <?php
                        $usersRole = '';
                        if(isset($_SESSION['roles']) && in_array('ADMIN', $_SESSION['roles'])){
                            $usersRole = 'ADMIN';
                        }else if(isset($_SESSION['roles']) && in_array('USER', $_SESSION['roles'])){
                            $usersRole = 'USER';
                        }
                        $hrefValue='#';
                        $username = isset($_SESSION['displayName']) ? $_SESSION['displayName'] : 'Guest';
                        $initial = strtoupper(substr($username, 0, 1));
                        if (isset($_SESSION['roles']) && in_array('ADMIN', $_SESSION['roles'])) {
                            $hrefValue = 'admindashboard.php';     
                        }
                        else if (isset($_SESSION['roles']) && in_array('USER',$_SESSION['roles'])) {
                            $hrefValue = 'userDashboard.php';
                        }
                        ?>
                       <?php if($usersRole === 'ADMIN'): ?>
                        <li class="nav-item">
              <li class="nav-item"><a class="nav-link <?= strpos($pageTitle, 'Blogs') !== false ? 'active' : '' ?>" href="blogs.php">Blogs</a></li>
          <li class="nav-item"><a class="nav-link <?= strpos($pageTitle, 'Product') !== false ? 'active' : '' ?>" href="product.php">Product</a></li>
          <li class="nav-item"><a class="nav-link <?= strpos($pageTitle, 'Contact') !== false ? 'active' : '' ?>" href="contactUs.php">Contact Us</a></li>
          <li class="nav-item"><a class="nav-link <?= strpos($pageTitle, 'Cart') !== false ? 'active' : '' ?>" href="cart.php">Cart</a></li>
          
          <?php endif ?>

           <?php if($usersRole === 'USER'): ?>
           <li class="nav-item">
          <li class="nav-item"><a class="nav-link <?= strpos($pageTitle, 'Blogs') !== false ? 'active' : '' ?>" href="blogs.php">Blogs</a></li>
          <li class="nav-item"><a class="nav-link <?= strpos($pageTitle, 'Product') !== false ? 'active' : '' ?>" href="product.php">Product</a></li>
          <li class="nav-item"><a class="nav-link <?= strpos($pageTitle, 'Contact') !== false ? 'active' : '' ?>" href="contactUs.php">Contact Us</a><li>
          <li class="nav-item"><a class="nav-link <?= strpos($pageTitle, 'Cart') !== false ? 'active' : '' ?>" href="cart.php">Cart</a></li>
          
          <?php endif ?>

            <li class="nav-item">
                            <a class="nav-link <?= strpos($pageTitle, 'Dashboard') !== false ? 'active' : '' ?>" href="<?= $hrefValue ?>">Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="avatar-circle me-2" style="width: 32px; height: 32px; border-radius: 50%; background-color: #6c757d; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                    <?= $initial; ?>
                </div>
                <span><?= htmlspecialchars($username); ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person me-2"></i>Profile Settings</a></li>
                <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Sign out</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link <?= strpos($pageTitle, 'Login') !== false ? 'active' : '' ?>" href="login.php">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
