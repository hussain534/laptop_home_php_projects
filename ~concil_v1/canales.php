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

    //$integrador=$_GET["integrador"];
    if(isset($_GET["id"]))
        $iid=$_GET["id"];
    else
        $iid=0;

    $canales = $controladorDB->listaCanales($databasecon,$iid,$DEBUG_STATUS);

    if(isset($_GET["cid"]))
    {
        $canales_edit_data = $controladorDB->listaCanalPorId($databasecon,$_GET["cid"],$DEBUG_STATUS);
        $cid=$canales_edit_data[0][0];
        $nombre=$canales_edit_data[0][1];
        $email=$canales_edit_data[0][2];
        $contacto=$canales_edit_data[0][3];
    }
    else
    {
        $cid=0;
        $nombre='';
        $email='';
        $contacto='';
    }

    
    

?>
<div class="container">    
    <?php
    include_once('sessionData.php');
    ?>
    <br>
    <div class="row pageTitle">
        <div class="col-sm-12">
            CANALES
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
            <form method="post" action="controladorProceso.php?proceso=2&task=0">
                <div class="row">
                    <div class="col-sm-6">
                        <input type="hidden" id="cid" name ="cid" value=<?php echo $cid;?> /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>INTEGRADOR</label>
                        <!-- <input type="RUC" class="form-control navbar-btn" id="integrador" name="integrador" value="<?php echo $integrador;?>" readonly="true"> -->

                        <select name="iid" class="form-control navbar-btn" id="iid" required>
                            <?php 
                                $lista_integrador = $controladorDB->listaProveedores($databasecon,0,$DEBUG_STATUS);
                                for($i=0;$i<count($lista_integrador);$i++)
                                {
                                    if($iid==$lista_integrador[$i][0])
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
                                }                                                            
                                if($iid==0)
                                {
                            ?>
                                <option value="0" selected="true">SELECIONAR INTEGRADOR</option>
                            <?php        
                                }
                                else
                                {
                            ?>
                                <option value="0">SELECIONAR INTEGRADOR</option>
                            <?php        
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>NOMBRE CANAL</label>
                        <input type="nombre" class="form-control navbar-btn" id="nombre" placeholder="Ingresar Nombre del canal" name="nombre" value="<?php echo $nombre;?>"required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>EMAIL</label>
                        <input type="email" class="form-control navbar-btn" id="email" placeholder="Ingresar Email del canal" name="email" value="<?php echo $email;?>"required>
                    </div>
                    <div class="col-sm-6">
                        <label>CONTACTO</label>
                        <input type="contacto" class="form-control navbar-btn" id="contacto" placeholder="Ingresar Nro Contacto del canal" name="contacto" value="<?php echo $contacto;?>"required>
                    </div>
                </div>
                <div class="row text-center">
                    <?php
                        if($cid==0)
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
        
        if(isset($canales))
            echo '<h5>Encontrado '.count($canales).' canales</h5>'
    ?>
    
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>ID</td>
                            <td>INTEGRADOR</td>
                            <td>NOMBRE CANAL</td>
                            <td>EMAIL CANAL</td>
                            <td>NRO CONTACTO CANAL</td>
                            <td>ACCION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($canales);$x++)
                {
            ?>
                        <tr class="table-body">
                            <td><?php echo $canales[$x][0];?></td>
                            <td><?php echo $canales[$x][4];?></td> 
                            <td><?php echo $canales[$x][1];?></td>
                            <td><?php echo $canales[$x][2];?></td>
                            <td><?php echo $canales[$x][3];?></td>
                            <td>
                                <a href="canales.php?cid=<?php echo $canales[$x][0];?>&id=<?php echo $canales[$x][5];?>"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <a href="controladorProceso.php?proceso=2&task=1&id=<?php echo $canales[$x][0];?>"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
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