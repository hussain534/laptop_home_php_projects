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
	$perfil = $controller->getPerfils($databasecon,$DEBUG_STATUS);
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
					<h2 class="page_title">ADMINISTRAR PERFIL</h2>
				</div>
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="perfil_name">NOMBRE DEL PERFIL:</label>
						<input type="text" class="form-control" id="perfil_name">
						<div class="errmsg" id="error_perfil_name"></div>
						<input type="hidden" id="id_perfil" name="id_perfil">
						<div id="perfilPadrePanel">
							<label for="perfil_padre">PADRE DEL PERFIL:</label>
							<select name="idPerfilPadre" class="form-control" id="idPerfilPadre"  onchange="getStates()" required>
								<option value="0">Elige perfil padre</option>
								<option value="2">ADMIN</option>
							<?php
						        if(isset($perfil) && count($perfil)>0)
								{
									for($x=0;$x<count($perfil);$x++)
									{
										echo "<option value='".$perfil[$x][0]."'>".'['.$perfil[$x][0].'] '.$perfil[$x][1]."</option>";
									}
								}
					        ?>
				        	</select>
				            <div class="errmsg" id="error_perfil_padre"></div>
			            </div>
			            <div id="editPerfilPanel">
				            <button type="button" id="editPerfil" class="btn btn-small btn_center">EDITAR PERFIL<span class="glyphicon glyphicon-chevron-right"></span></button>
				            <button type="button" id="cancelEditPerfil" class="btn btn-small btn_center">CANCEL<span class="glyphicon glyphicon-chevron-right"></span></button>
						</div>
						<button type="button" id="addPerfil" class="btn btn-small btn_center">AGREGAR PERFIL<span class="glyphicon glyphicon-chevron-right"></span></button>
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
							<h4>NOMBRE PERFIL</h4>
						</div>
						<div class="col-sm-4">
							<h4>PADRE</h4>
						</div>
						<div class="col-sm-2">
							<h4>HABILITADO</h4>
						</div>
						<div class="col-sm-1">
							<h4></h4>
						</div>
					</div>
					<?php 
						
						if(isset($perfil) && count($perfil)>0)
						{
							for($x=0;$x<count($perfil);$x++)
							{
					?>
							<div class="row tbl_row_data">
								<div class="col-sm-1">
									<?php echo $perfil[$x][0];?>
								</div>				
								<div class="col-sm-4">
									<?php echo '<a href="#" onclick=habilitarEditPerfil("'.$perfil[$x][0].'","'.urlencode($perfil[$x][1]).'","'.urlencode($perfil[$x][4]).'")><span class="glyphicon glyphicon-pencil glyphicon_edit"></span></a>';?>
									<?php echo $perfil[$x][1];?>
								</div>
								<div class="col-sm-4">
									<?php echo $perfil[$x][2];?>
								</div>
								<div class="col-sm-2">
									<?php if($perfil[$x][3]==0) echo 'NO'; else echo 'SI';?>
								</div>
								<div class="col-sm-1">
									<!-- <a href="#" onclick=delPerfil("<?php echo $perfil[$x][0];?>","<?php echo $perfil[$x][1];?>")><span class="glyphicon glyphicon-remove"></span></a> -->
									<?php echo '<a href="#" onclick=delPerfil("'.$perfil[$x][0].'","'.urlencode($perfil[$x][1]).'")><span class="glyphicon glyphicon-remove"></span></a>';?>
									
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