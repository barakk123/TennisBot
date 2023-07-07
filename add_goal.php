<?php
session_start();
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
    //redirect to login or error page
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION['user_id'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Goals</title>
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
    <div class="header" id="header-add-goals">
        <nav class="breadcrumb">
            <ol class="breadcrumb-list">
                <li class="breadcrumb-item"><a href="./index.php">My Goals</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="./add-goal.php">Add Goal</a>
                </li>
            </ol>
        </nav>
        <h1 class="headline">Add Goal</h1>
    </div>

    <div class="formDiv">
    <form action="./choose_category.php" method="post">
    <label class="form-nameofgoal-size">Name of goal</label>
    <input name="name" type="text" id="nameOfGoal" pattern=".+" required>
    <br>
    <label class="form-nameofgoal-size" id="form-goalName-size">Choose Goal Period</label>
    <label class="form-Startdate-size">Start: </label>
    <input name="start_date" type="date" id="startDate" required>
    <br>
    <label class="form-Startdate-size">End: </label>
    <input name="end_date" type="date" id="endDate" required>
    <br>
    
    <button type="submit" id="submit-button">Continue</button>
</form>


    </div>
    <div class="form-timeline">
        <a href="add-goal.php"><img class="form-timeline-size" src="images/form-timeline-adgrey.svg" alt="form-timeline-adgrey"></a>
        <a href="#"><img class="form-timeline-size" id="form-timeline-chooseCategory" src="images/form-timeline-chwhite.svg" alt="form-timeline-chwhite"></a>
    </div>
    <div id="mod"></div><br><br>    
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
    <script src="js/scrip.js"></script>
</body>
</html>
    
    