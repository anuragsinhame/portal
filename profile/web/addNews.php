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
$page_heading = "<b>Add Recent News</b>";
$extra_includes = '';
include $root.'includes/header.php';
require_once 'auth.php';
if($authorized){
    if(isset($_POST['addNews'])){
        include_once $root.'others/connect1.php';
        $news = $_POST['title'];
        $content = $_POST['content'];
        $content = mysqli_real_escape_string($connect1, $content);
        $date = $_POST['date'];
        $link = $_POST['link'];
        $pic = $_POST['pic'];
        $add_news_query = "INSERT INTO recent_news (id, news, content, date, link, pic_name) VALUES (NULL, '$news', '$content', '$date', '$link', '$pic');";
        if(mysqli_query($connect1, $add_news_query)){
            echo "Added";
            header('Refresh:2');
        }else{
            echo "Contact Admin";
        }
        mysqli_close($connect1);
    }
    else{
    ?>
<div class="container-fluid" style="width: 60%">
    <form id="addNews" role="form" action="" method="POST">
        <div class="form-group">
            <label for="title" class="required">News Title</label>
            <input id="title" name="title" class="form-control" type="text" placeholder="News Title" />
        </div>
        <div class="form-group">
            <label for="content" class="required">Content</label>
            <textarea class="form-control" rows="5" id="content" name="content" placeholder="Content of News"></textarea>
        </div>
        <div class="form-group">
            <label for="date" class="required">Date(YYYY-MM-DD)</label>
            <input id="date" name="date" class="form-control" type="text" placeholder="Date for the News" />
        </div>
        <div class="form-group">
            <label for="link" class="required">Link to News(Fb/Twitter/Insta Link)</label>
            <input id="link" name="link" class="form-control" type="text" placeholder="Link to the News" />
        </div>
        <div class="form-group">
            <label for="pic" class="required">Pic Name</label>
            <input id="pic" name="pic" class="form-control" type="text" placeholder="Pic for News" />
        </div>
        <input class="read_more btn btn-primary" type="submit" name="addNews" value="Add News"><br><br>
    </form>
</div>
    <?php
    }
}else{
    include_once 'redirect.php';
}
echo "<br><br>";
echo "<a class='btn mybtn bottom_btn' href='profile/web/news.php'>Go Back</a>";
include $root.'includes/footer.php';