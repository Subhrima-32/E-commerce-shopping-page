<?php
session_start();
require 'config.php';  // Include DB connection

// Initialize variables for messages
$error = '';
$success = '';

// Process form submission on POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get and sanitize input
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validation
    if ($username === '' || $email === '' || $password === '') {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // ✅ FIXED: changed id → username to match your table structure
        $stmt = $pdo->prepare("SELECT username FROM user WHERE username = :username OR email = :email");
        $stmt->execute(['username' => $username, 'email' => $email]);
        if ($stmt->fetch()) {
            $error = "Username or Email already exists.";
        } else {
            // Insert new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO user (username, email, password) VALUES (:username, :email, :password)");
            if ($stmt->execute(['username' => $username, 'email' => $email, 'password' => $hashed_password])) {
                // Redirect to login page after success
                header("Location: login.php");
                exit();
            } else {
                $error = "Failed to create account. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Sign up</title>
<style>
    body {
        background: #c19a71;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .form-container {
        background: #d3bfa7;
        border-radius: 19px;
        padding: 40px 35px;
        box-sizing: border-box;
        text-align: center;
        width: 320px;
        box-shadow: 0 0 7px rgb(0 0 0 / 0.2);
    }
    .user-icon {
        display: inline-block;
        width: 48px;
        height: 48px;
        border: 2px solid black;
        border-radius: 50%;
        position: relative;
        margin-bottom: 10px;
    }
    .user-icon::before {
        content: "";
        position: absolute;
        top: 8px;
        left: 50%;
        width: 22px;
        height: 22px;
        background: black;
        border-radius: 50%;
        transform: translateX(-50%);
    }
    .user-icon::after {
        content: "";
        position: absolute;
        top: 32px;
        left: 50%;
        width: 34px;
        height: 12px;
        background: black;
        border-radius: 90px / 50px;
        transform: translateX(-50%);
    }
    h2 {
        font-weight: 600;
        margin: 0 0 20px;
        font-size: 1.2rem;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        font-family: monospace;
        background: #fbf5ef;
        border-radius: 12px;
        border: 1px solid black;
        padding: 12px 15px;
        margin-bottom: 20px;
        box-sizing: border-box;
        font-size: 1rem;
    }
    button {
        background: black;
        color: white;
        font-family: monospace;
        font-size: 1rem;
        border-radius: 12px;
        border: none;
        padding: 10px 30px;
        cursor: pointer;
        margin-bottom: 25px;
    }
    .login-link {
        font-size: 0.9rem;
    }
    .login-link a {
        color: blue;
        font-weight: bold;
        text-decoration: none;
    }
    .error {
        color: red;
        margin-bottom: 15px;
        font-size: 0.9rem;
    }
    .success {
        color: green;
        margin-bottom: 15px;
        font-size: 0.9rem;
    }
</style>
</head>
<body>
<div class="form-container">
    <div class="user-icon"></div>
    <h2>Sign up</h2>

    <?php if ($error): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php elseif ($success): ?>
        <div class="success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <form action="signup.php" method="POST">
        <input type="text" name="username" placeholder="Username" required value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" />
        <input type="email" name="email" placeholder="Email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Sign in</button>
    </form>
    <div class="login-link">
        Already have account? <a href="login.php">Log in</a>
    </div>
</div>
</body>
</html>
