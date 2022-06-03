<?php
    #sistec db-desarrollo
    $databasecon = mysqli_connect('localhost','merakiprod01','merakiprod01','pmc') or die('Error:DB Connect error.');//IP,user,pwd,db
    
    #sistec db-pruebas
    #$databasecon = mysqli_connect('localhost','hussain1_sistec','sistec534','hussain1_sistec') or die('Error:DB Connect error.');//IP,user,pwd,db
    
    #sistec db-prod
    #$databasecon = mysqli_connect('localhost','sistecec_dbadmin','dbadminpwd','sistecec_maint') or die('Error:DB Connect error.');//IP,user,pwd,db
    
    $PRINT_LOG=false;
    $session_expirry_time=600;
    $pics_location='images/pics/';
    $gallery_location='images/gallery/';
?>