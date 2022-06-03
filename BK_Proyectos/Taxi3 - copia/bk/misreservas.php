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
					<center><img src="images/icon_reservas.png"></center>
					<h3 style="text-align:center;color:#222;margin-top:1px">MIS RESERVAS</h3>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="row">
			        <h6>SE ENCUENTRO <?php echo count($viajeDtl);?> VIAJES RESERVADOS</h6>
				</div>
				<div class="row">						
		            <div class="table-responsive">
						<table class="table">
							<thead>
								<tr class="success_row">
									<th>ID</th>
									<th>CODIGO VIAJE</th>
									<th>DESDE</th>
									<th>HASTA</th>									
									<th>FECHA SALIDA</th>
									<th>ESTADO</th>
									<th>COSTO<br>( $ )</th>
									<th>FECHA RESERVADO</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
									for($x=0;$x<count($viajeDtl);$x++) 
									{
										//echo 'ESTADO:'.$viajeDtl[$x][4].' :: '.strcmp($viajeDtl[$x][4], 'TERMINADO').'<br>';
										if(!isset($viajeDtl[$x][4]) || $viajeDtl[$x][4]==null || strcmp($viajeDtl[$x][4], '')==0)
											$str = '<a href=reservarRetornoDesdeAeropuerto.php?codigo_viaje='.$viajeDtl[$x][0].'>APLICAR RETORNO</a>';
										else if(isset($viajeDtl[$x][4]) && $viajeDtl[$x][4]!=null && strcmp($viajeDtl[$x][4], 'TERMINADO')==0)
											$str = '<a href=calificar.php?searchCodigoViaje='.$viajeDtl[$x][0].'&searchIdViaje='.$viajeDtl[$x][8].'&estadoViaje='.$viajeDtl[$x][4].'>CALIFICAR</a>';										
										else $str='';
										echo '<tr class="warning myrow"><td>'.$viajeDtl[$x][8].'</td><td><a href=showConductorPerfil.php?searchCodigoViaje='.$viajeDtl[$x][0].'&searchIdViaje='.$viajeDtl[$x][8].'&estadoViaje='.$viajeDtl[$x][4].'>'.$viajeDtl[$x][0].'</a></td><td>'.$viajeDtl[$x][1].'</td><td>'.$viajeDtl[$x][2].'</td><td>'.$viajeDtl[$x][3].'</td><td>'.$viajeDtl[$x][4].'</td><td>'.$viajeDtl[$x][5].'</td><td>'.$viajeDtl[$x][7].'</td><td>'.$str.'</td></tr>';	
									}
								?>
							</tbody>
						</table>
					</div>
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
