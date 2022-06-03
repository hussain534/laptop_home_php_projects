<?php
	#db-desarrollo
    $databasecon = mysqli_connect('localhost','merakiprod01',base64_decode('bWVyYWtpcHJvZDAx'),'mpplanner') or die('Error:DB Connect error.');//IP,user,pwd,db
    
	
	$PRINT_LOG=false;
	$session_expirry_time=2700;

    #$mon_databasecon = mysqli_connect('','',base64_decode(''),'') or die('Error:DB Connect error.');//IP,user,pwd,db
    $monitor_notification_umbral=50;
    $monitor_notification_sender_email="";//separado con ,
    $monitor_notification_reciever_email="";//separado con ,

    $res_code_9999="ERROR OCCURED";
    $res_code_9998="UNATHORISED ACCESS";
    $res_code_101="WELCOME!";
    $res_code_102="INCORRECT CREDENTIALS";
    $res_code_103="PASSWORD UPDATED SUCCESSFULLY";
    $res_code_104="PASSWORD UPDATED SUCCESSFULLY. PLEASE CHECK YOUR REGISTERED EMAIL FOR NEW PASSWORD";
    $res_code_105="PASSWORD UPDATED SUCCESSFULLY BUT ERROR OCCURED IN SEND EMAIL.";
    $res_code_106="USER EMAIL NOT FOUND";
?>