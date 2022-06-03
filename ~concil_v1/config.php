<?php
	#db-desarrollo
    #$databasecon = mysqli_connect('localhost','sitadmin','sitadmin534','concil') or die('Error:DB Connect error.');//IP,user,pwd,db
	
	#db-prod
    $databasecon = mysqli_connect('104.209.173.99','admin_db_concil','uzeMsD3bW1','admin_etapa_concil') or die('Error:DB Connect error.');//IP,user,pwd,db
	
	$PRINT_LOG=false;
	$session_expirry_time=2700;

?>