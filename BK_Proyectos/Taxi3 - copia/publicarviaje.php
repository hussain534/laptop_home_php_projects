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
		<div class="col-sm-3 inner_body-block  option animated slideInRight">
			<div class="row">
				<div class="col-sm-12">
					<br>
					<!-- <center><img src="images/icon_publicar.png"><img src="images/icon_aeropuerto.png" class="sub-img"></center> -->
					<h4 style="text-align:center;color:#222;margin-top:1px">PUBLICAR VIAJE A AEROPUERTO</h4>
				</div>
			</div>
			<br>
			<div class="row">
			 	<div class="col-sm-12">
			 		<?php
			 			if($isVerified==1)
				        {
				        	echo "<div class='alert alert-danger'><center>NO SE ENCUENTRO DETALLES CONTACTO. POR FAVOR <a href='editDetallesPersonales.php'>ACTUALIZAR</a> AHORA.</center></div>";
				        }
				        elseif($isVerified==2)
				        {
				        	echo "<div class='alert alert-danger'><center>NO SE HA VERIFICADO SU CORREO ELECTRONICO. <br>PARA ACTIVACION, POR FAVOR UTILIZAR LA LINK ENVIADO A SU CORREO EN MOMENTO DE REGISTRACION DE SU CUENTA.</center></div>";
				        }
				        elseif($isVerified==3)
				        {
				        	echo "<div class='alert alert-danger'><center>NO SE ENCUENTRO SU CEDULA O AUN NO ESTA ABROBADO. POR FAVOR <a href='editDocumentosConductor.php'>ACTUALIZAR</a> AHORA.</center></div>";
				        	
				        }
				        elseif($isVerified==4)
				        {
				        	//if(isset($_SESSION['userRole']) and ($_SESSION['userRole']==2))
				        		echo "<div class='alert alert-danger'><center>NO SE ENCUENTRO SU LICENCIA O AUN NO ESTA ABROBADO. POR FAVOR <a href='editDocumentosConductor.php'>ACTUALIZAR</a> AHORA.</center></div>";		        	
				        }
				        elseif($isVerified==6)
				        {
				        	//if(isset($_SESSION['userRole']) and ($_SESSION['userRole']==2))
				        		echo "<div class='alert alert-danger'><center>DETALLES DE AUTOMOVIL O SU MATRICULA SON RECHAZADOS. POR FAVOR <a href='editDetallesAutomovil.php'>ACTUALIZAR O REVISAR</a> AHORA.</center></div>";		        	
				        }
				        elseif($isVerified==5)
				        {
				        	//if(isset($_SESSION['userRole']) and ($_SESSION['userRole']==2))
				        		echo "<div class='alert alert-danger'><center>NO SE ENCUENTRO DETALLES DE AUTOMOVIL O SU MATRICULA O AUN NO ESTAN APROBADOS. POR FAVOR <a href='addDetallesAutomovil.php'>ACTUALIZAR O REVISAR</a> AHORA.</center></div>";		        	
				        }				        			        
				        else
				        {
			 		?>
			       			
			 			<div class="row">
			 				<div class="col-sm-12 planificarviaje">		
								<div class="form-group">
									<span class="input-group-addon">SECTOR DE SALIDA</span>					
									<select name="sector" class="form-control" id="sector"  onchange="getStates()" required>
										<option value="0">ELIGE SU SECTOR</option>
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
							<div class="col-sm-12 planificarviaje">
								<div class="form-group test">
									<span class="input-group-addon">DISPONIBILIDAD DESDE</span>
									<input type="date" name="fechaviaje" id="fechaviaje" class="form-control" style="width:60%">
									<select name="horainiciodisponibilidad" class="form-control" id="horainiciodisponibilidad" style="width:40%">
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
				                    </select><!-- 
				                    <select name="minutosviaje" class="selectpicker" id="minutosviaje">
				                        <option value="00">00</option>
				                        <option value="30">30</option>
				                    </select>	 -->		                    
				                    <div id="errorFecha" class="errorMsg"></div>
				                </div>
							</div>
							<div class="col-sm-12 planificarviaje">
								<div class="form-group">
									<span class="input-group-addon">DISPONIBILIDAD PARA</span>
									<select name="duraciondisponible" class="form-control" id="duraciondisponible">
				                        <option value="60">60 Minutos</option>
				                        <option value="90">90 Minutos</option>
				                        <option value="120">120 Minutos</option>
				                        <option value="150">150 Minutos</option>
				                        <option value="180">180 Minutos</option>
				                    </select><!-- 
				                    <select name="minutosviaje" class="selectpicker" id="minutosviaje">
				                        <option value="00">00</option>
				                        <option value="30">30</option>
				                    </select>	 -->		                    
				                    <div id="errorFecha" class="errorMsg"></div>
				                </div>
							</div>
							<div class="col-sm-12 planificarviaje">		
								<div class="form-group">
									<span class="input-group-addon">ELIGE AUTOMOVIL</span>					
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
							<div class="col-sm-12 planificarviaje">		
								<div class="form-group">
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
							<div class="col-sm-12 planificarviaje">
								<div class="form-group">
									<span class="input-group-addon">ASIENTOS DISPONIBLE</span>				
									<select name="nroAsientes" class="form-control" id="nroAsientes">
				                        <option value="1">1</option>
				                        <option value="2">2</option>
				                        <option value="3">3</option>
				                        <option value="4">4</option>
				                    </select>
				                    <div id="errorAsientes" class="errorMsg">                    	
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
								<p style="color:red;text-align:justify">
								<span class="glyphicon glyphicon-triangle-right"></span>El momento que hace click en boton PUBLICAR VIAJE a 
								aeropuero, estas acceptando que vas a recoger un pasajero en aeropuerto en exacto una hora 
								despues de iniciar su viaje a aeropuerto y traera a cuidad 
								en solo $6.00. <br>
								Por ejemplo: si publicas un viaje a aeropuerto a las 15H00, debes recoger otro pasajero 
								en aeropuerto a las 16H00.<br>
								<span class="glyphicon glyphicon-triangle-right"></span>No hagas click en boton PUBLICAR VIAJE si no estas de acuerdo</p>									
							</div>
			       			<button type="button" id="btnPublicarViaje" class="btn btn-info btn_center">PUBLICAR VIAJE <span class="glyphicon glyphicon-chevron-right"></span></button>
			       		</div>
			       	<?php
			       		}
			       	?>
			    </div>
			</div>
		</div>
		<div class="col-sm-7 inner_body-block_right option animated slideInLeft">
			<div class="row">
				<div class="col-sm-12">
					<div id="estadoPublicarViaje">
						<div class="row">
							<div class="col-sm-12 text-center option animated slideInUp" style="letter-spacing:.1em">					
								<h3>¡AHORRA DINERO Y SÁCALE EL MEJOR PROVECHO A TUS VIAJES!</h3>
							</div>
						</div>
						<br>
						<br>
						<div class="row">	
							<div class="col-sm-3 text-center">
								<div class="row">
									<div class="col-sm-12 text-center option animated slideInUp">	
										<img src="images/buscar.png" class="img_rounded1">
									</div>
									<div class="col-sm-12 text-center">	
										<h4>BUSCAR</h4>
									</div>
									<div class="col-sm-12 text-justify text-center">
										<h5>Busca el viaje que se acomode a tu tiempo, viaja compartiendo el gasto de viaje</h5>
									</div>
								</div>
							</div>
							<div class="col-sm-3 text-center">
								<div class="row">
									<div class="col-sm-12 text-center option animated slideInUp">	
										<img src="images/dollar.png" class="img_rounded1">
									</div>
									<div class="col-sm-12 text-center">	
										<h4>AHORRAR</h4>
									</div>
									<div class="col-sm-12 text-justify text-center">
										<h5>Compartir tus gastos de viaje con otros pasajeros.</h5>
									</div>
								</div>				
							</div>
							<div class="col-sm-3 text-center">
								<div class="row">
									<div class="col-sm-12 text-center option animated slideInUp">	
										<img src="images/computer3.png" class="img_rounded1">
									</div>
									<div class="col-sm-12 text-center">	
										<h4>VAIJE SMART</h4>
									</div>
									<div class="col-sm-12 text-justify text-center">
										<h5>Evita complicaciones de planificar tu viaje a cualquier cuidad nacional o internacional</h5>
									</div>
								</div>				
							</div>				
							<div class="col-sm-3 text-center">
								<div class="row">
									<div class="col-sm-12 text-center option animated slideInUp">	
										<img src="images/conocer.png" class="img_rounded1">
									</div>
									<div class="col-sm-12 text-center text-center">	
										<h4>HACER AMIGOS</h4>
									</div>
									<div class="col-sm-12 text-justify">
										<h5>Sácale el mayor provecho a tu viaje creando amistades y contactos de interés a lo largo del trayecto</h5>
									</div>
								</div>
							</div>
						</div>
					</div>
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
