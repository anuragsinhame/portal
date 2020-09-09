<?php

/*
 * Created By Udaaan Digital Team
 * sinha_000/  30-Jul-2017 6:20:10 AM
 * All Rights Reserved (c)
 */
$root = '../';
include $root . 'others/connect.php';
include $root . 'others/functions.php';
$navtext="SESSION TIMED OUT";
include $root . 'includes/header1.php';
echo '<div class="text-center text-danger" style="font: 2em comic sans ms; font-weight: bold;">You session is timed out. <br />Redirecting to login page in 5sec.<br />If you are not automatically redirected, please <a href="profile/login.php">Click Here</a> to go to login page</div>';
header('Refresh:5; url=login.php');
