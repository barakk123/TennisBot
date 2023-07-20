<?php
include "db.php";

if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION["profile_id"]) && !empty($_SESSION["profile_id"])) {
    $userId = $_SESSION["profile_id"];
    $coach_goals = 1;
}
else if (isset($_GET['coach_goals']) && !empty($_GET['coach_goals'])) {
    $userId = $_SESSION["user_id"];
    $coach_goals = 1;
}
else {
    $userId = $_SESSION["user_id"];
    $coach_goals = 0;
}

$sortOption = isset($_GET['sortOption']) ? $_GET['sortOption'] : 'start_date';

// Prepare SQL query based on the sort option
switch ($sortOption) {
    case 'Date':
        $sortOption = 'start_date' . " DESC";
        break;
    case 'Title':
        $sortOption = 'title';
        break;
    default:
        $sortOption = 'start_date'; // Default sort option
}

$sql = "SELECT * FROM tbl_210_goals WHERE trainee_id = " . $userId . " AND coach_goal = " . $coach_goals . " ORDER BY " . $sortOption;
$result = $connection->query($sql);

$goals = array();
while($row = $result->fetch_assoc()) 
{
    $goal = array(
        'id' => $row['id'],
        'title' => $row['title'],
        'start_date' => $row['start_date'],
        'end_date' => $row['end_date'],
        'categories' => array()
    );

    $sql_categories = "SELECT DISTINCT(catDef.name), catDef.id FROM tbl_210_subcategories as subCat JOIN tbl_210_categories_def as catDef ON subCat.category_id = catDef.id WHERE subCat.goal_id = " . $row['id'];
    $result_categories = $connection->query($sql_categories);

    while($row_categories = $result_categories->fetch_assoc())
    {
        $category = array(
            'id' => $row_categories['id'],
            'name' => $row_categories['name'],
            'subcategories' => array()
        );

        $sql_subcategories = "SELECT s.id, s.current, s.target, d.name FROM tbl_210_subcategories AS s JOIN tbl_210_subcategories_def AS d ON s.subcategory_id = d.id WHERE s.goal_id=" . $row['id'] . " AND s.category_id=" . $row_categories['id'];
        $result_subcategories = $connection->query($sql_subcategories);

        while($row_subcategories = $result_subcategories->fetch_assoc())
        {
            $subcategory = array(
                'id' => $row_subcategories['id'],
                'name' => $row_subcategories['name'],
                'current' => $row_subcategories['current'],
                'target' => $row_subcategories['target'],
            );
            array_push($category['subcategories'], $subcategory);
        }
        
        array_push($goal['categories'], $category);
    }
    
    array_push($goals, $goal);
}

echo json_encode($goals);