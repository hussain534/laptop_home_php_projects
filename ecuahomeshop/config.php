<?php
    $databasecon = mysqli_connect('localhost','merakiprod01','merakiprod01','ehs') or die('Error:DB Connect error.');//IP,user,pwd,db

    #hutesol db
    #$databasecon = mysqli_connect('localhost','hussain1_shop534','shop534','hussain1_zielus') or die('Error:DB Connect error.');//IP,user,pwd,db
    $PRINT_LOG=false;
    $session_expirry_time=30000;
    $clients_location='images/clients/';
    $default_location='images/';
    $uploadSize=5000000;
    $dataPorPagina=3;
?>