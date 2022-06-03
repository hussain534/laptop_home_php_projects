<?php

    $db_suffix="mod";
    $db_name="app";
    $database_server="localhost";
    $database_user="merakiprod01";
    $database_password="merakiprod01";
    $database=$db_suffix.'_'.$db_name;
    $databasecon = mysqli_connect($database_server,$database_user,$database_password,$database) or die('Error:DB Connect error.');
   
?>