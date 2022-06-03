<?php
	class securityDBController
	{
		public function loginUser($dbcon,$user_email,$user_password,$DEBUG_STATUS)
		{
			$sr=false;
			$sql="select u.id, u.name,u.email,u.password,u.id_profile, u.phone, u.mobile, u.address,id_company,
				(select p.name from profile p where u.id_profile=p.id) profile_name,user_red from person u
				where u.email = '".$user_email."' and u.enabled=1 ";
			echo $sql.'<br>';
			$updStatus=9999;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {            	
            	if($row = mysqli_fetch_assoc($result)) 
            	{
					$userId = $row["id"];
					$userName=$row["name"];
					$userEmail=$row["email"];
					$userPwd=$row["password"];
					$id_profile=$row["id_profile"];
					$userPhone=$row["phone"];
					$userMobile=$row["mobile"];
					$userAddress=$row["address"];
					$id_company=$row["id_company"];
					$profile_name=$row["profile_name"];
					$user_red=$row["user_red"];
            	}

            	/*if(strcmp($user_red, "000")!=0)
            	{
            		$server = "ldap://192.168.16.8/";
					$user = "ETAPA-NET\authalepo";
					$psw = "4lgRG*l1x4PXJwn";
					$dn = "OU=empresa,DC=etapa,DC=net,DC=ec";
					$search ="samaccountname=".$user_red;
					error_log("user_red!".$user_red, 0);
					$ds=ldap_connect($server);
					$sr=ldap_bind($ds, $user , $psw); 
					$sr=ldap_search($ds, $dn,$search);
					$data = ldap_get_entries($ds, $sr);    
					for ($i=0; $i<$data["count"]; $i++) 
					{
						$distinguishedName = $data[$i]["dn"];
						$user_email = $data[$i]["mail"][0];
					}
					error_log("distinguishedName!".$distinguishedName, 0);
					error_log("user_email!".$user_email, 0);
					$user=$distinguishedName;
					$psw=$user_password;
					$sr=ldap_bind($ds, $user , $psw); 
					if($sr)
						error_log("Authentication-TRUE!".$user_red, 0);
					else
						error_log("Authentication-FALSE!".$user_red, 0);
					ldap_close($ds);
            	}*/




            	//if(strcmp($userPwd, $user_password)==0 || $sr)
            	if(password_verify($user_password, $userPwd) || $sr)
            	{
            		$updStatus=101;	// LOGIN SUCCESSFULL
            		$_SESSION["user_id"]=$userId;
		        	$_SESSION["user_name"]=$userName;
					$_SESSION["user_email"]=$userEmail;
					$_SESSION["user_id_profile"]=$id_profile;
					$_SESSION["user_phone"]=$userPhone;
					$_SESSION["user_mobile"]=$userMobile;
					$_SESSION["user_address"]=$userAddress;
					$_SESSION["user_id_company"]=$id_company;
					$_SESSION["user_profile_name"]=$profile_name;
		            $_SESSION['LAST_LOGIN_TIME'] = time();
			    }
			    else
			    {
			    	$updStatus=102; //INVALID CREDENCIALES
			    }
            }
		    return $updStatus;			
		}

		public function recoverPassword($dbcon,$user_email,$DEBUG_STATUS)
		{
			$sql="select id,name,password from person u where u.email = '".$user_email."'";
			$updStatus=9999;
			$id=0;
			$name='';
			$password='';
			//$usr=array();
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {
            	if($row = mysqli_fetch_assoc($result)) 
            	{
            		$id=$row["id"];
            		$name=$row["name"];
            		$password=$row["password"];
            		
				    $options = [
				        'cost' => 12,
				    ];
				    $passwd= mt_rand();
				    //$passwd='123456';
				    $clave = password_hash($passwd, PASSWORD_BCRYPT, $options);
            		
            		$sql = "update person set password='".$clave."' where email = '".$user_email."'";
					if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus = 103;
			        	//$updStatus = $clave;
			        }

					/*$to = $user_email;
					$subject = 'METROWIFI CONCIL- RECUPERACION CLAVE';
					$txt = '¡HOLA, '.$name.'!'."<br><br>";
					$txt=$txt.'Se ha solicitado recuperar la clave para su cuenta en METROWIFI CONCIL'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.$user_email.' con siguiente clave para iniciar sesión'."<br><br>";
					$txt=$txt.'CLAVE:'.$passwd."<br><br>";
					$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en support@conciliacion-metrowifi.etapa.net.ec'."<br><br>";
					$txt=$txt.'MUCHAS GRACIAS'."<br><br>";
					

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					$headers .= 'From:METROWIFI CONCIL <concil@conciliacion-metrowifi.etapa.net.ec>' . "\r\n";
					//$headers .= 'CC: xxx@xxx.com';
					//$headers .= 'BCC: xxx@xxx.com';

					$res=mail($to,$subject,$txt,$headers);
					if($res==true)
					{
						$updStatus = 104;
					}
					else
					{
						$updStatus = 105;
					}*/
            	}
            }
            else
            {
            	$updStatus = 106;
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
            		if(password_verify($clave_anterior, $password))
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
						$subject = 'METROWIFI CONCIL - CAMBIO DE CLAVE';
						$txt = '¡HOLA, '.$nombre.'!'."<br><br>";
						$txt=$txt.'Se ha solicitado cambiar la clave para su cuenta en METROWIFI CONCIL'."<br><br>";
						$txt=$txt.'Usa la dirección de correo electrónico '.$_SESSION["user_email"].' con siguiente clave para iniciar sesión'."<br><br>";
						$txt=$txt.'CLAVE:'.$clave_nuevo."<br><br>";
						$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en support@conciliacion-metrowifi.etapa.net.ec'."<br><br>";
						$txt=$txt.'MUCHAS GRACIAS'."<br><br>";

						$headers = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
						$headers .= 'From:METROWIFI CONCIL <concil@conciliacion-metrowifi.etapa.net.ec>' . "\r\n";

						$res=mail($to,$subject,$txt,$headers);
						if($res==true)
						{
							$updStatus = 1;
						}
						/*else
						{
							$sql = "update c_login set clave='".$password."' where email = '".$_SESSION["user_email"]."'";
							if(mysqli_query($dbcon,$sql))
					        {
					        	$updStatus = 2;
					        }
						}*/
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

		public function registerUser($dbcon,$userNombre,$userEmail,$userPwd,$userTelefono,$userCelular,$userUbicacion,$userPerfil,$id_integrador,$usuarioRed,$DEBUG_STATUS)
		{
			
			$sql="select id, nombre,email, telefono, celular, ubicacion, perfil, clave, creado_por, fecha_creacion, modificado_por, fecha_modificacion,id_client from c_login 
					where email = '".strtoupper($userEmail)."' and habilitado=1";
			mysqli_autocommit($dbcon,FALSE);
			$result = mysqli_query($dbcon,$sql);
			$updStatus=0;
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO c_login(nombre,email,telefono, celular, ubicacion, perfil,clave,creado_por, fecha_creacion,modificado_por,fecha_modificacion,id_client,habilitado,user_red) 
				values('".$userNombre."','".$userEmail."','".$userTelefono."','".$userCelular."','".$userUbicacion."',".$userPerfil.",'".$userPwd."',1,now(),1,now(),".$id_integrador.",1,'".$usuarioRed."')";
				//echo $sql.'<br>';
		        
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$to = strtoupper($userEmail);
					$subject = 'METROWIFI CONCIL- REGISTRO DE USUARIO';
					$txt = '¡HOLA, '.strtoupper($userNombre).'!'."<br><br>";
					$txt=$txt.'Gracias por inscribirse en METROWIFI CONCIL'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.strtoupper($userEmail).' y tu clave para iniciar sesión.'."<br><br>";
					$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					$headers .= 'From:METROWIFI CONCIL <concil@conciliacion-metrowifi.etapa.net.ec>' . "\r\n";
					
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
			$sql="select cvi.id_txn_integrador, cvi.id_integrador,cvi.id_canal,cvi.id_plan,cvi.monto, cvi.fecha_venta,cvi.fecha_carga_archivo,id_conciliacion,cvi.habilitado  
			from c_ventas_integrador cvi where DATE_FORMAT(cvi.fecha_venta,'%Y%m%d')=DATE_FORMAT('".$fecha_conciliacion."','%Y%m%d') and cvi.id_integrador=".$id_integrador." 
			and cvi.habilitado in (1,3)";
			//echo $sql;
			$txn=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$txn[$count] = array($row["id_txn_integrador"],$row["id_integrador"],$row["id_canal"],$row["id_plan"],$row["monto"],$row["fecha_venta"],$row["fecha_carga_archivo"],$row["id_conciliacion"],$row["habilitado"]);
					$count++;
				}
			}
			return $txn;
		}

		public function estadoConciliacion($dbcon,$fecha_conciliacion, $id_integrador,$DEBUG_STATUS)
		{
			$sql="select cvi.habilitado from c_conciliacion cvi where DATE_FORMAT(cvi.fecha_venta,'%Y%m%d')=DATE_FORMAT('".$fecha_conciliacion."','%Y%m%d') 
			and cvi.id_integrador=".$id_integrador." and cvi.habilitado !=0";
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
			$sql="select cvi.id_txn_interna, cvi.id_txn_integrador, cvi.id_integrador,cvi.id_canal,cvi.id_plan,cvi.monto,cvi.fecha_venta,cvi.fecha_conciliacion,id_conciliacion,cvi.habilitado 
				from c_ventas_interna cvi where DATE_FORMAT(cvi.fecha_venta,'%Y%m%d')=DATE_FORMAT('".$fecha_conciliacion."','%Y%m%d') and cvi.id_integrador=".$id_integrador." 
				and cvi.habilitado in (1,3)";
			//echo $sql;
			$txn=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$txn[$count] = array($row["id_txn_interna"],$row["id_txn_integrador"],$row["id_integrador"],$row["id_canal"],$row["id_plan"],$row["monto"],$row["fecha_venta"],$row["fecha_conciliacion"],$row["id_conciliacion"],$row["habilitado"]);
					$count++;
				}
			}
			return $txn;
		}

		public function realizarConciliacion($dbcon,$txnIntegradores,$curr_dt,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql = "update c_ventas_interna set fecha_conciliacion=DATE_FORMAT('".$curr_dt."','%Y%m%d%H%i%s'),id_conciliacion=".$txnIntegradores[7].",habilitado=3 
					where id_txn_integrador='".$txnIntegradores[0]."' and id_integrador=".$txnIntegradores[1]." and id_canal=".$txnIntegradores[2]." 
					and id_plan='".$txnIntegradores[3]."' and monto=".$txnIntegradores[4]." and DATE_FORMAT(fecha_venta,'%Y%m%d')=DATE_FORMAT('".$txnIntegradores[5]."','%Y%m%d') 
					and habilitado in (1,3)";		        
	        //echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
	        {
	        	$sql="update c_ventas_integrador set habilitado=3 where id_txn_integrador='".$txnIntegradores[0]."' and id_integrador=".$txnIntegradores[1]." 
	        			and id_canal=".$txnIntegradores[2]." and id_plan='".$txnIntegradores[3]."' and monto=".$txnIntegradores[4]." 
	        			and DATE_FORMAT(fecha_venta,'%Y%m%d')=DATE_FORMAT('".$txnIntegradores[5]."','%Y%m%d') and habilitado in (1,3)";	
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
			$sql="update c_ventas_integrador set habilitado=3 where id_txn_integrador='".$txnIntegradores[0]."' and id_integrador=".$txnIntegradores[1]." 
			and id_canal=".$txnIntegradores[2]." and id_plan='".$txnIntegradores[3]."' and monto=".$txnIntegradores[4]." 
			and DATE_FORMAT(fecha_venta,'%Y%m%d')=DATE_FORMAT('".$txnIntegradores[5]."','%Y%m%d') and habilitado in (1,3)";	
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
			$sql = "update c_ventas_interna set fecha_conciliacion=DATE_FORMAT('".$curr_dt."','%Y%m%d%H%i%s'),id_conciliacion=".$txnIntegradores[8].",habilitado=3 where id_txn_integrador='".$txnIntegradores[1]."' and id_integrador=".$txnIntegradores[2]." and id_canal=".$txnIntegradores[3]." and id_plan='".$txnIntegradores[4]."' and monto=".$txnIntegradores[5]." and DATE_FORMAT(fecha_venta,'%Y%m%d')=DATE_FORMAT('".$txnIntegradores[6]."','%Y%m%d') and habilitado in (1,3)";		        
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
			$sql = "update c_conciliacion set habilitado=".$estado.",fecha_conciliacion=DATE_FORMAT('".$curr_dt."','%Y%m%d%H%i%s') where id=".$id_conciliacion." 
			and habilitado!=0";		        
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
			$sql="select cc.id id_conciliacion, cc.id_integrador,(select nombre from c_proveedor cp where id=cc.id_integrador) integrador,cc.monto,cc.cantidad, cc.fecha_venta,cc.fecha_conciliacion,
					case when cc.habilitado=1 then 'PENDIENTE' when cc.habilitado=3 then 'CONCILIADO' when cc.habilitado=6 then 'CONCILIACION INCONSISTENTE' when cc.habilitado=7 then 'CONCILIADO FORZADO' end estado 
					from c_conciliacion cc where cc.id_integrador=".$id_integrador." and DATE_FORMAT(cc.fecha_venta,'%Y%m%d')>=DATE_FORMAT('".$fecha_inicio."','%Y%m%d') 
					and DATE_FORMAT(cc.fecha_venta,'%Y%m%d')<=DATE_FORMAT('".$fecha_final."','%Y%m%d')";
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
					$txn[$count] = array($row["id_conciliacion"],$row["integrador"],$row["monto"],$row["cantidad"],$row["fecha_venta"],$row["fecha_conciliacion"],$row["estado"],$row["id_integrador"]);
					$count++;
				}
			}
			return $txn;
		}

		public function consultarConciliacionDetalles($dbcon,$id_conciliacion,$DEBUG_STATUS)
		{
			$sql="select ci.id_conciliacion,ci.id_txn_integrador,ci.id_txn_interna,ci.id_integrador,ci.id_canal,ci.id_plan,ci.monto,ci.fecha_venta,ci.fecha_conciliacion 
				from c_ventas_interna ci where ci.id_conciliacion=".$id_conciliacion." and ci.habilitado!=0";
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