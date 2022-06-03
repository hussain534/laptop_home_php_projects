<?php
include_once('../../common/config.php'); 
include_once('../../util.php');
//session_start();
include_once('../portal-menu.php');

   
$DEBUG_STATUS = $PRINT_LOG;
/*require 'dbcontroller.php';
$controller = new controller();
$clientes = $controller->getClientesProviders($databasecon,1,$DEBUG_STATUS); */


?>
<div class="row mm-container mm-container-back-insession">
    <div class="col-sm-2">
        <?php
            include_once("../sidebar_menu_super_admin.php");
        ?>
    </div> 
    <div class="col-sm-10 row_no_margin">
        <div class="row text-center">
            <h1>GESTION DE CLIENTE</h1>
        </div>
        <?php
            include_once('messagePanel.php');
        ?>
        <div class="row">
            <div class="col-sm-12">
                <form action="controller.php?controller=1&task=0" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">RAZ. SOCIAL</span>
                                <input type="text" id="client_name" name="client_name" class="form-control" placeholder="Ingresar razon social">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">RUC</span>
                                <input type="text" id="client_ruc" name="client_ruc" class="form-control" placeholder="Ingresar RUC">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">DIRECCION</span>
                                <input type="text" id="client_address" name="client_address" class="form-control" placeholder="Ingresar direccion">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">TELEFONO</span>
                                <input type="text" id="client_phone" name="client_phone" class="form-control" placeholder="Ingresar telefono">
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                                <th>RUC</th>
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
                                            <td><?php echo $clientes[$x][1];?></td>
                                            <td><?php echo $clientes[$x][2];?></td>
                                            <td><?php echo $clientes[$x][3];?></td>
                                            <td><?php echo $clientes[$x][4];?></td>
                                            <td><?php echo $clientes[$x][5];?></td>
                                            <td><?php if($clientes[$x][6]==0) echo 'DESHABILITADO'; else echo 'HABILITADO'?></td>
                                            <td>
                                                <?php
                                                echo '<a href="#" onclick=habilitarEditCliente("'.$clientes[$x][0].'","'.urlencode($clientes[$x][1]).'","'.urlencode($clientes[$x][2]).'","'.urlencode($clientes[$x][3]).'","'.urlencode($clientes[$x][4]).'","'.$clientes[$x][5].'")><span class="glyphicon glyphicon-pencil icon_action"></span></a>';
                                                if($clientes[$x][6]==0)
                                                    echo '<a href="#" onclick=delCliente("'.$clientes[$x][0].'","'.urlencode($clientes[$x][1]).'","'.urlencode($clientes[$x][2]).'",0)><span class="glyphicon glyphicon-arrow-up icon_action"></span></a>';
                                                else
                                                    echo '<a href="#" onclick=delCliente("'.$clientes[$x][0].'","'.urlencode($clientes[$x][1]).'","'.urlencode($clientes[$x][2]).'",1)><span class="glyphicon glyphicon-arrow-down icon_action"></span></a>';
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
        </div>
    </div>
</div>
<?php
include_once('../../footer.php');
?>
