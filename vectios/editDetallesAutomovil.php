<?php
	//avoid direct access
	defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
	if($DEBUG_STATUS)
	{
		echo 'USERID::'.$_SESSION['userid'].'<br>';
		echo 'EMAIL::'.$_SESSION['userEmail'].'<br>';
		echo 'ROLE::'.$_SESSION['userRole'].'<br>';
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

    include_once('header.php');
?>
<br>
<br>

<form method="post" action=updateDetallesAutomovil.php enctype="multipart/form-data">
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
            <div class="col-sm-10 bg-crimson">
                <br>
                <h3 style="text-align:center;color:#FFF;margin-top:1px">EDITAR DETALLES AUTOMOVIl</h3>
            </div>
            <div class="col-sm-1">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-10 inner_body-block">
                
            	<?php
            		if(isset($_GET['aid']))
                            $aid=$_GET['aid'];
                    $controller = new controller();
        			$vehDtl = $controller->getVehicleDetailsById($databasecon,$_SESSION['userid'],$aid,$DEBUG_STATUS);
                    if($DEBUG_STATUS)
                    {
                        echo $vehDtl[0][7].'<br>';		
                        echo $vehDtl[0][8];
                    }

            	?>
                
                <div class="row">
                    <div class="col-sm-12">
                            <!-- <div class="row">
                                <div class="col-sm-12" style="text-align:center">
                                    <H3>LISTA DE AUTOMOVILES</H3>
                                </div>
                            </div> -->

                        <fieldset class="servicepanel">
                            <legend><h3>Detalle automovil</h3></legend>
                            <?php
                            if(count($vehDtl)==0)
                            {
                            ?>
                                


                                <div class="row">
                                    <div class="col-sm-6">                                
                                        <center><img src=images/imageNotAvailable.png id="uploadImg" class="docImage"/></center>
                                        <p style="text-align:center">AUTOMOVIL</p>
                                        <center><input type="file" name="fileToUpload" id="fileToUpload" required>   
                                        <!-- <label for="imgId">Upload </label> -->
                                        <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p></center>
                                        <input type="hidden" name="docId" value="0" />                                       
                                    </div>
                                    <div class="col-sm-6">                                
                                        <center><img src=images/imageNotAvailable.png id="uploadImg2" class="docImage"/></center>
                                        <p style="text-align:center">MATRICULATION</p>
                                        <center><input type="file" name="fileToUpload2" id="fileToUpload2" required>   
                                        <!-- <label for="imgId">Upload </label> -->
                                        <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p></center>
                                        <input type="hidden" name="docId2" value="0" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-12 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">ID</span>
                                                    <input type="text" class="form-control" name="aid" value="0" readonly="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">MARCA</span>
                                                    <input type="text" maxlength="100" class="form-control" name="marca" id="marca" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">MODELO</span>
                                                    <input type="text" maxlength="100" class="form-control" name="modelo" id="modelo"  required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">ANO</span>
                                                    <input type="number" min="1900" max="2050" class="form-control" name="ano" id="ano" required>
                                                    <span id="ano_errmsg"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">NRO ASIENTOS</span>
                                                    <input type="text" maxlength="1" class="form-control" name="capacidad" id="capacidad" required>
                                                    <span id="capacidad_errmsg"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">NRO PLACA</span>
                                                    <input type="text" maxlength="15" class="form-control" name="placa" id="placa" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 planificarviaje">
                                                <div class="form-group">
                                                    <span class="input-group-addon">NRO MATRICULA</span>
                                                    <input type="text" maxlength="50" class="form-control" name="matriculation" id="matriculation" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                    </div>
                               </div>
                                <div class="row">
                                    <div class="col-sm-12 itemDtl">
                                        <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">SUBMIT<span class="glyphicon glyphicon-chevron-right"></span></button>
                                    </div>
                                </div>
                                <br><br>





                            <?php
                            }
                            ?>
                            <?php
                            for($x=0;$x<count($vehDtl);$x++)
                                {
                            ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?php 
                                    if(isset($vehDtl[$x][7]) && file_exists($vehDtl[$x][7]))
                                    {
                                    ?>
                                        <center><img src=<?php echo $vehDtl[$x][7].'?rand='.rand();?> id="uploadImg" class="docImage" /></center>
                                        <p style="text-align:center"><?php echo $vehDtl[$x][1].' - '.$vehDtl[$x][2].' -ANO:'.$vehDtl[$x][3];?></p>
                                        <center><input type="file" name="fileToUpload" id="fileToUpload">   
                                        <!-- <label for="imgId">Upload </label> -->
                                        <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p></center>
                                        <input type="hidden" name="docId" value=<?php echo $vehDtl[0][0];?> />
                                    <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <center><img src=images/imageNotAvailable.png id="uploadImg" class="profileImage"/></center>
                                        <p style="text-align:center"><?php echo $vehDtl[$x][1];?></p>
                                        <center><input type="file" name="fileToUpload" id="fileToUpload" required>   
                                        <!-- <label for="imgId">Upload </label> -->
                                        <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p></center>
                                        <input type="hidden" name="docId" value="0" />   
                                        <?php
                                    }   
                                    ?>
                                       
                                </div>
                                <div class="col-sm-6">
                                    <?php 
                                    if(isset($vehDtl[$x][8]) && file_exists($vehDtl[$x][8]))
                                    {
                                    ?>
                                        <center><img src=<?php echo $vehDtl[$x][8].'?rand='.rand();?> id="uploadImg2" class="docImage" /></center>
                                        <p style="text-align:center">MATRICULATION</p>
                                        <center><input type="file" name="fileToUpload2" id="fileToUpload2">   
                                        <!-- <label for="imgId">Upload </label> -->
                                        <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p></center>
                                        <input type="hidden" name="docId2" value=<?php echo $vehDtl[$x][9];?> />
                                    <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <center><img src=images/imageNotAvailable.png id="uploadImg2" class="docImage"/></center>
                                        <p style="text-align:center">MATRICULATION</p>
                                        <center><input type="file" name="fileToUpload2" id="fileToUpload2" required>   
                                        <!-- <label for="imgId">Upload </label> -->
                                        <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p></center>
                                        <input type="hidden" name="docId2" value="0" />
                                        <?php
                                    }   
                                    ?> 
                                    
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6 planificarviaje">
                                            <div class="form-group">
                                                <span class="input-group-addon">ID</span>
                                                <input type="text" class="form-control" name="aid" value="<?php echo $vehDtl[$x][0]; ?>" readonly="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 planificarviaje">
                                            <div class="form-group">
                                                <span class="input-group-addon">MARCA</span>
                                                <input type="text" maxlength="100" class="form-control" name="marca" id="marca" value="<?php echo $vehDtl[$x][1]; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 planificarviaje">
                                            <div class="form-group">
                                                <span class="input-group-addon">MODELO</span>
                                                <input type="text" maxlength="100" class="form-control" name="modelo" id="modelo" value="<?php echo $vehDtl[$x][2]; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 planificarviaje">
                                            <div class="form-group">
                                                <span class="input-group-addon">ANO</span>
                                                <input type="number" min="1900" max="2050" class="form-control" name="ano" id="ano"  value="<?php echo $vehDtl[$x][3]; ?>" required>
                                                <span id="ano_errmsg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 planificarviaje">
                                            <div class="form-group">
                                                <span class="input-group-addon">NRO ASIENTOS</span>
                                                <input type="text" maxlength="1" class="form-control" name="capacidad" value="<?php echo $vehDtl[$x][4]; ?>" required>
                                                <span id="capacidad_errmsg"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 planificarviaje">
                                            <div class="form-group">
                                                <span class="input-group-addon">NRO PLACA</span>
                                                <input type="text" maxlength="15" class="form-control" name="placa" id="placa" value="<?php echo $vehDtl[$x][5]; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 planificarviaje">
                                            <div class="form-group">
                                                <span class="input-group-addon">NRO MARTICULA</span>
                                                <input type="text" maxlength="50" class="form-control" name="matriculation" id="matriculation" value="<?php echo $vehDtl[$x][6]; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 itemDtl">
                                    <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">SUBMIT<span class="glyphicon glyphicon-chevron-right"></span></button>
                                </div>
                            <br><br>
                            <?php

                            }
                            ?>
                        </fieldset>  
                    </div>
                </div>
            </div>
        </div>
        <br>
    	<br>   
    </div>
</form>











<?php
	include_once('container_footer.php');
?>