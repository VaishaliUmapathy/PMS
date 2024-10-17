<?php
include 'db_connection.php';  // Include database connection

$messages = [];

// Handle POST request to create a new team
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST;  // Get POST data directly from the form

    // Validate input fields
    if (empty($data['team_name']) || empty($data['team_size']) || empty($data['year']) || empty($data['department'])) {
        $messages[] = "All team fields are required.";
    } else {
        $team_name = $conn->real_escape_string($data['team_name']);
        $team_size = (int)$data['team_size'];
        $year = (int)$data['year'];
        $department = $conn->real_escape_string($data['department']);

        // Insert team into the 'teams' table
        $sql = "INSERT INTO teams (team_name, team_size, year, department) VALUES ('$team_name', $team_size, $year, '$department')";

        if ($conn->query($sql) === TRUE) {
            $team_id = $conn->insert_id;  // Get the last inserted ID

            // Insert each team member into the 'team_members' table
            for ($i = 0; $i < count($data['member_name']); $i++) {
                $member_name = $conn->real_escape_string($data['member_name'][$i]);
                $roll_no = $conn->real_escape_string($data['roll_no'][$i]);
                $member_role = $conn->real_escape_string($data['member_role'][$i]);
                $member_email = $conn->real_escape_string($data['member_email'][$i]);
                $member_phone = $conn->real_escape_string($data['member_phone'][$i]);

                // Insert member query
                $sql_member = "INSERT INTO team_members (team_id, member_name, roll_no, member_role, member_email, member_phone)
                               VALUES ($team_id, '$member_name', '$roll_no', '$member_role', '$member_email', '$member_phone')";

                if ($conn->query($sql_member) === FALSE) {
                    $messages[] = "Error inserting member: " . $conn->error;
                }
            }

            // Success message
            $messages[] = "Team '$team_name' created successfully!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $messages[] = "Failed to create team: " . $conn->error;
        }
    }
}

// Fetch all teams and members
$sql = "SELECT * FROM teams";
$result = $conn->query($sql);
$teams = [];

while ($row = $result->fetch_assoc()) {
    $team_id = $row['id'];
    $row['members'] = [];

    // Fetch members for the team
    $member_sql = "SELECT * FROM team_members WHERE team_id = $team_id";
    $member_result = $conn->query($member_sql);
    while ($member_row = $member_result->fetch_assoc()) {
        unset($member_row['id']);
        unset($member_row['team_id']);
        $row['members'][] = $member_row;
    }

    // Add team data to the teams array
    $teams[] = array(
        "id" => $row['id'],
        "team_name" => $row['team_name'],
        "team_size" => $row['team_size'],
        "year" => $row['year'],
        "department" => $row['department'],
        "members" => $row['members']
    );
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Team</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Team Creation Page</h1>
        <button id="create-team-btn" class="btn primary">Create Team</button>

        <!-- Hidden form container -->
        <div id="form-container" class="hidden form-container">
            <form id="create-team-form" method="POST" action="">
                <div class="form-row">
                    <div class="form-group">
                        <label for="team-name">Team Name</label>
                        <input type="text" id="team-name" name="team_name" required>
                    </div>
                    <div class="form-group">
                        <label for="team-size">Team Size</label>
                        <input type="number" id="team-size" name="team_size" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="year">Year</label>
                        <select id="year" name="year" required>
                            <option value="0" disabled selected>Select</option>
                            <option value="1">1st</option>
                            <option value="2">2nd</option>
                            <option value="3">3rd</option>
                            <option value="4">4th</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select id="department" name="department" required>
                            <option value="0" disabled selected>Select</option>
                            <option value="CSE">CSE</option>
                            <option value="ECE">ECE</option>
                            <option value="EEE">EEE</option>
                            <option value="MECH">MECH</option>
                            <option value="IT">IT</option>
                            <option value="AIDS">AIDS</option>
                        </select>
                    </div>
                </div>
                
                <h3>Team Members</h3>
                <div id="team-members-section">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="member-name-0">Member Name</label>
                            <input type="text" id="member-name-0" name="member_name[]" required>
                        </div>
                        <div class="form-group">
                            <label for="roll-no-0">Roll No</label>
                            <input type="text" id="roll-no-0" name="roll_no[]" required>
                        </div>
                        <div class="form-group">
                            <label for="member-role-0">Role</label>
                            <select id="member-role-0" name="member_role[]" required>
                                <option value="0" disabled selected>Select</option>
                                <option value="Leader">Leader</option>
                                <option value="Member">Member</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="member-email-0">Email</label>
                            <input type="email" id="member-email-0" name="member_email[]" required>
                        </div>
                        <div class="form-group">
                            <label for="member-phone-0">Phone No</label>
                            <input type="tel" id="member-phone-0" name="member_phone[]" required>
                        </div>
                    </div>
                </div>
                <button type="button" id="add-member-btn" class="btn secondary">Add Member</button>
                <button type="submit">Save Team</button>
            </form>
        </div>

        <!-- Display success messages -->
        <?php if (!empty($messages)): ?>
            <div class="messages">
                <?php foreach ($messages as $message): ?>
                    <p><?php echo $message; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Created teams section -->
        <h2>Created Teams</h2>
        <div id="created-teams">  
            <?php foreach ($teams as $team): ?>  
                <div class="team-box">  
                    <h3><?php echo htmlspecialchars($team['team_name']); ?> (ID: <?php echo htmlspecialchars($team['id']); ?>)</h3>  
                    <p>Department: <?php echo htmlspecialchars($team['department']); ?>, Year: <?php echo htmlspecialchars($team['year']); ?>, Size: <?php echo htmlspecialchars($team['team_size']); ?></p>  
                    <h4>Members:</h4>  
                    <ul>  
                        <?php foreach ($team['members'] as $member): ?>  
                            <li><?php echo htmlspecialchars($member['member_name']); ?> (<?php echo htmlspecialchars($member['member_role']); ?>)</li>  
                        <?php endforeach; ?>  
                    </ul>  
                    <div class="team-actions">  
                        <button class="edit-btn" onclick="editTeam(<?php echo $team['id']; ?>)">Edit</button>  
                        <button class="view-btn" onclick="viewTeam(<?php echo $team['id']; ?>)">View</button>  
                        <button class="delete-btn" onclick="deleteTeam(<?php echo $team['id']; ?>)">Delete</button>  
                    </div>  
                </div>  
            <?php endforeach; ?>  
        </div>
    </div>

<!-- Modal for viewing team details -->  
<div id="team-modal" class="modal hidden">  
    <div class="modal-content">  
        <span class="close-modal" onclick="closeModal()">&times;</span>  
        <h2>Team Details</h2>  
        <div id="team-details"></div>  
    </div>  
</div>  

<script src="script.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
