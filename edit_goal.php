<?php
include "db.php";

session_start();

if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
    //redirect to login or error page
    header("Location: login.php");
    exit;
}
else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && !empty($_GET['id'])) {
    $goalId = $_GET["id"];
}
else {
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
    <title>Edit Goal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php include_once 'common/nav.php'; ?>

    <div class="header" id="header-add-goals">
        <nav class="breadcrumb">
            <ol class="breadcrumb-list">
                <li class="breadcrumb-item"><a href="./index.php">My Goals</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#">Edit Goal</a>
                </li>
            </ol>
        </nav>
        <h1 class="headline">Edit Goal</h1>
    </div>

    <div class="formDiv">
        <form action="./updateGoal.php" method="post">
            <input type="hidden" name="goal-id" id="goal-id" value="<?=$goalId;?>">

            <label class="form-nameofgoal-size">Name of goal</label>
            <input name="name" type="text" id="nameOfGoal" pattern=".+" required>
            <br>
            <label class="form-nameofgoal-size" id="form-goalName-size">Choose Goal Period</label>
            <label class="form-Startdate-size">Start: </label>
            <input name="start_date" type="date" id="startDate" required>
            <br>
            <label class="form-Startdate-size">End: </label>
            <input name="end_date" type="date" id="endDate" required>
            <br>

            <button type="submit" id="submit-button">Update</button>
        </form>
    </div>

    <?php include_once 'common/footer.php'; ?>

    <script src="js/global.js"></script>
    <script src="js/edit_goal.js"></script>
</body>

</html>