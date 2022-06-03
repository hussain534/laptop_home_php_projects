<?php
include_once('util.php');
if(session_status() == PHP_SESSION_NONE)
    session_start();
include_once('portal-menu.php');

include_once('config.php');    
$DEBUG_STATUS = $PRINT_LOG;
require 'dbcontroller.php';
$controller = new controller();
$itemCategory = $controller->getItemCategory($databasecon,$DEBUG_STATUS);
$distributors = $controller->getDistributors($databasecon,2,$DEBUG_STATUS);

?>
<div class="row mm-container mm-container-back-insession">
    <div class="col-sm-2">
        <?php
            include_once("sidebar_menu.php");
        ?>
    </div> 
    <div class="col-sm-10 row_no_margin">
        <div class="row text-center">
            <h1>VENTAS</h1>
        </div>
        <?php
            include_once('messagePanel.php');
        ?>
        <div class="row">
            <div class="col-sm-12">
                <!-- <form action="controller.php?controller=2&task=0" method="post">
                    <div class="row">
                        <div class="col-sm-12 bg_titulo">
                            <h5>DETALLE CLIENTE</h5>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">TIPO DOCUMENTO</span>
                                <select class="form-control" id="client_doc_type" name="client_doc_type">
                                    <option value="1">CEDULA</option>
                                    <option value="2">RUC</option>
                                    <option value="3">PASAPORTE</option>
                                  </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">NRO. DOCUMENTO</i></span>
                                <input type="text" id="client_ruc" name="client_ruc" class="form-control" placeholder="Ingresar nro documento">
                                <div class="errmsg" id="error_cust_id_num"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">NOMBRE</span>
                                <input type="text" id="client_name" name="client_name" class="form-control" placeholder="Ingresar nombre del cliente">
                                <div class="errmsg" id="error_client_name"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">TELEFONO / CELULAR</span>
                                <input type="text" id="client_phone" name="client_phone" class="form-control" placeholder="Ingresar contacto">
                                <div class="errmsg" id="error_client_phone"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">EMAIL</span>
                                <input type="text" id="client_email" name="client_email" class="form-control" placeholder="Ingresar email del cliente">
                                <div class="errmsg" id="error_client_email"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">DIRECCION</span>
                                <input type="text" id="client_address" name="client_address" class="form-control" placeholder="Ingresar direccion">
                                <div class="errmsg" id="error_client_address"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" id="addNewCustInVentas">AGREGAR</button>
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div class="btn-group">
                                <div id="addCustDocInVentas"></div>
                            </div>
                        </div>
                    </div>
                </form> -->
                <form action="controller.php?controller=6&task=0" method="post">
                    <div class="row">
                        <div class="col-sm-12 bg_titulo">
                            <h5>ORDEN</h5>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-sm-12 text-right">
                            <div class="btn-group">
                                <!-- <a href="#" data-toggle="modal" data-target="#buscarItem"><span class="glyphicon glyphicon-search icon_action glyphicon-pencil"></span></a> -->
                                <span class="glyphicon glyphicon-search icon_action" data-toggle="modal" data-target="#buscarItem"></span>
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                        <input type="hidden" id="id" name="id" class="form-control" value="0" placeholder="Ingresar codigo">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">COD. PRODUCTO</span>
                                <input type="text" id="item_id" name="item_id" class="form-control" placeholder="Ingresar codigo">
                                <div class="errmsg" id="error_item_id"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">CANTIDAD</span>
                                <input type="text" id="item_qty" name="item_qty" value="1" class="form-control" placeholder="Ingresar cantidad">
                                <div class="errmsg" id="error_item_qty"></div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-addon">CANTIDAD</span>
                                <input type="text" id="item_qty" name="item_qty" value="1" class="form-control" placeholder="Ingresar cantidad">
                                <div class="errmsg" id="error_item_qty"></div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="btn-group">
                                <a href="#" id="addItemForSale"><button type="button" class="btn btn-warning" style="margin:1px">AGREGAR</button></a>
                            </div>
                        </div> -->
                    </div>
                    <br>
                </form>
                <div id="basket" class="col-sm-12">
                    <!-- <form action="controller.php?controller=6&task=4" method="post">
                        <div class="row">
                            <div class="col-sm-12 bg_titulo">
                                <h5>DETALLE COMPRA - <?php echo $_SESSION["user_basket_id"];?></h5>
                            </div>
                        </div>
                        <br>
                        <?php
                        $basket = $controller->getBasket($databasecon,$_SESSION["user_basket_id"],$DEBUG_STATUS); 
                        if(count($basket)>0)
                            echo '<h4>'.count($basket).' REGISTROS ENCONTRADOS</h4>';
                        else
                            echo '<h4>0 REGISTROS ENCONTRADOS</h4>'
                        ?>
                        <div class="col-sm-12 table-responsive">          
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NOMBRE</th>
                                        <th>DESCRIPCION</th>
                                        <th class="td_right">CANTIDAD</th>
                                        <th class="td_right">COSTO DEL UNIDAD</th>
                                        <th class="td_right">IVA (%)</th>
                                        <th class="td_right">DESCUENTO (%)</th>
                                        <th class="td_right">SUB TOTAL</th>
                                        <th class="td_right">TOTAL IVA</th>
                                        <th class="td_right">TOTAL</th>
                                        <th class="td_right">ACCION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(count($basket)>0)
                                        {
                                            for($x=0;$x<count($basket);$x++)
                                            {
                                    ?>
                                    <tr>
                                        <td><?php echo $basket[$x][0];?></td>
                                        <td><?php echo $basket[$x][2];?></td>
                                        <td><?php echo $basket[$x][3];?></td>
                                        <td class="td_right"><?php echo $basket[$x][4];?></td>
                                        <td class="td_right"><?php echo number_format($basket[$x][5],2);?></td>
                                        <td class="td_right"><?php echo $basket[$x][6];?></td>
                                        <td class="td_right"><?php echo $basket[$x][7];?></td>
                                        <td class="td_right"><?php echo $basket[$x][8];?></td>
                                        <td class="td_right"><?php echo $basket[$x][9];?></td>
                                        <td class="td_right"><?php echo $basket[$x][10];?></td>
                                        <td class="td_right">
                                            <?php
                                            echo '<a href="#" onclick=habilitarEditItemEnVenta('.$basket[$x][0].',"'.$basket[$x][4].'",'.urlencode($basket[$x][1]).')><span class="glyphicon glyphicon-pencil icon_action"></span></a>';
                                            echo '<a href="#" onclick=delItemEnVenta('.$basket[$x][0].',"'.urlencode($basket[$x][2]).'",'.urlencode($basket[$x][1]).')><span class="glyphicon glyphicon-remove icon_action"></span></a>';
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        }
                                        $subtotal_12=0;
                                        $subtotal_0=0;
                                        $iva_total=0;
                                        $total=0;
                                        if(count($basket)>0)
                                        {
                                            for($x=0;$x<count($basket);$x++)
                                            {
                                                if($basket[$x][6]==0)
                                                {
                                                    $subtotal_0=$subtotal_0+$basket[$x][8];
                                                    $iva_total=$iva_total+0;
                                                    //$total=$total+$subtotal_0+$iva_total;
                                                }
                                                if($basket[$x][6]==12)
                                                {
                                                    $subtotal_12=$subtotal_12+$basket[$x][8];
                                                    $iva_total=$iva_total+$basket[$x][9];
                                                    //$total=$total+$subtotal_12+$iva_total;
                                                }
                                            }                                        
                                        }
                                        $total=$total+$subtotal_12+$subtotal_0+$iva_total;
                                        echo "<tr><td colspan=8 class=td_right>SUB TOTAL (12%):</td><td colspan=2 class=td_right>".number_format($subtotal_12,2)."</td><tr>";
                                        echo "<tr><td colspan=8 class=td_right>SUB TOTAL (0%):</td><td colspan=2 class=td_right>".number_format($subtotal_0,2)."</td><tr>";
                                        echo "<tr><td colspan=8 class=td_right>IVA TOTAL :</td><td colspan=2 class=td_right>".number_format($iva_total,2)."</td><tr>";
                                        echo "<tr><td colspan=8 class=td_right>TOTAL :</td><td colspan=2 class=td_right>".number_format($total,2)."</td><tr>";
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        

                         <div class="row">
                            <div class="col-sm-12 bg_titulo">
                                <h5>DETALLE PAGO</h5>
                            </div>
                        </div>
                        <br>
                        <input type="hidden" id="valor_factura" name="valor_factura" class="form-control" value="<?php echo number_format($total,2);?>">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon">TIPO PAGO</span>
                                    <select class="form-control" id="tipo_pago" name="tipo_pago">
                                        <option value="1">EFECTIVO</option>
                                        <option value="2">TARJETA DEBITO</option>
                                        <option value="3">TARJETA CREDITO</option>
                                        <option value="4">CHEQUE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon">VALOR RECIBIDO</span>
                                    <input type="text" id="valor_recibido" name="valor_recibido" class="form-control" placeholder="Ingresar Valor Recibido">
                                    <div class="errmsg" id="error_valor_recibido"></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon">VALOR CAMBIO</span>
                                    <input type="text" id="valor_cambio" name="valor_cambio" class="form-control" readonly="true" value="0">
                                    <div class="errmsg" id="error_valor_cambio"></div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary" id="btnConfirmSale">FINALIZAR</button>
                                </div>
                            </div>
                        </div>
                    </form> -->
                    <form action="controller.php?controller=6&task=4" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-11 bg_titulo">
                                        <h5>DETALLE COMPRA - <?php echo $_SESSION["user_basket_id"];?></h5>
                                    </div>
                                </div>
                                <br>
                                <!-- <?php
                                $basket = $controller->getBasket($databasecon,$_SESSION["user_basket_id"],$DEBUG_STATUS); 
                                if(count($basket)>0)
                                    echo '<h4>'.count($basket).' REGISTROS ENCONTRADOS</h4>';
                                else
                                    echo '<h4>0 REGISTROS ENCONTRADOS</h4>'
                                ?> -->
                                <div class="row">
                                    <div class="col-sm-11 table-responsive">          
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>NOMBRE</th>
                                                    <!-- <th>DESCRIPCION</th> -->
                                                    <th class="td_right">CANTIDAD</th>
                                                    <th class="td_right">COSTO DEL UNIDAD</th>
                                                    <!-- <th class="td_right">IVA (%)</th>
                                                    <th class="td_right">DESCUENTO (%)</th>
                                                    <th class="td_right">SUB TOTAL</th>
                                                    <th class="td_right">TOTAL IVA</th> -->
                                                    <th class="td_right">TOTAL</th>
                                                    <th class="td_right">ACCION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if(count($basket)>0)
                                                    {
                                                        for($x=0;$x<count($basket);$x++)
                                                        {
                                                ?>
                                                <tr>
                                                    <td><?php echo $basket[$x][0];?></td>
                                                    <td><?php echo $basket[$x][2];?></td>
                                                    <!-- <td><?php echo $basket[$x][3];?></td> -->
                                                    <td class="td_right"><?php echo $basket[$x][4];?></td>
                                                    <td class="td_right"><?php echo number_format($basket[$x][5],2);?></td>
                                                    <!-- <td class="td_right"><?php echo $basket[$x][6];?></td>
                                                    <td class="td_right"><?php echo $basket[$x][7];?></td>
                                                    <td class="td_right"><?php echo $basket[$x][8];?></td>
                                                    <td class="td_right"><?php echo $basket[$x][9];?></td> -->
                                                    <td class="td_right"><?php echo $basket[$x][10];?></td>
                                                    <td class="td_right">
                                                        <?php
                                                        echo '<a href="#" onclick=habilitarEditItemEnVenta('.$basket[$x][0].',"'.$basket[$x][4].'",'.urlencode($basket[$x][1]).')><span class="glyphicon glyphicon-pencil icon_action"></span></a>';
                                                        echo '<a href="#" onclick=delItemEnVenta('.$basket[$x][0].',"'.urlencode($basket[$x][2]).'",'.urlencode($basket[$x][1]).')><span class="glyphicon glyphicon-remove icon_action"></span></a>';
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                        }
                                                    }
                                                    $subtotal_12=0;
                                                    $subtotal_0=0;
                                                    $iva_total=0;
                                                    $total=0;
                                                    if(count($basket)>0)
                                                    {
                                                        for($x=0;$x<count($basket);$x++)
                                                        {
                                                            if($basket[$x][6]==0)
                                                            {
                                                                $subtotal_0=$subtotal_0+$basket[$x][8];
                                                                $iva_total=$iva_total+0;
                                                                //$total=$total+$subtotal_0+$iva_total;
                                                            }
                                                            if($basket[$x][6]==12)
                                                            {
                                                                $subtotal_12=$subtotal_12+$basket[$x][8];
                                                                $iva_total=$iva_total+$basket[$x][9];
                                                                //$total=$total+$subtotal_12+$iva_total;
                                                            }
                                                        }                                        
                                                    }
                                                    $total=$total+$subtotal_12+$subtotal_0+$iva_total;
                                                    echo "<tr><td colspan=3 class=td_right>SUB TOTAL (12%):</td><td colspan=2 class=td_right>".number_format($subtotal_12,2)."</td><tr>";
                                                    echo "<tr><td colspan=3 class=td_right>SUB TOTAL (0%):</td><td colspan=2 class=td_right>".number_format($subtotal_0,2)."</td><tr>";
                                                    echo "<tr><td colspan=3 class=td_right>IVA TOTAL :</td><td colspan=2 class=td_right>".number_format($iva_total,2)."</td><tr>";
                                                    echo "<tr><td colspan=3 class=td_right>TOTAL :</td><td colspan=2 class=td_right>".number_format($total,2)."</td><tr>";
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">


                                <form action="controller.php?controller=2&task=0" method="post">
                                    <div class="row">
                                        <div class="col-sm-12 bg_titulo">
                                            <h5>DETALLE CLIENTE</h5>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">TIPO DOCUMENTO</span>
                                                <select class="form-control" id="client_doc_type" name="client_doc_type">
                                                    <option value="1">CEDULA</option>
                                                    <option value="2">RUC</option>
                                                    <option value="3">PASAPORTE</option>
                                                  </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">NRO. DOCUMENTO</i></span>
                                                <input type="text" id="client_ruc" name="client_ruc" class="form-control" placeholder="Ingresar nro documento">
                                                <div class="errmsg" id="error_cust_id_num"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">NOMBRE</span>
                                                <input type="text" id="client_name" name="client_name" class="form-control" placeholder="Ingresar nombre del cliente">
                                                <div class="errmsg" id="error_client_name"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">TELEFONO / CELULAR</span>
                                                <input type="text" id="client_phone" name="client_phone" class="form-control" placeholder="Ingresar contacto">
                                                <div class="errmsg" id="error_client_phone"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">EMAIL</span>
                                                <input type="text" id="client_email" name="client_email" class="form-control" placeholder="Ingresar email del cliente">
                                                <div class="errmsg" id="error_client_email"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">DIRECCION</span>
                                                <input type="text" id="client_address" name="client_address" class="form-control" placeholder="Ingresar direccion">
                                                <div class="errmsg" id="error_client_address"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary" id="addNewCustInVentas">AGREGAR</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="btn-group">
                                                <div id="addCustDocInVentas"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>







                                <div class="row">
                                    <div class="col-sm-11 bg_titulo">
                                        <h5>DETALLE PAGO</h5>
                                    </div>
                                </div>
                                <br>                        
                                <div class="row">
                                    <!-- <input type="text" id="valor_factura" name="valor_factura" class="form-control" value="<?php echo number_format($total,2);?>"> -->
                                    <input type="hidden" id="valor_factura" name="valor_factura" class="form-control" value="<?php echo $total;?>">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">TIPO PAGO</span>
                                            <select class="form-control" id="tipo_pago" name="tipo_pago">
                                                <option value="1">EFECTIVO</option>
                                                <option value="2">TARJETA DEBITO</option>
                                                <option value="3">TARJETA CREDITO</option>
                                                <option value="4">CHEQUE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">VALOR RECIBIDO</span>
                                            <input type="text" id="valor_recibido" name="valor_recibido" class="form-control" placeholder="Ingresar Valor Recibido">
                                            <div class="errmsg" id="error_valor_recibido"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">VALOR CAMBIO</span>
                                            <input type="text" id="valor_cambio" name="valor_cambio" class="form-control" readonly="true" value="0">
                                            <div class="errmsg" id="error_valor_cambio"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary" id="btnConfirmSale">FINALIZAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                                <span class="input-group-addon">DESCRIPCION</span>
                                <input type="text" id="item_desc_busqueda" name="item_desc_busqueda" class="form-control" placeholder="Ingresar descripcion">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <span class="input-group-addon">BARCODE</span>
                                <input type="text" id="item_barcode" name="item_barcode" class="form-control" placeholder="Ingresar codiga barra">
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
                                <button type="button" class="btn btn-primary" id="btnBuscarItemsForVentas">BUSCAR</button>
                            </div><!-- 
                            <div class="btn-group">
                                <a href="#" data-toggle="modal" data-target="#buscarItem"><button type="button" class="btn btn-primary" id="btnOpenManageBusinessForm">BUSCAR</button></a>
                            </div> -->
                        </div>
                    </div>
                    <div class="row" id="dataItemsBusqueda">
                        
                    </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once('footer.php');
?>
