<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('util.php');
    include_once('config.php');
    include_once('header.php'); 
    
    


    require_once __DIR__ . '/fb/src/Facebook/autoload.php';
    $fb = new Facebook\Facebook([
    'app_id' => '1564307063870897', // Replace {app-id} with your app id
    'app_secret' => '8c71460b89a915bc85f77129f7a21e17',
    'default_graph_version' => 'v2.2',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    $permissions = ['email']; // Optional permissions
    $loginUrl = $helper->getLoginUrl('http://hutesol.com/fb-callback.php?tipo=0', $permissions);

    //echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';



?>
<br>
<br>
<div class="container" id="loginRegister">
    <br>
    <br>
    <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4 login-register-block">
            <form method="post" action="doRegisterAndLogin.php">
                <input type="hidden" name="submitted" value="true" />  
                <h4 class="modal-title text-center" style="font-weight:bolder;">REGISTRAR</h4>
                <br>
                <br>
                <?php echo '<a href="' . htmlspecialchars($loginUrl) . '">'?><img src="images/fb_login.png" class="fb_img" /><?php echo '</a>';?>
                <br>                
                <br>
                <p class="modal-title text-center" style="font-weight:bolder;">------------------------ Ó ------------------------</p>
                <br>
                <h5 class="modal-title text-center" style="font-weight:bolder;">CREAR USUARIO EN ZIELUS</h5>
                <input type="email" class="form-control navbar-btn" id="email" placeholder="Email" maxlength=40 name="userEmail" required>
                <input type="password" class="form-control navbar-btn" id="email" placeholder="Clave" maxlength=40 name="userPwd" required>
                <!-- <label class="radio-inline">
                    <input type="radio" name="userRole" value="2" checked="true">Registar como conductor
                </label>
                <label class="radio-inline">
                    <input type="radio" name="userRole" value="3">Registar como pasajero
                </label> -->
                <br>
                <p class="text-center">Al dar click en el botón registrarse ó iniciar sesión estarás aceptando todos los <a href="#" class="link01 text-center" >términos  y condiciones</a> del zielus</p>                
                <button type="submit" class="btn btn-info navbar-btn btn-warning btn_center" onclick="validateEmail()" title="Click to enter our portal">REGISTRARSE<span class="glyphicon glyphicon-chevron-right"></span></button> 
                <center><p class="btn_center">Ya esta registrado! <a href="userlogin.php">Login ahora</a></p></center>
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