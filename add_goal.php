<?php
    include_once 'common/verify.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Goals</title>

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
                    <a href="#">Add Goal</a>
                </li>
            </ol>
        </nav>
        <h1 class="headline">Add Goal</h1>
    </div>

    <div class="formDiv">
        <form action="./choose_category.php" method="post">
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

            <button type="submit" id="submit-button">Continue</button>
        </form>
    </div>

    <div class="form-timeline">
        <a href="add_goal.php"><img class="form-timeline-size" src="images/form-timeline-adgrey.svg"
                alt="form-timeline-adgrey"></a>
        <a href="#"><img class="form-timeline-size" id="form-timeline-chooseCategory"
                src="images/form-timeline-chwhite.svg" alt="form-timeline-chwhite"></a>
    </div>

    <?php include_once 'common/footer.php'; ?>

    <script src="js/global.js"></script>
    <script src="js/add_goal.js"></script>
</body>

</html>