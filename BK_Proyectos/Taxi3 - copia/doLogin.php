<?php
	//avoid direct access
	defined('__JEXEC') or ('Access denied');
	session_start();
	//load commoan parameters
	include_once('config.php'); 
	require 'dbcontroller.php';
    
    //assign commaon local variables
    $dbcon = $databasecon;
    $DEBUG_STATUS = $PRINT_LOG;
  	$err_code=0;
    $session_time=$session_expirry_time;

    //validate session expire
	if(isset($_SESSION['LAST_ACTIVITY']))
    {
		if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
		{
			$url="index.php?view=shop&layout=userlogout&tipo=2";
			header("Location:$url"); 
		}
        else
              $_SESSION['LAST_ACTIVITY'] = time();
	}
	else
		$_SESSION['LAST_ACTIVITY'] = time();

    //process login
    if(isset($_POST['submitted']))
    {

    	$controller = new controller();
    	$userEmail = $_POST['userEmail'];
		$userPwd = $_POST['userPwd'];
		$url='userlogin.php';
    	$strUserDtlArr=$controller->getUserDtlFromEmail($databasecon,$userEmail,$DEBUG_STATUS);  

    	if(isset($strUserDtlArr) && count($strUserDtlArr)!=0)	
    	{
    		$err_code = $controller->doLogin($databasecon,$userEmail,$userPwd,$strUserDtlArr,$DEBUG_STATUS);
    		//echo '1'  ;
			if($DEBUG_STATUS)
			{
				echo '$UserId retrieved::'.$strUserDtlArr[0].'<br>';
				//echo '$User Role retrieved::'.$strUserDtlArr[2].'<br>';
			}
			if(isset($err_code) and $err_code==0)
			{
				if(isset($_SESSION['last_url']))
					$url=$_SESSION['last_url'];
				else
					$url='perfilConductor.php';
				
			}
			else
			{
				$_SESSION["session_msg"]="Credenciales incorrecto o cuenta esta eliminada. Intenta nuevamente con detalles correcto.";
				$url='userlogin.php';
			}
    	}
    	else
    	{
    		//User not regsitered
    		$_SESSION["session_msg"]="No estas registrado en nuestro sistema. Por favor registrar ahora.";
    		$url='userlogin.php';
    	}
		//echo $url;
		header("Location:$url");
    }
    else
    {
    	$controller = new controller();
    	$userEmail = $_SESSION['email'];
		$userPwd = 'facebook534';
		$url='userlogin.php';
    	$strUserDtlArr=$controller->getUserDtlFromEmail($databasecon,$userEmail,$DEBUG_STATUS);  

    	if(isset($strUserDtlArr) && count($strUserDtlArr)!=0)	
    	{
    		$err_code = $controller->doLogin($databasecon,$userEmail,$userPwd,$strUserDtlArr,$DEBUG_STATUS);
    		//echo '1'  ;
			if($DEBUG_STATUS)
			{
				echo '$UserId retrieved::'.$strUserDtlArr[0].'<br>';
				//echo '$User Role retrieved::'.$strUserDtlArr[2].'<br>';
			}
			if(isset($err_code) and $err_code==0)
			{
				if(isset($_SESSION['last_url']))
					$url=$_SESSION['last_url'];
				else
					$url='perfilConductor.php';
				
			}
			else
			{
				$_SESSION["session_msg"]="Credenciales incorrecto o cuenta esta eliminada. Intenta nuevamente con detalles correcto.";
				$url='userlogin.php';
			}
    	}
    	else
    	{
    		//User not regsitered
    		$_SESSION["session_msg"]="No estas registrado en nuestro sistema. Por favor registrar ahora.";
    		$url='userlogin.php';
    	}
		//echo $url;
		header("Location:$url");
    }
?>