<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
<<<<<<< HEAD
//$dbname = "project_management_db"; 
$dbname = "teams_management"; 
=======

$dbname = 'teams_management';
>>>>>>> c18bbe4efabbb4103e1c0706a2f2d2912b446159

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch distinct batch years for the filter
$batch_sql = "SELECT DISTINCT batch_year FROM student_details ORDER BY batch_year DESC";
$batch_result = $conn->query($batch_sql);

// Fetch student details
$sql = "SELECT name, roll_number, degree, course, batch_year, email, phno FROM student_details";
$result = $conn->query($sql);
?>
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
    <style>
        /* Style for the main container */
        .main_header {
            padding: 20px;
            text-align: center;
            background-color: #f4f4f4;
        }

        /* Table styles */
            
        table {
            width: 70%; /* Set table width to 75% */
            border-collapse: collapse;
            margin: 20px auto; /* Center the table */
            margin-left: 8%; /* Move the table slightly to the right */
            font-size: 1em;
            min-width: 600px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

/* Other styles remain unchanged */
        .list-section{
            background-color: #f4f8f4;
            border:2px solid #e5e5e5;
            margin-left: 10%;
            

        }

        .table-container {
            display: flex; /* Use flexbox for layout */
            justify-content: center; /* Center the content horizontally */
             
            /* Move the table slightly to the right */
        }


        table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: center;
            vertical-align: middle;
        }

        table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        table tbody tr:hover {
            background-color: #f3f3f3;
        }

        table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        /* Profile link styling */
        table td a {
            text-decoration: none;
            color: #009879;
            font-weight: bold;
        }

        table td a:hover {
            color: #005f56;
            text-decoration: underline;
        }

        .table-name,.table-course,.table-batch-year {
            white-space: nowrap; /* Prevent text from wrapping */
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            table {
                width: 100%;
            }
        }

        /* Filter and search styles */
        .filter-container {
            text-align: right;
            margin-top: 10%;
            margin-right: 15%;
            margin-bottom: 10px;
        }

        .filter-container select, .filter-container input {
            padding: 10px;
            margin: 0 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        /* Additional styles for search box */
        .search-container {
            position: relative;
            display: inline-block; /* Align it with the select box */
        }

        .search-container input {
            padding: 10px 30px 10px 40px; /* Add padding to prevent text overlap with icon */
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .search-container i {
            position: absolute;
            left: 80%; /* Position the icon */
            top: 50%;
            transform: translateY(-50%); /* Center the icon vertically */
            color: #999; /* Icon color */
            pointer-events: none; /* Make sure clicks go through the icon */
        }
        .action-dropdown {
            padding: 10px 15px;  /* Increase the padding for a bigger appearance */
            font-size: 1em;      /* Adjust font size as needed */
            border-radius: 5px;  /* Maintain rounded corners */
            border: 1px solid #ddd; /* Consistent border */
            width: 120px;        /* Set width as needed */
            cursor: pointer;     /* Show pointer cursor on hover */
        }
        </style>

</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <img src="assets/img/girlprofile.png" alt="" width="100px" />
        <h2 class="profile-name"><?php echo isset($mentor_data['name']) ? htmlspecialchars($mentor_data['name']) : ''; ?></h2>
        <h2 class="profile-roll"><?php echo isset($mentor_data['department']) ? htmlspecialchars($mentor_data['department']) : ''; ?></h2>
        <ul>
            <li><a href="mentors_dash.php"><i class="fas fa-home"></i>Home</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-btn"><i class="fas fa-user"></i> Students</a>
                <div class="dropdown-container">
                    <a href="add_stud.php"><i class="fas fa-user-plus"></i> Add Students</a>
                    <a href="list_stud.php"><i class="fas fa-list"></i> List Students</a>
                </div>
            </li>
            <li><a href="projects.html"><i class="fas fa-address-card"></i>Projects</a></li>
            <li><a href="submission.html"><i class="fas fa-blog"></i>Submission</a></li>
            <li><a href="viewteams.php"><i class="fas fa-address-book"></i>Teams</a></li>
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
<!-- Filter and Search -->
<div class="list-section">
    <div class="filter-container">
        <select id="batchYearFilter">
            <option value="all">Filter Batch</option>
            <?php while ($batch_row = $batch_result->fetch_assoc()) { ?>
                <option value="<?php echo $batch_row['batch_year']; ?>"><?php echo $batch_row['batch_year']; ?></option>
            <?php } ?>
        </select>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
    </div>


    <div class="table-container">
        <table id="studentsTable">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Roll Number</th>
                    <th>Degree</th>
                    <th>Course</th>
                    <th>Batch Year</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $serial_number = 1;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $serial_number++ . "</td>";
                        echo "<td class='table-name'>" . htmlspecialchars($row['name']) . "</td>"; 
                        echo "<td>" . htmlspecialchars($row['roll_number']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['degree']) . "</td>";
                        echo "<td class='table-course'>" . htmlspecialchars($row['course']) . "</td>"; 
                        echo "<td class='table-batch-year'>" . htmlspecialchars($row['batch_year']) . "</td>";                     
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['phno']) . "</td>";
                        echo "<td>
                            <select class='action-dropdown' onchange='handleAction(this, \"" . htmlspecialchars($row['roll_number']) . "\")'>
                                <option value='' selected>Action</option>
                                <option value='view'>View</option>
                                <option value='delete'>Delete</option>
                            </select>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No students found</td></tr>";
                }
                ?>
            </tbody>

        </table>
    </div>
</div>
<script>
// Filter by Batch Year
document.getElementById('batchYearFilter').addEventListener('change', function() {
    var filterValue = this.value;
    var rows = document.querySelectorAll('#studentsTable tbody tr');

    rows.forEach(function(row) {
        var batchYear = row.querySelector('td:nth-child(6)').textContent;
        if (filterValue === 'all' || batchYear === filterValue) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Search Functionality
document.getElementById('searchInput').addEventListener('input', function() {
    var searchValue = this.value.toLowerCase();
    var rows = document.querySelectorAll('#studentsTable tbody tr');

    rows.forEach(function(row) {
        var rowText = row.textContent.toLowerCase();
        if (rowText.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

function handleAction(select, rollNumber) {
    const action = select.value;

    if (action === 'view') {
        // Redirect to the student profile page with roll number as a query parameter
        window.location.href = `view_stud_profiles.php?roll_number=${encodeURIComponent(rollNumber)}`;
    } else if (action === 'delete') {
        // Confirm deletion
        if (confirm('Are you sure you want to delete this student?')) {
            // Make an AJAX request to delete the student from the database
            fetch(`delete_student.php?roll_number=${encodeURIComponent(rollNumber)}`, {
                method: 'DELETE' // or 'POST' depending on your backend setup
            })
            .then(response => {
                if (response.ok) {
                    alert('Student deleted successfully.');
                    location.reload(); // Reload the page to see the changes
                } else {
                    alert('Failed to delete student. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the student.');
            });
        }
    }
}


</script>

</body>
</html>

<?php
$conn->close();
?>
