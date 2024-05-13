<?php
include('../models/db.php');

$query = "SELECT c.name as class_name, c.year,
          (SELECT COUNT(*) FROM users WHERE role = 'student' AND class_id = c.class_id) as student_count,
          (SELECT COUNT(*) FROM users WHERE role = 'teacher' AND class_id = c.class_id) as teacher_count
          FROM classes c";

$result = mysqli_query($conn, $query);
?>