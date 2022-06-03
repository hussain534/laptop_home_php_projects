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
            <a href="courses.php"> <span class="glyphicon glyphicon-chevron-right"></span> Courses</a>
        </div>
        <div class="col-sm-1"></div>
    </div>  
    <br>
    <div class="row">
        <div class="col-sm-12 text-center"><h1>Manage Courses</h1></div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="row text-center">
                <div class="menu_back">
                    <a href="courses-classroom-admin.php" class="menu_icon"><img src="images/blackboard.png" class="logo_img_login"></a>
                    <br>
                    <p>Class Room</p>
                </div>
                <div class="menu_back">
                    <a href="courses-online-admin.php" class="menu_icon"><img src="images/webcourse.png" class="logo_img_login"></a>
                    <br>
                    <p>Online</p>
                </div>                
                <div class="menu_back">
                    <a href="courses-selfstudy-admin.php" class="menu_icon"><img src="images/selfstudy.png" class="logo_img_login"></a>
                    <br>
                    <p>Self Study</p>
                </div>
            </div>
        </div>
    </div>
   
</div>