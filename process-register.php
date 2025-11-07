<?php
// Temporary registration processing - will be replaced with database in Sprint 2
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $user_type = $_POST['user_type'] ?? '';
    
    // Basic validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($user_type)) {
        header('Location: register.php?error=required');
        exit();
    }
    
    if ($password !== $confirm_password) {
        header('Location: register.php?error=password_mismatch');
        exit();
    }
    
    if (strlen($password) < 8) {
        header('Location: register.php?error=weak_password');
        exit();
    }
    
    // Temporary: Simulate successful registration
    // In Sprint 2, this will save to database
    $_SESSION['user_id'] = 2; // New user ID
    $_SESSION['user_email'] = $email;
    $_SESSION['user_type'] = $user_type;
    $_SESSION['logged_in'] = true;
    $_SESSION['first_name'] = $first_name;
    
    header('Location: index.php?register=success');
    exit();
} else {
    header('Location: register.php');
    exit();
}
?>