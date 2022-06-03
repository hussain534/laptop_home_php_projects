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

    //$cantidadRetorno = $_POST["cantidadRetorno"];
    $sector=$_POST["sector"];
    $nroasientessearch=$_POST["nroasientessearch"];
    $fechaviajesearch=$_POST["fechaviajesearch"];
    $calle_principal=$_POST["calle_principal"];
    $numeracion=$_POST["numeracion"];
    $calle_secundario=$_POST["calle_secundario"];
    $referencia=$_POST["referencia"];
    $c_viaje=$_POST["c_viaje"];
    $cedulas=array();
    $ctr=0;
    while($ctr<$nroasientessearch) 
    {
        $cedulas[$ctr] = $_POST["cedula".($ctr+1)];
        //echo '['.$ctr.'] : '.$_POST["cedula".($ctr+1)].'<br>';
        $ctr++;
    }

    $controller = new controller();
    //$micuenta=$controller->micuentaDtl($databasecon,1,$DEBUG_STATUS);
    $estado = $controller->regsiterViajePlanificadoRetornoAeropuerto($databasecon,$sector,$nroasientessearch,$fechaviajesearch,$calle_principal,$numeracion,$calle_secundario,$referencia,$cedulas,$c_viaje,$DEBUG_STATUS);
    
    //print_r($_POST);
    
    $message="";

    if($estado>0)
    {
        $message="<br><div class='row'><div class='col-sm-12'>VIAJE RETORNO REGISTRADO EXITOSAMENTE</div></div>";
        
    }
    else
    {
        $message="<br><div class='row'><div class='col-sm-12'>ERROR EN REGISTRAR VIAJE DE RETORNO. POR FAVOR INTENTA NUEVAMENTE</div></div><br><br>";
        //$message=$message."<div class='row'><div class='col-sm-12'><a href='#'><button type='button' class='btn btn-default btn_center'>BUSCAR VIAJES <span class='glyphicon glyphicon-chevron-right'></span></button></a></div></div><br>";
    }
    $message=$message."<div class='row'><div class='col-sm-4'></div><div class='col-sm-4'><a href='misreservas.php'><button type='button' class='btn btn-default btn_center'>MIS VIAJES <span class='glyphicon glyphicon-chevron-right'></span></button></a></div><div class='col-sm-4'></div></div><br>";

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
            <div class="col-sm-10 bg-crimson">
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
