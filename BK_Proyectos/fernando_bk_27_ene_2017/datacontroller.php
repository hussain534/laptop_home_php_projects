<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
	include_once('config.php');	
	$DEBUG_STATUS = $PRINT_LOG;

	require 'dbcontroller.php';
	$controller = new controller();
	if(isset($_GET["dojob"]))
	{
		
		if($_GET["dojob"]==98 && $_GET["metodo"]==0)
		{	
			//echo $_POST['user_email'].'<br>';
			//echo $_POST['user_password'].'<br>';
			$err = $controller->loginUser($databasecon,$_POST['user_id'],$_POST['user_password'],$DEBUG_STATUS);	
			//echo $err.'<br>';
			if($err>0)	
			{
				if($err==1)
				{
					$url='home.php';
				}
			}
			else
			{
				$url='index.php';
				$_SESSION["message"]="Usuario no existe. Registar usuario <a href=registrar.php>REGISTRAR</a>";
			}
			header("Location:$url");
		}
		else if($_GET["dojob"]==98 && $_GET["metodo"]==1)
		{	
			$err = $controller->recuperarClave($databasecon,$_POST['user_id'],$DEBUG_STATUS);	
			//echo 'FINAL:'.$err.'<br>';
			if($err==0)
			{
				$_SESSION["message"]="<center>ERROR EN RECUPERAR CLAVE. INTENTA MAS TARDE</center>";				
			}
			else if($err==2)
			{
				$_SESSION["message"]="<center>CLAVE RECUPERADO PERO ERROR EN ENVIAR EMAIL.</center>";
			}
			else if($err==3)
			{
				$_SESSION["message"]='<center>EMAIL- '.$_POST['user_email'].' NO SE ENCUENTRA REGISTRADO EN SISTEMA.INGRESA DATOS CORRECTOS.</center>';
			}
			else
			{
				$_SESSION["message"]="<center>CLAVE RECUPERADO Y ENVIADO A SU CORREO. PORFA REVISAR SU CORREO Y USA LA CLAVE ENVIADO PARA INGRESAR EN SISTEMA</center>";
			}
			$url='recuperarClave.php';
			header("Location:$url");
		}
		else if($_GET["dojob"]==98 && $_GET["metodo"]==2)
		{	
			$err = $controller->cambiarClave($databasecon,$_GET['clave_anterior'],$_GET['clave_nuevo'],$DEBUG_STATUS);	
			echo 'FINAL:'.$err.'<br>';
			if($err==0)
			{
				$_SESSION["message"]="<center>ERROR EN ACTUALIZAR CLAVE. INTENTA MAS TARDE</center>";
			}
			else if($err==2)
			{
				$_SESSION["message"]="<center>ERROR EN ENVIAR EMAIL.CLAVE NO ACTUALIZADO</center>";
			}
			else if($err==3)
			{
				$_SESSION["message"]='<center>CLAVE ANTERIOR INGRESADO NO RELACIONADO CON EMAIL- '.$_SESSION["user_email"].'. INGRESA DATOS CORRECTOS.</center>';
			}
			else
			{
				$_SESSION["message"]="<center>CLAVE ACTUALIZADO Y ENVIADO A SU CORREO. PORFA REVISAR SU CORREO Y USA LA CLAVE ENVIADO PARA INGRESAR EN SISTEMA</center>";
			}
			$url='cambiarClave.php';
			//header("Location:$url");
		}
		else if($_GET["dojob"]==0 && $_GET["metodo"]==0)
		{
			$err = $controller->registrarCliente($databasecon,1,$_GET["nombre_cliente"],$_GET["ciudad_cliente"],$_GET["client_telefono"],$_GET["client_celular"],$_GET["client_email"],$_GET["admin_name"],$_GET["admin_password"],$DEBUG_STATUS);	
			//echo $err.'<br>';
			if($err==1)	
			{
				echo '<center><h4>CLIENTE <span style="color:cornsilk">'.strtoupper($_GET["nombre_cliente"]).'</span> REGISTRADO</h4>.<br>
						<h5>SI EL CLIENTE RECIEN FUE CREADO, ESPERAN HASTA QUE NUESTRO AREA SE VALIDA SU INFORMACION</h5><br>
						<h5>LLAMANOS A SERVICIO CLIENTE PARA ABRIR UN TICKET<h5><br>
						<h4>ESTE PAGINA SE DIRECCIONA A PAGINA PRINCIPLA EN 20 SEGUNDOS<h4></center>';
		
			}
			else if($err==0)
			{
				echo '<center><h4>ERROR OCURIDO. INTENTA NUEVAMENTE</h4>';
			}
			else if($err<0)
			{
				echo '<center><h4>EMAIL DE ADMINISTRADOR '.$_GET["client_email"].' EXISTE. </h4>';
				echo '<button type="button" class="btn btn-big btn_center"><a href="registrar.php">REGISTRAR CON OTROS DATOS</a><span class="glyphicon glyphicon-chevron-right"></span></button></center>';
			}
			else if($err==9)
			{
				echo '<center><h4>ERROR EN ENVIAR CORREO DE CONFIRMACION DE REGISTRO DE CUENTA. </h4>';
			}
			else if($err==8)
			{
				echo '<center><h4>ERROR EN CREACION DE CLIENTE. </h4>';
			}
			else if($err==7)
			{
				echo '<center><h4>ERROR EN REGISTRO DE CIUDAD DEL CLIENTE. </h4>';
			}
			else if($err==6)
			{
				echo '<center><h4>ERROR EN REGISTRO DE DETALLES DEL ADMINISTRADOR. </h4>';
			}
			else if($err==5)
			{
				echo '<center><h4>ERROR EN REGISTRO DE DETALLES DEL CLIENTE. </h4>';
			}
			else if($err==4)
			{
				echo '<center><h4>CLIENTE '.$_GET["nombre_cliente"].' EXISTE. </h4>';
				echo '<button type="button" class="btn btn-big btn_center"><a href="registrar.php">REGISTRAR CON OTROS DATOS</a><span class="glyphicon glyphicon-chevron-right"></span></button></center>';
			}
		}		
		else
		{
			$_SESSION["message"]='ERROR EN DATA.';	
		}		
	}
	else
	{
		//echo '<h3>[ERROR:addEntidad]:input invalido</h3>';
		$_SESSION["message"]='ERROR EN DATA.';
	}
	
?>
						