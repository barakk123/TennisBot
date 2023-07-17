<?php
include "db.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["goal_name"] = $_POST["name"];
    $_SESSION["start_date"] = $_POST["start_date"];
    $_SESSION["end_date"] = $_POST["end_date"];
}

$coachId;
$userId = $_SESSION["user_id"];

$sql = 'SELECT coach_id FROM tbl_210_trainee_coach_test WHERE trainee_id = '.$userId;
$response = $connection->query($sql);
$trainee = $response->fetch_assoc();
if ($trainee && !empty($trainee['coach_id'])) {
    $coachId = $trainee['coach_id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Category</title>

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
                <li class="breadcrumb-item" aria-current="page">
                    <a href="add_goal.php">Add Goal</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#">Choose Category</a>
                </li>
            </ol>
        </nav>
        <div class="header-option">
            <h1 class="h1-space">Choose Category</h1>
            <select class="select-date" id="date-myGoals" onchange="updateStrikeList(this.value)">
            </select>
        </div>
        <div id="strike-list">
        </div>
    </div>
    <div class="tableChooseCategory">
        <form>
            <table></table>
            <input type="hidden" id="coach_id" name="coach_id" value="<?= $coachId; ?>">
            <input type="hidden" id="goal_name" name="goal_name" value="<?= $_SESSION["goal_name"];?>">
            <input type="hidden" id="start_date" name="start_date" value="<?= $_SESSION["start_date"];?>">
            <input type="hidden" id="end_date" name="end_date" value="<?= $_SESSION["end_date"];?>">
            <button type="submit" id="submitGoal">Save</button>
        </form>
    </div>
    <div class="form-timeline">
        <a href="add_goal.php"><img class="form-timeline-size" src="images/form-timeline-adgrey.svg"
                alt="form-timeline-adgrey"></a>
        <a href="choose_category.php"><img class="form-timeline-size" id="form-timeline-chooseCategory"
                src="images/form-timeline-chgrey.svg" alt="form-timeline-chgrey"></a>
    </div>
    <?php include_once 'common/footer.php'; ?>

    <script src="js/global.js"></script>
    <script src="js/choose_category.js"></script>
</body>

</html>