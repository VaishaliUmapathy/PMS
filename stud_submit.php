<?php 
// Include database connection file
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Debug: Check if data is received
    var_dump($_POST);
    var_dump($_FILES);
    exit; // Stop further execution for debugging

    // Retrieve form data
    $title = $_POST['title'];
    $leader = $_POST['leader'];
    $members = $_POST['members'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $abstract = $_POST['abstract'];

    // Handle file upload
    $ppt = $_FILES['ppt']['name'];
    $target_dir = "uploads/"; // Specify your upload directory
    $target_file = $target_dir . basename($ppt);
    
    // Check file upload errors
    if ($_FILES['ppt']['error'] !== UPLOAD_ERR_OK) {
        echo "File upload error: " . $_FILES['ppt']['error'];
        exit;
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['ppt']['tmp_name'], $target_file)) {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO projects_submissions (title, leader, members, start_date, end_date, ppt, abstract) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $title, $leader, $members, $start_date, $end_date, $target_file, $abstract);

        // Execute the query
        if ($stmt->execute()) {
            echo "New project submitted successfully.";
        } else {
            echo "Error: " . $stmt->error; // Show any SQL errors
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error uploading file.";
    }
}

// Close connection
$conn->close();
?>
