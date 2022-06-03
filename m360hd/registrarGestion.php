<?php
    //defined('__JEXEC') or ('Access denied');
    
    session_start();
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

    
    if(isset($_GET["tid"]) and $_GET["tid"]>0)
        $tid=$_GET["tid"];
    else
        $tid=0;
    $taskDtl = $controller->getTaskDetailsById($databasecon,$tid,$DEBUG_STATUS);
    $tasks = $controller->getGestionById($databasecon,$tid,$DEBUG_STATUS);
?>
<div class="container">
    <?php
        include_once('header.php');
        include_once('sessionData.php');
    ?>
        <br>
        
        <div class="row">
            <div class="col-sm-3 style="border-right:1px #ccc solid;"">
                <div class="row pageTitle">
                    <div class="col-sm-12">
                        DETALLES TAREA
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 inputData">
                        <label for="tipoTarea">TIPO TAREA (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" name="notificadoPor" id="notificadoPor" class="form-control" value="<?php echo $taskDtl[0][1];?>" readonly="true">
                    </div>
                    <div class="col-sm-6 inputData">
                        <label for="notificadoPorMedio">NOTIFICADO POR MEDIO (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" name="notificadoPor" id="notificadoPor" class="form-control" value="<?php echo $taskDtl[0][2];?>" readonly="true">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 inputData">
                        <label for="notificadoPor">NOTIFICADO POR (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" name="notificadoPor" id="notificadoPor" class="form-control" value="<?php echo $taskDtl[0][3];?>" readonly="true">
                    </div>
                    <div class="col-sm-6 inputData">
                        <label for="notificadoPor">RECIBIDO POR (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" name="notificadoPor" id="notificadoPor" class="form-control" value="<?php echo $taskDtl[0][5];?>" readonly="true">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 inputData">
                        <label for="prioridad">PRIORIDAD (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" name="notificadoPor" id="notificadoPor" class="form-control" value="<?php echo $taskDtl[0][8];?>" readonly="true">
                    </div>
                    <div class="col-sm-6 inputData">
                        <label for="fechaNotificacion">FECHA NOTIFICACION (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" name="fechaNotificacion" id="fechaNotificacion" class="form-control" value="<?php echo $taskDtl[0][4];?>" readonly="true">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 inputData">
                        <label for="id_tecnico">TECNICO ASIGNADO(<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" name="notificadoPor" id="notificadoPor" class="form-control" value="<?php echo $taskDtl[0][6];?>" readonly="true">
                    </div>
                    <div class="col-sm-6 inputData">
                        <label for="servicioAppl">SERVICIO / APLICACION (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" name="notificadoPor" id="notificadoPor" class="form-control" value="<?php echo $taskDtl[0][9];?>" readonly="true">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 inputData">
                        <label for="descBreveTarea">ASUNTO DEL TRABAJO (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" class="form-control" id="descBreveTarea" name="descBreveTarea" value="<?php echo $taskDtl[0][10];?>" readonly="true">
                        <div class="errmsg" id="error_descBreveTarea"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 inputData">
                        <label for="descCompTarea">DESC COMPLETO DEL TRABAJO(4500 caracteres) (<span class="mandatoryCheck">*</span>)</label>
                        <textarea class="form-control" name="descCompTarea" id="descCompTarea" value="" rows="8" maxlength=4500 readonly="true"><?php echo $taskDtl[0][11];?></textarea> 
                        <div class="errmsg" id="error_descCompTarea"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 inputData">
                        <label for="listaServidores">IP DE SERVIDORES(4500 caracteres) (<span class="mandatoryCheck">*</span>)</label>
                        <textarea class="form-control" name="listaServidores" id="listaServidores" value="" rows="8" maxlength=4500 readonly="true"><?php echo $taskDtl[0][12];?></textarea> 
                        <div class="errmsg" id="error_descCompTarea"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 inputData">
                        <label for="fileToUpload">DOCUMENTO (<span class="mandatoryCheck">*</span>)</label>
                        <input type="file" class="form-control" id="fileToUpload" name="fileToUpload" placeholder="Ingresa titulo del tarea">
                        <div class="errmsg" id="error_descBreveTarea"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="container">
                    <div class="row pageTitle">
                        <div class="col-sm-12">
                            REGISTRAR GESTION
                        </div>
                    </div>
                    <form method="post" action="controller.php?controller=3&task=4" enctype="multipart/form-data">
                        <input type="hidden" name="tid" id="tid" value="<?php echo $tid;?>">
                        <div class="row">            
                            <div class="col-sm-4 inputData">
                                <label for="estadoTarea">ESTADO (<span class="mandatoryCheck">*</span>)</label>
                                <select name="estadoTarea" class="form-control" id="estadoTarea" required>
                                    <?php 
                                        $estadoTarea = $controller->getCatalogByType($databasecon,5,$DEBUG_STATUS);
                                        for($i=0;$i<count($estadoTarea);$i++)
                                        {
                                            if($estadoTarea[$i][0]==31 || $estadoTarea[$i][0]==32 || $estadoTarea[$i][0]==39 || $estadoTarea[$i][0]==46 || $estadoTarea[$i][0]==47)
                                            {
                                            
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
                            <div class="col-sm-4 inputData" id="delegacion">
                                <label for="id_tecnico_new">DELEGAR A (<span class="mandatoryCheck">*</span>)</label>
                                <select name="id_tecnico_new" class="form-control" id="id_tecnico_new" required>
                                    <?php 
                                        $id_tecnico = $controller->getUsersListByPerfil($databasecon,4,$DEBUG_STATUS);
                                        for($i=0;$i<count($id_tecnico);$i++)
                                        {
                                            if($id_tecnico[$i][0]==$_SESSION["user_id"])
                                            {
                                            ?>
                                                <option value=<?php echo $id_tecnico[$i][0];?> selected="true"><?php echo $id_tecnico[$i][1];?></option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                <option value=<?php echo $id_tecnico[$i][0];?>><?php echo $id_tecnico[$i][1];?></option>
                                            <?php
                                            }                            
                                        }
                                        $id_tecnico = $controller->getUsersListByPerfil($databasecon,2,$DEBUG_STATUS);
                                        for($i=0;$i<count($id_tecnico);$i++)
                                        {
                                            if($id_tecnico[$i][0]==$_SESSION["user_id"])
                                            {
                                            ?>
                                                <option value=<?php echo $id_tecnico[$i][0];?> selected="true"><?php echo $id_tecnico[$i][1];?></option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                <option value=<?php echo $id_tecnico[$i][0];?>><?php echo $id_tecnico[$i][1];?></option>
                                            <?php
                                            }                            
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-4 inputData">
                                <label for="tecnologiaProducto">TECNOLOGIA / PRODUCTO (<span class="mandatoryCheck">*</span>)</label>
                                <select name="tecnologiaProducto" class="form-control" id="tecnologiaProducto" required>
                                    <?php 
                                        $tecnologiaProducto = $controller->getCatalogByType($databasecon,4,$DEBUG_STATUS);
                                        for($i=0;$i<count($tecnologiaProducto);$i++)
                                        {
                                            ?>
                                                <option value=<?php echo $tecnologiaProducto[$i][0];?>><?php echo '['.$tecnologiaProducto[$i][0].']:'.$tecnologiaProducto[$i][1];?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 inputData">
                                <label for="solucionAplicado">SOLUCION APLICADO (4500 caracteres) (<span class="mandatoryCheck">*</span>)</label>
                                <textarea class="form-control" name="solucionAplicado" id="solucionAplicado" rows="5" placeholder="Ingresa descripcion completo del tarea" maxlength=4500 required></textarea> 
                                <div class="errmsg" id="error_descCompTarea"></div>
                            </div>
                            <div class="col-sm-6 inputData">
                                <label for="causaProblema">CAUSA DEL PROBLEMA (4500 caracteres) (<span class="mandatoryCheck">*</span>)</label>
                                <textarea class="form-control" name="causaProblema" id="causaProblema" rows="5" placeholder="Ingresa descripcion completo del tarea" maxlength=4500></textarea> 
                                <div class="errmsg" id="error_descCompTarea"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 inputData">
                                <label for="impactProblema">IMPACTO DEL PROBLEMA (4500 caracteres) (<span class="mandatoryCheck">*</span>)</label>
                                <textarea class="form-control" name="impactProblema" id="impactProblema" rows="5" placeholder="Ingresa descripcion completo del tarea" maxlength=4500></textarea> 
                                <div class="errmsg" id="error_descCompTarea"></div>
                            </div>
                            <div class="col-sm-6 inputData">
                                <label for="comentarios">COMENTARIOS / OBSERVACION (4500 caracteres) (<span class="mandatoryCheck">*</span>)</label>
                                <textarea class="form-control" name="comentarios" id="comentarios" rows="5" placeholder="Ingresa descripcion completo del tarea" maxlength=4500></textarea> 
                                <div class="errmsg" id="error_descCompTarea"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 inputData">
                                <label for="fileToUpload">DOCUMENTO (<span class="mandatoryCheck">*</span>)</label>
                                <input type="file" class="form-control" id="fileToUpload" name="fileToUpload" placeholder="Ingresa titulo del tarea">
                                <div class="errmsg" id="error_descBreveTarea"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="base_conocimiento">DESEA MARCAR COMO BASE DE CONOCIMIENTO</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" name="base_conocimiento" value="0" checked="true">NO</label>
                            </div>
                            <div class="col-sm-2 inputData">
                                <input type="radio" name="base_conocimiento" value="1" >YES</label>
                            </div>
                        </div>
                        <?php 
                            if($taskDtl[0][19]!=6 || (strcmp($taskDtl[0][1], 'BITACORA'))==0)
                            {
                        ?>
                            <div class="row">
                                <button type="submit" class="btn btn-info navbar-btn btn-warning btn_center" title="Click to enter our portal">REGISTRAR GESTION<span class="glyphicon glyphicon-chevron-right"></span></button>
                            </div>
                        <?php        
                            }
                            else
                            {
                                echo '<br>';
                            }
                        ?>
                        
                    </form>
                    <div class="row pageTitle">
                        <div class="col-sm-12">
                            DETALLES DE GESTION
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr style="background:burlywood">
                                    <td>ID</td>
                                    <td>SOLUCION</td>
                                    <td>CAUSA</td>
                                    <td>IMPACTO</td>
                                    <td>COMENTARIOS</td>
                                    <td>FECHA GESTION</td>
                                    <td>GESTIONADO POR</td>
                                    <td>DOC. GESTION</td>
                                    <td>ESTADO</td>
                                    <td>TECNICO</td>
                                    <td>TECNOLOGIA</td>
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
                                    <td><?php echo $tasks[$x][2];?></td>
                                    <td><?php echo $tasks[$x][3];?></td>
                                    <td><?php echo $tasks[$x][4];?></td>
                                    <td><?php echo $tasks[$x][5];?></td>
                                    <td><?php echo $tasks[$x][6];?></td>
                                    <td>
                                        <?php 
                                            if(isset($tasks[$x][7]) && !empty($tasks[$x][7]) && strcmp('uploads/',$tasks[$x][7])!=0) 
                                            {
                                        ?>
                                            <a href=<?php echo $tasks[$x][7];?> target="0"><span class="glyphicon glyphicon-list-alt glyphicon-list-alt-doc-exist"></span></a> 
                                        <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $tasks[$x][8];?></td>
                                    <td><?php echo $tasks[$x][9];?></td>
                                    <td><?php echo $tasks[$x][10];?></td>
                                </tr>
                            
                    <?php
                        }
                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <br>
</div>