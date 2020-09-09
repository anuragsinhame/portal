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
$page_heading = "<b>Delete Recent News</b>";
$extra_includes = '';
include $root.'includes/header.php';
require_once 'auth.php';
if($authorized){
    $news_id = $_GET['id'];
    include_once $root.'others/connect1.php';
    if(isset($_POST['delete'])){
        $del_news_query = "DELETE FROM recent_news WHERE id=$news_id;";
        if(mysqli_query($connect1, $del_news_query)){
            echo "News Deleted Successfully..!!<br/>Taking you back to News";
            header('Refresh:2; url=news.php');
        }else{
            echo "Contact Admin";
        }
        mysqli_close($connect1);
    }
    else{
        $query = "SELECT * FROM recent_news WHERE id=$news_id;";
        $fetch_news = mysqli_query($connect1, $query);
        if($fetch_news){
            $news_data= mysqli_fetch_assoc($fetch_news);
    ?>
<div class="container-fluid" style="width: 60%">
    <header style="text-align: center;"><h3><?=$news_data['news']?></h3></header>
    <form id="deleteNews" role="form" action="" method="POST">
        <div class="form-group">
            <label for="title" class="required">News Title</label>
            <input id="title" name="title" class="form-control" type="text" placeholder="News Title" value="<?=$news_data['news']?>" disabled/>
        </div>
        <div class="form-group">
            <label for="content" class="required">Content</label>
            <textarea class="form-control" rows="5" id="content" name="content" placeholder="Content of News" disabled><?=$news_data['content']?></textarea>
        </div>
        <div class="form-group">
            <label for="date" class="required">Date(YYYY-MM-DD)</label>
            <input id="date" name="date" class="form-control" type="text" placeholder="Date for the News"  value="<?=$news_data['date']?>" disabled/>
        </div>
        <div class="form-group">
            <label for="link" class="required">Link to News(Fb/Twitter/Insta Link)</label>
            <input id="link" name="link" class="form-control" type="text" placeholder="Link to the News" value="<?=$news_data['link']?>" disabled/>
        </div>
        <div class="form-group">
            <label for="pic" class="required">Pic Name</label>
            <input id="pic" name="pic" class="form-control" type="text" placeholder="Pic for News" value="<?=$news_data['pic_name']?>" disabled/>
        </div>
        <div class="text-center text-danger">
            <label for="delete">Are You Sure? You want to Delete this News <i><?=$news_data['title']?></i></label><br>
            <input class="read_more btn btn-danger" type="submit" name="delete" value="Yes, Delete">
            <a class="read_more btn btn-success" href="profile/web/news.php">No, Go Back</a>
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
echo "<a class='btn mybtn bottom_btn' href='profile/web/news.php'>Go Back</a>";
include $root.'includes/footer.php';