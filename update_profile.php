<?php
    include "db.php";
    include_once 'common/verify.php';

    $profileId = NULL;
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && !empty($_GET['id'])) {
        $profileId = $_GET["id"];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
        integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>

    <form action="update_profile.php" method="POST">
        <input type="hidden" id="profile_id" name="profile_id" value="<?=$profileId; ?>">
    </form>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include_once 'common/nav.php'; ?>

    <div class="wrapper2">

    </div>
    <?php include_once 'common/footer.php'; ?>

    <script src="js/updateProfile.js"></script>
    <script src="js/global.js"></script>
</body>