<?php
// Database connection
$servername = "localhost";
$username = "root"; // Your DB username
$password = ""; // Your DB password
$dbname = "project_management_db"; // Your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$team_id = $_POST['team_id'];
$team_name = $_POST['team_name'];
$department = $_POST['department'];
$year = $_POST['year'];
$semester = $_POST['semester'];
$team_members = $_POST['team_members'];
$action = $_POST['action'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO team_approval (team_id, team_name, department, year, semester, team_members, action) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssiiss", $team_id, $team_name, $department, $year, $semester, $team_members, $action);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $stmt->error]);
}

// Close connection
$stmt->close();
$conn->close();
?>
