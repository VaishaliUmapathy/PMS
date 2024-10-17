<?php
$servername = "localhost";  // Your database server
$username = "root";  // Default username for XAMPP MySQL
$password = "";  // Default password is empty for XAMPP
$dbname = "project_management_db";  // Make sure this database exists

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
