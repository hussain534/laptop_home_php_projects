<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;
    //echo $_SESSION["userid"];
    $userCode = 0;
    if(isset($_SESSION["userid"]))
        $userCode=$_SESSION["userid"];
	$sql = "UPDATE rn_login SET rn_user_in_use='N' where rn_userid='".$userCode."'";
    if(mysqli_query($dbcon,$sql))
    {
    	if(isset($_GET['tipo']) and $_GET['tipo']==1)
        {
            if($DEBUG_STATUS)
                echo $_GET['tipo'].'<br>';
			$url = "index.php?view=shop&layout=login&tipo=1";
        }
        else if(isset($_GET['tipo']) and $_GET['tipo']==3)
        {
            if($DEBUG_STATUS)
                echo $_GET['tipo'].'<br>';
            $url = "index.php?view=shop&layout=login&tipo=3"; 
        }
        else if(isset($_GET['tipo']) and $_GET['tipo']==4)
        {
            if($DEBUG_STATUS)
                echo $_GET['tipo'].'<br>';
            $msg = "";
            if(isset($_GET['msg']))
                $msg = $_GET['msg'];
            $url = "index.php?view=shop&layout=registerform&tipo=4&msg=".$msg;       
        }
		else
		{
            if($DEBUG_STATUS)
                echo $_GET['tipo'].'<br>';
			//$url = "index.php?view=shop&layout=login&tipo=2&timeout=".($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY']).':'.$_SERVER['REQUEST_TIME'].':'.$_SESSION['LAST_ACTIVITY'];	
			$url = "index.php?view=shop&layout=login&tipo=2";
		}

			
        unset($_SESSION["userid"]); 
        unset($_SESSION['LAST_ACTIVITY']);
        unset($_SESSION["Order_id"]);
        mysqli_close($dbcon);
        // remove all session variables
        session_unset(); 

        // destroy the session 
        session_destroy();    
        
    }
    else
    {
        mysqli_close($dbcon);
        #$messsage= "Error in logout. Try again later.";
        $url = "index.php?view=shop&layout=userhome";
    }
    if($DEBUG_STATUS)
        echo 'url:'.$url;
	header("Location:$url"); 
?>