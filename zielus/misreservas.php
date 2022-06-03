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
		$_SESSION["last_url"]='misreservas.php';
		//echo $_SESSION["last_url"];
		header("Location:$url"); 
	}
	$controller = new controller();
	$viajeDtl=$controller->misreservas($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
	$micuenta=$controller->micuentaDtl($databasecon,1,$DEBUG_STATUS);
	//$solicitudDtl=$controller->misSolicitudes($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
    
	
	$_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }
    
  include_once('header.php');

?>
<br>
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
		<div class="col-sm-10 bg-crimson">
			<br>
			<h3 style="text-align:center;color:#FFF;margin-top:1px">MIS VIAJES</h3>
		</div>
		<div class="col-sm-1">
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-sm-1">
		</div>
		<div class="col-sm-10 inner_body-block">
			<div class="row">				
				<div class="col-sm-12">
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
                        <div class="col-sm-12 text-center">
                            <div class='alert alert-success shopAlert'>
                                <?php  echo 'Para confirmar su viaje, por favor realiza pago de su viaje en CUENTA: '.$micuenta[0][0],', del BANCO:'.$micuenta[0][1].' (TIPO CUENTA:'.$micuenta[0][2].')' ?>
                             </div>
                        </div>
                    </div>
					<div class="row">
				        <h6>SE ENCUENTRO <?php echo count($viajeDtl);?> VIAJES</h6>
					</div>
					<div class="row">						
			            <div class="table-responsive">
							<table class="table">
								<thead>
									<tr class="success_row">
										<th>DETALLES</th>
										<th>VIAJE ID</th>
										<th>CODIGO PAGO</th>
										<th>DESDE</th>
										<th>HASTA</th>									
										<th>FECHA SALIDA</th>
										<th>ESTADO</th>
										<th>COSTO<br>( $ )</th>
										<!-- <th>FECHA ACCEPTADO</th> -->
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
										for($x=0;$x<count($viajeDtl);$x++) 
										{
											$str0='';
											if(isset($viajeDtl[$x][13]) && $viajeDtl[$x][13]==0)
												$str0 = '<a href="#" data-toggle="tooltip" title="'.$viajeDtl[$x][14].'"><span class="glyphicon glyphicon-info-sign glyphicon-info-sign-default"></span></a>';

											//echo 'ESTADO:'.$viajeDtl[$x][10].'<br>';
											if(isset($viajeDtl[$x][10]) && $viajeDtl[$x][10]==1)
												$str = '<a href=pagar.php?codigo_pago='.$viajeDtl[$x][8].'&tipo=1><pre class="pre-pagar">PAGAR</pre></a>';
											else if(isset($viajeDtl[$x][10]) && $viajeDtl[$x][10]==3)
												$str = '<a href=calificar.php?searchIdViaje='.$viajeDtl[$x][0].'><pre class="pre-calificar">CALIFICAR</pre></a>';
											else if(isset($viajeDtl[$x][0]) && $viajeDtl[$x][0]>0 && isset($viajeDtl[$x][10]) && $viajeDtl[$x][10]==2 && isset($viajeDtl[$x][9]) && $viajeDtl[$x][9]==1)
												/*$str='<button type="button" onclick="terminarViaje('.$viajeDtl[$x][0].')" class="btn-success" style="border-radius:4px" title="REGISTRAR VIAJE TERMINADO"><span class="glyphicon glyphicon-ok"></span></button>';*/
												$str='<pre onclick=terminarViaje('.$viajeDtl[$x][0].',"'.$viajeDtl[$x][8].'") class="pre-success">REGISTRAR VIAJE TERMINADO</pre>';
											else if(isset($viajeDtl[$x][0]) && $viajeDtl[$x][0]==0 && isset($viajeDtl[$x][9]) && $viajeDtl[$x][9]==1)
												$str='<pre class="pre-disabled">EXPIRADO</pre>';
											else if(isset($viajeDtl[$x][10]) && $viajeDtl[$x][10]==0)
												$str = '<a href=reservarRetornoDesdeAeropuerto.php?codigo_viaje='.$viajeDtl[$x][12].'&tipo=1><pre class="pre-on-going">APLICAR RETORNO</pre></a>';
											/*else if(!isset($viajeDtl[$x][4]) || $viajeDtl[$x][4]==null || strcmp($viajeDtl[$x][4], '')==0)
												$str = '<a href=reservarRetornoDesdeAeropuerto.php?codigo_viaje='.$viajeDtl[$x][0].'>APLICAR RETORNO</a>';
											else if(isset($viajeDtl[$x][4]) && $viajeDtl[$x][4]!=null && strcmp($viajeDtl[$x][4], 'TERMINADO')==0)
												$str = '<a href=calificar.php?searchCodigoViaje='.$viajeDtl[$x][0].'&searchIdViaje='.$viajeDtl[$x][8].'&estadoViaje='.$viajeDtl[$x][4].'>CALIFICAR</a>';										
											else if(isset($viajeDtl[$x][9]) && $viajeDtl[$x][9]!=null && $viajeDtl[$x][9]==1)
												$str='<button type="button" onclick="terminarViaje('.$viajeDtl[$x][8].')" class="btn-info btn_center" style="border-radius:4px" title="REGISTRAR VIAJE TERMINADO"><span class="glyphicon glyphicon-ok"></span></button>';
											*/
											else if(isset($viajeDtl[$x][10]) && $viajeDtl[$x][10]==6)
												$str = '<pre class="pre-pending">VERIFICACION PAGO PENDIENTE</pre>';
											else if(isset($viajeDtl[$x][10]) && $viajeDtl[$x][10]==7)
												$str = '<pre class="pre-pending">PAGO RECHAZADO</pre>';
											else
												$str='<pre class="pre-pending">PENDIENTE VIAJAR</pre>';
											

											$str=$str0.' '.$str;
											$txt="";
											if($viajeDtl[$x][0]>0)
											{
												$txt='<td><a href=conductorForTrip.php?viajeId='.$viajeDtl[$x][0].' title="Ver detalles conductor"><i class="fa fa-automobile" style="font-size:15px;color:#d3d300;border: 1px solid darkgrey;padding:8px;background:#222;border-radius:6px"></i></a></td>';
											}
											else
											{
												$txt='<td></td>';
											}


											if(isset($viajeDtl[$x][11]) &&$viajeDtl[$x][11]==1 && isset($viajeDtl[$x][10]) && $viajeDtl[$x][10]==1)
											{
												echo '	<tr class="warning myrow">'.$txt.'
														
                                                    	<td>'.$viajeDtl[$x][0].'</td>
														<td>'.$viajeDtl[$x][8].'</td>
														<td>'.$viajeDtl[$x][1].'</td>
														<td>'.$viajeDtl[$x][2].'</td>
														<td>'.$viajeDtl[$x][3].'</td>
														<td>'.$viajeDtl[$x][4].'</td>
														<td></td>
														
														<td></td>
													</tr>';	
											}
											else
											{
												echo '	<tr class="warning myrow">'.$txt.'
															
		                                                    <td>'.$viajeDtl[$x][0].'</td>
		                                                    <td>'.$viajeDtl[$x][8].'</td>
															<td>'.$viajeDtl[$x][1].'</td>
															<td>'.$viajeDtl[$x][2].'</td>
															<td>'.$viajeDtl[$x][3].'</td>
															<td>'.$viajeDtl[$x][4].'</td>
															<td>'.$viajeDtl[$x][5].'</td>
															
															<td style="text-align:center">'.$str.'</td>
														</tr>';	
											}
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<br>
			<!-- <div class="col-sm-12">
				<div class="row">
			        <h6>SE ENCUENTRO <?php echo count($solicitudDtl);?> VIAJES SOLICITADAS</h6>
				</div>
				<div class="row">						
		            <div class="table-responsive">
						<table class="table">
							<thead>
								<tr class="success_row">
									<th>NRO BOLETO</th>
									<th>CODIGO RESERVA</th>
									<th>DESDE</th>
									<th>HASTA</th>									
									<th>FECHA SALIDA</th>
									<th>ESTADO</th>
									<th>CANT. PASAJEROS</th>
									<th>COSTO<br>( $ )</th>
									<th>MEDIO DE PAGO</th>
									<th>FECHA RESERVADO</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
									for($x=0;$x<count($solicitudDtl);$x++) 
									{
										echo '<tr class="warning myrow"><td>'.$solicitudDtl[$x][8].'</td><td>'.$solicitudDtl[$x][0].'</td><td>'.$solicitudDtl[$x][1].'</td><td>'.$solicitudDtl[$x][2].'</td><td>'.$solicitudDtl[$x][3].'</td><td>PENDIENTE ASIGNACION</td><td>'.$solicitudDtl[$x][10].'</td><td>'.$solicitudDtl[$x][5].'</td><td>'.$solicitudDtl[$x][6].'</td><td>'.$solicitudDtl[$x][7].'</td></tr>';	
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div> -->
		</div>
	</div>
	<br>
	<br>
</div>

<?php
include_once('container_footer.php');
?>
