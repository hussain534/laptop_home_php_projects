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
        $_SESSION['ASIG_PEND'] = count($viajePendienteSummary);
    }
	if(isset($_POST['submittedSearch']))
	{
		$searchDocId= $_POST["searchDocId"];
		$controlDocuments=$controller->controlDocumentsByUserId($databasecon,$_POST["searchDocId"],$_POST["estado"],$DEBUG_STATUS);
	}
	else
		$controlDocuments=$controller->controlDocuments($databasecon,$DEBUG_STATUS);
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
            <h3 style="text-align:center;color:#FFF;margin-top:1px">DOCUMENTOS VERIFICACION</h3>
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

		    	<form method="post" action=admincontrol.php enctype="multipart/form-data">
					<input type="hidden" name="submittedSearch" value="true" />
					<div class="row">
				        <div class="col-sm-3">
							<?php	
							
							if(isset($controlDocuments))
							{
								echo '<button type="button" class="btn btn-primary" style="padding:5px 25px;">DOCUMENTOS PENDIENTES <span class="badge">'.count($controlDocuments).'</span></button>';					
							?>					
				        </div>				    
				        <div class="col-sm-4">
                            <select name="estado" class="form-control" id="estado">
                                <option value="0">APROBADO</option>
                                <option value="1">RECHAZADO</option>
                            </select>
				        </div>
				        <div class="col-sm-4 text-right">
							<input type="text" class="form-control" name="searchDocId" value="" placeholder="Ingresar codigo conductor" required>
						</div>
						<div class="col-sm-1">
							<button type="submit" class="btn btn-primary" style="margin:0;padding:0;min-width:50px !important"><img src="images/search.png" style="width:62%"></button>
				        </div>
				        <?php
							}
							?>
				    </div>							
				</form>
				<br>
				<div class="row">					
					<div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="success_row">
                                    <th>CODIGO DOCUMENTO</th>
                                    <th>CODIGO USUARIO</th>
                                    <th>EMAIL USUARIO</th>
                                    <th>TIPO DOCUMENTO</th>                                    
                                    <th>APROBAR/RECHAZAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for($x=0;$x<count($controlDocuments);$x++) 
                                    {
                                        if($controlDocuments[$x][5]==0)
                                        	$str='APROBADO';
                                        else if($controlDocuments[$x][5]==1)
                                        	$str='RECHAZADO';
                                       	else
                                        	$str='PENDIENTE VERIFICACION';
                                        echo '    <tr class="warning myrow">
                                                        <td><a href=doccontrol.php?codigo_doc='.$controlDocuments[$x][2].'&tipo=1>'.$controlDocuments[$x][2].'</a></td>
                                                        <td>'.$controlDocuments[$x][0].'</td>
                                                        <td>'.$controlDocuments[$x][1].'</td>
                                                        <td>'.$controlDocuments[$x][3].'</td>
                                                        <td>'.$str.'</td>
                                                    </tr>';    
                                    }
                                ?>
                            </tbody>
                        </table>
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
