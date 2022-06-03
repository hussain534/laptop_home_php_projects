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
	//$controller = new controller();
	//$miclave=$controller->miclave($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
    
	
	$_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }
    
  include_once('header.php');

?>
<br>

 <form method="post" action="doEliminarCuenta.php">
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
						<center><img src="images/icon_dislike.png"></center>
						<h3 style="text-align:center;color:#222;margin-top:1px">ELIMINAR MI CUENTA</h3>
						<br>
					</div>
					<div id="message"></div>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-3">				
							</div>
							<div class="col-sm-6">	
								<div class="row">
									<div class="col-sm-12">
										<b>Antes de que elimines de manera definitiva tu cuenta, permitenos por favor darte algunas indicaciones que podrían resolver algún problema que se te haya presentado</b>
						                <textarea class="form-control" name="obser" id="obser" value="" rows="10" placeholder="Puedes ingresar su comentarios-1500 caracteres" maxlength=1500 required></textarea> 
						                <div class="errorMsg" id="error_obser"></div>
									</div>									
								</div>
							</div>
							<div class="col-sm-3">				
							</div>
						</div>
						<br>
						<div class="row">		
							<button type="submit" class="btn btn-info btn_center">ELIMINAR CUENTA Y CERRAR SESSION<span class="glyphicon glyphicon-chevron-right"></span></button>
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