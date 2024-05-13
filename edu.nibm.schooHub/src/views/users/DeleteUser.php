<?php
include '../../models/db.php';
include '../../controllers/UserManagementController.php';
session_start();
$userId = $_GET['id'];
$userController = new UserManagementController();
$userController->deleteUser($userId);
header("Location: ../Dashboard.php");