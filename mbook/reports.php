<?php
    session_start();
    include_once('util.php');
    include_once('logopanel.php');
    if(isset($_GET["err"]))
        $err=$_GET["err"];
    else 
        $err=1;
?>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10  links text-right">
            <a href="home.php">Home</a>
            <a href="reports.php"> <span class="glyphicon glyphicon-chevron-right"></span> Reports</a>
        </div>
        <div class="col-sm-1"></div>
    </div>   
    <br>
    <div class="row">
        <div class="col-sm-12 text-center"><h1>Manage Reports</h1></div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="row text-center">
                <div class="menu_back">
                    <a href="report-progress-admin.php" class="menu_icon"><img src="images/progress-report.png" class="logo_img_login"></a>
                    <br>
                    <p>Progress Report</p>
                </div>
                <div class="menu_back">
                    <a href="report-certificates-admin.php" class="menu_icon"><img src="images/certificate.png" class="logo_img_login"></a>
                    <br>
                    <p>Certificates</p>
                </div>
                <div class="menu_back">
                    <a href="report-badges-admin.php" class="menu_icon"><img src="images/badge.png" class="logo_img_login"></a>
                    <br>
                    <p>Badges</p>
                </div>
            </div>
        </div>
    </div>
   
</div>