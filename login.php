<?php
    include "db.php";

    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST["loginName"]) && !empty($_POST["loginPass"])) {

        $username = $_POST["loginName"];
        $password = $_POST["loginPass"];

        $query  = "SELECT * FROM tbl_210_users_test WHERE username=?";
        $stmt = mysqli_prepare($connection, $query);
        if ($stmt === false) {
            die('mysqli_prepare failed: ' . mysqli_error($connection));
        }
        mysqli_stmt_bind_param($stmt, 's', $username);
       
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result)) {
            // Verify the password against the hashed password in the database
            if(password_verify($password, $row['password']) || $password == $row['password']) {
                $_SESSION["user_id"] = $row['id'];
                $_SESSION["user_type"] = $row['userType'];
                header('Location: index.php');
                exit;
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
</head>

<body>

    <div class="container">

        <h1>Login</h1>

        <form action="login.php" method="post" id="frm">

            <div class="form-group">

                <label for="loginName">Username: </label>

                <input type="username" class="form-control" required name="loginName" id="loginName"
                    aria-describedby="loginNameHelp" placeholder="Enter username">

            </div>

            <div class="form-group">

                <label for="loginPass">Password: </label>

                <input type="password" class="form-control" required name="loginPass" id="loginPass"
                    placeholder="Enter Password">

            </div>

            <button type="submit" class="btn btn-primary">Log Me In</button>

            <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>

        </form>

    </div>
    <script src="js/global.js"></script>
</body>

</html>

<?php

//close DB connection

mysqli_close($connection);

?>