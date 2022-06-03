<?php
    session_start();
    include_once('000_config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'securityDBController.php';
    $securityDBController = new securityDBController();

    //CREAR NUEVA CUENTA
    if($_GET["task"]==1)
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

        $url='001_menu.php';
        header("Location:$url");
    }
    else if($_GET["task"]==2)
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

        $url='001_menu.php';
        header("Location:$url");
    }
    else if($_GET["task"]==3)
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

        $url='001_client.php';
        header("Location:$url");
    }
    else if($_GET["task"]==4)
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

        $url='001_client.php';
        header("Location:$url");
    } 
    else
    {
        $_SESSION["message"]='ERROR EN DATA.';
    }
    
?>