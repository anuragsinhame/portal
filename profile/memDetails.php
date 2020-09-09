<?php

/*
 * Created By Udaaan Digital Team
 * sinha_000/  29-Jul-2017 6:00:45 PM
 * All Rights Reserved (c)
 */
$root = '../';
include $root . 'others/connect.php';
include $root . 'others/functions.php';
include $root.$root . 'includes/ajaxCookie.php';

$username = $_GET['mem'];

$extra_includes = '<style>
  .modal-header, h4, .close {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
  }
  </style>';
include $root.'includes/header.php';

$query="SELECT * FROM user_master as um, registered_members as rm, department_master as dm, designation_master as dsm WHERE um.username=rm.username AND um.username='$username' AND um.department_id=dm.dep_id AND um.designation_id=dsm.designation_id;";
$data= mysqli_query($connect, $query);
$mem = mysqli_fetch_assoc($data);
$member_name=get_mem_name($mem['fname'],$mem['mname'],$mem['lname']);
$ad_query="SELECT * FROM additional as ad, registered_members as rm WHERE rm.username='$username' AND rm.uid=ad.uid;";
$sel_ud_mail="";
$out = get_all_data_in_array($ad_query, 'email_id');
foreach ($out as $ud_mail){
    $sel_ud_mail.=$ud_mail."<br/>";
}
$sel_mobile = $mem['mobile'];
$sel_email = $mem['email'];
$sel_dep = $mem['department_name'];
$sel_des = $mem['designation'];
$sel_pic_name=$mem['pic_name'];
?>
<div class="container" style="width: 80%;">
    <div class="row modal-header" style="padding:35px 50px;">
        <div class="col-sm-12"><img src="profile/pics/<?=$sel_pic_name;?>" width=150></div>
        <div class="col-sm-12" style="font-size: 36px;"><?=$member_name?></div>
    </div>
    <div style="width:80%; margin: 0 auto;">
        <div class="row">
            <div class="col-xs-6 info">Mobile No</div>
            <div class="col-xs-6 info1"><?=$sel_mobile;?></div>
        </div>
        <div class="row">
            <div class="col-xs-6 info">Registered Email</div>
            <div class="col-xs-6 info1"><?=$sel_email;?></div>
        </div>
        <div class="row">
            <div class="col-xs-6 info">Udaaan Mail</div>
            <div class="col-xs-6 info1"><?=$sel_ud_mail;?></div>
        </div>
        <div class="row">
            <div class="col-xs-6 info">Department</div>
            <div class="col-xs-6 info1"><?=$sel_dep;?></div>
        </div>
        <div class="row" style="margin-bottom: 50px;">
            <div class="col-xs-6 info">Designation</div>
            <div class="col-xs-6 info1"><?=$sel_des;?></div>
        </div>
    </div>
</div>
<?php echo "<a class='btn mybtn bottom_btn' href='profile/action.php?action=viewall'>Go Back</a>";
include $root . 'includes/footer.php';?>