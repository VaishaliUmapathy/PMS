<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'project_management_db';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
