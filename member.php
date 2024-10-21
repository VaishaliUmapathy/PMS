<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to external CSS file -->
    <title>Teams</title>

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 20px;
            text-align: left;
        }

        h1 {
            text-align: left;
            color: #333;
        }

        /* Team Container */
        #teams-container {
            display: flex; /* Make the teams container a flex container */
            flex-wrap: wrap; /* Allow wrapping to the next line */
            justify-content: space-between; /* Space between items */
            max-width: 800px;
            margin: 0 auto;
        }

        /* Team Box */
        

        /* Team Details Container */
        .team-details-container {
           
            display: flex;
            flex-direction: column; /* Stack team details vertically */
            margin-bottom: 10px;
            border:3px solid black; /* Space below the team details */
        }

        /* Team Name */
        .team-name {
            font-size: 20px;
            font-weight: bold;
            color: #007BFF;
            margin-bottom: 5px; /* Space below team name */
        }

        /* Abstract and PPT Sections */
        .abstract-section {
            font-size: 16px;
            margin-bottom: 5px; /* Space below abstract section */
        }

        /* Button Styles */
        button {
            padding: 8px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 1px;
            cursor: pointer;
            margin-top: 5px; 
            width:200px;
          
            justify-content:flex-end;/* Add margin for spacing */
        }

        button:hover {
            background-color: #218838;
           
        }

        /* Team Member Details Box */
        .members-box {
            border: 3px solid black; /* Border color for the member box */
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px; /* Space above the members box */
            display: none; /* Initially hidden */
        }

        /* Member List */
        ul {
            list-style-type: none;
            padding-left: 0;
        }

        ul li {
            background-color: #f9f9f9;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 5px;
        }

        /* Links */
        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Teams</h1>

    <div id="teams-container">
        
        <?php
        include 'db.php'; // Include your database connection

        // Fetch teams and their members from the database
        $sql = "SELECT teams.id, teams.team_name, teams.abstract, teams.ppt_link, 
                       team_members.member_name, team_members.roll_no, team_members.year, team_members.progress
                FROM teams
                LEFT JOIN team_members ON teams.id = team_members.team_id
                ORDER BY teams.id";
        $result = $conn->query($sql);

        $current_team = null;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Check if this is a new team to display
                if ($current_team !== $row['team_name']) {
                    // Close previous team's details if any
                    if ($current_team !== null) {
                        echo "</ul></div>"; // Close the previous team details
                    }
                    // Start a new team div
                    echo "<div class='team'>"; // Use the flex container class here
                    echo "<div class='team-details-container'>";
                    echo "<div class='team-name'>" . $row['team_name'] . "</div>";
                    echo "<div class='abstract-section'><strong>Abstract:</strong> " . $row['abstract'] . "</div>";
                    echo "<div class='abstract-section'><strong>PPT:</strong> <a href='" . $row['ppt_link'] . "' target='_blank'>View PPT</a></div>";
                    echo "<button onclick=\"toggleDetails('members-box-" . $row['id'] . "')\">View Team Members</button>";
                    echo "</div>"; // Close team-details-container
                    echo "<div id='members-box-" . $row['id'] . "' class='members-box'>";
                    echo "<ul>"; // Start member list
                    $current_team = $row['team_name'];
                }
                
                // Display team members for this team
                if (!empty($row['member_name'])) {
                    echo "<li>";
                    echo "<strong>" . $row['member_name'] . "</strong> (Roll No: " . $row['roll_no'] . ", Year: " . $row['year'] . ", Progress: " . $row['progress'] . "%)";
                    echo "</li>";
                }
            }
            // Close the last team's details
            echo "</ul></div>"; // Close last team's details div and list
        } else {
            echo "<p>No teams found.</p>";
        }

        $conn->close();
        ?>
    </div>

    <script>
        // JavaScript function to toggle the visibility of team member details
        function toggleDetails(id) {
            var details = document.getElementById(id);
            if (details.style.display === "none" || details.style.display === "") {
                details.style.display = "block"; // Show the members box
            } else {
                details.style.display = "none"; // Hide the members box
            }
        }
    </script>

</body>
</html>
