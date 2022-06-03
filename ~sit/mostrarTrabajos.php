<?php
    //defined('__JEXEC') or ('Access denied');
    
    session_start();
    include_once('util.php');
    include_once('header.php');

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
    if(isset($_SESSION["tasks"]))
    {
        $tasks= $_SESSION["tasks"];
        unset($_SESSION["tasks"]);
    }
    else
        $tasks = $controller->getMyRegisteredTasks($databasecon,$DEBUG_STATUS);
    
?>
<div class="container">
    <?php
    include_once('sessionData.php');
    ?>
    <br>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center">
            <?php
            if(strlen($msg)>0)
            {
            ?>
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $msg;?>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="col-sm-3"></div>
    </div>
    
    <!-- <button id="busquedaBtn" class="btn btn-info navbar-btn btn-success" data-toggle="collapse" data-target="#demo">ABRIR PANEL DE BUSQUEDA</button> -->

    <div id="demo">
        <input type="hidden" id="busquedaBtnValue" value="1">
        <input type="hidden" id="userDropDownValue" value="<?php if(isset($_SESSION["user"])) echo $_SESSION["user"];?>" >
        <form method="post" action="controller.php?controller=1&task=3">
        <div class="row">
            <div class="col-sm-2 inputData">
                <label for="projectCode">PROYECTO (<span class="mandatoryCheck">*</span>)</label>
                <select name="projectCode" class="form-control" id="projectCode" required>
                    <option value="0">TODOS</option>
                    <option value="1">MULTICANALIDAD</option>
                    <option value="2">PORTAL</option>
                    <option value="3">CONTINGENCIA</option>
                    <option value="99">OTRO</option>
                </select>
                <!-- <label for="projectCode">CODIGO DEL PROYECTO (<span class="mandatoryCheck">*</span>)</label>
                <input type="text" class="form-control" id="projectCode" name="projectCode" placeholder="Ingresa codigo del proyecto" required>
                <div class="errmsg" id="error_projectCode"></div> -->
            </div>
            <div class="col-sm-2 inputData">
                <label for="id_ambiente">AMBIENTE (<span class="mandatoryCheck">*</span>)</label>
                <select name="id_ambiente" class="form-control" id="id_ambiente" required>
                    <option value="0">TODOS</option>
                    <option value="1">PRODUCCION</option>
                    <option value="2">PRE-PRODUCCION</option>
                    <option value="3">CONTINGENCIA</option>
                    <option value="4">CALIDAD</option>
                    <option value="5">DESARROLLO</option>
                    <option value="99">OTRO</option>
                </select>
            </div>
            <!-- <div class="col-sm-3 inputData">
                <label for="projectCode">CODIGO DEL PROYECTO</label>
                <input type="text" class="form-control" id="projectCode" name="projectCode" value="<?php if(isset($_SESSION["codProyecto"])) echo $_SESSION["codProyecto"];?>"  placeholder="Ingresa codigo del proyecto">
                <div class="errmsg" id="error_projectCode"></div>
            </div> -->
            <div class="col-sm-2 inputData">
                <label for="taskDate">FECHA INICIO DEL TRABAJO (<span class="mandatoryCheck">*</span>)</label>
                <input type="date" class="form-control" id="taskDateInicial" name="taskDateInicial" value="<?php if(isset($_SESSION["fechaInicio"])) echo $_SESSION["fechaInicio"];?>" placeholder="Ingresa fecha inicio del tarea" required>
                <div class="errmsg" id="error_taskDate"></div>
            </div>
            <div class="col-sm-2 inputData">
                <label for="taskDate">FECHA FINAL DEL TRABAJO (<span class="mandatoryCheck">*</span>)</label>
                <input type="date" class="form-control" id="taskDateFinal" name="taskDateFinal" value="<?php if(isset($_SESSION["fechaFin"])) echo $_SESSION["fechaFin"];?>" placeholder="Ingresa fecha final del tarea" required>
                <div class="errmsg" id="error_taskDate"></div>
            </div>
        
            <div class="col-sm-2 inputData">
                <label for="categorea_tarea">CATEGORIA DE TAREA (<span class="mandatoryCheck">*</span>)</label>
                <select name="categorea_tarea" class="form-control" id="categorea_tarea" required>
                    <option value="0">TODOS</option>
                    <option value="1">SOPORTE</option>
                    <option value="2">ADMINISTRACION</option>
                    <option value="3">MEJORAS</option>
                    <option value="4">VALOR AGREGADO</option>
                </select>
            </div>
            <?php
            if($_SESSION["user_perfil"]==1)
            {
            ?>
            <div class="col-sm-2 inputData">
                <label for="taskDate">TECNICO (<span class="mandatoryCheck">*</span>)</label>
                <select class="form-control" id="taskOwner" name="taskOwner">
                    <option value="-1">Todos</option>
                    <?php
                        $tecnicos = $controller->getUsersListByPerfil($databasecon,2,$DEBUG_STATUS);
                        for($x=0;$x<count($tecnicos);$x++)
                        {
                    ?>
                            <option value="<?php echo $tecnicos[$x][0];?>"><?php echo $tecnicos[$x][1];?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <?php
            }
            else
            {
            ?>            
                <input type="hidden" class="form-control" id="taskOwner" name="taskOwner" value=<?php echo $_SESSION["user_id"];?> readonly="true">                
            <?php
            }
            ?>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-info navbar-btn btn-warning" style="margin-left: 10px;" title="Click to enter our portal">BUSCAR TRABAJO<span class="glyphicon glyphicon-chevron-right"></span></button>
        </div>
    </form>
    </div>

    <?php
        
        if(isset($tasks))
            echo '<h4>Encontrado '.count($tasks).' tareas registrado</h4>'
    ?>
    
    <?php
        if(isset($tasks) && $_SESSION["table_view"]==0)
        {
            ?>
            <div class="row tblData">
            <?php
                for($x=0;$x<count($tasks);$x++)
                {
                    ?>
                    <div class="col-sm-3 poster">
                        <div class="row poster-header">
                            <div class="col-sm-2">
                                <div class="poster-id">
                                    <?php echo $tasks[$x][0]; ?>
                                </div>
                            </div>
                            <div class="col-sm-7 poster-title">
                                <?php echo $tasks[$x][1]; ?>
                            </div>
                            <div class="col-sm-3 poster-duration">
                                <?php echo $tasks[$x][3].' min'; ?>
                            </div>
                        </div>
                        <div class="row poster-short-desc">
                            <div class="col-sm-12">
                                <?php echo $tasks[$x][2].'<br>'.$tasks[$x][5]; ?>
                            </div>
                        </div>
                        <div class="row poster-desc">
                            <div class="col-sm-12">
                                <?php echo $tasks[$x][6]; ?>
                            </div>
                        </div>
                        <div class="row poster-actions">
                            <div class="col-sm-12 text-right">
                                <!-- 
                                <a href=editarTrabajo.php?id=<?php echo $tasks[$x][0];?>><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href=controller.php?controller=1&task=1&id=<?php echo $tasks[$x][0];?>><span class="glyphicon glyphicon glyphicon-remove"></span></a>
                                 -->
                                <a href=controller.php?controller=1&task=1&id=<?php echo $tasks[$x][0];?> class="linkBtn"><button type="button" class="btn btn-info navbar-btn btn-danger btn_center" title="Click to enter our portal">ELIMINAR TAREA<span class="glyphicon glyphicon-chevron-right"></span></button></a>
                                <a href=editarTrabajo.php?id=<?php echo $tasks[$x][0];?> class="linkBtn"><button type="button" class="btn btn-info navbar-btn btn-success btn_center" title="Click to enter our portal">EDITAR TAREA<span class="glyphicon glyphicon-chevron-right"></span></button></a>
                                
                            </div>
                        </div>
                    </div>
                <?php
                }
            ?>
            </div>
            <?php
        }
        else if(isset($tasks) && $_SESSION["table_view"]==1)
        {
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>FECHA ACTIVIDAD</td>
                            <td>PROYECTO</td>
                            <td>ACTIVIDAD</td>
                            <td>HORA INICIO</td>
                            <td>HONA FIN</td>
                            <td>TIEMPO INDISPONIBILIDAD</td>
                            <td>TITULO</td>
                            <td>ACTIVIDAD REALIZADA</td>
                            <td>DOCUMENTO</td>
                            <td>AMBIENTE</td>                            
                            <td>APROBADO CLIENTE</td>
                            <td>NOMBRE TECNICO</td>
                            <td style="text-align:center">ACCION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($tasks);$x++)
                {
            ?>
                        <tr>
                            <td><?php echo $tasks[$x][0];?></td>
                            <td width="150px"><?php echo $tasks[$x][2];?></td>
                            <td><?php echo $tasks[$x][8];?></td>
                            <td><?php echo $tasks[$x][13];?></td>
                            <td><?php echo $tasks[$x][3];?></td>
                            <td><?php echo $tasks[$x][4];?></td>
                            <td><?php echo $tasks[$x][7];?></td>
                            <td style="text-align:justify"><?php echo $tasks[$x][5];?></td>
                            <td style="text-align:justify"><?php echo $tasks[$x][6];?></td>
                            <td>
                                <?php 
                                    if(isset($tasks[$x][14]) && !empty($tasks[$x][14]) && strcmp('uploads/',$tasks[$x][14])!=0) 
                                    {
                                ?>
                                    <a href=<?php echo $tasks[$x][14];?> target="0"><span class="glyphicon glyphicon-list-alt glyphicon-list-alt-doc-exist"></span></a> 
                                <?php
                                    }
                                    else 
                                    {
                                ?>
                                        <span class="glyphicon glyphicon-list-alt glyphicon-list-alt-no-doc"></span>
                                <?php
                                    }
                                ?>
                            </td>
                            <td><?php echo $tasks[$x][10];?></td>                            
                            <td><?php echo $tasks[$x][11];?></td>
                            <td><?php echo $tasks[$x][12];?></td>
                            <td width="150px">
                                <a href=controller.php?controller=1&task=1&id=<?php echo $tasks[$x][0];?> class="linkBtn"><button type="button" class="btn btn-info navbar-btn btn-danger btn_center" title="Click to enter our portal"><span class="glyphicon glyphicon-remove"></span></button></a>
                                <a href=editarTrabajo.php?id=<?php echo $tasks[$x][0];?> class="linkBtn"><button type="button" class="btn btn-info navbar-btn btn-success btn_center" title="Click to enter our portal"><span class="glyphicon glyphicon-pencil"></span></button></a>
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