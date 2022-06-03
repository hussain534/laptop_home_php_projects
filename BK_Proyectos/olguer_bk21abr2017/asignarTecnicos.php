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
	$clientId=0;
	if(isset($_GET["client_id"]))
		$clientId=$_GET["client_id"];
	$client=$controller->getClientById($databasecon,$clientId,$DEBUG_STATUS);
	$sucursales = $controller->getSucursalesByClientId($databasecon,99,$clientId,$DEBUG_STATUS);
	$ciudad = $controller->getCiudad($databasecon,$DEBUG_STATUS);
	$sucursal = $controller->getSucursales($databasecon,$DEBUG_STATUS);
	$salas = $controller->getSalas($databasecon,$DEBUG_STATUS);
	$users = $controller->getUsers($databasecon,$DEBUG_STATUS);

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
					<h2 class="page_title">ASIGNAR TECNICOS</h2>
				</div>
			</div>
			<br>
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
		            <label for="ciudad_id">CIUDAD:</label>
					<select name="ciudad_id" class="form-control" id="ciudad_id" onchange="getSucursales();getSucursalesParaAsignarTecnico()" required>
						<option value="99">Elige CIUDAD</option>
						<?php 								
							if(isset($ciudad) && count($ciudad)>0)
							{
								for($x=0;$x<count($ciudad);$x++)
								{
									echo '<option value='.$ciudad[$x][0].'>['.$ciudad[$x][0].']['.$ciudad[$x][1].']</option>';
								}
							}
						?>
		        	</select>
		            <div class="errmsg" id="error_ciudad"></div>
		        </div>
		        <div class="col-sm-6">
		            <label for="sucursal_id">SUCURSAL:</label>
					<select name="sucursal_id" class="form-control" id="sucursal_id" onchange="getSalas();getSalasParaAsignarTecnico()" required>
						<option value="99">Elige SUCURSAL</option>
		        	</select>
		            <div class="errmsg" id="error_sucursal"></div>
		        </div>
			</div>
			<div class="row">
		    	<div class="col-sm-6">
					<label for="sala_id">SALA:</label>
					<select name="sala_id" class="form-control" id="sala_id" onchange="getUsersParaAsignarTecnico()" required>
						<option value="99">Elige SALA</option>
		        	</select>
		            <div class="errmsg" id="error_sala"></div>
				</div>
				<div class="col-sm-6">
					<label for="tecnico_id">TECNICOS:</label>
					<select name="tecnico_id" class="form-control" id="tecnico_id" required>
						<option value="99">Elige Tecnico</option>
		        	</select>
		            <div class="errmsg" id="error_tecnico"></div>
				</div>
		    </div>
		    <br>
		    <br>
		    <div class="row">
				<div class="col-sm-12">
					<button type="button" id="asignarTecnicoParaSucursal" class="btn btn-small btn_center">ASIGNAR TECNICO<span class="glyphicon glyphicon-chevron-right"></span></button>
				</div>
			</div>
		    <br>
		    <input type="hidden" id="id_equipos" value="0" size="100">
		    <div id="tbl_entidad_solicitud"></div>
		    <div class="errmsg" id="error_equipos"></div>	
		    <div class="row">
				<div class="col-sm-10 text-center">
		    <?php 						
				if(isset($client) && count($client)>0)
				{
					echo '<h3>'.$client[0][1].'</h3>';
				}
			?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-10">
					<div id="tbl_entidad"></div>
					<div class="row tbl_row_heading">
						<div class="col-sm-1">
							<h4>ID</h4>
						</div>										
						<div class="col-sm-2">
							<h4>CIUDAD</h4>
						</div>
						<div class="col-sm-2">
							<h4>SUCURSAL</h4>
						</div>
						<div class="col-sm-3">
							<h4>CLIENTE</h4>
						</div>						
						<div class="col-sm-4">
							<h4>TECNICO ASIGNADO</h4>
						</div>
					</div>
					<?php 
						
						if(isset($sucursales) && count($sucursales)>0)
						{
							for($x=0;$x<count($sucursales);$x++)
							{
					?>
							<div class="row tbl_row_data">
								<div class="col-sm-1">
									<?php echo '<input type="checkbox" onchange=addToListList("'.$sucursales[$x][0].'")>';?>
									<?php echo $sucursales[$x][0];?>
								</div>												
								<div class="col-sm-2">
									<?php echo $sucursales[$x][1];?>
								</div>
								<div class="col-sm-2">
									<?php echo $sucursales[$x][2];?>
								</div>
								<div class="col-sm-3">
									<?php echo $sucursales[$x][3];?>
								</div>								
								<div class="col-sm-4">
									<?php echo $sucursales[$x][5];?>
								</div>
							</div>
					<?php	
							}	
						}
					?>
				</div>
			</div>

			<br>
			<br>
			<br>





		</div>
	</div>
</div>