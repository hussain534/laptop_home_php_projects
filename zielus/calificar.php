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
  /*  if(isset($_GET['estadoViaje']) && strcmp($_GET['estadoViaje'], 'SOLICITADO')==0)
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
        $estadoViaje=7;*/

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
                	<h3 style="color:antiquewhite;margin:5px"><img src="images/icon_calificar.png" style="width:50px;">CALIFICACION</h3>

                </div>
            </div>
            <br>
            <br>
            <?php                
                $usrDtl = $controller->getPerfil($databasecon,$userId,$DEBUG_STATUS);
                //print_r($usrDtl);
                if(isset($usrDtl) && count($usrDtl)>0)
                {
                    include_once('calificacionPanel.php');
                    include_once('galleryYcomentarioPanel.php');
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