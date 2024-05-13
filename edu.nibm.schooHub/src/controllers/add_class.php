<?php
include '../models/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $year = isset($_POST['Year']) ? $_POST['Year'] : '';

    $errors = [];
    if (empty($name)) {
        $errors[] = 'Class name is required.';
    }
    if (empty($year) || $year < 1800 || $year > 2099) {
        $errors[] = 'Year must be between 1800 and 2099.';
    }

    if (count($errors) === 0) {
        $stmt = $conn->prepare("INSERT INTO classes (name, year) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $year);

        if ($stmt->execute()) {
            header("Location: ../views/Dashboard.php");
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        foreach ($errors as $error) {
            echo $error;
        }
    }
}

$conn->close();
?>
