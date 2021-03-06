<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    //include_once('util.php');
	include_once('config.php'); 
	$session_time=$session_expirry_time;
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
	if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
	{
		//echo 'inside<br>';
		$url="userlogin.php";
		$_SESSION["last_url"]='publicarviaje.php';
		//echo $_SESSION["last_url"];
		header("Location:$url"); 
	}
	else
	{
		include_once('util.php');
	}
	$controller = new controller();
	$isVerified=$controller->isUserPerfilCompleted($databasecon,1,(isset($_SESSION['userEmail'])?$_SESSION['userEmail']:null),(isset($_SESSION['userRole'])?$_SESSION['userRole']:null),$DEBUG_STATUS);
    
	//echo $isVerified;
	$_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }
    if(isset($_GET["idviaje"]))
    	$idviaje=$_GET["idviaje"];
    else
    	$idviaje=0;
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
					<center><img src="images/icon_publicar.png"><img src="images/icon_nacional.png" class="sub-img"></center>
					<h3 style="text-align:center;color:#222;margin-top:1px">PUBLICAR VIAJE NACIONAL</h3>
				</div>
			</div>
			<br>
			<br>
			<div class="row">
			 	<div class="col-sm-12" id="estadoPublicarViaje">
			 		<?php
			 			if($isVerified==1)
				        {
				        	echo "<div class='alert alert-danger'><center>NO SE ENCUENTRO DETALLES CONTACTO. POR FAVOR <a href='editDetallesPersonales.php'>ACTUALIZAR</a> AHORA.</center></div>";
				        }
				        elseif($isVerified==2)
				        {
				        	echo "<div class='alert alert-danger'><center>NO SE VERIFICADO SU EMAIL. POR FAVOR <a href='enviarCodigoVerificacionEmail.php'>VERIFICAR</a> AHORA.</center></div>";
				        }
				        elseif($isVerified==3)
				        {
				        	echo "<div class='alert alert-danger'><center>NO SE ENCUENTRO SU CEDULA. POR FAVOR <a href='editDocumentosConductor.php'>ACTUALIZAR</a> AHORA.</center></div>";
				        	
				        }
				        elseif($isVerified==4)
				        {
				        	//if(isset($_SESSION['userRole']) and ($_SESSION['userRole']==2))
				        		echo "<div class='alert alert-danger'><center>NO SE ENCUENTRO SU LICENCIA. POR FAVOR <a href='editDocumentosConductor.php'>ACTUALIZAR</a> AHORA.</center></div>";		        	
				        }
				        elseif($isVerified==5)
				        {
				        	//if(isset($_SESSION['userRole']) and ($_SESSION['userRole']==2))
				        		echo "<div class='alert alert-danger'><center>NO SE ENCUENTRO DETALLES DE AUTOMOVIL O SU MATRICULA. POR FAVOR <a href='addDetallesAutomovil.php'>ACTUALIZAR</a> AHORA.</center></div>";		        	
				        }
				        else
				        {
			 		?>
			       			<!--<div class="col-sm-12 planificarviaje">
								<div class="row">
									<div class="col-sm-2">					
									</div>
									<div class="col-sm-8">	
										<div id="mapholder">                                            
                                        </div>
									</div>
									<div class="col-sm-2">					
									</div>
								</div>
								<div class="row">
									<div class="col-sm-2">					
									</div>
									<div class="col-sm-3">	
                                        <div class="input-group">
											<input type="text" class="form-control" name="rn_latitude" id="rn_latitude" value="">
						                </div>
									</div>
									<div class="col-sm-3">	
                                        <div class="input-group">
											<input type="text" class="form-control" name="rn_longitude" id="rn_longitude" value="">
						                </div>
									</div>
									<div class="col-sm-2">
										<span class="glyphicon glyphicon-map-marker" onclick="getLocation()" title="Click to get geological Location"></span>
									</div>
									<div class="col-sm-2">					
									</div>
								</div>
							</div>-->
			 				<div class="col-sm-12 planificarviaje">
								<div class="row">
									<div class="col-sm-2">					
									</div>
									<div class="col-sm-8">	
										<div class="input-group">
											<span class="input-group-addon">CIUDAD DE SALIDA</span>				
											<select name="ciudad" class="form-control" id="ciudad"  onchange="getTerminals()" required>
												<option value="0">Elige su ciudad</option>
						                    <?php 
												$controller = new controller();
				    							$ciudad = $controller->getCiudad($databasecon,1,$DEBUG_STATUS);
				    							for($x=0;$x<count($ciudad);$x++)
				    							{
				    								echo "<option value='".$ciudad[$x][0]."'>".$ciudad[$x][1]."</option>";
				    							}
											?>
						                    </select>
						                    <div id="errorCiudad" class="errorMsg"></div>
						                </div>
									</div>
									<div class="col-sm-2">					
									</div>
								</div>
							</div>
			 				<div class="col-sm-12 planificarviaje">
								<div class="row">
									<div class="col-sm-2">					
									</div>
									<div class="col-sm-8">
										<div class="input-group">
											<span class="input-group-addon">SECTOR DE SALIDA</span>				
											<select name="sector" class="form-control" id="sector"  onchange="getStates()" required>
												<option value="0">Elige su sector</option>
						                    <?php 
												$controller = new controller();
				    							$terminals = $controller->getTerminals($databasecon,1,$DEBUG_STATUS);
				    							for($x=0;$x<count($terminals);$x++)
				    							{
				    								echo "<option value='".$terminals[$x][0]."'>".$terminals[$x][1]."</option>";
				    							}
											?>
						                    </select>
						                    <div id="errorSector" class="errorMsg"></div>
						                </div>	
									</div>
									<div class="col-sm-2">					
									</div>
								</div>
							</div>

							<div class="col-sm-12 planificarviaje">
								<div class="row">
									<div class="col-sm-2">					
									</div>
									<div class="col-sm-8">
										<div class="input-group">
											<span class="input-group-addon">CIUDAD DESTINO</span>				
											<select name="ciudaddestino" class="form-control" id="ciudaddestino"  onchange="getTerminalsDestino()" required>
												<option value="0">Elige su ciudad destino</option>
						                    <?php 
												$controller = new controller();
				    							$ciudaddestino = $controller->getCiudad($databasecon,1,$DEBUG_STATUS);
				    							for($x=0;$x<count($ciudaddestino);$x++)
				    							{
				    								echo "<option value='".$ciudaddestino[$x][0]."'>".$ciudaddestino[$x][1]."</option>";
				    							}
											?>
						                    </select>
						                    <div id="errorCiudadDestino" class="errorMsg"></div>
						                </div>
									</div>
									<div class="col-sm-2">					
									</div>
								</div>
							</div>
			 				<div class="col-sm-12 planificarviaje">
								<div class="row">
									<div class="col-sm-2">					
									</div>
									<div class="col-sm-8">					
										<div class="input-group">
											<span class="input-group-addon">SECTOR DESTINO</span>				
											<select name="sectordestino" class="form-control" id="sectordestino"  onchange="getStates()" required>
												<option value="0">Elige su sector destino</option>
						                    <?php 
												$controller = new controller();
				    							$terminalsDestino = $controller->getTerminals($databasecon,1,$DEBUG_STATUS);
				    							for($x=0;$x<count($terminalsDestino);$x++)
				    							{
				    								echo "<option value='".$terminalsDestino[$x][0]."'>".$terminalsDestino[$x][1]."</option>";
				    							}
											?>
						                    </select>
						                    <div id="errorSectorDestino" class="errorMsg"></div>
						                </div>
									</div>
									<div class="col-sm-2">					
									</div>
								</div>
							</div>
							<div class="col-sm-12 planificarviaje">
								<div class="row">
									<div class="col-sm-2">
									</div>
									<div class="col-sm-8">
										<div class="input-group">
											<span class="input-group-addon">FECHA-HORA SALIDA</span>
											<input type="date" name="fechaviaje" id="fechaviaje">
											<select name="horaviaje" class="selectpicker" id="horaviaje">
						                        <option value="02:00">02:00 AM</option>
						                        <option value="02:30">02:30 AM</option>
						                        <option value="03:00">03:00 AM</option>
						                        <option value="03:30">03:30 AM</option>
						                        <option value="04:00">04:00 AM</option>
						                        <option value="04:30">04:30 AM</option>
						                        <option value="05:00">05:00 AM</option>
						                        <option value="05:30">05:30 AM</option>
						                        <option value="06:00">06:00 AM</option>
						                        <option value="06:30">06:30 AM</option>
						                        <option value="07:00">07:00 AM</option>
						                        <option value="07:30">07:30 AM</option>
						                        <option value="08:00">08:00 AM</option>
						                        <option value="08:30">08:30 AM</option>
						                        <option value="09:00">09:00 AM</option>
						                        <option value="09:30">09:30 AM</option>
						                        <option value="10:00">10:00 AM</option>
						                        <option value="10:30">10:30 AM</option>
						                        <option value="11:00">11:00 AM</option>
						                        <option value="11:30">11:30 AM</option>
						                        <option value="12:00">12:00 PM</option>
						                        <option value="12:30">12:30 PM</option>
						                        <option value="13:00">13:00 PM</option>
						                        <option value="13:30">13:30 PM</option>
						                        <option value="14:00">14:00 PM</option>
						                        <option value="14:30">14:30 PM</option>
						                        <option value="15:00">15:00 PM</option>
						                        <option value="15:30">15:30 PM</option>
						                        <option value="16:00">16:00 PM</option>
						                        <option value="16:30">16:30 PM</option>
						                        <option value="17:00">17:00 PM</option>
						                        <option value="17:30">17:30 PM</option>
						                        <option value="18:00">18:00 PM</option>
						                        <option value="18:30">18:30 PM</option>
						                        <option value="19:00">19:00 PM</option>
						                        <option value="19:30">19:30 PM</option>
						                        <option value="20:00">20:00 PM</option>
						                        <option value="20:30">20:30 PM</option>
						                        <option value="21:00">21:00 PM</option>
						                        <option value="21:30">21:30 PM</option>
						                        <option value="22:00">22:00 PM</option>
						                    </select>
						                    <!-- <select name="minutosviaje" class="selectpicker" id="minutosviaje">
						                        <option value="00">00</option>
						                        <option value="30">30</option>
						                    </select> -->			                    
						                    <div id="errorFecha" class="errorMsg"></div>
						                </div>
							        </div>
							        <div class="col-sm-2">
									</div>
								</div>
							</div>
							<div class="col-sm-12 planificarviaje">
								<div class="row">
									<div class="col-sm-2">					
									</div>
									<div class="col-sm-8">					
										<div class="input-group">
											<span class="input-group-addon">ELIGE SU AUTOMOVIL</span>					
											<select name="automovilID" class="form-control" id="automovilID"  onchange="getStates()" required>
												<?php 
												$controller = new controller();
				    							$automovil = $controller->getVehicleDetails($databasecon,$_SESSION["userid"],$DEBUG_STATUS);
				    							for($x=0;$x<count($automovil);$x++)
				    							{
				    								echo "<option value='".$automovil[$x][0]."'>".$automovil[$x][1].'-'.$automovil[$x][2].' '.$automovil[$x][3]."</option>";
				    							}
											?>
						                    </select>
						                    <div id="errorSectorDestino" class="errorMsg"></div>
						                </div>
									</div>
									<div class="col-sm-2">					
									</div>
								</div>
							</div>
							<div class="col-sm-12 planificarviaje">
								<div class="row">
									<div class="col-sm-2">					
									</div>
									<div class="col-sm-8">
										<div class="input-group">
											<span class="input-group-addon">EQUIPAJE POR PASAJERO</span>					
											<select name="nroEquipaje" class="form-control" id="nroEquipaje">
						                        <option value="1">1</option>
						                        <option value="2">2</option>
						                        <option value="3">3</option>
						                    </select>
						                    <div id="errorEquipaje" class="errorMsg">                    	
						                    </div>
						                </div>
									</div>
									<div class="col-sm-2">					
									</div>
								</div>
							</div>
							<div class="col-sm-12 planificarviaje">
								<div class="row">
									<div class="col-sm-2">					
									</div>
									<div class="col-sm-8">					
										<div class="input-group">
											<span class="input-group-addon">ASIENTOS DISPONIBLE</span>					
											<select name="nroAsientes" class="form-control" id="nroAsientes">
						                        <option value="1">1</option>
						                        <option value="2">2</option>
						                        <option value="3">3</option>
						                    </select>
						                    <div id="errorAsientes" class="errorMsg">                    	
						                    </div>
						                </div>
									</div>
									<div class="col-sm-2">					
									</div>
								</div>
							</div>
							<!-- <div class="col-sm-12 planificarviaje">
								<div class="row">
									<div class="col-sm-2">					
									</div>
									<div class="col-sm-4">					
										<b>ACCEPTAS : </b>
									</div>
									<div class="col-sm-4">					
										<label class="checkbox-inline"><input type="checkbox" id="mascotas">MASCOTAS</label>
										<label class="checkbox-inline"><input type="checkbox" id="fumar">FUMAR</label>
										<label class="checkbox-inline"><input type="checkbox" id="alcohol">ALCOHOL</label>
									</div>
									<div class="col-sm-2">					
									</div>
								</div>
							</div> -->
							<div class="col-sm-12 planificarviaje">
								<div class="row">
									<div class="col-sm-2">					
									</div>
									<div class="col-sm-8">					
										<div class="input-group">
											<span class="input-group-addon">COSTO POR PASAJERO</span>					
											<input type="text" class="form-control" name="costo_viaje" id="costo_viaje">
											<div id="errorCosto" class="errorMsg"></div>
										</div>
									</div>
									<div class="col-sm-2">					
									</div>
								</div>
							</div>
							<div class="col-sm-12 planificarviaje">
								<div class="row">
									<div class="col-sm-2">					
									</div>
									<div class="col-sm-8">					
										<div class="input-group">
											<span class="input-group-addon">PARADAS DE COMER</span>					
											&nbsp;&nbsp;&nbsp;<input type="radio" name="paradascomer" value="0" checked="true">No
											<input type="radio" name="paradascomer" value="1">Si
										</div>
									</div>
									<div class="col-sm-2">					
									</div>
								</div>
							</div>
							<div class="col-sm-12 planificarviaje">
								<div class="row">
									<div class="col-sm-2">					
									</div>
									<div class="col-sm-8">					
										<div class="input-group">
											<span class="input-group-addon">DILIGENCIAS</span>					
											&nbsp;&nbsp;&nbsp;<input type="radio" name="diligencias" value="0" checked="true">No
											<input type="radio" name="diligencias" value="1">Si
										</div>
									</div>
									<div class="col-sm-2">					
									</div>
								</div>
							</div>
							<div class="col-sm-12 planificarviaje">
								<div class="row">
									<div class="col-sm-2">					
									</div>
									<div class="col-sm-8">					
										<div class="input-group">
											<span class="input-group-addon">LLEVAS MERCANCIAS</span>					
											&nbsp;&nbsp;&nbsp;<input type="radio" name="mercancias" value="0" checked="true">No
											<input type="radio" name="mercancias" value="1">Si
										</div>
									</div>
									<div class="col-sm-2">					
									</div>
								</div>
							</div>
							<div class="col-sm-12 planificarviaje">
								<div class="row">
									<div class="col-sm-1">					
									</div>
									<div class="col-sm-10">					
										<p class="text-center">Al publicarse un viaje, se aceptar??n autom??ticamente los 
                <a href="#" class="link01 text-center" >t??rminos  y condiciones</a> del zielus</p>
									</div>
									<div class="col-sm-1">					
									</div>
								</div>
							</div>
			       			<button type="button" id="btnPublicarViajeNacional" class="btn btn-success btn_center">PUBLICAR VIAJE <span class="glyphicon glyphicon-chevron-right"></span></button>
			       	<?php
			       		}
			       	?>
			    </div>
			</div>
		</div>
	</div>
	<br>
	<br>
</div>

<?php
include_once('container_footer.php');
?>
