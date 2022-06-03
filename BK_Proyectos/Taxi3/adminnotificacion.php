<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    include_once('util.php');
	include_once('config.php'); 
	$session_time=$session_expirry_time;
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
	if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
	{
		//echo 'inside<br>';
		$url="userlogin.php";
		$_SESSION["last_url"]='mispublicaciones.php';
		//echo $_SESSION["last_url"];
		header("Location:$url"); 
	}
	$controller = new controller();
	$minotificacionsettings=$controller->configNotificacion($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
    
	
	$_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }
    
  include_once('header.php');

?>
<br>

<div class="container inner_body">
	<br>
	<br>
	<?php
		if(isset($_SESSION['userid']))
				include_once('submenu.php');
	?>
	<div class="row">
		<div class="col-sm-1">
		</div>
		<div class="col-sm-10 inner_body-block">
			<div class="row">
				<div class="col-sm-12">
					<center><img src="images/icon_mail.png"></center>
					<h3 style="text-align:center;color:#222;margin-top:1px">ADMINISTRAR NOTIFICACIONES</h3>
				</div>
			</div>
			<br>
			<br>
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-2">				
					</div>
					<div class="col-sm-8">
						<div id="message"></div>
					</div>
					<div class="col-sm-2">
					</div>
				</div>
			</div>			
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-2">				
					</div>
					<div class="col-sm-8">
						<div class="row">			
							<div class="col-sm-12">
								<h4><strong>Enviar Notificaciones para</strong></h4>
							</div>
						</div>
						<div class="row">			
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-3">										
									</div>
									<div class="col-sm-6 itemDtl">
										<input type="hidden" class="form-control" name="noti_id" id="noti_id" value="<?php echo $minotificacionsettings[0][0]; ?>"  readonly="true">
									</div>
									<div class="col-sm-3">										
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 notificar">
										<?php 
											if(count($minotificacionsettings)>0 && $minotificacionsettings[0][1]==0) 
												echo '<label class="checkbox-inline"><input type="checkbox" id="noti_viaje_publicado">VIAJE PUBLICADO</label>';
											else
												echo '<label class="checkbox-inline"><input type="checkbox" checked="true" id="noti_viaje_publicado">VIAJE PUBLICADO</label>';
										?>																	
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 notificar">
										<?php 
											if(count($minotificacionsettings)>0 && $minotificacionsettings[0][2]==0) 
												echo '<label class="checkbox-inline"><input type="checkbox" id="noti_viaje_reservado">VIAJE RESERVADO</label>';
											else
												echo '<label class="checkbox-inline"><input type="checkbox" checked="true" id="noti_viaje_reservado">VIAJE RESERVADO</label>';
										?>																	
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 notificar">
										<?php 
											if(count($minotificacionsettings)>0 && $minotificacionsettings[0][3]==0) 
												echo '<label class="checkbox-inline"><input type="checkbox" id="noti_cambio_viaje_publicado">CAMBIO DE VIAJE PUBLICADO</label>';
											else
												echo '<label class="checkbox-inline"><input type="checkbox" checked="true" id="noti_cambio_viaje_publicado">CAMBIO DE VIAJE PUBLICADO</label>';
										?>																	
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 notificar">
										<?php 
											if(count($minotificacionsettings)>0 && $minotificacionsettings[0][4]==0) 
												echo '<label class="checkbox-inline"><input type="checkbox" id="noti_cambio_viaje_reservado">CAMBIO DE VIAJE RESERVADO</label>';
											else
												echo '<label class="checkbox-inline"><input type="checkbox" checked="true" id="noti_cambio_viaje_reservado">CAMBIO DE VIAJE RESERVADO</label>';
										?>																	
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 notificar">
										<?php 
											if(count($minotificacionsettings)>0 && $minotificacionsettings[0][5]==0) 
												echo '<label class="checkbox-inline"><input type="checkbox" id="noti_publicos">COMUNICACION PUBLICOS</label>';
											else
												echo '<label class="checkbox-inline"><input type="checkbox" checked="true" id="noti_publicos">COMUNICACION PUBLICOS</label>';
										?>																	
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 notificar">
										<?php 
											if(count($minotificacionsettings)>0 && $minotificacionsettings[0][6]==0) 
												echo '<label class="checkbox-inline"><input type="checkbox" id="noti_privados">COMUNICACION PRIVADOS</label>';
											else
												echo '<label class="checkbox-inline"><input type="checkbox" checked="true" id="noti_privados">COMUNICACION PRIVADOS</label>';
										?>																	
									</div>
								</div>
							</div>
							
						</div>						
					</div>
					<div class="col-sm-2">				
					</div>
				</div>
				<br>
				<br>
				<div class="row">		
					<button type="button" id="btnPermisosNotificacion" class="btn btn-info btn_center">ACTUALIZAR <span class="glyphicon glyphicon-chevron-right"></span></button>
				</div>
			</div>
		</div>
		<div class="col-sm-1">
		</div>
	</div>
	<br>
	<br>			
</div>

<?php
    include_once('container_footer.php');
?>