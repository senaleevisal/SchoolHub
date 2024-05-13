<?php
session_start();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/principle_dashboard.css">
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
                        Reports
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

            </div>

        </div>
    </div>
    <script src="../../assets/js/principle_dashboard.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>