<?php
	//session_start();
	class controller
	{
		public function registrarUser($dbcon,$nombre_cliente,$email_cliente,$password_cliente,$DEBUG_STATUS)
		{
			$sql="select id, nombre from p_usuario where email = '".$email_cliente."' and habilitado=1";
			mysqli_autocommit($dbcon,FALSE);
			$result = mysqli_query($dbcon,$sql);
			$updStatus=0;
            if(mysqli_num_rows($result) == 0)
            {
            	
            	$sql = "INSERT INTO p_usuario(nombre,email,password,habilitado,fecha_creacion,creado_por_usuario) 
				values('".strtoupper($nombre_cliente)."','".$email_cliente."','".$password_cliente."',0,now(),1)";
				////echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$to = strtoupper($client_email);
					$subject = 'LIBRE ONLINE- REGISTRO DE CUENTA';
					$txt = '¡HOLA, '.strtoupper($nombre_cliente).'!'."<br><br>";
					$txt=$txt.'Gracias por crear su cuenta en LIBRE-ONLINE'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.strtoupper($email_cliente).' y tu clave ingresada el momento del registro para iniciar sesión.'."<br><br>";
					$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros support@libreonline.com'."<br><br>";
					$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";
					$txt=$txt.'El Equipo de Libre ONline'."<br><br>";
					$txt=$txt.'Por favor ingresar a <br>www.libreonline.com'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					/*$headers .= 'From:info@hutesol.com' . "\r\n";
					$headers .= 'CC: olguercalvache@gmail.com';*/
					$headers .= 'From:LIBRE ONLINE <portal@libreonline.com>' . "\r\n";
					$headers .= 'CC: info@libreonline.com';

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
		        }
		        else
		        {
		        	$updStatus=8;
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
			$sql="select u.id userid, u.perfil_id,u.nombre user_name,u.email,u.habilitado from p_usuario u 
				where u.email = '".$user_email."' and u.password='".$user_password."' and u.habilitado=1";
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
            	}

	        	$sql = "update p_usuario set en_uso=1 where email = '".$user_email."' and password='".$user_password."'";
				////echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;
		        	$_SESSION["user_id"]=$userId;
		        	$_SESSION["user_name"]=$userName;
		        	$_SESSION["user_perfil"]=$userPerfil;
					$_SESSION["user_email"]=$userEmail;
		            $_SESSION['LAST_ACTIVITY'] = time();	            	
		        }
		        else
		        {
		        	$updStatus=2;
		        	mysqli_rollback($dbcon);
		        }	
            }
		    return $updStatus;			
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
					$subject = 'SISTEC NIPRO- RECUPERACION CLAVE';
					$txt = '¡HOLA, '.$nombre.'!'."<br><br>";
					$txt=$txt.'Se ha solicitado recuperar la clave para su cuenta en SISTEC'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.$user_email.' con siguiente clave para iniciar sesión'."<br><br>";
					$txt=$txt.'CLAVE:'.$clave."<br><br>";
					$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en support@sistec.com'."<br><br>";
					$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";
					$txt=$txt.'El Equipo de Nipro Medical Ecuador'."<br><br>";
					$txt=$txt.'Por favor ingresar a <br>www.sistececuador.com'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					/*$headers .= 'From:info@hutesol.com' . "\r\n";
					$headers .= 'CC: olguercalvache@gmail.com';*/
					$headers .= 'From:SISTEC NIPRO <portal@sistececuador.com>' . "\r\n";
					//$headers .= 'CC: fernandoa@nipromed.com';
					$headers .= 'BCC: fernandoa@nipromed.com';

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
					$subject = 'SISTEC NIPRO - CAMBIO DE CLAVE';
					$txt = '¡HOLA, '.$nombre.'!'."<br><br>";
					$txt=$txt.'Se ha solicitado cambiar la clave para su cuenta en SISTEC'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.$_SESSION["user_email"].' con siguiente clave para iniciar sesión'."<br><br>";
					$txt=$txt.'CLAVE:'.$clave_nuevo."<br><br>";
					$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en fernandoa@nipromed.com'."<br><br>";
					$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";
					$txt=$txt.'El Equipo de Nipro Medical Ecuador'."<br><br>";
					$txt=$txt.'Por favor ingresar a <br>www.sistececuador.com'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					/*$headers .= 'From:info@hutesol.com' . "\r\n";
					$headers .= 'CC: olguercalvache@gmail.com';*/
					$headers .= 'From:SISTEC NIPRO <portal@sistececuador.com>' . "\r\n";
					//$headers .= 'CC: fernandoa@nipromed.com';
					$headers .= 'BCC: fernandoa@nipromed.com';

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
				/*$sql="select e.id,concat(e.nombre,' ',e.marca,' ',e.modelo,' ',e.serie) desc_equipo from p_solicitud s,p_equipos_solicitud es,p_equipos e
				where s.id='".$peticion_id."' and s.id=es.nro_solicitud and es.equipo_id=e.id and s.service_id>1";*/
				$sql="select e.id,concat(e.nombre,' ',e.marca,' ',e.modelo,' ',e.serie) desc_equipo from p_solicitud s,p_equipos_solicitud es,p_equipos e
				where s.id='".$peticion_id."' and s.id=es.nro_solicitud and es.equipo_id=e.id";
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
			$sql="select s.id sucursal_id,s.nombre sucursal_nombre, c.ID ciudad_id, c.NOMBRE ciudad_nombre,s.habilitado,s.id_tecnico 
				from p_sucursal s,p_ciudad c 
				where s.habilitado=1 and s.ciudad_id=c.id and s.ciudad_id=".$id_ciudad." order by c.nombre,s.nombre";
			$sucursal=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$sucursal[$count] = array($row["sucursal_id"],$row["sucursal_nombre"],$row["ciudad_id"],$row["ciudad_nombre"],$row["habilitado"],$row["id_tecnico"]);
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
					where ps.ciudad_id=pc.ID and pc.id_cliente=c.id and c.id=".$id_cliente.' and c.habilitado=1';
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
		public function adduser($dbcon,$supervision_id,$user_name,$user_email,$user_tele,$user_celular,$user_direccion,$perfil_id,$client_id,$ciudad_id,$sucursal_id,$sala_id,$tipo_cliente,$DEBUG_STATUS)
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
				
				//$clave=mt_rand();
					$clave="password";
				if($supervision_id==1)				
					$sql = "INSERT INTO p_usuario(nombre,password, email, telefono, celular, direccion, perfil_id,client_id,ciudad_id,
            			sucursal,sala,habilitado,en_uso,fecha_creacion,creado_por_usuario,supervision_cliente,gestion_cliente) 
						values('".strtoupper($user_name)."','".$clave."','".$user_email."','".$user_tele."','".$user_celular."',
						'".$user_direccion."',".$perfil_id.",".$client_id.",".$ciudad_id.",".$sucursal_id.",".$sala_id.",1,0,now(),".$_SESSION["user_id"].",1,".$tipo_cliente.")";
				else if($supervision_id==2)				
					$sql = "INSERT INTO p_usuario(nombre,password, email, telefono, celular, direccion, perfil_id,client_id,ciudad_id,
            			sucursal,sala,habilitado,en_uso,fecha_creacion,creado_por_usuario,supervision_ciudad,gestion_cliente) 
						values('".strtoupper($user_name)."','".$clave."','".$user_email."','".$user_tele."','".$user_celular."',
						'".$user_direccion."',".$perfil_id.",".$client_id.",".$ciudad_id.",".$sucursal_id.",".$sala_id.",1,0,now(),".$_SESSION["user_id"].",1,".$tipo_cliente.")";
				else if($supervision_id==3)				
					$sql = "INSERT INTO p_usuario(nombre,password, email, telefono, celular, direccion, perfil_id,client_id,ciudad_id,
            			sucursal,sala,habilitado,en_uso,fecha_creacion,creado_por_usuario,supervision_sucursal,gestion_cliente) 
						values('".strtoupper($user_name)."','".$clave."','".$user_email."','".$user_tele."','".$user_celular."',
						'".$user_direccion."',".$perfil_id.",".$client_id.",".$ciudad_id.",".$sucursal_id.",".$sala_id.",1,0,now(),".$_SESSION["user_id"].",1,".$tipo_cliente.")";
				else if($supervision_id==4)				
					$sql = "INSERT INTO p_usuario(nombre,password, email, telefono, celular, direccion, perfil_id,client_id,ciudad_id,
            			sucursal,sala,habilitado,en_uso,fecha_creacion,creado_por_usuario,supervision_sala,gestion_cliente) 
						values('".strtoupper($user_name)."','".$clave."','".$user_email."','".$user_tele."','".$user_celular."',
						'".$user_direccion."',".$perfil_id.",".$client_id.",".$ciudad_id.",".$sucursal_id.",".$sala_id.",1,0,now(),".$_SESSION["user_id"].",1,".$tipo_cliente.")";
				else
					$sql = "INSERT INTO p_usuario(nombre,password, email, telefono, celular, direccion, perfil_id,client_id,ciudad_id,
            			sucursal,sala,habilitado,en_uso,fecha_creacion,creado_por_usuario,supervision_solo,gestion_cliente) 
						values('".strtoupper($user_name)."','".$clave."','".$user_email."','".$user_tele."','".$user_celular."',
						'".$user_direccion."',".$perfil_id.",".$client_id.",".$ciudad_id.",".$sucursal_id.",".$sala_id.",1,0,now(),".$_SESSION["user_id"].",1,".$tipo_cliente.")";
	

				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$to = $user_email;
					$subject = 'SISTEC NIPRO- CREACION DE USUARIO';
					$txt = '¡HOLA, '.strtoupper($user_name).'!'."<br><br>";
					$txt=$txt.$_SESSION["user_name"].' ha creado una cuenta para ti en SISTEC'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.$user_email.' y clave <b>'.$clave.'</b> para iniciar sesión.'."<br><br>";
					$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en fernandoa@nipromed.com'."<br><br>";
					$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";
					$txt=$txt.'El Equipo de Nipro Medical Ecuador'."<br><br>";
					$txt=$txt.'Por favor ingresar a <br>www.sistececuador.com'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					/*$headers .= 'From:info@hutesol.com' . "\r\n";
					$headers .= 'CC: olguercalvache@gmail.com,'.$_SESSION["user_email"];*/
					$headers .= 'From:SISTEC NIPRO <portal@sistececuador.com>' . "\r\n";
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

		public function editUser($dbcon,$user_id,$supervision_id,$user_name,$user_email,$user_tele,$user_celular,$user_direccion,$perfil_id,$client_id,$ciudad_id,$sucursal_id,$sala_id,$tipo_cliente,$DEBUG_STATUS)
		{
			if($supervision_id==1)
				$sql = "UPDATE p_usuario SET nombre='".strtoupper($user_name)."' ,email='".$user_email."',telefono='".$user_tele."',celular='".$user_celular."',direccion='".$user_direccion."',perfil_id=".$perfil_id.",client_id=".$client_id.",ciudad_id=".$ciudad_id.",sucursal=".$sucursal_id.",sala=".$sala_id.",gestion_cliente=".$tipo_cliente.",supervision_cliente=1,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." WHERE id=".$user_id;
			else if($supervision_id==2)
				$sql = "UPDATE p_usuario SET nombre='".strtoupper($user_name)."' ,email='".$user_email."',telefono='".$user_tele."',celular='".$user_celular."',direccion='".$user_direccion."',perfil_id=".$perfil_id.",client_id=".$client_id.",ciudad_id=".$ciudad_id.",sucursal=".$sucursal_id.",sala=".$sala_id.",gestion_cliente=".$tipo_cliente.",supervision_ciudad=1,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." WHERE id=".$user_id;
			else if($supervision_id==3)
				$sql = "UPDATE p_usuario SET nombre='".strtoupper($user_name)."' ,email='".$user_email."',telefono='".$user_tele."',celular='".$user_celular."',direccion='".$user_direccion."',perfil_id=".$perfil_id.",client_id=".$client_id.",ciudad_id=".$ciudad_id.",sucursal=".$sucursal_id.",sala=".$sala_id.",gestion_cliente=".$tipo_cliente.",supervision_sucursal=1,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." WHERE id=".$user_id;
			else if($supervision_id==4)
				$sql = "UPDATE p_usuario SET nombre='".strtoupper($user_name)."' ,email='".$user_email."',telefono='".$user_tele."',celular='".$user_celular."',direccion='".$user_direccion."',perfil_id=".$perfil_id.",client_id=".$client_id.",ciudad_id=".$ciudad_id.",sucursal=".$sucursal_id.",sala=".$sala_id.",gestion_cliente=".$tipo_cliente.",supervision_sala=1,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." WHERE id=".$user_id;
			else 
				$sql = "UPDATE p_usuario SET nombre='".strtoupper($user_name)."' ,email='".$user_email."',telefono='".$user_tele."',celular='".$user_celular."',direccion='".$user_direccion."',perfil_id=".$perfil_id.",client_id=".$client_id.",ciudad_id=".$ciudad_id.",sucursal=".$sucursal_id.",sala=".$sala_id.",gestion_cliente=".$tipo_cliente.",supervision_solo=1,fecha_modificacion=now(),modificado_por_usuario=".$_SESSION["user_id"]." WHERE id=".$user_id;

			//echo 'sql:'.$sql.'<br>';
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
				where u.client_id=".$_SESSION["client_id"]." and u.perfil_id=f.id and u.client_id=cl.id and u.ciudad_id=c.ID and u.sucursal=s.id and u.sala=sl.id and cl.habilitado=1 order by u.nombre";
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
		public function buscarUser($dbcon,$user_name,$user_email,$user_tele,$user_celular,$user_direccion,$perfil_id,$client_id,$ciudad_id,$sucursal_id,$sala_id,$tipo_cliente,$DEBUG_STATUS)
		{
			$sql="select u.id,u.nombre user_name,u.email,u.telefono,u.celular,u.direccion,f.nombre perfil,
				f.id perfil_id,cl.nombre cliente,cl.id client_id,c.NOMBRE ciudad,c.id cuidad_id,
				s.nombre sucursal,s.id sucursal_id,sl.nombre sala,s.id sala_id,u.habilitado,u.supervision_cliente,u.supervision_ciudad,u.supervision_sucursal,u.supervision_sala,u.supervision_solo  
				from p_usuario u,p_perfil f,p_ciudad c,p_clientes cl,p_sucursal s,p_salas sl
				where u.perfil_id=f.id and u.client_id=cl.id 
				and u.ciudad_id=c.ID and u.sucursal=s.id and u.sala=sl.id and cl.habilitado=1 ";
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
			//if(!empty($tipo_cliente) && $tipo_cliente!=99)
				$sql=$sql." and u.gestion_cliente =".$tipo_cliente." ";
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
			$sql="select id from p_equipos where serie='".strtoupper($equipo_serie)."'";
			//echo $sql;
			$updStatus=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {
				$sql = "INSERT INTO p_equipos(nombre,modelo,marca,serie,client_id,ciudad_id,
	            		sucursal_id,sala_id,habilitado,fecha_creacion,creado_por_usuario) 
					values('".strtoupper($equipo_nombre)."','".strtoupper($equipo_modelo)."','".strtoupper($equipo_marca)."','".strtoupper($equipo_serie)."',".$client_id.",".$ciudad_id.",".$sucursal_id.",".$sala_id.",1,now(),".$_SESSION["user_id"].")";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;
		        }
		     }
		     else
		     {
		     	$updStatus = 2;
		     }

	        return $updStatus;	
        }

        //adminEquipos
        public function getEquipos($dbcon,$DEBUG_STATUS)
		{
			$sql="select e.id,e.nombre,e.modelo,e.marca,e.serie,cl.nombre cliente,c.NOMBRE ciudad,
				s.nombre sucursal,sl.nombre sala,e.habilitado from p_equipos e,p_ciudad c,p_clientes cl,p_sucursal s,p_salas sl
				where e.client_id=".$_SESSION["client_id"]." and e.client_id=cl.id and e.ciudad_id=c.ID and e.sucursal_id=s.id 
				and e.sala_id=sl.id and cl.habilitado=1 order by e.descripcion";
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
				and e.sala_id=sl.id and cl.habilitado=1 ";
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
			 
			//$sql=$sql." and e.id not in(select pe.equipo_id from p_solicitud ps,p_equipos_solicitud pe where ps.id=pe.nro_solicitud and ps.estado <3)";


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

		public function buscarEquipoPendientesParaPeticion($dbcon,$equipo_nombre,$equipo_modelo,$equipo_marca,$equipo_serie,$client_id,$ciudad_id,$sucursal_id,$sala_id,$DEBUG_STATUS)
		{
			/*$sql="select e.id,e.nombre,e.modelo,e.marca,e.serie,cl.nombre cliente,c.NOMBRE ciudad,
				s.nombre sucursal,sl.nombre sala,e.habilitado from p_equipos e,p_ciudad c,p_clientes cl,p_sucursal s,p_salas sl
				where e.in_gestion=0 and e.client_id=".$_SESSION["client_id"]." and e.client_id=cl.id and e.ciudad_id=c.ID and e.sucursal_id=s.id 
				and e.sala_id=sl.id";*/
			$sql="select e.id,e.nombre,e.modelo,e.marca,e.serie,cl.nombre cliente,c.NOMBRE ciudad,
				s.nombre sucursal,sl.nombre sala,e.habilitado from p_equipos e,p_ciudad c,p_clientes cl,p_sucursal s,p_salas sl
				where e.in_gestion=0 and e.client_id=cl.id and e.ciudad_id=c.ID and e.sucursal_id=s.id 
				and e.sala_id=sl.id and cl.habilitado=1 ";
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

		public function buscarEquipoParaInformes($dbcon,$equipo_nombre,$equipo_modelo,$equipo_marca,$equipo_serie,$client_id,$ciudad_id,$sucursal_id,$sala_id,$DEBUG_STATUS)
		{
			/*$sql="select e.id,e.nombre,e.modelo,e.marca,e.serie,cl.nombre cliente,c.NOMBRE ciudad,
				s.nombre sucursal,sl.nombre sala,e.habilitado from p_equipos e,p_ciudad c,p_clientes cl,p_sucursal s,p_salas sl
				where e.in_gestion=0 and e.client_id=".$_SESSION["client_id"]." and e.client_id=cl.id and e.ciudad_id=c.ID and e.sucursal_id=s.id 
				and e.sala_id=sl.id";*/
			$sql="select e.id,e.nombre,e.modelo,e.marca,e.serie,cl.nombre cliente,c.NOMBRE ciudad,
				s.nombre sucursal,sl.nombre sala,e.habilitado from p_equipos e,p_ciudad c,p_clientes cl,p_sucursal s,p_salas sl
				where e.in_gestion=0 and e.client_id=cl.id and e.ciudad_id=c.ID and e.sucursal_id=s.id 
				and e.sala_id=sl.id and cl.habilitado=1 ";
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
			 
			//$sql=$sql." and e.id not in(select pe.equipo_id from p_solicitud ps,p_equipos_solicitud pe where ps.id=pe.nro_solicitud and ps.estado <3)";


			$sql=$sql." order by cl.nombre,e.nombre";
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

		public function buscarInformesVisitasControl($dbcon,$client_id,$ciudad_id,$sucursal_id,$sala_id,$DEBUG_STATUS)
		{
			/*$sql="select e.id,e.nombre,e.modelo,e.marca,e.serie,cl.nombre cliente,c.NOMBRE ciudad,
				s.nombre sucursal,sl.nombre sala,e.habilitado from p_equipos e,p_ciudad c,p_clientes cl,p_sucursal s,p_salas sl
				where e.in_gestion=0 and e.client_id=".$_SESSION["client_id"]." and e.client_id=cl.id and e.ciudad_id=c.ID and e.sucursal_id=s.id 
				and e.sala_id=sl.id";*/
			$sql="select su.id,cl.nombre client_name,ci.NOMBRE ciudad_name,su.nombre sucursal_nombre from p_clientes cl, p_ciudad ci, p_sucursal su
					where su.ciudad_id=ci.ID and ci.id_cliente=cl.id and cl.id>1 and cl.habilitado=1 ";
			if(!empty($ciudad_id) && $ciudad_id!=99)
				$sql=$sql." and ci.id =".$ciudad_id." ";
			if(!empty($sucursal_id) && $sucursal_id!=99)
				$sql=$sql." and su.id =".$sucursal_id." ";
			/*if(!empty($sala_id) && $sala_id!=99)
				$sql=$sql." and sa.id =".$sala_id." ";*/
			if(!empty($client_id) && $client_id!=99)
				$sql=$sql." and cl.id =".$client_id." ";
			else
			{
				if($_SESSION["client_id"]>1)
					$sql=$sql." and cl.id =".$_SESSION["client_id"]." ";
			}
			 
			//$sql=$sql." and e.id not in(select pe.equipo_id from p_solicitud ps,p_equipos_solicitud pe where ps.id=pe.nro_solicitud and ps.estado <3)";


			$sql=$sql." order by cl.nombre,ci.nombre,su.nombre";
			//echo $sql.'<br>';
			$visitas=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$visitas[$count] = array($row["id"],$row["client_name"],$row["ciudad_name"],$row["sucursal_nombre"]);
					$count++;
				}
			}
			return $visitas;
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
	        {
	        	/*-----START OF EMAIL-----*/
	        	$jefe_email='';
	        	$tecnico_email = '';
				$tecnico_name='';
				$tecnico_perfil_id = 0;
				$client_name='';

	        	$sql="select u.email,u.nombre,u.perfil_id from p_usuario u where u.id=".$id_tecnico;
	        	$result = mysqli_query($dbcon,$sql);
	            if(mysqli_num_rows($result) > 0)  
	            {
					if($row = mysqli_fetch_assoc($result)) 
					{
						$tecnico_email = $row["email"];
						$tecnico_name=$row["nombre"];
						$tecnico_perfil_id = $row["perfil_id"];
						if($tecnico_perfil_id==29)
							$sql2="select p1.email from p_usuario p1 where p1.perfil_id=21";
						else if($tecnico_perfil_id==27 || $tecnico_perfil_id==28)
							$sql2="select p1.email from p_usuario p1 where p1.perfil_id=22";
						$result2 = mysqli_query($dbcon,$sql2);
			            if(mysqli_num_rows($result2) > 0)  
			            {
							while($row2 = mysqli_fetch_assoc($result2)) 
							{
								$jefe_email = $jefe_email.','.$row2["email"];
							}
						}
					}
				}

				$sql3="select c.nombre from p_clientes c where c.id=".$client_id.' and habilitado=1';
	        	$result3 = mysqli_query($dbcon,$sql3);
	            if(mysqli_num_rows($result3) > 0)  
	            {
					if($row3 = mysqli_fetch_assoc($result3)) 
					{
						$client_name = $row3["nombre"];
					}
				}
	        	$to = strtoupper($tecnico_email);
				$subject = 'SISTEC NIPRO- NUEVA PETICION GENERADA';
				$txt = '¡HOLA, '.strtoupper($tecnico_name).'!'."<br><br>";
				$txt=$txt.'Se ha asignado un nuevo ticket(nro peticion : '.$nro_solicitud.') generado para el cliente :'.strtoupper($client_name)."<br><br>";
				$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en fernandoa@nipromed.com'."<br><br>";
				$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";
				$txt=$txt.'El Equipo de Nipro Medical Ecuador'."<br><br>";
				$txt=$txt.'Por favor ingresar a <br>www.sistececuador.com'."<br><br>";

				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
				/*$headers .= 'From:info@hutesol.com' . "\r\n";
				$headers .= 'CC: olguercalvache@gmail.com';*/
				$headers .= 'From:SISTEC NIPRO <portal@sistececuador.com>' . "\r\n";
				$headers .= 'CC: fernandoa@nipromed.com'.$jefe_email;

				$res=mail($to,$subject,$txt,$headers);
				
				/*-----END OF EMAIL-----*/
	        	return $nro_solicitud;	
	        }
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
					where s.habilitado=1 and s.id_tecnico=u.id and cl.habilitado=1 ";	
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
						where s.habilitado=1 and cl.habilitado=1 and s.id_tecnico=u.id ".$str;
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
					where s.habilitado=1 and cl.habilitado=1 and s.creado_por_usuario=u.id and s.client_id=".$_SESSION["client_id"];
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
						where s.habilitado=1 and cl.habilitado=1 and s.creado_por_usuario=u.id ".$str;
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
					where s.habilitado=1 and cl.habilitado=1 ";	
				else
					$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
					(select nombre from p_salas where id=s.sala_id) sala_nombre,
					(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
					(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
					from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
					where s.habilitado=1 and cl.habilitado=1 and s.id_tecnico=".$_SESSION["user_id"];
			}
			else
			{		
				if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]<=2)
					$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
					(select nombre from p_salas where id=s.sala_id) sala_nombre,
					(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
					(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
					from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
					where s.habilitado=1 and cl.habilitado=1 and s.client_id=".$_SESSION["client_id"];
				else
					$sql="select s.id,s.service_id,cl.nombre cliente,c.NOMBRE ciudad,su.nombre sucursal,s.sala_id sala,s.observacion,s.estado,   
					(select nombre from p_salas where id=s.sala_id) sala_nombre,
					(select id from p_usuario where id=s.id_tecnico) tecnico_id,s.client_id, 
					(select nombre from p_usuario where id=s.id_tecnico) tecnico_name,u.nombre creado_por,s.fecha_creacion,t.desc tipo_servicio 
					from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_usuario u,p_tipo_servicios t  
					where s.habilitado=1 and cl.habilitado=1 and s.creado_por_usuario=".$_SESSION["user_id"];
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
					where s.habilitado=1 and cl.habilitado=1 and s.estado in(1,2) and s.id_tecnico=u.id and s.client_id=".$client_id;
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
						where s.habilitado=1 and cl.habilitado=1 and s.estado in(1,2) and s.id_tecnico=u.id ".$str." and s.client_id=".$client_id;
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
					where s.habilitado=1 and cl.habilitado=1 and s.estado in(1,2) and s.creado_por_usuario=u.id and s.client_id=".$_SESSION["client_id"];
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
						where s.habilitado=1 and cl.habilitado=1 and s.estado in(1,2) and s.creado_por_usuario=u.id ".$str;
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

		public function getPeticionesPorEquipoId($dbcon,$id_equipo,$DEBUG_STATUS)
		{
			$sql="select ps.id,pu.nombre,ps.fecha_modificacion,pt.`desc` tipo_servicioo,
					(case when ps.estado=1 then 'ABIERTO' when ps.estado=2 then 'EN CURSO' when ps.estado=3 then 'CERRADO' end) estado
					from p_solicitud ps, p_equipos_solicitud pe, p_usuario pu,p_tipo_servicios pt
					where pe.equipo_id=".$id_equipo." and pe.nro_solicitud=ps.id and ps.id_tecnico=pu.id
					and ps.service_id=pt.id";
			$peticiones=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$peticiones[$count] = array($row["id"],$row["nombre"],$row["fecha_modificacion"],$row["tipo_servicioo"],$row["estado"]);
					$count++;
				}
			}
			return $peticiones;

		}

		public function getPeticionesInformeVisitas($dbcon,$id_sucursal,$DEBUG_STATUS)
		{
			$sql="select ps.id,pu.nombre,ps.fecha_modificacion,pt.`desc` tipo_servicioo,
					(case when ps.estado=1 then 'ABIERTO' when ps.estado=2 then 'EN CURSO' when ps.estado=3 then 'CERRADO' end) estado
					from p_solicitud ps, p_usuario pu,p_tipo_servicios pt
					where ps.id_tecnico=pu.id and pt.id=7 
					and ps.service_id=pt.id and ps.sucursal_id=".$id_sucursal;
			$peticiones=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$peticiones[$count] = array($row["id"],$row["nombre"],$row["fecha_modificacion"],$row["tipo_servicioo"],$row["estado"]);
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
				(select nombre from p_usuario u where u.id=s.creado_por_usuario) creado_por_usuario,tipo_cliente      
				from p_solicitud s, p_clientes cl, p_ciudad c,p_sucursal su,p_tipo_servicios ts 
				where s.id='".$id_peticion."' and cl.habilitado=1 and s.client_id=cl.id and s.ciudad_id=c.ID and s.sucursal_id=su.id 
				and s.service_id=ts.id";
			////echo $sql.'<br>';
			$peticiones=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$peticiones[$count] = array($row["id"],
												$row["service_type"],
												$row["cliente"],
												$row["ciudad"],
												$row["sucursal"],
												$row["sala"],
												$row["observacion"],
												$row["estado"],
												$row["fecha_creacion"],
												$row["service_id"],
												$row["telefono"],
												$row["creado_por_usuario"],
												$row["tipo_cliente"]);
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
				where s.id='".$id_peticion."' and cl.habilitado=1 and s.client_id=cl.id and s.ciudad_id=c.ID and s.sucursal_id=su.id 
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

		public function getCurrDateValuesAsPerFormat($dbcon,$format,$DEBUG_STATUS)
		{
			$sql="select date_format(now(),'".$format."') dt_time from dual";
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

		public function getReport6($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select id,date_format(report_dt,'%Y%m%d') report_dt,recibido_por,cedula_user_recibido,servicio1,servicio2,servicio3,servicio4
					from p_informe_aplicaciones ia where ia.peticion_id='".$id_peticion."'";
			$reportDtl=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$report_id=$row["report_dt"].'-06-'.str_pad($row["id"], 10,"0",STR_PAD_LEFT);
					$reportDtl[$count] = array($report_id,$row["id"],$row["report_dt"],$row["recibido_por"],$row["cedula_user_recibido"],$row["servicio1"],$row["servicio2"],$row["servicio3"],$row["servicio4"]);
					$count++;
				}
			}
			else
			{
				$sql="insert into p_informe_aplicaciones(peticion_id,report_dt) values('".$id_peticion."',now())";
				if(mysqli_query($dbcon,$sql))
				{	
					$sql="select id,date_format(report_dt,'%Y%m%d') report_dt,recibido_por,cedula_user_recibido,servicio1,servicio2,servicio3,servicio4
					from p_informe_aplicaciones ia where ia.peticion_id='".$id_peticion."'";
					$reportDtl=array();
					$count=0;
					$result = mysqli_query($dbcon,$sql);
		            if(mysqli_num_rows($result) > 0)  
		            {
						while($row = mysqli_fetch_assoc($result)) 
						{
							$report_id=$row["report_dt"].'-06-'.str_pad($row["id"], 10,"0",STR_PAD_LEFT);
							$reportDtl[$count] = array($report_id,$row["id"],$row["report_dt"],$row["recibido_por"],$row["cedula_user_recibido"],$row["servicio1"],$row["servicio2"],$row["servicio3"],$row["servicio4"]);
							$count++;
						}
					}
				}
			}
			return $reportDtl;
		}

		public function updateReport6($dbcon,$id,$rep_recibido_por,$cedula_recibido_por,$id1,$id2,$id3,$id4,$DEBUG_STATUS)
		{
			$sql="update p_informe_aplicaciones set  recibido_por='".$rep_recibido_por."', 
					cedula_user_recibido='".$cedula_recibido_por."',servicio1=".$id1.",servicio2=".$id2.",servicio3=".$id3.",servicio4=".$id4." where id=".$id;
			$updStatus=1;
			//echo $sql;
			if(mysqli_query($dbcon,$sql))
			{	
				$updStatus=0;
			}
			return $updStatus;
		}

		public function getReport6PeticionDtl($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select cl.nombre client_name,pc.NOMBRE ciudad_name,
					(select pu.direccion from p_usuario pu where pu.client_id=cl.id and pu.perfil_id=2) direccion,
					(select pu.telefono from p_usuario pu where pu.client_id=cl.id and pu.perfil_id=2) telefono,
					date_format(ps.fecha_creacion,'%d-%m-%Y %H:%i:%s %p') dt_ing_solicitud,
					date_format((select min(p.fecha_creacion) from p_peticion_comments p where p.id=ps.id),'%d-%m-%Y %H:%i:%s %p') dt_inicio_gestion,
					date_format((select max(p.fecha_creacion) from p_peticion_comments p where p.id=ps.id),'%d-%m-%Y %H:%i:%s %p') dt_fin_gestion,
					pe.nombre equipo_nombre,pe.modelo,pe.serie,
					ps.observacion peticion_dtl,
					(select p.observacion from p_peticion_comments p where p.id=ps.id and p.estado=3) observacion
					from p_solicitud ps,p_ciudad pc,p_clientes cl,p_equipos_solicitud es,p_equipos pe
					where ps.id='".$id_peticion."'
					and ps.ciudad_id=pc.ID
					and ps.client_id=cl.id
					and ps.id=es.nro_solicitud
					and pe.id=es.equipo_id and cl.habilitado=1 ";
			$petcionDtl=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$petcionDtl[$count] = array($row["client_name"],
												$row["ciudad_name"],
												$row["direccion"],
												$row["telefono"],
												$row["dt_ing_solicitud"],
												$row["dt_inicio_gestion"],
												$row["dt_fin_gestion"],
												$row["equipo_nombre"],
												$row["modelo"],
												$row["serie"],
												$row["peticion_dtl"],
												$row["observacion"]);
					$count++;
				}
			}
			return $petcionDtl;
		}


		public function getReport7($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select id,date_format(report_dt,'%Y%m%d') report_dt
					from p_informe_visitas ia where ia.peticion_id='".$id_peticion."'";
			$reportDtl=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$report_id=$row["report_dt"].'-06-'.str_pad($row["id"], 10,"0",STR_PAD_LEFT);
					$reportDtl[$count] = array($report_id,$row["id"],$row["report_dt"]);
					$count++;
				}
			}
			else
			{
				$sql="insert into p_informe_visitas(peticion_id,report_dt) values('".$id_peticion."',now())";
				if(mysqli_query($dbcon,$sql))
				{	
					$sql="select id,date_format(report_dt,'%Y%m%d') report_dt
					from p_informe_visitas ia where ia.peticion_id='".$id_peticion."'";
					$reportDtl=array();
					$count=0;
					$result = mysqli_query($dbcon,$sql);
		            if(mysqli_num_rows($result) > 0)  
		            {
						while($row = mysqli_fetch_assoc($result)) 
						{
							$report_id=$row["report_dt"].'-06-'.str_pad($row["id"], 10,"0",STR_PAD_LEFT);
							$reportDtl[$count] = array($report_id,$row["id"],$row["report_dt"]);
							$count++;
						}
					}
				}
			}
			return $reportDtl;
		}

		public function updateReport7($dbcon,$id,$DEBUG_STATUS)
		{
			$sql="update p_informe_visitas set  fecha_creacion=now(),fecha_modificado=now() where id=".$id;
			$updStatus=1;
			if(mysqli_query($dbcon,$sql))
			{	
				$updStatus=0;
			}
			return $updStatus;
		}

		public function getReport7PeticionDtl($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select cl.nombre client_name,
					date_format(ps.fecha_creacion,'%d-%m-%Y %H:%i:%s %p') dt_ing_solicitud,
					date_format((select min(p.fecha_creacion) from p_peticion_comments p where p.id=ps.id),'%d-%m-%Y %H:%i:%s %p') dt_inicio_gestion,
					date_format((select max(p.fecha_creacion) from p_peticion_comments p where p.id=ps.id),'%d-%m-%Y %H:%i:%s %p') dt_fin_gestion,
					(select p.observacion from p_peticion_comments p where p.id=ps.id and p.estado=3) observacion
					from p_solicitud ps,p_clientes cl
					where ps.id='".$id_peticion."'
					and cl.habilitado=1 and ps.client_id=cl.id";
			$petcionDtl=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$petcionDtl[$count] = array($row["client_name"],
												$row["dt_ing_solicitud"],
												$row["dt_inicio_gestion"],
												$row["dt_fin_gestion"],
												$row["observacion"]);
					$count++;
				}
			}
			return $petcionDtl;
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



		public function getInformeST($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select id,date_format(report_dt,'%Y%m%d') report_dt,ciclos,contacto,desde,hasta,hora_viaje,
					validado,recibe,trabajo_terminado
					from p_informe_servicio_tecnico mp where mp.peticion_id='".$id_peticion."'";
			$reportDtl=array();
			$count=0;
			//echo 'sql:'.$sql.'<br>';
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$report_id=$row["report_dt"].'-00-'.str_pad($row["id"], 10,"0",STR_PAD_LEFT);
					$reportDtl[$count] = array($report_id,$row["id"],$row["report_dt"],$row["ciclos"],$row["contacto"],$row["desde"],
						$row["hasta"],$row["hora_viaje"],$row["validado"],$row["recibe"],$row["trabajo_terminado"]);
					$count++;
				}
			}
			else
			{
				$sql="insert into p_informe_servicio_tecnico(peticion_id,report_dt) values('".$id_peticion."',now())";
				if(mysqli_query($dbcon,$sql))
				{
					$sql="select id,date_format(report_dt,'%Y%m%d') report_dt,ciclos,contacto,desde,hasta,hora_viaje,
					validado,recibe,trabajo_terminado
					from p_informe_servicio_tecnico mp where mp.peticion_id='".$id_peticion."'";
					$reportDtl=array();
					$count=0;
					$result = mysqli_query($dbcon,$sql);
		            if(mysqli_num_rows($result) > 0)  
		            {
						while($row = mysqli_fetch_assoc($result)) 
						{
							$report_id=$row["report_dt"].'-00-'.str_pad($row["id"], 10,"0",STR_PAD_LEFT);
							$reportDtl[$count] = array($report_id,$row["id"],$row["report_dt"],$row["ciclos"],$row["contacto"],$row["desde"],
								$row["hasta"],$row["hora_viaje"],$row["validado"],$row["recibe"],$row["trabajo_terminado"]);
							$count++;
						}
					}
				}
			}
			return $reportDtl;
		}

		public function updateInformeST($dbcon,$id,$id_peticion,$ciclos,$contacto,$desde,$hasta,$horaViaje,$validado,$recibe,$terminada,$DEBUG_STATUS)
		{
			$sql="update p_informe_servicio_tecnico set ciclos='".$ciclos."',contacto='".$contacto."',desde='".$desde."',hasta='".$hasta."',hora_viaje='".$horaViaje."',validado=".$validado.",recibe='".$recibe."',trabajo_terminado=".$terminada.",report_dt=now(),created_by=".$_SESSION["user_id"].",fecha_modificacion=now() where id=".$id;
			//echo 'sql:'.$sql.'<br>';
			$updStatus=0;
			if(mysqli_query($dbcon,$sql))
			{
				$updStatus=1;
			}
			return $updStatus;
		}

		public function updateInformeSTPartes($dbcon,$id_peticion,$nombre,$cantidad,$pdesc,$DEBUG_STATUS)
		{
			$sql="insert into p_informe_st_partes(id,nombre_parte,cantidad_parte,desc_parte) values('".$id_peticion."','".$nombre."',".$cantidad.",'".$pdesc."')";
			$updStatus=0;
			if(mysqli_query($dbcon,$sql))
			{
				$updStatus=1;
			}
			return $updStatus;
		}

		public function getInformeSTPartes($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			$sql="select nombre_parte,cantidad_parte,desc_parte from p_informe_st_partes p where p.id='".$id_peticion."'";
			$reportDtl=array();
			$count=0;
			//echo 'sql:'.$sql.'<br>';
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					
					$reportDtl[$count] = array($row["nombre_parte"],$row["cantidad_parte"],$row["desc_parte"]);
					$count++;
				}
			}
			//echo 'count:'.$count.'<br>';
			return $reportDtl;
		}

		public function getDetallesForInformeST($dbcon,$id_peticion,$DEBUG_STATUS)
		{
			/*$sql="select ps.id,pu.nombre tecnico,pcd.NOMBRE ciudad,pc.nombre cliente,pe.nombre equipo,pe.serie,pp.observacion,date_format(now(),'%Y-%m-%d') fecha_actual,
					(select ts.`desc` from p_tipo_servicios ts where ts.id=ps.service_id) service
					from p_solicitud ps,p_usuario pu,p_clientes pc,p_equipos_solicitud pes,p_ciudad pcd,p_peticion_comments pp,p_equipos pe
					where ps.id=pes.nro_solicitud and ps.id=pp.id and ps.id_tecnico=pu.id and ps.ciudad_id=pcd.ID and ps.client_id=pc.id and pes.equipo_id=pe.id
					and pp.estado=3 and ps.id='".$id_peticion."'";*/
			$sql="select ps.id,pu.nombre tecnico,pcd.NOMBRE ciudad,pc.nombre cliente,
					(select pe.nombre from p_equipos pe,p_equipos_solicitud pes where pe.id=pes.equipo_id and pes.nro_solicitud=ps.id) equipo,
					(select pe.serie from p_equipos pe,p_equipos_solicitud pes where pe.id=pes.equipo_id and pes.nro_solicitud=ps.id) serie,
					pp.observacion,date_format(now(),'%Y-%m-%d') fecha_actual,
					(select ts.`desc` from p_tipo_servicios ts where ts.id=ps.service_id) service
					from p_solicitud ps,p_usuario pu,p_clientes pc,p_ciudad pcd,p_peticion_comments pp
					where ps.id=pp.id and ps.id_tecnico=pu.id and ps.ciudad_id=pcd.ID and ps.client_id=pc.id
					and pc.habilitado=1 and pp.estado=3 and ps.id='".$id_peticion."'";
			$reportDtl=array();
			$count=0;
			//echo 'sql:'.$sql.'<br>';
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					
					$reportDtl[$count] = array($row["id"],$row["tecnico"],$row["ciudad"],$row["cliente"],$row["equipo"],
						$row["serie"],$row["observacion"],$row["fecha_actual"],$row["service"]);
					$count++;
				}
			}
			//echo 'count:'.$count.'<br>';
			return $reportDtl;
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
						//echo 'sql1:'.$sql.'<br>';
						if(mysqli_query($dbcon,$sql))
				        {
				        	if($estado_id==3)
				        	{
					        	$sql="update p_equipos set in_gestion=0 where id=".$equipos[$t][0];
					        	//echo 'sql2:'.$sql.'<br>';
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
				//echo 'sql3:'.$sql.'<br>';
				if(mysqli_query($dbcon,$sql))
		        {
		        	if($estado_id==3)
		        	{
			        	$sql="update p_equipos set in_gestion=0 where id=".$equipo_id;
			        	//echo 'sql4:'.$sql.'<br>';
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
				//echo 'sql5:'.$sql.'<br>';
				if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus++;
		        }
			}
			//echo '<br><br><br>updStatus:'.$updStatus.'<br>';
			//echo 'ctr:'.$ctr.'<br>';
			if($updStatus==$ctr)
			{
    			$sql="UPDATE p_solicitud set estado=".$estado_id." where id ='".$peticion_id."'";
	        	//echo 'sql6:'.$sql.'<br>';
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
	        //echo 'updStatus:'.$updStatus.'<br>';
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
	        	//echo $sql.'<br>';
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
	        //echo 'updStatus:'.$updStatus.'<br>';
    		return $updStatus;
		}

		//9-1,
		/*public function getUsersBySala($dbcon,$ciudad_id,$sucursal_id,$sala_id,$DEBUG_STATUS)
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
		}*/

		public function getUsersBySala($dbcon,$ciudad_id,$sucursal_id,$sala_id,$DEBUG_STATUS)
		{
			$sql="select pu.id,pu.nombre from p_usuario pu where pu.ciudad_id=".$ciudad_id." and pu.habilitado=1 ";
			if(!empty($sucursal_id) && $sucursal_id!=99)
				$sql=$sql." and pu.sucursal=".$sucursal_id;
			if(!empty($sala_id) && $sala_id!=99)
				$sql=$sql." and pu.sala=".$sala_id;
			if($_SESSION["user_perfil"]==28 || $_SESSION["user_perfil"]==29)////Fase3-change perfil id::42
				$sql=$sql." and pu.perfil_id=".$_SESSION["user_perfil"];
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

		public function uploadPdfInWeb($dbcon,$peticion_id,$DEBUG_STATUS)
		{
			$sql="update p_solicitud set  fecha_modificacion=now(), modificado_por_usuario=".$_SESSION["user_id"]." where id='".$peticion_id."'";
			$updStatus=1;
			if(mysqli_query($dbcon,$sql))
			{	
				/*-----START OF EMAIL-----*/
	        	$client_admin_emails='';
				$client_id = 0;

	        	$sql="select s.client_id from p_solicitud s where s.id='".$peticion_id."'";
	        	$result = mysqli_query($dbcon,$sql);
	            if(mysqli_num_rows($result) > 0)  
	            {
					if($row = mysqli_fetch_assoc($result)) 
					{
						$client_id = $row["client_id"];
						$sql2="select u.email from p_usuario u where u.client_id=".$client_id." and u.perfil_id=2";
						$result2 = mysqli_query($dbcon,$sql2);
			            if(mysqli_num_rows($result2) > 0)  
			            {
							while($row2 = mysqli_fetch_assoc($result2)) 
							{
								$client_admin_emails = $client_admin_emails.','.$row2["email"];
							}
						}
					}
				}

				
	        	$to = $client_admin_emails;
				$subject = 'SISTEC NIPRO- CIERRE DE PETICION';
				$txt = '¡HOLA!'."<br><br>";
				$txt=$txt.'La solicitud '.$peticion_id.' fue atendida y cerrada'."<br><br>";
				$txt=$txt.'Para visualizar el informe, haga click en siguiente link:'."<br><br>";
				//$txt=$txt.'http://sistec.hutesol.com/pdf/'.$peticion_id.'.pdf'."<br><br>";
				$txt=$txt.'http://sistececuador.com/pdf/'.$peticion_id.'.pdf'."<br><br>";
				$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en fernandoa@nipromed.com'."<br><br>";
				$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";
				$txt=$txt.'El Equipo de Nipro Medical Ecuador'."<br><br>";
				$txt=$txt.'Por favor ingresar a <br>www.sistececuador.com'."<br><br>";

				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
				/*$headers .= 'From:info@hutesol.com' . "\r\n";
				$headers .= 'CC: olguercalvache@gmail.com';*/
				$headers .= 'From:SISTEC NIPRO <portal@sistececuador.com>' . "\r\n";
				$headers .= 'CC: fernandoa@nipromed.com';

				$res=mail($to,$subject,$txt,$headers);
				
				/*-----END OF EMAIL-----*/
				$updStatus=0;
			}
			return $updStatus;
		}		


		public function addEquipoParaPeticionDeInstalacion($dbcon,$id_peticion,$nombre,$modelo,$marca,$serie,$DEBUG_STATUS)
		{
			$sql="select id from p_equipos where serie='".strtoupper($serie)."'";
			//echo $sql;
			$updStatus=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {			
				$sql="insert into p_equipos(nombre,modelo,marca,serie,client_id,ciudad_id,sucursal_id,sala_id,habilitado,in_gestion,fecha_creacion,creado_por_usuario,fecha_modificacion,modificado_por_usuario)   
						(select '".strtoupper($nombre)."','".strtoupper($modelo)."','".strtoupper($marca)."','".strtoupper($serie)."',s.client_id,s.ciudad_id,s.sucursal_id,s.sala_id,1,0,now(),".$_SESSION["user_id"].",now(),".$_SESSION["user_id"]."  
							from p_solicitud s where s.id='".$id_peticion."')";
				if(mysqli_query($dbcon,$sql))
				{
					$equipo_id = mysqli_insert_id($dbcon);
					$sql="insert into p_equipos_solicitud(nro_solicitud,equipo_id) values('".$id_peticion."',".$equipo_id.")";
					if(mysqli_query($dbcon,$sql))
					{
						$updStatus=3;
					}
					else
						$updStatus=2;
				}
				else
					$updStatus=1;
			}
			else
				$updStatus=0;

			return $updStatus;
		}

		//Fase3-change perfil id::42
		public function getTecnicos($dbcon,$DEBUG_STATUS)
		{
			$sql="select id, nombre from p_usuario where perfil_id in (28,29) and habilitado=1 order by nombre";
			$tecnicos=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tecnicos[$count] = array($row["id"],$row["nombre"]);
					$count++;
				}
			}
			return $tecnicos;
		}

		//Fase3-change perfil id::42
		public function getTecnicosByClientType($dbcon,$client_type,$DEBUG_STATUS)
		{
			if($client_type==1)
				$sql="select id, nombre from p_usuario where perfil_id in (29) and habilitado=1 order by nombre";
			else if($client_type==2)
				$sql="select id, nombre from p_usuario where perfil_id in (28) and habilitado=1 order by nombre";
			else
				$sql="select id, nombre from p_usuario where perfil_id in (28,29) and habilitado=1 order by nombre";
			$tecnicos=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tecnicos[$count] = array($row["id"],$row["nombre"]);
					$count++;
				}
			}
			return $tecnicos;
		}

		//Fase3-change perfil id
		public function getTecnicosPlan($dbcon,$DEBUG_STATUS)
		{
			$sql="select us.id,us.nombre user_name from p_sucursal su,p_clientes cl,p_ciudad ci,p_usuario us
					where su.id_tecnico=us.id and su.ciudad_id=ci.ID and cl.habilitado=1 and ci.id_cliente=cl.id and us.perfil_id in (28,29)";
			if($_SESSION["client_id"]>1)
				$sql=$sql." and cl.id=".$_SESSION["client_id"];
			$sql=$sql." and us.habilitado=1 order by us.nombre";
			
			$tecnicos=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tecnicos[$count] = array($row["id"],$row["user_name"]);
					$count++;
				}
			}
			return $tecnicos;
		}

		//Fase3-change perfil id
		public function getPlanificaciones($dbcon,$client_id,$tecnico_id,$DEBUG_STATUS)
		{
			$sql="select file_name_fisico, file_name_uploaded,
				(select nombre from p_clientes where id=client_id and habilitado=1) client_id,
				(select nombre from p_usuario where id=modified_by) modified_by,
				fecha_modificacion
				from p_planificaciones where habilitado=1";
			if($_SESSION["client_id"]==1 && $_SESSION["user_perfil"]<=2)
			{
				if($client_id!=99)
					$sql=$sql." and client_id=".$client_id;
				if($tecnico_id!=99)
					$sql=$sql." and modified_by=".$tecnico_id;
			}
			else if($_SESSION["client_id"]==1 && $_SESSION["user_perfil"]>2)
			{
				if($client_id!=99)
					$sql=$sql." and client_id=".$client_id;
				$sql=$sql." and modified_by=".$_SESSION["user_id"];
			}
			else if($_SESSION["client_id"]>1)
			{
				$sql=$sql." and client_id=".$_SESSION["client_id"];
				if($tecnico_id!=99)
					$sql=$sql." and modified_by=".$tecnico_id;
			}

			//echo $sql;
			$plan=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$plan[$count] = array(	$row["file_name_fisico"],
											$row["file_name_uploaded"],
											$row["client_id"],
											$row["modified_by"],
											$row["fecha_modificacion"]);
					$count++;
				}
			}
			return $plan;
		}

		//Fase3-change perfil id
		public function getPlanificacionClientes($dbcon,$DEBUG_STATUS)
		{
			$sql="SELECT DISTINCT cl.id client_id, cl.nombre client_name FROM p_solicitud ps, p_clientes cl
					WHERE ps.client_id=cl.id and cl.habilitado=1 ";
			if($_SESSION["client_id"]>1)
				$sql=$sql." and cl.id=".$_SESSION["client_id"]." order by cl.nombre";
			else if($_SESSION["client_id"]==1 && $_SESSION["user_perfil"]<=2)
				$sql=$sql." order by cl.nombre";
			else if($_SESSION["client_id"]==1 && ($_SESSION["user_perfil"]==28 || $_SESSION["user_perfil"]==29))
				$sql=$sql." and ps.id_tecnico=".$_SESSION["user_id"]." order by cl.nombre";
			$clients=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$clients[$count] = array($row["client_id"],$row["client_name"]);
					$count++;
				}
			}
			return $clients;
		}

		//Fase3-change perfil id
		public function getPlanificacionTecnicos($dbcon,$client_id,$DEBUG_STATUS)
		{
			$sql="SELECT distinct pu.id id_tecnico,pu.nombre tecnico_name from p_solicitud ps, p_usuario pu
					where ps.id_tecnico=pu.id  and pu.perfil_id in(28,29)";
			if($_SESSION["client_id"]==1 && ($_SESSION["user_perfil"]==28 || $_SESSION["user_perfil"]==29))
				$sql=$sql." and ps.id_tecnico=".$_SESSION["user_id"];
			else if($client_id!=99)
				$sql=$sql." and ps.client_id=".$client_id." order by pu.nombre";
			//echo $sql.'<br>';
			$tecnicos=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tecnicos[$count] = array($row["id_tecnico"],$row["tecnico_name"]);
					$count++;
				}
			}
			return $tecnicos;
		}

		//Fase3-change perfil id
		public function getClientesParReportes($dbcon,$DEBUG_STATUS)
		{
			//$sql="select id, nombre from p_clientes where habilitado=1 order by nombre";
			$sql="select id, nombre from p_usuario where habilitado=1 and perfil_id in(28,29) order by nombre";
			$clientes=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$clientes[$count] = array($row["id"],$row["nombre"]);
					$count++;
				}
			}
			return $clientes;
		}

		//Fase3-change perfil id
		/*public function showReport1($dbcon,$client_id,$estado,$dt_ini,$dt_fin,$DEBUG_STATUS)
		{
			//REPORT 1
			echo 'dt_ini:'.$dt_ini.'<br>';
			echo 'dt_fin:'.$dt_fin.'<br>';
			//$sql="select round(datediff('".$dt_fin."','".$dt_ini."')/30,0) total_meses from dual";
			$sql="select period_diff(date_format('".$dt_fin."','%Y%m'),date_format('".$dt_ini."','%Y%m')) total_meses from dual";
			$total_meses=0;
			$strUsers='{"id":"","label":"A","pattern":"","type":"string"}';
			$strData="";
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result)) 
				{
					$total_meses=$row["total_meses"];
					echo 'total meses:'.$total_meses.'<br>';
					$clientes=array();
					$count=0;
					for($x=0;$x<=$total_meses;$x++)
					{
						$strTemp="";
						$sqlPeriod = "select date_format(date_add(date_format('".$dt_ini."','%Y%m%d'),interval ".$x." month),'%b %Y') period from dual";
						$resultPeriod = mysqli_query($dbcon,$sqlPeriod);
			            if(mysqli_num_rows($resultPeriod) > 0)  
			            {
							if($rowPeriod = mysqli_fetch_assoc($resultPeriod)) 
							{
								$period=$rowPeriod["period"];
							}
						}
						$strTemp=$strTemp.'{"c":[{"v":"'.$period.'","f":null}';
						$sqlUsers= "select id user_id,nombre user_name from p_usuario p where p.perfil_id=42 
						and p.client_id=1 
						order by user_name";
						$resultUsers = mysqli_query($dbcon,$sqlUsers);
			            if(mysqli_num_rows($resultUsers) > 0)  
			            {
							while($rowUsers = mysqli_fetch_assoc($resultUsers)) 
							{
								if($x==0)
								{
									$strUsers=$strUsers.',{"id":"","label":"'.$rowUsers["user_name"].'","pattern":"","type":"number"}';
								}

								$sql="select date_format(ps.fecha_creacion,'%b %Y') periodo,'".$rowUsers["user_name"]."',count(*) ctr 
								from p_solicitud ps where  ps.id_tecnico=".$rowUsers["user_id"]." and 
								date_format(ps.fecha_creacion,'%Y%m')=date_format(date_add(date_format('".$dt_ini."','%Y%m%d'),interval ".$x." month),'%Y%m') and ps.estado=".$estado." 
								group by date_format(ps.fecha_creacion,'%Y%m') 
								order by date_format(ps.fecha_creacion,'%Y%m')";
								//echo 'sql:'.$sql.'<br>';
								$result = mysqli_query($dbcon,$sql);
					            if(mysqli_num_rows($result) > 0)  
					            {
									while($row = mysqli_fetch_assoc($result)) 
									{
										$strTemp=$strTemp.',{"v":'.$row["ctr"].',"f":null}';
										$count++;
									}
								}
								else
								{
									$strTemp=$strTemp.',{"v":0,"f":null}';
								}
							}
							$strTemp=$strTemp.']},';
						}
						$strData=$strData.'"rows": ['.$strTemp.']';
					}
				}
			}
			$strUsers='"cols": ['.$strUsers.']';
			return '{'.$strMeses.$strData.'}';
			
		}

		public function showReport2($dbcon,$client_id,$estado,$dt_ini,$dt_fin,$DEBUG_STATUS)
		{
			//REPORT 2
			echo 'dt_ini:'.$dt_ini.'<br>';
			echo 'dt_fin:'.$dt_fin.'<br>';
			$strHeader="['USUARIO', 'Abierto', 'En Curso', 'Cerrada',{ role: 'style' },{ role: 'style' },{ role: 'style' }]";
			$strData="";
			$clientes=array();
			$count=0;					
			$sqlUsers= "select id user_id,nombre user_name from p_usuario p where p.perfil_id=42 and p.client_id=1 order by user_name";
			$resultUsers = mysqli_query($dbcon,$sqlUsers);
            if(mysqli_num_rows($resultUsers) > 0)  
            {
				while($rowUsers = mysqli_fetch_assoc($resultUsers)) 
				{
					$strTemp="'".$rowUsers["user_name"]."'";
					for($j=1;$j<=3;$j++)
					{
						$sql="select ps.id_tecnico,count(*) ctr from p_solicitud ps 
						where date_format(ps.fecha_creacion,'%Y%m')>=date_format('".$dt_ini."','%Y%m')
						and date_format(ps.fecha_creacion,'%Y%m')<=date_format('".$dt_fin."','%Y%m') 
						and estado=".$j." and ps.id_tecnico=".$rowUsers["user_id"]." group by ps.id_tecnico order by ps.id_tecnico";
						//echo 'sql:'.$sql.'<br>';
						$result = mysqli_query($dbcon,$sql);
			            if(mysqli_num_rows($result) > 0)  
			            {
							while($row = mysqli_fetch_assoc($result)) 
							{
								$strTemp=$strTemp.",'".$row["ctr"]."'";									
							}
						}
						else
						{
							$strTemp=$strTemp.",'0'";
						}
					}
					$strData=$strData.',['.$strTemp.']';
					$count++;
				}
			}
			
			//$strUsers='['.$strUsers.']';
			echo 'strUsers:'.$strHeader.'<br>';
			echo 'strData:'.$strData.'<br>';
			echo '<br>';
			return $strMeses.$strData;
		}*/

		public function showReport3($dbcon,$client_id,$estado,$dt_ini,$dt_fin,$DEBUG_STATUS)
		{

			//REPORT 3
			$tipo_cliente=2;
			//echo 'dt_ini:'.$dt_ini.'<br>';
			//echo 'dt_fin:'.$dt_fin.'<br>';
			$strHeader="['Clientes', 'Nro']";
			$strData="";
			$clientes=array();
			$count=0;	
			$total=0;				
			//$strTemp="";
			$sql="select pc.nombre client_name,count(*) ctr from p_solicitud ps,p_clientes pc where ps.client_id=pc.id and pc.habilitado=1 
				and date_format(ps.fecha_creacion,'%Y%m')>=date_format('".$dt_ini."','%Y%m')
				and date_format(ps.fecha_creacion,'%Y%m')<=date_format('".$dt_fin."','%Y%m') 
				and pc.tipo_cliente=".$tipo_cliente." and ps.estado=".$estado." 
				group by client_name
				order by client_name";
			//echo 'sql:'.$sql.'<br>';
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$clientes[$count] = array($row["client_name"],$row["ctr"]);
					$total=$total+$row["ctr"];
					$count++;
					
				}
			}
			//echo print_r($clientes).'<br>';

			for($x=0;$x<count($clientes);$x++)
			{
				$strData=$strData.",['".$clientes[$x][0]."','".round($clientes[$x][1]*100/$total,2)."']";									
			}

			//$strUsers='['.$strUsers.']';
			//echo 'strUsers:'.$strHeader.'<br>';
			//echo 'strData:'.$strData.'<br>';
			//echo '<br>';

			return $strMeses.$strData;
			
		}

		public function showReport4($dbcon,$client_id,$estado,$dt_ini,$dt_fin,$DEBUG_STATUS)
		{

			//REPORT 4
			//echo 'dt_ini:'.$dt_ini.'<br>';
			//echo 'dt_fin:'.$dt_fin.'<br>';

			$total_meses=0;
			$strMeses="'Clientes'";
			$strData="";
			$iterrator=0;
			$sqlClientes= "select id client_id,nombre client_name from p_clientes pc where pc.id>1 and pc.habilitado=1 order by pc.nombre";
			$resultClientes = mysqli_query($dbcon,$sqlClientes);
			if(mysqli_num_rows($resultClientes) > 0)  
            {
            	while($rowClientes = mysqli_fetch_assoc($resultClientes)) 
				{
					$iterrator++;
					$clientName = $rowClientes["client_name"];
					$client = $rowClientes["client_id"];
		            $strData = $strData.",['".$clientName."'";

					$sql="select period_diff(date_format('".$dt_fin."','%Y%m'),date_format('".$dt_ini."','%Y%m')) total_meses from dual";
					
					$result = mysqli_query($dbcon,$sql);
		            if(mysqli_num_rows($result) > 0)  
		            {
						if($row = mysqli_fetch_assoc($result)) 
						{
							$clientes=array();
							$count=0;
							$strTemp="";
							$total_meses=$row["total_meses"];
							for($x=0;$x<=$total_meses;$x++)
							{
								$sqlMes = "select date_format(date_add(date_format('".$dt_ini."','%Y%m%d'),interval ".$x." month),'%b %Y') period from dual";
								$resultMes = mysqli_query($dbcon,$sqlMes);
					            if(mysqli_num_rows($resultMes) > 0)  
					            {
									if($rowMes = mysqli_fetch_assoc($resultMes)) 
									{
										$period= $rowMes["period"];
									}
								}
								if($iterrator<=1)
									$strMeses = $strMeses.",'".$period."'";

																				
								$sql="select ps.client_id,count(*) ctr from p_solicitud ps
								where date_format(ps.fecha_creacion,'%Y%m')=date_format(date_add(date_format('".$dt_ini."','%Y%m%d'),interval ".$x." month),'%Y%m') 
								and ps.estado=".$estado." and ps.client_id=".$client."
								group by ps.client_id";
								//echo 'sql:'.$sql.'<br>';
								$result = mysqli_query($dbcon,$sql);
					            if(mysqli_num_rows($result) > 0)  
					            {
									if($row = mysqli_fetch_assoc($result)) 
									{
										$strTemp=$strTemp.",".$row["ctr"];
										$count++;
									}
								}
								else
								{
									$strTemp=$strTemp.",0";
								}						
							}
							$strData=$strData.$strTemp."]";
						}
					}
				}
			}
			$strMeses='['.$strMeses.']';
			//echo 'strMeses:'.$strMeses.'<br>';
			//echo 'strData:'.$strData.'<br>';
			//echo '<br>';
			return $strMeses.$strData;
		}

		public function uploadPlanInWeb($dbcon,$client_id,$fileNameUploaded,$target_file,$DEBUG_STATUS)
		{
			$updStatus=1;
			$sql="select * from p_planificaciones where file_name_fisico = '".$target_file."' and habilitado=1";
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				$sql="update p_planificaciones set habilitado=0, fecha_modificacion=now(), modified_by=".$_SESSION["user_id"]." where file_name_fisico = '".$target_file."' and habilitado=1";
				$updStatus=1;
				if(mysqli_query($dbcon,$sql))
				{	
					$updStatus=0;
				}
				return $updStatus;
			}
			else
			{
				$sql="insert into p_planificaciones(file_name_fisico,file_name_uploaded,client_id,fecha_creacion,created_by,habilitado,fecha_modificacion,modified_by)
					values('".$target_file."','".$fileNameUploaded."',".$client_id.",now(),".$_SESSION["user_id"].",1,now(),".$_SESSION["user_id"].")";
				$updStatus=1;
				if(mysqli_query($dbcon,$sql))
				{	
					$updStatus=0;
				}
				return $updStatus;
			}
		}

		public function getReport4ClientsData($dbcon,$client,$DEBUG_STATUS)
		{
			$sql="select distinct pc.id client_id,pc.nombre client_name from p_solicitud ps,p_clientes pc where ps.client_id=pc.id and pc.habilitado=1 and ps.id_tecnico=".$client;
			$clientes=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$clientes[$count] = array($row["client_id"],$row["client_name"]);
					$count++;
				}
			}
			return $clientes;
		}


		public function getAllServicios($dbcon,$DEBUG_STATUS)
		{
			$sql="select ts.id,ts.desc from p_tipo_servicios ts where ts.habilitado=1";
			$servicios=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$servicios[$count] = array($row["id"],$row["desc"]);
					$count++;
				}
			}
			return $servicios;
		}


		public function getClientesEnBaseDelServicio($dbcon,$serviceId,$DEBUG_STATUS)
		{
			if($serviceId==6)
				$sql="select c.id,c.nombre from p_clientes c where c.habilitado=1 and c.tipo_cliente=2 and id>1";
			else if($serviceId==7)
				$sql="select c.id,c.nombre from p_clientes c where c.habilitado=1 and c.tipo_cliente=1 and id>1";
			else
				$sql="select c.id,c.nombre from p_clientes c where c.habilitado=1 and id>1";
			$clientes=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$clientes[$count] = array($row["id"],$row["nombre"]);
					$count++;
				}
			}
			return $clientes;
		}

		public function manageSpecialCaracter($word) 
		{
		    $word = str_replace("@","%40",$word);
		    $word = str_replace("`","%60",$word);
		    $word = str_replace("¢","%A2",$word);
		    $word = str_replace("£","%A3",$word);
		    $word = str_replace("¥","%A5",$word);
		    $word = str_replace("|","%A6",$word);
		    $word = str_replace("«","%AB",$word);
		    $word = str_replace("¬","%AC",$word);
		    $word = str_replace("¯","%AD",$word);
		    $word = str_replace("º","%B0",$word);
		    $word = str_replace("±","%B1",$word);
		    $word = str_replace("ª","%B2",$word);
		    $word = str_replace("µ","%B5",$word);
		    $word = str_replace("»","%BB",$word);
		    $word = str_replace("¼","%BC",$word);
		    $word = str_replace("½","%BD",$word);
		    $word = str_replace("¿","%BF",$word);
		    $word = str_replace("À","%C0",$word);
		    $word = str_replace("Á","%C1",$word);
		    $word = str_replace("Â","%C2",$word);
		    $word = str_replace("Ã","%C3",$word);
		    $word = str_replace("Ä","%C4",$word);
		    $word = str_replace("Å","%C5",$word);
		    $word = str_replace("Æ","%C6",$word);
		    $word = str_replace("Ç","%C7",$word);
		    $word = str_replace("È","%C8",$word);
		    $word = str_replace("É","%C9",$word);
		    $word = str_replace("Ê","%CA",$word);
		    $word = str_replace("Ë","%CB",$word);
		    $word = str_replace("Ì","%CC",$word);
		    $word = str_replace("Í","%CD",$word);
		    $word = str_replace("Î","%CE",$word);
		    $word = str_replace("Ï","%CF",$word);
		    $word = str_replace("Ð","%D0",$word);
		    $word = str_replace("Ñ","%D1",$word);
		    $word = str_replace("Ò","%D2",$word);
		    $word = str_replace("Ó","%D3",$word);
		    $word = str_replace("Ô","%D4",$word);
		    $word = str_replace("Õ","%D5",$word);
		    $word = str_replace("Ö","%D6",$word);
		    $word = str_replace("Ø","%D8",$word);
		    $word = str_replace("Ù","%D9",$word);
		    $word = str_replace("Ú","%DA",$word);
		    $word = str_replace("Û","%DB",$word);
		    $word = str_replace("Ü","%DC",$word);
		    $word = str_replace("Ý","%DD",$word);
		    $word = str_replace("Þ","%DE",$word);
		    $word = str_replace("ß","%DF",$word);
		    $word = str_replace("à","%E0",$word);
		    $word = str_replace("á","%E1",$word);
		    $word = str_replace("â","%E2",$word);
		    $word = str_replace("ã","%E3",$word);
		    $word = str_replace("ä","%E4",$word);
		    $word = str_replace("å","%E5",$word);
		    $word = str_replace("æ","%E6",$word);
		    $word = str_replace("ç","%E7",$word);
		    $word = str_replace("è","%E8",$word);
		    $word = str_replace("é","%E9",$word);
		    $word = str_replace("ê","%EA",$word);
		    $word = str_replace("ë","%EB",$word);
		    $word = str_replace("ì","%EC",$word);
		    $word = str_replace("í","%ED",$word);
		    $word = str_replace("î","%EE",$word);
		    $word = str_replace("ï","%EF",$word);
		    $word = str_replace("ð","%F0",$word);
		    $word = str_replace("ñ","%F1",$word);
		    $word = str_replace("ò","%F2",$word);
		    $word = str_replace("ó","%F3",$word);
		    $word = str_replace("ô","%F4",$word);
		    $word = str_replace("õ","%F5",$word);
		    $word = str_replace("ö","%F6",$word);
		    $word = str_replace("÷","%F7",$word);
		    $word = str_replace("ø","%F8",$word);
		    $word = str_replace("ù","%F9",$word);
		    $word = str_replace("ú","%FA",$word);
		    $word = str_replace("û","%FB",$word);
		    $word = str_replace("ü","%FC",$word);
		    $word = str_replace("ý","%FD",$word);
		    $word = str_replace("þ","%FE",$word);
		    $word = str_replace("ÿ","%FF",$word);
		    return urldecode($word);
		}





	}
?>