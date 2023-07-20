<?php
    include "db.php";
    include_once 'common/verify.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Goals</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="wrapper">
        <?php include_once 'common/nav.php'; ?>
        <div class="header">
            <nav class="breadcrumb">
                <ol class="breadcrumb-list">
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="#">My Goals</a>
                    </li>
                </ol>
            </nav>

            <h1 class="headline">My Goals</h1>
            <div class="wrapper-head">
                <select class="select-date" id="date-myGoals">
                </select>
                <button id="add-goal-btn" class="image-button">
                    <img src="images/add.svg" alt="Button Image">
                </button>
            </div>
        </div>
        <div class="my-goals-table">
            <!-- All the script  -->
        </div>
        <?php include_once 'common/footer.php'; ?>
    </div>
    <script src="js/global.js"></script>
    <script src="js/my_goals.js"></script>
    <?php
$connection->close();
?>
</body>

</html>