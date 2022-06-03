<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    //include_once('util.php');
	include_once('config.php'); 
	$session_time=$session_expirry_time;
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
  	$_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }
	//include_once('header.php');


	$controller = new controller();
	$error_code=$controller->updateDocumentVerification($databasecon,$_POST["docId"],$_POST["estado"],$_POST["obser"],$_POST["docType"],$DEBUG_STATUS);
	if($error_code==0)
		$_SESSION["session_msg"]='ESTADO ACTUALIZADO CORRECTAMENTE';
	else
		$_SESSION["session_msg"]='ERROR OCURIDO EN ACTUALIZACIOND DEL VERIFICACION. INTENTE NEUVAMENTE';
	$url='admincontrol.php';
	header("Location:$url"); 
?>
