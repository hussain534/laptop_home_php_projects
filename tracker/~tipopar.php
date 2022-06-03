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
    $dbTable='tipopar';
    if(isset($_GET["pid"]))
    {
        $data = $controladorDB->obtenerData($databasecon,$_GET["pid"],$dbTable,$DEBUG_STATUS);
        $id=$data[0][0];
        $nombre=$data[0][1];
    }
    else
    {
        $id=0;
        $nombre='';
    }
    $data = $controladorDB->obtenerData($databasecon,0,$dbTable,$DEBUG_STATUS);
    //echo 'count::'.count($permisos);
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
    <div class="row pageTitle">
        <div class="col-sm-12">
            TIPO PAR
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
                        <input type="hidden" id="dbTable" name ="dbTable" value=<?php echo $dbTable;?> /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <label>TIPO PAR</label>
                        <input type="nombre" class="form-control navbar-btn" id="nombre" placeholder="NOMBRE" name="nombre" value="<?php echo $nombre;?>"required>
                    </div>
                    <div class="col-sm-4"></div>
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
        if(isset($data))
        {
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>ID</td>
                            <td>TIPO PAR</td>
                            <td>ACCION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($data);$x++)
                {
            ?>
                        <tr class="table-body">
                            <td><?php echo $data[$x][0];?></td> 
                            <td><?php echo $data[$x][1];?></td>
                            <td>
                                <a href="tipopar.php?pid=<?php echo $data[$x][0];?>"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <a href="controladorProceso.php?proceso=7&task=1&id=<?php echo $data[$x][0];?>&tid=<?php echo $dbTable;?>"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
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