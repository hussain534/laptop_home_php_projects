<?php
	$databasecon = mysqli_connect('localhost','merakiprod01','merakiprod01','bpm') or die('Error:DB Connect error.');//IP,user,pwd,db
	
  #hutesol db
  #$databasecon = mysqli_connect('localhost','hussain1_shop534','shop534','hussain1_zielus') or die('Error:DB Connect error.');//IP,user,pwd,db
  $PRINT_LOG=false;
	$session_expirry_time=30000;
  $pics_location='images/pics/';
  
?>