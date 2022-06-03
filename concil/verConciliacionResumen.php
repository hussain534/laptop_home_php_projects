<?php
    session_start();

    if(!isset($_SESSION['LAST_ACTIVITY']))
    {
        session_destroy();
        $url='index.php?err=98';
        header("Location:$url");
    }
    include_once('util.php');
    include_once('header.php');
    
    if(isset($_SESSION["message"]))
    {
        $msg=$_SESSION["message"];
        unset($_SESSION["message"]);
    }

    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'controladorDB.php';
    $controladorDB = new controladorDB();

    if(isset($_POST["submitted"]))
        $arrConciliacion = $controladorDB->consultarConciliacionResumen($databasecon,$_POST["id_integrador"],$_POST["estado"],$_POST["fecha_inicio"],$_POST["fecha_final"],$DEBUG_STATUS);
    else
        $arrConciliacion = $controladorDB->consultarConciliacionResumen($databasecon,0,99,'2999-12-31','2999-12-31',$DEBUG_STATUS);
    //$proveedores = $controladorDB->listaProveedores($databasecon,0,$DEBUG_STATUS);
    

?>
<style type="text/css">
    body
    {
        background-image: none !important;
    }
</style>
<div class="container">    
    <?php
    include_once('sessionData.php');
    ?>
    <br>
    <div class="row pageTitle">
        <div class="col-sm-12">
            RESUMEN CONCILIACION
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center">
            <?php
            if(isset($msg))
            {
            ?>
            <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $msg;?>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="col-sm-3"></div>
    </div>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <form method="post" action="verConciliacionResumen.php">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" value="true" name="submitted" /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        CONSULTAR DATOS DE CONCILIACION
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>INTEGRADOR</label>
                        <select name="id_integrador" class="form-control navbar-btn" id="id_integrador" required>
                            <?php 
                                $lista_integrador = $controladorDB->listaProveedores($databasecon,0,$DEBUG_STATUS);
                                for($i=0;$i<count($lista_integrador);$i++)
                                {
                            ?>
                                    <option value=<?php echo $lista_integrador[$i][0];?>><?php echo $lista_integrador[$i][1];?></option>
                            <?php        
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label>ESTADO CONCILIACION</label>
                        <select name="estado" class="form-control navbar-btn" id="estado" required>
                            <option value="99">TODO</option>
                            <option value="1">PENDIENTE</option>                            
                            <option value="3">CONCILIADO</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label>FECHA INICIO VENTA</label>
                        <input type="date" class="form-control navbar-btn" id="fecha_inicio" placeholder="CLAVE" name="fecha_inicio" value=""required>
                    </div>
                    <div class="col-sm-3">
                        <label>FECHA FIN VENTA</label>
                        <input type="date" class="form-control navbar-btn" id="fecha_final" placeholder="CLAVE" name="fecha_final" value=""required>
                    </div>
                </div>
                <div class="row text-center" style="padding:0px 0px">
                    <div class="col-sm-12">
                    <button type="submit" class="btn btn-info" title="Click to enter our portal">CONSULTAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                    
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <br>

    <?php
        
        if(isset($arrConciliacion))
            echo '<h5>Encontrado '.count($arrConciliacion).' Registro/s</h5>'
    ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>ID_CONCILIACION</td>
                            <td>INTEGRADOR</td>
                            <td>MONTO_CONCILIADO</td>
                            <td>CANTIDAD REGISTROS</td>
                            <td>FECHA_VENTA</td>
                            <td>FECHA_CONCILIACION</td>
                            <td>ESTADO CONCILIACION</td>
                            <td>ACCION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($arrConciliacion);$x++)
                {
            ?>
                        <tr class="table-body">
                            <td><?php echo $arrConciliacion[$x][0];?></td>
                            <td><?php echo $arrConciliacion[$x][1];?></td> 
                            <td><?php echo $arrConciliacion[$x][2];?></td>
                            <td><?php echo $arrConciliacion[$x][3];?></td>
                            <td><?php echo $arrConciliacion[$x][4];?></td>
                            <td><?php echo $arrConciliacion[$x][5];?></td>
                            <td><?php echo $arrConciliacion[$x][6];?></td>
                            <td><a href="verConciliacionHistory.php?id=<?php echo $arrConciliacion[$x][7];?>&fecha_venta=<?php echo $arrConciliacion[$x][4];?>"><span class="glyphicon glyphicon-th-list" style="font-size:x-large;color:grey;"></span>VER DETALLES</a></td>
                        </tr>
                    
            <?php
                }
            ?>
                        <!-- <tr class="table-body">
                            <td>1009</td>
                            <td>BUSINESSWISE</td>
                            <td>150</td> 
                            <td>21052018</td>
                            <td>22052018</td>
                            <td>EXITOSO</td>
                            <td><a href="verConciliacionHistory.php"><span class="glyphicon glyphicon-th-list" style="font-size:x-large;color:grey;"></span>VER DETALLES</a></td>
                        </tr>
                        <tr class="table-body">
                            <td></td>
                            <td>BUSINESSWISE</td>
                            <td>150</td> 
                            <td>22052018</td>
                            <td></td>
                            <td>PENDIENTE</td>
                            <td><a href="verConciliacionHistory.php"><span class="glyphicon glyphicon-th-list" style="font-size:x-large;color:grey;"></span>VER DETALLES</a></td>
                        </tr>
                        <tr class="table-body">
                            <td>1010</td>
                            <td>BUSINESSWISE</td>
                            <td>120</td> 
                            <td>23052018</td>
                            <td>24052018</td>
                            <td>ERROR</td>
                            <td><a href="verConciliacionHistory.php"><span class="glyphicon glyphicon-th-list" style="font-size:x-large;color:grey;"></span>VER DETALLES</a></td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
</div>