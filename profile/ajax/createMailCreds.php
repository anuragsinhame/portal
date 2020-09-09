<?php

/*
 * Created By Udaaan Digital Team
 * Anurag/  27-Aug-2017 8:54:33 AM
 * All Rights Reserved (c)
 */
$root = '../';
include $root.$root . 'others/connect.php';
include $root.$root . 'others/functions.php';
include $root.$root . 'includes/ajaxCookie.php';

$new_mail=$_POST['email'];
$new_pwd=$_POST['pwd'];
$uid = $_POST['uid'];

//Insert into additional
$additional_insertion_query = "INSERT INTO additional (uid, email_id, pwd) VALUES ('$uid', '$new_mail', '$new_pwd');";
$additional_insertion = mysqli_query($connect, $additional_insertion_query);
if($additional_insertion){
    $data_from_usermaster = get_data_from_table("SELECT * FROM user_master as um, registered_members as rm WHERE um.username=rm.username AND rm.uid=$uid;");
    $fname = $data_from_usermaster['fname'];
    $email = $data_from_usermaster['email'];
//              Mail Details
    $subject = "Your Udaaan Email Id has been created";
    $bodyContent = "Dear $fname,<br>
                    <br>
                    Your mail id has been created. Please find below the credentials-<br>
                    <br>
                    USERNAME: <b>$new_mail</b><br>
                    PASSWORD: <b>$new_pwd</b><br>
                    <br>
                    Please keep the above information confidential.<br>
                    You can login to this account on<br>
                    <a href='https://webmail1.hostinger.in/roundcube/' target='_blank'>https://webmail1.hostinger.in/roundcube/</a><br>
                    <br>
                    Please visit <b>Help</b> section on Portal to know how to-<br>
                    -- configure this account on Gmail App.<br>
                    -- change password of this email account.<br>
                    For more details, please contact admin@udaaan.org<br>
                    <br>
                    <br>
                    <i>Regards,</i><br>
                    <b>UDAAAN DIGITAL TEAM</b>";

//              Configration
    $mail_username = "admin@udaaan.org";
    $mail_password = "Aa9528962535#";
    $from_mail = "admin@udaaan.org";
    $from_name = "Udaaan Digital Team";
    $to.=$email;
    $cc = "";
    $bcc = "";

    $mail_error = "";
    $require_path = "../../";
    include $require_path.'includes/newsendmail.php';
    
    if($mail_sent!=TRUE){
        echo 'Error in sending Mail<br/>'.$mail_error;
    }else{
        echo 'Success';
    }
}