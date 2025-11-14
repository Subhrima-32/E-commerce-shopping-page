<?php
session_start();

require 'config.php';  // Include DB connection

// Get and sanitize POST data
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Basic validation
if ($username === '' || $email === '' || $password === '') {
    $_SESSION['error'] = "All fields are required.";
    header("Location: signup.php");
    exit();
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Invalid email format.";
    header("Location: signup.php");
    exit();
}

// Check if username or email already exists
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
$stmt->execute([$username, $email]);
$userExists = $stmt->fetch();

if ($userExists) {
    $_SESSION['error'] = "Username or Email already exists.";
    header("Location: signup.php");
    exit();
}

// Hash the password securely
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert new user into the database
$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
if ($stmt->execute([$username, $email, $hashed_password])) {
    $_SESSION['success'] = "Account created successfully!";
    header("Location: signup.php");
    exit();
} else {
    $_SESSION['error'] = "Something went wrong. Please try again.";
    header("Location: signup.php");
    exit();
}