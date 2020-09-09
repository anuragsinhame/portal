<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$root = '../';
include $root.$root . 'others/connect.php';
include $root.$root . 'others/functions.php';
include $root.$root . 'includes/ajaxCookie.php';

$username = $_POST['uname'];
//echo $uname;

  $query="SELECT * FROM user_master as um, registered_members as rm, additional as ad, department_master as dm, designation_master as dsm WHERE um.username=rm.username AND um.username='$username' AND rm.uid=ad.uid AND um.department_id=dm.dep_id AND um.designation_id=dsm.designation_id;";
            $data= mysqli_query($connect, $query);
//            while($mem = mysqli_fetch_assoc($data)){
            $mem = mysqli_fetch_assoc($data);
            $member_name=get_mem_name($mem['fname'],$mem['mname'],$mem['lname']);
            echo '<br>'.$member_name."<br>";
            $sel_mobile = $mem['mobile'];
            echo $sel_mobile;
            $sel_email = $mem['email'];
            $sel_ud_mail = $mem['email_id'];
            $sel_dep = $mem['department_name'];
            $sel_des = $mem['designation'];
            $sel_pic_name=$mem['pic_name'];
  ?>
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" style="z-index: 10000;">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <?php
//            $query="SELECT * FROM user_master WHERE username='$username'";
//            $data= mysqli_query($connect, $query);
////            while($mem = mysqli_fetch_assoc($data)){
//            $mem = mysqli_fetch_assoc($data);
//            }
        ?>
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><img src="profile/pics/<?=$sel_pic_name;?>" width=100 style="float: left"><span style="float:right;"><?=$member_name?></span></h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
            <div class="table-responsive">
                <table class="table table-condensed" style="font-weight: bold;">
                    <tbody>
                        <tr>
                            <td>Mobile No</td>
                            <td><?=$sel_mobile;?></td>
                        </tr>
                        <tr>
                            <td>Registered Email</td>
                            <td><?=$sel_email;?></td>
                        </tr>
                        <tr>
                            <td>Udaaan Mail</td>
                            <td><?=$sel_ud_mail;?></td>
                        </tr>
                        <tr>
                            <td>Department</td>
                            <td><?=$sel_dep;?></td>
                        </tr>
                        <tr>
                            <td>Designation</td>
                            <td><?=$sel_des;?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
      
    </div>
  </div> 
</div>
 
<script>
$(document).ready(function(){
    $("#1").click(function(){
        $("#myModal").modal();
    });
});
</script>