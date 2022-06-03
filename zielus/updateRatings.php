<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time; 
	$DEBUG_STATUS = $PRINT_LOG;
    $tipo=0;
    $conductorId=0;
    $vehicleId=0;
    $rating=0;
    $viajeId=0;
	if(isset($_GET["tipo"]))
		$tipo=$_GET["tipo"];
    if(isset($_GET["conductorId"]))
        $conductorId=$_GET["conductorId"];
    if(isset($_GET["vehicleId"]))
        $vehicleId=$_GET["vehicleId"];
    if(isset($_GET["rating"]) && $_GET["rating"]>0)
        $rating=$_GET["rating"];
    else
        $rating=0;
    if(isset($_GET["viajeId"]))
        $viajeId=$_GET["viajeId"];
	//echo $rating.'<br>';
  	require 'dbcontroller.php';

    $controller = new controller();
    if($tipo==1)
        $err_code = $controller->updateConductorRating($databasecon,$conductorId,$viajeId,$_SESSION["userid"],$rating,$DEBUG_STATUS);
    else if($tipo==2)
        $err_code = $controller->updateVehicleRating($databasecon,$vehicleId,$viajeId,$_SESSION["userid"],$rating,$DEBUG_STATUS);
    //echo $err_code;
    /*if(isset($err_code) && $err_code==0)
       echo 'Calificacion del conductor actualizada correctamente.';
    else
        echo 'Error en actualizar calificacion del conductor.Por favor intenta nuevamente.';*/

    if(isset($err_code) && $err_code==0)
       echo 'Calificacion del conductor actualizada correctamente.';
    else
        echo 'Error en actualizar calificacion del conductor.Por favor intenta nuevamente.';
            
    ?>
    