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
					<h2 class="page_title">ADMINISTRAR SUCURSAL</h2>
				</div>
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="sucursal_name">NOMBRE SUCURSAL:</label>
						<input type="text" class="form-control" id="sucursal_name">
						<div class="errmsg" id="error_sucursal_name"></div>
						<input type="hidden" id="id_sucursal" name="id_sucursal">
						<div id="sucursalPanel">
							<label for="idCiudad">CIUDAD DEL SUCURSAL:</label>
							<select name="idCiudad" class="form-control" id="idCiudad" required>
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
			            </div>
			            <div id="editSucursalPanel">
				            <button type="button" id="editSucursal" class="btn btn-small btn_center">EDITAR SUCURSAL<span class="glyphicon glyphicon-chevron-right"></span></button>
				            <button type="button" id="cancelEditSucursal" class="btn btn-small btn_center">CANCEL<span class="glyphicon glyphicon-chevron-right"></span></button>
						</div>
						<button type="button" id="addSucursal" class="btn btn-small btn_center">AGREGAR SUCURSAL<span class="glyphicon glyphicon-chevron-right"></span></button>
						<div class="progress" id="progress">
							<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
						</div>
				    </div>	
				</div>	
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-9">
					<div id="tbl_entidad"><?php echo $message;?></div>
					<div class="row tbl_row_heading">
						<div class="col-sm-1">
							<h4>ID</h4>
						</div>				
						<div class="col-sm-4">
							<h4>NOMBRE SUCURSAL</h4>
						</div>
						<div class="col-sm-4">
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
						
						if(isset($sucursal) && count($sucursal)>0)
						{
							for($x=0;$x<count($sucursal);$x++)
							{
					?>
							<div class="row tbl_row_data">
								<div class="col-sm-1">
									<?php echo $sucursal[$x][0];?>
								</div>				
								<div class="col-sm-4">
									<?php echo '<a href="#" onclick=habilitarEditSucursal("'.$sucursal[$x][0].'","'.urlencode($sucursal[$x][1]).'")><span class="glyphicon glyphicon-pencil glyphicon_edit"></span></a>';?>
									<?php echo $sucursal[$x][1];?>
								</div>
								<div class="col-sm-4">
									<?php echo $sucursal[$x][3];?>
								</div>
								<div class="col-sm-2">
									<?php if($sucursal[$x][4]==0) echo 'NO'; else echo 'SI';?>
								</div>
								<div class="col-sm-1">
									<!-- <a href="#" onclick=delPerfil("<?php echo $perfil[$x][0];?>","<?php echo $perfil[$x][1];?>")><span class="glyphicon glyphicon-remove"></span></a> -->
									<?php echo '<a href="#" onclick=delSucursal("'.$sucursal[$x][0].'","'.urlencode($sucursal[$x][1]).'")><span class="glyphicon glyphicon-remove"></span></a>';?>
									
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