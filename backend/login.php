<?php
require_once "../config/db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM User WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password_hash"])) {

        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["user_type"] = $user["user_type"];

        if ($user["user_type"] === "provider") {
            header("Location: ../provider/dashboard.php");
        } else {
            header("Location: ../customer/dashboard.php");
        }
        exit();
    }

    header("Location: ../login.php?error=invalid");
    exit();
}
?>
