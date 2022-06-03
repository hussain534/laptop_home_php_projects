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
    $clientes = $controller->getClientesParReportes($databasecon,$DEBUG_STATUS);
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
                    <h2 class="page_title">PETICIONES GESTIONADAS POR USUARIO/MES</h2>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-sm-3">
                    <label for="clientId">CLIENTE:</label>
                    <select name="clientId" class="form-control" id="clientId" required>
                    <?php
                        for($x=0;$x<count($clientes);$x++)
                        {
                            echo '<option value='.$clientes[$x][0].'>'.$clientes[$x][1].'</option>';
                        }
                    ?>
                    </select>
                    <div class="errmsg" id="error_clientId"></div> 
                </div>
                <div class="col-sm-3">
                    <label for="estadoPeticion">ESATADO PETICION:</label>
                    <select name="estadoPeticion" class="form-control" id="estadoPeticion" required>
                        <option value=1>ABIERTO</option>
                        <option value=2>EN CURSO</option>
                        <option value=3>CERRADA</option>
                    </select>
                    <div class="errmsg" id="error_estadoPeticion"></div> 
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
                <div class="col-sm-3">
                    <button type="button" id="showReport4" class="btn btn-small btn_center">MOSTRAR REPORTE<span class="glyphicon glyphicon-chevron-right"></span></button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12" id="tbl_entidad_gestion-data" style="width: 900px; height: 200px;">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12" id="tbl_entidad_gestion" style="width: 100%; height: 500px;">
                    
                </div>
            </div>

        </div>
    </div>
</div>


