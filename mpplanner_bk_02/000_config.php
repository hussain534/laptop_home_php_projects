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


    $res_code_121="MENU ITEM UPDATED / INSERTED SUCCESSFULLY";
    $res_code_122="ERROR OCCURED WHILE UPDATING / INSERTING MENU ITEM";
    $res_code_123="MENU ITEM DISABLED SUCCESSFULLY";
    $res_code_124="MENU ITEM ENABLED SUCCESSFULLY";
    $res_code_125="ERROR OCCURED WHILE DISABLING MENU ITEM";

    $res_code_131="PROFILE UPDATED / INSERTED SUCCESSFULLY";
    $res_code_132="ERROR OCCURED WHILE UPDATING / INSERTING PROFILE";
    $res_code_133="PROFILE DISABLED SUCCESSFULLY";
    $res_code_134="PROFILE ENABLED SUCCESSFULLY";
    $res_code_135="ERROR OCCURED WHILE DISABLING PROFILE";

    $res_code_141="ACCESS LIST UPDATED / INSERTED SUCCESSFULLY";
    $res_code_142="ERROR OCCURED WHILE UPDATING / INSERTING ACCESS LIST";
    $res_code_143="ACCESS LIST DISABLED SUCCESSFULLY";
    $res_code_144="ACCESS LIST ENABLED SUCCESSFULLY";
    $res_code_145="ERROR OCCURED WHILE DISABLING ACCESS LIST";

    $res_code_151="CLIENT UPDATED / INSERTED SUCCESSFULLY";
    $res_code_152="ERROR OCCURED WHILE UPDATING / INSERTING CLIENT";
    $res_code_153="CLIENT DISABLED SUCCESSFULLY";
    $res_code_154="CLIENT ENABLED SUCCESSFULLY";
    $res_code_155="ERROR OCCURED WHILE DISABLING CLIENT";
?>