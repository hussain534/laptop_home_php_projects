<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('util.php');
    include_once('config.php');
    include_once('header.php'); 
    $session_time=$session_expirry_time;
    
    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }
    else if(isset($_GET["msgid"]) && $_GET["msgid"]==99)
        $message="Su cuenta eliminada correctamente. En unos minutos recibira confirmacion por email.";

    require_once __DIR__ . '/fb/src/Facebook/autoload.php';
    $fb = new Facebook\Facebook([
    'app_id' => '1564307063870897', // Replace {app-id} with your app id
    'app_secret' => '8c71460b89a915bc85f77129f7a21e17',
    'default_graph_version' => 'v2.2',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    $permissions = ['public_profile','email']; // Optional permissions
    $loginUrl = $helper->getLoginUrl('http://zielus.hutesol.com/fb-callback.php?tipo=1', $permissions);
?>
<br>
<br>
<div class="container" id="loginRegister">
    <br>
    <br>
    <?php  
        if(isset($message)) 
        {
    ?>
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
            <div class='alert alert-danger shopAlert'>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php  
                    echo $message; 
                ?>
             </div>
        </div>
        <div class="col-sm-3">
        </div>
    </div>
    <?php
        }
    ?>
    <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4 login-register-block">
            <form method="post" action="doLogin.php">
                <input type="hidden" name="submitted" value="true" />  
                <h4 class="modal-title text-center" style="font-weight:bolder;">INICIAR SESIÓN</h4>
                <br>
                <br>
                
                <?php echo '<a href="' . htmlspecialchars($loginUrl) . '">'?><img src="images/fb_login.png" class="fb_img" /><?php echo '</a>';?>      
                <br>                
                <br>
                <p class="modal-title text-center" style="font-weight:bolder;">------------------------ Ó ------------------------</p>
                <br>
                <h5 class="modal-title text-center" style="font-weight:bolder;">INGRESA CON USUARIO DE ZIELUS</h5>
                <input type="email" class="form-control navbar-btn" id="email" placeholder="Email" maxlength=40 name="userEmail" required>
                <input type="password" class="form-control navbar-btn" id="email" placeholder="Clave" maxlength=40 name="userPwd" required>
                <br>
                <p class="text-center">Al dar click en el botón registrarse ó iniciar sesión estarás aceptando todos los <a href="#" class="link01 text-center" >términos  y condiciones</a> del zielus</p>
                <button type="submit" class="btn btn-info navbar-btn btn-warning btn_center" title="Click to enter our portal">INICIAR SESIÓN<span class="glyphicon glyphicon-chevron-right"></span>
                </button> 
                <center><p class="btn_center">No esta registrado!<a href="userregister.php">Registrar ahora</a></p></center>
                <center><p class="btn_center">Ya olvido su contrasena!<a href="userregister.php">Recuperar ahora</a></p></center>
            </form>          
        </div>
        <div class="col-sm-4">
        </div>
    </div>
    <br>
    <br>
    <br>
</div>



<?php
    include_once('container_footer.php');
?>

