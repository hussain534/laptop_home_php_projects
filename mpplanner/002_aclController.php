<?php
    session_start();
    include_once('000_config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'securityDBController.php';
    $securityDBController = new securityDBController();

    if($_GET["task"]==1)
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

        $url='002_profile.php';
        header("Location:$url");
    }
    else if($_GET["task"]==2)
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

        $url='002_profile.php';
        header("Location:$url");
    }
    else if($_GET["task"]==3)
    {   
        $_SESSION["ACCESS_IDPROFILE"]=$_GET["id_profile"];
        $_SESSION["ACCESS_IDMENU"]=$_GET["idMenu"];
    }
    else if($_GET["task"]==4)
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

        $url='002_access.php';
        header("Location:$url");
    }
    else if($_GET["task"]==5)
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

        $url='002_access.php';
        header("Location:$url");
    }
    else if($_GET["task"]==6)
    {
        //OK
        $profile = $securityDBController->getPerfilListByClient($databasecon,$_GET["cid"],$DEBUG_STATUS);    
        $data="";
        for($i=0;$i<count($profile);$i++)
        {
            $data=$data."<option value=".$profile[$i][0].">".'['.$profile[$i][0].']:'.$profile[$i][1]."</option>";
        }
        echo $data;
    }
    else if($_GET["task"]==7)
    {
        //OK
        $res_code = $securityDBController->register_update_User($databasecon,$_POST["id"],$_POST["user_name"],$_POST["user_email"],$_POST["user_phone"],$_POST["user_mobile"],$_POST["user_address"],$_POST["user_client_id"],$_POST["user_profile_id"],$_POST["user_cost_per_hour"],$_POST["user_joining_dt"],$_POST["user_red"],$DEBUG_STATUS);    
        if($res_code==161)
        {
            $_SESSION["res_code"]=$res_code_161;
        }
        else if($res_code==162)
        {
            $_SESSION["res_code"]=$res_code_162;
        }
        else if($res_code==9999)
        {
            $_SESSION["res_code"]=$res_code_9999;
        }

        $url='002_user.php';
        header("Location:$url");
    }
    else if($_GET["task"]==8)
    {   
        $res_code = $securityDBController->disableUserData($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($res_code==163 && $_GET["disval"]==1)
        {
            $_SESSION["res_code"]=$res_code_163;
        }
        else if($res_code==163 && $_GET["disval"]==0)
        {
            $_SESSION["res_code"]=$res_code_164;
        }
        else if($res_code==165)
        {
            $_SESSION["res_code"]=$res_code_165;
        }
        else if($res_code==9999)
        {
            $_SESSION["res_code"]=$res_code_9999;
        }

        $url='002_user.php';
        header("Location:$url");
    }
    else
    {
        $_SESSION["message"]='ERROR EN DATA.';
    }
    
?>