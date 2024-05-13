<?php global $conn;
include '../controllers/DashboardController.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SchoolHub</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
            <?php if (isset($_SESSION['school_logo'])) : ?>
                <img src="data:image/png;base64,<?php echo $_SESSION['school_logo']; ?>" height="32">
                <?php echo $_SESSION['school_name']; ?>
            <?php else : ?>
                <?php echo $_SESSION['school_name']; ?>
            <?php endif; ?>
        </a>
        <div class="w-100"> </div>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="users/SignOut.php">Sign out</a>
            </div>
        </div>
    </header>
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="height: 95vh">
            <?php if ($userRole == 'admin') : ?>
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item active" onclick="showDashboard()">
                            <a class="nav-link active text-black-50" aria-current="page" href="#" >
                                <img src="../../assets/dashboard.png" height="24">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item" onclick="showUsers()">
                            <a class="nav-link text-black-50" href="#" >
                                <img src="../../assets/users.png" height="24">
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black-50" href="#" onclick="showClasses()">
                                <img src="../../assets/class.png" height="24">
                                Classes
                            </a>
                        </li>
                    </ul>
                </div>
                <script>
                    function showDashboard() {
                        document.getElementById("dashboardContent").style.display = "block";
                        document.getElementById("usersContent").style.display = "none";
                        document.getElementById("classesContent").style.display = "none";
                        document.getElementById("schoolContent").style.display = "none";
                    }

                    function showUsers() {
                        document.getElementById("dashboardContent").style.display = "none";
                        document.getElementById("usersContent").style.display = "block";
                        document.getElementById("classesContent").style.display = "none";
                        document.getElementById("schoolContent").style.display = "none";
                    }

                    function showClasses() {
                        document.getElementById("dashboardContent").style.display = "none";
                        document.getElementById("usersContent").style.display = "none";
                        document.getElementById("classesContent").style.display = "block";
                        document.getElementById("schoolContent").style.display = "none";
                    }
                </script>
            <?php elseif ($userRole == 'student') : ?>
                <!-- side controll panel for students -->
            <?php elseif ($userRole == 'teacher') : ?>

                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showPanel('manageCoursesPanel');">
                                <span data-feather="home"></span>
                                classes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showPanel('postAssignmentsPanel');">
                                <span data-feather="file"></span>
                                Add Exam
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showPanel('gradeAssignmentsPanel');">
                                <span data-feather="bar-chart-2"></span>
                                Grade Exam
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showPanel('addSubjectsPanel');">
                                <span data-feather="layers"></span>
                                Add Subjects
                            </a>
                        </li>
                    </ul>
                </div>
                <script>
                    feather.replace(); // Activates feather icons

                    function showPanel(panelId) {
                        // Hide all panels
                        document.querySelectorAll('.content-panel').forEach(function(panel) {
                            panel.style.display = 'none';
                        });
                        // Show the selected panel
                        document.getElementById(panelId).style.display = 'block';
                    }
                </script>
            <?php elseif ($userRole == 'principal') : ?>

            <?php elseif ($userRole == 'parent') : ?>

            <?php endif; ?>
        </nav>
        <div class="container col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="row">
                <div class="col-12">
                    <h2>Welcome, <?php echo htmlspecialchars($userName); ?>!</h2>
                    <p>Your role: <strong><?php echo htmlspecialchars($userRole); ?></strong></p>
                </div>
            </div>

            <?php if ($userRole == 'teacher') : ?>
            <div id="gradeAssignmentsPanel" class="content-panel" style="display: none;">
                <h3>Grade Students</h3>
                <form id="gradeStudentsForm" action="../controllers/saveGrades.php" method="post">
                    <div class="form-group">
                        <label for="classId">Select Class:</label>
                        <input type="number" class="form-control" id="classId" name="classId" required onchange="loadExams(this.value) && loadStudents(this.value)">
                    </div>
                    <div class="form-group">
                        <label for="examId">Select exam:</label>
                        <select class="form-control" id="examId" name="examId">
                        </select>
                    </div>
                    <div id="studentsList">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Grades</button>
                </form>
            </div>
            <script>
                function loadExams(classId) {
                    fetch(`../controllers/fetchExams.php?classId=${classId}`)
                        .then(response => response.json())
                        .then(data => {
                            const examSelect = document.getElementById('examId');
                            examSelect.innerHTML = '<option value="">Select an Exam</option>';

                            data.forEach(exam => {
                                let option = new Option(exam.exam_id);
                                examSelect.add(option);
                            });
                        })
                        .catch(error => console.error('Error fetching exams:', error));
                }
            </script>

            <script>
                function loadStudents(classId) {
                    fetch(`../controllers/fetchStudents.php?classId=${classId}`)
                        .then(response => response.json())
                        .then(data => {
                            const studentsListDiv = document.getElementById('studentsList');
                            studentsListDiv.innerHTML = '';

                            data.forEach(student => {
                                studentsListDiv.innerHTML += `
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">${student.name} (ID: ${student.student_id})</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="grades[${student.student_id}]" placeholder="Enter grade">
                    </div>
                </div>
            `;
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }
            </script>


            <div id="postAssignmentsPanel" class="content-panel" style="display: none;">
                <h3>Add Exam</h3>
                <form id="addExamForm" action="../controllers/addExam.php" method="post">
                    <div class="form-group">
                        <label for="classId">Class ID</label>
                        <input type="number" class="form-control" id="classId" name="classId" required onchange="fetchSubjects(this.value)">
                    </div>
                    <div class="form-group">
                        <label for="subjectId">Subject</label>
                        <select class="form-control" id="subjectId" name="subjectId" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="examDate">Exam Date</label>
                        <input type="date" class="form-control" id="examDate" name="examDate" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Schedule Exam</button>
                </form>
            </div>
            <script>
                function fetchSubjects(classId) {
                    fetch('../controllers/fetchSubjects.php?classId=' + classId)
                        .then(response => response.json())
                        .then(subjects => {
                            const subjectSelect = document.getElementById('subjectId');
                            subjectSelect.innerHTML = '';
                            subjects.forEach(subject => {
                                const option = new Option(subject.name, subject.subject_id);
                                subjectSelect.add(option);
                            });
                        })
                        .catch(error => console.error('Error fetching subjects:', error));
                }
            </script>

                <div id="addSubjectsPanel" class="content-panel" style="display: none;" >
                    <h3>Add Subjects</h3>
                    <form id="addSubjectForm" action="../controllers/addSubject.php" method="post">
                        <div class="form-group">
                            <label for="classId">Class</label>
                            <input type="number" class="form-control" id="classId" name="classId" required>
                        </div>
                        <div class="form-group">
                            <label for="subjectName">Subject Name</label>
                            <input type="text" class="form-control" id="subjectName" name="subjectName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Subject</button>
                    </form>
                </div>
                <div id="manageCoursesPanel" class="content-panel" style="display: none;">
                    <?php
                    include '../models/db.php';
                    include '../controllers/ClassController.php';
                    $classController = new ClassController();
                    $classList = $classController->fetchClasses();
                    ?>
                    <div class="container mt-5">
                        <h2>Classes</h2>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($classList as $class) : ?>
                                    <tr>
                                        <th scope="row"><?php echo htmlspecialchars($class['class_id']); ?></th>
                                        <td><?php echo htmlspecialchars($class['name']); ?></td>
                                        <td><?php echo htmlspecialchars($class['year']); ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" onclick="showClassDetails(<?php echo $class['class_id']; ?>)">View Details</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <script>
                    function showClassDetails(classId) {
                        document.getElementById("classDetailsPanel").style.display = "block";
                    }
                        </script>
                        <div id="classDetailsPanel" style="display: none;">
                            <?php
                            include '../models/db.php';
                            $usersList = $classController->getClass($class['class_id']);
                            $class_id = $class['class_id'];
                            ?>
                            <div class="container mt-5">
                                <h2>User Management</h2>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($usersList as $user) : ?>
                                        <tr>
                                            <th scope="row"><?php echo $user['user_id']; ?></th>
                                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                                            <td><?php echo htmlspecialchars($user['role']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                



            <?php elseif ($userRole == 'student') : ?>

            <?php elseif ($userRole == 'principal') : ?>

            <?php elseif ($userRole == 'parent') : ?>

            <?php elseif ($userRole == 'admin') : ?>
                <div id="dashboardContent" >
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Admin Dashboard</h3>
                            <p>Manage the SchoolHub system effectively with the tools provided below.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Manage Users</h5>
                                    <p class="card-text">Add, remove, or modify user accounts.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Manage Classes</h5>
                                    <p class="card-text">Create new classes, assign teachers, and more.</p>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">View Reports</h5>
                                    <p class="card-text">Access detailed reports on system usage and performance.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="usersContent" style="display: none;">
                    <?php
                    include '../models/db.php';
                    include '../controllers/UserManagementController.php';
                    $userController = new UserManagementController();
                    $usersList = $userController->fetchAllUsers();
                    ?>
                    <div class="container mt-5">
                        <h2>User Management</h2>
                        <a href="./users/AddUser.php" class="btn btn-primary mb-3">Add New User</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usersList as $user) : ?>
                                    <tr>
                                        <th scope="row"><?php echo $user['user_id']; ?></th>
                                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                                        <td>
                                            <a href="./users/EditUser.php?id=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="./users/DeleteUser.php?id=<?php echo $user['user_id'] ?>;" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="classesContent" style="display: none;">
                    <?php
                    include '../models/db.php';
                    include '../controllers/ClassController.php';
                    $classController = new ClassController();
                    $classList = $classController->fetchClasses();
                    ?>
                    <div class="container mt-5">
                        <h2>Classes</h2>
                        <a href="#" class="btn btn-primary mb-3" onclick="showAddClassForm()">Add New Class</a>

                        <script>
                            function showAddClassForm() {
                                var form = `
                                                    <form action="./class/AddClass.php" method="POST">
                                                        <div class="form-group">
                                                            <label for="name">Class Name</label>
                                                            <input type="text" class="form-control" id="name" name="name" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="year">Year</label>
                                                            <input type="text" class="form-control" id="year" name="year" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </form>
                                                `;
                                document.getElementById("classesContent").innerHTML = form;
                            }
                        </script>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($classList as $class) : ?>
                                    <tr>
                                        <th scope="row"><?php echo htmlspecialchars($class['class_id']); ?></th>
                                        <td><?php echo htmlspecialchars($class['name']); ?></td>
                                        <td><?php echo htmlspecialchars($class['year']); ?></td>
                                        <td>
                                            <a href="./class/EditClass.php?id=<?php echo $class['class_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <button class="btn btn-sm btn-primary" onclick="showClassDetails(<?php echo $class['class_id']; ?>)">View Details</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <script>
                    function showClassDetails(classId) {
                        document.getElementById("classDetailsPanel").style.display = "block";
                    }
                    showDashboard();
                </script>
                    </div>
                </div>

                <div id="classDetailsPanel" style="display: none;">
                <?php
                    include '../models/db.php';
                    $usersList = $classController->getClass($class['class_id']);
                    $class_id = $class['class_id'];
                    ?>
                    <div class="container mt-5">
                        <h2>User Management</h2>
                        <a href="./class/AddUser.php?class_id=<?php echo $class['class_id']; ?>" class="btn btn-primary mb-3">Add New User</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usersList as $user) : ?>
                                    <tr>
                                        <th scope="row"><?php echo $user['user_id']; ?></th>
                                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                


                

            <?php endif; ?>
        </div>
    </div>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>