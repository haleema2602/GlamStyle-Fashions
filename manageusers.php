<?php
$pageTitle = "Manage Users | GlamStyle Fashions";
include 'header.php';
include 'dbconfig.php';

// Delete user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    try {
        // Remove user role link first
        $stmt = $conn->prepare("DELETE FROM users_roles WHERE user_id = ?");
        $stmt->execute([$id]);

        // Delete user from users table
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);

        echo "<p style='color: red; text-align: center;'>User deleted successfully.</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red; text-align: center;'>Error: " . $e->getMessage() . "</p>";
    }
}

// Update user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    try {
        $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, email=?, phone_number=? WHERE id=?");
        $stmt->execute([$first_name, $last_name, $email, $phone_number, $id]);
        echo "<p style='color: green; text-align: center;'>User updated successfully.</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red; text-align: center;'>Error: " . $e->getMessage() . "</p>";
    }
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

    .btn-primary {
        background-color: #6f42c1;
        border: none;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: #5a32a3;
    }

    .table th, .table td {
        vertical-align: middle !important;
    }
</style>

<div class="text-start mt-4">
    <a href="admindashboard.php" class="btn btn-primary">← Back to Dashboard</a>
</div>

<br>
<h2 style="text-align:center;">Manage Registered Users</h2>

<table border="1" cellpadding="10" cellspacing="0" style="width:90%; margin: 20px auto; border-collapse: collapse;">
<tr style="background-color: #f2f2f2;">
    <th>ID</th>
    <th>Full Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Role</th>
    <th>Actions</th>
</tr>

<?php
$stmt = $conn->query("
    SELECT u.id, u.first_name, u.last_name, u.email, u.phone_number, r.name AS role
    FROM users u
    LEFT JOIN users_roles ur ON u.id = ur.user_id
    LEFT JOIN roles r ON ur.role_id = r.id
    ORDER BY u.id DESC
");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['first_name']} {$row['last_name']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['phone_number']}</td>";
    echo "<td>" . ($row['role'] ?? 'No Role') . "</td>";
    echo "<td>
        <a href='?edit={$row['id']}'>Edit</a> |
        <a href='?delete={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>
    </td>";
    echo "</tr>";
}
?>
</table>

<?php
// Show edit form
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);  
    $user = $stmt->fetch(PDO::FETCH_ASSOC);  
    if ($user):
?>
<h3 style="text-align:center;">Edit User</h3>
<form method="POST" style="max-width: 500px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9;">
    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">

    <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px;">First Name:</label>
        <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px;">Last Name:</label>
        <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px;">Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px;">Phone Number:</label>
        <input type="text" name="phone_number" value="<?= htmlspecialchars($user['phone_number']) ?>" required style="width: 100%; padding: 8px;">
    </div>

    <div style="text-align: center;">
        <button type="submit" name="update" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px;">Update</button>
    </div>
</form>
<br>
<?php
    endif;
}
?>

<?php include 'footer.php'; ?>
