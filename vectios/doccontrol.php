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

	if(isset($_GET['codigo_doc']))
	{
		$controlDocuments=$controller->controlDocumentsById($databasecon,$_GET["codigo_doc"],$DEBUG_STATUS);
		echo 'controlDocuments count::'.count($controlDocuments);
	}
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
					<h3 style="text-align:center;color:#222;margin-top:1px">ADMIN CONTROL</h3>
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

		    	
				<form method="post" action=aprobarDocs.php enctype="multipart/form-data">
					<input type="hidden" name="submitted" value="true" /> 
					<?php
					//$controlDocuments=$controller->controlDocuments($databasecon,$DEBUG_STATUS);
					if(isset($controlDocuments) && count($controlDocuments)>0)
					{					
					?>
					<br>
					<br>
					<div class="row">
						<input type="hidden" name="userId" id="userId" value=<?php echo $controlDocuments[0][0];?>>
						<input type="hidden" name="email" id="email" value=<?php echo $controlDocuments[0][1];?>>
						<input type="hidden" name="docId" id="docId" value=<?php echo $controlDocuments[0][2];?>>
						<input type="hidden" name="docType" id="docType" value=<?php echo $controlDocuments[0][7];?>>
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">CODIGO DOCUMENTO</span>
										<input type="text" class="form-control" value=<?php echo $controlDocuments[0][2];?> readonly="true">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">CODIGO USUARIO</span>
										<input type="text" class="form-control" value=<?php echo $controlDocuments[0][0];?> readonly="true">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">EMAIL USUARIO</span>
										<input type="text" class="form-control" value=<?php echo $controlDocuments[0][1];?> readonly="true">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">TIPO DOCUMENTO</span>
										<input type="text" class="form-control" value=<?php echo $controlDocuments[0][3];?> readonly="true">
									</div>
								</div>
							</div>

							<!--<div class="col-sm-2 text-center">
								<b>Codigo-usuario: </b><?php echo $controlDocuments[0][0];?>
							</div>
							<div class="col-sm-4 text-center">
								<b>Email-usuario: </b><?php echo $controlDocuments[0][1];?>
							</div>
							<div class="col-sm-4 text-center">
								<b>Documento-usuario: </b><?php echo $controlDocuments[0][3];?>		
							</div>-->
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
					<?php 
					if($controlDocuments[0][7]==4)
					{
						
						$controlVehicle=$controller->getVehicleDetailsByMatriculationDoc($databasecon,$controlDocuments[0][2],$DEBUG_STATUS);
					?>
						<br>
						<br>
						<br>
						<div class="row">
							<div class="col-sm-2"></div>
							<div class="col-sm-8">
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group">
											<span class="input-group-addon">MARCA-MODELO-ANO</span>
											<input type="text" class="form-control" value=<?php echo $controlVehicle[0][1].'-'.$controlVehicle[0][2].'-'.$controlVehicle[0][3];?> readonly="true">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group">
											<span class="input-group-addon">CAPACIDAD</span>
											<input type="text" class="form-control" value=<?php echo $controlVehicle[0][4];?> readonly="true">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group">
											<span class="input-group-addon">PLACA</span>
											<input type="text" class="form-control" value=<?php echo $controlVehicle[0][5];?> readonly="true">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group">
											<span class="input-group-addon">NRO.MATRICULA</span>
											<input type="text" class="form-control" value=<?php echo $controlVehicle[0][6];?> readonly="true">
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-2"></div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<center><img src=<?php echo $controlVehicle[0][7];?> id="uploadImg" class="verificarImage"/></center>
							</div>
						</div>
					<?php 
					}
					?>
					<br>
					<br>
					<br>
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon" style="background:darkgrey">OBSERVACION ANTERIOR</span>
			                			<textarea class="form-control" name="obser" id="obser" rows="5" placeholder="Ingresar su comentarios-500 caracteres" maxlength=1500 readonly="true"><?php if($controlDocuments[0][5]==1) echo '['.$controlDocuments[0][8].'] RECAHZADO : '.$controlDocuments[0][6]; else if($controlDocuments[0][5]==0) echo '['.$controlDocuments[0][8].'] APROBADO : '.$controlDocuments[0][6];?></textarea> 
			                		</div>
			                	</div>
			                </div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">OBSERVACIONES</span>
			                			<textarea class="form-control" name="obser" id="obser" rows="5" placeholder="Ingresar su comentarios-500 caracteres" maxlength=1500 required></textarea> 
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
					                        if($controlDocuments[0][5]==1)
					                        {
												echo "<option value='0'>APROBADO</option>";
												echo "<option value='1' selected='selected' >RECHAZADO</option>";
					                        }
											else
											{
												echo "<option value='0' selected='selected' >APROBADO</option>";
												echo "<option value='1'>RECHAZADO</option>";
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
