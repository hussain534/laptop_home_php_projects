<?php
	#db-desarrollo
    $databasecon = mysqli_connect('localhost','merakiprod01','merakiprod01','m360hd') or die('Error:DB Connect error.');//IP,user,pwd,db
	
	#db-prod
    #$databasecon = mysqli_connect('localhost','merakiad_m360hd','m360hdpwd','merakiad_m360hd') or die('Error:DB Connect error.');//IP,user,pwd,db
	
	$PRINT_LOG=false;
	$session_expirry_time=2700;
    $install_dt='01/JUL/2019';

?>