<?php
include 'db_connection.php'; // Include database connection

// Check if project ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "No project ID provided.";
    exit;
}

// Get the project ID from the URL
$project_id = $_GET['id'];

// Prepare SQL statement to fetch project details
$sql = "SELECT * FROM student_projects WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch project details
$project = $result->fetch_assoc();

// Check if project exists
if (!$project) {
    echo "Project not found.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Details</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="mentors.css">
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
            max-width: 800px;
            margin: 20px auto;
            background-color: #FFFFFF; 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #594f8d; 
        }

        .project-detail {
            margin-bottom: 20px;
        }

        .project-detail label {
            font-weight: bold;
            color: #594f8d;
        }

        .project-detail p {
            margin: 5px 0;
        }

        .button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #594f8d;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #4e4484;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Project Details</h1>

    <div class="project-detail">
        <label>Project Title:</label>
        <p><?php echo htmlspecialchars($project['title']); ?></p>
    </div>
    <div class="project-detail">
        <label>Description:</label>
        <p><?php echo htmlspecialchars($project['description']); ?></p>
    </div>
    <div class="project-detail">
        <label>Team Name:</label>
        <p><?php echo htmlspecialchars($project['team_name']); ?></p>
    </div>
    <div class="project-detail">
        <label>Team Members:</label>
        <p><?php echo htmlspecialchars($project['members']); ?></p>
    </div>
    <div class="project-detail">
        <label>Technology Stack:</label>
        <p><?php echo htmlspecialchars($project['tech_stack']); ?></p>
    </div>
    <div class="project-detail">
        <label>Submitted on:</label>
        <p><?php echo htmlspecialchars($project['submission_date']); ?></p>
    </div>
    <div class="project-detail">
        <label>Status:</label>
        <p><?php echo htmlspecialchars($project['status']); ?></p>
    </div>

    <a href="stud_projects.php" class="button">Back to Projects</a>
</div>

</body>
</html>
