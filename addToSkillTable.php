<?php
    include "db.php";
    include_once 'common/verify.php';

    $user_type = $_SESSION['user_type'];

    if(!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }

    $profileId = NULL;
    if (isset($_SESSION["profile_id"]) && !empty($_SESSION["profile_id"])) {
        $profileId = $_SESSION["profile_id"];
    }

    // Query to fetch category names
    $query = "SELECT id, name FROM tbl_210_categories_def ORDER BY id";
    $result = mysqli_query($connection, $query);
    
    $categories = array();
    while($row = mysqli_fetch_assoc($result)){
        $categories[] = $row;
    }

    // Query to fetch subcategory names
    $query = "SELECT id, name FROM tbl_210_subcategories_def ORDER BY id";
    $result = mysqli_query($connection, $query);
    
    $subcategories = array();
    while($row = mysqli_fetch_assoc($result)){
        $subcategories[] = $row;
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
    For Yonit: Hey, this page is just to let you keep the flow if you tests new trainees you created.<br>
    OFC Trainee cant change this skills value for himself - its the Robot's job
    WARNNING: DO NOT TRY TO ADD GOAL BEFORE ASSIGN COACH TO THIS TRAINEE!!! <br> You can login to a coach/new coach and ASSIGN the coach to the trainee.
    <div id="traineeContainer">
        <form id="skillsForm">
            <input type="hidden" id="profile_id" name="profile_id" value="<?=$profileId; ?>">
            <?php
            // Iterate through categories array
            for ($i = 0; $i < count($categories); $i++) {
                // Print the category with its subcategories
                echo "<div>";
                if($i < 5){
                    echo "<label for='cat{$i}_sub1'>{$categories[$i]['name']} - {$subcategories[0]['name']}:</label>";
                    echo "<input type='number' id='cat{$i}_sub1' name='cat{$i}_sub1' min='0' max='100'>";
                    
                    echo "<label for='cat{$i}_sub2'>{$categories[$i]['name']} - {$subcategories[1]['name']}:</label>";
                    echo "<input type='number' id='cat{$i}_sub2' name='cat{$i}_sub2' min='0' max='100'>";
                }
                elseif ($i >= 5 && $i < 8) {
                    echo "<label for='cat{$i}_sub1'>{$categories[$i]['name']} - {$subcategories[0]['name']}:</label>";
                    echo "<input type='number' id='cat{$i}_sub1' name='cat{$i}_sub1' min='0' max='100'>";
                    
                    echo "<label for='cat{$i}_sub2'>{$categories[$i]['name']} - {$subcategories[1]['name']}:</label>";
                    echo "<input type='number' id='cat{$i}_sub2' name='cat{$i}_sub2' min='0' max='100'>";
                }
                elseif ($i >= 8 && $i < 11) {
                    echo "<label for='cat{$i}'>{$categories[$i]['name']} - {$subcategories[2]['name']}:</label>";
                    echo "<input type='number' id='cat{$i}' name='cat{$i}' min='0' max='100'>";
                }
                else{
                    echo "<label for='cat{$i}'>{$categories[$i]['name']} - {$subcategories[3]['name']}:</label>";
                    echo "<input type='number' id='cat{$i}' name='cat{$i}' min='0' max='100'>";
                }
                echo "</div>";
            }
        ?>
            <button type="submit" id="saveButton">Save</button>
        </form>

    </div>

    <?php include_once 'common/footer.php'; ?>

    <script src="js/global.js"></script>
    <script src="js/addToSkillTable.js"></script>
    <?php 
        mysqli_close($connection);
    ?>
</body>

</html>