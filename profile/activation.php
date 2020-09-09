<?php

/*
 * Created By Udaaan Digital Team
 * Anurag/  14-Feb-2017 10:49:32 PM
 * All Rights Reserved (c)
 */
$root = '../';
include $root . 'others/connect.php';
include $root . 'others/functions.php';

//$retrieved_code = filter_input(INPUT_GET, 'acfou');      //Activation Code for Udaaan --> acfou
$retrieved_code = $_GET['acfou'];      //Activation Code for Udaaan --> acfou
//echo 'Activation Code is: '.$retrieved_code;
$act_check_query = "SELECT * FROM temp_members WHERE activation='$retrieved_code' AND activated=0;";
$validate_result = mysqli_query($connect, $act_check_query);
$act_num_rows = mysqli_num_rows($validate_result);

//$data = mysqli_query($connect, $query);
//$num_rows = mysqli_num_rows($data);
//$$act_num_rows = 0;

if($act_num_rows == 1){
    //update activated as 1
    if(update_data('temp_members', 'activated', '1', 'activation', $retrieved_code)){
        //account activated
        echo 'Your account is activated. If you are not redirected to login page in 5 sec, please <a href="'.$base.'profile/login.php">Clik here</a> to go to login page.';
        header('Refresh:5; url=login.php');
    }
}else{
    //some error contact admin
    echo '<br>Error..!!<br />Possible Reasons<br />'
        . 'Your activation code expired. Please <a href="'.$base.'profile/signup.php">Sign Up</a> again.<br />'
        . 'Your acccount is already activated. <a href="'.$base.'profile/login.php">Clik here</a> to login to your acount.<br />'
        . 'If problem still persists. Please contact <a href = "'.$mailToAdmin.'"> Admin</a>';
}
    //nothing else
//    
//    $data_from_temp = mysqli_fetch_assoc($validate_result);
//    $temp_uname = $data_from_temp['username'];
//    $temp_pwd = $data_from_temp['password'];
//    $temp_mob = $data_from_temp['mobile'];
//    $temp_mail = $data_from_temp['email'];
//    $join_date = date("Ymd");
//    $temp_del_query = "DELETE FROM temp_members WHERE username='$temp_uname';";
//    $registered_update_query = "INSERT INTO registered_members (uid, username, password, mobile, email, failed_attempts, active, join_date, last_login, first_login) VALUES (NULL,"
//            . " '$temp_uname', '$temp_pwd', '$temp_mob', '$temp_mail', 0, 1, '$join_date', $join_date, 1);";
//    $registered_insertion = mysqli_query($connect, $registered_update_query);
//    if($registered_insertion){
//        $temp_deletion = mysqli_query($connect, $temp_del_query);
//    }
//    mysqli_close($connect);
//    
//}else{
//}