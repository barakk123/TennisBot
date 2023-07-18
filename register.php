<?php
include "db.php";

// Start session
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST["registerName"]) && !empty($_POST["registerPass"]) && !empty($_POST["registerType"])) {
    $username = $_POST["registerName"];
    $password = $_POST["registerPass"];
    $type = $_POST["registerType"];
  
    if(preg_match('/^(?=.*[A-Za-z])[A-Za-z0-9]{3,}$/', $username) && preg_match('/^[A-Za-z0-9]{6,}$/', $password)) {
        $stmt = $connection->prepare("SELECT * FROM tbl_210_users_test WHERE username=?");
        if ($stmt == false) {
            die('mysqli_prepare failed: ' . mysqli_error($connection));
        }
        $stmt->bind_param('s', $username);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $message = "Username already taken!";
            }
            else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $connection->prepare("INSERT INTO tbl_210_users_test (username, password, user_type) VALUES (?, ?, ?)");
                $stmt->bind_param('sss', $username, $hashed_password, $type);
                if ($stmt->execute()) {
                    $_SESSION['user_id'] = $connection->insert_id;
                    $_SESSION['user_type'] = $type;
                    $_SESSION['register_completed'] = false;
                    header('Location: profile_initial.php');
                    exit;
                }
                else {
                    $message = "Registration failed!";
                }
            }
        }
        else {
            $message = "Registration failed!";
        }
    } else {
        $message = "Invalid input!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">

        <h1 class="login_title">Register</h1>

        <form action="register.php" method="post" id="frm">

            <div class="form-group">
                <label for="registerName" class="login_name_pass">Username: </label>
                <input type="text" class="form-control" required name="registerName" id="registerName"
                    aria-describedby="registerNameHelp" pattern="^(?=.*[A-Za-z])[A-Za-z0-9]{3,}$" minlength="3"
                    placeholder="Enter username">
            </div>

            <div class="form-group">
                <label for="registerPass" class="login_name_pass">Password: </label>
                <input type="password" class="form-control" required name="registerPass" id="registerPass"
                    pattern="^[A-Za-z0-9]{6,}$" minlength="6" placeholder="Enter Password">
            </div>

            <div class="form-group">
                <label for="registerType" class="login_name_pass">User Type: </label>
                <select class="form-control" name="registerType" id="registerType" required>
                    <option value="Trainee" selected>Trainee</option>
                    <option value="Coach">Coach</option>
                </select>
            </div>

            <div class="login_sub_reg">
                <button type="submit" class="login_button">Submit</button>
                <a href="login.php" class="register_button">Sign In</a>
            </div>

            <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>

        </form>

    </div>

</body>

</html>

<?php
mysqli_close($connection);
?>