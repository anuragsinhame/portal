<?php

/*
 * Created By Udaaan Digital Team
 * sinha_000/  02-Aug-2017 11:06:51 PM
 * All Rights Reserved (c)
 */
$root = '../';
include $root.$root. 'others/connect.php';
include $root.$root. 'others/functions.php';

$data = mysqli_query($connect,"SELECT * FROM temp_mem;");
while($da = mysqli_fetch_assoc($data)){
//    echo $da['name'].'<br>';
    $name = $da['name'];
    include 'sendOffer.php';
}