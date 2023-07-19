<?php
    include "db.php";
    include_once 'common/verify.php';

    $user_type = $_SESSION['user_type'];


    if(!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;}
    if ($user_type == 'Trainee') {
        header("Location: index.php");
        exit;
        }
        
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include_once 'common/nav.php'; ?>
    For Yonit: Hey, this page is just to let you keep the flow if you tests new users(trainees/coaches) you created.<br>
    OFC coach cant assign trainees to himself - its the Cheif's job :p
    <div id="traineeContainer"></div>
    <button id="saveButton">Save</button> <!-- Added save button -->

    <?php include_once 'common/footer.php'; ?>

    <script src="js/global.js"></script>
    <script src="js/assign_trainees.js"></script>
</body>