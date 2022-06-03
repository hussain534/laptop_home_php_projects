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

    if(isset($_GET["id"]))
        $user_id=$_GET["id"];
    
    

    if(isset($_POST["submitted"]) && $_POST["submitted"])
    {
        /*$err_code = $controller->editUser($databasecon,$_POST["user_id"],$_POST["user_nombre"],$_POST["user_apellido"],$_POST["user_email"],$_POST["user_celular"],$DEBUG_STATUS);*/
        $err_code = $controller->editUser($databasecon,$_POST["user_id"],$_POST["user_nombre"],$_POST["user_apellido"],$_POST["user_email"],'',$DEBUG_STATUS);
        //echo 'SQL:'.$err_code.'<br>';
        if($err_code==1)
        {
            $message="REGISTRO GRABADO CORRECTAMENTE";
        }        
        else
        {
            $message="ERROR EN GRABAR REGISTRO";   
        }
    }
    $userList = $controller->getUserDetail($databasecon,$user_id,$DEBUG_STATUS);    
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
                    <p style="font-size:36px">ACTUALIZAR PERSONA</p>
                </div>
            </div>     
            <hr>
            <br>

            <!-- BOTONES -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group">
                        <a href="recursos.php"><button type="button" class="btn btn-lg"><span class="glyphicon glyphicon-arrow-left my-glyphicon"></span>ATRAS</button></a>
                    </div>    
                </div>
            </div> 
            <hr>
            <br>
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <form action="updateUsuario.php?id=<?php echo $user_id;?>" method="post">
                        <input type="hidden" name="submitted" value="true">

                        <label for="user_id">USUARIO</label>
                        <input type="text" class="form-control" id="user_id" maxlength=50 value="<?=$userList[0][0];?>" name="user_id" placeholder="USUARIO" required readonly="true">
                        <div class="errmsg" id="error_user_id"></div>
                        <br>

                        <label for="user_nombre">NOMBRE</label>
                        <input type="text" class="form-control" id="user_nombre" maxlength=100 value="<?=$userList[0][1];?>" name="user_nombre" placeholder="NOMBRE" required>
                        <div class="errmsg" id="error_user_nombre"></div>
                        <br>

                        <label for="user_apellido">APELLIDO</label>
                        <input type="text" class="form-control" id="user_apellido" maxlength=100 value="<?=$userList[0][2];?>" name="user_apellido" placeholder="APELLIDO" required>
                        <div class="errmsg" id="error_user_apellido"></div>
                        <br>

                        <label for="user_email">EMAIL</label>
                        <input type="text" class="form-control" id="user_email" maxlength=100 value="<?=$userList[0][3];?>" name="user_email" placeholder="CORREO ELECTRONICO" required>
                        <div class="errmsg" id="error_user_email"></div>
                        <br>

                        <!-- <label for="user_celular">CELULAR</label>
                        <input type="text" class="form-control" id="user_celular" maxlength=10 value="<?=$userList[0][4];?>" name="user_celular" placeholder="NRO CONTACTO" required>
                        <div class="errmsg" id="error_user_celular"></div>
                        <br> -->

                        <button type="submit" class="btn btn-small btn_center" onclick="return validateEmail();">GRABAR<span class="glyphicon glyphicon-chevron-right"></span></button>
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
<script>
  function validateEmail() 
    {
        //alert("HI");
        var x = document.getElementById("user_email").value;
        var atpos = x.indexOf("@");
        var dotpos = x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) 
        {
            alert("ERROR FORMATO EMAIL");
            return false;
        }
        else
            return true;
}
</script>

<?php
    include_once('footer.php');
?>