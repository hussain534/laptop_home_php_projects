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


    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'controladorDB.php';
    $controladorDB = new controladorDB();
    $proveedores = $controladorDB->listaProveedores($databasecon,0,$DEBUG_STATUS);
    $canales = $controladorDB->listaCanales($databasecon,0,$DEBUG_STATUS);
    //$canales = 0;

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
    <br>
    <div class="row pageTitle">
        <div class="col-sm-12">
            DASHBOARD
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php
    if($_SESSION["user_empresa"]==0)
    {
?>
    <!-- <div class="row text-center">
        <div class="col-sm-3"></div>
        <div class="col-sm-3 dash_panel">
            <a href="proveedores.php" style="font-size:60px;color:#00b0f0;">
                <i class='far fa-handshake' style="font-size: 120px;color:#00b0f0;"></i>
                <p style="font-size: 24px;padding:5px 30px 5px">INTEGRADORES</p>
                <p style="font-size: 50px;" class="dashboard">
                    <?php
                        echo count($proveedores);
                    ?>
                </p>
            </a>
        </div>
        <div class="col-sm-3 dash_panel">
            <a href="canales.php" style="font-size:60px;color:#00b0f0;">
                <i class='fas fa-sitemap' style="font-size: 120px;color:#00b0f0;"></i>
                <p style="font-size: 24px;padding:5px 30px 5px">CANALES</p>
                <p style="font-size: 50px;" class="dashboard">
                    <?php
                        echo count($canales);
                    ?>
                </p>
            </a>
        </div>
        <div class="col-sm-3"></div>
    </div> -->
    <div class="row text-center">
        <div class="col-sm-3"></div>
        <div class="col-sm-3 dash_panel">
            <a href="proveedores.php" style="font-size:60px;color:#ae1c1f;">
                <i class='far fa-handshake' style="font-size: 120px;color:#ae1c1f;"></i>
                <p style="font-size: 24px;padding:5px 30px 5px">INTEGRADORES</p>
                <p style="font-size: 50px;" class="dashboard">
                    <?php
                        echo count($proveedores);
                    ?>
                </p>
            </a>
        </div>
        <div class="col-sm-3 dash_panel">
            <a href="canales.php" style="font-size:60px;color:#ae1c1f;">
                <i class='fas fa-sitemap' style="font-size: 120px;color:#ae1c1f;"></i>
                <p style="font-size: 24px;padding:5px 30px 5px">CANALES</p>
                <p style="font-size: 50px;" class="dashboard">
                    <?php
                        echo count($canales);
                    ?>
                </p>
            </a>
        </div>
        <div class="col-sm-3"></div>
    </div>
<?php        
    }
    else
    {
?><div class="row text-center">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 dash_panel">
            <a href="subirArchivoConciliacion.php" class="btn btn-info">SUBIR ARCHIVO CONCILIACION</a>
        </div>
        <div class="col-sm-4"></div>
<?php
    }
    ?>
</div>