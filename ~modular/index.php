<?php
    include_once('./common/config.php');
    include_once('util.php');
    
    if(session_status() == PHP_SESSION_NONE)
        session_start();
    include_once('home.php');
?>