<?php
$host = 'localhost';
$user = 'root';
$password = '';
<<<<<<< HEAD
$dbname = 'project_management_db';
=======
$dbname = 'teams_management';
>>>>>>> 184fa70 (profiles pages were updated)

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
