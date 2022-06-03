<?php
    //define('ISGOOD', true);
    //defined('__JEXEC') or ('Access denied');
    //defined("ISGOOD") or exit('Access denied');
    session_start();
    include_once('util.php');
    include_once('header.php');
    if(isset($_GET["err"]))
        $err=$_GET["err"];
    else 
        $err=1;

    //include_once('config.php');
    //$DEBUG_STATUS = $PRINT_LOG;
    //require 'dbcontroller.php';
    //$controller = new controller();
    //$tasks = $controller->getMyTodaysTaskReport($databasecon,$DEBUG_STATUS);
    //print_r($tasks);
?>
<div class="container">    
    <?php
    include_once('sessionData.php');
    ?>
    
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>-->
    <!-- <div class="row">
        <div class="col-sm-12">
            <img src="images/graph-examples1.png" class="graph">
        </div>
    </div> -->
    <br>
    <div class="row pageTitle">
        <div class="col-sm-12">
            REPORTE DEL HOY      
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 text-right">
            <div style="width:95% !important;margin:5px;">
                <canvas id="myChart1"></canvas>
            </div>
        </div>
        <div class="col-sm-3">
            <div style="width:95% !important;margin:5px;">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        <div class="col-sm-3">
            <div style="width:95% !important;margin:5px;">
                <canvas id="myChart3"></canvas>
            </div>
        </div>    
        <div class="col-sm-3">
            <div style="width:95% !important;margin:5px;">
                <canvas id="myChart4"></canvas>
            </div>
        </div>
    </div>


    <div class="row pageTitle">
        <div class="col-sm-12">
            REPORTE ULTIMO 7 DIAS      
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 text-right">
            <div style="width:95% !important;margin:5px;">
                <canvas id="myChartWeekly1"></canvas>
            </div>
        </div>
        <div class="col-sm-3">
            <div style="width:95% !important;margin:5px;">
                <canvas id="myChartWeekly2"></canvas>
            </div>
        </div>
        <div class="col-sm-3">
            <div style="width:95% !important;margin:5px;">
                <canvas id="myChartWeekly3"></canvas>
            </div>
        </div>    
        <div class="col-sm-3">
            <div style="width:95% !important;margin:5px;">
                <canvas id="myChartWeekly4"></canvas>
            </div>
        </div>
    </div>

    <div class="row pageTitle">
        <div class="col-sm-12">
            REPORTE ULTIMO 30 DIAS      
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 text-right">
            <div style="width:95% !important;margin:5px;">
                <canvas id="myChartMonthly1"></canvas>
            </div>
        </div>
        <div class="col-sm-3">
            <div style="width:95% !important;margin:5px;">
                <canvas id="myChartMonthly2"></canvas>
            </div>
        </div>
        <div class="col-sm-3">
            <div style="width:95% !important;margin:5px;">
                <canvas id="myChartMonthly3"></canvas>
            </div>
        </div>    
        <div class="col-sm-3">
            <div style="width:95% !important;margin:5px;">
                <canvas id="myChartMonthly4"></canvas>
            </div>
        </div>
    </div>
    
</div>