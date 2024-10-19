

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>mentors</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/0f4e2bc10d.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap">
<<<<<<< HEAD
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
=======
    <style>
        .main-content{
            margin-top:100px;
        }
    </style>
>>>>>>> 8349245 (the submission and editor page is created)
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
<<<<<<< HEAD
            <li><a href="projects.php"><i class="fas fa-address-card"></i>Projects</a></li>
            <li><a href="cal.html"><i class="fas fa-project-diagram"></i>Calendar</a></li>
            <li><a href="sub.php"><i class="fas fa-blog"></i>Submission</a></li>
            <li><a href="viewteams.php"><i class="fas fa-address-book"></i>Teams</a></li>
=======
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-btn"><i class="fas fa-user"></i> Students</a>
                <div class="dropdown-container">
                    <a href="add_stud.php"><i class="fas fa-user-plus"></i> Add Students</a>
                    <a href="list_students.php"><i class="fas fa-list"></i> List Students</a>
                </div>
            </li>
            <li><a href="projects.html"><i class="fas fa-address-card"></i>Projects</a></li>
            <li><a href="submission.html"><i class="fas fa-blog"></i>Submission</a></li>
            <li><a href="teams.html"><i class="fas fa-address-book"></i>Teams</a></li>
            <li><a href="cal.html"><i class="fas fa-calendar-alt"></i>Schedule</a></li>
>>>>>>> 184fa70 (profiles pages were updated)
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
</section>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdownBtns = document.querySelectorAll('.dropdown-btn');
        
        dropdownBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                const dropdownContent = this.nextElementSibling;
                dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
            });
        });
    });
</script>

</body>
</html>
