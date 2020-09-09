<?php

/*
 * Created By Udaaan Digital Team
 * sinha_000/  13-Aug-2017 9:49:40 PM
 * All Rights Reserved (c)
 */

////            Configration
//            $mail_username = "";
//            $mail_password = "";
//            $from_mail = "";
//            $from_name = "";
//            $to.=$email;
//            $cc = "feedback@udaaan.org,admin@udaaan.org";
//
////            Mail Details
//            $subject="Your message is submitted successfully";
//            $bodyContent="Dear $name,<br><br>Thanks for contacting us.<br>You submitted message is -<br><span style='font-weight: bold; font-style: italic;'>\"$message\".</span><br><br>Regards,<br>Udaaan Team";
//
//            $require_path = "../";
//            include $require_path.'includes/sendmail.php';

require $require_path.'includes/PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->Host = 'mx1.hostinger.in';
$mail->SMTPAuth = false;
if($mail_username=="" && $mail_password==""){
    $mail_username = 'donotreply@udaaan.org';
    $mail_password = 'Aa9528962535#';
    $from_mail = 'donotreply@udaaan.org';
    $from_name = 'DoNotReply';
}
$mail->Username = $mail_username;
$mail->Password = $mail_password;
$mail->SMTPSecure = 'ssl';
$mail->Port = 587;

$mail->setFrom($from_mail,$from_name);
$mail->addReplyTo($from_mail,$from_name);
$arr_to = explode(',', $to);
foreach ($arr_to as $reciever){
    $mail->addAddress($reciever);
}
if($cc!=""){
    $arr_cc = explode(',', $cc);
    foreach($arr_cc as $email){
        $mail->AddCC($email);
    }
}
if($bcc!=""){
    $arr_bcc = explode(',', $bcc);
    foreach($arr_bcc as $bemail){
        $mail->AddBCC($bemail);
    }
}

$mail->isHTML(TRUE);
$mail->Subject = $subject;
$mail->Body = $bodyContent;
$mail_sent = $mail->send();
?>