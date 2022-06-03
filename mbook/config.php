<?php
	#sistec db-desarrollo
    $databasecon = mysqli_connect('localhost','merakiprod01','merakiprod01','mbook') or die('Error:DB Connect error.');//IP,user,pwd,db
	
	#sistec db-pruebas
	#$databasecon = mysqli_connect('localhost','hussain1_sistec','sistec534','hussain1_sistec') or die('Error:DB Connect error.');//IP,user,pwd,db
    
    #sistec db-prod
    #$databasecon = mysqli_connect('localhost','sistecec_dbadmin','dbadminpwd','sistecec_maint') or die('Error:DB Connect error.');//IP,user,pwd,db
	
	$PRINT_LOG=false;
	$session_expirry_time=2700;

    $pagination_count=10;
    $total_count=0;
    $first_page=0;
    $last_page=0;
    $prev_page_count=0;
    $next_page_count=0;
    $total_pages=1;

?>