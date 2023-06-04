<?php
$host = "localhost";
$admin = "root";
$password = "";
$database = "jobs";

// Establish a reusable database connection
$conn = new mysqli($host, $admin, $password, $database);

if ($conn->connect_error) {
    die("Database Connection Error: " . $conn->connect_error);
}
?>
