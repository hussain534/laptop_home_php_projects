<?php
	//session_start();
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
			$sql="select u.id userid, u.name user_name,u.email,u.password,u.perfil from mpm_login u
				where u.email = '".$user_email."' and u.enabled=1 ";
			////echo $sql.'<br>';
			$updStatus=0;
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
					$userPerfil=$row["perfil"];
            	}
            	if(strcmp($userPwd, $user_password)==0)
            	{
		        	$sql = "insert into login_audit(login_id,login_dt) values(".$userId.",now())";
					////echo $sql.'<br>';
			        if(mysqli_query($dbcon,$sql))
			        {
			        	mysqli_commit($dbcon);		        	
			            $updStatus = 1;
			        	$_SESSION["user_id"]=$userId;
			        	$_SESSION["user_name"]=$userName;
						$_SESSION["user_email"]=$userEmail;
						$_SESSION["user_perfil"]=$userPerfil;
			            $_SESSION['LAST_ACTIVITY'] = time();
			        }
			        else
			        {
			        	$updStatus=2;
			        	mysqli_rollback($dbcon);
			        }	
			    }
			    else
			    {
			    	$updStatus=3;
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

		public function registerUser($dbcon,$adminUserIdConstant,$user_email,$user_name,$user_password,$DEBUG_STATUS)
		{
			
			$sql="select id, name,email from mpm_login where email = '".strtoupper($user_email)."' and enabled=1";
			mysqli_autocommit($dbcon,FALSE);
			$result = mysqli_query($dbcon,$sql);
			$updStatus=0;
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO mpm_login(name,email,password,created_by,created_on,modified_by,modified_on,enabled) 
				values('".$user_name."','".$user_email."','".$user_password."',".$adminUserIdConstant.",now(),".$adminUserIdConstant.",now(),1)";
				//echo $sql.'<br>';
		        
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$to = strtoupper($user_email);
					$subject = 'MERAKI PM- REGISTRO DE USUARIO';
					$txt = '¡HOLA, '.strtoupper($user_name).'!'."<br><br>";
					$txt=$txt.'Gracias por inscribirse en MERAKI PM'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.strtoupper($user_email).' y tu clave ingresada el momento del registro para iniciar sesión.'."<br><br>";
					$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					/*$headers .= 'From:info@hutesol.com' . "\r\n";
					$headers .= 'CC: olguercalvache@gmail.com';*/
					$headers .= 'From:MERAKI PM <info@merakiminds.com>' . "\r\n";
					//$headers .= 'CC: fernandoa@nipromed.com';

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


		public function registerNewTask($dbcon,$projectType,$projectCode,$taskDate,$horaInicioTarea,$horaFinalTarea,$descBreveTarea,$descCompTarea,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
        	$sql = "INSERT INTO mpm_tasks(project_id,task_date,task_start_at,task_end_at,task_short_desc,task_full_desc,task_type,created_by,created_on,modified_by,modified_on,enabled) 
			values('".$projectCode."',DATE_FORMAT('".$taskDate."','%Y-%m-%d'),'".$horaInicioTarea."','".$horaFinalTarea."','".$descBreveTarea."','".$descCompTarea."',".$projectType.",".$adminUserIdConstant.",now(),".$adminUserIdConstant.",now(),1)";
			echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;
	        }
        	return $updStatus;			
		}


		public function getMyRegisteredTasks($dbcon,$DEBUG_STATUS)
		{
			$sql="select t.id,t.project_id,t.task_date,t.task_start_at,t.task_end_at,t.task_short_desc,t.task_full_desc from mpm_tasks t where t.created_by=".$_SESSION["user_id"]." 
			and enabled=1 order by task_date desc";

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array($row["id"],$row["project_id"],$row["task_date"],$row["task_start_at"],$row["task_end_at"],$row["task_short_desc"],$row["task_full_desc"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function getTaskDtlById($dbcon,$id,$DEBUG_STATUS)
		{
			$sql="select t.id,t.project_id,t.task_date,t.task_start_at,t.task_end_at,t.task_short_desc,t.task_full_desc 
			from mpm_tasks t where t.created_by=".$_SESSION["user_id"]." and t.id=".$id." and enabled=1 order by task_date desc";

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array($row["id"],$row["project_id"],$row["task_date"],$row["task_start_at"],$row["task_end_at"],$row["task_short_desc"],$row["task_full_desc"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function deleteTask($dbcon,$taskId,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
        	$sql = "UPDATE mpm_tasks set enabled=0, modified_by=".$adminUserIdConstant.",modified_on=now() where id=".$taskId;
			echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 2;
	        }
        	return $updStatus;			
		}

		public function updateTask($dbcon,$projectType,$taskId,$projectCode,$taskDate,$horaInicioTarea,$descBreveTarea,$descCompTarea,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
			$sql = "UPDATE mpm_tasks set enabled=0, modified_by=".$adminUserIdConstant.",modified_on=now() where id=".$taskId;
			echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	//mysqli_commit($dbcon);
	        	$sql = "INSERT INTO mpm_tasks(project_id,task_date,task_start_at,task_end_at,task_short_desc,task_full_desc,task_type,created_by,created_on,modified_by,modified_on,enabled) 
				values('".$projectCode."',DATE_FORMAT('".$taskDate."','%Y-%m-%d'),'".$horaInicioTarea."','".$horaFinalTarea."','".$descBreveTarea."','".$descCompTarea."',".$projectType.",".$adminUserIdConstant.",now(),".$adminUserIdConstant.",now(),1)";
				echo $sql.'<br>';
		        
		        if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        	$updStatus = 3;
		        }
	        }
        	
        	return $updStatus;			
		}

		public function getTaskDetailBySearchParam($dbcon,$taskType,$projectCode,$taskDateInicial,$taskDateFinal,$taskOwner,$DEBUG_STATUS)
		{
			$sql="select t.id,t.project_id,t.task_date,t.task_start_at,t.task_end_at,t.task_short_desc,t.task_full_desc 
			from mpm_tasks t where t.task_type=".$taskType;
			if($taskOwner!=null && $taskOwner>0)
				$sql=$sql." and t.created_by=".$taskOwner;
			if(isset($projectCode) && !empty($projectCode))
				$sql=$sql." and t.project_id='".$projectCode."'";
			if(isset($taskDateInicial) && !empty($taskDateInicial) && isset($taskDateFinal) && !empty($taskDateFinal))
			$sql=$sql."	and t.task_date>=DATE_FORMAT('".$taskDateInicial."','%Y-%m-%d %H:%i:%s') 
						and t.task_date<=DATE_FORMAT('".$taskDateFinal."','%Y-%m-%d %H:%i:%s')";
			$sql=$sql." and enabled=1 order by task_date desc";

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array($row["id"],$row["project_id"],$row["task_date"],$row["task_start_at"],$row["task_end_at"],$row["task_short_desc"],$row["task_full_desc"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function getUsersListByPerfil($dbcon,$userPerfil,$DEBUG_STATUS)
		{
			$sql="select id,name from mpm_login where perfil=".$userPerfil." and enabled=1";

			//echo $sql;
			$users=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$users[$count] = array($row["id"],$row["name"]);
					$count++;
				}
			}
			return $users;
		}


	}
?>