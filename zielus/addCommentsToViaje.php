<?php
	//avoid direct access
	defined('__JEXEC') or ('Access denied');
	session_start();
    //include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
	$target_dir=$gallery_location;
	$uploadSize=$uploadSize;
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
	if($DEBUG_STATUS)
	{
		echo 'USERID::'.$_SESSION['userid'].'<br>';
		echo 'EMAIL::'.$_SESSION['userEmail'].'<br>';
		//echo 'ROLE::'.$_SESSION['userRole'].'<br>';
	}
	if(isset($_SESSION['LAST_ACTIVITY']))
    {
		if(($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
		{
			$url="index.php?view=shop&layout=userlogout&tipo=2";
			header("Location:$url"); 
		}
        else
              $_SESSION['LAST_ACTIVITY'] = time();
	}
	else
		$_SESSION['LAST_ACTIVITY'] = time();

	if(isset($_POST['submitted']))
    {
        if($DEBUG_STATUS)
        {
            echo "Inside submitted check<br>";
        }
        $comments=$_POST['comments'];
        $viajeIDComment=$_POST['viajeIDComment'];        
        $url = $_SESSION["last_url"];

    	$controller = new controller();
    	
        $updStatus = $controller->insertComments($databasecon,$viajeIDComment,$_SESSION['userid'],$comments,$DEBUG_STATUS);
        
    	if($DEBUG_STATUS)
            echo $updStatus.'<br>';
        if($updStatus==0)
        {
            $_SESSION["session_msg"]= "Su comentarios guardado correctamente";
        }
        else
        {
        	$_SESSION["session_msg"]= 'Error en guardar su comentarios. Por favor intenta nuevamente';
        	//$url = "editDetallesPersonales.php";
        }  
    }
    header("Location:$url");
?>
