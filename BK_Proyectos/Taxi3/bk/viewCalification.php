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

    $_SESSION["last_url"]=$_SERVER['REQUEST_URI'];
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
                <div class="col-sm-12" id="grad_title">
                    <!-- <center><img src="images/icon_publicaciones.png"><img src="images/icon_calificar.png" class="sub-img"></center> -->
                	<h3 style="color:antiquewhite;margin:5px"><img src="images/icon_calificar.png" style="width:50px;">MI CALIFICACION</h3>

                </div>
            </div>
            <br>
            <br>


            <?php
                
                $usrDtl = $controller->getPerfil($databasecon,$userId,$DEBUG_STATUS);
                if(isset($usrDtl) && count($usrDtl)>0)
                {
                    //$_SESSION["session_msg"]="Se muestra detalles de usuario con codigo ".$userId;
            ?>
           <?php  if(isset($message)) 
                {
            ?>
            <div class="row">
                <div class="col-sm-12">
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
                    <div class="row">
                		<div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php 
                                    if(isset($usrDtl[6]) && file_exists($usrDtl[6]))
                                    {
                                    ?>
                                        <center><img src=<?php echo $usrDtl[6];?> class="profileImage" style="width:300px;height:300px;box-shadow: 6px 6px 6px grey;"/></center>
                                        <center>
                                            <div class="pic_desc text-center">
                                                <?php echo $usrDtl[1]; ?>
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <?php
                                                         $usrRating = $controller->getCoductorRating($databasecon,$userId,$DEBUG_STATUS);
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
                                    <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <center><img src=images/unknown_user.png class="profileImage"/></center>
                                        <?php
                                    }   
                                    ?> 
                                </div>
                            </div>                            
                		</div>
                		<div class="col-sm-6">
                			<?php
                                $vehDtl = $controller->getVehicleDetailsById($databasecon,$userId,$vehId,$DEBUG_STATUS);
                                for($x=0;$x<count($vehDtl);$x++)
                                {
                                    if(isset($vehDtl[$x][7]) && file_exists($vehDtl[$x][7]))
                                    {
                                    ?>
                                        <center><img src=<?php echo $vehDtl[$x][7];?> class="docImage" style="width:300px;height:300px;box-shadow: 6px 6px 6px grey;" /></center>
                                        <center>
                                            <div class="pic_veh_desc text-center">
                                                <?php echo strtoupper($vehDtl[$x][1]).' - '.strtoupper($vehDtl[$x][2]).'('.strtoupper($vehDtl[$x][3]).')'; ?>
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <?php
                                                         $vehRating = $controller->automovilRating($databasecon,$vehId,$DEBUG_STATUS);
                                                        if(isset($vehRating) && count($vehRating)>0)
                                                        {
                                                        ?>      <!-- <b>Calificacion Conductor :(<?php echo $vehRating;?>)</b> -->
                                                        <div class="rating-01">
                                                            <p class="container-item-rating">
                                                                <?php 
                                                                $rating_value =$vehRating;
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
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <center><img src=images/imageNotAvailable.png class="docImage"/></center>
                                        <p style="text-align:center"><?php echo $vehDtl[$x][1];?></p>
                                    <?php
                                    }
                                }
                            ?>                            
                        </div>
            		</div>
                </div>
        	</div>


            <!-- Gallery y Comentarios bloque -->            
            <div class="row">
                <div class="col-sm-12" id="grad_white">
                    <div class="row">
                        <div class="col-sm-6 text-center">
                            <?php 
                                $gallery = $controller->getGalleryByUserId($databasecon,$viajeId,$_SESSION["userid"],$DEBUG_STATUS);
                                include_once('gallery.php');
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <?php 
                                $comments = $controller->getCommentsByUserId($databasecon,$viajeId,$_SESSION["userid"],$DEBUG_STATUS);
                                include_once('comentarios.php');
                            ?>
                        </div>
                    </div>
                    <br>
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
                    <div class='alert alert-danger shopAlert text-center'>
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