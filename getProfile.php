<?php
include "db.php";

if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION["user_id"];
$sql = "SELECT catDef.id as category_id, catDef.name as category_name, catDef.s_type as category_type, subCatDef.id as subcategory_id, subCatDef.name as subcategory_name, skills.value as skill_value 
    FROM `tbl_210_skills_test` as skills 
    LEFT JOIN `tbl_210_subcategories_def_test` as subCatDef ON subCatDef.id = skills.subcategory_id 
    LEFT JOIN `tbl_210_categories_def_test` as catDef ON catDef.id = skills.category_id 
    WHERE skills.user_id = $userId";

$result = $connection->query($sql);

echo json_encode($result->fetch_assoc());