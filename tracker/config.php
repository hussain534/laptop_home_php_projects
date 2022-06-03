<?php
	#db-desarrollo
    $databasecon = mysqli_connect('127.0.0.1','merakiprod01','merakiprod01','ayaan_perftracker') or die('Error:DB Connect error.');//IP,user,pwd,db
	#db-prod
    #$databasecon = mysqli_connect('127.0.0.1','ayaan_tracker','tracker534','ayaan_perftracker') or die('Error:DB Connect error.');//IP,user,pwd,db
	$PRINT_LOG=false;
	$session_expirry_time=2700;
?>