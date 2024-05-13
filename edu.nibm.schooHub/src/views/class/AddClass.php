<?php
require '../../controllers/ClassController.php';
require '../../models/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $year = $_POST['year'];
    $schoolId = 1; // Replace with the actual school ID

    $classController = new ClassController();
    $rowCount = $classController->addClass($name, $year, $schoolId);

    if ($rowCount > 0) {
        $location = "../views/classroom.php";
    } else {
        echo "Failed to add class.";
    }
}