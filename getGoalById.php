<?php
include "db.php";

if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
else if ($_SERVER["REQUEST_METHOD"] != "GET" || !isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$goalId = $_GET['id'];

$sql = "SELECT goal.*, sub.*
    FROM tbl_210_goals_test as goal
    JOIN tbl_210_subcategories_test as sub ON goal.id = sub.goal_id
    WHERE goal.id = $goalId;
";

$result = $connection->query($sql);

$goal = $result->fetch_assoc();

echo json_encode($goal);

$connection->close();