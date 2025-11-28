<?php 
$pageTitle = "Manage Products | GlamStyle Fashion";
include 'header.php';
include 'dbconfig.php';

// Add Product
if (isset($_POST['add_product'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_FILES['image']['name'];
    $target = "img/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $stmt = $conn->prepare("INSERT INTO products (title, description, price, quantity, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $description, $price, $quantity, $target]);
    }
}

// Delete Product
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: manageproducts.php");
    exit();
}

// Edit Product
if (isset($_POST['edit_product'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_FILES['image']['name'];

    if (!empty($image)) {
        $target = "img/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $stmt = $conn->prepare("UPDATE products SET title=?, description=?, price=?, quantity=?, image=? WHERE id=?");
        $stmt->execute([$title, $description, $price, $quantity, $target, $id]);
    } else {
        $stmt = $conn->prepare("UPDATE products SET title=?, description=?, price=?, quantity=? WHERE id=?");
        $stmt->execute([$title, $description, $price, $quantity, $id]);
    }

    header("Location: manageproducts.php");
    exit();
}
?>

<!-- Bootstrap + Google Fonts -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<!-- Custom CSS -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to right, #f9f9f9, #eef3fc);
    }

    h2 {
        color: #6f42c1;
        font-weight: bold;
    }

    .form-control {
        border-radius: 10px;
    }

    .btn-primary {
        background-color: #6f42c1;
        border: none;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: #5a32a3;
    }

    .btn-danger {
        background-color: #e74c3c;
        border: none;
    }

    .btn-warning {
        background-color: #f39c12;
        border: none;
        color: white;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
        height: 250px;
        object-fit: cover;
        border-bottom: 1px solid #eee;
    }

    .card-body {
        background-color: #fff;
        padding: 20px;
    }

    .card-title {
        color: #6f42c1;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 0.95rem;
        color: #444;
    }
</style>

<div class="container my-5">
    <!-- Back to Dashboard Button -->
    <div class="mb-4 text-start">
        <?php if (isset($_SESSION['role'])): ?>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="adminDashboard.php" class="btn btn-secondary">&larr; Back to Admin Dashboard</a>
            <?php elseif ($_SESSION['role'] === 'user'): ?>
                <a href="userDashboard.php" class="btn btn-secondary">&larr; Back to User Dashboard</a>
            <?php endif; ?>
        <?php else: ?>
            <a href="admindashboard.php" class="btn btn-primary">&larr; Back to Dashboard</a>
        <?php endif; ?>
    </div>

    <h2 class="mb-4 text-center">Manage Products</h2>

    <!-- Add Product Form -->
    <form method="POST" enctype="multipart/form-data" class="border p-4 mb-4 rounded bg-white shadow-sm">
        <h5>Add New Product</h5>
        <div class="row g-2">
            <div class="col-md-3"><input type="text" name="title" class="form-control" placeholder="Title" required></div>
            <div class="col-md-3"><input type="text" name="description" class="form-control" placeholder="Description" required></div>
            <div class="col-md-2"><input type="number" name="price" class="form-control" placeholder="Price" required></div>
            <div class="col-md-2"><input type="number" name="quantity" class="form-control" placeholder="Qty" required></div>
            <div class="col-md-2"><input type="file" name="image" class="form-control" required></div>
        </div>
        <div class="mt-3">
            <button name="add_product" class="btn btn-primary">Add Product</button>
        </div>
    </form>

    <!-- Products List -->
    <div class="row">
        <?php
        $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $index => $product):
        ?>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <img src="<?= htmlspecialchars($product['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['title']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($product['title']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                    <p><strong>₹<?= htmlspecialchars($product['price']) ?></strong> | Qty: <?= htmlspecialchars($product['quantity']) ?></p>

                    <a href="?delete=<?= $product['id'] ?>" onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-danger btn-sm">Delete</a>
                    <button type="button" class="btn btn-warning btn-sm" onclick="toggleEdit(<?= $product['id'] ?>)">Edit</button>

                    <!-- Edit Form -->
                    <form method="POST" enctype="multipart/form-data" class="mt-3 d-none" id="editForm<?= $product['id'] ?>">
                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                        <input type="text" name="title" class="form-control mb-2" value="<?= htmlspecialchars($product['title']) ?>" required>
                        <input type="text" name="description" class="form-control mb-2" value="<?= htmlspecialchars($product['description']) ?>" required>
                        <input type="number" name="price" class="form-control mb-2" value="<?= htmlspecialchars($product['price']) ?>" required>
                        <input type="number" name="quantity" class="form-control mb-2" value="<?= htmlspecialchars($product['quantity']) ?>" required>
                        <input type="file" name="image" class="form-control mb-2">
                        <button name="edit_product" class="btn btn-success btn-sm">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (($index + 1) % 3 == 0) echo '</div><div class="row">';
        endforeach;
        ?>
    </div>
</div>

<script>
function toggleEdit(id) {
    const form = document.getElementById('editForm' + id);
    form.classList.toggle('d-none');
}
</script>

<?php include 'footer.php'; ?>
