<?php
include 'db_connection.php';

header('Content-Type: application/json');

$sql = "SELECT exam_date, AVG(score) AS average_mark
        FROM exams
        JOIN marks ON exams.exam_id = marks.exam_id
        GROUP BY exams.exam_date
        ORDER BY exams.exam_date ASC";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        'exam_date' => $row['exam_date'],
        'average_mark' => $row['average_mark']
    ];
}

echo json_encode($data);
?>
