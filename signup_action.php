<?php
// Database connection settings
$host = 'localhost'; // Database host
<<<<<<< HEAD
//$db = 'project_management_db';
=======
>>>>>>> c18bbe4efabbb4103e1c0706a2f2d2912b446159
$db = 'teams_management'; // Database name
$user = 'root'; // Database username
$pass = ''; // Database password

// Create a connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST['user_type'];
    
    // Check if the user type is student or staff/mentor etc.
    if ($user_type === 'student') {
        $identifier = $_POST['roll_number']; // Use roll_number for students
    } else {
        $identifier = $_POST['username']; // Use username for staff/mentors/etc.
    }
    
    $password = $_POST['password'];

    // Validate input
    if (empty($user_type) || empty($identifier) || empty($password)) {
        echo "All fields are required.";
        exit;
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Determine the table name and identifier column based on user type
    $table_name = '';
    $identifier_column = '';

    if ($user_type === 'student') {
        $table_name = 'students';
        $identifier_column = 'roll_number'; // Use roll_number for students
    } elseif ($user_type === 'mentor' || $user_type === 'hod' || $user_type === 'principal' || $user_type === 'ao') {
        $table_name = 'staff';
        $identifier_column = 'email'; // Use email for staff
    } else {
        echo "Invalid user type.";
        exit;
    }

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO $table_name ($identifier_column, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $identifier, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        // Display a success message
        echo "<script>alert('Registration successful! Redirecting to Sign In page...');</script>";
        
        // Redirect to the sign-in page after 3 seconds
        echo "<script>setTimeout(function() {
            window.location.href = 'signin.php';
        }, 1000);</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
}

// Close the database connection
$conn->close();

?>
