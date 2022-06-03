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
	$searchDocId=0;
	$controller = new controller();
	if(isset($_POST['submittedSearch']))
	{
		$searchDocId= $_POST["searchDocId"];
		//echo '<br><br><br><br><br>CODIGO PAGO:'.$_POST["searchDocId"];
		$controlDocuments=$controller->controlPagosById($databasecon,$_POST["searchDocId"],$DEBUG_STATUS);
	}
	else
		$controlDocuments=$controller->controlPagos($databasecon,$DEBUG_STATUS);
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
					<center><img src="images/icon_settings.png"></center>
					<h3 style="text-align:center;color:#222;margin-top:1px">ADMIN PAGOS</h3>
				</div>
			</div>
			<br>
			<br>
			<?php 
				
		        if(isset($message)) 
		        {
		    ?>
		    <div class="row">
		        <div class="col-sm-3">
		        </div>
		        <div class="col-sm-6">
		            <div class='alert alert-success shopAlert text-center'>
		                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                <?php  
		                    echo $message; 
		                ?>
		             </div>
		        </div>
		        <div class="col-sm-3">
		        </div>
		    </div>
		    <?php
		        }
		    ?>

		    	<form method="post" action=adminPagos.php enctype="multipart/form-data">
					<input type="hidden" name="submittedSearch" value="true" />
					<div class="row">
				        <div class="col-sm-3">
							<?php	
							
							if(isset($controlDocuments))
							{
								echo '<button type="button" class="btn btn-primary" style="padding:5px 25px;">DOCUMENTOS DE PAGOS PENDIENTES <span class="badge">'.count($controlDocuments).'</span></button>';					
							?>					
				        </div>				    
				        <div class="col-sm-4">
				        </div>
				        <div class="col-sm-4 text-right">
							<input type="text" class="form-control" name="searchDocId" value="" placeholder="INGRESAR CODIGO DE PAGO" required>
						</div>
						<div class="col-sm-1">
							<button type="submit" class="btn btn-primary" style="margin:0;padding:0;min-width:50px !important"><img src="images/search.png" style="width:62%"></button>
				        </div>
				    </div>
							<?php
							}
							?>
				</form>


				<form method="post" action=aprobarPagos.php enctype="multipart/form-data">
					<input type="hidden" name="submitted" value="true" /> 
					<?php
					//$controlDocuments=$controller->controlDocuments($databasecon,$DEBUG_STATUS);
					if(isset($controlDocuments) && count($controlDocuments)>0)
					{					
					?>
					<br>
					<br>
					<div class="row">
						<input type="hidden" name="docId" id="docId" value=<?php echo $controlDocuments[0][0];?>>
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">CODIGO PAGO</span>
										<input type="text" name="docId" class="form-control" value=<?php echo $controlDocuments[0][1];?> readonly="true">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">NOMBRE PASAJERO</span>
										<input type="text" class="form-control" value='<?php echo $controlDocuments[0][5];?>' readonly="true">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">FECHA PAGO</span>
										<input type="text" class="form-control" value='<?php echo $controlDocuments[0][2];?>' readonly="true">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">MODO DE PAGO</span>
										<input type="text" class="form-control" value='<?php echo $controlDocuments[0][3];?>' readonly="true">
									</div>
								</div>
							</div>							
						</div>
						<div class="col-sm-2"></div>
					</div>
					<br>
					<br>
					<br>
					<div class="row">
						<div class="col-sm-12">
							<center><img src=<?php echo $controlDocuments[0][4];?> id="uploadImg" class="verificarImage"/></center>
						</div>
					</div>
					<br>
					<br>
					<br>
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">OBSERVACIONES</span>
			                			<textarea class="form-control" name="obser" id="obser" rows="5" placeholder="Ingresar su comentarios-500 caracteres" maxlength=500 required><?php echo $controlDocuments[0][6];?></textarea> 
			                		</div>
			                	</div>
			                </div>
			                <div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">APROBAR/RECHAZAR</span>
			                			<select name="estado" class="form-control" id="estado">
					                        <!-- <option value="0">APROBADO</option>
					                        <option value="1">RECHAZADO</option> -->
					                        <?php
					                        if($controlDocuments[0][7]==1 || $controlDocuments[0][7]==99)
				                        	{
												echo "<option value='1' selected='selected' >APROBADO</option>";
												echo "<option value='0'>RECHAZADO</option>";
											}											
											else
											{
												echo "<option value='0' selected='selected' >RECHAZADO</option>";
												echo "<option value='1'>APROBADO</option>";
											}
											?>
					                    </select>
			                		</div>
			                	</div>
			                </div>
						</div>
						<div class="col-sm-2"></div>
					</div>					
					<div class="row">
						<div class="col-sm-12">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
									<br>
									<button type="submit"  class="btn btn-info btn_center">ACTUALIZAR <span class="glyphicon glyphicon-chevron-right"></span></button>
								</div>
								<div class="col-sm-4"></div>
						</div>
					</div>
					<?php
						}
					?>
				</form>
						



				    
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
