<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Student') {
    header("Location: signin.php");
    exit();
}

// Retrieve user data from session
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user']; // Fetch the user data from session
} else {
    // Handle the case where user data is not set
    $user = null; // or you can redirect to signin.php
}

// Safely retrieve dashboard data
$dashboard_data = isset($_SESSION['dashboard_data']) ? $_SESSION['dashboard_data'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/0f4e2bc10d.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap">
    <style>
        .main-content{
            margin-top:100px;
            margin-left: 100px;
        }
        .abstract{
            height: 200px;
            width: 700px;
            margin-left: 250px;
           
        }
        .abstract h2{
            text-align: justify;
            font-size: 32px;
            font-weight: 600;
        }
        .h2-tag{
            text-transform: uppercase;
            margin-left: 100px;
        }
        
    </style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <img src="assets/img/girlprofile.png" alt="" width="100px"/>
        <h2 class="profile-name"><?php echo htmlspecialchars($user['name'] ?? 'Guest'); ?></h2> <!-- Default to 'Guest' if not set -->
        <h2 class="profile-roll"><?php echo htmlspecialchars($user['roll_number'] ?? 'N/A'); ?></h2> <!-- Default to 'N/A' if not set -->
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

<section class="main-content">
    <section id="statistics">
        <h2 class="h2-tag">Project Statistics</h2>
        <div class="content-items">
            <div class="info">
                <h2 class="info-heading">Total Projects</h2>
                <div class="info-details">
                    <h3 class="info-numbers"><?php echo $dashboard_data['total_projects'] ?? '0'; ?></h3>
                </div>
            </div>
            <div class="info">
                <h2 class="info-heading">Completed Projects</h2>
                <div class="info-details">
                    <h3 class="info-numbers"><?php echo $dashboard_data['completed_projects'] ?? '0'; ?></h3>
                </div>
            </div>
            <div class="info">
                <h2 class="info-heading">Ongoing Projects</h2>
                <div class="info-details">
                    <h3 class="info-numbers"><?php echo $dashboard_data['ongoing_projects'] ?? '0'; ?></h3>
                </div>
            </div>
            <div class="info">
                <h2 class="info-heading">Overdue Projects</h2>
                <div class="info-details">
                    <h3 class="info-numbers"><?php echo $dashboard_data['overdue_projects'] ?? '0'; ?></h3>
                </div>
            </div>
        </div>
    </section>

    <section id="calendar">
        <h2>Calendar <a href="cal.html">view</a></h2>
        <div class="calendar-container">
            <div class="calendar-header">
                <button id="prevYear" onclick="changeYear(-1)">&#10094;&#10094;</button>
                <button id="prevMonth" onclick="changeMonth(-1)">&#10094;</button>
                <h3 id="currentMonthYear"></h3>
                <button id="nextMonth" onclick="changeMonth(1)">&#10095;</button>
                <button id="nextYear" onclick="changeYear(1)">&#10095;&#10095;</button>
            </div>
            <div class="calendar-days">
                <div class="day">Sun</div>
                <div class="day">Mon</div>
                <div class="day">Tue</div>
                <div class="day">Wed</div>
                <div class="day">Thu</div>
                <div class="day">Fri</div>
                <div class="day">Sat</div>
            </div>
            <div class="calendar-dates" id="calendarDates"></div>
        </div>
    </section>
</section>

<script src="assets/js/calendar.js"></script>
</body>
</html>
