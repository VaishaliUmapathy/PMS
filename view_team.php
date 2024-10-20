<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('db.php'); // Include the database connection

// Get the team ID from the URL (view_team.php?id=1)
if (isset($_GET['id'])) {
    $team_id = (int)$_GET['id'];

    // Fetch team details
    $sql_team = "SELECT * FROM teams WHERE id = $team_id";
    $team_result = $conn->query($sql_team);

    if ($team_result && $team_result->num_rows > 0) {
        $team = $team_result->fetch_assoc();

        // Fetch team members
        $sql_members = "SELECT * FROM team_members WHERE team_id = $team_id";
        $member_result = $conn->query($sql_members);

        if ($member_result) {
            $team['members'] = [];
            while ($member = $member_result->fetch_assoc()) {
                $team['members'][] = $member;
            }
        } else {
            $team['members'] = []; // No members found
        }
    } else {
        $error_message = "Team not found.";
    }
} else {
    $error_message = "No team ID provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Details</title>
    <link rel="stylesheet" href="#"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #E9F1FA; /* Light blue */
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #FFFFFF; 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2, h3 {
            color: #00ABE4; 
        }

        p {
            margin: 10px 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            color: #00ABE4;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Team Details</h1>

        <?php if (isset($error_message)): ?>
            <p>Error loading team details: <?= htmlspecialchars($error_message) ?></p>
        <?php else: ?>
            <h2><?= htmlspecialchars($team['team_name']) ?></h2>
            <p><strong>Team Size:</strong> <?= htmlspecialchars($team['team_size']) ?></p>
            <p><strong>Year:</strong> <?= htmlspecialchars($team['year']) ?></p>
            <p><strong>Department:</strong> <?= htmlspecialchars($team['department']) ?></p>

            <h3>Team Members:</h3>
            <?php if (count($team['members']) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Member</th>
                            <th>Roll No</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($team['members'] as $member): ?>
                            <tr>
                                <td><?= htmlspecialchars($member['member_name']) ?></td>
                                <td><?= htmlspecialchars($member['roll_no']) ?></td> <!-- Ensure this matches your DB column -->
                                <td><?= htmlspecialchars($member['member_email']) ?></td>
                                <td><?= htmlspecialchars($member['member_phone']) ?></td>
                                <td><?= htmlspecialchars($member['member_role']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No members found for this team.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
