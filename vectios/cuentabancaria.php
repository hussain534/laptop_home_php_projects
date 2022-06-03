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
	$micuenta=$controller->micuenta($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
    
	
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
            <h3 style="text-align:center;color:#FFF;margin-top:1px">MI CUENTA BANCARIA</h3>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <br>
	<div class="row">
		<div class="col-sm-1">
		</div>
		<div class="col-sm-10 inner_body-block">
			
			<div id="message"></div>
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-3">				
					</div>
					<div class="col-sm-6">				
						<?php
							if(isset($micuenta) && count($micuenta)>0)
							{
						?>
						<div class="row">			
							<div class="col-sm-12 planificarviaje">		
									<div class="form-group">
										<span class="input-group-addon">ID</span>
				                		<input type="text" class="form-control" name="cid" id="cid" value="<?php echo $micuenta[0][0]; ?>"  readonly="true">
				                	</div>
							</div>
							<div class="col-sm-12 planificarviaje">		
								<div class="form-group">
									<span class="input-group-addon">NRO. CUENTA BANCO</span>
					                <input type="text" class="form-control" name="nrocuenta" maxlength="50" id="nrocuenta" value="<?php echo $micuenta[0][1]; ?>">
					                <div class="errorMsg" id="error_nrocuenta"></div>
					            </div>
							</div>
							<div class="col-sm-12 planificarviaje">		
								<div class="form-group">
									<span class="input-group-addon">BANCO</span>
					                <select name="bancoId" class="form-control" id="bancoId"  onchange="getStates()" required>
										<option value="0">Elige su Banco</option>
					                    <?php 
											$controller = new controller();
											$bancos = $controller->getBancos($databasecon,$DEBUG_STATUS);
											for($x=0;$x<count($bancos);$x++)
											{
												if($micuenta[0][2]==$bancos[$x][0])
													echo "<option value='".$bancos[$x][0]."' selected='selected' >".$bancos[$x][1]."</option>";
												else
													echo "<option value='".$bancos[$x][0]."'>".$bancos[$x][1]."</option>";
											}
										?>
				                    </select>
					                <div class="errorMsg" id="error_bancoId"></div>
					            </div>
							</div>
							<div class="col-sm-12 planificarviaje">		
								<div class="form-group">
									<span class="input-group-addon">TIPO CUENTA</span>
					                <select name="tipoCuenta" class="form-control" id="tipoCuenta"  onchange="getStates()" required>
										<option value="0">Elige su Tipo de cuenta</option>
					                    <?php 
											$controller = new controller();
											$tipocuenta = $controller->getTipoCuentas($databasecon,$DEBUG_STATUS);
											for($x=0;$x<count($tipocuenta);$x++)
											{
												if($micuenta[0][3]==$tipocuenta[$x][0])
													echo "<option value='".$tipocuenta[$x][0]."' selected='selected' >".$tipocuenta[$x][1]."</option>";
												else
													echo "<option value='".$tipocuenta[$x][0]."'>".$tipocuenta[$x][1]."</option>";
											}
										?>
				                    </select>
					                <div class="errorMsg" id="error_tipoCuenta"></div>
					            </div>
							</div>
						</div>
						<?php
							}
							else
							{
						?>
						<div class="row">			
							<div class="col-sm-12 planificarviaje">		
								<div class="form-group">
									<span class="input-group-addon">ID</span>
				                	<input type="text" class="form-control" name="cid" id="cid" value="0" readonly="">
				                </div>
							</div>
							<div class="col-sm-12 planificarviaje">		
								<div class="form-group">
									<span class="input-group-addon">NRO. CUENTA BANCO</span>
					                <input type="text" class="form-control" name="nrocuenta" id="nrocuenta" value="">
					                <div class="errorMsg" id="error_nrocuenta"></div>
					            </div>
							</div>
							<div class="col-sm-12 planificarviaje">		
								<div class="form-group">
									<span class="input-group-addon">BANCO</span>
					                <select name="bancoId" class="form-control" id="bancoId"  onchange="getStates()" required>
										<option value="0">Elige su Banco</option>
				                    <?php 
										$controller = new controller();
										$bancos = $controller->getBancos($databasecon,$DEBUG_STATUS);
										for($x=0;$x<count($bancos);$x++)
										{
											echo "<option value='".$bancos[$x][0]."'>".$bancos[$x][1]."</option>";
										}
									?>
				                    </select>
				                	<div class="errorMsg" id="error_bancoId"></div>
				                </div>
							</div>
							<div class="col-sm-12 planificarviaje">		
								<div class="form-group">
									<span class="input-group-addon">TIPO CUENTA</span>
					                <select name="tipoCuenta" class="form-control" id="tipoCuenta"  onchange="getStates()" required>
										<option value="0">Elige su Tipo de cuenta</option>
					                    <?php 
											$controller = new controller();
											$tipocuenta = $controller->getTipoCuentas($databasecon,$DEBUG_STATUS);
											for($x=0;$x<count($tipocuenta);$x++)
											{
												echo "<option value='".$tipocuenta[$x][0]."'>".$tipocuenta[$x][1]."</option>";
											}
										?>
				                    </select>
					                <div class="errorMsg" id="error_tipoCuenta"></div>
					            </div>
							</div>
						</div>
						<?php
							}
						?>
					</div>
					<div class="col-sm-3">				
					</div>
				</div>
				<div class="row">		
					<button type="button" id="btnActualizarCuenta" class="btn btn-info btn_center">ACTUALIZAR <span class="glyphicon glyphicon-chevron-right"></span></button>
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