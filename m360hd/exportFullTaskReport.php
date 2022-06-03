<?php
    session_start();
    if(!isset($_SESSION['IN_SESSION']))
    {
        session_destroy();
        $url='index.php?err=98';
        header("Location:$url");
    }
    include_once('util.php');
    //include_once('header.php');

    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'dbcontroller.php';
    $controller = new controller();


    $msg='';
    if(isset($_SESSION["err_code"]))
    {
        if($_SESSION["err_code"]==0)
        {
            $msg= "Error en registrar tarea. Intenta mas tarde";
        }
        else if($_SESSION["err_code"]==1)
        {
            $msg= "Su tarea registrado correctamente.";
        }
        else if($_SESSION["err_code"]==2)
        {
            $msg= "Su tarea eliminado correctamente.";
        }
        else if($_SESSION["err_code"]==3)
        {
            $msg= "Su tarea modificado correctamente.";
        }
        unset($_SESSION["err_code"]);
    }

    $status=-1;

    if(isset($_POST["estadoTarea"]))
        $status=$_POST["estadoTarea"];

    $id_tecnicoStr=-1;

    if(isset($_POST["id_tecnico"]))
        $id_tecnicoStr=$_POST["id_tecnico"];

    if(isset($_POST["fechaNotificacionInicio"]))
    {
        $fechaInicio=$_POST["fechaNotificacionInicio"];
        //echo '<br>fechaInicio:'.$fechaInicio;
    }
    if(isset($_POST["fechaNotificacionFin"]))
    {
        $fechaFin=$_POST["fechaNotificacionFin"];
        //echo '<br>fechaFin:'.$fechaFin;
    }
    if(!isset($_POST["fechaNotificacionInicio"]) || !isset($_POST["fechaNotificacionFin"]))
    {
        //echo '<br>';   
    }
    else
        $tasks = $controller->getAssignedTasksInRangeByStatus($databasecon,$status,$fechaInicio.' 00:00:00',$fechaFin.' 23:59:59',$id_tecnicoStr,$DEBUG_STATUS);
    
    

    $uri = $_SERVER['REQUEST_URI'];     
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION["last_url"]=$url;

?>
<div class="container">
    <?php
    include_once('header.php');
    include_once('sessionData.php');
    ?>
    <br>

    <div class="row pageTitle">
        <div class="col-sm-12">
            REPORTE DE TRABAJOS            
        </div>
    </div>
    <br>
    <center>

        <form method="post" action="exportFullTaskReport.php" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-2 inputData">
                    <label for="fechaNotificacionInicio">FECHA NOTIFICACION INICIO(<span class="mandatoryCheck">*</span>)</label>
                    <input type="date" name="fechaNotificacionInicio" id="fechaNotificacionInicio" value="<?php if(isset($fechaInicio)) echo $fechaInicio;?>" class="form-control"required>
                </div>

                <div class="col-sm-2 inputData">
                    <label for="fechaNotificacionFin">FECHA NOTIFICACION FIN(<span class="mandatoryCheck">*</span>)</label>
                    <input type="date" name="fechaNotificacionFin" id="fechaNotificacionFin" value="<?php if(isset($fechaFin)) echo $fechaFin;?>" class="form-control"required>
                </div>
                <div class="col-sm-2 inputData">
                    <label for="id_tecnico">TECNICO (<span class="mandatoryCheck">*</span>)</label>
                    <select name="id_tecnico" class="form-control" id="id_tecnico" required>
                        <option value=-1 selected="true">TODOS</option>
                        <?php 
                            $id_tecnico = $controller->getUsersListByPerfil($databasecon,4,$DEBUG_STATUS);
                            for($i=0;$i<count($id_tecnico);$i++)
                            {
                                if($id_tecnico[$i][0]==$_POST["id_tecnico"])
                                {
                                ?>
                                    <option value=<?php echo $id_tecnico[$i][0];?> selected="true"><?php echo $id_tecnico[$i][1];?></option>      
                                <?php    
                                }
                                else
                                {
                                ?>
                                    <option value=<?php echo $id_tecnico[$i][0];?> ><?php echo $id_tecnico[$i][1];?></option>      
                                <?php                                        
                                }                            
                            }
                            $id_tecnico = $controller->getUsersListByPerfil($databasecon,2,$DEBUG_STATUS);
                            for($i=0;$i<count($id_tecnico);$i++)
                            {
                                if($id_tecnico[$i][0]==$_POST["id_tecnico"])
                                {
                                ?>
                                    <option value=<?php echo $id_tecnico[$i][0];?> selected="true"><?php echo $id_tecnico[$i][1];?></option>      
                                <?php    
                                }
                                else
                                {
                                ?>
                                    <option value=<?php echo $id_tecnico[$i][0];?> ><?php echo $id_tecnico[$i][1];?></option>      
                                <?php                                        
                                }                            
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-2 inputData">
                    <label for="estadoTarea">ESTADO (<span class="mandatoryCheck">*</span>)</label>
                    <select name="estadoTarea" class="form-control" id="estadoTarea" required>
                        <option value=-1 selected="true">TODOS</option>
                        <?php 
                            $estadoTarea = $controller->getCatalogByType($databasecon,5,$DEBUG_STATUS);
                            for($i=0;$i<count($estadoTarea);$i++)
                            {
                                if($estadoTarea[$i][0]==32 || $estadoTarea[$i][0]==39)
                                {
                                
                                }
                                else if($estadoTarea[$i][0]==$_POST["estadoTarea"])
                                {
                                ?>
                                    <option value=<?php echo $estadoTarea[$i][0];?> selected="true"><?php echo '['.$estadoTarea[$i][0].']:'.$estadoTarea[$i][1];?></option>
                                <?php
                                }
                                else
                                {
                                ?>
                                    <option value=<?php echo $estadoTarea[$i][0];?>><?php echo '['.$estadoTarea[$i][0].']:'.$estadoTarea[$i][1];?></option>
                                <?php
                                }                            
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-2"></div>
            </div>
            <div class="row">
                <div class="col-sm-5"></div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-info navbar-btn btn-warning btn_center">BUSCAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                </div>
                <div class="col-sm-5"></div>
            </div>
        </form>
        
    </center>
    <br>
    <?php
        
        if(isset($tasks))
            echo '<h4>Encontrado '.count($tasks).' tareas recibidos dentro fechas '.$fechaInicio.' 00:00:00 y '.$fechaFin.' 23:59:59 </h4><a href=utilityExportToExcel.php?fechaNotificacionInicio='.$fechaInicio.'&fechaNotificacionFin='.$fechaFin.'&status='.$status.'&id_tecnicoStr='.$id_tecnicoStr.'><button type="button" class="btn btn-info navbar-btn btn-warning">EXPOTAR A EXCEL</button></a>'
    ?>
    
    <?php
        if(isset($tasks))
        {
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr style="background:burlywood">
                            <td>ID</td>
                            <td>TIPO</td>
                            <td>DETTALE NOTIFICACION</td>
                            <td>DETALLE ASIGNACION</td>
                            <td>PRIORIDAD</td>
                            <td>SERVICIO / APLICACION</td>
                            <td>DETALLES TAREA</td>
                            <td>DOCUMENTO DE TAREA</td>
                            <td>EMAIL ENVIDO</td>
                            <td>LLAMADA REALIZADO</td>
                            <td>GESTION REALIZADO</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($tasks);$x++)
                {
            ?>
                        <tr>
                            <td><?php echo $tasks[$x][0];?></td>
                            <td><?php echo $tasks[$x][1];?></td>                            
                            <td><?php echo $tasks[$x][2].'<br>'.$tasks[$x][3].'<br>'.$tasks[$x][4].'<br>'.$tasks[$x][5];?></td>
                            <td><?php echo $tasks[$x][6].'<br>'.$tasks[$x][7];?></td>
                            <td><?php echo $tasks[$x][8];?></td>
                            <td><?php echo $tasks[$x][9].'<br>'.$tasks[$x][12];?></td>
                            <td style="max-width: 500px"><?php echo $tasks[$x][15].'<br>'.$tasks[$x][16].'<br>'.$tasks[$x][17].'<br>'.'<b>'.$tasks[$x][10].'</b><br>'.$tasks[$x][11];?></td>
                            <td>
                                <?php 
                                    if(isset($tasks[$x][18]) && !empty($tasks[$x][18]) && strcmp('uploads/',$tasks[$x][18])!=0) 
                                    {
                                ?>
                                    <a href=<?php echo $tasks[$x][18];?> target="0"><span class="glyphicon glyphicon-list-alt glyphicon-list-alt-doc-exist"></span></a> 
                                <?php
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if(!isset($tasks[$x][13]) || empty($tasks[$x][13])) 
                                    {
                                ?>
                                    <a href=controller.php?controller=3&task=1&medio=1&id=<?php echo $tasks[$x][0];?>><span class="glyphicon glyphicon-send"></span></a> 
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                    <span class="glyphicon glyphicon-send glyphicon-send-done"></span>
                                <?php        
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if(!isset($tasks[$x][14]) || empty($tasks[$x][14])) 
                                    {
                                ?>
                                    <a href=controller.php?controller=3&task=1&medio=2&id=<?php echo $tasks[$x][0];?>><span class="glyphicon glyphicon-phone-alt"></span></a> 
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                    <span class="glyphicon glyphicon-phone-alt glyphicon-phone-alt-done"></span>
                                <?php        
                                    }
                                ?>
                            </td>
                            <td class="text-center"><a href="registrarGestion.php?tid=<?php echo $tasks[$x][0];?>"><span class="glyphicon glyphicon-th-list" style="color:purple !important; font-size: xx-large;"></span><span class="badge"><?php echo $tasks[$x][20];?></span></a>
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