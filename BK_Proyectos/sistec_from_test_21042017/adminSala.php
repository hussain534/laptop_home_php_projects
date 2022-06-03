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
	$ciudad = $controller->getCiudad($databasecon,$DEBUG_STATUS);
	$sucursal = $controller->getSucursales($databasecon,$DEBUG_STATUS);
	$sala = $controller->getSalas($databasecon,$DEBUG_STATUS);
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
					<h2 class="page_title">ADMINISTRAR SALA</h2>
				</div>
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="sala_name">NOMBRE SALA:</label>
						<input type="text" class="form-control" id="sala_name">
						<div class="errmsg" id="error_sala_name"></div>
						<input type="hidden" id="id_sala" name="id_sala">

						<div id="salaPanel">
							<label for="ciudad_id">CIUDAD DEL SUCURSAL:</label>
							<select name="ciudad_id" class="form-control" id="ciudad_id" onchange="getSucursales()" required>
								<option value="0">Elige ciudad del sucursal</option>
							<?php
						        if(isset($ciudad) && count($ciudad)>0)
								{
									for($x=0;$x<count($ciudad);$x++)
									{
										echo "<option value='".$ciudad[$x][0]."'>".'['.$ciudad[$x][0].'] '.$ciudad[$x][1]."</option>";
									}
								}
					        ?>
				        	</select>
				            <div class="errmsg" id="error_ciudad"></div>

							<label for="sucursal_id">SUCURSAL:</label>
							<select name="sucursal_id" class="form-control" id="sucursal_id" required>
								<option value="0">Elige SUCURSAL</option>
				        	</select>
				            <div class="errmsg" id="error_sucursal"></div>
			            </div>

			            <div id="editSalaPanel">
				            <button type="button" id="editSala" class="btn btn-small btn_center">EDITAR SALA<span class="glyphicon glyphicon-chevron-right"></span></button>
				            <button type="button" id="cancelEditSala" class="btn btn-small btn_center">CANCEL<span class="glyphicon glyphicon-chevron-right"></span></button>
						</div>
						<button type="button" id="addSala" class="btn btn-small btn_center">AGREGAR SALA<span class="glyphicon glyphicon-chevron-right"></span></button>
						<div class="progress" id="progress">
							<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
						</div>
				    </div>	
				</div>	
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-11">
					<div id="tbl_entidad_solicitud"></div>
					<div id="tbl_entidad"><?php echo $message;?></div>
					<div class="row tbl_row_heading">
						<div class="col-sm-1">
							<h4>ID</h4>
						</div>
						<div class="col-sm-3">
							<h4>NOMBRE SALA</h4>
						</div>				
						<div class="col-sm-3">
							<h4>NOMBRE SUCURSAL</h4>
						</div>
						<div class="col-sm-2">
							<h4>CIUDAD</h4>
						</div>
						<div class="col-sm-2">
							<h4>HABILITADO</h4>
						</div>
						<div class="col-sm-1">
							<h4></h4>
						</div>
					</div>
					<?php 
						
						if(isset($sala) && count($sala)>0)
						{
							for($x=0;$x<count($sala);$x++)
							{
					?>
							<div class="row tbl_row_data">
								<div class="col-sm-1">
									<?php echo $sala[$x][0];?>
								</div>				
								<div class="col-sm-3">
									<?php echo '<a href="#" onclick=habilitarEditSala("'.$sala[$x][0].'","'.urlencode($sala[$x][1]).'")><span class="glyphicon glyphicon-pencil glyphicon_edit"></span></a>';?>
									<?php echo $sala[$x][1];?>
								</div>
								<div class="col-sm-3">
									<?php echo $sala[$x][3];?>
								</div>
								<div class="col-sm-2">
									<?php echo $sala[$x][5];?>
								</div>
								<div class="col-sm-2 text-center">
									<?php if($sala[$x][6]==0) echo 'NO'; else echo 'SI';?>
								</div>
								<div class="col-sm-1">
									<!-- <a href="#" onclick=delPerfil("<?php echo $perfil[$x][0];?>","<?php echo $perfil[$x][1];?>")><span class="glyphicon glyphicon-remove"></span></a> -->
									<?php echo '<a href="#" onclick=delSala("'.$sala[$x][0].'","'.urlencode($sala[$x][1]).'")><span class="glyphicon glyphicon-remove"></span></a>';?>
									
								</div>
							</div>
					<?php	
							}	
						}
					?>
				</div>
			</div>







		</div>
	</div>
</div>
