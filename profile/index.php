<?php

/* 
 * Created By Udaaan Digital Team
 * Anurag/  04-Feb-2017 4:29:57 PM
 * All Rights Reserved (c)
 */
$root = '../';
include $root.'others/connect.php';
include $root.'others/functions.php';
include $root.'includes/accessControl.php';
$title = "Welcome | Udaaan Portal";
$page_heading = "<b>".strtoupper($mem_fname)."'s Dashboard</b>";
$extra_includes = '';
include $root.'includes/header.php';

//Udaaan Mail Id Info Starts
$mailQuery = "SELECT * FROM additional WHERE uid='$mem_uid'";
$udaaan_mail = get_data_from_table($mailQuery);
$u_mail_id = $udaaan_mail['email_id'];
?>
<div class="container-fluid">
    <div class="row dashboard_parent">
        <header class="text-center">
            <h3>Your Details</h3>
        </header>
        <div class="col-md-3 col-xs-6 dashboard" style="">
            <div class="panel panel-style">
                <div class="panel-heading">Your Details</div>
                <div class="panel-body no-footer">
                    Udaaan Id: <?=$udaaan_id;?><br>
                    Username: <?=$uname;?><br>
                    Designation: <?=$mem_designation;?>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-6 dashboard" style="">
            <div class="panel panel-style">
                <div class="panel-heading">Your Details</div>
                <div class="panel-body with-footer">
                    <?php
                        if($udaaan_mail){
                            echo $u_mail_id;
                        }else{
                            echo 'Sorry you have not been assigned any email id yet. If your account was approved two days before, please send a mail to admin@udaaan.org';
                        }
                    ?>
                </div>
                <div class="panel-footer">
                    <?php
                        if($udaaan_mail){
                            echo '<a href="profile/action.php?action=view_pwd" class="">View Mail Password</a>';
                        }else{
                            echo '<a href="profile/action.php?action=req_mail" class="">Send Mail</a>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-6 dashboard" style="">
            <div class="panel panel-style">
                <div class="panel-heading">Logging Details</div>
                <div class="panel-body no-footer">
                    <?php
                        echo "Member Since: ";
                        $join_date = substr($mem_registered['join_date'],0,10);
                        $date = new DateTime($join_date);
                        $joined = $date->format("jS M Y");
                        echo $joined;
                        echo "<br>";
                        echo "Last Login: ";
                        $last_login = substr($mem_registered['last_login'],0,10);
                        $date = new DateTime($last_login);
                        $last = $date->format("jS M Y");
                        echo $last;
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-6 dashboard" style="">
            <div class="panel panel-style">
                <div class="panel-heading">Credits</div>
                <div class="panel-body no-footer">
                    Credit Points: Will be available soon
                    <br>
                    Points Required for next Level: Will be available soon
                </div>
            </div>
        </div>
    </div>


<?php
//Udaaan Mail Id Info Ends
if($uname=="admin"){
    ?>
    <!--Admin Actions-->
<div class="row dashboard_parent" style="">
    <header class="text-center">
        <h3>Admin Actions</h3>
    </header>
    <div class="col-md-3 col-xs-6 dashboard" style="">
        <div class="panel panel-style">
            <div class="panel-heading">Create Email Ids</div>
            <div class="panel-body with-footer">
                Create Email Ids of newly joined Members
            </div>
            <div class="panel-footer">
                <a href='profile/action.php?action=sendCreds' class=''>Send Emails</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xs-6 dashboard" style="">
        <div class="panel panel-style">
            <div class="panel-heading">Check Temporary Members</div>
            <div class="panel-body with-footer">
                Check temporary members in database
            </div>
            <div class="panel-footer">
                <a href='profile/action.php?action=view_temp' class=''>Temp </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xs-6 dashboard" style="">
        <div class="panel panel-style">
            <div class="panel-heading">Manage Udaaan Website</div>
            <div class="panel-body with-footer">
                Manage Udaaan Website
            </div>
            <div class="panel-footer">
                <a href='profile/web/manageWebsite.php' class=''>Manage</a>
            </div>
        </div>
    </div>
</div>
<?php
}
if($mem_org_level){
//    Actions
echo '<div class="row dashboard_parent" style="">
        <header class="text-center">
            <h3>For your Actions</h3>
        </header>';
        if($mem_org_level<4){
            echo '<div class="col-md-3 col-xs-6 dashboard" style="">
                        <div class="panel panel-style">
                            <div class="panel-heading">View Members</div>
                            <div class="panel-body with-footer">
                                View all the members who are registered on the portal
                            </div>
                            <div class="panel-footer">
                                <a href="profile/action.php?action=viewall" class="">View All Members</a>
                                <span><i class="fa fa-arrow-circle-right"></i></span>
                            </div>
                        </div>
                    </div>';
            if($mem_org_level<3){
                echo '<div class="col-md-3 col-xs-6 dashboard" style="">
                        <div class="panel panel-style">
                            <div class="panel-heading">Approve Members</div>
                            <div class="panel-body with-footer">
                                Approve Members and assign the Departments and Designations
                            </div>
                            <div class="panel-footer">
                                <a href="profile/action.php?action=approval" class="">Approve</a>
                            </div>
                        </div>
                    </div>';
                echo '<div class="col-md-3 col-xs-6 dashboard" style="">
                    <div class="panel panel-style">
                        <div class="panel-heading">Modify Member Details</div>
                        <div class="panel-body with-footer">
                            Modify members Designation and Departments
                        </div>
                        <div class="panel-footer">
                            <a href="profile/action.php?action=modify" class="">Modify</a>
                        </div>
                    </div>
                </div>';
                echo '<div class="col-md-3 col-xs-6 dashboard" style="">
                    <div class="panel panel-style">
                        <div class="panel-heading">Modify Credits</div>
                        <div class="panel-body with-footer">
                            Add or Delete Credits
                        </div>
                        <div class="panel-footer">
                            <a href="profile/action.php?action=manage_credits" class="">Manage Credits</a>
                        </div>
                    </div>
                </div>';
                echo '<div class="col-md-3 col-xs-6 dashboard" style="">
                    <div class="panel panel-style">
                        <div class="panel-heading">View Email Ids</div>
                        <div class="panel-body with-footer">
                            View All Mail Ids of registered members
                        </div>
                        <div class="panel-footer">
                            <a href="profile/action.php?action=view_email_ids" class="">View</a>
                        </div>
                    </div>
                </div>';
                if($mem_org_level<2){
                    echo '<div class="col-md-3 col-xs-6 dashboard" style="">
                        <div class="panel panel-style">
                            <div class="panel-heading">Print Offer Letter</div>
                            <div class="panel-body with-footer">
                                Send Offer Letters via Mail
                            </div>
                            <div class="panel-footer">
                                <a href="profile/ajax/sendOffer.php" class="">Print</a>
                            </div>
                        </div>
                    </div>';
                    echo '<div class="col-md-3 col-xs-6 dashboard" style="">
                        <div class="panel panel-style">
                            <div class="panel-heading">Generate I Card</div>
                            <div class="panel-body with-footer">
                                Generate and Print I cards
                            </div>
                            <div class="panel-footer">
                                <a href="profile/icard/">Generate Icard</a>
                            </div>
                        </div>
                    </div>';
                }
            }
        }
    echo "</div>
        </div>";
}else{
    echo "Error in retrieving Your Profile. Please contact admin.";    
    header("location: edit_profile.php");
}
include $root.'includes/footer.php';
?>