<?php
$pageTitle = "My Account | GlamStyle Fashion";
include 'header.php';
include 'dbconfig.php';

// Redirect if user not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$success = $error = null;

// Fetch user data
$stmt = $conn->prepare("SELECT first_name, last_name, email FROM users WHERE email = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle profile update form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($first_name) || empty($last_name)) {
        $error = "Name fields cannot be empty.";
    } elseif (!empty($password) && $password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Update name
        $updateQuery = "UPDATE users SET first_name = ?, last_name = ?";
        $params = [$first_name, $last_name];

        // Update password if provided
        if (!empty($password)) {
            $updateQuery .= ", password = ?";
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $params[] = $hashedPassword;
        }

        $updateQuery .= " WHERE email = ?";
        $params[] = $username;

        $updateStmt = $conn->prepare($updateQuery);
        if ($updateStmt->execute($params)) {
            $_SESSION['displayName'] = $first_name . ' ' . $last_name;
            $success = "Account updated successfully.";
            $user['first_name'] = $first_name;
            $user['last_name'] = $last_name;
        } else {
            $error = "Update failed. Please try again.";
        }
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm p-4">
                <h3 class="text-center mb-4">My Account</h3>

                <?php if ($success): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                <?php elseif ($error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST" action="account.php">
                    <div class="mb-3">
                        <label class="form-label">Email (cannot be changed)</label>
                        <input type="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($user['first_name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($user['last_name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password (optional)</label>
                        <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Re-enter new password">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark">Update Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
