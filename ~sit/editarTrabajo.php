<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('util.php');
    include_once('header.php');

    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'dbcontroller.php';
    $controller = new controller();
    $id=$_GET["id"];
    $taskDtl = $controller->getTaskDtlById($databasecon,$id,$DEBUG_STATUS);
    

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
        unset($_SESSION["err_code"]);
    }
    
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
    <br>
    <div class="row pageTitle">
        <div class="col-sm-12">
            EDITAR TRABAJO : <?php echo $id;?>      
        </div>
    </div>
    
    <form method="post" action="controller.php?controller=1&task=2" enctype="multipart/form-data">
        <input type="hidden" class="form-control" id="id" name="id" value=<?php echo $id;?>>
        <input type="hidden" class="form-control" id="doc_path_prev" name="doc_path_prev" value=<?php echo $taskDtl[0][13];?>>
        <input type="hidden" class="form-control" id="taskId" name="taskId" value=<?php echo $taskDtl[0][11];?> readonly="true">
        <div class="row">
            <div class="col-sm-3 inputData">
                <label for="projectCode">PROYECTO (<span class="mandatoryCheck">*</span>)</label>
                <select name="projectCode" class="form-control" id="projectCode" required>
                    <option value="1" <?php if($taskDtl[0][1]==1) echo 'selected';?>>MULTICANALIDAD</option>                    
                    <option value="2" <?php if($taskDtl[0][1]==2) echo 'selected';?>>PORTAL</option>
                    <option value="3" <?php if($taskDtl[0][1]==3) echo 'selected';?>>CONTINGENCIA</option>
                    <option value="99" <?php if($taskDtl[0][1]==4) echo 'selected';?>>OTRO</option>
                </select>
                <!-- <label for="projectCode">CODIGO DEL PROYECTO (<span class="mandatoryCheck">*</span>)</label>
                <input type="text" class="form-control" id="projectCode" name="projectCode" placeholder="Ingresa codigo del proyecto" required>
                <div class="errmsg" id="error_projectCode"></div> -->
            </div>
            <div class="col-sm-3 inputData">
                <label for="id_ambiente">AMBIENTE (<span class="mandatoryCheck">*</span>)</label>
                <select name="id_ambiente" class="form-control" id="id_ambiente" required>
                    <option value="1" <?php if($taskDtl[0][2]==1) echo 'selected';?>>PRODUCCION</option>
                    <option value="2" <?php if($taskDtl[0][2]==2) echo 'selected';?>>PRE-PRODUCCION</option>
                    <option value="3" <?php if($taskDtl[0][2]==3) echo 'selected';?>>CONTINGENCIA</option>
                    <option value="4" <?php if($taskDtl[0][2]==4) echo 'selected';?>>CALIDAD</option>
                    <option value="5" <?php if($taskDtl[0][2]==5) echo 'selected';?>>DESARROLLO</option>
                    <option value="99" <?php if($taskDtl[0][2]==99) echo 'selected';?>>OTRO</option>
                </select>
            </div>
            <div class="col-sm-3 inputData">
                <label for="aprobacion_Cliente">APROBADO POR CLIENTE (<span class="mandatoryCheck">*</span>)</label>
                <select name="aprobacion_Cliente" class="form-control" id="aprobacion_Cliente" required>
                    <option value="1" <?php if($taskDtl[0][3]==1) echo 'selected';?>>SI</option>
                    <option value="2" <?php if($taskDtl[0][3]==2) echo 'selected';?>>NO</option>
                </select>
            </div>
            <div class="col-sm-3 inputData">
                <label for="categorea_tarea">CATEGORIA DE TAREA (<span class="mandatoryCheck">*</span>)</label>
                <select name="categorea_tarea" class="form-control" id="categorea_tarea" required>
                    <option value="1" <?php if($taskDtl[0][4]==1) echo 'selected';?>>SOPORTE</option>
                    <option value="2" <?php if($taskDtl[0][4]==2) echo 'selected';?>>ADMINISTRACION</option>
                    <option value="3" <?php if($taskDtl[0][4]==3) echo 'selected';?>>MEJORAS</option>
                    <option value="4" <?php if($taskDtl[0][4]==4) echo 'selected';?>>VALOR AGREGADO</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 inputData">
                <label for="taskDate">FECHA DEL TRABAJO (<span class="mandatoryCheck">*</span>)</label>
                <input type="date" class="form-control" id="taskDate" name="taskDate" value="<?php echo $taskDtl[0][5];?>" required>
                <div class="errmsg" id="error_taskDate"></div>
            </div>
            <div class="col-sm-3 inputData">
                <label for="horaInicioTarea">HORA INICIO DEL TRABAJO (HH:MM) (<span class="mandatoryCheck">*</span>)</label>
                <input type="text" class="form-control" id="horaInicioTarea" name="horaInicioTarea" value="<?php echo $taskDtl[0][6];?>" required>
                <div class="errmsg" id="error_horaInicioTarea"></div>
            </div>
            <div class="col-sm-3 inputData">
                <label for="horaFinTarea">HORA FIN DEL TRABAJO (HH:MM) (<span class="mandatoryCheck">*</span>)</label>
                <input type="text" class="form-control" id="horaFinTarea" name="horaFinTarea" value="<?php echo $taskDtl[0][7];?>"  required>
                <div class="errmsg" id="error_horaInicioTarea"></div>
            </div>
            <div class="col-sm-3 inputData">
                <label for="tiempo_indisponibilidad">TIEMPO TOTAL INDISPONIBILIDAD (En Minutos) (<span class="mandatoryCheck">*</span>)</label>
                <input type="text" class="form-control" id="tiempo_indisponibilidad" name="tiempo_indisponibilidad" value="<?php echo $taskDtl[0][12];?>"  required>
                <div class="errmsg" id="error_horaInicioTarea"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 inputData">
                <label for="descBreveTarea">TITULO DEL TRABAJO (<span class="mandatoryCheck">*</span>)</label>
                <input type="text" class="form-control" id="descBreveTarea" name="descBreveTarea" value="<?php echo $taskDtl[0][8];?>" required>
                <div class="errmsg" id="error_descBreveTarea"></div>
            </div>
            <div class="col-sm-12 inputData">
                <label for="descCompTarea">DESC COMPLETO DEL TRABAJO (<span class="mandatoryCheck">*</span>)</label>
                <textarea class="form-control" name="descCompTarea" id="descCompTarea" value="" rows="8" maxlength=1500 required><?php echo $taskDtl[0][9];?></textarea> 
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
            <button type="submit" class="btn btn-info navbar-btn btn-warning btn_center" title="Click to enter our portal">EDITAR TRABAJO<span class="glyphicon glyphicon-chevron-right"></span></button>
        </div>
    </form>

    
    <br>
</div>