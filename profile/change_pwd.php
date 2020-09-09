<?php

/*
 * Created By Udaaan Digital Team
 * sinha_000/  01-Apr-2017 4:36:39 PM
 * All Rights Reserved (c)
 */
$root = '../';
include $root . 'others/connect.php';
include $root . 'others/functions.php';
$code=$_GET['v_code'];
$verif_code = substr($code,1);
$tab = substr($code,0,1);
if($tab=="t"){
    $table_name="temp_members";
}elseif($tab=="r"){
    $table_name="registered_members";
}else{
    $table_name="";
}
//echo $verif_code;
$title="Change Password";
$page_heading="Change Password";
include $root . 'includes/header_small.php';
if($verif_code){
    $user_data = get_data_from_table("SELECT username,email FROM verification WHERE verif_code='$verif_code';");
    if(!$user_data){
        echo "Not Authorized";
        exit;
    }
}else{
    echo "Not Authorized";
    exit;
}
$username = $user_data['username'];
$email = $user_data['email'];
$pwd_msg = "";
$conf_pwd_msg = "";
$mainMsg = "";
$errors = "";
if(isset($_POST['change'])){
    $password = $_POST['password'];
    $conf_password = $_POST['conf_password'];
    if(!$password || !$conf_password){
        $mainMsg.="Please fill all the fields";
    }else{
        //validation for Password
        $len = strlen($password);
        if($len<8 || $len>15){
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
                    $update_pwd = mysqli_query($connect, "UPDATE $table_name SET password='$password' WHERE username='$username';");
                    if($update_pwd){
                        $delete = mysqli_query($connect, "DELETE FROM verification WHERE username='$username';");
                        $mainMsg = "<div class='alert alert-success alert-dismissible show' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                <strong>Password changed Successfully...!!!</strong>
                            </div>";
                        echo 'Redirecting to Login Page in 5sec';
                        header('Refresh:5; url=login.php');
                    }else{
                        $mainMsg = "<div class='alert alert-danger alert-dismissible show' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                <strong>Error in changing password...!!!<br>Please contact Admin.</strong>
                            </div>";
                    }
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
    }
}
echo "<span class='mainError error'>$mainMsg</span>";
?>
<form method="POST">
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
    <input class="form-control btn btn-primary" type="submit" name="change" value="Change Password">
</form>