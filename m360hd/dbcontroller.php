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
			//OK
			$sql="select u.id userid, u.name user_name,u.email,u.password,u.profile perfil from mpm_login u
				where u.email = '".$user_email."' and u.enabled=1 ";
			////echo $sql.'<br>';
			$updStatus=0;
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
            		$updStatus=1;	
            		$_SESSION["user_id"]=$userId;
		        	$_SESSION["user_name"]=$userName;
					$_SESSION["user_email"]=$userEmail;
					$_SESSION["user_perfil"]=$userPerfil;
		            $_SESSION['IN_SESSION'] = 'Y';
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

		public function registerUser($dbcon,$perfil,$user_email,$user_name,$user_password,$DEBUG_STATUS)
		{
			
			$sql="select id, name,email from mpm_login where email = '".strtoupper($user_email)."' and enabled=1";
			mysqli_autocommit($dbcon,FALSE);
			$result = mysqli_query($dbcon,$sql);
			$updStatus=0;
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO mpm_login(name,email,password,profile,created_by,created_on,modified_by,modified_on,enabled) 
				values('".$user_name."','".$user_email."','".$user_password."',".$perfil.",1,now(),1,now(),1)";
				//echo $sql.'<br>';
		        
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$to = strtoupper($user_email);
					$subject = 'MERAKI 360 HELP DESK- REGISTRO DE USUARIO';
					$txt = '¡HOLA, '.strtoupper($user_name).'!'."<br><br>";
					$txt=$txt.'Gracias por inscribirse en MERAKI 360 HELP DESK'."<br><br>";
					$txt=$txt.'Usa la dirección de correo electrónico '.strtoupper($user_email).' y tu clave ingresada el momento del registro para iniciar sesión.'."<br><br>";
					$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					$headers .= 'From:MERAKI 360 HELP DESK <info@merakiminds.com>' . "\r\n";
					
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


		public function registerNewTask($dbcon,$projectCode,$id_ambiente,$aprobacion_Cliente,$categorea_tarea,$taskDate,$horaInicioTarea,$horaFinTarea,$tiempo_indisponibilidad,$descBreveTarea,$descCompTarea,$filePath,$base_conocimiento,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$task_id=mt_rand();
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
        	$sql = "INSERT INTO mpm_tasks(project_id,task_id,id_ambiente,aprobacion_Cliente,categorea_tarea,task_date,task_start_at,task_end_at,tiempo_indisponibilidad,task_short_desc,task_full_desc,task_status,created_by,created_on,modified_by,modified_on,enabled,doc_path,isKDB) 
			values(".$projectCode.",".$task_id.",".$id_ambiente.",".$aprobacion_Cliente.",".$categorea_tarea.",DATE_FORMAT('".$taskDate."','%Y-%m-%d'),'".$horaInicioTarea."','".$horaFinTarea."',".$tiempo_indisponibilidad.",'".$descBreveTarea."','".$descCompTarea."',1,".$adminUserIdConstant.",now(),".$adminUserIdConstant.",now(),1,'".$filePath."',".$base_conocimiento.")";
			echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;
	        }
        	return $updStatus;			
		}

		public function getMyTodaysRegisteredTasks($dbcon,$DEBUG_STATUS)
		{
			$sql="select t.id,
					t.project_id,
					t.task_date,
					(case when t.project_id=1 then 'MULTICANAL'  
					when t.project_id=2 then 'PORTAL' 
					when t.project_id=3 then 'CONTINGENCIA' 
					when t.project_id=4 then 'BILLETERA ELECTRONICA' 
					when t.project_id=5 then 'VU' 
					else 'OTROS' end) project,
					t.task_start_at,
					t.task_end_at,
					t.tiempo_indisponibilidad,
					t.task_short_desc,
					t.task_full_desc,
					(case when t.id_ambiente=1 then 'PRODUCCION'
					when t.id_ambiente=2 then 'PREPRODUCCION'
					when t.id_ambiente=3 then 'CONTINGENCIA'
					when t.id_ambiente=4 then 'CALIDAD'
					when t.id_ambiente=5 then 'DESARROLLO'
					else 'OTROS' end) ambiente,
					(case when t.aprobacion_Cliente=1 then 'SI' else 'NO' end) aprobacion_Cliente,
					(case when t.categorea_tarea=1 then 'SOPORTE' 
					when t.categorea_tarea=2 then 'ADMINISTRACION'
					when t.categorea_tarea=3 then 'MEJORAS'
					when t.categorea_tarea=4 then 'VALOR AGREGADO'
					else '--' end) task_category,
					t.doc_path,
					(select l.name from mpm_login l where l.id=t.modified_by) tecnico
					from mpm_tasks t where t.created_by=".$_SESSION["user_id"]."
					and enabled=1 
					and task_date>=DATE_FORMAT(now(),'%Y-%m-%d')
					order by modified_on desc";

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["project_id"],$row["task_date"],$row["task_start_at"],$row["task_end_at"],$row["task_short_desc"],
											$row["task_full_desc"],$row["tiempo_indisponibilidad"],$row["project"],$row["tiempo_indisponibilidad"],$row["ambiente"],$row["aprobacion_Cliente"],$row["tecnico"],$row["task_category"],$row["doc_path"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function getMyRegisteredTasks($dbcon,$DEBUG_STATUS)
		{
			/*$sql="select t.id,t.project_id,t.task_date,t.task_start_at,t.task_end_at,t.task_short_desc,t.task_full_desc,tiempo_indisponibilidad from mpm_tasks t where t.created_by=".$_SESSION["user_id"]." 
						and enabled=1 order by task_date desc";*/

			$sql="select t.id,
					t.project_id,
					t.task_date,
					(case when t.project_id=1 then 'MULTICANAL'  
					when t.project_id=2 then 'PORTAL' 
					when t.project_id=3 then 'CONTINGENCIA' 
					when t.project_id=4 then 'BILLETERA ELECTRONICA' 
					when t.project_id=5 then 'VU' 
					else 'OTROS' end) project,
					t.task_start_at,
					t.task_end_at,
					t.tiempo_indisponibilidad,
					t.task_short_desc,
					t.task_full_desc,
					(case when t.id_ambiente=1 then 'PRODUCCION'
					when t.id_ambiente=2 then 'PREPRODUCCION'
					when t.id_ambiente=3 then 'CONTINGENCIA'
					when t.id_ambiente=4 then 'CALIDAD'
					when t.id_ambiente=5 then 'DESARROLLO'
					else 'OTROS' end) ambiente,
					(case when t.aprobacion_Cliente=1 then 'SI' else 'NO' end) aprobacion_Cliente,
					(case when t.categorea_tarea=1 then 'SOPORTE' 
					when t.categorea_tarea=2 then 'ADMINISTRACION'
					when t.categorea_tarea=3 then 'MEJORAS'
					when t.categorea_tarea=4 then 'VALOR AGREGADO'
					else '--' end) task_category,
					t.doc_path,
					(select l.name from mpm_login l where l.id=t.modified_by) tecnico
					from mpm_tasks t where t.created_by=".$_SESSION["user_id"]."
						and enabled=1 order by task_date desc";

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["project_id"],$row["task_date"],$row["task_start_at"],$row["task_end_at"],$row["task_short_desc"],
											$row["task_full_desc"],$row["tiempo_indisponibilidad"],$row["project"],$row["tiempo_indisponibilidad"],$row["ambiente"],$row["aprobacion_Cliente"],$row["tecnico"],$row["task_category"],$row["doc_path"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function getTaskDtlById($dbcon,$id,$DEBUG_STATUS)
		{
			$sql="select t.id,t.project_id,t.id_ambiente,t.aprobacion_Cliente,t.categorea_tarea,t.task_date,t.task_start_at,t.task_end_at,t.tiempo_indisponibilidad,t.task_short_desc,t.task_full_desc,task_status,task_id,doc_path   
			from mpm_tasks t where t.created_by=".$_SESSION["user_id"]." and t.id=".$id." and enabled=1 order by task_date desc";

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array($row["id"],$row["project_id"],$row["id_ambiente"],$row["aprobacion_Cliente"],$row["categorea_tarea"],$row["task_date"],$row["task_start_at"],$row["task_end_at"],$row["task_short_desc"],$row["task_full_desc"],$row["task_status"],$row["task_id"],$row["tiempo_indisponibilidad"],$row["doc_path"]);
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

		public function updateTask($dbcon,$id,$taskId,$projectCode,$id_ambiente,$aprobacion_Cliente,$categorea_tarea,$taskDate,$horaInicioTarea,$horaFinTarea,$tiempo_indisponibilidad,$descBreveTarea,$descCompTarea,$doc_path,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
			$sql = "UPDATE mpm_tasks set enabled=0, modified_by=".$adminUserIdConstant.",modified_on=now() where id=".$id;
			echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	//mysqli_commit($dbcon);
	        	/*$sql = "INSERT INTO mpm_tasks(project_id,task_date,task_start_at,task_end_at,task_short_desc,task_full_desc,task_type,created_by,created_on,modified_by,modified_on,enabled) 
				values('".$projectCode."',DATE_FORMAT('".$taskDate."','%Y-%m-%d'),'".$horaInicioTarea."','".$horaFinalTarea."','".$descBreveTarea."','".$descCompTarea."',".$projectType.",".$adminUserIdConstant.",now(),".$adminUserIdConstant.",now(),1)";
				echo $sql.'<br>';
		        
		        if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        	$updStatus = 3;
		        }*/
		        $sql = "INSERT INTO mpm_tasks(task_id,project_id,id_ambiente,aprobacion_Cliente,categorea_tarea,task_date,task_start_at,task_end_at,tiempo_indisponibilidad,task_short_desc,task_full_desc,task_status,created_by,created_on,modified_by,modified_on,enabled,doc_path) 
					values(".$taskId.",".$projectCode.",".$id_ambiente.",".$aprobacion_Cliente.",".$categorea_tarea.",DATE_FORMAT('".$taskDate."','%Y-%m-%d'),'".$horaInicioTarea."','".$horaFinTarea."',".$tiempo_indisponibilidad.",'".$descBreveTarea."','".$descCompTarea."',1,".$adminUserIdConstant.",now(),".$adminUserIdConstant.",now(),1,'".$doc_path."')";
				echo $sql.'<br>';
		        
		        if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        	$updStatus = 3;
		        }
	        }
        	
        	return $updStatus;			
		}

		public function getTaskDetailBySearchParam($dbcon,$taskType,$projectCode,$id_ambiente,$taskDateInicial,$taskDateFinal,$taskOwner,$categorea_tarea,$DEBUG_STATUS)
		{
			/*$sql="select t.id,t.project_id,t.task_date,t.task_start_at,t.task_end_at,tiempo_indisponibilidad,t.task_short_desc,t.task_full_desc 
			from mpm_tasks t where enabled=1 ";
			if($taskOwner!=null && $taskOwner>0)
				$sql=$sql." and t.created_by=".$taskOwner;
			if(isset($projectCode) && $projectCode!=0)
				$sql=$sql." and t.project_id=".$projectCode;
			if(isset($id_ambiente) && $id_ambiente!=0)
				$sql=$sql." and t.id_ambiente=".$id_ambiente;
			if(isset($taskDateInicial) && !empty($taskDateInicial) && isset($taskDateFinal) && !empty($taskDateFinal))
			$sql=$sql."	and t.task_date>=DATE_FORMAT('".$taskDateInicial."','%Y-%m-%d %H:%i:%s') 
						and t.task_date<=DATE_FORMAT('".$taskDateFinal."','%Y-%m-%d %H:%i:%s')";
			$sql=$sql." order by task_date desc";

			echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array($row["id"],$row["project_id"],$row["task_date"],$row["task_start_at"],$row["task_end_at"],$row["task_short_desc"],$row["task_full_desc"],$row["tiempo_indisponibilidad"]);
					$count++;
				}
			}*/

			$sql="select t.id,
					t.project_id,
					t.task_date,
					(case when t.project_id=1 then 'MULTICANAL'  
					when t.project_id=2 then 'PORTAL' 
					when t.project_id=3 then 'CONTINGENCIA' 
					when t.project_id=4 then 'BILLETERA ELECTRONICA' 
					when t.project_id=5 then 'VU' 
					else 'OTROS' end) project,
					t.task_start_at,
					t.task_end_at,
					t.tiempo_indisponibilidad,
					t.task_short_desc,
					t.task_full_desc,
					(case when t.id_ambiente=1 then 'PRODUCCION'
					when t.id_ambiente=2 then 'PREPRODUCCION'
					when t.id_ambiente=3 then 'CONTINGENCIA'
					when t.id_ambiente=4 then 'CALIDAD'
					when t.id_ambiente=5 then 'DESARROLLO'
					else 'OTROS' end) ambiente,
					(case when t.aprobacion_Cliente=1 then 'SI' else 'NO' end) aprobacion_Cliente,
					(case when t.categorea_tarea=1 then 'SOPORTE' 
					when t.categorea_tarea=2 then 'ADMINISTRACION'
					when t.categorea_tarea=3 then 'MEJORAS'
					when t.categorea_tarea=4 then 'VALOR AGREGADO'
					else '--' end) task_category,
					t.doc_path,
					(select l.name from mpm_login l where l.id=t.modified_by) tecnico
					from mpm_tasks t where enabled=1";

					if($taskOwner!=null && $taskOwner>0)
						$sql=$sql." and t.created_by=".$taskOwner;
					if(isset($projectCode) && $projectCode!=0)
						$sql=$sql." and t.project_id=".$projectCode;
					if(isset($id_ambiente) && $id_ambiente!=0)
						$sql=$sql." and t.id_ambiente=".$id_ambiente;
					if(isset($categorea_tarea) && $categorea_tarea!=0)
						$sql=$sql." and t.categorea_tarea=".$categorea_tarea;
					if(isset($taskDateInicial) && !empty($taskDateInicial) && isset($taskDateFinal) && !empty($taskDateFinal))
						$sql=$sql."	and t.task_date>=DATE_FORMAT('".$taskDateInicial."','%Y-%m-%d %H:%i:%s') 
						and t.task_date<=DATE_FORMAT('".$taskDateFinal."','%Y-%m-%d %H:%i:%s')";
					$sql=$sql." order by task_date asc";

			//echo $sql;
			error_log($sql, 0);
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["project_id"],$row["task_date"],$row["task_start_at"],$row["task_end_at"],$row["task_short_desc"],
											$row["task_full_desc"],$row["tiempo_indisponibilidad"],$row["project"],$row["tiempo_indisponibilidad"],$row["ambiente"],$row["aprobacion_Cliente"],$row["tecnico"],$row["task_category"],$row["doc_path"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function getUsersListByPerfil($dbcon,$userPerfil,$DEBUG_STATUS)
		{
			//OK
			$sql="select id,name from mpm_login where profile=".$userPerfil." and enabled=1";

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


		public function getMyTodaysTaskReport($dbcon,$DEBUG_STATUS)
		{
			$accounts=[1,2,3,99];
			$task_category=[1,2,3,4];
			//echo count($accounts);
			for($x=0;$x<count($accounts);$x++)
			{
				for($y=0;$y<count($task_category);$y++)
				{
					$sql="select 
							(case when t.project_id=1 then 'MULTICANALIDAD' 
							when t.project_id=2 then 'PORTAL'
							when t.project_id=3 then 'CONTINGENCIA'
							when t.project_id=4 then 'BILLETERA ELECTRONICA' 
							when t.project_id=5 then 'VU' 
							else 'OTROS' end) project,
							(case when t.categorea_tarea=1 then 'SOPORTE'
							when t.categorea_tarea=2 then 'ADMINISTRACION'
							when t.categorea_tarea=3 then 'MEJORAS'
							when t.categorea_tarea=4 then 'VALOR AGREGADO' end) category, count(*) cnt
							from mpm_tasks t where t.created_by=".$_SESSION["user_id"]." and enabled=1 
							and t.project_id=".$accounts[$x]."
							and t.categorea_tarea=".$task_category[$y]."
							and t.task_date>=DATE_FORMAT(concat(DATE_FORMAT(now(),'%Y-%m-%d'),' 00:00:00'),'%Y-%m-%d %H:%i:%s') 
													and t.task_date<=DATE_FORMAT(concat(DATE_FORMAT(now(),'%Y-%m-%d'),' 23:59:59'),'%Y-%m-%d %H:%i:%s')
							group by t.project_id,t.categorea_tarea";

					//echo $sql;
					$tasks=array();
					$count=0;
					$result = mysqli_query($dbcon,$sql);
		            if(mysqli_num_rows($result) > 0)  
		            {
						while($row = mysqli_fetch_assoc($result)) 
						{
							$tasks[$count] = array($row["project"],$row["category"],$row["cnt"]);
							$count++;
						}
					}
					print_r($tasks);
				}
			}
			return $tasks;
		}

		public function getKDBSearch($dbcon,$searchparams,$DEBUG_STATUS)
		{
			$tasks=array();
			$count=0;

			$dataParam = explode(";", $searchparams);
			for($x=0;$x<count($dataParam);$x++)
			{
				$sql="select distinct t.task_id,
					(select c.name from catalogue c where c.type=3 and c.enabled=1 and c.id=t.task_type) task_type,
					(select c.name from catalogue c where c.type=7 and c.enabled=1 and c.id=t.task_notified_through) task_notified_through,
					task_notified_by,
					task_notified_on,
					(select l.name from mpm_login l where l.id=t.task_recieved_by) task_recieved_by,
					(select l.name from mpm_login l where l.id=t.task_assigned_to) task_assigned_to,
					t.task_assigned_on,
					(select c.name from catalogue c where c.type=6 and c.enabled=1 and c.id=t.task_priority) task_priority,
					(select c.name from catalogue c where c.type=1 and c.enabled=1 and c.id=t.task_service_appl) task_service_appl,
					t.task_title,
					t.task_desc,
					t.task_server_ips,
					t.task_email_sent_on,
					t.task_call_made_on,
					(select c.name from catalogue c where c.type=5 and c.enabled=1 and c.id=t.task_status) task_status_text,
					task_last_updated_on,
					(select l.name from mpm_login l where l.id=t.task_last_updated_by) task_last_updated_by,
					t.task_document,
					t.task_status,
					(select count(*) cnt from mpm_task_follow_up_dtl f where f.mt_task_id=t.task_id and f.enabled=1) cnt
					from mpm_tasks t,mpm_task_follow_up_dtl f where t.task_id=f.mt_task_id and t.enabled=1 and f.task_mark_as_kdb=1 and (t.task_title like '%".$dataParam[$x]."%' or t.task_desc like '%".$dataParam[$x]."%') order by task_last_updated_on desc";
				//echo $sql;
				$result = mysqli_query($dbcon,$sql);
	            if(mysqli_num_rows($result) > 0)  
	            {
					while($row = mysqli_fetch_assoc($result)) 
					{
						$tasks[$count] = array(	$row["task_id"],$row["task_type"],$row["task_notified_through"],
												$row["task_notified_by"],$row["task_notified_on"],$row["task_recieved_by"],$row["task_assigned_to"],$row["task_assigned_on"],$row["task_priority"],
												$row["task_service_appl"],$row["task_title"],$row["task_desc"],$row["task_server_ips"],$row["task_email_sent_on"],$row["task_call_made_on"],$row["task_status_text"],$row["task_last_updated_on"],$row["task_last_updated_by"],$row["task_document"],$row["task_status"],$row["cnt"]);
						$count++;
					}
				}


			}
			
			
			return $tasks;
		}

		public function getCatalogByType($dbcon,$type,$DEBUG_STATUS)
		{
			//OK
			$sql="select c.id,c.name from catalogue c where c.type=".$type." and c.enabled=1 order by c.name";

			//echo $sql;
			$catalog=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$catalog[$count] = array($row["id"],$row["name"]);
					$count++;
				}
			}
			return $catalog;
		}

		public function getServersDtlByEnvironment($dbcon,$environment,$DEBUG_STATUS)
		{
			//OK
			if($environment==99)
				$sql="select c.ip,c.hostname from mpm_servers c order by c.ip";
			else
				$sql="select c.ip,c.hostname from mpm_servers c where c.environment=".$environment." order by c.ip";

			echo $sql;
			$catalog=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$catalog[$count] = array($row["ip"],$row["hostname"]);
					$count++;
				}
			}
			return $catalog;
		}

		public function assignNewTask($dbcon,$tipoTarea,$notificadoPorMedio,$notificadoPor,$prioridad,$fechaNotificacion,$horaNotificacion,$id_tecnico,$servicioAppl,$descBreveTarea,$descCompTarea,$filePath,$listaServidores,$DEBUG_STATUS)
		{
			//OK
			$adminUserIdConstant = $_SESSION["user_id"];
			$horaNotificacion=$horaNotificacion.":00";
			$task_id=mt_rand();
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
        	$sql = "INSERT INTO mpm_tasks(task_type, task_notified_through,task_notified_by,task_notified_on,task_recieved_by,task_assigned_to,task_assigned_on,task_priority,task_service_appl,task_title,task_desc,task_server_ips,task_document,task_status,task_last_updated_on,task_last_updated_by) 
					values(".$tipoTarea.",".$notificadoPorMedio.",'".$notificadoPor."',DATE_FORMAT('".$fechaNotificacion.' '.$horaNotificacion."','%Y-%m-%d %H:%i:%S'),".$adminUserIdConstant.",".$id_tecnico.",now(),".$prioridad.",".$servicioAppl.",'".$descBreveTarea."','".$descCompTarea."','".$listaServidores."','".$filePath."',1,now(),".$adminUserIdConstant.")";
			//echo $sql.'<br>';


	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	$last_id = mysqli_insert_id($dbcon);
	        	mysqli_commit($dbcon);
	        	$updStatus = 1;
	        	$sql = "select email,name from mpm_login where id=".$id_tecnico;
	        	//echo $sql;
				$result = mysqli_query($dbcon,$sql);
	            if(mysqli_num_rows($result) > 0)  
	            {
					while($row = mysqli_fetch_assoc($result)) 
					{
						$to = strtoupper($row["email"]);
						$subject = 'MERAKI 360 HELP DESK- TICKET ASIGNADO: '.$last_id;
						$txt = 'Estimado '.strtoupper($row["name"]).'!'."<br><br>";
						$txt=$txt.'Nueva ticket asignado MERAKI 360 HELP DESK para su atencion'."<br><br>";
						$txt=$txt.'<b>NRO. TICKET</b><br>'.$last_id."<br><br>";
						$txt=$txt.'<b>DESCRIPCION CORTE</b><br>'.$descBreveTarea."<br><br>";
						$txt=$txt.'<b>DESCRIPCION COMPLETA</b><br>'.$descCompTarea."<br><br>";

						$headers = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
						$headers .= 'From:MERAKI 360 HELP DESK <info@merakiminds.com>' . "\r\n";

						$res=mail($to,$subject,$txt,$headers);
					}
				}	        	
	        }
        	return $updStatus;			
		}

		public function getAssignedTasksByStatus($dbcon,$status,$DEBUG_STATUS)
		{
			//OK
			$sql="select t.task_id,
					(select c.name from catalogue c where c.type=3 and c.enabled=1 and c.id=t.task_type) task_type,
					(select c.name from catalogue c where c.type=7 and c.enabled=1 and c.id=t.task_notified_through) task_notified_through,
					task_notified_by,
					task_notified_on,
					(select l.name from mpm_login l where l.id=t.task_recieved_by) task_recieved_by,
					(select l.profile from mpm_login l where l.id=t.task_recieved_by) task_recieved_by_profile,
					(select l.name from mpm_login l where l.id=t.task_assigned_to) task_assigned_to,
					t.task_assigned_on,
					(select c.name from catalogue c where c.type=6 and c.enabled=1 and c.id=t.task_priority) task_priority,
					(select c.name from catalogue c where c.type=1 and c.enabled=1 and c.id=t.task_service_appl) task_service_appl,
					t.task_title,
					t.task_desc,
					t.task_server_ips,
					t.task_email_sent_on,
					t.task_call_made_on,
					(select c.name from catalogue c where c.type=5 and c.enabled=1 and c.id=t.task_status) task_status_text,
					task_last_updated_on,
					(select l.name from mpm_login l where l.id=t.task_last_updated_by) task_last_updated_by,
					t.task_document,
					t.task_status,
					(select count(*) cnt from mpm_task_follow_up_dtl f where f.mt_task_id=t.task_id and f.enabled=1) cnt
					from mpm_tasks t where enabled=1";
			if($status!=99)
				$sql=$sql." and t.task_status=".$status;
			if($_SESSION["user_perfil"]==4)
				$sql=$sql." and t.task_assigned_to=".$_SESSION["user_id"];
			$sql=$sql." order by task_last_updated_on desc";
			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					if($_SESSION["user_perfil"]==1 || $_SESSION["user_perfil"]==4 || $row["task_recieved_by_profile"]==$_SESSION["user_perfil"])
					{
						$tasks[$count] = array(	$row["task_id"],$row["task_type"],$row["task_notified_through"],
											$row["task_notified_by"],$row["task_notified_on"],$row["task_recieved_by"],$row["task_assigned_to"],$row["task_assigned_on"],$row["task_priority"],
											$row["task_service_appl"],$row["task_title"],$row["task_desc"],$row["task_server_ips"],$row["task_email_sent_on"],$row["task_call_made_on"],$row["task_status_text"],$row["task_last_updated_on"],$row["task_last_updated_by"],$row["task_document"],$row["task_status"],$row["cnt"]);
						$count++;
					}
					else
					{
						
					}
				}
			}
			return $tasks;
		}

		public function getAssignedTasksInRangeByStatus($dbcon,$status,$fechaInicio,$fechaFin,$id_tecnico,$DEBUG_STATUS)
		{
			//OK
			$sql="select t.task_id,
					(select c.name from catalogue c where c.type=3 and c.enabled=1 and c.id=t.task_type) task_type,
					(select c.name from catalogue c where c.type=7 and c.enabled=1 and c.id=t.task_notified_through) task_notified_through,
					task_notified_by,
					task_notified_on,
					(select l.name from mpm_login l where l.id=t.task_recieved_by) task_recieved_by,
					(select l.profile from mpm_login l where l.id=t.task_recieved_by) task_recieved_by_profile,
					(select l.name from mpm_login l where l.id=t.task_assigned_to) task_assigned_to,
					t.task_assigned_on,
					(select c.name from catalogue c where c.type=6 and c.enabled=1 and c.id=t.task_priority) task_priority,
					(select c.name from catalogue c where c.type=1 and c.enabled=1 and c.id=t.task_service_appl) task_service_appl,
					t.task_title,
					t.task_desc,
					t.task_server_ips,
					t.task_email_sent_on,
					t.task_call_made_on,
					(select c.name from catalogue c where c.type=5 and c.enabled=1 and c.id=t.task_status) task_status_text,
					task_last_updated_on,
					(select l.name from mpm_login l where l.id=t.task_last_updated_by) task_last_updated_by,
					t.task_document,
					t.task_status,
					(select count(*) cnt from mpm_task_follow_up_dtl f where f.mt_task_id=t.task_id and f.enabled=1) cnt
					from mpm_tasks t where enabled=1";
			if($status!=-1)
				$sql=$sql." and t.task_status=".$status;
			if($_SESSION["user_perfil"]==4)
				$sql=$sql." and t.task_assigned_to=".$_SESSION["user_id"];
			else if($id_tecnico!=-1)
			{
				$sql=$sql." and t.task_assigned_to=".$id_tecnico;
			}

			$sql=$sql."	and t.task_notified_on>=DATE_FORMAT('".$fechaInicio."','%Y-%m-%d %H:%i:%s') 
						and t.task_notified_on<=DATE_FORMAT('".$fechaFin."','%Y-%m-%d %H:%i:%s')";

			$sql=$sql." order by task_last_updated_on desc";
			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					if($_SESSION["user_perfil"]==1 || $_SESSION["user_perfil"]==4 || $row["task_recieved_by_profile"]==$_SESSION["user_perfil"])
					{
						$tasks[$count] = array(	$row["task_id"],$row["task_type"],$row["task_notified_through"],
											$row["task_notified_by"],$row["task_notified_on"],$row["task_recieved_by"],$row["task_assigned_to"],$row["task_assigned_on"],$row["task_priority"],
											$row["task_service_appl"],$row["task_title"],$row["task_desc"],$row["task_server_ips"],$row["task_email_sent_on"],$row["task_call_made_on"],$row["task_status_text"],$row["task_last_updated_on"],$row["task_last_updated_by"],$row["task_document"],$row["task_status"],$row["cnt"]);
						$count++;
					}
					else
					{
						
					}
				}
			}
			return $tasks;
		}

		public function getTaskDetailsById($dbcon,$tid,$DEBUG_STATUS)
		{
			//OK
			$sql="select t.task_id,
					(select c.name from catalogue c where c.type=3 and c.enabled=1 and c.id=t.task_type) task_type,
					(select c.name from catalogue c where c.type=7 and c.enabled=1 and c.id=t.task_notified_through) task_notified_through,
					task_notified_by,
					task_notified_on,
					(select l.name from mpm_login l where l.id=t.task_recieved_by) task_recieved_by,
					(select l.name from mpm_login l where l.id=t.task_assigned_to) task_assigned_to,
					t.task_assigned_on,
					(select c.name from catalogue c where c.type=6 and c.enabled=1 and c.id=t.task_priority) task_priority,
					(select c.name from catalogue c where c.type=1 and c.enabled=1 and c.id=t.task_service_appl) task_service_appl,
					t.task_title,
					t.task_desc,
					t.task_server_ips,
					t.task_email_sent_on,
					t.task_call_made_on,
					(select c.name from catalogue c where c.type=5 and c.enabled=1 and c.id=t.task_status) task_status_text,
					task_last_updated_on,
					(select l.name from mpm_login l where l.id=t.task_last_updated_by) task_last_updated_by,
					t.task_document,
					t.task_status 
					from mpm_tasks t where t.task_id=".$tid;  
			$sql=$sql." order by task_last_updated_on desc";
			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["task_id"],$row["task_type"],$row["task_notified_through"],
											$row["task_notified_by"],$row["task_notified_on"],$row["task_recieved_by"],$row["task_assigned_to"],$row["task_assigned_on"],$row["task_priority"],
											$row["task_service_appl"],$row["task_title"],$row["task_desc"],$row["task_server_ips"],$row["task_email_sent_on"],$row["task_call_made_on"],$row["task_status_text"],$row["task_last_updated_on"],$row["task_last_updated_by"],$row["task_document"],$row["task_status"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function getMyAssignedTasks($dbcon,$DEBUG_STATUS)
		{
			$sql="select t.id,
					t.created_on,
					t.task_short_desc,
					t.task_full_desc,
					(select c.name from catalog c where c.type=1 and c.enabled=1 and c.id=t.project_id) project,
					(select c.name from catalog c where c.type=2 and c.enabled=1 and c.id=t.id_ambiente) ambiente,
					(case when t.aprobacion_Cliente=1 then 'SI' else 'NO' end) aprobacion_Cliente,
					(select c.name from catalog c where c.type=3 and c.enabled=1 and c.id=t.categorea_tarea) task_category,
					(select c.name from catalog c where c.type=4 and c.enabled=1 and c.id=t.task_area) task_area,
					(select l.name from mpm_login l where l.id=t.created_by) asignado_por,
					(select l.name from mpm_login l where l.id=t.id_tecnico) tecnico,
					t.doc_path,
					(select c.name from catalog c where c.type=5 and c.enabled=1 and c.id=t.task_status) estado,
					t.task_status,
					(case when (timestampdiff(MINUTE, t.created_on,t.modified_on))=0 then (timestampdiff(MINUTE, t.created_on,now())) else (timestampdiff(MINUTE, t.created_on,t.modified_on)) end)  total_time
					from mpm_tasks_assigned t where t.id_tecnico=".$_SESSION["user_id"]."
					and enabled=1 
					and t.task_status in(31,32,35,39) 
					order by modified_on desc";

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["created_on"],$row["task_short_desc"],
											$row["task_full_desc"],$row["project"],$row["ambiente"],$row["aprobacion_Cliente"],$row["task_category"],$row["task_area"],
											$row["asignado_por"],$row["tecnico"],$row["doc_path"],$row["estado"],$row["task_status"],$row["total_time"]);
					$count++;
				}
			}
			return $tasks;
		}
		public function getAssignedTaskDetailBySearchParam($dbcon,$taskType,$projectCode,$id_ambiente,$taskDateInicial,$taskDateFinal,$taskOwner,$categorea_tarea,$DEBUG_STATUS)
		{
			$sql="select t.id,
					t.created_on,
					t.task_short_desc,
					t.task_full_desc,
					(select c.name from catalog c where c.type=1 and c.enabled=1 and c.id=t.project_id) project,
					(select c.name from catalog c where c.type=2 and c.enabled=1 and c.id=t.id_ambiente) ambiente,
					(case when t.aprobacion_Cliente=1 then 'SI' else 'NO' end) aprobacion_Cliente,
					(select c.name from catalog c where c.type=3 and c.enabled=1 and c.id=t.categorea_tarea) task_category,
					(select c.name from catalog c where c.type=4 and c.enabled=1 and c.id=t.task_area) task_area,
					(select l.name from mpm_login l where l.id=t.created_by) asignado_por,
					(select l.name from mpm_login l where l.id=t.id_tecnico) tecnico,
					t.doc_path,
					(select c.name from catalog c where c.type=5 and c.enabled=1 and c.id=t.task_status) estado,t.task_status,
					(case when (timestampdiff(MINUTE, t.created_on,t.modified_on))=0 then (timestampdiff(MINUTE, t.created_on,now())) else (timestampdiff(MINUTE, t.created_on,t.modified_on)) end)  total_time 
					from mpm_tasks_assigned t where enabled=1 ";

					if($taskOwner!=null && $taskOwner>0)
						$sql=$sql." and t.id_tecnico=".$taskOwner;
					if(isset($projectCode) && $projectCode!=0)
						$sql=$sql." and t.project_id=".$projectCode;
					if(isset($id_ambiente) && $id_ambiente!=0)
						$sql=$sql." and t.id_ambiente=".$id_ambiente;
					if(isset($categorea_tarea) && $categorea_tarea!=0)
						$sql=$sql." and t.categorea_tarea=".$categorea_tarea;
					if(isset($taskDateInicial) && !empty($taskDateInicial) && isset($taskDateFinal) && !empty($taskDateFinal))
						$sql=$sql."	and t.created_on>=DATE_FORMAT(concat(DATE_FORMAT('".$taskDateInicial."','%Y-%m-%d'),' 00:00:00'),'%Y-%m-%d %H:%i:%s') 
						and t.created_on<=DATE_FORMAT(concat(DATE_FORMAT('".$taskDateFinal."','%Y-%m-%d'),' 23:59:59'),'%Y-%m-%d %H:%i:%s')";
					$sql=$sql." order by created_on asc";

			echo $sql;
			error_log($sql, 0);
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["created_on"],$row["task_short_desc"],
											$row["task_full_desc"],$row["project"],$row["ambiente"],$row["aprobacion_Cliente"],$row["task_category"],$row["task_area"],
											$row["asignado_por"],$row["tecnico"],$row["doc_path"],$row["estado"],$row["task_status"],$row["total_time"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function getAssignedTaskById($dbcon,$tid,$DEBUG_STATUS)
		{
			$sql="select t.id,
					t.created_on,
					t.task_short_desc,
					t.task_full_desc,
					(select c.name from catalog c where c.type=1 and c.enabled=1 and c.id=t.project_id) project,
					(select c.name from catalog c where c.type=2 and c.enabled=1 and c.id=t.id_ambiente) ambiente,
					(case when t.aprobacion_Cliente=1 then 'SI' else 'NO' end) aprobacion_Cliente,
					(select c.name from catalog c where c.type=3 and c.enabled=1 and c.id=t.categorea_tarea) task_category,
					(select c.name from catalog c where c.type=4 and c.enabled=1 and c.id=t.task_area) task_area,
					(select l.name from mpm_login l where l.id=t.modified_by) asignado_por,
					(select l.name from mpm_login l where l.id=t.id_tecnico) tecnico,
					t.doc_path,
					(select c.name from catalog c where c.type=5 and c.enabled=1 and c.id=t.task_status) estado,
					t.task_status, t.id_tecnico 
					from mpm_tasks_assigned t where 
					enabled=1 ";

                if(isset($_SESSION["user_perfil"]) && $_SESSION["user_perfil"]==2)
                {
					$sql=$sql." and t.id_tecnico=".$_SESSION["user_id"];
				}
				$sql=$sql." and t.id=".$tid."
					order by modified_on desc";

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["created_on"],$row["task_short_desc"],
											$row["task_full_desc"],$row["project"],$row["ambiente"],$row["aprobacion_Cliente"],$row["task_category"],$row["task_area"],
											$row["asignado_por"],$row["tecnico"],$row["doc_path"],$row["estado"],$row["task_status"],$row["id_tecnico"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function getGestionById($dbcon,$tid,$DEBUG_STATUS)
		{
			//ok
			$sql="select f.id,f.solution_applied,f.cause,f.impact_identified,f.comments,f.task_follow_up_on, 
					(select l.name from mpm_login l where l.id=f.task_follow_up_by) gestion_by,f.task_follow_up_doc_path,
					(select c.name from catalogue c where c.type=5 and c.enabled=1 and c.id=f.task_follow_up_status) gestion_status,
					(select l.name from mpm_login l where l.id=f.task_new_tecnico_id) new_tecnico_id,
					(select c.name from catalogue c where c.type=4 and c.enabled=1 and c.id=f.technology_product_id) technology_product_id
					from mpm_task_follow_up_dtl f where f.mt_task_id=".$tid." and f.enabled=1";

			
			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["solution_applied"],$row["cause"],$row["impact_identified"],$row["comments"],$row["task_follow_up_on"],$row["gestion_by"],$row["task_follow_up_doc_path"],$row["gestion_status"],$row["new_tecnico_id"],$row["technology_product_id"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function registrarGestion($dbcon,$tid,$estadoTarea,$id_tecnico_new,$tecnologiaProducto,$solucionAplicado,$causaProblema,$impactProblema,$comentarios,$filePath,$base_conocimiento,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$task_id=mt_rand();
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
			if($estadoTarea!=5)
			{
				if($estadoTarea!=5)
					$id_tecnico_new = $adminUserIdConstant;
        		$sql = "INSERT INTO mpm_task_follow_up_dtl(mt_task_id,task_follow_up_on,task_follow_up_by,task_follow_up_status,task_new_tecnico_id,technology_product_id,solution_applied,cause,impact_identified,comments,task_follow_up_doc_path,task_mark_as_kdb,enabled) 
					values(".$tid.",now(),".$adminUserIdConstant.",".$estadoTarea.",".$id_tecnico_new.",".$tecnologiaProducto.",'".$solucionAplicado."','".$causaProblema."','".$impactProblema."','".$comentarios."','".$filePath."',".$base_conocimiento.",1)";
				if(mysqli_query($dbcon,$sql))
		        {
		        	$sql = "UPDATE mpm_tasks set task_status=".$estadoTarea.",task_last_updated_on=now(), task_last_updated_by=".$adminUserIdConstant." where task_id=".$tid;
					if(mysqli_query($dbcon,$sql))
			        {
			        	mysqli_commit($dbcon);
			        	$updStatus = 1;
			        	//SEND EMAIL HERE
			        }
			        else
			        {
			        	mysqli_rollback($dbcon);
			        }
		        }
			}
			else
			{
				$sql = "INSERT INTO mpm_task_follow_up_dtl(mt_task_id,task_follow_up_on,task_follow_up_by,task_follow_up_status,task_new_tecnico_id,technology_product_id,solution_applied,cause,impact_identified,comments,task_follow_up_doc_path,task_mark_as_kdb,enabled) 
					values(".$tid.",now(),".$adminUserIdConstant.",".$estadoTarea.",".$id_tecnico_new.",".$tecnologiaProducto.",'".$solucionAplicado."','".$causaProblema."','".$impactProblema."','".$comentarios."','".$filePath."',".$base_conocimiento.",1)";
				if(mysqli_query($dbcon,$sql))
		        {
		        	$sql = "UPDATE mpm_tasks set task_status=".$estadoTarea.",task_assigned_to=".$id_tecnico_new.", task_assigned_on=now(), task_last_updated_on=now(), task_last_updated_by=".$adminUserIdConstant." where task_id=".$tid;
					if(mysqli_query($dbcon,$sql))
			        {
			        	mysqli_commit($dbcon);
			        	$updStatus = 1;
			        	$sql = "select email,name from mpm_login where id=".$id_tecnico_new;
						//echo $sql;
							$result = mysqli_query($dbcon,$sql);
						if(mysqli_num_rows($result) > 0)  
						{
							while($row = mysqli_fetch_assoc($result)) 
							{
								$to = strtoupper($row["email"]);
								$subject = 'MERAKI 360 HELP DESK- TICKET DELEGADO :'.$tid;
								$txt = 'Estimado '.strtoupper($row["name"]).'!'."<br><br>";
								$txt=$txt.'Ticket -No: '.$tid.' delegado en MERAKI 360 HELP DESK para su atencion'."<br><br>";

								$headers = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
								$headers .= 'From:MERAKI 360 HELP DESK <info@merakiminds.com>' . "\r\n";

								$res=mail($to,$subject,$txt,$headers);
							}
						}
			        }
			        else
			        {
			        	mysqli_rollback($dbcon);
			        }
		        }

			}
			
	        
	        
        	return $updStatus;			
		}

		public function getUserPerformance($dbcon,$DEBUG_STATUS)
		{
			$sql="select t.id_tecnico,(select ml.name from mpm_login ml where ml.id=t.id_tecnico) tecnico_name,
					(select c.name from catalog c where c.type=4 and c.enabled=1 and c.id=t.task_area) task_area, 
					count(*) cnt
					from mpm_tasks_assigned t where enabled=1 ";
			if($_SESSION["user_perfil"]>1)
			{
				$sql=$sql." and t.id_tecnico=".$_SESSION["user_id"];
				//$sql=$sql." and t.id_tecnico=3";
			}
			$sql=$sql." and t.modified_on>=DATE_ADD(DATE_FORMAT(concat(DATE_FORMAT(now(),'%Y-%m-%d'),' 00:00:00'),'%Y-%m-%d %H:%i:%s'), INTERVAL -30 DAY) 
						and t.modified_on<=DATE_FORMAT(concat(DATE_FORMAT(now(),'%Y-%m-%d'),' 23:59:59'),'%Y-%m-%d %H:%i:%s')
						group by t.id_tecnico,t.task_area ";
			
			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id_tecnico"],$row["tecnico_name"],$row["task_area"],$row["cnt"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function getSearchData($dbcon,$searchparams,$DEBUG_STATUS)
		{
			$tasks=array();
			$count=0;

			$dataParam = explode(";", $searchparams);
			for($x=0;$x<count($dataParam);$x++)
			{
				/*$sql="select t.id,
					t.modified_on,
					(select c.name from catalog c where c.type=1 and c.enabled=1 and c.id=project_id) project,
					t.task_short_desc,
					t.task_full_desc,
					(select c.name from catalog c where c.type=2 and c.enabled=1 and c.id=t.id_ambiente) ambiente,
					(select c.name from catalog c where c.type=3 and c.enabled=1 and c.id=t.categorea_tarea) task_category,
					gt.gestion_doc doc_path,gt.gestion_dtl,
					(select l.name from mpm_login l where l.id=t.id_tecnico) tecnico
					from mpm_tasks_assigned t left join mpm_gestion_tareas gt on t.id=gt.mpm_ta_id  where t.enabled=1";
				$sql=$sql." and (t.task_short_desc like '%".$dataParam[$x]."%' or t.task_full_desc like '%".$dataParam[$x]."%')";
				$sql=$sql." order by modified_on asc";*/

				
				$sql="select t.task_id,
					(select c.name from catalogue c where c.type=3 and c.enabled=1 and c.id=t.task_type) task_type,
					(select c.name from catalogue c where c.type=7 and c.enabled=1 and c.id=t.task_notified_through) task_notified_through,
					task_notified_by,
					task_notified_on,
					(select l.name from mpm_login l where l.id=t.task_recieved_by) task_recieved_by,
					(select l.name from mpm_login l where l.id=t.task_assigned_to) task_assigned_to,
					t.task_assigned_on,
					(select c.name from catalogue c where c.type=6 and c.enabled=1 and c.id=t.task_priority) task_priority,
					(select c.name from catalogue c where c.type=1 and c.enabled=1 and c.id=t.task_service_appl) task_service_appl,
					t.task_title,
					t.task_desc,
					t.task_server_ips,
					t.task_email_sent_on,
					t.task_call_made_on,
					(select c.name from catalogue c where c.type=5 and c.enabled=1 and c.id=t.task_status) task_status_text,
					task_last_updated_on,
					(select l.name from mpm_login l where l.id=t.task_last_updated_by) task_last_updated_by,
					t.task_document,
					t.task_status,
					(select count(*) cnt from mpm_task_follow_up_dtl f where f.mt_task_id=t.task_id and f.enabled=1) cnt
					from mpm_tasks t where t.enabled=1 and (t.task_title like '%".$dataParam[$x]."%' or t.task_desc like '%".$dataParam[$x]."%') order by task_last_updated_on desc";
				//echo $sql;
				$result = mysqli_query($dbcon,$sql);
	            if(mysqli_num_rows($result) > 0)  
	            {
					while($row = mysqli_fetch_assoc($result)) 
					{
						$tasks[$count] = array(	$row["task_id"],$row["task_type"],$row["task_notified_through"],
												$row["task_notified_by"],$row["task_notified_on"],$row["task_recieved_by"],$row["task_assigned_to"],$row["task_assigned_on"],$row["task_priority"],
												$row["task_service_appl"],$row["task_title"],$row["task_desc"],$row["task_server_ips"],$row["task_email_sent_on"],$row["task_call_made_on"],$row["task_status_text"],$row["task_last_updated_on"],$row["task_last_updated_by"],$row["task_document"],$row["task_status"],$row["cnt"]);
						$count++;
					}
				}
			}
			
			
			return $tasks;
		}

		public function updateNotidacionDone($dbcon,$medioNotificacion, $Id,$DEBUG_STATUS)
		{
			//ok
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
			if($medioNotificacion==1)
        		$sql = "UPDATE mpm_tasks set task_email_sent_on=now(),task_last_updated_on=now(),task_last_updated_by=".$adminUserIdConstant.",task_status=46 where task_id=".$Id;
        	else if($medioNotificacion==2)
        		$sql = "UPDATE mpm_tasks set task_call_made_on=now(),task_last_updated_on=now(),task_last_updated_by=".$adminUserIdConstant.",task_status=47 where task_id=".$Id;
			//echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 2;
	        }
        	return $updStatus;			
		}
	}


?>