<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    include_once('util.php');
	include_once('config.php'); 
	$session_time=$session_expirry_time;
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
  	if(isset($_SESSION['LAST_ACTIVITY']))
    {
    	if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
		{
			$url="userlogin.php";
			header("Location:$url"); 
		}
        else
              $_SESSION['LAST_ACTIVITY'] = time();
	}
	else
		$_SESSION['LAST_ACTIVITY'] = time();  
?>
<div class="container">
	<?php
		$controller = new controller();
		$err_code = $controller->configurarPermisosNotificaciones($databasecon,$_SESSION["userid"],$_GET["noti_id"],$_GET["noti_viaje_publicado"],$_GET["noti_viaje_reservado"],$_GET["noti_cambio_viaje_publicado"],$_GET["noti_cambio_viaje_reservado"],$_GET["noti_publicos"],$_GET["noti_privados"],$DEBUG_STATUS);	
		if($err_code==0)
		{
	?>
	<div class="row">
        <div class="col-sm-12">
        	<div class='alert alert-success shopAlert'>
            	<?php  echo 'Los permisos de notificaciones fueron actualizados correctamente.'; ?>
	         </div>
        </div>
    </div>    
	<?php
		}
		else
		{
	?>
	<div class="row">
        <div class="col-sm-12">
        	<div class='alert alert-danger shopAlert'>
                El sistema presenta error en este momento. Por favor intenta nuevamente.    	
	         </div>
        </div>
    </div>
	<?php		
		}
	?>
</div>