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
	if($_SESSION['userid']==1)
    {
        $controlDocuments=$controller->controlDocuments($databasecon,$DEBUG_STATUS);
        $controlPagos=$controller->controlPagos($databasecon,$DEBUG_STATUS);
        $viajePendienteSummary=$controller->viajesPendientesAsignarList($databasecon,$DEBUG_STATUS);

        $_SESSION['DOCS_PEND'] = count($controlDocuments);
        $_SESSION['PAGOS_PEND'] = count($controlPagos);
        $ctrs=0;
        for($i=0;$i<count($viajePendienteSummary);$i++)
        {
            $ctrs=$ctrs+$viajePendienteSummary[$i][2];
        }
        //$_SESSION['ASIG_PEND'] = count($viajePendienteSummary);
        $_SESSION['ASIG_PEND'] = $ctrs;
    }
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
            <h3 style="text-align:center;color:#FFF;margin-top:1px">PAGOS VERIFICACION</h3>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <br>
	<div class="row">
		<div class="col-sm-1">
		</div>
		<div class="col-sm-10 inner_body-block">
			
			<br>
			<br>
			<?php 
				
		        if(isset($message)) 
		        {
		    ?>
		    <div class="row">
		        <div class="col-sm-2">
		        </div>
		        <div class="col-sm-8">
		            <div class='alert alert-success shopAlert text-center'>
		                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                <?php  
		                    echo $message; 
		                ?>
		             </div>
		        </div>
		        <div class="col-sm-2">
		        </div>
		    </div>
		    <?php
		        }
		    ?>

		    	<form method="post" action=adminPagos.php enctype="multipart/form-data">
					<input type="hidden" name="submittedSearch" value="true" />
					<div class="row">
						<div class="col-sm-5"></div>
				        <div class="col-sm-4">
							<input type="text" class="form-control" name="searchDocId" value="" placeholder="INGRESAR DOCUMENTO DE PAGO">
						</div>
						<div class="col-sm-1">
							<button type="submit" class="btn btn-primary" style="margin-right:-20px;padding:0;min-width:50px !important"><img src="images/search.png" style="width:62%"></button>
				        </div>
				        <div class="col-sm-2"></div>
				    </div>
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
						<input type="hidden" name="docId" id="docId" value=<?php echo $controlDocuments[0][1];?>>
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">CODIGO PAGO</span>
										<input type="text" name="docIdText" class="form-control" value="<?php echo $controlDocuments[0][10];?>" readonly="true">
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
										<span class="input-group-addon">FECHA PAGO EN BANCO</span>
										<input type="text" class="form-control" value='<?php echo $controlDocuments[0][9];?>' readonly="true">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">FECHA PAGO EN SISTEMA</span>
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
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">VALOR DE PAGO</span>
										<input type="text" class="form-control" value='<?php echo $controlDocuments[0][8];?>' readonly="true">
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
						
					
					<?php 
                        if(isset($controlDocuments[0][4]) && file_exists($controlDocuments[0][4]))
                        {
                        ?>
                            <center><img src="<?php echo $controlDocuments[0][4];?>" id="uploadImg" class="verificarImage"/></center>
                        <?php
                        }
                        else
                        {
                            ?>
                            <!-- <center><img src=images/unknown_user.png id="uploadImg" class="verificarImage" style="width:300px;height:300px;box-shadow: 6px 6px 6px grey;"/></center> -->
                            <center><span class="glyphicon glyphicon-picture"></span>
                            <h5>IMAGEN NO DISPONIBLE</h5></center>
                            <?php
                        }   
                    ?>
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
										<span class="input-group-addon" style="background:darkgrey">OBSERVACION ANTERIOR</span>
			                			<textarea class="form-control" name="obser_ant" id="obser_ant" rows="5" placeholder="Ingresar su comentarios-500 caracteres" maxlength=1500 readonly="true"><?php if($controlDocuments[0][7]==1 || $controlDocuments[0][7]==99) echo $controlDocuments[0][6]; else if($controlDocuments[0][7]==0) echo $controlDocuments[0][6];?></textarea> 
			                		</div>
			                	</div>
			                </div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">OBSERVACIONES</span>
			                			<textarea class="form-control" name="obser" id="obser" rows="5" placeholder="Ingresar su comentarios-500 caracteres" maxlength=500 required></textarea> 
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
