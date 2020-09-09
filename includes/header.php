<?php
/* 
 * Cerated By Udaaan Digital Team
 * Anurag/  30-Jan-2017 6:54:06 PM
 * All Rights Reserved (c)
 */
?>
<!doctype html>
<html dir="ltr" lang="en">
    <head>
        <base href= "<?php echo $base;?>" />
        <!-- Meta Tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <meta http-equiv="content-type" content="text/html" />
        <meta name="author" content="Udaaan Digital Team" />
        <!-- Page Title -->
        <title><?php echo $title;?></title>

        <!-- Favicon and Touch Icons -->
        <link href="images/favicon.png" rel="shortcut icon" type="image/png">

        <!-- Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        
        <!-- external javascripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/jquery.blockUI.js"></script>
        <?php echo $extra_includes;?>
        <style>
            a{
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <a href="profile/" style="float: left;"><img src="images/logo.png" alt="Udaaan" style="width: 200px"></a>
        <h1 style="float: left; margin-left: 20%; margin-top: 4%;">Udaaan Members Portal</h1>
        <!--<div style="min-width: 100%; height: 8px; border: 1px solid yellow; background: green;"></div>-->
        <!--NavBar Code Starts-->
        <div id="wrapper" style="clear: both; min-height: 338px;">
            <nav id="mainNav" class="navbar navbar-inverse">
                <div class="container-fluid">
                    <!--For Mobile Screens Starts-->
                    <div class="navbar-header" id="mobile_nav">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    <!--For Mobile Screens Ends-->
                    </div>
                    <!--Menu Items-->
                    <div id="mainNavBar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <!--<li class="active"><a href="index.php">Home</a></li>-->
                            <li class="dropdown"><a href="<?=$home;?>">Home</a></li>
                            <li class="dropdown"><a href="profile/edit_profile.php">Edit Profile</a></li>
                            <li class="dropdown"><a href="profile/attendance.php">Attendance</a></li>
                            <li class="dropdown"><a href="profile/help/help.php">Help</a></li>
                            <li class="dropdown"><a href="https://webmail1.hostinger.in/roundcube/" target="_blank">Webmail Login</a></li>
                        </ul>
                    <!--Right Side Buttons-->
                        <ul id="nav_ul" class="nav navbar-nav navbar-right">
                            <li><a class="btn mybtn" href="profile/logout.php">LogOut</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container" style="">
                <div>
                    <header class="center_text">
                        <h1><?=$page_heading;?></h1>
                    </header>
                </div>