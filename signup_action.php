<?php
session_start();

// Database connection settings
$host = 'localhost'; 
$db = 'teams_management'; 
$user = 'root'; 
$pass = ''; 

// Create a connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST['user_type'];
    
    // Check if the user type is student or staff/mentor
    if ($user_type === 'student') {
        $identifier = $_POST['roll_number']; // For students, use roll_number
        $identifier_column = 'roll_number';
        $table_name = 'students';
    } else {
        $identifier = $_POST['username']; // For staff/mentors, use username (email)
        $identifier_column = 'email';
        $table_name = 'staff';
    }

    $password = $_POST['password'];

    // Validate input
    if (empty($user_type) || empty($identifier) || empty($password)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare a SQL statement to retrieve the user record securely
    $stmt = $conn->prepare("SELECT * FROM $table_name WHERE $identifier_column = ?");
    $stmt->bind_param("s", $identifier);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id']; // Assuming 'id' is the primary key
            $_SESSION['role'] = $user_type;
            $_SESSION['user'] = $user;
            $_SESSION['name'] = $user['name'] ?? $identifier; // Set the name or identifier
            $_SESSION['roll_number'] = $user['roll_number'] ?? ''; // Only for students

            // Redirect to the appropriate dashboard
            if ($user_type === 'student') {
                header("Location: stud_dash.php");
            } else {
                header("Location: staff_dash.php");
            }
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with the given identifier.";
    }

    // Close the statement and connection
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
