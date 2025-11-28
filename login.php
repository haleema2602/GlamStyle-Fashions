<?php
$error = null;
$pageTitle = "Login | GlamStyle Fashions";
$customLoginCss = "css/login.css";
include 'header.php';
include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        $stmt = $conn->prepare("SELECT id, password, first_name, last_name FROM users WHERE email = ?");
        $stmt->execute([$username]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                $_SESSION['displayName'] = $user['first_name'] . ' ' . $user['last_name'];
                $_SESSION['username'] = $username;

                $roleStmt = $conn->prepare("SELECT r.name 
                                            FROM roles r 
                                            INNER JOIN users_roles ur ON r.id = ur.role_id 
                                            WHERE ur.user_id = ?");
                $roleStmt->execute([$user['id']]);
                $roles = $roleStmt->fetchAll(PDO::FETCH_COLUMN);

                $_SESSION['roles'] = $roles;

                if (in_array('ADMIN', $roles)) {
                    header("Location: adminDashboard.php");
                    exit();
                } elseif (in_array('USER', $roles)) {
                    header("Location: userDashboard.php");
                    exit();
                } else {
                    $_SESSION['login_error'] = "No valid role assigned. Contact administrator.";
                    header("Location: login.php");
                    exit();
                }
            } else {
                $_SESSION['login_error'] = "Invalid password.";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['login_error'] = "No user found with this email address.";
            header("Location: login.php");
            exit();
        }
    }
}

if (isset($_SESSION['login_error'])) {
    $error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}

$registrationSuccess = isset($_GET['registered']) && $_GET['registered'] == 1;
?>
<br>
<!-- Stylish Login UI -->
<div class="bg-gradient bg-opacity-75" style="min-height: 70vh; background: linear-gradient(to right, #F49BAB,  #F49BAB );">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="card p-4 shadow-lg rounded-4 border-0" style="width: 100%; max-width: 400px; background-color: #ffffffee;">
            <div class="text-center mb-4">
                <img src="img/fashionlogo.jpg" alt="fashionLogo.jpg" width="30" class="mb-2">
                <h3 class="fw-bold" style="color: palevioletred;">Welcome</h3>
                <p class="text-muted small">Login to access your dashboard</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <?php if ($registrationSuccess): ?>
                <div class="alert alert-success">Registration successful. Please login.</div>
            <?php endif; ?>

            <form action="login.php" method="post">
                <div class="mb-3 position-relative">
                    <label for="username" class="form-label">Email</label>
                    <div class="input-group">
                     <span class="input-group-text"><i class="bi bi-envelope-fill text-palevioletred"></i></span>    
                     <input type="text" class="form-control" id="username" name="username" placeholder="you@example.com" required autofocus>
                    </div>
                </div>

                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill text-palevioletred"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="showPasswordToggle" onclick="togglePassword()">
                    <label class="form-check-label" for="showPasswordToggle">Show Password</label>
                </div>

                <div class="d-grid mb-3">
                  <button type="submit" class="btn btn-primary btn-lg shadow-sm" style="background-color: palevioletred; border: none;">Login</button>

                </div>
                
                <div class="text-center">
                <a href="registration.php" class="text-decoration-none fw-bold" style="color: palevioletred;">Register here</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const pwdInput = document.getElementById('password');
    const checkbox = document.getElementById('showPasswordToggle');
    pwdInput.type = checkbox.checked ? 'text' : 'password';
}
</script>

<?php include 'footer.php'; ?>