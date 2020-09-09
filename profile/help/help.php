<?php

/*
 * Created By Udaaan Digital Team
 * Anurag/  28-Aug-2017 1:12:02 AM
 * All Rights Reserved (c)
 */
$root = '../../';
include $root.'others/connect.php';
include $root.'others/functions.php';
include $root.'includes/accessControl.php';
$title = "Udaaan Portal | Help";
$extra_includes = '';
include $root.'includes/header.php';
?>
<div class="container-fluid">
    <div class="row dashboard_parent">
        <div class="col-md-3 col-xs-6 dashboard" style="">
            <div class="panel panel-style">
                <div class="panel-heading">Configure Gmail Android App</div>
                <div class="panel-body with-footer text-center">
                    <img src="images/gmail.svg" width="100px" style="margin: 0 auto;"/>
                </div>
                <div class="panel-footer">
                    <a href='profile/help/mailAndroid.php'>View Steps</a>
                </div>
            </div>
        </div>
<!--        <div class="col-md-3 col-xs-6 dashboard" style="">
            <div class="panel panel-style">
                <div class="panel-heading">Projects</div>
                <div class="panel-body no-footer">
                    <a href='profile/web/manageWebsite.php' style="font-size: 24px; font-weight: bold;">Manage Projects</a>
                </div>
            </div>
        </div>-->
    </div>
</div>
<?php
echo "Will be available soon";
include $root.'includes/footer.php';