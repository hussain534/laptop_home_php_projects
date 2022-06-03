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
	$tecnicos = $controller->getTecnicos($databasecon,$DEBUG_STATUS);
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
					<h2 class="page_title">NUEVO PETICION</h2>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-sm-12 text-right">
					<p class="page_title"><div id="peticion_status"></div></p>
				</div>
			</div>
			<br>
			<br> -->
			
			<!-- <div class="row">
				<div class="col-sm-12">
					<label for="equipo_desc">DESCRIPCION DEL EQUIPO (NOMBRE Ó MODELO Ó MARCA Ó SERIE):</label>
					<input type="text" class="form-control" id="equipo_desc" placeholder="Ingresa Nombre ó Modelo ó Marca ó Serie" required>
					<div class="errmsg" id="error_equipo_desc"></div>
				</div>
			</div> -->
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
					<select name="client_id" class="form-control" onchange="getCiudad();getClientTipo()" id="client_id" required>
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
					<select name="ciudad_id" class="form-control" id="ciudad_id" onchange="getSucursalesParaPeticion()" required>
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
					<select name="sucursal_id" class="form-control" id="sucursal_id" onchange="getSalasParaPeticion()" required>
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
					<label for="service_id">TIPO DE SERVICIO (Elige Cliente primero):</label>
					<select name="service_id" class="form-control" id="service_id" onchange="handleEquipoList()" required>
						<!-- <option value="1">INSTALACION DE EQUIPO</option>
						<option value="2">MANTENIMIENTO PREVENTIVO</option>
						<option value="5">MANTENIMIENTO CORRECTIVO</option> -->
		        	</select>
		            <div class="errmsg" id="error_service_id"></div>
				</div>
		    	<div class="col-sm-6" id="nipro_tecnicos">
		            <label for="tecnico_id">TECNICO NIPRO:</label>
					<select name="tecnico_id" class="form-control" id="tecnico_id" required>
						<option value="99">TODOS</option>
						<?php 								
							if(isset($tecnicos) && count($tecnicos)>0)
							{
								for($x=0;$x<count($tecnicos);$x++)
								{
									echo '<option value='.$tecnicos[$x][0].'>['.$tecnicos[$x][0].']['.$tecnicos[$x][1].']</option>';
								}
							}
						?>
		        	</select>
		            <div class="errmsg" id="error_tecnico_id"></div>
		        </div>
		    </div>
		    <div class="row">
		    	<div class="col-sm-6">
		            <?php
		            	if(isset($message))
		            		echo '<h4>'.$message.'</h4>'
		            ?>
		            <button type="button" id="buscarEquipoPendientesParaPeticion" class="btn btn-small btn_center">BUSCAR<span class="glyphicon glyphicon-chevron-right"></span></button>
					<!-- <button type="button" id="delPermisos" class="btn btn-small btn_center">QUITAR PERMISO<span class="glyphicon glyphicon-chevron-right"></span></button> -->
			        <div class="progress" id="progress">
						<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-12">
		            <br>
		            <!-- <input type="hidden" id="id_equipos" value="0" size="100"> -->		            
		            <div id="tbl_entidad_solicitud">		            	
		            	<label for="permisos">ELIGE EQUIPOS:</label>
		            	<div class="row tbl_row_heading">
							<div class="col-sm-1">
								<h6>ID</h6>
							</div>				
							<div class="col-sm-4">
								<h6>DESCRIPCION</h6>
							</div>						
							<div class="col-sm-2">
								<h6>CIUDAD</h6>
							</div>
							<div class="col-sm-2">
								<h6>SUCURSAL</h6>
							</div>
							<div class="col-sm-2">
								<h6>SALA</h6>
							</div>
							<div class="col-sm-1">
								<h6>ACTIVO</h6>
							</div>
						</div>
						<?php 
						
						if(isset($equipos) && count($equipos)>0)
						{
							for($x=0;$x<count($equipos);$x++)
							{
						?>
								<div class="row tbl_row_data_static" style="font-size:12px">
									<div class="col-sm-1">
										<!-- <?php echo '<input type="checkbox" onchange=addToListList("'.$equipos[$x][0].'")>';?> -->
										<?php echo '<input type="radio" name="id_equipos" id="id_equipos" value='.$equipos[$x][0].'>';?>
										<?php echo $equipos[$x][0];?>
									</div>				
									<div class="col-sm-4">									
										<?php echo $equipos[$x][1];?>
									</div>
									<div class="col-sm-2">
										<?php echo $equipos[$x][3];?>
									</div>
									<div class="col-sm-2">									
										<?php echo $equipos[$x][4];?>
									</div>
									<div class="col-sm-2">									
										<?php echo $equipos[$x][5];?>
									</div>
									<div class="col-sm-1 text-center">
										<?php if($equipos[$x][6]==0) echo 'NO'; else echo 'SI';?>
									</div>
								</div>
						<?php	
								}	
							}
						?>
		            </div>
				</div>	
			</div>	
			<div class="errmsg" id="error_equipos"></div>		
			<br>
			<div class="row">
				<div class="col-sm-12">
					<label for="permisos">DETALLE DE PETICION:</label><div class="errorMsg" id="text_size"></div>
					<textarea class="form-control" name="obser" id="obser" rows="10" onkeypress="countTextSize()" placeholder="Ingresar detalle de peticion-1500 caracteres" maxlength=1500 required></textarea> 
					<div class="errmsg" id="error_obser"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-right">
					<p class="page_title"><div id="peticion_status"></div></p>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12" id="crearPeticionCheck">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<button type="button" id="crearPeticion" class="btn btn-small btn_center">CREAR PETICION<span class="glyphicon glyphicon-chevron-right"></span></button>
				</div>
			</div>
			<br>







		</div>
	</div>
</div>