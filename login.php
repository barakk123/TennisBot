<?php
    include "db.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $message = ''; // Initialize here so it's always set

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST["loginName"]) && !empty($_POST["loginPass"])) {

        $username = $_POST["loginName"];
        $password = $_POST["loginPass"];

        $query  = "SELECT * FROM tbl_210_users WHERE username=?";
        $stmt = mysqli_prepare($connection, $query);
        if ($stmt === false) {
            die('mysqli_prepare failed: ' . mysqli_error($connection));
        }
        mysqli_stmt_bind_param($stmt, 's', $username);
       
        mysqli_stmt_execute($stmt);

        // Bind result variables.
        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $user_type);

        // Fetch the result into the bound variables.
        if (mysqli_stmt_fetch($stmt)) {
            // Verify the password against the hashed password in the database
            if(password_verify($password, $hashed_password)) {
                $_SESSION["user_id"] = $id;
                $_SESSION["user_type"] = $user_type;

                if (isset($_SESSION['register_completed']) && $_SESSION['register_completed'] == false) {
                    header('Location: profile_initial.php');
                    exit;
                }
                else {
                    header('Location: index.php');
                    exit;
                }
            } 
            else {
                $message = "Invalid Username or Password!";
            }
        } else {
            $message = "Invalid Username or Password!";
        }
    }
?>


<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/style.css">


</head>

<body>

    <div class="container">

        <h1 class="login_title">Login</h1>

        <form action="login.php" method="post" id="frm">

            <div class="form-group">

                <label for="loginName" class="login_name_pass">Username: </label>

                <input type="username" class="form-control" required name="loginName" id="loginName"
                    aria-describedby="loginNameHelp" placeholder="Enter username">

            </div>

            <div class="form-group">

                <label for="loginPass" class="login_name_pass">Password: </label>

                <input type="password" class="form-control" required name="loginPass" id="loginPass"
                    placeholder="Enter Password">

            </div>
            <div class="login_sub_reg">
                <button type="submit" class="login_button">Log Me In</button>
                <!-- Add button for Register -->
                <a href="register.php" class="register_button">Register</a>
            </div>
            <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>

        </form>

    </div>
</body>

</html>

<?php

//close DB connection

mysqli_close($connection);

?>