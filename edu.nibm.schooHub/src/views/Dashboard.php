<?php
session_start();
include('../models/db.php'); // Include your database connection settings

if (!isset($_SESSION['role'])) {
    // If no role defined in session, redirect to login
    header('Location: login.php');
    exit;
}

// Depending on the role, include the corresponding dashboard
switch ($_SESSION['role']) {
    case 'admin':
        include('Principle_Dashboard.php');
        break;
    case 'teacher':
        include('Teacher_Dashboard.php');
        break;
    case 'principle':
        include('Principle_Dashboard.php');
        break;
    default:
        echo "Access Denied: Your role is not recognized.";
        break;
}
?>
