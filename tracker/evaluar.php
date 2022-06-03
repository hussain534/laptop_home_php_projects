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

   if(isset($_SESSION["ID_SATISFACCION_NIVEL"]))
        $idSatisNivel=$_SESSION["ID_SATISFACCION_NIVEL"];
    else
        $idSatisNivel=4;
    unset($_SESSION["ID_SATISFACCION_NIVEL"]);
    $listaEvaluacion = $controladorDB->obtenerPreguntasDeEvaluacion($databasecon,$_GET["pid"],$_GET["uid"],$DEBUG_STATUS);
    //echo 'count::'.count($listaEvaluacion);
    $pid=$_GET["pid"];
    $uid=$_GET["uid"];


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
            EVALUACION
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
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center jumbotron">
            <span> FAVOR SELECCIONE SU EVALUCION DE CADA PREGUNTA Y DAR CLIC EN BOTON REGISTRAR<br></span>
        </div>
        <div class="col-sm-3"></div>
    </div> -->
    
    <br>
    
    <a type="button" class="btn btn-info" href="listaevaluacion.php">REGRESAR A LISTA DE EVALUACIONES<span class="glyphicon glyphicon-chevron-right"></span></a>

    
    <br>
    <br>
    <br>
    <?php
        if(isset($listaEvaluacion))
        {
            ?>
            <form method="post" action=controladorProceso.php?proceso=12&task=3&pid=<?php echo $pid;?>&uid=<?php echo $uid;?> onsubmit="return validateSatisfaccionNivel(<?php echo count($listaEvaluacion);?>)">
                <input type="hidden" id="respuestas" name ="respuestas" value="" />
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>ID</td>
                            <td>PREGUNTA</td>
                            <td>SU EVALUACION</td>
                            <!-- <td>ACTION</td> -->
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($listaEvaluacion);$x++)
                {
            ?>
                        <tr class="table-body">
                            <td><?php echo $listaEvaluacion[$x][0];?></td> 
                            <td><?php echo $listaEvaluacion[$x][1];?></td>
                            <td>
                                <select name="idrespuestaevaluacion<?php echo $x;?>" class="form-control" id="idrespuestaevaluacion<?php echo $x;?>" onChange=registrarSatisfaccionNivel(<?php echo $x;?>,<?php echo $listaEvaluacion[$x][0];?>) required>
                                    
                                    <?php 
                                        $respuestaevaluacion = $controladorDB->obtenerDataResEvaluacion($databasecon,0,'respuestaevaluacion',$DEBUG_STATUS);
                                        for($i=0;$i<count($respuestaevaluacion);$i++)
                                        {
                                            if($listaEvaluacion[$x][2]==$respuestaevaluacion[$i][0])
                                            {
                                                ?>
                                                    <option value=<?php echo $respuestaevaluacion[$i][0];?> selected="true"><?php echo '['.$respuestaevaluacion[$i][0].']:'.$respuestaevaluacion[$i][1];?></option>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                    <option value=<?php echo $respuestaevaluacion[$i][0];?>><?php echo '['.$respuestaevaluacion[$i][0].']:'.$respuestaevaluacion[$i][1];?></option>
                                                <?php
                                            }                                    
                                        }
                                    ?>
                                </select>
                            </td><!-- 
                            <td>
                                <button type="button" class="btn btn-info" title="Click to enter our portal" onClick=registrarSatisfaccionNivel(<?php echo $x;?>,<?php echo $listaEvaluacion[$x][0];?>)>REGISTRAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                            </td> -->
                        </tr>
                    
            <?php
                }
            ?>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-info" title="Click to enter our portal">REGISTRAR<span class="glyphicon glyphicon-chevron-right"></span></button>
            </form>
            <?php
        }
    ?>
    <br>
</div>