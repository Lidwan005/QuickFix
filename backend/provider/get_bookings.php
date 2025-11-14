<?php
require_once "../../config/db.php";
session_start();

$provider_user = $_SESSION["user_id"];

// Get provider ID
$stmt = $pdo->prepare("SELECT provider_id FROM Provider_Profile WHERE user_id = ?");
$stmt->execute([$provider_user]);
$pid = $stmt->fetchColumn();

// Get all bookings for that provider
$stmt = $pdo->prepare("
    SELECT b.booking_id, u.first_name, u.last_name, s.title, b.booking_date, b.booking_time, b.status
    FROM Booking b
    JOIN User u ON b.customer_id = u.user_id
    JOIN Service s ON b.service_id = s.service_id
    WHERE b.provider_id = ?
    ORDER BY b.booking_date DESC
");

$stmt->execute([$pid]);

echo json_encode($stmt->fetchAll());
?>
