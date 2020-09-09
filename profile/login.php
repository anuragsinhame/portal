<?php

/* 
 * Cerated By Udaaan Digital Team
 * Anurag/  30-Jan-2017 6:51:59 PM
 * All Rights Reserved (c)
 */
$root = '../';
include $root.'others/connect.php';
include $root.'others/functions.php';
//echo session_status();
//if(null!=filter_input(INPUT_COOKIE, 'u')){
if(isset($_COOKIE['u'])){
    header("location: index.php");
    exit;
}
$title="Login";
$page_heading="Login to Udaaan Portal";
include $root.'includes/header_small.php';
echo '<span class="mainError error"></span>';
//                if(null!=filter_input(INPUT_POST, 'login')){
if(isset($_POST['login'])){
    $username = trim(strtolower(mysqli_real_escape_string($connect, $_POST['username'])));
    $password = $_POST['password'];
    if($username == '' || $password == ''){
        echo "<script>$('.mainError').html('Please fill all the required fields');</script>";
    }else{
        echo "<script>$('.mainError').html('');</script>";
        $password = md5($password);
        $creds_check_registered = "SELECT * FROM registered_members WHERE username='$username' AND password='$password';";
        $creds_check_temp = "SELECT * FROM temp_members WHERE username='$username' AND password='$password';";
        if(get_num_rows($creds_check_registered) == 1){
            $user_data = get_data_from_table($creds_check_registered);
            $already_failed = $user_data['failed_attempts'];
            if($already_failed == $failed_attempts_allowed){
                echo "<br/>Your account is locked. Please contact<a href='$mailToAdmin'> Admin</a>";
            }else{
                update_data('registered_members', 'failed_attempts', 0, 'username', $username);
                $user_uid = $user_data['uid'];
                $user_mobile = $user_data['mobile'];
                $user_email = $user_data['email'];
                echo $user_uid.$username.$user_mobile.$user_email;
                if(null!=filter_input(INPUT_POST, 'remember')){
                    $cookie_new = time().$user_uid.'UD'.date();
                    setcookie('ud_cookie',$cookie_new,time()+60*60*24*2);
                }
                session_start();
                $last_login = date("Y-m-d h:i:s");
                update_data('registered_members', 'last_login', $last_login, 'uid', $user_uid);
                $temp_cookie = md5('UdaaanCookie'.$username.'for Temp');
                echo $temp_cookie.'<br />';
                setcookie('u',$temp_cookie,time()+$max_inactivity);
                $_SESSION['username']=$username;
                $_SESSION['password']=$password;
                header("location: index.php");
            }
        }else if(get_num_rows($creds_check_temp)==1){
            if(null!=filter_input(INPUT_POST, 'remember')){
                $cookie_new = time().$user_uid.'UD'.date();
                setcookie('ud_cookie',$cookie_new,time()+60*60*24*2);
            }
            $user_data = get_data_from_table($creds_check_registered);
            $activated=$user_data['activated'];
            $first_login=$user_data['first_login'];
            session_start();
            $temp_cookie = md5('UdaaanCookie'.$username.'for Temp');
//            echo $temp_cookie.'<br />';
            setcookie('u',$temp_cookie,time()+$max_inactivity);
            $_SESSION['username']=$username;
            $_SESSION['password']=$password;
            if($activated == 1){    //if account is activated
                header("location: approval_required.php");
            }else if($activated == 0){  //if not activated
                header("location: activation_required.php");
            }else{
                echo "Error: Contact Admin(admin@udaaan.org)";
            }
        }else {
            $lock_query = "SELECT * FROM registered_members WHERE username='$username';";
            if(get_num_rows($lock_query) == 1){
                $to_lock = get_data_from_table("SELECT * FROM registered_members WHERE username='$username';");
                if($to_lock['failed_attempts'] == $failed_attempts_allowed){
//                                    echo $to_lock['failed_attempts'].'<br/>';
                    echo "<br/>Your account is locked. Please contact<a href='$mailToAdmin'> Admin</a>";
                }else{
//                                    echo $to_lock['failed_attempts'].'<br/>';
                    update_data('registered_members', 'failed_attempts', $to_lock['failed_attempts']+1, 'username', $username);
                }
            }
            echo "<script>$('.mainError').html('Incorrect Credentials..!!');</script>";
        }
    }
}
?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username" class="required">Username</label><br />
                        <div class="inner-addon right-addon">
                            <input id="username" name="username" class="form-control" type="text" placeholder="Desired Username" />
                            <i class="glyphicon glyphicon-user"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="required">Password</label><a href='profile/forget_password.php' style="float: right;">forget password?</a><br />
                        <div class="inner-addon right-addon">
                            <input id="password" name="password" class="form-control" type="password" placeholder="Password">
                            <i class="glyphicon glyphicon-lock"></i>
                        </div>
                    </div>
                    <div class="checkbox">
                        <label for="remember" style="font-weight: bold;"><input class="" type="checkbox" name="remember" id="remember"/>Remember Me</label>
                    </div>
                    <input class="form-control btn btn-primary" type="submit" value="Login" name="login"/>
                </form>
            </div>
        </div>
        <span class="vline"></span>
        <div class="col-md-5">
            <div class="form-container" style="margin-top: 25%;">
                <label style="">Want to Join UDAAAN? &nbsp;<a href="profile/signup.php" style="font-size: 1.3em;">Sign Up</a></label>
            </div>
        </div>
        </div>
    </div>
    </div>
</body>
</html>