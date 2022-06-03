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

    if(isset($_GET["err"]))
        $err=$_GET["err"];
    else 
        $err=99;

    if($err==0)
    {
        $msg= "Error en cambiar clave. Intente mas tarde";
    }
    else if($err==1)
    {
        $msg= "Clave actualizado correctamente";
    }
    else if($err==3)
    {
        $msg= "Clave actual incorrecto.";
    }
    

?>
<div class="container">    
    <?php
    include_once('sessionData.php');
    ?>
    <br>
    <div class="row pageTitle">
        <div class="col-sm-12">
            CAMBIAR CLAVE
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
            <form method="post" action="controladorProceso.php?proceso=0&task=3">
                <div class="row">
                    <div class="col-sm-6">
                        <label>CLAVE ACTUAL</label>
                        <input type="RUC" class="form-control navbar-btn" id="clave_anterior" placeholder="CLAVE ACTUAL" name="clave_anterior" value=""required>
                    </div>
                    <div class="col-sm-6">
                        <label>NUEVA CLAVE</label>
                        <input type="nombre" class="form-control navbar-btn" id="clave_nuevo" placeholder="NUEVA CLAVE" name="clave_nuevo" value=""required>
                    </div>
                </div>
                <div class="row text-center">
                    <button type="submit" class="btn btn-info" title="Click to enter our portal">ACTUALIZAR<span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <br>

    <?php
        
        if(isset($proveedores))
            echo '<h5>Encontrado '.count($proveedores).' proveedores</h5>'
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
                            <td>
                                <a href="proveedores.php?pid=<?php echo $proveedores[$x][0];?>"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <a href="controladorProceso.php?proceso=1&task=1&id=<?php echo $proveedores[$x][0];?>"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
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