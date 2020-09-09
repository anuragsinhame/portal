<?php

/*
 * Created By Udaaan Digital Team
 * sinha_000/  30-Jul-2017 8:07:09 AM
 * All Rights Reserved (c)
 */
$root = '../';
$title = "Udaaan Portal | Send OfferLetter";
//variables to be defined
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?=$title;?></title>
    </head>
    <body style="margin: 0px;padding: 0px;clear: both;">
        <div id="A4" style="width:210mm; height:297mm; background: url('http://localhost/portal/images/lh150.jpg'); background-size: cover">
            <div class='heading' style="padding-top:65mm;text-align: center; font:1em Castellar;color: lightslategray;"><h1>WELCOME ABOARD</h1></div>
            <div class="body" style="padding: 5mm 10mm;">
                <span>Date: <b><?php echo date('F d, Y');?></b></span><br/><br/><br/>
                <span>Dear <b><?=$name;?></b>,</span><br/>
                <div style="text-align: center; font:1.5em monospace; color: #2196f3; margin-bottom: 1mm;">Welcome to Udaaan!</div>
                We are pleased to make you an offer to work with us at Udaaan Aasma Tak as <b>Senior Member</b>. Hope your innovative ideas and support will help us in giving the wings to the dreams of our organization.
                <br/>
                <div style="margin-top: 4mm;"><b>This offer is on following Terms and Conditions:</b>
                    <ul style="margin-top: 2mm;">
                        <li>All the rules must be followed strictly. Breaching the rules or acting in inconsistent manner will not be acceptable</li>
                        <li>For communication, hierarchy needs to be maintained.</li>
                        <li>All policies must be followed as per the norms.</li>
                        <li>Need to be available in the meetings, if not able due to any reasons then inform the host prior to the meeting.</li>
                    </ul>
                </div>
                <div style="margin-top: 4mm;"><b>Benifits entitled to:</b>
                    <ul>
                        <li>Government Authorized NGO certificate will be given as per the membership.</li>
                        <li>Appraisal will be done as per the Appraisal policy.</li>
                    </ul>
                </div>
                <div style="font: .9em Comic Sans MS; font-weight: bold; font-style: italic;color: blue;">"Good things come to people who wait, but better things come to those who go out and get them."</div>
                <div class="sign" style="margin-top: 10mm;">
                    Warm Regards,<br/>
                    <img src="../../images/sign.png" style="width: 25%;margin-left: -10px;"/><br/>
                    Prabha Tomar<br/>
                    Head - Human Resources
                </div>
            </div>
        </div>