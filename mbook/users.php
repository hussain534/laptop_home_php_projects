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
            <a href="users.php"> <span class="glyphicon glyphicon-chevron-right"></span> Users</a>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12 text-center"><h1>Manage Users</h1></div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="row text-center">
                <div class="menu_back">
                    <a href="users-teacher-admin.php" class="menu_icon"><img src="images/teacher.png" class="logo_img_login"></a>
                    <br>
                    <p>Teachers</p>
                </div>
                <div class="menu_back">
                    <a href="users-student-admin.php" class="menu_icon"><img src="images/students.png" class="logo_img_login"></a>
                    <br>
                    <p>Students</p>
                </div>
            </div>
        </div>
    </div>
   
</div>