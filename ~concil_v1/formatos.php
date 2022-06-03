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

    if(isset($_GET["pid"]))
    {
        $formatos = $controladorDB->getArchivoConcilFormatos($databasecon,$_GET["pid"],$DEBUG_STATUS);
        $id=$formatos[0][0];
        $ruc=$formatos[0][3];
        $nombre=$formatos[0][1];
        $email=$formatos[0][2];
        $contacto=$formatos[0][4];
    }
    else
    {
        $id=0;
        $ruc='';
        $nombre='';
        $email='';
        $contacto='';
    }

    $formatos = $controladorDB->getArchivoConcilFormatos($databasecon,$DEBUG_STATUS);
    

?>
<div class="container">    
    <?php
    include_once('sessionData.php');
    ?>
    <br>
    <div class="row pageTitle">
        <div class="col-sm-12">
            FORMATO ARCHIVO CONCILIACION
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

    <!-- <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <form method="post" action="controladorProceso.php?proceso=1&task=0">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="id" name ="id" value=<?php echo $id;?> /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>NOMBRE DATA</label>
                        <input type="RUC" class="form-control navbar-btn" id="ruc" name="ruc" placeholder="NOMBRE DATA" value="" readonly="true">
                    </div>
                    <div class="col-sm-6">
                        <label>TIPO DATA</label>
                        <select name="userPerfil" class="form-control navbar-btn" id="perfil" required>
                            <option value="1">INTEGER</option>
                            <option value="2">VARCHAR</option>
                            <option value="3">DECIMAL</option>
                            <option value="4">DATE</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>POSICION</label>
                        <input type="email" class="form-control navbar-btn" id="email" placeholder="POSICION" name="email" value=""required>
                    </div>
                    <div class="col-sm-6">
                        <label>TAMANO</label>
                        <input type="contacto" class="form-control navbar-btn" id="contacto" placeholder="TAMANO" name="contacto" value=""required>
                    </div>
                </div>
                <div class="row text-center">
                    <?php
                        if($id==0)
                        {
                    ?>
                        <button type="submit" class="btn btn-info" title="Click to enter our portal">AGREGAR<span class="glyphicon glyphicon-chevron-right"></span>
                    <?php
                        }
                        else
                        {
                    ?>
                        <button type="submit" class="btn btn-info" title="Click to enter our portal">ACTUALIZAR<span class="glyphicon glyphicon-chevron-right"></span>
                    <?php

                        }
                    ?>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <br> -->

    <?php
        
        if(isset($formatos))
            echo '<h5>Encontrado '.count($formatos).' componentes</h5>'
    ?>
    
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>ID</td>
                            <td>NOMBRE DATA</td>
                            <td>TIPO DATA</td>
                            <td>POSICION</td>
                            <td>TAMANO</td>
                            <td>MANDATORIO</td>
                            <!-- <td>ACCION</td> -->
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($formatos);$x++)
                {
            ?>
                        <tr class="table-body">
                            <td><?php echo $formatos[$x][0];?></td>
                            <td><?php echo $formatos[$x][1];?></td> 
                            <td><?php echo $formatos[$x][2];?></td>
                            <td><?php echo $formatos[$x][3];?></td>
                            <td><?php echo $formatos[$x][4];?></td>
                            <td><?php echo $formatos[$x][5];?></td>
                            <!-- <td>
                                <a href="proveedores.php?pid=<?php echo $proveedores[$x][0];?>"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <a href="controladorProceso.php?proceso=1&task=1&id=<?php echo $proveedores[$x][0];?>"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
                            </td> -->
                        </tr>
                    
            <?php
                }
            ?>
                        <!-- <tr class="table-body">
                            <td>1</td>
                            <td>TIPO_REGISTRO</td> 
                            <td>VARCHAR</td>
                            <td>1</td>
                            <td>1</td>
                            <td>
                                <a href="#"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <a href="#"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
                            </td>
                        </tr>
                        <tr class="table-body">
                            <td>2</td>
                            <td>TRAN_ID_EXTERNO</td> 
                            <td>INTEGER</td>
                            <td>2</td>
                            <td>20</td>
                            <td>
                                <a href="#"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <a href="#"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
                            </td>
                        </tr>
                        <tr class="table-body">
                            <td>3</td>
                            <td>ID_INTEGRADOR</td> 
                            <td>INTEGER</td>
                            <td>3</td>
                            <td>4</td>
                            <td>
                                <a href="#"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <a href="#"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
                            </td>
                        </tr>
                        <tr class="table-body">
                            <td>4</td>
                            <td>ID_CANAL</td> 
                            <td>INTEGER</td>
                            <td>4</td>
                            <td>4</td>
                            <td>
                                <a href="#"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <a href="#"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
                            </td>
                        </tr>
                        <tr class="table-body">
                            <td>5</td>
                            <td>ID_PLAN</td> 
                            <td>ALPHANUMERIC</td>
                            <td>5</td>
                            <td>15</td>
                            <td>
                                <a href="#"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <a href="#"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
                            </td>
                        </tr>
                        <tr class="table-body">
                            <td>6</td>
                            <td>MONTO_VENTA</td> 
                            <td>DECIMAL</td>
                            <td>6</td>
                            <td>10</td>
                            <td>
                                <a href="#"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <a href="#"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
                            </td>
                        </tr>
                        <tr class="table-body">
                            <td>7</td>
                            <td>FECHA HORA VENTA</td> 
                            <td>VARCHAR</td>
                            <td>7</td>
                            <td>14</td>
                            <td>
                                <a href="#"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <a href="#"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
            
    <br>
</div>