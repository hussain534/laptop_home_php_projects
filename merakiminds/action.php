<?php
    defined('__JEXEC') or ('Access denied');
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();
    $adminUserIdConstant=1;
    if(isset($_GET["action"]))
    {
        if($_GET["action"]==1&& $_GET["id"]!=0)
        {
            $err = $controller->verifyUser($databasecon,$_GET["id"],$_GET["token"],$DEBUG_STATUS);    
            echo $err.'<br>';
            
            $nextView='actionResponse.php?err='.$err;
            header("Location:$nextView");
        }
        if($_GET["action"]==2)
        {
            $err = $controller->loginUser($databasecon,$_POST["userEmail"],$_POST["userPwd"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            if($err==1)
            {
                $nextView='userPortal.php';
            }
            else
            {
                $nextView='actionResponse.php?err='.$err;
            }
            
            header("Location:$nextView");
        }
        else
        {
            $nextView='actionResponse.php?err=2';
            header("Location:$nextView");  
        }        
    }
    else
    {
        //echo '<h3>[ERROR:addEntidad]:input invalido</h3>';
        $_SESSION["message"]='ERROR EN DATA.';
    }
    
?>
                        
