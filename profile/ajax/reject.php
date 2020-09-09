<?php

/*
 * Created By Udaaan Digital Team
 * Anurag/  09-Mar-2017 7:57:26 AM
 * All Rights Reserved (c)
 */
$root = '../';
include $root.$root . 'others/connect.php';
include $root.$root . 'others/functions.php';
include $root.$root . 'includes/ajaxCookie.php';

$uid = $_POST['uid'];
$rejector = $_POST['rejector'];

$data_from_temp = get_data_from_table("SELECT * FROM temp_members WHERE temp_id='$uid';");
$temp_uname = $data_from_temp['username'];
$temp_mob = $data_from_temp['mobile'];
$temp_mail = $data_from_temp['email'];
$deleted_insertion_query = "INSERT INTO deleted (id, username, mobile, email, deleted_by, timestamp) VALUES ('','$temp_uname','$temp_mob','$temp_mail','$rejector', '');";
//Insert into deleted
$deleted_insertion = mysqli_query($connect, $deleted_insertion_query);
if($deleted_insertion){
//Delete from Temp
    $temp_del_query = "DELETE FROM temp_members WHERE temp_id=$uid";
    $temp_deletion = mysqli_query($connect, $temp_del_query);
    if($temp_deletion){
        echo 'Success';
    }else{
        echo 'Temp Deletion Failed';
    }
}else{
    echo 'Deleted insertion Failed';
}