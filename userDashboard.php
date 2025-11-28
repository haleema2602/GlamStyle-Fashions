<?php
$pageTitle = "User Dashboard | GlamStyle Fashion";
include 'header.php';

if (!isset($_SESSION['roles']) || !in_array('USER', $_SESSION['roles'])) {
    header("Location: login.php");
    exit();
}

$displayName = isset($_SESSION['displayName']) ? $_SESSION['displayName'] : 'User';
?>

<!-- Google Fonts and Bootstrap -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom Styling -->
<style>
    html, body {
        height: 100%;
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to right, #fff0f5, #e6e6fa);
        display: flex;
        flex-direction: column;
    }

    .wrapper {
        flex: 1;
        padding-bottom: 40px;
    }

    h2.text-center {
        font-weight: 600;
        color: #d63384;
    }

    .card {
        border: none;
        border-radius: 18px;
        background: linear-gradient(to right, #faf0f8, #fefefe);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        padding: 1.5rem;
    }

    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 20px rgba(214, 51, 132, 0.15);
    }

    .card h5 {
        color: #5a189a;
        font-weight: 600;
    }

    .card p {
        color: #444;
        font-size: 0.95rem;
    }

    .btn {
        border-radius: 25px;
        font-weight: 500;
        padding: 0.5rem 1.2rem;
    }

    .btn-secondary {
        background-color: #6f42c1;
        border: none;
    }

    .btn-success {
        background-color: #20c997;
        border: none;
    }

    .btn-primary {
        background-color: #d63384;
        border: none;
    }
</style>

<div class="wrapper container mt-5">
    <h2 class="text-center mb-4">Welcome, <?= htmlspecialchars($displayName) ?>!</h2>

    <div class="row g-4">
         <!-- Product -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <h5>Product</h5>
                <p>Trendy and affordable fashion wear designed to elevate your everyday style.</p>
                <a href="product.php" class="btn btn-warning mt-3">See Product</a>
            </div>
        </div>

         <!-- Product -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <h5>Blogs</h5>
                <p>Discover the latest fashion trends, styling tips, and beauty insights from GlamStyle Fashions.</p>
                <a href="blogs.php" class="btn btn-success mt-3">See Blogs</a>
            </div>
        </div>

        <!-- Profile Settings -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <h5>Profile Settings</h5>
                <p>Update your personal details and preferences.</p>
                <a href="profile.php" class="btn btn-secondary mt-3">Edit Profile</a>
            </div>
        </div>

        <!-- Your Cart -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <h5>Your Cart</h5>
                <p>Manage products you’re ready to buy.</p>
                <a href="cart.php" class="btn btn-danger mt-3">View Cart</a>
            </div>
        </div>


        <!-- Cancel Order -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100 text-center">
                <h5>Cancel Order</h5>
                <p>Allows to delete a customer's order from the system.</p>
                <a href="cancelorder.php" class="btn btn-primary mt-3">Cancel Order</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
