<?php
include "db.php";

session_start();

if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION["user_id"];
$sql = "SELECT DISTINCT(catDef.s_type) 
    FROM `tbl_210_categories_def_test` as catDef 
    JOIN `tbl_210_skills_test` as skills ON catDef.id = skills.category_id 
    WHERE skills.user_id = $userId AND catDef.id = skills.category_id";

$result = $connection->query($sql);

$categories = array();
while($row = $result->fetch_assoc()) 
{   
    array_push($categories, $row['s_type']);
}

echo json_encode($categories);