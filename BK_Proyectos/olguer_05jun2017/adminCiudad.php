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
					<h2 class="page_title">ADMINISTRAR CIUDAD</h2>
				</div>
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="ciudad_name">NOMBRE DEL CIUDAD:</label>
						<input type="text" class="form-control" id="ciudad_name">
						<input type="hidden" id="id_ciudad" name="id_ciudad">
						<div class="errmsg" id="error_ciudad_name"></div>
						<div id="editCiudadPanel">
							<button type="button" id="editCiudad" class="btn btn-small btn_center">EDITAR CIUDAD<span class="glyphicon glyphicon-chevron-right"></span></button>
							<button type="button" id="cancelEditCiudad" class="btn btn-small btn_center">CANCEL<span class="glyphicon glyphicon-chevron-right"></span></button>
						</div>
						<button type="button" id="addCiudad" class="btn btn-small btn_center">AGREGAR CIUDAD<span class="glyphicon glyphicon-chevron-right"></span></button>
						<div class="progress" id="progress">
							<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
						</div>
				    </div>	
				</div>	
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<div id="tbl_entidad"><?php echo $message;?></div>
					<div class="row tbl_row_heading">
						<div class="col-sm-2">
							<h4>ID</h4>
						</div>				
						<div class="col-sm-8">
							<h4>NOMBRE CIUDAD</h4>
						</div>
						<div class="col-sm-2">
							<h4></h4>
						</div>
					</div>
					<?php 
						$ciudad = $controller->getCiudad($databasecon,$DEBUG_STATUS);
						if(isset($ciudad) && count($ciudad)>0)
						{
							for($x=0;$x<count($ciudad);$x++)
							{
					?>

							<div class="row tbl_row_data">
								<div class="col-sm-2">
									<?php echo $ciudad[$x][0];?>
								</div>				
								<div class="col-sm-8">
									<?php echo $ciudad[$x][1];?>
								</div>
								<div class="col-sm-2">
									<!-- <a href="#" onclick=delCiudad('<?php echo $ciudad[$x][0];?>',urlencode('<?php echo $ciudad[$x][1];?>'))><span class="glyphicon glyphicon-remove"></span></a> -->
									<?php echo '<a href="#" onclick=delCiudad("'.$ciudad[$x][0].'","'.urlencode($ciudad[$x][1]).'")><span class="glyphicon glyphicon-remove"></span></a>';?>
									<?php echo '<a href="#" onclick=habilitarEditCiudad("'.$ciudad[$x][0].'","'.urlencode($ciudad[$x][1]).'")><span class="glyphicon glyphicon-pencil"></span></a>';?>
									<!-- <a href="#"><span class="glyphicon glyphicon-pencil"></span></a> -->
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