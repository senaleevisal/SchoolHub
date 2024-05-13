<?php
include '../models/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract and sanitize the input
    $name = !empty($_POST['name']) ? trim($_POST['name']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $role = !empty($_POST['role']) ? $_POST['role'] : null;
    $password = !empty($_POST['password']) ? $_POST['password'] : null;

    // Basic validation
    if (empty($name) || empty($email) || empty($role) || empty($password)) {
        die("Please fill out all fields correctly.");
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    if ($count > 0) {
        die("This email is already used.");
    }
    $stmt->close();

    // Hash the password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user
    $stmt = $conn->prepare("INSERT INTO users (name, email, role, password_hash) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $role, $passwordHash);
    if ($stmt->execute()) {
        header("Location: ../views/Dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
