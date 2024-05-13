<?php
$servername = "localhost";
$username = "root";
$password = "Dsov@0506";
$dbname = "SchoolHub";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
