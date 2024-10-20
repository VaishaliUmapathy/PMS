







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
                    /* General Styles */
            body {
                font-family:sans-serif;
                background-color: whitesmoke;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 100%;
                margin-left: 210px;
                padding: 20px;
                margin-top: 100px;
            }

            /* Project Card Styles */
            .project-card {
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin-bottom: 20px;
            }

            .project-title {
                font-size: 16px;
                color:#717171;
                text-transform: capitalize;
                margin-bottom: 10px;
            }

            .team-name {
                font-size: 18px;
                color: #333;
                margin-bottom: 15px;
            }
            .team-name, .semester, .technology-stack {
                font-size: 18px;
                color: #333;
                margin-bottom: 10px;
            }

            .project-details h3 {
                font-size: 20px;
                color: #594f8d;
                margin-bottom: 10px;
            }

            .project-details p {
                margin-bottom: 10px;
                font-size: 16px;
                line-height: 1.5;
            }

            .project-details p strong {
                color: #333;
            }

            .project-details a {
                background-color: #594f8d;
                color: #fff;
                padding: 8px 12px;
                border-radius: 4px;
                text-decoration: none;
                font-weight: bold;
            }

            .project-details a:hover {
                background-color: #483a8b;
                text-decoration: underline;
            }

            /* Download button for PPT */
            

            .project-details a:hover {
                background-color: #483a8b;
            }

            /* Additional styles for spacing */
            .project-card {
                margin-bottom: 30px;
            }

            h2, h3 {
                margin-top: 0;
            }
            h2>em{
                color:#594f8d;
                font-size: 2rem;
                font-style: normal;
            }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <img src="assets/img/girlprofile.png" alt="Profile Picture" width="100px"/>
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
        <?php
        // Database connection
        $conn = new mysqli("localhost", "root", "", "teams_management");//project_management_db;

        // Check if the connection was successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the 'id' parameter is set in the URL
        if (isset($_GET['id'])) {
            $project_id = $_GET['id'];

            // Use prepared statements for safety
            $stmt = $conn->prepare("SELECT * FROM student_projects WHERE id = ?");
            $stmt->bind_param("i", $project_id); // "i" indicates the type is integer
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if any project is found
            if ($result->num_rows > 0) {
                // Fetch the project data
                $project = $result->fetch_assoc();
        ?>
                <div class="project-card">
                    <h2 class="project-title"><em>Project Title:</em> <?php echo htmlspecialchars($project['project_title']); ?></h2>
                    <p class="team-name">Team Name: <?php echo htmlspecialchars($project['team_name']); ?></p>
                    <p class="semester">Semester: <?php echo htmlspecialchars($project['semester']); ?></p>
                    <p class="technology-stack">Technology Stack: <?php echo htmlspecialchars($project['technology_stack']); ?></p>

                    <div class="project-details">
                        <h2><em>Project Details</em></h2>
                        <p><strong>Description:</strong> <?php echo htmlspecialchars($project['project_description']); ?></p>
                        <p><strong>Abstract:</strong> <?php echo htmlspecialchars($project['abstract']); ?></p>
                        <p><strong>PPT:</strong> <a href="path_to_ppt/<?php echo htmlspecialchars($project['ppt_filename']); ?>" download>Download PPT</a></p>
                        <p><strong>Additional Details:</strong> <?php echo htmlspecialchars($project['additional_details']); ?></p>
                    </div>
                </div>
        <?php
            } else {
                // If no project is found
                echo "<p>Project not found.</p>";
            }
            // Close the statement
            $stmt->close();
        } else {
            // If no ID is passed in the URL
            echo "<p>No project ID provided.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</section>


</body>
</html>
