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
    if(isset($_POST['submittedSearch']))
        $userId=$_POST["searchUserId"];
    else
        $userId=0;
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
            <h3 style="text-align:center;color:#FFF;margin-top:1px">PERFIL USUARIO</h3>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10 inner_body-block">
            
            
            <form method="post" action=getConductorPerfil.php enctype="multipart/form-data">
                <input type="hidden" name="submittedSearch" value="true" />
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-3 text-right">
                        <input type="text" class="form-control" name="searchUserId" value="" placeholder="Ingresar codigo usuario" required>
                    </div>
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-primary"  style="margin:0;padding:0;min-width:50px !important"><img src="images/search.png" style="width:62%"></button>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </form>
            <br>
            <br>
            <?php
                
                $usrDtl = $controller->getPerfil($databasecon,$userId,$DEBUG_STATUS);
                if(isset($usrDtl) && count($usrDtl)>0)
                {
                    //$_SESSION["session_msg"]="Se muestra detalles de usuario con codigo ".$userId;
            ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class='alert alert-success shopAlert text-center'>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php  echo "Se muestra detalles de usuario con codigo ".$userId; ?>
                     </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <fieldset class="servicepanel">
                        <legend><h3>Detalles Personales</h3></legend>
                    	<div class="row">
                    		<div class="col-sm-1">
            	        		&nbsp;
                    		</div>
                    		<div class="col-sm-2">
                    			<?php 
                                if(isset($usrDtl[6]) && file_exists($usrDtl[6]))
                                {
                                ?>
                                    <center><img src=<?php echo $usrDtl[6].'?rand='.rand();?> id="uploadImg" class="profileImage" /></center>
                                <?php
                                }
                                else
                                {
                                    ?>
                                    <center><img src=images/unknown_user.png id="uploadImg" class="profileImage"/></center>
                                    <?php
                                }   
                                ?> 
                    		</div>
                    		<div class="col-sm-1">
            	        		&nbsp;
                    		</div>
                    		<div class="col-sm-7">
                    			<div class="row">
                    				<div class="col-sm-12 itemDtl">
                    					<label for="user_id">ID</label>
                                        <input type="text" class="form-control" name="user_id" value="<?php echo $usrDtl[0]; ?>" readonly="true" >
                    				</div>
                    				<div class="col-sm-12 itemDtl">
                    					<label for="user_name">NAME</label>
                                        <input type="text" class="form-control" name="user_name" value="<?php echo $usrDtl[1]; ?>" readonly="true" >
                    				</div>
                                    <div class="col-sm-12 itemDtl">
                                        <label for="user_name">EMAIL</label>
                                        <input type="text" class="form-control" name="user_mail" value="<?php echo $usrDtl[7]; ?>" readonly="true" >
                                    </div>
                    				<div class="col-sm-12 itemDtl">
                    					<label for="user_celular">CELULAR</label>
                                        <input type="text" class="form-control" name="user_celular" value="<?php echo $usrDtl[2]; ?>" readonly="true" >
                    				</div>
                    				<div class="col-sm-12 itemDtl">
                    					<label for="user_landline">CONVENTIONAL</label>
                                        <input type="text" class="form-control" name="user_landline" value="<?php echo $usrDtl[3]; ?>" readonly="true" >
                    				</div>
                    				<div class="col-sm-12 itemDtl">
                    					<label for="user_cedula">CEDULA</label>
                                        <input type="text" class="form-control" name="user_cedula" value="<?php echo $usrDtl[4]; ?>" readonly="true" >
                    				</div>
                                    <div class="col-sm-12 itemDtl">
                                        <label for="user_cedula">NRO.LICENCIA</label>
                                        <input type="text" class="form-control" name="user_licence" value="<?php echo $usrDtl[5]; ?>" readonly="true" >
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


        	<?php
                $vehDtl = $controller->getVehicleDetails($databasecon,$userId,$DEBUG_STATUS);
                if($DEBUG_STATUS)
                {
                    if(isset($vehDtl))
                        echo count($vehDtl);
                    else 0;
                }
        	?>
            
            <div class="row">
                <div class="col-sm-12">
                    <fieldset class="servicepanel">
                        <legend><h3>Detalle automovil</h3></legend>
                        <?php
                        for($x=0;$x<count($vehDtl);$x++)
                            {
                        ?>

                        <br>
                        <br>
                        <div class="row">
                            <div class="col-sm-4">
                                <?php 
                                if(isset($vehDtl[$x][7]) && file_exists($vehDtl[$x][7]))
                                {
                                ?>
                                    <center><img src=<?php echo $vehDtl[$x][7].'?rand='.rand();?> id="uploadImg" class="docImage" /></center>
                                    <p style="text-align:center"><?php echo $vehDtl[$x][1].' - '.$vehDtl[$x][2].' -ANO:'.$vehDtl[$x][3];?></p>
                                <?php
                                }
                                else
                                {
                                    ?>
                                    <center><img src=images/imageNotAvailable.png id="uploadImg" class="docImage"/></center>
                                    <p style="text-align:center"><?php echo $vehDtl[$x][1];?></p>
                                    <?php
                                }   
                                ?> 
                            </div>
                            <div class="col-sm-4">
                                <?php 
                                if(isset($vehDtl[$x][8]) && file_exists($vehDtl[$x][8]))
                                {
                                ?>
                                    <center><img src=<?php echo $vehDtl[$x][8].'?rand='.rand();?> id="uploadImg" class="docImage" /></center>
                                    <p style="text-align:center">MATRICULATION</p>
                                <?php
                                }
                                else
                                {
                                ?>
                                    <center><img src=images/imageNotAvailable.png id="uploadImg" class="docImage"/></center>
                                    <p style="text-align:center">MATRICULATION</p>
                                    <?php
                                }   
                                ?> 
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-12 itemDtl">
                                        <label for="marca">MARCA</label>
                                        <input type="text" class="form-control" name="marca" value="<?php echo $vehDtl[$x][1]; ?>" readonly="true">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 itemDtl">
                                        <label for="modelo">MODELO</label>
                                        <input type="text" class="form-control" name="modelo" value="<?php echo $vehDtl[$x][2]; ?>" readonly="true">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 itemDtl">
                                        <label for="ano">ANO</label>
                                        <input type="text" class="form-control" name="ano" value="<?php echo $vehDtl[$x][3]; ?>" readonly="true">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 itemDtl">
                                        <label for="capacidad">CAPACIDAD</label>
                                        <input type="text" class="form-control" name="capacidad" value="<?php echo $vehDtl[$x][4]; ?>" readonly="true">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 itemDtl">
                                        <label for="placa">NRO. PLACA</label>
                                        <input type="text" class="form-control" name="placa" value="<?php echo $vehDtl[$x][5]; ?>" readonly="true">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 itemDtl">
                                        <label for="matriculation">NRO.MATRICULA</label>
                                        <input type="text" class="form-control" name="matriculation" value="<?php echo $vehDtl[$x][6]; ?>" readonly="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php

                        }
                        ?>
                    </fieldset>  
                </div>
            </div>
            





        	<?php
        	$docDtl = $controller->getDocuments($databasecon,$userId,$DEBUG_STATUS);
            if($DEBUG_STATUS)
            {
        	   echo $docDtl[0][2];
            }
            ?>
        	<div class="row">
                <div class="col-sm-12">

                    <fieldset class="servicepanel">
                        <legend><h3>Documentos del Usuario</h3></legend>
                    	<div class="row">
                    		<div class="col-sm-6">
                    			<?php 
                                if(isset($docDtl[0][2]) && file_exists($docDtl[0][2]))
                                {
                                ?>
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
            <?php
        }
        else if($userId==0)
            "";
        else
        {
        ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class='alert alert-success shopAlert text-center'>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php  echo "No existe detalles de usuario con codigo ".$userId; ?>
                     </div>
                </div>
            </div>
            <br>
        <?php
        }
        ?> 
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