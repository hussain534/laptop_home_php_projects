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
    if(isset($_SESSION["ID_DESC_ANO_EVAL"]))
        $idDescAnoEvaluacion=$_SESSION["ID_DESC_ANO_EVAL"];
    else
        $idDescAnoEvaluacion=0;
    unset($_SESSION["ID_DESC_ANO_EVAL"]);
    $listaEvaluacion = $controladorDB->obtenerListaEvaluacionPorAnoDesc($databasecon,$idDescAnoEvaluacion,$DEBUG_STATUS);
    //echo 'count::'.count($listaEvaluacion);
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
            LISTA DE EVALUACION
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
            <!-- <form method="post" action="controladorProceso.php?proceso=6&task=0"> -->
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="idDescAnoEvaluacion" name ="idDescAnoEvaluacion" value=<?php echo $idDescAnoEvaluacion;?> > 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <label>DESC</label>
                        <select name="idDescAno" class="form-control" id="idDescAno" required>
                            <option value=0><?php echo 'TODO';?></option>
                            <?php 
                                $anoLista = $controladorDB->obtenerListaEvaluacion($databasecon,0,$DEBUG_STATUS);
                                for($i=0;$i<count($anoLista);$i++)
                                {
                                    if($idDescAnoEvaluacion==$anoLista[$i][0])
                                    {
                                        ?>
                                            <option value=<?php echo $anoLista[$i][0];?> selected="true"><?php echo '['.$anoLista[$i][0].']:'.$anoLista[$i][1];?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value=<?php echo $anoLista[$i][0];?>><?php echo '['.$anoLista[$i][0].']:'.$anoLista[$i][1];?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
                <br>
                <div class="row text-center">
                    <button type="button" class="btn btn-info" title="Click to enter our portal" onClick="buscarListaEvaluacion()">BUSCAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                </div>
            <!--</form> -->
        </div>
        <div class="col-sm-1"></div>
    </div>
    <br>
    <?php
        if(isset($listaEvaluacion))
        {
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>ID</td>
                            <td>ANO-DESC EVALUACION</td>
                            <td>NOMBRE EVALUADO</td>
                            <td>VER PREGUNTAS Y SU CALIFICACION</td>
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
                            <td><?php echo $listaEvaluacion[$x][2];?></td>
                            <td>
                                <a href="evaluar.php?pid=<?php echo $listaEvaluacion[$x][0];?>&uid=<?php echo $listaEvaluacion[$x][3];?>"><span class="glyphicon glyphicon glyphicon-th-list" style="font-size:x-large;color:grey;"></span></a>
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