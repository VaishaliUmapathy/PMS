<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the additional details
    $degree = $_POST['degree'];
    $department = $_POST['department'];
    $domain = $_POST['domain'];
    $phone_number = $_POST['phone_number'];
    $email = $_SESSION['email']; // Store email in session during signup

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'project_managment_db');//$dbname = 'teams_management';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE mentors SET degree = ?, department = ?, domain = ?, phone_number = ? WHERE email = ?");
    $stmt->bind_param("sssss", $degree, $department, $domain, $phone_number, $email);
    
    if ($stmt->execute()) {
        // Redirect to mentor dashboard after successfully saving details
        header("Location: mentors_dash.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
