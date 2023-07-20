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
    <title>Trainees</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include_once 'common/nav.php'; ?>
    <div class="filters">
        <div class="name_search"><input type="text" id="name-search" placeholder="Search by name"></div>
        <div class="age-box">
            <div class="chkbox-data-container">
                <input type="checkbox" id="male" name="male" value="Male">
                <label for="male">Male</label>
            </div>
            <div class="chkbox-data-container">
                <input type="checkbox" id="female" name="female" value="Female">
                <label for="female">Female</label>
            </div>
        </div>
        <div class="pot-box">

                <h4>Potential</h4>
                <div class="pot-box-cont">
                    <div class="chkbox-data-container">
                        <input type="checkbox" id="top" name="top" value="Top">
                        <label for="top">Top</label>
                    </div>
                    
                    <div class="chkbox-data-container">
                        <input type="checkbox" id="high" name="high" value="High">
                        <label for="high">High</label>
                    </div>
                    <div class="chkbox-data-container">
                        <input type="checkbox" id="moderate" name="moderate" value="Moderate">
                        <label for="moderate">Moderate</label>
                    </div>
                    <div class="chkbox-data-container">
                        <input type="checkbox" id="low" name="low" value="Low">
                        <label for="low">Low</label>
                    </div>
                    <div class="chkbox-data-container">
                        <input type="checkbox" id="uncertain" name="uncertain" value="Uncertain">
                        <label for="uncertain">Uncertain</label>
                    </div>
                </div>
        </div>
    </div>

    </div>
    <div id="tableContainer"></div>

    <?php include_once 'common/footer.php'; ?>
    <script src="./js/trainees_list.js"></script>
    <script src="./js/global.js"></script>
</body>

</html>