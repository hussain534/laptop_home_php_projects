<?php
include_once('util.php');
if(session_status() == PHP_SESSION_NONE)
    session_start();
include_once('portal-menu.php');

include_once('config.php');    
$DEBUG_STATUS = $PRINT_LOG;
require 'dbcontroller.php';
$controller = new controller();
$clientes = $controller->getDistributors($databasecon,0,$DEBUG_STATUS); 
$_SESSION['SUPPLIER']=0;

?>
<div class="row mm-container mm-container-back-insession">
    <div class="col-sm-2">
        <?php
            include_once("sidebar_menu.php");
        ?>
    </div> 
    <div class="col-sm-10 row_no_margin">
        <div class="row text-center">
            <h1>GESTION DE DISTRIBUIDORES Y CUSTOMERS</h1>
        </div>
        <?php
            include_once('messagePanel.php');
        ?>
        <div class="row">
            <div class="col-sm-12">
                <form action="controller.php?controller=2&task=0" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">TIPO DOCUMENTO</span>
                                <select class="form-control" id="client_doc_type" name="client_doc_type">
                                    <option value="1">CEDULA</option>
                                    <option value="2">RUC</option>
                                    <option value="3">PASAPORTE</option>
                                    <option value="4">CONSUMIDOR FINAL</option>
                                  </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">CODIGO IDEN.</span>
                                <input type="text" id="client_ruc" name="client_ruc" class="form-control" placeholder="Ingresar RUC">
                            </div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">RAZ. SOCIAL / NOMBRE</span>
                                <input type="text" id="client_name" name="client_name" class="form-control" placeholder="Ingresar razon social o nombre customer">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">DIRECCION</span>
                                <input type="text" id="client_address" name="client_address" class="form-control" placeholder="Ingresar direccion">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">TELEFONO</span>
                                <input type="text" id="client_phone" name="client_phone" class="form-control" placeholder="Ingresar telefono">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">EMAIL</span>
                                <input type="email" id="client_email" name="client_email" class="form-control" placeholder="Ingresar correo electronico">
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
                </form>
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
                                <th>TIPO DOC</th>
                                <th>NRO.DOC</th>
                                <th>RAZON SOCIAL</th>
                                <th>DIRECCION</th>
                                <th>TELEFONO</th>
                                <th>CORREO ELECTRONICO</th>
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
                                            <td><?php echo $clientes[$x][8];?></td>
                                            <td><?php echo $clientes[$x][1];?></td>
                                            <td><?php echo $clientes[$x][2];?></td>
                                            <td><?php echo $clientes[$x][3];?></td>
                                            <td><?php echo $clientes[$x][4];?></td>
                                            <td><?php echo $clientes[$x][5];?></td>
                                            <td><?php if($clientes[$x][6]==0) echo 'DESHABILITADO'; else echo 'HABILITADO'?></td>
                                            <td>
                                                <?php
                                                echo '<a href="#" onclick=habilitarEditDistributor("'.$clientes[$x][0].'","'.$clientes[$x][7].'","'.urlencode($clientes[$x][1]).'","'.urlencode($clientes[$x][2]).'","'.urlencode($clientes[$x][3]).'","'.urlencode($clientes[$x][4]).'","'.$clientes[$x][5].'")><span class="glyphicon glyphicon-pencil icon_action"></span></a>';
                                                if($clientes[$x][6]==0)
                                                    echo '<a href="#" onclick=delDistributor("'.$clientes[$x][0].'","'.urlencode($clientes[$x][1]).'","'.urlencode($clientes[$x][2]).'",0)><span class="glyphicon glyphicon-arrow-up icon_action"></span></a>';
                                                else
                                                    echo '<a href="#" onclick=delDistributor("'.$clientes[$x][0].'","'.urlencode($clientes[$x][1]).'","'.urlencode($clientes[$x][2]).'",1)><span class="glyphicon glyphicon-arrow-down icon_action"></span></a>';
                                                echo '<a href="admin-inventario.php?sid='.$clientes[$x][1].'")><span class="glyphicon glyphicon-th-large icon_action"></span></a>';
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
            </div>
        </div>
    </div>
</div>
<?php
include_once('footer.php');
?>
