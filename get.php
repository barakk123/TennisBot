
<?php


    include "db.php";
    include "config.php";
    

    session_start();

    if(!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }

    $userId = $_SESSION["user_id"];
    $sql = "SELECT * FROM tbl_210_Goals_test WHERE traineeId = " . $userId;
    
    $result = $connection->query($sql);

    $goals = array();
    while($row = $result->fetch_assoc()) {
    $goal = array(
        'id' => $row['id'],
        'title' => $row['title'],
        'start_date' => $row['start_date'],
        'end_date' => $row['end_date'],
        'status' => $row['status'],
        'progress' => $row['progress'],
        'categories' => array()
    );

    $sql_categories = "SELECT * FROM tbl_210_Categories_test WHERE goal_id=" . $row['id'];
    $result_categories = $connection->query($sql_categories);
    
    while($row_categories = $result_categories->fetch_assoc()) {
        $category = array(
        'id' => $row_categories['id'],
        'name' => $row_categories['name'],
        'subcategories' => array()
        );

        $sql_subcategories = "SELECT * FROM tbl_210_Subcategories_test WHERE category_id=" . $row_categories['id'];
        $result_subcategories = $connection->query($sql_subcategories);
    
        while($row_subcategories = $result_subcategories->fetch_assoc()) {
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

