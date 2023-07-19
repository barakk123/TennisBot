<?php
include "db.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from request
    $request = json_decode(file_get_contents('php://input'));

    if (!empty($request)) {
        $coach_id = $_SESSION["user_id"];

        foreach ($request as $trainee_id) {
            // Insert each trainee-coach assignment into the database
            $sql = "INSERT INTO tbl_210_trainee_coach_test (trainee_id, coach_id) VALUES ($trainee_id, $coach_id)";
            if (!$connection->query($sql)) {
                // Insert failed, send back an error response
                echo json_encode(['success' => false]);
                exit();
            }
        }

        // All inserts successful, send back a success response
        echo json_encode(['success' => true]);
    }
}

$connection->close();
?>
