<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    include_once('util.php');
	include_once('config.php');	
	$DEBUG_STATUS = $PRINT_LOG;

	require 'dbcontroller.php';
	$controller = new controller();

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
	<div class="row">
		<div class="col-sm-3">			
		</div>
		<div class="col-sm-6">




			<div class="row">
				<div class="col-sm-12 text-center">
					<h2 class="page_title">INICIAR SESION</h2>
				</div>
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group" id="mensaje">										
			            <hr>
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
			            <form action="datacontroller.php?dojob=98&metodo=0" method="post">
			            	<input type="hidden" name="submitted" value="true">
				            <label for="user_email">CORREO-ELECTRONICO:</label>
							<input type="email" class="form-control" id="user_email" name="user_email" required>
							<div class="errmsg" id="error_user_email"></div>

							<label for="user_password">CONTRASENA:</label>
							<input type="password" class="form-control" id="user_password" name="user_password" required>
							<div class="errmsg" id="error_user_password"></div>				


							<button type="submit" class="btn btn-small btn_center">INGRESAR<span class="glyphicon glyphicon-chevron-right"></span></button>
							<a href="recuperarClave.php"><button type="button" class="btn btn-small btn_center">RECUPERAR CLAVE<span class="glyphicon glyphicon-chevron-right"></span></button></a>
						</form>
				    </div>	
				</div>	
			</div>
			







		</div>
		<div class="col-sm-3">			
		</div>
	</div>
</div>