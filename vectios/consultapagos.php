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
	$viajeDtl=$controller->consultapagos($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
    
	
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
            <h3 style="text-align:center;color:#FFF;margin-top:1px">ESTADO PAGOS</h3>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <br>
	<div class="row">
		<div class="col-sm-1">
		</div>
		<div class="col-sm-10 inner_body-block">
			
			<div class="col-sm-12">
				<div class="row">
			        <h6>SE ENCUENTRO <?php echo count($viajeDtl);?> REGISTROS DE PAGO</h6>
				</div>
				<div class="row">						
		            <div class="table-responsive">
						<table class="table">
							<thead>
								<tr class="success_row">
									<th>CODIGO VIAJE</th>
									<th>DESDE</th>
									<th>HASTA</th>									
									<th>FECHA SALIDA</th>
									<!-- <th>ESTADO VIAJE</th> -->
									<th>COSTO</th>
									<th>FECHA RESERVACION</th>
									<th>NOMBRE PASAJERO</th>
									<th>ESTADO PAGOS</th>
								</tr>
							</thead>
							<tbody>
								<?php
									for($x=0;$x<count($viajeDtl);$x++) 
									{
										$str = 'PENDIENTE RESERVAR';
										/*if(isset($viajeDtl[$x][9]) && ($viajeDtl[$x][9]==2 || $viajeDtl[$x][9]==3))
											$str = 'PENDIENTE PAGAR';*/
											if(isset($viajeDtl[$x][9]) && $viajeDtl[$x][9]==3)
											$str = 'PENDIENTE PAGAR';
										elseif(isset($viajeDtl[$x][9]) && $viajeDtl[$x][9]==2)
											$str = 'PROGRAMADO';
										elseif(isset($viajeDtl[$x][9]) && $viajeDtl[$x][9]==4)
											$str = '<b>PAGADO</b><br>FECHA PAGO:'.$viajeDtl[$x][10].'<br>DOC:'.$viajeDtl[$x][11];
										/*echo '<tr class="warning"><td>'.$viajeDtl[$x][0].'</td><td>'.$viajeDtl[$x][1].'</td><td>'.$viajeDtl[$x][2].'</td><td>'.$viajeDtl[$x][3].'</td><td>'.$viajeDtl[$x][4].'</td><td>'.$viajeDtl[$x][5].'</td><td>'.$viajeDtl[$x][7].'</td><td>'.$viajeDtl[$x][8].'</td><td>'.$str.'</td></tr>';	*/
										echo '<tr class="warning"><td>'.$viajeDtl[$x][0].'</td><td>'.$viajeDtl[$x][1].'</td><td>'.$viajeDtl[$x][2].'</td><td>'.$viajeDtl[$x][3].'</td><td>'.$viajeDtl[$x][5].'</td><td>'.$viajeDtl[$x][7].'</td><td>'.$viajeDtl[$x][8].'</td><td>'.$str.'</td></tr>';	
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
