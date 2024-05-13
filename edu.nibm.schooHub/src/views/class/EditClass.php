<?php
require_once '../../models/db.php';
require_once '../../controllers/ClassController.php';

$classController = new ClassController();

$classId = isset($_GET['id']) ? $_GET['id'] : null;
$classDetails = null;

if ($classId) {
    $classDetails = $classController->fetchClassById($classId);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $year = $_POST['year'];
    $schoolId = $_POST['school_id'];


    $updateResult = $classController->updateClass($classId, $name, $year, $schoolId);

    if ($updateResult) {
        return header("Location: ../Dashboard.php");
    } else {
        echo "Failed to update class.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Class - SchoolHub</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Class</h2>
    <form action="#?id=<?php echo htmlspecialchars($classId); ?>" method="post">
        <div class="form-group">
            <label for="name">Class Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars(isset($classDetails['name']) ? $classDetails['name'] : ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="year">Year:</label>
            <input type="number" class="form-control" id="year" name="year" value="<?php echo htmlspecialchars(isset($classDetails['year']) ? $classDetails['year'] : ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="school_id">School ID:</label>
            <input type="number" class="form-control" id="school_id" name="school_id" value="<?php echo htmlspecialchars(isset($classDetails['school_id']) ? $classDetails['school_id'] : ''); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Class</button>
    </form>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
