<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php'); 
    include_once('util.php');   
    $DEBUG_STATUS = $PRINT_LOG;

    /*if(!isset($_SESSION["user_name"]) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
    {
        $url='cerrarSesion.php';
        header("Location:$url");
    }
    else
    {
        include_once('util.php');
    }*/
    $_SESSION['LAST_ACTIVITY'] = time();

    include_once('menuPanel.php');
    $message='';
    if(isset($_SESSION["message"])) 
    {
        //echo $_SESSION["message"];
        $message=$_SESSION["message"];
        unset($_SESSION["message"]);
    }

    //require 'dbcontroller.php';
    //$controller = new controller();
        
?>
<style>
    body
    {
        background: url('images/gate.jpg');
        background-attachment: fixed;
        background-size: cover;
    }
</style>
<div class="container" id="home">
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6 text-center">
            <?php
                 if(isset($_GET["error"]) && $_GET["error"]==1) 
                {
                    echo '<h5 style="background:cornsilk; color:red;padding:5px 15px;">SESION TERMINADO O ACCESO DENEGADO. INGRESA NUEVAMENTE CON SU USUARIO REGISTRADO</h5>';
                }
            ?>
        </div>
        <div class="col-sm-3">
        </div>
    </div>  
    <?php 
        if(isset($message) && strcmp($message, '')!=0)
        {
    ?>
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="errblock">
                    <?php echo $message;?>
                </div>
            </div>
        </div>
    <?php
        }
    ?>
    <br>
    <div class="row">
        <div class="col-sm-8">
        </div>
        <div class="col-sm-4 login">
            <div class="row">
                <div class="col-sm-12 login_title">
                    <h4>ENTRE AQUI</h4>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <form action="datacontroller.php?dojob=98&metodo=0" method="post">
                        <input type="hidden" name="submitted" value="true">
                        <label for="user_email">USUARIO:</label>
                        <input type="email" class="form-control" id="user_email" name="user_email" placeholder="USUARIO" required>
                        <div class="errmsg" id="error_user_email"></div>
                        <br>
                        <label for="user_password">PASSWORD:</label>
                        <input type="password" class="form-control" id="user_password" name="user_password" placeholder="PASSWORD" required>
                        <div class="errmsg" id="error_user_password"></div>                
                        <br>
                        <label for="user_password">OLVIDO SU PASSWORD</label>
                        <a href="recuperarClave.php" class="link1">PULSE AQUI</a>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-small btn_center">ACCEDER<span class="glyphicon glyphicon-chevron-right"></span></button>
                        <br>
                    </form>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-6 text-left" style="background:#4E5D6C;color:#dbddde;font-size: 18px">
            <span style="color:#f5f5f5;font-size:12px;font-weight:bold;font-family: 'Taviraj', serif">SISTEC ECUADOR &copy;2016.</span><span style="color:#f5f5f5;font-size:9px;font-family: 'Taviraj', serif">&nbsp;&nbsp;&nbsp;TODOS LOS DERECHOS RESERVADOS</span>
        </div>
        <div class="col-sm-6 text-right" style="background:#4E5D6C;color:#dbddde;font-size: 10px">
            <span style="color:#f5f5f5;font-size:12px;font-family: 'Taviraj', serif">DISEÑADO Y DESARROLLADO POR -<a href="http://www.merakiminds.com" style="color:#00b0f0;font-size:18px">MERAKI MINDS</a></span>
        </div>
    </div>
</div>