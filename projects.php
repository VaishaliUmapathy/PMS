<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Projects Dashboard</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/projects.css">
    <link rel="stylesheet" href="mentors.css">
    <script src="https://kit.fontawesome.com/0f4e2bc10d.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <style>
        body {
            font-family: 'Josefin Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4; /* Overall background color */
        }
        .wrapper {
            display: flex;
        }
        .sidebar {
            background: #4b4276; /* Sidebar color */
            color: white;
            width: 200px;
            padding: 20px;
        }

        .sidebar img {
            border-radius: 50%; /* Profile image rounded */
        }
        .sidebar h2 {
            font-size: 20px; /* Profile name font size */
        }
        .sidebar ul {
            list-style-type: none; /* Remove bullet points */
            padding: 0;
        }
        .sidebar ul li {
            margin: 15px 0; /* Space between menu items */
        }
        .sidebar ul li a {
            color: white; /* Menu item color */
            text-decoration: none; /* Remove underline */
        }
        .main_header {
            flex: 1; /* Take remaining space */
            padding: 20px;
            background: white; /* Header background */
        }
        .main-content {
            padding: 20px;
            flex: 1; /* Take remaining space */
        }
        #statistics{
            margin-left: 70px;
        }
        #statistics > h2{
            margin-left: 150px;
        }
        .main-content>h2{
            margin-left: 200px;
            padding: 10px 20px;
            background-color: #4e64bb;
            border-radius: 5px;
            border:2px solid #4e64bb;
        }
        .info>a{
            color: #4e64bb;
            font-weight: 400;

        }
        #calendar {
            max-width: 800px;  /* Adjust width as necessary */
            margin: 20px auto;  /* Center align */
            padding: 20px;  /* Padding around the calendar */
            border: 1px solid #ccc;  /* Light border for calendar */
            border-radius: 10px;  /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);  /* Subtle shadow */
            background-color: #f9f9f9;  /* Light background color */
        }
        .fc-today {
            background-color: #ffcc00 !important; /* Highlight today */
        }
        .main-content{
            margin-top:100px;
        }
        .fc-event {
            border-radius: 5px; /* Rounded corners for events */
            color: white; /* Text color for events */
            border: none; /* Remove borders */
        }
        .fc-header-toolbar {
            background-color: #f1f1f1; /* Header background */
            padding: 10px 0; /* Header padding */
            border-bottom: 1px solid #ccc; /* Bottom border */
        }
        /* Modal Styles */
        #eventModal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 20px;
        }
        #modalContent {
            background: #333;
            border-radius: 5px;
            padding: 20px;
            max-width: 300px;
            margin: auto;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }
        .mentor-details {
            background-color: #ffffff;
            border: 1px solid #ccc;
            margin-left: 200px;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .mentor-info p {
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
        }
        .mentor-details h2 {
            margin-bottom: 10px;
            color: #4e64bb;
}

    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <img src="assets/img/girlprofile.png" alt="" width="100px" />
        <h2 class="profile-name"><?php echo isset($mentor_data['name']) ? htmlspecialchars($mentor_data['name']) : ''; ?></h2>
        <h2 class="profile-roll"><?php echo isset($mentor_data['department']) ? htmlspecialchars($mentor_data['department']) : ''; ?></h2>
        <ul>
            <li><a href="mentors_dash.php"><i class="fas fa-home"></i>Home</a></li>
        
            <li><a href="viewteams.php"><i class="fas fa-address-book"></i>Teams</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-btn"><i class="fas fa-user"></i> Students</a>
                <div class="dropdown-container">
                    <a href="add_stud.php"><i class="fas fa-user-plus"></i> Add Students</a>
                    <a href="list_stud.php"><i class="fas fa-list"></i> List Students</a>
                </div>
            </li>
            <li><a href="teams.html"><i class="fas fa-address-book"></i>Projects</a></li>
            <li><a href="cal.html"><i class="fas fa-calendar-alt"></i>Schedule</a></li>
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
    <div class="container">
        <h1>Mentor Dashboard</h1><div id="notification" class="notification"></div>
        <div class="cards-container" id="teamsCards"></div>
    </div>
   
<section class="project-section">
    

</section>



<script src="assets/js/app.js"></script>
</body>
</html>
