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

    if(isset($_SESSION["ID_TIPOEVALUACION"]))
        $idTipoEvaluacion=$_SESSION["ID_TIPOEVALUACION"];
    else
        $idTipoEvaluacion=0;
    if(isset($_SESSION["ID_SECCION"]))
        $idSeccion=$_SESSION["ID_SECCION"];
    else
        $idSeccion=0;

    if(isset($_GET["pid"]))
    {
        $id=$_GET["pid"];
        $nombrePregunta=$_GET["pregunta"];
    }
    else
    {
        $id=0;
        $nombrePregunta="";
    }
    
    
    /*unset($_SESSION['ID_TIPOEVALUACION']);
    unset($_SESSION['ID_SECCION']);*/

    $dbTable='preguntas';

    $data = $controladorDB->obtenerTipoevaluacionSeccionPreguntas($databasecon,$idTipoEvaluacion,$idSeccion,0,$DEBUG_STATUS);
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
            <form method="post" action="controladorProceso.php?proceso=7&task=4">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="id" name ="id" value=<?php echo $id;?> />
                        <input type="hidden" id="idTipoEvaluacion" name ="idTipoEvaluacion" value=<?php echo $idTipoEvaluacion;?> /> 
                        <input type="hidden" id="idSeccion" name ="idSeccion" value=<?php echo $idSeccion;?> /> 
                        <!-- <input type="text" id="idPregunta" name ="idPregunta" value=<?php echo $idPregunta;?> />  -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label>PREGUNTA</label>
                        <input type="nombre" class="form-control navbar-btn" id="nombre" placeholder="PREGUNTA" name="nombre" value="<?php echo $nombrePregunta;?>" required>
                    </div>
                </div>
                <div class="row text-center">
                    <button type="submit" class="btn btn-info" title="Click to enter our portal">INGRESAR<span class="glyphicon glyphicon-chevron-right"></span></button>
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
                            <td>TIPO EVALUACION</td>
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
                            <td><?php echo $x+1;?></td>
                            <td><?php echo $data[$x][5];?></td> 
                            <td><?php echo $data[$x][4];?></td>
                            <td><?php echo $data[$x][3];?></td>
                            <td>
                                <a href="preguntas.php?pid=<?php echo $data[$x][0];?>&pregunta=<?php echo $data[$x][3];?>"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <a href="controladorProceso.php?proceso=7&task=5&id=<?php echo $data[$x][0];?>"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
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