<?php
    session_start();
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'securityDBController.php';
    $securityDBController = new securityDBController();

    //CREAR NUEVA CUENTA
    if($_GET["task"]==0)
    {
        //OK
        $err = $securityDBController->registerUser($databasecon,$_POST["userNombre"],$_POST["userEmail"],$_POST["userPwd"],$_POST["userTelefono"],$_POST["userCelular"],
            $_POST["userUbicacion"],$_POST["userPerfil"],$_POST["id_integrador"],$_POST["usuarioRed"],$DEBUG_STATUS);    
        $nextView='crearCuenta.php?err='.$err;
        header("Location:$nextView");
    }

    //INICIAR SESSION
    else if($_GET["task"]==1)
    {    
        //OK
        $res_code = $securityDBController->loginUser($databasecon,$_POST['userEmail'],$_POST['userPwd'],$DEBUG_STATUS);   
        if($res_code==101)
        {
            $url='dashboard.php';
            $_SESSION["res_code"]=$res_code_101;
        }
        else if($res_code==102)
        {
            $url='index.php';
            $_SESSION["res_code"]=$res_code_102;
        }
        else
        {
            $url='index.php';
            $_SESSION["res_code"]=$res_code_9999;
        }
        header("Location:$url");
    }
    //RECUPERAR CLAVE
    else if($_GET["task"]==2)
    {    
        $res_code = $securityDBController->recoverPassword($databasecon,$_POST['user_email'],$DEBUG_STATUS);    
        if($res_code==103)
        {
            $_SESSION["res_code"]=$res_code_103;
        }
        else if($res_code==104)
        {
            $_SESSION["res_code"]=$res_code_104;
        }
        else if($res_code==105)
        {
            $_SESSION["res_code"]=$res_code_105;
        }
        else if($res_code==106)
        {
            $_SESSION["res_code"]=$res_code_106;
        }
        else
        {
            $_SESSION["res_code"]=$res_code_9999;
        }
        $url='recoverPassword.php';
        header("Location:$url");
    }
    //CAMBIAR CLAVE
    else if($_GET["proceso"]==0 && $_GET["task"]==3)
    {    
        $err = $securityDBController->cambiarClave($databasecon,$_POST['clave_anterior'],$_POST['clave_nuevo'],$DEBUG_STATUS);    
        
        $url='admin-usuario.php?err='.$err;
        header("Location:$url");
    }    
    else
    {
        $_SESSION["message"]='ERROR EN DATA.';
    }
    
?>