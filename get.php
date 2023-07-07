<?php
include "db.php";
include "config.php";

session_start();

if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION["user_id"];
$sql = "SELECT * FROM tbl_210_goals_test WHERE trainee_id = " . $userId;

$result = $connection->query($sql);

$goals = array();
while($row = $result->fetch_assoc()) 
{
    $goal = array(
        'id' => $row['id'],
        'title' => $row['title'],
        'start_date' => $row['start_date'],
        'end_date' => $row['end_date'],
        'status' => $row['status'],
        'progress' => $row['progress'],
        'categories' => array()
    );

    $sql_categories = "SELECT c.id AS category_test_id, c.category_id, cd.name FROM tbl_210_categories_test AS c JOIN tbl_210_categories_def_test AS cd ON c.category_id = cd.id WHERE c.goal_id=" . $row['id'];

    $result_categories = $connection->query($sql_categories);

    while($row_categories = $result_categories->fetch_assoc())
    {
        $category = array(
            'id' => $row_categories['category_test_id'],
            'name' => $row_categories['name'],
            'subcategories' => array()
        );
        
        

        $sql_subcategories = "SELECT s.id, s.current, s.target, d.name FROM tbl_210_subcategories_test AS s JOIN tbl_210_subcategories_def_test AS d ON s.subcategory_id = d.id WHERE s.goal_id=" . $row['id'] . " AND s.category_id=" . $row_categories['category_id'];
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

?>
