<?php

/* 
 * Created By Udaaan Digital Team
 * Anurag/  03-Feb-2017 12:39:25 AM
 * All Rights Reserved (c)
 */
$root = '../';
include $root.'others/connect.php';
include $root.'others/functions.php';
$mainMsg = "";
$email = "";
//initialization for errors
$errors = "";
$name_msg = "";
$pwd_msg = "";
$conf_pwd_msg = "";
$mobile_msg = "";
$email_msg = "";

//echo session_status();
//if(null!=filter_input(INPUT_COOKIE, 'u')){
if(isset($_COOKIE['u'])){
    echo "<p style='background:white;'>In if".$_SEESION['username'].'</p>';
    header("location: index.php");
    exit;
}
$title="SignUp";
$page_heading="Become a Member of Udaaan";
include $root.'includes/header_small.php';
$e_user = 0;
$e_pwd = 0;
$e_mob = 0;
$e_mail = 0;
//                if(null!=filter_input(INPUT_POST, 'signUp')){
if(isset($_POST['signUp'])){
//                    $username = strtolower(mysqli_real_escape_string($connect,filter_input(INPUT_POST, 'username')));
//                    $password = md5(mysqli_real_escape_string($connect,filter_input(INPUT_POST, 'password')));
//                    $conf_password = md5(mysqli_real_escape_string($connect,filter_input(INPUT_POST, 'conf_password')));
//                    $mobile = mysqli_real_escape_string($connect,filter_input(INPUT_POST, 'mobile'));
//                    $email = strtolower(mysqli_real_escape_string($connect,filter_input(INPUT_POST, 'email')));
    $username = trim(strtolower(mysqli_real_escape_string($connect,$_POST['username'])));
    $password = $_POST['password'];
    $conf_password = $_POST['conf_password'];
    $mobile = trim(mysqli_real_escape_string($connect,$_POST['mobile']));
    $email = trim(strtolower(mysqli_real_escape_string($connect,$_POST['email'])));
    if(!$username || !$password || !$conf_password || !$mobile || !$email){
        $mainMsg = "Please fill all the required fields";
    }else{
        $mainMsg = "";
        $table_name = 'registered_members';
        $table_name1 = 'temp_members';
        //validation for Username
        if(data_exists($username, 'username', $table_name)){
            $mainMsg.="Error in Username<br>";
            $name_msg.="Sorry!! Username is taken<br />";
            $errors.='input_error("username","1");';
            $e_user = 0;
        }else{
            if(data_exists($username, 'username', $table_name1)){
                $mainMsg.="Error in Username<br>";
                $name_msg.="Sorry!! Username is taken<br />";
                $errors.='input_error("username","1");';
                $e_user = 0;
            }else {
                $len = strlen($username);
                if($len<3 || $len>20){
                    $mainMsg.="Error in Username<br>";
                    $name_msg.="Username should be of length minimum 3 and maximum 20";
                    $errors.='input_error("username","1");';
                    $e_user = 0;
                }else{
                    if(!preg_match($contains_space, $username) && preg_match($contains_no_special_char_but_underscore, $username) && preg_match($start_with_char, $username)){
                        $errors.='input_error("username","0");';
                        $e_user = 1;
                    }else{
                        $mainMsg.="Error in Username<br>";
                        $name_msg.="Username should start only with a Character and should not contain any spaces or special characters";
                        $errors.='input_error("username","1");';
                        $e_user = 0;
                    }
                }
            }
        }
        //validation for Password
        $len = strlen($password);
        if($len<8 || $len>15){
            $mainMsg.="Error in Password<br>";
            $pwd_msg.="Password length should be minimum 8 and maximum 15";
            $errors.='input_error("password","1");';
            $e_pwd = 0;
        }else{
            if(!preg_match($contains_no_special_char, $password) && preg_match($contains_digit, $password) && preg_match($contains_lowercase, $password) && preg_match($contains_uppercase, $password)){
                //encrypting pwds
                $password = md5($password);
                $conf_password = md5($conf_password);
                if($password == $conf_password){
                    $pwd_msg = "";
                    $conf_pwd_msg = "";
                    $errors.='input_error("password","0");';
                    $errors.='input_error("conf_password","0");';
                    $e_pwd = 1;
                }else{
                    $mainMsg.="Error in Password<br>";
                    $conf_pwd_msg.="Entered Passwords do not Match";
                    $errors.='input_error("password","1");';
                    $errors.='input_error("conf_password","1");';
                    $e_pwd = 0;
                }
            }else{
                $mainMsg.="Error in Password<br>";
                $pwd_msg.="Password should contain at least 1 digit, 1 special character, 1 Lowercase and 1 Uppercase letter";
                $errors.='input_error("password","1");';
                $e_pwd = 0;
            }
        }

        //validation for mobile
        if(is_numeric($mobile)){
            if(strlen($mobile) == 10){
                if(!data_exists($mobile,'mobile',$table_name)){
                    if(!data_exists($mobile, 'mobile', $table_name1)){
                        $mobile_msg="";
                        $errors.='input_error("mobile","0");';
                        $e_mob = 1;
                    }else {
                        $mainMsg.="Error in Mobile No<br>";
                        $mobile_msg.="Mobile No is already registered";
                        $errors.='input_error("mobile","1");';
                        $e_mob = 0;
                    }
                }else{
                    $mainMsg.="Error in Mobile No<br>";
                    $mobile_msg.="Mobile No is already registered";
                    $errors.='input_error("mobile","1");';
                    $e_mob = 0;
                }
            }else{
                $mainMsg.="Error in Mobile No<br>";
                $mobile_msg.="Mobile length should be 10 instead of ".strlen($mobile);
                $errors.='input_error("mobile","1");';
                $e_mob = 0;
            }
        }else{
            $mainMsg.="Error in Mobile No<br>";
            $mobile_msg.="Mobile Number should be Numeric<br />";
            $errors.='input_error("mobile","1");';
            $e_mob = 0;
        }

        //validation for Email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $mainMsg.="Error in mail";
            $email_msg.="Invalid email format<br />";
            $errors.='input_error("email","1");';
            $e_mail = 0;
        }
        else{
            if(!data_exists($email,'email',$table_name)){
                if(!data_exists($email,'email',$table_name1)){
                    $email_msg="";
                    $errors.='input_error("email","0");';
                    $e_mail = 1;
                }else{
                    $mainMsg.="Error in mail";
                    $email_msg.="Email is already registered";
                    $errors.='input_error("email","1");';
                    $e_mail = 0;
                }
            }else{
                $mainMsg.="Error in mail";
                $email_msg.="Email is already registered";
                $errors.='input_error("email","1");';
                $e_mail = 0;
            }
        }
    }
    if($e_user==1 && $e_pwd==1 && $e_mob==1 && $e_mail==1){
        $mainMsg = "";
        $signup_date = date("Ymd");
        $activation_code = md5($email.time()."Udaaan");
        $in_temp_mem = "INSERT INTO temp_members (temp_id,username,password,mobile,email,activation,signup_date,first_login,activated) VALUES (NULL, '$username', '$password', '$mobile', '$email', '$activation_code', '$signup_date', '1','0')";
        $insertion_result = mysqli_query($connect, $in_temp_mem);
        //Comment Below line
//                        $insertion_result = 1;
        mysqli_close($connect);
        if($insertion_result){
//            Sending Mail through Include
            
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
            
            $require_path = "../";
            include $require_path.'includes/newsendmail.php';
            
//            $mail_sent = send_mail_from_dnr($email, $subject, $bodyContent);
            
            if($mail_sent!=TRUE){
                global $connect;
                $deletion_query = "DELETE FROM temp_members WHERE username='$username';";
                $deletion_result = mysqli_query($connect, $deletion_query);
                if($deletion_result){
//                    echo "Entry is Deleted";
                }
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail_sent->ErrorInfo;
            }else{
                echo '<script>
                    var $website = "#";
                    $(document).ajaxStop($.unblockUI);
                    setTimeout(function(){},3000);
                </script>';
                $mainMsg = "<div class='alert alert-success alert-dismissible show' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                <strong>Signed Up Successfully...!!!Please check your Email Account $email for activation of your account.</strong>.
                            </div>";
                echo 'Redirecting to Login Page in 10sec';
                header('Refresh:10; url=login.php');
            }
        }else{
            //Will occur only in case of problem with database
            $mainMsg.="Error in Signing Up. Please <a href='$mailToAdmin'>contact us</a>";
        }
    }else{
//                        echo '<span style="background: cyan">Some Error</span>';
//                        echo "<br/>user $e_user<br/>Password $e_pwd<br/>Mobile $e_mob<br/>Mail $e_mail<br/>";
    }
//                    echo "<p style='background: white;'> IN IFIFIFIFIFIF</p>";
} else {
//                    echo "<p style='background: yellow;'> IN ELSE</p>";
//                    echo $root.'includes/PHPMailer/PHPMailerAutoload.php';
    }
?>
            <span class="mainError error"><?php echo $mainMsg;?></span>
                <form id="signUp" role="form" action="" method="POST">
                    <div class="form-group">
                        <label for="username" class="required italic">Username&nbsp;
                            <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="<?=$i_user;?>"></span>
                        </label><br />
                        <div class="inner-addon right-addon">
                            <input id="username" name="username" class="form-control" type="text" placeholder="Desired Username" />
                            <i class="glyphicon glyphicon-user"></i>
                        </div>
                        <span class="error"><?=$name_msg;?></span>
                    </div>
                    <div class="form-group">
                        <label for="password" class="required italic">Password&nbsp;
                            <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="<?=$i_pwd;?>"></span>
                        </label><br />
                        <div class="inner-addon right-addon">
                            <input id="password" name="password" class="form-control" type="password" placeholder="Password">
                            <i class="glyphicon glyphicon-lock"></i>
                        </div>
                        <span class="error"><?=$pwd_msg;?></span>
                    </div>
                    <div class="form-group">
                        <label for="conf_password" class="required italic">Confirm Password&nbsp;
                            <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="<?=$i_conf_pwd;?>"></span>
                        </label><br />
                        <div class="inner-addon right-addon">
                            <input id="conf_password" name="conf_password" class="form-control" type="password" placeholder="Confirm Password">
                            <i class="glyphicon glyphicon-lock"></i>
                        </div>
                        <span class="error"><?=$conf_pwd_msg;?></span>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="required italic">Mobile No.&nbsp;
                            <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="<?=$i_mobile;?>"></span>
                        </label><br />
                        <div class="inner-addon right-addon">
                            <input id="mobile" name="mobile" class="form-control" type="text" placeholder="Mobile No.">
                            <i class="glyphicon glyphicon-earphone"></i>
                            <span class="error"><?=$mobile_msg;?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="required italic">Email ID&nbsp;
                            <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="<?=$i_email;?>"></span>
                        </label><br />
                        <div class="inner-addon right-addon">
                            <input id="email" name="email" class="form-control" type="email" placeholder="Enter your Mail Id" size="50">
                            <i class="glyphicon glyphicon-envelope"></i>
                            <span class="error"><?=$email_msg;?></span>
                        </div>
                    </div>
                    <input class="read_more btn btn-primary" type="submit" name="signUp" value="Sign Up">
                </form>
            </div>
        </div>
        <span class="vline"></span>
        <div class="col-md-5">
            <div class="form-container" style="margin-top: 25%;">
                <label style="">Already a Member? &nbsp;<a href="profile/login.php" style="font-size: 1.3em;">Log In</a></label>
            </div>
        </div>
        </div>
    </div>
    </div>
    <script><?=$errors;?></script>
    <script>
        $(window).bind("pageshow", function(){
            console.log("PAGESHOW");
            $("#username").val('');
//                $("#password").val('');
            $("#mobile").val('');
            $("#email").val('');
        });
    </script>
    </body>
</html>