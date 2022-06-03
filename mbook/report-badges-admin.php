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
            <a href="report-badges-admin.php"> <span class="glyphicon glyphicon-chevron-right"></span> Badges</a>
        </div>
        <div class="col-sm-1"></div>
    </div> 
    <br>
    <div class="row">
        <div class="col-sm-12 text-center"><h1>Manage Badges</h1></div>
    </div>
    <br>
    <br>
    <div class="row">
        
    </div>
   
</div>