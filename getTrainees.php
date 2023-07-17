<?php
    include "db.php";

    $sql = "SELECT tbl_210_users_test.id, tbl_210_users_test.username, tbl_210_details_test.full_name, tbl_210_details_test.birth_date, TIMESTAMPDIFF(YEAR, tbl_210_details_test.birth_date, CURDATE()) AS age, tbl_210_details_test.gender, tbl_210_details_test.potential as potential, tbl_210_union_test.team
            FROM tbl_210_users_test
            JOIN tbl_210_details_test ON tbl_210_users_test.id = tbl_210_details_test.user_id
            JOIN tbl_210_union_test ON tbl_210_users_test.id = tbl_210_union_test.user_id";

    $result = $connection->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
        echo "0 results";
    }

    echo json_encode($data);
?>
