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
        //echo $_SESSION["message"];
        $message=$_SESSION["message"];
        unset($_SESSION["message"]);
    }

    $clientes = $controller->getPlanificacionClientes($databasecon,$DEBUG_STATUS);
    $tecnicos = $controller->getTecnicosPlan($databasecon,$DEBUG_STATUS);
    
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
                    <h2 class="page_title">PLANIFICACION ANUAL DE TECNICOS</h2>
                </div>
            </div>
            
            <div class="row">                
                <div class="col-sm-6">
                    <label for="client_id">CLIENTE:</label>
                    <select name="client_id" class="form-control" id="client_id" onchange="getTecnicosForClient()" required>
                        <option value='99'>[99][TODOS]</option>
                        <?php                                 
                            if(isset($clientes) && count($clientes)>0)
                            {
                                for($x=0;$x<count($clientes);$x++)
                                {
                                    echo '<option value='.$clientes[$x][0].'>['.$clientes[$x][0].']['.$clientes[$x][1].']</option>';
                                }
                            }
                        ?>
                    </select>
                    <div class="errmsg" id="error_cliente"></div>
                </div>
                 <div class="col-sm-6">
                    <label for="tecnico_id">TECNICO:</label>
                    <select name="tecnico_id" class="form-control" id="tecnico_id" required>
                        <option value='99'>[99][TODOS]</option>
                        
                    </select>
                    <div class="errmsg" id="error_tecnico_id"></div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <?php
                        if(isset($message))
                            echo '<h4>'.$message.'</h4>'
                    ?>
                    <button type="button" id="buscarPlanificaciones" class="btn btn-small btn_center">BUSCAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                    
                    <div class="progress" id="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div id="tbl_entidad_gestion">                        
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
