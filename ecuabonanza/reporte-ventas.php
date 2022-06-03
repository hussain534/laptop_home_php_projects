<?php
include_once('util.php');
include_once('portal-menu.php');
//session_start();
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
                <form method="post">
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">SUCURSAL</span>
                                <select class="form-control" id="user_perfil" name="user_perfil">
                                    <option>ELIGE SUCURSAL</option>
                                    <option>PUNTO EMISION 335</option>
                                    <option>PUNTO EMISION 336</option>
                                    <option>PUNTO EMISION 337</option>
                                  </select>
                            </div>
                        </div>  
                        <div class="col-sm-3">
                            <div class="input-group">
                                <span class="input-group-addon">DESDE</span>
                                <input type="date" id="branch_name" name="branch_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <span class="input-group-addon">HASTA</span>
                                <input type="date" id="branch_nro_emision" name="branch_nro_emision" class="form-control">
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
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="btn-group">
                                <img src="images/pdf-icon.png" style="width:10%" title="Exportar PDF"><img src="images/excel-icon.png" style="width:10%" title="Exportar EXCEL">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">          
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NOMBRE SUCURSAL</th>
                                    <th>NOMBRE</th>
                                    <th>DESCRIPCION</th>
                                    <th>CATEGORIA</th>
                                    <th class="td-aligh-right">CANTIDAD</th>
                                    <th class="td-aligh-right">COSTO DEL UNIDAD</th>
                                    <th class="td-aligh-right">IVA (%)</th>
                                    <th class="td-aligh-right">DESCUENTO (%)</th>
                                    <th class="td-aligh-right">SUB TOTAL</th>
                                    <th class="td-aligh-right">TOTAL IVA</th>
                                    <th class="td-aligh-right">TOTAL</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>101</td>
                                    <td>PUNTO EMISION 335</td>
                                    <td>BUPREX</td>
                                    <td>100 MG - 1*10</td>
                                    <td>ANALGESICO</td>
                                    <td class="td-aligh-right">5</td>
                                    <td class="td-aligh-right">1.50</td>
                                    <td class="td-aligh-right">12</td>
                                    <td class="td-aligh-right">10</td>
                                    <td class="td-aligh-right">6.03</td>
                                    <td class="td-aligh-right">0.70</td>
                                    <td class="td-aligh-right">6.73</td>
                                    <td><i class="glyphicon glyphicon-pencil icon_action"></i><i class="glyphicon glyphicon-remove icon_action"></i></td>
                                </tr>
                                <tr>
                                    <td>102</td>
                                    <td>PUNTO EMISION 336</td>
                                    <td>WEIR ALCOHOL</td>
                                    <td>250 ML - 1*1</td>
                                    <td>ANTI - BACTERIAL</td>
                                    <td class="td-aligh-right">4</td>
                                    <td class="td-aligh-right">3.20</td>
                                    <td class="td-aligh-right">0</td>
                                    <td class="td-aligh-right">0</td>
                                    <td class="td-aligh-right">12.80</td>
                                    <td class="td-aligh-right">0.00</td>
                                    <td class="td-aligh-right">12.80</td>
                                    <td><i class="glyphicon glyphicon-pencil icon_action"></i><i class="glyphicon glyphicon-remove icon_action"></i></td>
                                </tr>
                                <tr>
                                    <td>103</td>
                                    <td>PUNTO EMISION 337</td>
                                    <td>OTRO PRODUCTO</td>
                                    <td>500 MG - 1*3</td>
                                    <td>ANALGESICO</td>
                                    <td class="td-aligh-right">8</td>
                                    <td class="td-aligh-right">12.85</td>
                                    <td class="td-aligh-right">12</td>
                                    <td class="td-aligh-right">5</td>
                                    <td class="td-aligh-right">87.20</td>
                                    <td class="td-aligh-right">10.48</td>
                                    <td class="td-aligh-right">97.68</td>
                                    <td><i class="glyphicon glyphicon-pencil icon_action"></i><i class="glyphicon glyphicon-remove icon_action"></i></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="td-aligh-right"><b>SUBTOTAL</b></td>
                                    <td class="td-aligh-right">106.03</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="td-aligh-right"><b>SUBTOTAL IVA(12%)</b></td>
                                    <td class="td-aligh-right">11.18</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="td-aligh-right"><b>TOTAL A PAGAR</b></td>
                                    <td class="td-aligh-right">117.21</td>
                                </tr>
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
