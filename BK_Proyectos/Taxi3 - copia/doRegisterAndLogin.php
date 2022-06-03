<?php
	//avoid direct access
	defined('__JEXEC') or ('Access denied');
	session_start();
    //include_once('util.php');
	include_once('config.php'); 
	require 'dbcontroller.php';

	$session_time=$session_expirry_time;
    
    //assign commaon local variables
    $dbcon = $databasecon;
    $DEBUG_STATUS = $PRINT_LOG;
  	$err_code=0;
    $session_time=$session_expirry_time;

    //validate session expire
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

    //process login
    if(isset($_POST['submitted']))
    {
    	//echo 'SUBMITTED<br>';
    	$controller = new controller();    	
    	$userEmail = $_POST['userEmail'];
		$userPwd = $_POST['userPwd'];
		//$userRole = $_POST['userRole'];
		$err_code = $controller->doRegisterAndLogin($databasecon,$userEmail,$userPwd,null,$DEBUG_STATUS);
		if(isset($err_code) and $err_code==0)
		{
			/*if(isset($userRole) and $userRole==2)
				$url='perfilConductor.php';
			elseif (isset($userRole) and $userRole==3) {
				$url='perfilPasajero.php';
			}*/
            $_SESSION["session_msg"]="<h3>FELICITACIONES!</h3><br>SE HA CREADO CUENTA CORRECTAMENTE EN NUESTRO SISTEMA. <br>PARA VERIFICAR SU CORREO ELECTRONICO, SE HA ENVIADO UN LINK DE ACTIVACION A ".strtoupper($userEmail);
			$url='perfilConductor.php';
		}
		else
		{
			if(isset($err_code) and $err_code==1)
            {
                $url='errorDisplay.php?err=1';
            }
            else
            {
                $url='errorDisplay.php?err=2';
            }
		}
		header("Location:$url"); 
		
    }
    else
    {
    	//echo 'FACEBOOK<br>';
    	//echo 'EMAIL:'.$_SESSION['email'].'<br>';
    	$controller = new controller();    	
    	$userEmail = $_SESSION['email'];
		$userPwd = 'facebook534';
		//$userRole = $_POST['userRole'];
		$err_code = $controller->doRegisterAndLogin($databasecon,$userEmail,$userPwd,null,$DEBUG_STATUS);
		if(isset($err_code) and $err_code==0)
		{
			/*if(isset($userRole) and $userRole==2)
				$url='perfilConductor.php';
			elseif (isset($userRole) and $userRole==3) {
				$url='perfilPasajero.php';
			}*/

			$url='perfilConductor.php';
		}
		else
		{
			$url='errorDisplay.php';
		}
		header("Location:$url"); 
    }
?>