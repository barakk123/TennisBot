<?php
    include "db.php";
    include "config.php";

    session_start();

    if(!empty($_POST["loginName"])) {

        $username = $_POST["loginName"];
        $password = $_POST["loginPass"];

        $query  = "SELECT * FROM tbl_210_Users_test WHERE username=?";
        $stmt = mysqli_prepare($connection, $query);
        if ($stmt === false) {
            die('mysqli_prepare failed: ' . mysqli_error($connection));
        }
        mysqli_stmt_bind_param($stmt, 's', $username);
       
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result)) {
            // Verify the password against the hashed password in the database
            if($password == $row['password']) {
                $_SESSION["user_id"] = $row['id'];
                $_SESSION["user_type"] = $row['userType'];
                header('Location: ' . URL . 'index.php');
                exit;
            } 
            
        } else {
            $message = "Invalid Username or Password!";
            //echo $message;
        }
    }
?>


<!DOCTYPE html>

<html>

	<head>

	    <meta charset="utf-8">  

        <title>LOGIN</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>	   

	</head>

	<body>

	    <div class="container">

            <h1>Login</h1>

            <form action="login.php" method="post" id="frm">

                <div class="form-group">

                    <label for="loginName">Username: </label>

                    <input type="username" class="form-control" required name="loginName" id="loginName" aria-describedby="loginNameHelp" placeholder="Enter username">

                </div>

                <div class="form-group">

                    <label for="loginPass">Password: </label>

                    <input type="password" class="form-control" required name="loginPass" id="loginPass" placeholder="Enter Password">

                </div>

                <button type="submit" class="btn btn-primary">Log Me In</button>

                <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>    

           </form>

	    </div>

	</body>

</html>

<?php

//close DB connection

mysqli_close($connection);

?>