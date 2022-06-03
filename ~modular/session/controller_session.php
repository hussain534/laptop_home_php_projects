<?php
    defined('__JEXEC') or ('Access denied');
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    include_once('../common/db_config.php');
    require 'model_session.php';
    $model = new model_session();


    
    if(isset($_GET["task"]) && $_GET["task"]==0)
    {
        /*LOGIN*/
        $ret_code = $model->login_user($databasecon,$_POST["userEmail"],$_POST["userPwd"],$DEBUG_STATUS);
        if($ret_code==0)
        {
            $_SESSION["MESSAGE_TYPE"]="success";
            $_SESSION["MESSAGE_TEXT"]="CONGRATULATION";
            $nextView='../portal/portal_index.php';
        }
        else if($ret_code==1)
        {
            $_SESSION["MESSAGE_TYPE"]="danger";
            $_SESSION["MESSAGE_TEXT"]="USER NOT EXIST";
            $nextView='../index.php';
        }
        else if($ret_code==2)
        {
            $_SESSION["MESSAGE_TYPE"]="danger";
            $_SESSION["MESSAGE_TEXT"]="INVALID PASSWORD";
            $nextView='../index.php';
        }
        else
        {
            $_SESSION["MESSAGE_TYPE"]="danger";
            $_SESSION["MESSAGE_TEXT"]="ERROR IN LOGIN PROCESS";
            $nextView='../index.php';
        }
        
        header("Location:$nextView");
    }
    else
    {
        $_SESSION["MESSAGE_TYPE"]="danger";
        $_SESSION["MESSAGE_TEXT"]="TASK ID NOT SENT";
        //echo $_SESSION["MESSAGE_TYPE"];
        $nextView='../index.php';
        header("Location:$nextView");
    }
    
?>
                        
