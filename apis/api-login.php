<?php
    session_start();
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();
    $output=$controller->loginUser($databasecon,$_GET['email'],$_GET['password'],$DEBUG_STATUS);    
    
    echo $output;
?>