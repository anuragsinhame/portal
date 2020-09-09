<?php

/*
 * Created By Udaaan Digital Team
 * sinha_000/  26-Mar-2017 8:02:08 PM
 * All Rights Reserved (c)
 */
$root = '../';
include $root . 'others/connect.php';
include $root . 'others/functions.php';
include $root . 'includes/header1.php';

$message = $_GET['message'];

echo $message;
echo "<br/>Go to <a href='#'><span class='btn btn-primary'>Home</span></a>";
?>