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
	include_once('header.php');

?>
<br>

<form method="post" action="doLogin.php">
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
			<div class="col-sm-10 inner_body-block">
				<div class="row">
					<div class="col-sm-12">
						<h3 style="text-align:center;color:#222;margin-top:1px">BUSCAR VIAJE DESDE AEROPUERTO</h3>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12 planificarviaje">
						<div class="row">
							<div class="col-sm-2">
							</div>
							<div class="col-sm-3">
								<b>CODIGO PARA RETORNO</b>
							</div>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="c_viaje"  value=<?php echo $_GET["codigo_viaje"]; ?> readonly="true" >
					        </div>
					        <div class="col-sm-2">
							</div>
						</div>
					</div>
					<div class="col-sm-12 planificarviaje">
						<div class="row">
							<div class="col-sm-2">
							</div>
							<div class="col-sm-3">
								<b>LUGAR DE SALIDA</b>
							</div>
							<div class="col-sm-5">
								<select name="sector" class="form-control" id="sector"  onchange="getStates()" required>
									<option value='1'>AEROPUERTO QUITO	</option>
			                    </select>
			                    <div id="errorSector" class="errorMsg">                    	
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
							<div class="col-sm-3">
								<b>NRO DE PASAJEROS</b>
							</div>
							<div class="col-sm-5">
								<select name="nroasientessearch" class="form-control" id="nroasientessearch">
			                        <option value="1">1</option>
			                    </select>
					        </div>
					        <div class="col-sm-2">
							</div>
						</div>
					</div>
			        <div class="col-sm-12 planificarviaje">
						<div class="row">
							<div class="col-sm-2">
							</div>
							<div class="col-sm-3">
								<b>FECHA-HORA DE VIAJE</b>
							</div>
							<div class="col-sm-5">
								<input type="date" name="fechaviajesearch" id="fechaviajesearch">
								<select name="horavuelosearch" class="selectpicker" id="horaviajesearch">
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
					        <div class="col-sm-2">
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
					 <br>
			        <div class="col-sm-12 planificarviaje">
			        	<div class="row">
			        		<div class="col-sm-5">	        			
			        		</div>
			        		<div class="col-sm-2 btn_inline">
			        		<button type="button" id="btnViajes" class="btn btn-success btn_center">BUSCAR VIAJES<span class="glyphicon glyphicon-chevron-right"></span></button>
			        		</div>
			        		<div class="col-sm-5">	        			
			        		</div>
			        	</div>
			        </div>          
			        <br>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div id="viajes">
							
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
</form>

<?php
include_once('container_footer.php');
?>
