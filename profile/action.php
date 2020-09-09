<?php

/*
 * Created By Udaaan Digital Team
 * sinha_000/  23-Jul-2017 3:51:27 PM
 * All Rights Reserved (c)
 */
$noAuth = "You are not Authorised to view this page.<br>Will be redirected to Homepage in 3sec.";
if(isset($_GET['action'])){
    $action = $_GET['action'];
    $root = '../';
    include $root . 'others/connect.php';
    include $root . 'others/functions.php';
    include $root . 'includes/accessControl.php';
    $title = "Udaaan Portal | $action";
    $extra_includes = '';
    include $root.'includes/header.php';
    $approver = $uname;
//    View All
    if($action=='viewall'){
        if($mem_org_level<3){
            all_members();
        }else{
            echo $noAuth;
            header("Refresh:3; url=index.php");
        }
    }
//    Approve New Members
    elseif($action=='approval') {
        if($mem_org_level<3){
            approve_new_members($approver);
        }else{
            echo $noAuth;
            header("Refresh:3; url=index.php");
        }
    }
//    Request Mail
    elseif($action=='req_mail') {
        request_mail($uname);
    }
//    View Password
    elseif($action=='view_pwd') {
        if($_POST['mailPwd']){
            $entered_pwd = md5($_POST['checkpwd']);
            $query = "SELECT * FROM registered_members WHERE username='$uname';";
            $data=get_data_from_table($query);
            $user_pwd = $data['password'];
            if($user_pwd==$entered_pwd){
                $query_pwd = "SELECT * FROM additional WHERE uid='$mem_uid';";
                $fetched_data = mysqli_query($connect,$query_pwd);
                while ($mailPwd = mysqli_fetch_assoc($fetched_data)){
                    $req_pwd = $mailPwd['pwd'];
                    $req_mail = $mailPwd['email_id'];
                    echo "Password for your mail Id <b>$req_mail</b> is <b>$req_pwd</b><br>";
                }
            }else{
                view_mail_password($uname);
                echo "Sorry, passwords doesn't match";
            }
        }else{
            view_mail_password($uname);
        }
    }
//    Send Credentials of Registered Members
    elseif($action=='sendCreds') {
        if($uname=='admin'){
            send_mail_creds();
        }else{
            echo $noAuth;
            header("Refresh:3; url=index.php");
        }
    }
//    View TempMembers
    elseif($action=='view_temp') {
        if($uname=='admin'){
            echo 'Coming Soon. Will be redirected to Homepage in 3sec.';
            header("Refresh:1; url=index.php");
    //        view_temp_members();         //yet to be created
        }else{
            echo $noAuth;
            header("Refresh:3; url=index.php");
        }
    }
//    Modify Members Details
    elseif($action=='modify') {
        if($mem_org_level<3){
//        if($_POST['searchMember']){
//            $entered = $_POST['searchMem'];
//            if($entered==""){
//                modify_members();
//                echo "<div style='margin: -12% 32%;color: red;'>Please enter UID or Username</div>";
//            }else{
//                $found=FALSE;
//                $query = "SELECT * FROM user_master WHERE username='$entered';";
//                $data=get_data_from_table($query);
//                if($data){
//                    
//                }
//                if($user_pwd==$entered_pwd){
//                    $query_pwd = "SELECT * FROM additional WHERE uid='$mem_uid';";
//                    $mailPwd = get_data_from_table($query_pwd);
//                    $req_pwd = $mailPwd['pwd'];
//                    $req_mail = $mailPwd['email_id'];
//                    echo "Password for your mail Id <b>$req_mail</b> is <b>$req_pwd</b>";
//                }else{
//                    modify_members();
//                    echo "<div style='margin: -12% 32%;color: red;'>Sorry, No match found, Please try again</div>";
//                }
//            }
//        }else{
//            modify_members();
//        }
        echo "Under Construction";
        
//        modify_members();         //yet to be created
        }else{
            echo $noAuth;
            header("Refresh:3; url=index.php");
        }
    }elseif($action=='manage_credits') {
        if($mem_org_level<3){
            manage_credits();         //yet to be created
        }else{
            echo $noAuth;
            header("Refresh:3; url=index.php");
        }
    }elseif($action=='view_email_ids') {
        if($mem_org_level<3){
            view_email_ids();         //yet to be created
        }else{
            echo $noAuth;
            header("Refresh:3; url=index.php");
        }
    }else{
        echo 'Invalid action. Will be redirected to Homepage in 5sec.';
        header("Refresh:1; url=index.php");
    }
    echo "<a class='btn mybtn bottom_btn' href='index.php'>Go Back</a>";
    include $root . 'includes/footer.php';
}else{
    echo 'Invalid action. Will be redirected to Homepage in 5sec.';
    header("Refresh:1; url=index.php");
}