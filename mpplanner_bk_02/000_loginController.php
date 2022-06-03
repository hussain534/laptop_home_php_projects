<?php
    session_start();
    include_once('000_config.php');    
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
            $url='001_dashboard.php';
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
        $url='000_recoverPassword.php';
        header("Location:$url");
    }
    //CAMBIAR CLAVE
    else if($_GET["task"]==3)
    {    
        $err = $securityDBController->cambiarClave($databasecon,$_POST['clave_anterior'],$_POST['clave_nuevo'],$DEBUG_STATUS);    
        
        $url='admin-usuario.php?err='.$err;
        header("Location:$url");
    }
    else if($_GET["task"]==4)
    {   
        $res_code = $securityDBController->updateMenuData($databasecon,$_POST["id"],$_POST["id_menu"],$_POST["menu_name"],$_POST["url"],$DEBUG_STATUS);
        if($res_code==121)
        {
            $_SESSION["res_code"]=$res_code_121;
        }
        else if($res_code==122)
        {
            $_SESSION["res_code"]=$res_code_122;
        }
        else if($res_code==9999)
        {
            $_SESSION["res_code"]=$res_code_9999;
        }

        $url='menu.php';
        header("Location:$url");
    }
    else if($_GET["task"]==5)
    {   
        $res_code = $securityDBController->disableMenuData($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($res_code==123 && $_GET["disval"]==1)
        {
            $_SESSION["res_code"]=$res_code_123;
        }
        else if($res_code==123 && $_GET["disval"]==0)
        {
            $_SESSION["res_code"]=$res_code_124;
        }
        else if($res_code==125)
        {
            $_SESSION["res_code"]=$res_code_125;
        }
        else if($res_code==9999)
        {
            $_SESSION["res_code"]=$res_code_9999;
        }

        $url='menu.php';
        header("Location:$url");
    }
    else if($_GET["task"]==6)
    {   
        $res_code = $securityDBController->updateProfileData($databasecon,$_POST["id"],$_POST["profile_name"],$_POST["id_company"],$DEBUG_STATUS);
        if($res_code==131)
        {
            $_SESSION["res_code"]=$res_code_131;
        }
        else if($res_code==132)
        {
            $_SESSION["res_code"]=$res_code_132;
        }
        else if($res_code==9999)
        {
            $_SESSION["res_code"]=$res_code_9999;
        }

        $url='profile.php';
        header("Location:$url");
    }
    else if($_GET["task"]==7)
    {   
        $res_code = $securityDBController->disableProfileData($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($res_code==133 && $_GET["disval"]==1)
        {
            $_SESSION["res_code"]=$res_code_133;
        }
        else if($res_code==133 && $_GET["disval"]==0)
        {
            $_SESSION["res_code"]=$res_code_134;
        }
        else if($res_code==135)
        {
            $_SESSION["res_code"]=$res_code_135;
        }
        else if($res_code==9999)
        {
            $_SESSION["res_code"]=$res_code_9999;
        }

        $url='profile.php';
        header("Location:$url");
    }
    else if($_GET["task"]==8)
    {   
        $res_code = $securityDBController->updateAccessList($databasecon,$_POST["id"],$_POST["id_profile"],$_POST["idMenu"],$DEBUG_STATUS);
        if($res_code==141)
        {
            $_SESSION["res_code"]=$res_code_141;
        }
        else if($res_code==142)
        {
            $_SESSION["res_code"]=$res_code_142;
        }
        else if($res_code==9999)
        {
            $_SESSION["res_code"]=$res_code_9999;
        }

        $url='access.php';
        header("Location:$url");
    }
    else if($_GET["task"]==9)
    {   
        $res_code = $securityDBController->disableAccess($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($res_code==143 && $_GET["disval"]==1)
        {
            $_SESSION["res_code"]=$res_code_143;
        }
        else if($res_code==143 && $_GET["disval"]==0)
        {
            $_SESSION["res_code"]=$res_code_144;
        }
        else if($res_code==145)
        {
            $_SESSION["res_code"]=$res_code_145;
        }
        else if($res_code==9999)
        {
            $_SESSION["res_code"]=$res_code_9999;
        }

        $url='access.php';
        header("Location:$url");
    }
    else if($_GET["task"]==10)
    {   
        $_SESSION["ACCESS_IDPROFILE"]=$_GET["id_profile"];
        $_SESSION["ACCESS_IDMENU"]=$_GET["idMenu"];
    } 
    else if($_GET["task"]==11)
    {   
        $res_code = $securityDBController->updateClientData($databasecon,$_POST["id"],$_POST["client_name"],$_POST["client_website"],$_POST["client_unique_id"],$DEBUG_STATUS);
        if($res_code==151)
        {
            $_SESSION["res_code"]=$res_code_151;
        }
        else if($res_code==152)
        {
            $_SESSION["res_code"]=$res_code_152;
        }
        else if($res_code==9999)
        {
            $_SESSION["res_code"]=$res_code_9999;
        }

        $url='client.php';
        header("Location:$url");
    }
    else if($_GET["task"]==12)
    {   
        $res_code = $securityDBController->disableClientData($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($res_code==153 && $_GET["disval"]==1)
        {
            $_SESSION["res_code"]=$res_code_153;
        }
        else if($res_code==153 && $_GET["disval"]==0)
        {
            $_SESSION["res_code"]=$res_code_154;
        }
        else if($res_code==155)
        {
            $_SESSION["res_code"]=$res_code_155;
        }
        else if($res_code==9999)
        {
            $_SESSION["res_code"]=$res_code_9999;
        }

        $url='client.php';
        header("Location:$url");
    }
    else
    {
        $_SESSION["message"]='ERROR EN DATA.';
    }
    
?>