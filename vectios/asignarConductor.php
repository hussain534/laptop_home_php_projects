<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    
    require 'dbcontroller.php';

    $DEBUG_STATUS = $PRINT_LOG;
    if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
    {
        //echo 'inside<br>';
        $url="userlogin.php";
        $_SESSION["last_url"]='misreservas.php';
        //echo $_SESSION["last_url"];
        header("Location:$url"); 
    }
    $controller = new controller();
    if($_SESSION['userid']==1)
    {
        $controlDocuments=$controller->controlDocuments($databasecon,$DEBUG_STATUS);
        $controlPagos=$controller->controlPagos($databasecon,$DEBUG_STATUS);
        $viajePendienteSummary=$controller->viajesPendientesAsignarList($databasecon,$DEBUG_STATUS);

        $_SESSION['DOCS_PEND'] = count($controlDocuments);
        $_SESSION['PAGOS_PEND'] = count($controlPagos);
        $ctrs=0;
        for($i=0;$i<count($viajePendienteSummary);$i++)
        {
            $ctrs=$ctrs+$viajePendienteSummary[$i][2];
        }
        //$_SESSION['ASIG_PEND'] = count($viajePendienteSummary);
        $_SESSION['ASIG_PEND'] = $ctrs;
    }
    $viajePendienteSummary=$controller->viajesPendientesAsignarList($databasecon,$DEBUG_STATUS);
    $count_viajeDtl=0;
    if(isset($_GET["hora_viaje"]) && isset($_GET["from_airport"]))
    {
           $viajeDtl=$controller->viajesAeropuertoPendienteAsignar($databasecon,$_GET["hora_viaje"],$_GET["from_airport"],$DEBUG_STATUS);
           $count_viajeDtl=count($viajeDtl);
    }
    //$solicitudDtl=$controller->misSolicitudes($databasecon,$_SESSION['userid'],$hora_viaje,$DEBUG_STATUS);
    
    
    $_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }
    
  include_once('header.php');

?>
<br>
<br>
<div class="container inner_body">
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
            <h3 style="text-align:center;color:#FFF;margin-top:1px">ASIGNAR CONDUCTOR</h3>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10 inner_body-block">
            
            <br>
            <?php  if(isset($message)) 
                {
            ?>
            <div class="row">
                <div class="col-sm-12 text-center">
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
                <div class="col-sm-12 text-center">
                    <a href="#"><button type="button" class="btn btn-success btn_summary_viaje_green">AEROPUERTO - QUITO<span class="badge badge_summary_viaje"></span></button></a>
                    <a href="#"><button type="button" class="btn btn-primary btn_summary_viaje">QUITO - AEROPUERTO<span class="badge badge_summary_viaje"></span></button></a>
                </div>
            </div>                    
            <br><br>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <?php
                        for($i=0;$i<count($viajePendienteSummary);$i++) 
                        {
                            if($viajePendienteSummary[$i][3]==1)
                                echo '<a href=asignarConductor.php?hora_viaje='.$viajePendienteSummary[$i][1].'&from_airport=1><button type="button" class="btn btn-success btn_summary_viaje_green">'.$viajePendienteSummary[$i][0].' <span class="badge badge_summary_viaje">'.$viajePendienteSummary[$i][2].'</span></button></a>';
                            else
                                echo '<a href=asignarConductor.php?hora_viaje='.$viajePendienteSummary[$i][1].'&from_airport=0><button type="button" class="btn btn-primary btn_summary_viaje">'.$viajePendienteSummary[$i][0].' <span class="badge badge_summary_viaje">'.$viajePendienteSummary[$i][2].'</span></button></a>';
                        }

                    ?>
                </div>
            </div>
            <br><br>
            <form method="post" action="asignarConductorAction.php">
                <input type="hidden" name="submitted" value="true">
                <div class="row">
                    <!-- <div class="col-sm-2">                        
                    </div> -->
                    <div class="col-sm-6 text-right">                        
                        <div class="form-group">
                            <?php
                                if(isset($_GET["hora_viaje"]) && isset($_GET["from_airport"]))
                                {
                            ?>
                                <span class="input-group-addon">CONDUCTORES(ASIGNACION NORMAL)</span>
                            
                                <input type="hidden" id="horaviaje" value=<?php echo $_GET["hora_viaje"];?>>
                                <input type="hidden" id="fromairport" value=<?php echo $_GET["from_airport"];?>>
                            
                            
                                <select name="conductor" class="form-control" id="conductor" onchange=getConductorViajes()>
                                    <option value="0:0:0">Elige un conductor</option>
                                    <?php 
                                        //$controller = new controller();
                                        $conductor = $controller->getConductorsConCorrectDocuments($databasecon,$_GET["hora_viaje"],$_GET["from_airport"],$DEBUG_STATUS);
                                        for($x=0;$x<count($conductor);$x++)
                                        {
                                            echo "<option value='".$conductor[$x][0].':'.$conductor[$x][2].':'.$conductor[$x][3]."'>".strtoupper($conductor[$x][1]).'      ['.$conductor[$x][2].']'."</option>";
                                            /*echo "<option value='".$conductor[$x][0].':8'."'>".$conductor[$x][1].'      [8]'."</option>";*/
                                        }
                                    ?>
                                </select>
                                <div id="errorConductorSelected" class="errorMsg">                        
                                </div>
                            <?php        
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-6 text-right"> 
                    <?php
                        if(isset($conductor) && count($conductor)==0)
                        {
                    ?>                       
                        <div class="form-group">
                            <span class="input-group-addon input-group-addon_forzada">CONDUCTORES(ASIGNACION FORZADA)</span>
                            <select name="conductorForzada" class="form-control" id="conductorForzada">
                                <?php
                                    $conductorForzada = $controller->getConductorsForceAssign($databasecon,$_GET["hora_viaje"],$_GET["from_airport"],$DEBUG_STATUS);
                                    for($x=0;$x<count($conductorForzada);$x++)
                                    {
                                        echo "<option value='".$conductorForzada[$x][0].':'.$conductorForzada[$x][2].':'.$conductorForzada[$x][3]."'>".strtoupper($conductorForzada[$x][1]).'      ['.$conductorForzada[$x][2].']'."</option>";
                                    }
                                ?>
                            </select>
                            <div id="errorConductorSelected" class="errorMsg">                        
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                </div>
               <!--  <div class="row">
                    <div class="col-sm-12 text-right">
                        <h6>SE ENCUENTRO <?php echo $count_viajeDtl;?> VIAJES</h6>
                    </div>
                </div> -->
                <input type="hidden" id="id_viaje_selected" name="id_viaje_selected" value="0" size="100">
                <input type="hidden" id="asientos_selected" name="asientos_selected" value="0" size="100">
                <input type="hidden" id="total_asientos" name="total_asientos" value="0" size="100">
                <div id="errorViajesSelected" class="errorMsg">                        
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h5>DETALLES DE VIAJES ASIGNADOS</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="success_row">
                                        <th>VIAJE ID</th>
                                        <th>DESDE</th>
                                        <th>HASTA</th>
                                        <th>NRO PASAJEROS</th>
                                        <th>FECHA SALIDA</th>
                                    </tr>
                                </thead>
                                <tbody id="viajesAsignados">

                                </tbody>
                            </table>
                        </div>
                    </div> 
                    <div class="col-sm-6">
                        <h5>DETALLES DE VIAJES PARA ASIGNAR</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="success_row">
                                        <th></th>
                                        <th>ID</th>
                                        <th>CODIGO PAGO</th>
                                        <!-- <th>DESDE</th>
                                        <th>HASTA</th>   -->                                 
                                        <th>FECHA SALIDA</th>
                                        <!-- <th>ESTADO</th> -->
                                        <th>CANTIDAD PASAJEROS</th>
                                        <th>COSTO<br>( $ )</th>
                                        <!-- <th>FECHA ACCEPTADO</th>
                                        <th></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        for($x=0;$x<$count_viajeDtl;$x++) 
                                        {
                                            /*if(isset($viajeDtl[$x][10]) && $viajeDtl[$x][10]==1)
                                                $str = '<a href=pagar.php?codigo_pago='.$viajeDtl[$x][8].'&tipo=1>PAGAR</a>';
                                            else if(isset($viajeDtl[$x][10]) && $viajeDtl[$x][10]==2 && isset($viajeDtl[$x][9]) && $viajeDtl[$x][9]==1)
                                                $str='<button type="button" onclick="terminarViaje('.$viajeDtl[$x][0].')" class="btn-info" style="border-radius:4px" title="REGISTRAR VIAJE TERMINADO"><span class="glyphicon glyphicon-ok"></span></button>';
                                            else if(isset($viajeDtl[$x][10]) && $viajeDtl[$x][10]==0)
                                                $str = '<a href=pagar.php?codigo_pago='.$viajeDtl[$x][8].'&tipo=1>APLICAR RETORNO</a>';else
                                                $str='';
                                            echo '<tr class="warning myrow"><td><input type="checkbox" id=check_'.$x.' onchange=addToListList("'.$viajeDtl[$x][0].'","'.$viajeDtl[$x][11].'",'.$x.')></td><td>'.$viajeDtl[$x][0].'</td><td>'.$viajeDtl[$x][8].'</td><td>'.$viajeDtl[$x][1].'</td><td>'.$viajeDtl[$x][2].'</td><td>'.$viajeDtl[$x][3].'</td><td>'.$viajeDtl[$x][11].'</td><td>'.$viajeDtl[$x][4].'</td><td>'.$viajeDtl[$x][5].'</td><td>'.$viajeDtl[$x][7].'</td><td>'.$str.'</td></tr>';    
                                            */
                                            echo '<tr class="warning myrow">
                                                <td><input type="checkbox" id=check_'.$x.' onchange=addToListList("'.$viajeDtl[$x][0].'","'.$viajeDtl[$x][11].'",'.$x.')></td>
                                                <td>'.$viajeDtl[$x][0].'</td>
                                                <td>'.$viajeDtl[$x][8].'</td>
                                                <td>'.$viajeDtl[$x][3].'</td>
                                                <td>'.$viajeDtl[$x][11].'</td>
                                                <td>'.$viajeDtl[$x][5].'</td>
                                                </tr>';    
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-right">
                        <button type="submit" onclick="return validateViajesYConductor();" class="btn btn-info">ASIGNAR CONDUCTOR<span class="glyphicon glyphicon-chevron-right"></span></button>
                    </div>
                </div>
            </form>
            <br>
        </div>
    </div>
    <br>
    <br>
</div>

<?php
include_once('container_footer.php');
?>
