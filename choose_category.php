<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["goal_name"] = $_POST["name"];
    $_SESSION["start_date"] = $_POST["start_date"];
    $_SESSION["end_date"] = $_POST["end_date"];

}
/* after setting the session variables
echo "Goal name: " . $_SESSION["goal_name"] . "<br/>";
echo "Start date: " . $_SESSION["start_date"] . "<br/>";
echo "End date: " . $_SESSION["end_date"] . "<br/>";
echo "User id: " . $_SESSION["user_id"] . " <br>";
*/


$data = json_decode(file_get_contents('categories.json'), true);
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Category</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="nav-container">
        <div class="header-container">
            <div class="menu-container">
                <a href="#">
                    <img src="images/profile.svg" class="logo margin" alt="profile">
                </a>
                <a href="#">
                    <img src="images/bell.svg" class="logo green margin" alt="Notifications">
                </a>
            </div>
            <nav class="nav-desktop"> 
                <ul>
                    <li>
                        <a href="#" class="nav-home navlink">
                            <div class="text-home">Home</div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Goals
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="index.php">My Goals</a></li>
                                <li><a href="#">Coach Goals</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Reports
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#">My Reports</a></li>
                                <li><a href="#">Coach Reports</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="nav-home navlink">
                            <div class="text-home">Schedule</div>
                        </a>
                    </li>
                </ul>
            </nav>
            <img src="images/logo.png" alt="logo" class="logo tennis">
        </div>
        
        <nav class="nav-mobile"> 
            <ul>
                <li>
                    <a href="#" class="nav-home navlink">
                        <div class="text-home2">Home</div>
                    </a>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Goals</button>
                        <ul class="dropdown-menu">
                            <li><a href="index.php" class="my-goals-link">My Goals</a></li>
                            <li><a href="#">Coach Goals</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Reports</button>
                        <ul class="dropdown-menu">
                            <li><a href="#">My Reports</a></li>
                            <li><a href="#">Coach Reports</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" class="nav-home navlink">
                        <div class="text-home2">Schedule</div>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="change-header">
        <nav class="breadcrumb">
            <ol class="breadcrumb-list">
                <li class="breadcrumb-item"><a href="index.php">My Goals</a></li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="add_goal.php">Add Goal</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="add_goal.php">Choose category</a>
                </li>
            </ol>
        </nav>
        <div class="header-option">
            <h1 class="h1-space">Choose Category</h1>
            <select class="select-date" id="date-myGoals" onchange="updateStrikeList(this.value)">
            </select>
        </div>
        <div id="strike-list">
        </div>

    </div>
    <div class="tableChooseCategory">
        <form action="save_data.php" method="POST">
            <table>
                
            </table>
            <button type="submit">Save</button>
        </form>
    </div>

   
    <div id="mod" style="display: none;">
        <div class="overlay"></div>
        <div class="lightbox-container">
            <div class="lightbox-lightbox">
                <div class="lightbox-button">
                    <span class="lightbox-text"><button onclick="go()">ok</button></span>
                </div>
                <div class="lightbox-group28">
                    <span class="lightbox-text2">
                        <span>Goal saved successfully!</span>
                    </span>
                <img src="./images/v.svg" alt="Union9138" class="lightbox-union">
                </div>
                <img src="./images/logo.png" alt="logo39138" class="lightbox-logo3">
            </div>
        </div>
    </div><br><br>
    <footer>
        <div class="footer-container">
            <div class="footer-footer">
                <div class="logo-description"><img src="./images/logo.png" alt="logo31353" class="footer-logo3">
                    <span class="footer-text09">
                        <span>
                            <span>
                                A comprehensive multipurpose tennis training system capable of
                                precision and a variety of intensities,
                            </span>
                            <span>
                                It studies the trainee and adapts training to him personally.
                            </span>
                            <br>
                        </span>
                    </span>
                </div>
                <div class="social-about-links">
                    <div class="footer-text27">Social</div>
                    <span class="footer-text">
                        <span>
                            <span><a href="#" class="navlinks-color">Twitter</a></span>
                            <br>
                            <span><a href="#" class="navlinks-color">Facebook</a></span>
                            <br>
                            <span><a href="#" class="navlinks-color">Instegram</a></span>
                            <br>
                            <span><a href="#" class="navlinks-color">youtube</a></span>
                        </span>
                    </span>
                </div>
                <div class="social-about-links">
                    <div class="footer-text27">About</div>
                    <span class="footer-text18">
                        <span>
                            <span><a href="#" class="navlinks-color">Support</a></span>
                            <br>
                            <span><a href="#" class="navlinks-color">Sitemap</a></span>
                            <br>
                            <span><a href="#" class="navlinks-color">About us</a></span>
                            <br>
                            <span><a href="#" class="navlinks-color">Contact</a></span>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </footer>
    <script src="js/scri.js"></script>
</body>
</html>
    
    
    
    
    