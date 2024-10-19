<?php
// Database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "teams_management"; 

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
    <title>Student Profile</title>
    <!-- Add your CSS and other head elements -->
</head>
<body>
<<<<<<< HEAD

<div class="wrapper">
    <div class="sidebar">
        <img src="assets/img/girlprofile.png" alt="" width="100px "/>
        <h2 class="profile-name">Menu</h2>
        <h2 class="profile-roll">21CS053</h2>
        <ul> 
            <li><a href="stud_dash.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="stud_profiles.php"><i class="fas fa-user"></i>Profile</a></li>
            <li><a href="stud_projects.php"><i class="fas fa-address-card"></i>Projects</a></li>
            <li><a href="stud_mentors.php"><i class="fas fa-project-diagram"></i>Mentors</a></li>
            <li><a href="stud_submission.php"><i class="fas fa-blog"></i>Submission</a></li>
            <li><a href="create_teams.php"><i class="fas fa-address-book"></i>Teams</a></li>
        </ul>
    </div>

    <div class="main_header">
        <div class="header">
            <h1>PROJECT MANAGEMENT</h1>
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

<section class="content_section_stud">
    <div class="additional-details">
        <form action="#" method="post">
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" id="position" name="position" value="Student" required>
            </div>

            <div class="form-group">
                <label for="join-date">Joining Date</label>
                <input type="date" id="join-date" name="join-date" value="2021-12-12" required>
            </div>

            <div class="form-group">
                <label for="cgpa">CGPA</label>
                <input type="number" step="0.01" id="cgpa" name="cgpa" value="9.00" required>
            </div>

            <div class="form-group">
                <label for="degree">Degree</label>
                <input type="text" id="degree" name="degree" value="Bachelor of Technology" required>
            </div>

            <div class="form-group">
                <label for="course">Course</label>
                <input type="text" id="course" name="course" value="Computer Science Engineering" required>
            </div>

            <div class="form-group">
                <label for="year">Year</label>
                <input type="text" id="year" name="year" value="4th Year" required>
            </div>

            <div class="form-group">
                <label for="email">Email Id</label>
                <input type="email" id="email" name="email" value="vaishali@gmail.com" required>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" value="2003-12-12" required>
            </div>

            <div class="form-group">
                <label for="phno">Phone Number</label>
                <input type="tel" id="phno" name="phno" value="234567890" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="asdfghjkl" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <button type="button">Edit</button>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
    <div class="pro-academic">
        <div class="section1">
            <h2>Academic</h2>
            <div class="course-insights">
                <h3>Course Insights</h3>
                <p>Zeroth Review: 88%</p>
                <p>First review: 6 out of 8</p>
                <p>Second Review: 82%</p>
                <p>Third Review: 82%</p>
                <p>Final Review: 88%</p>
                <button>View Detailed Report</button>
            </div>
            <div class="sem-mrk">
                <div class="sem1">Sem 1</div>
                <div class="sem2">Sem 2</div>
                <div class="sem3">Sem 3</div>
                <div class="sem1">Sem 4</div>
                <div class="sem2">Sem 5</div>
                <div class="sem3">Sem 6</div>
                <div class="sem3">Sem 7</div>
            </div>
        </div>
        <div class="section2">
            <h2>Activity</h2>
            <!-- Additional content for section 2 can go here -->
        </div>
    </div>
</section>

=======
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
>>>>>>> 184fa70 (profiles pages were updated)
</body>
</html>
