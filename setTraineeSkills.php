<?php
    include "db.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            $user_id = $_GET["id"];
        }
        else {
            $user_id = $_SESSION["user_id"];
        }
    
        $query = "INSERT INTO tbl_210_skills (user_id, category_id, subcategory_id, value) VALUES ";
        $values = [];
    
        // Process the 8 categories with two subcategories
        for($i = 1; $i <= 8; $i++) {
            if(isset($_POST["cat" . ($i-1) . "_sub1"]) && $_POST["cat" . ($i-1) . "_sub1"] !== "") {
                $sub1_value = $_POST["cat" . ($i-1) . "_sub1"];
                $values[] = "($user_id, $i, 1, $sub1_value)";
            }
    
            if(isset($_POST["cat" . ($i-1) . "_sub2"]) && $_POST["cat" . ($i-1) . "_sub2"] !== "") {
                $sub2_value = $_POST["cat" . ($i-1) . "_sub2"];
                $values[] = "($user_id, $i, 2, $sub2_value)";
            }
        }
    
        // Process the 3 categories with one subcategory with id 3
        for($i = 9; $i <= 11; $i++) {
            if(isset($_POST["cat" . ($i-1)]) && $_POST["cat" . ($i-1)] !== "") {
                $value = $_POST["cat" . ($i-1)];
                $values[] = "($user_id, $i, 3, $value)";
            }
        }
    
        // Process the 2 categories with one subcategory with id 4
        for($i = 12; $i <= 13; $i++) {
            if(isset($_POST["cat" . ($i-1)]) && $_POST["cat" . ($i-1)] !== "") {
                $value = $_POST["cat" . ($i-1)];
                $values[] = "($user_id, $i, 4, $value)";
            }
        }
    

    
        // If there are no values to insert, exit the script
        if(empty($values)) {
            echo "No values to insert!";
            exit;
        }
    
        $query .= implode(", ", $values);
    
        // Execute the query
        $result = mysqli_query($connection, $query);
    
        if($result) {
            echo "Success!";
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    }
    
?>