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
            <h3 style="text-align:center;color:#FFF;margin-top:1px">CAMBIAR CLAVE</h3>
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
				
				<div id="message"></div>
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-3">				
						</div>
						<div class="col-sm-6">	
							<div class="row">			
								<div class="col-sm-12 planificarviaje">		
									<div class="form-group">
										<span class="input-group-addon">NUEVA CLAVE</span>	
						                <input type="password" class="form-control" name="newpwd" id="newpwd" value="">
						                <div class="errorMsg" id="error_newpwd"></div>
									</div>
								</div>
								<div class="col-sm-12 planificarviaje">		
									<div class="form-group">
										<span class="input-group-addon">CONFIRMAR CLAVE</span>
						                <input type="password" class="form-control" name="confpwd" id="confpwd" value="">
						                <div class="errorMsg" id="error_confpwd"></div>
									</div>
								</div>
								<div class="col-sm-12 planificarviaje">		
									<div class="form-group">
										<span class="input-group-addon">CLAVE ANTERIOR</span>
						                <input type="password" class="form-control" name="oldpwd" id="oldpwd" value="">
						                <div class="errorMsg" id="error_oldpwd"></div>
						            </div>
								</div>										
							</div>
						</div>
						<div class="col-sm-3">				
						</div>
					</div>
					<div class="row">		
						<button type="button" id="btnActualizarClave" class="btn btn-info btn_center">ACTUALIZAR <span class="glyphicon glyphicon-chevron-right"></span></button>
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