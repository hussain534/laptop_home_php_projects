<?php
if(session_status() == PHP_SESSION_NONE)
	session_start();
	class controller
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
			$sql="select u.id userid, u.name user_name,u.email,u.password,u.role,u.id_branch,client_registration_id from ct_user u
				where u.email = '".$user_email."' and u.enabled=1 ";
			////echo $sql.'<br>';
			$updStatus=9999;
			mysqli_autocommit($dbcon,FALSE);
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {            	
            	if($row = mysqli_fetch_assoc($result)) 
            	{
					$userId = $row["userid"];
					$userName=$row["user_name"];
					$userEmail=$row["email"];
					$userPwd=$row["password"];
					$userRole=$row["role"];
					$userClientId=$row["client_registration_id"];
					$userBranchId=$row["id_branch"];
            	}
            	if(strcmp($userPwd, $user_password)==0)
            	{
		        	$sql = "insert into ct_login(id_login_user,login_date) values(".$userId.",now())";
					////echo $sql.'<br>';
			        if(mysqli_query($dbcon,$sql))
			        {
			        	mysqli_commit($dbcon);		        	
			            $updStatus = 0;
			        	$_SESSION["user_id"]=$userId;
			        	$_SESSION["user_name"]=$userName;
						$_SESSION["user_email"]=$userEmail;
						$_SESSION["user_role"]=$userRole;
						$_SESSION["user_client_id"]=$userClientId;
						$_SESSION["user_branch_id"]=$userBranchId;

						/*$_SESSION["cust_id"]="0";
						$_SESSION["cust_code"]="1111111111";
						$_SESSION["cust_name"]="XXXXXXXX";
						$_SESSION["cust_address"]="XXXXXXXX";
						$_SESSION["cust_contact"]="XXXXXXXX";
						$_SESSION["cust_email"]="XXXXXXXX";
						$_SESSION["cust_type"]="0";*/
						$_SESSION["user_basket_id"]=0;
			            $_SESSION['LAST_ACTIVITY'] = time();
			        }
			        else
			        {
			        	//$updStatus=2;
			        	mysqli_rollback($dbcon);
			        }	
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
			$sql="select id,name nombre,password from ct_user u where u.email = '".$user_email."'";
			echo $sql;
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
            		
            		$sql = "update ct_user set password='".$clave."',modified_dt=now() where email = '".$user_email."'";
					if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus = 1;
			        }

					$to = $user_email;
					$subject = 'SKRIMER- RECUPERACION CLAVE';
					$txt = '¡HOLA, '.$nombre.'!'."<br><br>";
					$txt=$txt.'Se ha solicitado recuperar la clave para su cuenta en SKRIMER'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.$user_email.' con siguiente clave para iniciar sesión'."<br><br>";
					$txt=$txt.'CLAVE:'.$clave."<br><br>";
					$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en info@skrimer.com'."<br><br>";
					$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";
					$txt=$txt.'El Equipo de SKRIMER'."<br><br>";
					$txt=$txt.'Por favor ingresar a <br>www.skrimer.com'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					/*$headers .= 'From:info@hutesol.com' . "\r\n";
					$headers .= 'CC: olguercalvache@gmail.com';*/
					$headers .= 'From:SKRIMER <portal@skrimer.com>' . "\r\n";
					//$headers .= 'CC: fernandoa@nipromed.com';
					//$headers .= 'BCC: fernandoa@nipromed.com';

					$res=mail($to,$subject,$txt,$headers);
					if($res==true)
					{
						$updStatus = 1;
					}
					else
					{
						$sql = "update ct_user set password='".$password."' where email = '".$user_email."'";
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
			$sql="select id,name nombre,password from ct_user u where u.email = '".$_SESSION["user_email"]."' and password='".$clave_anterior."'";
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

            		$sql = "update ct_user set password='".$clave_nuevo."',modified_dt=now() where email = '".$_SESSION["user_email"]."'";
					if(mysqli_query($dbcon,$sql))
			        {
			        	$updStatus = 1;
			        }

					$to = $_SESSION["user_email"];
					$subject = 'SKRIMER - CAMBIO DE CLAVE';
					$txt = '¡HOLA, '.$nombre.'!'."<br><br>";
					$txt=$txt.'Se ha solicitado cambiar la clave para su cuenta en SKRIMER'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.$_SESSION["user_email"].' con siguiente clave para iniciar sesión'."<br><br>";
					$txt=$txt.'CLAVE:'.$clave_nuevo."<br><br>";
					$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros info@skrimer.com'."<br><br>";
					$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";
					$txt=$txt.'El Equipo de SKRIMER'."<br><br>";
					$txt=$txt.'Por favor ingresar a <br>www.skrimer.com'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					/*$headers .= 'From:info@hutesol.com' . "\r\n";
					$headers .= 'CC: olguercalvache@gmail.com';*/
					$headers .= 'From:SISTEC NIPRO <portal@skrimer.com>' . "\r\n";
					//$headers .= 'CC: fernandoa@nipromed.com';
					//$headers .= 'BCC: fernandoa@nipromed.com';

					$res=mail($to,$subject,$txt,$headers);
					if($res==true)
					{
						$updStatus = 1;
					}
					else
					{
						$sql = "update ct_user set password='".$password."' where email = '".$_SESSION["user_email"]."'";
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

		public function gestionCliente($dbcon,$clientTypeConstant,$client_name,$client_ruc,$client_address,$client_phone,$client_email,$DEBUG_STATUS)
		{
			
			$sql="select id, code ruc, name,address, contact,email from ct_client where code = '".$client_ruc."' and enabled=1";
			mysqli_autocommit($dbcon,FALSE);
			$result = mysqli_query($dbcon,$sql);
			$updStatus=0;
            if(mysqli_num_rows($result) == 0)
            {
            	$clave=mt_rand();

            	$sql = "INSERT INTO ct_client(client_type,code,name,address,contact,email,created_by,created_on,modified_by,modified_on,enabled) 
				values(1,'".$client_ruc."','".$client_name."','".$client_address."','".$client_phone."','".$client_email."',".$_SESSION["user_id"].",now(),".$_SESSION["user_id"].",now(),1)";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
			    {
			    	//mysqli_commit($dbcon);
			    	$id = mysqli_insert_id($dbcon);
			    	$sql = "INSERT INTO ct_user(name,password,role,id_branch,email,celular,phone,client_registration_id,enabled) 
					values('".$client_name."','".$clave."',2,0,'".$client_email."',".$client_phone.",".$client_phone.",".$id.",1)";
					//echo $sql.'<br>';
			        if(mysqli_query($dbcon,$sql))
				    {
				    	$to = strtoupper($client_email);
						$subject = 'SKRIMER- REGISTRO DEL CLIENTE';
						$txt = '¡HOLA, '.strtoupper($client_name).'!'."<br><br>";
						$txt=$txt.'Su cuenta ha creado exitosamente en SKRIMER'."<br><br>";
						$txt=$txt.'Usa la dirección de correo electrónico '.strtoupper($client_email).' y siguiente clave para iniciar sesión.'."<br><br>";
						$txt=$txt.'CLAVE:'.$clave."<br><br>";
						$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";

						$headers = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
						//$headers .= 'From:info@hutesol.com' . "\r\n";
						//$headers .= 'CC: olguercalvache@gmail.com';
						$headers .= 'From:CONJUNTOS <info@skrimer.com>' . "\r\n";
						//$headers .= 'CC: fernandoa@nipromed.com';

						$res=mail($to,$subject,$txt,$headers);

						if($res==true)
						{
							mysqli_commit($dbcon);
			        		$updStatus = 1;
						}
				    }
			    }    	
            }
            else if(mysqli_num_rows($result) > 0)
            {
            	if($row = mysqli_fetch_assoc($result)) 
            	{
            		$id=$row["id"];
            	}
            	$sql="UPDATE ct_client set name='".$client_name."',address='".$client_address."',contact='".$client_phone."',email='".$client_email."',
            			modified_by=".$_SESSION["user_id"].",modified_on=now() where code='".$client_ruc."'";
            	if(mysqli_query($dbcon,$sql))
		        {
		        	$sql="UPDATE ct_user set name='".$client_name."',celular='".$client_phone."',phone='".$client_phone."',email='".$client_email."' where client_registration_id=".$id;
	            	if(mysqli_query($dbcon,$sql))
			        {
			        	mysqli_commit($dbcon);
			        	$updStatus = 2;
			        }
		        }
            }

            return $updStatus;			
		}


		
		public function getClientesProviders($dbcon,$clientType,$DEBUG_STATUS)
		{
			/*$sql="select id,code,name,address,contact,email, (case when enabled =1 then 'HABILITADO' else 'DESHABILITADO' end) enabled,created_on, modified_on from ct_client t order by name asc";*/
			$sql="select id,code,name,address,contact,email, enabled,created_on, modified_on from ct_client t where client_type=".$clientType." order by name asc";

			//echo $sql;
			$clients=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$clients[$count] = array($row["id"],$row["code"],$row["name"],$row["address"],$row["contact"],$row["email"],$row["enabled"]);
					$count++;
				}
			}
			return $clients;
		}

		public function getClientes($dbcon,$DEBUG_STATUS)
		{
			if($_SESSION["user_role"]==1)
				$sql="select id,name from ct_client t where client_type=1 and enabled=1 order by name asc";
			else
				$sql="select id,name from ct_client t where client_type=1 and id= ".$_SESSION["user_client_id"]." and enabled=1 order by name asc";

			//echo $sql;
			$clients=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$clients[$count] = array($row["id"],$row["name"]);
					$count++;
				}
			}
			return $clients;
		}

		public function deleteCliente($dbcon,$Id,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
        	$sql = "UPDATE ct_client set enabled=((enabled*(-1))+1), modified_by=".$_SESSION["user_id"].",modified_on=now() where id=".$Id;
			//echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;
	        }
        	return $updStatus;			
		}

		public function getMiDetallesCliente($dbcon,$clientType,$DEBUG_STATUS)
		{
			/*$sql="select id,code,name,address,contact,email, (case when enabled =1 then 'HABILITADO' else 'DESHABILITADO' end) enabled,created_on, modified_on from ct_client t order by name asc";*/
			$sql="select t.id,t.code,t.name,t.address,t.contact,t.email,t.enabled,t.created_on, t.modified_on from ct_client t,ct_user u where u.client_registration_id=t.id and u.id=".$_SESSION["user_id"];

			//echo $sql;
			$clients=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$clients[$count] = array($row["id"],$row["code"],$row["name"],$row["address"],$row["contact"],$row["email"],$row["enabled"]);
					$count++;
				}
			}
			return $clients;
		}


		public function gestionDistributor($dbcon,$clientTypeConstant,$client_doc_type,$client_name,$client_ruc,$client_address,$client_phone,$client_email,$DEBUG_STATUS)
		{
			
			$sql="select id, code ruc, name,address, contact,email from ct_distributors_customers where code = '".$client_ruc."' and enabled=1";
			mysqli_autocommit($dbcon,FALSE);
			$result = mysqli_query($dbcon,$sql);
			$updStatus=0;
			if($client_doc_type==2)
				$clientTypeConstant=2;
			else
				$clientTypeConstant=3;
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO ct_distributors_customers(client_cust_type,id_type,code,name,address,contact,email,created_by,created_on,modified_by,modified_on,enabled) 
				values(".$clientTypeConstant.",".$client_doc_type.",'".$client_ruc."','".$client_name."','".$client_address."','".$client_phone."','".$client_email."',".$_SESSION["user_id"].",now(),".$_SESSION["user_id"].",now(),1)";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
			    {
			    	mysqli_commit($dbcon);
			        $updStatus = 1;
			    }    	
            }
            else if(mysqli_num_rows($result) > 0)
            {
            	$sql="UPDATE ct_distributors_customers set client_cust_type=".$clientTypeConstant.",name='".$client_name."',address='".$client_address."',contact='".$client_phone."',email='".$client_email."',
            			modified_by=".$_SESSION["user_id"].",modified_on=now() where code='".$client_ruc."'";
            	//echo $sql.'<br>';
            	if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
			        $updStatus = 2;
		        }
            }

            return $updStatus;			
		}


		
		public function getDistributors($dbcon,$clientType,$DEBUG_STATUS)
		{
			if($clientType==0)
				$sql="select id,code,name,address,contact,email, enabled,id_type,(select name from ct_ident_type where id=id_type) id_type_desc,created_on, modified_on from ct_distributors_customers t where client_cust_type in(2,3) order by name asc";
			/*$sql="select id,code,name,address,contact,email, (case when enabled =1 then 'HABILITADO' else 'DESHABILITADO' end) enabled,created_on, modified_on from ct_client t order by name asc";*/
			else
				$sql="select id,code,name,address,contact,email, enabled,id_type,(select name from ct_ident_type where id=id_type) id_type_desc,created_on, modified_on from ct_distributors_customers t where client_cust_type=".$clientType." order by name asc";

			//echo $sql;
			$distributors=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$distributors[$count] = array($row["id"],$row["code"],$row["name"],$row["address"],$row["contact"],$row["email"],$row["enabled"],$row["id_type"],$row["id_type_desc"]);
					$count++;
				}
			}
			return $distributors;
		}

		public function buscarCustByDoc($dbcon,$idType,$idNum,$DEBUG_STATUS)
		{
			$sql="select id,code,name,address,contact,email,client_cust_type from ct_distributors_customers t where client_cust_type in(2,3) and id_type=".$idType." and code=".$idNum;
			
			//echo $sql;
			$distributors=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$distributors[$count] = array($row["id"],$row["code"],$row["name"],$row["address"],$row["contact"],$row["email"]);
					$_SESSION["cust_id"]=$row["id"];
					$_SESSION["cust_code"]=$row["code"];
					$_SESSION["cust_name"]=$row["name"];
					$_SESSION["cust_address"]=$row["address"];
					$_SESSION["cust_contact"]=$row["contact"];
					$_SESSION["cust_email"]=$row["email"];
					$_SESSION["cust_type"]=$row["client_cust_type"];
					$count++;
				}
			}
			return $distributors;
		}

		public function deleteDistributor($dbcon,$Id,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
        	$sql = "UPDATE ct_distributors_customers set enabled=((enabled*(-1))+1), modified_by=".$_SESSION["user_id"].",modified_on=now() where id=".$Id;
			//echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;
	        }
        	return $updStatus;			
		}


		public function gestionBranch($dbcon,$branch_id,$branch_name,$branch_address,$branch_phone,$branch_email,$branch_emision_code,$branch_bill_start_num,$branch_bill_end_num,$DEBUG_STATUS)
		{
			
			$sql="select id, name,address, phone,email,id_client,emision_code,bill_start_num,bill_end_num from ct_branch where id = '".$branch_id."' and id_client=".$_SESSION["user_client_id"]." and enabled=1";
			mysqli_autocommit($dbcon,FALSE);
			$result = mysqli_query($dbcon,$sql);
			$updStatus=0;
            if(mysqli_num_rows($result) == 0)
            {
            	$bill_start_num=0;
            	$bill_end_num=0;
            	$sql = "INSERT INTO ct_branch(name,address,phone,email,id_client,emision_code,bill_start_num,bill_end_num,created_by,created_on,modified_by,modified_on,enabled) 
				values('".$branch_name."','".$branch_address."','".$branch_phone."','".$branch_email."',".$_SESSION["user_client_id"].",'".$branch_emision_code."',".$branch_bill_start_num.",".$branch_bill_end_num.",".$_SESSION["user_id"].",now(),".$_SESSION["user_id"].",now(),1)";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
			    {
			    	mysqli_commit($dbcon);
			        $updStatus = 1;
			    }    	
            }
            else if(mysqli_num_rows($result) > 0)
            {
            	while($row = mysqli_fetch_assoc($result)) 
				{
	            	$bill_start_num=$row["bill_start_num"];
	            	$bill_end_num=$row["bill_end_num"];
	            	$sql="UPDATE ct_branch set name='".$branch_name."',address='".$branch_address."',phone='".$branch_phone."',email='".$branch_email."',
	            			emision_code='".$branch_emision_code."',bill_start_num=".$branch_bill_start_num.",bill_end_num=".$branch_bill_end_num.",
	            			modified_by=".$_SESSION["user_id"].",modified_on=now() where id=".$branch_id." and id_client=".$_SESSION["user_client_id"];
	            	if(mysqli_query($dbcon,$sql))
			        {
			        	mysqli_commit($dbcon);
				        $updStatus = 2;
			        }
			    }
            }
            if($bill_start_num!=$branch_bill_start_num)
            {
            	$sql="update ct_branch_factura_cur_value set enabled=0 where branch_id=".$branch_id;
            	if(mysqli_query($dbcon,$sql))
		        {
		        	$sql="insert into ct_branch_factura_cur_value(branch_id,branch_factura_cur_value,enabled,modified_dt,modified_by) 
		        		values(".$branch_id.",".$branch_bill_start_num.",1,now(),".$_SESSION["user_id"].")";
	            	if(mysqli_query($dbcon,$sql))
			        {
			        	mysqli_commit($dbcon);
				        $updStatus = 3;
			        }
		        }
            }


            return $updStatus;			
		}


		
		public function getBranches($dbcon,$DEBUG_STATUS)
		{
			/*$sql="select id,code,name,address,contact,email, (case when enabled =1 then 'HABILITADO' else 'DESHABILITADO' end) enabled,created_on, modified_on from ct_client t order by name asc";*/
			$sql="select t.id,t.name,t.address,t.phone,t.email,t.emision_code,t.bill_start_num,t.bill_end_num,t.enabled,t.created_on,t.modified_on 
			from ct_branch t,ct_user u where u.id=".$_SESSION["user_id"]." and t.id_client=u.client_registration_id order by t.name asc";

			//echo $sql;
			$branches=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$branches[$count] = array($row["id"],$row["name"],$row["address"],$row["phone"],$row["email"],$row["emision_code"],$row["bill_start_num"],$row["bill_end_num"],$row["enabled"]);
					$count++;
				}
			}
			return $branches;
		}

		public function deleteBranch($dbcon,$Id,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
        	$sql = "UPDATE ct_branch set enabled=((enabled*(-1))+1), modified_by=".$_SESSION["user_id"].",modified_on=now() where id=".$Id;
			//echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;
	        }
        	return $updStatus;			
		}

		public function getRoles($dbcon,$DEBUG_STATUS)
		{
			$sql="select r.id,r.role from ct_role r where r.client_id=".$_SESSION["user_client_id"]." order by r.role asc";
			
			//echo $sql;
			$roles=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$roles[$count] = array($row["id"],$row["role"]);
					$count++;
				}
			}
			return $roles;
		}

		public function gestionUser($dbcon,$user_id,$user_name,$user_email,$user_phone,$user_role,$user_branch,$DEBUG_STATUS)
		{
			$clave=mt_rand();
			$sql="select id, name,password, role,id_branch,email,celular,phone,client_registration_id from ct_user where id=".$user_id." and enabled=1";
			mysqli_autocommit($dbcon,FALSE);
			$result = mysqli_query($dbcon,$sql);
			$updStatus=0;
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO ct_user(name,password, role,id_branch,email,celular,phone,client_registration_id,enabled) 
				values('".$user_name."','".$clave."',".$user_role.",".$user_branch.",'".$user_email."',".$user_phone.",".$user_phone.",".$_SESSION["user_client_id"].",1)";
				echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
			    {
			    	mysqli_commit($dbcon);
			        $updStatus = 1;
			    }    	
            }
            else if(mysqli_num_rows($result) > 0)
            {
            	$sql="UPDATE ct_user set name='".$user_name."',role=".$user_role.",id_branch=".$user_branch.",email='".$user_email."',
            			celular=".$user_phone.",phone=".$user_phone.", client_registration_id=".$_SESSION["user_client_id"]." where id=".$user_id;
            	//echo $sql;
            	if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
			        $updStatus = 2;
		        }
            }

            return $updStatus;			
		}


		
		public function getUsers($dbcon,$DEBUG_STATUS)
		{
			/*$sql="select id,code,name,address,contact,email, (case when enabled =1 then 'HABILITADO' else 'DESHABILITADO' end) enabled,created_on, modified_on from ct_client t order by name asc";*/
			$sql="select u.id user_id,u.name user_name,b.id branch_id,b.name branch_name,u.phone,u.celular,u.email,r.id role_id,r.role role_name,u.enabled 
					from ct_user u,ct_branch b,ct_role r where u.client_registration_id=".$_SESSION["user_client_id"]." 
					and u.id_branch=b.id and u.role=r.id order by u.name asc";

			//echo $sql;
			$branches=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$branches[$count] = array(	$row["user_id"],$row["user_name"],$row["branch_id"],$row["branch_name"],$row["phone"]
												,$row["celular"],$row["email"],$row["role_id"],$row["role_name"],$row["enabled"]);
					$count++;
				}
			}
			return $branches;
		}

		public function deleteUser($dbcon,$Id,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
        	$sql = "UPDATE ct_user set enabled=((enabled*(-1))+1) where id=".$Id;
			//echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;
	        }
        	return $updStatus;			
		}


		public function gestionInventoryItems($dbcon,$item_id,$item_name,$item_category,$item_lleva_inventario,$item_qty,$item_ppu,$item_lleva_inventario,$item_prov_ruc,$item_accion,$fecha_expiracion,$barcode,$purchase_price,$consumption_type,$alert_store,$DEBUG_STATUS)
		{
			$updStatus=0;
            if($item_accion == 0)
            {
            	$sql = "INSERT INTO ct_item(name,id_category, detail,quantity,price_per_unit,do_inventory_movement,id_provider,client_id,fecha_expiracion,enabled,bar_code,purchase_price,consumption_type,alert_store) 
				values('".$item_name."',".$item_category.",'',".$item_qty.",".$item_ppu.",".$item_lleva_inventario.",".$item_prov_ruc.",".$_SESSION["user_client_id"].",date_format('".$fecha_expiracion."','%Y-%m-%d'),1,'".$barcode."',".$purchase_price.",".$consumption_type.",".$alert_store.")";
				echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
			    {
			    	mysqli_commit($dbcon);
			        $updStatus = 1;
			    }    	
            }
            else
            {
            	$sql="UPDATE ct_item set name='".$item_name."',id_category=".$item_category.",quantity=".$item_qty.",
            				price_per_unit=".$item_ppu.",id_provider=".$item_prov_ruc.", client_id=".$_SESSION["user_client_id"].",fecha_expiracion=date_format('".$fecha_expiracion."','%Y-%m-%d'), 
            				bar_code='".$barcode."',purchase_price=".$purchase_price.",consumption_type=".$consumption_type.",alert_store=".$alert_store." where id=".$item_id;
            	//echo $sql;
            	if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
			        $updStatus = 2;
		        }
            }

            return $updStatus;		
		}


		
		public function getInventoryItems($dbcon,$DEBUG_STATUS)
		{
			/*$sql="select id,code,name,address,contact,email, (case when enabled =1 then 'HABILITADO' else 'DESHABILITADO' end) enabled,created_on, modified_on from ct_client t order by name asc";*/
			$sql="select id, name,detail,id_category,(select ic.name from ct_item_category ic where ic.id=id_category) desc_category,
				(select ci.quantity-ifnull(sum(co1.quantity),0) from ct_order co1 where co1.id_item=ci.id and co1.estado in(1,3)) quantity,
				price_per_unit,
				id_provider,fecha_expiracion,enabled,
				bar_code,purchase_price,consumption_type,alert_store,do_inventory_movement from ct_item ci where client_id=".$_SESSION["user_client_id"];

			//echo $sql;
			$branches=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$branches[$count] = array(	$row["id"],$row["name"],$row["detail"],$row["id_category"],$row["desc_category"]
												,$row["quantity"],$row["price_per_unit"],$row["id_provider"],
												$row["fecha_expiracion"],$row["enabled"],
												$row["bar_code"],$row["purchase_price"],$row["consumption_type"],$row["alert_store"],$row["do_inventory_movement"]);
					$count++;
				}
			}
			return $branches;
		}

		public function deleteInventoryItem($dbcon,$Id,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
        	$sql = "UPDATE ct_item set enabled=((enabled*(-1))+1) where id=".$Id;
			//echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;
	        }
        	return $updStatus;			
		}

		public function getItemCategory($dbcon,$DEBUG_STATUS)
		{
			$sql="select r.id,r.name from ct_item_category r where r.id_client=".$_SESSION["user_client_id"]." order by r.name";
			
			//echo $sql;
			$iteCategory=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$iteCategory[$count] = array($row["id"],$row["name"]);
					$count++;
				}
			}
			return $iteCategory;
		}

		public function buscarInventoryItems($dbcon,$item_name_busqueda,$item_category_busqueda,$item_desc_busqueda,$item_prov_ruc_busqueda,$DEBUG_STATUS)
		{
			/*$sql="select id,code,name,address,contact,email, (case when enabled =1 then 'HABILITADO' else 'DESHABILITADO' end) enabled,created_on, modified_on from ct_client t order by name asc";*/
			$sql="select id, name,detail,id_category,(select ic.name from ct_item_category ic where ic.id=id_category) desc_category,
			quantity,
			price_per_unit,iva,
				id_provider,(select cd.name from ct_distributors_customers cd where cd.code=id_provider ) name_provider,fecha_expiracion,enabled,
				bar_code,purchase_price,consumption_type,alert_store,alert_godown1,alert_godown2 
				from ct_item ci where client_id=".$_SESSION["user_client_id"];

			if(isset($item_name_busqueda) && !empty($item_name_busqueda))
				$sql=$sql." and upper(name) like '%".strtoupper($item_name_busqueda)."%'";
			if(isset($item_category_busqueda) && $item_category_busqueda>=0)
				$sql=$sql." and id_category =".$item_category_busqueda;
			if(isset($item_desc_busqueda) && !empty($item_desc_busqueda))
				$sql=$sql." and detail like '%".$item_desc_busqueda."%'";
			if(isset($item_prov_ruc_busqueda) && $item_prov_ruc_busqueda>=0)
				$sql=$sql." and id_provider = ".$item_prov_ruc_busqueda;

			//echo $sql;
			$branches=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$branches[$count] = array(	$row["id"],$row["name"],$row["detail"],$row["id_category"],$row["desc_category"]
												,$row["quantity"],$row["price_per_unit"],$row["iva"],$row["id_provider"],$row["name_provider"],$row["fecha_expiracion"],$row["enabled"],
												$row["bar_code"],$row["purchase_price"],$row["consumption_type"],$row["alert_store"],
												$row["alert_godown1"],$row["alert_godown2"]);
					$count++;
				}
			}
			return $branches;
		}

		public function addItemForSale($dbcon,$id,$item_id,$item_qty,$DEBUG_STATUS)
		{
			$updStatus = "0:0";
			$instock=0;
			$isItemsAreInStock=0;
			if($_SESSION["user_basket_id"]==0)
				$id_order=mt_rand();
			else
				$id_order=$_SESSION["user_basket_id"];
			$sql="select IFNULL(a.full_qty,0) full_qty,IFNULL(a.in_linea,0) in_linea,IFNULL((a.full_qty-a.in_linea),0) in_stock,IFNULL(a.in_cur_venta,0) in_cur_venta 
				from (select i.id,IFNULL(i.quantity,0) full_qty,IFNULL(sum(o.quantity),0) in_linea,
				IFNULL((select co.quantity from ct_order co where co.id=".$id." and co.estado in(1,3)),0) in_cur_venta 
				from ct_item i,ct_order o where i.id=".$item_id." and o.id_item=i.id and o.estado in(1,3)) a";
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result)) 
				{
					$instock=$row["in_stock"];
					if($id==0 && $row["in_stock"]>=$item_qty)
						$isItemsAreInStock=1;
					else if($id>0 && ($row["in_stock"]+$row["in_cur_venta"])>=$item_qty)
						$isItemsAreInStock=1;
				}
			}

			if($isItemsAreInStock==1)
			{
				if($id==0)
					$sql = "INSERT INTO ct_order(id_order,id_item,quantity, order_date,id_branch,id_cajero) 
						values(".$id_order.",".$item_id.",".$item_qty.",now(),".$_SESSION["user_branch_id"].",".$_SESSION["user_id"].")";
				else
					$sql="UPDATE ct_order set quantity=".$item_qty." where id=".$id;
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
			    {
			    	$_SESSION["user_basket_id"] = $id_order;
			    	mysqli_commit($dbcon);
			        $updStatus = +"1:0";
			    }
			}
			else
			{
				$updStatus = "2:".$instock;

			}
			//echo $updStatus+":hello";
        	return $updStatus;			
		}

		public function deleteItemEnVentas($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus = 0;
			$sql="UPDATE ct_order set estado=2 where id=".$id;
			//echo $sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
		    {
		    	mysqli_commit($dbcon);
		        $updStatus = 1;
		    } 
        	return $updStatus;			
		}

		public function getBasket($dbcon,$basketId,$DEBUG_STATUS)
		{
			/*$sql="select 	o.id backet_id,
							i.id basket_item_id,
							i.name basket_item_name,
							i.detail basket_item_desc,
							o.quantity basket_item_qty,
							i.price_per_unit basket_item_cpu,
							i.iva basket_item_iva,
							0 basket_item_discount,
							round((i.price_per_unit*o.quantity*100/(100+i.iva)),2) basket_item_subtotal,
							round(((i.price_per_unit*o.quantity*100/(100+i.iva))*i.iva/100),2) basket_item_total_iva,
							round(((i.price_per_unit*o.quantity*100/(100+i.iva))+((i.price_per_unit*o.quantity*100/(100+i.iva))*i.iva/100)),2) basket_item_total 
							from ct_item i,ct_order o where o.id_order=".$basketId." and o.id_item=i.id and o.estado=1";*/
			$sql="select 	o.id backet_id,
							i.id basket_item_id,
							i.name basket_item_name,
							o.quantity basket_item_qty,
							i.price_per_unit basket_item_cpu,
							0 basket_item_discount,
							round((i.price_per_unit*o.quantity*100/(100+i.iva)),2) basket_item_subtotal,
							round(((i.price_per_unit*o.quantity*100/(100+i.iva))*i.iva/100),2) basket_item_total_iva,
							round(((i.price_per_unit*o.quantity*100/(100+i.iva))+((i.price_per_unit*o.quantity*100/(100+i.iva))*i.iva/100)),2) basket_item_total 
							from ct_item i,ct_order o where o.id_order=".$basketId." and o.id_item=i.id and o.estado=1";
			
			//echo $sql;
			$backet=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$backet[$count] = array(	$row["backet_id"],
												$row["basket_item_id"],
												$row["basket_item_name"],
												$row["basket_item_desc"],
												$row["basket_item_qty"],
												$row["basket_item_cpu"],
												$row["basket_item_iva"],
												$row["basket_item_discount"],
												$row["basket_item_subtotal"],
												$row["basket_item_total_iva"],
												$row["basket_item_total"]
											);
					$count++;
				}
			}
			return $backet;
		}


		public function confirmSale($dbcon,$bill_amount,$id_payment_mode,$DEBUG_STATUS)
		{
			
			$updStatus = 0;

			//validate customer details start - insert if absent, update if present
			$sql="select id,code,name,address,contact,email from ct_distributors_customers t where client_cust_type in(2,3) and code=".$_SESSION["cust_code"];
			
			//echo $sql;
			$distributors=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 1)  
            {
            	$cust_code=$_SESSION["cust_code"];
            	$sql="UPDATE ct_distributors_customers set client_cust_type=3,id_type".$_SESSION["cust_doc_type"].",name='".$_SESSION["cust_name"]."',
            			address='".$_SESSION["cust_address"]."',contact='".$_SESSION["cust_contact"]."',email='".$_SESSION["cust_email"]."',
            			modified_by=".$_SESSION["user_id"].",modified_on=now() where code='".$_SESSION["cust_code"]."'";
            	//echo $sql.'<br>';
            	if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        }
            }
            else if(mysqli_num_rows($result) == 0)
            {
            	$cust_code=$_SESSION["cust_code"];
            	$sql = "INSERT INTO ct_distributors_customers(client_cust_type,id_type,code,name,address,contact,email,created_by,created_on,modified_by,modified_on,enabled) 
				values(3,".$_SESSION["cust_doc_type"].",'".$_SESSION["cust_code"]."','".$_SESSION["cust_name"]."','".$_SESSION["cust_address"]."',
					'".$_SESSION["cust_contact"]."','".$_SESSION["cust_email"]."',".$_SESSION["user_id"].",now(),".$_SESSION["user_id"].",now(),1)";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
			    {
			    	mysqli_commit($dbcon);
			    }   
            }
            else
            {
            	$cust_code='9999999999';
            	$sql = "INSERT INTO ct_distributors_customers(client_cust_type,id_type,code,name,address,contact,email,created_by,created_on,modified_by,modified_on,enabled) 
				values(3,4,'9999999999','CONSUMIDOR FINAL','-','2222222','consumidor_final@gmail.com',".$_SESSION["user_id"].",now(),".$_SESSION["user_id"].",now(),1)";
				//echo $sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
			    {
			    	mysqli_commit($dbcon);
			    }   
            }
            //validate customer details end



			if($_SESSION["user_basket_id"]==0)
			{

			}
			else
			{
				$branch_factura_cur_value=-1;
				$sql="select b.id,b.emision_code,b.bill_start_num,b.bill_end_num from ct_user u,ct_branch b 
							where u.id=".$_SESSION["user_id"]." and u.id_branch=b.id and u.enabled=1 and b.enabled=1";
		    	$result = mysqli_query($dbcon,$sql);
	            if(mysqli_num_rows($result) > 0)  
	            {
	            	//$branch_factura_cur_value=mt_rand()."_TEMP";
					//$emision_code="TEMP";
					if($row = mysqli_fetch_assoc($result)) 
					{
						$branch_id=$row["id"];
						$emision_code=$row["emision_code"];
						$bill_start_num=$row["bill_start_num"];
						$bill_end_num=$row["bill_end_num"];

						$sql="select bf.branch_factura_cur_value from ct_branch_factura_cur_value bf 
						where bf.branch_id=".$branch_id." and bf.enabled=1 
						and bf.branch_factura_cur_value >= ".$bill_start_num." and branch_factura_cur_value <".$bill_end_num." for update";
				    	$result = mysqli_query($dbcon,$sql);
			            if(mysqli_num_rows($result) > 0)  
			            {
							if($row = mysqli_fetch_assoc($result)) 
							{
								$branch_factura_cur_value=$row["branch_factura_cur_value"];
								$sql="update ct_branch_factura_cur_value set branch_factura_cur_value=branch_factura_cur_value+1 
						        			where branch_id=".$branch_id." and enabled=1";					        	
								if(mysqli_query($dbcon,$sql))
						        {
						        	$nro_factura=$emision_code."-".$branch_factura_cur_value;

									$sql="UPDATE ct_order set estado=3,factura='".$nro_factura."', id_customer='".$cust_code."',order_date=now() where id_order=".$_SESSION["user_basket_id"]." and  estado=1";
									//echo $sql.'<br>';


							        if(mysqli_query($dbcon,$sql))
								    {
								    	mysqli_commit($dbcon);
								    	
								    	$sql="INSERT into ct_billing(id_bill,id_order,id_customer) values('".$nro_factura."', ".$_SESSION["user_basket_id"].",'".$cust_code."')";
								    	//echo $sql.'<br>';
								    	mysqli_commit($dbcon);
								    	if(mysqli_query($dbcon,$sql))
									    {
									    	$sql="insert into ct_payment_details(id_payment_motive,id_billing,id_payment_mode,bill_amount) values(1,'".$nro_factura."',".$id_payment_mode.",".$bill_amount.")";
									    	//echo $sql.'<br>';
									    	if(mysqli_query($dbcon,$sql))
										    {
										    	$updStatus=$_SESSION["user_basket_id"];
												$_SESSION["user_basket_id"]=0;
												mysqli_commit($dbcon);
										    }
									    } 
								    }
						        }
							}							
						}
					}					
				}
			}	
			$_SESSION["user_basket_id"]=0;		
		    return $branch_factura_cur_value;			
		}

		public function getReporteVentas($dbcon,$branch_id,$str_date,$end_date,$nro_factura,$id_cliente,$DEBUG_STATUS)
		{
			$sql="select distinct co.factura,co.order_date,co.id_branch,co.id_cajero from ct_order co where co.estado=3";
			if(isset($branch_id))
				$sql=$sql." and id_branch=".$branch_id;
			if(isset($str_date) && $str_date!=null)
				$sql=$sql." and co.order_date >= DATE_FORMAT('".$str_date."','%Y-%m-%d %H:%i:%s')";
			if(isset($end_date) && $end_date!=null)
				$sql=$sql." and co.order_date < DATE_ADD(DATE_FORMAT('".$end_date."','%Y-%m-%d %H:%i:%s'),INTERVAL 24 HOUR) ";
			if(isset($nro_factura))
				$sql=$sql." and co.factura like '%".$nro_factura."%' ";
			$sql="select (select name branch_name from ct_branch cb where cb.id=a.id_branch) branch_name,
					a.factura,a.order_date,cbl.id_customer,(select name user_name from ct_user where id=a.id_cajero) user_name ,cpd.bill_amount
					from
					(".$sql.") a,
					ct_payment_details cpd, ct_billing cbl
					where a.factura=cbl.id_bill and cbl.id_bill=cpd.id_billing";
			
			//echo $sql;
			$backet=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$backet[$count] = array(	$row["branch_name"],
												$row["factura"],
												$row["order_date"],
												$row["id_customer"],
												$row["user_name"],
												$row["bill_amount"]
											);
					$count++;
				}
			}
			return $backet;
		}

		public function buscarItemsForVentas($dbcon,$item_name_busqueda,$item_category_busqueda,$item_desc_busqueda,$item_prov_ruc_busqueda,$barcode,$DEBUG_STATUS)
		{
			$sql="select id, name,quantity,price_per_unit,iva from ct_item ci where client_id=".$_SESSION["user_client_id"];

			if(isset($item_name_busqueda) && !empty($item_name_busqueda))
				$sql=$sql." and upper(name) like '%".strtoupper($item_name_busqueda)."%'";
			else if(isset($barcode) && !empty($barcode))
				$sql=$sql." and bar_code like '%".$barcode."%'";
			if(isset($item_category_busqueda) && $item_category_busqueda>=0)
				$sql=$sql." and id_category =".$item_category_busqueda;
			if(isset($item_desc_busqueda) && !empty($item_desc_busqueda))
				$sql=$sql." and detail like '%".$item_desc_busqueda."%'";
			if(isset($item_prov_ruc_busqueda) && $item_prov_ruc_busqueda>=0)
				$sql=$sql." and id_provider = ".$item_prov_ruc_busqueda;

			//echo $sql;
			$items=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$items[$count] = array(	$row["id"],$row["name"],$row["quantity"],$row["price_per_unit"],$row["iva"]);
					$count++;
				}
			}
			return $items;
		}


	}
?>