<?php

/*
 * Created By Udaaan Digital Team
 * Anurag/  11-Feb-2017 11:56:16 AM
 * All Rights Reserved (c)
 */
$root = '../';
include $root.'others/connect.php';
include $root.'others/functions.php';
include $root.'includes/accessControl.php';
$title = "Udaaan Portal | Attendance Management";
if($mem_org_level <= $allowed_level_for_attendance_insert){
    $page_heading = "You are allowed to view this. Coming Soon.";
}else{
    $page_heading = "Sorry...!! You are not authorized to view this page now.";
}
include $root.'includes/header.php';

if($mem_org_level <= $allowed_level_for_attendance_insert){
    $day = date('l');
    echo "<h1>The list of Members for $day </h1>
        <form method='POST'>";
    $db_day = strtolower($day);
    $timetable_query = "SELECT u.uid,u.fname,u.mname,u.lname FROM user_master as u INNER JOIN timetable as t ON u.uid = t.uid WHERE t.$db_day='1';";
    $get_mem = mysqli_query($connect, $timetable_query);
    while ($mem_on_duty = mysqli_fetch_assoc($get_mem)){
        $on_duty_mem = get_mem_name($mem_on_duty['fname'], $mem_on_duty['mname'], $mem_on_duty['lname']);
        echo '<input type="checkbox" id="on_duty_'.$mem_on_duty['uid'].'"><label>'.$on_duty_mem.'</label><br />';
    }
    echo '<label>Others </label><input type="text"><br /><br />
            <input type="submit" value="Submit Attendance" name="att_submit">
        </form>';
}
//echo $uid;
//echo '<br>';
//echo 'Welcome '.$mem_name."<br>";
//echo 'Gender is '.$mem_gender."<br>";
//echo 'Dob is '.$mem_dob."<br>";
//echo 'Department- '.$mem_department."<br>";
//echo 'Designation- '.$mem_designation."<br>";
//$designation_data = get_data_from_table('designation_master', 'designation', $mem_designation);
//echo "He is ".$designation_data['designation']."<br>";
//$org_level = $designation_data['org_level'];
?>
<?php
include $root.'includes/footer.php';