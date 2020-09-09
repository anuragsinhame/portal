<?php

/*
 * Created By Udaaan Digital Team
 * Anurag/  17-Feb-2017 9:41:29 AM
 * All Rights Reserved (c)
 */
$root = '../';
include $root.$root.'others/connect.php';
include $root.$root.'others/functions.php';
include $root.$root.'includes/accessControl.php';
$title = "Udaaan Portal | Id Cards";
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script language="JavaScript" src="code39.js"></script>
    </head>
    <body>
        <div id="A4" style="width:210mm; height:297mm;">
        <?php
            $selected_table= "SELECT * FROM user_master as um, registered_members as rm,designation_master as dm WHERE um.uid=rm.uid AND um.designation_id=dm.designation_id AND um.designation_id<>1 ORDER BY um.uid;";
            $query= mysqli_query($connect, $selected_table);
            $designation= 'designation';
            $dob= 'dob';
            $mob_no= 'mobile';
            $issued_on= 'join_date';
            $pic= 'pic_name';
            $pg_count = 0;
            while ($fetch= mysqli_fetch_assoc($query)){
                if($pg_count<3){
                    $udaaan_id = conv_to_udaaanId($fetch['uid']);
                    $fname = $fetch['fname'];
                    $mname = $fetch['mname'];
                    $lname = $fetch['lname'];
                    $name = get_mem_name($fname, $mname, $lname);
                    echo "<div id='row'>
                <div id='front'>
                    <div id='logo' style='text-align: center;'><img src='logo.png' style='width:22%; height:22%; margin-top: 5px;'></div>
                    <div id='front_bottom'>
                        <div id='photo'>
                            <img src='../pics/$fetch[$pic]' style='width:25%; height:25%; margin: 0px -30px 0px 6px;'>
                            <ul style='display: inline-block; list-style: none; font-size: 14px;'>
                                <li><b>ID No:-</b> $udaaan_id</li>
                                <li><b>Name:-</b> $name</li>
                                <li><b>Designation:-</b> $fetch[$designation]</li>
                                <li><b>Date of Birth:-</b> $fetch[$dob]</li>
                                <li><b>Mobile:-</b> +91 $fetch[$mob_no]</li>
                                <li><b>Issued On:-</b> $fetch[$issued_on]</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id='back'>
                    <div id='holder_sign' style=''>
                        <img src='sign.jpg' id='sign' style='float: left;'/>
                        <img src='auth_sign.jpg' id='sign' style='float: right;'/>
                    </div>
                    <div id='auth_sign' style=''>
                        <div id='sign_text' style='float: left'><u>Signature of Holder</u></div>
                        <div id='sign_text' style='float: right'><u>Authorized Signature</u></div>
                    </div>
                    <div id='bar_code' style='clear: both; margin'>
                        <script language='JavaScript'>
                            Code39(200,300,35,10,'$udaaan_id',1.3);
                        </script>
                    </div>
                </div>
            </div>";
                    $pg_count+=1;
                }
                else{
                    $udaaan_id = conv_to_udaaanId($fetch['uid']);
                    $fname = $fetch['fname'];
                    $mname = $fetch['mname'];
                    $lname = $fetch['lname'];
                    $name = get_mem_name($fname, $mname, $lname);
                    echo "<div id='row'>
                <div id='front'>
                    <div id='logo' style='text-align: center;'><img src='logo.png' style='width:22%; height:22%; margin-top: 5px;'></div>
                    <div id='front_bottom'>
                        <div id='photo'>
                            <img src='../pics/$fetch[$pic]' style='width:25%; height:25%; margin: 0px -30px 0px 6px;'>
                            <ul style='display: inline-block; list-style: none; font-size: 14px;'>
                                <li><b>ID No:-</b> $udaaan_id</li>
                                <li><b>Name:-</b> $name</li>
                                <li><b>Designation:-</b> $fetch[$designation]</li>
                                <li><b>Date of Birth:-</b> $fetch[$dob]</li>
                                <li><b>Mobile:-</b> +91 $fetch[$mob_no]</li>
                                <li><b>Issued On:-</b> $fetch[$issued_on]</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id='back'>
                    <div id='holder_sign' style=''>
                        <img src='sign.jpg' id='sign' style='float: left;'/>
                        <img src='auth_sign.jpg' id='sign' style='float: right;'/>
                    </div>
                    <div id='auth_sign' style=''>
                        <div id='sign_text' style='float: left'><u>Signature of Holder</u></div>
                        <div id='sign_text' style='float: right'><u>Authorized Signature</u></div>
                    </div>
                    <div id='bar_code' style='clear: both; margin'>
                        <script language='JavaScript'>
                            Code39(200,300,35,10,'$udaaan_id',1.3);
                        </script>
                    </div>
                </div>
            </div>";
                    echo "</div><br />";
                    echo "<div id='A4' style='width:210mm; height:297mm;'>";
                    $pg_count = 0;
                }
            }
            if ($pg_count != 0){
                echo "</div>";
            }
           
        ?>
        
    </body>
</html>
