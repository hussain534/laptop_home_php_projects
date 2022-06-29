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
    $dbTable='datos';
    /*if(isset($_GET["pid"]))
    {
        $data = $controladorDB->obtenerDataDatos($databasecon,$_GET["pid"],$dbTable,$DEBUG_STATUS);
        $id=$data[0][0];
        $nombre=$data[0][1];
        $peso=$data[0][2];
    }
    else
    {
        $id=0;
        $nombre='';
        $peso=0;
    }
    */
    //$data = $controladorDB->obtenerDataDatos($databasecon,0,$dbTable,$DEBUG_STATUS);
    if(isset($_GET["pid"]))
    {
        $idPlanEvaluacion=$_GET["pid"];
        $data = $controladorDB->obtenerDataPlanEvaluacion($databasecon,$_GET["pid"],'planevaluacion',$DEBUG_STATUS);
        $nombre=$data[0][1];
        $ano=$data[0][2];
    }
    else
        $idPlanEvaluacion=0;
    if(isset($_SESSION["ID_PREGUNTA"]))
        $idPregunta=$_SESSION["ID_PREGUNTA"];
    else
        $idPregunta=0;
    /*if(isset($_SESSION["ID_COMPONENTE"]))
        $idComponente=$_SESSION["ID_COMPONENTE"];
    else
        $idComponente=0;*/
    /*if(isset($_SESSION["ID_TIPOPAR"]))
        $idTipoPar=$_SESSION["ID_TIPOPAR"];
    else
        $idTipoPar=0;*/
    if(isset($_SESSION["ID_TIPOEVALUACION"]))
        $idTipoEvaluacion=$_SESSION["ID_TIPOEVALUACION"];
    else
        $idTipoEvaluacion=0;
    if(isset($_SESSION["ID_SECCION"]))
        $idSeccion=$_SESSION["ID_SECCION"];
    else
        $idSeccion=0;
    if(isset($_SESSION["ID_EVALUADO"]))
        $idEvaluado=$_SESSION["ID_EVALUADO"];
    else
        $idEvaluado=0;
    if(isset($_SESSION["ID_EVALUADOR"]))
        $idEvaluador=$_SESSION["ID_EVALUADOR"];
    else
        $idEvaluador=0;  
    unset($_SESSION['ID_PREGUNTA']);  
    //unset($_SESSION['ID_COMPONENTE']);
    //unset($_SESSION['ID_TIPOPAR']);
    unset($_SESSION['ID_TIPOEVALUACION']);
    unset($_SESSION['ID_SECCION']);
    unset($_SESSION['ID_EVALUADO']);
    unset($_SESSION['ID_EVALUADOR']);
    $data = $controladorDB->obtenerDataDatos($databasecon,$idPlanEvaluacion,$idPregunta,$idSeccion,$idTipoEvaluacion,$idEvaluado,$idEvaluador,$dbTable,$DEBUG_STATUS);
    //echo 'count::'.count($permisos);
    $tipoevaluacion = $controladorDB->obtenerDataTipoEvaluacion($databasecon,$idTipoEvaluacion,'tipoevaluacion',$DEBUG_STATUS);
    if(count($tipoevaluacion)>0)
    {
        $id_perfil_evaluador=$tipoevaluacion[0][3];
        $id_perfil_evaluado=$tipoevaluacion[0][4];
    }
    else
    {
        $id_perfil_evaluador=0;
        $id_perfil_evaluado=0;   
    }
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
            CUESTIONARIOS
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
            <form method="post" action="controladorProceso.php?proceso=9&task=0" onsubmit="return validateFormDatos();">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="dbTable" name ="dbTable" value=<?php echo $dbTable;?> />
                        <input type="hidden" id="idPlanEvaluacion" name ="idPlanEvaluacion" value=<?php echo $idPlanEvaluacion;?> /> 
                        <input type="hidden" value=<?php echo $idTipoEvaluacion;?> />
                        <input type="hidden" value=<?php echo $id_perfil_evaluador;?> />
                        <input type="hidden" value=<?php echo $id_perfil_evaluado;?> />
                        <!-- <input type="text" id="idSeccion" name ="idSeccion" value=<?php echo $idSeccion;?> /> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>AÑO</label>
                        <input type="text" class="form-control navbar-btn" id="ano" name ="ano" value=<?php echo $ano;?> / readonly="true"> 
                    </div>
                    <div class="col-sm-8">
                        <label>PROCESO DE EVALUACIÓN</label>
                        <input type="text" class="form-control navbar-btn" value="<?php echo $nombre;?>" readonly="true">
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-sm-4">
                        <label>TIPO EVALUACION</label>
                        <select name="idTiEv" class="form-control navbar-btn" id="idTiEv" onChange="buscarComboData()" required>
                            <option value=0><?php echo '[0]:ESCOGER TIPO EVALUACION';?></option>
                            <?php
                                $dbTable='tipoevaluacion';
                                $tipoevaluacion = $controladorDB->obtenerData($databasecon,0,$dbTable,$DEBUG_STATUS);
                                for($i=0;$i<count($tipoevaluacion);$i++)
                                {
                                    if($idTipoEvaluacion==$tipoevaluacion[$i][0])
                                    {
                                        ?>
                                            <option value=<?php echo $tipoevaluacion[$i][0];?> selected="true"><?php echo '['.$tipoevaluacion[$i][0].']:'.$tipoevaluacion[$i][1];?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value=<?php echo $tipoevaluacion[$i][0];?>><?php echo '['.$tipoevaluacion[$i][0].']:'.$tipoevaluacion[$i][1];?></option>
                                        <?php
                                    }                                    
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>EVALUADOR</label>
                            <?php
                                $dbTable='c_perfil';
                                $evaluador = $controladorDB->obtenerData($databasecon,0,$dbTable,$DEBUG_STATUS);
                                for($i=0;$i<count($evaluador);$i++)
                                {
                                    if($id_perfil_evaluador==$evaluador[$i][0])
                                    {
                                        ?>
                                            <input type="hidden" class="form-control navbar-btn" id="idEvalr" name ="idEvalr" value=<?php echo $evaluador[$i][0];?> readonly="true">
                                            <input type="text" class="form-control navbar-btn" value=<?php echo $evaluador[$i][1];?> readonly="true"> 
                                        <?php
                                    }                                  
                                }
                            ?>
                    </div>
                    <div class="col-sm-4">
                        <label>EVALUADO</label>
                            <?php
                                $dbTable='c_perfil';
                                $evaluado = $controladorDB->obtenerData($databasecon,0,$dbTable,$DEBUG_STATUS);
                                for($i=0;$i<count($evaluado);$i++)
                                {
                                    if($id_perfil_evaluado==$evaluado[$i][0])
                                    {
                                        ?>
                                            <input type="hidden" class="form-control navbar-btn" id="idEvalo" name ="idEvalo" value=<?php echo $evaluado[$i][0];?> readonly="true">
                                            <input type="text" class="form-control navbar-btn" value=<?php echo $evaluado[$i][1];?> readonly="true"> 
                                        <?php
                                    }                                  
                                }
                            ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>SECCION</label>
                        <select name="idSec" class="form-control navbar-btn" id="idSec" onChange="buscarComboData()" required>
                            <option value=0><?php echo '[0]:ESCOGER SECCION';?></option>
                            <?php
                                $dbTable='seccion';
                                //$seccion = $controladorDB->obtenerData($databasecon,0,$dbTable,$DEBUG_STATUS);
                                $seccion = $controladorDB->getSeccionPorTipoEvaluacion($databasecon,$idTipoEvaluacion,$DEBUG_STATUS);
                                for($i=0;$i<count($seccion);$i++)
                                {
                                    if($idSeccion==$seccion[$i][0])
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
                    <div class="col-sm-8">
                        <label>PREGUNTA</label>
                        <select name="idPreg" class="form-control navbar-btn" id="idPreg" onChange="buscarComboData()" required>
                            <option value=0><?php echo '[0]:ESCOGER PREGUNTA';?></option>
                            <?php
                                $dbTable='preguntas';
                                $pregunta = $controladorDB->obtenerPreguntas($databasecon,0,$idSeccion,$dbTable,$DEBUG_STATUS);
                                for($i=0;$i<count($pregunta);$i++)
                                {
                                    if($idPregunta==$pregunta[$i][0])
                                    {
                                        ?>
                                            <option value=<?php echo $pregunta[$i][0];?> selected="true"><?php echo '['.$pregunta[$i][1].']['.$pregunta[$i][0].']:'.$pregunta[$i][2];?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value=<?php echo $pregunta[$i][0];?>><?php echo '['.$pregunta[$i][1].']['.$pregunta[$i][0].']:'.$pregunta[$i][2];?></option>
                                        <?php
                                    }                                    
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row text-center">
                    <button type="submit" class="btn btn-info" title="Click to enter our portal">AGREGAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                </div>
            </form>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <br>
    <?php
        if(isset($data))
        {
            $dbTable='datos';
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>#FILA</td>
                            <td>TIPO EVALUACION</td>
                            <td>SECCION</td>
                            <td>PREGUNTA</td>
                            <td>EVALUADO</td>
                            <td>EVALUADOR</td>
                            <td>ACCION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($data);$x++)
                {
            ?>
                        <tr class="table-body">
                            <!-- <td><?php echo $data[$x][0];?></td>  -->
                            <td><?php echo $x+1;?></td>
                            <td><?php echo $data[$x][4];?></td> 
                            <td><?php echo $data[$x][2];?></td>
                            <td><?php echo $data[$x][6];?></td>
                            <td><?php echo $data[$x][8];?></td>
                            <td><?php echo $data[$x][10];?></td>
                            <td>
                                <!-- <a href="tipoevaluacion.php?pid=<?php echo $data[$x][0];?>"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a> -->
                                <a href="controladorProceso.php?proceso=9&task=1&id=<?php echo $data[$x][0];?>&tid=<?php echo $dbTable;?>&pid=<?php echo $idPlanEvaluacion;?>"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
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