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
    $userId=0;
    $vehId= 0;
    $viajeId= 0;
    $estadoViaje=0;
    /*if(isset($_GET['searchCodigoViaje']))
    {
        $searchCodigoViaje=$_GET["searchCodigoViaje"];
        $conductorDtl = $controller->getConductorIdFromCodigoViaje($databasecon,$searchCodigoViaje,$DEBUG_STATUS);
        if(isset($conductorDtl) && $conductorDtl>0)
        {
            $userId=$conductorDtl[0][0];
            $vehId =$conductorDtl[0][1];

        }
    }*/
    if(isset($_GET['searchIdViaje']))
    {
        $searchCodigoViaje=$_GET["searchIdViaje"];
        $conductorDtl = $controller->getConductorIdFromCodigoViaje($databasecon,$searchCodigoViaje,$DEBUG_STATUS);
        if(isset($conductorDtl) && $conductorDtl>0)
        {
            $userId=$conductorDtl[0][0];
            $vehId =$conductorDtl[0][1];
        }
    }
    if(isset($_GET['searchIdViaje']))
    {
        $viajeId=$_GET["searchIdViaje"];
    }
    if(isset($_GET['estadoViaje']) && strcmp($_GET['estadoViaje'], 'SOLICITADO')==0)
        $estadoViaje=1;
    else if(isset($_GET['estadoViaje']) && strcmp($_GET['estadoViaje'], 'PROGRAMADO')==0)
        $estadoViaje=2;
    else if(isset($_GET['estadoViaje']) && strcmp($_GET['estadoViaje'], 'EN EJECUCION')==0)
        $estadoViaje=3;
    else if(isset($_GET['estadoViaje']) && strcmp($_GET['estadoViaje'], 'TERMINADO')==0)
        $estadoViaje=4;
    else if(isset($_GET['estadoViaje']) && strcmp($_GET['estadoViaje'], 'CANCELADO')==0)
        $estadoViaje=5;
    else if(isset($_GET['estadoViaje']) && strcmp($_GET['estadoViaje'], 'PAGO PENDIENTE')==0)
        $estadoViaje=6;
    else if(isset($_GET['estadoViaje']) && strcmp($_GET['estadoViaje'], 'PAGADO')==0)
        $estadoViaje=7;













    if($DEBUG_STATUS)
    {
        echo 'ID CONDUCTOR:'.$userId.'<br>';;
        echo 'ID AUTOMOVIL:'.$vehId.'<br>'; 
    }
    

    include_once('header.php');
?>
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
        <div class="col-sm-10 inner_body-block">
            <div class="row">
                <div class="col-sm-12" style="text-align:center">
                    <center><img src="images/icon_user.png"></center>
                	<h3 style="text-align:center;color:#222;margin-top:1px">PERFIL CONDUCTOR</h3>
                </div>
            </div>
            
        


            <?php
                
                $usrDtl = $controller->getPerfil($databasecon,$userId,$DEBUG_STATUS);
                if(isset($usrDtl) && count($usrDtl)>0)
                {
                    //$_SESSION["session_msg"]="Se muestra detalles de usuario con codigo ".$userId;
            ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class='alert alert-success shopAlert text-center'>
                        <div id="message"><?php  echo "SE MUESTRA DETALLES DE CONDUCTOR CON ID:  ".$userId; ?></div>
                     </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <fieldset class="servicepanel">
                        <legend><h3>Detalles Personales</h3></legend>
                    	<div class="row">
                    		<div class="col-sm-5">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php 
                                        if(isset($usrDtl[6]) && file_exists($usrDtl[6]))
                                        {
                                        ?>
                                            <center><img src=<?php echo $usrDtl[6].'?rand='.rand();?> id="uploadImg" class="profileImage" style="width:300px;height:300px;box-shadow: 6px 6px 6px grey;" /></center>
                                        <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <center><img src=images/unknown_user.png id="uploadImg" class="profileImage" style="width:300px;height:300px;box-shadow: 6px 6px 6px grey;"/></center>
                                            <?php
                                        }   
                                        ?> 
                                    </div>
                                </div>
                                <center><div class="pic_desc text-center">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                    <?php
                                        echo $usrDtl[1].'<br>';
                                         $usrRating = $controller->getCoductorRating($databasecon,$userId,$DEBUG_STATUS);
                                        if(isset($usrRating) && count($usrRating)>0)
                                        {
                                    ?>      
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
                    		</div>
                    		<div class="col-sm-7">
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
                    	</div>
                    </fieldset>
                </div>
        	</div>


        	<?php
                $vehDtl = $controller->getVehicleDetailsById($databasecon,$userId,$vehId,$DEBUG_STATUS);
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
                            <div class="col-sm-6">
                                <?php 
                                if(isset($vehDtl[$x][7]) && file_exists($vehDtl[$x][7]))
                                {
                                ?>
                                    <center><img src=<?php echo $vehDtl[$x][7];?> id="uploadImg" class="docImage" /></center>
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
                            <div class="col-sm-6">
                                <?php 
                                if(isset($vehDtl[$x][8]) && file_exists($vehDtl[$x][8]))
                                {
                                ?>
                                    <center><img src=<?php echo $vehDtl[$x][8];?> id="uploadImg" class="docImage" /></center>
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
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-12 planificarviaje">     
                                        <div class="form-group">
                                            <span class="input-group-addon">MARCA</span>
                                            <input type="text" class="form-control" name="marca" value="<?php echo $vehDtl[$x][1]; ?>" readonly="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 planificarviaje">     
                                        <div class="form-group">
                                            <span class="input-group-addon">MODELO</span>
                                            <input type="text" class="form-control" name="modelo" value="<?php echo $vehDtl[$x][2]; ?>" readonly="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 planificarviaje">     
                                        <div class="form-group">
                                            <span class="input-group-addon">ANO</span>
                                            <input type="text" class="form-control" name="ano" value="<?php echo $vehDtl[$x][3]; ?>" readonly="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 planificarviaje">     
                                        <div class="form-group">
                                            <span class="input-group-addon">CAPACIDAD</span>
                                            <input type="text" class="form-control" name="capacidad" value="<?php echo $vehDtl[$x][4]; ?>" readonly="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 planificarviaje">     
                                        <div class="form-group">
                                            <span class="input-group-addon">NRO. PLACA</span>
                                            <input type="text" class="form-control" name="placa" value="<?php echo $vehDtl[$x][5]; ?>" readonly="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 planificarviaje">     
                                        <div class="form-group">
                                            <span class="input-group-addon">NRO.MATRICULA</span>
                                            <input type="text" class="form-control" name="matriculation" value="<?php echo $vehDtl[$x][6]; ?>" readonly="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
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
                                    <center><img src=<?php echo $docDtl[0][2];?> id="uploadImg" class="docImage" /></center>
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
                                    <center><img src=<?php echo $docDtl[1][2];?> id="uploadImg" class="docImage" /></center>
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
                        <div id="message"><?php  echo "No existe detalles de usuario con codigo ".$userId; ?></div>
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