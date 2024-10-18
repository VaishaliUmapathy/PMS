<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mentor Dashboard</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/0f4e2bc10d.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap">
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <img src="assets/img/girlprofile.png" alt="" width="100px "/>
        <h2 class="profile-name">Anitha</h2>
        <h2 class="profile-roll">CSE</h2>
        <ul>
            <li><a href="mentors_dash.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="mentor_profiles.php"><i class="fas fa-user"></i>Profile</a></li>
            <li><a href="projects.php"><i class="fas fa-address-card"></i>Projects</a></li>
            <li><a href="cal.html"><i class="fas fa-project-diagram"></i>Calendar</a></li>
            <li><a href="sub.php"><i class="fas fa-blog"></i>Submission</a></li>
            <li><a href="viewteams.php"><i class="fas fa-address-book"></i>Teams</a></li>
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

</body>
</html>
