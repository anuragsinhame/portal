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
        <div id="wrapper" style="clear: both;">
            <ul id="nav_ul" class="nav navbar-nav navbar-right" style="margin-right: 10px;">
                    <li><a class="btn mybtn" href="profile/logout.php">LogOut</a></li>
            </ul>
            <div class='text-center' style="background: #000; height: 50px; color: #fff;">
                <h1 class='' style="padding:5px;"><?=$navtext;?></h1>
            </div>
            <div class="container" style="min-height: 260px;">
                <div>
                    <header class="center_text">
                        <h1><?=$page_heading;?></h1>
                    </header>
                </div>