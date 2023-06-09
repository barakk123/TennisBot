<?php


include "db.php";

session_start();
if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Build the SQL query
$sql = "SELECT 
  catDef.name AS category_name,
  subCatDef.name AS subcategory_name,
  skills.value AS skill_value
FROM 
  tbl_210_skills_test AS skills
JOIN 
  tbl_210_categories_def_test AS catDef
ON
  skills.category_id = catDef.id
JOIN 
  tbl_210_subcategories_def_test AS subCatDef
ON
  skills.subcategory_id = subCatDef.id
WHERE
  skills.user_id = $user_id";

if ($category != '') {
    $sql .= " AND catDef.s_type = '$category'";
}

// Order by category_id
$sql .= " ORDER BY catDef.id";

$result = $connection->query($sql);

$strikes = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $strikes[] = $row;
    }
}
echo json_encode(array('strikes' => $strikes));
$connection->close();
?>
