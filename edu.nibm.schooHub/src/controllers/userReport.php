<?php
include '../models/db.php';

header('Content-Type: application/json');

$school_id = isset($_GET['school_id']) ? (int)$_GET['school_id'] : 0;

$query = "SELECT role, COUNT(*) AS count FROM users WHERE school_id = ? GROUP BY role";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $school_id);
$stmt->execute();
$result = $stmt->get_result();

$user_counts = [];
while ($row = $result->fetch_assoc()) {
    $user_counts[$row['role']] = $row['count'];
}

echo json_encode($user_counts);
