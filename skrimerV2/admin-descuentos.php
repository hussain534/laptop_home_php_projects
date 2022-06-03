<?php
include_once('util.php');
session_start();
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
            <h1>ADMINISTRACIÓN DE DESCUENTOS</h1>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form method="post">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">COD. PRODUCTO</span>
                                <input type="text" id="branch_name" name="branch_name" class="form-control" placeholder="Id del producto">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">NOM. PRODUCTO</span>
                                <input type="text" id="branch_name" name="branch_name" class="form-control" placeholder="Nombre del producto">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">CATEGORIA DEL PROD.</span>
                                <select class="form-control" id="user_perfil" name="user_perfil">
                                    <option>ELIGE CATEGORIA</option>
                                    <option>Categoria 01</option>
                                    <option>Categoria 02</option>
                                    <option>Categoria 03</option>
                                    <option>Categoria 04</option>
                                  </select>
                            </div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">DESCUENTO (%)</span>
                                <input type="text" id="branch_nro_emision" name="branch_nro_emision" class="form-control" placeholder="% de descuento">
                            </div>
                        </div>
                    </div>
                    <div class="row">  
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">FECHA INI. DESCUENTO</span>
                                <input type="date" id="branch_name" name="branch_name" class="form-control" title="Fecha inicio del descuento">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">FECHA FIN DESCUENTO</span>
                                <input type="date" id="branch_name" name="branch_name" class="form-control" title="Fecha fin del descuento">
                            </div>
                        </div>                      
                    </div>
                    
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary" id="btnOpenManageBusinessForm">ACTUALIZAR</button>
                            </div>
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary" id="btnOpenManageBusinessForm">BUSCAR</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="table-responsive">          
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NOMBRE</th>
                                    <th>CATEGORIA</th>
                                    <th>DESCUENTO</th>
                                    <th>DESDE</th>
                                    <th>HASTA</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>101</td>
                                    <td>BUPREX</td>
                                    <td>ANALGESICO</td>
                                    <td>15%</td>
                                    <td>12/DIC/2017</td>
                                    <td>31/DIC/2017</td>
                                    <td><i class="glyphicon glyphicon-pencil icon_action"></i><i class="glyphicon glyphicon-remove icon_action"></i></td>
                                </tr>
                                <tr>
                                    <td>102</td>
                                    <td>WEIR ALCOHOL</td>
                                    <td>ANTI - BACTERIAL</td>
                                    <td>5%</td>
                                    <td>15/DIC/2017</td>
                                    <td>21/DIC/2017</td>
                                    <td><i class="glyphicon glyphicon-pencil icon_action"></i><i class="glyphicon glyphicon-remove icon_action"></i></td>
                                </tr>
                                <tr>
                                    <td>103</td>
                                    <td>OTRO PRODUCTO</td>
                                    <td>ANALGESICO</td>
                                    <td>10%</td>
                                    <td>01/ENE/2018</td>
                                    <td>15/ENE/2018</td>
                                    <td><i class="glyphicon glyphicon-pencil icon_action"></i><i class="glyphicon glyphicon-remove icon_action"></i></td>
                                </tr>
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
