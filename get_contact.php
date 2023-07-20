<?php
include 'db.php'; // Assumes you have a db_connect.php to establish a db connection


if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $userId = $_GET["id"];
}
else {
    $userId = $_SESSION["user_id"];
}

$query = "SELECT * FROM tbl_210_contact_test WHERE user_id = $userId";
$result = $connection->query($query);
$data = mysqli_fetch_assoc($result);

header('Content-Type: application/json');
echo json_encode($data);
?>