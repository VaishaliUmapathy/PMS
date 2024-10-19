<?php
// Start the session
session_start();
include('db.php');

// Fetch mentor data
$query = "SELECT name, email FROM mentors"; 
$result = mysqli_query($conn, $query);
$mentors = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $mentors[] = $row; // Store mentor data in an array
    }
} else {
    echo "No mentors found."; 
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $leader = mysqli_real_escape_string($conn, $_POST['leader']);
    $members = mysqli_real_escape_string($conn, $_POST['members']);
    $mentor_email = mysqli_real_escape_string($conn, $_POST['mentor']); 
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    
    // Handle file upload for PPT
    $ppt = $_FILES['ppt'];
    $ppt_name = basename($ppt['name']);
    $ppt_tmp_name = $ppt['tmp_name'];
    $ppt_error = $ppt['error'];
    $ppt_size = $ppt['size'];

    // Define upload directory
    $upload_directory = 'uploads/';
    
    // Validate file type and size (optional: adjust the allowed types and size as needed)
    $allowed_types = ['application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'];
    $ppt_file_type = mime_content_type($ppt_tmp_name);
    
    if ($ppt_error === 0) {
        if (in_array($ppt_file_type, $allowed_types) && $ppt_size <= 2 * 1024 * 1024) { // 2 MB limit
            // Move uploaded file to the designated directory
            if (move_uploaded_file($ppt_tmp_name, $upload_directory . $ppt_name)) {
                // Display success message
                echo "<h1>Submission Successful!</h1>";
                echo "<h2>Your project details have been submitted successfully!</h2>";
                echo "<strong>Title:</strong> $title<br>";
                echo "<strong>Project Leader:</strong> $leader<br>";
                echo "<strong>Project Members:</strong> $members<br>";
                echo "<strong>Mentor Email:</strong> $mentor_email<br>";
                echo "<strong>Start Date:</strong> $start_date<br>";
                echo "<strong>End Date:</strong> $end_date<br>";
                echo "<strong>PPT Uploaded:</strong> $ppt_name<br>";
                
                // Email notification
                $subject = "New Project Submission from $leader";
                $message = "A new project has been submitted:\n\nTitle: $title\nLeader: $leader\nMembers: $members\nStart Date: $start_date\nEnd Date: $end_date\nPPT: $ppt_name";
                $headers = "From: noreply@yourdomain.com"; 
               
                // Send email to mentor
                if (mail($mentor_email, $subject, $message, $headers)) {
                    echo "Email sent to mentor successfully.";
                } else {
                    echo "Failed to send email.";
                }

                // Redirect to the dashboard after 3 seconds
                echo "<script>
                        setTimeout(function() {
                            window.location.href = 'stud_dash.php';
                        }, 3000);
                      </script>";
            } else {
                echo "Failed to upload PPT file.";
            }
        } else {
            echo "Invalid file type or size exceeds limit.";
        }
    } else {
        echo "Error in file upload.";
    }
} else {
    echo "Invalid request.";
}
?>
