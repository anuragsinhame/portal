<?php

/*
 * Created By Udaaan Digital Team
 * sinha_000/  20-Mar-2017 2:45:20 AM
 * All Rights Reserved (c)
 */
$root = '../';
include $root.$root.'others/connect.php';
include $root.$root.'others/functions.php';

$email=$_POST['email'];
$username=$_POST['uname'];
$activation_code = md5($email.time()."Udaaan");

//            Mail Details
$subject = "Activate your Udaaan Account";
$bodyContent = "
                <html>
                <head>
                    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' />
                    <style>
                        .message-container {position: relative;overflow: hidden;width: 70%;margin: 0 auto;padding: 20% 0;min-height: 580px;}
                        .message-container:before {content: ' ';display: block;position: absolute;left: 0;top: 0;width: 100%;height: 100%;z-index: -1;opacity: 0.25;background-image: url('".$base."images/logo.png');
                            background-repeat: no-repeat;-ms-background-size: cover;-o-background-size: cover;-moz-background-size: cover;-webkit-background-size: cover;background-size: cover;}
                    </style>
                </head>
                <body>
                    <div class='message-container'>
                        <h1 style='clear: both; font-size: 2em; text-align: center;' class='strong'>Greetings from Udaaan</h1>
                        <h2 style='font-size: 1.5em;'>You are just one step away to join Udaaan Family</h2>
                        <p>Your Username is: <b>$username</b><br /></p>
                        <p>Thank you for registering with Udaaan.<br>To activate your account for Udaaan Portal, click the link below.</p>
                        <p style='text-align: center; margin-top: 4%;'><a href='".$base."profile/activation.php?acfou=$activation_code' target='_blank' class='btn btn-primary'>Activate Your Account</a></p>
                    </div>
                </body>
                </html>";

//            Configration
            $mail_username = "";
            $mail_password = "";
            $from_mail = "";
            $from_name = "";
            $to.=$email;
            $cc = "";
            $bcc = "";
            
            $require_path = "../../";
            include $require_path.'includes/newsendmail.php';

            
if($mail_sent!=TRUE){
    echo "Not Sent<br/>Error".$mail_sent->ErrorInfo;
}else if($mail_sent){
    //update activation code in database
    if(update_data('temp_members', 'activation', $activation_code, 'email', $email)){
        echo 'Sent';
    }else{
        echo "Not Updated";
    }
}