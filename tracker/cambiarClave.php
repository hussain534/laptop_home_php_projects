<?php
    session_start();
    include_once('util.php');
    include_once('header.php');
    $msg='';
    if(isset($_SESSION["message"]))
    {
        $msg=$_SESSION["message"];
        unset($_SESSION["message"]);
    }
    
?>
<style type="text/css">
    body
    {
        background-image: none !important;
    }
</style>
<div class="container">
    <?php
    include_once('sessionData.php');
    ?>
    <div class="row pageTitle">
        <div class="col-sm-12">
            CAMBIAR CLAVE
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center">
            <?php
            if(strlen($msg)>0)
            {
            ?>
            <div class="alert alert-info" role="alert">
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
    <br>
    <div class="row">
         <div class="col-sm-1"></div>
         <div class="col-sm-10">
            <form method="post" action="controladorProceso.php?proceso=0&task=3" onsubmit="return validateCambiarClave();">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" name="submitted" value="true" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>CLAVE ANTERIOR</label>
                        <input type="password" class="form-control navbar-btn" id="clave_anterior" placeholder="Clave Anterior" name="clave_anterior" required>
                    </div>
                    <div class="col-sm-4">
                        <label>CLAVE NUEVA</label>
                        <input type="password" class="form-control navbar-btn" id="clave_nuevo" placeholder="Clave Nueva" name="clave_nuevo" required>
                    </div>
                    <div class="col-sm-4">
                        <label>CONFIRMAR CLAVE</label>
                        <input type="password" class="form-control navbar-btn" id="confirmar_clave" placeholder="Confirmar Clave" name="confirmar_clave" required>
                    </div>
                </div>
                
                <br>                        
                <!-- <center> -->
                    <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">ACTUALIZAR CLAVE<span class="glyphicon glyphicon-chevron-right"></span></button>
                <!-- </center> -->
            </form>
        </div>
        <div class="col-sm-1"></div>    
    </div>
    <br>
    
    <br>
</div>