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
	/*if(isset($_POST["submitted"]))
	{
		$clientId=$_POST["searchClientId"];
		$peticionId=$_POST["searchPeticionId"];
		$peticiones = $controller->getPeticionesByClient($databasecon,$clientId,$peticionId,$DEBUG_STATUS);
	}
	else
	{*/	
		/*if(isset($_GET["estado"]))
			$peticiones = $controller->getPeticiones($databasecon,0,$_GET["estado"],$DEBUG_STATUS);
		else
			$peticiones = $controller->getPeticiones($databasecon,0,0,$DEBUG_STATUS);*/

		if(isset($_GET["estado"]) && isset($_GET["tipo_cliente"]))
			$peticiones = $controller->getPeticiones($databasecon,0,$_GET["estado"],$_GET["tipo_cliente"],$DEBUG_STATUS);
		else
			$peticiones = $controller->getPeticiones($databasecon,0,0,99,$DEBUG_STATUS);
	/*}*/
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
					<h2 class="page_title">GESTION PETICION</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-right">
					<p class="page_title"><div id="peticion_status"></div></p>
				</div>
			</div>
			<br>
			<!-- <form action="gestionPeticion.php" method="post">
            	<input type="hidden" name="submitted" value="true">
	            <div class="row">
	            	<div class="col-sm-12">
	            		<label for="searchClientId">CLIENTE(*):</label>
						<select name="searchClientId" class="form-control" id="searchClientId" required>
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
			        </div>
			    </div>
			    <div class="row">
					<div class="col-sm-12">
						<label for="ciudad_id">NRO PETICION:</label>
						<input type="text" class="form-control" name="searchPeticionId" value="" placeholder="Ingresa nro de peticion para buscar o numeral cero para traer todos los peticiones">
			        </div>
				</div>
				 <div class="row">
					<div class="col-sm-12">
						<button type="submit" id="buscarPeticionPorId" class="btn btn-small btn_center">BUSCAR PETICION<span class="glyphicon glyphicon-chevron-right"></span></button>
					</div>
				</div>
			</form> -->
			<br>
			<div class="row">
					<div class="col-sm-6">
						<label for="ciudad_id">NRO PETICION:</label>
						<input type="text" class="form-control" id="searchPeticionId" value="" placeholder="Ingresa nro de peticion para buscar o numeral cero para traer todos los peticiones">
			        </div>
			        <div class="col-sm-6">
						<label for="estado_id">ESTADOS</label>
						<select name="estado_id" class="form-control" id="estado_id" required>
							<option value="99">TODOS</option>
							<option value="1">ABIERTA</option>
							<option value="2">EN CURSO</option>
							<option value="3">CERRADA</option>
			        	</select>
			            <div class="errmsg" id="error_estado_id"></div>
					</div>
				</div>
			<div class="row">				
				<div class="col-sm-6">
		            <label for="client_id">CLIENTE:</label>
					<select name="client_id" class="form-control"  onchange="getCiudad()" id="client_id" required>
						<option value='99'>[99][TODOS]</option>
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
		            <label for="tipo_cliente">TIPO CLIENTE:</label>
					<select name="tipo_cliente" class="form-control" id="tipo_cliente" required>
						<option value='99'>[99][TODOS]</option>
						<option value='1'>[1][RENAL]</option>
						<option value='2'>[2][LABORATORIO]</option>
						<option value='0'>[0][NO CLASIFICADO]</option>
		        	</select>
		            <div class="errmsg" id="error_cliente"></div>
		        </div>
			</div>
			<!-- <div class="row">
				<div class="col-sm-12">
					<label for="observacion">OBSERVACION (TIPO, MODELO, MARCA, etc):</label>
					<input type="text" class="form-control" id="observacion">
					<div class="errmsg" id="error_observacion"></div>
				</div>
			</div> -->
		    <div class="row">		    	
		        <div class="col-sm-6">
					<label for="service_id">TIPO DE SERVICIO:</label>
					<select name="service_id" class="form-control" id="service_id" onchange="handleEquipoList()" required>
						<option value="99">TODOS</option>
						<option value="1">INSTALACION DE EQUIPO</option>
						<option value="2">MANTENIMIENTO PREVENTIVO</option>
						<option value="3">RETIRO DE EQUIPO</option>
						<option value="4">MODIFICACION MANDATARIA</option>
						<option value="5">MANTENIMIENTO CORRECTIVO</option>
		        	</select>
		            <div class="errmsg" id="error_service_id"></div>
				</div>
		       	<div class="col-sm-6">
		            <label for="ciudad_id">CIUDAD:</label>
					<select name="ciudad_id" class="form-control" id="ciudad_id" onchange="getSucursales()" required>
						<option value="99">TODOS</option>
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
		            <button type="button" id="buscarPeticion" class="btn btn-small btn_center">BUSCAR<span class="glyphicon glyphicon-chevron-right"></span></button>
					<!-- <button type="button" id="delPermisos" class="btn btn-small btn_center">QUITAR PERMISO<span class="glyphicon glyphicon-chevron-right"></span></button> -->
			        <div class="progress" id="progress">
						<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-12">
		            <br>
		            <div id="tbl_entidad_solicitud"></div>
		            <div id="tbl_entidad_gestion">		            	
		            <?php
		            	if(isset($peticiones) && count($peticiones)>0)
							echo '<label for="permisos">SE ENCUENTRA '.count($peticiones).' PETICIONES:</label><br>';
						else
							echo '<label for="permisos">SE ENCUENTRA 0 PETICIONES:</label><br>';
						?>
		            	<div class="row tbl_row_heading">
							<div class="col-sm-3">
								<h6>ID</h6>
							</div>				
							<div class="col-sm-3">
								<h6>DETALLES</h6>
							</div>						
							<div class="col-sm-3">						
								<h6>SOLICITADO POR</h6>
							</div>
							<div class="col-sm-2">						
								<h6>TECNICO</h6>
							</div>
							<div class="col-sm-1">
								<h6>ACTIVO</h6>
							</div>
						</div>
						<?php 
						
						if(isset($peticiones) && count($peticiones)>0)
						{
							for($x=0;$x<count($peticiones);$x++)
							{
						?>
								<div class="row tbl_row_data_static" style="font-size:12px;line-height: 20px;">
									<div class="col-sm-3">										
										<a href=atender.php?peticion=<?php echo $peticiones[$x][0];?>><?php echo $peticiones[$x][0];?></a>
									</div>				
									<div class="col-sm-3">		
										<?php echo $peticiones[$x][12].'<br>';?>
										<?php echo $peticiones[$x][13].'<br>';?>
										<?php echo '--------DESC---------<br>';?>							
										<?php echo $peticiones[$x][6];?>
									</div>
									<div class="col-sm-3">
										<?php echo '<b>USR : </b>'.$peticiones[$x][11].',';?><br>
										<?php echo '<b>CLI : </b>'.$peticiones[$x][2].',';?><br>
										<?php echo '<b>CIU : </b>'.$peticiones[$x][3].',';?><br>
										<?php echo '<b>SUC : </b>'.$peticiones[$x][4].',';?><br>				
										<?php echo '<b>SAL : </b>'.$peticiones[$x][10];?><br>
									</div>
									<div class="col-sm-2">									
										<?php 
											if($_SESSION["client_id"]==1)
												echo $peticiones[$x][9].'<a href=asignarPeticiones.php?client_id='.$peticiones[$x][14].'&peticion='.$peticiones[$x][0].'><span class="glyphicon glyphicon-pencil glyphicon_edit"></span></a> ';
											else
												echo $peticiones[$x][9];
										?>
									</div>
									<div class="col-sm-1 text-center">
										<?php if($peticiones[$x][7]==1) echo 'ABIERTA'; else if($peticiones[$x][7]==2) echo 'EN CURSO'; else echo 'CERRADA';?>
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
			<br>







		</div>
	</div>
</div>
