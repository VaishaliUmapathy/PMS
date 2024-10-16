<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Profiles</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/0f4e2bc10d.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap">
    <style>
        .content_section_stud {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
        }
        .pro-academic {
            width: 100%;
            display: flex;
            flex-direction: column;
            border: 2px solid black;
            margin-left: 20px;
            padding: 20px;
        }
        .section1, .section2 {
            border: 2px solid black;
            width: 400px;
            height: 400px;
            margin: 10px;
            width: 100%;
        }
        .section1>h2{
            text-align: center;
            font-size: 20px;
            font-weight: 300;
        }
        .course-insights>h3{
            font-size: 20px;
            font-weight: 300;
        }
        .sem-mrk {
            display: flex;               /* Set as a flex container */
            flex-wrap: wrap;           /* Allow items to wrap */
            justify-content: flex-start; /* Align items to the start */
        }
        .sem1, .sem2, .sem3 {
            border: 1px solid black;    /* Optional: Add a border for better visibility */
            padding: 10px;              /* Add some padding */
            margin: 5px;                /* Add some margin */
            flex: 1 1 30%;              /* Allow them to grow and shrink, with a base width of 30% */
            text-align: center;         /* Center text */
        }
    </style>
</head>
<body>

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

</body>
</html>
0
