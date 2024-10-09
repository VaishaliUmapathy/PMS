<?php
// update_approval.php

// Include database connection
include 'db_connection.php'; // Ensure you have your database connection script

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the project ID and action from the POST request
    $project_id = isset($_POST['project_id']) ? intval($_POST['project_id']) : 0; // Ensure it's an integer
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    // Validate the action
    if ($action === 'approve' || $action === 'disapprove') {
        // Prepare SQL query to update the approval status
        $approval_status = ($action === 'approve') ? 'approved' : 'disapproved'; // Use appropriate status values

        // Create a prepared statement
        if ($stmt = $conn->prepare("UPDATE projectsapproval SET approval_status = ?, updated_at = NOW() WHERE id = ?")) {
            $stmt->bind_param("si", $approval_status, $project_id);

            // Execute the statement
            if ($stmt->execute()) {
                // Return success response in JSON format
                echo json_encode(['status' => 'success', 'message' => 'Approval status updated successfully']);
            } else {
                // Return error response in JSON format
                echo json_encode(['status' => 'error', 'message' => 'Error executing query: ' . $stmt->error]);
            }

            // Close the statement
            $stmt->close();
        } else {
            // Return error response if statement preparation fails
            echo json_encode(['status' => 'error', 'message' => 'Error preparing statement']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

// Close the database connection
$conn->close();
?>
