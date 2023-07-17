<?php
include "db.php";

session_start();
if(!isset($_SESSION["user_id"])) {
    header("Content-Type: application/json");
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION["user_id"];
$goal = json_decode(file_get_contents('php://input'), true);

$goal_id = $goal['goalId'];
$title = $goal['nameOfGoal'];
$start_date = $goal['startDate'];
$end_date = $goal['endDate'];

// Insert the goal into the goals table
$sql = "UPDATE tbl_210_goals_test 
SET title='$title', start_date='$start_date', end_date='$end_date' 
WHERE trainee_id = $user_id AND id = $goal_id";

$stmt = $connection->prepare($sql);
if ($stmt->execute()) {
    echo json_encode(['message' => 'Goal updated successfully']);
} else {
    echo json_encode(['error' => 'Failed to update goal: ' . $stmt->error]);
}

$connection->close();
exit;