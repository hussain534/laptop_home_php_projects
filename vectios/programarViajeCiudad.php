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
            $_SESSION["nroasientessearch"]=$_POST["nroasientessearch"];
            $_SESSION["fechaviajesearch"]=$_POST["fechaviajesearch"]." ".$_POST["horavuelosearch"].":00";
            $_SESSION["calle_principal"]=$_POST["calle_principal"];
            $_SESSION["numeracion"]=$_POST["numeracion"];
            $_SESSION["calle_secundario"]=$_POST["calle_secundario"];
            $_SESSION["referencia"]=$_POST["referencia"];
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
        $nroasientessearch=$_SESSION["nroasientessearch"];
        $fechaviajesearch=$_SESSION["fechaviajesearch"];
        $calle_principal=$_SESSION["calle_principal"];
        $numeracion=$_SESSION["numeracion"];
        $calle_secundario=$_SESSION["calle_secundario"];
        $referencia=$_SESSION["referencia"];
    }
    else
    {
        $sector=$_POST["sector"];
        $terminal=$_POST["terminal"];
        $nroasientessearch=$_POST["nroasientessearch"];
        $fechaviajesearch=$_POST["fechaviajesearch"]." ".$_POST["horavuelosearch"].":00";
        $calle_principal=$_POST["calle_principal"];
        $numeracion=$_POST["numeracion"];
        $calle_secundario=$_POST["calle_secundario"];
        $referencia=$_POST["referencia"];
    }
    //echo $nroasientessearch;

    $controller = new controller();
    $micuenta=$controller->micuentaDtl($databasecon,1,$DEBUG_STATUS);
    $sectorSalida = $controller->getSectorDesc($databasecon,$sector,$DEBUG_STATUS);
    $terminalSalida = $controller->getTerminalDesc($databasecon,$terminal,$DEBUG_STATUS);
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
            <div class="col-sm-10 bg-green">
                <br>
                <h3 style="text-align:center;color:#FFF;margin-top:1px">PLANIFICAR VIAJE A QUITO</h3>
            </div>
            <div class="col-sm-1">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-10 inner_body-block">
                <form method="post" action="programarViajeCiudadConfirm.php">
                    <br>                    
                    <input type="hidden" name="submitted" value="true">
                    <input type="hidden" name="sector" value="<?=$sector;?>">
                    <input type="hidden" name="terminal" value="<?=$terminal;?>">
                    <input type="hidden" name="nroasientessearch" id="nroasientessearch" value="<?=$nroasientessearch;?>">
                    <input type="hidden" name="cantidadRetorno" value="0">
                    <br>
                    <div class="row">
                        <div class="col-sm-4 planificarviaje">
                        <h4>DETALLES DE VIAJES</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 planificarviaje">                        
                            <div class="form-group">
                                <span class="input-group-addon">LUGAR A LLEGAR</span>
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
                                <input type="text" class="form-control" name="nroasientes" id="nroasientes" value="UN ASIENTO : $12.00" readonly="true">
                                <?php
                                    }
                                    else if($nroasientessearch==2)
                                    {
                                ?>
                                <input type="text" class="form-control" name="nroasientes" id="nroasientes" value="DOS ASIENTOS : $20.00" readonly="true">
                                <?php
                                    }
                                    else if($nroasientessearch==5)
                                    {
                                ?>
                                <input type="text" class="form-control" name="nroasientes" id="nroasientes" value="PLAN FAMILIAR (3 o 4 PERSONAS) : $25.00" readonly="true">
                                <?php
                                    }
                                    else if($nroasientessearch==6)
                                    {
                                ?>
                                <input type="text" class="form-control" name="nroasientes" id="nroasientes" value="PLAN EJECUTIVO : $25.00" readonly="true">
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
                                <input type="text" class="form-control" name="calle_principal" id="calle_principal" value="<?=strtoupper($calle_principal);?>" readonly="true">
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
                                <input type="text" class="form-control" name="calle_secundario" id="calle_secundario" value="<?=strtoupper($calle_secundario);?>" readonly="true">
                                <div id="errorCalleSecundario" class="errorMsg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 planificarviaje">
                            <div class="form-group">
                                <span class="input-group-addon">REFERENCIA</span>
                                <input type="text" class="form-control" name="referencia" id="referencia" value="<?=strtoupper($referencia);?>" readonly="true">
                                <div id="errorReferencia" class="errorMsg"></div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- <div class="row">
                        <div class="col-sm-4 planificarviaje">
                        <h4>DETALLES PARA RETORNO(Si quieres?)</h4>
                        </div>
                    </div>
                    <div class="information">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="row">
                                    <div class="col-sm-12 tituloInfo">
                                        <span class="glyphicon glyphicon-info-sign"></span>
                                        <h4>¿NECESITAS TRANSPORTE PARA RETORNAR? RESÉRVALO AHORA Y PAGA SOLO $6.00.  
                                        LOS DETALLES DE TU RECOGIDA PODRÁS INDICARLOS UNA VEZ DECIDAS A VOLVER</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 planificarviaje">
                                        <div class="form-group">
                                            <span class="input-group-addon">NRO DE PASAJEROS PARA RETORNO</span>
                                            <?php
                                                if($nroasientessearch==1)
                                                {
                                            ?>
                                            <select name="cantidadRetorno" onchange="calcularCosto();" class="form-control" id="cantidadRetorno">
                                                <option value="0">SIN RETORNO</option>
                                                <option value="1">RETORNO PARA UN PASAJERO</option>
                                            </select>
                                            <?php
                                                }
                                                else if($nroasientessearch==2)
                                                {
                                            ?>
                                            <select name="cantidadRetorno" onchange="calcularCosto();" class="form-control" id="cantidadRetorno">
                                                <option value="0">SIN RETORNO</option>
                                                <option value="1">RETORNO PARA UN PASAJERO</option>
                                                <option value="2">RETORNO PARA DOS PASAJEROS</option>
                                            </select>
                                            <?php
                                                }
                                                else if($nroasientessearch==5)
                                                {
                                            ?>
                                            <select name="cantidadRetorno" onchange="calcularCosto();" class="form-control" id="cantidadRetorno">
                                                <option value="0">SIN RETORNO</option>
                                                <option value="1">RETORNO PARA UN PASAJERO</option>
                                                <option value="2">RETORNO PARA DOS PASAJERO<S/option>
                                                <option value="3">RETORNO PARA TRES PASAJEROS</option>
                                                <option value="4">RETORNO PARA CUATRO PASAJEROS</option>
                                            </select>
                                            <?php
                                                }  
                                            ?>
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
                    </div> -->
                    <div class="row">
                        <div class="col-sm-12 text-center" id="costoTotal">
                            <br>
                            <?php
                                if($nroasientessearch==1)
                                {
                            ?>
                            <h1 style="background:#00b0f0;padding:10px;border:1px solid #00b0f0;color:#FFF"><b>VALOR TOTAL A PAGAR : </b>$ 12.00</h1>    
                            <?php
                                }
                                else if($nroasientessearch==2)
                                {
                            ?>
                            <h1 style="background:#00b0f0;padding:10px;border:1px solid #00b0f0;color:#FFF"><b>VALOR TOTAL A PAGAR : </b>$ 20.00</h1>    
                            <?php
                                }
                                else if($nroasientessearch==5)
                                {
                            ?>
                            <h1 style="background:#00b0f0;padding:10px;border:1px solid #00b0f0;color:#FFF"><b>VALOR TOTAL A PAGAR : </b>$ 25.00</h1>    
                            <?php
                                }  
                            ?>                 
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
                                           <br>
                                           <br>
                                           <div class="row">
                                                <div class="col-sm-12 text-center">
                                                    <div class='alert alert-success shopAlert'>
                                                        <?php  echo 'Para confirmar su viaje, por favor realiza pago de su viaje en CUENTA: '.$micuenta[0][0],', del BANCO:'.$micuenta[0][1].' (TIPO CUENTA:'.$micuenta[0][2].') y carga su documento de pago aqui.' ?>
                                                     </div>
                                                </div>
                                            </div> 
                                           <!-- <button type="submit" onclick="return validatePlanificarViajeDataBeforeConfirmation();" class="btn btn-info btn_center">PLANIFICAR VIAJE<span class="glyphicon glyphicon-chevron-right"></span></button> -->
                                           <button type="submit" class="btn btn-info btn_center">PLANIFICAR VIAJE<span class="glyphicon glyphicon-chevron-right"></span></button>
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
