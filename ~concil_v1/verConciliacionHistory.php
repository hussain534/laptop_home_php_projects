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

    if(isset($_GET["id"]))
        $arrConciliacion = $controladorDB->consultarConciliacionDetalles($databasecon,$_GET["id"],$DEBUG_STATUS);
    else
        $arrConciliacion=null;

    //$proveedores = $controladorDB->listaProveedores($databasecon,0,$DEBUG_STATUS);
    

?>
<div class="container">    
    <?php
    include_once('sessionData.php');
    ?>
    <br>
    <div class="row pageTitle">
        <div class="col-sm-12">
            CONCILIACION DETALLES
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

    

    <?php
        
        if(isset($arrConciliacion))
            echo '<h5>Encontrado '.count($arrConciliacion).' registros</h5>'
    ?>

    <div class="row text-right">
        <div class="col-sm-8"></div>
        <div class="col-sm-4">ESTADO: CONCILIADO</div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">                            
                            <td>ID_CONCILIACION</td>
                            <td>TRAN_ID_EXT</td>
                            <td>TRAN_ID_INTT</td>
                            <td>ID_INTEG</td>
                            <td>ID_CANAL</td>
                            <td>ID_PLAN</td>
                            <td>MONTO_VENTA</td>
                            <td>FECHA_HORA_VENTA</td>
                            <td>FECHA_HORA_CONCILIACION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($arrConciliacion);$x++)
                {
            ?>
                        <tr class="table-body">
                            <td><?php echo $arrConciliacion[$x][0];?></td>
                            <td><?php echo $arrConciliacion[$x][1];?></td> 
                            <td><?php echo $arrConciliacion[$x][2];?></td>
                            <td><?php echo $arrConciliacion[$x][3];?></td>
                            <td><?php echo $arrConciliacion[$x][4];?></td>
                            <td><?php echo $arrConciliacion[$x][5];?></td>
                            <td><?php echo $arrConciliacion[$x][6];?></td>
                            <td><?php echo $arrConciliacion[$x][7];?></td>
                            <td><?php echo $arrConciliacion[$x][8];?></td>
                        </tr>
                    
            <?php
                }
            ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
</div>