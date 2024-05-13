<?php


require_once "../../models/db.php";
require_once '../../controllers/classController.php';

// Assuming you have an instance of the classController class
$classController = new classController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $classId = $_POST['classId'];
    $studentId =  $_POST['studentId'];

    // Call the addStudentToClass method
    $result = $classController->addStudentToClass($classId, $studentId);

    // Check the result and display a message
    if ($result > 0) {
        header('Location: ../Dashboard.php');
        exit;
    } else {
        echo "Failed to add student.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Add User</h1>
        <form action="AddUser.php" method="post">
            <div class="form-group">
                <label for="classId">Class ID:</label>
                <input type="text" name="classId" id="classId" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="studentId">Student ID:</label>
                <input type="text" name="studentId" id="studentId" class="form-control" required>
            </div>

            <input type="submit" value="Add Student" class="btn btn-primary">
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
