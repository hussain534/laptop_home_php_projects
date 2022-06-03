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
	if(isset($_GET["tipo_cliente"]))
	{
		if($_GET["tipo_cliente"]==1)
			$clientes = $controller->getClientesByTipo($databasecon,1,$DEBUG_STATUS);
		else if($_GET["tipo_cliente"]==2)
			$clientes = $controller->getClientesByTipo($databasecon,2,$DEBUG_STATUS);
		else if($_GET["tipo_cliente"]==0)
			$clientes = $controller->getClientesByTipo($databasecon,0,$DEBUG_STATUS);
	}
	else
		$clientes = $controller->getClientes($databasecon,$DEBUG_STATUS);
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
					<h2 class="page_title">ADMINISTRAR CLIENTE</h2>
				</div>
			</div>
			<br>
			<?php
				if($_SESSION["user_perfil"]<=2 && $_SESSION["client_id"]==1)
				{
					$clientesRenales = $controller->getClientesByTipo($databasecon,1,$DEBUG_STATUS);
					$clientesLaboratorios = $controller->getClientesByTipo($databasecon,2,$DEBUG_STATUS);
					$clientesNoClasificados = $controller->getClientesByTipo($databasecon,0,$DEBUG_STATUS);
			?>
			<div class="row">
				<div class="col-sm-4 text-center">
					<a href="adminClientes.php?tipo_cliente=1">
						<img src="images/icons/tasks.png" id="dash_img">
						<span class="badge"><?php echo count($clientesRenales);?></span><br>
						<!-- <button type="button">PENDIENTES</button> -->
						<button type="button" class="btn btn-small btn_center">RENAL<span class="glyphicon glyphicon-chevron-right"></span></button>
					</a>
				</div>
				<div class="col-sm-4 text-center">
					<a href="adminClientes.php?tipo_cliente=2">
						<img src="images/icons/tasks.png" id="dash_img">
						<span class="badge"><?php echo count($clientesLaboratorios);?></span><br>
						<!-- <button type="button">EN CURSO</button> -->
						<button type="button" class="btn btn-small btn_center">LABORATORIO<span class="glyphicon glyphicon-chevron-right"></span></button>
					</a>
				</div>
				<div class="col-sm-4 text-center">
					<a href="adminClientes.php?tipo_cliente=0">
						<img src="images/icons/tasks.png" id="dash_img">
						<span class="badge"><?php echo count($clientesNoClasificados);?></span><br>
						<!-- <button type="button">ATENDIDAS </button> -->
						<button type="button" class="btn btn-small btn_center">NO CLASIFICADOS<span class="glyphicon glyphicon-chevron-right"></span></button>
					</a>
				</div>
			</div>
			<?php
			}
			?>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<div id="editClientePanel">
							<label for="client_name">NOMBRE DEL CLIENTE:</label>
							<input type="text" class="form-control" id="client_name">
							<div class="errmsg" id="error_client_name"></div>
							<input type="hidden" id="id_cliente" name="id_cliente">

							<label for="ciudad_cliente">CIUDAD DE MATRIZ:</label>
							<select name="ciudad_cliente" class="form-control" id="ciudad_cliente"  required>
								<option value="0">Elige ciudad</option>
							<?php
								$ciudad = $controller->getCiudad($databasecon,$DEBUG_STATUS);
						        if(isset($ciudad) && count($ciudad)>0)
								{
									for($x=0;$x<count($ciudad);$x++)
									{
										echo "<option value='".$ciudad[$x][0]."'>".'['.$ciudad[$x][0].'] '.$ciudad[$x][1]."</option>";
									}
								}
					        ?>
				        	</select>
				            <div class="errmsg" id="error_ciudad_cliente"></div>

				            <label for="client_admin">NOMBRE ADMIN:</label>
							<input type="text" class="form-control" id="client_admin">
							<input type="hidden" class="form-control" id="admin_id">
							<div class="errmsg" id="error_client_admin"></div>

				            <label for="client_telefono">TELEFONO:</label>
							<input type="text" class="form-control" id="client_telefono">
							<div class="errmsg" id="error_client_telefono"></div>

							<label for="client_celular">CELULAR:</label>
							<input type="text" class="form-control" id="client_celular">
							<div class="errmsg" id="error_client_celular"></div>

							<label for="client_email">CORREO-ELECTRONICO:</label>
							<input type="email" class="form-control" id="client_email">
							<div class="errmsg" id="error_client_email"></div>
			            
				            <button type="button" id="editCliente" class="btn btn-small btn_center">EDITAR CLIENTE<span class="glyphicon glyphicon-chevron-right"></span></button>
				            <button type="button" id="cancelEditCliente" class="btn btn-small btn_center">CANCEL<span class="glyphicon glyphicon-chevron-right"></span></button>
						</div>
						<!-- <button type="button" id="addCliente" class="btn btn-small btn_center">AGREGAR CLIENTE<span class="glyphicon glyphicon-chevron-right"></span></button> -->
						<div class="progress" id="progress">
							<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
						</div>
				    </div>	
				</div>	
			</div>
			<div class="row">
				<div class="col-sm-10">
					<div id="tbl_entidad"><?php echo $message;?></div>
					<?php
						if(isset($clientes) && count($clientes)>0)
						{
							echo '<h5> SE ENCUENTRA '.count($clientes).' CLIENTE/S ';
							if(isset($_GET["tipo_cliente"]))
							{	
								if($_GET["tipo_cliente"]==1)
									echo ' DE TIPO - RENAL';
								else if($_GET["tipo_cliente"]==2)
									echo ' DE TIPO - LABORATORIO';
								else if($_GET["tipo_cliente"]==0)
									echo ' DE TIPO - NO CLASIFICADO';
							}
						}
					?>
					<br>
					<br>
					<div class="row tbl_row_heading">
						<div class="col-sm-1">
							<h4>ID</h4>
						</div>				
						<div class="col-sm-3">
							<h4>NOMBRE</h4>
						</div>
						<div class="col-sm-2">
							<h4>CIUDAD</h4>
						</div>
						<div class="col-sm-4">
							<h4>CONTACTO</h4>
						</div>
						<div class="col-sm-2">
							<h4>HABILITADO</h4>
						</div>
					</div>
					<?php 
						
						if(isset($clientes) && count($clientes)>0)
						{
							for($x=0;$x<count($clientes);$x++)
							{
					?>
							<div class="row tbl_row_data">
								<div class="col-sm-1">
									<?php echo $clientes[$x][0];?>
								</div>				
								<div class="col-sm-3">									
									<?php
										if($_SESSION["user_perfil"]==1)
										{
											echo '<a href=aprobarCliente.php?client_id='.$clientes[$x][0].'>'.$clientes[$x][1].'</a>';
										}
										else
										{
											echo $clientes[$x][1];
										}
										$sucursalesPendientes = $controller->getSucursalesByClientId($databasecon,0,$clientes[$x][0],$DEBUG_STATUS);
										if(isset($sucursalesPendientes) && count($sucursalesPendientes)>0)
											echo '<br><span class="glyphicon glyphicon-user glyphicon_margin glyphicon_edit" title="total sucursales pendientes asignar tecnicos"></span>'.count($sucursalesPendientes);
										else
											echo '<br><span class="glyphicon glyphicon-user glyphicon_margin glyphicon_edit" title="total sucursales pendientes asignar tecnicos"></span>0';
									?>
								</div>
								<div class="col-sm-2">
									<?php echo $clientes[$x][6];?>
								</div>
								<div class="col-sm-4">
									<?php 
										echo '<span class="glyphicon glyphicon-user glyphicon_margin"></span><i>'.$clientes[$x][8].'</i><br>';
										echo '<span class="glyphicon glyphicon-earphone glyphicon_margin"></span><i>'.$clientes[$x][3].'</i><br>';
										echo '<span class="glyphicon glyphicon-phone glyphicon_margin"></span><i>'.$clientes[$x][4].'</i><br>';
										echo '<span class="glyphicon glyphicon-envelope glyphicon_margin"></span><i>'.$clientes[$x][5].'</i><br>';
									?>
								</div>
								<div class="col-sm-2 text-center">
									<?php if($clientes[$x][7]==0) echo 'NO'; else echo 'SI';?>
									<!-- <a href="#" onclick=delPerfil("<?php echo $perfil[$x][0];?>","<?php echo $perfil[$x][1];?>")><span class="glyphicon glyphicon-remove"></span></a> -->
									
									<?php 
										if($_SESSION["client_id"]==1)
											echo '<a href="#" onclick=delCliente("'.$clientes[$x][0].'","'.urlencode($clientes[$x][1]).'")><span class="glyphicon glyphicon-remove glyphicon_edit"></span></a>';
									
										if($_SESSION["client_id"]!=1)
											echo '<a href="#" onclick=habilitarEditCliente("'.$clientes[$x][0].'","'.urlencode($clientes[$x][1]).'","'.urlencode($clientes[$x][8]).'","'.urlencode($clientes[$x][9]).'","'.urlencode($clientes[$x][3]).'","'.urlencode($clientes[$x][4]).'","'.$clientes[$x][5].'","'.urlencode($clientes[$x][2]).'")><span class="glyphicon glyphicon-pencil glyphicon_edit"></span></a>';
									?>
									
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