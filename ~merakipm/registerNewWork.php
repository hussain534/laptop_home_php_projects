<?php
    defined('__JEXEC') or ('Access denied');
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
            REGISTRAR NUEVO TRABAJO            
        </div>
    </div>
    
    <form method="post" action="controller.php?controller=1&task=0">
        <div class="row">
            <div class="col-sm-3 inputData">
                <label for="projectCode">CODIGO DEL PROYECTO (<span class="mandatoryCheck">*</span>)</label>
                <input type="text" class="form-control" id="projectCode" name="projectCode" placeholder="Ingresa codigo del proyecto" required>
                <div class="errmsg" id="error_projectCode"></div>
            </div>
            <div class="col-sm-3 inputData">
                <label for="taskDate">FECHA DEL TRABAJO (<span class="mandatoryCheck">*</span>)</label>
                <input type="date" class="form-control" id="taskDate" name="taskDate" placeholder="Ingresa fecha del tarea" required>
                <div class="errmsg" id="error_taskDate"></div>
            </div>
            <div class="col-sm-3 inputData">
                <label for="horaInicioTarea">TIEMPO DEL TRABAJO (EN MINUTOS) (<span class="mandatoryCheck">*</span>)</label>
                <input type="text" class="form-control" id="horaInicioTarea" name="horaInicioTarea" placeholder="Ingresa tiempo total del tarea (minutos)"  required>
                <div class="errmsg" id="error_horaInicioTarea"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 inputData">
                <label for="descBreveTarea">DESC BREVE DEL TRABAJO (<span class="mandatoryCheck">*</span>)</label>
                <input type="text" class="form-control" id="descBreveTarea" name="descBreveTarea" placeholder="Ingresa brere descripcion del tarea" required>
                <div class="errmsg" id="error_descBreveTarea"></div>
            </div>
            <div class="col-sm-12 inputData">
                <label for="descCompTarea">DESC COMPLETO DEL TRABAJO (<span class="mandatoryCheck">*</span>)</label>
                <textarea class="form-control" name="descCompTarea" id="descCompTarea" value="" rows="8" placeholder="Ingresa descripcion completo del tarea" maxlength=1500 required></textarea> 
                <div class="errmsg" id="error_descCompTarea"></div>
            </div>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-info navbar-btn btn-warning btn_center" title="Click to enter our portal">REGISTRAR TRABAJO<span class="glyphicon glyphicon-chevron-right"></span></button>
        </div>
    </form>

    
    <br>
</div>