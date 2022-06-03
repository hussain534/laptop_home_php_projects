<?php
    defined('__JEXEC') or ('Access denied');
    session_start();

    //PARAMETROS COMUNES PARA PAGINAS EN SESSION
    include_once('config.php'); 
    $DEBUG_STATUS = $PRINT_LOG;
    $session_time = $session_expirry_time;
    
    


    //VALIDAR SESSION
    if(!isset($_SESSION["user_name"]) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
    {
        $url='cerrarSesion.php';
        header("Location:$url");
    }
    else
    {
        include_once('util.php');
    }
    $_SESSION['LAST_ACTIVITY'] = time();


    //CARGAR MENU PRINCIPAL
    include_once('menuPanel.php');

    //PARAMETROS DE MENSAJE/ERRORES
    $message='';
    if(isset($_SESSION["message"])) 
    {
        //echo $_SESSION["message"];
        $message=$_SESSION["message"];
        unset($_SESSION["message"]);
    }

    //CARGAR CLASE DE BDD
    require 'dbcontroller.php';
    $controller = new controller();

    if(isset($_POST["submitted"]) && $_POST["submitted"])
    {
        if(strcmp($_POST["clave_nuevo"],$_POST["confirmar_clave"])==0)
        {
            $err_code = $controller->cambiarClave($databasecon,$_POST["clave_anterior"],$_POST["clave_nuevo"],$_POST["confirmar_clave"],$DEBUG_STATUS);
            //echo 'SQL:'.$err_code.'<br>';
            if($err_code==1)
            {
                $message="CLAVE REGISTRADO CORRECTAMENTE";
            }
            else if($err_code==2)
            {
                $message="CLAVE REGISTRADO CORRECTAMENTE, PERO ERROR OCURIDO EN ENVIAR CORREO ELECTRONICO";
            }
            else if($err_code==3)
            {
                $message='CLAVE ANTERIOR NO COINCIDIO.INTENTA NUEVAMENTE CON CLAVE ANTERIOR CORRECTO.';
            }
            else
            {
                $message="ERROR EN REGISTRAR CLAVE";   
            }
        }
        else
            $message='CLAVE NUEVO Y CONFIRMAR CLAVE NO COINCIDIO.INTENTA NUEVAMENTE CON CLAVES CORRECTO.';
    }
        
?>
<style>
    body
    {
        background-color: #2b3e50;
    }
</style>
<div class="container"  id="home">    
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
    <br>
    <div class="row">
        <div class="col-sm-12">
            <!-- TITULO -->
            <div class="row">
                <div class="col-sm-1 text-right">
                    <img src="images/business-male-team.png" style="width:50px;">
                </div>
                <div class="col-sm-6">
                    <p style="font-size:36px">CAMBIAR CLAVE</p>
                </div>
            </div>     
            <hr>
            <br>

            <!-- BOTONES -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group">
                        <a href="home.php"><button type="button" class="btn btn-lg"><span class="glyphicon glyphicon-arrow-left my-glyphicon"></span>ATRAS</button></a>
                    </div>    
                </div>
            </div> 
            <hr>
            <br>
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <form action="cambiarClave.php" method="post">
                        <input type="hidden" name="submitted" value="true">

                        <label for="clave_anterior">CLAVE ANTERIOR</label>
                        <input type="text" class="form-control" id="clave_anterior" maxlength=50  name="clave_anterior" placeholder="CLAVE ANTERIOR" required>
                        <div class="errmsg" id="error_clave_anterior"></div>
                        <br>

                        <label for="clave_nuevo">CLAVE NUEVO</label>
                        <input type="text" class="form-control" id="clave_nuevo" maxlength=50 name="clave_nuevo" placeholder="CLAVE NUEVO" required>
                        <div class="errmsg" id="error_clave_nuevo"></div>
                        <br>

                        <label for="confirmar_clave">CONFIRMAR CLAVE NUEVO</label>
                        <input type="text" class="form-control" id="confirmar_clave" maxlength=50 name="confirmar_clave" placeholder="CONFIRMAR CLAVE NUEVO" required>
                        <div class="errmsg" id="error_confirmar_clave"></div>
                        <br>

                        <button type="submit" class="btn btn-small btn_center">CAMBIAR CLAVE<span class="glyphicon glyphicon-chevron-right"></span></button>
                        <br>
                    </form>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <br>
            <br>
               
        </div>
    </div>
</div>
<?php
    include_once('footer.php');
?>