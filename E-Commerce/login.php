<?php
session_start();
include 'config.php'; // DB connection (explained below)

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Basic validation
    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        // Check user in DB
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Login success
            $_SESSION['user_id'] = $user['id'];
            header("Location: home.php"); // Redirect to homepage or dashboard
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login</title>
<style>
  body {
    background-color: #daa793; /* peach background */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex; justify-content: center; align-items: center;
    height: 100vh; margin: 0;
  }
  .login-container {
    background: white;
    border-radius: 30px;
    border: 30px solid black;
    width: 350px;
    padding: 20px 30px 40px 30px;
    text-align: center;
    box-sizing: border-box;
  }
  .user-icon {
    font-size: 60px;
    border: 2px solid black;
    border-radius: 50%;
    width: 80px; height: 80px;
    line-height: 80px;
    margin: 0 auto 10px;
  }
  .login-container h2 {
    margin: 10px 0 20px;
    font-weight: 400;
  }
  input[type="email"], input[type="password"] {
    width: 100%;
    padding: 8px 16px;
    margin: 10px 0 20px;
    box-sizing: border-box;
    border-radius: 25px;
    border: 2px solid black;
    font-size: 16px;
    outline: none;
  }
  input::placeholder {
    color: #856353;
  }
  button {
    width: 140px;
    background: black;
    color: white;
    border: none;
    border-radius: 25px;
    padding: 10px 0;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
  }
  button:hover {
    background: #333;
  }
  .signup-text {
    margin-top: 18px;
    font-size: 14px;
    color: #4d2f1c;
  }
  .signup-text a {
    text-decoration: none;
    color: #0000ee;
    font-weight: bold;
  }
  .error-msg {
    color: red;
    margin-bottom: 10px;
    font-size: 14px;
  }
</style>
</head>
<body>
<div class="login-container">
    <div class="user-icon">&#128100;</div> <!-- Unicode user icon -->
    <h2>Log in</h2>

    <?php if ($error): ?>
        <div class="error-msg"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="email" name="email" placeholder="Email" required />       
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Log in</button>
    </form>

    <div class="signup-text">
        Don’t have account? <a href="signup.php">Sign in</a>
    </div>
</div>
</body>
</html>
