<?php
include "db.php";

if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payload = json_decode(file_get_contents('php://input'), true);
    
    $user_id = $_SESSION["user_id"];
    $profile_pic = $payload["profile_pic"];

    $query = "UPDATE tbl_210_details SET profile_pic = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($connection, $query);
    $stmt->bind_param("si", $profile_pic, $user_id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Profile pic saved successfully']);
    }
    else {
        echo json_encode(['error' => 'Failed to update profile pic: ' . $stmt->error]);
    }
}
$connection->close();