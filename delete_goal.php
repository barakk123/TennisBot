<?php
include_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $goalId = $_GET['id'];

    // Start a transaction
    mysqli_begin_transaction($connection, MYSQLI_TRANS_START_READ_WRITE);

    try {
        // Delete the subcategories associated with the goal
        $stmt = mysqli_prepare($connection, "DELETE FROM tbl_210_subcategories WHERE goal_id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $goalId);
        mysqli_stmt_execute($stmt);

        // Delete the categories associated with the goal
        $stmt = mysqli_prepare($connection, "DELETE FROM tbl_210_categories WHERE goal_id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $goalId);
        mysqli_stmt_execute($stmt);

        // Delete the goal itself
        $stmt = mysqli_prepare($connection, "DELETE FROM tbl_210_goals WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $goalId);
        mysqli_stmt_execute($stmt);

        // Commit the transaction
        mysqli_commit($connection);
        http_response_code(200);
    } catch (Exception $e) {
        // An error occurred; rollback the transaction
        mysqli_rollback($connection);
        http_response_code(500);
        // Re-throw the exception for further handling
        throw $e;
    }
} else {
    http_response_code(400);
}
?>
