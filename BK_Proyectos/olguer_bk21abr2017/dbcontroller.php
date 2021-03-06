<?php
	//session_start();
	class controller
	{
		//adminEntidad,
		public function getEntidad($dbcon,$DEBUG_STATUS)
		{
			$sql="select id, nombre from p_tipo_entidad where habilitado=1 order by nombre";
			$entidad=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$entidad[$count] = array($row["id"],$row["nombre"]);
					$count++;
				}
			}
			return $entidad;
		}

		//1-0,
		public function addEntidad($dbcon,$userId,$entidad_nombre,$DEBUG_STATUS)
		{
			$sql="select id, nombre from p_tipo_entidad where nombre = '".$entidad_nombre."'";
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO p_tipo_entidad(nombre,habilitado,fecha_creacion,creado_por_usuario) 
				values('".strtoupper($entidad_nombre)."',1,now(),".$userId.")";
				////echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;
		        }
		        else
		        	$updStatus=0;

		        return $updStatus;	
            }
            else
            {
            	if($row = mysqli_fetch_assoc($result)) 
				{
					$sql = "UPDATE p_tipo_entidad SET habilitado=1,fecha_modificacion=now(),modificado_por_usuario=".$userId." 
						WHERE id=".$row["id"];
					////echo $sql.'<br>';
			        if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus = 2;
			        }
			        else
			        	$updStatus=0;
				}
            }
			
		}

		//1-1,
		public function delEntidad($dbcon,$userId,$entidad_id,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_tipo_entidad SET habilitado=0,fecha_modificacion=now(),modificado_por_usuario=".$userId." 
					WHERE id=".$entidad_id;
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;
		}

		//adminPerfil,adminPermisos,adminUser
		public function getPerfils($dbcon,$DEBUG_STATUS)
		{
			$sql="select p1.id, p1.nombre perfil ,p2.nombre perfil_padre,p2.id perfil_padre_id,p1.habilitado from p_perfil p1,p_perfil p2 
			where p1.id_padre=p2.id and p1.id_cliente=".$_SESSION["client_id"]." order by p1.nombre";
			$perfil=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$perfil[$count] = array($row["id"],$row["perfil"],$row["perfil_padre"],$row["habilitado"],$row["perfil_padre_id"]);
					$count++;
				}
			}
			return $perfil;
		}

		//2-0,
		public function addPerfil($dbcon,$perfil_nombre,$padre_perfil,$DEBUG_STATUS)
		{
			$sql="select id, nombre from p_perfil where nombre='".strtoupper($perfil_nombre)."' 
				and id_padre=".$padre_perfil." and id_cliente=".$_SESSION["client_id"]." order by nombre";
			////echo $sql.'<br>';
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO p_perfil(nombre,id_padre,id_cliente,habilitado,fecha_creacion,creado_por) 
				values('".strtoupper($perfil_nombre)."',".$padre_perfil.",".$_SESSION["client_id"].",1,now(),".$_SESSION["user_id"].")";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;
		        }
		        else
		        	$updStatus=0;

		        return $updStatus;	
            }
            else
            {
            	if($row = mysqli_fetch_assoc($result)) 
				{
					$sql = "UPDATE p_perfil SET habilitado=1,fecha_modificacion=now(),modificado_por=".$_SESSION["user_id"]." 
						WHERE id=".$row["id"];
					//echo $sql.'<br>';
			        if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus = 2;
			        }
			        else
			        	$updStatus=0;
				}
            }
			
		}

		//2-1,
		public function delPerfil($dbcon,$userId,$perfil_id,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_perfil SET habilitado=0,fecha_modificacion=now(),modificado_por=".$_SESSION["user_id"]." 
					WHERE id=".$perfil_id;
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;
		}

		//2-2
		public function editPerfil($dbcon,$userId,$perfil_id,$perfil_nombre,$idPerfilPadre,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_perfil SET nombre='".strtoupper($perfil_nombre)."' ,id_padre=".$idPerfilPadre.",fecha_modificacion=now(),modificado_por=".$_SESSION["user_id"]." 
					WHERE id=".$perfil_id;
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;
		}

		//adminCiudad, adminClientes, adminEquipos,adminSala,adminSucursal,adminUser,asignarPeticiones,asignarTecnicos,nuevoPeticion,
		public function getCiudad($dbcon,$DEBUG_STATUS)
		{
			/*$sql="select id, nombre from p_ciudad where id_cliente=".$_SESSION["client_id"]." and habilitado=1 order by nombre";*/
			if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]>0)
				$sql="select id, nombre from p_ciudad where id_cliente=".$_SESSION["client_id"]." and habilitado=1 order by nombre";
			else
				$sql="select id, nombre from p_ciudad where habilitado=1 order by nombre";
			$ciudad=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$ciudad[$count] = array($row["id"],$row["nombre"]);
					$count++;
				}
			}
			return $ciudad;
		}

		//registrar
		public function getCiudadParaRegistrar($dbcon,$DEBUG_STATUS)
		{
			$sql="select id, nombre from p_ciudad where id_cliente=0 and habilitado=1 order by nombre";
			$ciudad=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$ciudad[$count] = array($row["id"],$row["nombre"]);
					$count++;
				}
			}
			return $ciudad;
		}

		//3-2,
		public function getCiudadByClient($dbcon,$client_id,$DEBUG_STATUS)
		{
			$sql="select id, nombre from p_ciudad where";
			if($client_id==99) 
				$sql=$sql." id_cliente>1";
			else
				$sql=$sql." id_cliente=".$client_id;
			$sql=$sql." and habilitado=1 order by nombre";
			$ciudad=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$ciudad[$count] = array($row["id"],$row["nombre"]);
					$count++;
				}
			}
			return $ciudad;
		}

		//3-0,
		public function addCiudad($dbcon,$userId,$nombre_ciudad,$DEBUG_STATUS)
		{
			$sql="select id, nombre from p_ciudad where id_cliente=".$_SESSION["client_id"]." and nombre = '".strtoupper($nombre_ciudad)."'";
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO p_ciudad(id_cliente,nombre,habilitado,fecha_creacion,creacion_por_usuario) 
				values(".$_SESSION["client_id"].",'".strtoupper($nombre_ciudad)."',1,now(),".$_SESSION["user_id"].")";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;
		        }
		        else
		        	$updStatus=0;

		        return $updStatus;	
            }
            else
            {
            	if($row = mysqli_fetch_assoc($result)) 
				{
					$sql = "UPDATE p_ciudad SET habilitado=1,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." 
						WHERE id=".$row["id"];
					//echo $sql.'<br>';
			        if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus = 2;
			        }
			        else
			        	$updStatus=0;
				}
            }
			
		}

		//3-1,
		public function delCiudad($dbcon,$userId,$entidad_id,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_ciudad SET habilitado=0,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." 
					WHERE id=".$entidad_id;
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;
		}

		//3-4
		public function editCiudad($dbcon,$ciudad_id,$ciudad_name,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_ciudad SET nombre='".strtoupper($ciudad_name)."' ,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." 
					WHERE id=".$ciudad_id;
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;
		}

		//adminClientes,adminEquipos, gestionCliente,nuevoPeticion,
		public function getClientes($dbcon,$DEBUG_STATUS)
		{
			/*if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]>1)
			{
				$sql="select cl.id id_cliente,cl.nombre nombre_cliente,cl.id_ciudad ,cl.telefono,cl.celular,
					cl.email,cd.nombre nombre_ciudad,cl.habilitado,p.nombre admin_name,p.id admin_id 
					from p_clientes cl,p_ciudad cd,p_usuario p 
					where p.client_id=cl.id and p.perfil_id in (1,2) and 
					cl.id_ciudad=cd.id and cl.id=".$_SESSION["client_id"]." order by cl.nombre";
			}
			else
			{
				$sql="select cl.id id_cliente,cl.nombre nombre_cliente,cl.id_ciudad ,cl.telefono,cl.celular,
					cl.email,cd.nombre nombre_ciudad,cl.habilitado,p.nombre admin_name,p.id admin_id 
					from p_clientes cl,p_ciudad cd,p_usuario p  
					where p.client_id=cl.id and p.perfil_id in (1,2) and 
					cl.id_ciudad=cd.id order by cl.nombre";
			}*/
			/*if(isset($_SESSION["user_perfil"]) && ($_SESSION["user_perfil"]==1 || $_SESSION["user_perfil"]==20))*/
			if(isset($_SESSION["client_id"]) && $_SESSION["client_id"]==1)
			{
				$sql="select cl.id id_cliente,cl.nombre nombre_cliente,cl.id_ciudad ,cl.telefono,cl.celular,
					cl.email,cd.nombre nombre_ciudad,cl.habilitado,p.nombre admin_name,p.id admin_id 
					from p_clientes cl,p_ciudad cd,p_usuario p  
					where p.client_id=cl.id and p.perfil_id in (1,2) and 
					cl.id_ciudad=cd.id order by cl.nombre";
			}
			else
			{
				$sql="select cl.id id_cliente,cl.nombre nombre_cliente,cl.id_ciudad ,cl.telefono,cl.celular,
					cl.email,cd.nombre nombre_ciudad,cl.habilitado,p.nombre admin_name,p.id admin_id 
					from p_clientes cl,p_ciudad cd,p_usuario p 
					where p.client_id=cl.id and p.perfil_id in (1,2) and 
					cl.id_ciudad=cd.id and cl.id=".$_SESSION["client_id"]." order by cl.nombre";
			}
			$cliente=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$cliente[$count] = array($row["id_cliente"],$row["nombre_cliente"],$row["id_ciudad"],$row["telefono"],$row["celular"],$row["email"],$row["nombre_ciudad"],$row["habilitado"],$row["admin_name"],$row["admin_id"]);
					$count++;
				}
			}
			return $cliente;
		}

		public function getClientesByTipo($dbcon,$tipo_cliente,$DEBUG_STATUS)
		{
			$sql="select cl.id id_cliente,cl.nombre nombre_cliente,cl.id_ciudad ,cl.telefono,cl.celular,
					cl.email,cd.nombre nombre_ciudad,cl.habilitado,p.nombre admin_name,p.id admin_id 
					from p_clientes cl,p_ciudad cd,p_usuario p  
					where p.client_id=cl.id and p.perfil_id in (1,2) and cl.tipo_cliente=".$tipo_cliente." and 
					cl.id_ciudad=cd.id order by cl.nombre";
			$cliente=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$cliente[$count] = array($row["id_cliente"],$row["nombre_cliente"],$row["id_ciudad"],$row["telefono"],$row["celular"],$row["email"],$row["nombre_ciudad"],$row["habilitado"],$row["admin_name"],$row["admin_id"]);
					$count++;
				}
			}
			return $cliente;
		}

		//adminUser
		public function getClientesList($dbcon,$DEBUG_STATUS)
		{
			$sql="select cl.id id_cliente,cl.nombre nombre_cliente,cl.id_ciudad ,cl.telefono,cl.celular,
					cl.email,cd.nombre nombre_ciudad,cl.habilitado,p.nombre admin_name,p.id admin_id 
					from p_clientes cl,p_ciudad cd,p_usuario p 
					where p.client_id=cl.id and p.perfil_id in (1,2) and 
					cl.id_ciudad=cd.id and cl.id=".$_SESSION["client_id"]." order by cl.nombre";
			$cliente=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$cliente[$count] = array($row["id_cliente"],$row["nombre_cliente"],$row["id_ciudad"],$row["telefono"],$row["celular"],$row["email"],$row["nombre_ciudad"],$row["habilitado"],$row["admin_name"],$row["admin_id"]);
					$count++;
				}
			}
			return $cliente;
		}

		//aprobarCliente,4-3,
		public function getClientById($dbcon,$client_id,$DEBUG_STATUS)
		{
			$sql="select cl.id id_cliente,cl.nombre nombre_cliente,cl.id_ciudad,cl.telefono,cl.celular,
					cl.email,cd.nombre nombre_ciudad,cl.habilitado,p.nombre admin_name,p.id admin_id,cl.observacion,tipo_cliente  
					from p_clientes cl,p_ciudad cd,p_usuario p 
					where p.client_id=cl.id and 
					cl.id_ciudad=cd.id and cl.id=".$client_id." order by cl.nombre";
			$cliente=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$cliente[$count] = array($row["id_cliente"],$row["nombre_cliente"],$row["id_ciudad"],$row["telefono"],$row["celular"],$row["email"],$row["nombre_ciudad"],$row["habilitado"],$row["admin_name"],$row["admin_id"],$row["observacion"],$row["tipo_cliente"]);
					$count++;
				}
			}
			return $cliente;
		}

		//4-2,
		public function editCliente($dbcon,$userId,$id_cliente,$nombre_cliente,$ciudad_cliente,$client_telefono,$client_celular,$client_email,$client_admin,$client_admin_id,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_clientes SET nombre='".$nombre_cliente."',id_ciudad=".$ciudad_cliente.",telefono='".$client_telefono."',
					celular='".$client_celular."',email='".$client_email."',fecha_modificacion=now(),modificado_por=".$userId." 
					WHERE id=".$id_cliente;
			mysqli_autocommit($dbcon,FALSE);
			if(mysqli_query($dbcon,$sql))
	        {
	        	$sql="update p_usuario set nombre='".strtoupper($client_admin)."',email='".$client_email."',telefono='".$client_telefono."',
	        			celular='".$client_celular."' where id=".$client_admin_id;
	        	if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;
		        	mysqli_commit($dbcon);
		        }
		        else
		        {
		        	mysqli_rollback($dbcon);
		        	$updStatus=0;
		        }
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        	$updStatus=0;
	        }

	        return $updStatus;
		}

		//4-1,
		public function delCliente($dbcon,$userId,$id_cliente,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_clientes SET habilitado=0,fecha_modificacion=now(),modificado_por=".$userId." 
					WHERE id=".$id_cliente;
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;
		}

		//doAprobarCliente
		public function aprobarCliente($dbcon,$id_cliente,$is_approved,$obser,$tipo_cliente,$DEBUG_STATUS)
		{
			$sql="select cl.id id_cliente,cl.nombre nombre_cliente,cl.id_ciudad,cl.telefono,cl.celular,
					cl.email,cd.nombre nombre_ciudad,cl.habilitado,p.nombre admin_name,p.id admin_id,cl.observacion,tipo_cliente  
					from p_clientes cl,p_ciudad cd,p_usuario p 
					where p.client_id=cl.id and 
					cl.id_ciudad=cd.id and cl.id=".$id_cliente." order by cl.nombre";
			$cliente=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result)) 
				{
					$sql = "UPDATE p_clientes SET habilitado=".$is_approved.",observacion='".$obser."',tipo_cliente=".$tipo_cliente.",fecha_modificacion=now(),modificado_por=".$_SESSION["user_id"]." 
					WHERE id=".$id_cliente;
					if(mysqli_query($dbcon,$sql))
			        {
			        	$strMsg='';
			        	if($is_approved==1)
			        		$strMsg='<b>ESTADO:</b>APROBADO'."<br><br>";
			        	else
			        	{
			        		$strMsg='<b>ESTADO:</b>RECHAZADO'."<br><br>";
			        		$strMsg=$strMsg.'<b>OBSERVACION SISTEC:</b>'.$obser."<br><br>";
			        	}
			        	$to = strtoupper($row["email"]);
						$subject = 'SISTEC - VERIFICACION DE CUENTA';
						$txt = '??HOLA,??'.strtoupper($row["admin_name"]).'!'."<br><br>";
						$txt=$txt.'Gracias por crear su cuenta en SISTEC'."<br><br>";
						$txt=$txt.$strMsg;
						$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en??support@sistec.com'."<br><br>";
						$txt=$txt.'??Disfruta de esta herramienta creada para ti!'."<br><br>";
						$txt=$txt.'El Equipo de Nipro Medical Ecuador'."<br><br>";

						$headers = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
						/*$headers .= 'From:info@hutesol.com' . "\r\n";
						$headers .= 'CC: olguercalvache@gmail.com';*/
						$headers .= 'From:portal@sistececuador.com' . "\r\n";
						$headers .= 'CC: fernandoa@nipromed.com';

						$res=mail($to,$subject,$txt,$headers);
						if($res==true)
						{
							//mysqli_commit($dbcon);
			        		$updStatus = 1;
						}
						else
						{
							$updStatus = 0;
							//mysqli_rollback($dbcon);
						}
			        }
			        else
			        	$updStatus=0;
				}
			}
			else
			    $updStatus=0;
			
			

	        return $updStatus;
		}

		//4-0,
		public function addCliente($dbcon,$userId,$nombre_cliente,$ciudad_cliente,$client_telefono,$client_celular,$client_email,$DEBUG_STATUS)
		{
			$sql="select id, nombre from p_clientes where nombre = '".strtoupper($nombre_cliente)."'";
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO p_clientes(nombre,id_ciudad,telefono,celular,email,habilitado,fecha_creacion,creacion_por) 
				values('".strtoupper($nombre_cliente)."',".$ciudad_cliente.",'".$client_telefono."','".$client_celular."','".$client_email."',1,now(),".$userId.")";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;
		        }
		        else
		        	$updStatus=0;

		        return $updStatus;	
            }
            else
            {
            	if($row = mysqli_fetch_assoc($result)) 
				{
					$sql = "UPDATE p_clientes SET nombre='".$nombre_cliente."',id_ciudad=".$ciudad_cliente.",telefono='".$client_telefono."',
					celular='".$client_celular."',email='".$client_email."',fecha_modificacion=now(),modificado_por=".$userId." 
					WHERE id=".$row["id"];
					//echo $sql.'<br>';
			        if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus = 2;
			        }
			        else
			        	$updStatus=0;
				}
            }
			
		}

		//0-0,
		public function registrarCliente($dbcon,$userId,$nombre_cliente,$ciudad_cliente,$client_telefono,$client_celular,$client_email,$admin_name,$admin_password,$DEBUG_STATUS)
		{
			$sql="select id, nombre from p_clientes where nombre = '".strtoupper($nombre_cliente)."'";
			mysqli_autocommit($dbcon,FALSE);
			$result = mysqli_query($dbcon,$sql);
			$updStatus=0;
            if(mysqli_num_rows($result) == 0)
            {
            	$ciudad_nombre=0;
            	$sql="select id, nombre from p_ciudad where id_cliente=0 and id =".$ciudad_cliente;
				$result = mysqli_query($dbcon,$sql);
	            if(mysqli_num_rows($result) > 0)  
	            {
					if($row = mysqli_fetch_assoc($result)) 
					{
						$ciudad_nombre=$row["nombre"];
					}
				}
				else
				{
					return $updStatus;
				}

            	$sql = "INSERT INTO p_clientes(nombre,id_ciudad,telefono,celular,email,habilitado,fecha_creacion,creacion_por) 
				values('".strtoupper($nombre_cliente)."',".$ciudad_cliente.",'".$client_telefono."','".$client_celular."','".$client_email."',0,now(),".$userId.")";
				////echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$client_id = mysqli_insert_id($dbcon);
		        	$sql="select id, nombre from p_usuario where upper(email) = '".strtoupper($client_email)."'";
		        	$result = mysqli_query($dbcon,$sql);
		            if(mysqli_num_rows($result) == 0)
		            {
		            	$sql = "INSERT INTO p_usuario(client_id,nombre,password,perfil_id,ciudad_id,email,telefono,celular,habilitado,fecha_creacion,creado_por_usuario) 
						values(".$client_id.",'".strtoupper($admin_name)."','".$admin_password."',2,".$ciudad_cliente.",'".$client_email."','".$client_telefono."','".$client_celular."',1,now(),".$userId.")";
						////echo $sql.'<br>';
				        if(mysqli_query($dbcon,$sql))
				        {
				        	$user_id = mysqli_insert_id($dbcon);
				        	$sql = "INSERT INTO p_ciudad(id_cliente,nombre,habilitado,fecha_creacion,creacion_por_usuario) 
								values(".$client_id.",'".strtoupper($ciudad_nombre)."',1,now(),".$user_id.")";
								//echo $sql.'<br>';
					        if(mysqli_query($dbcon,$sql))
					        {
					        	$new_ciudad_id = mysqli_insert_id($dbcon);
					        	$sql = "UPDATE p_clientes SET id_ciudad=".$new_ciudad_id.",fecha_modificacion=now(),modificado_por=".$user_id." 
									WHERE id=".$client_id;
									//echo $sql.'<br>';
						        if(mysqli_query($dbcon,$sql))
						        {
						        	$to = strtoupper($client_email);
									$subject = 'SISTEC - REGISTRO DE CUENTA';
									$txt = '??HOLA,??'.strtoupper($admin_name).'!'."<br><br>";
									$txt=$txt.'Gracias por crear su cuenta en SISTEC'."<br><br>";
									$txt=$txt.'Usa la direcci??n de correo electr??nico??'.strtoupper($client_email).'??y tu clave ingresada el momento del registro para iniciar sesi??n.'."<br><br>";
									$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en??support@sistec.com'."<br><br>";
									$txt=$txt.'??Disfruta de esta herramienta creada para ti!'."<br><br>";
									$txt=$txt.'El Equipo de Nipro Medical Ecuador'."<br><br>";

									$headers = 'MIME-Version: 1.0' . "\r\n";
									$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
									/*$headers .= 'From:info@hutesol.com' . "\r\n";
									$headers .= 'CC: olguercalvache@gmail.com';*/
									$headers .= 'From:portal@sistececuador.com' . "\r\n";
									$headers .= 'CC: fernandoa@nipromed.com';

									$res=mail($to,$subject,$txt,$headers);
									if($res==true)
									{
										mysqli_commit($dbcon);
						        		$updStatus = 1;
									}
									else
									{
										$updStatus = 9;
										mysqli_rollback($dbcon);
									}
						        	
						        	/*$_SESSION["user_id"]=$user_id;
						        	$_SESSION["user_name"]=$nombre_cliente;
						        	$_SESSION["user_perfil"]=2;
									$_SESSION["client_name"]=$nombre_cliente;
									$_SESSION["user_email"]=$client_email;
									$_SESSION["client_id"]=2;*/
						        }
						        else
						        {
						        	$updStatus=8;
						        	mysqli_rollback($dbcon);
						        }					        			
					        }
					        else
					        {
					        	$updStatus=7;
					        	mysqli_rollback($dbcon);
					        }				        						
				        }
				        else
				        {
				        	$updStatus=6;
				        	mysqli_rollback($dbcon);
				        }
		            }
		            else
			        {
			        	$updStatus=-1;
			        	mysqli_rollback($dbcon);
			        }		        	
		        }
		        else
		        {
		        	$updStatus=5;
		        	mysqli_rollback($dbcon);
		        }		        	
            }
            else
            {
            	$updStatus=4;
            	mysqli_rollback($dbcon);
            }
            return $updStatus;
			
		}

		//98-0,
		public function loginUser($dbcon,$user_email,$user_password,$DEBUG_STATUS)
		{
			$sql="select u.id userid, u.perfil_id,u.nombre user_name,u.email,c.nombre client_name,c.id clientid,c.habilitado,c.tipo_cliente  
				from p_usuario u,p_clientes c 
				where u.email = '".$user_email."' and u.password='".$user_password."' and u.habilitado=1 and u.client_id=c.id";
			////echo $sql.'<br>';
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
			//$usr=array();
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {            	
            	if($row = mysqli_fetch_assoc($result)) 
            	{
					$userId = $row["userid"];
					$userName=$row["user_name"];
					$userPerfil=$row["perfil_id"];
					$userEmail=$row["email"];
					$clientName=$row["client_name"];
					$clientId=$row["clientid"];
					$client_habilitado=$row["habilitado"];
					$tipo_cliente=$row["tipo_cliente"];
            	}

	        	$sql = "update p_usuario set en_uso=1 where email = '".$user_email."' and password='".$user_password."'";
				////echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);		        	
		            if($client_habilitado==0)
		            	$updStatus=2;	
		            else
		            {
			            $updStatus = 1;
			        	$_SESSION["user_id"]=$userId;
			        	$_SESSION["user_name"]=$userName;
			        	$_SESSION["user_perfil"]=$userPerfil;
						$_SESSION["client_name"]=$clientName;
						$_SESSION["user_email"]=$userEmail;
						$_SESSION["client_id"]=$clientId;
						$_SESSION["tipo_cliente"]=$tipo_cliente;
			            $_SESSION['LAST_ACTIVITY'] = time();
		            }	            	
		        }
		        else
		        {
		        	$updStatus=0;
		        	mysqli_rollback($dbcon);
		        }
		        return $updStatus;	
            }
            else
            {
            	
            }
			
		}

		public function recuperarClave($dbcon,$user_email,$DEBUG_STATUS)
		{
			$sql="select id,nombre,password from p_usuario u where u.email = '".$user_email."'";
			$updStatus=0;
			$id=0;
			$nombre='';
			$password='';
			//$usr=array();
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {            	
            	if($row = mysqli_fetch_assoc($result)) 
            	{
            		$id=$row["id"];
            		$nombre=$row["nombre"];
            		$password=$row["password"];
            		$clave=mt_rand();
            		
            		$sql = "update p_usuario set password='".$clave."' where email = '".$user_email."'";
					if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus = 1;
			        }

					$to = $user_email;
					$subject = 'SISTEC - RECUPERACION CLAVE';
					$txt = '??HOLA,??'.$nombre.'!'."<br><br>";
					$txt=$txt.'Se ha solicitado recuperar la clave para su cuenta en SISTEC'."<br><br>";
					$txt=$txt.'Usa la direcci??n de correo electr??nico??'.$user_email.'??con siguiente clave para iniciar sesi??n'."<br><br>";
					$txt=$txt.'CLAVE:'.$clave."<br><br>";
					$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en??support@sistec.com'."<br><br>";
					$txt=$txt.'??Disfruta de esta herramienta creada para ti!'."<br><br>";
					$txt=$txt.'El Equipo de Nipro Medical Ecuador'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					/*$headers .= 'From:info@hutesol.com' . "\r\n";
					$headers .= 'CC: olguercalvache@gmail.com';*/
					$headers .= 'From:portal@sistececuador.com' . "\r\n";
					$headers .= 'CC: fernandoa@nipromed.com';

					$res=mail($to,$subject,$txt,$headers);
					if($res==true)
					{
						$updStatus = 1;
					}
					else
					{
						$sql = "update p_usuario set password='".$password."' where email = '".$user_email."'";
						if(mysqli_query($dbcon,$sql))
				        {
				        	$updStatus = 2;
				        }
					}
            	}
            }
            else
            {
            	$updStatus = 3;
            }
            return $updStatus;
		}

		public function cambiarClave($dbcon,$clave_anterior,$clave_nuevo,$DEBUG_STATUS)
		{
			$sql="select id,nombre,password from p_usuario u where u.email = '".$_SESSION["user_email"]."' and password='".$clave_anterior."'";
			$updStatus=0;
			$id=0;
			$nombre='';
			$password='';
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {            	
            	if($row = mysqli_fetch_assoc($result)) 
            	{
            		$id=$row["id"];
            		$nombre=$row["nombre"];
            		$password=$row["password"];

            		$sql = "update p_usuario set password='".$clave_nuevo."' where email = '".$_SESSION["user_email"]."'";
					if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus = 1;
			        }

					$to = $_SESSION["user_email"];
					$subject = 'SISTEC - CAMBIO DE CLAVE';
					$txt = '??HOLA,??'.$nombre.'!'."<br><br>";
					$txt=$txt.'Se ha solicitado cambiar la clave para su cuenta en SISTEC'."<br><br>";
					$txt=$txt.'Usa la direcci??n de correo electr??nico??'.$_SESSION["user_email"].'??con siguiente clave para iniciar sesi??n'."<br><br>";
					$txt=$txt.'CLAVE:'.$clave_nuevo."<br><br>";
					$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en??support@sistec.com'."<br><br>";
					$txt=$txt.'??Disfruta de esta herramienta creada para ti!'."<br><br>";
					$txt=$txt.'El Equipo de Nipro Medical Ecuador'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					/*$headers .= 'From:info@hutesol.com' . "\r\n";
					$headers .= 'CC: olguercalvache@gmail.com';*/
					$headers .= 'From:portal@sistececuador.com' . "\r\n";
					$headers .= 'CC: fernandoa@nipromed.com';

					$res=mail($to,$subject,$txt,$headers);
					if($res==true)
					{
						$updStatus = 1;
					}
					else
					{
						$sql = "update p_usuario set password='".$password."' where email = '".$_SESSION["user_email"]."'";
						if(mysqli_query($dbcon,$sql))
				        {
				        	$updStatus = 2;
				        }
					}
            	}
            }
            else
            {
            	$updStatus = 3;
            }
            return $updStatus;
		}

		//menu,
		public function getMenuPanel($dbcon,$DEBUG_STATUS)
		{
			/*$sql="select sec,param,nombre,url,id,habilitado from p_menu where habilitado=1 order by sec";*/
			if($_SESSION["user_perfil"]>2 && $_SESSION["client_id"]>1)
				$sql='select * from (
					select sec,param,nombre,url,id,habilitado from p_menu where habilitado=1 and param=1
					union
					select sec,param,m.nombre,url,m.id,m.habilitado from p_menu m,p_permisos p,p_usuario u where m.habilitado=1 
					and m.id=p.menu_id and m.id <>22 
					and p.perfil_id=u.perfil_id and u.id='.$_SESSION["user_id"].') a
					order by a.sec';
			else if($_SESSION["user_perfil"]<=2 && $_SESSION["client_id"]>1)
				$sql="select sec,param,nombre,url,id,habilitado from p_menu where habilitado=1 and id <>22 order by sec";
			else if($_SESSION["user_perfil"]>2 && $_SESSION["client_id"]==1)
				$sql='select * from (
					select sec,param,nombre,url,id,habilitado from p_menu where habilitado=1 and param=1
					union
					select sec,param,m.nombre,url,m.id,m.habilitado from p_menu m,p_permisos p,p_usuario u where m.habilitado=1 and m.id=p.menu_id 
					and p.perfil_id=u.perfil_id and u.id='.$_SESSION["user_id"].') a
					order by a.sec';
			else
				$sql="select sec,param,nombre,url,id,habilitado from p_menu where habilitado=1 order by sec";
			$menu=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$menu[$count] = array($row["sec"],$row["param"],$row["nombre"],$row["url"],$row["id"],$row["habilitado"]);
					$count++;
				}
			}
			return $menu;
		}

		//adminMenu,adminPermisos,
		public function getMenu($dbcon,$DEBUG_STATUS)
		{
			$sql="select sec,param,nombre,url,id,habilitado from p_menu order by sec";
			$menu=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$menu[$count] = array($row["sec"],$row["param"],$row["nombre"],$row["url"],$row["id"],$row["habilitado"]);
					$count++;
				}
			}
			return $menu;
		}

		//5-0,5-2,
		public function addMenu($dbcon,$userId,$menu_sec,$menu_tipo,$menu_nombre,$menu_url,$DEBUG_STATUS)
		{
			$sql="select id, nombre from p_menu where sec='".$menu_sec."'";
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO p_menu(sec,param,nombre,url,habilitado,fecha_creacion,creado_por_usuario) 
				values('".$menu_sec."',".$menu_tipo.",'".strtoupper($menu_nombre)."','".$menu_url."',1,now(),".$userId.")";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;
		        }
		        else
		        	$updStatus=0;

		        return $updStatus;	
            }
            else
            {
            	return 2;
            }
			
		}

		//5-2
		public function editMenu($dbcon,$userId,$id_menu,$menu_sec,$menu_tipo,$menu_nombre,$menu_url,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_menu SET sec='".$menu_sec."',param=".$menu_tipo.",nombre='".strtoupper($menu_nombre)."',url='".$menu_url."' 
					where id=".$id_menu;
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=$sql;
	        return $updStatus;	
		    
		}

		//5-1
		public function delMenu($dbcon,$userId,$id_menu,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_menu SET habilitado=(habilitado-1)*(-1) where id=".$id_menu;
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=$sql;
	        return $updStatus;	
		    
		}


		//6-0
		public function getPermisos($dbcon,$userId,$menu_id,$DEBUG_STATUS)
		{
			$sql="select p.id, m.nombre nombre_menu,f.nombre nombre_perfil,p.menu_id,p.perfil_id from p_permisos p,p_menu m, p_perfil f where p.habilitado=1 and p.menu_id=".$menu_id." and 
					p.menu_id=m.id and p.perfil_id=f.id and f.id_cliente=".$_SESSION["client_id"];
			$permisos=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$permisos[$count] = array($row["id"],$row["nombre_menu"],$row["nombre_perfil"],$row["menu_id"],$row["perfil_id"]);
					$count++;
				}
			}
			return $permisos;
		}

		//adminPermisos
		public function getAllPermisos($dbcon,$DEBUG_STATUS)
		{
			$sql="select p.id, m.nombre nombre_menu,f.nombre nombre_perfil,p.menu_id,p.perfil_id from p_permisos p,p_menu m, p_perfil f where p.habilitado=1 and  
					p.menu_id=m.id and p.perfil_id=f.id and f.id_cliente=".$_SESSION["client_id"];
			$permisos=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$permisos[$count] = array($row["id"],$row["nombre_menu"],$row["nombre_perfil"],$row["menu_id"],$row["perfil_id"]);
					$count++;
				}
			}
			return $permisos;
		}

		//6-1
		public function addPermisos($dbcon,$userId,$menu_id,$perfil_id,$DEBUG_STATUS)
		{
			$sql="select p.id, p.menu_id,p.perfil_id from p_permisos p where p.habilitado=1 and p.menu_id=".$menu_id.' and p.perfil_id='.$perfil_id;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO p_permisos(menu_id,perfil_id,habilitado,fecha_creacion,creado_por_usuario) 
				values(".$menu_id.",".$perfil_id.",1,now(),".$userId.")";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;
		        }
		        else
		        	$updStatus=0;

		        return $updStatus;	
            }
            else
            {
            	return 2;
            }
			
		}

		//6-2
		public function delPermisos($dbcon,$userId,$menu_id,$perfil_id,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_permisos set habilitado=0, fecha_modificacion=now(),modificado_por_usuario=".$userId.' 
					where menu_id='.$menu_id.' and perfil_id='.$perfil_id;
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;
			
		}


		//adminEquipos,adminSalas,adminSucursal,adminUser,asignarPeticiones,asignarTecnicos,gestionCliente,nuevoPeticion,
		public function getSucursales($dbcon,$DEBUG_STATUS)
		{
			$sql="select s.id sucursal_id,s.nombre sucursal_nombre, c.ID ciudad_id, c.NOMBRE ciudad_nombre,s.habilitado 
				from p_sucursal s,p_ciudad c 
				where s.ciudad_id=c.id and c.id_cliente=".$_SESSION["client_id"]." order by c.nombre,s.nombre";
			$sucursal=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$sucursal[$count] = array($row["sucursal_id"],$row["sucursal_nombre"],$row["ciudad_id"],$row["ciudad_nombre"],$row["habilitado"]);
					$count++;
				}
			}
			return $sucursal;
		}


		//atender,12-0,
		public function getEquiposEnPeticion($dbcon,$peticion_id,$DEBUG_STATUS)
		{
			/*$sql="select e.id,concat(e.nombre,' ',e.marca,' ',e.modelo,' ',e.serie) desc_equipo from p_solicitud s,p_equipos_solicitud es,p_equipos e
				where s.id='".$peticion_id."' and s.id=es.nro_solicitud and es.equipo_id=e.id and s.service_id>1
				union
				select s.id='".$peticion_id."' and e.id,concat(e.nombre,' ',e.marca,' ',e.modelo,' ',e.serie) desc_equipo from p_solicitud s,p_equipos e
				where s.client_id=e.client_id and s.sucursal_id=e.sucursal_id and s.service_id=1";*/
				$sql="select e.id,concat(e.nombre,' ',e.marca,' ',e.modelo,' ',e.serie) desc_equipo from p_solicitud s,p_equipos_solicitud es,p_equipos e
				where s.id='".$peticion_id."' and s.id=es.nro_solicitud and es.equipo_id=e.id and s.service_id>1";
			$equipos=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$equipos[$count] = array($row["id"],$row["desc_equipo"]);
					$count++;
				}
			}
			return $equipos;
		}

		//7-3,
		public function getSucursalesByCiudad($dbcon,$id_ciudad,$DEBUG_STATUS)
		{
			$sql="select s.id sucursal_id,s.nombre sucursal_nombre, c.ID ciudad_id, c.NOMBRE ciudad_nombre,s.habilitado 
				from p_sucursal s,p_ciudad c 
				where s.habilitado=1 and s.ciudad_id=c.id and s.ciudad_id=".$id_ciudad." order by c.nombre,s.nombre";
			$sucursal=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$sucursal[$count] = array($row["sucursal_id"],$row["sucursal_nombre"],$row["ciudad_id"],$row["ciudad_nombre"],$row["habilitado"]);
					$count++;
				}
			}
			return $sucursal;
		}

		//asignarTecnicos
		public function getSucursalesByClientId($dbcon,$estado,$id_cliente,$DEBUG_STATUS)
		{
			$sql="select ps.id,pc.NOMBRE nombre_ciudad,ps.nombre sucursal_name,c.nombre client_name,
					(select pu.id from p_usuario pu where pu.id=ps.id_tecnico) id_tecnico,
					(select pu.nombre from p_usuario pu where pu.id=ps.id_tecnico) nombre_tecnico 
			 		from p_sucursal ps,p_ciudad pc, p_clientes c
					where ps.ciudad_id=pc.ID and pc.id_cliente=c.id and c.id=".$id_cliente;
			if($estado==0)
				$sql=$sql." and ps.id_tecnico=".$estado;
			else if($estado==1)
				$sql=$sql." and ps.id_tecnico>".$estado;
					
			$sql=$sql." order by pc.NOMBRE,ps.nombre";

			$sucursal=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$sucursal[$count] = array($row["id"],$row["nombre_ciudad"],$row["sucursal_name"],$row["client_name"],$row["id_tecnico"],$row["nombre_tecnico"]);
					$count++;
				}
			}
			return $sucursal;
		}

		//7-0,
		public function addSucursal($dbcon,$sucursal_name,$idCiudad,$DEBUG_STATUS)
		{
			$sql="select id, nombre from p_sucursal where nombre='".strtoupper($sucursal_name)."' 
				and ciudad_id=".$idCiudad." order by nombre";
			//echo $sql.'<br>';
			//$updStatus=99;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO p_sucursal(nombre,ciudad_id,habilitado,fecha_creacion,creado_por_usuario) 
				values('".strtoupper($sucursal_name)."',".$idCiudad.",1,now(),".$_SESSION["user_id"].")";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;
		        }
		        else
		        	$updStatus=0;

		        return $updStatus;	
            }
            else
            {
            	if($row = mysqli_fetch_assoc($result)) 
				{
					$sql = "UPDATE p_sucursal SET habilitado=1,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." 
						WHERE id=".$row["id"];
					//echo $sql.'<br>';
			        if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus = 2;
			        }
			        else
			        	$updStatus=0;
			        return $updStatus;
				}
            }
			
		}

		//7-1,
		public function delSucursal($dbcon,$sucursal_id,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_sucursal SET habilitado=0,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." 
					WHERE id=".$sucursal_id;
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;
		}

		//7-2,
		public function editSucursal($dbcon,$sucursal_id,$sucursal_name,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_sucursal SET nombre='".strtoupper($sucursal_name)."' ,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." 
					WHERE id=".$sucursal_id;
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;
		}

		//adminEquipos,adminSalas,adminUser,asignarPeticiones,asignarTecnicos,getSalas,nuevoPeticion,
		public function getSalas($dbcon,$DEBUG_STATUS)
		{
			$sql="select sl.id sala_id, sl.nombre sala_nombre, s.id sucursal_id,s.nombre sucursal_nombre, c.ID ciudad_id, c.NOMBRE ciudad_nombre,sl.habilitado 
				from p_sucursal s,p_ciudad c,p_salas sl 
				where s.ciudad_id=c.id and s.id=sl.id_sucursal and c.id_cliente=".$_SESSION["client_id"]." order by c.nombre,s.nombre";
			$sala=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$sala[$count] = array($row["sala_id"],$row["sala_nombre"],$row["sucursal_id"],$row["sucursal_nombre"],$row["ciudad_id"],$row["ciudad_nombre"],$row["habilitado"]);
					$count++;
				}
			}
			return $sala;
		}

		//8-0,
		public function addSala($dbcon,$sala_name,$sucursal_id,$DEBUG_STATUS)
		{
			$sql="select id, nombre from p_salas where nombre='".strtoupper($sala_name)."' 
				and id_sucursal=".$sucursal_id." order by nombre";
			//echo $sql.'<br>';
			//$updStatus=99;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO p_salas(nombre,id_sucursal,habilitado,fecha_creacion,creado_por_usuario) 
				values('".strtoupper($sala_name)."',".$sucursal_id.",1,now(),".$_SESSION["user_id"].")";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;
		        }
		        else
		        	$updStatus=0;

		        return $updStatus;	
            }
            else
            {
            	if($row = mysqli_fetch_assoc($result)) 
				{
					$sql = "UPDATE p_salas SET habilitado=1,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." 
						WHERE id=".$row["id"];
					//echo $sql.'<br>';
			        if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus = 2;
			        }
			        else
			        	$updStatus=0;
			        return $updStatus;
				}
            }
			
		}

		//8-1,
		public function delSala($dbcon,$sala_id,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_salas SET habilitado=0,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." 
					WHERE id=".$sala_id;
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;
		}

		//8-2
		public function editSala($dbcon,$sala_id,$sala_name,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_salas SET nombre='".strtoupper($sala_name)."' ,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." 
					WHERE id=".$sala_id;
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;
		}

		//8-3
		public function getSalasBySucursal($dbcon,$sucursal_id,$DEBUG_STATUS)
		{
			$sql="select sl.id sala_id, sl.nombre sala_nombre, s.id sucursal_id,s.nombre sucursal_nombre, c.ID ciudad_id, c.NOMBRE ciudad_nombre,s.habilitado 
				from p_sucursal s,p_ciudad c,p_salas sl 
				where s.ciudad_id=c.id and s.id=sl.id_sucursal and s.id=".$sucursal_id."  order by c.nombre,s.nombre";
			$sala=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$sala[$count] = array($row["sala_id"],$row["sala_nombre"],$row["sucursal_id"],$row["sucursal_nombre"],$row["ciudad_id"],$row["ciudad_nombre"],$row["habilitado"]);
					$count++;
				}
			}
			return $sala;
		}

		//9-0,
		public function adduser($dbcon,$supervision_id,$user_name,$user_email,$user_tele,$user_celular,$user_direccion,$perfil_id,$client_id,$ciudad_id,$sucursal_id,$sala_id,$DEBUG_STATUS)
		{
			/*$sql="select id, nombre,email from p_usuario where nombre='".strtoupper($user_name)."' 
				and email='".$user_email."' and perfil_id=".$perfil_id." and client_id=".$client_id." and ciudad_id=".$ciudad_id." and 
				sucursal=".$sucursal_id." and sala=".$sala." and habilitado=1 order by nombre";*/
				$sql="select id, nombre,email from p_usuario where upper(email)='".strtoupper($user_email)."' 
				and habilitado=1 order by nombre";
			//echo $sql.'<br>';
			//$updStatus=99;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {
            	/*$sql = "INSERT INTO p_usuario(nombre,password, email, telefono, celular, direccion, perfil_id,client_id,ciudad_id,
            		sucursal,sala,habilitado,en_uso,fecha_creacion,creado_por_usuario) 
				values('".strtoupper($user_name)."','".mt_rand()."','".$user_email."','".$user_tele."','".$user_celular."',
					'".$user_direccion."',".$perfil_id.",".$client_id.",".$ciudad_id.",".$sucursal_id.",".$sala_id.",1,0,now(),".$_SESSION["user_id"].")";
				*/
				
				$clave=mt_rand();
				if($supervision_id==1)				
					$sql = "INSERT INTO p_usuario(nombre,password, email, telefono, celular, direccion, perfil_id,client_id,ciudad_id,
            			sucursal,sala,habilitado,en_uso,fecha_creacion,creado_por_usuario,supervision_cliente) 
						values('".strtoupper($user_name)."','".$clave."','".$user_email."','".$user_tele."','".$user_celular."',
						'".$user_direccion."',".$perfil_id.",".$client_id.",".$ciudad_id.",".$sucursal_id.",".$sala_id.",1,0,now(),".$_SESSION["user_id"].",1)";
				else if($supervision_id==2)				
					$sql = "INSERT INTO p_usuario(nombre,password, email, telefono, celular, direccion, perfil_id,client_id,ciudad_id,
            			sucursal,sala,habilitado,en_uso,fecha_creacion,creado_por_usuario,supervision_ciudad) 
						values('".strtoupper($user_name)."','".$clave."','".$user_email."','".$user_tele."','".$user_celular."',
						'".$user_direccion."',".$perfil_id.",".$client_id.",".$ciudad_id.",".$sucursal_id.",".$sala_id.",1,0,now(),".$_SESSION["user_id"].",1)";
				else if($supervision_id==3)				
					$sql = "INSERT INTO p_usuario(nombre,password, email, telefono, celular, direccion, perfil_id,client_id,ciudad_id,
            			sucursal,sala,habilitado,en_uso,fecha_creacion,creado_por_usuario,supervision_sucursal) 
						values('".strtoupper($user_name)."','".$clave."','".$user_email."','".$user_tele."','".$user_celular."',
						'".$user_direccion."',".$perfil_id.",".$client_id.",".$ciudad_id.",".$sucursal_id.",".$sala_id.",1,0,now(),".$_SESSION["user_id"].",1)";
				else if($supervision_id==4)				
					$sql = "INSERT INTO p_usuario(nombre,password, email, telefono, celular, direccion, perfil_id,client_id,ciudad_id,
            			sucursal,sala,habilitado,en_uso,fecha_creacion,creado_por_usuario,supervision_sala) 
						values('".strtoupper($user_name)."','".$clave."','".$user_email."','".$user_tele."','".$user_celular."',
						'".$user_direccion."',".$perfil_id.",".$client_id.",".$ciudad_id.",".$sucursal_id.",".$sala_id.",1,0,now(),".$_SESSION["user_id"].",1)";
				else
					$sql = "INSERT INTO p_usuario(nombre,password, email, telefono, celular, direccion, perfil_id,client_id,ciudad_id,
            			sucursal,sala,habilitado,en_uso,fecha_creacion,creado_por_usuario,supervision_solo) 
						values('".strtoupper($user_name)."','".$clave."','".$user_email."','".$user_tele."','".$user_celular."',
						'".$user_direccion."',".$perfil_id.",".$client_id.",".$ciudad_id.",".$sucursal_id.",".$sala_id.",1,0,now(),".$_SESSION["user_id"].",1)";
	

				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$to = $user_email;
					$subject = 'SISTEC - CREACION DE USUARIO';
					$txt = '??HOLA,??'.strtoupper($user_name).'!'."<br><br>";
					$txt=$txt.$_SESSION["user_name"].' ha creado una cuenta para ti en SISTEC'."<br><br>";
					$txt=$txt.'Usa la direcci??n de correo electr??nico??'.$user_email.'??y clave <b>'.$clave.'</b> para iniciar sesi??n.'."<br><br>";
					$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en??support@sistec.com'."<br><br>";
					$txt=$txt.'??Disfruta de esta herramienta creada para ti!'."<br><br>";
					$txt=$txt.'El Equipo de Nipro Medical Ecuador'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					/*$headers .= 'From:info@hutesol.com' . "\r\n";
					$headers .= 'CC: olguercalvache@gmail.com,'.$_SESSION["user_email"];*/
					$headers .= 'From:portal@sistececuador.com' . "\r\n";
					$headers .= 'CC: fernandoa@nipromed.com,'.$_SESSION["user_email"];


					$res=mail($to,$subject,$txt,$headers);
					if($res==true)
					{
						//mysqli_commit($dbcon);
		        		$updStatus = 1;
					}
		        }
		        else
		        	$updStatus=0;

		        	
            }
            else
            {
            	$updStatus = 2;
            }
            return $updStatus;
            /*else
            {
            	if($row = mysqli_fetch_assoc($result)) 
				{
					$sql = "UPDATE p_salas SET habilitado=1,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." 
						WHERE id=".$row["id"];
					//echo $sql.'<br>';
			        if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus = 2;
			        }
			        else
			        	$updStatus=0;
			        return $updStatus;
				}
            }*/
			
		}

		public function editUser($dbcon,$user_id,$supervision_id,$user_name,$user_email,$user_tele,$user_celular,$user_direccion,$perfil_id,$client_id,$ciudad_id,$sucursal_id,$sala_id,$DEBUG_STATUS)
		{
			if($supervision_id==1)
				$sql = "UPDATE p_usuario SET nombre='".strtoupper($user_name)."' ,email='".$user_email."',telefono='".$user_tele."',celular='".$user_celular."',direccion='".$user_direccion."',perfil_id=".$perfil_id.",client_id=".$client_id.",ciudad_id=".$ciudad_id.",sucursal=".$sucursal_id.",sala=".$sala_id.",supervision_cliente=1,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." WHERE id=".$user_id;
			else if($supervision_id==2)
				$sql = "UPDATE p_usuario SET nombre='".strtoupper($user_name)."' ,email='".$user_email."',telefono='".$user_tele."',celular='".$user_celular."',direccion='".$user_direccion."',perfil_id=".$perfil_id.",client_id=".$client_id.",ciudad_id=".$ciudad_id.",sucursal=".$sucursal_id.",sala=".$sala_id.",supervision_ciudad=1,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." WHERE id=".$user_id;
			else if($supervision_id==3)
				$sql = "UPDATE p_usuario SET nombre='".strtoupper($user_name)."' ,email='".$user_email."',telefono='".$user_tele."',celular='".$user_celular."',direccion='".$user_direccion."',perfil_id=".$perfil_id.",client_id=".$client_id.",ciudad_id=".$ciudad_id.",sucursal=".$sucursal_id.",sala=".$sala_id.",supervision_sucursal=1,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." WHERE id=".$user_id;
			else if($supervision_id==4)
				$sql = "UPDATE p_usuario SET nombre='".strtoupper($user_name)."' ,email='".$user_email."',telefono='".$user_tele."',celular='".$user_celular."',direccion='".$user_direccion."',perfil_id=".$perfil_id.",client_id=".$client_id.",ciudad_id=".$ciudad_id.",sucursal=".$sucursal_id.",sala=".$sala_id.",supervision_sala=1,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." WHERE id=".$user_id;
			else 
				$sql = "UPDATE p_usuario SET nombre='".strtoupper($user_name)."' ,email='".$user_email."',telefono='".$user_tele."',celular='".$user_celular."',direccion='".$user_direccion."',perfil_id=".$perfil_id.",client_id=".$client_id.",ciudad_id=".$ciudad_id.",sucursal=".$sucursal_id.",sala=".$sala_id.",supervision_solo=1,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." WHERE id=".$user_id;

			echo 'sql:'.$sql.'<br>';
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;
		}

		public function disableUser($dbcon,$user_id,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_usuario SET habilitado = ((habilitado -1)*(-1)) WHERE id=".$user_id;
			
			//echo 'sql:'.$sql.'<br>';
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;
		}

		//adminUser,asignarPeticiones,asignarTecnicos
		public function getUsers($dbcon,$DEBUG_STATUS)
		{
			$sql="select u.id,u.nombre user_name,u.email,u.telefono,u.celular,u.direccion,f.nombre perfil,
				f.id perfil_id,cl.nombre cliente,cl.id client_id,c.NOMBRE ciudad,c.id cuidad_id,
				s.nombre sucursal,s.id sucursal_id,sl.nombre sala,s.id sala_id,u.habilitado,u.supervision_cliente,u.supervision_ciudad,u.supervision_sucursal,u.supervision_sala,u.supervision_solo from p_usuario u,p_perfil f,p_ciudad c,p_clientes cl,p_sucursal s,p_salas sl
				where u.client_id=".$_SESSION["client_id"]." and u.perfil_id=f.id and u.client_id=cl.id and u.ciudad_id=c.ID and u.sucursal=s.id and u.sala=sl.id order by u.nombre";
			$users=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
			$supervision=0;
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					if($row["supervision_cliente"]==1)
						$supervision=1;
					else if($row["supervision_ciudad"]==1)
						$supervision=2;
					else if($row["supervision_sucursal"]==1)
						$supervision=3;
					else if($row["supervision_sala"]==1)
						$supervision=4;
					else if($row["supervision_solo"]==1)
						$supervision=4;
					$users[$count] = array($row["id"],$row["user_name"],$row["email"],$row["telefono"],$row["celular"],$row["direccion"],$row["perfil"],$row["cliente"],$row["ciudad"],$row["sucursal"],$row["sala"],$row["habilitado"],$row["perfil_id"],$row["client_id"],$row["cuidad_id"],$row["sucursal_id"],$row["sala_id"],$supervision);
					$count++;
				}
			}
			return $users;
		}

		//9-9,
		public function buscarUser($dbcon,$user_name,$user_email,$user_tele,$user_celular,$user_direccion,$perfil_id,$client_id,$ciudad_id,$sucursal_id,$sala_id,$DEBUG_STATUS)
		{
			$sql="select u.id,u.nombre user_name,u.email,u.telefono,u.celular,u.direccion,f.nombre perfil,
				f.id perfil_id,cl.nombre cliente,cl.id client_id,c.NOMBRE ciudad,c.id cuidad_id,
				s.nombre sucursal,s.id sucursal_id,sl.nombre sala,s.id sala_id,u.habilitado,u.supervision_cliente,u.supervision_ciudad,u.supervision_sucursal,u.supervision_sala,u.supervision_solo  
				from p_usuario u,p_perfil f,p_ciudad c,p_clientes cl,p_sucursal s,p_salas sl
				where u.perfil_id=f.id and u.client_id=cl.id 
				and u.ciudad_id=c.ID and u.sucursal=s.id and u.sala=sl.id";
			if(!empty($user_name))
				$sql=$sql." and u.nombre like '%".strtoupper($user_name)."%' ";
			if(!empty($user_email))
				$sql=$sql." and u.email ='".$user_email."' ";
			if(!empty($user_tele))
				$sql=$sql." and u.telefono ='".$user_tele."' ";
			if(!empty($user_celular))
				$sql=$sql." and u.celular ='".$user_celular."' ";
			if(!empty($user_direccion))
				$sql=$sql." and u.direccion ='".$user_direccion."' ";
			if(!empty($perfil_id) && $perfil_id!=99)
				$sql=$sql." and u.perfil_id =".$perfil_id." ";
			if(!empty($ciudad_id) && $ciudad_id!=99)
				$sql=$sql." and u.ciudad_id =".$ciudad_id." ";
			if(!empty($sucursal_id) && $sucursal_id!=99)
				$sql=$sql." and u.sucursal =".$sucursal_id." ";
			if(!empty($sala_id) && $sala_id!=99)
				$sql=$sql." and u.sala =".$sala_id." ";
			if(!empty($client_id) && $client_id!=99)
				$sql=$sql." and u.client_id =".$client_id." ";
			/*else
			{
				if($_SESSION["client_id"]>1)
					$sql=$sql." and e.client_id =".$_SESSION["client_id"]." ";
			}*/


			$sql=$sql." order by u.nombre";
			////echo $sql.'<br>';
			$users=array();
			$count=0;
			$supervision=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					if($row["supervision_cliente"]==1)
						$supervision=1;
					else if($row["supervision_ciudad"]==1)
						$supervision=2;
					else if($row["supervision_sucursal"]==1)
						$supervision=3;
					else if($row["supervision_sala"]==1)
						$supervision=4;
					else if($row["supervision_solo"]==1)
						$supervision=0;
					$users[$count] = array($row["id"],$row["user_name"],$row["email"],$row["telefono"],$row["celular"],$row["direccion"],$row["perfil"],$row["cliente"],$row["ciudad"],$row["sucursal"],$row["sala"],$row["habilitado"],$row["perfil_id"],$row["client_id"],$row["cuidad_id"],$row["sucursal_id"],$row["sala_id"],$supervision);
					$count++;
				}
			}
			return $users;
		}

		//10-0,
		public function addEquipo($dbcon,$equipo_nombre,$equipo_modelo,$equipo_marca,$equipo_serie,$client_id,$ciudad_id,$sucursal_id,$sala_id,$DEBUG_STATUS)
		{
			$sql = "INSERT INTO p_equipos(nombre,modelo,marca,serie,client_id,ciudad_id,
            		sucursal_id,sala_id,habilitado,fecha_creacion,creado_por_usuario) 
				values('".strtoupper($equipo_nombre)."','".strtoupper($equipo_modelo)."','".strtoupper($equipo_marca)."','".strtoupper($equipo_serie)."',".$client_id.",".$ciudad_id.",".$sucursal_id.",".$sala_id.",1,now(),".$_SESSION["user_id"].")";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;	
        }

        //adminEquipos
        public function getEquipos($dbcon,$DEBUG_STATUS)
		{
			$sql="select e.id,e.nombre,e.modelo,e.marca,e.serie,cl.nombre cliente,c.NOMBRE ciudad,
				s.nombre sucursal,sl.nombre sala,e.habilitado from p_equipos e,p_ciudad c,p_clientes cl,p_sucursal s,p_salas sl
				where e.client_id=".$_SESSION["client_id"]." and e.client_id=cl.id and e.ciudad_id=c.ID and e.sucursal_id=s.id 
				and e.sala_id=sl.id order by e.descripcion";
			//echo $sql;
			$equipos=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$equipos[$count] = array($row["id"],$row["nombre"],$row["cliente"],$row["ciudad"],$row["sucursal"],$row["sala"],$row["habilitado"],$row["modelo"],$row["marca"],$row["serie"]);
					$count++;
				}
			}
			return $equipos;
		}

		//10-8,10-9,
		public function buscarEquipo($dbcon,$equipo_nombre,$equipo_modelo,$equipo_marca,$equipo_serie,$client_id,$ciudad_id,$sucursal_id,$sala_id,$DEBUG_STATUS)
		{
			/*$sql="select e.id,e.nombre,e.modelo,e.marca,e.serie,cl.nombre cliente,c.NOMBRE ciudad,
				s.nombre sucursal,sl.nombre sala,e.habilitado from p_equipos e,p_ciudad c,p_clientes cl,p_sucursal s,p_salas sl
				where e.in_gestion=0 and e.client_id=".$_SESSION["client_id"]." and e.client_id=cl.id and e.ciudad_id=c.ID and e.sucursal_id=s.id 
				and e.sala_id=sl.id";*/
			$sql="select e.id,e.nombre,e.modelo,e.marca,e.serie,cl.nombre cliente,c.NOMBRE ciudad,
				s.nombre sucursal,sl.nombre sala,e.habilitado from p_equipos e,p_ciudad c,p_clientes cl,p_sucursal s,p_salas sl
				where e.in_gestion=0 and e.client_id=cl.id and e.ciudad_id=c.ID and e.sucursal_id=s.id 
				and e.sala_id=sl.id";
			if(!empty($equipo_nombre))
				$sql=$sql." and e.nombre like '%".strtoupper($equipo_nombre)."%' ";
			if(!empty($equipo_modelo))
				$sql=$sql." and e.modelo like '%".strtoupper($equipo_modelo)."%' ";
			if(!empty($equipo_marca))
				$sql=$sql." and e.marca like '%".strtoupper($equipo_marca)."%' ";
			if(!empty($equipo_serie))
				$sql=$sql." and e.serie like '%".strtoupper($equipo_serie)."%' ";
			if(!empty($ciudad_id) && $ciudad_id!=99)
				$sql=$sql." and e.ciudad_id =".$ciudad_id." ";
			if(!empty($sucursal_id) && $sucursal_id!=99)
				$sql=$sql." and e.sucursal_id =".$sucursal_id." ";
			if(!empty($sala_id) && $sala_id!=99)
				$sql=$sql." and e.sala_id =".$sala_id." ";
			if(!empty($client_id) && $client_id!=99)
				$sql=$sql." and e.client_id =".$client_id." ";
			else
			{
				if($_SESSION["client_id"]>1)
					$sql=$sql." and e.client_id =".$_SESSION["client_id"]." ";
			}
			 
			$sql=$sql." and e.id not in(select pe.equipo_id from p_solicitud ps,p_equipos_solicitud pe where ps.id=pe.nro_solicitud and ps.estado <3)";


			$sql=$sql." order by e.nombre";
			//echo $sql.'<br>';
			$equipos=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$equipos[$count] = array($row["id"],$row["nombre"],$row["cliente"],$row["ciudad"],$row["sucursal"],$row["sala"],$row["habilitado"],$row["modelo"],$row["marca"],$row["serie"]);
					$count++;
				}
			}
			return $equipos;
		}

		//9-2,
		public function asignarTecnicoSucursal($dbcon,$tecnico_id,$sucursal_ids,$DEBUG_STATUS)
		{
			//$sucursal=explode(",",$sucursal_ids);
			$updStatus=0;	
    		//for($z=1;$z<count($sucursal);$z++)
    		//{
    			$sql="UPDATE p_sucursal set id_tecnico=".$tecnico_id." where id in(".$sucursal_ids.")";
	        	////echo $sql.'<br>';
	        	if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus++;
		        }
    		//}
    		return $updStatus;
		}

		//9-3,
		public function asignarTecnicoParaPeticiones($dbcon,$tecnico_id,$peticiones,$DEBUG_STATUS)
		{
			mysqli_autocommit($dbcon,FALSE);
			$peticion=explode(",",$peticiones);
			$updStatus=0;	
    		for($z=1;$z<count($peticion);$z++)
    		{
    			$sql="UPDATE p_solicitud set id_tecnico=".$tecnico_id." where id ='".$peticion[$z]."'";
	        	////echo $sql.'<br>';
	        	if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus++;
		        }
    		}
    		if($updStatus==(count($peticion)-1))
    			mysqli_commit($dbcon);
    		else
    		{
    			$updStatus=0;
    			mysqli_rollback($dbcon);	
    		}
    		return $updStatus;
		}

		//11-0,
		public function addSolicitud($dbcon,$equipo_desc,$client_id,$ciudad_id,$sucursal_id,$sala_id,$service_id,$id_equipos,$obser,$DEBUG_STATUS)
		{
			$id=mt_rand();
			mysqli_autocommit($dbcon,FALSE);
			$sql="select date_format(now(),'%Y%m%d%H%i%s') dt_time from dual";
			////echo $sql.'<br>';
			$updStatus=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result))
				{
					$dt_time =$row["dt_time"];
				}
			}

			$id_tecnico=0;
			$sql="select id_tecnico from p_sucursal where id=".$sucursal_id;
			////echo $sql.'<br>';
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result))
				{
					$id_tecnico =$row["id_tecnico"];
				}
			}


			$nro_solicitud=$dt_time.'_'.$id;
			$sql = "INSERT INTO p_solicitud(id,descripcion,client_id,ciudad_id,
            		sucursal_id,sala_id,service_id,observacion,habilitado,fecha_creacion,creado_por_usuario,id_tecnico) 
				values('".$nro_solicitud."','".strtoupper($equipo_desc)."',".$client_id.",".$ciudad_id.",".$sucursal_id.",".$sala_id.",".$service_id.",'".$obser."',1,now(),".$_SESSION["user_id"].",".$id_tecnico.")";
			////echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	if($service_id>1 && isset($id_equipos))
	        	{
	        		$equipos=explode(",",$id_equipos);	
	        		/*for($z=1;$z<count($equipos);$z++)
	        		{
	        			$sql="INSERT INTO p_equipos_solicitud(nro_solicitud,equipo_id) values('".$nro_solicitud."',".$equipos[$z].")";
			        	////echo $sql.'<br>';
			        	if(mysqli_query($dbcon,$sql))
				        {
				        	$updStatus++;
				        }
	        		}
	        		if($updStatus=(count($equipos)-1))
	        		{
	        			mysqli_commit($dbcon);
	        			$updStatus=1;
	        		}
	        		else
	        		{
	        			mysqli_rollback($dbcon);
	        			$updStatus=0;
	        		}*/
	        		for($z=0;$z<count($equipos);$z++)
	        		{
		        		$sql="INSERT INTO p_equipos_solicitud(nro_solicitud,equipo_id) values('".$nro_solicitud."',".$equipos[$z].")";
			        	////echo $sql.'<br>';
			        	if(mysqli_query($dbcon,$sql))
				        {
				        	mysqli_commit($dbcon);
		        			$updStatus=1;
				        }
				    }
	        	}
	        	else
	        	{
	        		mysqli_commit($dbcon);
	        		$updStatus=1;
	        	}
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        	$updStatus=0;
	        }

	        if($updStatus>=1)
	        	return $nro_solicitud;	
	        else
	        	return $updStatus;
        }

        //dashboard,gestionPeticion,
        public function getPeticiones($dbcon,$tipo_peticion,$estado_peticion,$tipo_cliente,$DEBUG_STATUS)
		{
			if(isset($_SESSION["client_id"]) && $_SESSION["client_id"]==1)
			{
				if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]<=2)
					$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
					(select nombre from p_salas where id=s.sala_id) sala_nombre,
					(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
					(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,
					(select nombre from p_usuario where id=s.creado_por_usuario) creado_por,
					s.fecha_creacion,t.desc tipo_servicio 
					from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
					where s.habilitado=1 and s.id_tecnico=u.id ";	
				else
					{
						$perfils=0;
						$str="";
						$sqlusr = "select p1.perfil_id,p1.client_id,p1.ciudad_id,p1.sucursal,p1.sala,p1.supervision_cliente,p1.supervision_ciudad,p1.supervision_sucursal,p1.supervision_sala,p1.supervision_solo from p_usuario p1 where p1.id=".$_SESSION["user_id"];
						$result = mysqli_query($dbcon,$sqlusr);
			            if(mysqli_num_rows($result) > 0)  
			            {
							if($row = mysqli_fetch_assoc($result)) 
							{
								$perfil_user=$row["perfil_id"];
								if($row["supervision_cliente"]==1)
									$str=$str." and u.client_id=".$row["client_id"];
								else if($row["supervision_ciudad"]==1)
									$str=$str." and u.ciudad_id=".$row["ciudad_id"];
								else if($row["supervision_sucursal"]==1)
									$str=$str." and u.sucursal=".$row["sucursal"];
								else if($row["supervision_sala"]==1)
									$str=$str." and u.sala=".$row["sala"];
								else if($row["supervision_solo"]==1)
									$str=$str." and u.id=".$_SESSION["user_id"];
								/*$perfils=$perfils.','.$perfil_user;
								while($perfil_user>2)
								{
									$sql_perfil="select f1.id from p_perfil f1 where f1.id_padre=".$perfil_user;
									$result1 = mysqli_query($dbcon,$sql_perfil);
						            if(mysqli_num_rows($result1) > 0)  
						            {
										if($row1 = mysqli_fetch_assoc($result1)) 
										{
											$perfil_user=$row1["id"];
											$perfils=$perfils.','.$perfil_user;
										}
									}
									else
										$perfil_user=0;
								}*/
							}
						}


						/*$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
						(select nombre from p_salas where id=s.sala_id) sala_nombre,
						(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
						(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
						from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
						where s.habilitado=1 and s.id_tecnico=".$_SESSION["user_id"];*/
						/*$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
						(select nombre from p_salas where id=s.sala_id) sala_nombre,
						(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
						(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
						from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
						where s.habilitado=1 and s.id_tecnico=u.id and s.id_tecnico in (select p2.id from p_usuario p2 where p2.perfil_id in(".$perfils.")) ".$str;*/
						$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
						(select nombre from p_salas where id=s.sala_id) sala_nombre,
						(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
						(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,
						(select nombre from p_usuario where id=s.creado_por_usuario) creado_por,
						s.fecha_creacion,t.desc tipo_servicio 
						from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
						where s.habilitado=1 and s.id_tecnico=u.id ".$str;
					}
			}
			else
			{		
				if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]<=2)
					$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
					(select nombre from p_salas where id=s.sala_id) sala_nombre,
					(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
					(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
					from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
					where s.habilitado=1 and s.creado_por_usuario=u.id and s.client_id=".$_SESSION["client_id"];
				else
					{
						$perfils=0;
						$str="";
						$sqlusr = "select p1.perfil_id,p1.client_id,p1.ciudad_id,p1.sucursal,p1.sala,p1.supervision_cliente,p1.supervision_ciudad,p1.supervision_sucursal,p1.supervision_sala,p1.supervision_solo from p_usuario p1 where p1.id=".$_SESSION["user_id"];
						$result = mysqli_query($dbcon,$sqlusr);
			            if(mysqli_num_rows($result) > 0)  
			            {
							if($row = mysqli_fetch_assoc($result)) 
							{
								$perfil_user=$row["perfil_id"];
								if($row["supervision_cliente"]==1)
									$str=$str." and u.client_id=".$row["client_id"];
								else if($row["supervision_ciudad"]==1)
									$str=$str." and u.ciudad_id=".$row["ciudad_id"];
								else if($row["supervision_sucursal"]==1)
									$str=$str." and u.sucursal=".$row["sucursal"];
								else if($row["supervision_sala"]==1)
									$str=$str." and u.sala=".$row["sala"];
								else if($row["supervision_solo"]==1)
									$str=$str." and u.id=".$_SESSION["user_id"];
								/*$perfils=$perfils.','.$perfil_user;
								while($perfil_user>2)
								{
									$sql_perfil="select f1.id from p_perfil f1 where f1.id_padre=".$perfil_user;
									$result1 = mysqli_query($dbcon,$sql_perfil);
						            if(mysqli_num_rows($result1) > 0)  
						            {
										if($row1 = mysqli_fetch_assoc($result1)) 
										{
											$perfil_user=$row1["id"];
											$perfils=$perfils.','.$perfil_user;
										}
									}
									else
										$perfil_user=0;
								}*/
							}
						}
						/*$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
						(select nombre from p_salas where id=s.sala_id) sala_nombre,
						(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
						(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
						from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
						where s.habilitado=1 and s.creado_por_usuario=u.id and s.creado_por_usuario=".$_SESSION["user_id"];*/
						$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
						(select nombre from p_salas where id=s.sala_id) sala_nombre,
						(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
						(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
						from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
						where s.habilitado=1 and s.creado_por_usuario=u.id ".$str;
					}
			}

			if($tipo_peticion>0 && $tipo_peticion<=5)
				$sql=$sql." and s.service_id=".$tipo_peticion;
			if($estado_peticion>0 && $estado_peticion<=3)
				$sql=$sql." and s.estado=".$estado_peticion;
			if($tipo_cliente>=0 && $tipo_cliente<3)
				$sql=$sql." and cl.tipo_cliente=".$tipo_cliente;
			$sql=$sql." and s.client_id=cl.id and s.ciudad_id=c.ID and s.sucursal_id=su.id and t.id=s.service_id";
			//echo $sql.'<br>';
			$peticiones=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$peticiones[$count] = array($row["id"],$row["service_id"],$row["cliente"],$row["ciudad"],$row["sucursal"],$row["sala"],$row["observacion"],$row["estado"],$row["tecnico_id"],$row["tecnico_name"],$row["sala_nombre"],$row["creado_por"],$row["fecha_creacion"],$row["tipo_servicio"],$row["client_id"]);
					$count++;
				}
			}
			return $peticiones;
		}

		//11-9,
		public function buscarPeticion($dbcon,$peticion_id,$estado_id,$service_id,$client_id,$ciudad_id,$sucursal_id,$sala_id,$tipo_cliente,$DEBUG_STATUS)
		{
			/*if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]>1)
				$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,  
				(select nombre from p_salas where id=s.sala_id) sala_nombre,
				(select id from p_usuario where id=s.id_tecnico) tecnico_id,
				(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
				from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t 
				where s.habilitado=1 and s.client_id=".$_SESSION["client_id"];
			else
				$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,  
				(select nombre from p_salas where id=s.sala_id) sala_nombre,
				(select id from p_usuario where id=s.id_tecnico) tecnico_id,
				(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
				from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t 
				where s.habilitado=1 ";*/

			if(isset($_SESSION["client_id"]) && $_SESSION["client_id"]==1)
			{
				if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]<=2)
					$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
					(select nombre from p_salas where id=s.sala_id) sala_nombre,
					(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
					(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
					from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
					where s.habilitado=1 ";	
				else
					$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
					(select nombre from p_salas where id=s.sala_id) sala_nombre,
					(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
					(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
					from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
					where s.habilitado=1 and s.id_tecnico=".$_SESSION["user_id"];
			}
			else
			{		
				if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]<=2)
					$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
					(select nombre from p_salas where id=s.sala_id) sala_nombre,
					(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
					(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
					from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
					where s.habilitado=1 and s.client_id=".$_SESSION["client_id"];
				else
					$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
					(select nombre from p_salas where id=s.sala_id) sala_nombre,
					(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
					(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
					from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
					where s.habilitado=1 and s.creado_por_usuario=".$_SESSION["user_id"];
			}
			
			if($client_id>0 && $client_id!=99)
				$sql=$sql." and s.client_id=".$client_id;
			if($service_id>0 && $service_id<=5)
				$sql=$sql." and s.service_id=".$service_id;
			if($estado_id>0 && $estado_id<=3)
				$sql=$sql." and s.estado=".$estado_id;
			if(!empty($ciudad_id) && $ciudad_id!=99)
				$sql=$sql." and s.ciudad_id =".$ciudad_id." ";
			if(!empty($sucursal_id) && $sucursal_id!=99)
				$sql=$sql." and s.sucursal_id =".$sucursal_id." ";
			if(!empty($sala_id) && $sala_id!=99)
				$sql=$sql." and s.sala_id =".$sala_id." ";
			if($tipo_cliente>=0 && $tipo_cliente<3)
				$sql=$sql." and cl.tipo_cliente=".$tipo_cliente;
			if(isset($peticion_id) && !empty($peticion_id))
				$sql=$sql." and s.id like '%".$peticion_id."%' ";

			$sql=$sql." and s.client_id=cl.id and s.ciudad_id=c.ID and s.sucursal_id=su.id and s.creado_por_usuario=u.id and t.id=s.service_id";
			//echo $sql.'<br>';
			$peticiones=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$peticiones[$count] = array($row["id"],$row["service_id"],$row["cliente"],$row["ciudad"],$row["sucursal"],$row["sala"],$row["observacion"],$row["estado"],$row["tecnico_id"],$row["tecnico_name"],$row["sala_nombre"],$row["creado_por"],$row["fecha_creacion"],$row["tipo_servicio"],$row["client_id"]);
					$count++;
				}
			}
			return $peticiones;
		}

		//asignarPeticiones,
		public function getPeticionesByClient($dbcon,$client_id,$peticion,$DEBUG_STATUS)
		{
			/*if(isset($_SESSION["client_id"]) && $_SESSION["client_id"]==1)
			{
				if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]<=2)
					$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
					(select nombre from p_salas where id=s.sala_id) sala_nombre,
					(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
					(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
					from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
					where s.habilitado=1 ";	
				else
					$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
					(select nombre from p_salas where id=s.sala_id) sala_nombre,
					(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
					(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
					from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
					where s.habilitado=1 and s.id_tecnico=".$_SESSION["user_id"];
			}
			else
			{		
				if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]<=2)
					$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
					(select nombre from p_salas where id=s.sala_id) sala_nombre,
					(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
					(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
					from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
					where s.habilitado=1 and s.client_id=".$_SESSION["client_id"];
				else
					$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
					(select nombre from p_salas where id=s.sala_id) sala_nombre,
					(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
					(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
					from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
					where s.habilitado=1 and s.creado_por_usuario=".$_SESSION["user_id"];
			}*/

			if(isset($_SESSION["client_id"]) && $_SESSION["client_id"]==1)
			{
				if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]<=2)
					$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
					(select nombre from p_salas where id=s.sala_id) sala_nombre,
					(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
					(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
					from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
					where s.habilitado=1 and s.estado in(1,2) and s.id_tecnico=u.id and s.client_id=".$client_id;
				else
					{
						$perfils=0;
						$str="";
						$sqlusr = "select p1.perfil_id,p1.client_id,p1.ciudad_id,p1.sucursal,p1.sala,p1.supervision_cliente,p1.supervision_ciudad,p1.supervision_sucursal,p1.supervision_sala,p1.supervision_solo from p_usuario p1 where p1.id=".$_SESSION["user_id"];
						$result = mysqli_query($dbcon,$sqlusr);
			            if(mysqli_num_rows($result) > 0)  
			            {
							if($row = mysqli_fetch_assoc($result)) 
							{
								$perfil_user=$row["perfil_id"];
								if($row["supervision_cliente"]==1)
									$str=$str." and u.client_id=".$row["client_id"];
								else if($row["supervision_ciudad"]==1)
									$str=$str." and u.ciudad_id=".$row["ciudad_id"];
								else if($row["supervision_sucursal"]==1)
									$str=$str." and u.sucursal=".$row["sucursal"];
								else if($row["supervision_sala"]==1)
									$str=$str." and u.sala=".$row["sala"];
								else if($row["supervision_solo"]==1)
									$str=$str." and u.id=".$_SESSION["user_id"];
								/*$perfils=$perfils.','.$perfil_user;
								while($perfil_user>2)
								{
									$sql_perfil="select f1.id from p_perfil f1 where f1.id_padre=".$perfil_user;
									$result1 = mysqli_query($dbcon,$sql_perfil);
						            if(mysqli_num_rows($result1) > 0)  
						            {
										if($row1 = mysqli_fetch_assoc($result1)) 
										{
											$perfil_user=$row1["id"];
											$perfils=$perfils.','.$perfil_user;
										}
									}
									else
										$perfil_user=0;
								}*/
							}
						}


						/*$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
						(select nombre from p_salas where id=s.sala_id) sala_nombre,
						(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
						(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
						from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
						where s.habilitado=1 and s.id_tecnico=".$_SESSION["user_id"];*/
						/*$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
						(select nombre from p_salas where id=s.sala_id) sala_nombre,
						(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
						(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
						from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
						where s.habilitado=1 and s.id_tecnico=u.id and s.id_tecnico in (select p2.id from p_usuario p2 where p2.perfil_id in(".$perfils.")) ".$str;*/
						$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
						(select nombre from p_salas where id=s.sala_id) sala_nombre,
						(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
						(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
						from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
						where s.habilitado=1 and s.estado in(1,2) and s.id_tecnico=u.id ".$str." and s.client_id=".$client_id;
					}
			}
			else
			{		
				if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]<=2)
					$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
					(select nombre from p_salas where id=s.sala_id) sala_nombre,
					(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
					(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
					from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
					where s.habilitado=1 and s.estado in(1,2) and s.creado_por_usuario=u.id and s.client_id=".$_SESSION["client_id"];
				else
					{
						$perfils=0;
						$str="";
						$sqlusr = "select p1.perfil_id,p1.client_id,p1.ciudad_id,p1.sucursal,p1.sala,p1.supervision_cliente,p1.supervision_ciudad,p1.supervision_sucursal,p1.supervision_sala,p1.supervision_solo from p_usuario p1 where p1.id=".$_SESSION["user_id"];
						$result = mysqli_query($dbcon,$sqlusr);
			            if(mysqli_num_rows($result) > 0)  
			            {
							if($row = mysqli_fetch_assoc($result)) 
							{
								$perfil_user=$row["perfil_id"];
								if($row["supervision_cliente"]==1)
									$str=$str." and u.client_id=".$row["client_id"];
								else if($row["supervision_ciudad"]==1)
									$str=$str." and u.ciudad_id=".$row["ciudad_id"];
								else if($row["supervision_sucursal"]==1)
									$str=$str." and u.sucursal=".$row["sucursal"];
								else if($row["supervision_sala"]==1)
									$str=$str." and u.sala=".$row["sala"];
								else if($row["supervision_solo"]==1)
									$str=$str." and u.id=".$_SESSION["user_id"];
								/*$perfils=$perfils.','.$perfil_user;
								while($perfil_user>2)
								{
									$sql_perfil="select f1.id from p_perfil f1 where f1.id_padre=".$perfil_user;
									$result1 = mysqli_query($dbcon,$sql_perfil);
						            if(mysqli_num_rows($result1) > 0)  
						            {
										if($row1 = mysqli_fetch_assoc($result1)) 
										{
											$perfil_user=$row1["id"];
											$perfils=$perfils.','.$perfil_user;
										}
									}
									else
										$perfil_user=0;
								}*/
							}
						}
						/*$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
						(select nombre from p_salas where id=s.sala_id) sala_nombre,
						(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
						(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
						from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
						where s.habilitado=1 and s.creado_por_usuario=u.id and s.creado_por_usuario=".$_SESSION["user_id"];*/
						$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
						(select nombre from p_salas where id=s.sala_id) sala_nombre,
						(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
						(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
						from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
						where s.habilitado=1 and s.estado in(1,2) and s.creado_por_usuario=u.id ".$str;
					}
			}

			if($peticion!=0)
				$sql=$sql." and s.id='".$peticion."'";
			$sql=$sql." and s.client_id=cl.id and s.ciudad_id=c.ID and s.sucursal_id=su.id and t.id=s.service_id";
			/*$sql=$sql." and s.client_id=".$client_id." and s.client_id=cl.id and s.ciudad_id=c.ID and s.sucursal_id=su.id and s.creado_por_usuario=u.id and t.id=s.service_id";*/
			$peticiones=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$peticiones[$count] = array($row["id"],$row["service_id"],$row["cliente"],$row["ciudad"],$row["sucursal"],$row["sala"],$row["observacion"],$row["estado"],$row["tecnico_id"],$row["tecnico_name"],$row["sala_nombre"],$row["creado_por"],$row["fecha_creacion"],$row["tipo_servicio"],$row["client_id"]);
					$count++;
				}
			}
			return $peticiones;
		}

		//atender
		public function getPeticionDtl($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select s.id,ts.desc service_type,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,
				(select p.nombre from p_salas p where p.id=s.sala_id) sala,
				s.observacion,s.estado,date_format(s.fecha_creacion,'%d-%m-%Y %H:%i:%s %p') fecha_creacion,ts.id service_id,cl.telefono,
				(select nombre from p_usuario u where u.id=s.creado_por_usuario) creado_por_usuario     
				from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_tipo_servicios ts 
				where s.id='".$id_peticion."' and s.client_id=cl.id and s.ciudad_id=c.ID and s.sucursal_id=su.id 
				and s.service_id=ts.id";
			////echo $sql.'<br>';
			$peticiones=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$peticiones[$count] = array($row["id"],$row["service_type"],$row["cliente"],$row["ciudad"],$row["sucursal"],$row["sala"],$row["observacion"],$row["estado"],$row["fecha_creacion"],$row["service_id"],$row["telefono"],$row["creado_por_usuario"]);
					$count++;
				}
			}
			return $peticiones;
		}

		public function getPeticionDtl1($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select s.id,ts.desc service_type,cl.nombre cliente,cl.id id_cliente,c.NOMBRE ciudad,su.nombre sucursal,
				(select p.nombre from p_salas p where p.id=s.sala_id) sala,
				s.observacion,s.estado,date_format(s.fecha_creacion,'%d-%m-%Y %H:%i:%s %p') fecha_creacion,ts.id service_id,cl.telefono,
				(select nombre from p_usuario u where u.id=s.creado_por_usuario) creado_por_usuario     
				from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_tipo_servicios ts 
				where s.id='".$id_peticion."' and s.client_id=cl.id and s.ciudad_id=c.ID and s.sucursal_id=su.id 
				and s.service_id=ts.id";
			////echo $sql.'<br>';
			$peticiones=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$peticiones[$count] = array($row["id"],$row["service_type"],$row["id_cliente"],$row["cliente"],$row["ciudad"],$row["sucursal"],$row["sala"],$row["observacion"],$row["estado"],$row["fecha_creacion"],$row["service_id"],$row["telefono"],$row["creado_por_usuario"]);
					$count++;
				}
			}
			return $peticiones;
		}

		public function getCurDate($dbcon,$DEBUG_STATUS)
		{
			$sql="select date_format(now(),'%d%m%Y') dt_time from dual";
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result))
				{
					$dt_time =$row["dt_time"];
				}
			}
			return $dt_time;
		}

		//atender
		public function getPeticionComments($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select c.observacion, (case when c.estado=1 then 'ABIERTA' when c.estado=2 then 'EN CURSO' when c.estado=3 then 'CERRADA' end) estado_desc, c.fecha_creacion, p.nombre creado_por_usuario,
				(select concat(e.nombre,' ',e.marca,' ',e.modelo,' ',e.serie) from p_equipos e where e.id=c.equipo_id) desc_equipo,c.estado from p_peticion_comments c, 
				p_usuario p where c.id='".$id_peticion."' and c.creado_por_usuario=p.id order by c.fecha_creacion desc";
			////echo $sql.'<br>';
			$peticiones=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$peticiones[$count] = array($row["observacion"],$row["fecha_creacion"],$row["creado_por_usuario"],$row["desc_equipo"],$row["estado_desc"],$row["estado"]);
					$count++;
				}
			}
			return $peticiones;
		}

		public function getPeticionComments2($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select c.observacion, (case when c.estado=1 then 'ABIERTA' when c.estado=2 then 'EN CURSO' when c.estado=3 then 'CERRADA' end) estado_desc, c.fecha_creacion, p.nombre creado_por_usuario,
				(select e.nombre from p_equipos e where e.id=c.equipo_id) nombre_equipo,
				(select e.modelo from p_equipos e where e.id=c.equipo_id) modelo_equipo,
				(select e.serie from p_equipos e where e.id=c.equipo_id) serie_equipo,
				c.estado from p_peticion_comments c, 
				p_usuario p where c.id='".$id_peticion."' and c.creado_por_usuario=p.id order by c.fecha_creacion desc";
			////echo $sql.'<br>';
			$peticiones=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result)) 
				{
					$peticiones[$count] = array($row["observacion"],$row["fecha_creacion"],$row["creado_por_usuario"],$row["nombre_equipo"],$row["estado_desc"],$row["estado"],$row["serie_equipo"],$row["modelo_equipo"]);
					$count++;
				}
			}
			return $peticiones;
		}

		public function getPeticionCommentsPDF($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select c.observacion, (case when c.estado=1 then 'ABIERTA' when c.estado=2 then 'EN CURSO' when c.estado=3 then 'CERRADA' end) estado_desc, c.fecha_creacion, p.nombre creado_por_usuario,
				(select concat(e.nombre,' ',e.marca,' ',e.modelo,' ',e.serie) from p_equipos e where e.id=c.equipo_id) desc_equipo,c.estado from p_peticion_comments c, 
				p_usuario p where c.id='".$id_peticion."' and c.creado_por_usuario=p.id order by c.fecha_creacion";
			////echo $sql.'<br>';
			$peticiones=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$peticiones[$count] = array($row["observacion"],$row["fecha_creacion"],$row["creado_por_usuario"],$row["desc_equipo"],$row["estado_desc"],$row["estado"]);
					$count++;
				}
			}
			return $peticiones;
		}

		public function getChecklist($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select id,desc_checklist,
				(select estado from p_proc_inst_equipo_checklist c,p_inst_equipo i where peticion_id='".$id_peticion."' and i.id=c.id and checklist_id=ch.id) estado,
				(select c.notas from p_proc_inst_equipo_checklist c,p_inst_equipo i where peticion_id='".$id_peticion."' and i.id=c.id and checklist_id=ch.id) notas
				from p_checklist_inst_equipo ch where ch.habilitado=1";
			
			//echo 'SQL:'.$sql.'<br>';
			$checklist=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$checklist[$count] = array($row["id"],$row["desc_checklist"],$row["estado"],$row["notas"]);
					$count++;
				}
			}
			
			return $checklist;
		}

		public function getReport1($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select id,date_format(report_dt,'%Y%m%d') report_dt,ost,date_format(fecha_inst,'%Y-%m-%d') fecha_inst,equipo_serie,equipo_modelo,software_version,estado_equipo,notas,tecnico_atendido,persona_recibido from p_inst_equipo ie where ie.peticion_id='".$id_peticion."'";
			$reportDtl=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$report_id=$row["report_dt"].'-01-'.str_pad($row["id"], 10,"0",STR_PAD_LEFT);
					$reportDtl[$count] = array($report_id,$row["id"],$row["report_dt"],$row["ost"],$row["fecha_inst"],$row["equipo_serie"],$row["equipo_modelo"],$row["software_version"],$row["estado_equipo"],$row["notas"],$row["tecnico_atendido"],$row["persona_recibido"]);
					$count++;
				}
			}
			else
			{
				$sql="insert into p_inst_equipo(peticion_id,report_dt) values('".$id_peticion."',now())";
				if(mysqli_query($dbcon,$sql))
				{	
					$sql="select id,date_format(report_dt,'%Y%m%d') report_dt,ost,date_format(fecha_inst,'%Y%m%d') fecha_inst,equipo_serie,equipo_modelo,software_version,estado_equipo,notas,tecnico_atendido,persona_recibido,date_format(fecha_ini,'%Y%m%d') fecha_ini,date_format(fecha_fin,'%Y%m%d') fecha_fin from p_inst_equipo ie where ie.peticion_id='".$id_peticion."'";
					$reportDtl=array();
					$count=0;
					$result = mysqli_query($dbcon,$sql);
		            if(mysqli_num_rows($result) > 0)  
		            {
						while($row = mysqli_fetch_assoc($result)) 
						{
							$report_id=$row["report_dt"].'-01-'.str_pad($row["id"], 10,"0",STR_PAD_LEFT);
							$reportDtl[$count] = array($report_id,$row["id"],$row["report_dt"],$row["ost"],$row["fecha_inst"],$row["equipo_serie"],$row["equipo_modelo"],$row["software_version"],$row["estado_equipo"],$row["notas"],$row["tecnico_atendido"],$row["persona_recibido"],$row["fecha_ini"],$row["fecha_fin"]);
							$count++;
						}
					}
				}
			}
			return $reportDtl;
		}

		public function updateReport1($dbcon,$id,$ost,$fecha_inst,$equipo_serie,$software_version,$equipo_modelo,$estado_equipo,$notas,$persona_recibido,$DEBUG_STATUS)
		{
			$sql="update p_inst_equipo set  ost='".$ost."', fecha_inst=date_format('".$fecha_inst."','%Y-%m-%d'),
				equipo_serie='".$equipo_serie."',equipo_modelo='".$equipo_modelo."',software_version='".$software_version."',
				estado_equipo=".$estado_equipo.",notas='".$notas."',tecnico_atendido=".$_SESSION["user_id"].",
				persona_recibido='".$persona_recibido."' where id=".$id;
			$updStatus=1;
			if(mysqli_query($dbcon,$sql))
			{	
				$updStatus=0;
			}
			return $updStatus;
		}

		public function updateChecklistReport1($dbcon,$id,$checklist_codigo_0,$checklist_codigo_1,$checklist_codigo_2,$checklist_codigo_3,$checklist_codigo_4,$checklist_codigo_5,$checklist_codigo_6,$checklist_codigo_7,$checklist_codigo_8,$checklist_codigo_9,$checklist_codigo_10,$checklist_codigo_11,$checklist_codigo_12,$checklist_codigo_13,$checklist_codigo_14,$checklist_codigo_15,$checklist_codigo_16,$checklist_codigo_17,$checklist_codigo_18,$checklist_codigo_19,$checklist_codigo_20,$turnos_dia_0,$turnos_dia_1,$turnos_dia_2,$turnos_dia_3,$turnos_dia_4,$turnos_dia_5,$turnos_dia_6,$turnos_dia_7,$turnos_dia_8,$turnos_dia_9,$turnos_dia_10,$turnos_dia_11,$turnos_dia_12,$turnos_dia_13,$turnos_dia_14,$turnos_dia_15,$turnos_dia_16,$turnos_dia_17,$turnos_dia_18,$turnos_dia_19,$turnos_dia_20,$nota_0,$nota_1,$nota_2,$nota_3,$nota_4,$nota_5,$nota_6,$nota_7,$nota_8,$nota_9,$nota_10,$nota_11,$nota_12,$nota_13,$nota_14,$nota_15,$nota_16,$nota_17,$nota_18,$nota_19,$nota_20,$DEBUG_STATUS)
		{
			/*$sql="select * from p_proc_inst_equipo_checklist where id=".$id;
			$checklistCtr=array();
			$count=0;
			$updStatus=1;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
            	$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_0." ,notas='".$nota_0."' where id=".$id." and checklist_id=".$checklist_codigo_0;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_1." ,notas='".$nota_1."' where id=".$id." and checklist_id=".$checklist_codigo_1;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_2." ,notas='".$nota_2."' where id=".$id." and checklist_id=".$checklist_codigo_2;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_3." ,notas='".$nota_3."' where id=".$id." and checklist_id=".$checklist_codigo_3;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_4." ,notas='".$nota_4."' where id=".$id." and checklist_id=".$checklist_codigo_4;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_5." ,notas='".$nota_5."' where id=".$id." and checklist_id=".$checklist_codigo_5;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_6." ,notas='".$nota_6."' where id=".$id." and checklist_id=".$checklist_codigo_6;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_7." ,notas='".$nota_7."' where id=".$id." and checklist_id=".$checklist_codigo_7;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_8." ,notas='".$nota_8."' where id=".$id." and checklist_id=".$checklist_codigo_8;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_9." ,notas='".$nota_9."' where id=".$id." and checklist_id=".$checklist_codigo_9;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_10." ,notas='".$nota_10."' where id=".$id." and checklist_id=".$checklist_codigo_10;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_11." ,notas='".$nota_11."' where id=".$id." and checklist_id=".$checklist_codigo_11;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_12." ,notas='".$nota_12."' where id=".$id." and checklist_id=".$checklist_codigo_12;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_13." ,notas='".$nota_13."' where id=".$id." and checklist_id=".$checklist_codigo_13;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_14." ,notas='".$nota_14."' where id=".$id." and checklist_id=".$checklist_codigo_14;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_15." ,notas='".$nota_15."' where id=".$id." and checklist_id=".$checklist_codigo_15;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_16." ,notas='".$nota_16."' where id=".$id." and checklist_id=".$checklist_codigo_16;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_17." ,notas='".$nota_17."' where id=".$id." and checklist_id=".$checklist_codigo_17;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_18." ,notas='".$nota_18."' where id=".$id." and checklist_id=".$checklist_codigo_18;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_19." ,notas='".$nota_19."' where id=".$id." and checklist_id=".$checklist_codigo_19;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="update p_proc_inst_equipo_checklist set estado=".$turnos_dia_20." ,notas='".$nota_20."' where id=".$id." and checklist_id=".$checklist_codigo_20;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;

            }
            else
            {*/
            	$sql="delete from p_proc_inst_equipo_checklist where id=".$id;
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;


            	$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_0.",".$turnos_dia_0.",'".$nota_0."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_1.",".$turnos_dia_1.",'".$nota_1."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_2.",".$turnos_dia_2.",'".$nota_2."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_3.",".$turnos_dia_3.",'".$nota_3."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_4.",".$turnos_dia_4.",'".$nota_4."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_5.",".$turnos_dia_5.",'".$nota_5."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_6.",".$turnos_dia_6.",'".$nota_6."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_7.",".$turnos_dia_7.",'".$nota_7."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_8.",".$turnos_dia_8.",'".$nota_8."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_9.",".$turnos_dia_9.",'".$nota_9."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_10.",".$turnos_dia_10.",'".$nota_10."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_11.",".$turnos_dia_11.",'".$nota_11."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_12.",".$turnos_dia_12.",'".$nota_12."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_13.",".$turnos_dia_13.",'".$nota_13."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_14.",".$turnos_dia_14.",'".$nota_14."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_15.",".$turnos_dia_15.",'".$nota_15."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_16.",".$turnos_dia_16.",'".$nota_16."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_17.",".$turnos_dia_17.",'".$nota_17."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_18.",".$turnos_dia_18.",'".$nota_18."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_19.",".$turnos_dia_19.",'".$nota_19."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
				$sql="insert into p_proc_inst_equipo_checklist values(".$id.",".$checklist_codigo_20.",".$turnos_dia_20.",'".$nota_20."')";
				if(mysqli_query($dbcon,$sql))	
					$updStatus=0;
            /*}*/

			
			return $updStatus;
		}
		
		public function getReport5($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select id,date_format(report_dt,'%Y%m%d') report_dt,hora_entrada,hora_salida,ciclos,repuestos_utilizados_desc,repuestos_utilizados_codigo,repuestos_utilizados_cantidad,observacion,recibido_por from p_maint_correctivo mc where mc.peticion_id='".$id_peticion."'";
			$reportDtl=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$report_id=$row["report_dt"].'-05-'.str_pad($row["id"], 10,"0",STR_PAD_LEFT);
					$reportDtl[$count] = array($report_id,$row["id"],$row["report_dt"],$row["hora_entrada"],$row["hora_salida"],$row["ciclos"],$row["repuestos_utilizados_desc"],$row["repuestos_utilizados_codigo"],$row["repuestos_utilizados_cantidad"],$row["observacion"],$row["recibido_por"]);
					$count++;
				}
			}
			else
			{
				$sql="insert into p_maint_correctivo(peticion_id,report_dt) values('".$id_peticion."',now())";
				if(mysqli_query($dbcon,$sql))
				{	
					$sql="select id,date_format(report_dt,'%Y%m%d') report_dt,hora_entrada,hora_salida,ciclos,repuestos_utilizados_desc,repuestos_utilizados_codigo,repuestos_utilizados_cantidad,observacion,recibido_por from p_maint_correctivo mc where mc.peticion_id='".$id_peticion."'";
					$reportDtl=array();
					$count=0;
					$result = mysqli_query($dbcon,$sql);
		            if(mysqli_num_rows($result) > 0)  
		            {
						while($row = mysqli_fetch_assoc($result)) 
						{
							$report_id=$row["report_dt"].'-05-'.str_pad($row["id"], 10,"0",STR_PAD_LEFT);
							$reportDtl[$count] = array($report_id,$row["id"],$row["report_dt"],$row["hora_entrada"],$row["hora_salida"],$row["ciclos"],$row["repuestos_utilizados_desc"],$row["repuestos_utilizados_codigo"],$row["repuestos_utilizados_cantidad"],$row["observacion"],$row["recibido_por"]);
							$count++;
						}
					}
				}
			}
			return $reportDtl;
		}

		public function updateReport5($dbcon,$id,$rep_hora_entrada,$rep_hora_salida,$rep_ciclos,$rep_desc,$rep_codigo,$rep_cantidad,$rep_obser,$rep_recibido_por,$DEBUG_STATUS)
		{
			$sql="update p_maint_correctivo set  hora_entrada='".$rep_hora_entrada."', hora_salida='".$rep_hora_salida."',ciclos='".$rep_ciclos."',repuestos_utilizados_desc='".$rep_desc."',repuestos_utilizados_codigo='".$rep_codigo."',repuestos_utilizados_cantidad='".$rep_cantidad."',observacion='".$rep_obser."',recibido_por='".$rep_recibido_por."' where id=".$id;
			$updStatus=1;
			if(mysqli_query($dbcon,$sql))
			{	
				$updStatus=0;
			}
			return $updStatus;
		}



		public function getReport2($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select id,date_format(report_dt,'%d%m%Y') report_dt,responsable,cargo,nombre_hospital,pais,telfono,direccion_fisica,rep_ventas, 
					fecha_instalacion,fecha_problema,horas_de_uso,version_sw,codigo_err,garantia,reportado_por,maquina_tipo,detalle,turnos_por_dia,
					fecha_ult_mantenimiento,freq_de_la_desinfeccion,freq_de_la_desincrustacion,oper_gen_de_equipo,insp_cond_ext,insp_sis_elec,insp_veri_parametros,
					insp_sis_hidra,insp_veri_func,insp_sis_apoyo,observacion,nombr_recibe,hora_de_inicio,hora_de_finalizacion,date_format(fecha,'%Y-%m-%d') fecha,equipo_apto_con_paciente 
					from p_maint_preventivo mp where mp.peticion_id='".$id_peticion."'";
			$reportDtl=array();
			$count=0;
			//echo 'sql:'.$sql.'<br>';
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$report_id=$row["report_dt"].'-02-'.str_pad($row["id"], 10,"0",STR_PAD_LEFT);
					$reportDtl[$count] = array($report_id,$row["id"],$row["report_dt"],$row["responsable"],$row["cargo"],$row["nombre_hospital"],
						$row["pais"],$row["telfono"],$row["direccion_fisica"],$row["rep_ventas"],$row["fecha_instalacion"],$row["fecha_problema"],	
						$row["horas_de_uso"],$row["version_sw"],$row["codigo_err"],$row["garantia"],$row["reportado_por"],$row["maquina_tipo"],
						$row["detalle"],$row["turnos_por_dia"],$row["fecha_ult_mantenimiento"],$row["freq_de_la_desinfeccion"],
						$row["freq_de_la_desincrustacion"],$row["oper_gen_de_equipo"],$row["insp_cond_ext"],$row["insp_sis_elec"],
						$row["insp_veri_parametros"],$row["insp_sis_hidra"],$row["insp_veri_func"],$row["insp_sis_apoyo"],$row["observacion"],
						$row["nombr_recibe"],	$row["hora_de_inicio"],$row["hora_de_finalizacion"],$row["fecha"],$row["equipo_apto_con_paciente"]);
					$count++;
				}
			}
			else
			{
				$sql="insert into p_maint_preventivo(peticion_id,report_dt,fecha) values('".$id_peticion."',now(),now())";
				if(mysqli_query($dbcon,$sql))
				{
					$sql="select id,date_format(report_dt,'%Y%m%d') report_dt,responsable,cargo,nombre_hospital,pais,telfono,direccion_fisica,rep_ventas, 
						fecha_instalacion,fecha_problema,horas_de_uso,version_sw,codigo_err,garantia,reportado_por,maquina_tipo,detalle,turnos_por_dia,
						fecha_ult_mantenimiento,freq_de_la_desinfeccion,freq_de_la_desincrustacion,oper_gen_de_equipo,insp_cond_ext,insp_sis_elec,insp_veri_parametros,
						insp_sis_hidra,insp_veri_func,insp_sis_apoyo,observacion,nombr_recibe,hora_de_inicio,hora_de_finalizacion,date_format(fecha,'%Y-%m-%d') fecha,equipo_apto_con_paciente 
						from p_maint_preventivo mp where mp.peticion_id='".$id_peticion."'";
					$reportDtl=array();
					$count=0;
					$result = mysqli_query($dbcon,$sql);
		            if(mysqli_num_rows($result) > 0)  
		            {
						while($row = mysqli_fetch_assoc($result)) 
						{
							$report_id=$row["report_dt"].'-02-'.str_pad($row["id"], 10,"0",STR_PAD_LEFT);
							$reportDtl[$count] = array($report_id,$row["id"],$row["report_dt"],$row["responsable"],$row["cargo"],$row["nombre_hospital"],
								$row["pais"],$row["telfono"],$row["direccion_fisica"],$row["rep_ventas"],$row["fecha_instalacion"],$row["fecha_problema"],	
								$row["horas_de_uso"],$row["version_sw"],$row["codigo_err"],$row["garantia"],$row["reportado_por"],$row["maquina_tipo"],
								$row["detalle"],$row["turnos_por_dia"],$row["fecha_ult_mantenimiento"],$row["freq_de_la_desinfeccion"],
								$row["freq_de_la_desincrustacion"],$row["oper_gen_de_equipo"],$row["insp_cond_ext"],$row["insp_sis_elec"],
								$row["insp_veri_parametros"],$row["insp_sis_hidra"],$row["insp_veri_func"],$row["insp_sis_apoyo"],$row["observacion"],
								$row["nombr_recibe"],	$row["hora_de_inicio"],$row["hora_de_finalizacion"],$row["fecha"],$row["equipo_apto_con_paciente"]);
							$count++;
						}
					}
				}
			}
			return $reportDtl;
		}

		public function updateReport2($dbcon,$id,$responsable,$cargo,$nombre_hospital,$pais,$telfono,$direccion_fisica,$rep_ventas,
			$fecha_instalacion,$fecha_problema,$horas_de_uso,$version_sw,$codigo_err,$garantia,$reportado_por,$maquina_tipo,$detalle,
			$turnos_por_dia,$fecha_ult_mantenimiento,$freq_de_la_desinfeccion,$freq_de_la_desincrustacion,$oper_gen_de_equipo,
			$insp_cond_ext,$insp_sis_elec,$insp_veri_parametros,$insp_sis_hidra,$insp_veri_func,$insp_sis_apoyo,$observacion,
			$nombr_recibe,$hora_de_inicio,$hora_de_finalizacion,$fecha,$equipo_apto_con_paciente,$DEBUG_STATUS)
		{
			$sql="update p_maint_preventivo set  responsable='".$responsable."',cargo='".$cargo."',nombre_hospital='".$nombre_hospital."',pais='".$pais."',telfono='".$telfono."',
				direccion_fisica='".$direccion_fisica."',rep_ventas='".$rep_ventas."',fecha_instalacion=date_format('".$fecha_instalacion."','%Y-%m-%d'),fecha_problema=date_format('".$fecha_problema."','%Y-%m-%d'),
				horas_de_uso='".$horas_de_uso."',version_sw='".$version_sw."',codigo_err='".$codigo_err."',garantia=".$garantia.",reportado_por='".$reportado_por."',
				maquina_tipo=".$maquina_tipo.",detalle=".$detalle.",turnos_por_dia=".$turnos_por_dia.",fecha_ult_mantenimiento=date_format('".$fecha_ult_mantenimiento."','%Y-%m-%d'),
				freq_de_la_desinfeccion=".$freq_de_la_desinfeccion.",freq_de_la_desincrustacion=".$freq_de_la_desincrustacion.",
				oper_gen_de_equipo=".$oper_gen_de_equipo.",insp_cond_ext='".$insp_cond_ext."',insp_sis_elec='".$insp_sis_elec."',insp_veri_parametros='".$insp_veri_parametros."',
				insp_sis_hidra='".$insp_sis_hidra."',insp_veri_func='".$insp_veri_func."',insp_sis_apoyo='".$insp_sis_apoyo."',observacion='".$observacion."',
				nombr_recibe='".$nombr_recibe."',hora_de_inicio='".$hora_de_inicio."',hora_de_finalizacion='".$hora_de_finalizacion."',fecha=now(),equipo_apto_con_paciente=".$equipo_apto_con_paciente." where id=".$id;
			//echo 'SQL::'.$sql.'<br>';
			$updStatus=1;
			if(mysqli_query($dbcon,$sql))
			{	
				$updStatus=0;
			}
			return $updStatus;
		}

		//12-0,
		public function actualizarGestionMasiva($dbcon,$equipos,$peticion_id,$equipo_id,$estado_id,$obser,$DEBUG_STATUS)
		{
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
			$ctr=0;
			if(isset($equipo_id) && !empty($equipo_id) && $equipo_id==99)
			{
				if(count($equipos)>0)
				{
					$ctr=count($equipos);
					for($t=0;$t<count($equipos);$t++)
					{
						$sql="insert into p_peticion_comments(id,observacion, equipo_id,estado, fecha_creacion,creado_por_usuario)
							value('".$peticion_id."','".$obser."',".$equipos[$t][0].",".$estado_id.",now(),".$_SESSION["user_id"].")";
						echo 'sql1:'.$sql.'<br>';
						if(mysqli_query($dbcon,$sql))
				        {
				        	if($estado_id==3)
				        	{
					        	$sql="update p_equipos set in_gestion=0 where id=".$equipos[$t][0];
					        	echo 'sql2:'.$sql.'<br>';
					        	if(mysqli_query($dbcon,$sql))
						        {
						        	$updStatus++;
						        }
					        }
					        else
					        	$updStatus++;
				        }
					}
				}
			}
			else if(isset($equipo_id) && !empty($equipo_id) && $equipo_id!=99)
			{
				$ctr=1;
				$sql="insert into p_peticion_comments(id,observacion, equipo_id,estado, fecha_creacion,creado_por_usuario)
					value('".$peticion_id."','".$obser."',".$equipo_id.",".$estado_id.",now(),".$_SESSION["user_id"].")";
				echo 'sql3:'.$sql.'<br>';
				if(mysqli_query($dbcon,$sql))
		        {
		        	if($estado_id==3)
		        	{
			        	$sql="update p_equipos set in_gestion=0 where id=".$equipo_id;
			        	echo 'sql4:'.$sql.'<br>';
			        	if(mysqli_query($dbcon,$sql))
				        {
				        	$updStatus++;
				        }
			        }
			        else
			        	$updStatus++;
		        }
			}
			else
			{
				$ctr=1;
				$sql="insert into p_peticion_comments(id,observacion, estado, fecha_creacion,creado_por_usuario)
					value('".$peticion_id."','".$obser."',".$estado_id.",now(),".$_SESSION["user_id"].")";
				echo 'sql5:'.$sql.'<br>';
				if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus++;
		        }
			}
			echo '<br><br><br>updStatus:'.$updStatus.'<br>';
			echo 'ctr:'.$ctr.'<br>';
			if($updStatus==$ctr)
			{
    			$sql="UPDATE p_solicitud set estado=".$estado_id." where id ='".$peticion_id."'";
	        	echo 'sql6:'.$sql.'<br>';
	        	if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        	$updStatus++;
		        }
		        else
		        {
		        	mysqli_rollback($dbcon);
		        	$updStatus=0;
		        }
    		}
    		else
	        {
	        	mysqli_rollback($dbcon);
	        	$updStatus=0;
	        }
	        echo 'updStatus:'.$updStatus.'<br>';
    		return $updStatus;
		}

		//12-0,
		public function actualizarGestion($dbcon,$peticion_id,$equipo_id,$estado_id,$obser,$DEBUG_STATUS)
		{
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
			$ctr=0;
			
			
			$sql="insert into p_peticion_comments(id,observacion, equipo_id,estado, fecha_creacion,creado_por_usuario)
				value('".$peticion_id."','".$obser."',".$equipo_id.",".$estado_id.",now(),".$_SESSION["user_id"].")";
			if(mysqli_query($dbcon,$sql))
	        {
	        	if($estado_id==3)
	        	{
		        	$sql="update p_equipos set in_gestion=0 where id=".$equipo_id;
		        	if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus++;
			        }
		        }
		        else
		        	$updStatus++;
	        }
			if($updStatus>0)
			{
    			$sql="UPDATE p_solicitud set estado=".$estado_id." where id ='".$peticion_id."'";
	        	echo $sql.'<br>';
	        	if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        	$updStatus++;
		        }
		        else
		        {
		        	mysqli_rollback($dbcon);
		        	$updStatus=0;
		        }
    		}
    		else
	        {
	        	mysqli_rollback($dbcon);
	        	$updStatus=0;
	        }
	        echo 'updStatus:'.$updStatus.'<br>';
    		return $updStatus;
		}

		//9-1,
		public function getUsersBySala($dbcon,$ciudad_id,$sucursal_id,$sala_id,$DEBUG_STATUS)
		{
			$sql="select pu.id,pu.nombre from p_usuario pu where pu.ciudad_id=".$ciudad_id." and pu.habilitado=1 ";
			if(!empty($sucursal_id) && $sucursal_id!=99)
				$sql=$sql." and pu.sucursal=".$sucursal_id;
			if(!empty($sala_id) && $sala_id!=99)
				$sql=$sql." and pu.sala=".$sala_id;
			//echo $sql.'<br>';
			$users=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$users[$count] = array($row["id"],$row["nombre"]);
					$count++;
				}
			}
			return $users;
		}





	}
?>