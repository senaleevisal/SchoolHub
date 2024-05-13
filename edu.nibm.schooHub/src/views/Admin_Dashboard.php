<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin_dashboard.css">
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
                    <div class="text-white">Senalee Visal</div>
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
                                        Class</button>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-sm btn-outline-secondary mx-5" type="button" id="btn_admin_addUser_Class">Add Users to
                                        Class</button>
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
                                                <h3>Add A Class</h3>
                                                <p>Fill the Class data.</p>
                                                <form class="requires-validation" novalidate action="../controllers/add_class.php" method="POST">

                                                    <div class="col-md-12">
                                                        <input class="form-control" type="text" name="name" placeholder="Class Name" required>
                                                        <div class="valid-feedback">Username field is valid!</div>
                                                        <div class="invalid-feedback">Username field cannot be blank!
                                                        </div>
                                                    </div>


                                                    <div class="col-md-12 mt-4">
                                                        <input class="form-control" type="number" min="1800" max="2099" name="Year" placeholder="Year" required>
                                                        <div class="valid-feedback">Year field is valid!</div>
                                                        <div class="invalid-feedback">Year field cannot be blank!
                                                        </div>
                                                    </div>

                                                    <div class="form-check mt-4">
                                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                                        <label class="form-check-label">I confirm that all data are
                                                            correct</label>
                                                        <div class="invalid-feedback">Please confirm that the entered
                                                            data are all correct!</div>
                                                    </div>


                                                    <div class="form-button mt-3">
                                                        <button id="submit" type="submit" class="btn btn-primary">Add
                                                            Class</button>
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
                                <h4 class="text-white">Class List</h4>
                                <div id="admin_class_table_holder" class="">
                                    <?php
                                    include '../models/db.php';
                                    include '../controllers/ClassController.php';
                                    $classController = new ClassController();
                                    $classList = $classController->fetchClasses();

                                    ?>
                                    <table class="table" id="admin_class_table">
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
                                </div>
                            </div>
                            <div class="col-12 mt-4 container">
                                <div class="row">
                                    <div class="col-8">
                                        <h4 class="text-white">Class Users List</h4>
                                    </div>
                                    <div class="col-4 mb-1" id="btn_admin_addUser_Class">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                                            <i class="fa fa-plus-circle"></i> Add User
                                        </button>
                                    </div>
                                </div>
                                <div id="admin_class_user_table_holder" class="">
                                    <?php
                                    $usersList = $classController->getClass($class['class_id']);
                                    $class_id = $class['class_id'];
                                    ?>
                                    <table class="table" id="admin_class_user_table">
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
                                                    <form>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                                                            <input type="text" class="form-control" id="recipient-name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Message:</label>
                                                            <textarea class="form-control" id="message-text"></textarea>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Send message</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container rounded shadow-lg " id="admin_tab_classroom_AddSubjectsClass">
                            <div class="col-12 pt-4">
                                <h4 class="text-white">Class List</h4>
                                <div id="admin_class_table_holder" class="">
                                    <table id="admin_class_table">
                                        <thead>
                                        <tr>
                                            <th >Id</th>
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
                                </div>
                            </div>
                            <div class="col-12 mt-4 container">
                                <div class="row">
                                    <div class="col-8">
                                        <h4 class="text-white">Class Users List</h4>
                                    </div>
                                    <div class="col-4 mb-1" id="btn_admin_addUser_Class">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                                            <i class="fa fa-plus-circle"></i> Add User
                                        </button>
                                    </div>
                                </div>
                                <div id="admin_class_user_table_holder" class="">
                                    <table id="admin_class_user_table">
                                        <thead>
                                            <tr>
                                                <th>Class Name</th>
                                                <th>Student Count</th>
                                                <th>Teachers Count</th>
                                                <th>Year</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1A</td>
                                                <td>12</td>
                                                <td>2</td>
                                                <td>2024</td>
                                            </tr>
                                            <tr>
                                                <td>2B</td>
                                                <td>15</td>
                                                <td>3</td>
                                                <td>2023</td>
                                            </tr>
                                            <tr>
                                                <td>3C</td>
                                                <td>10</td>
                                                <td>1</td>
                                                <td>2022</td>
                                            </tr>
                                            <tr>
                                                <td>4D</td>
                                                <td>20</td>
                                                <td>4</td>
                                                <td>2021</td>
                                            </tr>
                                            <tr>
                                                <td>5E</td>
                                                <td>18</td>
                                                <td>3</td>
                                                <td>2020</td>
                                            </tr>
                                            <tr>
                                                <td>6F</td>
                                                <td>25</td>
                                                <td>5</td>
                                                <td>2019</td>
                                            </tr>
                                            <tr>
                                                <td>7G</td>
                                                <td>30</td>
                                                <td>6</td>
                                                <td>2018</td>
                                            </tr>
                                            <tr>
                                                <td>8H</td>
                                                <td>35</td>
                                                <td>7</td>
                                                <td>2017</td>
                                            </tr>
                                            <tr>
                                                <td>9I</td>
                                                <td>40</td>
                                                <td>8</td>
                                                <td>2016</td>
                                            </tr>
                                            <tr>
                                                <td>10J</td>
                                                <td>45</td>
                                                <td>9</td>
                                                <td>2015</td>
                                            </tr>
                                            <tr>
                                                <td>11K</td>
                                                <td>50</td>
                                                <td>10</td>
                                                <td>2014</td>
                                            </tr>
                                            <tr>
                                                <td>12L</td>
                                                <td>55</td>
                                                <td>11</td>
                                                <td>2013</td>
                                            </tr>
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
                                                    <form>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                                                            <input type="text" class="form-control" id="recipient-name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Message:</label>
                                                            <textarea class="form-control" id="message-text"></textarea>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Send message</button>
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
                                    <button class="btn btn-sm btn-outline-secondary mx-5" type="button" id="btn_admin_addUser_users">Add User</button>
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
                                                <h3>Add A User</h3>
                                                <p>Fill the User data.</p>
                                                <form class="requires-validation" action="../controllers/add_user.php" method="POST" novalidate>

                                                    <div class="col-md-12">
                                                        <input class="form-control" type="text" name="name" placeholder="Name" required>
                                                        <div class="valid-feedback">Name field is valid!</div>
                                                        <div class="invalid-feedback">Name field cannot be blank!</div>
                                                    </div>

                                                    <div class="col-md-12 mt-4">
                                                        <input class="form-control" type="email" name="email" placeholder="Email" required>
                                                        <div class="valid-feedback">Email field is valid!</div>
                                                        <div class="invalid-feedback">Email field cannot be blank!</div>
                                                    </div>

                                                    <div class="col-md-12 mt-4">
                                                        <select class="form-control" name="role" required>
                                                            <option value="">Select Role</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="principal">Principal</option>
                                                            <option value="teacher">Teacher</option>
                                                            <option value="student">Student</option>
                                                            <option value="parent">Parent</option>
                                                        </select>
                                                        <div class="valid-feedback">Role field is valid!</div>
                                                        <div class="invalid-feedback">Role field cannot be blank!</div>
                                                    </div>

                                                    <div class="col-md-12 mt-4">
                                                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                                                        <div class="valid-feedback">Password field is valid!</div>
                                                        <div class="invalid-feedback">Password field cannot be blank!</div>
                                                    </div>

                                                    <div class="form-button mt-3">
                                                        <button id="submit" type="submit" class="btn btn-primary">Add User</button>
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
                            <?php
                            include '../models/db.php';
                            include '../controllers/UserManagementController.php';
                            $userController = new UserManagementController();
                            $usersList = $userController->fetchAllUsers();
                            ?>
                            <h2 class="pt-4">User List</h2>
                            <div class="container " id="admin_user_table_holder">
                                <table class="table text-white" id="admin_class_table">
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
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="../../assets/js/admin_dashboard.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>