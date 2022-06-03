<?php
include_once('util.php');
if(session_status() == PHP_SESSION_NONE)
    session_start();
include_once('portal-menu.php');

include_once('config.php');    
$DEBUG_STATUS = $PRINT_LOG;
require 'dbcontroller.php';
$controller = new controller();
$clientes = $controller->getBranches($databasecon,$DEBUG_STATUS); 

?>
<div class="row mm-container mm-container-back-insession">
    <div class="col-sm-2">
        <?php
            include_once("sidebar_menu.php");
        ?>
    </div> 
    <div class="col-sm-10 row_no_margin">
        <div class="row text-center">
            <h1>ADMINISTRACIÓN DE PUNTO DE EMISIÓN</h1>
        </div>
        <?php
            include_once('messagePanel.php');
        ?>
        <div class="row">
            <div class="col-sm-12">
                <form action="controller.php?controller=3&task=0" method="post">
                    <input type="hidden" id="branch_id" name="branch_id" value="<?php echo 0;?>" class="form-control">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">NOMBRE</span>
                                <input type="text" id="branch_name" name="branch_name" class="form-control" placeholder="Ingresar nombre">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">DIRECCIÓN</span>
                                <input type="text" id="branch_address" name="branch_address" class="form-control" placeholder="Ingresar direccion">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">TELEFONO</span>
                                <input type="text" id="branch_telephone" name="branch_telephone" class="form-control" placeholder="Ingresar telefono">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">EMAIL</span>
                                <input type="text" id="branch_email" name="branch_email" class="form-control" placeholder="Ingresar email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">COD. EMISIÓN</span>
                                <input type="text" id="branch_emision_code" name="branch_emision_code" class="form-control" placeholder="Ingresar codigo emision">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">NRO. INI FACTURA</span>
                                <input type="text" id="branch_bill_start_num" name="branch_bill_start_num" class="form-control" placeholder="Ingresar inicio del factura">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">NRO. FIN FACTURA</span>
                                <input type="text" id="branch_bill_end_num" name="branch_bill_end_num" class="form-control" placeholder="Ingresar final del factuar">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary" id="btnOpenManageBusinessForm">ACTUALIZAR</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                     <?php
                        if(count($clientes)>0)
                            echo '<h4>'.count($clientes).' REGISTROS ENCONTRADOS</h4>';
                        else
                            echo '<h4>0 REGISTROS ENCONTRADOS</h4>'
                    ?>
                    <div class="table-responsive">          
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NOMBRE DE PUNTO DE EMISIÓN</th>
                                    <th>DIRECCIÓN</th>
                                    <th>TELEFONO</th>
                                    <th>CORREO ELECTRÓNICO</th>
                                    <th>CODIGO EMISIÓN</th>
                                    <th>FACTURA INICIO</th>
                                    <th>FACTURA FIN</th>
                                    <th>ESTADO</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(count($clientes)>0)
                                    {
                                        for($x=0;$x<count($clientes);$x++)
                                        {
                                    ?>
                                        <tr>
                                            <td><?php echo $clientes[$x][0];?></td>
                                            <td><?php echo $clientes[$x][1];?></td>
                                            <td><?php echo $clientes[$x][2];?></td>
                                            <td><?php echo $clientes[$x][3];?></td>
                                            <td><?php echo $clientes[$x][4];?></td>
                                            <td><?php echo $clientes[$x][5];?></td>
                                            <td><?php echo $clientes[$x][6];?></td>
                                            <td><?php echo $clientes[$x][7];?></td>
                                            <td><?php if($clientes[$x][8]==0) echo 'DESHABILITADO'; else echo 'HABILITADO'?></td>
                                            <td>
                                                <?php
                                                echo '<a href="#" onclick=habilitarEditBranch("'.$clientes[$x][0].'","'.urlencode($clientes[$x][1]).'","'.urlencode($clientes[$x][2]).'","'.urlencode($clientes[$x][3]).'","'.$clientes[$x][4].'","'.$clientes[$x][5].'","'.$clientes[$x][6].'","'.$clientes[$x][7].'")><span class="glyphicon glyphicon-pencil icon_action"></span></a>';
                                                if($clientes[$x][8]==0)
                                                    echo '<a href="#" onclick=delBranch("'.$clientes[$x][0].'","'.urlencode($clientes[$x][1]).'","'.urlencode($clientes[$x][2]).'",0)><span class="glyphicon glyphicon-arrow-up icon_action"></span></a>';
                                                else
                                                    echo '<a href="#" onclick=delBranch("'.$clientes[$x][0].'","'.urlencode($clientes[$x][1]).'","'.urlencode($clientes[$x][2]).'",1)><span class="glyphicon glyphicon-arrow-down icon_action"></span></a>';
                                                ?>
                                                <!-- <button type="button" class="btn btn-primary" id="editCliente"><i class="glyphicon glyphicon-pencil icon_action"></i></button>
                                                <button type="button" class="btn btn-primary" id="deleteCliente"><i class="glyphicon glyphicon-remove icon_action"></i></button> -->
                                            </td>
                                        </tr>
                                <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once('footer.php');
?>
