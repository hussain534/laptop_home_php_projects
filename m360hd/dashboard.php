<?php
    session_start();
    if(!isset($_SESSION['IN_SESSION']))
    {
        session_destroy();
        $url='index.php?err=98';
        header("Location:$url");
    }
    include_once('util.php');
    
    if(isset($_GET["err"]))
        $err=$_GET["err"];
    else 
        $err=1;


    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'dbcontroller.php';
    $controller = new controller();


?>
<div class="container">    
    <?php
    include_once('header.php');
    include_once('sessionData.php');
    ?>
    <br>
    <div class="row pageTitle">
        <div class="col-sm-12">
            <!-- RESUMEN DE ACTIVIDADES DESDE <?php echo $install_dt;?> HASTA LA FECHA ACTUAL -->
            RESUMEN DE ACTIVIDADES
        </div>
    </div>
    <br>
    <br>
    <br>
    

    <center>
        <?php
        if($_SESSION["user_perfil"]<=3)
        {
        ?>
            <div style="width:200px;display:inline-block;margin:10px">
                <a href=mostrarTodoTrabajo.php?status=99>
                    <p class="dashboardIcon dashboardIconNotificado">
                        TODOS
                    </p>
                    <p class="dashboard-count">
                        <?php 
                            echo count($controller->getAssignedTasksByStatus($databasecon,99,$DEBUG_STATUS));
                        ?>
                    </p>
                </a>
            </div>
        <?php
        }
        ?>
     <?php 
        $estadoTarea = $controller->getCatalogByType($databasecon,5,$DEBUG_STATUS);
        for($i=0;$i<count($estadoTarea);$i++)
        {
            if($_SESSION["user_perfil"]==4 && $estadoTarea[$i][0]!=39)
            {
        ?>
                <div style="width:200px;display:inline-block;margin:10px">
                    <a href=mostrarTodoTrabajo.php?status=<?php echo $estadoTarea[$i][0];?>>
                        <p class="dashboardIcon dashboardIconNotificado">
                            <?php echo $estadoTarea[$i][1];?>
                        </p>
                        <p class="dashboard-count">
                            <?php 
                                echo count($controller->getAssignedTasksByStatus($databasecon,$estadoTarea[$i][0],$DEBUG_STATUS));
                            ?>
                        </p>
                    </a>
                </div>
        <?php 
            }
            else if($_SESSION["user_perfil"]<=3 && $estadoTarea[$i][0]!=39)
            {
        ?>
                <div style="width:200px;display:inline-block;margin:10px">
                    <a href=mostrarTodoTrabajo.php?status=<?php echo $estadoTarea[$i][0];?>>
                        <p class="dashboardIcon dashboardIconNotificado">
                            <?php echo $estadoTarea[$i][1];?>
                        </p>
                        <p class="dashboard-count">
                            <?php 
                                echo count($controller->getAssignedTasksByStatus($databasecon,$estadoTarea[$i][0],$DEBUG_STATUS));
                            ?>
                        </p>
                    </a>
                </div>
        <?php 
            }
        }
    ?>
    </center>
<?php 
            
            if($_SESSION["user_perfil"]<=3)
            {
        ?>
    <div class="row">
        <div class="col-sm-12" style="background: white">
            <div class="row pageTitle">
                <div class="col-sm-12">
                    <!-- ACTIVIDADES ATENDIDOS POR TIPO DE NOTIFICACION Y TAREA DESDE <?php echo $install_dt;?> HASTA LA FECHA ACTUAL -->
                    ACTIVIDADES ATENDIDOS POR TIPO DE NOTIFICACION Y TAREA
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4 text-right">
                    <div margin:5px;">
                        <canvas id="myChartEstadosPorNotificacion2" width="800" height="450"></canvas>
                    </div>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-4 text-right">
                    <div margin:5px;">
                        <canvas id="myChartEstadosPorTarea2" width="800" height="450"></canvas>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>            
        </div>
    </div>


    <div class="row" style="background: white">
        <div class="col-sm-12">
            <div class="row pageTitle">
                <div class="col-sm-12">
                    <!-- ACTIVIDADES ATENDIDOS POR APLICACION DESDE <?php echo $install_dt;?> HASTA LA FECHA ACTUAL -->
                    ACTIVIDADES ATENDIDOS POR APLICACION
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 text-right">
                    <div margin:5px;">
                        <canvas id="myChartEstadosPorAplicacion2" width="800" height="450"></canvas>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>            
        </div>
    </div>

    <div class="row" style="background: white">
        <div class="col-sm-12">
            <div class="row pageTitle">
                <div class="col-sm-12">
                    <!-- ACTIVIDADES ATENDIDOS POR TIEMPO DESDE <?php echo $install_dt;?> HASTA LA FECHA ACTUAL -->
                    ACTIVIDADES ATENDIDOS POR TIEMPO
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 text-right">
                    <div margin:5px;">
                        <canvas id="myChartEstadosPorTiempo1" width="800" height="450"></canvas>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>            
        </div>
    </div>

    <?php
    }
?>

   


</div>