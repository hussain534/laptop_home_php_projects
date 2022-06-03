<?php
	//session_start();
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


		public function loginUser($dbcon,$user_email,$user_password,$DEBUG_STATUS)
		{
			//OK
			$sql="select u.id, u.nombre,u.email,u.clave,u.perfil, u.telefono, u.celular, u.ubicacion,id_client,(select p.nombre from c_perfil p where u.perfil=p.id) perfil_nombre from c_login u
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
            	}
            	if(strcmp($userPwd, $user_password)==0)
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
            		$clave=mt_rand();
            		
            		$sql = "update c_login set clave='".$clave."' where email = '".$user_email."'";
					if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus = 1;
			        	//$updStatus = $clave;
			        }

					$to = $user_email;
					$subject = 'SMART CONCIL- RECUPERACION CLAVE';
					$txt = '¡HOLA, '.$nombre.'!'."<br><br>";
					$txt=$txt.'Se ha solicitado recuperar la clave para su cuenta en SMART CONCIL'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.$user_email.' con siguiente clave para iniciar sesión'."<br><br>";
					$txt=$txt.'CLAVE:'.$clave."<br><br>";
					$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en support@smart-concil.com'."<br><br>";
					$txt=$txt.'MUCHAS GRACIAS'."<br><br>";
					

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					//$headers .= 'From:info@hutesol.com' . "\r\n";
					//$headers .= 'CC: olguercalvache@gmail.com';
					$headers .= 'From:SMART CONCIL <concil@merakiminds.com>' . "\r\n";
					//$headers .= 'CC: fernandoa@nipromed.com';
					//$headers .= 'BCC: fernandoa@nipromed.com';

					$res=mail($to,$subject,$txt,$headers);
					if($res==true)
					{
						$updStatus = 1;
					}
					else
					{
						$sql = "update c_login set clave='".$password."' where email = '".$user_email."'";
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
			$sql="select id,nombre,clave password from c_login u where u.email = '".$_SESSION["user_email"]."' and clave='".$clave_anterior."'";
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

            		$sql = "update c_login set clave='".$clave_nuevo."' where email = '".$_SESSION["user_email"]."'";
					if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus = 1;
			        }

					$to = $_SESSION["user_email"];
					$subject = 'SMART CONCIL - CAMBIO DE CLAVE';
					$txt = '¡HOLA, '.$nombre.'!'."<br><br>";
					$txt=$txt.'Se ha solicitado cambiar la clave para su cuenta en SMART CONCIL'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.$_SESSION["user_email"].' con siguiente clave para iniciar sesión'."<br><br>";
					$txt=$txt.'CLAVE:'.$clave_nuevo."<br><br>";
					$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en support@smart-concil.com'."<br><br>";
					$txt=$txt.'MUCHAS GRACIAS'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					//$headers .= 'From:info@hutesol.com' . "\r\n";
					//$headers .= 'CC: olguercalvache@gmail.com';
					$headers .= 'From:SMART CONCIL <concil@merakiminds.com>' . "\r\n";
					//$headers .= 'CC: fernandoa@nipromed.com';
					//$headers .= 'BCC: fernandoa@nipromed.com';

					$res=mail($to,$subject,$txt,$headers);
					if($res==true)
					{
						$updStatus = 1;
					}
					else
					{
						$sql = "update c_login set clave='".$password."' where email = '".$_SESSION["user_email"]."'";
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

		public function registerUser($dbcon,$userNombre,$userEmail,$userPwd,$userTelefono,$userCelular,$userUbicacion,$userPerfil,$id_integrador,$DEBUG_STATUS)
		{
			
			$sql="select id, nombre,email, telefono, celular, ubicacion, perfil, clave, creado_por, fecha_creacion, modificado_por, fecha_modificacion,id_client from c_login 
					where email = '".strtoupper($userEmail)."' and habilitado=1";
			mysqli_autocommit($dbcon,FALSE);
			$result = mysqli_query($dbcon,$sql);
			$updStatus=0;
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO c_login(nombre,email,telefono, celular, ubicacion, perfil,clave,creado_por, fecha_creacion,modificado_por,fecha_modificacion,id_client,habilitado) 
				values('".$userNombre."','".$userEmail."','".$userTelefono."','".$userCelular."','".$userUbicacion."',".$userPerfil.",'".$userPwd."',1,now(),1,now(),".$id_integrador.",1)";
				//echo $sql.'<br>';
		        
		        if(mysqli_query($dbcon,$sql))
		        {
		        	/*$to = strtoupper($user_email);
					$subject = 'MERAKI PM- REGISTRO DE USUARIO';
					$txt = '¡HOLA, '.strtoupper($user_name).'!'."<br><br>";
					$txt=$txt.'Gracias por inscribirse en MERAKI PM'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.strtoupper($user_email).' y tu clave ingresada el momento del registro para iniciar sesión.'."<br><br>";
					$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					$headers .= 'From:MERAKI PM <info@merakiminds.com>' . "\r\n";
					
					$res=mail($to,$subject,$txt,$headers);
					if($res==true)
					{*/
						mysqli_commit($dbcon);
		        		$updStatus = 1;
					/*}
					else
					{
						$updStatus = 9;
						mysqli_rollback($dbcon);
					}*/
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

		public function listaProveedores($dbcon,$id,$DEBUG_STATUS)
		{
			if($id!=0)
				$sql="select id,nombre, email,email_adicionales, ruc, nro_contacto from c_proveedor where id=".$id." and habilitado=1";
			else
				$sql="select id,nombre, email,email_adicionales, ruc, nro_contacto from c_proveedor where habilitado=1";
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

		public function actualizarProveedorData($dbcon,$id,$ruc,$nombre,$email,$contacto,$emailAdicionales,$DEBUG_STATUS)
		{
			$updStatus = 0;
			if($id==0)
				$sql = "insert into c_proveedor(ruc, nombre, email, email_adicionales,nro_contacto, creado_por,fecha_creacion,modificado_por,fecha_modificacion,habilitado) 
						values('".$ruc."','".$nombre."','".$email."','".$emailAdicionales."','".$contacto."',".$_SESSION["user_id"].",now(),".$_SESSION["user_id"].",now(),1)";
			else
				$sql = "update c_proveedor set nombre='".$nombre."',ruc='".$ruc."',email='".$email."',email_adicionales='".$emailAdicionales."',nro_contacto='".$contacto."',modificado_por=".$_SESSION["user_id"].",fecha_modificacion=now()  where id=$id";
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

		public function deshabilitarProveedorData($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update c_proveedor set habilitado=0,modificado_por=".$_SESSION["user_id"].",fecha_modificacion=now() where id=$id";
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

		public function listaCanales($dbcon,$id,$DEBUG_STATUS)
		{
			if($id!=0)
				$sql="select cc.id,(select cp.nombre from c_proveedor cp where cp.id=cc.id_prov) nombre_prov,cc.id_prov,cc.nombre, cc.email, cc.nro_contacto from c_canal cc where cc.id_prov=".$id." and cc.habilitado=1";
			else
				$sql="select cc.id,(select cp.nombre from c_proveedor cp where cp.id=cc.id_prov) nombre_prov,cc.id_prov,cc.nombre, cc.email, cc.nro_contacto from c_canal cc where cc.habilitado=1";
			//echo $sql;
			$canales=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$canales[$count] = array($row["id"],$row["nombre"],$row["email"],$row["nro_contacto"],$row["nombre_prov"],$row["id_prov"]);
					$count++;
				}
			}
			return $canales;
		}

		public function listaCanalPorId($dbcon,$id,$DEBUG_STATUS)
		{
			if($id!=0)
				$sql="select cc.id,(select cp.nombre from c_proveedor cp where cp.id=cc.id_prov) id_prov, cc.nombre, cc.email, cc.nro_contacto from c_canal cc where cc.id=".$id." and cc.habilitado=1";
			else
				$sql="select cc.id,(select cp.nombre from c_proveedor cp where cp.id=cc.id_prov) id_prov, cc.nombre, cc.email, cc.nro_contacto from c_canal cc where cc.habilitado=1";
			//echo $sql;
			$canales=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$canales[$count] = array($row["id"],$row["nombre"],$row["email"],$row["nro_contacto"],$row["id_prov"]);
					$count++;
				}
			}
			return $canales;
		}

		public function actualizarCanalData($dbcon,$iid,$cid,$nombre,$email,$contacto,$DEBUG_STATUS)
		{
			$updStatus = 0;
			if($cid==0)
				$sql = "insert into c_canal(id_prov, nombre, email, nro_contacto, creado_por,fecha_creacion,modificado_por,fecha_modificacion,habilitado) 
						values(".$iid.",'".$nombre."','".$email."','".$contacto."',".$_SESSION["user_id"].",now(),".$_SESSION["user_id"].",now(),1)";
			else
				$sql = "update c_canal set id_prov=".$iid.", nombre='".$nombre."',email='".$email."',nro_contacto='".$contacto."',modificado_por=".$_SESSION["user_id"].",fecha_modificacion=now()  where id=$cid";
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

		public function deshabilitarCanalData($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update c_canal set habilitado=0,modificado_por=".$_SESSION["user_id"].",fecha_modificacion=now() where id=$id";
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

		public function listaTxnIntegradores($dbcon,$fecha_conciliacion, $id_integrador,$DEBUG_STATUS)
		{
			$sql="select cvi.id_txn_integrador, cvi.id_integrador,cvi.id_canal,cvi.id_plan,cvi.monto, cvi.fecha_venta,cvi.fecha_carga_archivo,id_conciliacion from c_ventas_integrador cvi where DATE_FORMAT(cvi.fecha_venta,'%Y%m%d')=DATE_FORMAT('".$fecha_conciliacion."','%Y%m%d') and cvi.id_integrador=".$id_integrador." and cvi.habilitado in (1,3)";
			//echo $sql;
			$txn=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$txn[$count] = array($row["id_txn_integrador"],$row["id_integrador"],$row["id_canal"],$row["id_plan"],$row["monto"],$row["fecha_venta"],$row["fecha_carga_archivo"],$row["id_conciliacion"]);
					$count++;
				}
			}
			return $txn;
		}

		public function estadoConciliacion($dbcon,$fecha_conciliacion, $id_integrador,$DEBUG_STATUS)
		{
			$sql="select cvi.habilitado from c_conciliacion cvi where DATE_FORMAT(cvi.fecha_venta,'%Y%m%d')=DATE_FORMAT('".$fecha_conciliacion."','%Y%m%d') and cvi.id_integrador=".$id_integrador." and cvi.habilitado !=0";
			//echo $sql;
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$count=$row["habilitado"];
				}
			}
			return $count;
		}

		public function listaTxnVentas($dbcon,$fecha_conciliacion, $id_integrador,$DEBUG_STATUS)
		{
			$sql="select cvi.id_txn_interna, cvi.id_txn_integrador, cvi.id_integrador,cvi.id_canal,cvi.id_plan,cvi.monto,cvi.fecha_venta,cvi.fecha_conciliacion,id_conciliacion from c_ventas_interna cvi where DATE_FORMAT(cvi.fecha_venta,'%Y%m%d')=DATE_FORMAT('".$fecha_conciliacion."','%Y%m%d') and cvi.id_integrador=".$id_integrador." and cvi.habilitado in (1,3)";
			//echo $sql;
			$txn=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$txn[$count] = array($row["id_txn_interna"],$row["id_txn_integrador"],$row["id_integrador"],$row["id_canal"],$row["id_plan"],$row["monto"],$row["fecha_venta"],$row["fecha_conciliacion"],$row["id_conciliacion"]);
					$count++;
				}
			}
			return $txn;
		}

		public function realizarConciliacion($dbcon,$txnIntegradores,$curr_dt,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update c_ventas_interna set fecha_conciliacion=DATE_FORMAT('".$curr_dt."','%Y%m%d%H%i%s'),id_conciliacion=".$txnIntegradores[7].",habilitado=3 where id_txn_integrador=".$txnIntegradores[0]." and id_integrador=".$txnIntegradores[1]." and id_canal=".$txnIntegradores[2]." and id_plan='".$txnIntegradores[3]."' and monto=".$txnIntegradores[4]." and DATE_FORMAT(fecha_venta,'%Y%m%d')=DATE_FORMAT('".$txnIntegradores[5]."','%Y%m%d') and habilitado in (1,3)";		        
	        //echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
	        {
	        	$sql="update c_ventas_integrador set habilitado=3 where id_txn_integrador=".$txnIntegradores[0]." and id_integrador=".$txnIntegradores[1]." and id_canal=".$txnIntegradores[2]." and id_plan='".$txnIntegradores[3]."' and monto=".$txnIntegradores[4]." and DATE_FORMAT(fecha_venta,'%Y%m%d')=DATE_FORMAT('".$txnIntegradores[5]."','%Y%m%d') and habilitado in (1,3)";	
	        	//echo $sql.'<br>';
	        	if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;		        	
		        }
		        else
		        {
		        	mysqli_rollback($dbcon);
		        }	  
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            
            return $updStatus;			
		}

		public function cerrarConciliacionForzadaIntegrador($dbcon,$txnIntegradores,$curr_dt,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql="update c_ventas_integrador set habilitado=3 where id_txn_integrador=".$txnIntegradores[0]." and id_integrador=".$txnIntegradores[1]." and id_canal=".$txnIntegradores[2]." and id_plan='".$txnIntegradores[3]."' and monto=".$txnIntegradores[4]." and DATE_FORMAT(fecha_venta,'%Y%m%d')=DATE_FORMAT('".$txnIntegradores[5]."','%Y%m%d') and habilitado in (1,3)";	
        	//echo $sql.'<br>';
        	if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;		        	
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }        	
            
            return $updStatus;			
		}

		public function cerrarConciliacionForzadaInterna($dbcon,$txnIntegradores,$curr_dt,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update c_ventas_interna set fecha_conciliacion=DATE_FORMAT('".$curr_dt."','%Y%m%d%H%i%s'),id_conciliacion=".$txnIntegradores[8].",habilitado=3 where id_txn_integrador=".$txnIntegradores[1]." and id_integrador=".$txnIntegradores[2]." and id_canal=".$txnIntegradores[3]." and id_plan='".$txnIntegradores[4]."' and monto=".$txnIntegradores[5]." and DATE_FORMAT(fecha_venta,'%Y%m%d')=DATE_FORMAT('".$txnIntegradores[6]."','%Y%m%d') and habilitado in (1,3)";		        
	        //echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = 1;	  
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            
            return $updStatus;			
		}

		public function actualizarEstadoConciliacion($dbcon,$estado, $id_conciliacion,$curr_dt,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update c_conciliacion set habilitado=".$estado.",fecha_conciliacion=DATE_FORMAT('".$curr_dt."','%Y%m%d%H%i%s') where id=".$id_conciliacion." and habilitado!=0";		        
	        //echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	$sql = "update c_contenido_archivo_conciliacion set habilitado=".$estado." where id_conciliacion=".$id_conciliacion." and habilitado!=0";		        
		        //echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$updStatus = 1;
		        	mysqli_commit($dbcon);
		        }
		        else
		        {
		        	mysqli_rollback($dbcon);
		        }
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        }	        	
            
            return $updStatus;			
		}

		public function consultarConciliacionResumen($dbcon,$id_integrador,$estado, $fecha_inicio,$fecha_final,$DEBUG_STATUS)
		{
			$sql="select cc.id id_conciliacion, (select nombre from c_proveedor cp where id=cc.id_integrador) id_integrador,cc.monto,cc.cantidad, cc.fecha_venta,cc.fecha_conciliacion,
					case when cc.habilitado=1 then 'PENDIENTE' when cc.habilitado=3 then 'CONCILIADO' when cc.habilitado=7 then 'CONCILIADO FORZADO' end estado from c_conciliacion cc where cc.id_integrador=".$id_integrador." and DATE_FORMAT(cc.fecha_venta,'%Y%m%d')>=DATE_FORMAT('".$fecha_inicio."','%Y%m%d') and DATE_FORMAT(cc.fecha_venta,'%Y%m%d')<=DATE_FORMAT('".$fecha_final."','%Y%m%d')";
			if($estado!=99)
				$sql=$sql." and cc.habilitado=".$estado;
			else
				$sql=$sql." and cc.habilitado!=0";
			//echo $sql;
			$txn=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$txn[$count] = array($row["id_conciliacion"],$row["id_integrador"],$row["monto"],$row["cantidad"],$row["fecha_venta"],$row["fecha_conciliacion"],$row["estado"]);
					$count++;
				}
			}
			return $txn;
		}

		public function consultarConciliacionDetalles($dbcon,$id_conciliacion,$DEBUG_STATUS)
		{
			$sql="select ci.id_conciliacion,ci.id_txn_integrador,ci.id_txn_interna,ci.id_integrador,ci.id_canal,ci.id_plan,ci.monto,ci.fecha_venta,ci.fecha_conciliacion from c_ventas_interna ci where ci.id_conciliacion=".$id_conciliacion." and ci.habilitado!=0";
			//echo $sql;
			$txn=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$txn[$count] = array($row["id_conciliacion"],$row["id_txn_integrador"],$row["id_txn_interna"],$row["id_integrador"],$row["id_canal"],$row["id_plan"],$row["monto"],$row["fecha_venta"],$row["fecha_conciliacion"]);
					$count++;
				}
			}
			return $txn;
		}

		public function getMenuList($dbcon,$id,$DEBUG_STATUS)
		{
			if($id==0)
				$sql="SELECT id, id_menu, nombre_menu, url, habilitado FROM c_menu where habilitado='1' and url!='#' order by id_menu";
			else
				$sql="SELECT id, id_menu, nombre_menu, url, habilitado FROM c_menu where habilitado='1' and url!='#' and id=".$id." order by id_menu";
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
			if($id==0)
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
			if($id==0)
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

		public function obtenerPerfilPermisos($dbcon,$idPerfil,$idMenu,$DEBUG_STATUS)
		{
			$sql="SELECT pm.id, pf.id pf_id,pf.nombre pf_nombre,mn.id mn_id,mn.nombre_menu mn_nombre FROM c_permisos pm,c_perfil pf, c_menu mn where pm.habilitado=1";
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

		public function getArchivoConcilFormatos($dbcon,$DEBUG_STATUS)
		{
			$sql="SELECT id, nombre_data,tipo_data,posicion, tamano, case when mandatorio=1 then 'SI' else 'NO' end mandatorio FROM c_formato_archivo_concil order by posicion";
			//echo $sql;
			$txn=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$txn[$count] = array($row["id"],$row["nombre_data"],$row["tipo_data"],$row["posicion"],$row["tamano"],$row["mandatorio"]);
					$count++;
				}
			}
			return $txn;
		}

		public function listaFileServerData($dbcon,$id,$DEBUG_STATUS)
		{
			if($id!=0)
				$sql="select id,id_integrador,(select nombre from c_proveedor cp where cp.id=fs.id_integrador) nombre_proveedor ,ip_servidor,ruta,usuario,clave,(select intervalo from c_auto_concil_intervalos aci where aci.id=fs.id_intervalo) intervalo,fs.id_intervalo from c_config_file_server fs where id=".$id." and habilitado=1";
			else
				$sql="select id,id_integrador,(select nombre from c_proveedor cp where cp.id=fs.id_integrador) nombre_proveedor ,ip_servidor,ruta,usuario,clave,(select intervalo from c_auto_concil_intervalos aci where aci.id=fs.id_intervalo) intervalo,fs.id_intervalo from c_config_file_server fs where habilitado=1";
			//echo $sql;
			$proveedores=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$proveedores[$count] = array($row["id"],$row["nombre_proveedor"],$row["id_integrador"],$row["ip_servidor"],$row["ruta"],$row["usuario"],$row["clave"],$row["intervalo"],$row["id_intervalo"]);
					$count++;
				}
			}
			return $proveedores;
		}

		public function actualizarFileServerData($dbcon,$id,$id_integrador,$ip_servidor,$ruta,$usuario,$clave,$intervalo,$DEBUG_STATUS)
		{
			$updStatus = 0;
			if($id==0)
				$sql = "insert into c_config_file_server(id_integrador, ip_servidor,ruta,usuario,clave,id_intervalo,habilitado) values(".$id_integrador.",'".$ip_servidor."','".$ruta."','".$usuario."','".$clave."',".$intervalo.",1)";
			else
				$sql = "update c_config_file_server set ip_servidor='".$ip_servidor."',ruta='".$ruta."',usuario='".$usuario."',clave='".$clave."',id_intervalo=".$intervalo." where id=$id";
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

		public function deshabilitarFileServerData($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update c_config_file_server set habilitado=habilitado*(-1)+1 where id=$id";
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

		public function listaAutoConcilIntervalos($dbcon,$DEBUG_STATUS)
		{
			$sql="select id,intervalo from c_auto_concil_intervalos ci order by intervalo";
			//echo $sql;
			$proveedores=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$proveedores[$count] = array($row["id"],$row["intervalo"]);
					$count++;
				}
			}
			return $proveedores;
		}
	}
?>