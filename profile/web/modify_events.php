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
$page_heading = "<b>Update Events</b>";
$extra_includes = '';
include $root.'includes/header.php';
require_once 'auth.php';
if($authorized){
    include_once $root.'others/connect1.php';
    $event_id = $_GET['id'];
    if(isset($_POST['update'])){
        $title = $_POST['title'];
        $heading = $_POST['heading'];
        $content = $_POST['content'];
        $content = mysqli_real_escape_string($connect1, $content);
        $img_folder = $_POST['img_folder'];
        $venue = $_POST['venue'];
        $date = $_POST['date'];
        $year = $_POST['year'];
        $keywords = $_POST['keywords'];
        $up_event_query = "UPDATE events SET title='$title', heading='$heading', content='$content', img_folder='$img_folder', venue='$venue', keywords='$keywords' WHERE id=$event_id;";
        if(mysqli_query($connect1, $up_event_query)){
            echo "Updated";
            header('Refresh:2');
        }else{
            echo mysqli_error($connect1);
            echo "Contact Admin";
        }
    }else{
        $query = "SELECT * FROM events WHERE id=$event_id;";
        $fetch_event = mysqli_query($connect1, $query);
        if($fetch_event){
            $event_data= mysqli_fetch_assoc($fetch_event);
    ?>
<div class="container-fluid" style="width: 60%">
    <header style="text-align: center;"><h3><?=$event_data['title']?></h3></header>
    <form id="update" role="form" action="" method="POST">
        <div class="form-group">
            <label for="title" class="required">Title</label>
            <input id="username" name="title" class="form-control" type="text" placeholder="Title of Event" value="<?=$event_data['title']?>"/>
        </div>
        <div class="form-group">
            <label for="heading" class="required">Heading</label>
            <input id="heading" name="heading" class="form-control" type="text" placeholder="Heading of Event" value="<?=$event_data['heading']?>"/>
        </div>
        <div class="form-group">
            <label for="content" class="required">Content</label>
            <textarea class="form-control" rows="10" id="content" name="content" placeholder="Main Content for Event"><?=$event_data['content']?></textarea>
        </div>
        <div class="form-group">
            <label for="img_folder" class="required">Image Folder</label>
            <input id="img_folder" name="img_folder" class="form-control" type="text" placeholder="Path of the Image folder" value="<?=$event_data['img_folder']?>"/>
        </div>
        <div class="form-group">
            <label for="venue" class="required">Venue</label>
            <input id="venue" name="venue" class="form-control" type="text" placeholder="Venue of Event" value="<?=$event_data['venue']?>"/>
        </div>
        <div class="form-group">
            <label for="keywords" class="required">Keywords</label>
            <input id="keywords" name="keywords" class="form-control" type="text" placeholder="Keywords seperated by Comma" value="<?=$event_data['keywords']?>"/>
        </div>
        <input class="read_more btn btn-primary" type="submit" name="update" value="Update Event">
    </form>
</div>
    <?php
        }else{
            echo 'Please contact admin.';
        }
    }
}else{
    include_once 'redirect.php';
}
echo "<br><br>";
echo "<a class='btn mybtn bottom_btn' href='profile/web/events.php'>Go Back</a>";
include $root.'includes/footer.php';