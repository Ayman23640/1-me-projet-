<?php
session_start();
include 'db.php';

$error = "";
$success = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields";
    } else {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_id'] = $row['id'];
                $success = "Login successful! Redirecting...";
                header("refresh:1;url=index.php");
            } else {
                $error = "Password is incorrect!";
            }
        } else {
            $error = "Username not found!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Safood</title>
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h1>🔐 Login</h1>
            <p>Welcome back to Safood</p>
        </div>

        <?php 
        if (!empty($error)) {
            echo "<div class='alert alert-error'>⚠️ {$error}</div>";
        }
        if (!empty($success)) {
            echo "<div class='alert alert-success'>✓ {$success}</div>";
        }
        ?>

        <form method="POST" id="loginForm">
            <div class="form-group">
                <label for="username">Username or Email</label>
                <input 
                    type="text" 
                    id="username"
                    name="username" 
                    placeholder="Enter your username" 
                    required
                    autocomplete="username"
                >
            </div>

            <div class="form-group password-field">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password"
                    name="password" 
                    placeholder="Enter your password" 
                    required
                    autocomplete="current-password"
                >
                <button type="button" class="toggle-password" onclick="togglePassword()">👁️</button>
            </div>

            <div class="form-options">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>

            <button type="submit" name="login" class="auth-btn">Login Now</button>
        </form>

        <div class="auth-link">
            Don't have an account? <a href="signup.php">Sign Up Here</a>
        </div>
    </div>

    <script src="login.js"></script>
</body>
</html>
