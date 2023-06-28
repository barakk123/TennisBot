<?php
    include_once 'db.php';

    // Retrieve the goal id from the query parameters
    $goalId = $_GET['id'];

    // Start a transaction
    mysqli_begin_transaction($connection, MYSQLI_TRANS_START_READ_WRITE);

    try {
        // Delete the subcategories associated with the goal
        $stmt = mysqli_prepare($connection, "DELETE FROM tbl_210_Subcategories_test WHERE category_id IN (SELECT id FROM tbl_210_Categories_test WHERE goal_id = ?)");
        mysqli_stmt_bind_param($stmt, 'i', $goalId);
        mysqli_stmt_execute($stmt);

        // Delete the categories associated with the goal
        $stmt = mysqli_prepare($connection, "DELETE FROM tbl_210_Categories_test WHERE goal_id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $goalId);
        mysqli_stmt_execute($stmt);

        // Delete the goal itself
        $stmt = mysqli_prepare($connection, "DELETE FROM tbl_210_Goals_test WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $goalId);
        mysqli_stmt_execute($stmt);

        // Commit the transaction
        mysqli_commit($connection);
    } catch (Exception $e) {
        // An error occurred; rollback the transaction
        mysqli_rollback($connection);

        // Re-throw the exception for further handling
        throw $e;
    }
?>
