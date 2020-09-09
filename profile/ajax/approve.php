<?php

/*
 * Created By Udaaan Digital Team
 * Anurag/  09-Mar-2017 7:57:26 AM
 * All Rights Reserved (c)
 */
$root = '../';
include $root.$root . 'others/connect.php';
include $root.$root . 'others/functions.php';
include $root.$root . 'includes/ajaxCookie.php';

$uid = $_POST['uid'];
$approver = $_POST['approver'];
$assigned_dep = $_POST['dep'];
$assigned_des = $_POST['des'];

$dep_res = get_data_from_table("SELECT * FROM department_master WHERE department_name='$assigned_dep';"); //dep result
$assigned_dep_id = $dep_res['dep_id'];

$des_res = get_data_from_table("SELECT * FROM designation_master WHERE designation='$assigned_des';"); //des result
$assigned_des_id = $des_res['designation_id'];

$data_from_temp = get_data_from_table("SELECT * FROM temp_members WHERE temp_id='$uid';");
$temp_uname = $data_from_temp['username'];
$temp_pwd = $data_from_temp['password'];
$temp_mob = $data_from_temp['mobile'];
$temp_mail = $data_from_temp['email'];

$temp_fname = $data_from_temp['fname'];
$temp_mname = $data_from_temp['mname'];
$temp_lname = $data_from_temp['lname'];
$temp_pic_name = $data_from_temp['pic_name'];

if($temp_mail!=""){
    $join_date = date("Ymd");

    $last_uid = get_data_from_table('SELECT max(uid) as last_uid FROM registered_members');
    $new_uid=$last_uid['last_uid'];
    if($new_uid==NULL){ //for the first member in Database
        $new_uid=0;
    }
    $new_uid+=1; //new uid as previous max + 1

    $registered_insertion_query = "INSERT INTO registered_members (uid, username, password, mobile, email, failed_attempts, active, join_date, last_login, approved_by) VALUES ('$new_uid','$temp_uname','$temp_pwd','$temp_mob','$temp_mail','0','1','$join_date','$join_date','$approver');";
    //Insert into registered_members
    $registered_insertion = mysqli_query($connect, $registered_insertion_query);
    if($registered_insertion){
    //Insert into user_master
        $user_master_insertion_query = "INSERT INTO user_master "
        . "(username,fname,mname,lname,gender,dob,father_name,mother_name,department_id,designation_id,pic_name,address1,address2,city,state,pincode,country,fcheck) VALUES "
        . "('$temp_uname','$temp_fname','$temp_mname','$temp_lname','','','','','$assigned_dep_id','$assigned_des_id','$temp_pic_name','','','','','','','');";
        $user_master_insertion = mysqli_query($connect, $user_master_insertion_query);
        if($user_master_insertion){
            $temp_del_query = "DELETE FROM temp_members WHERE temp_id=$uid";
            $temp_deletion = mysqli_query($connect, $temp_del_query);
            if($temp_deletion){

//              Mail Details
                $subject = "Welcome To Udaaan Family || Account Approved";
                $bodyContent = "Dear $temp_fname,<br/>Your account with Udaaan Aasma Tak has been approved. Go to http://members.udaaan.org to login to your account.<br/><br/>Regards,<br/>Udaaan Admin";
                    
//              Configration
                $mail_username = "";
                $mail_password = "";
                $from_mail = "";
                $from_name = "";
                $to.=$temp_mail;
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
//                Mail Include End
            }else{
                echo 'Temp Deletion Failed';
            }
        }else{
            echo 'User Master insertion Failed';
        }
    }else{
        echo 'Registered Members insertion Failed';
    }
}else{
    echo 'Network Error';
}