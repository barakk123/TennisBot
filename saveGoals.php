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


// Insert the goal into the goals table
$stmt = $connection->prepare("
INSERT INTO tbl_210_goals_test (trainee_id, coach_id, title, start_date, end_date)
VALUES (?, ?, ?, ?, ?)
");
$stmt->bind_param('iisss', $user_id, $goal['coach_id'], $goal['title'], $goal['start_date'], $goal['end_date']);
if ($stmt->execute()) {
    $goal_id = $connection->insert_id;
} else {
    echo json_encode(['error' => 'Failed to save goal: ' . $stmt->error]);
    exit;
}

// Insert the categories into the tbl_210_categories_test table
foreach ($goal['categories'] as $category) {
    $category_id = getCategoryID($category['name']);

    $stmt = $connection->prepare("
        INSERT INTO tbl_210_categories_test (goal_id, category_id)
        VALUES (?, ?)
    ");
    $stmt->bind_param('ii', $goal_id, $category_id);
    if ($stmt->execute()) {
        $categories_test_id = $connection->insert_id;
    }
    else {
        echo json_encode(['error' => 'Failed to save goal: ' . $stmt->error]);
        exit;
    }

    // Insert the subcategories into the tbl_210_subcategories_test table
    foreach ($category['subcategories'] as $subcategory) {
        $subcategory_id = getSubcategoryID($subcategory['name']);

        $stmt = $connection->prepare("
            INSERT INTO tbl_210_subcategories_test (goal_id, user_id, category_id, subcategory_id, current, target)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param('iiiiss', $goal_id, $user_id, $category_id, $subcategory_id, $subcategory['current'], $subcategory['target']);
        if ($stmt->execute()) {
            $subcategory_test_id = $connection->insert_id;
        }
        else {
            echo json_encode(['error' => 'Failed to save goal: ' . $stmt->error]);
            exit;
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

echo json_encode(['message' => 'Goal saved successfully', 'goal_id' => $goal_id]);
$connection->close();