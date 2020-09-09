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
$title = "Welcome | Manage Events";
$page_heading = "<b>Manage Events</b>";
$extra_includes = '';
include $root.'includes/header.php';
require_once 'auth.php';
if($authorized){
    ?>
<div class="container" style="text-align: center">
    <div class="row">
        <div class='col-sm-12 event-col'>
            <header><span>ADD A NEW EVENT</span></header>
            <div class="btn-info" style="padding: 1%; margin: 2%;"><a class="btn btn-info" href='profile/web/addEvent.php' style='font-size:30px; font-weight:bold; valign'>Add Event</a></div>
        </div>
        <hr><hr>
        <div class='col-sm-12 event-col'>
            <header><span>MODIFY EXISTING EVENT</span></header>
            <div class="row" style="text-align: center;">
            <?php
                include $root.'others/connect1.php';
                $query="SELECT * FROM events ORDER BY id ASC;";
                $data= mysqli_query($connect1, $query);
                while($events= mysqli_fetch_assoc($data)){
                    echo '<div class="col-sm-4 col-xs-12"><div class="btn-success" style="padding: 5%; margin: 2%;"><a class="btn btn-success" href="profile/web/modify_events.php?id='.$events['id'].'">'.$events['title'].'</a></div></div>';
                }
            ?>
            </div>;
        </div><hr><hr>
        <div class='col-sm-12 event-col'>
            <header><span>DELETE AN EVENT</span></header>
            <div class="row" style="text-align: center;">
            <?php
                $query="SELECT * FROM events ORDER BY id ASC;";
                $data= mysqli_query($connect1, $query);
                while($events= mysqli_fetch_assoc($data)){
                    echo '<div class="col-sm-4 col-xs-12"><div class="btn-danger" style="padding: 5%; margin: 2%;"><a class="btn btn-danger" href="profile/web/deleteEvent.php?id='.$events['id'].'">'.$events['title'].'</a></div></div>';
                }
                mysqli_close($connect1);
            ?>
            </div>;
        </div>
    </div>
</div>
<?php
}else{
    include_once 'redirect.php';
}
echo "<a class='btn mybtn bottom_btn' href='profile/web/manageWebsite.php'>Go Back</a>";
include $root.'includes/footer.php';
?>