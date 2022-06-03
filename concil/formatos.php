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

    

    <?php
        
        if(isset($formatos))
            echo '<h5>Encontrado '.count($formatos).' componentes</h5>'
    ?>
    
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>ID</td>
                            <td>DESCRIPCION DEL CAMPO</td>
                            <td>TIPO DE DATO</td>
                            <td>POSICION</td>
                            <td>TAMANO</td>
                            <td>MANDATORIO</td>
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
                                </tr>
                            
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            
    <br>
</div>