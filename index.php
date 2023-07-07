<?php
    include "db.php";
   
    

    session_start();

    if(!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }
    echo $_SESSION["user_id"];









?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Goals</title>
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="wrapper">
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
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Reports
                        </button>
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
    <div class="header">
        <nav class="breadcrumb">
            <ol class="breadcrumb-list">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#">My Goals</a>
                </li>
            </ol>
        </nav>
        
        <h1 class="headline">My Goals</h1>
        <div class="wrapper-head">
        <select class="select-date" id="date-myGoals">
            <option value="Date">Date</option>
            <option value="Progress">Progress</option>
            <option value="Name">Name</option>
        </select>
        <button class="image-button" onclick="location.href='add_goal.php'">
            <img src="images/add.svg" alt="Button Image">
        </button>
        </div>
    </div>
    <div class="my-goals-table">
        <!-- All the script  -->
    </div>
    <footer>
        <div class="footer-container">
            <div class="footer-footer">
                <div class="logo-description"><img src="./images/logo.png" alt="logo" class="footer-logo3">
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
                            <span><a target="_blank" href="https://twitter.com/TennisBotIL" class="navlinks-color">Twitter</a></span>
                            <br>
                            <span><a target="_blank" href="https://www.facebook.com/profile.php?id=100094332309940" class="navlinks-color">Facebook</a></span>
                            <br>
                            <span><a target="_blank" href="https://www.instagram.com/tennisbotil/" class="navlinks-color">Instegram</a></span>
                            <br>
                            <span><a target="_blank" href="https://www.youtube.com/channel/UCk0C7FZ9hhbagbre5JjT-PA" class="navlinks-color">youtube</a></span>
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
</div>
<script src="./js/script.js"></script>
<?php
$connection->close();
?>
</body>
</html>











