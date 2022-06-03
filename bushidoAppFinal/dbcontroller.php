<?php
	//session_start();
	class controller
	{
		public function loginUser($dbcon,$user_id,$user_password,$DEBUG_STATUS)
		{
			$sql="select u.user_id,u.user_name,u.user_apellido, u.user_email,u.id_grupo,g.descripcion_grupo from usuarios u, grupos g 
					where u.user_id= BINARY '".$user_id."' and u.password= BINARY '".$user_password."' and u.id_grupo=g.id_group";
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
			$sql="select user_id,concat(user_name,' ',user_apellido) nombre,password,user_email from usuarios u where u.user_id = '".$user_id."'";
			//echo 'sql1'.$sql.'<br>';
            $updStatus=0;
			$id=0;
			$nombre='';
			$password='';
            $user_email='';
			//$usr=array();
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {            	
            	if($row = mysqli_fetch_assoc($result)) 
            	{
            		$id=$row["user_id"];
            		$nombre=$row["nombre"];
            		$password=$row["password"];
                    $user_email=$row["user_email"];
            		$clave=mt_rand();
            		
            		$sql = "update usuarios set password='".$clave."' where user_id = '".$user_id."'";
                    //echo 'sql2'.$sql.'<br>';
					if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus = 1;
			        }

					$to = $user_email;
					$subject = 'BUSHIDO - RECUPERACION CLAVE';
					$txt = '¡HOLA, '.$nombre.'!'."<br><br>";
					$txt=$txt.'Se ha solicitado recuperar la clave para su cuenta en BUSHIDOAPP'."<br><br>";
					$txt=$txt.'Usa la siguiente clave para iniciar sesión'."<br><br>";
					$txt=$txt.'CLAVE:'.$clave."<br><br>";
					

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					/*$headers .= 'From:info@hutesol.com' . "\r\n";*/
                    /*$headers .= 'From:BushidoApp <bushidoapp@hutesol.com>' . "\r\n";*/
                    $headers .= 'From:BushidoApp <bushidoapp@bushidoecuador.com>' . "\r\n";

					$res=mail($to,$subject,$txt,$headers);
					if($res==true)
					{
						$updStatus = 1;
					}
					else
					{
						$sql = "update usuarios set password='".$password."' where user_id = '".$user_id."'";
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

		public function cambiarClave1($dbcon,$clave_anterior,$clave_nuevo,$DEBUG_STATUS)
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
					/*$headers .= 'From:info@hutesol.com' . "\r\n";*/
                    /*$headers .= 'From:BushidoApp <bushidoapp@hutesol.com>' . "\r\n";*/
                    $headers .= 'From:BushidoApp <bushidoapp@bushidoecuador.com>' . "\r\n";

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
									/*$headers .= 'From:info@hutesol.com' . "\r\n";*/
                                    /*$headers .= 'From:BushidoApp <bushidoapp@hutesol.com>' . "\r\n";*/
                                    $headers .= 'From:BushidoApp <bushidoapp@bushidoecuador.com>' . "\r\n";

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
				$sql="select u.user_id,u.user_name,u.user_apellido, u.user_email,u.celular,u.fecha_cumpleanos from usuarios u where u.estado=1";
				if($strBusqueda!=null)
					$sql=$sql." and (u.user_id like'%".$strBusqueda."%' or u.user_name like'%".$strBusqueda."%' or u.user_apellido like'%".$strBusqueda."%')";
				$sql=$sql." order by u.user_name asc limit ".$current_page*$products_per_page.",".$products_per_page;
			}
			else
			{
				$sql="select u.user_id,u.user_name,u.user_apellido, u.user_email,u.celular,u.fecha_cumpleanos from usuarios u where u.estado=1";
				if($strBusqueda!=null)
					$sql=$sql." and (u.user_id like'%".$strBusqueda."%' or u.user_name like'%".$strBusqueda."%' or u.user_apellido like'%".$strBusqueda."%')";
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

		public function getUserDetail($dbcon,$user,$DEBUG_STATUS)
		{
			$sql="select u.user_id,u.user_name,u.user_apellido, u.user_email,u.celular from usuarios u where u.estado=1 and user_id='".$user."'";
			
			$updStatus=0;
			$entidad=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {            	
            	while($row = mysqli_fetch_assoc($result)) 
            	{
					$entidad[$count] = array($row["user_id"],$row["user_name"],$row["user_apellido"],$row["user_email"],$row["celular"]);
					$count++;
            	}	
            }
            return $entidad;			
		}

		
		public function getCatalogPuntaje($dbcon,$DEBUG_STATUS)
		{
			$sql="select id,estado,pic,desc_puntaje,desc_impacto from catalogos_puntos cp where cp.estado=1 order by id asc";
			//$updStatus=0;
			$entidad=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {            	
            	while($row = mysqli_fetch_assoc($result)) 
            	{
					$entidad[$count] = array($row["id"],$row["estado"],$row["pic"],$row["desc_puntaje"],$row["desc_impacto"]);
					$count++;
            	}	
            }
            return $entidad;			
		}

		public function addUser($dbcon,$user_id,$user_nombre,$user_apellido,$user_email,$user_celular,$DEBUG_STATUS)
		{
			$sql="select u.user_id,u.user_name,u.user_apellido, u.user_email,u.celular from usuarios u 
					where u.user_id ='".$user_id."'";
			$user_clave=mt_rand();
			$updStatus=0;
			$id=0;
			$nombre='';
			$password='';
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {            	
            	$sql = "insert into usuarios(user_id,password,user_name,user_apellido,user_email,celular,fecha_registro,id_grupo) 
            				values('".$user_id."','".$user_clave."','".$user_nombre."','".$user_apellido."','".$user_email."','".$user_celular."',now(),3)";
				//echo 'SQL:'.$sql.'<br>';
				if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;			        

					$to = $user_email;
					$subject = 'BUSHIDO - CREACION DE USUARIO';
					$txt = '¡HOLA, '.$user_nombre.' '.$user_apellido.'!'."<br><br>";
					$txt=$txt.'Se ha creado su cuenta en BUSHIDOAPP'."<br><br>";
					$txt=$txt.'Usa el usuario :<b> '.$user_id.'</b> con la siguiente clave para iniciar sesión'."<br><br>";
					$txt=$txt.'CLAVE:<b>'.$user_clave."</b><br><br>";
					
					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					/*$headers .= 'From:info@hutesol.com' . "\r\n";*/
                    /*$headers .= 'From:BushidoApp <bushidoapp@hutesol.com>' . "\r\n";*/
                    $headers .= 'From:BushidoApp <bushidoapp@bushidoecuador.com>' . "\r\n";

					$res=mail($to,$subject,$txt,$headers);
					if($res==true)
					{
						$updStatus = 1;
					}
					else
					{
						$updStatus = 2;	
					}

				}
            }
            else
            {
            	$updStatus = 3;
            }
            return $updStatus;
		}

		public function editUser($dbcon,$user_id,$user_nombre,$user_apellido,$user_email,$user_celular,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update usuarios set user_name='".$user_nombre."', user_apellido='".$user_apellido."',
            			user_email='".$user_email."',celular='".$user_celular."' where user_id='".$user_id."'";
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
            return $updStatus;
		}


		public function asignarPuntos($dbcon,$fecha_actividad,$motivo,$puntaje,$postulante,$ganador,$DEBUG_STATUS)
		{
			$sql="select u.user_id,u.user_name,u.user_apellido, u.user_email,u.celular from usuarios u 
					where u.user_id ='".$ganador."'";
			//echo 'GANADOR:'.$sql.'<br>';
			$ganadorCtr=0;
			$updStatus = 0;
			$result = mysqli_query($dbcon,$sql);
			if(mysqli_num_rows($result) > 0)
            {            	
            	if($row = mysqli_fetch_assoc($result)) 
            	{
					$ganadorName = $row["user_name"].' '.$row["user_apellido"];
					$emailGanador =$row["user_email"];
					$ganadorCtr=1;
            	}	
            }

            $sql="select u.user_id,u.user_name,u.user_apellido, u.user_email,u.celular from usuarios u 
					where u.user_id ='".$postulante."'";
			//echo 'POSTULANTE:'.$sql.'<br>';
			$postulanteCtr=0;
			$result = mysqli_query($dbcon,$sql);
			if(mysqli_num_rows($result) > 0)
            {            	
            	if($row = mysqli_fetch_assoc($result)) 
            	{
					$postulanteName = $row["user_name"].' '.$row["user_apellido"];
					$emailPostulante =$row["user_email"];
					$postulanteCtr=1;
            	}	
            }
            //echo 'ganadorCtr:'.$ganadorCtr.'<br>';
            //echo 'postulanteCtr:'.$postulanteCtr.'<br>';
            if($ganadorCtr==1 && $postulanteCtr==1)
            {
				$sql = "insert into puntos(id_catalog_punto,fecha_actividad,fecha_registro,Motivo,postulante,ganador) 
	            				values(".$puntaje.",DATE_FORMAT('".$fecha_actividad."','%Y-%m-%d'),now(),'".$motivo."','".$postulante."','".$ganador."')";
				//echo 'INSERT:'.$sql.'<br>';
				if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;			        

					$to = $emailGanador;
					$subject = 'BUSHIDO - ASIGNACION DE PUNTAJES';
					$txt = '¡HOLA, '.$ganadorName.'!'."<br><br>";
					//$txt=$txt.'¡FELICIDADES GANASTE PUNTOS!'."<br><br>";
					//$txt=$txt.'Entra a www.bushidoecuador.com y revisa que tan cerca estas de convertirte en el proximo Samurai Nipro.'."<br><br>";
					/*$txt=$txt.'<img src=http://bushido.hutesol.com/images/Mensaje_Mail.jpg>'."<br><br>";*/
                    $txt=$txt.'<img src=http://bushidoecuador.com/images/Mensaje_Mail.jpg>'."<br><br>";
					
					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					/*$headers .= 'From:info@hutesol.com' . "\r\n";*/
                    /*$headers .= 'From:BushidoApp <bushidoapp@hutesol.com>' . "\r\n";*/
                    $headers .= 'From:BushidoApp <bushidoapp@bushidoecuador.com>' . "\r\n";

					$res=mail($to,$subject,$txt,$headers);
					if($res==true)
					{
						$updStatus = 1;
					}
					else
					{
						$updStatus = 2;	
					}

				}
            }
            return $updStatus;
		}

        public function updatePuntos($dbcon,$id,$fecha_actividad,$motivo,$puntaje,$postulante,$ganador,$DEBUG_STATUS)
        {
            $sql="select u.user_id,u.user_name,u.user_apellido, u.user_email,u.celular from usuarios u 
                    where u.user_id ='".$ganador."'";
            //echo 'GANADOR:'.$sql.'<br>';
            $ganadorCtr=0;
            $updStatus = 0;
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {                
                if($row = mysqli_fetch_assoc($result)) 
                {
                    $ganadorName = $row["user_name"].' '.$row["user_apellido"];
                    $emailGanador =$row["user_email"];
                    $ganadorCtr=1;
                }    
            }

            $sql="select u.user_id,u.user_name,u.user_apellido, u.user_email,u.celular from usuarios u 
                    where u.user_id ='".$postulante."'";
            //echo 'POSTULANTE:'.$sql.'<br>';
            $postulanteCtr=0;
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {                
                if($row = mysqli_fetch_assoc($result)) 
                {
                    $postulanteName = $row["user_name"].' '.$row["user_apellido"];
                    $emailPostulante =$row["user_email"];
                    $postulanteCtr=1;
                }    
            }
            //echo 'ganadorCtr:'.$ganadorCtr.'<br>';
            //echo 'postulanteCtr:'.$postulanteCtr.'<br>';
            if($ganadorCtr==1 && $postulanteCtr==1)
            {
                $sql = "update puntos set id_catalog_punto=".$puntaje.",fecha_actividad=DATE_FORMAT('".$fecha_actividad."','%Y-%m-%d'),
                        fecha_registro=now(),Motivo='".$motivo."',postulante='".$postulante."',ganador='".$ganador."' 
                        where id=".$id;
                //echo 'INSERT:'.$sql.'<br>';
                if(mysqli_query($dbcon,$sql))
                {
                    $updStatus = 1;                    

                    $to = $emailGanador;
                    $subject = 'BUSHIDO - MODIFICACION DE PUNTAJES';
                    $txt = '¡HOLA, '.$ganadorName.'!'."<br><br>";
                    //$txt=$txt.'¡FELICIDADES GANASTE PUNTOS!'."<br><br>";
                    //$txt=$txt.'Entra a www.bushidoecuador.com y revisa que tan cerca estas de convertirte en el proximo Samurai Nipro.'."<br><br>";
                    /*$txt=$txt.'<img src=http://bushido.hutesol.com/images/Mensaje_Mail.jpg>'."<br><br>";*/
                    $txt=$txt.'<img src=http://bushidoecuador.com/images/Mensaje_Mail.jpg>'."<br><br>";
                    
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
                   /*$headers .= 'From:info@hutesol.com' . "\r\n";*/
                    /*$headers .= 'From:BushidoApp <bushidoapp@hutesol.com>' . "\r\n";*/
                    $headers .= 'From:BushidoApp <bushidoapp@bushidoecuador.com>' . "\r\n";

                    $res=mail($to,$subject,$txt,$headers);
                    if($res==true)
                    {
                        $updStatus = 1;
                    }
                    else
                    {
                        $updStatus = 2;    
                    }

                }
            }
            return $updStatus;
        }

		public function getUserPuntos($dbcon,$apply_pagination,$current_page,$products_per_page,$strBusqueda,$DEBUG_STATUS)
		{
			$total=0;
            $position=0;
            $sql="select sum(cp.desc_puntaje) total from puntos p, catalogos_puntos cp where p.id_catalog_punto=cp.id and p.estado=1";
            if($_SESSION["user_perfil"]==3)
                $sql=$sql." and p.ganador='".$_SESSION["user_id"]."'";

            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {                
                if($row = mysqli_fetch_assoc($result)) 
                {
                    $total = $row["total"];
                }    
            }

            $sql="select ganador,total from
                    (select p.ganador,sum(cp.desc_puntaje) total from puntos p, catalogos_puntos cp where p.id_catalog_punto=cp.id and p.estado=1
                    group by p.ganador) a
                    order by total desc";

            $result = mysqli_query($dbcon,$sql);
            $ctr=0;
            if(mysqli_num_rows($result) > 0)
            {                
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $ctr++;
                    if(strcmp($_SESSION["user_id"], $row["ganador"])==0)
                        $position = $ctr;
                }    
            }

            //$position=$position.' de '.$ctr;



            if($apply_pagination==1)	
			{
				$sql="select p.id,p.fecha_actividad,p.fecha_registro,p.Motivo,cp.desc_puntaje,cp.desc_impacto,cp.pic,
						(select concat(u1.user_name,' ',u1.user_apellido) from usuarios u1 where u1.user_id=p.postulante) postulante,
						(select concat(u2.user_name,' ',u2.user_apellido) from usuarios u2 where u2.user_id=p.ganador) ganador
						from puntos p, catalogos_puntos cp where p.id_catalog_punto=cp.id and p.estado=1";
				if($_SESSION["user_perfil"]==3)
					$sql=$sql." and p.ganador='".$_SESSION["user_id"]."'";
				if($strBusqueda!=null)
					$sql=$sql." and (p.postulante like'%".$strBusqueda."%' or p.ganador like'%".$strBusqueda."%')";
				$sql=$sql." order by p.fecha_registro desc limit ".$current_page*$products_per_page.",".$products_per_page;
			}
			else
			{
				$sql="select p.id,p.fecha_actividad,p.fecha_registro,p.Motivo,cp.desc_puntaje,cp.desc_impacto,cp.pic,
						(select concat(u1.user_name,' ',u1.user_apellido) from usuarios u1 where u1.user_id=p.postulante) postulante,
						(select concat(u2.user_name,' ',u2.user_apellido) from usuarios u2 where u2.user_id=p.ganador) ganador
						from puntos p, catalogos_puntos cp where p.id_catalog_punto=cp.id and p.estado=1";
				if($_SESSION["user_perfil"]==3)
					$sql=$sql." and p.ganador='".$_SESSION["user_id"]."'";
				if($strBusqueda!=null)
					$sql=$sql." and (p.postulante like'%".$strBusqueda."%' or p.ganador like'%".$strBusqueda."%')";
				$sql=$sql." order by p.fecha_registro desc";
			}
			//echo 'INSERT:'.$sql.'<br>';
			$updStatus=0;
			$entidad=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {            	
            	while($row = mysqli_fetch_assoc($result)) 
            	{
					$entidad[$count] = array($row["fecha_actividad"],$row["fecha_registro"],$row["Motivo"],$row["desc_puntaje"],$row["desc_impacto"],$row["pic"],$row["postulante"],$row["ganador"],$row["id"],$total,$position);
					$count++;
            	}	
            }
            return $entidad;			
		}

        public function exportarUserPuntos($dbcon,$strBusqueda,$DEBUG_STATUS)
        {
            $sql="select p.id,p.fecha_actividad,p.fecha_registro,p.Motivo,cp.desc_puntaje,cp.desc_impacto,cp.pic,
                        (select concat(u1.user_name,' ',u1.user_apellido) from usuarios u1 where u1.user_id=p.postulante) postulante,
                        (select concat(u2.user_name,' ',u2.user_apellido) from usuarios u2 where u2.user_id=p.ganador) ganador
                        from puntos p, catalogos_puntos cp where p.id_catalog_punto=cp.id and p.estado=1";
                if($_SESSION["user_perfil"]==3)
                    $sql=$sql." and p.ganador='".$_SESSION["user_id"]."'";
                if($strBusqueda!=null)
                    $sql=$sql." and (p.postulante like'%".$strBusqueda."%' or p.ganador like'%".$strBusqueda."%')";
                $sql=$sql." order by p.fecha_registro desc";
            //echo 'INSERT:'.$sql.'<br>';
            $updStatus=0;
            $entidad=array();
            $count=0;
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {                
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $entidad[$count] = array("FECHA DEL ACTIVIDAD"=>$row["fecha_actividad"],"FECHA INGRESO"=>$row["fecha_registro"],"MOTIVO"=>$row["Motivo"],"PUNTAJE"=>$row["desc_puntaje"],"IMPACTO"=>$row["desc_impacto"],"POSTULANTE"=>$row["postulante"],"GANADOR"=>$row["ganador"]);
                    $count++;
                }    
            }
            return $entidad;            
        }

        public function getUserPuntosById($dbcon,$id,$DEBUG_STATUS)
        {
            $sql="select p.id pid,DATE_FORMAT(p.fecha_actividad,'%Y-%m-%d') fecha_actividad,p.fecha_registro,p.Motivo,cp.id,cp.desc_impacto,cp.pic,
                        p.postulante,p.ganador 
                        from puntos p, catalogos_puntos cp where p.id_catalog_punto=cp.id and p.estado=1 and p.id=".$id;
            
            
            //echo 'INSERT:'.$sql.'<br>';
            $updStatus=0;
            $entidad=array();
            $count=0;
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {                
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $entidad[$count] = array($row["fecha_actividad"],$row["fecha_registro"],$row["Motivo"],$row["id"],$row["desc_impacto"],$row["pic"],$row["postulante"],$row["ganador"],$row["pid"]);
                    $count++;
                }    
            }
            return $entidad;            
        }

		public function getDocumentos($dbcon,$apply_pagination,$current_page,$products_per_page,$strBusqueda,$DEBUG_STATUS)
		{
			if($apply_pagination==1)	
			{
				$sql="select id,path,descripcion from documentos d where d.estado=1";
				if($strBusqueda!=null)
					$sql=$sql." and d.descripcion like'%".$strBusqueda."%'";
				$sql=$sql." order by d.id asc limit ".$current_page*$products_per_page.",".$products_per_page;
			}
			else
			{
				$sql="select id,path,descripcion from documentos d where d.estado=1";
				if($strBusqueda!=null)
					$sql=$sql." and d.descripcion like'%".$strBusqueda."%'";
				$sql=$sql." order by d.id asc";
			}
			$updStatus=0;
			$entidad=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {            	
            	while($row = mysqli_fetch_assoc($result)) 
            	{
					$entidad[$count] = array($row["id"],$row["path"],$row["descripcion"]);
					$count++;
            	}	
            }
            return $entidad;			
		}

        public function getDocumentById($dbcon,$id,$DEBUG_STATUS)
        {
            $sql="select id,path,descripcion from documentos d where d.estado=1 and id=".$id;
             
            $updStatus=0;
            $entidad=array();
            $count=0;
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {                
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $entidad[$count] = array($row["id"],$row["path"],$row["descripcion"]);
                    $count++;
                }    
            }
            return $entidad;            
        }


		public function addDocument($dbcon,$doc_desc,$doc_path,$DEBUG_STATUS)
		{
			$sql="select id from documentos where path ='".$doc_path."' and estado=1";
			$updStatus=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {            	
            	$sql = "insert into documentos(path,descripcion) 
            				values('".$doc_path."','".$doc_desc."')";
				//echo 'SQL:'.$sql.'<br>';
				if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;	
				}
            }
            else
            {
            	$updStatus = 3;
            }
            return $updStatus;
		}

        public function updateDocument($dbcon,$id,$descripcion,$file,$DEBUG_STATUS)
        {
            $updStatus = 0;
            $sql = "update documentos set path='".$file."', descripcion='".$descripcion."' where id='".$id."'";
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
            return $updStatus;
        }

        public function cambiarClave($dbcon,$clave_anterior,$clave_nuevo,$confirmar_clave,$DEBUG_STATUS)
        {
            $updStatus = 0;
            $sql="select u.password from usuarios u where u.user_id ='".$_SESSION["user_id"]."' and password='".$clave_anterior."'";
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {                
                if($row = mysqli_fetch_assoc($result)) 
                {
                    $password_ant = $row["password"];
                }    
            }
            else
            {
                return 3;
            }
            $sql = "update usuarios set password='".$clave_nuevo."' where user_id='".$_SESSION["user_id"]."' and password='".$clave_anterior."'";
            //echo 'SQL:'.$sql.'<br>';
            if(mysqli_query($dbcon,$sql))
            {
                $updStatus = 1;                    

                $to = $_SESSION["user_email"];
                $subject = 'BUSHIDO - CAMBIO DE CLAVE';
                $txt = '¡HOLA, '.$_SESSION["user_name"].'!'."<br><br>";
                $txt=$txt.'Has cambiado tu clave de su cuenta en BUSHIDOAPP'."<br><br>";
                $txt=$txt.'Usa el usuario : <b>'.$_SESSION["user_id"].'</b> con la siguiente clave para iniciar sesión'."<br><br>";
                $txt=$txt.'CLAVE:<b>'.$clave_nuevo."</b><br><br>";
                
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
               /*$headers .= 'From:info@hutesol.com' . "\r\n";*/
                /*$headers .= 'From:BushidoApp <bushidoapp@hutesol.com>' . "\r\n";*/
                    $headers .= 'From:BushidoApp <bushidoapp@bushidoecuador.com>' . "\r\n";

                $res=mail($to,$subject,$txt,$headers);
                if($res==true)
                {
                    $updStatus = 1;
                }
                else
                {
                    $sql = "update usuarios set password='".$password_ant."' where user_id='".$_SESSION["user_id"]."'";
                    //echo 'SQL:'.$sql.'<br>';
                    if(mysqli_query($dbcon,$sql))
                    {   
                        $updStatus = 2;
                    }
                }

            }
            return $updStatus;
        }

		public function deleteDoc($dbcon,$id_doc,$DEBUG_STATUS)
		{
			$updStatus=0;
			$sql = "update documentos set estado=0 where id=".$id_doc;
				//echo 'SQL:'.$sql.'<br>';
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;	
			}
            return $updStatus;
		}

		public function deletePuntos($dbcon,$id_puntos,$DEBUG_STATUS)
		{
			$updStatus=0;
			$sql = "update puntos set estado=0 where id=".$id_puntos;
				//echo 'SQL:'.$sql.'<br>';
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;	
			}
            return $updStatus;
		}
		public function deleteUsuario($dbcon,$user,$DEBUG_STATUS)
		{
			$updStatus=0;
			$sql = "update usuarios set estado=0 where user_id='".$user."'";
				//echo 'SQL:'.$sql.'<br>';
			if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;	
			}
            return $updStatus;
		}

        public function getUserDashboard($dbcon,$month,$DEBUG_STATUS)
        {
            $sql="select sum(cp.desc_puntaje) total from puntos p, 
                    catalogos_puntos cp where p.id_catalog_punto=cp.id and p.estado=1 and 
                    date_format(p.fecha_actividad,'%m')='".$month."'";
            if($_SESSION["user_perfil"]==3)
                $sql=$sql." and p.ganador='".$_SESSION["user_id"]."'";
            $sql=$sql." group by date_format(p.fecha_actividad,'%m')";

            $result = mysqli_query($dbcon,$sql);
            $score=0;
            if(mysqli_num_rows($result) > 0)
            {                
                if($row = mysqli_fetch_assoc($result)) 
                {
                    $score=$row["total"];
                }    
            }

            return $score;
        }
	}
?>