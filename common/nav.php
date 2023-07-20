<?php
    $user_type = $_SESSION['user_type'];
?>

<div class="nav-container">


    <div class="header-container">
        <div class="menu-container">

            <img src="images/hamburger.png" class="profile margin" id="hamburger" alt="hamburger">
            <div id="overlay_ham" class="overlay_hamburger"></div>
            <div id="mySidenav" class="sidenav">
                <div class="sidenavcontent">
                    <!--Profile pic -->
                    <!--Name of user from database -->
                    <!--View profile button -->
                    <a href="#">My Account</a>
                    <a href="#">Settings</a>
                    <a href="#">Support</a>
                    <a href="#">Contact</a>
                    <div class="social_icons">
                        <a target="_blank" href="https://twitter.com/TennisBotIL"><img src="images/twitter.svg"
                                class="social_icon" alt="Twitter"></a>
                        <a target="_blank" href="https://www.facebook.com/profile.php?id=100094332309940"><img
                                src="images/facebook.svg" class="social_icon" alt="Facebook"></a>
                        <a target="_blank" href="https://www.instagram.com/tennisbotil/"><img src="images/instagram.svg"
                                class="social_icon" alt="Instagram"></a>
                        <a target="_blank" href="https://www.youtube.com/channel/UCk0C7FZ9hhbagbre5JjT-PA"><img
                                src="images/youtube.svg" class="social_icon" alt="Youtube"></a>
                    </div>
                    <a href="logout.php" class="logout-button-ham">Log Out</a>
                </div>
            </div>
            <div class="logout-button-pc"><a href="logout.php" class="logout-button">Log Out</a></div>
            <a href="profile.php">
                <img src="images/profile.svg" class="profile margin" alt="profile">
            </a>
            <a href="#">
                <img src="images/bell.svg" class="profile green margin" alt="Notifications">
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
                    <?php
                    if ($user_type == 'Coach') {
                        echo '
                        <a href="trainees_list.php" class="nav-home navlink">
                            <div class="text-home">Trainees</div>
                        </a>
                        ';
                    }
                    else {
                        echo '
                        <div class="dropdown">
                            <button class="text-home btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown">Goals
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php">My Goals</a></li>
                                <li><a class="dropdown-item" href="#">Coach Goals</a></li>
                            </ul>
                        </div>
                        ';
                    }
                    ?>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="text-home btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown">Reports
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">My Reports</a></li>
                            <li><a class="dropdown-item" href="#">Coach Reports</a></li>
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

        <div class="logo-tennis"></div>

    </div>

    <nav class="nav-mobile">
        <ul>
            <li>
                <a href="#" class="nav-home navlink">
                    <div class="text-home2">Home</div>
                </a>
            </li>
            <li>
            <?php
                    if ($user_type == 'Coach') {
                        echo '
                        <a href="trainees_list.php" class="nav-home navlink">
                            <div class="text-home2">Trainees</div>
                        </a>
                        ';
                    }
                    else {
                        echo '
                        <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button"
                            data-bs-toggle="dropdown">Goals</button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php" class="my-goals-link">My Goals</a></li>
                            <li><a class="dropdown-item" href="#">Coach Goals</a></li>
                        </ul>
                        </div>
                        ';
                    }
                    ?>
            </li>
            <li>
                <div class="dropdown drpdwn3">
                    <button class="btn btn-default dropdown-toggle" type="button"
                        data-bs-toggle="dropdown">Reports</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">My Reports</a></li>
                        <li><a class="dropdown-item" href="#">Coach Reports</a></li>
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
    <script src="./js/global.js"></script>
</div>