<?php
    include "db.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $user_id = $_SESSION['user_id'];
    
    $sql = "SELECT tbl_210_users_test.id, tbl_210_users_test.username, tbl_210_details_test.full_name, tbl_210_details_test.birth_date, TIMESTAMPDIFF(YEAR, tbl_210_details_test.birth_date, CURDATE()) AS age, tbl_210_details_test.gender, tbl_210_details_test.potential as potential, tbl_210_union_test.team
            FROM tbl_210_users_test
            INNER JOIN tbl_210_details_test ON tbl_210_users_test.id = tbl_210_details_test.user_id
            INNER JOIN tbl_210_union_test ON tbl_210_users_test.id = tbl_210_union_test.user_id
            INNER JOIN tbl_210_trainee_coach_test ON tbl_210_users_test.id = tbl_210_trainee_coach_test.trainee_id
            WHERE tbl_210_trainee_coach_test.coach_id = $user_id";

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
