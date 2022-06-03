<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    //include_once('util.php');
	include_once('config.php');	
	$DEBUG_STATUS = $PRINT_LOG;

	require 'dbcontroller.php';
	$controller = new controller();
	if(!isset($_SESSION["user_name"]))
	{
		$url='cerrarSesion.php';
		header("Location:$url");
	}

	//include_once('menuPanel.php');
	$message='';
	$err_code=0;
	if(isset($_POST["submitted"]))
	{
		$err_code = $controller->aprobarCliente($databasecon,$_POST["id_cliente"],$_POST["is_approved"],$_POST["obser"],$_POST["tipo_cliente"],$DEBUG_STATUS);
		if($err_code==1)
		{
			$_SESSION["message"]="ACTUALIZACION DE DATOS FUE EXITOSO";		
		}
		else
		{
			$_SESSION["message"]="ERROR EN ACTUALIZACION DE DATOS";
		}
		$url='aprobarCliente.php?client_id='.$_POST["id_cliente"];
		header("Location:$url");
	}
	else
	{
		$url='aprobarCliente.php?client_id='.$_POST["id_cliente"];
	}
	header("Location:$url");
?>
