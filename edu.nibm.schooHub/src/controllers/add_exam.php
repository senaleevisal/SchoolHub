<?php
include '../models/db.php'; // Ensure you have this file set up correctly to connect to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $examName = filter_input(INPUT_POST, 'exam_name', FILTER_SANITIZE_STRING);
    $examDate = filter_input(INPUT_POST, 'exam_date', FILTER_SANITIZE_STRING);
    $subjectId = filter_input(INPUT_POST, 'subject_id', FILTER_VALIDATE_INT);

    // Validate inputs
    if (!$examName || !$examDate || !$subjectId) {
        die('Invalid input.');
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO exams (name, exam_date, subject_id) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssi", $examName, $examDate, $subjectId);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "Exam added successfully!";
        } else {
            echo "Error adding exam: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>
