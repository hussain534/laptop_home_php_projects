<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    //include_once('util.php');
    include_once('config.php');
    $session_time=$session_expirry_time;    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();

    if(!isset($_SESSION["user_name"]) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
    {
        $url='cerrarSesion.php';
        header("Location:$url");
    }
    else
    {
        include_once('util.php');
    }
    $_SESSION['LAST_ACTIVITY'] = time();



    include_once('menuPanel.php');
    $message='';
    if(isset($_SESSION["message"])) 
    {
        $message=$_SESSION["message"];
        unset($_SESSION["message"]);
    }
    //$clientes = $controller->getClientesParReportes($databasecon,$DEBUG_STATUS);
    $servicios = $controller->getAllServicios($databasecon,$DEBUG_STATUS);
?>
<div class="container">
    <div class="row">
        <div class="col-sm-2 sidebar">
            <?php include_once('menu.php');?>
        </div>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-12">
                    <?php include_once('mysession.php');?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="page_title">GESTION SERVICIOS POR CLIENTE</h2>
                </div>
            </div>
            <br>
            <form action="excel5.php" method="POST">
            <div class="row">
                <div class="col-sm-3">
                    <label for="serviceId">SERVICIO:</label>
                    <select name="serviceId" class="form-control" onchange="getClientesEnBaseDelServicio()" id="serviceId" required>
                    <?php
                        for($x=0;$x<count($servicios);$x++)
                        {
                            echo '<option value='.$servicios[$x][0].'>'.$servicios[$x][1].'</option>';
                        }
                    ?>
                    </select>
                    <div class="errmsg" id="error_serviceId"></div> 
                </div>
                <div class="col-sm-3">
                    <label for="clientId">CLIENTE:</label>
                    <select name="clientId" class="form-control" id="clientId" required>
                    </select>
                    <div class="errmsg" id="error_clientId"></div>
                </div>
                <div class="col-sm-3">
                    <label for="dt_ini">FECHA INICIO:</label>
                    <input type="date" name="dt_ini" id="dt_ini" class="form-control">
                    <div class="errmsg" id="error_dt_ini"></div>
                </div>
                <div class="col-sm-3">
                    <label for="dt_fin">FECHA FIN:</label>
                    <input type="date" name="dt_fin" id="dt_fin" class="form-control">
                    <div class="errmsg" id="error_dt_fin"></div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-2">
                    <button type="button" id="showReport5" class="btn btn-small btn_center">MOSTRAR REPORTE<span class="glyphicon glyphicon-chevron-right"></span></button>
                </div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-small btn_center">EXPORTAR REPORTE<span class="glyphicon glyphicon-chevron-right"></span></button>
                </div>
            </div>
            </form>
            <!--  <div class="row">
                <div class="col-sm-12" id="tbl_entidad_gestion-data" style="width: 900px; height: 200px;">
                    
                </div>
            </div> -->
            <div class="row">
                <div class="col-sm-12" id="tbl_entidad_gestion" style="width: 100%;height:2000px;">
                    
                </div>
            </div>

        </div>
    </div>
</div>


