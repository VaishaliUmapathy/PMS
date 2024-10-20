<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'teams_management';
//$dbname = 'teams_management_db';


// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// Close the connection when done

?>
