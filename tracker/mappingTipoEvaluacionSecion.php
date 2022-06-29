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
    $dbTable='datos';
   
    if(isset($_SESSION["ID_TIPOEVALUACION"]))
        $idTipoEvaluacion=$_SESSION["ID_TIPOEVALUACION"];
    else
        $idTipoEvaluacion=0;
    if(isset($_SESSION["ID_SECCION"]))
        $idSeccion=$_SESSION["ID_SECCION"];
    else
        $idSeccion=0;
    
    unset($_SESSION['ID_TIPOEVALUACION']);
    unset($_SESSION['ID_SECCION']);
    /*$data = $controladorDB->obtenerDataDatos($databasecon,$idPlanEvaluacion,$idPregunta,$idSeccion,$idTipoEvaluacion,$idEvaluado,$idEvaluador,$dbTable,$DEBUG_STATUS);
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
    }*/
    $data = $controladorDB->obtenerDataTipoEvaluacionYSeccion($databasecon,$idTipoEvaluacion,$idSeccion,'mappingtipoevaluacionsecion',$DEBUG_STATUS);  
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
            MAPPING (TIPO EVALUACION -SECCION)
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
        <div class="col-sm-12">
            <form method="post" action="controladorProceso.php?proceso=14&task=0" onsubmit="return validateFormDatos2();">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" value=<?php echo $idTipoEvaluacion;?> />
                        <input type="hidden" value=<?php echo $idSeccion;?> />
                        
                        <!-- <input type="text" id="idSeccion" name ="idSeccion" value=<?php echo $idSeccion;?> /> -->
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-3"></div>                  
                    <div class="col-sm-3">
                        <label>TIPO EVALUACION</label>
                        <select name="idTiEv" class="form-control navbar-btn" id="idTiEv" onChange="configurarSessionTipoEvalSeccion()" required>
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
                    <div class="col-sm-3">
                        <label>SECCION</label>
                        <select name="idSec" class="form-control navbar-btn" id="idSec" onChange="configurarSessionTipoEvalSeccion()" required>
                            <option value=0><?php echo '[0]:ESCOGER SECCION';?></option>
                            <?php
                                $dbTable='seccion';
                                $seccion = $controladorDB->obtenerData($databasecon,0,$dbTable,$DEBUG_STATUS);
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
                    <div class="col-sm-3"></div>
                </div>
                <br>
                <div class="row text-center">
                    <?php
                        if($idTipoEvaluacion==0 || $idSeccion==0)
                        {
                    ?>
                    <button type="submit" class="btn btn-info" title="Click to enter our portal">AGREGAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                    <?php
                        }
                        else if(count($data)==0)
                        {
                    ?>
                            <button type="submit" class="btn btn-info" title="Click to enter our portal">AGREGAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                    <?php
                        }
                        else
                        {
                    ?>
                    <h2>Existen registros en base, La sistema no permite registrar.</h2>
                    <?php        
                        }
                    ?>
                </div>
            </form>
        </div>
    </div>
    <br>
    <?php
        if(isset($data))
        {
            $dbTable='datos';
            ?>
            <div class="col-sm-2"></div>
            <div class="table-responsive col-sm-8">                
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>#FILA</td>
                            <td>TIPO EVALUACION</td>
                            <td>SECCION</td>
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
                            <td><?php echo $data[$x][2];?></td>
                            <td><?php echo $data[$x][4];?></td>
                            <td>
                                <!-- <a href="tipoevaluacion.php?pid=<?php echo $data[$x][0];?>"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a> -->
                                <a href="controladorProceso.php?proceso=14&task=1&id=<?php echo $data[$x][0];?>&tid=<?php echo $data[$x][1];?>&sid=<?php echo $data[$x][3];?>"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
                                <a href="controladorProceso.php?proceso=14&task=2&id=<?php echo $data[$x][0];?>&tid=<?php echo $data[$x][1];?>&sid=<?php echo $data[$x][3];?>"><span class="glyphicon glyphicon-th-list" style="font-size:x-large;color:green;"></span></a>
                            </td>
                        </tr>
            <?php
                }
            ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-2"></div>
            <?php
        }
    ?>
    <br>
</div>