<?php
	#sistec db-desarrollo
    $databasecon = mysqli_connect('9.13.45.88','sitadmin','sitadmin534','sit') or die('Error:DB Connect error.');//IP,user,pwd,db
	
	#sistec db-pruebas
	#$databasecon = mysqli_connect('localhost','hussain1_sistec','sistec534','hussain1_sistec') or die('Error:DB Connect error.');//IP,user,pwd,db
    
    #sistec db-prod
    #$databasecon = mysqli_connect('localhost','sistecec_dbadmin','dbadminpwd','sistecec_maint') or die('Error:DB Connect error.');//IP,user,pwd,db
	
	$PRINT_LOG=false;
	$session_expirry_time=2700;

?>