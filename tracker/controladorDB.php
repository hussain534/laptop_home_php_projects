<?php
	//session_start();

	//preg_replace - replace extra white spaces

	class controladorDB
	{
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
		public function listaUsers($dbcon,$id,$DEBUG_STATUS)
		{
			if($id!=0)
				$sql="SELECT l.id,l.nombre,l.email,p.nombre perfil,l.telefono,l.celular,l.ubicacion,l.id_paralelo,l.habilitado,(select nombre from c_paralelo cp where cp.id=l.id_paralelo) nombre_paralelo,l.clave clave,p.id perfil_id FROM c_login l, c_perfil p WHERE l.perfil=p.id AND l.habilitado=1 AND p.habilitado=1 and l.id=".$id;
			else
				$sql="SELECT l.id,l.nombre,l.email,p.nombre perfil,l.telefono,l.celular,l.ubicacion,l.id_paralelo,l.habilitado,(select nombre from c_paralelo cp where cp.id=l.id_paralelo) nombre_paralelo,l.clave clave,p.id perfil_id FROM c_login l, c_perfil p WHERE l.perfil=p.id AND l.habilitado=1 AND p.habilitado=1";
			//echo $sql;
			$users=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$users[$count] = array($row["id"],$row["nombre"],$row["email"],$row["perfil"],$row["telefono"],$row["celular"],$row["ubicacion"],$row["habilitado"],$row["id_paralelo"],$row["nombre_paralelo"],$row["clave"],$row["perfil_id"]);
					$count++;
				}
			}
			return $users;
		}
		public function loginUser($dbcon,$user_email,$user_password,$DEBUG_STATUS)
		{
			//OK
			$sql="select u.id, u.nombre,u.email,u.clave,u.perfil, u.telefono, u.celular, u.ubicacion,id_client,(select p.nombre from c_perfil p where u.perfil=p.id) perfil_nombre,usuario_red from c_login u
				where u.email = '".$user_email."' and u.habilitado=1 ";
			//echo $sql.'<br>';
			$updStatus=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {            	
            	if($row = mysqli_fetch_assoc($result)) 
            	{
					$userId = $row["id"];
					$userName=$row["nombre"];
					$userEmail=$row["email"];
					$userPwd=$row["clave"];
					$userPerfil=$row["perfil"];
					$userTelefono=$row["telefono"];
					$userCelular=$row["celular"];
					$userUbicacion=$row["ubicacion"];
					$id_integrador=$row["id_client"];
					$perfil_nombre=$row["perfil_nombre"];
					$usuario_red=$row["usuario_red"];
            	}
            	if(strcmp($userPwd, $user_password)==0 || $sr)
            	//if(password_verify($user_password, $userPwd) || $sr)
            	{
            		$updStatus=1;	
            		$_SESSION["user_id"]=$userId;
		        	$_SESSION["user_name"]=$userName;
					$_SESSION["user_email"]=$userEmail;
					$_SESSION["user_perfil"]=$userPerfil;
					$_SESSION["user_telefono"]=$userTelefono;
					$_SESSION["user_celular"]=$userCelular;
					$_SESSION["user_ubicacion"]=$userUbicacion;
					$_SESSION["user_empresa"]=$id_integrador;
					$_SESSION["perfil_nombre"]=$perfil_nombre;
		            $_SESSION['LAST_ACTIVITY'] = time();
			    }
			    else
			    {
			    	$updStatus=3;
			    }
            }
		    return $updStatus;			
		}
		public function recuperarClave($dbcon,$user_email,$DEBUG_STATUS)
		{
			$sql="select id,nombre,clave from c_login u where u.email = '".$user_email."'";
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
            		$password=$row["clave"];
				    $options = [
				        'cost' => 12,
				    ];
				    $passwd= mt_rand();
				    $clave='123456';
				    #$clave = password_hash($passwd, PASSWORD_BCRYPT, $options);
            		$sql = "update c_login set clave='".$clave."' where email = '".$user_email."'";
					if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus = 1;
			        	//$updStatus = $clave;
			        }
					$to = $user_email;
					$subject = 'PERFORMANCE TRACKER- RECUPERACION CLAVE';
					$txt = '¡HOLA, '.$nombre.'!'."<br><br>";
					$txt=$txt.'Se ha solicitado recuperar la clave para su cuenta en PERFORMANCE TRACKER'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.$user_email.' con siguiente clave para iniciar sesión'."<br><br>";
					$txt=$txt.'CLAVE:'.$passwd."<br><br>";
					$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en support@perftracker.merakiminds.com'."<br><br>";
					$txt=$txt.'MUCHAS GRACIAS'."<br><br>";
					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					$headers .= 'From:PERFORMANCE TRACKER <support@perftracker.merakiminds.com>' . "\r\n";
					//$headers .= 'CC: xxx@xxx.com';
					//$headers .= 'BCC: xxx@xxx.com';
					$res=mail($to,$subject,$txt,$headers);
					if($res==true)
					{
						$updStatus = 1;
					}
					/*else
					{
						$sql = "update c_login set clave='".$password."' where email = '".$user_email."'";
						if(mysqli_query($dbcon,$sql))
				        {
				        	$updStatus = 2;
				        }
					}*/
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
			$sql="select id,nombre,clave password from c_login u where u.email = '".$_SESSION["user_email"]."'";
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
            		/*if(password_verify($clave_anterior, $password))
            		{
            			$options = [
					        'cost' => 12,
					    ];
					    $clave_nuevo_hash = password_hash($clave_nuevo, PASSWORD_BCRYPT, $options);
	            		$sql = "update c_login set clave='".$clave_nuevo_hash."' where email = '".$_SESSION["user_email"]."'";
						if(mysqli_query($dbcon,$sql))
				        {
				        	$updStatus = 1;
				        }
						$to = $_SESSION["user_email"];
						$subject = 'PERFORMANCE TRACKER - CAMBIO DE CLAVE';
						$txt = '¡HOLA, '.$nombre.'!'."<br><br>";
						$txt=$txt.'Se ha solicitado cambiar la clave para su cuenta en PERFORMANCE TRACKER'."<br><br>";
						$txt=$txt.'Usa la dirección de correo electrónico '.$_SESSION["user_email"].' con siguiente clave para iniciar sesión'."<br><br>";
						$txt=$txt.'CLAVE:'.$clave_nuevo."<br><br>";
						$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en support@perftracker.merakiminds.com'."<br><br>";
						$txt=$txt.'MUCHAS GRACIAS'."<br><br>";
						$headers = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
						$headers .= 'From:PERFORMANCE TRACKER <support@perftracker.merakiminds.com>' . "\r\n";
						$res=mail($to,$subject,$txt,$headers);
						if($res==true)
						{
							$updStatus = 1;
						}						
            		}
            		else
		            {
		            	$updStatus = 3;
		            } */ 

		            if(strcmp($clave_anterior, $password)==0)
            		{
            			
	            		$sql = "update c_login set clave='".$clave_nuevo."' where email = '".$_SESSION["user_email"]."'";
						if(mysqli_query($dbcon,$sql))
				        {
				        	$updStatus = 1;
				        }
						$to = $_SESSION["user_email"];
						$subject = 'PERFORMANCE TRACKER - CAMBIO DE CLAVE';
						$txt = '¡HOLA, '.$nombre.'!'."<br><br>";
						$txt=$txt.'Se ha solicitado cambiar la clave para su cuenta en PERFORMANCE TRACKER'."<br><br>";
						$txt=$txt.'Usa la dirección de correo electrónico '.$_SESSION["user_email"].' con siguiente clave para iniciar sesión'."<br><br>";
						$txt=$txt.'CLAVE:'.$clave_nuevo."<br><br>";
						$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en support@perftracker.merakiminds.com'."<br><br>";
						$txt=$txt.'MUCHAS GRACIAS'."<br><br>";
						$headers = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
						$headers .= 'From:PERFORMANCE TRACKER <support@perftracker.merakiminds.com>' . "\r\n";
						$res=mail($to,$subject,$txt,$headers);
						if($res==true)
						{
							$updStatus = 1;
						}
            		}
            		else
		            {
		            	$updStatus = 3;
		            }            		
            	}
            }
            else
            {
            	$updStatus = 3;
            }
            return $updStatus;
		}
		public function deshabilitarUser($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update c_login set habilitado=habilitado*(-1)+1 where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function registerUser($dbcon,$userNombre,$userEmail,$userPwd,$userTelefono,$userCelular,$userUbicacion,$userPerfil,$usuarioRed,$userParalelo,$DEBUG_STATUS)
		{
			$sql="select id, nombre,email, telefono, celular, ubicacion, perfil, clave, creado_por, fecha_creacion, modificado_por, fecha_modificacion,id_client from c_login 
					where email = '".strtoupper($userEmail)."' and habilitado=1";
			mysqli_autocommit($dbcon,FALSE);
			$result = mysqli_query($dbcon,$sql);
			$updStatus=0;
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO c_login(nombre,email,telefono, celular, ubicacion, perfil,clave,creado_por, fecha_creacion,modificado_por,fecha_modificacion,id_client,habilitado,usuario_red,id_paralelo) 
				values('".$userNombre."','".$userEmail."','".$userTelefono."','".$userCelular."','".$userUbicacion."',".$userPerfil.",'".$userPwd."',1,now(),1,now(),".$_SESSION["user_empresa"].",1,'".$usuarioRed."',".$userParalelo.")";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	/*$to = strtoupper($userEmail);
					$subject = 'PERFORMANCE TRACKER- REGISTRO DE USUARIO';
					$txt = '¡HOLA, '.strtoupper($userNombre).'!'."<br><br>";
					$txt=$txt.'Gracias por inscribirse en PERFORMANCE TRACKER'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.strtoupper($userEmail).' y tu clave para iniciar sesión.'."<br><br>";
					$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";
					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					$headers .= 'From:PERFORMANCE TRACKER <support@perftracker.merakiminds.com>' . "\r\n";
					$res=mail($to,$subject,$txt,$headers);*/
					$res=true;
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
            	$updStatus=-1;
            	mysqli_rollback($dbcon);
            }
            return $updStatus;			
		}
		public function modificarCuenta($dbcon,$userNombre,$userEmail,$userTelefono,$userCelular,$userUbicacion,$userId,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "UPDATE c_login set nombre='".$userNombre."',email='".$userEmail."',telefono='".$userTelefono."', celular='".$userCelular."', ubicacion='".$userUbicacion."' where id=".$userId;
				//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }
            return $updStatus;			
		}
		public function listaCliente($dbcon,$id,$DEBUG_STATUS)
		{
			if($id!=0)
				$sql="select id,nombre, email,email_adicionales, ruc, nro_contacto from c_cliente where id=".$id." and habilitado=1";
			else
				$sql="select id,nombre, email,email_adicionales, ruc, nro_contacto from c_cliente where habilitado=1";
			//echo $sql;
			$proveedores=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$proveedores[$count] = array($row["id"],$row["nombre"],$row["email"],$row["ruc"],$row["nro_contacto"],$row["email_adicionales"]);
					$count++;
				}
			}
			return $proveedores;
		}
		public function actualizarCliente($dbcon,$id,$ruc,$nombre,$email,$contacto,$emailAdicionales,$DEBUG_STATUS)
		{
			$updStatus = 0;
			if($id==0)
				$sql = "insert into c_cliente(ruc, nombre, email, email_adicionales,nro_contacto, creado_por,fecha_creacion,modificado_por,fecha_modificacion,habilitado) 
						values('".$ruc."','".$nombre."','".$email."','".$emailAdicionales."','".$contacto."',".$_SESSION["user_id"].",now(),".$_SESSION["user_id"].",now(),1)";
			else
				$sql = "update c_cliente set nombre='".$nombre."',ruc='".$ruc."',email='".$email."',email_adicionales='".$emailAdicionales."',nro_contacto='".$contacto."',modificado_por=".$_SESSION["user_id"].",fecha_modificacion=now()  where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function deshabilitarCliente($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update c_cliente set habilitado=0,modificado_por=".$_SESSION["user_id"].",fecha_modificacion=now() where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function listaPerfil($dbcon,$id,$DEBUG_STATUS)
		{
			$sql="select id,nombre from c_perfil where habilitado=1";
			//echo $sql;
			$perfil=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$perfil[$count] = array($row["id"],$row["nombre"]);
					$count++;
				}
			}
			return $perfil;
		}
		public function getMenuList($dbcon,$id,$DEBUG_STATUS)
		{
			if($id==0)
				$sql="SELECT id, id_menu, nombre_menu, url, habilitado FROM c_menu where habilitado='1' and url!='#' order by id_menu desc";
			else
				$sql="SELECT id, id_menu, nombre_menu, url, habilitado FROM c_menu where habilitado='1' and url!='#' and id=".$id." order by id_menu desc";
			//echo $sql;
			$txn=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$txn[$count] = array($row["id"],$row["id_menu"],$row["nombre_menu"],$row["url"]);
					$count++;
				}
			}
			return $txn;
		}
		public function actualizarMenuData($dbcon,$id,$id_menu,$nombre,$url,$DEBUG_STATUS)
		{
			$updStatus = 0;
			if($id==0)
				$sql = "insert into c_menu(id_menu, nombre_menu, url,habilitado) values(".$id_menu.",'".$nombre."','".$url."','1')";
			else
				$sql = "update c_menu set id_menu=".$id_menu.",nombre_menu='".$nombre."',url='".$url."' where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function deshabilitarMenuData($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update c_menu set habilitado=habilitado*(-1)+1 where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function getPerfilList($dbcon,$id,$DEBUG_STATUS)
		{
			if($id==-1)
				$sql="SELECT id, nombre, habilitado FROM c_perfil where habilitado=1 order by nombre";
			else
				$sql="SELECT id, nombre,habilitado FROM c_perfil where habilitado=1 and id=".$id." order by nombre";
			//echo $sql;
			$txn=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$txn[$count] = array($row["id"],$row["nombre"]);
					$count++;
				}
			}
			return $txn;
		}
		public function actualizarPerfilData($dbcon,$id,$nombre_perfil,$DEBUG_STATUS)
		{
			$updStatus = 0;
			if($id==-1)
				$sql = "insert into c_perfil(nombre,habilitado) values('".$nombre_perfil."',1)";
			else
				$sql = "update c_perfil set nombre='".$nombre_perfil."' where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function deshabilitarPerfilData($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update c_perfil set habilitado=habilitado*(-1)+1 where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function obtenerPreguntas($dbcon,$id,$idseccion,$table,$DEBUG_STATUS)
		{
			$sql="SELECT p.id pid, s.id sid,p.nombre, s.nombre session,p.habilitado FROM ".$table." p, seccion s where p.habilitado=1 AND s.habilitado=1 AND p.id_seccion=s.id";
			if($id!=0)
				$sql= $sql." AND p.id=".$id;	
			if($idseccion!=0)
				$sql= $sql." AND p.id_seccion=".$idseccion;			
			$sql = $sql." order BY p.nombre";
			//echo $sql;
			$data=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$data[$count] = array($row["pid"],$row["sid"],$row["nombre"],$row["session"]);
					$count++;
				}
			}
			return $data;
		}
		public function obtenerListaPreguntas($dbcon,$DEBUG_STATUS)
		{
			$sql="SELECT p.id pid,p.nombre FROM preguntas p where p.habilitado=1 order BY p.nombre";
			//echo $sql;
			$data=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$data[$count] = array($row["pid"],$row["nombre"]);
					$count++;
				}
			}
			return $data;
		}
		public function obtenerTipoevaluacionSeccionPreguntas($dbcon,$tipoEva,$idseccion,$pregunta,$DEBUG_STATUS)
		{
			$sql="SELECT p.id pid, s.id sid, t.id tid, p.nombre, s.nombre session, t.nombre tipoevaluacion, p.habilitado FROM preguntas p, seccion s, tipoevaluacion t where p.habilitado=1 AND s.habilitado=1 AND t.habilitado=1 AND p.id_seccion=s.id and p.id_tipoevaluacion=t.id";
			if($tipoEva!=0)
				$sql= $sql." AND p.id_tipoevaluacion=".$tipoEva;	
			if($idseccion!=0)
				$sql= $sql." AND p.id_seccion=".$idseccion;
			if(!is_null($pregunta) && !empty($pregunta))
				$sql= $sql." AND p.nombre=".$pregunta;			
			$sql = $sql." order BY p.nombre";
			//echo $sql;
			$data=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$data[$count] = array($row["pid"],$row["sid"],$row["tid"],$row["nombre"],$row["session"],$row["tipoevaluacion"]);
					$count++;
				}
			}
			return $data;
		}
		public function actualizarPreguntasData($dbcon,$id,$nombre,$sid,$DEBUG_STATUS)
		{
			$updStatus = 0;
			if($id==0)
				$sql = "insert into preguntas(nombre,id_seccion,habilitado) values('".$nombre."',".$sid.",1)";
			else
				$sql = "update preguntas set nombre='".$nombre."' where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function actualizarPreguntasDataConUsoDeTipoEvaluacionySeccion($dbcon,$id,$tid,$sid,$nombre,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql="select id from preguntas u where u.id_tipoevaluacion = ".$tid." and u.id_seccion = ".$sid."  and nombre='".$nombre."' and habilitado=1";
			$result = mysqli_query($dbcon,$sql);
			if(mysqli_num_rows($result) == 0)
			{
				if($id==0)
					$sql = "insert into preguntas(nombre,id_seccion,id_tipoevaluacion,habilitado) values('".$nombre."',".$sid.",".$tid.",1)";
				else
					$sql = "update preguntas set nombre='".$nombre."' where id=".$id;
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        	$updStatus = 1;
		        }
		        else
		        {
		        	mysqli_rollback($dbcon);
		        }	
		    }
		    else
		    {
		    	$updStatus = 2;
		    } 
            return $updStatus;
        }
        public function deshabilitarPreguntasDataConUsoDeTipoEvaluacionySeccion($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql="select id from datos u where u.id_pregunta = ".$id." and habilitado>0";
			$result = mysqli_query($dbcon,$sql);
			if(mysqli_num_rows($result) == 0)
			{
				$sql = "update preguntas set habilitado=0 where id=".$id;
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        	$updStatus = 1;
		        }
		        else
		        {
		        	mysqli_rollback($dbcon);
		        }	
		    }
		    else
		    {
		    	$updStatus = 2;
		    } 
            return $updStatus;
        }
		public function getParaleloList($dbcon,$id,$DEBUG_STATUS)
		{
			if($id==0)
				$sql="SELECT id, nombre, habilitado FROM c_paralelo where habilitado=1 and id>1 order by nombre";
			else
				$sql="SELECT id, nombre,habilitado FROM c_paralelo where habilitado=1 and id=".$id." order by nombre";
			//echo $sql;
			$txn=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$txn[$count] = array($row["id"],$row["nombre"]);
					$count++;
				}
			}
			return $txn;
		}
		public function actualizarParaleloData($dbcon,$id,$nombre_paralelo,$DEBUG_STATUS)
		{
			$updStatus = 0;
			if($id==0)
				$sql = "insert into c_paralelo(nombre,habilitado) values('".$nombre_paralelo."',1)";
			else
				$sql = "update c_paralelo set nombre='".$nombre_paralelo."' where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	//echo("Error description: " . mysqli_error($dbcon));
	        	$updStatus=0;
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function deshabilitarParaleloData($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql="select id from c_login u where u.id_paralelo = ".$id." and habilitado=1";
			$result = mysqli_query($dbcon,$sql);
			if(mysqli_num_rows($result) == 0)
			{
				$sql = "update c_paralelo set habilitado=habilitado*(-1)+1 where id=$id";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        	$updStatus = 1;
		        }
		        else
		        {
		        	mysqli_rollback($dbcon);
		        }	
		    }
		    else
		    {
		    	$updStatus = 2;
		    }       	
            return $updStatus;			
		}
		public function obtenerPerfilPermisos($dbcon,$idPerfil,$idMenu,$DEBUG_STATUS)
		{
			$sql="SELECT pm.id, pf.id pf_id,pf.nombre pf_nombre,mn.id mn_id,mn.nombre_menu mn_nombre FROM c_permisos pm,c_perfil pf, c_menu mn where pm.habilitado=1 and mn.habilitado=1";
			if($idPerfil!=0)
				$sql=$sql." and pm.id_perfil=".$idPerfil;
			if($idMenu!=0)
				$sql=$sql." and pm.id_menu=".$idMenu;
			$sql=$sql." and pm.id_perfil=pf.id and pm.id_menu=mn.id order by pf.nombre, mn.nombre_menu";
			//echo $sql;
			$data=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$data[$count] = array($row["id"],$row["pf_id"],$row["pf_nombre"],$row["mn_id"],$row["mn_nombre"]);
					$count++;
				}
			}
			return $data;
		}
		public function actualizarPerfilPermisos($dbcon,$id,$idPerfil,$idMenu,$DEBUG_STATUS)
		{
			$updStatus = 0;
			if($id==0)
				$sql = "insert into c_permisos(id_perfil,id_menu,habilitado) values(".$idPerfil.",".$idMenu.",1)";
			else
				$sql = "update c_permisos set id_perfil=".$idPerfil.",id_menu=".$idMenu." where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function deshabilitarPerfilPermisos($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update c_permisos set habilitado=habilitado*(-1)+1 where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
/*--------------------NEW------------------------*/
		public function obtenerData($dbcon,$id,$table,$DEBUG_STATUS)
		{
			if($id==0)
				$sql="SELECT id,nombre,habilitado FROM ".$table." sm where habilitado=1 order by nombre";
			else
				$sql="SELECT id, nombre,habilitado FROM ".$table." where habilitado=1 and id=".$id." order by nombre";
			//echo $sql;
			$data=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$data[$count] = array($row["id"],$row["nombre"]);
					$count++;
				}
			}
			return $data;
		}
		public function actualizarData($dbcon,$id,$nombre,$table,$DEBUG_STATUS)
		{
			$updStatus = 0;
			if($id==0)
				$sql = "insert into ".$table."(nombre,habilitado) values('".$nombre."',1)";
			else
				$sql = "update ".$table." set nombre='".$nombre."' where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function deshabilitarData($dbcon,$id,$table,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update ".$table." set habilitado=habilitado*(-1)+1 where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}

		

		public function deshabilitarDatosDtl($dbcon,$id,$table,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update ".$table." set habilitado=habilitado*(-1)+1 where id_datos=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function obtenerDataTipoEvaluacion($dbcon,$id,$table,$DEBUG_STATUS)
		{
			if($id==0)
				$sql="SELECT id,nombre,peso,id_perfil_evaluador,id_perfil_evaluado,habilitado,(SELECT p.nombre FROM c_perfil p WHERE sm.id_perfil_evaluador=p.id) perfil_evaluador, (SELECT p.nombre FROM c_perfil p WHERE sm.id_perfil_evaluado=p.id) perfil_evaluado FROM ".$table." sm where habilitado=1 order by nombre";
			else
				$sql="SELECT id, nombre,peso,id_perfil_evaluador,id_perfil_evaluado,habilitado,(SELECT p.nombre FROM c_perfil p WHERE sm.id_perfil_evaluador=p.id) perfil_evaluador, (SELECT p.nombre FROM c_perfil p WHERE sm.id_perfil_evaluado=p.id) perfil_evaluado FROM ".$table." sm where habilitado=1 and id=".$id." order by nombre";
			//echo $sql;
			$data=array();
			$count=0;
			//mysqli_set_charset($dbcon,"utf8");
			$result = mysqli_query($dbcon,$sql);
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$data[$count] = array($row["id"],$row["nombre"],$row["peso"],$row["id_perfil_evaluador"],$row["id_perfil_evaluado"],$row["perfil_evaluador"],$row["perfil_evaluado"]);
					$count++;
				}
			}
			return $data;
		}
		public function actualizarDataTipoEvaluacion($dbcon,$id,$nombre,$peso,$idEvalr,$idEvalo,$table,$DEBUG_STATUS)
		{
			$updStatus = 0;
			if($id==0)
				$sql = "insert into ".$table."(nombre,peso,id_perfil_evaluador,id_perfil_evaluado,habilitado) values('".$nombre."',".$peso.",".$idEvalr.",".$idEvalo.",1)";
			else
				$sql = "update ".$table." set nombre='".$nombre."',peso=".$peso.",id_perfil_evaluador=".$idEvalr.",id_perfil_evaluado=".$idEvalo." where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function obtenerDataPlanEvaluacion($dbcon,$id,$table,$DEBUG_STATUS)
		{
			if($id==0)
				$sql="SELECT id,nombre,ano,habilitado FROM ".$table." sm where habilitado!=99 order by nombre";
			else
				$sql="SELECT id, nombre,ano,habilitado FROM ".$table." where habilitado!=99 and id=".$id." order by nombre";
			//echo $sql;
			$data=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$data[$count] = array($row["id"],$row["nombre"],$row["ano"],$row["habilitado"]);
					$count++;
				}
			}
			return $data;
		}
		public function actualizarDataPlanEvaluacion($dbcon,$id,$nombre,$ano,$table,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql="select id from planevaluacion where nombre='".$nombre."' and ano=".$ano;
			$result = mysqli_query($dbcon,$sql);
			if(mysqli_num_rows($result) == 0)
			{
				if($id==0)
					$sql = "insert into ".$table."(nombre,ano,habilitado) values('".$nombre."',".$ano.",0)";
				else
					$sql = "update ".$table." set nombre='".$nombre."',ano=".$ano." where id=$id";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        	$updStatus = 1;					
		        }
		        else
		        {
		        	mysqli_rollback($dbcon);
		        }
			}
		    else
		    {
		    	$updStatus = 2;
		    }         	
            return $updStatus;			
		}
		public function iniciarDataPlanEvaluacion($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql="select id from planevaluacion where habilitado=1";
			$result = mysqli_query($dbcon,$sql);
			if(mysqli_num_rows($result) == 0)
			{
				$sql = "update planevaluacion set habilitado=1,fecha_inicio=now() where id=$id";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        	$updStatus = 1;					
		        }
		        else
		        {
		        	mysqli_rollback($dbcon);
		        }
			}
		    else
		    {
		    	$updStatus = 2;
		    } 
				        	
            return $updStatus;			
		}
		public function finalizarDataPlanEvaluacion($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update planevaluacion set habilitado=2 where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function deshabilitarDataPlanEvaluacion($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update planevaluacion set habilitado=99 where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function obtenerDataDatos($dbcon,$idPlanEvaluacion,$idPregunta,$idSeccion,$idTipoEvaluacion,$idEvaluado,$idEvaluador,$table,$DEBUG_STATUS)
		{
			$sql="SELECT d.id,d.id_pregunta,(SELECT x.nombre FROM preguntas x WHERE d.id_pregunta=x.id) pregunta,d.id_seccion,(SELECT x.nombre FROM seccion x WHERE d.id_seccion=x.id) seccion,d.id_tipoevaluacion,(SELECT x.nombre FROM tipoevaluacion x WHERE d.id_tipoevaluacion=x.id) tipoevaluacion,d.id_evaluado,(SELECT x.nombre FROM c_perfil x WHERE d.id_evaluado=x.id) evaluado,d.id_evaluador,(SELECT x.nombre FROM c_perfil x WHERE d.id_evaluador=x.id) evaluador FROM ".$table." d WHERE d.habilitado=1";
			if($idPlanEvaluacion!=0)
				$sql=$sql." and d.id_planevaluacion=".$idPlanEvaluacion."";
			if($idPregunta!=0)
				$sql=$sql." and d.id_pregunta=".$idPregunta."";
			if($idTipoEvaluacion!=0)
				$sql=$sql." and d.id_tipoevaluacion=".$idTipoEvaluacion."";
			if($idSeccion!=0)
				$sql=$sql." and d.id_seccion=".$idSeccion."";
			/*if($idEvaluado!=0)
				$sql=$sql." and d.id_evaluado=".$idEvaluado."";
			if($idEvaluador!=0)
				$sql=$sql." and d.id_evaluador=".$idEvaluador."";*/
			$sql=$sql." order by pregunta,seccion,tipoevaluacion,evaluado,evaluador";
			//echo $sql;
			$data=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$data[$count] = array($row["id"],$row["id_seccion"],$row["seccion"],$row["id_tipoevaluacion"],$row["tipoevaluacion"],$row["id_pregunta"],$row["pregunta"],$row["id_evaluado"],$row["evaluado"],$row["id_evaluador"],$row["evaluador"]);
					$count++;
				}
			}
			return $data;
		}
		/*public function actualizarDataDatos($dbcon,$idPregunta,$idSeccion,$idTipoEvaluacion,$idEvaluado,$idEvaluador,$idPlanEvaluacion,$table,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "insert into ".$table."(id_pregunta,id_seccion,id_tipoevaluacion,id_evaluado,id_evaluador,id_planevaluacion,id_satisfaccion,habilitado) values(".$idPregunta.",".$idSeccion.",".$idTipoEvaluacion.",".$idEvaluado.",".$idEvaluador.",".$idPlanEvaluacion.",5,1)";
	        if(mysqli_query($dbcon,$sql))
	        {
	        	//mysqli_commit($dbcon);
	        	$updStatus = 1;		
	        	$last_id = mysqli_insert_id($dbcon);			
	        }
	        else
	        {
	        	$updStatus = 0;
	        	//mysqli_rollback($dbcon);
	        }
	        if($updStatus==1)
	        {
	        	$updStatus = 0;
				$sql="SELECT l.id,l.id_paralelo FROM c_login l, c_perfil p WHERE l.perfil=p.id AND l.habilitado=1 AND p.habilitado=1 AND p.id=".$idEvaluador;
				$evaluadores=array();
				$countEvaluadores=0;
				$result = mysqli_query($dbcon,$sql);
	            {
					while($row = mysqli_fetch_assoc($result)) 
					{
						$evaluadores[$countEvaluadores] = array($row["id"],$row["id_paralelo"]);
						$countEvaluadores++;
					}
				}
				$sql="SELECT l.id,l.id_paralelo FROM c_login l, c_perfil p WHERE l.perfil=p.id AND l.habilitado=1 AND p.habilitado=1 AND p.id=".$idEvaluado;
				$evaluados=array();
				$countEvaluados=0;
				$result = mysqli_query($dbcon,$sql);
	            {
					while($row = mysqli_fetch_assoc($result)) 
					{
						$evaluados[$countEvaluados] = array($row["id"],$row["id_paralelo"]);
						$countEvaluados++;
					}
				}
				if($idTipoEvaluacion==2)
				{
					
			        for($x=0;$x<$countEvaluadores;$x++)
					{						
						$sql = "insert into datos_dtl(id_pregunta,id_seccion,id_tipoevaluacion,id_evaluado,id_evaluador,id_planevaluacion,id_satisfaccion,id_datos,id_paralelo,habilitado) values(".$idPregunta.",".$idSeccion.",".$idTipoEvaluacion.",".$evaluadores[$x][0].",".$evaluadores[$x][0].",".$idPlanEvaluacion.",5,".$last_id.",".$evaluadores[$x][1].",1)";
				        if(mysqli_query($dbcon,$sql))
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
				}
				else if($idTipoEvaluacion==3)
				{
					for($x=0;$x<$countEvaluadores;$x++)
					{
						for($y=0;$y<$countEvaluados;$y++)
						{
							if($evaluadores[$x][0]!=$evaluados[$y][0])
							{
								$sql = "insert into datos_dtl(id_pregunta,id_seccion,id_tipoevaluacion,id_evaluado,id_evaluador,id_planevaluacion,id_satisfaccion,id_datos,id_paralelo,habilitado) values(".$idPregunta.",".$idSeccion.",".$idTipoEvaluacion.",".$evaluados[$y][0].",".$evaluadores[$x][0].",".$idPlanEvaluacion.",5,".$last_id.",".$evaluadores[$x][1].",1)";
						        if(mysqli_query($dbcon,$sql))
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
						}
					}	
				}
				else
				{
					for($x=0;$x<$countEvaluadores;$x++)
					{
						for($y=0;$y<$countEvaluados;$y++)
						{
							$sql = "insert into datos_dtl(id_pregunta,id_seccion,id_tipoevaluacion,id_evaluado,id_evaluador,id_planevaluacion,id_satisfaccion,id_datos,id_paralelo,habilitado) values(".$idPregunta.",".$idSeccion.",".$idTipoEvaluacion.",".$evaluados[$y][0].",".$evaluadores[$x][0].",".$idPlanEvaluacion.",5,".$last_id.",".$evaluadores[$x][1].",1)";
					        if(mysqli_query($dbcon,$sql))
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
					}	
				}        	
            }
			if($updStatus == 1)
	        {
	        	mysqli_commit($dbcon);			
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }
            return $updStatus;
		}*/
		public function actualizarDataDatos($dbcon,$pregunta,$idSeccion,$idTipoEvaluacion,$idEvaluado,$idEvaluador,$idPlanEvaluacion,$table,$DEBUG_STATUS)
		{
			$updStatus = 0;

			$sql="select id from preguntas p where p.id_seccion=".$idSeccion." and p.id_tipoevaluacion=".$idTipoEvaluacion." and p.nombre='".$pregunta."'";


			$result = mysqli_query($dbcon,$sql);
            
			if(mysqli_num_rows($result) == 0)
			{
				$sql="insert into preguntas(nombre,id_seccion,id_tipoevaluacion,habilitado) values('".$pregunta."',".$idSeccion.",".$idTipoEvaluacion.",1)";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$idPregunta = mysqli_insert_id($dbcon);
		        	mysqli_commit($dbcon);
		        	$updStatus = 1;
		        }
		        else
		        {
		        	//echo("Error description: " . mysqli_error($dbcon));
		        	$updStatus=0;
		        	mysqli_rollback($dbcon);
		        }	
			}
			else if(mysqli_num_rows($result) == 1)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$idPregunta = $row["id"];
					$updStatus = 1;
				}
			}
			else
			{
				$updStatus = 2;
			}

			//echo 'IDPREGUNTA:'.$idPregunta.'<br>';


			if($updStatus==1)
			{
				$sql = "insert into datos(id_pregunta,id_seccion,id_tipoevaluacion,id_evaluado,id_evaluador,id_planevaluacion,id_satisfaccion,habilitado) values(".$idPregunta.",".$idSeccion.",".$idTipoEvaluacion.",".$idEvaluado.",".$idEvaluador.",".$idPlanEvaluacion.",5,1)";
		        if(mysqli_query($dbcon,$sql))
		        {
		        	//mysqli_commit($dbcon);
		        	$updStatus = 1;		
		        	$last_id = mysqli_insert_id($dbcon);			
		        }
		        else
		        {
		        	$updStatus = 3;
		        	//mysqli_rollback($dbcon);
		        }
		        if($updStatus==1)
		        {
		        	$updStatus = 0;
					$sql="SELECT l.id,l.id_paralelo FROM c_login l, c_perfil p WHERE l.perfil=p.id AND l.habilitado=1 AND p.habilitado=1 AND p.id=".$idEvaluador;
					$evaluadores=array();
					$countEvaluadores=0;
					$result = mysqli_query($dbcon,$sql);
		            {
						while($row = mysqli_fetch_assoc($result)) 
						{
							$evaluadores[$countEvaluadores] = array($row["id"],$row["id_paralelo"]);
							$countEvaluadores++;
						}
					}
					$sql="SELECT l.id,l.id_paralelo FROM c_login l, c_perfil p WHERE l.perfil=p.id AND l.habilitado=1 AND p.habilitado=1 AND p.id=".$idEvaluado;
					$evaluados=array();
					$countEvaluados=0;
					$result = mysqli_query($dbcon,$sql);
		            {
						while($row = mysqli_fetch_assoc($result)) 
						{
							$evaluados[$countEvaluados] = array($row["id"],$row["id_paralelo"]);
							$countEvaluados++;
						}
					}
					if($idTipoEvaluacion==2)
					{
						
				        for($x=0;$x<$countEvaluadores;$x++)
						{						
							$sql = "insert into datos_dtl(id_pregunta,id_seccion,id_tipoevaluacion,id_evaluado,id_evaluador,id_planevaluacion,id_satisfaccion,id_datos,id_paralelo,habilitado) values(".$idPregunta.",".$idSeccion.",".$idTipoEvaluacion.",".$evaluadores[$x][0].",".$evaluadores[$x][0].",".$idPlanEvaluacion.",5,".$last_id.",".$evaluadores[$x][1].",1)";
					        if(mysqli_query($dbcon,$sql))
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
					}
					else if($idTipoEvaluacion==3)
					{
						for($x=0;$x<$countEvaluadores;$x++)
						{
							for($y=0;$y<$countEvaluados;$y++)
							{
								if($evaluadores[$x][0]!=$evaluados[$y][0])
								{
									$sql = "insert into datos_dtl(id_pregunta,id_seccion,id_tipoevaluacion,id_evaluado,id_evaluador,id_planevaluacion,id_satisfaccion,id_datos,id_paralelo,habilitado) values(".$idPregunta.",".$idSeccion.",".$idTipoEvaluacion.",".$evaluados[$y][0].",".$evaluadores[$x][0].",".$idPlanEvaluacion.",5,".$last_id.",".$evaluadores[$x][1].",1)";
							        if(mysqli_query($dbcon,$sql))
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
							}
						}	
					}
					else
					{
						for($x=0;$x<$countEvaluadores;$x++)
						{
							for($y=0;$y<$countEvaluados;$y++)
							{
								$sql = "insert into datos_dtl(id_pregunta,id_seccion,id_tipoevaluacion,id_evaluado,id_evaluador,id_planevaluacion,id_satisfaccion,id_datos,id_paralelo,habilitado) values(".$idPregunta.",".$idSeccion.",".$idTipoEvaluacion.",".$evaluados[$y][0].",".$evaluadores[$x][0].",".$idPlanEvaluacion.",5,".$last_id.",".$evaluadores[$x][1].",1)";
						        if(mysqli_query($dbcon,$sql))
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
						}	
					}        	
	            }
				if($updStatus == 1)
		        {
		        	mysqli_commit($dbcon);			
		        }
		        else
		        {
		        	mysqli_rollback($dbcon);
		        }
		    }				
            return $updStatus;
		}
		public function obtenerDataResEvaluacion($dbcon,$id,$table,$DEBUG_STATUS)
		{
			if($id==0)
				$sql="SELECT id,nombre,satisfaccion,habilitado FROM ".$table." sm where habilitado=1 order by nombre";
			else
				$sql="SELECT id, nombre,satisfaccion,habilitado FROM ".$table." where habilitado=1 and id=".$id." order by nombre";
			//echo $sql;
			$data=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$data[$count] = array($row["id"],$row["nombre"],$row["satisfaccion"]);
					$count++;
				}
			}
			return $data;
		}
		public function actualizarDataResEvaluacion($dbcon,$id,$nombre,$satisfaccion,$table,$DEBUG_STATUS)
		{
			$updStatus = 0;
			if($id==0)
				$sql = "insert into ".$table."(nombre,satisfaccion,habilitado) values('".$nombre."',".$satisfaccion.",1)";
			else
				$sql = "update ".$table." set nombre='".$nombre."',satisfaccion=".$satisfaccion." where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function obtenerListaEvaluacion($dbcon,$id,$DEBUG_STATUS)
		{
			$sql="SELECT DISTINCT p.id,p.nombre,p.ano FROM planevaluacion p where habilitado=1 order by p.ano, p.nombre";
			//echo $sql;
			$data=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$data[$count] = array($row["id"],$row["ano"].'--'.$row["nombre"]);
					$count++;
				}
			}
			return $data;
		}
		public function obtenerListaEvaluacionPorAnoDesc($dbcon,$id,$DEBUG_STATUS)
		{
			/*$sql="SELECT DISTINCT pe.id, pe.nombre evaluacion_desc,pe.ano,l.nombre nombre_evaluado,l.id id_evaluado FROM planevaluacion pe, datos d, c_perfil p, c_login l 
			WHERE pe.id=d.id_planevaluacion AND p.id=d.id_evaluado AND p.id=l.perfil AND pe.habilitado=1 and d.habilitado=1 AND p.habilitado=1 and l.habilitado=1 and d.id_evaluador=".$_SESSION["user_perfil"];*/
			/*$sql="SELECT DISTINCT pe.id, pe.nombre evaluacion_desc,pe.ano,l.nombre nombre_evaluado,l.id id_evaluador FROM planevaluacion pe, datos d, c_perfil p, c_login l 
			WHERE pe.id=d.id_planevaluacion AND p.id=d.id_evaluado AND p.id=l.perfil AND pe.habilitado=1 and d.habilitado=1 AND p.habilitado=1 and l.habilitado=1 and d.id_evaluador=".$_SESSION["user_perfil"]." and l.id=".$_SESSION["user_id"];*/

			$sql="SELECT distinct pe.id, pe.nombre evaluacion_desc,pe.ano, c.nombre nombre_evaluado, c.id id_evaluado FROM datos_dtl d, datos dt, c_login c,planevaluacion pe WHERE d.id_planevaluacion=pe.id AND d.id_evaluado=c.id AND dt.id=d.id_datos AND dt.habilitado=1 AND d.habilitado=1 and pe.habilitado=1  and c.habilitado=1 AND d.id_evaluador=".$_SESSION["user_id"];
			if($id!=0)
				$sql=$sql." and pe.id=".$id;
			$sql=$sql." order by pe.id,pe.ano, pe.nombre,nombre_evaluado";
			//echo $sql;
			$data=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$data[$count] = array($row["id"],$row["ano"].'--'.$row["evaluacion_desc"],$row["nombre_evaluado"],$row["id_evaluado"]);
					$count++;
				}
			}
			return $data;
		}
		public function obtenerPreguntasDeEvaluacion($dbcon,$id_planevaluacion,$id_evaluado,$DEBUG_STATUS)
		{
			$sql="SELECT d.id, p.nombre, d.id_evaluador, d.id_evaluado, d.id_satisfaccion FROM datos_dtl d, datos dt, preguntas p,planevaluacion pe 
			WHERE d.id_planevaluacion=pe.id AND d.id_pregunta=p.id AND dt.id=d.id_datos AND dt.habilitado=1 AND d.habilitado=1 AND d.id_evaluador=".$_SESSION["user_id"];
			if($id_planevaluacion!=0)
				$sql=$sql." and d.id_planevaluacion=".$id_planevaluacion;
			if($id_evaluado!=0)
				$sql=$sql." and d.id_evaluado=".$id_evaluado;
			//echo $sql;
			$data=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$data[$count] = array($row["id"],$row["nombre"],$row["id_satisfaccion"]);
					$count++;
				}
			}
			return $data;
		}
		public function actualizarPreguntasDeEvaluacion($dbcon,$res,$table,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$respuestas = explode("|", $res);
			//echo count($respuestas).'<br>';
			for($x=0;$x<count($respuestas)-1;$x++)
			{
				$r=explode("~",$respuestas[$x]);
				$sql = "update ".$table." set id_satisfaccion=".$r[1]." where id=".$r[0];
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	//mysqli_commit($dbcon);
		        	$updStatus = 1;					
		        }
		        else
		        {
		        	$updStatus = 0;
		        }
			}
			if($updStatus == 1)
	        {
	        	mysqli_commit($dbcon);			
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;
		}

		public function obtenerDataTipoEvaluacionYSeccion($dbcon,$idTiEv,$idSec,$table,$DEBUG_STATUS)
		{
			$sql="SELECT id,id_tipoEvaluacion,id_seccion,(select te.nombre from tipoevaluacion te where te.id=sm.id_tipoEvaluacion) nombre_tipoEvaluacion,(select s.nombre from seccion s where s.id=sm.id_seccion) nombre_seccion FROM ".$table." sm where habilitado=1";
			
			if($idTiEv!=0)
				$sql=$sql." and id_tipoEvaluacion=".$idTiEv;
			if($idSec!=0)
				$sql=$sql." and id_seccion=".$idSec;
			$sql=$sql." order by id_tipoEvaluacion,id_seccion";
			
			$data=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$data[$count] = array($row["id"],$row["id_tipoEvaluacion"],$row["nombre_tipoEvaluacion"],$row["id_seccion"],$row["nombre_seccion"]);
					$count++;
				}
			}
			return $data;
		}
		public function actualizarDataTipoEvaluacionYSeccion($dbcon,$idTiEv,$idSec,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "insert into mappingtipoevaluacionsecion(id_tipoEvaluacion,id_seccion,habilitado) values(".$idTiEv.",".$idSec.",1)";
			
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	echo("Error description: " . mysqli_error($dbcon));
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}
		public function deshabilitarDataTipoEvaluacionYSeccion($dbcon,$id,$tid,$sid,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql="select id from datos u where u.id_tipoevaluacion = ".$tid." and u.id_seccion = ".$sid."  and habilitado=1";
			$result = mysqli_query($dbcon,$sql);
			if(mysqli_num_rows($result) == 0)
			{
				$sql = "update mappingtipoevaluacionsecion set habilitado=habilitado*(-1)+1 where id=$id";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        	$updStatus = 1;
		        }
		        else
		        {
		        	mysqli_rollback($dbcon);
		        }	
		    }
		    else
		    {
		    	$updStatus = 2;
		    }       	
            return $updStatus;			
		}

		public function getSeccionPorTipoEvaluacion($dbcon,$tid,$DEBUG_STATUS)
		{
			if($tid==0)
				$sql="select m.id_seccion,(select s.nombre from seccion s where s.habilitado=1 and m.id_seccion=s.id) nombre_seccion from mappingtipoevaluacionsecion m, tipoevaluacion t where t.habilitado=1 and m.habilitado and m.id_tipoEvaluacion=t.id";
			else
				$sql="select m.id_seccion,(select s.nombre from seccion s where s.habilitado=1 and m.id_seccion=s.id) nombre_seccion from mappingtipoevaluacionsecion m, tipoevaluacion t where t.habilitado=1 and m.habilitado and m.id_tipoEvaluacion=t.id and m.id_tipoEvaluacion=".$tid;

			$data=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$data[$count] = array($row["id_seccion"],$row["nombre_seccion"]);
					$count++;
				}
			}
			return $data;
		}

		public function actualizarDataSeccion($dbcon,$id,$nombre_seccion,$DEBUG_STATUS)
		{
			$updStatus = 0;
			if($id==0)
				$sql = "insert into seccion(nombre,habilitado) values('".$nombre_seccion."',1)";
			else
				$sql = "update seccion set nombre='".$nombre_seccion."' where id=$id";
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;					
	        }
	        else
	        {
	        	//echo("Error description: " . mysqli_error($dbcon));
	        	$updStatus=0;
	        	mysqli_rollback($dbcon);
	        }	        	
            return $updStatus;			
		}

		public function deshabilitarSeccionData($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql="select id from datos d where d.id_seccion = ".$id." and habilitado=1";
			$result = mysqli_query($dbcon,$sql);
			if(mysqli_num_rows($result) == 0)
			{
				$sql = "update seccion set habilitado=habilitado*(-1)+1 where id=$id";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        	$updStatus = 1;
		        }
		        else
		        {
		        	mysqli_rollback($dbcon);
		        }	
		    }
		    else
		    {
		    	$updStatus = 2;
		    }       	
            return $updStatus;			
		}
	}
?>