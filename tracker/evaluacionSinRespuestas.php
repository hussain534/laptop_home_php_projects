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
        $idPlanEvaluacion=$_GET["pid"];
    else
        $idPlanEvaluacion=0;

    $evaluacionSinRespuestas = $controladorDB->evaluacionSinRespuestas($databasecon,$idPlanEvaluacion,$DEBUG_STATUS);
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
            PREGUNTAS SIN RESPUESTAS
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-12 text-right">
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
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <?php
            if(isset($evaluacionSinRespuestas))
            {
                ?>
                <div class="table-responsive">
                    <table class="table" id="myTable2">
                        <thead>
                            <tr class="table-header" style="background:green">
                                <td>#FILA</td>
                                <td>DESC EVALUACION</td>
                                <td>TIPO EVALUACION</td>
                                <td>SECCION</td>
                                <td>EVALUADOR</td>
                                <td>EVALUADO</td>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                for($x=0;$x<count($evaluacionSinRespuestas);$x++)
                {
                ?>  
                    <tr class="table-body">
                        <td><?php echo $x+1;?></td>
                        <td><?php echo $evaluacionSinRespuestas[$x][0];?></td> 
                        <td><?php echo $evaluacionSinRespuestas[$x][1];?></td>
                        <td><?php echo $evaluacionSinRespuestas[$x][2];?></td>
                        <td><?php echo $evaluacionSinRespuestas[$x][3];?></td>
                        <td><?php echo $evaluacionSinRespuestas[$x][4];?></td>
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
        <div class="col-sm-3"></div>
    </div>
   
</div>