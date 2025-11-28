<?php  
$pageTitle = "Contact Us | GlamStyle Fashions";
include 'header.php';
include 'dbconfig.php';

$successMsg = '';
$errorMsg = '';
$full_name = '';
$email = '';
$message = '';

// Only handle form if NOT admin
if (!isset($_SESSION['roles']) || !in_array('ADMIN', $_SESSION['roles'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $full_name = trim($_POST['full_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if (!empty($full_name) && !empty($email) && !empty($message)) {
            try {
                $sql = "INSERT INTO contact_us (full_name, email, message) VALUES (:full_name, :email, :message)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':full_name', $full_name, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':message', $message, PDO::PARAM_STR);
                $stmt->execute();

                $successMsg = "Your message has been submitted successfully!";
                $full_name = $email = $message = '';
            } catch (PDOException $e) {
                $errorMsg = "There was a problem submitting your message: " . htmlspecialchars($e->getMessage());
            }
        } else {
            $errorMsg = "Please fill in all fields.";
        }
    }
}
?>

<!-- ====== Custom CSS Styling ====== -->
<style>
    h2, h4, h5 {
        color: #6f42c1;
        font-weight: 600;
    }

    .form-label {
        font-weight: 500;
    }

    .form-control {
        border-radius: 8px;
        box-shadow: none;
        border: 1px solid #ccc;
    }

    .form-control:focus {
        border-color: #6f42c1;
        box-shadow: 0 0 0 0.2rem rgba(214, 51, 132, 0.25);
    }

    .btn-success {
        background-color: #6f42c1;
        border: none;
        font-weight: bold;
        padding: 10px 25px;
        border-radius: 25px;
    }

    .btn-success:hover {
        background-color: #b02d6a;
    }

    .btn-outline-success {
        color: #6f42c1;
        border-color: #6f42c1;
    }

    .btn-outline-success:hover {
        background-color: #6f42c1;
        color: white;
    }

    .alert {
        border-radius: 8px;
    }

    iframe {
        border-radius: 10px;
    }

    @media (max-width: 768px) {
        h2 {
            font-size: 28px;
        }
    }
</style>

<!-- ====== Contact Section ====== -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Contact Us</h2>

        <div class="mb-4 text-start">
    <a href="admindashboard.php" class="btn btn-primary">← Back to Dashboard</a>
</div>

        <?php if ($successMsg): ?>
            <div class="alert alert-success"><?= $successMsg ?></div>
        <?php endif; ?>

        <?php if ($errorMsg): ?>
            <div class="alert alert-danger"><?= $errorMsg ?></div>
        <?php endif; ?>

        <?php if (!isset($_SESSION['roles']) || !in_array('ADMIN', $_SESSION['roles'])): ?>
        <div class="row">
            <!-- Contact Info -->
            <div class="col-md-6 mb-4">
                <h5>Get in Touch</h5>
                <p><i class="bi bi-geo-alt-fill me-2"></i> GlamStyle Fashions Street,<br> Hubli, Karnataka, India - 560001</p>
                <p><i class="bi bi-telephone-fill me-2"></i> Office: <a href="tel:080-1234567">080-1234567</a></p>
                <p><i class="bi bi-telephone-outbound-fill me-2"></i> Toll Free: <a href="tel:1800-500-900">1800-500-900</a></p>
                <p><i class="bi bi-envelope-fill me-2"></i> Email: <a href="mailto:info@glamstylefashions.in">info@glamstylefashions.in</a></p>
                <p>
                    <a href="https://maps.app.goo.gl/by257YUR99HeD8iC8" target="_blank" class="btn btn-outline-success mt-2">
                        <i class="bi bi-map-fill me-2"></i> View on Google Maps
                    </a>
                </p>

                <!-- Map -->
                <div class="ratio ratio-16x9 rounded shadow-sm">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3847.343852069322!2d75.10728487416472!3d15.357853058090944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bb8d75701d85d45%3A0x5ccd1dacb44c4c9a!2sIBMR%20College!5e0!3m2!1sen!2sin!4v1747202106471!5m2!1sen!2sin"
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-md-6">
                <h5>Send Us a Message</h5>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" value="<?= htmlspecialchars($full_name) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required><?= htmlspecialchars($message) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
        <?php endif; ?>

        <!-- Admin View Messages -->
        <?php if (isset($_SESSION['roles']) && in_array('ADMIN', $_SESSION['roles'])):
            $stmt = $conn->query("SELECT id, full_name, email, message FROM contact_us ORDER BY id ASC");
            $messages = $stmt->fetchAll();
        ?>
            <hr class="my-5">
            <h4>User Messages</h4>
            <?php if (count($messages) > 0): ?>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($messages as $msg): ?>
                                <tr>
                                    <td><?= $msg['id'] ?></td>
                                    <td><?= htmlspecialchars($msg['full_name']) ?></td>
                                    <td><?= htmlspecialchars($msg['email']) ?></td>
                                    <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>No messages found.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<?php include 'footer.php'; ?>
