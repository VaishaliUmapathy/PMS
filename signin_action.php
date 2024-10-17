<?php
session_start(); // Start the session
require 'db.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['user_type'], $_POST['identifier'], $_POST['password'])) {
        $user_type = $_POST['user_type'];
        $identifier = $_POST['identifier']; 
        $password = $_POST['password'];

        // Prepare SQL based on user type
        if ($user_type == 'student') {
            $stmt = $conn->prepare("SELECT * FROM students WHERE roll_number = ?");
        } elseif ($user_type == 'staff') {
            $stmt = $conn->prepare("SELECT * FROM staff WHERE email = ?");
        } elseif ($user_type == 'mentor') {
            $stmt = $conn->prepare("SELECT * FROM mentors WHERE email_id = ?");
        } else {
            echo "Invalid user type.";
            exit();
        }

        $stmt->bind_param("s", $identifier);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_type'] = $user_type; 
                $_SESSION['identifier'] = $identifier; 
                $_SESSION['user_id'] = $user['id']; // Assuming you have an 'id' field

                // Redirect to the appropriate dashboard
                if ($user_type == 'student') {
                    header("Location: stud_dash.php");
                } elseif ($user_type == 'staff') {
                    header("Location: mentors_profile.php");
                } elseif ($user_type == 'mentor') {
                    header("Location: mentors_dash.php");
                }
                exit();
            } else {
                echo "Invalid credentials. Please try again. (Password verification failed)";
            }
        } else {
            echo "Invalid credentials. Please try again. (No matching user found)";
        }
    } else {
        echo "Please fill in all fields.";
    }
}

// Close the database connection
$conn->close();
