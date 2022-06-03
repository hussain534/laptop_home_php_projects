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
	$perfil = $controller->getPerfils($databasecon,$DEBUG_STATUS);
	$permisos = $controller->getAllPermisos($databasecon,$DEBUG_STATUS);
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
					<h2 class="page_title">ADMINISTRAR PERMISOS</h2>
				</div>
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="menu_id">MENU:</label>
						<select name="menu_id" class="form-control" id="menu_id" onchange="getPermisos()" required>
							<option value="99">Elige MENU</option>
							<?php 								
								if(isset($menuObj) && count($menuObj)>0)
								{
									for($x=0;$x<count($menuObj);$x++)
									{
										echo '<option value='.$menuObj[$x][4].'>['.$menuObj[$x][0].']['.$menuObj[$x][2].']</option>';
									}
								}
							?>
			        	</select>
			            <div class="errmsg" id="error_menu_id"></div>

			            <label for="perfil">PERFIL:</label>
						<select name="perfil" class="form-control" id="perfil"  required>
							<option value="99">Elige PERFIL</option>
							<?php 								
								if(isset($perfil) && count($perfil)>0)
								{
									for($x=0;$x<count($perfil);$x++)
									{
										echo '<option value='.$perfil[$x][0].'>'.$perfil[$x][1].'->'.$perfil[$x][2].'</option>';
									}
								}
							?>
			        	</select>
			            <div class="errmsg" id="error_perfil"></div>
			            <?php
			            	if(isset($message))
			            		echo '<h4>'.$message.'</h4>'
			            ?>
			            <button type="button" id="addPermisos" class="btn btn-small btn_center">AGREGAR PERMISO<span class="glyphicon glyphicon-chevron-right"></span></button>
						<!-- <button type="button" id="delPermisos" class="btn btn-small btn_center">QUITAR PERMISO<span class="glyphicon glyphicon-chevron-right"></span></button> -->
				        <div class="progress" id="progress">
							<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
						</div>

			            <br><br>

			            <label for="permisos">PERMISOS APLICADOS:</label><br>
			            <div id="tbl_entidad">
			            	<div class="row tbl_row_heading">
								<div class="col-sm-6">
									<h4>MENU</h4>
								</div>				
								<div class="col-sm-6">
									<h4>PERFIL</h4>
								</div>
							</div>
							<?php
							if(isset($permisos) && count($permisos)>0)	
							{	
								for($x=0;$x<count($permisos);$x++)
								{
									?>
									<div class="row tbl_row_data">
										<div class="col-sm-6">
											<?php echo $permisos[$x][1];?>
										</div>
										<div class="col-sm-6">
											<?php echo $permisos[$x][2];?>
											<a href="#" onclick=delPermisos('<?php echo $permisos[$x][3];?>','<?php echo $permisos[$x][4];?>')><span class="glyphicon glyphicon-remove"></span></a>
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
			<!-- <div class="row">
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
								<div class="col-sm-2 text-center">
									<?php 
										if($menuObj[$x][5]==0) 
										{
											$strEnabled='habilitar';
											echo 'NO'; 
										}
										else 
										{
											$strEnabled='deshabilitar';
											echo 'SI';
										}
									?>
									<?php echo '<a href="#" onclick=delMenu("'.$menuObj[$x][4].'","'.urlencode($menuObj[$x][2]).'","'.$strEnabled.'")><span class="glyphicon glyphicon-remove glyphicon_edit"></span></a>';?>
									<?php echo '<a href="#" onclick=habilitarEditMenu("'.$menuObj[$x][4].'","'.$menuObj[$x][0].'","'.$menuObj[$x][1].'","'.$menuObj[$x][2].'","'.$menuObj[$x][3].'")><span class="glyphicon glyphicon-pencil glyphicon_edit"></span></a>';?>
									
								</div>
							</div>
					<?php	
							}	
						}
					?>
				</div>
			</div> -->
			<br>
			<br>
			<br>







		</div>
	</div>
</div>