<?php
include "db.php";
include_once 'common/verify.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && !empty($_GET['id'])) {
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
    <title>Edit Goal Categories</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php include_once 'common/nav.php'; ?>

    <div class="change-header">
        <nav class="breadcrumb">
            <ol class="breadcrumb-list">
                <li class="breadcrumb-item"><a href="index.php">My Goals</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#">Edit Goal Categories</a>
                </li>
            </ol>
        </nav>
        <div class="header-option">
            <h1 class="h1-space">Choose Category</h1>
            <select class="select-date" id="date-myGoals" onchange="updateStrikeList(this.value, <?=$goalId?>)">
            </select>
        </div>
        <div id="strike-list">
        </div>
    </div>
    <div class="tableChooseCategory">
        <form>
            <table></table>
            <input type="hidden" name="goal-id" id="goal-id" value="<?=$goalId;?>">
            <button type="submit" id="submitGoal">Update</button>
        </form>
    </div>

    <?php include_once 'common/footer.php'; ?>

    <script src="js/global.js"></script>
    <script src="js/edit_goal_categories.js"></script>
</body>

</html>