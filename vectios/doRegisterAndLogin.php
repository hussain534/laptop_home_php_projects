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
        $userDtl = $controller->getUserDtlFromEmail($databasecon,$userEmail,$DEBUG_STATUS);
        if(isset($userDtl) and count($userDtl)>0)
            $err_code=-1;
        else
		    $err_code = $controller->doRegisterAndLogin($databasecon,$userEmail,$userPwd,null,$DEBUG_STATUS);
		if(isset($err_code) and $err_code==0)
		{
			/*if(isset($userRole) and $userRole==2)
				$url='perfilConductor.php';
			elseif (isset($userRole) and $userRole==3) {
				$url='perfilPasajero.php';
			}*/
            $_SESSION["session_msg"]="<h4>FELICITACIONES!</h4><br>SE HA CREADO CUENTA CORRECTAMENTE EN NUESTRO SISTEMA. <br><br>
                        <h3>SI ERES CONDUCTOR</h3>
                        1. COMPLETAR SU DETALLES DE CONTACTO, NRO CEDULA Y NRO LICENCIA<br>
                        2. REGISTRAR DETALLES DE AUTOMOVIL,IMAGEN DE AUTOMOVIL MOSTRANDO LA PLACA Y IMAGEN DE MATRICULA<br>
                        3. SUBIR IMAGEN DE CEDULA Y LICENCIA<br>
                        4. VERIFICAR SU CORREO ELECTRONICO, SE HA ENVIADO UN LINK DE ACTIVACION A ".strtoupper($userEmail)."<br>
                        <br>
                        <h3>SI ERES PASAJERO</h3>
                        1. COMPLETAR SU DETALLES DE CONTACTO Y NRO CEDULA<br>
                        2. SUBIR IMAGEN DE CEDULA<br>
                        3. VERIFICAR SU CORREO ELECTRONICO, SE HA ENVIADO UN LINK DE ACTIVACION A ".strtoupper($userEmail)."<br>";
			$url='perfilConductor.php';
		}
		else
		{
			if(isset($err_code) and $err_code<0)
            {
                $_SESSION["session_msg"]='CORREO ELECTRONICO EXISTE. INTENTA RECUPERAR SU CLAVE O INGRESA OTROS DATOS';
                $url='userregister.php';
            }
            else if(isset($err_code) and $err_code==1)
            {
                $_SESSION["session_msg"]='ERROR EN CREAR LA CUENTA. INTENTA NUEVAMENTE O LLAMAR SERVICIO AL CLIENTE';
                $url='userregister.php';
            }
            else
            {
                $_SESSION["session_msg"]='ERROR EN CREAR LA CUENTA. INTENTA NUEVAMENTE O LLAMAR SERVICIO AL CLIENTE.';
                $url='userregister.php';
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
        $userDtl = $controller->getUserDtlFromEmail($databasecon,$userEmail,$DEBUG_STATUS);
		if(isset($userDtl) and count($userDtl)>0)
            $err_code=-1;
        else
            $err_code = $controller->doRegisterAndLogin($databasecon,$userEmail,$userPwd,null,$DEBUG_STATUS);
		if(isset($err_code) and $err_code==0)
		{
			/*if(isset($userRole) and $userRole==2)
				$url='perfilConductor.php';
			elseif (isset($userRole) and $userRole==3) {
				$url='perfilPasajero.php';
			}*/
            $_SESSION["session_msg"]="<h4>FELICITACIONES!</h4><br>SE HA CREADO CUENTA CORRECTAMENTE EN NUESTRO SISTEMA. <br><br>
                        <h3>SI ERES CONDUCTOR</h3>
                        1. COMPLETAR SU DETALLES DE CONTACTO, NRO CEDULA Y NRO LICENCIA<br>
                        2. REGISTRAR DETALLES DE AUTOMOVIL,IMAGEN DE AUTOMOVIL MOSTRANDO LA PLACA Y IMAGEN DE MATRICULA<br>
                        3. SUBIR IMAGEN DE CEDULA Y LICENCIA<br>
                        4. VERIFICAR SU CORREO ELECTRONICO, SE HA ENVIADO UN LINK DE ACTIVACION A ".strtoupper($userEmail)."<br>
                        <br>
                        <h3>SI ERES PASAJERO</h3>
                        1. COMPLETAR SU DETALLES DE CONTACTO Y NRO CEDULA<br>
                        2. SUBIR IMAGEN DE CEDULA<br>
                        3. VERIFICAR SU CORREO ELECTRONICO, SE HA ENVIADO UN LINK DE ACTIVACION A ".strtoupper($userEmail)."<br>";
            $url='perfilConductor.php';
		}
		else
        {
            if(isset($err_code) and $err_code<0)
            {
                $_SESSION["session_msg"]='USUARIO DE FACEBOOK EXISTE. INTENTA RECUPERAR SU CLAVE O INGRESA OTROS DATOS';
                $url='userregister.php';
            }
            else if(isset($err_code) and $err_code==1)
            {
                $_SESSION["session_msg"]='ERROR EN CREAR LA CUENTA. INTENTA NUEVAMENTE O LLAMAR SERVICIO AL CLIENTE';
                $url='userregister.php';
            }
            else
            {
                $_SESSION["session_msg"]='ERROR EN CREAR LA CUENTA. INTENTA NUEVAMENTE O LLAMAR SERVICIO AL CLIENTE.';
                $url='userregister.php';
            }
        }
		header("Location:$url"); 
    }
?>