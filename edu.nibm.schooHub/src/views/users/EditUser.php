<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - SchoolHub</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Edit User</h2>
            <?php
                include '../../models/db.php';
                require_once '../../controllers/UserManagementController.php';
                // Fetch user details from the server
                $userId = $_GET['id']; // Assuming the user ID is passed as a query parameter
                $userController = new UserManagementController();
                $user = $userController->fetchUserById($userId);
            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select class="form-control" id="role" name="role">
                        <option value="student" <?php if ($user['role'] == 'student') echo 'selected'; ?>>Student</option>
                        <option value="teacher" <?php if ($user['role'] == 'teacher') echo 'selected'; ?>>Teacher</option>
                        <option value="parent" <?php if ($user['role'] == 'parent') echo 'selected'; ?>>Parent</option>
                        <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="principal" <?php if ($user['role'] == 'principal') echo 'selected'; ?>>Principal</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo $userId; ?>">
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>

            <?php
            if (isset($_POST['update'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $role = $_POST['role'];

                $userController->updateUser($userId, $name, $email, $role);
            }
            ?>
        </div>
    </div>
</div>

<footer class="footer mt-5 py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">© SchoolHub 2024</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
