<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

// Check if user started register but didn't finished yet
if (isset($_SESSION['register_completed']) && $_SESSION['register_completed'] == false) {
    header('Location: profile_initial.php');
    exit;
}
else if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    //redirect to login or error page
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];