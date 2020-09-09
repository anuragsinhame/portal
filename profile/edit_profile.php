<?php

/*
 * Created By Udaaan Digital Team
 * Anurag/  17-Feb-2017 9:41:29 AM
 * All Rights Reserved (c)
 */
$root = '../';
include $root.'others/connect.php';
include $root.'others/functions.php';
//$first_login = false;
include $root.'includes/accessControl.php';
$insertion_success_msg = "<div class='alert alert-success alert-dismissible show' role='alert'>
           <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
           <span aria-hidden='true'>&times;</span>
           </button>
           <strong>Data Update Successfully...!!!</strong>.
       </div>";
//error_reporting(0);
$title = "Udaaan Portal | Edit Profile";
$page_heading = "<b>Edit Profile</b>";
$extra_includes='<script type="text/javascript" src="js/jquery.plugin.min.js"></script>
                <script type="text/javascript" src="js/jquery.datepick.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jquery.datepick.css">';
include $root.'includes/header.php';
$mainMsg = "";
$msg_to_be_displayed = "";
$editMsg = "";
if(!$mem_data['fcheck']){
    $editMsg.="Please enter the details first";
}
//if(null!= filter_input(INPUT_POST, 'upload_img')){
if(isset($_POST['upload_img'])){
    if($_FILES['profile_pic']['tmp_name']){
        $upload_msg = "";
        $img_name = $_FILES['profile_pic']['name'];
        $img_temp_path = $_FILES['profile_pic']['tmp_name'];
        $new_img_name = md5("Image".$uname."Udaaan");
        $upload_dir = "pics/";
        $img_size = $_FILES['profile_pic']['size'];
        $img_type = $_FILES['profile_pic']['type'];
        $img_error = $_FILES['profile_pic']['error'];
        $image_extension = pathinfo($_FILES["profile_pic"]["name"],PATHINFO_EXTENSION);
        if($img_error==0){
            if($img_type == "image/jpeg"){
                if($img_size < $profile_pic_max_size){
                    $new_img_name = strtolower($new_img_name.".".$image_extension);
                    $new_file_path = $upload_dir.$new_img_name;
                    if(move_uploaded_file($img_temp_path, $new_file_path)){
                        update_data('user_master', 'pic_name', $new_img_name, 'uid', $mem_uid);
                        $msg_to_be_displayed = $insertion_success_msg;
//                        header("refresh:2; url=edit_profile.php");
                    }else{
                        echo 'Some error in uploading';
                    }
                }else{
                    $upload_msg.="Image size should not exceed 500Kb";
                }
            }else{
                $upload_msg.="Uploaded image should be in .jpg/.jpeg format";
            }
        }else{
            $upload_msg.=$img_error;
        }
        echo $upload_msg;
    }else{
        echo "<script>alert('Please Select a image by clicking the image');</script>";
    }
}

//if(null!= filter_input(INPUT_POST, 'save_profile')){
if(isset($_POST['save_profile'])){
//    $mem_fname = filter_input(INPUT_POST, 'fname');
    $mem_fname = trim(mysqli_real_escape_string($connect,$_POST['fname']));
    $mem_mname = trim(mysqli_real_escape_string($connect,$_POST['mname']));
    $mem_lname = trim(mysqli_real_escape_string($connect,$_POST['lname']));
    $mem_gender = $_POST['gender'];
    $mem_dob = $_POST['dob'];
    $mem_father_name = trim(mysqli_real_escape_string($connect,$_POST['father_name']));
    $mem_mother_name = trim(mysqli_real_escape_string($connect,$_POST['mother_name']));
    $mem_address1 = trim(mysqli_real_escape_string($connect,$_POST['address1']));
    $mem_address2 = trim(mysqli_real_escape_string($connect,$_POST['address2']));
    $mem_city = trim(mysqli_real_escape_string($connect,$_POST['city']));
    $mem_state = trim(mysqli_real_escape_string($connect,$_POST['state']));
    $mem_pincode = trim(mysqli_real_escape_string($connect,$_POST['pincode']));
    $mem_country = trim(mysqli_real_escape_string($connect,$_POST['country']));
    if(!$mem_fname || !$mem_lname || !$mem_gender || !$mem_dob || !$mem_father_name || !$mem_address1
       || !$mem_city || !$mem_state || !$mem_pincode || !$mem_country){
        $mainMsg.="Please fill all the required fields!!";
    }elseif (!is_numeric($mem_pincode)) {
        $mainMsg.="PIN Code should be Numeric";
    }else {
        $profile_query = "UPDATE user_master SET fname='$mem_fname',mname='$mem_mname',lname='$mem_lname',gender='$mem_gender',"
        . "dob='$mem_dob',father_name='$mem_father_name',mother_name='$mem_mother_name',address1='$mem_address1',address2='$mem_address2',city='$mem_city',"
        . "state='$mem_state',pincode='$mem_pincode',country='$mem_country',fcheck=1 WHERE username='$uname';";
            
            if(mysqli_query($connect, $profile_query)){
//                Updation Successful
                $mainMsg = $insertion_success_msg;
                header("refresh:3; url=edit_profile.php");
            }else {
                echo "Please Contact <a href='$mailToAdmin'>Admin</a> with Below Error";
                echo "<br />".mysqli_errno($connect).":". mysqli_error($connect);
            }
        }
    }
?>

<!--TAKE CARE OF IMAGE RELOAD. MAY BE WITH CACHE FALSE-->
<!--TAKE CARE OF IMAGE RELOAD. MAY BE WITH CACHE FALSE-->
<!--TAKE CARE OF IMAGE RELOAD. MAY BE WITH CACHE FALSE-->
<!--TAKE CARE OF IMAGE RELOAD. MAY BE WITH CACHE FALSE-->


<div class="mainError error center_text"><?=$editMsg;?></div>
<div class="row border" style="width: 65%; margin: 0 auto;">
    <?=$msg_to_be_displayed;?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="col-sm-4 border">
            <div class="border" style="padding: 6%; text-align: center;">
            <?php
            if(!$mem_profile_pic){
                $mem_profile_pic="user.jpg";
            }
            echo "<img class='img-responsive center_margin mem_image' src='profile/pics/$mem_profile_pic?rand=".rand().";' width=200 max-height=200 style='margin-bottom: 10px;' />";
            ?>
                <label for="profile_pic" name="upload_image" class="img_overlay img-responsive">
                    Choose Image(Max Upload Size is 500kb)
                </label>
                <input id="profile_pic" class="btn btn-lg btn-success" type="file" name="profile_pic" style="display: none;">
            </div>
            <div class="border center_text btn-box">
                <input class="btn btn-primary" type="submit" name="upload_img" value="Upload Image" />
            </div>
        </div>
    </form>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="col-sm-8 border" style="">
            <div class='mem_details' style="margin-bottom: 30px; border-bottom: 5px double goldenrod;">
                <h3 class="">Welcome <b><?php echo $mem_name;?></b></h3>
                <h4>Designation : <b><?=$mem_designation;?></b></h4>
                <h4>Department : <b><?=$mem_department;?> Department</b></h4>
            </div>
            <span class="mainError error"><?=$mainMsg;?></span>
            <div style="padding: 5px;">
                <div class="row">
                    <div class="col-sm-4"><b>Udaaan Id</b></div>
                    <div class="col-sm-8"><input class="form-control" type="text" name="fname" value="<?=$udaaan_id;?>" disabled/></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>Username</b></div>
                    <div class="col-sm-8"><input class="form-control" type="text" name="fname" value="<?=$uname;?>" disabled/></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>First Name</b></div>
                    <div class="col-sm-8"><input class="form-control" type="text" name="fname" value="<?=$mem_fname;?>" /></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>Middle Name</b></div>
                    <div class="col-sm-8"><input class="form-control" type="text" name="mname" value="<?php echo $mem_mname;?>" /></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>Last Name</b></div>
                    <div class="col-sm-8"><input class="form-control" type="text" name="lname" value="<?php echo $mem_lname;?>" /></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>Gender</b></div>
                    <div class="col-sm-8">
                        <label class="radio-inline"><input type="radio" name="gender" <?=$mem_gender=="Male" ? "checked":""?> value="Male">Male</label>
                        <label class="radio-inline"><input type="radio" name="gender" <?=$mem_gender=="Female" ? "checked":""?> value="Female">Female</label>
                        <label class="radio-inline"><input type="radio" name="gender" <?=$mem_gender=="Other" ? "checked":""?> value="Other">Other</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>Date of Birth</b></div>
                    <div class="col-sm-8">
                        <input id="dob" class="form-control" type="text" name="dob" placeholder="Date of Birth(dd/mm/yyyy)" value="<?php echo $mem_dob;?>">
                        <script>
                            $(function(){
                                $('#dob').datepick({dateFormat: "yyyy-mm-dd"});
                            });
                        </script>
                        <span id="dob_msg"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>Father's Name</b></div>
                    <div class="col-sm-8"><input class="form-control" type="text" name="father_name" value="<?php echo $mem_father_name;?>"/></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>Mother's Name</b></div>
                    <div class="col-sm-8"><input class="form-control" type="text" name="mother_name" value="<?php echo $mem_mother_name;?>"/></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>Address Line1</b></div>
                    <div class="col-sm-8"><input class="form-control" type="text" name="address1" value="<?php echo $mem_address1;?>" /></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>Address Line2</b></div>
                    <div class="col-sm-8"><input class="form-control" type="text" name="address2" value="<?php echo $mem_address2;?>" /></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>City</b></div>
                    <div class="col-sm-8"><input class="form-control" type="text" name="city" value="<?php echo $mem_city;?>" /></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>State</b></div>
                    <div class="col-sm-8"><input class="form-control" type="text" name="state" value="<?php echo $mem_state;?>" /></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>Pincode</b></div>
                    <div class="col-sm-8"><input class="form-control" type="text" name="pincode" value="<?php echo $mem_pincode;?>" /></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>Country</b></div>
                    <div class="col-sm-8"><input class="form-control" type="text" name="country" value="<?php echo $mem_country;?>" /></div>
                </div>
            </div>
        </div>
        <div class="row" style="text-align:center; clear: both;">
            <input class="btn btn-primary" type="submit" name="save_profile" value="Save Data" style="width: 25%; margin-top: 30px; margin-bottom: 10px;"><br />
<!--            <a href="change_profile.php" style="clear: both; visibility: hidden;" class="btn btn-danger">Edit Email Id and Mobile No</a>
            <br /><br />
            <a class="btn btn-primary" href = 'profile/logout.php'>LogOut </a>-->
        </div>
    </form>
</div>
</div>
<?php
include $root.'includes/footer.php';
?>