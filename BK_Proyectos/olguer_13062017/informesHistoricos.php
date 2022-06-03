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
	$clientes = $controller->getClientes($databasecon,$DEBUG_STATUS);
	//$ciudad = $controller->getCiudad($databasecon,$DEBUG_STATUS);	
	$sucursal = $controller->getSucursales($databasecon,$DEBUG_STATUS);
	$salas = $controller->getSalas($databasecon,$DEBUG_STATUS);
	//$equipos = $controller->getEquipos($databasecon,$DEBUG_STATUS);
?>
<div class="container">
	<div class="row">
		<div class="col-sm-2 sidebar">
			<?php include_once('menu.php');?>
		</div>
		<div class="col-sm-10">

		<div id="tbl_entidad_gestion"></div>

			<div class="row">
				<div class="col-sm-12">
					<?php include_once('mysession.php');?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<h2 class="page_title">INFORMES HISTORICOS</h2>
				</div>
			</div>
			
			<!-- SEARCH PARAMETERS -->
			<div class="row">
				<div class="col-sm-6">
					<label for="equipo_nombre">NOMBRE DEL EQUIPO</label>
					<input type="text" class="form-control" id="equipo_nombre" placeholder="Ingresa Nombre del equipo">
					<div class="errmsg" id="error_equipo_nombre"></div>
				</div>
				<div class="col-sm-6">
					<label for="equipo_modelo">MODELO DEL EQUIPO</label>
					<input type="text" class="form-control" id="equipo_modelo" placeholder="Ingresa Modelo del equipo">
					<div class="errmsg" id="error_equipo_modelo"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<label for="equipo_marca">MARCA DEL EQUIPO</label>
					<input type="text" class="form-control" id="equipo_marca" placeholder="Ingresa Marca del equipo">
					<div class="errmsg" id="error_equipo_marca"></div>
				</div>
				<div class="col-sm-6">
					<label for="equipo_serie">SERIE DEL EQUIPO</label>
					<input type="text" class="form-control" id="equipo_serie" placeholder="Ingresa Serie del equipo">
					<div class="errmsg" id="error_equipo_serie"></div>
				</div>
			</div>
		    <div class="row">
		    	<div class="col-sm-6">
		            <label for="client_id">CLIENTE(*):</label>
					<select name="client_id" class="form-control" onchange="getCiudad()" id="client_id" required>
						<option value="99">TODOS</option>
						<?php 								
							if(isset($clientes) && count($clientes)>0)
							{
								for($x=0;$x<count($clientes);$x++)
								{
									echo '<option value='.$clientes[$x][0].'>['.$clientes[$x][0].']['.$clientes[$x][1].']</option>';
								}
							}
						?>
		        	</select>
		            <div class="errmsg" id="error_cliente"></div>
		        </div>
		       	<div class="col-sm-6">
		            <label for="ciudad_id">CIUDAD:</label>
					<select name="ciudad_id" class="form-control" id="ciudad_id" onchange="getSucursales()" required>
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
		    </div>
		    <div class="row">
		    	<div class="col-sm-6">
		            <label for="sucursal_id">SUCURSAL:</label>
					<select name="sucursal_id" class="form-control" id="sucursal_id" onchange="getSalas()" required>
						<option value="99">Elige SUCURSAL</option>
		        	</select>
		            <div class="errmsg" id="error_sucursal"></div>
		        </div>
				<div class="col-sm-6">
					<label for="sala_id">SALA:</label>
					<select name="sala_id" class="form-control" id="sala_id" required>
						<option value="99">Elige SALA</option>
		        	</select>
		            <div class="errmsg" id="error_sala"></div>
				</div>
		    </div>
		    <div class="row">
		    	<div class="col-sm-6">
		            <?php
		            	if(isset($message))
		            		echo '<h4>'.$message.'</h4>'
		            ?>
		            <button type="button" id="buscarEquipoInformes" class="btn btn-small btn_center">BUSCAR<span class="glyphicon glyphicon-chevron-right"></span></button>
					<!-- <button type="button" id="delPermisos" class="btn btn-small btn_center">QUITAR PERMISO<span class="glyphicon glyphicon-chevron-right"></span></button> -->
			        <div class="progress" id="progress">
						<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
					</div>
				</div>
			</div>
			

			<!-- LISTA DE EQUIPOS  -->
			<div class="row">
				<div class="col-sm-12">
		            <br>
		            <!-- <input type="hidden" id="id_equipos" value="0" size="100"> -->		            
		            <div id="tbl_entidad_solicitud">		            	
		            			            	
		            </div>
				</div>	
			</div>	
			<div class="errmsg" id="error_equipos"></div>		
			<br>
		</div>
	</div>
</div>