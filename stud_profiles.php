<?php
// Database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "teams_management"; 
<<<<<<< HEAD
// $dbname = "project_management_db"; Database connection
=======

>>>>>>> c18bbe4efabbb4103e1c0706a2f2d2912b446159
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Debugging output: Print the entire URL
echo "Current URL: " . $_SERVER['REQUEST_URI'] . "<br>";

// Check if roll_number is set in the URL
if (isset($_GET['roll_number'])) {
    $roll_number = $_GET['roll_number'];

    // Debugging output: Print the roll number
    echo "Roll Number: " . htmlspecialchars($roll_number) . "<br>";

    // Prepare and execute query to fetch student details
    $stmt = $conn->prepare("SELECT * FROM student_details WHERE roll_number = ?");
    $stmt->bind_param("s", $roll_number);

    // Debugging output: Check if the statement was prepared successfully
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
    } else {
        // Execute the statement and check for errors
        if (!$stmt->execute()) {
            echo "Error executing query: " . $stmt->error;
        } else {
            $result = $stmt->get_result();

            // Check if any results were returned
            if ($result->num_rows > 0) {
                // Fetch student data
                $student = $result->fetch_assoc();
            } else {
                $error_message = "No student found with that roll number.";
            }
        }

        // Close statement
        $stmt->close();
    }
} else {
    $error_message = "Roll number not provided.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Profiles</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/0f4e2bc10d.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap">
    <style>
        .content_section_stud {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
        }
        .pro-academic {
            width: 100%;
            display: flex;
            flex-direction: column;
            border: 2px solid black;
            margin-left: 20px;
            margin-top: 100px;
            padding: 20px;
        }
        .section1, .section2 {
            border: 2px solid black;
            width: 400px;
            height: 400px;
            margin: 10px;
            width: 100%;
            margin-top: 50px;
        }
        .section1>h2{
            text-align: center;
            font-size: 20px;
            font-weight: 300;
        }
        .course-insights>h3{
            font-size: 20px;
            font-weight: 300;
        }
        .sem-mrk {
            display: flex;               /* Set as a flex container */
            flex-wrap: wrap;           /* Allow items to wrap */
            justify-content: flex-start; /* Align items to the start */
        }
        .sem1, .sem2, .sem3 {
            border: 1px solid black;    /* Optional: Add a border for better visibility */
            padding: 10px;              /* Add some padding */
            margin: 5px;                /* Add some margin */
            flex: 1 1 30%;              /* Allow them to grow and shrink, with a base width of 30% */
            text-align: center;         /* Center text */
        }
        
<<<<<<< HEAD
=======
        
>>>>>>> c18bbe4efabbb4103e1c0706a2f2d2912b446159
   
    </style>
</head>
<body>
    <h1>Student Profile</h1>
    
    <?php if (isset($student)): ?>
        <p>Name: <?php echo htmlspecialchars($student['name']); ?></p>
        <p>Roll Number: <?php echo htmlspecialchars($student['roll_number']); ?></p>
        <p>University Reg No: <?php echo htmlspecialchars($student['univ_reg_no']); ?></p>
        <p>CGPA: <?php echo htmlspecialchars($student['cgpa']); ?></p>
        <p>Degree: <?php echo htmlspecialchars($student['degree']); ?></p>
        <p>Course: <?php echo htmlspecialchars($student['course']); ?></p>
        <p>Batch Year: <?php echo htmlspecialchars($student['batch_year']); ?></p>
        <p>Email: <?php echo htmlspecialchars($student['email']); ?></p>
        <p>Phone Number: <?php echo htmlspecialchars($student['phno']); ?></p>
    <?php else: ?>
        <p style='color: red;'><?php echo isset($error_message) ? $error_message : ""; ?></p>
    <?php endif; ?>
</body>
</html>
