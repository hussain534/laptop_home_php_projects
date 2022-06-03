<?php
include_once('util.php');
if(session_status() == PHP_SESSION_NONE)
    session_start();
include_once('portal-menu.php');

include_once('config.php');    
$DEBUG_STATUS = $PRINT_LOG;
require 'dbcontroller.php';
$controller = new controller();
$sucursales = $controller->getBranches($databasecon,$DEBUG_STATUS);
$clients= $controller->getClientes($databasecon,$DEBUG_STATUS);
$reportData = null;
if(isset($_POST['submitted']))
{
    $reportData = $controller->getReporteVentas($databasecon,$_POST['branch_id'],$_POST['str_date'],$_POST['end_date'],$_POST['nro_factura'],$_POST['id_cliente'],$DEBUG_STATUS); 
    //print_r($inventoryItems);
}
?>
<div class="row mm-container mm-container-back-insession">
    <div class="col-sm-2">
        <?php
            include_once("sidebar_menu.php");
        ?>
    </div> 
    <div class="col-sm-10 row_no_margin">
        <div class="row text-center">
            <h1>REPORTE VENTAS</h1>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="reporte-ventas.php" method="post">
                    <input type="hidden" name="submitted" value="true">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">SUCURSAL</span>
                                <select class="form-control" id="branch_id" name="branch_id">
                                    <?php
                                        for($x=0;$x<count($sucursales);$x++)
                                        {
                                    ?>
                                    <option value="<?php echo $sucursales[$x][0];?>"><?php echo $sucursales[$x][1];?></option>
                                    <?php
                                        }
                                    ?>
                                  </select>
                            </div>
                        </div>  
                        <div class="col-sm-3">
                            <div class="input-group">
                                <span class="input-group-addon">DESDE</span>
                                <input type="date" id="str_date" name="str_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <span class="input-group-addon">HASTA</span>
                                <input type="date" id="end_date" name="end_date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">NRO FACTURA</span>
                                <input type="text" id="nro_factura" name="nro_factura" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">ID CLIENTE</span>
                                <select class="form-control" id="id_cliente" name="id_cliente">
                                    <?php
                                        for($x=0;$x<count($clients);$x++)
                                        {
                                    ?>
                                    <option value="<?php echo $clients[$x][0];?>"><?php echo $clients[$x][1];?></option>
                                    <?php
                                        }
                                    ?>
                                  </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary" id="btnOpenManageBusinessForm">BUSCAR</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <!-- <div class="row">
                        <div class="col-sm-12">
                            <div class="btn-group">
                                <img src="images/pdf-icon.png" style="width:10%" title="Exportar PDF"><img src="images/excel-icon.png" style="width:10%" title="Exportar EXCEL">
                            </div>
                        </div>
                    </div> -->
                    <?php
                        if(count($reportData)>0)
                            echo '<h4>'.count($reportData).' FACTURAS ENCONTRADOS</h4>';
                        else
                            echo '<h4>0 FACTURAS ENCONTRADOS</h4>'
                    ?>
                    <div class="table-responsive">          
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NOMBRE SUCURSAL</th>
                                    <th>NRO FACTURA</th>
                                    <th>FECHA EMISION FACTURA</th>
                                    <th>NRO ID CLIENTE</th>
                                    <th>NOMBRE CAJERO</th>
                                    <th class="td_right">TOTAL</th>
                                    <!-- <th class="td_right">ACCION</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(count($reportData)>0)
                                    {
                                        for($x=0;$x<count($reportData);$x++)
                                        {
                                    ?>
                                        <tr>
                                            <td><?php echo $x;?></td>
                                            <td><?php echo $reportData[$x][0];?></td>
                                            <td><?php echo $reportData[$x][1];?></td>
                                            <td><?php echo $reportData[$x][2];?></td>
                                            <td><?php echo $reportData[$x][3];?></td>
                                            <td><?php echo $reportData[$x][4];?></td>
                                            <td class="td_right"><?php echo number_format($reportData[$x][5],2);?></td>
                                            <!-- <td class="td_right">
                                                <?php
                                                echo '<a href="#" onclick=habilitarEditUser("'.$reportData[$x][1].'")><span class="glyphicon glyphicon-pencil icon_action"></span></a>';
                                                echo '<a href="#" onclick=delUser("'.$reportData[$x][1].'")><span class="glyphicon glyphicon-arrow-up icon_action"></span></a>';
                                                ?>
                                            </td> -->
                                        </tr>
                                <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    


                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once('footer.php');
?>
