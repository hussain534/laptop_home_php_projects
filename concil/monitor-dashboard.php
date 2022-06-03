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
?>
<style type="text/css">
    body
    {
        background-image: none !important;
    }
</style>
<div class="container" style="background: white;min-height:1000px !important">
    <?php
    include_once('sessionData.php');
    ?>
    <br>
    <div class="row pageTitle">
        <div class="col-sm-12">
            MONITOR
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-5 text-right">
            <div style="margin:5px;background:#00b0f0" id="monitor-usercpu-div" width="800" height="450">
            </div>
        </div>
        <div class="col-sm-5 text-right">
            <div style="margin:5px;background: #f32058" id="monitor-systemcpu-div" width="800" height="450">
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-5 text-right">
            <div style="margin:5px;background: #69a218" id="monitor-memoryfisico-div" width="800" height="450">
            </div>
        </div>
        <div class="col-sm-5 text-right">
            <div style="margin:5px;background: #ca6e03" id="monitor-memorypaging-div" width="800" height="450">
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div> 
</div>
<script>
    $(document).ready(
            function() {
                    $('#monitor-usercpu-div').load('monitor-usercpu.php');
                    $('#monitor-systemcpu-div').load('monitor-systemcpu.php');
                    $('#monitor-memoryfisico-div').load('monitor-memoryfisico.php');
                    $('#monitor-memorypaging-div').load('monitor-memorypaging.php');
                    setInterval(function() {
                        $('#monitor-usercpu-div').load('monitor-usercpu.php');
                    }, 10000);
                    setInterval(function() {
                        $('#monitor-systemcpu-div').load('monitor-systemcpu.php');
                    }, 10000);
                    setInterval(function() {
                        $('#monitor-memoryfisico-div').load('monitor-memoryfisico.php');
                    }, 10000);
                    setInterval(function() {
                        $('#monitor-memorypaging-div').load('monitor-memorypaging.php');
                    }, 10000);
            });
</script>