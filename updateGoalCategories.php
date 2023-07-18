<?php
include "db.php";

session_start();
if(!isset($_SESSION["user_id"])) {
    header("Content-Type: application/json");
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION["user_id"];
$goal = json_decode(file_get_contents('php://input'), true);

foreach ($goal['categories'] as $category) {
    $goalId = $goal['goalId'];
    $category_id = getCategoryID($category['name']);
    $sql = "SELECT * FROM tbl_210_categories_test WHERE goal_id = $goalId AND category_id = $category_id";
    $result = $connection->query($sql);
    if ($result->num_rows == 0) {
        $stmt = $connection->prepare("
            INSERT INTO tbl_210_categories_test (goal_id, category_id)
            VALUES (?, ?)
        ");
        $stmt->bind_param('ii', $goalId, $category_id);
        if ($stmt->execute()) {
            $categories_test_id = $connection->insert_id;
        }
        else {
            echo json_encode(['error' => 'Failed to save goal: ' . $stmt->error]);
            exit;
        }
    }

    // Upsert the subcategories in the tbl_210_subcategories_test table
    foreach ($category['subcategories'] as $subcategory) {
        $subcategory_id = getSubcategoryID($subcategory['name']);
        $goalId = $goal['goalId'];

        $sql = "SELECT * FROM tbl_210_subcategories_test 
        WHERE goal_id = $goalId 
        AND category_id = $category_id 
        AND subcategory_id = $subcategory_id 
        AND user_id = $user_id";
        
        $result = $connection->query($sql);
        if ($result->num_rows == 0 && $subcategory['target'] != null) {
            $stmt = $connection->prepare("
                INSERT INTO tbl_210_subcategories_test (goal_id, user_id, category_id, subcategory_id, current, target)
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->bind_param('iiiiss', $goalId, $user_id, $category_id, $subcategory_id, $subcategory['current'], $subcategory['target']);
            if ($stmt->execute()) {
                $subcategory_test_id = $connection->insert_id;
            }
            else {
                echo json_encode(['error' => 'Failed to save goal: ' . $stmt->error]);
                exit;
            }
        }
        else if ($result->num_rows > 0 && $subcategory['target'] != null) {
            $stmt = $connection->prepare("
                UPDATE tbl_210_subcategories_test SET target = ?
                WHERE goal_id = $goalId AND category_id = $category_id AND subcategory_id = $subcategory_id AND user_id = $user_id;
            ");
    
            $stmt->bind_param('s', $subcategory['target']);
            if (!$stmt->execute()) {
                echo json_encode(['error' => 'Failed to update goal: ' . $stmt->error]);
                exit;
            }
        }
        else if ($subcategory['target'] == null) {
            $stmt = $connection->prepare("
                DELETE FROM tbl_210_subcategories_test WHERE goal_id = $goalId AND category_id = $category_id AND subcategory_id = $subcategory_id AND user_id = $user_id;
            ");

            if (!$stmt->execute()) {
                echo json_encode(['error' => 'Failed to delete goal: ' . $stmt->error]);
                exit;
            }
        }
    }
}

function getCategoryID($category_name) {
    global $connection;
    $stmt = $connection->prepare("SELECT id FROM tbl_210_categories_def_test WHERE name = ?");
    $stmt->bind_param('s', $category_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['id'];
}

function getSubcategoryID($subcategory_name) {
    global $connection;
    $stmt = $connection->prepare("SELECT id FROM tbl_210_subcategories_def_test WHERE name = ?");
    $stmt->bind_param('s', $subcategory_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['id'];
}

echo json_encode(['message' => 'Goal updated successfully']);
$connection->close();