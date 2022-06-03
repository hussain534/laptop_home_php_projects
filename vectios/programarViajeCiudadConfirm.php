<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    //include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    
    require 'dbcontroller.php';

    $DEBUG_STATUS = $PRINT_LOG;
    if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
    {
        //echo 'inside<br>';
        $url="userlogin.php";
        header("Location:$url"); 
    }
    else
    {
        include_once('util.php');
    }
    $_SESSION['LAST_ACTIVITY'] = time();

    $cantidadRetorno = $_POST["cantidadRetorno"];
    $sector=$_POST["sector"];
    $terminal=$_POST["terminal"];
    $nroasientessearch=$_POST["nroasientessearch"];
    $fechaviajesearch=$_POST["fechaviajesearch"];
    $calle_principal=$_POST["calle_principal"];
    $numeracion=$_POST["numeracion"];
    $calle_secundario=$_POST["calle_secundario"];
    $referencia=$_POST["referencia"];
    $cedulas=array();
    /*$ctr=0;
    while($ctr<$cantidadRetorno) 
    {
        $cedulas[$ctr] = $_POST["cedula".($ctr+1)];
        //echo '['.$ctr.'] : '.$_POST["cedula".($ctr+1)].'<br>';
        $ctr++;
    }*/

    $controller = new controller();
    $micuenta=$controller->micuentaDtl($databasecon,1,$DEBUG_STATUS);
    $estado = $controller->regsiterViajePlanificadoCiudad($databasecon,$sector,$terminal,$nroasientessearch,$fechaviajesearch,$calle_principal,$numeracion,$calle_secundario,$referencia,$cantidadRetorno,$cedulas,$DEBUG_STATUS);
    
    //print_r($_POST);
    

    if(strcmp($estado, '0')!=0)
    {
        $message="<br><div class='row'><div class='col-sm-12'>CODIGO VIAJE: <b>".$estado."</b> REGISTRADO EXITOSAMENTE. </div></div><br><br>";
        $message=$message."<div class='row'><div class='col-sm-6'><a href=pagar.php?codigo_pago=".$estado."&tipo=1><button type='button' class='btn btn-default btn_center'>CONTINUAR A PAGAR <span class='glyphicon glyphicon-chevron-right'></span></button></a></div>";
        $message=$message."<div class='col-sm-6'><a href='misreservas.php'><button type='button' class='btn btn-default btn_center'>MIS VIAJES <span class='glyphicon glyphicon-chevron-right'></span></button></a></div></div><br>";
    }
    else
    {
        $message="<br><div class='row'><div class='col-sm-12'>ERROR EN REGISTRAR VIAJE. POR FAVOR INTENTA NUEVAMENTE</div></div><br><br>";
        $message=$message."<div class='row'><div class='col-sm-12'><a href='#'><button type='button' class='btn btn-default btn_center'>BUSCAR VIAJES <span class='glyphicon glyphicon-chevron-right'></span></button></a></div></div><br>";
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
            <div class="col-sm-10 bg-green">
                <br>
                <h3 style="text-align:center;color:#FFF;margin-top:1px">ESTADO VIAJE PLANIFICADO</h3>
            </div>
            <div class="col-sm-1">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-10 inner_body-block">
                <!-- <div class="row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-8 text-center">
                        <div class='alert alert-success shopAlert'>
                            <?php  echo 'Para confirmar su viaje, por favor realiza pago de su viaje en CUENTA: '.$micuenta[0][0],', del BANCO:'.$micuenta[0][1].' (TIPO CUENTA:'.$micuenta[0][2].') y carga su documento de pago aqui.' ?>
                         </div>
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-8 text-center">
                        <div class='alert alert-success shopAlert'>
                            <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> -->
                            <?php  
                                echo $message; 
                            ?>
                         </div>
                    </div>
                    <div class="col-sm-2">
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
