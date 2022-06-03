<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    include_once('util.php');
	include_once('config.php'); 
	$session_time=$session_expirry_time;
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
  	$_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);        
    }
    unset($_SESSION["isViajePlanAavailable"]);
    unset($_SESSION["sector"]);
    unset($_SESSION["nroasientessearch"]);
    unset($_SESSION["fechaviajesearch"]);
    unset($_SESSION["calle_principal"]);
    unset($_SESSION["numeracion"]);
    unset($_SESSION["calle_secundario"]);
    unset($_SESSION["referencia"]);
	include_once('header.php');

	$controller = new controller();
	$currDt=$controller->getCurDate($databasecon,$DEBUG_STATUS);

?>
<script>
	$(function() {
	 $('.item').matchHeight({
	    byRow: true,
	    property: 'height',
	    target: null,
	    remove: false
	  });
	});
</script>
<br>


	<input type="hidden" name="submitted" value="true" />
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
			<div class="col-sm-10 bg-blue">
				<br>
				<h3 style="text-align:center;color:#FFF;margin-top:1px">PLANIFICAR VIAJE A AEROPUERTO</h3>
			</div>
			<div class="col-sm-1">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-1">
			</div>
			<div data-mh="my-group" class="item col-sm-3 inner_body-block  option animated slideInRight">
				<form method="post" action="programarViajeAeropuerto.php">
					<br>
					
					<input type="hidden" name="submitted" value="true">
					<div class="row">
						<div class="col-sm-12 planificarviaje">						
							<div class="form-group">
								<span class="input-group-addon">SECTOR DE SALIDA</span>
								<select name="sector" class="form-control" id="sector"  onchange="getTerminalsBySector();" required>
									<option value="0">Elige su sector</option>
									<?php 
										
		    							$sector = $controller->getSectors($databasecon,1,$DEBUG_STATUS);
		    							for($x=0;$x<count($sector);$x++)
		    							{
		    								echo "<option value='".$sector[$x][0]."'>".$sector[$x][1]."</option>";
		    							}
									?>
			                    </select>
			                    <div id="errorSector" class="errorMsg">                    	
			                    </div>
		                    </div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 planificarviaje">						
							<div class="form-group">
								<span class="input-group-addon">PARROQUIA DE SALIDA</span>
								<select name="terminal" class="form-control" id="terminal" required>
									
			                    </select>
			                    <div id="errorTerminal" class="errorMsg">                    	
			                    </div>
		                    </div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 planificarviaje">
							<div class="form-group">
								<span class="input-group-addon">NRO DE PASAJEROS</span>
								<select name="nroasientessearch" class="form-control" id="nroasientessearch">
			                        <option value="1">INDIVIDUAL UN ASIENTO : $12.00</option>
			                        <option value="2">AMIGOS DOS ASIENTOS : $20.00</option>
			                        <option value="5">FAMILIAR TRES O CUATRO ASIENTOS : $25.00</option>
			                        <option value="6">VIAJE PREMIUM : $25.00</option>
			                    </select>
					        </div>
						</div>
					</div>
					<div class="row">
				        <div class="col-sm-12 planificarviaje">
							<div class="form-group test">
								<span class="input-group-addon">HORA-FECHA DE VIAJE</span>
								<input type="date" min=<?php echo $currDt;?>  name="fechaviajesearch" id="fechaviajesearch" class="form-control" style="width:60%">
								<select name="horavuelosearch" class="form-control" id="horaviajesearch" style="width:40%">
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
			                    <div id="errorFecha" class="errorMsg"></div>
			                 </div>
						</div> 	
					</div>
					<div class="row">
						<div class="col-sm-12 planificarviaje">
		                    <div class="form-group">
								<span class="input-group-addon">CALLE PRINCIPAL</span>
			                    <input type="text" class="form-control" size=25 name="calle_principal" value="" placeholder="Ejemplo : MARIANA DE JESUS" id="calle_principal">
			                    <div id="errorCallePrincipal" class="errorMsg"></div>
			                </div>
				        </div>
					</div>
					<div class="row">
						<div class="col-sm-12 planificarviaje">
		                    <div class="form-group">
								<span class="input-group-addon">NUMERACION</span>
			                    <input type="text" class="form-control" size=25 name="numeracion" value="" placeholder="Ejemplo : N3-35" id="numeracion">
			                    <div id="errorNumeracion" class="errorMsg"></div>
			                </div>
				        </div>
					</div>
					<div class="row">
						<div class="col-sm-12 planificarviaje">
		                    <div class="form-group">
								<span class="input-group-addon">CALLE SECUNDARIO</span>
			                    <input type="text" class="form-control" size=25 name="calle_secundario" value="" placeholder="Ejemplo : AMAZONAS" id="calle_secundario">
			                    <div id="errorCalleSecundario" class="errorMsg"></div>
			                </div>
				        </div>
					</div>
					<div class="row">
						<div class="col-sm-12 planificarviaje">
		                    <div class="form-group">
								<span class="input-group-addon">REFERENCIA</span>
			                    <input type="text" class="form-control" size=25 name="referencia" value="" placeholder="Ejemplo : CC EL JARDIN" id="referencia">
			                    <div id="errorReferencia" class="errorMsg"></div>
			                </div>
				        </div>
					</div>
					<div class="row">
						<div class="col-sm-12 planificarviaje text-center">
				        	<h3>NOTA IMPORTANTE:</h3><b>DEBES TENER UNA DISPONIBILIDAD DE 30 MINUTOS ANTES DE LA HORA DE TU RESERVA</b>
				        	<a href="#" data-toggle="tooltip" data-placement="bottom" title="Los 30 minutos de disponibilidad se dan para poder recoger a los pasajeros según sea su ubicación geográfica y poder partir a la hora de la reserva a tiempo!"><span class="glyphicon glyphicon-info-sign" style="font-size:20px"></span></a>

						</div>
						 <br>
				        <div class="col-sm-12 planificarviaje">
				        	<button type="submit" onclick="return validatePlanificarViajeData();" class="btn btn-info btn_center">PLANIFICAR VIAJE<span class="glyphicon glyphicon-chevron-right"></span></button>
				        </div>  
				        <div class="col-sm-12 planificarviaje">
				        	<div class="row">
				        		<div class="col-sm-4">	        			
				        		</div>
				        		<div class="col-sm-4">
				        			<div class="progress" id="progress">
	    								<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
	    							</div>
				        		</div>
				        		<div class="col-sm-4">	        			
				        		</div>
				        	</div>
				        </div>
					</div>	
					<br>
					<br>
					<br>
					<br>
					<br>
				</form>			
			</div>
			
			<div data-mh="my-group" class="item col-sm-7 inner_body-block_right option animated slideInLeft">
				<div class="row">
					<div class="col-sm-12">
						<div id="mapa">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div id="viajes">
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
