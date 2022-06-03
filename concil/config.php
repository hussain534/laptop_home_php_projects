<?php
	#db-desarrollo
    #$databasecon = mysqli_connect('localhost','sitadmin','sitadmin534','concil') or die('Error:DB Connect error.');//IP,user,pwd,db
	
	#db-prod
    //$databasecon = mysqli_connect('104.209.173.99','admin_db_concil','uzeMsD3bW1','admin_etapa_concil') or die('Error:DB Connect error.');//IP,user,pwd,db
    $databasecon = mysqli_connect('104.209.173.99','admin_db_concil',base64_decode('dXplTXNEM2JXMQ=='),'admin_etapa_concil') or die('Error:DB Connect error.');//IP,user,pwd,db
	
	$PRINT_LOG=false;
	$session_expirry_time=2700;

    //$mon_databasecon = mysqli_connect('104.209.173.99','admin_db_mon','db_mon534','admin_monitoring') or die('Error:DB Connect error.');//IP,user,pwd,db
    $mon_databasecon = mysqli_connect('104.209.173.99','admin_db_mon',base64_decode('ZGJfbW9uNTM0'),'admin_monitoring') or die('Error:DB Connect error.');//IP,user,pwd,db
    $monitor_notification_umbral=50;
    $monitor_notification_sender_email="monitor@conciliacion-metrowifi.etapa.net.ec";//separado con ,
    $monitor_notification_reciever_email="hussain.mm.2006@gmail.com";//separado con ,

?>