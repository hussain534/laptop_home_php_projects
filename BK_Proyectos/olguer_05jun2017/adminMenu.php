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
	$menuObj = $controller->getMenu($databasecon,$DEBUG_STATUS);
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
					<h2 class="page_title">ADMINISTRAR MENU</h2>
				</div>
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="menu_sec">SECUENCIAL:</label>
						<input type="text" class="form-control" id="menu_sec">
						<div class="errmsg" id="error_menu_sec"></div>
						<input type="hidden" id="id_menu" name="id_menu">
						<input type="hidden" id="old_menu_sec" name="old_menu_sec">

						<label for="menu_tipo">TIPO:</label>
						<select name="menu_tipo" class="form-control" id="menu_tipo"  required>
							<option value="99">Elige TIPO(PADRE / HIJO)</option>
							<option value="1">PADRE</option>
							<option value="0">HIJO</option>								
			        	</select>
			            <div class="errmsg" id="error_menu_tipo"></div>

			            <label for="menu_nombre">NOMBRE MENU:</label>
						<input type="text" class="form-control" id="menu_nombre">
						<div class="errmsg" id="error_menu_nombre"></div>

						<label for="menu_url">URL:</label>
						<input type="text" class="form-control" id="menu_url">
						<div class="errmsg" id="error_menu_url"></div>


			            <div id="editMenuPanel">
				            <button type="button" id="editMenu" class="btn btn-small btn_center">EDITAR MENU ITEM<span class="glyphicon glyphicon-chevron-right"></span></button>
				            <button type="button" id="cancelEditMenu" class="btn btn-small btn_center">CANCEL<span class="glyphicon glyphicon-chevron-right"></span></button>
						</div>
						<?php
							if($_SESSION["client_id"]==1)
							{
						?>
						<button type="button" id="addMenu" class="btn btn-small btn_center">AGREGAR MENU ITEM<span class="glyphicon glyphicon-chevron-right"></span></button>
						<?php
							}
						?>
						<div class="progress" id="progress">
							<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
						</div>
				    </div>	
				</div>	
			</div>
			<div class="row">
				<div class="col-sm-11">
					<div id="tbl_entidad"><?php echo $message;?></div>
					<div class="row tbl_row_heading">
						<div class="col-sm-1">
							<h4>ID</h4>
						</div>				
						<div class="col-sm-2">
							<h4>SECUENCIAL</h4>
						</div>
						<div class="col-sm-1">
							<h4>TIPO</h4>
						</div>
						<div class="col-sm-3">
							<h4>NOMBRE</h4>
						</div>
						<div class="col-sm-3">
							<h4>URL</h4>
						</div>
						<div class="col-sm-2">
							<h4>HABILITADO</h4>
							<h4></h4>
						</div>
					</div>
					<?php 
						
						if(isset($menuObj) && count($menuObj)>0)
						{
							for($x=0;$x<count($menuObj);$x++)
							{
					?>
							<div class="row tbl_row_data">
								<div class="col-sm-1">
									<?php echo $menuObj[$x][4];?>
								</div>				
								<div class="col-sm-2">									
									<?php echo $menuObj[$x][0];?>
								</div>
								<div class="col-sm-1">
									<?php echo $menuObj[$x][1];?>
								</div>
								<div class="col-sm-3">
									<?php echo $menuObj[$x][2];?>
								</div>
								<div class="col-sm-3">
									<?php echo $menuObj[$x][3];?>
								</div>
								<div class="col-sm-2 text-left">
									<?php 
										if($menuObj[$x][5]==0) 
										{
											$strEnabled='habilitar';
											echo '<span style="background:orange;padding:0 5px">NO</span>'; 
										}
										else 
										{
											$strEnabled='deshabilitar';
											echo '<span style="background:lightgreen;padding:0 5px">SI</span>';
										}

										/*if($menuObj[$x][1]==0)*/
										if($_SESSION["client_id"]==1)
										{
									?>
									<!-- <a href="#" onclick=delPerfil("<?php echo $perfil[$x][0];?>","<?php echo $perfil[$x][1];?>")><span class="glyphicon glyphicon-remove"></span></a> -->
									<?php echo '<a href="#" onclick=delMenu("'.$menuObj[$x][4].'","'.urlencode($menuObj[$x][2]).'","'.$strEnabled.'")><span class="glyphicon glyphicon-remove glyphicon_edit"></span></a>';?>
									<?php echo '<a href="#" onclick=habilitarEditMenu("'.$menuObj[$x][4].'","'.$menuObj[$x][0].'","'.$menuObj[$x][1].'","'.urlencode($menuObj[$x][2]).'","'.$menuObj[$x][3].'")><span class="glyphicon glyphicon-pencil glyphicon_edit"></span></a>';?>
									<?php
										}
									?>
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