<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    include_once('util.php');
	include_once('config.php'); 
	$session_time=$session_expirry_time;
    $target_dir=$pics_location;

	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
    $costo_uio_aero=$costo_quito_aeropuerto;
    $costo_aero_uio=$costo_aeropuerto_quito;
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
    if(isset($_POST['submitted']))
    {
    	$userId = $_SESSION['userid'];
        if($DEBUG_STATUS)
        {
            echo "Inside submitted check<br>";
        }

        if($DEBUG_STATUS)
        {
            /*echo 'ID:'.$_POST['rn_id'].'<br>';
            echo 'Client ID:'.$_POST['rn_client_id'].'<br>';
            echo 'Price:'.$_POST['rn_price'].'<br>';*/
        }
    }
    $destino =1;
    if(isset($_GET["destino"]))
    	$destino=$_GET["destino"];
  
?>
<div class="container">
	<?php
		$controller = new controller();
		if($destino ==1)
        {
			$id = $controller->publicarViaje($databasecon,$_SESSION["userid"],$_GET["duraciondisponible"],$_GET["sector"],$destino,$_GET["fechaviaje"],$_GET["nroequipaje"],$_GET["nroasientes"],$_GET["automovilID"],$DEBUG_STATUS);

            $solicitudDtl=$controller->misSolicitudesParaAsignar($databasecon,$_SESSION['userid'],$_GET["duraciondisponible"],$_GET["sector"],$destino,$_GET["fechaviaje"],$_GET["nroequipaje"],$_GET["nroasientes"],$DEBUG_STATUS);
            for($t=0;$t<count($solicitudDtl);$t++)
            {
                $getViajeDtl = $controller->getDetallesViajesAAeropuerto($databasecon,$solicitudDtl[$t][4],$solicitudDtl[$t][1],$solicitudDtl[$t][5],$DEBUG_STATUS);    
                if(isset($getViajeDtl) && count($getViajeDtl)>0)
                {
                    $codigoStr = $controller->reservarViaje($databasecon,$solicitudDtl[$t][8],$getViajeDtl[0][0],$target_dir,$solicitudDtl[$t][9],$solicitudDtl[$t][3],$solicitudDtl[$t][5],$solicitudDtl[$t][11],$solicitudDtl[$t][6],$costo_uio_aero,$costo_aero_uio,$DEBUG_STATUS);
                    $codigo=explode(':', $codigoStr);
                    $id_viaje=$codigo[0];
                    $pago=$codigo[1];
                    //echo '1:'.$solicitudDtl[$t][0].'<br>';
                    //echo '2:'.$id_viaje.'<br>';
                    if($id_viaje>0)
                    {
                        $resultado = $controller->actualizarEstadoSolicitud($databasecon,$solicitudDtl[$t][0],$id_viaje,$DEBUG_STATUS);
                        //echo '3:'.$resultado.'<br>';
                    }
                    else
                    {
                        //echo 'ERROR<br>';
                    }
                }
            }            
        }
		else
			$id = $controller->publicarViajeNacional($databasecon,$_SESSION["userid"],$_GET["sector"],$destino,$_GET["fechaviaje"],$_GET["nroequipaje"],$_GET["nroasientes"],$_GET["costo_viaje"],0,0,0,$_GET["automovilID"],0,0,0,$DEBUG_STATUS);	
		if($id==1)
		{
	?>
        	<div class="row">
                <div class="col-sm-12">
                	<div class='alert alert-success shopAlert'>
                    	<?php  echo 'Gracias por publicar viaje con ZIELUS. <br>Ahora recibirás confirmacion de este viaje a tu correo electrónico. 
                        <br>Te damos las siguientes recomendaciones para que el viaje sea lo más placentero y provechoso para todos:'; ?>
                		<ul>
                			<li>Recuerda que el propósito de esto no es hacer lucro, sino compartir tus gastos de viaje. Por eso, si tan solo una persona va a bajar contigo hacia el aeropuerto/otro ciudad, debes estar dispuesto a recogerla. Si cancelas tu viaje sin previo aviso moderado, tu cuenta será cancelada y tu perfil bloqueado.</li>
                			<li>Una vez los usuarios confirmen su reserva, se te enviará la información directamente al correo electrónico para que puedas confirmar directamente con ellos los detalles de viaje.</li>
                            <li>Para efectos de efectividad en las reservas de ida al aeropuerto/otro ciudad, las personas que reserven, irán a parar al servicio del conductor que esté “primero en la fila”. Solamente podrán escoger al conductor que esté con el siguiente turno respecto al servicio compartido hacia el aeropuerto.</li>
                		</ul>    	
        	         </div>
                </div>
            </div>
            <div class="row">
        	 	<div class="col-sm-12">
        	       	<a href="mispublicaciones.php"><button type="button" class="btn btn-info btn_center">MIS VIAJES PUBLICADAS <span class="glyphicon glyphicon-chevron-right"></span></button></a>
        	    </div>
        	</div>
	<?php
		}
		else
		{
            if($id==99)
                $strReturn='El sistema presenta error en este momento. Por favor intenta nuevamente.';
            else if($id==98)
                $strReturn='Viajes planificada para aeropuero en la nuevo disponibilidad solicitada. Por favor elegir otro periodo.';
            else
                $strReturn='Viajes planificada desde aeropuerto en la nuevo disponibilidad solicitada. Por favor elegir otro periodo.';
	?>
        	<div class="row">
                <div class="col-sm-12">
                	<div class='alert alert-danger shopAlert'>
                        <?php echo $strReturn;?>
        	         </div>
                </div>
            </div>
            <div class="row">
        	 	<div class="col-sm-12">
        	       	<a href="publicarviaje.php"><button type="button" class="btn btn-info btn_center">PUBLICAR VIAJE <span class="glyphicon glyphicon-chevron-right"></span></button></a>
        	    </div>
        	</div>
	<?php		
		}
	?>
</div>