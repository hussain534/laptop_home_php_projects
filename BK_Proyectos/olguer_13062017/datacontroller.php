<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
	include_once('config.php');	
	$DEBUG_STATUS = $PRINT_LOG;

	require 'dbcontroller.php';
	$controller = new controller();
	/*if(!isset($_SESSION["user_name"]))
	{
		$url='index.php?error=1';
		header("Location:$url");
	}*/
	if(isset($_GET["dojob"]))
	{
		/*  doJob=1 : administrar entidad
					metodo 0 : agregar o habilitar entidad
					metodo 1 : deshabilitar entidad 
			doJob=2 : administrar perfil
					metodo 0 : agregar o habilitar perfil
					metodo 1 : deshabilitar perfil
			doJob=3 : administrar ciudad
					metodo 0 : agregar o habilitar ciudad
					metodo 1 : deshabilitar ciudad

		*/
		if($_GET["dojob"]==98 && $_GET["metodo"]==0)
		{	
			//echo $_POST['user_email'].'<br>';
			//echo $_POST['user_password'].'<br>';
			$err = $controller->loginUser($databasecon,$_POST['user_email'],$_POST['user_password'],$DEBUG_STATUS);	
			//echo $err.'<br>';
			if($err>0)	
			{
				if($err==1)
				{
					if($_SESSION["client_id"]==1 && $_SESSION["user_perfil"]<=2)
						$url='adminClientes.php';
					else
						$url='dashboard.php';
				}
				else if($err==2)
				{
					$url='error.php';
					$_SESSION["message"]="<center><h3>CLIENTE NO HABILITADO.</h3><br>
						<h5>SI EL CLIENTE RECIEN FUE CREADO, ESPERAN HASTA QUE NUESTRO AREA SE VALIDA SU INFORMACION</h5><br>
						<h5>LLAMANOS A SERVICIO CLIENTE PARA ABRIR UN TICKET<h5></center>";
				}
			}
			else
			{
				$url='login.php';
				$_SESSION["message"]="Usuario no existe. Registar usuario <a href=registrar.php>REGISTRAR</a>";
			}
			header("Location:$url");
		}
		else if($_GET["dojob"]==98 && $_GET["metodo"]==1)
		{	
			$err = $controller->recuperarClave($databasecon,$_POST['user_email'],$DEBUG_STATUS);	
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
		else if($_GET["dojob"]==1 && $_GET["metodo"]==0)
		{
			$err = $controller->addEntidad($databasecon,$_SESSION["user_id"],$_GET["nombre_entidad"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				if($err==2)
					$_SESSION["message"]='ENTIDAD EXISTE Y HABILITADO EN BASE.';
				else	
					$_SESSION["message"]='ENTIDAD GUARDADO CORRECTAMENTE';
			}
		}
		else if($_GET["dojob"]==1 && $_GET["metodo"]==1)
		{
			$err = $controller->delEntidad($databasecon,$_SESSION["user_id"],$_GET["id_entidad"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				//echo '<h3>[EXITOSO:addEntidad]:DATA ELIMINADO CORRECTAMENTE</h3>';		
				$_SESSION["message"]='ENTIDAD DESHABILITADO CORRECTAMENTE';
			}
		}
		else if($_GET["dojob"]==2 && $_GET["metodo"]==0)
		{
			echo '20-<br>';
			$err = $controller->addPerfil($databasecon,$_GET["nombre_perfil"],$_GET["perfil_padre"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				if($err==2)
					$_SESSION["message"]='PERFIL EXISTE Y HABILITADO EN BASE.';
				else	
					$_SESSION["message"]='PERFIL GUARDADO CORRECTAMENTE';
			}
			else
				$_SESSION["message"]=$_SESSION["user_id"];
		}
		else if($_GET["dojob"]==2 && $_GET["metodo"]==1)
		{
			$err = $controller->delPerfil($databasecon,$_SESSION["user_id"],$_GET["id_perfil"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				$_SESSION["message"]='PERFIL DESHABILITADO CORRECTAMENTE';
			}
		}
		else if($_GET["dojob"]==2 && $_GET["metodo"]==2)
		{
			$err = $controller->editPerfil($databasecon,$_SESSION["user_id"],$_GET["id_perfil"],$_GET["nombre_perfil"],$_GET["idPerfilPadre"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				$_SESSION["message"]='PERFIL ACTUALIZADO CORRECTAMENTE';
			}
		}
		else if($_GET["dojob"]==3 && $_GET["metodo"]==0)
		{
			$err = $controller->addCiudad($databasecon,$_SESSION["user_id"],$_GET["nombre_ciudad"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				if($err==2)
					$_SESSION["message"]='CIUDAD EXISTE Y HABILITADO EN BASE.';
				else	
					$_SESSION["message"]='CIUDAD GUARDADO CORRECTAMENTE';
			}
		}
		else if($_GET["dojob"]==3 && $_GET["metodo"]==1)
		{
			$err = $controller->delCiudad($databasecon,$_SESSION["user_id"],$_GET["id_ciudad"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				//echo '<h3>[EXITOSO:addEntidad]:DATA ELIMINADO CORRECTAMENTE</h3>';		
				$_SESSION["message"]='CIUDAD DESHABILITADO CORRECTAMENTE';
			}
		}
		else if($_GET["dojob"]==3 && $_GET["metodo"]==2)
		{
			$ciudad = $controller->getCiudadByClient($databasecon,$_GET["id_client"],$DEBUG_STATUS);	
			//echo $ciudad.'<br>';
			?>
				<option value="99">TODOS</option>
				<?php 								
					if(isset($ciudad) && count($ciudad)>0)
					{
						for($x=0;$x<count($ciudad);$x++)
						{
							echo '<option value='.$ciudad[$x][0].'>['.$ciudad[$x][0].']['.$ciudad[$x][1].']</option>';
						}
					}
				?>
			<?php			
		}
		else if($_GET["dojob"]==3 && $_GET["metodo"]==3)
		{
			$err = $controller->editCiudad($databasecon,$_GET["id_ciudad"],$_GET["nombre_ciudad"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				$_SESSION["message"]='CIUDAD ACTUALIZADO CORRECTAMENTE';
			}
			else
				$_SESSION["message"]=$err;			
		}
		else if($_GET["dojob"]==3 && $_GET["metodo"]==4)
		{
			$err = $controller->getClientTipo($databasecon,$_GET["id_client"],$DEBUG_STATUS);	
			echo $err;	
		}
		else if($_GET["dojob"]==4 && $_GET["metodo"]==0)
		{
			$err = $controller->addCliente($databasecon,$_SESSION["user_id"],$_GET["nombre_cliente"],$_GET["ciudad_cliente"],$_GET["client_telefono"],$_GET["client_celular"],$_GET["client_email"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				if($err==2)
					$_SESSION["message"]='CLIENTE EXISTE Y HABILITADO EN BASE.';
				else	
					$_SESSION["message"]='CLIENTE GUARDADO CORRECTAMENTE';
			}
		}
		else if($_GET["dojob"]==4 && $_GET["metodo"]==1)
		{
			$err = $controller->delCliente($databasecon,$_SESSION["user_id"],$_GET["id_cliente"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				//echo '<h3>[EXITOSO:addEntidad]:DATA ELIMINADO CORRECTAMENTE</h3>';		
				$_SESSION["message"]='CLIENTE DESHABILITADO CORRECTAMENTE';
			}
		}
		else if($_GET["dojob"]==4 && $_GET["metodo"]==2)
		{
			$err = $controller->editCliente($databasecon,$_SESSION["user_id"],$_GET["id_cliente"],$_GET["nombre_cliente"],$_GET["ciudad_cliente"],$_GET["client_telefono"],$_GET["client_celular"],$_GET["client_email"],$_GET["client_admin"],$_GET["client_admin_id"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				//echo '<h3>[EXITOSO:addEntidad]:DATA ELIMINADO CORRECTAMENTE</h3>';		
				$_SESSION["message"]='CLIENTE ACTUALIZADO CORRECTAMENTE';
			}
		}
		else if($_GET["dojob"]==4 && $_GET["metodo"]==3)
		{
			$err = $controller->aprobarCliente($databasecon,$_SESSION["user_id"],$_GET["id_cliente"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				//echo '<h3>[EXITOSO:addEntidad]:DATA ELIMINADO CORRECTAMENTE</h3>';		
				$_SESSION["message"]='CLIENTE DESHABILITADO CORRECTAMENTE';
			}
		}
		else if($_GET["dojob"]==5 && $_GET["metodo"]==0)
		{
			$err = $controller->addMenu($databasecon,$_SESSION["user_id"],$_GET["menu_sec"],$_GET["menu_tipo"],$_GET["menu_nombre"],$_GET["menu_url"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				if($err==2)
					$_SESSION["message"]='MENU SECUENCIAL EXISTE.POR FAVOR CAMBIAR NUMERO DE SECUENCIAL.<br>SECUENCIAL:'.$_GET["menu_sec"].'<br>TIPO:'.$_GET["menu_tipo"].'<br>NOMBRE:'.$_GET["menu_nombre"].'<br>URL:'.$_GET["menu_url"];
				else	
					$_SESSION["message"]='MENU GUARDADO CORRECTAMENTE';
			}
			else
				$_SESSION["message"]='ERROR';
		}
		else if($_GET["dojob"]==5 && $_GET["metodo"]==2)
		{
			if(strcmp($_GET["old_menu_sec"], $_GET["menu_sec"])==0)
			{
				$err = $controller->editMenu($databasecon,$_SESSION["user_id"],$_GET["id_menu"],$_GET["menu_sec"],$_GET["menu_tipo"],$_GET["menu_nombre"],$_GET["menu_url"],$DEBUG_STATUS);	
			}
			else
			{
				$err = $controller->addMenu($databasecon,$_SESSION["user_id"],$_GET["menu_sec"],$_GET["menu_tipo"],$_GET["menu_nombre"],$_GET["menu_url"],$DEBUG_STATUS);	
			}			
			echo $err.'<br>';
			if($err>0)	
			{
				if($err==2)
					$_SESSION["message"]='MENU SECUENCIAL EXISTE.POR FAVOR CAMBIAR NUMERO DE SECUENCIAL.<br>SECUENCIAL:'.$_GET["menu_sec"].'<br>TIPO:'.$_GET["menu_tipo"].'<br>NOMBRE:'.$_GET["menu_nombre"].'<br>URL:'.$_GET["menu_url"];
				else
					$_SESSION["message"]='MENU ACTUALIZADO CORRECTAMENTE';
			}
			else
				$_SESSION["message"]='ERROR'.$err;
		}
		else if($_GET["dojob"]==5 && $_GET["metodo"]==1)
		{
			$err = $controller->delMenu($databasecon,$_SESSION["user_id"],$_GET["id_menu"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				//echo '<h3>[EXITOSO:addEntidad]:DATA ELIMINADO CORRECTAMENTE</h3>';		
				$_SESSION["message"]='MENU HABILITADO/DESHABILITADO CORRECTAMENTE';
			}
		}
		else if($_GET["dojob"]==6 && $_GET["metodo"]==0)
		{
			$permisos = $controller->getPermisos($databasecon,$_SESSION["user_id"],$_GET["id_menu"],$DEBUG_STATUS);
			if(isset($permisos) && count($permisos)>0)	
				echo '<h4>SE ENCUENTRA SIGUIENTE PERMISOS HABILITADOS</h4>';	
			else
				echo '<h4>NO SE ENCUENTRA NINGUN PERMISOS HABILITADOS</h4>';
			//echo $err.'<br>';
			?>
			<div class="row tbl_row_heading">
						<div class="col-sm-6">
							<h4>MENU</h4>
						</div>				
						<div class="col-sm-6">
							<h4>PERFIL</h4>
						</div>
					</div>
			<?php
			if(isset($permisos) && count($permisos)>0)	
			{	
				for($x=0;$x<count($permisos);$x++)
				{
					?>
					<div class="row tbl_row_data">
						<div class="col-sm-6">
							<?php echo $permisos[$x][1];?>
						</div>
						<div class="col-sm-6">
							<?php echo $permisos[$x][2];?>
							<a href="#" onclick=delPermisos('<?php echo $permisos[$x][3];?>','<?php echo $permisos[$x][4];?>')><span class="glyphicon glyphicon-remove"></span></a>
						</div>
					</div>
					<?php
				}
			}
		}
		else if($_GET["dojob"]==6 && $_GET["metodo"]==1)
		{
			$err = $controller->addPermisos($databasecon,$_SESSION["user_id"],$_GET["menu_id"],$_GET["perfil_id"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				if($err==2)
					$_SESSION["message"]='MENU ESTA HABILITADO PARA ESTE PERFIL.POR FAVOR ELIGE OTRO COMBINACION';
				else	
					$_SESSION["message"]='MENU HABILITADO CORRECTAMENTE';
			}
			else
				$_SESSION["message"]='ERROR';
		}
		else if($_GET["dojob"]==6 && $_GET["metodo"]==2)
		{
			$err = $controller->delPermisos($databasecon,$_SESSION["user_id"],$_GET["menu_id"],$_GET["perfil_id"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				$_SESSION["message"]='PERMISOS QUITADO CORRECTAMENTE';
			}
			else
				$_SESSION["message"]='ERROR';
		}
		else if($_GET["dojob"]==7 && $_GET["metodo"]==0)
		{
			//echo '20-<br>';
			$err = $controller->addSucursal($databasecon,$_GET["sucursal_name"],$_GET["idCiudad"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				if($err==2)
					$_SESSION["message"]='SUCURSAL EXISTE Y HABILITADO EN BASE.';
				else	
					$_SESSION["message"]='SUCURSAL GUARDADO CORRECTAMENTE';
			}
			else
				$_SESSION["message"]='ERROR EN CREACION DE SUCURSAL';
		}
		else if($_GET["dojob"]==7 && $_GET["metodo"]==1)
		{
			$err = $controller->delSucursal($databasecon,$_GET["id_sucursal"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				$_SESSION["message"]='SUCURSAL DESHABILITADO CORRECTAMENTE';
			}
		}
		else if($_GET["dojob"]==7 && $_GET["metodo"]==2)
		{
			$err = $controller->editSucursal($databasecon,$_GET["id_sucursal"],$_GET["nombre_sucursal"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				$_SESSION["message"]='SUCURSAL ACTUALIZADO CORRECTAMENTE';
			}
			else
				$_SESSION["message"]=$err;
		}
		else if($_GET["dojob"]==7 && $_GET["metodo"]==3)
		{
			$sucursales = $controller->getSucursalesByCiudad($databasecon,$_GET["ciudad_id"],$DEBUG_STATUS);
			
			//echo $err.'<br>';
			echo '<option value="99">Elige SUCURSAL</option>';
			if(isset($sucursales) && count($sucursales)>0)	
			{	
				for($x=0;$x<count($sucursales);$x++)
				{
					echo '<option value="'.$sucursales[$x][0].'">['.$sucursales[$x][0].']['.$sucursales[$x][1].']</option>';
					
				}
			}
		}
		else if($_GET["dojob"]==7 && $_GET["metodo"]==4)
		{
			$sucursales = $controller->getSucursalesByCiudad($databasecon,$_GET["ciudad_id"],$DEBUG_STATUS);
			
			//echo $err.'<br>';
			echo '<option value="99">Elige SUCURSAL</option>';
			if(isset($sucursales) && count($sucursales)>0)	
			{	
				for($x=0;$x<count($sucursales);$x++)
				{
					if(isset($sucursales[$x][5]) && $sucursales[$x][5]!=0)
						echo '<option value="'.$sucursales[$x][0].'">['.$sucursales[$x][0].']['.$sucursales[$x][1].']</option>';
					else
						echo '<option value=98>['.$sucursales[$x][0].']['.$sucursales[$x][1].']</option>';
				}
			}
		}
		else if($_GET["dojob"]==8 && $_GET["metodo"]==0)
		{
			//echo '20-<br>';
			//echo 'SALA:'.$_GET["sala_name"].'<br>';
			$err = $controller->addSala($databasecon,$_GET["sala_name"],$_GET["sucursal_id"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				if($err==2)
					$_SESSION["message"]='SALA -'.$_GET["sala_name"].' EXISTE Y HABILITADO EN BASE.';
				else	
					$_SESSION["message"]='SALA -'.$_GET["sala_name"].' GUARDADO CORRECTAMENTE';
			}
			else
				$_SESSION["message"]='ERROR EN CREACION DE SALA-'.$_GET["sala_name"];
		}
		else if($_GET["dojob"]==8 && $_GET["metodo"]==1)
		{
			$err = $controller->delSala($databasecon,$_GET["id_sala"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				$_SESSION["message"]='SALA DESHABILITADO CORRECTAMENTE';
			}
		}
		else if($_GET["dojob"]==8 && $_GET["metodo"]==2)
		{
			$err = $controller->editSala($databasecon,$_GET["id_sala"],$_GET["sala_name"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				$_SESSION["message"]='SALA ACTUALIZADO CORRECTAMENTE';
			}
			else
				$_SESSION["message"]='ERROR EN ACTUALIZACION DE SALA';
		}
		else if($_GET["dojob"]==8 && $_GET["metodo"]==3)
		{
			$salas = $controller->getSalasBySucursal($databasecon,$_GET["sucursal_id"],$DEBUG_STATUS);
			
			//echo $err.'<br>';
			echo '<option value="99">Elige SALA</option>';
			if(isset($salas) && count($salas)>0)	
			{	
				for($x=0;$x<count($salas);$x++)
				{
					echo '<option value="'.$salas[$x][0].'">['.$salas[$x][0].']['.$salas[$x][1].']</option>';
				}
			}
		}
		else if($_GET["dojob"]==9 && $_GET["metodo"]==0)
		{
			//echo '20-<br>';
			$err = $controller->addUser($databasecon,$_GET["supervision_id"],$_GET["user_name"],$_GET["user_email"],$_GET["user_tele"],$_GET["user_celular"],$_GET["user_direccion"],$_GET["perfil_id"],$_GET["client_id"],$_GET["ciudad_id"],$_GET["sucursal_id"],$_GET["sala_id"],$_GET["tipo_cliente"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				if($err==2)
					$_SESSION["message"]='USUARIO EXISTE EN BASE.INTENTA CON OTRO DATOS';
				else	
					$_SESSION["message"]='USUARIO GUARDADO CORRECTAMENTE';
			}
			else
				$_SESSION["message"]='ERROR EN CREACION DE USUARIO';
		}
		else if($_GET["dojob"]==9 && $_GET["metodo"]==1)
		{
			$users = $controller->getUsersBySala($databasecon,$_GET["ciudad_id"],$_GET["sucursal_id"],$_GET["sala_id"],$DEBUG_STATUS);
			
			//echo $err.'<br>';
			echo '<option value="99">Elige Tecnico</option>';
			if(isset($users) && count($users)>0)	
			{	
				for($x=0;$x<count($users);$x++)
				{
					echo '<option value="'.$users[$x][0].'">['.$users[$x][0].']['.$users[$x][1].']</option>';
				}
			}
		}
		else if($_GET["dojob"]==9 && $_GET["metodo"]==2)
		{
			$updStatus = $controller->asignarTecnicoSucursal($databasecon,$_GET["tecnico_id"],$_GET["id_equipos"],$DEBUG_STATUS);
			
			$_SESSION["message"]= '<h5>'.$updStatus.' sucursal asignados</h5>';
		}
		else if($_GET["dojob"]==9 && $_GET["metodo"]==3)
		{
			$updStatus = $controller->asignarTecnicoParaPeticiones($databasecon,$_GET["tecnico_id"],$_GET["id_equipos"],$DEBUG_STATUS);
			
			$_SESSION["message"]= '<h5>'.$updStatus.' peticiones asignados</h5>';
		}
		else if($_GET["dojob"]==9 && $_GET["metodo"]==4)
		{
			$err = $controller->editUser($databasecon,$_GET["user_id"],$_GET["supervision_id"],$_GET["user_name"],$_GET["user_email"],$_GET["user_tele"],$_GET["user_celular"],$_GET["user_direccion"],$_GET["perfil_id"],$_GET["client_id"],$_GET["ciudad_id"],$_GET["sucursal_id"],$_GET["sala_id"],$_GET["tipo_cliente"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				$_SESSION["message"]='USER ACTUALIZADO CORRECTAMENTE';
			}
			else
				$_SESSION["message"]='ERROR EN ACTUALIZACION DE USER';
		}
		else if($_GET["dojob"]==9 && $_GET["metodo"]==5)
		{
			$err = $controller->disableUser($databasecon,$_GET["user_id"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err>0)	
			{
				$_SESSION["message"]='USER ACTUALIZADO CORRECTAMENTE';
			}
			else
				$_SESSION["message"]='ERROR EN ACTUALIZACION DE USER';
		}
		else if($_GET["dojob"]==9 && $_GET["metodo"]==9)
		{
			$users = $controller->buscarUser($databasecon,$_GET["user_name"],$_GET["user_email"],$_GET["user_tele"],$_GET["user_celular"],$_GET["user_direccion"],$_GET["perfil_id"],$_GET["client_id"],$_GET["ciudad_id"],$_GET["sucursal_id"],$_GET["sala_id"],$_GET["tipo_cliente"],$DEBUG_STATUS);	
			if(isset($users))
				echo '<label for="permisos">SE ENCUENTRA '.count($users).' USUARIOS:</label><br>';
			if($users>0)	
			{
				?>
				<div class="row tbl_row_heading">
							<div class="col-sm-1" style="width:3%">
								<h6>ID</h6>
							</div>				
							<div class="col-sm-2">
								<h6>NOMBRE</h6>
							</div>
							<div class="col-sm-3">
								<h6>CONTACTOS</h6>
							</div>
							<div class="col-sm-2">
								<h6>PERFIL</h6>
							</div>
							<div class="col-sm-3">
								<h6>UBICACION OFICIAL</h6>
							</div>						
							<div class="col-sm-1">
								<h6>HABILITADO</h6>
							</div>
						</div>
						<?php 
						
						if(isset($users) && count($users)>0)
						{
							for($x=0;$x<count($users);$x++)
							{
						?>
								<div class="row tbl_row_data" style="font-size:12px">
									<div class="col-sm-1" style="width:3%">
										<?php echo $users[$x][0];?>
									</div>				
									<div class="col-sm-2">									
										<?php echo $users[$x][1];?>
									</div>
									<div class="col-sm-3">
										<?php echo $users[$x][2];?><br>
										<?php echo $users[$x][3];?><br>
										<?php echo $users[$x][4];?><br>
										<?php echo $users[$x][5];?><br>
									</div>
									<div class="col-sm-2">									
										<?php echo $users[$x][6];?>
									</div>
									<div class="col-sm-3">									
										<?php echo $users[$x][8];?><br>
										<?php echo $users[$x][9];?><br>				
										<?php echo $users[$x][10];?><br>
									</div>
									<div class="col-sm-1 text-center">
										<?php if($users[$x][11]==0) echo 'NO'; else echo 'SI';?>
										<?php echo '<a href="#" onclick=disableUser("'.$users[$x][0].'","'.urlencode($users[$x][1]).'")><span class="glyphicon glyphicon-remove glyphicon_edit"></span></a>';?>
										<?php echo '<a href="#" onclick=habilitarEditUser("'.$users[$x][0].'","'.urlencode($users[$x][1]).'","'.urlencode($users[$x][2]).'","'.urlencode($users[$x][3]).'","'.urlencode($users[$x][4]).'","'.urlencode($users[$x][5]).'","'.urlencode($users[$x][12]).'","'.urlencode($users[$x][13]).'","'.urlencode($users[$x][14]).'","'.urlencode($users[$x][15]).'","'.urlencode($users[$x][16]).'","'.urlencode($users[$x][17]).'")><span class="glyphicon glyphicon-pencil glyphicon_edit"></span></a>';?>
									</div>
								</div>
						<?php	
								}	
							}
			}
			else
				$_SESSION["message"]='ERROR EN CREACION DE USUARIO';
		}
		else if($_GET["dojob"]==10 && $_GET["metodo"]==0)
		{
			//echo '20-<br>';
			$err = $controller->addEquipo($databasecon,$_GET["equipo_nombre"],$_GET["equipo_modelo"],$_GET["equipo_marca"],$_GET["equipo_serie"],$_GET["client_id"],$_GET["ciudad_id"],$_GET["sucursal_id"],$_GET["sala_id"],$DEBUG_STATUS);	
			echo $err.'<br>';
			if($err==1)	
			{
				$_SESSION["message"]='EQUIPO GUARDADO CORRECTAMENTE';
			}
			else if($err==2)	
			{
				$_SESSION["message"]='EQUIPO EXISTE CON SERIE:'.$_GET["equipo_serie"];
			}
			else
				$_SESSION["message"]='ERROR EN CREACION DE EQUIPO';
		}
		else if($_GET["dojob"]==10 && $_GET["metodo"]==7)
		{
			//echo '<br><br><br><br>NOMBRE:'.$_GET["equipo_nombre"];
			$equipos = $controller->buscarEquipoPendientesParaPeticion($databasecon,$_GET["equipo_nombre"],$_GET["equipo_modelo"],$_GET["equipo_marca"],$_GET["equipo_serie"],$_GET["client_id"],$_GET["ciudad_id"],$_GET["sucursal_id"],$_GET["sala_id"],$DEBUG_STATUS);	
			if(isset($equipos) && count($equipos)>0)
				echo '<label for="permisos">SE ENCUENTRA '.count($equipos).' EQUIPOS PENDIENTES PARA SOLICITAR SERVICIO:</label><br>';
			else
				echo '<label for="permisos">SE ENCUENTRA 0 EQUIPOS PENDIENTES PARA SOLICITAR SERVICIO:</label><br>';
			if($equipos>0)	
			{
				?>
				<div class="row tbl_row_heading">
							<div class="col-sm-1">
								<h6>ID</h6>
							</div>				
							<div class="col-sm-4">
								<h6>DESCRIPCION</h6>
							</div>						
							<div class="col-sm-2">
								<h6>CIUDAD</h6>
							</div>
							<div class="col-sm-2">
								<h6>SUCURSAL</h6>
							</div>
							<div class="col-sm-2">
								<h6>SALA</h6>
							</div>
							<div class="col-sm-1 text-center">
								<h6>ACTIVO</h6>
							</div>
						</div>
						<?php 
						
						if(isset($equipos) && count($equipos)>0)
						{
							for($x=0;$x<count($equipos);$x++)
							{
						?>
								<div class="row tbl_row_data_static" style="font-size:12px">
									<div class="col-sm-1">
										<!-- <?php echo '<input type="checkbox" onchange=addToListList("'.$equipos[$x][0].'")>';?> -->
										<?php echo '<input type="radio" name="id_equipos" id="id_equipos" value='.$equipos[$x][0].'>';?>
										<?php echo $equipos[$x][0];?>
									</div>				
									<div class="col-sm-4">	
										<?php echo '<strong>CLIENTE : </strong>'.$equipos[$x][2];?><br>								
										<?php echo '<strong>NOMBRE : </strong>'.$equipos[$x][1];?><br>
										<?php echo '<strong>MODELO : </strong>'.$equipos[$x][7];?><br>
										<?php echo '<strong>MARCA : </strong>'.$equipos[$x][8];?><br>
										<?php echo '<strong>SERIE : </strong>'.$equipos[$x][9];?>
									</div>
									<div class="col-sm-2">
										<?php echo $equipos[$x][3];?>
									</div>
									<div class="col-sm-2">									
										<?php echo $equipos[$x][4];?>
									</div>
									<div class="col-sm-2">									
										<?php echo $equipos[$x][5];?>
									</div>
									<div class="col-sm-1 text-center">
										<?php if($equipos[$x][6]==0) echo 'NO'; else echo 'SI';?>
									</div>
								</div>
						<?php	
								}	
							}
			}
			else
				$_SESSION["message"]='ERROR EN CREACION DE USUARIO';
		}
		else if($_GET["dojob"]==10 && $_GET["metodo"]==8)
		{
			//echo '<br><br><br><br>NOMBRE:'.$_GET["equipo_nombre"];
			$equipos = $controller->buscarEquipo($databasecon,$_GET["equipo_nombre"],$_GET["equipo_modelo"],$_GET["equipo_marca"],$_GET["equipo_serie"],$_GET["client_id"],$_GET["ciudad_id"],$_GET["sucursal_id"],$_GET["sala_id"],$DEBUG_STATUS);	
			if(isset($equipos) && count($equipos)>0)
				echo '<label for="permisos">SE ENCUENTRA '.count($equipos).' EQUIPOS:</label><br>';
			else
				echo '<label for="permisos">SE ENCUENTRA 0 EQUIPOS:</label><br>';
			if($equipos>0)	
			{
				?>
				<div class="row tbl_row_heading">
							<div class="col-sm-1">
								<h6>ID</h6>
							</div>				
							<div class="col-sm-4">
								<h6>DESCRIPCION</h6>
							</div>						
							<div class="col-sm-2">
								<h6>CIUDAD</h6>
							</div>
							<div class="col-sm-2">
								<h6>SUCURSAL</h6>
							</div>
							<div class="col-sm-2">
								<h6>SALA</h6>
							</div>
							<div class="col-sm-1">
								<h6>HABILITADO</h6>
							</div>
						</div>
						<?php 
						
						if(isset($equipos) && count($equipos)>0)
						{
							for($x=0;$x<count($equipos);$x++)
							{
						?>
								<div class="row tbl_row_data_static" style="font-size:12px">
									<div class="col-sm-1">
										<!-- <?php echo '<input type="checkbox" onchange=addToListList("'.$equipos[$x][0].'")>';?> -->
										<?php echo '<input type="radio" name="id_equipos" id="id_equipos" value='.$equipos[$x][0].'>';?>
										<?php echo $equipos[$x][0];?>
									</div>				
									<div class="col-sm-4">	
										<?php echo '<strong>CLIENTE : </strong>'.$equipos[$x][2];?><br>								
										<?php echo '<strong>NOMBRE : </strong>'.$equipos[$x][1];?><br>
										<?php echo '<strong>MODELO : </strong>'.$equipos[$x][7];?><br>
										<?php echo '<strong>MARCA : </strong>'.$equipos[$x][8];?><br>
										<?php echo '<strong>SERIE : </strong>'.$equipos[$x][9];?>
									</div>
									<div class="col-sm-2">
										<?php echo $equipos[$x][3];?>
									</div>
									<div class="col-sm-2">									
										<?php echo $equipos[$x][4];?>
									</div>
									<div class="col-sm-2">									
										<?php echo $equipos[$x][5];?>
									</div>
									<div class="col-sm-1 text-center">
										<?php if($equipos[$x][6]==0) echo 'NO'; else echo 'SI';?>
									</div>
								</div>
						<?php	
								}	
							}
			}
			else
				$_SESSION["message"]='ERROR EN CREACION DE USUARIO';
		}
		else if($_GET["dojob"]==10 && $_GET["metodo"]==9)
		{
			$equipos = $controller->buscarEquipo($databasecon,$_GET["equipo_desc"],$_GET["client_id"],$_GET["ciudad_id"],$_GET["sucursal_id"],$_GET["sala_id"],$DEBUG_STATUS);	
			if(isset($equipos))
				echo '<label for="permisos">ELIGE EQUIPOS:</label>';
			if($equipos>0)	
			{
				?>
				<div class="row tbl_row_heading">
							<div class="col-sm-1">
								<h6>ID</h6>
							</div>				
							<div class="col-sm-4">
								<h6>DESCRIPCION</h6>
							</div>						
							<div class="col-sm-2">
								<h6>CIUDAD</h6>
							</div>
							<div class="col-sm-2">
								<h6>SUCURSAL</h6>
							</div>
							<div class="col-sm-2">
								<h6>SALA</h6>
							</div>
							<div class="col-sm-1">
								<h6>HABILITADO</h6>
							</div>
						</div>
						<?php 
						
						if(isset($equipos) && count($equipos)>0)
						{
							for($x=0;$x<count($equipos);$x++)
							{
						?>
								<div class="row tbl_row_data_static" style="font-size:12px">
									<div class="col-sm-1">
										<?php echo '<input type="checkbox" onchange=addToListList("'.$equipos[$x][0].'")>';?>
										<?php echo $equipos[$x][0];?>
									</div>				
									<div class="col-sm-4">									
										<?php echo $equipos[$x][1];?>
									</div>
									<div class="col-sm-2">
										<?php echo $equipos[$x][3];?>
									</div>
									<div class="col-sm-2">									
										<?php echo $equipos[$x][4];?>
									</div>
									<div class="col-sm-2">									
										<?php echo $equipos[$x][5];?>
									</div>
									<div class="col-sm-1 text-center">
										<?php if($equipos[$x][6]==0) echo 'NO'; else echo 'SI';?>
									</div>
								</div>
						<?php	
								}	
							}
			}
			else
				$_SESSION["message"]='ERROR EN CREACION DE USUARIO';
		}
		else if($_GET["dojob"]==10 && $_GET["metodo"]==10)
		{
			//echo '<br><br><br><br>NOMBRE:'.$_GET["equipo_nombre"];
			$equipos = $controller->buscarEquipoParaInformes($databasecon,$_GET["equipo_nombre"],$_GET["equipo_modelo"],$_GET["equipo_marca"],$_GET["equipo_serie"],$_GET["client_id"],$_GET["ciudad_id"],$_GET["sucursal_id"],$_GET["sala_id"],$DEBUG_STATUS);	
			if(isset($equipos) && count($equipos)>0)
				echo '<label for="permisos">SE ENCUENTRA '.count($equipos).' EQUIPOS</label><br>';
			else
				echo '<label for="permisos">SE ENCUENTRA 0 EQUIPOS</label><br>';
			if($equipos>0)	
			{
				?>

				<div class="row tbl_row_heading">
							<div class="col-sm-1">
								<h6>ID</h6>
							</div>				
							<div class="col-sm-3">
								<h6>DESCRIPCION</h6>
							</div>						
							<div class="col-sm-2">
								<h6>CIUDAD</h6>
							</div>
							<div class="col-sm-2">
								<h6>SUCURSAL</h6>
							</div>
							<div class="col-sm-2">
								<h6>SALA</h6>
							</div>
							<div class="col-sm-1 text-center">
								<h6>HABILITADO</h6>
							</div>
							<div class="col-sm-1 text-center">
								<h6>INFORME</h6>
							</div>
						</div>
						<?php 
						
						if(isset($equipos) && count($equipos)>0)
						{
							for($x=0;$x<count($equipos);$x++)
							{
						?>
								<div class="row tbl_row_data_static" style="font-size:12px">
									<div class="col-sm-1">
										<?php echo $equipos[$x][0];?>
									</div>				
									<div class="col-sm-3">									
										<?php echo '<strong>CLIENTE : </strong>'.$equipos[$x][2];?><br>
										<?php echo '<strong>NOMBRE : </strong>'.$equipos[$x][1];?><br>
										<?php echo '<strong>MODELO : </strong>'.$equipos[$x][7];?><br>
										<?php echo '<strong>MARCA : </strong>'.$equipos[$x][8];?><br>
										<?php echo '<strong>SERIE : </strong>'.$equipos[$x][9];?>
									</div>
									<div class="col-sm-2">
										<?php echo $equipos[$x][3];?>
									</div>
									<div class="col-sm-2">									
										<?php echo $equipos[$x][4];?>
									</div>
									<div class="col-sm-2">									
										<?php echo $equipos[$x][5];?>
									</div>
									<div class="col-sm-1 text-center">
										<?php if($equipos[$x][6]==0) echo 'NO'; else echo 'SI';?>
									</div>
									<div class="col-sm-1 text-center">
										<a href=informePeticionesPorEquipo.php?eid=<?php echo $equipos[$x][0];?> target="_blank"><span class="glyphicon glyphicon-folder-open"></span></a>
									</div>
								</div>
						<?php	
								}	
							}
			}
			else
				$_SESSION["message"]='ERROR EN CREACION DE USUARIO';
		}
		else if($_GET["dojob"]==11 && $_GET["metodo"]==0)
		{
			//echo '20-<br>';
			$err = $controller->addSolicitud($databasecon,$_GET["equipo_desc"],$_GET["client_id"],$_GET["ciudad_id"],$_GET["sucursal_id"],$_GET["sala_id"],$_GET["service_id"],$_GET["id_equipos"],$_GET["obser"],$_GET["tecnico_id"],$DEBUG_STATUS);	
			//echo $err.'<br>';
			if($err>0)	
			{
				echo 'SOLICITUD REGISTRADO CORRECTAMENTE. NRO-SOLICITUD:<h3>'.$err.'</h3>';
			}
			else
				echo 'ERROR EN CREACION DE SOLICITUD';
		}
		else if($_GET["dojob"]==11 && $_GET["metodo"]==9)
		{
			$peticiones = $controller->buscarPeticion($databasecon,$_GET["searchPeticionId"],$_GET["estado_id"],$_GET["service_id"],$_GET["client_id"],$_GET["ciudad_id"],$_GET["sucursal_id"],$_GET["sala_id"],$_GET["tipo_cliente"],$DEBUG_STATUS);	
			if(isset($peticiones) && count($peticiones)>0)
				echo '<label for="permisos">SE ENCUENTRA '.count($peticiones).' PETICIONES:</label><br>';
			else
				echo '<label for="permisos">SE ENCUENTRA 0 PETICIONES:</label><br>';
			if($peticiones>0)	
			{
				?>
				<div class="row tbl_row_heading">
					<div class="col-sm-3">
						<h6>ID</h6>
					</div>				
					<div class="col-sm-3">
						<h6>DETALLES</h6>
					</div>						
					<div class="col-sm-3">						
						<h6>SOLICITADO POR</h6>
					</div>
					<div class="col-sm-2">						
						<h6>TECNICO</h6>
					</div>
					<div class="col-sm-1">
						<h6>ACTIVO</h6>
					</div>
				</div>
				<?php 
				
				if(isset($peticiones) && count($peticiones)>0)
				{
					for($x=0;$x<count($peticiones);$x++)
					{
				?>
						<div class="row tbl_row_data_static" style="font-size:12px;line-height: 20px;">
							<div class="col-sm-3">										
								<a href=atender.php?peticion=<?php echo $peticiones[$x][0];?>><?php echo $peticiones[$x][0];?></a>
							</div>				
							<div class="col-sm-3">	
								<?php echo $peticiones[$x][12].'<br>';?>								
								<?php echo $peticiones[$x][13].'<br>';?>
								<?php echo '--------DESC---------<br>';?>
								<?php echo $peticiones[$x][6];?>
							</div>
							<div class="col-sm-3">
								<?php echo '<b>USR : </b>'.$peticiones[$x][11].',';?><br>
								<?php echo '<b>CLI : </b>'.$peticiones[$x][2].',';?><br>
								<?php echo '<b>CIU : </b>'.$peticiones[$x][3].',';?><br>
								<?php echo '<b>SUC : </b>'.$peticiones[$x][4].',';?><br>				
								<?php echo '<b>SAL : </b>'.$peticiones[$x][10];?><br>
							</div>
							<div class="col-sm-2">									
								<?php echo $peticiones[$x][9].'<a href=asignarPeticiones.php?client_id='.$peticiones[$x][14].'&peticion='.$peticiones[$x][0].'><span class="glyphicon glyphicon-pencil glyphicon_edit"></span></a> ';?>
							</div>
							<div class="col-sm-1 text-center">
								<?php if($peticiones[$x][7]==1) echo 'ABIERTA'; else if($peticiones[$x][7]==2) echo 'EN CURSO'; else echo 'CERRADA';?>
							</div>
						</div>
				<?php	
						}	
					}
			}
			else
				$_SESSION["message"]='ERROR EN CREACION DE USUARIO';
		}
		else if($_GET["dojob"]==12 && $_GET["metodo"]==0)
		{
			//echo '20-<br>';
			//if(isset($_GET["equipo_id"]) && $_GET["equipo_id"]==99)
			//{
				$equipos=$controller->getEquiposEnPeticion($databasecon,$_GET["peticion_id"],$DEBUG_STATUS);				
				$err = $controller->actualizarGestionMasiva($databasecon,$equipos,$_GET["peticion_id"],$_GET["equipo_id"],$_GET["estado_id"],$_GET["obser"],$DEBUG_STATUS);	
			//}
			//else				
			//	$err = $controller->actualizarGestion($databasecon,$_GET["peticion_id"],$_GET["equipo_id"],$_GET["estado_id"],$_GET["obser"],$DEBUG_STATUS);	
			//echo $err.'<br>';
			if($err>0)	
			{
				$_SESSION["message"]= 'GESTION REGISTRADO CORRECTAMENTE.';
			}
			else
				$_SESSION["message"]= 'ERROR EN REGISTRAR LA GESTION';
		}
		else if($_GET["dojob"]==12 && $_GET["metodo"]==1)
		{
			$err = $controller->addEquipoParaPeticionDeInstalacion($databasecon,$_GET["peticion_id"],$_GET["nombre_equipo_added"],$_GET["modelo_equipo_added"],$_GET["marca_equipo_added"],$_GET["serie_equipo_added"],$DEBUG_STATUS);	
			
			if($err==3)			
				$_SESSION["message"]= 'EQUIPO CREADO CORRECTAMENTE.';
			else if($err==2)
				$_SESSION["message"]= 'ERROR EN RELACIONAR EQUIPO CON PETICION';
			else if($err==1)
				$_SESSION["message"]= 'ERROR EN CREACION DEL EQUIPO';
			else
				$_SESSION["message"]= 'EXISTE EQUIPO CON SERIE : '.strtoupper($_GET["serie_equipo_added"]);
		}
		else if($_GET["dojob"]==13 && $_GET["metodo"]==0)
		{
			$err = $controller->getPlanificaciones($databasecon,$_GET["client_id"],$_GET["tecnico_id"],$DEBUG_STATUS);	
			
			
		}
		else if($_GET["dojob"]==13 && $_GET["metodo"]==1)
		{
			$tecnicos = $controller->getPlanificacionTecnicos($databasecon,$_GET["client_id"],$DEBUG_STATUS);	
			echo "<option value=99>[99][TODOS]</option>";
			for($x=0;$x<count($tecnicos);$x++)
				echo "<option value=".$tecnicos[$x][0].">[".$tecnicos[$x][0]."] ".$tecnicos[$x][1]."</option>";
			
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
						