<?php
include "db.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payload = json_decode(file_get_contents('php://input'), true);
    
    if (isset($payload['profile_id']) && !empty($payload['profile_id'])) {
        $user_id = $payload['profile_id'];

        $experience = $payload['experience'];
        $rank = $payload['rank'];
        $team = $payload['team'];
    
        $query = "UPDATE tbl_210_union_test SET experience = ?, rank = ?, team = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($connection, $query);
        $stmt->bind_param("sssi", $experience, $rank, $team, $user_id);
    }
    else {
        $user_id = $_SESSION["user_id"];
        $phone = $payload['phone'];
        $city = $payload['city'];
        $emergency_phone = $payload['emergency_phone'];
        $email = $payload['email'];
    
        $query = "UPDATE tbl_210_contact_test SET phone = ?, city = ?, emergency_phone = ?, email = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($connection, $query);
        $stmt->bind_param("ssssi", $phone, $city, $emergency_phone, $email, $user_id);
    }

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Profile contact details updated successfully']);
    }
    else {
        echo json_encode(['error' => 'Failed to update profile contact details: ' . $stmt->error]);
    }
}
$connection->close();