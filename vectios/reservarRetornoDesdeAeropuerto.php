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
    $codigo_viaje_retorno=$_GET["codigo_viaje"];
    $controller = new controller();
    if(isset($_POST['submitted']))
    {
    	$fechaviajesearch=$_POST["fechaviajesearch"]." ".$_POST["horavuelosearch"].":00";
    	
    	$codigoStr = $controller->confirmarRetorno($databasecon,$_POST["c_viaje"],$fechaviajesearch,$_SESSION['userid'],$DEBUG_STATUS);
    	if($codigoStr==0)
    	{
    		/*$url="misreservas.php";
    		$_SESSION["session_msg"]="Su viaje de retorno para ".$fechaviajesearch." esta confirmado";
    		header("Location:$url");*/
    		$message="Su viaje de retorno para ".$fechaviajesearch." esta confirmado";
    		$codigo_viaje_retorno=0;
    	}
    	
    }
	include_once('header.php');

?>
<br>
<br>
<form method="post" action="reservarRetornoDesdeAeropuerto.php">
	<input type="hidden" name="submitted" value="true" />
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
	        <div class="col-sm-10 bg-crimson">
	            <br>
	            <h3 style="text-align:center;color:#FFF;margin-top:1px">APLICAR VIAJE RETORNO DESDE AEROPUERTO</h3>
	        </div>
	        <div class="col-sm-1">
	        </div>
	    </div>
	    <br>
		<div class="row">
			<div class="col-sm-1">
			</div>
			<div class="col-sm-3 inner_body-block">
				
				<br>
				<div class="row">
					<div class="col-sm-12 planificarviaje">
						<div class="form-group">
							<span class="input-group-addon">CODIGO PARA RETORNO</span>
							<input type="text" class="form-control" id="c_viaje" name="c_viaje"  value=<?php echo $codigo_viaje_retorno; ?> readonly="true" >					        
						</div>
					</div>
				</div>
				<div class="row">
                    <div class="col-sm-12 planificarviaje">                        
                        <div class="form-group">
                            <span class="input-group-addon">SECTOR A LLEGAR</span>
                            <select name="sector" class="form-control" id="sector"  onchange="showMap(this);" required>
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
				<!-- <div class="row">
					<div class="col-sm-12 planificarviaje">
						<div class="form-group">
							<span class="input-group-addon">DESTINO</span>
							<select name="sector" class="form-control" id="sector"  onchange="showMap(this);" required>
								<?php 
									$controller = new controller();
	    							$sector = $controller->getSectors($databasecon,1,$DEBUG_STATUS);
	    							for($x=0;$x<count($sector);$x++)
	    							{
	    								echo "<option value='".$sector[$x][0]."'>".$sector[$x][1]."</option>";
	    							}
								?>
		                    </select>
			                <div id="errorSector" class="errorMsg"></div>                   				                
						</div>
					</div>
				</div> -->
				<!-- <div class="row">
					<div class="col-sm-12 planificarviaje">
						<div class="form-group">
							<span class="input-group-addon">NRO. DE PASAJEROS</span>
							<select name="nroasientessearch" class="form-control" id="nroasientessearch">
		                        <option value="1">1</option>
		                    </select>					        
						</div>
					</div>
				</div> -->
				<div class="row">
			        <div class="col-sm-12 planificarviaje"><div class="form-group">
						<div class="form-group test">
							<span class="input-group-addon">FECHA-HORA DE SALIDA</span>
							<input type="date" name="fechaviajesearch" class="form-control" id="fechaviajesearch" style="width:60%">
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
		                    <!-- <select name="minviajesearch" class="selectpicker" id="minviajesearch">
		                        <option value="00">00</option>
		                        <option value="30">30</option>
		                    </select> -->
		                    <div id="errorFecha" class="errorMsg"></div>
		                </div>
			        </div>
			    </div>			    
					<!-- <div class="col-sm-12 planificarviaje">
						<div class="row">
							<div class="col-sm-2">					
							</div>
							<div class="col-sm-3">					
								<b>ACCEPTAS : </b>
							</div>
							<div class="col-sm-5">					
								<label class="checkbox-inline"><input type="checkbox" id="mascotas">MASCOTAS</label>
								<label class="checkbox-inline"><input type="checkbox" id="fumar">FUMAR</label>
								<label class="checkbox-inline"><input type="checkbox" id="alcohol">ALCOHOL</label>
							</div>
							<div class="col-sm-2">					
							</div>
						</div>
					</div> -->
				<div class="row">
                    <div class="col-sm-12 planificarviaje">
                        <div class="form-group">
                            <!-- <span class="input-group-addon">CALLE PRINCIPAL</span> -->
                            <input type="hidden" class="form-control" size=25 name="calle_principal" value="Aeropuerto" placeholder="Ejemplo : MARIANA DE JESUS" id="calle_principal" readonly="true">
                            <div id="errorCallePrincipal" class="errorMsg"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 planificarviaje">
                        <div class="form-group">
                            <!-- <span class="input-group-addon">NUMERACION</span> -->
                            <input type="hidden" class="form-control" size=25 name="numeracion" value="-" placeholder="Ejemplo : N3-35" id="numeracion" readonly="true">
                            <div id="errorNumeracion" class="errorMsg"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 planificarviaje">
                        <div class="form-group">
                            <!-- <span class="input-group-addon">CALLE SECUNDARIO</span> -->
                            <input type="hidden" class="form-control" size=25 name="calle_secundario" value="Aeropuerto" placeholder="Ejemplo : AMAZONAS" id="calle_secundario" readonly="true">
                            <div id="errorCalleSecundario" class="errorMsg"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 planificarviaje">
                        <div class="form-group">
                            <!-- <span class="input-group-addon">REFERENCIA</span> -->
                            <input type="hidden" class="form-control" size=25 name="referencia" value="Aeropuerto" placeholder="Ejemplo : CC EL JARDIN" id="referencia" readonly="true">
                            <div id="errorReferencia" class="errorMsg"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 planificarviaje text-justify">
                        <h3>NOTA IMPORTANTE:</h3><b>DEBES TENER UNA DISPONIBILIDAD DE 30 MINUTOS ANTES DE LA HORA DE TU RESERVA PARA QUE PUEDAS SER RECOGIDO JUNTO CON LOS DEMÁS PASAJEROS.</b>
                    </div>
                </div> 
				<?php
					if($codigo_viaje_retorno>0)
					{
				?>
				<div class="row">
			        <div class="col-sm-12 planificarviaje">
			        	<button type="submit" class="btn btn-info btn_center">CONFIRMAR VIAJE RETORNO<span class="glyphicon glyphicon-chevron-right"></span></button>			        		
			        </div>          			     
				</div>
				<?php
					}
				?>
			</div>
			
		</div>
		<div class="col-sm-7 inner_body-block_right option animated slideInLeft">
			<div class="row">
				<div class="col-sm-12">
					<div id="viajes">
						<?php  if(isset($message)) 
                        {
	                    ?>
	                    <div class="row">
	                        <div class="col-sm-12 text-center">
	                            <div class='alert alert-success shopAlert'>
	                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                                <?php  echo $message; ?>
	                             </div>
	                        </div>
	                    </div>
	                    <?php
	                        }
	                    ?>
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
		<br>
		<br>
	</div>
</form>

<?php
include_once('container_footer.php');
?>
