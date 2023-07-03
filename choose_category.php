<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["goal_name"] = $_POST["name"];
    $_SESSION["start_date"] = $_POST["start_date"];
    $_SESSION["end_date"] = $_POST["end_date"];
    $_SESSION["user_id"] = $_POST["user_id"];

}
// after setting the session variables
/*echo "Goal name: " . $_SESSION["goal_name"] . "<br/>";
echo "Start date: " . $_SESSION["start_date"] . "<br/>";
echo "End date: " . $_SESSION["end_date"] . "<br/>";
*/

// Now you can access the form data later using $_SESSION["goal_name"], $_SESSION["start_date"], and $_SESSION["end_date"]

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
                                <li><a href="index.html">My Goals</a></li>
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
                            <li><a href="index.html" class="my-goals-link">My Goals</a></li>
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
                <li class="breadcrumb-item"><a href="./index.html">My Goals</a></li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="./add-goals.html">Add Goal</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="./add-goals.html">Choose category</a>
                </li>
            </ol>
        </nav>
        <div class="header-option">
            <h1 class="h1-space">Choose category</h1>
            <select class="select-date" id="date-myGoals">
                <option value="Strikes">Strikes</option>
                <option value="Serves">Serves</option>
                <option value="Physical">Physical</option>
                <option value="Position">Position</option>
            </select>
        </div>
    </div>

    <div class="tableChooseCategory">
        <form action="save_data.php" method="POST">
            <table>
                <tbody class="tr_wrapper">
                    <tr class="headtitle-table-tr">
                        <td><div class="headtitle-table">Forehand</div></td></tr>
                    <tr>
                        <td class="td1">Avg. Speed</td>
                        <td class="td2"><div class="text_speed_acc">65 -></div><input id="s1" type="number" min="66" oninput="validateInput('s1')" required>km/h</td>
                        <td class="td3">Accuracy</td>
                        <td class="td4"><div class="text_speed_acc">62 -></div><input id="a1" type="number" min="63" max="100" oninput="validateInput('a1')" required>%</td>
                    </tr>
                </tbody>
                <tbody class="tr_wrapper">
                    <tr class="headtitle-table-tr">
                        <td><div class="headtitle-table">Backhand</div></td></tr>
                    <tr>
                        <td class="td1">Avg. Speed</td>
                        <td class="td2"><div class="text_speed_acc">73 -></div><input id="s2" type="number" min="74" oninput="validateInput('s2')" required>km/h</td>
                        <td class="td3">Accuracy</td>
                        <td class="td4"><div class="text_speed_acc">68 -></div><input id="a2" type="number" min="69" max="100" oninput="validateInput('a2')" required>%</td>
                    </tr>
                </tbody>
                <tbody class="tr_wrapper">
                    <tr class="headtitle-table-tr">
                        <td><div class="headtitle-table">Volley</div></td></tr>
                    <tr>
                        <td class="td1">Avg. Speed</td>
                        <td class="td2"><div class="text_speed_acc">90 -></div><input id="s3" type="number" min="93" oninput="validateInput('s3')" required>km/h</td>
                        <td class="td3">Accuracy</td>
                        <td class="td4"><div class="text_speed_acc">59 -></div><input id="a3" type="number" min="60" max="100" oninput="validateInput('a3')" required>%</td>
                    </tr>
                </tbody>    
                <tbody class="tr_wrapper">
                    <tr class="headtitle-table-tr">
                        <td><div class="headtitle-table">Slice</div></td></tr>
                    <tr>
                        <td class="td1">Avg. Speed</td>
                        <td class="td2"><div class="text_speed_acc">60 -></div><input id="s4" type="number" min="61" oninput="validateInput('s4')" required>km/h</td>
                        <td class="td3">Accuracy</td>
                        <td class="td4"><div class="text_speed_acc">69 -></div><input id="a4" type="number" min="56" max="100" oninput="validateInput('a4')" required>%</td>
                    </tr>
                </tbody>
                <tbody class="tr_wrapper">
                    <tr class="headtitle-table-tr">
                        <td><div class="headtitle-table">Drop-Shot</div></td></tr>
                    <tr>
                        <td class="td1">Avg. Speed</td>
                        <td class="td2"><div class="text_speed_acc">50 -></div><input id="s5" type="number" min="51" oninput="validateInput('s5')" required>km/h</td>
                        <td class="td3">Accuracy</td>
                        <td class="td4"><div class="text_speed_acc">47 -></div><input id="a5" type="number" min="48" max="100" oninput="validateInput('a5')" required>%</td>
                    </tr>   
                </tbody>
            </table>
            <button type="submit">Save</button>
        </form>
    </div>

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
    
    
    
    
    