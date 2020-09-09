<?php

/* 
 * Cerated By Udaaan Digital Team
 * Anurag/  30-Jan-2017 7:07:55 PM
 * All Rights Reserved (c)
 */
//include_once '../others/connect.php';

error_reporting(0);

//Info Messages
$i_user = "Username can be of min 3 and max 20, should start with character and should not contain any space or special character";
$i_pwd = "Password must be of min 8 and max 15. Also it must contain a lowercase, an uppercase, a special char and a digit";
$i_conf_pwd = "Should match the password";
$i_mobile = "Should contain only digit and no need to add country code.";
$i_email = "A Valid email should be entered";

$description = '';
$keywords = '';
$title = '';
$extra_includes = '';
$max_inactivity = 3600; //login session will last only 1hr without any activity
$profile_pic_max_size = 512000;  //size in bytes
$failed_attempts_allowed = 5; //no. of failed attempts after which account will be locked
$allowed_level_for_attendance_insert = 3;
$mailToAdmin = "mailto:admin@udaaan.org";

$contains_space = '/\s/';                       //for username
$start_with_char = '/^[A-Za-z]/';               //for username
$contains_no_special_char_but_underscore = '/^[a-zA-Z0-9_]*$/'; //for username
$contains_no_special_char = '/^[a-zA-Z0-9]*$/'; //for pwd
$contains_digit = '/[0-9]/';                    //for pwd
$contains_lowercase = '/[a-z]/';                //for pwd
$contains_uppercase = '/[A-Z]/';                //for pwd
$contains_only_digit = '/^[0-9]{10}$/';         //mobile digit and length

function conv_to_udaaanId($userId){
    $max_length = 11;
    $required_zeros = $max_length-2-strlen($userId);
    $zeros = str_repeat('0', $required_zeros);
    $udaaan_id = 'UD'.$zeros.$userId;
    return $udaaan_id;
}

function get_data_from_table($query){
    global $connect;
//    $query = "SELECT * FROM $table WHERE $field='$value';";
    $result = mysqli_query($connect, $query);
    if($result){
        $data = mysqli_fetch_assoc($result);
//        mysqli_close($connect);
        return $data;
    }
    mysqli_close($connect);
}

function data_exists($value,$field_name,$table_name){
    global $connect;
    $query = "SELECT * FROM $table_name WHERE $field_name='$value';";
    $data = mysqli_query($connect, $query);
    $num_rows = mysqli_num_rows($data);
    if($num_rows == 1){
        return true;
    }else{
        return false;
    }
}

function update_data($table_name,$field_name,$value,$check_field,$check_value){
    global $connect;
    $query = "UPDATE $table_name SET $field_name='$value' WHERE $check_field='$check_value';";
    if(mysqli_query($connect, $query)){
        return true;
    }else{
        return false;
    }
}

function get_num_rows($query){
    global $connect;
    $data = mysqli_query($connect, $query);
    return(mysqli_num_rows($data));
}

function get_file_name($uri){
    $path = explode('/', $uri);
    $file_name_old = end($path);
    $new = explode('?', $file_name_old);    //for URIs having ? for get Methods
    $file_name = $new[0];
    return $file_name;
}

function get_mem_name($fname,$mname,$lname){
    if($mname == ""){
        $mem_name = $fname." ".$lname;
    }else{
        $mem_name = $fname." ".$mname." ".$lname;
    }
    return $mem_name;
}

function get_all_data_in_array($query,$col_name){
    global $connect;
    $result = mysqli_query($connect, $query);
    $all_elements = array();
    if($result){
        while($data = mysqli_fetch_assoc($result)){
            array_push($all_elements, $data[$col_name]);
        }
    }
    return $all_elements;
}

function approve_new_members($approver){
    global $connect;
    echo '<div id="box">';
    echo "<h1>Approve/Reject New Members</h1>";
    $tab_uid = "temp_id";
    $tab_uname = "username";
    $tab_pic = "pic_name";
    
//    Get all the Departments Name
    $dep_query = "SELECT * FROM department_master;";
    $dep_name = "department_name";
    $all_dep_name = get_all_data_in_array($dep_query, $dep_name);
    
//    Get all the Designations Name
    $des_query = "SELECT * FROM designation_master;";
    $des_name = "designation";
    $all_des_name = get_all_data_in_array($des_query, $des_name);
    
//    Get new members who have submitted their details
    $get_new_members = "SELECT * FROM temp_members WHERE submitted=1 ORDER BY temp_id ASC;";
    $fetch_new_members = mysqli_query($connect, $get_new_members);
    $count_mem = 0;
    
//    Get number of members to be approved
    $num_of_new_mem = mysqli_num_rows($fetch_new_members);
    if($num_of_new_mem != 0){
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered table-stripped" style="text-align: center; color:#fff; background: #0c7684; font-weight: bold;">
        <thead>
            <tr style="background: #fff; color:#000;">
                <th style="text-align: center;">Profile Pic</th>
                <th style="text-align: center;">Username</th>
                <th style="text-align: center;">Name</th>
                <th style="text-align: center;">Department</th>
                <th style="text-align: center;">Designation</th>
                <th style="text-align: center;">Approval Status</th>
            </tr>
        </thead><tbody>';
        while($data = mysqli_fetch_assoc($fetch_new_members)){
            $count_mem+=1;
            $mem_name = get_mem_name($data['fname'], $data['mname'], $data['lname']);
            echo '<tr>
                    <td><img src="profile/pics/'.$data[$tab_pic].'" width=100></td>
                    <td>'.$data[$tab_uname].'</td>
                    <td>'.$mem_name.'</td>
                    <td><select class="btn btn-danger" id="'.$data[$tab_uid].'_dep">';
            foreach ($all_dep_name as $value){
                echo '<option>'.$value.'</option>';
            }
            echo '</select>
                </td>
                <td><select class="btn btn-danger" id="'.$data[$tab_uid].'_des">';
            foreach ($all_des_name as $value){
                echo '<option>'.$value.'</option>';
            }
            echo '</select>
                </td>
                <td>
                    <input class="btn btn-success" type="button" name="approval['.$count_mem.']" value="Approve" onClick="approve('.$data[$tab_uid].',\''.$approver.'\');">&nbsp;&nbsp;&nbsp;
                    <input class="btn btn-danger" type="button" name="reject['.$count_mem.']" value="Reject" onClick="reject('.$data[$tab_uid].',\''.$approver.'\');">
                </td>
            </tr>';
        }
    }else if($num_of_new_mem == 0){
        echo 'Hurray....!! Nothing to Approve Now.';
    }
    echo "</tbody></table></div>";
}

function all_members(){
    global $connect;
    echo '<div id="box">';
    echo "<h1>Viewing all the Registerd Members</h1>";
    $tab_uid = "uid";
    $tab_uname = "username";
    $tab_mobile = "mobile";
    $tab_email = "email";
    $tab_gender = "gender";
    $tab_mother = "mother_name";
    $tab_father = "father_name";
    $tab_pic = "pic_name";
    $dep_name = "department_name";
    $des_name = "designation";
    $get_new_members = "SELECT * FROM registered_members as rm,user_master as um,department_master as dep,designation_master as des WHERE rm.username=um.username AND um.department_id = dep.dep_id AND um.designation_id = des.designation_id ORDER BY rm.uid;";
    $fetch_new_members = mysqli_query($connect, $get_new_members);
    $count_mem = 0;
//    Get number of members to be approved
    $num_of_new_mem = mysqli_num_rows($fetch_new_members);
    if($num_of_new_mem != 0){
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered table-stripped" style="text-align: center; color:#fff; background: #0c7684; font-weight: bold;">
        <thead>
            <tr style="background: #fff; color:#000;">
                <th style="text-align: center;">Profile Pic</th>
                <th style="text-align: center;">UID</th>
                <th style="text-align: center;">Name</th>
                <th style="text-align: center;">Gender</th>
                <th style="text-align: center;">Mother Name</th>
                <th style="text-align: center;">Father Name</th>
                <th style="text-align: center;">Department</th>
                <th style="text-align: center;">Designation</th>
            </tr>
        </thead>';
        while($data = mysqli_fetch_assoc($fetch_new_members)){
            if($data[$tab_uid]!="1"){
                $count_mem+=1;
                $mem_name = get_mem_name($data['fname'], $data['mname'], $data['lname']);
                $pic = $data[$tab_pic];
                if(!$pic){
                    $pic = "user.jpg";
                }
                echo '<tr>
                        <td><img src="profile/pics/'.$pic.'" width=100></td>
                        <td>'.$data[$tab_uid].'</td>
                        <td><a href="profile/memDetails.php?mem='.$data[$tab_uname].'" style="color: #ff1">'.$mem_name.'</button></td>
                        <td>'.$data[$tab_gender].'</td>
                        <td>'.$data[$tab_mother].'</td>
                        <td>'.$data[$tab_father].'</td>
                        <td>'.$data[$dep_name].'</td>
                        <td>'.$data[$des_name].'</td></tr>';
            }
        }
    }else if($num_of_new_mem == 0){
        echo 'Wooopss....!! No Members Now.';
    }
    echo "</table></div>";
}

//To get the difference in two dates
function diff_in_dates($old_date, $new_date){
//    $new_date = date("Y-m-d");
    $datetime1 = date_create($old_date);
    $datetime2 = date_create($new_date);
    $interval = date_diff($datetime1, $datetime2);
    // '%y Year %m Month %d Day %h Hours %i Minute %s Seconds'        =>  1 Year 3 Month 14 Day 11 Hours 49 Minute 36 
//    $days_passed = $interval->format('%a');
    return $interval;
}




//////////////////////        Action Functions        /////////////////////////
function view_mail_password($username){
    echo '<form method="POST" action="/profile/action.php?action=view_pwd" style="width:40%; margin: 0 auto;">
            <label for="checkpwd" class="required italic">Enter Your Password&nbsp</label>
            <input id="checkpwd" name="checkpwd" class="form-control" type="password" placeholder="Password" />
            <input type="submit" class="btn btn-primary" name="mailPwd" onClick="" style="margin-top: 5px; float: right;">
        </form>';
}

function send_mail_creds(){
    global $connect;
    $query_remaining = "SELECT * FROM registered_members WHERE uid NOT IN (SELECT uid FROM additional);";
    $fetch_remaining = mysqli_query($connect, $query_remaining);
    $num_of_remaining = mysqli_num_rows($fetch_remaining);
    $tab_uname = "username";
    $tab_uid = "uid";
    if($num_of_remaining != 0){
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered table-stripped" style="text-align: center; color:#fff; background: #0c7684; font-weight: bold;">
        <thead>
            <tr style="background: #fff; color:#000;">
                <th style="text-align: center;">User Id</th>
                <th style="text-align: center;">Email Id</th>
                <th style="text-align: center;">Password</th>
                <th style="text-align: center;">Send Mail</th>
            </tr>
        </thead><tbody>';
        while($data = mysqli_fetch_assoc($fetch_remaining)){
            echo '<tr>
                    <td>'.$data[$tab_uname].'</td>
                    <td><input type="text" id="'.$data[$tab_uname].'_mail" name="mailName" class="btn-danger" value='.$data[$tab_uname].'@udaaan.org></td>
                    <td><input type="password" id="'.$data[$tab_uname].'_pwd" name="mailPassword" class="btn-danger"></td>
                    <td>
                        <input class="btn btn-success" type="button" name="['.$data[$tab_uname].'_mail]" value="Send Mail" onClick="createMail(\''.$data[$tab_uname].'\','.$data[$tab_uid].');">
                    </td>
                </tr>';
        }
    }else if($num_of_remaining == 0){
        echo 'Hurray....!! Nothing to Approve Now.';
    }
    echo "</tbody></table></div>";
}

function request_mail($username){
//    Mail Details
    $subject = "Create || Udaaan Mail Id";
    $bodyContent = "Create Mail id for <b>$username</b><br><br>Regards,<br>Udaaan Digital Team";
//            Configration
    $mail_username = "";
    $mail_password = "";
    $from_mail = "";
    $from_name = "";
    $to.='admin@udaaan.org';
    $cc = "";
    $bcc = "";
    $require_path = "../";
    include $require_path.'includes/newsendmail.php';
    if($mail_sent!=TRUE){
        echo 'Message could not be sent. Please send mail to admin@udaaan.org';
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
                        <strong>Request Sent Successfully...!!!</strong>.
                    </div>";
        echo $mainMsg;
    }
}


function modify_members(){
    echo '<form method="POST" action="/profile/action.php?action=modify" style="width:40%; margin: 0 auto;">
            <label for="searchMem" class="required italic">Enter UID or Username of Member&nbsp</label>
            <input id="searchMem" name="searchMem" class="form-control" type="text" placeholder="UID or Username" />
            <input type="submit" class="btn btn-primary" name="searchMember" value="Search" style="margin-top: 5px; float: right;">
        </form>';
}

function manage_credits(){
    echo "Will be available soon...!!";
}

function view_email_ids(){
    global $connect;
    echo '<div id="box">';
    echo "<h1>Contact Details of all the Registerd Members</h1>";
    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered table-stripped" style="text-align: center; color:#fff; background: #0c7684; font-weight: bold;">
    <thead>
        <tr style="background: #fff; color:#000;">
            <th style="text-align: center;">Profile Pic</th>
            <th style="text-align: center;">UID</th>
            <th style="text-align: center;">Name</th>
            <th style="text-align: center;">Mobile</th>
            <th style="text-align: center;">Registered Mail</th>
            <th style="text-align: center;">Udaaan Mail</th>
        </tr>
    </thead>';
    $query="SELECT * FROM user_master as um, registered_members as rm WHERE um.username=rm.username ORDER BY rm.uid;";
    $data= mysqli_query($connect, $query);
    while ($mem = mysqli_fetch_assoc($data)){
        $member_name=get_mem_name($mem['fname'],$mem['mname'],$mem['lname']);
        $sel_username= $mem['username'];
        $ad_query="SELECT * FROM additional as ad, registered_members as rm WHERE rm.username='$sel_username' AND rm.uid=ad.uid;";
        $sel_ud_mail="";
        $out = get_all_data_in_array($ad_query, 'email_id');
        foreach ($out as $ud_mail){
            $sel_ud_mail.=$ud_mail."<br/>";
        }
        if($sel_ud_mail==""){
            $sel_ud_mail="<span style='color:orange'>Not Assigned</span>";
        }
        $sel_mobile = $mem['mobile'];
        $sel_email = $mem['email'];
        $sel_uid = $mem['uid'];
        $sel_pic_name=$mem['pic_name'];
        if(!$sel_pic_name){
            $sel_pic_name = "user.jpg";
        }
        echo '<tr>
                <td><img src="profile/pics/'.$sel_pic_name.'" width=100></td>
                <td>'.$sel_uid.'</td>;
                <td><a href="profile/memDetails.php?mem='.$sel_username.'" style="color: #ff1">'.$member_name.'</button></td>
                <td>'.$sel_mobile.'</td>
                <td>'.$sel_email.'</td>
                <td>'.$sel_ud_mail.'</td></tr>';
    }
    echo "</table></div>";
}


//Website Managing Functions Starts
function addEvent(){
    
}

//Website Managing Functions Ends