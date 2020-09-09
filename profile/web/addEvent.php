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
$page_heading = "<b>Add Events</b>";
$extra_includes = '';
include $root.'includes/header.php';
require_once 'auth.php';
if($authorized){
    echo $mem_org_level;
    if(isset($_POST['add'])){
        include_once $root.'others/connect1.php';
        $file_name = $_POST['file_name'];
        $date = $_POST['date'];
        $year = $_POST['year'];
        $title = $_POST['title'];
        $heading = $_POST['heading'];
        $content = $_POST['content'];
        $content = mysqli_real_escape_string($connect1, $content);
        $img_folder = $_POST['img_folder'];
        $venue = $_POST['venue'];
        $date = $_POST['date'];
        $year = $_POST['year'];
        $keywords = $_POST['keywords'];
        $add_event_query = "INSERT INTO events (id, file_name, date, year, title, heading, content, img_folder, venue, keywords) VALUES (NULL, '$file_name', '$date', '$year', '$title', '$heading', '$content', '$img_folder', '$venue', '$keywords');";
        if(mysqli_query($connect1, $add_event_query)){
            echo "Added";
            header('Refresh:2; url=events.php');
        }else{
            echo "Contact Admin";
        }
        mysqli_close($connect1);
    }
    else{
    ?>
<div class="container-fluid" style="width: 60%">
    <form id="addEvent" role="form" action="" method="POST">
        <div class="form-group">
            <label for="file_name" class="required">File Name(Max 2 character)</label>
            <input id="file_name" name="file_name" class="form-control" type="text" placeholder="File Name" />
        </div>
        <div class="form-group">
            <label for="date" class="required">Date(YYYY-MM-DD)</label>
            <input id="date" name="date" class="form-control" type="text" placeholder="Date of Event" />
        </div>
        <div class="form-group">
            <label for="year" class="required">Year</label>
            <input id="year" name="year" class="form-control" type="text" placeholder="Year of Event" />
        </div>
        <div class="form-group">
            <label for="title" class="required">Title</label>
            <input id="username" name="title" class="form-control" type="text" placeholder="Title of Event" />
        </div>
        <div class="form-group">
            <label for="heading" class="required">Heading</label>
            <input id="heading" name="heading" class="form-control" type="text" placeholder="Heading of Event" />
        </div>
        <div class="form-group">
            <label for="content" class="required">Content</label>
            <textarea class="form-control" rows="10" id="content" name="content" placeholder="Main Content for Event"></textarea>
        </div>
        <div class="form-group">
            <label for="img_folder" class="required">Image Folder</label>
            <input id="img_folder" name="img_folder" class="form-control" type="text" placeholder="Path of the Image folder" />
        </div>
        <div class="form-group">
            <label for="venue" class="required">Venue</label>
            <input id="venue" name="venue" class="form-control" type="text" placeholder="Venue of Event" />
        </div>
        <div class="form-group">
            <label for="keywords" class="required">Keywords</label>
            <input id="keywords" name="keywords" class="form-control" type="text" placeholder="Keywords seperated by Comma" />
        </div>
        <input class="read_more btn btn-primary" type="submit" name="add" value="Add Event">
    </form>
</div>
    <?php
    }
}else{
    include_once 'redirect.php';
}
echo "<br><br>";
echo "<a class='btn mybtn bottom_btn' href='profile/web/events.php'>Go Back</a>";
include $root.'includes/footer.php';