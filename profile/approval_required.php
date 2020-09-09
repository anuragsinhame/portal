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
if($mem_uid){
    header("location: index.php");
    exit;
}
$navtext="PROFILE NOT CREATED";
include $root . 'includes/header1.php';
$submitted = $data_from_temp['submitted'];
$activated = $data_from_temp['activated'];
if($submitted==1){
    echo '<div class="text-center text-warning" style="font: 2em comic sans ms">Your account is activated and your below data has been submitted for approval from an Authorized Person.</div>';
    $mem_profile_pic = md5("Image".$uname."Udaaan").'.jpg';
?>
<br/><br/>
<table class="table table-bordered table-responsive center_margin text-center" style="width: 50%; background: #08b4c8;">
    <thead>
        <tr style="background: #ddd">
            <th style="text-align: center;">Image</th>
            <th style="text-align: center;">First Name</th>
            <th style="text-align: center;">Middle Name</th>
            <th style="text-align: center;">Last Name</th>
        </tr>
    </thead>
    <tr class="valign" style="color: #fff;font-size:1.5em">
        <td><img src="profile/pics/<?=$mem_profile_pic;?>" width=200 max-height=200 style='margin-bottom: 10px;'></td>
        <td><?=$data_from_temp['fname'];?></td>
        <td><?=$data_from_temp['mname'];?></td>
        <td><?=$data_from_temp['lname'];?></td>
    </tr>
</table>
<?php
}else{
    $mem_uname=$data_from_temp['username'];
    echo '<span class="text-warning">Your account is activated but your profile is not approved yet. Please fill the below details and submit. After this it will take maximum of 2 day to get your profile approved.</span><br /><br />';
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
                            update_data('temp_members', 'pic_name', $new_img_name, 'username', $uname);
                            $msg_to_be_displayed = $insertion_success_msg;
                            header("refresh:0; url=edit_profile.php");
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
    if(isset($_POST['save_profile'])){
        $mem_fname = trim(mysqli_real_escape_string($connect,$_POST['fname']));
        $mem_mname = trim(mysqli_real_escape_string($connect,$_POST['mname']));
        $mem_lname = trim(mysqli_real_escape_string($connect,$_POST['lname']));
        if(!$mem_fname || !$mem_lname){
            $mainMsg.="Please fill all the required fields!!";
        }else{
            if($data_from_temp['pic_name']!="user.jpg" && $data_from_temp['pic_name']!=""){
                $update_temp = "UPDATE temp_members SET fname='$mem_fname',mname='$mem_mname',lname='$mem_lname',submitted='1' WHERE username='$mem_uname';";
                if(mysqli_query($connect, $update_temp)){
    //                Updation Successful
                    $mainMsg = $insertion_success_msg;
                    header("refresh:1; url=edit_profile.php");
                }else{
                    echo "Please Contact <a href='$mailToAdmin'>Admin</a> with Below Error";
                    echo "<br />".mysqli_errno($connect).":". mysqli_error($connect);
                }
            }else{
                $mainMsg.='Please upload your pic first';
            }
        }
    }
?>
<div class="row border" style="width: 65%; margin: 0 auto;">
    <?=$msg_to_be_displayed;?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="col-sm-4 border">
            <div class="border" style="padding: 6%; text-align: center; padding-top: 45px;">
            <?php
            $mem_profile_pic = $data_from_temp['pic_name'];
            echo "<img class='img-responsive center_margin mem_image' src='profile/pics/$mem_profile_pic' width=200 max-height=200 style='margin-bottom: 10px;' />";
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
                <h3 class="text-center">Welcome <b><?php echo $mem_uname;?></b></h3>
            </div>
            <span class="mainError error"><?=$mainMsg;?></span>
            <div style="padding: 5px;">
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
                <div class="row" style="text-align:center; clear: both;">
                    <input class="btn btn-primary" type="submit" name="save_profile" value="Submit for Approval" style="width: 30%; margin-top: 30px; margin-bottom: 10px;">
                </div>
            </div>
        </div>
    </form>
</div>
<?php
}
    include $root . 'includes/footer.php';
?>