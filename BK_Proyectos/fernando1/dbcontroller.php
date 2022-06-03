<?php
	//session_start();
	class controller
	{
		public function loginUser($dbcon,$user_id,$user_password,$DEBUG_STATUS)
		{
			$sql="select u.user_id,u.user_name,u.user_apellido, u.user_email,u.id_grupo,g.descripcion_grupo from usuarios u, grupos g 
					where u.user_id='".$user_id."' and u.password='".$user_password."' and u.id_grupo=g.id_group";
			////echo $sql.'<br>';
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
			//$usr=array();
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {            	
            	if($row = mysqli_fetch_assoc($result)) 
            	{
					$userId = $row["user_id"];
					$userName=$row["user_name"].' '.$row["user_apellido"];
					$userPerfil=$row["id_grupo"];
					$userEmail=$row["user_email"];
            	}

	        	$sql = "update usuarios set en_uso=1 where user_id = '".$user_id."' and password='".$user_password."'";
				////echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);		        	
		            $updStatus = 1;
		        	$_SESSION["user_id"]=$userId;
		        	$_SESSION["user_name"]=$userName;
		        	$_SESSION["user_perfil"]=$userPerfil;
					$_SESSION["user_email"]=$userEmail;
		            $_SESSION['LAST_ACTIVITY'] = time();
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

		public function recuperarClave($dbcon,$user_id,$DEBUG_STATUS)
		{
			$sql="select id,nombre,password from p_usuario u where u.email = '".$user_id."'";
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
					$txt = '¡HOLA, '.$nombre.'!'."<br><br>";
					$txt=$txt.'Se ha solicitado recuperar la clave para su cuenta en SISTEC'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.$user_email.' con siguiente clave para iniciar sesión'."<br><br>";
					$txt=$txt.'CLAVE:'.$clave."<br><br>";
					$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en support@sistec.com'."<br><br>";
					$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";
					$txt=$txt.'El Equipo de Nipro Medical Ecuador'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					$headers .= 'From:info@hutesol.com' . "\r\n";
					$headers .= 'CC: olguercalvache@gmail.com';

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
					$txt = '¡HOLA, '.$nombre.'!'."<br><br>";
					$txt=$txt.'Se ha solicitado cambiar la clave para su cuenta en SISTEC'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.$_SESSION["user_email"].' con siguiente clave para iniciar sesión'."<br><br>";
					$txt=$txt.'CLAVE:'.$clave_nuevo."<br><br>";
					$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en support@sistec.com'."<br><br>";
					$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";
					$txt=$txt.'El Equipo de Nipro Medical Ecuador'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					$headers .= 'From:info@hutesol.com' . "\r\n";
					$headers .= 'CC: olguercalvache@gmail.com';

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
									$txt = '¡HOLA, '.strtoupper($admin_name).'!'."<br><br>";
									$txt=$txt.'Gracias por crear su cuenta en SISTEC'."<br><br>";
									$txt=$txt.'Usa la dirección de correo electrónico '.strtoupper($client_email).' y tu clave ingresada el momento del registro para iniciar sesión.'."<br><br>";
									$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en support@sistec.com'."<br><br>";
									$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";
									$txt=$txt.'El Equipo de Nipro Medical Ecuador'."<br><br>";

									$headers = 'MIME-Version: 1.0' . "\r\n";
									$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
									$headers .= 'From:info@hutesol.com' . "\r\n";
									$headers .= 'CC: olguercalvache@gmail.com';

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

		public function getUserList($dbcon,$apply_pagination,$current_page,$products_per_page,$strBusqueda,$DEBUG_STATUS)
		{
			if($apply_pagination==1)	
			{
				$sql="select u.user_id,u.user_name,u.user_apellido, u.user_email,u.celular,u.fecha_cumpleanos from usuarios u";
				if($strBusqueda!=null)
					$sql=$sql." where u.user_id like'%".$strBusqueda."%'";
				$sql=$sql." order by u.user_name asc limit ".$current_page*$products_per_page.",".$products_per_page;
			}
			else
			{
				$sql="select u.user_id,u.user_name,u.user_apellido, u.user_email,u.celular,u.fecha_cumpleanos from usuarios u";
				if($strBusqueda!=null)
					$sql=$sql." where u.user_id like'%".$strBusqueda."%'";
				$sql=$sql." order by u.user_name asc";
			}
			$updStatus=0;
			$entidad=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {            	
            	while($row = mysqli_fetch_assoc($result)) 
            	{
					$entidad[$count] = array($row["user_id"],$row["user_name"],$row["user_apellido"],$row["user_email"],$row["celular"],$row["fecha_cumpleanos"]);
					$count++;
            	}	
            }
            return $entidad;			
		}


		public function addUser($dbcon,$user_id,$user_nombre,$user_apellido,$user_email,$user_celular,$nacimiento,$DEBUG_STATUS)
		{
			$sql="select u.user_id,u.user_name,u.user_apellido, u.user_email,u.celular,u.fecha_cumpleanos from usuarios u 
					where u.user_id ='".$user_id."'";
			$user_clave=mt_rand();
			$updStatus=0;
			$id=0;
			$nombre='';
			$password='';
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {            	
            	$sql = "insert into usuarios(user_id,password,user_name,user_apellido,user_email,celular,fecha_registro,fecha_cumpleanos,id_grupo) 
            				values('".$user_id."','".$user_clave."','".$user_nombre."','".$user_apellido."','".$user_email."','".$user_celular."',now(),DATE_FORMAT('".$nacimiento."','%Y-%m-%d'),3)";
				//echo 'SQL:'.$sql.'<br>';
				if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;			        

					/*$to = $user_email;
					$subject = 'BUSHIDO - CREACION DE RECURSO';
					$txt = '¡HOLA, '.$user_nombre.' '.$user_apellido.'!'."<br><br>";
					$txt=$txt.'Se ha creado su cuenta en BUSHIDO'."<br><br>";
					$txt=$txt.'Usa la usuario : '.$user_id.' con siguiente clave para iniciar sesión'."<br><br>";
					$txt=$txt.'CLAVE:'.$user_clave."<br><br>";
					
					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					$headers .= 'From:info@hutesol.com' . "\r\n";
					$headers .= 'CC: olguercalvache@gmail.com';

					$res=mail($to,$subject,$txt,$headers);
					if($res==true)
					{
						$updStatus = 1;
					}
					else
					{
						$updStatus = 2;	
					}*/

				}
            }
            else
            {
            	$updStatus = 3;
            }
            return $updStatus;
		}
	}
?>