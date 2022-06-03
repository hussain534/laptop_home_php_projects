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
    /*include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'controladorDB.php';
    $controladorDB = new controladorDB();*/
    $dbTable='preguntas';
    if(isset($_GET["pid"]) && isset($_GET["sid"]))
    {
        $data = $controladorDB->obtenerPreguntas($databasecon,$_GET["pid"],$_GET["sid"],$dbTable,$DEBUG_STATUS);
        $id=$data[0][0];
        $id_session=$data[0][1];
        $nombre=$data[0][2];
    }
    else if(isset($_SESSION["ID_SECCION"]))
    {
        $id_session=$_SESSION["ID_SECCION"];
        $data = $controladorDB->obtenerPreguntas($databasecon,0,$_SESSION["ID_SECCION"],$dbTable,$DEBUG_STATUS);
        $id=0;
        //$id_session=$data[0][1];
        $nombre="";
        unset($_SESSION["ID_SECCION"]);
    }
    else
    {
        $id=0;
        $id_session=0;
        $nombre='';
        $data = $controladorDB->obtenerPreguntas($databasecon,0,0,$dbTable,$DEBUG_STATUS);
    }
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
            GESTIÓN DE PREGUNTAS
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
            <form method="post" action="controladorProceso.php?proceso=7&task=2">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="id" name ="id" value=<?php echo $id;?> /> 
                        <input type="hidden" id="dbTable" name ="dbTable" value=<?php echo $dbTable;?> /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3">
                        <label>SECCIÓN</label>
                        <select name="seccion" class="form-control navbar-btn" id="idseccion"  onChange="selectSeccion()" required>
                            <option value="0">ESCOGER SECCIÓN</option>
                            <?php 
                                $dbTable='seccion';
                                $seccion = $controladorDB->obtenerData($databasecon,0,$dbTable,$DEBUG_STATUS);
                                for($i=0;$i<count($seccion);$i++)
                                {
                                    if($id_session==$seccion[$i][0])
                                    {
                                        ?>
                                            <option value=<?php echo $seccion[$i][0];?> selected="true"><?php echo '['.$seccion[$i][0].']:'.$seccion[$i][1];?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value=<?php echo $seccion[$i][0];?>><?php echo '['.$seccion[$i][0].']:'.$seccion[$i][1];?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-7">
                        <label>PREGUNTA</label>
                        <input type="nombre" class="form-control navbar-btn" id="nombre" placeholder="PREGUNTA" name="nombre" value="<?php echo $nombre;?>"required>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row text-center">
                    <button type="submit" class="btn btn-info" title="Click to enter our portal">ACTUALIZAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                    <a href="preguntas.php"><button type="button" class="btn btn-info" >LIMPIAR<span class="glyphicon glyphicon-chevron-right"></span></button></a>
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
                            <td>#FILA</td>
                            <td>SECCION</td>
                            <td>PREGUNTAS</td>
                            <td>ACCION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
            $dbTable='preguntas';
                for($x=0;$x<count($data);$x++)
                {
            ?>
                        <tr class="table-body">
                            <!-- <td><?php echo $data[$x][0];?></td> --> 
                            <td><?php echo $x;?></td>
                            <td><?php echo $data[$x][3];?></td> 
                            <td><?php echo $data[$x][2];?></td>
                            <td>
                                <a href="preguntas.php?pid=<?php echo $data[$x][0];?>&sid=<?php echo $data[$x][1];?>"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
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