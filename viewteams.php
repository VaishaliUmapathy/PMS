<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Side Navigation Bar</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/0f4e2bc10d.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap">
    <style>
        /* Team Cards */
        /* General Styles for Main Content */
.main-content {
    padding: 20px;
    margin-left: 250px; /* To account for the sidebar */
    background-color: #f8f9fa; /* Light background for contrast */
}

/* Header Styles */


/* Section Title */
.main-content h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333; /* Dark color for the title */
}

/* Filter Options */
.filter-options {
    margin-bottom: 20px;
}

.filter-options select,
.filter-options input {
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-right: 10px;
}

/* Team Cards */
.team-card {
    width: 250px; /* Set a specific width for uniformity */
    margin: 15px; /* Spacing between cards */
    border:2px solid black;
    padding:20px;
    flex: 1 1 300px; /* Allows cards to grow and shrink, with a base width of 300px */
    margin: 10px; /* Adds space between cards */
    max-width: 500px; /* Ensures the card does not exceed 300px */
    box-sizing: border-box; /* Ensures padding is included in width */
}
.team-card:hover {
    transform: scale(1.05); /* Slightly enlarge on hover */
}

/* Action Buttons */
.action-buttons {
    display: flex;
    justify-content: space-between; /* Space out buttons */
}

/* Pagination Styles */
.pagination {
    margin-top: 20px;
    display: flex;
    justify-content: center; /* Center pagination controls */
    align-items: center;
}

.pagination button {
    padding: 10px 15px;
    margin: 0 10px; /* Spacing between buttons */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
    background-color: #007BFF;
    color: white;
}

.pagination button:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

.pagination span {
    color: #333; /* Dark color for text */
}
.section-team {
    display: flex;
    flex-wrap: wrap; /* Allows wrapping to the next line */
    justify-content: flex-start; /* Align items to the left */
    align-items: flex-start; /* Align items at the start of the container */
    margin-top: 50px;
}
/* Responsive Adjustments */
@media (max-width: 768px) {
    .main-content {
        margin-left: 0; /* Full width on smaller screens */
    }

    .team-card {
        width: 100%; /* Full width for cards on smaller screens */
    }
}


        .action-buttons {
            margin-top: 10px;
        }
        .action-buttons button {
            margin-right: 10px;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
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
        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 5px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        /* Responsive */
        
    </style>
    <script>
        function filterTeams() {
            const searchInput = document.getElementById("teamSearch").value.toLowerCase();
            const teamCards = document.querySelectorAll(".team-card");

            teamCards.forEach(card => {
                const teamName = card.querySelector("h3").textContent.toLowerCase();
                const department = card.querySelector("p").textContent.toLowerCase();

                // Check if the team name or department includes the search input
                if (teamName.includes(searchInput) || department.includes(searchInput)) {
                    card.style.display = ""; // Show the card
                } else {
                    card.style.display = "none"; // Hide the card
                }
            });
        }
        // Function to handle approval
        function updateApprovalStatus(teamId, action) 
        {
            fetch('update_approval.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `team_id=${teamId}&action=${action}`,
            })
            .then(response => response.text())
            .then(data => {
                if (data === "Success") {
                    alert(`Project has been ${action}d successfully.`);
                    // Optionally, update the button text or disable buttons after action
                    if (action === 'approve') {
                        document.getElementById(`approve_${teamId}`).textContent = "Approved";
                    } else {
                        document.getElementById(`disapprove_${teamId}`).textContent = "Disapproved";
                    }
                } else {
                    alert("Error updating the project status.");
                }
            })
            .catch(error => console.error('Error:', error));
        }


    </script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <img src="assets/img/girlprofile.png" alt="" width="100px "/>
        <h2 class="profile-name">Menu</h2>
        <h2 class="profile-roll">21CS053</h2>
        <ul>
            <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="student_dash.html"><i class="fas fa-user"></i>Profile</a></li>
            <li><a href="projects.html"><i class="fas fa-address-card"></i>Projects</a></li>
            <li><a href="mentor.html"><i class="fas fa-project-diagram"></i>Mentors</a></li>
            <li><a href="submission.html"><i class="fas fa-blog"></i>Submission</a></li>
            <li><a href="teams.html"><i class="fas fa-address-book"></i>Teams</a></li>
            <li><a href="#"><i class="fas fa-map-pin"></i>Map</a></li>
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
    
        <h2>Teams Under Your Mentorship</h2>
        <div class="filter-options">
            <select id="departmentFilter" onchange="filterTeams()">
                <option value="">All Departments</option>
                <option value="CS">Computer Science</option>
                <option value="ME">Mechanical Engineering</option>
            </select>
            <input type="text" id="teamSearch" placeholder="Search teams..." oninput="filterTeams()">
        </div>
    <section class="section-team">   
       
        <div class="team-card" >
            <a>
                <h3>Team Gamma</h3>
                <p><strong>Department:</strong> Computer Science</p>
                <p><strong>Year:</strong> 2024</p>
                <p><strong>Semester:</strong> 1</p>
                <p><strong>Team Members:</strong> Alice, Bob, Charlie</p>
                <div class="action-buttons">
                    <button class="approve" id="approve_1" onclick="event.stopPropagation(); updateApprovalStatus(1, 'approve');">Approve</button>
                    <button class="disapprove" id="disapprove_1" onclick="event.stopPropagation(); updateApprovalStatus(1, 'disapprove');">Disapprove</button>
                </div>
            </a>
        </div>
        <div class="team-card" onclick="showProjectDetails('Team Alpha', 'Smart Home Automation', 'To create an automated home system that can be controlled via mobile.');">
            <h3>Team Alpha</h3>
            <p><strong>Department:</strong> Computer Science</p>
            <p><strong>Year:</strong> 2024</p>
            <p><strong>Semester:</strong> 1</p>
            <p><strong>Team Members:</strong> Alice, Bob, Charlie</p>
            <div class="action-buttons">
                <button class="approve" id="approve_1" onclick="event.stopPropagation(); updateApprovalStatus(1, 'approve');">Approve</button>
                <button class="disapprove" id="disapprove_1" onclick="event.stopPropagation(); updateApprovalStatus(1, 'disapprove');">Disapprove</button>
            </div>
        </div>

        <div class="team-card" onclick="showProjectDetails('Team Beta', 'Eco-Friendly Packaging', 'To develop biodegradable packaging solutions for products.');">
            <h3>Team Beta</h3>
            <p><strong>Department:</strong> Mechanical Engineering</p>
            <p><strong>Year:</strong> 2024</p>
            <p><strong>Semester:</strong> 1</p>
            <p><strong>Team Members:</strong> David, Emma, Frank</p>
            <div class="action-buttons">
                <button class="approve" id="approve_1" onclick="event.stopPropagation(); updateApprovalStatus(1, 'approve');">Approve</button>
                <button class="disapprove" id="disapprove_1" onclick="event.stopPropagation(); updateApprovalStatus(1, 'disapprove');">Disapprove</button>
            </div>
        </div>
        <div class="team-card" onclick="showProjectDetails('Team Beta', 'Eco-Friendly Packaging', 'To develop biodegradable packaging solutions for products.');">
            <h3>Team Beta</h3>
            <p><strong>Department:</strong> Mechanical Engineering</p>
            <p><strong>Year:</strong> 2024</p>
            <p><strong>Semester:</strong> 1</p>
            <p><strong>Team Members:</strong> David, Emma, Frank</p>
            <div class="action-buttons">
                <button class="approve" id="approve_1" onclick="event.stopPropagation(); updateApprovalStatus(1, 'approve');">Approve</button>
                <button class="disapprove" id="disapprove_1" onclick="event.stopPropagation(); updateApprovalStatus(1, 'disapprove');">Disapprove</button>
            </div>
        </div>
        <div class="team-card" onclick="showProjectDetails('Team Beta', 'Eco-Friendly Packaging', 'To develop biodegradable packaging solutions for products.');">
            <h3>Team Beta</h3>
            <p><strong>Department:</strong> Mechanical Engineering</p>
            <p><strong>Year:</strong> 2024</p>
            <p><strong>Semester:</strong> 1</p>
            <p><strong>Team Members:</strong> David, Emma, Frank</p>
            <div class="action-buttons">
                <button class="approve" id="approve_1" onclick="event.stopPropagation(); updateApprovalStatus(1, 'approve');">Approve</button>
                <button class="disapprove" id="disapprove_1" onclick="event.stopPropagation(); updateApprovalStatus(1, 'disapprove');">Disapprove</button>
            </div>
        </div>
        <div class="team-card" onclick="showProjectDetails('Team Beta', 'Eco-Friendly Packaging', 'To develop biodegradable packaging solutions for products.');">
            <h3>Team Beta</h3>
            <p><strong>Department:</strong> Mechanical Engineering</p>
            <p><strong>Year:</strong> 2024</p>
            <p><strong>Semester:</strong> 1</p>
            <p><strong>Team Members:</strong> David, Emma, Frank</p>
            <div class="action-buttons">
                <button class="approve" id="approve_1" onclick="event.stopPropagation(); updateApprovalStatus(1, 'approve');">Approve</button>
                <button class="disapprove" id="disapprove_1" onclick="event.stopPropagation(); updateApprovalStatus(1, 'disapprove');">Disapprove</button>
            </div>
        </div>

        <!-- More team cards can be added here -->
    </section>

    <!-- Project Details Modal -->
    <div id="projectModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTeamName"></h2>
            <p><strong>Project Idea:</strong> <span id="modalProjectIdea"></span></p>
            <p><strong>Problem Statement:</strong> <span id="modalProblemStatement"></span></p>
        </div>
    </div>
    <div class="pagination">
        <button class="prev" onclick="previousPage()">Previous</button>
        <span>Page <strong id="currentPage">1</strong> of <strong id="totalPages">5</strong></span>
        <button class="next" onclick="nextPage()">Next</button>
    </div>
    
</section>


</body>
</html>
