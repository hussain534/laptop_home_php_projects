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
    if(isset($_GET["pid"]))
    {
        $idPlanEvaluacion=$_GET["pid"];
        $data = $controladorDB->obtenerDataPlanEvaluacion($databasecon,$_GET["pid"],'planevaluacion',$DEBUG_STATUS);
        $status=$data[0][3];
    }
    else
        $idPlanEvaluacion=0;

    $pendientesAsignacion = $controladorDB->obtenerAsignacionesPendientes($databasecon,$idPlanEvaluacion,$DEBUG_STATUS);
    $realizadasAsignacion = $controladorDB->obtenerAsignacionesRealizados($databasecon,$idPlanEvaluacion,$DEBUG_STATUS);
    $controladorDB->actualizatHabilitadoEnDatosEnbaseDeDatosDtl($databasecon,$idPlanEvaluacion,$DEBUG_STATUS);

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
            ASIGNACIONES
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center">
            <img src="images/eval-step-03.png" style="width:20%;height: 20%;">
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-12 text-right">
            <a href="datos.php?pid=<?php echo $idPlanEvaluacion;?>"><button type="button" class="btn btn-info" title="Click to enter our portal">ASIGNAR PREGUNTAS<span class="glyphicon glyphicon-circle-arrow-left"></span></button></a>
            <a href="planevaluacion.php"><button type="button" class="btn btn-info" title="Click to enter our portal">REGRESAR<span class="glyphicon glyphicon-circle-arrow-left"></span></button></a>
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
        <div class="col-sm-6">
            <div class="row text-center">
                <div class="col-sm-12">PARA ASIGNAR</div>
            </div>
            
            <br>
            <?php
            if(isset($pendientesAsignacion))
            {
                ?>
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr class="table-header">
                                <td>#FILA</td>
                                <td>TIPO EVALUACION</td>
                                <td>SECCION</td>
                                <td>EVALUADO</td>
                                <td>EVALUADOR</td>
                                <td>ACCION</td>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                for($x=0;$x<count($pendientesAsignacion);$x++)
                {
                ?>  
                    <tr class="table-body">
                        <td><?php echo $x+1;?></td>
                        <td><?php echo $pendientesAsignacion[$x][1];?></td> 
                        <td><?php echo $pendientesAsignacion[$x][3];?></td>
                        <td><?php echo $pendientesAsignacion[$x][5];?></td>
                        <td>
                            <select name="idEvalr" id="idEvalr" onchange="setEvaluador(<?php echo $x+1;?>)">
                            <option value=-1><?php echo 'ESCOGER EVALUADOR';?></option>
                            <?php
                                $perfilevaluador = $controladorDB->obtenerPerfilEvaluadorPendientes($databasecon,$pendientesAsignacion[$x][0],$pendientesAsignacion[$x][2],$idPlanEvaluacion,$DEBUG_STATUS);
                                for($j=0;$j<count($perfilevaluador);$j++)
                                {
                                    if($pendientesAsignacion[$x][0]>1)
                                    {
                                        $evaluador = $controladorDB->getUsersByPerfil($databasecon,$perfilevaluador[$j][0],$DEBUG_STATUS);
                                        for($i=0;$i<count($evaluador);$i++)
                                        {
                                            if($pendientesAsignacion[$x][4]!=$evaluador[$i][0])
                                            {
                                                /*if($evaluador[$i][2]>1)
                                                {
                                                    ?>
                                                    <option value=<?php echo $evaluador[$i][0].'|'.$evaluador[$i][2];?>><?php echo '[PARALELO-'.$evaluador[$i][2].']:'.$evaluador[$i][1];?></option>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <option value=<?php echo $evaluador[$i][0];?>><?php echo $evaluador[$i][1];?></option>
                                                    <?php
                                                }*/
                                                ?>
                                                <option value=<?php echo $evaluador[$i][0];?>><?php echo $evaluador[$i][1];?></option>
                                                <?php
                                            }                                    
                                        }
                                    }
                                    else
                                    {
                                        $evaluador = $controladorDB->getParalelosByPerfil($databasecon,$perfilevaluador[$j][0],$pendientesAsignacion[$x][4],$DEBUG_STATUS);
                                        for($i=0;$i<count($evaluador);$i++)
                                        {
                                            /*if($evaluador[$i][2]>1)
                                            {
                                                ?>
                                                <option value=<?php echo $evaluador[$i][0].'|'.$evaluador[$i][2];?>><?php echo '[PARALELO-'.$evaluador[$i][2].']:'.$evaluador[$i][1];?></option>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <option value=<?php echo $evaluador[$i][0];?>><?php echo $evaluador[$i][1];?></option>
                                                <?php
                                            }*/ 
                                            ?>
                                                <option value=<?php echo $evaluador[$i][0].'|'.$evaluador[$i][0];?>><?php echo $evaluador[$i][1];?></option>
                                            <?php                               
                                        }
                                    }
                                    
                                }
                            ?>
                        </select>
                        </td>                       
                        <td>
                            <button type="button" id="btnAsignar" onClick="asignarEvaluador(<?php echo $idPlanEvaluacion;?>,<?php echo $pendientesAsignacion[$x][0];?>,<?php echo $pendientesAsignacion[$x][2];?>,<?php echo $pendientesAsignacion[$x][4];?>,<?php echo $x+1;?>)">ASIGNAR<span class="glyphicon glyphicon-chevron-right"></span></button>
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
            if(count($pendientesAsignacion)>0)
            {
            ?>
            <div class="row text-center">
                <div class="col-sm-12"><a href="controladorProceso.php?proceso=9&task=5&pid=<?php echo $idPlanEvaluacion;?>"><button type="button" class="btn btn-info" title="Click to enter our portal">DESHABILITAR NO ASIGNADOS<span class="glyphicon glyphicon-remove"></span></button></a></div>
            </div>
            <?php
            }    
            ?>
        </div>

        <div class="col-sm-6">
            <div class="row text-center">
                <div class="col-sm-12">ASIGNADOS</div>
            </div>
            <br>
            <?php
            if(isset($realizadasAsignacion))
            {
                ?>
                <div class="table-responsive">
                    <table class="table" id="myTable2">
                        <thead>
                            <tr class="table-header" style="background:green">
                                <td>#FILA</td>
                                <td>TIPO EVALUACION</td>
                                <td>SECCION</td>
                                <td>EVALUADO</td>
                                <td>EVALUADOR</td>
                                <td>PARALELO</td>
                                <td style="display: none;"></td>
                                <td>LIBERAR</td>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                for($x=0;$x<count($realizadasAsignacion);$x++)
                {
                ?>  
                    <tr class="table-body">
                        <td><?php echo $x+1;?></td>
                        <td><?php echo $realizadasAsignacion[$x][1];?></td> 
                        <td><?php echo $realizadasAsignacion[$x][3];?></td>
                        <td><?php echo $realizadasAsignacion[$x][5];?></td>
                        <td><?php echo $realizadasAsignacion[$x][7];?></td>
                        <td><?php if($realizadasAsignacion[$x][8]>1) echo $realizadasAsignacion[$x][9];?></td>
                        <td style="display: none;"><?php echo $realizadasAsignacion[$x][6].'|'.$realizadasAsignacion[$x][8];?></td>
                        <td>
                            <?php
                                    if($status==-1)
                                    {
                                ?>
                                        <button type="button" id="btnAsignar" onClick="liberarEvaluador(<?php echo $idPlanEvaluacion;?>,<?php echo $realizadasAsignacion[$x][0];?>,<?php echo $realizadasAsignacion[$x][2];?>,<?php echo $realizadasAsignacion[$x][4];?>,<?php echo $x+1;?>)"><span class="glyphicon glyphicon-remove"></span></button>
                                <?php        
                                    }
                            ?>
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
        </div>
    </div>
   
</div>