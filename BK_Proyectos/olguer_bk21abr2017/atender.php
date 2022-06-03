<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    //include_once('util.php');
	include_once('config.php');	
	$session_time=$session_expirry_time;
	$DEBUG_STATUS = $PRINT_LOG;
	$PERFIL_ID_GERENTE_SISTEC=42;

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
	$peticionId=0;
	if(isset($_GET["peticion"]))
		$peticionId=$_GET["peticion"];

	//echo $peticionId.'<br>';

	//$peticiones = $controller->getPeticionDtl($databasecon,0,$_GET["estado"],$DEBUG_STATUS);
	$peticionHist = $controller->getPeticionComments($databasecon,$peticionId,$DEBUG_STATUS);
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
			<hr>
			<div class="row">
				<div class="col-sm-12">
					<h2 class="page_title">ATENDER PETICION</h2>					
				</div>
			</div>
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
			<div class="row">				
				<div class="col-sm-6" style="border-right:1px solid darkgrey">
					<div class="row">
						<div class="col-sm-12 text-center" style="background:#222;color:cornsilk">
							<h4>GESTION</h4>								
						</div>						
					</div>
					<div class="row">
						<div class="col-sm-12">
						<label for="peticion_id">NRO. PETICION :</label><br>
						<input type="text" class="form-control bg_lightgrey" value='<?php echo $peticionId;?>' id="peticion_id" disabled>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<label for="equipo_id">LISTA DE EQUIPOS</label>
							<select name="equipo_id" class="form-control bg_lightgreen" id="equipo_id" required>

							<?php
								$equipos = $controller->getEquiposEnPeticion($databasecon,$peticionId,$DEBUG_STATUS);
								if(isset($equipos) && count($equipos)>0)
								{
									echo '<option value="99">TODOS</option>';
									for($t=0;$t<count($equipos);$t++)
									{
										echo '<option value='.$equipos[$t][0].'>'.$equipos[$t][1].'</option>';
									}
								}
							?>
				        	</select>
				            <div class="errmsg" id="error_equipo_id"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<label for="estado_id">ESTADO DE PETICION</label>
							<select name="estado_id" class="form-control bg_lightgreen" id="estado_id" required>
								<option value="2">EN CURSO</option>
								<option value="3">CERRADA</option>
				        	</select>
				            <div class="errmsg" id="error_estado_id"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<label for="permisos">OBSERVACION TECNICO:</label><div class="errorMsg" id="text_size"></div>
							<textarea class="form-control bg_lightgreen" name="obser" id="obser" value="" rows="10" onkeypress="countTextSize()" placeholder="Ingresar detalle de peticion-1500 caracteres" maxlength=1500 required></textarea> 
							<div class="errmsg" id="error_obser"></div>
						</div>
					</div>
				    <div class="row">
				    	<div class="col-sm-12">
				            <?php
				         		//echo $peticionHist[0][4];
				            	if(isset($_SESSION["client_id"]) && $_SESSION["client_id"]==1 && (!isset($peticionHist[0][5]) || $peticionHist[0][5]<3))
				            	{
				            ?>

				            <button type="button" id="actPeticion" class="btn btn-small btn_center">ACTUALIZAR<span class="glyphicon glyphicon-chevron-right"></span></button>
				            <?php
				            	}
				            ?>
							<!-- <button type="button" id="delPermisos" class="btn btn-small btn_center">QUITAR PERMISO<span class="glyphicon glyphicon-chevron-right"></span></button> -->
					        <div class="progress" id="progress">
								<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-12 text-center" style="background:#222;color:cornsilk">
							<h4>DETALLES DE PETICION</h4>								
						</div>						
					</div>
					<div class="row">
						<div class="col-sm-12 hist-dtl">
							<?php
								//echo $peticionId.'<br>';
								$peticionDtl = $controller->getPeticionDtl($databasecon,$peticionId,$DEBUG_STATUS);
								if(isset($peticionDtl))
								{
									//echo count($peticionDtl);
							?>
								<div class="row">
									<div class="col-sm-4" style="padding:0">
										<?php echo 'NRO: PETICION:';?>
									</div>
									<div class="col-sm-8" style="padding:0">
										<?php echo $peticionDtl[0][0];?>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4" style="padding:0">
										<?php echo 'TIPO SERVICIO:';?>
									</div>
									<div class="col-sm-8" style="padding:0">
										<?php echo $peticionDtl[0][1];?>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4" style="padding:0">
										<?php echo 'CLIENTE:';?>
									</div>
									<div class="col-sm-8" style="padding:0">
										<?php echo $peticionDtl[0][2];?>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4" style="padding:0">
										<?php echo 'CIUDAD:';?>
									</div>
									<div class="col-sm-8" style="padding:0">
										<?php echo $peticionDtl[0][3];?>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4" style="padding:0">
										<?php echo 'SUCURSAL:';?>
									</div>
									<div class="col-sm-8" style="padding:0">
										<?php echo $peticionDtl[0][4];?>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4" style="padding:0">
										<?php echo 'SALA:';?>
									</div>
									<div class="col-sm-8" style="padding:0">
										<?php echo $peticionDtl[0][5];?>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4" style="padding:0">
										<?php echo 'DETALLE PETICION:';?>
									</div>
									<div class="col-sm-8 text-justify" style="padding:0">
										<?php echo $peticionDtl[0][6];?>
									</div>
								</div>
							<?php
								}
							?>
						</div>
					</div>
					<?php
    					if($peticionDtl[0][7]==3)
    					{
    				?>
						<div class="row">
							<div class="col-sm-6 text-left">
								<div class="errblock" style="background:transparent">
		            				<?php
		            					if($peticionDtl[0][9]==1 && $_SESSION["client_id"]==1 && $_SESSION["user_perfil"]!=$PERFIL_ID_GERENTE_SISTEC)
		            					{
		            				?>
		            						<a href=instalacionEquipo.php?peticion=<?php echo $peticionId;?>>ELABORAR INFORME</a>
		            				<?php
		            					}
		            					else if($peticionDtl[0][9]==2 && $_SESSION["client_id"]==1 && $_SESSION["user_perfil"]!=$PERFIL_ID_GERENTE_SISTEC)
		            					{
		            				?>
		            						<a href=mantenimientoPreventivo.php?peticion=<?php echo $peticionId;?>>ELABORAR INFORME</a>
		            				<?php
		            					}
		            					else if($peticionDtl[0][9]==5 && $_SESSION["client_id"]==1 && $_SESSION["user_perfil"]!=$PERFIL_ID_GERENTE_SISTEC)
		            					{
		            				?>
		            						<a href=mantenimientoCorrectivo.php?peticion=<?php echo $peticionId;?>>ELABORAR INFORME</a>
		            				<?php
		            					}
		            				?>
		            			</div>
		            		</div>
		            		<div class="col-sm-6 text-left">
								<div class="errblock" style="background:transparent">
		            				<a href=exportpdf.php?peticion=<?php echo $peticionId;?> target="_blank">EXPORTAR</a>
		            			</div>						
							</div>
						</div>
					<?php
    					}
    					else
    						echo '<br>';
    				?>
					<div class="row">
						<div class="col-sm-12 hist-dtl2">
								<div class="row">
									<div class="col-sm-12 text-center" style="background:#222;color:cornsilk">
										<h4>HISTORIAL</h4>								
									</div>						
								</div>
							<?php
								//echo $peticionId.'<br>';
								
								if(isset($peticionHist))
								{
									//echo count($peticionHist);
									for($x=0;$x<count($peticionHist);$x++)
									{
							?>
								
								<div class="row">
									<div class="col-sm-12 text-justify" style="padding-top:5px">
										<?php echo '<b>FECHA OBSERVACION :</b> '.$peticionHist[$x][1];?>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 text-justify" style="padding-top:5px">
										<?php echo '<b>NOMBRE TECNICO :</b> '.$peticionHist[$x][2];?>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 text-justify" style="padding-top:5px">
										<?php echo '<b>ESTADO :</b> '.$peticionHist[$x][4];?>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 text-justify" style="padding-top:5px">
										<?php echo '<b>EQUIPOS :</b> '.$peticionHist[$x][3];?>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 text-justify" style="padding-top:5px">
										<?php echo '<b>OBSERVACION :</b><i> '.$peticionHist[$x][0].'</i>';?>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12" style="padding-top:15px;border-bottom:1px solid #222">
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
			<br>			
			<br>







		</div>
	</div>
</div>
