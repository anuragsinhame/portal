<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$root = '../../';
include $root.'others/connect.php';
include $root.'others/functions.php';
include $root.'includes/accessControl.php';
$title = "Welcome | Manage Udaaan Website";
$page_heading = "<b>Manage Udaaan Website</b>";
$extra_includes = '';
include $root.'includes/header.php';
require_once 'auth.php';
if($authorized){
    ?>
<div class="container-fluid">
    <div class="row dashboard_parent">
        <div class="col-md-3 col-xs-6 dashboard" style="">
            <div class="panel panel-style">
                <div class="panel-heading">Events</div>
                <div class="panel-body no-footer">
                    <a href='profile/web/events.php' style="font-size: 24px; font-weight: bold;">Manage Events</a>
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
        <div class="col-md-3 col-xs-6 dashboard" style="">
            <div class="panel panel-style">
                <div class="panel-heading">Recent News</div>
                <div class="panel-body no-footer">
                    <a href='profile/web/news.php' style="font-size: 24px; font-weight: bold;">Manage Recent News</a>
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
        </div>
        <div class="col-md-3 col-xs-6 dashboard" style="">
            <div class="panel panel-style">
                <div class="panel-heading">Projects</div>
                <div class="panel-body no-footer">
                    <a href='profile/web/manageWebsite.php' style="font-size: 24px; font-weight: bold;">Manage Projects</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-6 dashboard" style="">
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
}else{
    include_once 'redirect.php';
}
echo "<a class='btn mybtn bottom_btn' href='index.php'>Go Back</a>";
include $root.'includes/footer.php';
?>