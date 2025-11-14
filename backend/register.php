<?php
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $first = $_POST["first_name"];
    $last = $_POST["last_name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $type = $_POST["user_type"]; // customer or provider
    $phone = $_POST["phone"];

    // Insert into User table
    $stmt = $pdo->prepare("
        INSERT INTO User (first_name, last_name, email, password_hash, user_type, phone)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([$first, $last, $email, $password, $type, $phone]);

    $user_id = $pdo->lastInsertId();

    // If provider, create profile
    if ($type === "provider") {
        $stmt = $pdo->prepare("
            INSERT INTO Provider_Profile (user_id, business_name, description, service_category) 
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([
            $user_id,
            $_POST["business_name"],
            $_POST["description"],
            $_POST["service_category"]
        ]);
    }

    header("Location: ../login.php?success=1");
    exit();
}
?>
