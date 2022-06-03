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
    
    if(isset($_SESSION["message"]))
    {
        $msg=$_SESSION["message"];
        unset($_SESSION["message"]);
    }

    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'controladorDB.php';
    $controladorDB = new controladorDB();

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
            SUBIR ARCHIVO CONCILIACION
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
            <form method="post" action="controladorProceso.php?proceso=3&task=6">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="consulta_integrador" name ="consulta_integrador" value=<?php echo $_SESSION["user_empresa"];?> /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        CONSULTAR DATOS DE VENTAS EN PLATAFORMA WIFI
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <label>FECHA CONCILIACION</label>
                        <input type="date" class="form-control navbar-btn" id="consulta_fecha_conciliacion" placeholder="CLAVE" name="consulta_fecha_conciliacion" value=""required>
                    </div>
                </div>
                <div class="row text-left" style="padding:0px 0px">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-info" title="Click to enter our portal">CONSULTAR BASE<span class="glyphicon glyphicon-chevron-right"></span></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-6" style="background-image: linear-gradient(to left, rgba(255,0,0,0), burlywood);padding:10px">
            <form method="post" action="controladorProceso.php?proceso=3&task=0" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="integrador_carga" name ="integrador_carga" value=<?php echo $_SESSION["user_empresa"];?> /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        CARGA MANUAL DE ARCHIVO DE VENTAS DEL INTEGRADOR
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>FECHA CONCILIACION</label>
                        <input type="date" class="form-control navbar-btn" id="fecha_archivo" placeholder="fecha_archivo" name="fecha_archivo" value=""required>
                    </div>
                    <div class="col-sm-6">
                        <label>ARCHIVO CONCILIACION</label>
                        <input type="file" class="form-control navbar-btn" id="fileToUpload" name="fileToUpload" placeholder="Seleccionar Archivo" required>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <div class="row text-left" style="padding:0px 0px">
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-info" title="Click to enter our portal">PROCESAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
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
                    echo "<h3>CONCILIACION INCONSISTENTE</h3>";
                else if($estadoConcil==7)
                    echo "<h3>CONCILIACION CERRADO FORZADA</h3>";
                else
                    echo "<h3>CONCILIACION PENDIENTE</h3>";
            ?>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="row text-center">
                <div class="col-sm-12">PLATAFORMA WIFI</div>
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
                for($x=0;$x<count($txn_integradores);$x++)
                {
            ?>
                        <tr class="table-body">
                            <td><?php echo $txn_integradores[$x][0];?></td>
                            <td><?php echo $txn_integradores[$x][1];?></td> 
                            <td><?php echo $txn_integradores[$x][2];?></td>
                            <td><?php echo $txn_integradores[$x][3];?></td>
                            <td><?php echo $txn_integradores[$x][4];?></td>
                            <td><?php echo $txn_integradores[$x][5];?></td>
                            <td><?php echo $txn_integradores[$x][6];?></td>
                        </tr>
                    
            <?php
                }
            ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <br>
</div>