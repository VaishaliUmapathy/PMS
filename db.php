<?php
$host = 'localhost';
$user = 'root';
<<<<<<< HEAD
$password = '';
<<<<<<< HEAD
$dbname = 'project_management_db';
=======
$dbname = 'teams_management';
>>>>>>> 184fa70 (profiles pages were updated)
=======
$password = ''; // Set this to your root password if you have one
$dbname = 'project_management_db'; // Ensure this is your correct database name
>>>>>>> 8349245 (the submission and editor page is created)

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// Close the connection when done

?>
