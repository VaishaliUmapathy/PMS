

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>mentors</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="mentors.css">
    <script src="https://kit.fontawesome.com/0f4e2bc10d.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
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
            <li><a href="sub.php"><i class="fas fa-blog"></i>Submission</a></li>
            <li><a href="viewteams.php"><i class="fas fa-address-book"></i>Teams</a></li>
=======
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-btn"><i class="fas fa-user"></i> Students</a>
                <div class="dropdown-container">
                    <a href="add_stud.php"><i class="fas fa-user-plus"></i> Add Students</a>
                    <a href="list_stud.php"><i class="fas fa-list"></i> List Students</a>
                </div>
            </li>
            <li><a href="projects.html"><i class="fas fa-address-card"></i>Projects</a></li>
            <li><a href="submission.html"><i class="fas fa-blog"></i>Submission</a></li>
            <li><a href="teams.html"><i class="fas fa-address-book"></i>Teams</a></li>
>>>>>>> 184fa70 (profiles pages were updated)
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
    <div class="mentor-details">
        <h2>Mentor Details</h2>
        <?php
        // Display mentor details
        if (!empty($mentor_data)) {
            echo '<h3>Mentor ID: ' . htmlspecialchars($mentor_data['mentor_id']) . '</h3>';
            echo '<p><strong>Name:</strong> ' . htmlspecialchars($mentor_data['name']) . '</p>';
            echo '<p><strong>Degree:</strong> ' . htmlspecialchars($mentor_data['degree']) . '</p>';
            echo '<p><strong>Department:</strong> ' . htmlspecialchars($mentor_data['department']) . '</p>';
            echo '<p><strong>Domain:</strong> ' . htmlspecialchars($mentor_data['domain']) . '</p>';
            echo '<p><strong>Phone Number:</strong> ' . htmlspecialchars($mentor_data['phone_number']) . '</p>';
            echo '<p><strong>Email:</strong> ' . htmlspecialchars($mentor_data['email']) . '</p>';
        } else {
            echo "<p>No mentor data available.</p>";
        }
        ?>
    </div>
    
    <section id="statistics">
        <h2>Mentor Dashboard</h2>
        <div class="content-items">
            <div class="info">
                <a href="cal.html">
                    <h2 class="info-heading">Calendar</h2>
                    <div class="info-details">
                        <h3 class="info-numbers">3</h3>
                    </div>
                </a>
            </div>
            <div class="info">
                <a href="viewteams.html">
                    <h2 class="info-heading">View Teams</h2>
                    <div class="info-details">
                        <h3 class="info-numbers">3</h3>
                    </div>
                </a>
            </div>
            <div class="info">
                <a href="Year.html">
                    <h2 class="info-heading">Year</h2>
                    <div class="info-details">
                        <h3 class="info-numbers">2</h3> 
                    </div>
                </a>
            </div>
            <div class="info">
                <a href="viewprojects.html">
                    <h2 class="info-heading">ALL Projects</h2>
                    <div class="info-details">
                        <h3 class="info-numbers">1</h3> 
                    </div>
                </a>
            </div>
        </div>
    </section>
</section>

<!-- Modal for event details -->
<!-- Add modal HTML if needed -->

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

    $(document).ready(function() {
        // Initialize the calendar
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true, // Enable drag-and-drop
            events: [
                {
                    title: 'Project Submission Deadline',
                    start: '2024-10-10',
                    backgroundColor: '#ff5733' // Custom color for deadlines
                },
                {
                    title: 'Team Meeting',
                    start: '2024-10-12T10:00:00',
                    end: '2024-10-12T11:00:00', // Optional end date
                    backgroundColor: '#007bff' // Another event color
                },
                {
                    title: 'Client Review',
                    start: '2024-10-15',
                    allDay: true // For all-day events
                },
                {
                    title: 'Weekly Team Sync',
                    start: '2024-10-05T10:00:00',
                    rrule: {
                        freq: 'weekly',
                        interval: 1,
                        byweekday: ['mo', 'we', 'fr'] // Repeat every Monday, Wednesday, and Friday
                    },
                    backgroundColor: '#28a745' // Custom color for recurring events
                }
            ],
            dayRender: function(date, cell) {
                if (date.isSame(moment(), 'day')) {
                    cell.css("background-color", "#ffcc00"); // Highlight today's date
                }
            },
            eventClick: function(event) {
                $('#modalTitle').text(event.title);
                $('#modalDescription').text('Event Date: ' + event.start.format('MMMM Do YYYY'));
                $('#eventModal').show(); // Show the modal
            }
        });

        // Close modal functionality
        $('#closeModal').click(function() {
            $('#eventModal').hide(); // Hide the modal
        });
    });
</script>

</body>
</html>
