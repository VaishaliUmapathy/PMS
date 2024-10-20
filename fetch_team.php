<?php
include 'db_connection.php';
//include 'db.php';
header('Content-Type: application/json'); // Ensure the response is JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $team_id = (int)$_POST['id'];

    // Fetch the team details
    $sql = "SELECT * FROM teams WHERE id = $team_id";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $team = $result->fetch_assoc();

            // Fetch members for the team
            $member_sql = "SELECT * FROM team_members WHERE team_id = $team_id";
            $member_result = $conn->query($member_sql);
            $members = [];

            while ($member_row = $member_result->fetch_assoc()) {
                unset($member_row['id']);
                unset($member_row['team_id']);
                $members[] = $member_row;
            }

            // Return the response
            echo json_encode([
                'success' => true,
                'data' => array_merge($team, ['members' => $members]),
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => "Team not found.",
            ]);
        }
    } else {
        // Query failed
        echo json_encode([
            'success' => false,
            'message' => "SQL error: " . $conn->error,
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => "Invalid request.",
    ]);
}

$conn->close();
?>
