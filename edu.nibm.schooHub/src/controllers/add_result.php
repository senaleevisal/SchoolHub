<?php
include 'db_connection.php'; // Ensure this file correctly sets up a connection to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $examId = filter_input(INPUT_POST, 'exam_id', FILTER_VALIDATE_INT);
    $studentId = filter_input(INPUT_POST, 'student_id', FILTER_VALIDATE_INT);
    $score = filter_input(INPUT_POST, 'score', FILTER_SANITIZE_STRING);

    // Validate inputs
    if (!$examId || !$studentId || $score === false) {
        die('Invalid input. Please make sure all fields are filled correctly.');
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO marks (exam_id, student_id, score) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("iis", $examId, $studentId, $score);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "Result added successfully!";
        } else {
            echo "Error adding result: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>
