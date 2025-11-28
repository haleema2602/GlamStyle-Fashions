<?php
$pageTitle = "Blog Details | GlamStyle Fashion";
include 'header.php';
include 'dbconfig.php';

// Sample product list — must match blogs.php exactly

 try {
    $stmt = $conn->prepare("SELECT img, title, description FROM blogs");
    $stmt->execute();

    $blogs= $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Optional: Print or inspect the array
    // echo "<pre>"; print_r($blogs); echo "</pre>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
   
// Get the blog key from URL
$blogKey = $_GET['blog'] ?? 'Trendy';
$blog = $blogs[$blogKey] ?? null;
?>

<div class="container my-5">
  <?php if ($blog): ?>
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card shadow-lg">
          <img src="<?= $blog['img'] ?>" class="card-img-top" alt="<?= $blog['title'] ?>" style="height: 350px; object-fit: cover;">
          <div class="card-body">
            <h2 class="card-title"><?= $blog['title'] ?></h2>
            <p class="card-text mt-4" style="line-height: 1.8;"><?= $blog['content'] ?></p>
            <a href="blogslist.php" class="btn btn-outline-secondary mt-3">← Back to Blogs</a>
          </div>
        </div>
      </div>
    </div>
  <?php else: ?>
    <div class="alert alert-danger text-center">Blog not found<a href="blogslist.php">Go back to Blog</a>
    </div>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
