<?php
// Include database connection
include "db.php";

// Start session
session_start();

// Check if user is not logged in
if (!isset($_SESSION['user_type']) || empty($_SESSION['user_type'])) {
    header('Location: login.php');
    exit;
}
$user_type = $_SESSION['user_type'];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the input values
    $user_id = $_SESSION["user_id"]?: NULL;
    $full_name = $_POST["full_name"]?: NULL;
    $birth_date = $_POST["birth_date"]?: NULL;
    $height = $_POST["height"]?: NULL;
    $weight = $_POST["weight"]?: NULL;
    $gender = $_POST["gender"]?: NULL;
    $potential = $_POST["potential"]?: NULL;
    $experience = $_POST["experience"]?: NULL;
    $rank = $_POST["rank"]?: NULL;
    $team = $_POST["team"]?: NULL;
    $registered_date = $_POST["registered_date"]?: NULL;
    $phone = $_POST["phone"]?: NULL;
    $city = $_POST["city"]?: NULL;
    $emergency_phone = $_POST["emergency_phone"]?: NULL;
    $email = $_POST["email"]?: NULL;
    
    // Prepare SQL for each table and execute
    $query = "INSERT INTO tbl_210_details_test(user_id, full_name, birth_date, height, weight, gender, potential) VALUES(?,?,?,?,?,?,?)";
    $stmt = mysqli_prepare($connection, $query);
    $stmt->bind_param("issiiss", $user_id, $full_name, $birth_date, $height, $weight, $gender, $potential);
    
    if ($stmt->execute()) {
        $query = "INSERT INTO tbl_210_union_test(user_id, experience, rank, team, registered_date) VALUES(?,?,?,?,?)";
        $stmt = mysqli_prepare($connection, $query);
        $stmt->bind_param("iiiss", $user_id, $experience, $rank, $team, $registered_date);
        
        if ($stmt->execute()) {
            $query = "INSERT INTO tbl_210_contact_test(user_id, phone, city, emergency_phone, email) VALUES(?,?,?,?,?)";
            $stmt = mysqli_prepare($connection, $query);
            $stmt->bind_param("issss", $user_id, $phone, $city, $emergency_phone, $email);
            
            if ($stmt->execute()) {
                $_SESSION['register_completed'] = true;
                
                // Redirect to index.php after successful submission
                header("Location: index.php");
            }
            else {
                echo json_encode(['error' => 'Failed to init profile: ' . $stmt->error]);
                exit;
            }
        }
        else {
            echo json_encode(['error' => 'Failed to init profile: ' . $stmt->error]);
            exit;
        }
    }
    else {
        echo json_encode(['error' => 'Failed to init profile: ' . $stmt->error]);
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile Initial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/profile_initial.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="title">Please share more about you</h1>
        <form action="profile_initial.php" method="post" id="profileForm">
            <h2>Personal Details</h2>
            <div class="form-group">
                <label for="full_name">Full Name: </label>
                <input type="text" class="form-control" required
                    pattern="([a-zA-Z]{2,}-[a-zA-Z]{2,}|[a-zA-Z]{2,}) ([a-zA-Z]{2,}-[a-zA-Z]{2,}|[a-zA-Z]{2,})"
                    name="full_name" id="full_name" placeholder="Enter Full Name" maxlength="30">
            </div>
            <div class="form-group">
                <label for="birth_date">Birth Date: </label>
                <input type="date" class="form-control" required name="birth_date" id="birth_date"
                    max="<?php echo date('Y-m-d', strtotime('-13 years')); ?>">
            </div>

            <?php 
                if ($user_type === 'Trainee') {
                    echo '
                    <div class="height-weight">
                        <div class="form-group" id="form-height">
                            <label for="height">Height: </label>
                            <input type="number" min="125" max="235" class="form-control" required name="height" id="height"
                                placeholder="Enter Height in cm">
                        </div>
                        <div class="form-group" id="form-weight">
                            <label for="weight">Weight: </label>
                            <input type="number" min="25" max="180" class="form-control" required name="weight" id="weight"
                                placeholder="Enter Weight in kg">
                        </div>
                    </div>
                        ';
                    }
                    ?>
            
            <div class="form-group" id="form-gender-pick">
                <label>Gender: </label>
                <div>
                    <input type="radio" id="male" name="gender" value="Male" required>
                    <label for="male">Male</label>
                </div>
                <div>
                    <input type="radio" id="female" name="gender" value="Female" required>
                    <label for="female">Female</label>
                </div>
            </div>

            <?php 
                if ($user_type === 'Trainee') {
                    echo '
                        <input type="hidden" name="potential" id="potential" value="Uncertain">
                        <input type="hidden" name="experience" id="experience" value="-1">
                        <input type="hidden" name="rank" id="rank" value="-1">
                        <input type="hidden" name="team" id="team" value="Unknown yet">
                        ';
                    }
                    ?>

            <input type="hidden" name="registered_date" id="registered_date" value="<?php echo date('Y-m-d'); ?>">

            <h2>Contact Details</h2>
            <div class="form-group">
                <label for="phone">Phone: </label>
                <input type="tel" class="form-control" required pattern="[0-9]{10}" name="phone" id="phone"
                    placeholder="Enter Phone Number">
            </div>

            <div class="form-group">
                <label for="city">City: </label>
                <input type="text" class="form-control" min="2" max="30" required name="city" id="city"
                    placeholder="Enter City">
            </div>

            <?php 
                if ($user_type === 'Trainee') {
                    echo '
                        <div class="form-group">
                        <label for="emergency_phone">Emergency Phone: </label>
                        <input type="tel" class="form-control" required pattern="[0-9]{10}" name="emergency_phone"
                            id="emergency_phone" placeholder="Enter Emergency Phone Number">
                    </div>
                        ';
                    }
                    ?>

            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" class="form-control" required name="email" id="email" placeholder="Enter Email">
            </div>

            <button type="submit" class="login-button">Save</button>
        </form>
    </div>
</body>

</html>

<?php
mysqli_close($connection);
?>