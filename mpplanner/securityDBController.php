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

		

		public function getMenuList($dbcon,$id,$DEBUG_STATUS)
		{
			if($id==0)
				$sql="SELECT id, id_menu, menu_name, url, enabled FROM menu where url!='#' order by id_menu";
			else
				$sql="SELECT id, id_menu, menu_name, url, enabled FROM menu where url!='#' and id=".$id." order by id_menu";
			//echo $sql;
			$txn=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$txn[$count] = array($row["id"],$row["id_menu"],$row["menu_name"],$row["url"],$row["enabled"]);
					$count++;
				}
			}
			return $txn;
		}

		public function updateMenuData($dbcon,$id,$id_menu,$menu_name,$url,$DEBUG_STATUS)
		{
			$updStatus = 9999;
			if($id==0)
				$sql = "insert into menu(id_menu, menu_name, url,enabled) values(".$id_menu.",'".$menu_name."','".$url."','1')";
			else
				$sql = "update menu set id_menu=".$id_menu.",menu_name='".$menu_name."',url='".$url."' where id=$id";
			//echo $sql.'<br>';
		        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 121;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        	$updStatus = 122;
	        }	        	
            
            return $updStatus;			
		}

		public function disableMenuData($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 9999;
			$sql = "update menu set enabled=enabled*(-1)+1 where id=$id";
			//echo $sql.'<br>';
		        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 123;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        	$updStatus = 125;
	        }	        	
            
            return $updStatus;			
		}

		public function getClientList($dbcon,$id,$DEBUG_STATUS)
		{
			if($_SESSION["user_id_company"]==1)
			{
				if($id==0)
					$sql="SELECT id, name, website, company_unique_id, enabled FROM company order by name";
				else
					$sql="SELECT id, name, website, company_unique_id, enabled FROM company where id=".$id." order by name";
			}
			else
			{
				if($id==0)
					$sql="SELECT id, name, website, company_unique_id, enabled FROM company where id=".$_SESSION["user_id_company"]." order by name";
				else
					$sql="SELECT id, name, website, company_unique_id, enabled FROM company where id=".$id." order by name";
			}
			//echo $sql;
			$txn=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$txn[$count] = array($row["id"],$row["name"],$row["website"],$row["company_unique_id"],$row["enabled"]);
					$count++;
				}
			}
			return $txn;
		}

		public function updateClientData($dbcon,$id,$client_name,$client_website,$client_unique_id,$DEBUG_STATUS)
		{
			$updStatus = 9999;
			if($id==0)
				$sql = "insert into company(name,website, company_unique_id,enabled) values('".$client_name."','".$client_website."','".$client_unique_id."',1)";
			else
				$sql = "update company set name='".$client_name."',website='".$client_website."',company_unique_id='".$client_unique_id."' where id=$id";
			//echo $sql.'<br>';
		        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 151;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        	$updStatus = 153;
	        }	        	
            
            return $updStatus;			
		}

		public function disableClientData($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 9999;
			$sql = "update company set enabled=enabled*(-1)+1 where id=$id";
			//echo $sql.'<br>';
		        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 153;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        	$updStatus = 155;
	        }	  	        	
            
            return $updStatus;			
		}


		public function getPerfilList($dbcon,$id,$DEBUG_STATUS)
		{
			if($id==0)
				$sql="select p.id profile_id,p.name profile_name,c.id company_id,c.name company_name,p.enabled from profile p, company c where p.id_company=c.id order by p.name";
			else
				$sql="select p.id profile_id,p.name profile_name,c.id company_id,c.name company_name,p.enabled from profile p, company c where p.id_company=c.id and p.id=".$id." order by p.name";
			//echo $sql;
			$txn=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$txn[$count] = array($row["profile_id"],$row["profile_name"],$row["company_id"],$row["company_name"],$row["enabled"]);
					$count++;
				}
			}
			return $txn;
		}

		public function updateProfileData($dbcon,$id,$profile_name,$id_company,$DEBUG_STATUS)
		{
			$updStatus = 9999;
			if($id==0)
				$sql = "insert into profile(name,id_company,enabled) values('".$profile_name."',".$id_company.",1)";
			else
				$sql = "update profile set name='".$profile_name."',id_company=".$id_company." where id=$id";
			//echo $sql.'<br>';
		        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 131;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        	$updStatus = 133;
	        }	        	
            
            return $updStatus;			
		}

		public function disableProfileData($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 9999;
			$sql = "update profile set enabled=enabled*(-1)+1 where id=$id";
			//echo $sql.'<br>';
		        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 133;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        	$updStatus = 135;
	        }	  	        	
            
            return $updStatus;			
		}

		public function obtainAccessList($dbcon,$idprofile,$idMenu,$DEBUG_STATUS)
		{
			$sql="SELECT pm.id, f.id pf_id,f.name pf_name,m.id mn_id,m.menu_name mn_name,pm.enabled FROM profile_menu_rn pm,profile f, menu m where pm.enabled>=0";
			if($idprofile!=0)
				$sql=$sql." and pm.id_profile=".$idprofile;
			if($idMenu!=0)
				$sql=$sql." and pm.id_menu=".$idMenu;
			$sql=$sql." and pm.id_profile=f.id and pm.id_menu=m.id order by f.name, m.menu_name";
			//echo $sql;
			$data=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$data[$count] = array($row["id"],$row["pf_id"],$row["pf_name"],$row["mn_id"],$row["mn_name"],$row["enabled"]);
					$count++;
				}
			}
			return $data;
		}

		public function updateAccessList($dbcon,$id,$id_profile,$idMenu,$DEBUG_STATUS)
		{
			$updStatus = 9999;
			if($id==0)
				$sql = "insert into profile_menu_rn(id_profile,id_menu,enabled) values(".$id_profile.",".$idMenu.",1)";
			else
				$sql = "update profile_menu_rn set id_profile=".$id_profile.",id_menu=".$idMenu." where id=$id";
			//echo $sql.'<br>';
		        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 141;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        	$updStatus = 142;
	        }        	
            
            return $updStatus;			
		}

		public function disableAccess($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 9999;
			$sql = "update profile_menu_rn set enabled=enabled*(-1)+1 where id=$id";
			//echo $sql.'<br>';
		        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 143;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        	$updStatus = 145;
	        }	        	
            
            return $updStatus;			
		}

		public function getUserList($dbcon,$id,$DEBUG_STATUS)
		{
			if($_SESSION["user_id_company"]==1)
			{
				if($id==0)
					$sql="select ps.id user_id,ps.name user_name,ps.email user_email, ps.phone user_phone, ps.mobile user_mobile,ps.address user_address, pf.id profile_id, pf.name profile_name, cp.id client_id,cp.name client_name, ps.cost_per_hour, date_format(ps.joining_date,'%Y-%m-%d') joining_date,ps.user_red,ps.enabled from person ps,profile pf, company cp where ps.id_profile=pf.id and ps.id_company=cp.id order by cp.name, ps.name";
				else
					$sql="select ps.id user_id,ps.name user_name,ps.email user_email, ps.phone user_phone, ps.mobile user_mobile,ps.address user_address, pf.id profile_id, pf.name profile_name, cp.id client_id,cp.name client_name, ps.cost_per_hour, date_format(ps.joining_date,'%Y-%m-%d') joining_date,ps.user_red,ps.enabled from person ps,profile pf, company cp where ps.id_profile=pf.id and ps.id_company=cp.id and ps.id=".$id." order by cp.name, ps.name";	
			}
			else
			{
				if($id==0)
					$sql="select ps.id user_id,ps.name user_name,ps.email user_email, ps.phone user_phone, ps.mobile user_mobile,ps.address user_address, pf.id profile_id, pf.name profile_name, cp.id client_id,cp.name client_name, ps.cost_per_hour, date_format(ps.joining_date,'%Y-%m-%d') joining_date,ps.user_red,ps.enabled from person ps,profile pf, company cp where ps.id_profile=pf.id and ps.id_company=cp.id and cp.id=".$_SESSION["user_id_company"]." order by cp.name, ps.name";
				else
					$sql="select ps.id user_id,ps.name user_name,ps.email user_email, ps.phone user_phone, ps.mobile user_mobile,ps.address user_address, pf.id profile_id, pf.name profile_name, cp.id client_id,cp.name client_name, ps.cost_per_hour, date_format(ps.joining_date,'%Y-%m-%d') joining_date,ps.user_red,ps.enabled from person ps,profile pf, company cp where ps.id_profile=pf.id and ps.id_company=cp.id and ps.id=".$id." order by cp.name, ps.name";
			}
			//echo $sql;
			$txn=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$txn[$count] = array($row["user_id"],$row["user_name"],$row["user_email"],$row["user_phone"],$row["user_mobile"],$row["user_address"],$row["profile_id"],$row["profile_name"],$row["client_id"],$row["client_name"],$row["cost_per_hour"],$row["joining_date"],$row["user_red"],$row["enabled"]);
					$count++;
				}
			}
			return $txn;
		}

		public function getPerfilListByClient($dbcon,$cid,$DEBUG_STATUS)
		{
			$sql="select p.id profile_id,p.name profile_name,c.id company_id,c.name company_name,p.enabled from profile p, company c where p.id_company=c.id and c.id=".$cid." and p.enabled=1 order by p.name";
			//echo $sql;
			$txn=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$txn[$count] = array($row["profile_id"],$row["profile_name"]);
					$count++;
				}
			}
			return $txn;
		}

		public function register_update_User($dbcon,$id, $user_name, $user_email, $user_phone, $user_mobile, $user_address, $user_client_id, $user_profile_id, $user_cost_per_hour, $user_joining_dt, $user_red,$DEBUG_STATUS)
		{
			$updStatus = 9999;
			if($id==0)
			{
				$options = [
			        'cost' => 12,
			    ];
			    $passwd= mt_rand();
			    //$passwd='123456';
			    $clave = password_hash($passwd, PASSWORD_BCRYPT, $options);
				$sql = "insert into person(id,name, email, password, phone, mobile,address, id_profile, id_company, cost_per_hour, joining_date, user_red,enabled) values(".$id.",'".$user_name."','".$user_email."','".$clave."','".$user_phone."','".$user_mobile."','".$user_address."',".$user_profile_id.",".$user_client_id.",".$user_cost_per_hour.",date_format('".$user_joining_dt."','%Y-%m-%d'),'".$user_red."','1')";
			}
			else
				$sql = "update menu set id_menu=".$id_menu.",menu_name='".$menu_name."',url='".$url."' where id=$id";
			//echo $sql.'<br>';
		        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 161;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        	$updStatus = 162;
	        }	        	
            
            return $updStatus;			
		}

		public function disableUserData($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 9999;
			$sql = "update person set enabled=enabled*(-1)+1 where id=$id";
			//echo $sql.'<br>';
		        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 163;					
	        }
	        else
	        {
	        	mysqli_rollback($dbcon);
	        	$updStatus = 165;
	        }	        	
            
            return $updStatus;			
		}

		
	}
?>