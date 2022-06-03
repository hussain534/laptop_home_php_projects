<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('util.php');
    include_once('config.php');
    $session_time=$session_expirry_time;
    $payment_wait_time = $payment_max_wait_time;
    $target_dir=$pics_location;
    
    require 'dbcontroller.php';

    $DEBUG_STATUS = $PRINT_LOG;
    if(isset($_SESSION['LAST_ACTIVITY']))
    {
        if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
        {
            $url="userlogin.php";
            header("Location:$url"); 
        }        
    }
    $_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }

    $controller = new controller();
    include_once('header.php');
    $detallesPago = $controller->getDetallesPago($databasecon,$_GET["tipo"],$_GET["codigo_pago"],$DEBUG_STATUS);
    $usrCelular=$controller->getUserMobileNumber($databasecon,$DEBUG_STATUS);
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
                    <input type="hidden" name="codigo_pago" id="codigo_pago" value=<?php echo $_GET["codigo_pago"];?>>
                    <div id="res"></div>
                    <?php
                    if(isset($_SESSION['payphone_status']) && $_SESSION['payphone_status']==3)
                    {
                        ?>
                            <div class='alert alert-success shopAlert'>  
                                <?php
                                    $messsage= 'EL PAGO SE HA REALIZADO CORRECTAMENTE. <br>GUARDE EL NÚMERO DE COMPROBANTE PARA FUTURAS REFERENCIAS. <br>MUCHAS GRACIAS POR ELEGIR VECTIOS.<br>';
                                    $messsage=$messsage.'Numero Comprobante::'.$_SESSION['payphone_txn_id'].'<br><br>';
                                    $messsage=$messsage."<a href='misreservas.php'><button type='button' class='btn btn-default btn_center'>MIS VIAJES <span class='glyphicon glyphicon-chevron-right'></span></button></a><br>";
                                    echo $messsage; 
                                ?>
                            </div>
                        <?php
                        unset($_SESSION['payphone_status']);
                        unset($_SESSION['payphone_txn_id']);
                        unset($_SESSION['DB_Payment_Upd_Status']);
                    }
                    else if(isset($_SESSION['payphone_status']) && $_SESSION['payphone_status']==2)
                    {
                        unset($_SESSION['payphone_status']);
                        unset($_SESSION['payphone_txn_id']);
                        unset($_SESSION['DB_Payment_Upd_Status']);
                        ?>
                            <center>
                            <div class='alert alert-danger shopAlert'>                               
                                ERROR EN REGISTRAR PAGO.<br><br>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <span class="input-group-addon" style="text-align: center;">NÚMERO MÓVIL UTILIZADO PARA EL PAGO EN PAYPHONE</span>
                                            <input type="text" class="form-control" name="usrCelular" id="usrCelular" value="<?php echo $usrCelular; ?>" readonly="true">
                                        </div>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                        <button type='button' class='btn btn-default btn_center' id='payphone'>INTENTAR NUEVAMENTE <span class='glyphicon glyphicon-chevron-right'></span></button><br><br><br>
                                    </div>
                                    <div class="col-sm-4"></div>
                                </div>
                            </div>
                        </center>
                        <?php
                    }
                    else
                    {
                        unset($_SESSION['payphone_status']);
                        unset($_SESSION['payphone_txn_id']);
                        unset($_SESSION['DB_Payment_Upd_Status']);
                        ?>
                        <div id="showPayValue">                          
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <!-- <iframe width="840px" height="315px" src="https://www.youtube.com/watch?v=zctb-CgyrrI"></iframe> -->
                                    <!-- <object width="420" height="315" data="https://www.youtube.com/watch?v=zctb-CgyrrI"></object> -->
                                    <!-- <iframe width="100%" height="315" src="https://www.youtube.com/embed/zctb-CgyrrI?autoplay=1" frameborder="0" allowfullscreen></iframe> -->
                                </div>
                                <div class="col-sm-3"></div>
                            </div>                             
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4" id="costoTotal">
                                    <br>
                                    <h1 style="background:#00b0f0;padding:10px;border:1px solid #00b0f0;color:#FFF">
                                       <i><span style="float:left">VALOR DE VIAJE : $</span> <span style="float:right"><?php echo round($detallesPago[0][0]*100/112,2);?></span></i>
                                       <br>
                                       <i><span style="float:left">IVA(12%) : $</span> <span style="float:right"><?php echo round($detallesPago[0][0]*12/112,2);?></span></i>
                                       <br>
                                       <span style="float:right">-------------------------------------</span>
                                       <br>
                                       <i><span style="float:left">VALOR TOTAL A PAGAR : $</span>  <span style="float:right"><?=$detallesPago[0][0].'.00';?></span></i>
                                       <br>
                                    </h1>                                 
                                </div>
                                <div class="col-sm-4"></div>
                            </div> 
                             <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8 text-center" id="costoTotal">
                                    <br>
                                   <h3 style="padding:10px;color:#222">POR FAVOR TENGA SU CELULAR EN MANO. PAYPHONE NECESITA SU CONFIRMACION DE PAGO</h3>                                 
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 planificarviaje">
                                </div>
                                <div class="col-sm-4 planificarviaje">
                                    <div class="form-group">
                                        <span class="input-group-addon" style="text-align: center;">POR FAVOR INTRODUCIR SU NÚMERO MÓVIL <br>SIN EL 0 Y 593 <br>PARA PROSEGUIR CON EL PAGO EN PAYPHONE</span>
                                        <input type="text" class="form-control" name="usrCelular" id="usrCelular" value="<?php echo $usrCelular; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4 planificarviaje">
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="button" id="payphone" class="btn btn-info btn_center">CONFIRMAR PAGO<span class="glyphicon glyphicon-chevron-right"></span></button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <br>
                            <br>
                            <div class="progress" id="progressbar">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%;line-height:60px">ESTAMOS PROCESANDO SU PAGO. POR FAVOR NO ACTUALIZAR O ABANDONAR LA PÁGINA.</div>                                
                            </div>
                            <br>
                            <div id="progressbarMsg" class="text-center">
                                <h4>Por favor revisar y aprobar la transacción en el teléfono móvil del número que indico para proseguir con el pago. Recuerde que ya debe tener la aplicación Payphone instalada y un método de pago establecido</h4>
                            </div>                               
                        </div>
                        <div class="col-sm-3"></div>
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
