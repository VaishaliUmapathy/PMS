<?php
include 'db.php';  // Include database connection

$messages = [];

// Handle POST request to create a new project
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST;  // Get POST data directly from the form

    // Validate input fields
    if (empty($data['project_title']) || empty($data['project_description'])) {
        $messages[] = "Project title and description are required.";
    } else {
        $student_id = 1; // Replace with actual student ID based on your application's logic
        $project_title = $conn->real_escape_string($data['project_title']);
        $project_description = $conn->real_escape_string($data['project_description']);
        $submission_date = date('Y-m-d'); // Set to today's date or use an input field
        $status = 'Pending'; // Default status; you can change this as needed
        $mentor_comments = ''; // Initial value
        $files = ''; // Initial value; handle file uploads if necessary

        // Insert project into the 'projects' table
        $sql = "INSERT INTO student_projects (student_id, project_title, project_description, submission_date, status, mentor_comments, files) 
                VALUES ('$student_id', '$project_title', '$project_description', '$submission_date', '$status', '$mentor_comments', '$files')";

        if ($conn->query($sql) === TRUE) {
            // Success message
            $messages[] = "Project '$project_title' created successfully!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $messages[] = "Failed to create project: " . $conn->error;
        }
    }
}

// Fetch all projects
$sql = "SELECT * FROM student_projects";
$result = $conn->query($sql);
$projects = [];

while ($row = $result->fetch_assoc()) {
    $projects[] = $row;
}
// Handle project deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $conn->query("DELETE FROM student_projects WHERE id = $delete_id");
    header("Location: stud_projects.php"); // Redirect to avoid resubmission
    exit();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Creation Dashboard</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/0f4e2bc10d.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: whitesmoke; /* Light blue */
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 100%;
            margin-left: 210px;
            background-color: #FFFFFF; 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Header Styles */
        h1, h2, h3 {
            color: #594f8d; 
        }
        
        .header > h1 {
            text-transform: uppercase;
            font-size: 30px;
        }
        .main-content{
            margin-top:100px;
            
        }
        .form-container {
            background-color: #f7f7f7; /* Light gray background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Slight shadow */
            margin-bottom: 20px;
        }

        /* Form row styles */
        .form-row {
            display: flex; 
            justify-content: space-between; 
            margin-bottom: 1rem; 
        }

        .form-group {
            flex: 1; 
            margin-right: 10px; 
        }
        
        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #594f8d; /* Label color matching the theme */
        }

        .form-group:last-child {
            margin-right: 0; 
        }

        /* Input and select styles */
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Button Styles */
        button {
            background-color: #594f8d;
            margin: 10px;
            color: #FFFFFF; 
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        /* Created Projects Section */
        #created-projects {
            display: flex;
            justify-content: space-evenly; 
            padding: 20px;
        }

        .project-box {
            background-color: white;
            width: 400px; /* Two cards in a row */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            margin: 15px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        .project-box h3 {
            font-size: 18px;
            margin-bottom: 5px; /* Reduce space below heading */
        }

        .project-box p {
            margin: 2px 0; /* Tighten space between paragraphs */
            line-height: 1.2; /* Reduce line spacing */
        }

        /* Styling Error Messages */
        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }   
        .project-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px; /* Space above buttons */
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <img src="assets/img/girlprofile.png" alt="" width="100px "/>
        <h2 class="profile-name">Vaishali</h2>
        <h2 class="profile-roll">21CS053</h2>
        <ul>
            <li><a href="stud_dash.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="stud_profiles.php"><i class="fas fa-user"></i>Profile</a></li>
            <li><a href="stud_projects.php"><i class="fas fa-address-card"></i>Projects</a></li>
            <li><a href="stud_mentors.php"><i class="fas fa-project-diagram"></i>Mentors</a></li>
            <li><a href="stud_submission.php"><i class="fas fa-blog"></i>Submission</a></li>
            <li><a href="create_teams.php"><i class="fas fa-address-book"></i>Teams</a></li>
            <li><a href="stud_editor.php"><i class="fas fa-address-book"></i>Editor</a></li>
        </ul>
    </div>

    <div class="main_header">
        <div class="header">
            <h1>Project Creation</h1>
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

<section class="main-content">
<div class="container">
        <!--<button id="create-project-btn" class="btn primary">Create Project</button>-->

        <!-- Hidden form container -->
        <div id="form-container" class="hidden form-container">
            <form id="create-project-form" method="POST" action="">
                <div class="form-row">
                    <div class="form-group">
                        <label for="project-title">Project Title</label>
                        <input type="text" id="project-title" name="project_title" required>
                    </div>
                    <div class="form-group">
                        <label for="project-description">Project Description</label>
                        <input type="text" id="project-description" name="project_description" required>
                    </div>
                </div>
                <button type="submit" class="btn primary">Create Project</button>
            </form>
        </div>

        <!-- Display messages -->
        <?php if (!empty($messages)): ?>
            <div class="error-message">
                <?php foreach ($messages as $message): ?>
                    <p><?php echo htmlspecialchars($message); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Created Projects Section -->
        <h2>Created Projects</h2>
        <div id="created-projects">
            <?php if (empty($projects)): ?>
                <p>No projects created yet.</p>
            <?php else: ?>
                <?php foreach ($projects as $project): ?>
                    <div class="project-box">
                        <h3><?php echo htmlspecialchars($project['project_title']); ?></h3>
                        <p><strong>Description:</strong> <?php echo htmlspecialchars($project['project_description']); ?></p>
                        <p><strong>Submission Date:</strong> <?php echo htmlspecialchars($project['submission_date']); ?></p>
                        <p><strong>Status:</strong> <?php echo htmlspecialchars($project['status']); ?></p>

                        <div class="project-buttons">
                            <a href="edit_projects.php?id=<?php echo $project['id']; ?>" class="btn edit">Edit</a>
                            <a href="?delete_id=<?php echo $project['id']; ?>" class="btn delete" onclick="return confirm('Are you sure you want to delete this project?');">Delete</a>
                            <a href="view_projects.php?id=<?php echo $project['id']; ?>" class="btn view">View</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
    // Show/hide form
    document.getElementById('create-project-btn').addEventListener('click', function() {
        const formContainer = document.getElementById('form-container');
        formContainer.classList.toggle('hidden'); // Toggle visibility
    });
</script>

</body>
</html>
