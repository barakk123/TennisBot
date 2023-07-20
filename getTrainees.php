<?php
    include "db.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $user_id = $_SESSION['user_id'];
    
    $sql = "SELECT tbl_210_users.id, tbl_210_users.username, tbl_210_details.full_name, tbl_210_details.birth_date, TIMESTAMPDIFF(YEAR, tbl_210_details.birth_date, CURDATE()) AS age, tbl_210_details.gender, tbl_210_details.potential as potential, tbl_210_union.team
            FROM tbl_210_users
            INNER JOIN tbl_210_details ON tbl_210_users.id = tbl_210_details.user_id
            INNER JOIN tbl_210_union ON tbl_210_users.id = tbl_210_union.user_id
            INNER JOIN tbl_210_trainee_coach ON tbl_210_users.id = tbl_210_trainee_coach.trainee_id
            WHERE tbl_210_trainee_coach.coach_id = $user_id";

    $result = $connection->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } 

    echo json_encode($data);
?>
