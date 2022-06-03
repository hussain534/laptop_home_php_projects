<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    $target_dir=$pics_location;
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
  	if(isset($_SESSION['LAST_ACTIVITY']))
    {
    	/*if(isset($_SESSION['userid']))
    		echo 'TRUE<br>';
    	else
    		echo 'FALSE<br>';
    	echo $_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'].'<br>';*/
		if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
		{
			//echo 'inside<br>';
			$url="userlogin.php";
			/*if(isset($_GET["idviaje"]))
				$_SESSION["last_url"]=$_SERVER['REQUEST_URI'];*/
			//echo $_SESSION["last_url"];
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
    
    include_once('header.php');
    
        $controller = new controller();

        $id = $controller->reservarViajeDesdeAeropuerto($databasecon,$_GET["idviaje"],$_GET["cantpass"],$_GET["c_viaje"],$_SESSION["userid"],$DEBUG_STATUS);
        echo $id;

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
            <?php 
                if($id>0)
                {
            ?>
        	<div class="row">
                <div class="col-sm-12">
                    <center><img src="images/icon_success.png"></center>
                	<div class='alert alert-info shopAlert'>
                    	<?php  echo 'Gracias por reservar viaje con ZIELUS. Numero de boleto de su viaje es '.$id.'.<br>Ahora recibirás 
                        los datos de tu conductor y el los tuyos a tu correo electrónico. Deben comunicarse para confirmar la hora de viaje 
                        según sea vuestra propia preferencia. <br>Te damos las siguientes recomendaciones para que el viaje sea lo más placentero y provechoso para todos'; ?>
                		<ul>
                			<li><span class="doBold">Puntualidad:</span> Si pasados 10 minutos no has salido al encuentro de tu conductor según fue acordado, el conductor podrá irse y no se te hará devolución de tu dinero. Si se te presenta algún imprevisto, debes notificar con un día de anterioridad para notificar al conductor. Solo en este caso se te devolverá tu dinero o si lo prefieres lo podrás usar para otro viaje a futuro</li>
                			<li>Comparte tus intereses y profesión con el fin de generar contactos según tus intereses en tiempo real. Sácale el mayor provecho a tu viaje, generando contactos de gran valor</li>
                		</ul>    	
        	         </div>
                </div>
            </div>
            <div class="row">
        	 	<div class="col-sm-12">
        	       	<a href="misreservas.php"><button type="button" class="btn btn-success btn_center">MIS RESERVAS <span class="glyphicon glyphicon-chevron-right"></span></button></a>
        	    </div>
        	</div>
        	<?php
        		}
        		else
        		{
        	?>
        	<div class="row">
                <div class="col-sm-12">
                    <center><img src="images/icon_error.png"></center>
                	<div class='alert alert-danger shopAlert'>
                        El sistema presenta error en este momento. Por favor intenta nuevamente.    	
        	         </div>
                </div>
            </div>
            <div class="row">
        	 	<div class="col-sm-12">
        	       	<a href="iniciarviaje.php"><button type="button" class="btn btn-success btn_center">BUSCAR VIAJE <span class="glyphicon glyphicon-chevron-right"></span></button></a>
        	    </div>
        	</div>
            
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