<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    include_once('util.php');
	include_once('config.php');	
	$DEBUG_STATUS = $PRINT_LOG;

	

	include_once('menuPanel.php');
	$message='';
	if(isset($_SESSION["message"])) 
	{
		$message=$_SESSION["message"];
		unset($_SESSION["message"]);
	}
	//$clientes = $controller->getClientes($databasecon,$DEBUG_STATUS);
?>
<div class="container">
			<br>
			<br>
			<div class="row">
				<div class="col-sm-12 text-center">
					<?php if(isset($message)) echo $message;?>
					<br>
					<button type="button" class="btn btn-big"><a href="index.php">IR PAGINA INICIO</a><span class="glyphicon glyphicon-chevron-right"></span></button>			

				</div>
			</div>
</div>