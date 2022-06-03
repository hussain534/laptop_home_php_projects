<?php
	//session_start();
	class controller
	{
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


		public function getPerfils($dbcon,$DEBUG_STATUS)
		{
			$sql="select p1.id, p1.nombre perfil ,p2.nombre perfil_padre,p1.habilitado from p_perfil p1,p_perfil p2 
			where p1.id_padre=p2.id and p1.id_cliente=".$_SESSION["client_id"]." order by p1.nombre";
			$perfil=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$perfil[$count] = array($row["id"],$row["perfil"],$row["perfil_padre"],$row["habilitado"]);
					$count++;
				}
			}
			return $perfil;
		}

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

		public function editPerfil($dbcon,$userId,$perfil_id,$perfil_nombre,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_perfil SET nombre='".strtoupper($perfil_nombre)."' ,fecha_modificacion=now(),modificado_por=".$_SESSION["user_id"]." 
					WHERE id=".$perfil_id;
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;
		}

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


		public function getClientes($dbcon,$DEBUG_STATUS)
		{
			if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]>1)
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

		public function getClientById($dbcon,$client_id,$DEBUG_STATUS)
		{
			$sql="select cl.id id_cliente,cl.nombre nombre_cliente,cl.id_ciudad,cl.telefono,cl.celular,
					cl.email,cd.nombre nombre_ciudad,cl.habilitado,p.nombre admin_name,p.id admin_id 
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
					$cliente[$count] = array($row["id_cliente"],$row["nombre_cliente"],$row["id_ciudad"],$row["telefono"],$row["celular"],$row["email"],$row["nombre_ciudad"],$row["habilitado"],$row["admin_name"],$row["admin_id"]);
					$count++;
				}
			}
			return $cliente;
		}

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

		public function aprobarCliente($dbcon,$id_cliente,$is_approved,$obser,$DEBUG_STATUS)
		{
			$sql = "UPDATE p_clientes SET habilitado=".$is_approved.",observacion='".$obser."',fecha_modificacion=now(),modificado_por=".$_SESSION["user_id"]." 
					WHERE id=".$id_cliente;
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;
		}

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

		public function registrarCliente($dbcon,$userId,$nombre_cliente,$ciudad_cliente,$client_telefono,$client_celular,$client_email,$admin_name,$admin_password,$DEBUG_STATUS)
		{
			$sql="select id, nombre from p_clientes where nombre = '".strtoupper($nombre_cliente)."'";
			mysqli_autocommit($dbcon,FALSE);
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO p_clientes(nombre,id_ciudad,telefono,celular,email,habilitado,fecha_creacion,creacion_por) 
				values('".strtoupper($nombre_cliente)."',".$ciudad_cliente.",'".$client_telefono."','".$client_celular."','".$client_email."',0,now(),".$userId.")";
				////echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$client_id = mysqli_insert_id($dbcon);
		        	$sql = "INSERT INTO p_usuario(client_id,nombre,password,perfil_id,ciudad_id,email,telefono,celular,habilitado,fecha_creacion,creado_por_usuario) 
						values(".$client_id.",'".strtoupper($admin_name)."','".$admin_password."',2,".$ciudad_cliente.",'".$client_email."','".$client_telefono."','".$client_celular."',1,now(),".$userId.")";
						////echo $sql.'<br>';
				        if(mysqli_query($dbcon,$sql))
				        {
				        	$user_id = mysqli_insert_id($dbcon);
				        	mysqli_commit($dbcon);
				        	$updStatus = 1;
				        	$_SESSION["user_id"]=$user_id;
				        	$_SESSION["user_name"]=$nombre_cliente;
				        	$_SESSION["user_perfil"]=2;
							$_SESSION["client_name"]=$nombre_cliente;
							$_SESSION["user_email"]=$client_email;
							$_SESSION["client_id"]=2;							
				        }
				        else
				        {
				        	$updStatus=0;
				        	mysqli_rollback($dbcon);
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
            	$updStatus=0;
            	return $updStatus;
            }
			
		}

		public function loginUser($dbcon,$user_email,$user_password,$DEBUG_STATUS)
		{
			$sql="select u.id userid, u.perfil_id,u.nombre user_name,u.email,c.nombre client_name,c.id clientid,c.habilitado from p_usuario u,p_clientes c 
				where u.email = '".$user_email."' and u.password='".$user_password."' and u.client_id=c.id";
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
            	}

	        	$sql = "update p_usuario set en_uso=1 where email = '".$user_email."' and password='".$user_password."'";
				////echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        	$updStatus = 1;
		        	$_SESSION["user_id"]=$userId;
		        	$_SESSION["user_name"]=$userName;
		        	$_SESSION["user_perfil"]=$userPerfil;
					$_SESSION["client_name"]=$clientName;
					$_SESSION["user_email"]=$userEmail;
					$_SESSION["client_id"]=$clientId;
		            $_SESSION['LAST_ACTIVITY'] = time();
		            if($client_habilitado==0)
		            	$updStatus=2;		            	
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

		public function getMenuPanel($dbcon,$DEBUG_STATUS)
		{
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



		public function getPermisos($dbcon,$userId,$menu_id,$DEBUG_STATUS)
		{
			$sql="select p.id, m.nombre nombre_menu,f.nombre nombre_perfil,p.menu_id,p.perfil_id from p_permisos p,p_menu m, p_perfil f where p.habilitado=1 and p.menu_id=".$menu_id." and 
					p.menu_id=m.id and p.perfil_id=f.id";
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

		public function getAllPermisos($dbcon,$DEBUG_STATUS)
		{
			$sql="select p.id, m.nombre nombre_menu,f.nombre nombre_perfil,p.menu_id,p.perfil_id from p_permisos p,p_menu m, p_perfil f where p.habilitado=1 and  
					p.menu_id=m.id and p.perfil_id=f.id";
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

		public function getSucursalesByCiudad($dbcon,$id_ciudad,$DEBUG_STATUS)
		{
			$sql="select s.id sucursal_id,s.nombre sucursal_nombre, c.ID ciudad_id, c.NOMBRE ciudad_nombre,s.habilitado 
				from p_sucursal s,p_ciudad c 
				where s.habilitado=1 and s.ciudad_id=c.id and s.ciudad_id=".$id_ciudad." and c.id_cliente=".$_SESSION["client_id"]." order by c.nombre,s.nombre";
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

		public function getSalasBySucursal($dbcon,$sucursal_id,$DEBUG_STATUS)
		{
			$sql="select sl.id sala_id, sl.nombre sala_nombre, s.id sucursal_id,s.nombre sucursal_nombre, c.ID ciudad_id, c.NOMBRE ciudad_nombre,s.habilitado 
				from p_sucursal s,p_ciudad c,p_salas sl 
				where s.ciudad_id=c.id and s.id=sl.id_sucursal and s.id=".$sucursal_id." and c.id_cliente=".$_SESSION["client_id"]." order by c.nombre,s.nombre";
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

		public function adduser($dbcon,$user_name,$user_email,$user_tele,$user_celular,$user_direccion,$perfil_id,$client_id,$ciudad_id,$sucursal_id,$sala_id,$DEBUG_STATUS)
		{
			$sql="select id, nombre,email from p_usuario where nombre='".strtoupper($user_name)."' 
				and email='".$user_email."' and perfil_id=".$perfil_id." and client_id=".$client_id." and ciudad_id=".$ciudad_id." and 
				sucursal=".$sucursal_id." and sala=".$sala." and habilitado=1 order by nombre";
			//echo $sql.'<br>';
			//$updStatus=99;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO p_usuario(nombre,password, email, telefono, celular, direccion, perfil_id,client_id,ciudad_id,
            		sucursal,sala,habilitado,en_uso,fecha_creacion,creado_por_usuario) 
				values('".strtoupper($user_name)."','".mt_rand()."','".$user_email."','".$user_tele."','".$user_celular."',
					'".$user_direccion."',".$perfil_id.",".$client_id.",".$ciudad_id.",".$sucursal_id.",".$sala_id.",1,0,now(),".$_SESSION["user_id"].")";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;
		        }
		        else
		        	$updStatus=0;

		        return $updStatus;	
            }
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

		public function getUsers($dbcon,$DEBUG_STATUS)
		{
			$sql="select u.id,u.nombre user_name,u.email,u.telefono,u.celular,u.direccion,f.nombre perfil,cl.nombre cliente,c.NOMBRE ciudad,
				s.nombre sucursal,sl.nombre sala,u.habilitado from p_usuario u,p_perfil f,p_ciudad c,p_clientes cl,p_sucursal s,p_salas sl
				where u.client_id=".$_SESSION["client_id"]." and u.perfil_id=f.id and u.client_id=cl.id and u.ciudad_id=c.ID and u.sucursal=s.id and u.sala=sl.id order by u.nombre";
			$users=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$users[$count] = array($row["id"],$row["user_name"],$row["email"],$row["telefono"],$row["celular"],$row["direccion"],$row["perfil"],$row["cliente"],$row["ciudad"],$row["sucursal"],$row["sala"],$row["habilitado"]);
					$count++;
				}
			}
			return $users;
		}

		public function buscarUser($dbcon,$user_name,$user_email,$user_tele,$user_celular,$user_direccion,$perfil_id,$client_id,$ciudad_id,$sucursal_id,$sala_id,$DEBUG_STATUS)
		{
			$sql="select u.id,u.nombre user_name,u.email,u.telefono,u.celular,u.direccion,f.nombre perfil,
				cl.nombre cliente,c.NOMBRE ciudad,s.nombre sucursal,sl.nombre sala,u.habilitado 
				from p_usuario u,p_perfil f,p_ciudad c,p_clientes cl,p_sucursal s,p_salas sl
				where u.client_id=".$_SESSION["client_id"]." and u.perfil_id=f.id and u.client_id=cl.id 
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



			$sql=$sql." order by u.nombre";
			////echo $sql.'<br>';
			$users=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$users[$count] = array($row["id"],$row["user_name"],$row["email"],$row["telefono"],$row["celular"],$row["direccion"],$row["perfil"],$row["cliente"],$row["ciudad"],$row["sucursal"],$row["sala"],$row["habilitado"]);
					$count++;
				}
			}
			return $users;
		}

		public function addEquipo($dbcon,$equipo_desc,$client_id,$ciudad_id,$sucursal_id,$sala_id,$DEBUG_STATUS)
		{
			$sql = "INSERT INTO p_equipos(descripcion,client_id,ciudad_id,
            		sucursal_id,sala_id,habilitado,fecha_creacion,creado_por_usuario) 
				values('".strtoupper($equipo_desc)."',".$client_id.",".$ciudad_id.",".$sucursal_id.",".$sala_id.",1,now(),".$_SESSION["user_id"].")";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;	
        }

        public function getEquipos($dbcon,$DEBUG_STATUS)
		{
			$sql="select e.id,e.descripcion,cl.nombre cliente,c.NOMBRE ciudad,
				s.nombre sucursal,sl.nombre sala,e.habilitado from p_equipos e,p_ciudad c,p_clientes cl,p_sucursal s,p_salas sl
				where e.client_id=".$_SESSION["client_id"]." and e.client_id=cl.id and e.ciudad_id=c.ID and e.sucursal_id=s.id 
				and e.sala_id=sl.id order by e.descripcion";
			$equipos=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$equipos[$count] = array($row["id"],$row["descripcion"],$row["cliente"],$row["ciudad"],$row["sucursal"],$row["sala"],$row["habilitado"]);
					$count++;
				}
			}
			return $equipos;
		}

		public function buscarEquipo($dbcon,$equipo_desc,$client_id,$ciudad_id,$sucursal_id,$sala_id,$DEBUG_STATUS)
		{
			$sql="select e.id,e.descripcion,cl.nombre cliente,c.NOMBRE ciudad,
				s.nombre sucursal,sl.nombre sala,e.habilitado from p_equipos e,p_ciudad c,p_clientes cl,p_sucursal s,p_salas sl
				where e.client_id=".$_SESSION["client_id"]." and e.client_id=cl.id and e.ciudad_id=c.ID and e.sucursal_id=s.id 
				and e.sala_id=sl.id";
			if(!empty($equipo_desc))
				$sql=$sql." and e.descripcion like '%".strtoupper($equipo_desc)."%' ";
			if(!empty($ciudad_id) && $ciudad_id!=99)
				$sql=$sql." and e.ciudad_id =".$ciudad_id." ";
			if(!empty($sucursal_id) && $sucursal_id!=99)
				$sql=$sql." and e.sucursal_id =".$sucursal_id." ";
			if(!empty($sala_id) && $sala_id!=99)
				$sql=$sql." and e.sala_id =".$sala_id." ";



			$sql=$sql." order by e.descripcion";
			////echo $sql.'<br>';
			$equipos=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$equipos[$count] = array($row["id"],$row["descripcion"],$row["cliente"],$row["ciudad"],$row["sucursal"],$row["sala"],$row["habilitado"]);
					$count++;
				}
			}
			return $equipos;
		}

		public function asignarTecnicoSucursal($dbcon,$tecnico_id,$sucursal_ids,$DEBUG_STATUS)
		{
			$sucursal=explode(",",$sucursal_ids);
			$updStatus=0;	
    		for($z=1;$z<count($sucursal);$z++)
    		{
    			$sql="UPDATE p_sucursal set id_tecnico=".$tecnico_id." where id in(".$sucursal_ids.")";
	        	////echo $sql.'<br>';
	        	if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus++;
		        }
    		}
    		return $updStatus;
		}

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
	        		for($z=1;$z<count($equipos);$z++)
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

        public function getPeticiones($dbcon,$tipo_peticion,$estado_peticion,$DEBUG_STATUS)
		{
			if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]>1)
				$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
				(select nombre from p_salas where id=s.sala_id) sala_nombre,
				(select id from p_usuario where id=s.id_tecnico) tecnico_id,
				(select nombre from p_usuario where id=s.id_tecnico) tecnico_name 
				from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su 
				where s.habilitado=1 and s.client_id=".$_SESSION["client_id"];
			else
				$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
				(select nombre from p_salas where id=s.sala_id) sala_nombre,
				(select id from p_usuario where id=s.id_tecnico) tecnico_id,
				(select nombre from p_usuario where id=s.id_tecnico) tecnico_name 
				from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su 
				where s.habilitado=1 ";
			if($tipo_peticion>0 && $tipo_peticion<=5)
				$sql=$sql." and s.service_id=".$tipo_peticion;
			if($estado_peticion>0 && $estado_peticion<=3)
				$sql=$sql." and s.estado=".$estado_peticion;
			$sql=$sql." and s.client_id=cl.id and s.ciudad_id=c.ID and s.sucursal_id=su.id";
			$peticiones=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$peticiones[$count] = array($row["id"],$row["service_id"],$row["cliente"],$row["ciudad"],$row["sucursal"],$row["sala"],$row["observacion"],$row["estado"],$row["tecnico_id"],$row["tecnico_name"],$row["sala_nombre"]);
					$count++;
				}
			}
			return $peticiones;
		}

		public function buscarPeticion($dbcon,$estado_id,$service_id,$client_id,$ciudad_id,$sucursal_id,$sala_id,$DEBUG_STATUS)
		{
			if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]>1)
				$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,  
				(select nombre from p_salas where id=s.sala_id) sala_nombre,
				(select id from p_usuario where id=s.id_tecnico) tecnico_id,
				(select nombre from p_usuario where id=s.id_tecnico) tecnico_name
				from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su 
				where s.habilitado=1 and s.client_id=".$_SESSION["client_id"];
			else
				$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,  
				(select nombre from p_salas where id=s.sala_id) sala_nombre,
				(select id from p_usuario where id=s.id_tecnico) tecnico_id,
				(select nombre from p_usuario where id=s.id_tecnico) tecnico_name
				from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su 
				where s.habilitado=1 ";
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

			$sql=$sql." and s.client_id=cl.id and s.ciudad_id=c.ID and s.sucursal_id=su.id";
			////echo $sql.'<br>';
			$peticiones=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$peticiones[$count] = array($row["id"],$row["service_id"],$row["cliente"],$row["ciudad"],$row["sucursal"],$row["sala"],$row["observacion"],$row["estado"],$row["tecnico_id"],$row["tecnico_name"],$row["sala_nombre"]);
					$count++;
				}
			}
			return $peticiones;
		}

		public function getPeticionDtl($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado  
				from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su 
				where s.id='".$id_peticion."' and s.client_id=cl.id and s.ciudad_id=c.ID and s.sucursal_id=su.id";
			////echo $sql.'<br>';
			$peticiones=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$peticiones[$count] = array($row["id"],$row["service_id"],$row["cliente"],$row["ciudad"],$row["sucursal"],$row["sala"],$row["observacion"],$row["estado"]);
					$count++;
				}
			}
			return $peticiones;
		}

		
		public function getPeticionComments($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select c.observacion, c.fecha_creacion, p.nombre creado_por_usuario from p_peticion_comments c, 
				p_usuario p where c.id='".$id_peticion."' and c.creado_por_usuario=p.id order by c.fecha_creacion desc";
			////echo $sql.'<br>';
			$peticiones=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$peticiones[$count] = array($row["observacion"],$row["fecha_creacion"],$row["creado_por_usuario"]);
					$count++;
				}
			}
			return $peticiones;
		}



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