<?php
include 'db_connection.php'; // Make sure to include your database connection setup

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $recordType = $_POST['record_type'];
    $studentId = filter_input(INPUT_POST, 'student_id', FILTER_VALIDATE_INT);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $violationDate = isset($_POST['violation_date']) ? $_POST['violation_date'] : null;

    // Validate inputs
    if (!$studentId || !$description) {
        die('Invalid input. Please make sure all fields are filled correctly.');
    }

    switch ($recordType) {
        case 'violation':
            $stmt = $conn->prepare("INSERT INTO rule_violations (student_id, description, violation_date) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $studentId, $description, $violationDate);
            break;
        case 'achievement':
            $stmt = $conn->prepare("INSERT INTO achievements (student_id, description) VALUES (?, ?)");
            $stmt->bind_param("is", $studentId, $description);
            break;
        case 'activity':
            $stmt = $conn->prepare("INSERT INTO extracurricular_activities (student_id, name, description) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $studentId, $description, $description); // Assuming 'name' and 'description' are somewhat similar
            break;
        default:
            die('Invalid record type selected.');
    }

    if ($stmt && $stmt->execute()) {
        echo ucfirst($recordType) . " added successfully!";
    } else {
        echo "Error adding record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
