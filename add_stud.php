<?php
// Database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "project_management_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch form data
    $name = $_POST['name'];
    $roll_number = $_POST['roll_number'];
    $univ_reg_no = $_POST['univ_reg_no'];
    $cgpa = $_POST['cgpa'];
    $degree = $_POST['degree'];
    $course = $_POST['course'];
    $batch_year = $_POST['batch_year']; 
    $email = $_POST['email'];
    $phno = $_POST['phno'];

    // Validate roll number
    $check_roll_number = $conn->prepare("SELECT * FROM student_details WHERE roll_number = ?");
    $check_roll_number->bind_param("s", $roll_number);
    $check_roll_number->execute();
    $result = $check_roll_number->get_result();

    if ($result->num_rows > 0) {
        echo "<p style='color: red;'>Error: Roll number already exists.</p>";
    } else {
        // Prepare and bind for student details
        $stmt = $conn->prepare("INSERT INTO student_details (name, roll_number, univ_reg_no, cgpa, degree, course, batch_year, email, phno) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $name, $roll_number, $univ_reg_no, $cgpa, $degree, $course, $batch_year, $email, $phno);

        // Execute the statement for student details
        if ($stmt->execute()) {
            // Redirect to the student profile page after successful insertion
            header("Location: stud_profiles.php?roll_number=" . urlencode($roll_number));
            exit(); // Ensure no further code is executed after redirection
        } else {
            echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
        }

        // Close the statement
        $stmt->close();
    }

    // Close check statement
    $check_roll_number->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="mentors.css">
    <link rel="stylesheet" href="addstud.css">
    <script src="https://kit.fontawesome.com/0f4e2bc10d.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap">
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <img src="assets/img/girlprofile.png" alt="" width="100px" />
        <h2 class="profile-name"><?php echo isset($mentor_data['name']) ? htmlspecialchars($mentor_data['name']) : ''; ?></h2>
        <h2 class="profile-roll"><?php echo isset($mentor_data['department']) ? htmlspecialchars($mentor_data['department']) : ''; ?></h2>
        <ul>
            <li><a href="mentors_dash.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="mentor_profiles.php"><i class="fas fa-user"></i>Profile</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-btn"><i class="fas fa-user"></i> Students</a>
                <div class="dropdown-container">
                    <a href="add_stud.php"><i class="fas fa-user-plus"></i> Add Students</a>
                    <a href="list_stud.php"><i class="fas fa-list"></i> List Students</a>
                </div>
            </li>
            <li><a href="projects.html"><i class="fas fa-address-card"></i>Projects</a></li>
            <li><a href="submission.html"><i class="fas fa-blog"></i>Submission</a></li>
            <li><a href="viewteams.php"><i class="fas fa-address-book"></i>Teams</a></li>
            <li><a href="cal.html"><i class="fas fa-calendar-alt"></i>Schedule</a></li>
        </ul>
    </div>

    <div class="main_header">
        <div class="header">
            <h1>ADD STUDENT</h1>
            <div class="header_icons">
                <div class="search">
                    <input type="text" placeholder="Search..." />
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <i class="fa-solid fa-bell"></i>
            </div>
        </div>
        <br>
        <hr>
    </div>
</div>
    <div class="main_header">
        <form method="POST" action="">
            <div class="container">
                <!-- Student Details Section -->
                <div class="student-details">
                    <h3>Student Details</h3>
                    <input type="text" name="name" placeholder="Name" required value="<?php echo htmlspecialchars($name ?? ''); ?>">
                    <input type="text" name="roll_number" placeholder="Roll Number" required value="<?php echo htmlspecialchars($roll_number ?? ''); ?>">
                    <input type="text" name="univ_reg_no" placeholder="University Reg No" required value="<?php echo htmlspecialchars($univ_reg_no ?? ''); ?>">
                    <input type="text" name="cgpa" placeholder="CGPA" required value="<?php echo htmlspecialchars($cgpa ?? ''); ?>">
                    <input type="text" name="degree" placeholder="Degree" required value="<?php echo htmlspecialchars($degree ?? ''); ?>">
                    <input type="text" name="course" placeholder="Course" required value="<?php echo htmlspecialchars($course ?? ''); ?>">
                    <input type="text" name="batch_year" placeholder="Batch Year" required value="<?php echo htmlspecialchars($batch_year ?? ''); ?>"  oninput="validateBatchYear(this)">
                    <input type="email" name="email" placeholder="Email" required value="<?php echo htmlspecialchars($email ?? ''); ?>">
                    <input type="text" name="phno" placeholder="Phone Number" required value="<?php echo htmlspecialchars($phno ?? ''); ?>">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>
    </div>

    <script src="addstud.js"></script>
</body>
</html>