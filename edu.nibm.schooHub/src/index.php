<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SchoolHub Home</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#"><img src="../assets/Logo.png" class="rounded" style="width: 10vh;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item margin mx-3 active">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item mx-3 ">
                <a class="nav-link" href="views/About.html">About</a>
            </li>
            <li class="nav-item mx-3 mr-5 ">
                <a class="nav-link" href="views/Contact.html">Contact</a>
            </li>
            <li class="nav-item mx-1" style="width: 85px">
                <a class="nav-link btn btn-success" href="views/Login.html">Login</a>
            </li>
            <li class="nav-item mx-1 " style="width: 85px">
                <a class="nav-link btn btn-secondary" href="views/Register.html" style="margin-left: 10px;">Register</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid mt-5 text-white">
    <div class="jumbotron" style="background: url(../assets/cover.png)">
        <h1 class="display-4">Welcome to SchoolHub!</h1>
        <p class="lead">Your one-stop solution for managing educational activities seamlessly.</p>
        <hr class="my-4">
        <p>Explore features, manage classes, track progress, and much more.</p>
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </div>
</div>

<div class="container d-flex align-items-center text-center" style="height: 50vh;">
    <div class="row">
        <div class="col-md-12">
            <h2>About SchoolHub</h2>
            <p>SchoolHub is an integrated platform designed to facilitate efficient management of educational institutions, encompassing administrative operations, classroom management, student progress tracking, and enhanced communication between teachers, students, and parents.</p>
        </div>
    </div>
</div>

<footer class="footer mt-5 py-3 bg-light position-absolute" style="bottom: 0vh; width: 100vw">
    <div class="container text-center">
        <span class="text-muted">© SchoolHub 2024</span>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
