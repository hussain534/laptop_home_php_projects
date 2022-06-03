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
			$sql="select u.id userid, u.name user_name,u.email,u.password,u.profile perfil,u.contact_number from mb_login u
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
					$userContact=$row["contact_number"];
					$userPerfil=$row["perfil"];
            	}
            	if(strcmp($userPwd, $user_password)==0)
            	{
		        	$sql = "insert into mb_audit(login_id,login_dt) values(".$userId.",now())";
					////echo $sql.'<br>';
			        if(mysqli_query($dbcon,$sql))
			        {
			        	mysqli_commit($dbcon);		        	
			            $updStatus = 1;
			        	$_SESSION["user_id"]=$userId;
			        	$_SESSION["user_name"]=$userName;
						$_SESSION["user_email"]=$userEmail;
						$_SESSION["user_perfil"]=$userPerfil;
						$_SESSION["userContact"]=$userPerfil;
			            $_SESSION['LAST_ACTIVITY'] = time();
			            $_SESSION["table_view"]=1;

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

		public function registerUser($dbcon,$adminUserIdConstant,$user_email,$user_name,$userContact,$user_password,$userProfile,$DEBUG_STATUS)
		{
			
			$sql="select id, name,email from mb_login where email = '".strtoupper($user_email)."' and enabled=1";
			mysqli_autocommit($dbcon,FALSE);
			$result = mysqli_query($dbcon,$sql);
			$updStatus=0;
            if(mysqli_num_rows($result) == 0)
            {
            	$sql = "INSERT INTO mb_login(name,email,password,contact_number,profile,created_by,created_on,modified_by,modified_on,enabled) 
				values('".$user_name."','".$user_email."','".$user_password."','".$userContact."',".$userProfile.",".$adminUserIdConstant.",now(),".$adminUserIdConstant.",now(),1)";
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

		public function getAllTeachers($dbcon,$isPaginationEnabled,$current_page,$products_per_page,$DEBUG_STATUS)
		{
			if($isPaginationEnabled==1)
				$sql="select id,name,email,contact_number,enabled from mb_login where profile=2 limit ".$current_page*$products_per_page.",".$products_per_page;
			else
				$sql="select id,name,email,contact_number,enabled from mb_login where profile=2";

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["name"],$row["email"],$row["contact_number"],$row["enabled"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function getTeacherDtlById($dbcon,$id,$DEBUG_STATUS)
		{
			$sql="select id,name,email,contact_number,password,enabled from mb_login where profile=2 and id=".$id;

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["name"],$row["email"],$row["contact_number"],$row["password"],$row["enabled"]);
					$count++;
				}
			}
			return $tasks;
		}

		

		public function enableDisableTeacher($dbcon,$userId,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=9;
			mysqli_autocommit($dbcon,FALSE);
        	$sql = "UPDATE mb_login set enabled=(enabled*(-1)+1), modified_by=".$adminUserIdConstant.",modified_on=now() where id=".$userId;
			echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 2;
	        }
        	return $updStatus;			
		}

		public function updateTeacher($dbcon,$id,$name,$email,$contact,$password,$status,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
			$sql = "UPDATE mb_login set name='".$name."', email='".$email."', password='".$password."', contact_number='".$contact."', enabled=".$status.", modified_by=".$adminUserIdConstant.",modified_on=now() where id=".$id;
			echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
		        	$updStatus = 1;
	        }
        	
        	return $updStatus;			
		}



		public function getAllStudents($dbcon,$isPaginationEnabled,$current_page,$products_per_page,$DEBUG_STATUS)
		{
			if($isPaginationEnabled==1)
				$sql="select id,name,email,contact_number,enabled from mb_login where profile=3 limit ".$current_page*$products_per_page.",".$products_per_page;
			else
				$sql="select id,name,email,contact_number,enabled from mb_login where profile=3";

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["name"],$row["email"],$row["contact_number"],$row["enabled"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function getStudentDtlById($dbcon,$id,$DEBUG_STATUS)
		{
			$sql="select id,name,email,contact_number,password,enabled from mb_login where profile=3 and id=".$id;

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["name"],$row["email"],$row["contact_number"],$row["password"],$row["enabled"]);
					$count++;
				}
			}
			return $tasks;
		}

		

		public function enableDisableStudent($dbcon,$userId,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=9;
			mysqli_autocommit($dbcon,FALSE);
        	$sql = "UPDATE mb_login set enabled=(enabled*(-1)+1), modified_by=".$adminUserIdConstant.",modified_on=now() where id=".$userId;
			echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 2;
	        }
        	return $updStatus;			
		}

		public function updateStudent($dbcon,$id,$name,$email,$contact,$password,$status,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
			$sql = "UPDATE mb_login set name='".$name."', email='".$email."', password='".$password."', contact_number='".$contact."', enabled=".$status.", modified_by=".$adminUserIdConstant.",modified_on=now() where id=".$id;
			echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
		        	$updStatus = 1;
	        }
        	
        	return $updStatus;			
		}





		public function addNewClassRoomCourseDtl($dbcon,$name,$description,$start_from,$ends_on,$capacity,$teacher_id,$DEBUG_STATUS)
		{
			$updStatus=9;
			$adminUserIdConstant = $_SESSION["user_id"];			
			$sql = "INSERT INTO mb_course(name,description,start_from,ends_on,course_type,capacity,teacher_id,created_by,created_on,modified_by,modified_on,enabled) 
				values('".$name."','".$description."',DATE_FORMAT('".$start_from."','%Y-%m-%d'),DATE_FORMAT('".$ends_on."','%Y-%m-%d'),1,".$capacity.",".$teacher_id.",".$adminUserIdConstant.",now(),".$adminUserIdConstant.",now(),-1)";
			echo $sql;	
			if(mysqli_query($dbcon,$sql))
	        {		        	
				mysqli_commit($dbcon);
        		$updStatus = 1;
	        }        	
            
            return $updStatus;	
		}
		public function getAllClassRoomCourses($dbcon,$isPaginationEnabled,$current_page,$products_per_page,$DEBUG_STATUS)
		{
			if($isPaginationEnabled==1)
				$sql="select id,name,description,DATE_FORMAT(start_from,'%Y-%m-%d') start_from,DATE_FORMAT(ends_on,'%Y-%m-%d') ends_on,enabled,capacity,(select count(*) from mb_allocation where id_course=mc.id and enabled=1) enrolled_capacity from mb_course mc where course_type=1 limit ".$current_page*$products_per_page.",".$products_per_page;
			else
				$sql="select id,name,description,DATE_FORMAT(start_from,'%Y-%m-%d') start_from,DATE_FORMAT(ends_on,'%Y-%m-%d') ends_on,enabled,capacity,(select count(*) from mb_allocation where id_course=mc.id and enabled=1) enrolled_capacity from mb_course mc where course_type=1";

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["name"],$row["description"],$row["start_from"],$row["ends_on"],$row["enabled"],$row["capacity"],$row["enrolled_capacity"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function getClassRoomCourseDtlById($dbcon,$id,$DEBUG_STATUS)
		{
			$sql="select id,name,description,DATE_FORMAT(start_from,'%Y-%m-%d') start_from,DATE_FORMAT(ends_on,'%Y-%m-%d') ends_on,enabled from mb_course where course_type=1 and id=".$id;

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["name"],$row["description"],$row["start_from"],$row["ends_on"],$row["enabled"]);
					$count++;
				}
			}
			return $tasks;
		}		

		public function enableDisableClassRoomCourse($dbcon,$userId,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=9;
			mysqli_autocommit($dbcon,FALSE);
        	$sql = "UPDATE mb_course set enabled=(enabled*(-1)+1), modified_by=".$adminUserIdConstant.",modified_on=now() where id=".$userId;
			echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 2;
	        }
        	return $updStatus;			
		}

		public function updateClassRoomCourse($dbcon,$id,$name,$description,$start_from,$ends_on,$status,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
			$sql = "UPDATE mb_course set name='".$name."', description='".$description."', start_from='".$start_from."', ends_on='".$ends_on."', enabled=".$status.", modified_by=".$adminUserIdConstant.",modified_on=now() where id=".$id;
			echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
		        	$updStatus = 1;
	        }
        	
        	return $updStatus;			
		}


		public function addNewOnlineCourseDtl($dbcon,$name,$description,$start_from,$ends_on,$capacity,$teacher_id,$DEBUG_STATUS)
		{
			$updStatus=9;
			$adminUserIdConstant = $_SESSION["user_id"];
			$sql = "INSERT INTO mb_course(name,description,start_from,ends_on,course_type,capacity,teacher_id,created_by,created_on,modified_by,modified_on,enabled) 
				values('".$name."','".$description."',DATE_FORMAT('".$start_from."','%Y-%m-%d'),DATE_FORMAT('".$ends_on."','%Y-%m-%d'),2,".$capacity.",".$teacher_id.",".$adminUserIdConstant.",now(),".$adminUserIdConstant.",now(),-1)";
			echo $sql;	
			if(mysqli_query($dbcon,$sql))
	        {		        	
				mysqli_commit($dbcon);
        		$updStatus = 1;
	        }        	
            
            return $updStatus;	
		}
		public function getAllOnlineCourses($dbcon,$isPaginationEnabled,$current_page,$products_per_page,$DEBUG_STATUS)
		{
			if($isPaginationEnabled==1)
				$sql="select id,name,description,DATE_FORMAT(start_from,'%Y-%m-%d') start_from,DATE_FORMAT(ends_on,'%Y-%m-%d') ends_on,enabled,capacity,(select count(*) from mb_allocation where id_course=mc.id and enabled=1) enrolled_capacity from mb_course mc where course_type=2 limit ".$current_page*$products_per_page.",".$products_per_page;
			else
				$sql="select id,name,description,DATE_FORMAT(start_from,'%Y-%m-%d') start_from,DATE_FORMAT(ends_on,'%Y-%m-%d') ends_on,enabled,capacity,(select count(*) from mb_allocation where id_course=mc.id and enabled=1) enrolled_capacity from mb_course mc where course_type=2";

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["name"],$row["description"],$row["start_from"],$row["ends_on"],$row["enabled"],$row["capacity"],$row["enrolled_capacity"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function getOnlineCourseDtlById($dbcon,$id,$DEBUG_STATUS)
		{
			$sql="select id,name,description,DATE_FORMAT(start_from,'%Y-%m-%d') start_from,DATE_FORMAT(ends_on,'%Y-%m-%d') ends_on,enabled from mb_course where course_type=2 and id=".$id;

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["name"],$row["description"],$row["start_from"],$row["ends_on"],$row["enabled"]);
					$count++;
				}
			}
			return $tasks;
		}		

		public function enableDisableOnlineCourse($dbcon,$userId,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=9;
			mysqli_autocommit($dbcon,FALSE);
        	$sql = "UPDATE mb_course set enabled=(enabled*(-1)+1), modified_by=".$adminUserIdConstant.",modified_on=now() where id=".$userId;
			echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 2;
	        }
        	return $updStatus;			
		}

		public function updateOnlineCourse($dbcon,$id,$name,$description,$start_from,$ends_on,$status,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
			$sql = "UPDATE mb_course set name='".$name."', description='".$description."', start_from='".$start_from."', ends_on='".$ends_on."', enabled=".$status.", modified_by=".$adminUserIdConstant.",modified_on=now() where id=".$id;
			echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
		        	$updStatus = 1;
	        }
        	
        	return $updStatus;			
		}


		public function addNewSelfStudyCourseDtl($dbcon,$name,$description,$start_from,$ends_on,$teacher_id,$DEBUG_STATUS)
		{
			$updStatus=9;
			$adminUserIdConstant = $_SESSION["user_id"];
			$sql = "INSERT INTO mb_course(name,description,start_from,ends_on,course_type,capacity,teacher_id,created_by,created_on,modified_by,modified_on,enabled) 
				values('".$name."','".$description."',DATE_FORMAT('".$start_from."','%Y-%m-%d'),DATE_FORMAT('".$ends_on."','%Y-%m-%d'),3,-1,".$teacher_id.",".$adminUserIdConstant.",now(),".$adminUserIdConstant.",now(),-1)";
			echo $sql;	
			if(mysqli_query($dbcon,$sql))
	        {		        	
				mysqli_commit($dbcon);
        		$updStatus = 1;
	        }        	
            
            return $updStatus;	
		}
		public function getAllSelfStudyCourses($dbcon,$isPaginationEnabled,$current_page,$products_per_page,$DEBUG_STATUS)
		{
			if($isPaginationEnabled==1)
				$sql="select id,name,description,DATE_FORMAT(start_from,'%Y-%m-%d') start_from,DATE_FORMAT(ends_on,'%Y-%m-%d') ends_on,enabled,capacity,(select count(*) from mb_allocation where id_course=mc.id and enabled=1) enrolled_capacity from mb_course mc where course_type=3 limit ".$current_page*$products_per_page.",".$products_per_page;
			else
				$sql="select id,name,description,DATE_FORMAT(start_from,'%Y-%m-%d') start_from,DATE_FORMAT(ends_on,'%Y-%m-%d') ends_on,enabled,capacity,(select count(*) from mb_allocation where id_course=mc.id and enabled=1) enrolled_capacity from mb_course mc where course_type=3";

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["name"],$row["description"],$row["start_from"],$row["ends_on"],$row["enabled"],$row["capacity"],$row["enrolled_capacity"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function getSelfStudyCourseDtlById($dbcon,$id,$DEBUG_STATUS)
		{
			$sql="select id,name,description,DATE_FORMAT(start_from,'%Y-%m-%d') start_from,DATE_FORMAT(ends_on,'%Y-%m-%d') ends_on,enabled from mb_course where course_type=3 and id=".$id;

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["name"],$row["description"],$row["start_from"],$row["ends_on"],$row["enabled"]);
					$count++;
				}
			}
			return $tasks;
		}		

		public function enableDisableSelfStudyCourse($dbcon,$userId,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=9;
			mysqli_autocommit($dbcon,FALSE);
        	$sql = "UPDATE mb_course set enabled=(enabled*(-1)+1), modified_by=".$adminUserIdConstant.",modified_on=now() where id=".$userId;
			echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$updStatus = 2;
	        }
        	return $updStatus;			
		}

		public function updateSelfStudyCourse($dbcon,$id,$name,$description,$start_from,$ends_on,$status,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
			$sql = "UPDATE mb_course set name='".$name."', description='".$description."', start_from='".$start_from."', ends_on='".$ends_on."', enabled=".$status.", modified_by=".$adminUserIdConstant.",modified_on=now() where id=".$id;
			echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
		        	$updStatus = 1;
	        }
        	
        	return $updStatus;			
		}

		public function getUserDtlById($dbcon,$id,$DEBUG_STATUS)
		{
			$sql="select id,name,email,contact_number,password,enabled from mb_login where id=".$id;

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["name"],$row["email"],$row["contact_number"],$row["password"],$row["enabled"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function updateUser($dbcon,$id,$name,$email,$contact,$password,$status,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=0;
			mysqli_autocommit($dbcon,FALSE);
			$sql = "UPDATE mb_login set name='".$name."', email='".$email."', password='".$password."', contact_number='".$contact."', enabled=".$status.", modified_by=".$adminUserIdConstant.",modified_on=now() where id=".$id;
			echo $sql.'<br>';
	        
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
		        	$updStatus = 1;
	        }
        	
        	return $updStatus;			
		}

		public function getAllCourses($dbcon,$isPaginationEnabled,$current_page,$products_per_page,$DEBUG_STATUS)
		{
			if($isPaginationEnabled==1)
				$sql="select id,name,description,DATE_FORMAT(start_from,'%Y-%m-%d') start_from,DATE_FORMAT(ends_on,'%Y-%m-%d') ends_on,
			enabled,(case when course_type=1 then 'CLASS ROOM' when course_type=2 then 'ONLINE' 
			when course_type=3 then 'SELF STUDY' else '' end) course_type,capacity, 
			(select count(*) from mb_allocation where id_course=mc.id and enabled=1) enrolled_capacity 
			from mb_course mc where id not in(select id_course from mb_allocation ma
				where id_user=".$_SESSION["user_id"]." and enabled=1) and enabled=1 
			limit ".$current_page*$products_per_page.",".$products_per_page;
			else
				$sql="select id,name,description,DATE_FORMAT(start_from,'%Y-%m-%d') start_from,DATE_FORMAT(ends_on,'%Y-%m-%d') ends_on,
			enabled,(case when course_type=1 then 'CLASS ROOM' when course_type=2 then 'ONLINE' 
			when course_type=3 then 'SELF STUDY' else '' end) course_type,capacity, 
			(select count(*) from mb_allocation where id_course=mc.id and enabled=1) enrolled_capacity 
			from mb_course mc where id not in(select id_course from mb_allocation ma
			where id_user=".$_SESSION["user_id"]." and enabled=1) and enabled=1";

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["name"],$row["description"],$row["start_from"],$row["ends_on"],$row["enabled"],$row["course_type"],$row["capacity"],$row["enrolled_capacity"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function getMyAllCourses($dbcon,$isPaginationEnabled,$current_page,$products_per_page,$DEBUG_STATUS)
		{
			if($_SESSION["user_perfil"]==2)
			{
				if($isPaginationEnabled==1)
					$sql="select mc.id,mc.name,mc.description,DATE_FORMAT(mc.start_from,'%Y-%m-%d') start_from,
							DATE_FORMAT(mc.ends_on,'%Y-%m-%d') ends_on,mc.enabled,
							(case when mc.course_type=1 then 'CLASS ROOM' when mc.course_type=2 then 'ONLINE' 
							when mc.course_type=3 then 'SELF STUDY' else '' end) course_type, mc.modified_on last_modified,mc.capacity,
							(select count(*) from mb_allocation where id_course=mc.id and enabled=1) enrolled_capacity 
							from mb_course mc where mc.teacher_id=".$_SESSION["user_id"]." 
							order by mc.start_from limit ".$current_page*$products_per_page.",".$products_per_page;
				else
					$sql="select mc.id,mc.name,mc.description,DATE_FORMAT(mc.start_from,'%Y-%m-%d') start_from,
							DATE_FORMAT(mc.ends_on,'%Y-%m-%d') ends_on,mc.enabled,
							(case when mc.course_type=1 then 'CLASS ROOM' when mc.course_type=2 then 'ONLINE' 
							when mc.course_type=3 then 'SELF STUDY' else '' end) course_type, mc.modified_on last_modified,mc.capacity,
							(select count(*) from mb_allocation where id_course=mc.id and enabled=1) enrolled_capacity 
							from mb_course mc where mc.teacher_id=".$_SESSION["user_id"];
			}
			else
			{
				if($isPaginationEnabled==1)
					$sql="select ma.id,mc.name,mc.description,DATE_FORMAT(mc.start_from,'%Y-%m-%d') start_from,
						DATE_FORMAT(mc.ends_on,'%Y-%m-%d') ends_on,ma.enabled,
						(case when mc.course_type=1 then 'CLASS ROOM' when mc.course_type=2 then 'ONLINE' 
						when mc.course_type=3 then 'SELF STUDY' else '' end) course_type, ma.modified_on last_modified,mc.capacity,
						(select count(*) from mb_allocation where id_course=mc.id and enabled=1) enrolled_capacity 
						from mb_allocation ma, mb_course mc where ma.id_course=mc.id 
						and ma.allocation_type=2 
						and ma.id_user=".$_SESSION["user_id"]." 
						order by mc.start_from limit ".$current_page*$products_per_page.",".$products_per_page;
				else
					$sql="select ma.id,mc.name,mc.description,DATE_FORMAT(mc.start_from,'%Y-%m-%d') start_from,
						DATE_FORMAT(mc.ends_on,'%Y-%m-%d') ends_on,ma.enabled,
						(case when mc.course_type=1 then 'CLASS ROOM' when mc.course_type=2 then 'ONLINE' 
						when mc.course_type=3 then 'SELF STUDY' else '' end) course_type, ma.modified_on last_modified,mc.capacity,
						(select count(*) from mb_allocation where id_course=mc.id and enabled=1) enrolled_capacity 
						from mb_allocation ma, mb_course mc where ma.id_course=mc.id 
						and ma.allocation_type=2 
						and ma.id_user=".$_SESSION["user_id"];
			}

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["name"],$row["description"],$row["start_from"],$row["ends_on"],$row["enabled"],$row["course_type"],$row["last_modified"],$row["capacity"],$row["enrolled_capacity"]);
					$count++;
				}
			}
			return $tasks;
		}

		public function manageEnrollmentCourse($dbcon,$Id,$DEBUG_STATUS)
		{
			$adminUserIdConstant = $_SESSION["user_id"];
			$updStatus=9;
			mysqli_autocommit($dbcon,FALSE);
        	$sql="select * from mb_allocation where id_course=".$Id." and id_user = ".$_SESSION["user_id"]." and enabled=1";
        	echo $sql.'<br>';
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {
	        	$sql = "UPDATE mb_allocation set enabled=(enabled*(-1)+1), modified_by=".$adminUserIdConstant.",modified_on=now() where id=".$Id;
				echo $sql.'<br>';
		        
		        if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        	$updStatus = 2;
		        }
		    }
		    else
		    {
		    	$updStatus = 7;
		    }

        	return $updStatus;			
		}

		public function enrollInCourse($dbcon,$id,$DEBUG_STATUS)
		{
			$updStatus=8;
			$adminUserIdConstant = $_SESSION["user_id"];


			$sql="select * from mb_allocation where id_course=".$id." and id_user = ".$_SESSION["user_id"]." and enabled=1";
			mysqli_autocommit($dbcon,FALSE);
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {
				$sql = "INSERT INTO mb_allocation(id_course,id_user,allocation_type,created_by,created_on,modified_by,modified_on,enabled) 
					values(".$id.",".$adminUserIdConstant.",2,".$adminUserIdConstant.",now(),".$adminUserIdConstant.",now(),1)";
				echo $sql;	
				if(mysqli_query($dbcon,$sql))
		        {		        	
					mysqli_commit($dbcon);
	        		$updStatus = 1;
		        }   
		    }
		    else
		    {
		    	$updStatus = 7;
		    }     	
            
            return $updStatus;	
		}

		public function addContentDtl($dbcon,$course_id,$content_type,$content_path,$DEBUG_STATUS)
		{
			$updStatus=9;
			$adminUserIdConstant = $_SESSION["user_id"];
			$sql = "INSERT INTO mb_course_content(course_id,content_type,content_path,created_by,created_on,modified_by,modified_on,enabled) 
				values(".$course_id.",".$content_type.",'".$content_path."',".$adminUserIdConstant.",now(),".$adminUserIdConstant.",now(),1)";
			echo $sql;	
			if(mysqli_query($dbcon,$sql))
	        {		        	
				mysqli_commit($dbcon);
        		$updStatus = 1;
	        }        	
            
            return $updStatus;	
		}

		public function getCourseContentDtl($dbcon,$courseId,$isPaginationEnabled,$current_page,$products_per_page,$DEBUG_STATUS)
		{
			if($isPaginationEnabled==1)
				$sql="select id,course_id,
						(case 	when content_type=1 then 'WORD' 
								when content_type=2 then 'PPT'
								when content_type=3 then 'EXCEL' 
								when content_type=4 then 'PDF' 
								when content_type=5 then 'IMAGE'
								when content_type=6 then 'VIDEO' end) content_type,
						content_path,enabled from mb_course_content where course_id=".$courseId." and enabled=1  
			limit ".$current_page*$products_per_page.",".$products_per_page;
			else
				$sql="select id,course_id,
						(case 	when content_type=1 then 'WORD' 
								when content_type=2 then 'PPT'
								when content_type=3 then 'EXCEL' 
								when content_type=4 then 'PDF' 
								when content_type=5 then 'IMAGE'
								when content_type=6 then 'VIDEO' end) content_type,
						content_path,enabled from mb_course_content where course_id=".$courseId." and enabled=1";

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["course_id"],$row["content_type"],$row["content_path"],$row["enabled"]);
					$count++;
				}
			}
			return $tasks;
		}


		public function getDoc($dbcon,$DocId,$DEBUG_STATUS)
		{
			$sql="select id,course_id,
						(case 	when content_type=1 then 'WORD' 
								when content_type=2 then 'PPT'
								when content_type=3 then 'EXCEL' 
								when content_type=4 then 'PDF' 
								when content_type=5 then 'IMAGE'
								when content_type=6 then 'VIDEO' end) content_type,
						content_path,enabled from mb_course_content where id=".$DocId." and enabled=1";

			//echo $sql;
			$tasks=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tasks[$count] = array(	$row["id"],$row["course_id"],$row["content_type"],$row["content_path"],$row["enabled"]);
					$count++;
				}
			}
			return $tasks;
		}

	}
?>