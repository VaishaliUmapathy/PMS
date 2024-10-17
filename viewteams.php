<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management - Teams</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/0f4e2bc10d.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap">
    <script src="https://kit.fontawesome.com/0f4e2bc10d.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap">
    <style>
        /* General layout for the page */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Josefin Sans', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar styling */
        .sidebar {
            width: 250px;
            background-color: #343a40;
            position: fixed;
            top: 0;
            bottom: 0;
            padding: 20px;
            color: #fff;
        }

        .sidebar img {
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .sidebar h2 {
            color: #fff;
            font-size: 18px;
            text-align: center;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        /* Main content layout */
        .main-content {
            padding: 20px;
            margin-left: 250px;
            width: 100%;
            background-color: #f8f9fa;
        }

        .main-content h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        /* Filter and search */
        .filter-options {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .filter-options select,
        .filter-options input {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        /* Team cards layout */
        .section-team {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .team-card {
            width: 250px;
            margin: 15px;
            padding: 20px;
            background-color: #fff;
            border: 2px solid #343a40;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .team-card:hover {
            transform: scale(1.05);
        }

        .team-card h3 {
            margin-bottom: 10px;
            color: #343a40;
        }

        .team-card p {
            margin-bottom: 8px;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
        }

        .action-buttons button {
            padding: 8px 12px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .approve {
            background-color: #28a745;
            color: white;
        }

        .approve:hover {
            background-color: #218838;
        }

        .disapprove {
            background-color: #dc3545;
            color: white;
        }

        .disapprove:hover {
            background-color: #c82333;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }

            .team-card {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar section -->
    <div class="sidebar">
        <img src="assets/img/girlprofile.png" alt="Profile" width="100px">
        <h2 class="profile-name">Anitha</h2>
        <h2 class="profile-roll">CSE</h2>
        <ul>
            <li><a href="mentors_dash.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="mentor_profiles.php"><i class="fas fa-user"></i>Profile</a></li>
            <li><a href="projects.html"><i class="fas fa-address-card"></i>Projects</a></li>
            <li><a href="submission.html"><i class="fas fa-blog"></i>Submission</a></li>
            <li><a href="viewteams.php"><i class="fas fa-address-book"></i>Teams</a></li>
            <li><a href="cal.html"><i class="fas fa-calendar-alt"></i>Schedule</a></li>
        </ul>
    </div>

    <!-- Main content section -->
    <div class="main-content">
        <h2>Teams Under Your Mentorship</h2>

        <!-- Filter and search section -->
        <div class="filter-options">
            <select id="departmentFilter" onchange="filterTeams()">
                <option value="">All Departments</option>
                <option value="CS">Computer Science</option>
                <option value="ME">Mechanical Engineering</option>
            </select>
            <input type="text" id="teamSearch" placeholder="Search teams..." oninput="filterTeams()">
        </div>

        <!-- Team cards section -->
        <section class="section-team">
            <div class="team-card" data-team-id="team12"> 
                <h3>Team Gamma</h3>
                <p><strong>Department:</strong> Computer Science</p>
                <p><strong>Year:</strong> 2024</p>
                <p><strong>Semester:</strong> 1</p>
                <p><strong>Team Members:</strong> Alice, Bob, Charlie</p>
                <div class="action-buttons">
                    <button class="approve" onclick="updateProjectStatus(this, 'approve')">Approve</button>
                    <button class="disapprove" onclick="updateProjectStatus(this, 'disapprove')">Disapprove</button>
                </div>
            </div>
            <div class="team-card" data-team-id="team123"> 
                <h3>Team Gamma</h3>
                <p><strong>Department:</strong> Computer Science</p>
                <p><strong>Year:</strong> 2024</p>
                <p><strong>Semester:</strong> 1</p>
                <p><strong>Team Members:</strong> Alice, Bob, Charlie</p>
                <div class="action-buttons" >
                    <button class="approve" onclick="updateProjectStatus(this, 'approve')">Approve</button>
                    <button class="disapprove" onclick="updateProjectStatus(this, 'disapprove')">Disapprove</button>
                </div>
            </div>
            <div class="team-card" data-team-id="team18"> 
                <h3>Team Gamma</h3>
                <p><strong>Department:</strong> Computer Science</p>
                <p><strong>Year:</strong> 2024</p>
                <p><strong>Semester:</strong> 1</p>
                <p><strong>Team Members:</strong> Alice, Bob, Charlie</p>
                <div class="action-buttons">
                    <button class="approve" onclick="updateProjectStatus(this, 'approve')">Approve</button>
                    <button class="disapprove" onclick="updateProjectStatus(this, 'disapprove')">Disapprove</button>
                </div>
            </div>
            <div class="team-card" data-team-id="team15">
                <h3>Team Gamma</h3>
                <p><strong>Department:</strong> Computer Science</p>
                <p><strong>Year:</strong> 2024</p>
                <p><strong>Semester:</strong> 1</p>
                <p><strong>Team Members:</strong> Alice, Bob, Charlie</p>
                <div class="action-buttons">
                    <button class="approve" onclick="updateProjectStatus(this, 'approve')">Approve</button>
                    <button class="disapprove" onclick="updateProjectStatus(this, 'disapprove')">Disapprove</button>
                </div>
            </div>
            <div class="team-card" data-team-id="team155">
                <h3>Team Gamma</h3>
                <p><strong>Department:</strong> Computer Science</p>
                <p><strong>Year:</strong> 2024</p>
                <p><strong>Semester:</strong> 1</p>
                <p><strong>Team Members:</strong> Alice, Bob, Charlie</p>
                <div class="action-buttons">
                    <button class="approve" onclick="updateProjectStatus(this, 'approve')">Approve</button>
                    <button class="disapprove" onclick="updateProjectStatus(this, 'disapprove')">Disapprove</button>
                </div>
            </div>

            <div class="team-card" data-team-id="team193">
                <h3>Team Alpha</h3>
                <p><strong>Department:</strong> Computer Science</p>
                <p><strong>Year:</strong> 2024</p>
                <p><strong>Semester:</strong> 1</p>
                <p><strong>Team Members:</strong> Alice, Bob, Charlie</p>
                <div class="action-buttons">
                    <button class="approve" onclick="updateProjectStatus(this, 'approve')">Approve</button>
                    <button class="disapprove" onclick="updateProjectStatus(this, 'disapprove')">Disapprove</button>
                </div>
            </div>

            <div class="team-card" data-team-id="team456"> 
                <h3>Team Beta</h3>
                <p><strong>Department:</strong> Mechanical Engineering</p>
                <p><strong>Year:</strong> 2024</p>
                <p><strong>Semester:</strong> 1</p>
                <p><strong>Team Members:</strong> David, Emma, Frank</p>
                <div class="action-buttons">
                    <button class="approve" onclick="updateProjectStatus(this, 'approve')">Approve</button>
                    <button class="disapprove" onclick="updateProjectStatus(this, 'disapprove')">Disapprove</button>
                </div>
            </div>
        </section>
    </div>

    <script>
        // Filtering logic
        function filterTeams() {
            const searchInput = document.getElementById("teamSearch").value.toLowerCase();
            const departmentFilter = document.getElementById("departmentFilter").value;
            const teamCards = document.querySelectorAll(".team-card");

            teamCards.forEach(card => {
                const teamName = card.querySelector("h3").textContent.toLowerCase();
                const department = card.querySelector("p").textContent.toLowerCase();

                const matchesSearch = teamName.includes(searchInput);
                const matchesDepartment = departmentFilter === "" || department.includes(departmentFilter.toLowerCase());

                if (matchesSearch && matchesDepartment) {
                    card.style.display = ""; // Show the card
                } else {
                    card.style.display = "none"; // Hide the card
                }
            });
        }

        
        function updateProjectStatus(buttonElement, action)
         {
                // Get the parent team-card element
                const teamCard = buttonElement.closest('.team-card');

                // Extract data attributes
                const teamId = teamCard.getAttribute('data-team-id'); // Add this attribute to your team cards
                const teamName = teamCard.querySelector("h3").textContent;
                const department = teamCard.querySelector("p").textContent.match(/Department:\s*(.*)/)[1]; // Adjusted for correct extraction
                const year = teamCard.querySelector("p").textContent.match(/Year:\s*(\d+)/)[1]; // Adjusted for correct extraction
                const semester = teamCard.querySelector("p").textContent.match(/Semester:\s*(\d+)/)[1]; // Adjusted for correct extraction
                const teamMembers = teamCard.querySelector("p").textContent.match(/Team Members:\s*(.*)/)[1]; // Adjusted for correct extraction

                // Prepare the data to send
                const postData = `team_id=${encodeURIComponent(teamId)}&` +
                                `team_name=${encodeURIComponent(teamName)}&` +
                                `department=${encodeURIComponent(department)}&` +
                                `year=${encodeURIComponent(year)}&` +
                                `semester=${encodeURIComponent(semester)}&` +
                                `team_members=${encodeURIComponent(teamMembers)}&` +
                                `action=${encodeURIComponent(action)}`;

                fetch('update_approval.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: postData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Status updated successfully!');
                    } else {
                        alert('Error updating status: ' + data.message);
                    }
                })
            .catch(error => console.error('Error:', error));
        }



    </script>
</body>

</html>
