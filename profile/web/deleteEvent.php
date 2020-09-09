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
$page_heading = "<b>Delete Events</b>";
$extra_includes = '';
include $root.'includes/header.php';
require_once 'auth.php';
if($authorized){
    $event_id = $_GET['id'];
    include_once $root.'others/connect1.php';
    if(isset($_POST['delete'])){
        $del_event_query = "DELETE FROM events WHERE id=$event_id;";
        if(mysqli_query($connect1, $del_event_query)){
            echo "Event Deleted Successfully..!!<br/>Taking you back to Events";
            header('Refresh:2; url=events.php');
        }else{
            echo "Contact Admin";
        }
        mysqli_close($connect1);
    }
    else{
        $query = "SELECT * FROM events WHERE id=$event_id;";
        $fetch_event = mysqli_query($connect1, $query);
        if($fetch_event){
            $event_data= mysqli_fetch_assoc($fetch_event);
    ?>
<div class="container-fluid" style="width: 60%">
    <header style="text-align: center;"><h3><?=$event_data['title']?></h3></header>
    <form id="deleteEvent" role="form" action="" method="POST">
        <div class="form-group">
            <label for="title" class="required">Title</label>
            <input id="username" name="title" class="form-control" type="text" placeholder="Title of Event" value="<?=$event_data['title']?>" disabled/>
        </div>
        <div class="form-group">
            <label for="heading" class="required">Heading</label>
            <input id="heading" name="heading" class="form-control" type="text" placeholder="Heading of Event" value="<?=$event_data['heading']?>" disabled/>
        </div>
        <div class="form-group">
            <label for="content" class="required">Content</label>
            <textarea class="form-control" rows="5" id="content" name="content" disabled><?=$event_data['content']?></textarea>
        </div>
        <div class="form-group">
            <label for="img_folder" class="required">Image Folder</label>
            <input id="img_folder" name="img_folder" class="form-control" type="text" placeholder="Path of the Image folder" value="<?=$event_data['img_folder']?>" disabled/>
        </div>
        <div class="form-group">
            <label for="venue" class="required">Venue</label>
            <input id="venue" name="venue" class="form-control" type="text" placeholder="Venue of Event" value="<?=$event_data['venue']?>" disabled/>
        </div>
        <div class="form-group">
            <label for="keywords" class="required">Keywords</label>
            <input id="keywords" name="keywords" class="form-control" type="text" placeholder="Keywords seperated by Comma" value="<?=$event_data['keywords']?>" disabled/>
        </div>
        <div class="text-center text-danger">
            <label for="delete">Are You Sure? You want to Delete Event <i><?=$event_data['title']?></i></label><br>
            <input class="read_more btn btn-danger" type="submit" name="delete" value="Yes, Delete">
            <a class="read_more btn btn-success" href="profile/web/events.php">No, Go Back</a>
        </div>
    </form>
</div>
    <?php
        }else{
            echo 'Please contact admin';
        }
    }
}else{
    include_once 'redirect.php';
}
echo "<br><br>";
echo "<a class='btn mybtn bottom_btn' href='profile/web/events.php'>Go Back</a>";
include $root.'includes/footer.php';