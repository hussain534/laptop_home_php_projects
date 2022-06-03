<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('util.php');
    //include_once('header.php');

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
    else if($err==99)
    {
        $msg= "Su sesion finalizado correctamente.";
    }
?>

<div class="container">
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
    <br>
    <br>
    <div class="row">
        <div class="col-sm-12"><img src="images/logo.png" class="logo_img"></div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center"><h1>Knowledge, The Way To Success</h1></div>
    </div>

    <div class="row">
        <div class="col-sm-12 text-center"><p>Sign up for a <span class="logoText">M</span>Book account and get access to lots of courses and classroom teaching plans that can help in your career.</p></div>
    </div>
    <div class="row">
        <div class="col-sm-5"></div>
        <div class="col-sm-2">
            <a href="userRegister.php">
                <button type="submit" class="btn btn-default btn_center" title="Click to enter our portal" style="letter-spacing:1px">
                    Join <span class="logoText">M</span>Book
                </button>
            </a>
        </div>
        <div class="col-sm-5"></div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center"><p>Already have a <span class="logoText">M</span>Book account? <a href="login.php"><b>SIGN IN.</b></a></p></div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-12 text-center"><p>-------------------------------- or --------------------------------</p></div>
    </div>

    <div class="row">
        <div class="col-sm-12"><img src="images/building.png" class="icon_img"></div>
    </div>

    <div class="row">
        <div class="col-sm-12 text-center"><p>Are you a company, a school or an university?</p></div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <a href="userRegister.php"><button type="submit" class="btn btn-default btn_center btn_transparent"style="letter-spacing:1px">Join now</button></a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12 text-center">
            <p>MERAKIMINDS CIA LTDA&nbsp;&nbsp;&copy;&nbsp;&nbsp;2018</p>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-sm-3 login-register-block">
            <div class="row">
                 <div class="col-sm-1"></div>
                 <div class="col-sm-10">
                    <form method="post" action="controller.php?controller=0&task=1">
                        <input type="hidden" name="submitted" value="true" /> 
                        <h5 class="modal-title text-center">INGRESA TU USUARIO Y CONTRASEÑA</h5>
                        <input type="email" class="form-control navbar-btn" id="email" placeholder="Email" name="userEmail" required>
                        <input type="password" class="form-control navbar-btn" id="pwd" placeholder="Clave" name="userPwd" required>
                        <br>
                       <button type="submit" class="btn btn-info navbar-btn btn-warning btn_center" title="Click to enter our portal">INICIAR SESIÓN<span class="glyphicon glyphicon-chevron-right"></span>
                        </button>
                       <center><a href="userRegister.php">Register Now</a></center>
                    </form>
                </div>
                <div class="col-sm-1"></div>    
        </div>
    </div> -->
</div>