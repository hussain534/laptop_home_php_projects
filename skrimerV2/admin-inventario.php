<?php
include_once('util.php');
if(session_status() == PHP_SESSION_NONE)
    session_start();
include_once('portal-menu.php');

include_once('config.php');    
$DEBUG_STATUS = $PRINT_LOG;
require 'dbcontroller.php';

echo $_SESSION['SUPPLIER'];
if(isset($_GET['sid']) && $_GET['sid']!=0)
    $_SESSION['SUPPLIER']=$_GET['sid'];
else
    $_SESSION['SUPPLIER']=0;

$controller = new controller();
$itemCategory = $controller->getItemCategory($databasecon,$DEBUG_STATUS);
$distributors = $controller->getDistributors($databasecon,2,$DEBUG_STATUS);
if(isset($_POST['submitted']))
{
    $inventoryItems = $controller->buscarInventoryItems($databasecon,$_POST['item_name_busqueda'],$_POST['item_category_busqueda'],$_POST['item_desc_busqueda'],$_POST['item_prov_ruc_busqueda'],$DEBUG_STATUS);
    //print_r($inventoryItems);
}
else
{
    //echo 'hello';
    $inventoryItems = $controller->getInventoryItems($databasecon,$DEBUG_STATUS); 
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
            <h1>ADMINISTRACIÓN DE INVENTARIO</h1>
        </div>
        <?php
            include_once('messagePanel.php');
        ?>
        <div class="row">
            <div class="col-sm-12">
                <form action="controller.php?controller=5&task=0" method="post">
                    <div class="row">
                        <div class="col-sm-10"></div>
                        <div class="col-sm-2">
                            <div class="btn-group">
                                <a href="admin-distribuidor.php"><button type="button" class="btn btn-warning">ESCOGER PROVEEDOR</button></a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="hidden" id="item_id" name="item_id" value="<?php echo 0;?>" class="form-control">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">RUC. PROVEEDOR</span>
                                <input type="text" id="item_prov_ruc" name="item_prov_ruc" value="<?php echo $_SESSION['SUPPLIER'];?>"class="form-control" readonly="true">
                                <!-- <span class="input-group-addon">RUC. PROVEEDOR</span>
                                <select class="form-control" id="item_prov_ruc" name="item_prov_ruc">
                                    <option value="0">OTRO</option>
                                <?php
                                    for($x=0;$x<count($distributors);$x++)
                                    {
                                    ?>
                                    <option value="<?php echo $distributors[$x][1];?>"><?php echo $distributors[$x][2];?></option>
                                    <?php
                                    }
                                    ?>
                                </select> -->
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">LLEVA MOV INVENTARIO</span>
                                <select class="form-control" id="item_lleva_inventario" name="item_lleva_inventario" onchange="setInventoryValues()">
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">CODIGO BARRA</span>
                                <input type="text" id="item_barcode" name="item_barcode" class="form-control" value="0" readonly="true">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">CATEGORIA</span>
                                <select class="form-control" id="item_category" name="item_category">
                                    <?php
                                        for($x=0;$x<count($itemCategory);$x++)
                                        {
                                    ?>
                                    <option value="<?php echo $itemCategory[$x][0];?>"><?php echo $itemCategory[$x][1];?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">NOM. PRODUCTO</span>
                                <input type="text" id="item_name" name="item_name" class="form-control" placeholder="Ingresar nombre">
                            </div>
                        </div>
                        <!-- <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">DESCRIPCION</span>
                                <input type="text" id="item_desc" name="item_desc" class="form-control" placeholder="Ingresar descripcion">
                            </div>
                        </div> --> 
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">CANTIDAD</span>
                                <input type="text" id="item_qty" name="item_qty" class="form-control" placeholder="Ingresar cantidad">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">COSTO COMPRA / UNIDAD</span>
                                <input type="text" id="item_purchase_price" name="item_purchase_price" class="form-control" placeholder="Ingresar precio de compra">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">COSTO VENTA/ UNIDAD</span>
                                <input type="text" id="item_ppu" name="item_ppu" class="form-control" placeholder="Costo del unidad">
                            </div>
                        </div>
                        <!-- <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">IVA (%)</span>
                                <input type="text" id="item_iva" name="item_iva" class="form-control" placeholder="Ingresar % de IVA">
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">FECHA EXPIRACION</span>
                                <input type="date" id="item_exp_dt" name="item_exp_dt" class="form-control" placeholder="Fecha Expiracion en formato AAAA-MM-DD">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">ALERTA ALMACEN</span>
                                <input type="text" id="item_store_min_alert" name="item_store_min_alert" class="form-control" value="0">
                            </div>
                        </div>
                        <!-- <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">RUC. PROVEEDOR</span>
                                <select class="form-control" id="item_prov_ruc" name="item_prov_ruc">
                                    <option value="0">OTRO</option>
                                <?php
                                    for($x=0;$x<count($distributors);$x++)
                                    {
                                    ?>
                                    <option value="<?php echo $distributors[$x][1];?>"><?php echo $distributors[$x][2];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">TIPO DE GASTO</span>
                                <select class="form-control" id="item_expenditure_type" name="item_expenditure_type">
                                    <option value="1">OTRO</option>
                                    <option value="2">ALIMENTACION</option>
                                    <option value="3">SALUD</option>
                                    <option value="4">EDUCACION</option>
                                    <option value="5">VESTIMIENTO</option>
                                    <option value="6">VIVIENDA</option>
                                </select>
                            </div>
                        </div>                        
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">ACCION</span>
                                <select class="form-control" id="item_accion" name="item_accion">
                                    <option value="0">AGREGAR</option>
                                    <option value="1">EDITAR</option>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">ALERTA BOD. 1</span>
                                <input type="text" id="item_pri_godown_min_alert" name="item_pri_godown_min_alert" class="form-control" value="0">
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <!-- <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">ALERTA BOD. 2</span>
                                <input type="text" id="item_sec_godown_min_alert" name="item_sec_godown_min_alert" class="form-control" value="0">
                            </div>
                        </div> -->
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if ($_SESSION['SUPPLIER']!=0) 
                            {
                            ?>
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary" id="btnOpenManageBusinessForm">ACTUALIZAR</button>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="btn-group">
                                <a href="#" data-toggle="modal" data-target="#buscarItem"><button type="button" class="btn btn-primary" id="btnOpenManageBusinessForm">BUSCAR</button></a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <?php
                        if(count($inventoryItems)>0)
                            echo '<h4>'.count($inventoryItems).' REGISTROS ENCONTRADOS</h4>';
                        else
                            echo '<h4>0 REGISTROS ENCONTRADOS</h4>'
                    ?>
                    <div class="table-responsive">          
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NOMBRE</th>
                                    <th>DESCRIPCION</th>
                                    <th>CATEGORIA</th>
                                    <th>CANTIDAD ACTUAL</th>
                                    <th>COSTO DEL UNIDAD</th>
                                    <th>PROVEEDOR</th>
                                    <th>FECHA EXPIRACION</th>
                                    <th>ESTADO</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(count($inventoryItems)>0)
                                    {
                                        for($x=0;$x<count($inventoryItems);$x++)
                                        {
                                    ?>
                                        <tr>
                                            <td><?php echo $inventoryItems[$x][0];?></td>
                                            <td><?php echo $inventoryItems[$x][1];?></td>
                                            <td><?php echo $inventoryItems[$x][2];?></td>
                                            <td><?php echo $inventoryItems[$x][4];?></td>
                                            <td><?php echo $inventoryItems[$x][5];?></td>
                                            <td><?php echo $inventoryItems[$x][6];?></td>
                                            <td><?php echo $inventoryItems[$x][7];?></td>
                                            <td><?php echo $inventoryItems[$x][9];?></td>
                                            <!-- <td><?php echo $inventoryItems[$x][10];?></td> -->
                                            <td><?php if($inventoryItems[$x][9]==0) echo 'DESHABILITADO'; else echo 'HABILITADO'?></td>
                                            <td>
                                                <?php
                                                echo '<a href="#" onclick=habilitarEditInventory("'.$inventoryItems[$x][0].'","'.urlencode($inventoryItems[$x][1]).'","'.urlencode($inventoryItems[$x][2]).'",'.urlencode($inventoryItems[$x][5]).','.$inventoryItems[$x][6].',"'.urlencode($inventoryItems[$x][3]).'","'.urlencode($inventoryItems[$x][7]).'","'.urlencode($inventoryItems[$x][8]).'","'.urlencode($inventoryItems[$x][10]).'","'.urlencode($inventoryItems[$x][11]).'","'.urlencode($inventoryItems[$x][12]).'","'.urlencode($inventoryItems[$x][13]).'","'.urlencode($inventoryItems[$x][14]).'")><span class="glyphicon glyphicon-pencil icon_action"></span></a>';
                                                if($inventoryItems[$x][9]==0)
                                                    echo '<a href="#" onclick=delInventory("'.$inventoryItems[$x][0].'","'.urlencode($inventoryItems[$x][1]).'","'.urlencode($inventoryItems[$x][2]).'",0)><span class="glyphicon glyphicon-arrow-up icon_action"></span></a>';
                                                else
                                                    echo '<a href="#" onclick=delInventory("'.$inventoryItems[$x][0].'","'.urlencode($inventoryItems[$x][1]).'","'.urlencode($inventoryItems[$x][2]).'",1)><span class="glyphicon glyphicon-arrow-down icon_action"></span></a>';
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
            <div id="buscarItem" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h2 class="modal-title text-center">BUSQUEDA</h2>
                        </div>
                        <div class="modal-body text-center">
                            <br>
                            <br>
                            <form action="admin-inventario.php" method="post">
                                <input type="hidden" name="submitted" value="true">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">NOM. PRODUCTO</span>
                                            <input type="text" id="item_name_busqueda" name="item_name_busqueda" class="form-control" placeholder="Ingresar nombre">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">CATEGORIA</span>
                                            <select class="form-control" id="item_category_busqueda" name="item_category_busqueda">
                                                <option value="-1">TODOS</option>
                                                <?php
                                                    for($x=0;$x<count($itemCategory);$x++)
                                                    {
                                                ?>
                                                <option value="<?php echo $itemCategory[$x][0];?>"><?php echo $itemCategory[$x][1];?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">DESCRIPCION</span>
                                            <input type="text" id="item_desc_busqueda" name="item_desc_busqueda" class="form-control" placeholder="Ingresar descripcion">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">RUC. PROVEEDOR</span>
                                            <select class="form-control" id="item_prov_ruc_busqueda" name="item_prov_ruc_busqueda">
                                                <option value="-1">TODOS</option>
                                            <?php
                                                for($x=0;$x<count($distributors);$x++)
                                                {
                                                ?>
                                                <option value="<?php echo $distributors[$x][1];?>"><?php echo $distributors[$x][2];?></option>
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
                                            <button type="submit" class="btn btn-primary" id="btnBuscarItems">BUSCAR</button>
                                        </div><!-- 
                                        <div class="btn-group">
                                            <a href="#" data-toggle="modal" data-target="#buscarItem"><button type="button" class="btn btn-primary" id="btnOpenManageBusinessForm">BUSCAR</button></a>
                                        </div> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once('footer.php');
?>
