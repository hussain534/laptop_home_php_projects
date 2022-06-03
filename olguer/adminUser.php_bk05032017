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
	$perfil = $controller->getPerfils($databasecon,$DEBUG_STATUS);
	/*$clientes = $controller->getClientesList($databasecon,$DEBUG_STATUS);*/
	$clientes = $controller->getClientes($databasecon,$DEBUG_STATUS);
	//$ciudad = $controller->getCiudad($databasecon,$DEBUG_STATUS);
	$sucursal = $controller->getSucursales($databasecon,$DEBUG_STATUS);
	$salas = $controller->getSalas($databasecon,$DEBUG_STATUS);
	//$users = $controller->getUsers($databasecon,$DEBUG_STATUS);
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
					<h2 class="page_title">ADMINISTRAR USUARIOS</h2>
				</div>
			</div>
			<br>
			<input type="hidden" id="user_id" name="user_id">
			<div id="tbl_entidad_gestion"></div>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<label for="user_name">NOMBRE:</label>
					<input type="text" class="form-control" id="user_name">
					<div class="errmsg" id="error_user_name"></div>
				</div>
				<div class="col-sm-6">
					<label for="user_email">CORREO ELECTRONICO:</label>
					<input type="text" class="form-control" id="user_email">
					<div class="errmsg" id="error_user_email"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<label for="user_tele">TELEFONO:</label>
					<input type="text" class="form-control" id="user_tele">
					<div class="errmsg" id="error_user_tele"></div>
				</div>
				<div class="col-sm-6">
					<label for="user_celular">CELULAR:</label>
					<input type="text" class="form-control" id="user_celular">
					<div class="errmsg" id="error_user_celular"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<label for="user_direccion">DIRECCION:</label>
					<input type="text" class="form-control" id="user_direccion">
					<div class="errmsg" id="error_user_direccion"></div>
				</div>
				<div class="col-sm-6">
					<label for="perfil_id">PERFIL:</label>
					<select name="perfil_id" class="form-control" id="perfil_id" required>
						<option value="99">Elige PERFIL</option>
						<?php 								
							if(isset($perfil) && count($perfil)>0)
							{
								for($x=0;$x<count($perfil);$x++)
								{
									echo '<option value='.$perfil[$x][0].'>['.$perfil[$x][0].']['.$perfil[$x][1].']</option>';
								}
							}
						?>
		        	</select>
		            <div class="errmsg" id="error_perfil"></div>
		        </div>
		    </div>
		    <div class="row">
		    	<div class="col-sm-6">
		            <label for="client_id">CLIENTE:</label>
					<select name="client_id" class="form-control"  onchange="getCiudad()" id="client_id" required>
					<option value="99">Elige CLIENTE</option>
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
					<select name="ciudad_id" class="form-control" id="ciudad_id" onchange="getSucursales()" required>
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
		    	<div class="col-sm-12">
		    		 <label for="supervision_id">PERMITA SUPERVISION DE PETICIONES DE :</label>
		    		<select name="supervision_id" class="form-control" id="supervision_id" required>
			    		<option value="0">SOLO DE EL</option>
			    		<option value="1">SU EMPRESA</option>
			    		<option value="2">SU CIUDAD</option>
			    		<option value="3">SU SUCURSAL</option>
			    		<option value="4">SU SALA</option>			    		
					</select>
		    	</div>
		    </div>
		    <div class="row">
		    	<div class="col-sm-6">
		            <?php
		            	if(isset($message))
		            		echo '<h4>'.$message.'</h4>'
		            ?>
		            <button type="button" id="addUser" class="btn btn-small btn_center">AGREGAR USUARIO<span class="glyphicon glyphicon-chevron-right"></span></button>
		            <button type="button" id="buscarUser" class="btn btn-small btn_center">BUSCAR<span class="glyphicon glyphicon-chevron-right"></span></button>
					<!-- <button type="button" id="delPermisos" class="btn btn-small btn_center">QUITAR PERMISO<span class="glyphicon glyphicon-chevron-right"></span></button> -->
			        <div id="editUserPanel">
			        	<button type="button" id="editUser" class="btn btn-small btn_center">EDITAR USUARIO<span class="glyphicon glyphicon-chevron-right"></span></button>
			        	<button type="button" id="cancelEditUser" class="btn btn-small btn_center">CANCEL<span class="glyphicon glyphicon-chevron-right"></span></button>
			        </div>
			        <div class="progress" id="progress">
						<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
		            <br><br>
		            <div id="tbl_entidad_solicitud"></div>
		            <div id="tbl_entidad">
		            	<label for="permisos">
		            		<?php
		            			if(isset($users) && count($users)>0)
		            				echo '<label for="permisos">SE ENCUENTRA '.count($users).' USUARIOS:</label><br>';
		            			else
		            				echo '<label for="permisos">SE ENCUENTRA 0 USUARIOS:</label><br>';
		            		?>
		            	</label><br>
		            	<div class="row tbl_row_heading">
							<div class="col-sm-1" style="width:3%">
								<h6>ID</h6>
							</div>				
							<div class="col-sm-2">
								<h6>NOMBRE</h6>
							</div>
							<div class="col-sm-3">
								<h6>CONTACTOS</h6>
							</div>
							<div class="col-sm-2">
								<h6>PERFIL</h6>
							</div>
							<div class="col-sm-3">
								<h6>UBICACION OFICIAL</h6>
							</div>						
							<div class="col-sm-1">
								<h6>HABILITADO</h6>
							</div>
						</div>
						<?php 
						
						if(isset($users) && count($users)>0)
						{
							for($x=0;$x<count($users);$x++)
							{
						?>
								<div class="row tbl_row_data" style="font-size:12px">
									<div class="col-sm-1" style="width:3%">
										<?php echo $users[$x][0];?>
									</div>				
									<div class="col-sm-2">									
										<?php echo $users[$x][1];?>
									</div>
									<div class="col-sm-3">
										<?php echo $users[$x][2];?><br>
										<?php echo $users[$x][3];?><br>
										<?php echo $users[$x][4];?><br>
										<?php echo $users[$x][5];?><br>
									</div>
									<div class="col-sm-2">									
										<?php echo $users[$x][6];?>
									</div>
									<div class="col-sm-3">									
										<?php echo $users[$x][8];?><br>
										<?php echo $users[$x][9];?><br>				
										<?php echo $users[$x][10];?><br>
									</div>
									<div class="col-sm-1 text-center">
										<?php if($users[$x][11]==0) echo 'NO'; else echo 'SI';?>
										<!--<?php echo '<a href="#" onclick=delCliente("'.$users[$x][0].'","'.urlencode($users[$x][1]).'")><span class="glyphicon glyphicon-remove glyphicon_edit"></span></a>';?>-->
										<?php echo '<a href="#" onclick=habilitarEditUser("'.$users[$x][0].'","'.urlencode($users[$x][1]).'","'.$users[$x][2].'","'.urlencode($users[$x][3]).'","'.urlencode($users[$x][4]).'","'.urlencode($users[$x][5]).'","'.urlencode($users[$x][12]).'","'.urlencode($users[$x][13]).'","'.urlencode($users[$x][14]).'","'.urlencode($users[$x][15]).'","'.urlencode($users[$x][16]).'","'.urlencode($users[$x][17]).'")><span class="glyphicon glyphicon-pencil glyphicon_edit"></span></a>';?>
									</div>
								</div>
						<?php	
								}	
							}
						?>
		            </div>
				</div>	
			</div>			
			<br>
			<br>
			<br>







		</div>
	</div>
</div>