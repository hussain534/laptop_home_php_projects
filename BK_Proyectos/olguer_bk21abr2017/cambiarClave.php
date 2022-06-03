<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    //include_once('util.php');
	include_once('config.php');	
	$session_time=$session_expirry_time;
	$DEBUG_STATUS = $PRINT_LOG;

	require 'dbcontroller.php';
	$controller = new controller();
	if(!isset($_SESSION["user_name"]) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
	{
		$url='cerrarSesion.php';
		header("Location:$url");
	}
	else
	{
		include_once('util.php');
	}
	$_SESSION['LAST_ACTIVITY'] = time();

	include_once('menuPanel.php');
	$message='';
	if(isset($_SESSION["message"])) 
	{
		$message=$_SESSION["message"];
		unset($_SESSION["message"]);
	}
?>
<div class="container">
	<div class="row">
		<div class="col-sm-2 sidebar">
			<?php include_once('menu.php');?>
		</div>
		<div class="col-sm-10">
					


			<div class="row">
				<div class="col-sm-12">
					<?php include_once('mysession.php');?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<h2 class="page_title">ADMINISTRAR CLAVE</h2>
				</div>
			</div>
			<br>
			<?php 
			            	if(isset($message) && strcmp($message, '')!=0)
			            	{
			            ?>
			            	<div class="row">
								<div class="col-sm-12 text-center">
							        <div class="errblock">
			            				<?php echo $message;?>
			            			</div>
			            		</div>
			            	</div>
			            <?php
			            	}
			            ?>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="clave_anterior">CLAVE ANTERIOR:</label>
						<input type="password" class="form-control" id="clave_anterior">
						<div class="errmsg" id="error_clave_anterior"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="clave_nuevo">CLAVE NUEVA:</label>
						<input type="password" class="form-control" id="clave_nuevo">
						<div class="errmsg" id="error_clave_nuevo"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="confirmar_clave">CONFIRMAR CLAVE:</label>
						<input type="password" class="form-control" id="confirmar_clave">
						<div class="errmsg" id="error_confirmar_clave"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<button type="button" id="cambiarClave" class="btn btn-small btn_center">ACTUALIZAR CLAVE<span class="glyphicon glyphicon-chevron-right"></span></button>
					<div class="progress" id="progress">
						<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
					</div>
				</div>	
			</div>
			
		</div>
	</div>
</div>