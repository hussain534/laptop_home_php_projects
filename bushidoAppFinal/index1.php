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
        <div class="col-sm-12 text-center">
            <?php
                 if(isset($_GET["error"]) && $_GET["error"]==1) 
                {
                    echo '<h5 style="background:cornsilk; color:red;padding:8px 15px;">SESION TERMINADO O ACCESO DENEGADO. INGRESA NUEVAMENTE CON SU USUARIO REGISTRADO</h5>';
                }
            ?>
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
                    <b>ENTRE AQUI</b>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <form action="datacontroller.php?dojob=98&metodo=0" method="post">
                        <input type="hidden" name="submitted" value="true">
                        <label for="user_id">USUARIO</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" placeholder="USUARIO" required>
                        <div class="errmsg" id="error_user_id"></div>
                        <br>
                        <label for="user_password">PASSWORD</label>
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


<?php
    include_once('footer.php');
?>