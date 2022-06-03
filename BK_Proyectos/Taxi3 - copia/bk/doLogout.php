<?php
	//avoid direct access
	defined('__JEXEC') or ('Access denied');
	session_start();
	include_once('config.php'); 
	require 'dbcontroller.php';
    
    //assign commaon local variables
    $dbcon = $databasecon;
    $DEBUG_STATUS = $PRINT_LOG;
  	$err_code=0;
    $session_time=$session_expirry_time;

    //validate session expire
	if(isset($_SESSION['LAST_ACTIVITY']))
    {
		if(($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
		{
			$url="index.php?view=shop&layout=userlogout&tipo=2";
			header("Location:$url"); 
		}
        else
              $_SESSION['LAST_ACTIVITY'] = time();
	}
	/*else
		$_SESSION['LAST_ACTIVITY'] = time();*/

    //process login
   	$controller = new controller();    	
	$userEmail = $_SESSION['userEmail'];
	$userId = $_SESSION['userid'];
	$err_code = $controller->doLogout($databasecon,$userId,$userEmail,$DEBUG_STATUS);
	if(isset($err_code) and $err_code==0)
	{
		$url='index.php';
		// remove all session variables
        //session_unset(); 

        // destroy the session 
        //session_destroy(); 
	}
	
	header("Location:$url"); 
?>