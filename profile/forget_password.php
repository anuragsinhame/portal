<?php

/* 
 * Created By Udaaan Digital Team
 * Anurag/  03-Feb-2017 12:39:09 AM
 * All Rights Reserved (c)
 */
$root = "../";
include $root.'others/connect.php';
include $root.'others/functions.php';
if(isset($_COOKIE['u'])){
    echo "<p style='background:white;'>In if".$_SEESION['username'].'</p>';
    header("location: index.php");
    exit;
}
$mainMsg="";
$table_name="";
$tab="";
$title="Forget Password";
$page_heading="Reset your password";
include $root.'includes/header_small.php';

if(isset($_POST['reset_pwd'])){
    $username = $_POST['username'];
    $email="";
    if($username==""){
        $mainMsg.= "Enter Username";
    }else{
        if(data_exists($username, 'username', 'registered_members')){
            $table_name = "registered_members";
            $tab = "r";
        }else if (data_exists($username, 'username', 'temp_members')){
            $table_name = "temp_members";
            $tab = "t";
        }else{
            $table_name = "";
            $tab = "";
        }
        $user_data = get_data_from_table("SELECT * FROM $table_name WHERE username='$username'");
        if($user_data){
            if(data_exists($username, 'username', 'verification')){
                $data=get_data_from_table("SELECT * FROM verification WHERE username='$username';");
                $act_code=$data['verif_code'];
                $email=$data['email'];
                $time = $data['creation_time'];
                $creation_time = date("d M Y H:i:s", strtotime($time));
                $exp_time = date("d M Y H:i:s", strtotime("$time+15Minutes"));
                echo "We have already sent a verification code at <b>$creation_time</b>. If you did not get it please wait till <b>$exp_time</b> and then try again.";
            }else{
                $email = $user_data['email'];
                $curr_time = time();
                $act_code = md5($email.$curr_time.$username);
                
                
                $insert_to_db = "INSERT INTO verification(username, email, verif_code, creation_time) VALUES('$username','$email','$act_code',CURRENT_TIMESTAMP);";
                $result = mysqli_query($connect,$insert_to_db);
                if($result){
//                    $mail_sent = send_mail_from_dnr($email, $subject, $bodyContent);
                    
                    //            Mail Details
                    $subject = "Reset Password of your Udaaan Account";
                    $bodyContent = "
                            <h1 style='clear: both; font-size: 2em; text-align: center;'>Reset Password for <i>$username</i></h1>
                            <p>Dear <b>$username</b>,<br></p>
                            <p>Click the link below to reset your password.</p>
                            <p style='text-align: center; margin-top: 4%;'><a href='".$base."profile/change_pwd.php?v_code=$tab$act_code' target='_blank'>Reset Password</a></p>
                            <br>Regards,<br><b>Udaaan Digital Team</b>
                            ";

        //            Configration
                    $mail_username = "";
                    $mail_password = "";
                    $from_mail = "";
                    $from_name = "";
                    $to.=$email;
                    $cc = "";
                    $bcc = "";

                    $require_path = "../";
                    include $require_path.'includes/newsendmail.php';

                    if(!$mail_sent){
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail_sent->ErrorInfo;
                    }else{
                        $mainMsg = "<div class='alert alert-success alert-dismissible show' role='alert'>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                        </button>
                                        <strong>Verification Link successfully sent...!!!<br>Please check your email account<br><i style='color:blue'>$email</i><br>for link to reset password of your account.</strong>
                                            <br>You will be redirected to login page in 5 seconds.....
                                    </div>";
                        
                        header("Refresh:5; url=login.php");
                    }
                }
            }
        }else{
            $mainMsg.="Doesn't Exist. <span style='color: green'>Want to </span><a href='profile/signup.php' style='font-size: 1em;'>Sign Up?</a>";
        }
    }
}


echo "<span class='mainError error'>$mainMsg</span>";
?>
<form action="" method="POST">
    <div class="form-group">
        <label for="username" class="required">Username</label><br />
        <div class="inner-addon right-addon">
            <input id="username" name="username" class="form-control" type="text" placeholder="Enter your Username" />
            <i class="glyphicon glyphicon-user"></i>
        </div>
    </div>
    <input class="form-control btn btn-primary" type="submit" value="Reset Password" name="reset_pwd"/>
</form>
</div>
<div class="form-container">
    <label style="margin-left: 10%;">Go to Login Page &nbsp;<a href="profile/login.php" style="font-size: 1.3em;">Log In</a></label>
</div>
<div class="form-container">
    <label style="margin-left: 10%;">New at UDAAAN? &nbsp;<a href="profile/signup.php" style="font-size: 1.3em;">Sign Up</a></label>
</div>