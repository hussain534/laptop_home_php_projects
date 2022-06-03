<?php
    #bushido db-desarrollo
    #$databasecon = mysqli_connect('localhost','merakiprod01','merakiprod01','bushido') or die('Error:DB Connect error.');//IP,user,pwd,db
    
    #bushido db-pruebas
    #$databasecon = mysqli_connect('localhost','hussain1_bushido','bushido534','hussain1_bushido') or die('Error:DB Connect error.');//IP,user,pwd,db
    
    #bushido db-prod
    $databasecon = mysqli_connect('localhost','bushidoe_admin','appadmin534','bushidoe_appdb') or die('Error:DB Connect error.');//IP,user,pwd,db
    
    $PRINT_LOG=false;
    $session_expirry_time=600;
    $pics_location='images/pics/';
    $gallery_location='images/gallery/';
    $docs_location='images/docs/';
    $dataPorPagina=10;
?>