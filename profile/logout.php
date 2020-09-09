<?php

/* 
 * Created By Udaaan Digital Team
 * Anurag/  04-Feb-2017 4:39:06 PM
 * All Rights Reserved (c)
 */
$root = '../';
include $root.'others/connect.php';
include $root.'others/functions.php';
include $root.'includes/header1.php';
session_start();
setcookie('u', '', time()-3600);
if(isset($_COOKIE['ud_cookie'])){
    setcookie('ud_cookie', '', time()-3600);
}
session_destroy();
echo '<div class="text-center text-danger" style="font: 2em comic sans ms; font-weight: bold;">Logged Out.<br />Redirecting to login page in 5sec.<br />If you are not automatically'
.' redirected, please <a href="profile/login.php">Click Here</a> to go to login page</div>';
header('Refresh:5; url=login.php');