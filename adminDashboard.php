<?php
$pageTitle = "Admin Dashboard | GlamStyle Fashion";
include 'header.php';

if (!isset($_SESSION['roles']) || !in_array('ADMIN', $_SESSION['roles'])) {
    header("Location: login.php");
    exit();
}

$displayName = $_SESSION['displayName'] ?? 'Admin';
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
        background: linear-gradient(to right, #f3e5f5, #e8eaf6);
        display: flex;
        flex-direction: column;
    }

    .wrapper {
        flex: 1;
        padding-bottom: 40px;
    }

    h2.text-center {
        font-weight: 600;
        color:   #d63384;
    }

    .card {
        border: none;
        border-radius: 18px;
        background: linear-gradient(to right, #ffffff, #f3f0ff);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        padding: 1.5rem;
    }

    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 20px rgba(111, 66, 193, 0.15);
    }

    .card h5 {
        color: #6f42c1;
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
        color: white;
    }
</style>

<div class="wrapper container mt-5">
    <h2 class="text-center mb-4">Welcome to GlamStyle Admin Dashboard</h2>

    <div class="row g-4">
        <!-- Manage Products -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <h5>Manage Products</h5>
                <p>Add, edit or delete products in the catalog.</p>
                <a href="manageproducts.php" class="btn btn-primary mt-3">Manage Products</a>
            </div>
        </div>

        <!-- Manage Blogs -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <h5>Manage Blogs</h5>
                <p>Add, edit, or delete blog posts to keep your website content fresh and engaging.</p>
                <a href="manageblogs.php" class="btn btn-danger mt-3">Manage Blogs</a>
            </div>
        </div>

        

        <!-- Manage Orders -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <h5>Manage Orders</h5>
                <p>Check your recent past fashion purchases.</p>
                <a href="manageorders.php" class="btn btn-warning mt-3">Orders History</a>
            </div>
        </div>

        <!-- Profile Settings -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <h5>Profile Setting</h5>
                <p>Update your personal details and preference.</p>
                <a href="profile.php" class="btn btn-info mt-3">Edit Profile</a>
            </div>
        </div>

        <!-- View Messages -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <h5>View Messages</h5>
                <p>View messages that were sent by users.</p>
                <a href="Contactus.php" class="btn btn-dark mt-3">Contact Us</a>
            </div>
        </div>

        <!-- Manage Users -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <h5>Manage Users</h5>
                <p>View, edit or delete registered users.</p>
                <a href="manageusers.php" class="btn btn-secondary mt-3">Manage Users</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
