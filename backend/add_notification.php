<?php
require_once "../config/db.php";

function notifyUser($user_id, $message) {
    global $pdo;

    $stmt = $pdo->prepare("
        INSERT INTO Notification (user_id, message)
        VALUES (?, ?)
    ");

    $stmt->execute([$user_id, $message]);
}
?>
