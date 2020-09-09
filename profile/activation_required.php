<?php

/*
 * Created By Udaaan Digital Team
 * Anurag/  11-Mar-2017 9:41:50 AM
 * All Rights Reserved (c)
 */
$root = '../';
include $root . 'others/connect.php';
include $root . 'others/functions.php';
include $root . 'includes/accessControl.php';
$navtext="ACTIVATION REQUIRED";
include $root . 'includes/header1.php';

$creds_check_temp = "SELECT * FROM temp_members WHERE username='$username' AND password='$password' AND activated='0';";
$user_data = get_data_from_table($creds_check_temp);
$temp_id = $user_data['temp_id'];
$username = $user_data['username'];
$email = $user_data['email'];
$act = $user_data['activation'];
$join_date = $user_data['signup_date'];

$interval = diff_in_dates($join_date, date("Y-m-d"));
$days_passed = $interval->format('%a');
$expiry_date = date("d M, Y", strtotime("$join_date +30days"));


echo "Dear <b>$username</b>,<br />Your account is not activated. ";
if($days_passed>=7){
    echo "Your activation link has expired.<br /><br />To send an activation link again to <b>$email</b>, please <span onclick=\"sendmail('$email','$username');\" style='font-weight: bold; cursor: pointer;'><u>click here</u></span>.<br/>"
            . "If you don't activate your account by <b>$expiry_date</b>, your account will be deleted.";
}elseif ($days_passed<7 && $days_passed>=0){
    echo "Please Check <b>$email</b> for activation link.<br /><br />You can <span onclick=\"sendmail('$email','$username');\" style='font-weight: bold; cursor: pointer;'>Click here</span> to send the activation Mail again.";
}
?>

<script>
    $insertion_success_msg = "<div class='alert alert-success alert-dismissible show' role='alert'>"+
                            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>"+
                            "<span aria-hidden='true'>&times;</span>"+
                            "</button><strong>Mail Sent Successfully...!!!</strong>.</div>";

    function sendmail(email,username){
//        $.blockUI({ message: '<h1><img src="busy.gif" /> Just a moment...</h1>' }); 
        $.blockUI({ message: '<h1> Sending mail to '+email+' ...</h1>' });
        $.ajax({
            type: 'POST',
            url: 'profile/ajax/sendActivationMail.php',
            data: 'email='+email+'&uname='+username,
            cache: false,
            success: function(data){
                $status = data;
                if(data==='Sent'){
                    console.log("Sent");
                    $("#username_msg").html("Available");
                }else{
                    console.log("Not Sent: "+ data);
                    $("#username_msg").html('<b>Already Taken</b>');
                }
            }
        });
        message = 'Mail Sent Successfully..!!';
        $(document).ajaxStop($.unblockUI);
//        setTimeout(function(){},3000);
        setTimeout(function(){
            window.location.href = $website+"profile/message.php?message="+message+"";
        },3000);
    }
</script>
<?php
include $root . 'includes/footer.php';
?>