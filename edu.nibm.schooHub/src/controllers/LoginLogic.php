<?php
global $conn;
include '../models/db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $stmt = $conn->prepare("SELECT user_id, password_hash, role, name, school_id  FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password, $role, $name , $school_id);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['role'] = $role;
            $_SESSION['name'] = $name;
            $_SESSION['school_id'] = $school_id;

            $query = "SELECT logo, name FROM schools WHERE school_id = ?";
            $stmt = $conn->prepare($query);
            $i = 1;
            $stmt->bind_param("i", $i);
            $stmt->execute();
            $result = $stmt->get_result();
            $school =  $result->fetch_assoc();

            echo htmlspecialchars($school['name']);

            if ($school['logo'] !== false) {
                $_SESSION['school_logo'] = base64_encode($school['logo']);
            } else {
                $_SESSION['school_logo'] = '../../assets/img/school.png';
            }


            $_SESSION['school_name'] = $school['name'];
            header("Location: ../views/Dashboard.php");
            exit;
        } else {
            echo "<script>alert('Error: " . "Invalid email or password.". "'); window.location.href = '../views/Login.html';</script>";
        }
    } else {
        echo "<script>alert('Error: " . "Invalid email or password.". "'); window.location.href = '../views/Login.html';</script>";
    }

    $stmt->close();
    $conn->close();


}

