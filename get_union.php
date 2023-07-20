<?php
include 'db.php'; 


session_start();

if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION["user_id"];

$query = "SELECT * FROM tbl_210_union_test WHERE user_id = $userId";
$result = $connection->query($query);
$data = mysqli_fetch_assoc($result);

header('Content-Type: application/json');
echo json_encode($data);
?>
