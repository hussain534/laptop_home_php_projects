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
        $proveedores = $controladorDB->listaProveedores($databasecon,$_GET["pid"],$DEBUG_STATUS);
        $id=$proveedores[0][0];
        $ruc=$proveedores[0][3];
        $nombre=$proveedores[0][1];
        $email=$proveedores[0][2];
        $contacto=$proveedores[0][4];
        $emailAdicionales=$proveedores[0][5];
    }
    else
    {
        $id=0;
        $ruc='';
        $nombre='';
        $email='';
        $contacto='';
        $emailAdicionales='';
    }

    $proveedores = $controladorDB->listaProveedores($databasecon,0,$DEBUG_STATUS);
    
?>
<div class="container">    
    <?php
    include_once('sessionData.php');
    ?>
    <br>
    <div class="row pageTitle">
        <div class="col-sm-12">
            INTEGRADORES
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
            <form method="post" action="controladorProceso.php?proceso=1&task=0">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="id" name ="id" value=<?php echo $id;?> /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>RUC</label>
                        <input type="RUC" class="form-control navbar-btn" id="ruc" placeholder="RUC" name="ruc" value="<?php echo $ruc;?>"required>
                    </div>
                    <div class="col-sm-6">
                        <label>NOMBRE</label>
                        <input type="nombre" class="form-control navbar-btn" id="nombre" placeholder="Nombre" name="nombre" value="<?php echo $nombre;?>"required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>EMAIL DE LOS RESPONSABLES DEL INTEGRADOR(separado con ,)</label>
                        <input type="text" class="form-control navbar-btn" id="email" placeholder="Email" name="email" value="<?php echo $email;?>"required>
                    </div>
                    <div class="col-sm-6">
                        <label>CONTACTO</label>
                        <input type="contacto" class="form-control navbar-btn" id="contacto" placeholder="Nro Contacto" name="contacto" value="<?php echo $contacto;?>"required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label>EMAIL DE LOS RESPONSABLES DEL ETAPA(separado con ,)</label>
                        <input type="text" class="form-control navbar-btn" id="emailAdicionales" placeholder="Email" name="emailAdicionales" value="<?php echo $emailAdicionales;?>"required>
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
        
        if(isset($proveedores))
            echo '<h5>Encontrado '.count($proveedores).' integradores</h5>'
    ?>
    
    <?php
        if(isset($proveedores))
        {
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>ID</td>
                            <td>RUC</td>
                            <td>NOMBRE</td>
                            <td>EMAIL</td>
                            <td>NRO CONTACTO</td>
                            <td>EMAILS DE ETAPA</td>
                            <td>ACCION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($proveedores);$x++)
                {
            ?>
                        <tr class="table-body">
                            <td><?php echo $proveedores[$x][0];?></td>
                            <td><?php echo $proveedores[$x][3];?></td> 
                            <td><?php echo $proveedores[$x][1];?></td>
                            <td><?php echo $proveedores[$x][2];?></td>
                            <td><?php echo $proveedores[$x][4];?></td>
                            <td><?php echo $proveedores[$x][5];?></td>
                            <td>
                                <a href="proveedores.php?pid=<?php echo $proveedores[$x][0];?>"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <a href="controladorProceso.php?proceso=1&task=1&id=<?php echo $proveedores[$x][0];?>"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
                                <a href="canales.php?id=<?php echo $proveedores[$x][0];?>"><span class="glyphicon glyphicon-record" style="font-size:x-large;color:green;"></span></a>
                            </td>
                        </tr>
                    
            <?php
                }
            ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
    ?>
    <br>
</div>