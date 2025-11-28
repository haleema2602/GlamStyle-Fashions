<?php

$pageTitle = "Manage Blogs | GlamStyle Fashion";
include 'header.php';
include 'dbconfig.php';

// Directory for blog images
$uploadDir = 'uploads/blogs/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Handle Add Blog
if (isset($_POST['add_blog'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imagePath = $targetPath;
        }
    }

    if ($title && $description && $imagePath) {
        $stmt = $conn->prepare("INSERT INTO blogs (image, title, description) VALUES (?, ?, ?)");
        $stmt->execute([$imagePath, $title, $description]);
    }
}

// Handle Edit Blog
if (isset($_POST['update_blog'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imagePath = $_POST['current_image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imagePath = $targetPath;
        }
    }

    $stmt = $conn->prepare("UPDATE blogs SET image = ?, title = ?, description = ? WHERE id = ?");
    $stmt->execute([$imagePath, $title, $description, $id]);
}

// Handle Delete Blog
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM blogs WHERE id = ?");
    $stmt->execute([$id]);
}

// Fetch all blogs
$stmt = $conn->query("SELECT * FROM blogs ORDER BY created_at DESC");
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch blog for edit
$editBlog = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editBlog = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

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

    form h5 {
        color: #444;
        font-weight: 600;
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

    <h2 class="text-center mb-4"><?= $editBlog ? 'Edit Blog' : 'Add New Blog' ?></h2>

    <form method="POST" enctype="multipart/form-data" class="mb-5">
        <?php if ($editBlog): ?>
            <input type="hidden" name="id" value="<?= $editBlog['id'] ?>">
            <input type="hidden" name="current_image" value="<?= $editBlog['image'] ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required value="<?= $editBlog['title'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required><?= $editBlog['description'] ?? '' ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <?php if ($editBlog): ?>
                <div class="mb-2">
                    <img src="<?= $editBlog['image'] ?>" alt="Blog Image" width="150" class="rounded">
                </div>
            <?php endif; ?>
            <input type="file" name="image" class="form-control" <?= $editBlog ? '' : 'required' ?>>
        </div>

        <button type="submit" name="<?= $editBlog ? 'update_blog' : 'add_blog' ?>" class="btn btn-primary">
            <?= $editBlog ? 'Update Blog' : 'Add Blog' ?>
        </button>
        <?php if ($editBlog): ?>
            <a href="manageblogs.php" class="btn btn-secondary">Cancel Edit</a>
        <?php endif; ?>
    </form>

    <h2 class="text-center mb-3">All Blogs</h2>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($blogs): ?>
                    <?php foreach ($blogs as $index => $blog): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><img src="<?= $blog['image'] ?>" width="100" height="70" class="rounded" style="object-fit:cover;"></td>
                            <td><?= htmlspecialchars($blog['title']) ?></td>
                            <td><?= htmlspecialchars($blog['description']) ?></td>
                            <td><?= $blog['created_at'] ?></td>
                            <td>
                                <a href="?edit=<?= $blog['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="?delete=<?= $blog['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this blog?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center">No blogs found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
