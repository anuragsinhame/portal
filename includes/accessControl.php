<?php

/* 
 * Created By Udaaan Digital Team
 * Anurag/  05-Feb-2017 10:26:53 PM
 * All Rights Reserved (c)
 */
//include_once $root.'others/connect.php';
//if(null!= filter_input(INPUT_COOKIE, 'u')){
$login_location = "location: ".$root."profile/login.php";
$dataFillingLocation = "location: ".$root."profile/edit_profile.php";
$approvalRequiredLocation = "location: ".$root."profile/approval_required.php";
$activationRequiredLocation = "location: ".$root."profile/activation_required.php";
$file_name = get_file_name($_SERVER['REQUEST_URI']);
if(isset($_COOKIE['u']) || isset($_COOKIE['ud_cookie'])){
    session_start();
    
//    $uname = null!=filter_input(INPUT_POST, 'username') ? filter_input(INPUT_POST, 'username') : $_SESSION['username'];
//      $pwd = null!=filter_input(INPUT_POST, 'password') ? filter_input(INPUT_POST, 'password') : $_SESSION['password'];
    $uname = isset($_POST['username']) ? $_POST['username'] : $_SESSION['username'];
      $pwd = isset($_POST['password']) ? $_POST['password'] : $_SESSION['password'];

//    echo $uname.'<br />';
//    echo $pwd.'<br /><br />';

    if(!isset($uname)){
        setcookie('u','', time()-3600);
        setcookie('ud_cookie','',time()-3600);
        header($login_location);
        exit;
    }else{
        $_SESSION['username'] = $uname;
        $_SESSION['password'] = $pwd;

        $creds_check_temp = "SELECT * FROM temp_members WHERE username='$uname' AND password='$pwd';";
        $creds_check_registered = "SELECT * FROM registered_members WHERE username='$uname' AND password='$pwd';";
        if(get_num_rows($creds_check_temp)==1){
            $data_from_temp = get_data_from_table($creds_check_temp);
            $activated = $data_from_temp['activated'];
            $first_login = $data_from_temp['first_login'];
            if($activated==0 && $file_name=="activation_required.php"){
                $username = $uname;
                $password = $pwd;
            }else if($activated==0 && $file_name!="activation_required.php"){
                header($activationRequiredLocation);
            }else if($activated==1 && $file_name!="approval_required.php"){
                header($approvalRequiredLocation);
            }
        }else if(get_num_rows($creds_check_registered)==1){
            $result = mysqli_query($connect, $creds_check_registered);
            if(!$result){
                error('A database error occurred while checking your '.
                'login details.\\nIf this error persists, please '.
                'contact <a href="mailTo:admin@udaaan.org">admin@udaaan.org</a>');
                exit;
            }
            if(mysqli_num_rows($result) == 0){
                unset($_SESSION['uname']);
                unset($_SESSION['password']);
                setcookie('u','', time()-3600);
                setcookie('ud_cookie','',time()-3600);
                echo "Access Denied. Go to <a href = '../profile/login.php'>login</a>";
                exit;
            }elseif (mysqli_num_rows($result) == 1) {
                $mem_data_query = "SELECT * FROM user_master WHERE username='$uname';";
                $mem_data = get_data_from_table($mem_data_query);
                if(!$mem_data['fcheck'] && $file_name!="edit_profile.php"){
                    header($dataFillingLocation);
                }else{
                    $mem_registered = get_data_from_table("SELECT * FROM registered_members WHERE username = '$uname';");   //added
                    if($mem_data){
                        $mem_uid = $mem_registered['uid'];
                        $udaaan_id = conv_to_udaaanId($mem_uid);
                        $mem_fname = $mem_data['fname'];
                        $mem_mname = $mem_data['mname'];
                        $mem_lname = $mem_data['lname'];
                        if($mem_mname == ""){
                            $mem_name = $mem_fname." ".$mem_lname;
                        }else{
                            $mem_name = $mem_fname." ".$mem_mname." ".$mem_lname;
                        }
                        $mem_gender = $mem_data['gender'];
                        $mem_dob = $mem_data['dob'];
                        $mem_father_name = $mem_data['father_name'];
                        $mem_mother_name = $mem_data['mother_name'];

                        $mem_dep = $mem_data['department_id'];                 //dep id
                        $dep_res = get_data_from_table("SELECT * FROM department_master WHERE dep_id='$mem_dep';"); //dep result
                        $mem_department = $dep_res['department_name'];      //department name

                        $mem_des = $mem_data['designation_id'];                //des id
                        $des_res = get_data_from_table("SELECT * FROM designation_master WHERE designation_id='$mem_des';");   //des result
                        $mem_designation = $des_res['designation'];         //designatin name

                        $mem_profile_pic = $mem_data['pic_name'];
                        $mem_address1 = $mem_data['address1'];
                        $mem_address2 = $mem_data['address2'];
                        $mem_city = $mem_data['city'];
                        $mem_state = $mem_data['state'];
                        $mem_pincode = $mem_data['pincode'];
                        $mem_country = $mem_data['country'];
                        $org_data = mysqli_query($connect,"SELECT * FROM designation_master WHERE designation='$mem_designation';");
                        $mem_org = mysqli_fetch_assoc($org_data);
                        $mem_org_level = $mem_org['org_level'];
                    }
                    else{
                        echo "User Not Found. Contact Admin";
                    }
                }
            }else{
//                echo "<h1>dsalkjadskjbfsasdda</h1>";
            }
        }else{
            echo "<h1>Access Denied</h1>";  //When user is manually deleted and was logged in
            header('Refresh:5; url=logout.php');    //will refresh after 5 and go to logout
        }
    }
    $temp_cookie = md5('UdaaanCookie'.$uname.'for Temp');
    setcookie('u',$temp_cookie,time()+$max_inactivity);    //will be logged in only for 1hour without any activity
}else{
    setcookie('u','', time()-3600);
    header($login_location);
    echo "You are not logged in. Please Login<br/><a href = '../profile/login.php'>login</a>";
    exit;
}