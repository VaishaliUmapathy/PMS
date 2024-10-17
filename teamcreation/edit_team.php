<?php
include('db_connection.php'); // Include the database connection

// Get the team ID from the URL (edit_team.php?id=1)
if (isset($_GET['id'])) {
    $team_id = (int)$_GET['id'];

    // Fetch team details
    $sql_team = "SELECT * FROM teams WHERE id = $team_id";
    $team_result = $conn->query($sql_team);
    $team = $team_result->fetch_assoc();

    if ($team) {
        // Fetch team members
        $sql_members = "SELECT * FROM team_members WHERE team_id = $team_id";
        $member_result = $conn->query($sql_members);
        $team['members'] = [];
        while ($member = $member_result->fetch_assoc()) {
            $team['members'][] = $member;
        }
    } else {
        echo "Team not found.";
        exit();
    }
} else {
    echo "No team ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Team</title>
    <link rel="stylesheet" href="edit-style.css">
</head>
<body>
    <h1>Edit Team: <?= htmlspecialchars($team['team_name']) ?></h1>

    <form action="update_team.php" method="POST">
        <input type="hidden" name="team_id" value="<?= $team['id'] ?>">

        <label for="team_name">Team Name:</label>
        <input type="text" id="team_name" name="team_name" value="<?= htmlspecialchars($team['team_name']) ?>" required><br>

        <label for="team_size">Team Size:</label>
        <input type="number" id="team_size" name="team_size" value="<?= $team['team_size'] ?>" required><br>

        <label for="year">Year:</label>
        <input type="number" id="year" name="year" value="<?= $team['year'] ?>" required><br>

        <label for="department">Department:</label>
        <input type="text" id="department" name="department" value="<?= htmlspecialchars($team['department']) ?>" required><br>

        <h3>Team Members:</h3>
        <?php foreach ($team['members'] as $index => $member): ?>
            <div class="member">
                <input type="hidden" name="member_id[]" value="<?= $member['id'] ?>">
                <label for="member_name_<?= $index ?>">Name:</label>
                <input type="text" id="member_name_<?= $index ?>" name="member_name[]" value="<?= htmlspecialchars($member['member_name']) ?>" required><br>

                <label for="roll_no_<?= $index ?>">Roll No:</label>
                <input type="text" id="roll_no_<?= $index ?>" name="roll_no[]" value="<?= htmlspecialchars($member['roll_no']) ?>" required><br>

                <label for="member_role_<?= $index ?>">Role:</label>
                <input type="text" id="member_role_<?= $index ?>" name="member_role[]" value="<?= htmlspecialchars($member['member_role']) ?>" required><br>

                <label for="member_email_<?= $index ?>">Email:</label>
                <input type="email" id="member_email_<?= $index ?>" name="member_email[]" value="<?= htmlspecialchars($member['member_email']) ?>" required><br>

                <label for="member_phone_<?= $index ?>">Phone:</label>
                <input type="text" id="member_phone_<?= $index ?>" name="member_phone[]" value="<?= htmlspecialchars($member['member_phone']) ?>" required><br>
            </div>
        <?php endforeach; ?>

        <div class="button-group">
    <button type="submit">Update Team</button>
    <a href="index.php">
        <button class="back">Go Back</button>
    </a>
</div>
</form>
</a>
</body>
</html>
