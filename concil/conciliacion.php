<?php
    session_start();

    if(!isset($_SESSION['LAST_ACTIVITY']))
    {
        session_destroy();
        $url='index.php?err=98';
        header("Location:$url");
    }
    include_once('util.php');
    include_once('header.php');
    
    if(isset($_SESSION["result"]))
    {
        $msg=$_SESSION["result"];
        unset($_SESSION["result"]);
    }

    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'controladorDB.php';
    require 'controladorWS.php';
    $controladorDB = new controladorDB();
    $controladorWS = new controladorWS();

    if(isset($_SESSION["integrador_carga"]))
        $integrador_carga=$_SESSION["integrador_carga"];

?>
<style type="text/css">
    body
    {
        background-image: none !important;
    }
</style>
<div class="container">    
    <?php
    include_once('sessionData.php');
    ?>
    <br>
    <div class="row pageTitle">
        <div class="col-sm-6">
            CONCILIACION
        </div>
        <div class="col-sm-6 text-right">
            <a href="verConciliacionResumen.php"><button type="submit" class="btn btn-info" title="Click to enter our portal">VER HISTORIAL DE CONCILIACION<span class="glyphicon glyphicon-chevron-right"></span></button></a>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center">
            <?php
            if(isset($msg))
            {
            ?>
            <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $msg;?>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="col-sm-3"></div>
    </div>

    <div class="row">

        <div class="col-sm-6" style="background-image: linear-gradient(to left, rgba(255,0,0,0), burlywood);padding:10px">
            <form method="post" action="controladorProceso.php?proceso=3&task=5" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12">
                        CONSULTAR DATOS DE VENTAS EN PLATAFORMA WIFI
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <label>INTEGRADOR</label>
                        <select name="consulta_integrador" class="form-control navbar-btn" id="consulta_integrador" required>
                            <?php 
                                $lista_integrador = $controladorDB->listaProveedores($databasecon,0,$DEBUG_STATUS);
                                for($i=0;$i<count($lista_integrador);$i++)
                                {
                            ?>
                                    <option value=<?php echo $lista_integrador[$i][0];?>><?php echo $lista_integrador[$i][1];?></option>
                            <?php        
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>FECHA CONCILIACION</label>
                        <input type="date" class="form-control navbar-btn" id="consulta_fecha_conciliacion" placeholder="CLAVE" name="consulta_fecha_conciliacion" value=""required>
                    </div>
                    <div class="col-sm-4">
                        <label>ARCHIVO VENTAS</label>
                        <input type="file" class="form-control navbar-btn" id="fileToUpload" name="fileToUpload" placeholder="Seleccionar Archivo" required>
                    </div>
                </div>
                <div class="row text-center" style="padding:0px 0px">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-info" title="Click to enter our portal">PROCESAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                        <button type="button" class="btn btn-info" title="Click to enter our portal" id="consultarData">CONSULTAR DATOS<span class="glyphicon glyphicon-chevron-right"></span></button>
                        <button type="button" class="btn btn-info" title="Click to enter our portal" id="consultarAlepo">CONSULTAR EN PLATAFORMA WIFI<span class="glyphicon glyphicon-chevron-right"></span></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-6" style="background-image: linear-gradient(to left, rgba(255,0,0,0), burlywood);padding:10px">
            <form method="post" action="controladorProceso.php?proceso=3&task=0" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12">
                        CARGA MANUAL DE ARCHIVO DE VENTAS DEL INTEGRADOR
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>INTEGRADOR</label>
                        <select name="integrador_carga" class="form-control navbar-btn" id="integrador_carga" required>
                            <?php 
                                $lista_integrador = $controladorDB->listaProveedores($databasecon,0,$DEBUG_STATUS);
                                for($i=0;$i<count($lista_integrador);$i++)
                                {
                            ?>
                                    <option value=<?php echo $lista_integrador[$i][0];?>><?php echo $lista_integrador[$i][1];?></option>
                            <?php        
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>FECHA CONCILIACION</label>
                        <input type="date" class="form-control navbar-btn" id="fecha_archivo" placeholder="fecha_archivo" name="fecha_archivo" value=""required>
                    </div>
                    <div class="col-sm-4">
                        <label>ARCHIVO CONCILIACION</label>
                        <input type="file" class="form-control navbar-btn" id="fileToUpload" name="fileToUpload" placeholder="Seleccionar Archivo" required>
                    </div>
                </div>
                <div class="row text-center" style="padding:0px 0px">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-info" title="Click to enter our portal">PROCESAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>

    <?php
        if(isset($_SESSION["result"]))
        {
    ?>
            <div class="row">
                <div class="col-sm-12">
                    <?php 
                        echo $_SESSION["result"];
                        unset($_SESSION["result"]);
                    ?>            
                </div>
            </div>
    <?php
        }   
    ?>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <?php
                if(isset($_SESSION["FECHA_CONCILIACION"]))
                {
                    $fecCon=$_SESSION["FECHA_CONCILIACION"];
                }
                else
                    $fecCon=0;
                if(isset($_SESSION["INTEGRADOR"]))
                {
                    $idCon=$_SESSION["INTEGRADOR"];
                }
                else
                    $idCon=0;
                $estadoConcil=$controladorDB->estadoConciliacion($databasecon,$fecCon,$idCon,$DEBUG_STATUS);
                if($estadoConcil==3)
                    echo "<h3>CONCILIADO</h3>";
                else if($estadoConcil==6 || $estadoConcil==8)
                {
                    echo "<h3>CONCILIACION INCONSISTENTE</h3>";
                ?>
                    <a href="controladorProceso.php?proceso=3&task=3" class="btn btn-info">CERRAR CONCILIACION FORZADA</a>
                <?php
                }
                else if($estadoConcil==7)
                    echo "<h3>CONCILIACION CERRADO FORZADA</h3>";
                else
                    echo "<h3>CONCILIACION PENDIENTE</h3>";
            ?>
        </div>
    </div>
    <div class="row">        
        <div class="col-sm-6">
            <div class="row text-center">
                <div class="col-sm-12">PLATAFORMA WIFI</div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>ID_TRANS_WIFI</td>
                            <td>ID_TRANS_INTEG</td>
                            <td>ID_INTEG</td>
                            <td>ID_CANAL</td>
                            <td>ID_PLAN</td>
                            <td>MONTO</td>
                            <td>FECHA_HORA_VENTA</td>
                            <td>FECHA_HORA_CONCIL</td>
                            <td>ID_CONCIL</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            if(isset($_SESSION["FECHA_CONCILIACION"]))
                            {
                                $fecCon=$_SESSION["FECHA_CONCILIACION"];
                            }
                            else
                                $fecCon=0;
                            if(isset($_SESSION["INTEGRADOR"]))
                            {
                                $idCon=$_SESSION["INTEGRADOR"];
                            }
                            else
                                $idCon=0;
                            $txn_ventas=$controladorDB->listaTxnVentas($databasecon,$fecCon,$idCon,$DEBUG_STATUS);
                            if(count($txn_ventas)==0)
                            {
                                $txn_ventas=$controladorWS->cargarTxnVentas($databasecon,$fecCon,$idCon,$DEBUG_STATUS);
                            }
                            if(count($txn_ventas)==0)
                            {
                        ?>
                            <tr class="table-body">
                                <td colspan=8>No encontrado datos</td>
                            </tr>
                        <?php
                            }
                            else
                            {
                                for($x=0;$x<count($txn_ventas);$x++)
                                {
                                    if($txn_ventas[$x][9]==1)
                                    {
                                ?>
                                        <tr class="table-body" style="background: yellow">
                                <?php    
                                    }
                                    else
                                    {
                                ?>
                                        <tr class="table-body" style="background: aquamarine">
                                <?php
                                    }
                            ?>
                                        
                                            <td><?php echo $txn_ventas[$x][0];?></td>
                                            <td><?php echo $txn_ventas[$x][1];?></td> 
                                            <td><?php echo $txn_ventas[$x][2];?></td>
                                            <td><?php echo $txn_ventas[$x][3];?></td>
                                            <td><?php echo $txn_ventas[$x][4];?></td>
                                            <td><?php echo $txn_ventas[$x][5];?></td>
                                            <td><?php echo $txn_ventas[$x][6];?></td>
                                            <td>
                                                <?php 
                                                    if(is_null($txn_ventas[$x][7]) || empty($txn_ventas[$x][7]))
                                                        echo "NO CONCILIADO";
                                                    else
                                                        echo $txn_ventas[$x][7];
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if(!is_null($txn_ventas[$x][7]) && $txn_ventas[$x][8]==0)
                                                        echo "CONCILIADO FORZADA";
                                                    else
                                                        echo $txn_ventas[$x][8];
                                                ?>
                                            </td>
                                        </tr>
                                    
                            <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row text-center">
                <div class="col-sm-12">INTEGRADOR</div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>ID_TRANS_INTEG</td>
                            <td>ID_INTEG</td>
                            <td>ID_CANAL</td>
                            <td>ID_PLAN</td>
                            <td>MONTO_VENTA</td>
                            <td>FECHA_HORA_VENTA</td>
                            <td>FECHA_HORA_CARGA_ARCHIVO</td>
                            <td>ID_CONCIL</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                if(isset($_SESSION["FECHA_CONCILIACION"]))
                {
                    $fecCon=$_SESSION["FECHA_CONCILIACION"];
                }
                else
                    $fecCon=0;
                if(isset($_SESSION["INTEGRADOR"]))
                {
                    $idCon=$_SESSION["INTEGRADOR"];
                }
                else
                    $idCon=0;
                $txn_integradores=$controladorDB->listaTxnIntegradores($databasecon,$fecCon,$idCon,$DEBUG_STATUS);
                if(count($txn_integradores)==0)
                {
            ?>
                    <tr class="table-body">
                        <td colspan=7>No encontrado datos</td>
                    </tr>
            <?php
                }
                else
                {
                    for($x=0;$x<count($txn_integradores);$x++)
                    {
                        if($txn_integradores[$x][8]==1)
                        {
                    ?>
                            <tr class="table-body" style="background: yellow">
                    <?php    
                        }
                        else
                        {
                    ?>
                            <tr class="table-body" style="background: aquamarine">
                    <?php
                        }
                ?>
                            
                                <td><?php echo $txn_integradores[$x][0];?></td>
                                <td><?php echo $txn_integradores[$x][1];?></td> 
                                <td><?php echo $txn_integradores[$x][2];?></td>
                                <td><?php echo $txn_integradores[$x][3];?></td>
                                <td><?php echo $txn_integradores[$x][4];?></td>
                                <td><?php echo $txn_integradores[$x][5];?></td>
                                <td><?php echo $txn_integradores[$x][6];?></td>
                                <td><?php echo $txn_integradores[$x][7];?></td>
                            </tr>
                        
                <?php
                    }
                }
            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-sm-12">
            <?php
                if(isset($_SESSION["FECHA_CONCILIACION"]))
                {
                    $fecCon=$_SESSION["FECHA_CONCILIACION"];
                }
                else
                    $fecCon=0;
                if(isset($_SESSION["INTEGRADOR"]))
                {
                    $idCon=$_SESSION["INTEGRADOR"];
                }
                else
                    $idCon=0;
                if($controladorDB->estadoConciliacion($databasecon,$fecCon,$idCon,$DEBUG_STATUS)==1)
                {
            ?>
                <a href="controladorProceso.php?proceso=3&task=2"><button type="button" class="btn btn-info" title="Haz clic para conciliar">CONCILIAR<span class="glyphicon glyphicon-chevron-right"></span></button></a>
            <?php   
                }
                else
                {
            ?>
                <a href="controladorProceso.php?proceso=3&task=2"><button type="button" class="btn btn-info" title="Haz clic para conciliar">CONCILIAR NUEVAMENTE<span class="glyphicon glyphicon-chevron-right"></span></button></a>
            <?php   
                }
            ?>
            
        </div>
    </div>
    <br>
</div>