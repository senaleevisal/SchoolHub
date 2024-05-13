<?php
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/teacher_dashboard.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <title>SchoolHub</title>
</head>

<body>

<!-- --------- Navbar ------------ -->
<nav class="navbar navbar-expand-lg navbar-dark shadow">
    <a class="navbar-brand" href="#"><img src="../../assets/Logo.png" class="rounded" width="60"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item margin mx-3 active">
                <div class="text-white">
                    <?php if (isset($_SESSION['school_logo'])) : ?>
                        <img src="data:image/png;base64,<?php echo $_SESSION['school_logo']; ?>" height="32">
                        <?php echo $_SESSION['school_name']; ?>
                    <?php else : ?>
                        <?php echo $_SESSION['school_name']; ?>
                    <?php endif; ?>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="row">

    <!-- --------- Side Button panel ------------ -->
    <div class="col-2">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white " id="sidebar">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <img class="ml-2" src="../../assets/profile.png" width="40" />
                <span class="ml-3">Sidebar</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a id="admin_btn_home" class="nav-link text-white bg-dark ml-3 text-center mt-3" aria-current="page">
                        Home
                    </a>
                </li>
                <li>
                    <a id="admin_btn_classroom" class="nav-link text-white bg-dark ml-3 text-center mt-4" aria-current="page">
                        Classroom
                    </a>
                </li>
                <li>
                    <a id="admin_btn_Users" class="nav-link text-white bg-dark ml-3 text-center mt-4">
                        Users
                    </a>
                </li>
            </ul>
            <hr>
            <div class="text-black-50 text-sm-center">
                <h6>© senalee Visal</h6>
            </div>
        </div>
    </div>

    <!-- --------- Content panel ------------ -->
    <div class="col-10">
        <div class="tab-content" id="v-pills-tabContent">

            <!-- --------- Home tab ------------ -->
            <div class="d-none" id="admin_tab-home" role="tabpanel">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-6">
                            <canvas id="users" style="width:100%;max-width:600px"></canvas>
                        </div>
                        <div class="col-6">
                            <canvas id="progress" style="width:100%;max-width:600px"></canvas>
                        </div>
                    </div>
                    <?php
                    include('../controllers/class_user_count.php');
                    ?>
                    <div id="admin_home_table_container" class="mt-4">
                        <table id="admin_home_table">
                            <tr>
                                <th>Class Name</th>
                                <th>Student Count</th>
                                <th>Teachers Count</th>
                                <th>Year</th>
                            </tr>
                            <?php
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['class_name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['student_count']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['teacher_count']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['year']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No data available</td></tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>

            <!-- --------- Classroom tab ------------ -->
            <div class="d-none" id="admin_tab-classroom" role="tabpanel">
                <div>
                    <div class="container p-2 rounded shadow" id="admin_calssroom_navbar">
                        <div class="row text-center">
                            <div class="col-4">
                                <button class="btn btn-sm btn-outline-secondary mx-5" type="button" id="btn_admin_addclass_Class">Add
                                    subject</button>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-sm btn-outline-secondary mx-5" type="button" id="btn_admin_addUser_Class">Subject List</button>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-sm btn-outline-secondary mx-5" type="button" id="btn_admin_addSubjects_Class">Add Subjects to
                                    Class</button>
                            </div>
                        </div>
                    </div>
                    <div class="container rounded shadow-lg d-none" id="admin_tab_classroom_addClass">
                        <div class="form-body">
                            <div class="row">
                                <div class="form-holder">
                                    <div class="form-content">
                                        <div class="form-items">
                                            <h3>Add A subject</h3>
                                            <p>Fill the subject data.</p>
                                            <form action="../controllers/teacher_actions.php" method="post">
                                                <input type="hidden" name="action" value="add_subject">
                                                <div class="form-group">
                                                    <label for="subject_name">Subject Name:</label>
                                                    <input type="text" id="subject_name" name="subject_name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="class_id">Class ID:</label>
                                                    <input type="number" id="class_id" name="class_id" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Add Subject</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="container rounded shadow-lg d-none" id="admin_tab_classroom_AddUsersClass">
                        <div class="col-12 pt-4">
                            <h4 class="text-white">Subject List</h4>
                            <div id="admin_class_table_holder" class="">

                                <table class="table" id="admin_class_table">
                                    <thead>
                                    <tr>
                                        <th>Subject ID</th>
                                        <th>Name</th>
                                        <th>Class ID</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include '../models/db.php'; // Make sure this file has the correct database connection setup

                                    // Create query to fetch all subjects
                                    $query = "SELECT * FROM subjects ORDER BY class_id";
                                    $result = $conn->query($query);

                                    // Check if there are any results
                                    if ($result->num_rows > 0) {
                                        // Output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["subject_id"] . "</td>";
                                            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                                            echo "<td>" . $row["class_id"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>No subjects found</td></tr>";
                                    }
                                    $conn->close();
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container rounded shadow-lg " id="admin_tab_classroom_AddSubjectsClass">
                        <div class="col-12 mt-4 container">
                            <div class="row">
                                <div class="col-8 pt-4">
                                    <h4 class="text-white">Exam List</h4>
                                </div>
                                <div class="col-4 mb-1 pt-4" id="btn_admin_addUser_Class">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                                        <i class="fa fa-plus-circle"></i> Add User
                                    </button>
                                </div>
                            </div>
                            <div id="admin_class_user_table_holder" class="">
                                <table id="admin_class_user_table">
                                    <thead>
                                    <tr>
                                        <th>Exam Name</th>
                                        <th>Subject</th>
                                        <th>Exam Date</th>
                                        <th>Class</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                     <?php
                                     include '../controllers/exam_list.php'
                                    ?>
                                    </tbody>
                                </table>

                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../controllers/add_exam.php" method="post">
                                                    <div class="form-group">
                                                        <label for="exam-name" class="col-form-label">Exam Name:</label>
                                                        <input type="text" class="form-control" id="exam-name" name="exam_name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exam-date" class="col-form-label">Exam Date:</label>
                                                        <input type="date" class="form-control" id="exam-date" name="exam_date" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="subject-id" class="col-form-label">Subject ID:</label>
                                                        <input type="number" class="form-control" id="subject-id" name="subject_id" required>
                                                    </div>
                                                    <div class="form-button mt-3">
                                                        <button type="submit" class="btn btn-primary">Add Exam</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- --------- Users tab ------------ -->
            <div class="d-none" id="admin_tab-Users" role="tabpanel">
                <div class="container">
                    <div class="container p-2 rounded shadow" id="admin_calssroom_navbar">
                        <div class="row text-center">
                            <div class="col-6">
                                <button class="btn btn-sm btn-outline-secondary mx-5" type="button" id="btn_admin_addUser_users">Add User result</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-sm btn-outline-secondary mx-5" type="button" id="btn_admin_updateUser_users">User List</button>
                            </div>
                        </div>
                    </div>

                    <!-- --------- Add User tab ------------ -->
                    <div class="container rounded shadow-lg d-none" id="admin_tab_addUser_User">
                        <div class="form-body">
                            <div class="row">
                                <div class="form-holder">
                                    <div class="form-content">
                                        <div class="form-items">
                                            <h3>Add A User Result</h3>
                                            <p>Fill the User data.</p>
                                            <form action="../controllers/add_result.php" method="post" novalidate >
                                                <div class="form-group">
                                                    <label for="exam-id">Exam ID:</label>
                                                    <input type="number" class="form-control" id="exam-id" name="exam_id" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="student-id">Student ID:</label>
                                                    <input type="number" class="form-control" id="student-id" name="student_id" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="score">Score:</label>
                                                    <input type="text" class="form-control" id="score" name="score" required>
                                                </div>
                                                <div class="form-button mt-3">
                                                    <button type="submit" class="btn btn-primary">Submit Result</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- --------- User List tab ------------ -->
                    <div class="container rounded shadow-lg d-none" id="admin_tab_updateUser_User">
                        <div class="form-body">
                            <div class="row">
                                <div class="form-holder">
                                    <div class="form-content">
                                        <div class="form-items">
                                            <h3>Add A User record</h3>
                                            <p>Fill the User data.</p>
                                            <form action="../controllers/add_records.php" method="post" novalidate>
                                                <div class="form-group">
                                                    <label for="record-type">Record Type:</label>
                                                    <select class="form-control" id="record-type" name="record_type" required>
                                                        <option value="">Select Type</option>
                                                        <option value="violation">School Rule Violation</option>
                                                        <option value="achievement">Achievement</option>
                                                        <option value="activity">Extracurricular Activity</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="student-id">Student ID:</label>
                                                    <input type="number" class="form-control" id="student-id" name="student_id" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description:</label>
                                                    <textarea class="form-control" id="description" name="description" required></textarea>
                                                </div>
                                                <div class="form-group" id="date-group" style="display: none;">
                                                    <label for="violation-date">Date:</label>
                                                    <input type="date" class="form-control" id="violation-date" name="violation_date">
                                                </div>
                                                <div class="form-button mt-3">
                                                    <button type="submit" class="btn btn-primary">Submit Record</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="../../assets/js/teacher_dashboard.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>