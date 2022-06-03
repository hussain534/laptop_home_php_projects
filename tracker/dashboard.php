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
    if(isset($_GET["err"]))
        $err=$_GET["err"];
    else 
        $err=1;
    /*include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'controladorDB.php';*/
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
            DASHBOARD - EVALUADO * TIPO EVALUACION
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-12" style="background: white">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-2">
                    Heteroevaluación
                </div>
                <div class="col-sm-2">
                    Autoevaluación
                </div>
                <div class="col-sm-2">
                    Coevaluación Pares
                </div>
                <div class="col-sm-2">
                    Coevaluación Directivo
                </div>
                <div class="col-sm-2"></div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-2 text-right">
                    <div style="margin:5px;">
                        <canvas id="myChartTipoEvaluacion1" width="800" height="800"></canvas>
                    </div>
                </div>
                <div class="col-sm-2 text-right">
                    <div style="margin:5px;">
                        <canvas id="myChartTipoEvaluacion2" width="800" height="800"></canvas>
                    </div>
                </div>
                <div class="col-sm-2 text-right">
                    <div style="margin:5px;">
                        <canvas id="myChartTipoEvaluacion3" width="800" height="800"></canvas>
                    </div>
                </div>
                <div class="col-sm-2 text-right">
                    <div style="margin:5px;">
                        <canvas id="myChartTipoEvaluacion4" width="800" height="800"></canvas>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>          
        </div>
    </div>
    <div class="row pageTitle">
        <div class="col-sm-12">
            DASHBOARD - EVALUADOR * TIPO EVALUACION
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-12" style="background: white">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-2">
                    Heteroevaluación
                </div>
                <div class="col-sm-2">
                    Autoevaluación
                </div>
                <div class="col-sm-2">
                    Coevaluación Pares
                </div>
                <div class="col-sm-2">
                    Coevaluación Directivo
                </div>
                <div class="col-sm-2"></div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-2 text-right">
                    <div style="margin:5px;">
                        <canvas id="myChartTipoEvaluacion1evaluador" width="800" height="800"></canvas>
                    </div>
                </div>
                <div class="col-sm-2 text-right">
                    <div style="margin:5px;">
                        <canvas id="myChartTipoEvaluacion2evaluador" width="800" height="800"></canvas>
                    </div>
                </div>
                <div class="col-sm-2 text-right">
                    <div style="margin:5px;">
                        <canvas id="myChartTipoEvaluacion3evaluador" width="800" height="800"></canvas>
                    </div>
                </div>
                <div class="col-sm-2 text-right">
                    <div style="margin:5px;">
                        <canvas id="myChartTipoEvaluacion4evaluador" width="800" height="800"></canvas>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>          
        </div>
    </div>
</div>