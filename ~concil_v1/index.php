<?php
    session_start();
    include_once('util.php');
    include_once('header.php');

    $msg='';
    
    if(isset($_GET["err"]))
        $err=$_GET["err"];
    else 
        $err=1;
    
    if($err==0)
    {
        $msg= "Usuario no existe. Registrar usuario <a href=userRegister.php>REGISTRAR</a>";
    }
    else if($err==2)
    {
        $msg= "Error en iniciar sesion. Intente mas tarde";
    }
    else if($err==3)
    {
        $msg= "Clave incorrecto. Intentar con clave correcto";
    }
    else if($err==98)
    {
        $msg= "Sesion invalido.";
    }
    else if($err==99)
    {
        $msg= "Su sesion finalizado correctamente.";
    }
?>

<style type="text/css">
    body
    {
        //background-image: url('images/merakipm_background_sm.jpg');
        background-size: cover;
    }
</style>
<div class="container" style="min-height:700px">
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
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 login-register-block">
            <div class="row">
                 <div class="col-sm-1"></div>
                 <div class="col-sm-10">
                    <form method="post" action="controladorProceso.php?proceso=0&task=1">
                        <input type="hidden" name="submitted" value="true" /> 
                        <h3 class="modal-title text-center">LOGIN</h3>
                        <input type="email" class="form-control navbar-btn" id="email" placeholder="Email" name="userEmail" required>
                        <input type="password" class="form-control navbar-btn" id="pwd" placeholder="Clave" name="userPwd" required>
                        <br>                        
                        <center>
                            <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">INICIAR SESIÓN<span class="glyphicon glyphicon-chevron-right"></span></button>
                            <br>
                            No recuerdas tu clave. Haz clic aqui para <a href="recuperarClave.php">RECUPERAR CLAVE</a>
                        </center>
                    </form>
                </div>
                <div class="col-sm-1"></div>    
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>    
    <!-- <div class="row">
        <center><a href="#">Seguridad del sitio</a> | <a href="#">Política de Privacidad en Internet</a> | <a href="#">Términos y condiciones</a> | Copyright © , ABC S.A</center>
    </div> -->
</div>

<?php
    include_once('footer.php');
?>