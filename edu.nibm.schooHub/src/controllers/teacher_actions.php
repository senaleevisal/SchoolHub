<?php
include '../models/db.php'; // Ensure this points to your actual database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == 'add_subject') {
    // Get input values from the form
    $subjectName = isset($_POST['subject_name']) ? $_POST['subject_name'] : '';
    $classId = isset($_POST['class_id']) ? $_POST['class_id'] : '';

    // Validate input
    if (empty($subjectName) || empty($classId)) {
        die('Both Subject Name and Class ID are required.');
    }

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO subjects (name, class_id) VALUES (?, ?)");
    if (!$stmt) {
        die('MySQL prepare error: ' . $conn->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param('si', $subjectName, $classId);
    if ($stmt->execute()) {
        echo 'Subject added successfully!';
    } else {
        echo 'Error inserting subject: ' . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Not a POST request or different action
    echo "Invalid request.";
}
?>
