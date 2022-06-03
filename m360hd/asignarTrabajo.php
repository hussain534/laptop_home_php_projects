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
    //echo $_SESSION["err_code"];
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
        unset($_SESSION["err_code"]);
    }

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
    <?php
            if(strlen($msg)>0)
            {
            ?>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center">
            
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $msg;?>
            </div>
           
        </div>
        <div class="col-sm-3"></div>
    </div>
     <?php
            }
            ?>
    <div class="row">
        <div class="col-sm-3" style="border-right:1px #ccc solid;">
            <div class="row pageTitle">
                <div class="col-sm-12">
                    ASIGNAR NUEVO TRABAJO            
                </div>
            </div>
            <!-- <a href="DocsTemplates/KNOWLEDGE BASE - INCIDENTES_ERRORS.doc">DESCARGAR TEMPLATE - KNOWLEDGE BASE - INCIDENTES_ERRORS</a><br>
            <a href="DocsTemplates/KNOWLEDGE BASE - CONOCIMIENTO.doc">DESCARGAR TEMPLATE - KNOWLEDGE BASE - CONOCIMIENTO</a> -->
            
            <form method="post" action="controller.php?controller=3&task=0" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6 inputData">
                        <label for="tipoTarea">TIPO TAREA (<span class="mandatoryCheck">*</span>)</label>
                        <select name="tipoTarea" class="form-control" id="tipoTarea" required>
                            <?php 
                                $tipoTarea = $controller->getCatalogByType($databasecon,3,$DEBUG_STATUS);
                                for($i=0;$i<count($tipoTarea);$i++)
                                {
                            ?>
                                    <option value=<?php echo $tipoTarea[$i][0];?>><?php echo $tipoTarea[$i][1];?></option>
                            <?php        
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-6 inputData">
                        <label for="notificadoPorMedio">NOTIFICADO POR MEDIO (<span class="mandatoryCheck">*</span>)</label>
                        <select name="notificadoPorMedio" class="form-control" id="notificadoPorMedio" required>
                            <?php 
                                $notificadoPorMedio = $controller->getCatalogByType($databasecon,7,$DEBUG_STATUS);
                                for($i=0;$i<count($notificadoPorMedio);$i++)
                                {
                            ?>
                                    <option value=<?php echo $notificadoPorMedio[$i][0];?>><?php echo $notificadoPorMedio[$i][1];?></option>
                            <?php        
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 inputData">
                        <label for="notificadoPor">NOTIFICADO POR (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" name="notificadoPor" id="notificadoPor" class="form-control" placeholder="NOMBRE DEL PERSONA" required>
                    </div>
                    <div class="col-sm-6 inputData">
                        <label for="prioridad">PRIORIDAD (<span class="mandatoryCheck">*</span>)</label>
                        <select name="prioridad" class="form-control" id="notificadoPorMedio" required>
                            <?php 
                                $prioridad = $controller->getCatalogByType($databasecon,6,$DEBUG_STATUS);
                                for($i=0;$i<count($prioridad);$i++)
                                {
                            ?>
                                    <option value=<?php echo $prioridad[$i][0];?>><?php echo $prioridad[$i][1];?></option>
                            <?php        
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 inputData">
                        <label for="fechaNotificacion">FECHA NOTIFICACION (<span class="mandatoryCheck">*</span>)</label>
                        <input type="date" name="fechaNotificacion" id="fechaNotificacion" class="form-control"required>
                    </div>
                    <div class="col-sm-6 inputData">
                        <label for="horaNotificacion">HORA NOTIFICACION (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" name="horaNotificacion" id="horaNotificacion" placeholder="HH:MM" class="form-control"required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 inputData">
                        <label for="id_tecnico">ASIGNAR TECNICO (<span class="mandatoryCheck">*</span>)</label>
                        <select name="id_tecnico" class="form-control" id="id_tecnico" required>
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
                                        <option value=<?php echo $id_tecnico[$i][0];?> ><?php echo $id_tecnico[$i][1];?></option>      
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
                                        <option value=<?php echo $id_tecnico[$i][0];?> ><?php echo $id_tecnico[$i][1];?></option>      
                                    <?php                                        
                                    }                            
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-6 inputData">
                        <label for="servicioAppl">SERVICIO / APLICACION (<span class="mandatoryCheck">*</span>)</label>
                        <select name="servicioAppl" class="form-control" id="servicioAppl" required>
                            <?php 
                                $servicioAppl = $controller->getCatalogByType($databasecon,1,$DEBUG_STATUS);
                                for($i=0;$i<count($servicioAppl);$i++)
                                {
                            ?>
                                    <option value=<?php echo $servicioAppl[$i][0];?>><?php echo $servicioAppl[$i][1];?></option>
                            <?php        
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 inputData">
                        <label for="descBreveTarea">ASUNTO DEL TRABAJO (<span class="mandatoryCheck">*</span>)</label>
                        <input type="text" class="form-control" id="descBreveTarea" name="descBreveTarea" placeholder="Ingresa titulo del tarea" required>
                        <div class="errmsg" id="error_descBreveTarea"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 inputData">
                        <label for="descCompTarea">DESC COMPLETO DEL TRABAJO(4500 caracteres) (<span class="mandatoryCheck">*</span>)</label>
                        <textarea class="form-control" name="descCompTarea" id="descCompTarea" value="" rows="8" placeholder="Ingresa descripcion completo del tarea" maxlength=4500 required></textarea> 
                        <div class="errmsg" id="error_descCompTarea"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 inputData">
                        <label for="listaServidores">IP DE SERVIDORES(4500 caracteres) (<span class="mandatoryCheck">*</span>)</label>
                        <textarea class="form-control" name="listaServidores" id="listaServidores" value="" rows="8" placeholder="Ingresa IP de servidores involucardos en trabajo(separado por ; )" maxlength=4500 required></textarea> 
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
                    <button type="submit" class="btn btn-info navbar-btn btn-warning btn_center" title="Click to enter our portal">ASIGNAR TRABAJO<span class="glyphicon glyphicon-chevron-right"></span></button>
                </div>
            </form>
        </div>
        <div class="col-sm-9">
            <?php
                include_once('mostrarTrabajo.php');
            ?>
        </div>
    </div>
    
    <br>
</div>