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
		$_SESSION["last_url"]='mispublicaciones.php';
		//echo $_SESSION["last_url"];
		header("Location:$url"); 
	}
	$controller = new controller();

	$viajeDtl=$controller->mispublicaciones($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
    
	
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
			<h3 style="text-align:center;color:#FFF;margin-top:1px">MIS PUBLICACIONES</h3>
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
			        <h6>SE ENCUENTRO <?php echo count($viajeDtl);?> VIAJES PUBLICADOS</h6>
				</div>
				<div class="row">								
		            <div class="table-responsive">
						<table class="table" style="border:1px solid darkgrey">
							<thead>
								<tr class="success_row" style="border:1px solid darkgrey">
									<th>DETALLES</th>
									<th>CODIGO VIAJE</th>
									<th>DESDE</th>
									<th>HASTA</th>									
									<th>FECHA SALIDA</th>
									<th>ESTADO</th>
									<th>COSTO<br>( $ )</th>
									<th>ASIENTOS OCUPADO</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
									for($x=0;$x<count($viajeDtl);$x++) 
									{
										$str = '<a href=viewCalification.php?searchCodigoViaje='.$viajeDtl[$x][0].'>CALIFICACION</a>';
										echo '	<tr class="warning myrow">
													<td><a href=listPassengers.php?viajeId='.$viajeDtl[$x][0].' title="Ver detalles pasajeros"><span class="glyphicon glyphicon-user" style="border: 1px solid darkgrey;padding:10px;background:#222;border-radius:6px"></span></a></td>
                                                    <td>'.$viajeDtl[$x][0].'</td>
													<td>'.$viajeDtl[$x][1].'</td>
													<td>'.$viajeDtl[$x][2].'</td>
													<td>'.$viajeDtl[$x][3].'</td>
													<td>'.$viajeDtl[$x][4].'</td>
													<td>'.$viajeDtl[$x][5].'</td>
													<td>'.$viajeDtl[$x][6].'</td>
													<td>'.$str.'</td>
												</tr>';	
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="row">
		        <div class="col-sm-12">
		            <a href="#" id="top"><span class="glyphicon glyphicon-arrow-up" style="float:right;margin:5px 10px; color:#01c5c5">TOP</span></a>
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
