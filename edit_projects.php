<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/0f4e2bc10d.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
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

        .project-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .project-title, .team-name {
            font-size: 24px;
            color: #594f8d;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .project-details h3 {
            font-size: 20px;
            color: #594f8d;
            margin-bottom: 10px;
        }

        .project-details p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container input[type="text"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            background-color: #594f8d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #483a8b;
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
            <h1>Edit Project</h1>
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
            include 'db_connection.php';
            //include 'db.php';


            // Initialize $project as null to prevent undefined variable warnings
            $project = null;

            // Handle GET request to fetch project details
            if (isset($_GET['id'])) {
                $project_id = $_GET['id'];

                // Fetch project details securely
                $stmt = $conn->prepare("SELECT * FROM student_projects WHERE id = ?");
                $stmt->bind_param("i", $project_id); // Use parameter binding to prevent SQL injection
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $project = $result->fetch_assoc();
                } else {
                    echo "<p>Project not found.</p>";
                }

                $stmt->close();
            }

            // Handle POST request to update project
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $project_title = $conn->real_escape_string($_POST['project_title']);
                $project_description = $conn->real_escape_string($_POST['project_description']);

                $stmt = $conn->prepare("UPDATE student_projects SET project_title = ?, project_description = ? WHERE id = ?");
                $stmt->bind_param("ssi", $project_title, $project_description, $project_id);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    header("Location: stud_projects.php"); // Redirect after successful update
                    exit();
                } else {
                    echo "<p>Failed to update project or no changes made.</p>";
                }

                $stmt->close();
            }

            $conn->close();
        ?>

        <?php if ($project): ?>
            <div class="form-container">
                <form method="POST" action="">
                    <label for="project-title">Project Title</label>
                    <input type="text" id="project-title" name="project_title" value="<?php echo htmlspecialchars($project['project_title']); ?>" required>
                    
                    <label for="project-description">Project Description</label>
                    <textarea id="project-description" name="project_description" required><?php echo htmlspecialchars($project['project_description']); ?></textarea>

                    <button type="submit">Update Project</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</section>

</body>
</html>
