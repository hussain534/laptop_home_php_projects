<?php
	//avoid direct access
	defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('util.php');
	include_once('config.php'); 
    //
	$session_time=$session_expirry_time;
	//session_start();
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
	if($DEBUG_STATUS)
	{
		//echo 'USERID::'.$_SESSION['userid'].'<br>';
		//echo 'EMAIL::'.$_SESSION['userEmail'].'<br>';
	}
	if(isset($_SESSION['LAST_ACTIVITY']))
    {
		if(($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
		{
			$url="index.php?view=shop&layout=userlogout&tipo=2";
			header("Location:$url"); 
		}
        else
              $_SESSION['LAST_ACTIVITY'] = time();
	}
	else
		$_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }
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

    include_once('header.php');
?>
<br>
<br>
<div class="container inner_body" id="estadoReservarViaje">
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
            <h3 style="text-align:center;color:#FFF;margin-top:1px">MI PERFIL</h3>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10 inner_body-block">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#perfil">INFORMACIÓN PERSONAL</a></li>
                <li><a data-toggle="tab" href="#automovil">INFORMACIÓN AUTOMÓVIL</a></li>
                <li><a data-toggle="tab" href="#identity">DOCUMENTOS IDENTIFICACION</a></li>
                <li><a data-toggle="tab" href="#intereses">INTERESES</a></li>
            </ul>
            <br>
            <div class="tab-content">
                <div id="perfil" class="tab-pane fade in active">
                    <?php
                    	
                    	$usrDtl = $controller->getPerfil($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
                    ?>
                    <?php  if(isset($message)) 
                        {
                    ?>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class='alert alert-success shopAlert'>
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php  echo $message; ?>
                             </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <fieldset class="servicepanel">
                                <legend><h3>Detalles Personales</h3></legend>
                                <a href="editDetallesPersonales.php"><span>EDIT</span></a>
                                <br>
                                <br>
                            	<div class="row">                            
                                    <div class="col-sm-1">
                                        &nbsp;
                                    </div>
                            		<div class="col-sm-4">
                            			<?php 
                                        if(isset($usrDtl[6]) && file_exists($usrDtl[6]))
                                        {
                                        ?>
                                            <center><img src=<?php echo $usrDtl[6].'?rand='.rand();?> id="uploadImg" class="profileImage" style="width:300px;height:300px;box-shadow: 6px 6px 6px grey;"/></center>
                                        <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <center><img src=images/imageNotAvailable3.png id="uploadImg" class="profileImage" style="width:300px;height:300px;box-shadow: 6px 6px 6px grey;"/></center>
                                            <?php
                                        }   
                                        ?>
                                        <center>
                                            <div class="pic_desc text-center">
                                                <?php echo strtoupper($usrDtl[1]); ?>
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <?php
                                                             $usrRating = $controller->getCoductorRating($databasecon,$_SESSION["userid"],$DEBUG_STATUS);
                                                            if(isset($usrRating) && count($usrRating)>0)
                                                            {
                                                        ?>      <!-- <b>Calificacion Conductor :(<?php echo $usrRating;?>)</b> -->
                                                                <div class="rating-01">
                                                                    <p class="container-item-rating">
                                                                        <?php 
                                                                        $rating_value =$usrRating;
                                                                        $rating_star_def=0.5;
                                                                        $rating_inicial = 0;                            
                                                                        while($rating_value > ($rating_star_def*$rating_inicial))
                                                                        {
                                                                            if($rating_inicial%2==0)
                                                                                echo "<img src='images/star_left_fill.png' />";
                                                                            else
                                                                                echo "<img src='images/star_right_fill.png' />";
                                                                            $rating_inicial = $rating_inicial+1;
                                                                        }
                                                                        while($rating_inicial<10)
                                                                        {
                                                                            if($rating_inicial%2==0)
                                                                                echo "<img src='images/star_left_empty.png' />";
                                                                            else
                                                                                echo "<img src='images/star_right_empty.png' />";
                                                                            $rating_inicial = $rating_inicial+1;  
                                                                        } 
                                                                        ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </center> 
                            		</div>
                            		<div class="col-sm-6">
                            			<div class="row">
                            				<div class="col-sm-12 planificarviaje">
                            					<div class="form-group">
                                                    <span class="input-group-addon">ID</span>
                                                    <input type="text" class="form-control" name="user_id" value="<?php echo $usrDtl[0]; ?>" readonly="true" >
                                                </div>
                            				</div>
                            				<div class="col-sm-12 planificarviaje">
                            					<div class="form-group">
                                                    <span class="input-group-addon">NOMBRE COMPLETO</span>
                                                    <input type="text" class="form-control" name="user_name" value="<?php echo $usrDtl[1]; ?>" readonly="true" >
                                                </div>
                            				</div>
                            				<div class="col-sm-12 planificarviaje">
                            					<div class="form-group">
                                                    <span class="input-group-addon">NRO. CELULAR</span>
                                                    <input type="text" class="form-control" name="user_celular" value="<?php echo $usrDtl[2]; ?>" readonly="true" >
                                                </div>
                            				</div>
                            				<div class="col-sm-12 planificarviaje">
                            					<div class="form-group">
                                                    <span class="input-group-addon">NRO.TELEFONO</span>
                                                    <input type="text" class="form-control" name="user_landline" value="<?php echo $usrDtl[3]; ?>" readonly="true" >
                                                </div>
                            				</div>
                            				<div class="col-sm-12 planificarviaje">
                            					<div class="form-group">
                                                    <span class="input-group-addon">CEDULA</span>
                                                    <input type="text" class="form-control" name="user_cedula" value="<?php echo $usrDtl[4]; ?>" readonly="true" >
                                                </div>
                            				</div>
                                            <div class="col-sm-12 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">NRO. LICENCIA</span>
                                                    <input type="text" class="form-control" name="user_licence" value="<?php echo $usrDtl[5]; ?>" readonly="true" >
                                                </div>
                                            </div>
                            			</div>
                            		</div>
                            		<div class="col-sm-1">
                    	        		&nbsp;
                            		</div>
                            	</div>
                            </fieldset>
                        </div>
                	</div>
                </div>
                <div id="automovil" class="tab-pane fade">

                	<?php
                        $vehDtl = $controller->getVehicleDetails($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
                        if($DEBUG_STATUS)
                        {
                            if(isset($vehDtl))
                                echo count($vehDtl);
                            else 0;
                        }
                	?>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <fieldset class="servicepanel" id="veh">
                                <legend><h3>Detalle automovil</h3></legend>
                                <?php
                                    if(isset($vehDtl) && count($vehDtl)==0)
                                    {
                                ?>
                                <a href=addDetallesAutomovil.php?aid=0><span>AGGREGAR</span></a>
                                <?php
                                    }
                                for($x=0;$x<count($vehDtl);$x++)
                                    {
                                ?>

                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?php 
                                        if(isset($vehDtl[$x][7]) && file_exists($vehDtl[$x][7]))
                                        {
                                        ?>
                                            <p style="text-align:center">
                                                CODIGO-<?php echo $vehDtl[$x][0];?><br>
                                                <?php 
                                                    if($vehDtl[$x][11]==0) 
                                                        echo 'APROBADO';
                                                    else if($vehDtl[$x][11]==1) 
                                                        echo 'RECHAZADO <a href="#" data-toggle="tooltip" title="'.$vehDtl[$x][12].'"><span class="glyphicon glyphicon-info-sign glyphicon-info-sign-docs"></span></a>';
                                                    else
                                                        echo 'VERIFICACION PENDIENTE';
                                                ?>
                                            </p>
                                            <center><img src=<?php echo $vehDtl[$x][7].'?rand='.rand();?> id="uploadImg" class="docImage" style="box-shadow: 6px 6px 6px grey;"/></center>
                                            <br>
                                            <p style="text-align:center"><?php echo $vehDtl[$x][1].' - '.$vehDtl[$x][2].' -ANO:'.$vehDtl[$x][3];?></p>
                                        <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <center><img src=images/imageNotAvailable.png id="uploadImg" class="docImage" style="width:300px;height:300px;box-shadow: 6px 6px 6px grey;"/></center>
                                            <br>
                                            <p style="text-align:center"><?php echo $vehDtl[$x][1];?></p>
                                            <?php
                                        }   
                                        ?> 
                                    </div>
                                    <div class="col-sm-6">
                                        <?php 
                                        if(isset($vehDtl[$x][8]) && file_exists($vehDtl[$x][8]))
                                        {
                                        ?>
                                            <p style="text-align:center">
                                                CODIGO-<?php echo $vehDtl[$x][9];?><br>
                                                <?php 
                                                    if($vehDtl[$x][10]==0) 
                                                        echo 'APROBADO';
                                                    else if($vehDtl[$x][10]==1) 
                                                        echo 'RECHAZADO <a href="#" data-toggle="tooltip" title="'.$vehDtl[$x][13].'"><span class="glyphicon glyphicon-info-sign glyphicon-info-sign-docs"></span></a>';
                                                    else
                                                        echo 'VERIFICACION PENDIENTE';
                                                ?>
                                            </p>
                                            <center><img src=<?php echo $vehDtl[$x][8].'?rand='.rand();?> id="uploadImg" class="docImage" style="box-shadow: 6px 6px 6px grey;"/></center>
                                            <br>
                                            <p style="text-align:center">MATRICULATION</p>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                            <center><img src=images/imageNotAvailable.png id="uploadImg" class="docImage" style="width:300px;height:300px;box-shadow: 6px 6px 6px grey;"/></center>
                                            <br>
                                            <p style="text-align:center">MATRICULATION</p>
                                            <?php
                                        }   
                                        ?> 
                                    </div>
                                    
                                </div>
                                <br>
                                <br>
                                <div class="row">                            
                                    <div class="col-sm-1">
                                        &nbsp;
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-6 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">MARCA</span>
                                                    <input type="text" class="form-control" name="marca" value="<?php echo $vehDtl[$x][1]; ?>" readonly="true">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">MODELO</span>
                                                    <input type="text" class="form-control" name="modelo" value="<?php echo $vehDtl[$x][2]; ?>" readonly="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">ANO</span>
                                                    <input type="text" class="form-control" name="ano" value="<?php echo $vehDtl[$x][3]; ?>" readonly="true">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">NRO ASIENTOS</span>
                                                    <input type="text" class="form-control" name="capacidad" value="<?php echo $vehDtl[$x][4]; ?>" readonly="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">NRO PLACA</span>
                                                    <input type="text" class="form-control" name="placa" value="<?php echo $vehDtl[$x][5]; ?>" readonly="true">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">NRO MATRICULA</span>
                                                    <input type="text" class="form-control" name="matriculation" value="<?php echo $vehDtl[$x][6]; ?>" readonly="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                    </div>
                                </div>
                                <a href=editDetallesAutomovil.php?aid=<?php echo $vehDtl[$x][0];?>><span>EDIT</span></a>
                                <br><br>
                                <?php

                                }
                                ?>
                            </fieldset>  
                        </div>
                    </div>
                </div>
                <div id="identity" class="tab-pane fade">





                	<?php
                	$docDtl = $controller->getDocuments($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
                    if($DEBUG_STATUS)
                    {
                	   echo $docDtl[0][2];
                    }
                    ?>
                	<div class="row">
                        <div class="col-sm-12">

                            <fieldset class="servicepanel">
                                <legend><h3>Documentos del Usuario</h3></legend>
                                <a href="editDocumentosConductor.php"><span>EDIT</span></a>
                                <br>
                                <br>		    
                            	<div class="row">
                            		<div class="col-sm-6">
                            			<?php 
                                        if(isset($docDtl[0][2]) && file_exists($docDtl[0][2]))
                                        {
                                        ?>
                                            <p style="text-align:center">
                                                CODIGO-<?php echo $docDtl[0][0];?><br>
                                                <?php 
                                                    if($docDtl[0][3]==0) 
                                                        echo 'APROBADO';
                                                    else if($docDtl[0][3]==1) 
                                                        echo 'RECHAZADO<a href="#" data-toggle="tooltip" title="'.$docDtl[0][4].'"><span class="glyphicon glyphicon-info-sign glyphicon-info-sign-docs"></span></a>';
                                                    else
                                                        echo 'VERIFICACION PENDIENTE';
                                                ?>
                                            </p>
                                            <center><img src=<?php echo $docDtl[0][2].'?rand='.rand();?> id="uploadImg" class="docImage" /></center>
                                            <p style="text-align:center"><?php echo $docDtl[0][1];?></p>
                                        <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <center><img src=images/imageNotAvailable.png id="uploadImg" class="docImage"/></center>
                                            <p style="text-align:center">CEDULA</p>
                                            <?php
                                        }   
                                        ?> 
                            		</div>
                            		<div class="col-sm-6">
                            			<?php 
                                        if(isset($docDtl[1][2]) && file_exists($docDtl[1][2]))
                                        {
                                        ?>
                                            <p style="text-align:center">
                                                CODIGO-<?php echo $docDtl[1][0];?><br>
                                                <?php 
                                                    if($docDtl[1][3]==0) 
                                                        echo 'APROBADO';
                                                    else if($docDtl[1][3]==1) 
                                                        echo 'RECHAZADO <a href="#" data-toggle="tooltip" title="'.$docDtl[1][4].'"><span class="glyphicon glyphicon-info-sign glyphicon-info-sign-docs"></span></a>';
                                                    else
                                                        echo 'VERIFICACION PENDIENTE';
                                                ?>
                                            </p>
                                            <center><img src=<?php echo $docDtl[1][2].'?rand='.rand();?> id="uploadImg" class="docImage" /></center>
                                            <p style="text-align:center"><?php echo $docDtl[1][1];?></p>
                                        <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <center><img src=images/imageNotAvailable.png id="uploadImg" class="docImage"/></center>
                                            <p style="text-align:center">LICENCIA</p>
                                            <?php
                                        }   
                                        ?> 
                            		</div>
                            	</div>	
                            </fieldset>
                        </div>
                	</div>  
                </div>
                <div id="intereses" class="tab-pane fade">
                    <?php
                        
                        $usrDtl = $controller->getPerfil($databasecon,$_SESSION['userid'],$DEBUG_STATUS);
                    ?>
                    <?php  if(isset($message)) 
                        {
                    ?>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class='alert alert-success shopAlert'>
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php  echo $message; ?>
                             </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <fieldset class="servicepanel">
                                <legend><h3>MI INTERESES</h3></legend>
                                <a href="editDetallesIntereses.php"><span>EDIT</span></a>
                                <br>
                                <br>
                                <div class="row">                            
                                    <div class="col-sm-1">
                                        &nbsp;
                                    </div>                                    
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-6 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">INTERESES PERSONAL</span>
                                                    <textarea class="form-control" name="intereses_p" id="intereses_p" rows="15" readonly="true"><?php echo $usrDtl[8];?></textarea> 
                                                </div>
                                            </div>
                                            <div class="col-sm-6 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">INTERESES DE NEGOCIOS</span>
                                                    <textarea class="form-control" name="intereses_n" id="intereses_n" rows="15" readonly="true"><?php echo $usrDtl[9];?></textarea> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        &nbsp;
                                    </div>
                                </div>
                            </fieldset>
                        </div>
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