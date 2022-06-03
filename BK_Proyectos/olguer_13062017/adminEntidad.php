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
					<h2 class="page_title">ADMINISTRAR ENTIDAD</h2>
				</div>
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
				      <label for="entidad_name">NOMBRE DEL ENTIDAD:</label>
				      <input type="text" class="form-control" id="entidad_name">
				      <div class="errmsg" id="error_entidad_name"></div>
				      <button type="button" id="addEntidad" class="btn btn-small btn_center">AGREGAR ENTIDAD<span class="glyphicon glyphicon-chevron-right"></span></button>
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
							<h4>NOMBRE ENTIDAD</h4>
						</div>
						<div class="col-sm-2">
							<h4></h4>
						</div>
					</div>
					<?php 
						$entidad = $controller->getEntidad($databasecon,$DEBUG_STATUS);
						if(isset($entidad) && count($entidad)>0)
						{
							for($x=0;$x<count($entidad);$x++)
							{
					?>

							<div class="row tbl_row_data">
								<div class="col-sm-2">
									<?php echo $entidad[$x][0];?>
								</div>				
								<div class="col-sm-8">
									<?php echo $entidad[$x][1];?>
								</div>
								<div class="col-sm-2">
									<a href="#" onclick=delEntidad('<?php echo $entidad[$x][0];?>','<?php echo $entidad[$x][1];?>')><span class="glyphicon glyphicon-remove"></span></a>
									<a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
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