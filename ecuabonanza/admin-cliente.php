<?php
include_once('util.php');
if(session_status() == PHP_SESSION_NONE)
    session_start();
include_once('portal-menu.php');

include_once('config.php');    
$DEBUG_STATUS = $PRINT_LOG;
require 'dbcontroller.php';
$controller = new controller();
$clientes = $controller->getClientesProviders($databasecon,1,$DEBUG_STATUS); 


?>
<div class="row mm-container mm-container-back-insession">
    <div class="col-sm-2">
        <?php
            include_once("sidebar_menu.php");
        ?>
    </div> 
    <div class="col-sm-10 row_no_margin">
        <div class="row text-center">
            <h1>ADMINISTRACION DE CLIENTE</h1>
        </div>
        <?php
            include_once('messagePanel.php');
        ?>
        <div class="row">
            <div class="col-sm-12">
                <form action="controller.php?controller=1&task=0" method="post">
                    <div class="row">
                        <div class="col-sm-9"></div>
                        <div class="col-sm-2">
                            <div class="btn-group">
                                <a href="admin-punto.php"><button type="button" class="btn btn-warning">ADMINISTRAR PUNTO EMISION</button></a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="hidden" id="client_name" name="client_name" value="<?php echo $clientes[0][0];?>" class="form-control" placeholder="Ingresar razon social">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">RAZ. SOCIAL</span>
                                <input type="text" id="client_name" name="client_name" value="<?php echo $clientes[0][2];?>" class="form-control" placeholder="Ingresar razon social">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">RUC</span>
                                <input type="text" id="client_ruc" name="client_ruc" value="<?php echo $clientes[0][1];?>" class="form-control" placeholder="Ingresar RUC" readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">DIRECCION</span>
                                <input type="text" id="client_address" name="client_address" value="<?php echo $clientes[0][3];?>" class="form-control" placeholder="Ingresar direccion">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">TELEFONO</span>
                                <input type="text" id="client_phone" name="client_phone" value="<?php echo $clientes[0][4];?>" class="form-control" placeholder="Ingresar telefono">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">EMAIL</span>
                                <input type="email" id="client_email" name="client_email" value="<?php echo $clientes[0][5];?>" class="form-control" placeholder="Ingresar correo electronico">
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
            </div>
        </div>
    </div>
</div>
<?php
include_once('footer.php');
?>
