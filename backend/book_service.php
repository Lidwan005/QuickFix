<?php
require_once "../config/db.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    die("Not logged in");
}

$customer = $_SESSION["user_id"];
$provider = $_POST["provider_id"];
$service = $_POST["service_id"];
$date = $_POST["date"];
$time = $_POST["time"];

$stmt = $pdo->prepare("
    INSERT INTO Booking 
        (customer_id, provider_id, service_id, booking_date, booking_time) 
    VALUES (?, ?, ?, ?, ?)
");

$stmt->execute([$customer, $provider, $service, $date, $time]);

echo "SUCCESS";
?>
