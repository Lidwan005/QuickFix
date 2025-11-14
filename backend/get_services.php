<?php
require_once "../config/db.php";

$stmt = $pdo->query("
    SELECT s.service_id, s.title, s.description, s.price, 
           s.duration_minutes, p.business_name
    FROM Service s
    JOIN Provider_Profile p ON s.provider_id = p.provider_id
");

echo json_encode($stmt->fetchAll());
?>
