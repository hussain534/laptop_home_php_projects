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
                    <!-- <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class='alert alert-success shopAlert'>
                                <?php  echo 'Para confirmar su viaje, por favor realiza pago de su viaje en CUENTA: '.$micuenta[0][0],', del BANCO:'.$micuenta[0][1].' (TIPO CUENTA:'.$micuenta[0][2].')' ?>
                             </div>
                        </div>
                    </div>
                    <div class="row">
		                <div class="col-sm-12">
		                    <button type="button" class="btn btn-success btn_summary_viaje_green">AEROPUERTO - QUITO</button>
		                    <button type="button" class="btn btn-primary btn_summary_viaje">QUITO - AEROPUERTO</button>
		                </div>
		            </div>  -->
					<div class="row">
						<div class="col-sm-12">
				        	<h6>SE ENCUENTRO <?php echo count($viajeDtl);?> VIAJES</h6>
				        </div>
					</div>
					<div class="row">	
						<div class="col-sm-12">					
			            <!-- <div class="table-responsive">
							<table class="table">
								<thead>
									<tr class="success_row">
										<th>DETALLES</th>
										<th>CODIGO VIAJE</th>
										<th>CODIGO PAGO</th>
										<th>DESDE</th>
										<th>HASTA</th>									
										<th>FECHA SALIDA</th>
										<th>IDA PAGADO</th>
										<th>RETORNO PAGADO</th>
										<th>RETORNO PENDIENTE</th>
										<th>COSTO<br>( $ )</th>
										<th></th>
										<th></th>
									</tr>
								</thead>
								<tbody> -->
									<?php
									echo '<div class=row>';
										for($x=0;$x<count($viajeDtl);$x++) 
										{
											$str0='';
											$str='';
											$str2='';
											if(isset($viajeDtl[$x][13]) && $viajeDtl[$x][13]==0)
												$str0 = '<a href="#" data-toggle="tooltip" title="'.$viajeDtl[$x][14].'"><span class="glyphicon glyphicon-info-sign glyphicon-info-sign-default"></span></a>';

											if(isset($viajeDtl[$x][10]) && ($viajeDtl[$x][10]==2 || $viajeDtl[$x][10]==3) && isset($viajeDtl[$x][17]) && $viajeDtl[$x][17]>0 && isset($viajeDtl[$x][18]) && $viajeDtl[$x][18]>0)
											{
												if(isset($viajeDtl[$x][11]) && $viajeDtl[$x][11]==0)
													$str2 = '<a href=iniciarviajeRetornoCiudad.php?codigo_viaje='.$viajeDtl[$x][12].'&tipo=1><pre class="pre-on-going">APLICAR RETORNO</pre></a>';
												else
													$str2 = '<a href=iniciarviajeRetornoAeropuerto.php?codigo_viaje='.$viajeDtl[$x][12].'&tipo=1><pre class="pre-on-going">APLICAR RETORNO</pre></a>';
											}

											if(isset($viajeDtl[$x][10]) && $viajeDtl[$x][10]==1)
												$str = '<a href=pagar.php?codigo_pago='.$viajeDtl[$x][19].'&tipo=1><pre class="pre-pagar">PAGAR</pre></a>';
											else if(isset($viajeDtl[$x][10]) && $viajeDtl[$x][10]==3)
												$str = '<a href=calificar.php?searchIdViaje='.$viajeDtl[$x][0].'><pre class="pre-calificar">CALIFICAR</pre></a>';
											else if(isset($viajeDtl[$x][0]) && $viajeDtl[$x][0]>0 && isset($viajeDtl[$x][10]) && $viajeDtl[$x][10]==2 && isset($viajeDtl[$x][9]) && $viajeDtl[$x][9]==1)
												/*$str='<button type="button" onclick="terminarViaje('.$viajeDtl[$x][0].')" class="btn-success" style="border-radius:4px" title="REGISTRAR VIAJE TERMINADO"><span class="glyphicon glyphicon-ok"></span></button>';*/
												$str='<pre onclick=terminarViaje('.$viajeDtl[$x][0].',"'.$viajeDtl[$x][19].'") class="pre-success">REGISTRAR VIAJE TERMINADO</pre>';
											else if(isset($viajeDtl[$x][0]) && $viajeDtl[$x][0]==0 && isset($viajeDtl[$x][9]) && $viajeDtl[$x][9]==1)
												$str='<pre class="pre-disabled">EXPIRADO</pre>';
											
											else if(isset($viajeDtl[$x][10]) && $viajeDtl[$x][10]==6)
												$str = '<pre class="pre-pending">VERIFICACION PAGO PENDIENTE</pre>';
											else if(isset($viajeDtl[$x][10]) && $viajeDtl[$x][10]==7)
											{
												$str = '<pre class="pre-pending">PAGO RECHAZADO</pre><a href=pagar.php?codigo_pago='.$viajeDtl[$x][19].'&tipo=1><pre class="pre-act-pago">ACTUALIZAR PAGO</pre></a>';
											}
											else
												$str='<pre class="pre-pending">PENDIENTE VIAJAR</pre>';
											
											
											$str=$str.' '.$str2;
											$txt="";
											if($viajeDtl[$x][0]>0)
											{
												$txt='<td><a href=showCoPassengers.php?viajeId='.$viajeDtl[$x][0].' title="Ver detalles pasajeros"><span class="glyphicon glyphicon-user" style="font-size:22px;border: 1px solid darkgrey;padding:14px;background:#222;border-radius:6px"></span></a>
												<a href=conductorForTrip.php?viajeId='.$viajeDtl[$x][0].' title="Ver detalle del conductor asignado para este viaje"><i class="fa fa-automobile" style="font-size:25px;color:#d3d300;border: 1px solid darkgrey;padding:12px;background:#222;border-radius:6px"></i></a></td>';
											}
											else
											{
												$txt='<td><a href=# title="Aun no asignado conductor para este viaje"><i class="fa fa-automobile" style="font-size:25px;color:#f5f5f5;border: 1px solid darkgrey;padding:12px;background:darkgrey;border-radius:6px"></i></a></td>';
											}


											if(isset($viajeDtl[$x][18]) && $viajeDtl[$x][18]>0)
											{
												/*echo '	<tr class="warning myrow">'.$txt.'															
	                                                    <td>'.$viajeDtl[$x][0].'</td>
	                                                    <td>'.$viajeDtl[$x][8].'</td>
														<td>'.$viajeDtl[$x][1].'</td>
														<td>'.$viajeDtl[$x][2].'</td>
														<td>'.$viajeDtl[$x][3].'</td>
														<td>'.$viajeDtl[$x][15].'</td>
														<td>'.$viajeDtl[$x][16].'</td>
														<td>'.$viajeDtl[$x][17].'</td>
														<td>'.$viajeDtl[$x][5].'</td>															
														<td style="text-align:center">'.$str0.'</td>
														<td style="text-align:center">'.$str.'</td>
													</tr>';*/
													/*echo '<div class="col-sm-6 viajes_data_blue">';
														echo '<div class=row>';*/
															if($viajeDtl[$x][20]==1)
															{
																echo '<div data-mh="my-group" class="col-sm-6 viajes_data_blue">';
																	echo '<div class=row>';
																		echo '<div class=col-sm-12><div class=row style="background:#058aba; font-size:18px;margin:0 -3px;padding:16px;color:#f5f5f5"><div class=col-sm-12 style="font-size:20px">VIAJE : '.($x+1).'</div></div></div>';
															}
															else
															{ 
																echo '<div data-mh="my-group" class="col-sm-6 viajes_data_green">';
																	echo '<div class=row>';
																		echo '<div class=col-sm-12><div class=row style="background:#1dd31d; font-size:18px;margin:0 -3px;padding:16px;color:#f5f5f5"><div class=col-sm-12 style="font-size:20px">VIAJE : '.($x+1).'</div></div></div>';
															}
															echo '<div class=col-sm-6 style="line-height:22px;"><b>CODIGO VIAJE</b></div>';
															echo '<div class=col-sm-6 style="line-height:22px;">'.$viajeDtl[$x][0].'</div>';
															echo '<div class=col-sm-6 style="line-height:22px;"><b>CODIGO PAGO</b></div>';
															echo '<div class=col-sm-6 style="line-height:22px;">'.$viajeDtl[$x][8].'</div>';
															echo '<div class=col-sm-6 style="line-height:22px;"><b>DESDE</b></div>';
															echo '<div class=col-sm-6 style="line-height:22px;">'.$viajeDtl[$x][1].'</div>';
															echo '<div class=col-sm-6 style="line-height:22px;"><b>HASTA</b></div>';
															echo '<div class=col-sm-6 style="line-height:22px;">'.$viajeDtl[$x][2].'</div>';
															echo '<div class=col-sm-6 style="line-height:22px;"><b>FECHA SALIDA</b></div>';
															echo '<div class=col-sm-6 style="line-height:22px;">'.$viajeDtl[$x][3].'</div>';
															/*echo '<div class=col-sm-6 style="line-height:22px;"><b>IDA PAGADO</b></div>';
															echo '<div class=col-sm-6 style="line-height:22px;">'.$viajeDtl[$x][15].'</div>';
															echo '<div class=col-sm-6 style="line-height:22px;"><b>RETORNO PAGADO</b></div>';
															echo '<div class=col-sm-6 style="line-height:22px;">'.$viajeDtl[$x][16].'</div>';
															echo '<div class=col-sm-6 style="line-height:22px;"><b>RETORNO PENDIENTE</b></div>';
															echo '<div class=col-sm-6 style="line-height:22px;">'.$viajeDtl[$x][17].'</div>';*/
															echo '<div class=col-sm-6 style="line-height:22px;"><b>COSTO( $ )</b></div>';
															echo '<div class=col-sm-6 style="line-height:22px;">'.number_format((float)$viajeDtl[$x][5], 2, '.', '').'</div>';
															echo '<div class=col-sm-3 style="line-height:22px;"></div>';
															echo '<div class=col-sm-6 style="line-height:22px;">'.$str0.'</div>';
															echo '<div class=col-sm-3 style="line-height:22px;"></div>';
															echo '<div class=col-sm-6 style="line-height:22px;"></div>';
															echo '<div class=col-sm-6 style="line-height:22px;">'.$txt.'</div>';
															echo '<div class=col-sm-3 style="line-height:22px;"></div>';
															echo '<div class=col-sm-6 style="line-height:22px;">'.$str.'</div>';
															echo '<div class=col-sm-3 style="line-height:22px;"></div>';
														echo '</div>';
													echo '</div>';

											}
											else
											{
												/*echo '	<tr class="warning myrow">'.$txt.'															
	                                                    <td>'.$viajeDtl[$x][0].'</td>
	                                                    <td>'.$viajeDtl[$x][8].'</td>
														<td>'.$viajeDtl[$x][1].'</td>
														<td>'.$viajeDtl[$x][2].'</td>
														<td>'.$viajeDtl[$x][3].'</td>
														<td>'.$viajeDtl[$x][15].'</td>
														<td></td>
														<td></td>
														<td>INCLUIDO EN VIAJE DE IDA</td>	
														<td style="text-align:center">'.$str0.'</td>														
														<td style="text-align:center">'.$str.'</td>
													</tr>';*/	
												/*echo '<div class="col-sm-6 viajes_data_blue">';
													echo '<div class=row>';*/
														if($viajeDtl[$x][20]==1)
														{
															echo '<div data-mh="my-group" class="col-sm-6 viajes_data_blue">';
																echo '<div class=row>';
																	echo '<div class=col-sm-12><div class=row style="background:#058aba; font-size:18px;margin:0 -3px;padding:16px;color:#f5f5f5"><div class=col-sm-12 style="font-size:20px">VIAJE : '.($x+1).'</div></div></div>';
														}
														else
														{
															echo '<div data-mh="my-group" class="col-sm-6 viajes_data_green">';
																echo '<div class=row>';
																	echo '<div class=col-sm-12><div class=row style="background:#1dd31d; font-size:18px;margin:0 -3px;padding:16px;color:#f5f5f5"><div class=col-sm-12 style="font-size:20px">VIAJE : '.($x+1).'</div></div></div>';
														}
														echo '<div class=col-sm-6 style="line-height:22px;"><b>CODIGO VIAJE</b></div>';
														echo '<div class=col-sm-6 style="line-height:22px;">'.$viajeDtl[$x][0].'</div>';
														echo '<div class=col-sm-6 style="line-height:22px;"><b>CODIGO PAGO</b></div>';
														echo '<div class=col-sm-6 style="line-height:22px;">'.$viajeDtl[$x][8].'</div>';
														echo '<div class=col-sm-6 style="line-height:22px;"><b>DESDE</b></div>';
														echo '<div class=col-sm-6 style="line-height:22px;">'.$viajeDtl[$x][1].'</div>';
														echo '<div class=col-sm-6 style="line-height:22px;"><b>HASTA</b></div>';
														echo '<div class=col-sm-6 style="line-height:22px;">'.$viajeDtl[$x][2].'</div>';
														echo '<div class=col-sm-6 style="line-height:22px;"><b>FECHA SALIDA</b></div>';
														echo '<div class=col-sm-6 style="line-height:22px;">'.$viajeDtl[$x][3].'</div>';
														echo '<div class=col-sm-6 style="line-height:22px;"><b>PASAJEROS (IDA)</b></div>';
														echo '<div class=col-sm-6 style="line-height:22px;">'.$viajeDtl[$x][15].'</div>';
														echo '<div class=col-sm-6 style="line-height:22px;"><b>PASAJEROS (RETORNO)</b></div>';
														echo '<div class=col-sm-6 style="line-height:22px;">&nbsp;</div>';
														echo '<div class=col-sm-6 style="line-height:22px;"><b>RETORNO PENDIENTE</b></div>';
														echo '<div class=col-sm-6 style="line-height:22px;">&nbsp;</div>';
														echo '<div class=col-sm-6 style="line-height:22px;"><b>COSTO( $ )</b></div>';
														echo '<div class=col-sm-6 style="line-height:22px;">INCLUIDO EN VIAJE DE IDA</div>';
														echo '<div class=col-sm-6 style="line-height:22px;"></div>';
														echo '<div class=col-sm-6 style="line-height:22px;">'.$str0.'</div>';
														echo '<div class=col-sm-6 style="line-height:22px;">&nbsp;</div>';
														echo '<div class=col-sm-6 style="line-height:22px;">'.$txt.'</div>';
														echo '<div class=col-sm-6 style="line-height:22px;">&nbsp;</div>';
														echo '<div class=col-sm-5 style="line-height:22px;">'.$str.'</div>';
														echo '<div class=col-sm-1 style="line-height:22px;">&nbsp;</div>';
													echo '</div>';
												echo '</div>';
											}
											if($x%2==1)
											{
												echo '</div>';
												echo '<br><br><br>';
												echo '<div class=row>';
											}
										}
									?>
								<!-- </tbody>
							</table>
						</div> -->
						</div>
					</div>
				</div>
			</div>
			<br>
			
		</div>
	</div>
	<br>
	<br>
</div>

<?php
include_once('container_footer.php');
?>
