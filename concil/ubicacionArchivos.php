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

    if(isset($_GET["uid"]))
    {
        $file_server_data = $controladorDB->listaFileServerData($databasecon,$_GET["uid"],$DEBUG_STATUS);
        $id=$file_server_data[0][0];
        $nombre_proveedor=$file_server_data[0][1];
        $id_integrador=$file_server_data[0][2];
        $ip_servidor=$file_server_data[0][3];
        $ruta=$file_server_data[0][4];
        $usuario=$file_server_data[0][5];
        $clave=$file_server_data[0][6];
        $intervalo=$file_server_data[0][8];
    }
    else
    {
        $id=0;
        $nombre_proveedor='';
        $id_integrador=0;
        $ip_servidor='';
        $ruta='';
        $usuario='';
        $clave='';
        $intervalo=60;
    }

    $file_server_data = $controladorDB->listaFileServerData($databasecon,0,$DEBUG_STATUS);
    

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
            CONFIGURACION PARÁMETROS DE CARGA DE ARCHIVOS - INTEGRADORES
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
            <form method="post" action="controladorProceso.php?proceso=7&task=0">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="id" name ="id" value=<?php echo $id;?> /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>INTEGRADOR</label>
                        <select name="id_integrador" class="form-control navbar-btn" id="id_integrador" required>
                            <?php 
                                $lista_integrador = $controladorDB->listaProveedores($databasecon,0,$DEBUG_STATUS);
                                for($i=0;$i<count($lista_integrador);$i++)
                                {
                                    if($id_integrador==$lista_integrador[$i][0])
                                    {
                            ?>
                                        <option value=<?php echo $lista_integrador[$i][0];?> selected="true"><?php echo $lista_integrador[$i][1];?></option>
                            <?php
                                    }
                                    else
                                    {
                            ?>
                                        <option value=<?php echo $lista_integrador[$i][0];?>><?php echo $lista_integrador[$i][1];?></option>
                            <?php
                                    }
                            ?>
                                    
                            <?php        
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>IP SERVIDOR</label>
                        <input type="text" class="form-control navbar-btn" id="ip_servidor" name="ip_servidor" placeholder="IP SERVIDOR" value="<?php echo $ip_servidor;?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>RUTA DEL ARCHIVO</label>
                        <input type="text" class="form-control navbar-btn" id="ruta" name="ruta" placeholder="RUTA DEL ARCHIVO" value="<?php echo $ruta;?>" required="true">
                    </div>
                    <div class="col-sm-6">
                        <label>INTERVALO(MIN)</label>
                        <select name="intervalo" class="form-control navbar-btn" id="intervalo" required>
                            <?php 
                                $intervalos = $controladorDB->listaAutoConcilIntervalos($databasecon,$DEBUG_STATUS);
                                for($i=0;$i<count($intervalos);$i++)
                                {
                                    if($intervalo==$intervalos[$i][0])
                                    {
                            ?>
                                        <option value=<?php echo $intervalos[$i][0];?> selected="true"><?php echo $intervalos[$i][1];?></option>
                            <?php
                                    }
                                    else
                                    {
                            ?>
                                        <option value=<?php echo $intervalos[$i][0];?>><?php echo $intervalos[$i][1];?></option>
                            <?php
                                    }
                            ?>
                                    
                            <?php        
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>USUARIO</label>
                        <input type="text" class="form-control navbar-btn" id="usuario" placeholder="USUARIO" name="usuario" value="<?php echo $usuario;?>" required="true">
                    </div>
                    <div class="col-sm-6">
                        <label>CLAVE</label>
                        <input type="password" class="form-control navbar-btn" id="clave" placeholder="CLAVE" name="clave" value="<?php echo $clave;?>" required="true" >
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
    <br>

    <?php
        
        if(isset($file_server_data))
            echo '<h5>Encontrado 2 canales</h5>'
    ?>
    
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>ID</td>
                            <td>NOMBRE INTEGRADOR</td>
                            <td>IP SERVIDOR</td>
                            <td>RUTA</td>
                            <!-- <td>NOMBRE</td> -->
                            <td>USUARIO</td>
                            <!-- <td>CLAVE</td> -->
                            <td>INTERVALO</td>
                            <td>ACCION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($file_server_data);$x++)
                {
            ?>
                        <tr class="table-body">
                            <td><?php echo $file_server_data[$x][0];?></td>
                            <td><?php echo $file_server_data[$x][1];?></td> 
                            <td><?php echo $file_server_data[$x][3];?></td>
                            <td><?php echo $file_server_data[$x][4];?></td>
                            <td><?php echo $file_server_data[$x][5];?></td>
                            <!-- <td><?php echo $file_server_data[$x][6];?></td> -->
                            <td><?php echo $file_server_data[$x][7];?></td>
                            <td>
                                <a href="ubicacionArchivos.php?uid=<?php echo $file_server_data[$x][0];?>"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <a href="controladorProceso.php?proceso=7&task=1&id=<?php echo $file_server_data[$x][0];?>"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
                            </td>
                        </tr>
                    
            <?php
                }
            ?>
                    </tbody>
                </table>
            </div>
            
    <br>
</div>