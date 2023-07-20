<?php
include "db.php";
if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

$sql = "
SELECT u.*, d.full_name 
FROM tbl_210_users u 
JOIN tbl_210_details d ON u.id = d.user_id 
WHERE u.user_type = 'Trainee' 
AND u.id NOT IN (
    SELECT tc.trainee_id FROM tbl_210_trainee_coach tc
)
";

$result = $connection->query($sql);

if (!$result) {
    die('Invalid query: ' . mysqli_error($connection));
}

$data = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} 

header('Content-Type: application/json');
echo json_encode(array('trainees' => $data));
$connection->close();
?>
