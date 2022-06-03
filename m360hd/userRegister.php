<?php
    defined('__JEXEC') or ('Access denied');
    include_once('util.php');
    //include_once('header.php');

    $msg='';
    if(isset($_GET["err"]))
        $err=$_GET["err"];
    else 
        $err=99;

    if($err==1)    
    {
        $msg= '<center>USUARIO REGISTRADO CORRECTAMENTE. <a href="index.php">INICIAR SESION</a></center>';
    }
    else if($err==0)
    {
         $msg= '<center>ERROR OCURIDO. INTENTA NUEVAMENTE</center>';
    }
    else if($err<0)
    {
         $msg= '<center>USUARIO EXISTE. REGISTRAR CON OTROS DATOS</center>';
    }
    else if($err==9)
    {
         $msg= '<center>ERROR EN ENVIAR CORREO DE CONFIRMACION DE REGISTRO EXITOSO DEL USUARIO. <a href="index.php">INICIAR SESION</a</center>';
    }
    else if($err==8)
    {
         $msg= '<center>ERROR OCURIDO EN REGISTRAR USUARIO. INTENTA NUEVAMENTE</center>';
    }
?>

<style type="text/css">
    body
    {
        background-image: url('images/merakipm_background.jpg');
        //background-attachment: fixed;
        background-size: cover;
    }
</style>
<div class="container">
    <?php
    include_once('header.php');
    //include_once('sessionData.php');
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
    <div class="row">
        <div class="col-sm-3 login-register-block">
            <div class="row">
                 <div class="col-sm-1"></div>
                 <div class="col-sm-10">
                    <form method="post" action="controller.php?controller=0&task=0">
                        <input type="hidden" name="submitted" value="true" />
                        <h5 class="modal-title text-center">INGRESA TU USUARIO Y CONTRASEÑA</h5>
                        <input type="text" class="form-control navbar-btn" id="name" placeholder="Nombre (100 caracteres)" maxlength=100 name="userName" required>
                        <input type="email" class="form-control navbar-btn" id="email" placeholder="Email (50 caracteres)" maxlength=50 name="userEmail" required>
                        <input type="password" class="form-control navbar-btn" id="password" placeholder="Clave (50 caracteres)" maxlength=50 name="userPwd" required>
                        <select name="perfil" class="form-control" id="perfil" required>
                            <!-- <option value="2">OPERADOR</option> -->
                            <option value="4">TECNICO</option>
                        </select>
                        <br>
                       <button type="submit" class="btn btn-info navbar-btn btn-warning btn_center" title="Click to enter our portal">REGISTRAR<span class="glyphicon glyphicon-chevron-right"></span>
                        </button>
                        <center><a href="index.php">Tienes cuenta. Iniciar Sesion</a></center>
                    </form>
                </div>
                <div class="col-sm-1"></div>    
        </div>
    </div>
</div>