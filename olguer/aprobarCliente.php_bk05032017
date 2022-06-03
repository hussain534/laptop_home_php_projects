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
		//echo $_SESSION["message"];
		$message=$_SESSION["message"];
		unset($_SESSION["message"]);
	}
	$clientId=0;
	if(isset($_GET["client_id"]))
		$clientId=$_GET["client_id"];
	$clientes = $controller->getClientById($databasecon,$clientId,$DEBUG_STATUS);
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
			<hr>
			<div class="row">
				<div class="col-sm-6">
					<h2 class="page_title">APROBAR CLIENTE</h2>					
				</div>
				<div class="col-sm-6 text-right">
					<a href=asignarTecnicos.php?client_id=<?php echo $clientes[0][0];?> class="btn btn-small btn_center">ASIGNAR TECNICOS</a>
					<a href=asignarPeticiones.php?client_id=<?php echo $clientes[0][0];?>&peticion=0 class="btn btn-small btn_center">ASIGNAR PETICIONES</a>
				</div>
			</div>
			<br>
			<div class="row">				
				<div class="col-sm-10">	
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
					<form action="doAprobarCliente.php" method="post">
						<input type="hidden" id="id_cliente" name="id_cliente" value='<?php echo $clientes[0][0];?>'>
						<input type="hidden" id="submitted" name="submitted">

						<label for="client_name">NOMBRE DEL CLIENTE:</label>
						<input type="text" class="form-control" id="client_name" name="client_name" value='<?php echo $clientes[0][1];?>' readonly="true">

						<label for="ciudad_cliente">CIUDAD DE MATRIZ:</label>
						<input type="text" class="form-control" id="ciudad_cliente" name="ciudad_cliente" value='<?php echo $clientes[0][6];?>' readonly="true">

			            <label for="client_admin">NOMBRE ADMIN:</label>
						<input type="text" class="form-control" id="client_admin" name="client_admin" value='<?php echo $clientes[0][8];?>' readonly="true">
						
			            <label for="client_telefono">TELEFONO:</label>
						<input type="text" class="form-control" id="client_telefono" name="client_telefono" value='<?php echo $clientes[0][3];?>' readonly="true">
						
						<label for="client_celular">CELULAR:</label>
						<input type="text" class="form-control" id="client_celular" name="client_celular" value='<?php echo $clientes[0][4];?>' readonly="true">
						
						<label for="client_email">CORREO-ELECTRONICO:</label>
						<input type="email" class="form-control" id="client_email" name="client_email" value='<?php echo $clientes[0][5];?>' readonly="true">

						<label for="is_approved">TIPO CIENTE:</label>
						<select name="tipo_cliente" class="form-control" id="tipo_cliente"  required>
						<?php 
							if($clientes[0][11]==1)
							{
						?>
							<option value="1" selected="true">RENAL</option>
							<option value="2">LABORATORIO</option>
							<option value="3">NO CLASIFICADO</option>
						<?php
							}
							else if($clientes[0][11]==2)
							{
						?>
							<option value="2" selected="true">LABORATORIO</option>
							<option value="1">RENAL</option>
							<option value="0">NO CLASIFICADO</option>
						<?php
							}
							else
							{
						?>
							<option value="3" selected="true">NO CLASIFICADO</option>
							<option value="1">RENAL</option>
							<option value="2">LABORATORIO</option>
						<?php
							}
						?>
			        	</select>

						<label for="is_approved">APROBADO:</label>
						<select name="is_approved" class="form-control" id="is_approved"  required>
						<?php 
							if($clientes[0][7]==1)
							{
						?>
							<option value="1" selected="true">SI</option>
							<option value="0">NO</option>
						<?php
							}
							else
							{
						?>
							<option value="0" selected="true">NO</option>
							<option value="1">SI</option>
						<?php
							}
						?>
			        	</select>

			        	<label for="permisos">OBSERVACION:</label><div class="errorMsg" id="text_size"></div>
						<textarea class="form-control" name="obser" id="obser" name="obser" rows="10" onkeypress="countTextSize()" maxlength=1500 required><?php echo $clientes[0][10];?></textarea> 
						
			            <button type="submit" class="btn btn-small btn_center">ENVIAR<span class="glyphicon glyphicon-chevron-right"></span></button>
					</form>
				</div>				
			</div>
			<br>			
			<br>







		</div>
	</div>
</div>
