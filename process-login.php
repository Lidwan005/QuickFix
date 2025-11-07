<?php
// Temporary login processing - will be replaced with database authentication in Sprint 2
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Basic validation
    if (empty($email) || empty($password)) {
        header('Location: login.php?error=required');
        exit();
    }
    
    // Temporary: For demo purposes, accept any non-empty credentials
    // In Sprint 2, this will validate against database
    if (!empty($email) && !empty($password)) {
        // Simulate successful login
        $_SESSION['user_id'] = 1;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_type'] = 'customer'; // or 'provider'
        $_SESSION['logged_in'] = true;
        
        header('Location: index.php?login=success');
        exit();
    } else {
        header('Location: login.php?error=invalid');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}
?>