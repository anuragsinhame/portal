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
$title = "Welcome | Manage Recent News";
$page_heading = "<b>Manage Recent News</b>";
$extra_includes = '';
include $root.'includes/header.php';
require_once 'auth.php';
if($authorized){
    ?>
<div class="container" style="text-align: center">
    <div class="row">
        <div class='col-sm-12 event-col'>
            <header><span>ADD A NEW NEWS</span></header>
            <div class="btn-info" style="padding: 1%; margin: 2%;"><a class="btn btn-info" href='profile/web/addNews.php' style='font-size:30px; font-weight:bold; valign'>Add Recent News</a></div>
        </div>
        <hr><hr>
        <div class='col-sm-12 event-col'>
            <header><span>DELETE OLD RECENT NEWS</span></header>
            <div class="row" style="text-align: center;">
            <?php
                include $root.'others/connect1.php';
                $query="SELECT * FROM recent_news ORDER BY id DESC LIMIT 10;";
                $data= mysqli_query($connect1, $query);
                while($news= mysqli_fetch_assoc($data)){
                    echo '<div class="col-sm-4 col-xs-12"><div class="btn-danger" style="padding: 5%; margin: 2%;"><a class="btn btn-danger" href="profile/web/deleteNews.php?id='.$news['id'].'">'.$news['news'].'</a></div></div>';
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