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
					<h2 class="page_title">REGISTRARSE</h2>
				</div>
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group" id="mensaje">										
						<hr>
						
			            <h4>DETALLES DEL EMPRESS</h4>
						<label for="client_name">NOMBRE DEL EMPRESA:</label>
						<input type="text" class="form-control" id="client_name">
						<div class="errmsg" id="error_client_name"></div>

						<label for="ciudad_cliente">CIUDAD DE MATRIZ:</label>
						<select name="ciudad_cliente" class="form-control" id="ciudad_cliente"  required>
							<option value="0">Elige ciudad</option>
						<?php
							$ciudad = $controller->getCiudadParaRegistrar($databasecon,$DEBUG_STATUS);
					        if(isset($ciudad) && count($ciudad)>0)
							{
								for($x=0;$x<count($ciudad);$x++)
								{
									echo "<option value='".$ciudad[$x][0]."'>".'['.$ciudad[$x][0].'] '.$ciudad[$x][1]."</option>";
								}
							}
				        ?>
			        	</select>
			            <div class="errmsg" id="error_ciudad_cliente"></div>

			            <hr>
			            <h4>DETALLES DEL ADMINISTRADOR</h4>
			            <h5>Recuerda que administrador es la unico punto de contacto por parte del cliente/empresa</h5>
			            <label for="admin_name">NOMBRE DEL ADMINISTRADOR:</label>
						<input type="text" class="form-control" id="admin_name">
						<div class="errmsg" id="error_admin_name"></div>

						<label for="client_email">CORREO-ELECTRONICO DEL ADMINISTRADOR:</label>
						<input type="email" class="form-control" id="client_email">
						<div class="errmsg" id="error_client_email"></div>

						<label for="admin_password">CONTRASENA DEL ADMINISTRADOR:</label>
						<input type="password" class="form-control" id="admin_password">
						<div class="errmsg" id="error_admin_password"></div>

			            <label for="client_telefono">TELEFONO DEL ADMINISTRADOR:</label>
						<input type="text" class="form-control" id="client_telefono">
						<div class="errmsg" id="error_client_telefono"></div>

						<label for="client_celular">CELULAR DEL ADMINISTRADOR:</label>
						<input type="text" class="form-control" id="client_celular">
						<div class="errmsg" id="error_client_celular"></div>

						


						<button type="button" id="registrarCliente" class="btn btn-small btn_center">REGISTRAR<span class="glyphicon glyphicon-chevron-right"></span></button>
						
				    </div>	
				</div>	
			</div>
			







		</div>
		<div class="col-sm-3">			
		</div>
	</div>
</div>