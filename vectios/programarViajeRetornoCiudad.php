<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    //include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    
    require 'dbcontroller.php';

    $DEBUG_STATUS = $PRINT_LOG;
    $costo_uio_aero=$costo_quito_aeropuerto;
    $costo_aero_uio=$costo_aeropuerto_quito;
    if(isset($_POST["submitted"]))
        {
            $_SESSION["last_url"]=$_SERVER['REQUEST_URI'];
            $_SESSION["isViajePlanAavailable"]=1;
            $_SESSION["sector"]=$_POST["sector"];
            $_SESSION["terminal"]=$_POST["terminal"];
            $_SESSION["nroasientesid"]=$_POST["nroasientesid"];
            $_SESSION["fechaviajesearch"]=$_POST["fechaviajesearch"]." ".$_POST["horavuelosearch"].":00";
            $_SESSION["calle_principal"]=$_POST["calle_principal"];
            $_SESSION["numeracion"]=$_POST["numeracion"];
            $_SESSION["calle_secundario"]=$_POST["calle_secundario"];
            $_SESSION["referencia"]=$_POST["referencia"];
            $_SESSION["c_viaje"]=$_POST["c_viaje"];
        }
    if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
    {
        //echo 'inside<br>';
        $url="userlogin.php";
        
        //echo $_SERVER['REQUEST_URI'];
        header("Location:$url"); 
    }
    else
    {
        include_once('util.php');
    }

    if(isset($_SESSION["isViajePlanAavailable"]) && $_SESSION["isViajePlanAavailable"]==1)
    {
        $sector=$_SESSION["sector"];
        $terminal=$_SESSION["terminal"];
        $nroasientesid=$_SESSION["nroasientesid"];
        $fechaviajesearch=$_SESSION["fechaviajesearch"];
        $calle_principal=$_SESSION["calle_principal"];
        $numeracion=$_SESSION["numeracion"];
        $calle_secundario=$_SESSION["calle_secundario"];
        $referencia=$_SESSION["referencia"];
        $c_viaje=$_SESSION["c_viaje"];
    }
    else
    {
        $sector=$_POST["sector"];
        $terminal=$_POST["terminal"];
        $nroasientesid=$_POST["nroasientesid"];
        $fechaviajesearch=$_POST["fechaviajesearch"]." ".$_POST["horavuelosearch"].":00";
        $calle_principal=$_POST["calle_principal"];
        $numeracion=$_POST["numeracion"];
        $calle_secundario=$_POST["calle_secundario"];
        $referencia=$_POST["referencia"];
        $c_viaje=$_POST["c_viaje"];
    }
    //echo $nroasientesid;

    $controller = new controller();
    //$micuenta=$controller->micuentaDtl($databasecon,1,$DEBUG_STATUS);
    $sectorSalida = $controller->getSectorDesc($databasecon,$sector,$DEBUG_STATUS);
    $terminalSalida = $controller->getTerminalDesc($databasecon,$terminal,$DEBUG_STATUS);
    $nroasientessearch = $controller->getNroAsientosSearch($databasecon,$nroasientesid,$DEBUG_STATUS);
    $isVerified=$controller->isUserPerfilCompleted($databasecon,0,(isset($_SESSION['userEmail'])?$_SESSION['userEmail']:null),(isset($_SESSION['userRole'])?$_SESSION['userRole']:null),$DEBUG_STATUS);
    //echo   $isVerified; 
    
    $_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
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
            <div class="col-sm-10 bg-verde">
                <br>
                <h3 style="text-align:center;color:#FFF;margin-top:1px">PLANIFICAR VIAJE RETORNO A QUITO</h3>
            </div>
            <div class="col-sm-1">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-10 inner_body-block">
                <form method="post" action="programarViajeCiudadRetornoConfirm.php">
                    <br>                    
                    <input type="hidden" name="submitted" value="true">
                    <input type="hidden" name="sector" value="<?=$sector;?>">
                    <input type="hidden" name="terminal" value="<?=$terminal;?>">
                    <input type="hidden" name="c_viaje" value="<?=$c_viaje;?>">
                    <input type="hidden" name="nroasientessearch" id="nroasientessearch" value="<?=$nroasientessearch;?>">
                    <input type="hidden" name="nroasientesid" id="nroasientesid" value="<?=$nroasientesid;?>">
                    <br>
                    <div class="row">
                        <div class="col-sm-4 planificarviaje">
                        <h4>DETALLES DE VIAJES</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 planificarviaje">                        
                            <div class="form-group">
                                <span class="input-group-addon">SECTOR A LLEGAR</span>
                                <input type="text" class="form-control" name="sectorSalida" id="sectorSalida" value="<?=$sectorSalida.' - '.$terminalSalida;?>" readonly="true">
                            </div>
                        </div>
                        <div class="col-sm-4 planificarviaje">
                            <div class="form-group">
                                <span class="input-group-addon">NRO DE PASAJEROS</span>
                                <?php
                                    if($nroasientessearch==1)
                                    {
                                ?>
                                <input type="text" class="form-control" name="nroasientes" id="nroasientes" value="UN ASIENTO" readonly="true">
                                <?php
                                    }
                                    else if($nroasientessearch==2)
                                    {
                                ?>
                                <input type="text" class="form-control" name="nroasientes" id="nroasientes" value="DOS ASIENTOS" readonly="true">
                                <?php
                                    }
                                    else if($nroasientessearch==3)
                                    {
                                ?>
                                <input type="text" class="form-control" name="nroasientes" id="nroasientes" value="3 ASIENTOS" readonly="true">
                                <?php
                                    }
                                    else if($nroasientessearch==4)
                                    {
                                ?>
                                <input type="text" class="form-control" name="nroasientes" id="nroasientes" value="4 ASIENTOS" readonly="true">
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-4 planificarviaje">
                            <div class="form-group test">
                                <span class="input-group-addon">HORA-FECHA DE VIAJE</span>
                                <input type="text" class="form-control" name="fechaviajesearch" id="fechaviajesearch" value="<?=$fechaviajesearch;?>" readonly="true">
                             </div>
                        </div>     
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4 planificarviaje">
                        <h4>DIRECCION PARA RECOGER PASAJEROS</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 planificarviaje">
                            <div class="form-group">
                                <span class="input-group-addon">CALLE PRINCIPAL</span>
                                <input type="text" class="form-control" name="calle_principal" id="calle_principal" value="<?=$calle_principal;?>" readonly="true">
                                <div id="errorCallePrincipal" class="errorMsg"></div>
                            </div>
                        </div>
                        <div class="col-sm-4 planificarviaje">
                            <div class="form-group">
                                <span class="input-group-addon">NUMERACION</span>
                                <input type="text" class="form-control" name="numeracion" id="numeracion" value="<?=$numeracion;?>" readonly="true">
                                <div id="errorNumeracion" class="errorMsg"></div>
                            </div>
                        </div>
                        <div class="col-sm-4 planificarviaje">
                            <div class="form-group">
                                <span class="input-group-addon">CALLE SECUNDARIO</span>
                                <input type="text" class="form-control" name="calle_secundario" id="calle_secundario" value="<?=$calle_secundario;?>" readonly="true">
                                <div id="errorCalleSecundario" class="errorMsg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje">
                            <div class="form-group">
                                <span class="input-group-addon">REFERENCIA</span>
                                <input type="text" class="form-control" name="referencia" id="referencia" value="<?=$referencia;?>" readonly="true">
                                <div id="errorReferencia" class="errorMsg"></div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4 planificarviaje">
                        <h4>DETALLES DE PASAJEROS</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="row">
                                <div class="col-sm-3" id="cedula1">
                                    <div class="form-group">
                                        <span class="input-group-addon">IDENTIFICACION DEL PASAJERO 1</span>
                                        <input type="text" class="form-control" name="cedula1" maxlength="10" placeholder="INGRESAR NRO CEDULA O PASAPORTE" id="ced1">
                                        <div class="errorMsg" id="error_cedula1"></div>
                                    </div>
                                </div>
                                <div class="col-sm-3 planificarviaje" id="cedula2">
                                    <div class="form-group">
                                        <span class="input-group-addon">IDENTIFICACION DEL PASAJERO 2</span>
                                        <input type="text" class="form-control" name="cedula2" maxlength="10" placeholder="INGRESAR NRO CEDULA O PASAPORTE" id="ced2">
                                        <div class="errorMsg" id="error_cedula2"></div>
                                    </div>
                                </div>
                                <div class="col-sm-3 planificarviaje" id="cedula3">
                                    <div class="form-group">
                                        <span class="input-group-addon">IDENTIFICACION DEL PASAJERO 3</span>
                                        <input type="text" class="form-control" name="cedula3" maxlength="10" placeholder="INGRESAR NRO CEDULA O PASAPORTE" id="ced3">
                                        <div class="errorMsg" id="error_cedula3"></div>
                                    </div>
                                </div>
                                <div class="col-sm-3 planificarviaje" id="cedula4">
                                    <div class="form-group">
                                        <span class="input-group-addon">IDENTIFICACION DEL PASAJERO 4</span>
                                        <input type="text" class="form-control" name="cedula4" maxlength="10" placeholder="INGRESAR NRO CEDULA O PASAPORTE" id="ced4">
                                        <div class="errorMsg" id="error_cedula4"></div>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-12 planificarviaje">
                                    <div class="form-group">                                
                                        <div id="errorMsgCedulas" class="errorMsg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div id="panelPago">
                        <div class="row">
                             <div class="col-sm-12 text-center">
                                 <?php
                                     if($isVerified==1)
                                    {
                                        echo "<div class='alert alert-danger'><center>NO SE ENCUENTRO DETALLES CONTACTO. POR FAVOR <a href='editDetallesPersonales.php'>ACTUALIZAR</a> AHORA</center></div>";
                                    }
                                    elseif($isVerified==2)
                                    {
                                        echo "<div class='alert alert-danger'><center>NO SE HA VERIFICADO SU CORREO ELECTRONICO. <br>PARA ACTIVACION, POR FAVOR UTILIZAR LA LINK ENVIADO A SU CORREO EN MOMENTO DE REGISTRACION DE SU CUENTA</center></div>";
                                    }
                                    elseif($isVerified==3)
                                    {
                                        echo "<div class='alert alert-danger'><center>NO SE ENCUENTRO SU CEDULA O AUN NO ESTA ABROBADO. POR FAVOR <a href='editDocumentosConductor.php'>ACTUALIZAR</a> AHORA.</center></div>";                                            
                                    }
                                    else
                                    {
                                 ?>
                                           <!-- <button type="button" id="btnAcceptarViaje" class="btn btn-success btn_center">ACCEPTAR VIAJE <span class="glyphicon glyphicon-chevron-right"></span></button> -->
                                           <br>
                                           <h3>NOTA IMPORTANTE:</h3><b>DEBES TENER UNA DISPONIBILIDAD DE 30 MINUTOS ANTES DE LA HORA DE TU RESERVA PARA QUE PUEDAS SER RECOGIDO JUNTO CON LOS DEMÁS PASAJEROS.</b>
                                           
                                           <button type="submit" onclick="return validatePlanificarViajeDataBeforeConfirmation2();" class="btn btn-info btn_center">PLANIFICAR VIAJE<span class="glyphicon glyphicon-chevron-right"></span></button>
                                   <?php
                                       }
                                   ?>
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
            <div class="col-sm-1">
            </div>
        </div>
        <br>
        <br>
<!-- </form> -->
    </div>
<?php
include_once('container_footer.php');
?>
