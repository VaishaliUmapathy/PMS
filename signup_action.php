<?php
// Database connection settings
$host = 'localhost'; // Database host
$db = 'pms'; // Database name
$user = 'root'; // Database username
$pass = ''; // Database password

// Create a connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST['user_type'];
    $identifier = $_POST['identifier'];
    $password = $_POST['password'];

    // Validate input
    if (empty($user_type) || empty($identifier) || empty($password)) {
        echo "All fields are required.";
        exit;
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Determine the table name based on user type
    $table_name = '';
    if ($user_type === 'student') {
        $table_name = 'students';
    } elseif ($user_type === 'mentor') {
        $table_name = 'mentors';
    } elseif ($user_type === 'staff') {
        $table_name = 'staff';
    } elseif ($user_type === 'hod') {
        // Handle HOD if applicable
        $table_name = 'hod'; // Replace with the actual table name for HOD
    } elseif ($user_type === 'principal') {
        // Handle Principal if applicable
        $table_name = 'principal'; // Replace with the actual table name for Principal
    } elseif ($user_type === 'admin') {
        // Handle Admin if applicable
        $table_name = 'admin'; // Replace with the actual table name for Admin
    } else {
        echo "Invalid user type.";
        exit;
    }

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO $table_name (identifier, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $identifier, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";

        // Redirect based on user type
        if ($user_type === 'student') {
            header("Location: stud_dash.php");
        } elseif ($user_type === 'mentor') {
            header("Location: mentors_dash.php");
        } elseif ($user_type === 'staff') {
            header("Location: mentors_details.php"); // Adjust if you have a staff dashboard
        } elseif ($user_type === 'hod') {
            header("Location: hod_dash.php"); // Adjust if you have an HOD dashboard
        } elseif ($user_type === 'principal') {
            header("Location: principal_dash.php"); // Adjust if you have a Principal dashboard
        } elseif ($user_type === 'admin') {
            header("Location: admin_dash.php"); // Adjust if you have an Admin dashboard
        }
        exit; // Ensure no further code is executed after redirection
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
