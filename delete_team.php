<?php
$host = 'localhost'; 
$username = 'root'; 
$password = ''; 
$database = 'project_management_db'; 

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$team_id = $_GET['team_id'];

// Delete the team and its members
$conn->query("DELETE FROM teams WHERE id = $team_id");
$conn->query("DELETE FROM team_members WHERE team_id = $team_id");

$conn->close();

http_response_code(200); // Send OK status
?>
