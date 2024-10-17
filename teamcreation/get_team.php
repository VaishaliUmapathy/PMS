<?php
include 'db_connection.php';  // Include database connection

if (isset($_GET['id'])) {
    $team_id = (int)$_GET['id'];

    // Fetch the team details
    $sql = "SELECT * FROM teams WHERE id = $team_id";
    $team_result = $conn->query($sql);
    $team = $team_result->fetch_assoc();

    // Fetch members for the team
    $member_sql = "SELECT * FROM team_members WHERE team_id = $team_id";
    $member_result = $conn->query($member_sql);
    $members = [];

    while ($member_row = $member_result->fetch_assoc()) {
        unset($member_row['id']);
        unset($member_row['team_id']);
        $members[] = $member_row;
    }

    // Combine team and members data
    $team['members'] = $members;

    // Return team details as JSON
    echo json_encode($team);
}

$conn->close();
?>
