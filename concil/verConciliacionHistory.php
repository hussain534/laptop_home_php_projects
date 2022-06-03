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
                            $txn_ventas=$controladorDB->listaTxnVentas($databasecon,$_GET["fecha_venta"],$_GET["id"],$DEBUG_STATUS);
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
                                            <td><?php echo $txn_ventas[$x][8];?></td>
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
               
                $txn_integradores=$controladorDB->listaTxnIntegradores($databasecon,$_GET["fecha_venta"],$_GET["id"],$DEBUG_STATUS);
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
    <br>
</div>