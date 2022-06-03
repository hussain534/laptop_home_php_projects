<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    //include_once('util.php');
	include_once('config.php'); 
	$session_time=$session_expirry_time;
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
	$costo_uio_aero=$costo_quito_aeropuerto;
    $costo_aero_uio=$costo_aeropuerto_quito;
  	if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
	{
		//echo 'inside<br>';
		$url="userlogin.php";
		if(isset($_GET["idviaje"]))
			$_SESSION["last_url"]=$_SERVER['REQUEST_URI'];
		//echo $_SESSION["last_url"];
		header("Location:$url"); 
	}
	else
	{
		include_once('util.php');
	}
		$controller = new controller();

		$isVerified=$controller->isUserPerfilCompleted($databasecon,0,(isset($_SESSION['userEmail'])?$_SESSION['userEmail']:null),(isset($_SESSION['userRole'])?$_SESSION['userRole']:null),$DEBUG_STATUS);
        
	
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
    if(isset($_GET["tipoviaje"]) && $_GET["tipoviaje"]==0 && isset($_GET["cantpass"]))
    {
    	if($_GET["cantpass"]==4)
    	{
    		$costo_uio_aero=10;
	        $cantpass=2;
    	}
	    else if($_GET["cantpass"]==5)
	    {
	    	$costo_uio_aero=6.25;
	        $cantpass=4;
	    }
	    else
	        $cantpass=$_GET["cantpass"];
    }
    else if(isset($_GET["tipoviaje"]) && $_GET["tipoviaje"]==1 && isset($_GET["cantpass"]))
    	$cantpass=$_GET["cantpass"];
    else	
    	$cantpass=0;

    $viajeDtl = $controller->getDetallesViajesById($databasecon,$idviaje,$cantpass,$DEBUG_STATUS);

  include_once('header.php');

?>
<br>

<?php 	
	if(isset($_GET["tipoviaje"]) && $_GET["tipoviaje"]==1)
	{
?>
	<form method="post" action=doAcceptarViajeNacional.php enctype="multipart/form-data">
<?php
	}
	else
	{		
?>
	<form method="post" action=doAcceptarViaje.php enctype="multipart/form-data">
<?php
	}
?>
	<input type="hidden" name="submitted" value="true" /> 
	
	<div class="container inner_body" id="estadoReservarViaje">
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
						<center><img src="images/icon_reservar.png"></center>
						<h3 style="text-align:center;color:#222;margin-top:1px">RESERVAR VIAJE</h3>
					</div>
				</div>
				<br>				
				<div class="row">
					<div class="col-sm-12">
						<h6 class="text-center">SE HA SELECIONADO SIGUIENTE VIAJE</h6>
					</div>
				</div>
				<?php 	
					if(isset($_GET["tipoviaje"]) && $_GET["tipoviaje"]==1) 
					{
				?>
					<input type="hidden" name="cost_trip" value='<?php echo $_GET["costoviaje"];?>' />
				<?php
					}
				?>
				<div class="row">
					<div class="col-sm-12">
						<input type="hidden" name="cantpass" id="cantpass" value=<?php echo $viajeDtl[0][6];?> />
			            <div class="table-responsive">
							<table class="table">
								<thead>
									<tr class="success_row">
										<th>ID</th>
										<th>PLACA</th>
										<th>ORIGEN</th>
										<th>DESTINO</th>									
										<th>FECHA SALIDA</th>
										<th>COSTO / ASIENTO <br>(En $)</th>
										<th>ASIENTES <br>SOLICITADO</th>
										<th>COSTO TOTAL</th>
									</tr>
								</thead>
								<tbody>
									<?php 	
										if(isset($_GET["tipoviaje"]) && $_GET["tipoviaje"]==1)
											echo '<tr class="warning"><td>'.$viajeDtl[0][0].'</td><td>'.$viajeDtl[0][1].'</td><td>'.$viajeDtl[0][2].'</td><td>'.$viajeDtl[0][3].'</td><td>'.$viajeDtl[0][4].'</td><td>'.$viajeDtl[0][5].'</td><td>'.$viajeDtl[0][6].'</td><td>'.$viajeDtl[0][5]*$viajeDtl[0][6].'</td></tr>';	
										else
											echo '<tr class="warning"><td>'.$viajeDtl[0][0].'</td><td>'.$viajeDtl[0][1].'</td><td>'.$viajeDtl[0][2].'</td><td>'.$viajeDtl[0][3].'</td><td>'.$viajeDtl[0][4].'</td><td>'.$costo_uio_aero.'</td><td>'.$viajeDtl[0][6].'</td><td>'.$costo_uio_aero*$viajeDtl[0][6].'</td></tr>';	
									
									?>
								</tbody>
							</table>
						</div>
					</div>
					<br>
					<input type="hidden" name="idviaje" id="idviaje" value=<?php echo $idviaje;?> />
					<input type="hidden" name="asientesctr" id="asientesctr" value=<?php echo $viajeDtl[0][6];?> />
					<?php
						if(isset($_GET["tipoviaje"]) && $_GET["tipoviaje"]==0)
						{
					?>
					<input type="hidden" name="costoAsiento" id="costoAsiento" value=<?php echo $costo_uio_aero;?> />
					<?php
						}
						else
						{
					?>
					<input type="hidden" name="costoAsiento" id="costoAsiento" value=<?php echo $viajeDtl[0][5];?> />
					<?php
						}
					?>
					<input type="hidden" name="costoRetorno" id="costoRetorno" value="" />
				</div>
				<div class="row">
					<div class="col-sm-12 itemDtl">
	                    <div class="input-group">
							<span class="input-group-addon">DIRECCION PARA RECOGER</span>
		                    <input type="text" class="form-control" size=25 name="direccion" placeholder="Calle principal, numeracion y calle secundario" id="direccion" value="" required >
		                    <div id="errorDireccion" class="errorMsg"></div>
		                </div>
			        </div>
				</div>
				<?php
					if(isset($_GET["tipoviaje"]) && $_GET["tipoviaje"]==0)
					{
				?>
				<div class="row">
					<br>
					<div class="col-sm-12 text-center">
						<b>¿RESIDES EN QUITO? ¿NECESITAS TRANSPORTE AL VOLVER A TU HOGAR? RESÉRVALO AHORA Y PAGA SOLO $6.00.  LOS DETALLES DE TU RECOGIDA PODRÁS INDICARLOS UNA VEZ DECIDAS VOLVER A TU CIUDAD</b><br>
						<input type="radio" name="eligoretorno" value="0" checked="true" onchange=calcularCosto();>No
						<input type="radio" name="eligoretorno" value="1" onchange="calcularCosto();">Si
		            </div>
				</div>
				<?php
					}
				?>
				
				<br>
				<div class="row">
					<div class="col-sm-12 text-center">
						<button type="button" id="btnAbrirPago" class="btn btn-info btn_center">CONTINUAR A PAGAR <span class="glyphicon glyphicon-chevron-right"></span></button>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12 text-center" id="costoTotal">						
					</div>
				</div>
				<div id="panelPago">
					<div class="row">
						<div class="col-sm-12 text-center">
							<div class="row">
								<div class="col-sm-6">			
									<br>
									<b>ELIGES SU TIPO DE PAGO</b>
									<br>
									<input type="radio" name="tipoPago" value="1" checked="true">Transferencia Bancaria
									<br>
									<input type="radio" name="tipoPago" value="2">Deposito en Banco
									<br>
									<input type="radio" name="tipoPago" value="3">Tarjeta Debito
									<br>
									<input type="radio" name="tipoPago" value="4">Tarjeta Credito
								</div>
								<div class="col-sm-6 text-left">									
									<br>

									<b>SUBE SU DOCUMENTO DE PAGO</b>
									<br>
									<img src=images/unknown_user.png id="uploadImg" class="profileImage"/>
									<input type="file" name="fileToUpload" id="fileToUpload" required> 
									<div class="progress" id="progress">
	    								<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
	    							</div>
			                        <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p>
								</div>
							</div>
		                </div>
					</div>
					<div class="row">
					 	<div class="col-sm-12">
					 		<?php
					 			if($isVerified==1)
						        {
						        	echo "<div class='alert alert-danger'><center>NO SE ENCUENTRO DETALLES CONTACTO. POR FAVOR <a href='editDetallesPersonales.php'>ACTUALIZAR</a> AHORA</center></div>";
						        }
						        elseif($isVerified==2)
						        {
						        	echo "<div class='alert alert-danger'><center>NO SE HA VERIFICADO SU CORREO ELECTRONICO. <br>PARA ACTIVACION, POR FAVOR UTILIZAR LA LINK ENVIADO A SU CORREO EN MOMENTO DE REGISTRACION DE SU CUENTA</center></div>";
						        }
						        elseif($isVerified==3)
						        {
						        	echo "<div class='alert alert-danger'><center>NO SE ENCUENTRO SU CEDULA O AUN NO ESTA ABROBADO. POR FAVOR <a href='editDocumentosConductor.php'>ACTUALIZAR</a> AHORA.</center></div>";								        	
						        }
						        else
						        {
					 		?>
					       			<!-- <button type="button" id="btnAcceptarViaje" class="btn btn-success btn_center">ACCEPTAR VIAJE <span class="glyphicon glyphicon-chevron-right"></span></button> -->
					       			<br>
					       			<button type="submit"  class="btn btn-info btn_center">ACCEPTAR VIAJE <span class="glyphicon glyphicon-chevron-right"></span></button>
					       	<?php
					       		}
					       	?>
					    </div>
					</div>
				</div>			
			</div>
			<div class="col-sm-1">
			</div>
		</div>
		<br>
		<br>
<!-- </form> -->
	</div>
</form>
<?php
include_once('container_footer.php');
?>
