<?php

/* 
 * Cerated By Udaaan Digital Team
 * Anurag/  30-Jan-2017 6:56:18 PM
 * All Rights Reserved (c)
 */

$connect = mysqli_connect('localhost','root','') or die('Error in Connection');
$select_db = mysqli_select_db($connect, 'portal') or die('Error in connecting to Database');

$base = 'http://localhost/portal/';
$home = $base;
$page_heading = "";
