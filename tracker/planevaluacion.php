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
    $dbTable='planevaluacion';
    if(isset($_GET["pid"]))
    {
        $data = $controladorDB->obtenerDataPlanEvaluacion($databasecon,$_GET["pid"],$dbTable,$DEBUG_STATUS);
        $id=$data[0][0];
        $nombre=$data[0][1];
        $ano=$data[0][2];
    }
    else
    {
        $id=0;
        $nombre='';
        $ano=date("Y");
    }
    $data = $controladorDB->obtenerDataPlanEvaluacion($databasecon,0,$dbTable,$DEBUG_STATUS);//ID, NOMBRE, ANO, HABILITADO
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
            GESTIÓN DE EVALUACIÓN
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center">
            <img src="images/eval-step-01.png" style="width:20%;height: 20%;">
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
            <form method="post" action="controladorProceso.php?proceso=10&task=0">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="id" name ="id" value=<?php echo $id;?> /> 
                        <input type="hidden" id="dbTable" name ="dbTable" value=<?php echo $dbTable;?> /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-4">
                        <label>PROCESO DE EVALUACIÓN</label>
                        <input type="nombre" class="form-control navbar-btn" id="nombre" placeholder="NOMBRE" name="nombre" value="<?php echo $nombre;?>" onkeyup="FindByDescEval()" required>
                    </div>
                    <div class="col-sm-4">
                        <label>AÑO</label>
                        <!-- <input type="ano" class="form-control navbar-btn" id="ano" placeholder="NOMBRE" name="ano" value="<?php echo $ano;?>"required> -->
                        <select name="ano" class="form-control navbar-btn" id="ano" required>                            
                            <?php 
                                for($i=1900;$i<=2100;$i++)
                                {
                                    if($ano==$i)
                                    {
                                        ?>
                                            <option value=<?php echo $i;?> selected="true"><?php echo $i;?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value=<?php echo $i;?>><?php echo $i;?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-2"></div>
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
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
    <?php
        if(isset($data))
        {
            ?>
            <div class="table-responsive">
                <table class="table" id="myTable">
                    <thead>
                        <tr class="table-header">
                            <td>#FILA</td>
                            <td>PLAN EVALUACION</td>
                            <td>ANO</td>
                            <td>PREGUNTAS EN CUESTIONARIO</td>
                            <td>PREGUNTAS SIN RESPUSTAS</td>
                            <td colspan="5">ACCION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($data);$x++)
                {
            ?>
                        <tr class="table-body">
                            <!-- <td><?php echo $data[$x][0];?></td> --> 
                            <td><?php echo $x+1;?></td>
                            <td><?php echo $data[$x][1];?></td>
                            <td><?php echo $data[$x][2];?></td>
                            <td>
                                <?php
                                    $totalPreguntasHabilitados = $controladorDB->totalPreguntasHabilitados($databasecon,$data[$x][0],$DEBUG_STATUS);
                                    echo $totalPreguntasHabilitados;
                                ?>
                            </td>
                            <td>
                                <?php
                                    $totalPreguntasHabilitadosSinContestacion = $controladorDB->totalPreguntasHabilitadosSinContestacion($databasecon,$data[$x][0],$DEBUG_STATUS);
                                    if($totalPreguntasHabilitadosSinContestacion>0)
                                    {
                                ?>
                                        <a href="evaluacionSinRespuestas.php?pid=<?php echo $data[$x][0];?>"><span class="glyphicon glyphicon-ban-circle" style="color:red;"> <?php echo $totalPreguntasHabilitadosSinContestacion;?></span></a>
                                <?php        
                                    }
                                    else
                                    {
                                ?>
                                        <span class="glyphicon glyphicon-ban-circle" style="color:grey;"> <?php echo $totalPreguntasHabilitadosSinContestacion;?></span>
                                <?php        
                                    }
                                ?>
                            </td>
                            <?php 
                                if($data[$x][3]==1 || $data[$x][3]==-1)
                                {
                            ?>
                                <td><a href="planevaluacion.php?pid=<?php echo $data[$x][0];?>"><span class="glyphicon glyphicon-pencil" style="color:green;"> EDITAR</span></a></td>
                                <td><a href="datos.php?pid=<?php echo $data[$x][0];?>"><span class="glyphicon glyphicon glyphicon-th-list" style="color:green;"> VER / EDITAR CUESTIONARIO</span></a></td>
                                <td><a href="controladorProceso.php?proceso=10&task=3&id=<?php echo $data[$x][0];?>"><span class="glyphicon glyphicon-remove" style="color:red;">DESHABILITAR</span></a></td>
                            <?php
                                }
                                else
                                {
                            ?>
                                <td><span class="glyphicon glyphicon-pencil" style="color:grey;"> EDITAR</span></td>
                                <td><span class="glyphicon glyphicon glyphicon-th-list" style="color:grey;"> VER / EDITAR CUESTIONARIO</span></td>
                                <td><span class="glyphicon glyphicon-remove" style="color:grey;">DESHABILITAR</span></td>
                            <?php        
                                }
                            ?>
                            <td>
                                <?php
                                    $pendientesAsignacion = $controladorDB->obtenerAsignacionesPendientes($databasecon,$data[$x][0],$DEBUG_STATUS);
                                    $preguntasList = $controladorDB->obtenerPreguntasList($databasecon,$data[$x][0],$DEBUG_STATUS);
                                    if($data[$x][3]==-1 && count($preguntasList)==0)
                                    {
                                        ?>
                                            <a href="asignarEvaluadoresInDatosDtl.php?pid=<?php echo $data[$x][0];?>"><span class="glyphicon glyphicon-user" style="color:blue;"> ASIGNAR-EVALUADORES</span></a>
                                        <?php
                                    }
                                    else if($data[$x][3]==-1 && count($preguntasList)>0 && count($pendientesAsignacion)>0)
                                    {
                                        ?>
                                            <a href="asignarEvaluadoresInDatosDtl.php?pid=<?php echo $data[$x][0];?>"><span class="glyphicon glyphicon-user" style="color:blue;"> ASIGNAR-EVALUADORES</span></a>
                                        <?php
                                    }
                                    else if($data[$x][3]==-1 && count($preguntasList)>0 && count($pendientesAsignacion)==0)
                                    {
                                ?>
                                    <a href="controladorProceso.php?proceso=10&task=1&id=<?php echo $data[$x][0];?>"><span class="glyphicon glyphicon-play" style="color:blue;"> INICIAR</span></a>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                    <span class="glyphicon glyphicon-send" style="color:grey;"> INICIADO</span>
                                <?php        
                                    }
                                ?>
                            </td>
                            <td>

                                <?php 
                                    if($data[$x][3]==1 || $data[$x][3]==-1)
                                    {
                                ?>
                                    <a href="controladorProceso.php?proceso=10&task=2&id=<?php echo $data[$x][0];?>"><span class="glyphicon glyphicon-stop" style="color:red;"> FINALIZAR</span></a>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                    <span class="glyphicon glyphicon-stop" style="color:grey;"> FINALIZADA</span>
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
        <div class="col-sm-1"></div>
    </div>
    <br>
</div>