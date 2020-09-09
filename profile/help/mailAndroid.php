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
$title = "Udaaan Portal | Help";
$page_heading = "<b>Configure Udaaan Mail to Gmail Android App</b>";
$extra_includes = '';
include $root.'includes/header.php';
//require_once 'auth.php';
//$step = $_GET['step'];
//if($step>=1 && $step<=10){
//    echo '<header style="text-align: center;"><h3>Step '.$step.'</h3></header>';
//    echo '<div class="container-fluid text-center" style="width: 60%">';
//    if($step != 1){
//        echo '<a href="profile/help/mailAndroid.php?step='.($step-1).'" class="btn btn-primary">Step '.($step-1).'</a>';
//    }
//    echo "<img src='images/help/mail/android/Step$step.png' width='500px'/>";
//    if($step != 10){
//        echo '<a href="profile/help/mailAndroid.php?step='.($step+1).'" class="btn btn-primary">Step '.($step+1).'</a>';
//    }
//    echo '</div>';
//    ?>


    <div id="steps" class="carousel slide" data-ride="carousel" data-interval="false">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php
            for($i=0; $i<10; $i++){
                $cl = "";
                if($i==0){
                    $cl = 'active';
                }
                echo "\n<li data-target='#steps' data-slide-to='$i' class='$cl'></li>";
            }
            ?>
        </ol>
        <!-- Wrapper for slides -->
        
        <div class="carousel-inner">
            <?php
            for($i=0; $i<10; $i++){
                $cl = "";
                if($i==0){
                    $cl = 'active';
                }
                $j=$i+1;
                $query_text = "SELECT * FROM help WHERE help='androidMail' AND step=$j";
                $help_data = get_data_from_table($query_text);
                $help_text = $help_data['text'];
                echo "\n\t\t\t<div class='item $cl'>
                <header style='text-align: center;'><h3>Step $j</h3></header>
                <img src='images/help/mail/android/Step$j.png' width='400px' alt='Step $j' style='margin: 0 auto;'>
                <div class='carousel-caption' style='background: rgba(3, 169, 244, 0.92); width:40%; margin: 0 auto; opacity:'>
                    <h3 style='color: black; font-weight: bold;'>Step $j</h3>
                    <p style='font-weight: bold;'>$help_text</p>
                </div>
            </div>";
            }
            ?>
        </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#steps" data-slide="prev" style="background-image: none;">
        <span class="glyphicon glyphicon-chevron-left carousel-button"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#steps" data-slide="next" style="background-image: none;">
      <span class="glyphicon glyphicon-chevron-right carousel-button"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
<?php
    echo "<br><br>";
    echo "<a class='btn mybtn bottom_btn' href='profile/help/help.php'>Go Back</a>";
    include $root.'includes/footer.php';