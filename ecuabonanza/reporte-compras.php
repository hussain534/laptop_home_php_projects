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
            <h1>REPORTE COMPRAS</h1>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form method="post">
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">PROVEEDOR</span>
                                <select class="form-control" id="user_perfil" name="user_perfil">
                                    <option>ELIGE PROVEEDOR</option>
                                    <option>DISTRIBUIDOR 158 LTDA</option>
                                    <option>DISTRIBUIDOR 2</option>
                                    <option>DISTRIBUIDOR 3</option>
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
                                <input type="text" id="branch_nro_emision" name="branch_nro_emision" class="form-control" placeholder="Ingresar descripcion del producto">
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
                                    <th>NOMBRE</th>
                                    <th>DESCRIPCION</th>
                                    <th>CATEGORIA</th>
                                    <th>CANTIDAD ACTUAL</th>
                                    <th>COSTO DEL UNIDAD</th>
                                    <th>IVA (%)</th>
                                    <th>PROVEEDOR</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>101</td>
                                    <td>BUPREX</td>
                                    <td>100 MG - 1*10</td>
                                    <td>ANALGESICO</td>
                                    <td>50</td>
                                    <td>1.50</td>
                                    <td>12</td>
                                    <td>PROVEEDOR XYZ</td>
                                    <td><i class="glyphicon glyphicon-pencil icon_action"></i><i class="glyphicon glyphicon-remove icon_action"></i></td>
                                </tr>
                                <tr>
                                    <td>102</td>
                                    <td>WEIR ALCOHOL</td>
                                    <td>250 ML - 1*1</td>
                                    <td>ANTI - BACTERIAL</td>
                                    <td>42</td>
                                    <td>3.20</td>
                                    <td>0</td>
                                    <td>PROVEEDOR PEPITO</td>
                                    <td><i class="glyphicon glyphicon-pencil icon_action"></i><i class="glyphicon glyphicon-remove icon_action"></i></td>
                                </tr>
                                <tr>
                                    <td>103</td>
                                    <td>OTRO PRODUCTO</td>
                                    <td>500 MG - 1*3</td>
                                    <td>ANALGESICO</td>
                                    <td>85</td>
                                    <td>12.85</td>
                                    <td>12</td>
                                    <td>PROVEEDOR XYZ</td>
                                    <td><i class="glyphicon glyphicon-pencil icon_action"></i><i class="glyphicon glyphicon-remove icon_action"></i></td>
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
