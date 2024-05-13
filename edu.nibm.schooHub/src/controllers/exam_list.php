<?php
include '../models/db.php'; // Ensure this file has the correct database connection setup

// SQL query to fetch exam information
$query = "SELECT e.exam_id, e.exam_date, s.name as subject_name, c.name as class_name 
          FROM exams e
          JOIN subjects s ON e.subject_id = s.subject_id
          JOIN classes c ON s.class_id = c.class_id
          ORDER BY e.exam_date DESC";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["exam_id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["subject_name"]) . "</td>";
        echo "<td>" . $row["exam_date"] . "</td>";
        echo "<td>" . htmlspecialchars($row["class_name"]) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No exams found</td></tr>";
}
$conn->close();
?>
