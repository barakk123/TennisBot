<?php
    include "db.php";
    include_once 'common/verify.php';

    // Check if user is not logged in
    if (!isset($_SESSION['user_type']) || empty($_SESSION['user_type'])) {
        header('Location: login.php');
        exit;
    }

    if(!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the input values
        $user_id = $_SESSION["user_id"]?: NULL;
    }

    // Get the user's full name from the database
    $query = "SELECT full_name FROM tbl_210_details WHERE user_id = $user_id";
    $result = mysqli_query($connection, $query);
    
    if (mysqli_num_rows($result) > 0) {
        // fetch the result as an associative array
        $row = mysqli_fetch_assoc($result);
        $full_name = $row['full_name'];
    } else {
        $full_name = "";
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

    <div class="index-title">
        <h1>Welcome <?php echo $full_name; ?></h1>
    </div>
    <div class="messages-index">
        <h3>Newest Messages</h3>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img src="images/winter.png" class="card-img-top" alt="Article 1">
                    <div class="card-body">
                        <h5 class="card-title">Winter Weather Training Schedule Update</h5>
                        <p class="card-text">Please note that there might be changes in the training schedule due to the
                            stormy winter weather that we have been experiencing lately. We will do our best to keep you
                            updated on any changes to the schedule. Please stay safe and feel free to reach out to us if
                            you have any concerns.</p>
                        <p class="card-text"><small class="text-muted">Israeli Tennis Association • Feb 14, 2023</small>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <img src="images/coaches.png" class="card-img-top" alt="Article 2">
                    <div class="card-body">
                        <h5 class="card-title">Coaches' Certification Update Reminder</h5>
                        <p class="card-text">Coaches are advised to update their qualifications and certifications in a
                            timely manner to ensure continued eligibility to coach at ITA-sanctioned events.</p>
                        <p class="card-text"><small class="text-muted">Michael Berkovich • Jan 11, 2023</small></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <img src="images/bottle.png" class="card-img-top" alt="Article 3">
                    <div class="card-body">
                        <h5 class="card-title">Reminder: Bring Your Own Water Bottle</h5>
                        <p class="card-text">Trainees are reminded to bring their own water bottles to training
                            sessions. Water fountains will not be available due to health and safety protocols.</p>
                        <p class="card-text"><small class="text-muted">Israeli Tennis Association • May 8, 2022</small>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <img src="images/corona.png" class="card-img-top" alt="Article 4">
                    <div class="card-body">
                        <h5 class="card-title">COVID-19 Training Session Cancellation Notice</h5>
                        <p class="card-text">Due to COVID-19 restrictions, all training sessions have been cancelled
                            until further notice. Please stay safe and follow all guidelines provided by health
                            authorities.</p>
                        <p class="card-text"><small class="text-muted">Israeli Tennis Association • Dec 21, 2021</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include_once 'common/footer.php'; ?>

    <script src="js/global.js"></script>
</body>

</html>