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
	$peticionId=0;
	if(isset($_POST["submitted"]))
	{
		$clientId=$_POST["searchClientId"];
		$peticionId=$_POST["searchPeticionId"];
	}
	else
	{
		if(isset($_GET["client_id"]))
			$clientId=$_GET["client_id"];
		if(isset($_GET["peticion"]))
			$peticionId=$_GET["peticion"];
	}
	$client=$controller->getClientById($databasecon,$clientId,$DEBUG_STATUS);
	$peticiones = $controller->getPeticionesByClient($databasecon,$clientId,$peticionId,$DEBUG_STATUS);
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
					<h2 class="page_title">ASIGNAR PETICIONES</h2>
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
            <form action="asignarPeticiones.php" method="post">
            	<input type="hidden" name="submitted" value="true">
	            <div class="row">
					<div class="col-sm-12">
						<input type="hidden" class="form-control" name="searchClientId" value=<?php echo $clientId;?>>
			            <label for="ciudad_id">BUSCAR PETICION:</label>
						<input type="text" class="form-control" name="searchPeticionId" value=<?php echo $peticionId;?> placeholder="Ingresa nro de peticion para buscar o numeral cero para traer todos los peticiones">
			        </div>
				</div>
				 <div class="row">
					<div class="col-sm-12">
						<button type="submit" id="buscarPeticionPorId" class="btn btn-small btn_center">BUSCAR PETICION<span class="glyphicon glyphicon-chevron-right"></span></button>
					</div>
				</div>
			</form>
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
					<button type="button" id="asignarTecnicoParaPeticion" class="btn btn-small btn_center">ASIGNAR TECNICO<span class="glyphicon glyphicon-chevron-right"></span></button>
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
				<div class="col-sm-12">
					<div id="tbl_entidad"></div>
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
										<?php echo '<input type="checkbox" onchange=addToListList("'.$peticiones[$x][0].'")>';?>									
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
										<?php echo $peticiones[$x][9];?>
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

			<br>
			<br>
			<br>





		</div>
	</div>
</div>