<?php
session_start();
include 'db.php';

$error = "";
$success = "";

if (isset($_POST['signup'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if (empty($username) || empty($phone) || empty($password) || empty($confirm_password)) {
        $error = "Please fill in all fields";
    } elseif (strlen($username) < 3) {
        $error = "Username must be at least 3 characters";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match";
    } else {
        // Check if username already exists
        $check_sql = "SELECT * FROM users WHERE username='$username'";
        $check_result = mysqli_query($conn, $check_sql);
        
        if (mysqli_num_rows($check_result) > 0) {
            $error = "Username already exists!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, phone, password) VALUES ('$username', '$phone', '$hashed_password')";
            
            if (mysqli_query($conn, $sql)) {
                $success = "Account created successfully! Redirecting to login...";
                header("refresh:2;url=login.php");
            } else {
                $error = "Error creating account: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Kafood</title>
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h1>✨ Sign Up</h1>
            <p>Join Kafood and start ordering</p>
        </div>

        <?php 
        if (!empty($error)) {
            echo "<div class='alert alert-error'>⚠️ {$error}</div>";
        }
        if (!empty($success)) {
            echo "<div class='alert alert-success'>✓ {$success}</div>";
        }
        ?>

        <form method="POST" id="signupForm">
            <div class="form-group">
                <label for="username">Username</label>
                <input 
                    type="text" 
                    id="username"
                    name="username" 
                    placeholder="Create a username" 
                    required
                    minlength="3"
                    autocomplete="username"
                >
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input 
                    type="tel" 
                    id="phone"
                    name="phone" 
                    placeholder="Enter your phone number" 
                    required
                    autocomplete="tel"
                >
            </div>

            <div class="form-group password-field">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password"
                    name="password" 
                    placeholder="Create a strong password" 
                    required
                    minlength="6"
                    autocomplete="new-password"
                >
                <button type="button" class="toggle-password" onclick="togglePassword()">👁️</button>
            </div>

            <div class="form-group password-field">
                <label for="confirm_password">Confirm Password</label>
                <input 
                    type="password" 
                    id="confirm_password"
                    name="confirm_password" 
                    placeholder="Confirm your password" 
                    required
                    autocomplete="new-password"
                >
                <button type="button" class="toggle-password" onclick="toggleConfirmPassword()">👁️</button>
            </div>

            <button type="submit" name="signup" class="auth-btn">Create Account</button>
        </form>

        <div class="auth-link">
            Already have an account? <a href="login.php">Login Here</a>
        </div>
    </div>

    <script src="signup.js"></script>
</body>
</html>
