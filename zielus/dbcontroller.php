<?php
	//session_start();
	class controller
	{
		public function doRegisterAndLogin($dbcon,$userEmail,$userPwd,$userRole,$DEBUG_STATUS)
		{
			session_start();
			mysqli_autocommit($dbcon,FALSE);
			$err_code=1;
			$confirmacion_codigo=mt_rand();
			$sql = "INSERT INTO z_users(u_emailid,u_role,u_created_on,u_created_by,u_verificacion_code) VALUES('$userEmail',3,now(),1,".$confirmacion_codigo.")";
			if($DEBUG_STATUS)
				echo '$sql-1::'.$sql.'<br>';
				//echo 'dbcon::'.$dbcon.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	//echo 'INSERTED INTO Z_USERS<br>';
	        	$last_id = mysqli_insert_id($dbcon);
	        	if($DEBUG_STATUS)
					echo 'LAST ID::'.$last_id.'<br>';
	        	$sessionId = time().'_'.mt_rand();
	        	if($DEBUG_STATUS)
					echo 'sessionId::'.$sessionId.'<br>';
	            $sql = "INSERT INTO z_login(L_ID,L_EMAIL,L_PWD, L_LAST_LOGIN_DT, L_FAILED_ATTEMPTS, L_IS_FIRST_LOGIN,L_IS_BLOCKED,L_IN_USE,L_SESSION_ID) 
	            VALUES($last_id,'$userEmail','$userPwd',now(),0,0,1,0,'$sessionId')";
	            if($DEBUG_STATUS)
					echo '$sql-2::'.$sql.'<br>';
	            if(mysqli_query($dbcon,$sql))
	            {
	            	$err_code=0; // REGISTRATION AND LOGIN SUCCESS
	            	if($DEBUG_STATUS)
						echo 'REGISTRATION AND LOGIN SUCCESS<br>';

					$to = $userEmail;
					$subject = 'ZIELUS - ACTIVAR CUENTA';
					$txt = '¡HOLA!'."<br><br>";
					$txt=$txt.'Se ha registrado cuenta en ZIELUS'."<br><br>";
					$txt=$txt.'Para la activacion del cuenta , por favor haz clic en la siguiente link.'."<br><br>";
					/*$txt=$txt.'LINK DE ACTIVACION:http://localhost/Taxi3/activarCuenta.php?id='.$confirmacion_codigo."<br><br>";*/
					$txt=$txt.'LINK DE ACTIVACION:http://zielus.hutesol.com/activarCuenta.php?id='.$confirmacion_codigo."<br><br>";
					$txt=$txt.'En caso de tener problemas, puedes copiarle ese link y pegarle en la barra de direccion en cualquier navegador de tu gusto.'."<br><br>";
					$txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en support@zielus.com'."<br><br>";
					$txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";
					$txt=$txt.'El Equipo de Zielus - Ecuador'."<br><br>";

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					$headers .= 'From:info@hutesol.com' . "\r\n";

					$res=mail($to,$subject,$txt,$headers);
					if($res==true)
					{
						mysqli_commit($dbcon);
						$_SESSION['userid']=$last_id;
			            $_SESSION['userEmail']=$userEmail;
			            $_SESSION['userRole']=3;
			            $_SESSION['LAST_ACTIVITY'] = time();
			        }
			        else
			        {
			        	$err_code=2;
			        	mysqli_rollback($dbcon);
			        }
			        /*mysqli_commit($dbcon);
			        $_SESSION['userid']=$last_id;
			        $_SESSION['userEmail']=$userEmail;
			        $_SESSION['userRole']=3;
			        $_SESSION['LAST_ACTIVITY'] = time();*/
	            }
	            else
	            {
	            	$err_code=1; // ERROR EN LOGIN
	            	if($DEBUG_STATUS)
						echo 'ERROR EN LOGIN<br>';
					mysqli_rollback($dbcon);
	            }
	        }
	        else
	        {
	        	$err_code=1;// ERROR EN REGISTRATION
	        	if($DEBUG_STATUS)
					echo 'ERROR EN REGISTRATION<br>';
	        }
	        return $err_code;
		}

		public function activarCuenta($dbcon,$id,$DEBUG_STATUS)
		{
			mysqli_autocommit($dbcon,FALSE);
			$err_code=1;
			$sql = "UPDATE z_users set u_is_email_verified=0 WHERE u_verificacion_code=".$id;
			if($DEBUG_STATUS)
				echo '$sql-1::'.$sql.'<br>';
	        if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
	        {
	        	mysqli_commit($dbcon);
	        	$err_code=0;
	        	if($DEBUG_STATUS)
					echo 'ACCOUNT ACTIVATION SUCCESSFUL<br>';
			
	        }
	        return $err_code;
		}

		public function doLogout($dbcon,$userId,$userEmail,$DEBUG_STATUS)
		{
			//session_start();
			mysqli_autocommit($dbcon,FALSE);
			$err_code=0;
			$sql = "UPDATE z_login SET L_IN_USE=0,L_SESSION_ID='' WHERE L_ID=$userId and L_EMAIL='$userEmail'";
			if($DEBUG_STATUS)
				echo '$sql-1::'.$sql.'<br>';
	        if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
	        {
	        	mysqli_commit($dbcon);
	        	$err_code=0;
	        	if($DEBUG_STATUS)
					echo 'LOGOUT SUCCESSFUL<br>';
			
	        }
	        	session_destroy();
	       /* else
	        {
	        	$err_code=1;// ERROR EN LOGOUT
	        	if($DEBUG_STATUS)
					echo 'ERROR EN LOGOUT<br>';
	        }*/
	        return $err_code;
		}

		public function doLogin($dbcon,$userEmail,$userPwd,$strUserDtlArr,$DEBUG_STATUS)
		{
			//session_start();
			mysqli_autocommit($dbcon,TRUE);
			$err_code=0;
			$sessionId = time().'_'.mt_rand();
			if($DEBUG_STATUS)
			{
				echo '$UserId retrieved::'.$strUserDtlArr[0].'<br>';
				//echo '$User Role retrieved::'.$strUserDtlArr[2].'<br>';
			}
			$sql = "UPDATE z_login SET L_LAST_LOGIN_DT=now(),L_IN_USE=0,L_SESSION_ID='$sessionId' WHERE 
				L_EMAIL='$userEmail' and L_PWD='$userPwd' and l_id=$strUserDtlArr[0] and l_is_eliminado_por_usuario=1";
			if($DEBUG_STATUS)
				echo '$sql-1::'.$sql.'<br>';
	        if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
	        {
	        	//mysqli_commit($dbcon);
	        	$err_code=0;
	        	if($DEBUG_STATUS)
					echo 'LOGIN SUCCESSFUL<br>';
				$_SESSION['userid']=$strUserDtlArr[0];
	            $_SESSION['userEmail']=$userEmail;
	            $_SESSION['userRole']=$strUserDtlArr[6];
	            $_SESSION['LAST_ACTIVITY'] = time();
				//session_destroy();
	        }
	        else
	        {
	        	$err_code=1;// ERROR EN LOGOUT
	        	if($DEBUG_STATUS)
					echo 'ERROR EN LOGIN<br>';
	        }
	        return $err_code;
		}

		public function getUserDtlFromEmail($dbcon,$userEmail,$DEBUG_STATUS)
		{
			$sql="select u_id,u_name, u_celular, u_conventional, u_cedula, u_licence_number,u_role 
					from z_users where u_emailid='$userEmail'";
			$usrDtl=array();
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result)) 
				{
					$usrDtl[0] = $row["u_id"];
					$usrDtl[1] = $row["u_name"];
					$usrDtl[2] = $row["u_celular"];
					$usrDtl[3] = $row["u_conventional"];
					$usrDtl[4] = $row["u_cedula"];
					$usrDtl[5] = $row["u_licence_number"];
					$usrDtl[6] = $row["u_role"];
				}
			}
			return $usrDtl;
		}

		public function getPerfil($dbcon,$userId,$DEBUG_STATUS)
		{
			$sql="select u.u_id,u.u_name,u.u_celular, u.u_conventional, u.u_cedula, u.u_licence_number,
			u.u_profile_pic,u.u_emailId from z_users u where u_id=".$userId;

			$usrDtl=array();
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result)) 
				{
					$usrDtl[0] = $row["u_id"];
					$usrDtl[1] = $row["u_name"];
					//$usrDtl[2] = $row["u_role"];
					$usrDtl[2] = $row["u_celular"];
					$usrDtl[3] = $row["u_conventional"];
					$usrDtl[4] = $row["u_cedula"];
					$usrDtl[5] = $row["u_licence_number"];
					$usrDtl[6] = $row["u_profile_pic"];
					$usrDtl[7] = $row["u_emailId"];
				}
			}
			return $usrDtl;
		}
		public function getDocuments($dbcon,$userId,$DEBUG_STATUS)
		{
			$sql="select d.d_id,c.d_desc,d.d_document_name,d.d_is_doc_verified,d.d_observacion from z_userdocs d, z_users u,z_docs c
					where u.u_id=d.d_user and c.d_id=d.d_document_type and u.u_id=".$userId."
					and d_document_type in(1,3)";

			//echo $sql;
			$docDtl=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$docDtl[$count] = array($row["d_id"],$row["d_desc"],$row["d_document_name"],$row["d_is_doc_verified"],$row["d_observacion"]);
					$count++;
				}
			}
			return $docDtl;
		}

		public function getVehicleDetails($dbcon,$userId,$DEBUG_STATUS)
		{
			$sql="select a_id,a_userid,a_marca,a_modelo,a_ano,a_capacidad,a_placa,a_nro_matricula,a_pic_automovil,
				(select d_document_name from z_userdocs where d_user=a_userid and d_document_type=4 and d_veh_id=a_id) a_pic_matriculation,
				(select d_id from z_userdocs where d_user=a_userid and d_document_type=4 and d_veh_id=a_id) a_docId,
				(select d_is_doc_verified from z_userdocs where d_user=a_userid and d_document_type=4 and d_veh_id=a_id) d_is_doc_verified,
				(select d_observacion from z_userdocs where d_user=a_userid and d_document_type=4 and d_veh_id=a_id) d_observacion,
				a_is_approved,a_observation 
				from z_automovil a,z_users u
				where a.a_userid=u.u_id and u.u_id=".$userId;

			$vehDtl=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$vehDtl[$count] = array($row["a_id"],
											$row["a_marca"],
											$row["a_modelo"],
											$row["a_ano"],
											$row["a_capacidad"],
											$row["a_placa"],
											$row["a_nro_matricula"],
											$row["a_pic_automovil"],
											$row["a_pic_matriculation"],
											$row["a_docId"],
											$row["d_is_doc_verified"],
											$row["a_is_approved"],
											$row["a_observation"],
											$row["d_observacion"]);
					$count++;
				}
			}
			return $vehDtl;
		}

		public function getVehicleDetailsById($dbcon,$userId,$aid,$DEBUG_STATUS)
		{
			if($aid==0)
			{
				$vehDtl=array();
				#$vehDtl[0] = array(0,'','',0,0,'','','','',0);
			}
			else
			{
				$sql="select a_id,a_userid,a_marca,a_modelo,a_ano,a_capacidad,a_placa,a_nro_matricula,a_pic_automovil,
					(select d_document_name from z_userdocs where d_user=a_userid and d_document_type=4 and d_veh_id=a_id) a_pic_matriculation,
					(select d_id from z_userdocs where d_user=a_userid and d_document_type=4 and d_veh_id=a_id) a_docId 
					from z_automovil a,z_users u
					where a.a_userid=u.u_id and u.u_id=".$userId." and a.a_id=".$aid;

				$vehDtl=array();
				$count=0;
				$result = mysqli_query($dbcon,$sql);
	            if(mysqli_num_rows($result) > 0)  
	            {
					while($row = mysqli_fetch_assoc($result)) 
					{
						$vehDtl[$count] = array($row["a_id"],$row["a_marca"],$row["a_modelo"],$row["a_ano"],$row["a_capacidad"],$row["a_placa"],$row["a_nro_matricula"],$row["a_pic_automovil"],$row["a_pic_matriculation"],$row["a_docId"]);
						$count++;
					}
				}				
			}
			return $vehDtl;
		}

		public function updateProfileDetails($dbcon,$userId,$username,$celular,$userConventional,$userCedula,$userLicence,$target_file,$DEBUG_STATUS)
		{
			$sql = "UPDATE z_users SET U_NAME='".$username."', U_CELULAR='".$celular."', 
    			U_CONVENTIONAL='".$userConventional."', U_CEDULA='".$userCedula."', 
    			U_MODIFIED_ON=now(),U_MODIFIED_BY=".$userId;
    		if(isset($target_file))
    			$sql=$sql.", U_PROFILE_PIC='".$target_file."'";
    		//if(isset($userLicence) and $_SESSION['userRole']==2)
    			$sql = $sql.",U_LICENCE_NUMBER='".$userLicence."'";
    		$sql = $sql." WHERE U_ID=".$userId;

    		if($DEBUG_STATUS)
	        	echo $sql;
	        if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus=0;
	        }
	        else
	        	$updStatus=1;

	        return $updStatus;
		}

		public function updateDocument($dbcon,$vehId,$userId,$docId,$docType,$target_file,$DEBUG_STATUS)
		{
			if($docId==0)
				$sql = "INSERT INTO z_userdocs(D_USER,D_DOCUMENT_TYPE,D_DOCUMENT_NAME,d_CREATED_ON,D_VEH_ID) 
						VALUES(".$userId.",".$docType.",'".$target_file."',NOW(),".$vehId.")";
			else
				$sql = "UPDATE z_userdocs SET D_USER=".$userId.", D_DOCUMENT_TYPE=".$docType.", 
    					D_MODIFIED_ON= now(), D_DOCUMENT_NAME='".$target_file."',d_is_doc_verified=9 where d_id=".$docId;  		

	        //echo $sql;
	        if(mysqli_query($dbcon,$sql))
	        {
	        	if($docType==4)
	        	{
	        		$updStatus = mysqli_insert_id($dbcon);
		        	//echo '`DOCUMENT ID::'.$updStatus.'<br>';
	        	}
	        	else
	        		$updStatus=0;
	        }
	        else
	        	$updStatus=1;

	        return $updStatus;
		}


		public function updateVehicleDetails($dbcon,$aid,$userId,$marca,$modelo,$ano,$capacidad,$placa,$matricula, $target_file,$DEBUG_STATUS)
		{
			$sql = "UPDATE z_automovil SET a_userid=".$userId.",a_marca='".$marca."',a_modelo='".$modelo."',
			a_ano=".$ano.",a_capacidad=".$capacidad.",a_placa='".$placa."',a_nro_matricula='".$matricula."',
			a_modified_on=now(),a_is_approved=9,A_MODIFIED_BY=".$userId;
    		if(isset($target_file))
    			$sql=$sql.", a_pic_automovil='".$target_file."'";
    		$sql = $sql." WHERE a_id=".$aid;

	        //echo $sql;
	        if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus=0;
	        }
	        else
	        	$updStatus=1;

	        return $updStatus;
		}

		public function insertVehicleDetails($dbcon,$userId,$marca,$modelo,$ano,$capacidad,$placa,$matricula, $target_file,$DEBUG_STATUS)
		{
			$sql = "INSERT INTO z_automovil(a_userid,a_marca,a_modelo,a_ano,a_capacidad,a_placa,a_nro_matricula,
				a_created_on,a_created_by,a_pic_automovil) 
			VALUES(".$userId.",'".$marca."','".$modelo."',
			".$ano.",".$capacidad.",'".$placa."','".$matricula."',
			now(),".$userId.", '".$target_file."')";
	        //echo $sql;
	        if(mysqli_query($dbcon,$sql))
	        {
	        	$updStatus = mysqli_insert_id($dbcon);
	        	//echo 'AUTOMOVIL ID::'.$updStatus.'<br>';
	        }
	        else
	        	$updStatus=0;

	        return $updStatus;
		}


		public function getDetallesVuelos($dbcon,$tipovuelo,$DEBUG_STATUS)
		{
			$vueloDtl=array();
			if($tipovuelo==1)
			{
	            $vueloDtl[0] = array(1,'TAME-755','QUITO','QUAYAQUIL','02/Nov/2016 15:40PM');
	            $vueloDtl[1] = array(2,'TAME-125','QUITO','LOJA','02/Nov/2016 16:05PM');
	            $vueloDtl[2] = array(3,'TAME-008','QUITO','CUENCA','02/Nov/2016 16:40PM');
				$vueloDtl[3] = array(4,'TAME-688','QUITO','GALAPAGOS','02/Nov/2016 17:15PM');
				$vueloDtl[4] = array(5,'TAME-956','QUITO','ESMERALDAS','02/Nov/2016 17:50PM');
			}
			if($tipovuelo==2)
			{
	            $vueloDtl[0] = array(1,'KLM-755','QUITO','AMSTERDAM','02/Nov/2016 15:30PM');
	            $vueloDtl[1] = array(2,'TAME-125','QUITO','BAGOTA','02/Nov/2016 15:55PM');
	            $vueloDtl[2] = array(3,'EMIRATES-008','QUITO','LIMA','02/Nov/2016 16:10PM');
				$vueloDtl[3] = array(4,'AI-688','QUITO','HYDERABAD','02/Nov/2016 16:45PM');
				$vueloDtl[4] = array(5,'BA-956','QUITO','NEW YORK','02/Nov/2016 17:30PM');
			}
			return $vueloDtl;
		}

		
		public function getDetallesViajesAAeropuerto($dbcon,$horavuelo,$sector,$nroasientes,$DEBUG_STATUS)
		{
			$viajeDtl=array();
			$sql="select v.v_id,
					(select CONCAT(a_marca,' ',a_modelo,'-',a_ano) from z_automovil a where a.a_id=v.v_automovil_id) v_automovil_id,
					a.a_placa,
					(select t.t_name from z_terminal t where t.t_id=v.v_desde) origen,
					(select t.t_name from z_terminal t where t.t_id=v.v_hasta) destino,
					DATE_FORMAT(v.v_fecha_salida,'%d-%b-%Y %H:%i:%s') v_fecha_salida,
					v_costo_viaje,
					v_acceptas_mascotas,
					v_acceptas_fumar,
					v_acceptas_alcohol 
					from z_viajes v,z_users u,z_automovil a
					where v.v_created_by=u.u_id and u.u_id=a.a_userid and v.v_desde=".$sector." and v.v_hasta=1 and 
					v.v_fecha_salida = DATE_FORMAT('".$horavuelo."','%Y-%m-%d %H:%i:%s') 					
					and v.v_estado in (0,1,2) and (v.v_min_pasajeros - v.v_ocupado)>=".$nroasientes." order by v.v_created_on,v_id desc";
					//and v.v_fecha_salida >= DATE_SUB(DATE_FORMAT('".$horavuelo."','%Y-%m-%d %H:%i:%s'),INTERVAL 5 HOUR)

			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result)) 
				{
					$viajeDtl[$count] = array($row["v_id"],$row["v_automovil_id"],$row["a_placa"],$row["origen"],$row["destino"],$row["v_fecha_salida"],$row["v_costo_viaje"]);
					$count++;
				}
			}

			
			return $viajeDtl;
		}

		public function getDetallesViajesDesdeAeropuerto($dbcon,$horavuelo,$sector,$nroasientes,$DEBUG_STATUS)
		{
			$viajeDtl=array();
			$sql="select v.v_id,
						(select CONCAT(a_marca,' ',a_modelo,'-',a_ano) from z_automovil a where a.a_id=v.v_automovil_id) v_automovil_id,
						a.a_placa,
						(select t.t_name from z_terminal t where t.t_id=v.v_desde) origen,
						(select t.t_name from z_terminal t where t.t_id=v.v_hasta) destino,
						DATE_FORMAT(v.v_fecha_salida,'%d-%b-%Y %H:%i:%s') v_fecha_salida,
						v_costo_viaje,
						v_acceptas_mascotas,
						v_acceptas_fumar,
						v_acceptas_alcohol 
						from z_viajes v,z_users u,z_automovil a
					where v.v_created_by=u.u_id and u.u_id=a.a_userid and v.v_desde=".$sector." and 
					v.v_fecha_salida = DATE_FORMAT('".$horavuelo."','%Y-%m-%d %H:%i:%s') 					
					and v.v_estado in(0,1,2) and (v.v_min_pasajeros - v.v_ocupado)>=".$nroasientes." order by v.v_created_on,v_id desc";

			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result)) 
				{
					$viajeDtl[$count] = array($row["v_id"],$row["v_automovil_id"],$row["a_placa"],$row["origen"],$row["destino"],$row["v_fecha_salida"],$row["v_costo_viaje"],$nroasientes);
					$count++;
				}
			}

			
			return $viajeDtl;
		}


		public function getDetallesViajesNacional($dbcon,$ciudad_origen,$ciudad_destino,$horavuelo,$sector,$destino,$nroasientes,$mascotas,$fumar,$alcohol,$DEBUG_STATUS)
		{
			$viajeDtl=array();

			$sql="select v.v_id,
						(select CONCAT(a_marca,' ',a_modelo,'-',a_ano) from z_automovil a where a.a_id=v.v_automovil_id) v_automovil_id,
						a.a_placa,
						(select t.t_name from z_terminal t where t.t_id=v.v_desde) origen,
						(select t.t_name from z_terminal t where t.t_id=v.v_hasta) destino,
						DATE_FORMAT(v.v_fecha_salida,'%d-%b-%Y %H:%i:%s') v_fecha_salida,
						v_costo_viaje,
						v_acceptas_mascotas,
						v_acceptas_fumar,
						v_acceptas_alcohol,
						v_paradas_comer,
						v_diligencias,
						v_mercancias 
						from z_viajes v,z_users u,z_automovil a,z_terminal t1,z_terminal t2 						
					where v.v_created_by=u.u_id and u.u_id=a.a_userid and 
					t1.t_id_ciudad=".$ciudad_origen." and t2.t_id_ciudad=".$ciudad_destino." and 
					t1.t_id=v.v_desde and t2.t_id=v.v_hasta and 
					v.v_fecha_salida <= DATE_ADD(DATE_FORMAT('".$horavuelo."','%Y-%m-%d %H:%i:%s'),INTERVAL 5 HOUR) 
					and v.v_fecha_salida >= DATE_SUB(DATE_FORMAT('".$horavuelo."','%Y-%m-%d %H:%i:%s'),INTERVAL 5 HOUR)
					and v.v_estado in (1,2) and v.v_acceptas_mascotas>=".$mascotas." and v.v_acceptas_fumar>=".$fumar." and v.v_acceptas_alcohol>=".$alcohol." 
					and (v.v_min_pasajeros - v.v_ocupado)>=".$nroasientes." order by v_costo_viaje asc";

			$count=0;
			//echo $sql.'<br>';
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$viajeDtl[$count] = array($row["v_id"],$row["v_automovil_id"],$row["a_placa"],$row["origen"],$row["destino"],$row["v_fecha_salida"],$row["v_costo_viaje"],$nroasientes,$row["v_acceptas_mascotas"],$row["v_acceptas_fumar"],$row["v_acceptas_alcohol"],$row["v_paradas_comer"],$row["v_diligencias"],$row["v_mercancias"]);
					$count++;
				}
			}

			
			return $viajeDtl;
		}

		public function getDetallesViajesById($dbcon,$idviaje,$cantpass,$DEBUG_STATUS)
		{
			$viajeDtl=array();


			$sql="select v.v_id,a.a_placa,(select t.t_name from z_terminal t where t.t_id=v.v_desde) origen,
					(select t.t_name from z_terminal t where t.t_id=v.v_hasta) destino,
					DATE_FORMAT(v.v_fecha_salida,'%d-%b-%Y %H:%i:%s') v_fecha_salida,v_costo_viaje,
					v_acceptas_mascotas,v_acceptas_fumar,v_acceptas_alcohol from z_viajes v,z_users u,z_automovil a
					where v.v_created_by=u.u_id and u.u_id=a.a_userid and v.v_id=".$idviaje;

			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$viajeDtl[$count] = array($row["v_id"],$row["a_placa"],$row["origen"],$row["destino"],$row["v_fecha_salida"],$row["v_costo_viaje"],$cantpass,$row["v_acceptas_mascotas"],$row["v_acceptas_fumar"],$row["v_acceptas_alcohol"]);
					$count++;
				}
			}

			
			return $viajeDtl;
		}

		
		public function reservarViaje($dbcon,$codigo_viaje,$idviaje,$target_dir,$tipoPago,$direccion,$cantpass,$userid,$eligoretorno,$costo_uio_aero,$costo_aero_uio,$DEBUG_STATUS)
		{
			//echo $idviaje.'-'.$direccion.'-'.$cantpass.'-'.$userid;
			
			//$codigo_viaje=0;
			$counterviajeDtl=0;
			$viajeDtl='';
			/*$sql="select v_codigo_viaje from z_viajes v where v.v_id=".$idviaje;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result)) 
				{
					$codigo_viaje=$row["v_codigo_viaje"];
				}
			}*/
			//$codigo_viaje=mt_rand();

			$sql="select v_id from z_viajes v where v.v_id!=".$idviaje." 
			and v.v_fecha_salida=DATE_ADD(DATE_FORMAT((select v_fecha_salida from z_viajes v where v.v_id=".$idviaje."),'%Y-%m-%d %H:%i:%s'),INTERVAL 60 MINUTE)";
			$v_retorno_id=0;
			
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result)) 
				{
					$v_retorno_id=$row["v_id"];
				}
			}


			$sql="select v2.v_id from z_viajes v2 where 
				(v2.v_fecha_salida<DATE_ADD((select v_fecha_salida from z_viajes v where v.v_id=".$idviaje."),INTERVAL 150 MINUTE) 
					and v2.v_fecha_salida>DATE_SUB((select v_fecha_salida from z_viajes v where v.v_id=".$idviaje."),INTERVAL 150 MINUTE)) 
				and v2.v_estado =0 and v2.v_created_by=(select v.v_created_by from z_viajes v where v.v_id=".$idviaje.") 
				and v2.v_id not in (".$idviaje.",".$v_retorno_id.")";

			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$viajeDtl = $viajeDtl.$row["v_id"].",";
					$counterviajeDtl++;
				}
				$viajeDtl=$viajeDtl."0";
			}


			//echo '<br>'.$codigo_viaje;

			mysqli_autocommit($dbcon,FALSE);
			$target_file = $target_dir .'PagoPic-'.$codigo_viaje.'-'.$userid.'.jpg';
			$sql="insert into z_viajespasajero(vp_viaje_id,vp_codigo_viaje,vp_pass_id, vp_fecha_aceptacion,vp_fecha_pago, vp_direccion,vp_pic_pago,vp_tipo_pago,vp_estado_viaje) 
			 		values(".$idviaje.",'".$codigo_viaje."',".$userid.",now(),now(),'".$direccion."','".$target_file."',".$tipoPago.",2)";
			if($DEBUG_STATUS)
				echo '$sql::'.$sql.'<br>';
			$ctr=0;
			for($x=0;$x<$cantpass;$x++)
			{
				if(mysqli_query($dbcon,$sql))
	            {
	            	$ctr++;
	            }
			}
			//echo '<br>CTR:'.$ctr;
			$cantretorno = 0;
			if(isset($eligoretorno) && $eligoretorno==1)
				$cantretorno = 1; //replace 1 with variable cantpass if return to be aplicable for all users in same ticket

			//by default vp_estado_viaje will be 0 and vp_viaje_id is set to default conductor through which he actually went to airport.
			//vp_fecha_aceptacion, vp_viaje_id should be updated once any user reserve this return journey.
			//vp_estado_viaje should changed to programmed once any user reserve this return journey
			//vp_estado_viaje should changed to terminated once journey completed by passenger
			$sql="insert into z_viajespasajero(vp_viaje_id,vp_codigo_viaje,vp_pass_id, vp_fecha_pago, vp_direccion,vp_pic_pago,vp_tipo_pago) 
			 		values(".$v_retorno_id.",".$codigo_viaje.",".$userid.",now(),'QUITO AEROPUERTO','".$target_file."',".$tipoPago.")";
			if($DEBUG_STATUS)
				echo '$sql::'.$sql.'<br>';
			$ctr_retorno=0;
			for($x=0;$x<$cantretorno;$x++)
			{
				if(mysqli_query($dbcon,$sql))
	            {
	            	$ctr_retorno++;
	            }
			}

			/*$sql="update z_viajes set v_estado=2,v_codigo_viaje='".$codigo_viaje."',v_costo_viaje=".$costo_uio_aero.",v_ocupado=v_ocupado+".$cantpass.", 
			v_cant_pagado_retorno=".$cantretorno.",	v_cant_retorno_servido=0 where v_id=".$idviaje;*/
			$sql="update z_viajes set v_estado=2,v_costo_viaje=".$costo_uio_aero.",v_ocupado=v_ocupado+".$cantpass.", 
			v_cant_pagado_retorno=".$cantretorno.",	v_cant_retorno_servido=0 where v_id=".$idviaje;
            if($ctr==$cantpass && $ctr_retorno==$cantretorno)
            {
            	if(mysqli_query($dbcon,$sql))
	            {
	            	/*$sql="update z_viajes set v_estado=1,v_codigo_viaje='".$codigo_viaje."',v_desde=1,v_hasta=6,v_costo_viaje=".$costo_aero_uio.",
	            	v_ocupado=0, v_cant_pagado_retorno=".$cantretorno.",
					v_cant_retorno_servido=0 where v_id=".$v_retorno_id;*/
					$sql="update z_viajes set v_estado=1,v_desde=1,v_hasta=6,v_costo_viaje=".$costo_aero_uio.",
	            	v_ocupado=0, v_cant_pagado_retorno=".$cantretorno.",
					v_cant_retorno_servido=0 where v_id=".$v_retorno_id;
	            	if(mysqli_query($dbcon,$sql))
	            	{
	            		if($counterviajeDtl>0)
	            		{
	            			$sql="update z_viajes v3 set v3.v_estado=99 where v3.v_id in(".$viajeDtl.")";
			            	if(mysqli_query($dbcon,$sql))
			            	{
				            	mysqli_commit($dbcon);
				            	//echo '<br>OK';
			            		return $idviaje.':'.$codigo_viaje;
			            	}
			            	else
			            	{
			            		mysqli_rollback($dbcon);
		            			return '0:'.$codigo_viaje;
			            	}
	            		}
	            		else
	            		{
	            			mysqli_commit($dbcon);
			            	//echo '<br>OK';
		            		return $idviaje.':'.$codigo_viaje;
	            		}
	            		
	            	}
	            	else
	            	{
	            		mysqli_rollback($dbcon);
            			return '0:'.$codigo_viaje;
	            	}
            	}
            	else
            	{
            		//echo '<br>UPDATE ERR';
            		mysqli_rollback($dbcon);
            		return '0:'.$codigo_viaje;
            	}
            }
            else
            {
            	//echo '<br>INSERT ERR';
            	mysqli_rollback($dbcon);
            	return '0:'.$codigo_viaje;
            }
		}


		public function preReservarViaje($dbcon,$origenViaje,$horaViaje,$target_dir,$tipoPago,$direccion,$cantpass,$userid,$eligoretorno,$costo_uio_aero,$costo_aero_uio,$DEBUG_STATUS)
		{
			$codigo_viaje=mt_rand();
			$status=0;
			
			$target_file = $target_dir .'PagoPic-'.$codigo_viaje.'-'.$userid.'.jpg';
			$sql="insert into z_viajes_solicitado(vs_desde, vs_hasta, vs_fecha_viaje, vs_cant_pasajeros, vs_plan_retorno, vs_codigo_pago,vs_created_by, vs_created_on,vs_estado_solicitud,vs_tipo_pago,vs_costo_viaje) 
			 		values(".$origenViaje.",1,DATE_FORMAT('".$horaViaje."','%Y-%m-%d %H:%i:%s'),".$cantpass.",".$eligoretorno.",".$codigo_viaje.",".$userid.",now(),0,".$tipoPago.",".$costo_uio_aero.")";
			if($DEBUG_STATUS)
				echo '$sql::'.$sql.'<br>';
			if(mysqli_query($dbcon,$sql))
            {
            	$status = mysqli_insert_id($dbcon);
            }

            return ($status.":".$codigo_viaje);
		}


		public function reservarViajeNacional($dbcon,$idviaje,$target_dir,$tipoPago,$direccion,$cantpass,$userid,$costo,$DEBUG_STATUS)
		{
			$codigo_viaje=0;
			$counterviajeDtl=0;
			$viajeDtl='';
			$codigo_viaje=mt_rand();

			mysqli_autocommit($dbcon,FALSE);
			$target_file = $target_dir .'PagoPic-'.$codigo_viaje.'-'.$userid.'.jpg';
			$sql="insert into z_viajespasajero(vp_viaje_id,vp_codigo_viaje,vp_pass_id, vp_fecha_aceptacion,vp_fecha_pago, vp_direccion,vp_pic_pago,vp_tipo_pago,vp_estado_viaje) 
			 		values(".$idviaje.",'".$codigo_viaje."',".$userid.",now(),now(),'".$direccion."','".$target_file."',".$tipoPago.",2)";
			if($DEBUG_STATUS)
				echo '<br><br><br>'.'$sql::'.$sql.'<br>';
			$ctr=0;
			for($x=0;$x<$cantpass;$x++)
			{
				if(mysqli_query($dbcon,$sql))
	            {
	            	$ctr++;
	            }
			}
			$sql="update z_viajes set v_estado=2,v_ocupado=v_ocupado+".$cantpass.", 
			v_cant_pagado_retorno=0,	v_cant_retorno_servido=0 where v_id=".$idviaje;
			//echo '$sql::'.$sql.'<br>';
            if($ctr==$cantpass)
            {
            	if(mysqli_query($dbcon,$sql))
            	{
            		mysqli_commit($dbcon);
	            	return $idviaje;	
            	}
            	else
            	{
            		mysqli_rollback($dbcon);
            		return 0;
            	}
            	
            }
            else
            {
            	//echo '<br>INSERT ERR';
            	mysqli_rollback($dbcon);
            	return 0;
            }
		}

		public function reservarViajeDesdeAeropuerto($dbcon,$idviajenew,$cantpass,$codigo_viaje,$userid,$DEBUG_STATUS)
		{
			mysqli_autocommit($dbcon,FALSE);
			//by default vp_estado_viaje will be 0 and vp_viaje_id is set to default conductor through which he actually went to airport.
			//vp_fecha_aceptacion, vp_viaje_id should be updated once any user reserve this return journey.
			//vp_estado_viaje should changed to programmed once any user reserve this return journey
			//vp_estado_viaje should changed to terminated once journey completed by passenger
			$codigo_viaje_para_reservar=0;
			$sql="select v_codigo_viaje from z_viajes where v_id=".$idviajenew;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result)) 
				{
					$codigo_viaje_para_reservar=$row["v_codigo_viaje"];
				}
			}
			//echo $codigo_viaje_para_reservar.'<br>';

			$sql="update z_viajespasajero set vp_viaje_id=".$idviajenew.",vp_fecha_aceptacion=now(),vp_estado_viaje=2 
			 		where vp_codigo_viaje='".$codigo_viaje."' and vp_pass_id=".$userid." and vp_estado_viaje =0";
			if($DEBUG_STATUS)
				echo '$sql::'.$sql.'<br>';
			$ctr=0;
			for($x=0;$x<$cantpass;$x++)
			{
				if(mysqli_query($dbcon,$sql))
	            {
	            	$ctr++;
	            }
			}
			//echo $ctr.'<br>';
			
			

			$sql="update z_viajes set v_estado=2,v_ocupado=v_ocupado+".$cantpass." where v_id=".$idviajenew;
            if($ctr==$cantpass)
            {
            	if(mysqli_query($dbcon,$sql))
	            {
	            	mysqli_commit($dbcon);
	            	//echo 'OK<br>';
            		return $idviajenew;
            	}
            	else
            	{
            		//echo 'UPD ERR<br>';
            		mysqli_rollback($dbcon);
            		return 0;
            	}
            }
            else
            {
            	//echo 'CTR ERR<br>';
            	mysqli_rollback($dbcon);
            	return 0;
            }
		}


		/*public function publicarViaje($dbcon,$userId,$desde,$hasta,$fechaviaje,$nroequipaje,$nroasientes,$costoviaje,$automovilId,$DEBUG_STATUS)
		{
			$codigo_viaje=mt_rand();
			mysqli_autocommit($dbcon,FALSE);
			$sql="INSERT INTO z_viajes(V_CODIGO_VIAJE,V_AUTOMOVIL_ID,V_DESDE,V_HASTA,V_FECHA_SALIDA,V_MIN_PASAJEROS,V_EQUIPAJE_PASAJERO,V_COSTO_VIAJE,V_ACCEPTAS_MASCOTAS,V_ACCEPTAS_FUMAR,V_ACCEPTAS_ALCOHOL,V_CREATED_ON,V_CREATED_BY) 
					VALUES('".$codigo_viaje."',".$automovilId.",".$desde.",".$hasta.",DATE_FORMAT('".$fechaviaje."','%Y-%m-%d %H:%i:%s'),".$nroasientes.",".$nroequipaje.",".$costoviaje.",".$mascotas.",".$fumar.",".$alcohol.",now(),".$userId.")";
			if($DEBUG_STATUS)
				echo '$sql::'.$sql.'<br>';
            if(mysqli_query($dbcon,$sql))
            {
            	$sql="INSERT INTO z_viajes(V_CODIGO_VIAJE,V_AUTOMOVIL_ID,V_DESDE,V_HASTA,V_FECHA_SALIDA,V_MIN_PASAJEROS,V_EQUIPAJE_PASAJERO,V_COSTO_VIAJE,V_ACCEPTAS_MASCOTAS,V_ACCEPTAS_FUMAR,V_ACCEPTAS_ALCOHOL,V_CREATED_ON,V_CREATED_BY) 
					VALUES('".$codigo_viaje."',".$automovilId.",".$hasta.",".$desde.",DATE_ADD(DATE_FORMAT('".$fechaviaje."','%Y-%m-%d %H:%i:%s'),INTERVAL 1 HOUR),1,1,4,".$mascotas.",".$fumar.",".$alcohol.",now(),".$userId.")";
            	if(mysqli_query($dbcon,$sql))
            	{
            		mysqli_commit($dbcon);
            		return $codigo_viaje;
            	}
            	else
            	{
            		mysqli_rollback($dbcon);
            		return 0;
            	}
            }
            else
            {
            	mysqli_rollback($dbcon);
            	return 0;
            }
		}*/
		public function publicarViaje($dbcon,$userId,$duraciondisponible,$desde,$hasta,$fechaviaje,$nroequipaje,$nroasientes,$automovilId,$DEBUG_STATUS)
		{
			//$codigo_viaje=mt_rand();
			mysqli_autocommit($dbcon,FALSE);
			if($duraciondisponible>150)
				$duraciondisponibleNew=$duraciondisponible;
			else
				$duraciondisponibleNew=150;
			//echo 'fechaviaje::'.$fechaviaje.'<br>';
			//echo 'duraciondisponible::'.$duraciondisponible.'<br>';
			$sql="select v2.v_id from z_viajes v2 where 
				(v2.v_fecha_salida<=DATE_ADD(date_format('".$fechaviaje."','%y-%m-%d %H:%i:%s'),INTERVAL ".$duraciondisponible." MINUTE) 
					and v2.v_fecha_salida>=DATE_SUB(date_format('".$fechaviaje."','%y-%m-%d %H:%i:%s'),INTERVAL ".$duraciondisponibleNew." MINUTE)) 
				and v2.v_estado in(1,2,3,4,5,6,7) and v2.v_created_by=".$userId."
				and v2.v_hasta=1";
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				return 98;//trip planned to airport in the new calender requested.
			}
			else
			{
				$sql="select v2.v_id from z_viajes v2 where 
				(v2.v_fecha_salida<DATE_ADD(date_format('".$fechaviaje."','%y-%m-%d %H:%i:%s'),INTERVAL 90 MINUTE) 
					and v2.v_fecha_salida>DATE_SUB(date_format('".$fechaviaje."','%y-%m-%d %H:%i:%s'),INTERVAL 90 MINUTE)) 
				and v2.v_estado in(1,2,3,4,5,6,7) and v2.v_created_by=".$userId."
				and v2.v_desde=1";
				$result = mysqli_query($dbcon,$sql);
	            if(mysqli_num_rows($result) > 0)  
	            {
	            	return 99;//trip planned from airport in the new calender requested.
	            }
	            else
	            {
	            	$planificacion=30;
					$cantidadFranjasNormal=$duraciondisponible/$planificacion;
					$cantidadFranjasRetornosExtras=2;
					$ctr=0;
					for($x=0;$x<($cantidadFranjasNormal+$cantidadFranjasRetornosExtras);$x++)
					{
						if($x<$cantidadFranjasNormal)
							$estado=0;
						else
							$estado=99;
						$sql="INSERT INTO z_viajes(V_ESTADO,V_DESDE,V_HASTA,V_AUTOMOVIL_ID,V_FECHA_SALIDA,V_MIN_PASAJEROS,V_EQUIPAJE_PASAJERO,V_CREATED_ON,V_CREATED_BY) 
							VALUES(".$estado.",".$desde.",".$hasta.",".$automovilId.",DATE_ADD(DATE_FORMAT('".$fechaviaje."','%Y-%m-%d %H:%i:%s'),INTERVAL ".($planificacion*$x)." MINUTE),".$nroasientes.",".$nroequipaje.",now(),".$userId.")";
						//if($DEBUG_STATUS)
							//echo '$sql::'.$sql.'<br>';
			            if(mysqli_query($dbcon,$sql))
			            {
			            	$ctr++;
			            }	            
			        }
			        if($ctr==$x)
			        {
			        	mysqli_commit($dbcon);
			        	return 1;
			        }
			        else
		            {
		            	mysqli_rollback($dbcon);
		            	return 0;
		            }
	            }
			}



				        
		}

		public function publicarViajeNacional($dbcon,$userId,$desde,$hasta,$fechaviaje,$nroequipaje,$nroasientes,$costoviaje,$mascotas,$fumar,$alcohol,$automovilId,$paradascomer,$diligencias,$mercancias,$DEBUG_STATUS)
		{
			$codigo_viaje=mt_rand();
			mysqli_autocommit($dbcon,FALSE);
			$sql="INSERT INTO z_viajes(V_CODIGO_VIAJE,V_AUTOMOVIL_ID,V_DESDE,V_HASTA,V_FECHA_SALIDA,V_MIN_PASAJEROS,V_EQUIPAJE_PASAJERO,V_COSTO_VIAJE,V_ACCEPTAS_MASCOTAS,V_ACCEPTAS_FUMAR,V_ACCEPTAS_ALCOHOL,V_PARADAS_COMER,V_DILIGENCIAS,V_MERCANCIAS,V_CREATED_ON,V_CREATED_BY) 
					VALUES('".$codigo_viaje."',".$automovilId.",".$desde.",".$hasta.",DATE_FORMAT('".$fechaviaje."','%Y-%m-%d %H:%i:%s'),".$nroasientes.",".$nroequipaje.",".$costoviaje.",".$mascotas.",".$fumar.",".$alcohol.",".$paradascomer.",".$diligencias.",".$mercancias.",now(),".$userId.")";
			if($DEBUG_STATUS)
				echo '$sql::'.$sql.'<br>';
            if(mysqli_query($dbcon,$sql))
        	{
        		mysqli_commit($dbcon);
        		return 1;
        	}
        	else
        	{
        		mysqli_rollback($dbcon);
        		return 0;
        	}
		}


		public function isUserPerfilCompleted($dbcon,$filtro,$userEmail,$userRole,$DEBUG_STATUS)
		{
			$is_verified=99;
			if($filtro>=0)
			{
				
				$sql="select * from z_users where u_emailid='$userEmail' and u_is_email_verified=0";
				$result = mysqli_query($dbcon,$sql);
	            if(mysqli_num_rows($result) > 0)  
	            {
					$is_verified=0;
				}
				else
				{
					$is_verified=2;	// email no verificado
					return $is_verified;
				}

				$sql="select * from z_users where u_emailid='$userEmail' and ((u_celular is not null and u_celular!='') or (u_conventional is not null and u_conventional!=''))";
				
				$result = mysqli_query($dbcon,$sql);
	            if(mysqli_num_rows($result) > 0)  
	            {
					$is_verified=0;
				}
				else
				{
					$is_verified=1;	// contacto no desponible
					return $is_verified;
				}			

				

				$sql="select * from z_users u,z_userdocs ud where u.u_emailId='$userEmail' and u.u_id=ud.d_user and ud.d_document_type=1 and ud.d_document_name is not null and ud.d_is_doc_verified=0";
				$result = mysqli_query($dbcon,$sql);
	            if(mysqli_num_rows($result) > 0)  
	            {
					$is_verified=0;
				}
				else
				{
					$is_verified=3;	// cedula no desponible
					return $is_verified;
				}
			}

			if($filtro>=1)
			{
				$sql="select * from z_users u,z_userdocs ud where u.u_emailId='$userEmail' and u.u_id=ud.d_user and ud.d_document_type=3 and ud.d_document_name is not null and ud.d_is_doc_verified=0";
				$result = mysqli_query($dbcon,$sql);
	            if(mysqli_num_rows($result) > 0)  
	            {
					$is_verified=0;
				}
				else
				{
					$is_verified=4;	// licencia no desponible
					return $is_verified;
				}

						
				/*$sql="select a_is_approved,a_docId,a_pic_automovil,a_pic_matriculation from (select a_is_approved,a_pic_automovil,
				(select d_document_name from z_userdocs where d_user=a_userid and d_document_type=4 and d_veh_id=a_id) a_pic_matriculation,
				(select d_id from z_userdocs where d_user=a_userid and d_document_type=4 and d_veh_id=a_id and d_is_doc_verified=0) a_docId 
				from z_automovil a,z_users u
				where a.a_userid=u.u_id and u.u_emailId='".$userEmail."') a
				where ((a_pic_automovil is not null and a_pic_automovil!='') and (a_pic_matriculation is not null and a_pic_matriculation!=''))	and a_is_approved=0 and 	a_docId>0";
				$result = mysqli_query($dbcon,$sql);
				
	            if(mysqli_num_rows($result) > 0)  
	            {
					$is_verified=6;	// Detalles de automovil o matricula no desponible
					return $is_verified;
					
				}
				else
				{
					$is_verified=6;	// Detalles de automovil o matricula no desponible
					
				}

				$sql="select a_id,a_is_approved,a_docId,a_pic_automovil,a_pic_matriculation from (select a_id,a_is_approved,a_pic_automovil,
				(select d_document_name from z_userdocs where d_user=a_userid and d_document_type=4 and d_veh_id=a_id) a_pic_matriculation,
				(select d_id from z_userdocs where d_user=a_userid and d_document_type=4 and d_veh_id=a_id and d_is_doc_verified=1) a_docId 
				from z_automovil a,z_users u
				where a.a_userid=u.u_id and u.u_emailId='".$userEmail."') a
				where ((a_pic_automovil is not null and a_pic_automovil!='') and (a_pic_matriculation is not null and a_pic_matriculation!=''))	and a_is_approved=1 and 	a_docId>0";
				$result = mysqli_query($dbcon,$sql);
				
	            if(mysqli_num_rows($result) > 0)  
	            {
					$is_verified=0;	// Detalles de automovil o matricula son aprobado
					
				}
				else
				{
					$is_verified=5;	// Detalles de automovil o matricula no aprobados
					return $is_verified;
				}*/

				$sql="select a_id,a_is_approved,d_is_doc_verified,a_pic_automovil,a_pic_matriculation from 
						(select a_id,a_is_approved,a_pic_automovil,
						(select d_document_name from z_userdocs where d_user=a_userid and d_document_type=4 and d_veh_id=a_id) a_pic_matriculation,
						(select d_is_doc_verified from z_userdocs where d_user=a_userid and d_document_type=4 and d_veh_id=a_id) d_is_doc_verified 
						from z_automovil a,z_users u
						where a.a_userid=u.u_id and u.u_emailId='".$userEmail."') a";
				
				
				$result = mysqli_query($dbcon,$sql);
	            if(mysqli_num_rows($result) > 0)  
	            {
					if($row = mysqli_fetch_assoc($result)) 
					{
						$veh_id = $row["a_id"];
						$is_veh_approved=$row["a_is_approved"];
						$is_matricula_approved=$row["d_is_doc_verified"];
						$path_veh_pic = $row["a_pic_automovil"];
						$path_matricula_pic = $row["a_pic_matriculation"];

						//0:APROBADO,1:RECHAZADA;9:PENDIENTE
						if($is_veh_approved==1 && $is_matricula_approved==1)
						{
							$is_verified=50;
							return $is_verified;
						}
						else if($is_veh_approved==1 && $is_matricula_approved==0)
						{
							$is_verified=51;
							return $is_verified;
						}
						else if($is_veh_approved==0 && $is_matricula_approved==9)
						{
							$is_verified=52;
							return $is_verified;
						}
						else if($is_veh_approved==0 && $is_matricula_approved==1)
						{
							$is_verified=53;
							return $is_verified;
						}
						else if($is_veh_approved==0 && $is_matricula_approved==0)
						{
							$is_verified=54;
							return $is_verified;
						}
						else if($is_veh_approved==0 && $is_matricula_approved==9)
						{
							$is_verified=55;
							return $is_verified;
						}
						else if($is_veh_approved==9 && $is_matricula_approved==1)
						{
							$is_verified=56;
							return $is_verified;
						}
						else if($is_veh_approved==9 && $is_matricula_approved==0)
						{
							$is_verified=57;
							return $is_verified;
						}
						else if($is_veh_approved==9 && $is_matricula_approved==9)
						{
							$is_verified=58;
							return $is_verified;
						}						
					}
				}
				else
				{
					$is_verified=-1;
					return $is_verified;
				}



			}


			return $is_verified;
		}

		public function getCiudad($dbcon,$cuidad,$DEBUG_STATUS)
		{
			$sql="select c_id,c_name from z_ciudad where c_estado=0 order by c_id ";
			$ciudad=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$ciudad[$count] = array($row["c_id"],$row["c_name"]);
					$count++;
				}
			}
			return $ciudad;

		}


		public function getSectors($dbcon,$cuidad,$DEBUG_STATUS)
		{
			$sql="select distinct s.id,s.sector_name from z_terminal t, z_sector s where t.t_sector=s.id and t.t_estado=0 
					and t.t_id_ciudad=$cuidad and t.t_id >1 order by s.sector_name asc";
			$terminal=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$terminal[$count] = array($row["id"],$row["sector_name"]);
					$count++;
				}
			}
			return $terminal;

		}

		public function getSectorDesc($dbcon,$sector_id,$DEBUG_STATUS)
		{
			$sql="select s.sector_name from z_sector s where s.id=$sector_id";
			$result = mysqli_query($dbcon,$sql);
			$sector_name='';
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result)) 
				{
					$sector_name = $row["sector_name"];
				}
			}
			return $sector_name;

		}

		public function getTerminals($dbcon,$cuidad,$DEBUG_STATUS)
		{
			$sql="select t_id,t_name,longitud,latitud from z_terminal where t_estado=0 and t_id_ciudad=$cuidad and t_id >1 order by t_name ";
			$terminal=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$terminal[$count] = array($row["t_id"],$row["t_name"],$row["longitud"],$row["latitud"]);
					$count++;
				}
			}
			return $terminal;

		}

		public function getTerminalMapDtl($dbcon,$terminalId,$DEBUG_STATUS)
		{
			$sql="select longitud,latitud from z_terminal where t_id=".$terminalId;
			$terminal="";
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result)) 
				{
					$terminal=$row["longitud"].','.$row["latitud"];
				}
			}
			return $terminal;

		}



		public function misreservas($dbcon,$userId,$DEBUG_STATUS)
		{
			/*$sql="select vp_viaje_id,s1.sector_name desde,s2.sector_name hasta,vp.vp_fecha_salida, vp.vp_estado_viaje codigo_estado,
					(select p_desc from z_parametros where p_id=vp.vp_estado_viaje) vp_estado_viaje,vp.vp_valor_total_pago,vp.vp_tipo_pago,vp.vp_fecha_acceptation,
					(case when vp.vp_fecha_salida<now() then 1 else 0 end) open_terminate,
					(case when vp.vp_sector_inicio=1 then 1 else 0 end) return_journey,
						(case when vp_codigo_pago>0 then vp_codigo_pago else substr(vp_codigo_pago,5) end) vp_codigo_pago 
					from z_viajespasajero vp, z_sector s1,z_sector s2
					where vp.vp_sector_inicio=s1.id and vp.vp_sector_destino=s2.id and vp.vp_comprado_por=".$userId." order by vp.vp_fecha_salida desc";*/

			$sql="select vp_viaje_id,s1.sector_name desde,s2.sector_name hasta,vp.vp_fecha_salida, vp.vp_estado_viaje codigo_estado,
					(select p_desc from z_parametros where p_id=vp.vp_estado_viaje) vp_estado_viaje,
					(case when vp.vp_sector_inicio>1 then (select sum(vp1.vp_valor_total_pago) from z_viajespasajero vp1 where 
					vp1.vp_codigo_pago=vp.vp_codigo_pago) else 0 end) vp_valor_total_pago,
					vp.vp_tipo_pago,vp.vp_fecha_acceptation,
					(case when vp.vp_fecha_salida<now() then 1 else 0 end) open_terminate,
					(case when vp.vp_sector_inicio=1 then 1 else 0 end) return_journey,
					vp_codigo_pago,
					vp_id,
					vp_pago_verificado,vp_observacion   
					from z_viajespasajero vp, z_sector s1,z_sector s2
					where vp.vp_sector_inicio=s1.id and vp.vp_sector_destino=s2.id and vp.vp_comprado_por=".$userId." order by vp.vp_fecha_salida desc";
			$misreservas=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$misreservas[$count] = array(	$row["vp_viaje_id"],
													$row["desde"],
													$row["hasta"],
													$row["vp_fecha_salida"],
													$row["vp_estado_viaje"],
													$row["vp_valor_total_pago"],
													$row["vp_tipo_pago"],
													$row["vp_fecha_acceptation"],
													$row["vp_codigo_pago"],
													$row["open_terminate"],
													$row["codigo_estado"],
													$row["return_journey"],
													$row["vp_id"],
													$row["vp_pago_verificado"],
													$row["vp_observacion"]);
					$count++;
				}
			}
			return $misreservas;
		}

		public function viajesAeropuertoPendienteAsignar($dbcon,$hora_viaje,$from_airport,$DEBUG_STATUS)
		{
			if($from_airport==1)
				$sql="select vp_id,s1.sector_name desde,s2.sector_name hasta,vp.vp_fecha_salida, vp.vp_estado_viaje codigo_estado,vp.vp_nro_pasajeros,
					(select p_desc from z_parametros where p_id=vp.vp_estado_viaje) vp_estado_viaje,vp.vp_valor_total_pago,vp.vp_tipo_pago,vp.vp_fecha_acceptation,
					(case when vp.vp_fecha_salida<now() then 1 else 0 end) open_terminate,vp_codigo_pago vp_codigo_pago 
					from z_viajespasajero vp, z_sector s1,z_sector s2
					where vp.vp_sector_inicio=s1.id and vp.vp_sector_destino=s2.id and vp.vp_estado_viaje=2 and vp_viaje_id=0 and vp_sector_inicio=1 
					and vp_pago_verificado=1 and date_format(vp.vp_fecha_salida,'%Y%m%d%h%i%s')=date_format('".$hora_viaje."','%Y%m%d%h%i%s') 
					order by vp.vp_fecha_salida";
			else
				$sql="select vp_id,s1.sector_name desde,s2.sector_name hasta,vp.vp_fecha_salida, vp.vp_estado_viaje codigo_estado,vp.vp_nro_pasajeros,
					(select p_desc from z_parametros where p_id=vp.vp_estado_viaje) vp_estado_viaje,vp.vp_valor_total_pago,vp.vp_tipo_pago,vp.vp_fecha_acceptation,
					(case when vp.vp_fecha_salida<now() then 1 else 0 end) open_terminate,vp_codigo_pago vp_codigo_pago 
					from z_viajespasajero vp, z_sector s1,z_sector s2
					where vp.vp_sector_inicio=s1.id and vp.vp_sector_destino=s2.id and vp.vp_estado_viaje=2 and vp_viaje_id=0 and vp_sector_destino=1 
					and vp_pago_verificado=1 and date_format(vp.vp_fecha_salida,'%Y%m%d%h%i%s')=date_format('".$hora_viaje."','%Y%m%d%h%i%s') 
					order by vp.vp_fecha_salida";
			//echo $sql.'<br>';
			$misreservas=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$misreservas[$count] = array(	$row["vp_id"],
													$row["desde"],
													$row["hasta"],
													$row["vp_fecha_salida"],
													$row["vp_estado_viaje"],
													$row["vp_valor_total_pago"],
													$row["vp_tipo_pago"],
													$row["vp_fecha_acceptation"],
													$row["vp_codigo_pago"],
													$row["open_terminate"],
													$row["codigo_estado"],
													$row["vp_nro_pasajeros"]);
					$count++;
				}
			}
			return $misreservas;
		}

		public function misSolicitudes($dbcon,$userId,$DEBUG_STATUS)
		{
			$sql="select vs_codigo_pago vs_codigo_pago,t1.t_name desde,t2.t_name hasta,
				DATE_FORMAT(vs_fecha_viaje,'%d-%b-%Y %H:%i:%s') vs_fecha_viaje,
				(case when vs_fecha_viaje<now() then 1 else 0 end) open_terminate,
				vs_estado_solicitud,vs_costo_viaje,vs_cant_pasajeros,
				(case when vs_tipo_pago=1 then 'Transferencia Bancaria' when vs_tipo_pago=2 then 'Deposito en Banco' when vs_tipo_pago=3 then 'Tarjeta Debito' when vs_tipo_pago=4 then 'Tarjeta Credito' end) vs_tipo_pago,
				DATE_FORMAT(vs_created_on,'%d-%b-%Y %H:%i:%s') vs_created_on,'0' vp_viaje_id  		 
				from z_viajes_solicitado,z_terminal t1,
				z_terminal t2 where vs_estado_solicitud=0 and vs_desde=t1.t_id and 
				vs_hasta=t2.t_id and vs_created_by=".$userId." order by vs_fecha_viaje";
			$misreservas=array();
			$count=0;
			//$cant_retorno_pendiente = 0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$misreservas[$count] = array($row["vs_codigo_pago"],$row["desde"],$row["hasta"],$row["vs_fecha_viaje"],
						$row["vs_estado_solicitud"],$row["vs_costo_viaje"],$row["vs_tipo_pago"],$row["vs_created_on"],
						$row["vp_viaje_id"],$row["open_terminate"],$row["vs_cant_pasajeros"]);
					$count++;
				}
			}
			return $misreservas;
		}

		public function misSolicitudesParaAsignar($dbcon,$userId,$duraciondisponible,$origen,$fechaviaje,$nroequipaje,$nroasientes,$DEBUG_STATUS)
		{
			$sql="select * from z_viajes_solicitado where vs_estado_solicitud=0 and vs_desde=".$origen." and vs_hasta=1 order by vs_created_on desc";
			$misreservas=array();
			$count=0;
			//$cant_retorno_pendiente = 0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$misreservas[$count] = array($row["vs_id"],$row["vs_desde"],$row["vs_hasta"],$row["vs_direccion"],$row["vs_fecha_viaje"],
						$row["vs_cant_pasajeros"],$row["vs_plan_retorno"],$row["vs_costo_viaje"],$row["vs_codigo_pago"],
						$row["vs_tipo_pago"],$row["vs_estado_solicitud"],$row["vs_created_by"],$row["vs_created_on"]);
					$count++;
				}
			}
			return $misreservas;
		}

		
		public function actualizarEstadoSolicitud($dbcon,$id,$viaje_id,$DEBUG_STATUS)
		{
			mysqli_autocommit($dbcon,FALSE);
			$sql="update z_viajes_solicitado set vs_codigo_viaje=".$viaje_id.", vs_estado_solicitud=1 where vs_id=".$id;
			//echo 'SQL:'.$sql.'<br>';

			if(mysqli_query($dbcon,$sql))
            {
            	mysqli_commit($dbcon);
				return 0;
			}
			else
			{
				mysqli_rollback($dbcon);
				return 1;
			}
		}

		//TODO - map passenger to view
		public function consultapagos($dbcon,$userId,$DEBUG_STATUS)
		{
			/*$sql="select v.v_id,t1.t_name desde,t2.t_name hasta,
				DATE_FORMAT(v.v_fecha_salida,'%d-%b-%Y %H:%i:%s') v_fecha_salida,
				(select p_desc from z_parametros where p_id=v.v_estado) v_estado,v.v_costo_viaje,
				vp.vp_tipo_pago,DATE_FORMAT(vp.vp_fecha_aceptacion,'%d-%b-%Y %H:%i:%s') vp_fecha_aceptacion,
				(select u_name from z_users u where u.u_id=vp.vp_pass_id) nombre_pasajero,
				vp.vp_estado_viaje,DATE_FORMAT(vp.vp_fecha_pago,'%d-%b-%Y %H:%i:%s') vp_fecha_pago  
				from z_viajes v,z_viajespasajero vp,z_terminal t1,
				z_terminal t2 where v.v_id=vp.vp_viaje_id and v.v_desde=t1.t_id and 
				v.v_hasta=t2.t_id and vp.vp_estado_viaje>0 and v.v_created_by=".$userId." order by v.v_fecha_salida";*/
			/*$sql="select v.v_id,t1.t_name desde,t2.t_name hasta,
				DATE_FORMAT(v.v_fecha_salida,'%d-%b-%Y %H:%i:%s') v_fecha_salida,
				(select p_desc from z_parametros where p_id=v.v_estado) v_estado,v.v_costo_viaje,
				vp.vp_tipo_pago,DATE_FORMAT(vp.vp_fecha_aceptacion,'%d-%b-%Y %H:%i:%s') vp_fecha_aceptacion,
				(select u_name from z_users u where u.u_id=vp.vp_pass_id) nombre_pasajero,
				vp.vp_estado_viaje,DATE_FORMAT(vp.vp_dt_payment_to_client,'%d-%b-%Y') vp_dt_payment_to_client,vp_doc_paymet_to_client   
				from z_viajes v,z_viajespasajero vp,z_terminal t1,
				z_terminal t2 where v.v_id=vp.vp_viaje_id and v.v_desde=t1.t_id and 
				v.v_hasta=t2.t_id and v.v_estado in(4,7) and v.v_created_by=".$userId." order by v.v_fecha_salida";*/
			$sql="select v.v_viaje_id,t1.sector_name desde,t2.sector_name hasta,
				DATE_FORMAT(vp.vp_fecha_salida,'%d-%b-%Y %H:%i:%s') v_fecha_salida,
				(select p_desc from z_parametros where p_id=v.v_estado) v_estado,vp.vp_valor_total_pago,
				vp.vp_tipo_pago,DATE_FORMAT(vp.vp_fecha_acceptation,'%d-%b-%Y %H:%i:%s') vp_fecha_aceptacion,
				(select u_name from z_users u where u.u_id=vp.vp_comprado_por) nombre_pasajero,
				vp.vp_estado_viaje,DATE_FORMAT(vp.vp_dt_payment_to_client,'%d-%b-%Y') vp_dt_payment_to_client,vp_doc_paymet_to_client   
				from z_viajes v,z_viajespasajero vp,z_sector t1,
				z_sector t2 where v.v_viaje_id=vp.vp_viaje_id and vp.vp_sector_inicio=t1.id and 
				vp.vp_sector_destino=t2.id and v.v_id_conductor=".$userId." order by vp.vp_fecha_salida";
			$misconsultas=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$misconsultas[$count] = array(	$row["v_viaje_id"],
													$row["desde"],
													$row["hasta"],
													$row["v_fecha_salida"],
													$row["v_estado"],
													$row["vp_valor_total_pago"],
													$row["vp_tipo_pago"],
													$row["vp_fecha_aceptacion"],
													$row["nombre_pasajero"],
													$row["vp_estado_viaje"],
													$row["vp_dt_payment_to_client"],
													$row["vp_doc_paymet_to_client"]);
					$count++;
				}
			}
			return $misconsultas;
		}

	

		public function mispublicaciones($dbcon,$userId,$DEBUG_STATUS)
		{
			/*$sql="select v.v_id,v.v_codigo_viaje,t1.t_name desde,t2.t_name hasta,DATE_FORMAT(v.v_fecha_salida,'%d-%b-%Y %H:%i:%s') v_fecha_salida,
			(select p_desc from z_parametros where p_id=v.v_estado) v_estado,v.v_costo_viaje,v.v_min_pasajeros,v.v_ocupado,
			DATE_FORMAT(v.v_created_on,'%d-%b-%Y %H:%i:%s') v_created_on from z_viajes v,z_users u,z_terminal t1,z_terminal t2 where v.v_created_by=u.u_id and 
			v.v_desde=t1.t_id and v.v_hasta=t2.t_id and v.v_created_by=".$userId." and v.v_estado <99 order by v.v_fecha_salida";*/
			$sql="select v.v_viaje_id,s1.sector_name desde,s2.sector_name hasta,vp.vp_fecha_salida,
						(select p.p_desc from z_parametros p where p.p_id=vp.vp_estado_viaje) vp_estado_viaje,sum(vp.vp_valor_total_pago) valor_total_pago,
						sum(vp.vp_nro_pasajeros) vp_nro_pasajeros,vp.vp_doc_paymet_to_client,vp.vp_dt_payment_to_client
						from z_viajes v, z_viajespasajero vp,z_sector s1,z_sector s2
						where v.v_id_conductor=".$userId." and v.v_viaje_id=vp.vp_viaje_id and s1.id=vp.vp_sector_inicio and s2.id=vp.vp_sector_destino
						group by vp.vp_viaje_id";
			$misreservas=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$misreservas[$count] = array(	$row["v_viaje_id"],
													$row["desde"],
													$row["hasta"],
													$row["vp_fecha_salida"],
													$row["vp_estado_viaje"],
													$row["valor_total_pago"],
													$row["vp_nro_pasajeros"],
													$row["vp_doc_paymet_to_client"],
													$row["vp_dt_payment_to_client"]);
					$count++;
				}
			}
			return $misreservas;
		}

		public function publicacionesConductor($dbcon,$viajeId,$estado,$DEBUG_STATUS)
		{
			$sql="select v.v_viaje_id,s1.sector_name desde,s2.sector_name hasta,vp.vp_fecha_salida,
				(select p.p_desc from z_parametros p where p.p_id=vp.vp_estado_viaje) vp_estado_viaje,sum(vp.vp_valor_total_pago) valor_total_pago,
				sum(vp.vp_nro_pasajeros) vp_nro_pasajeros,vp.vp_doc_paymet_to_client,vp.vp_dt_payment_to_client,v.v_id_conductor,vp.vp_estado_viaje vp_codigo_estado_viaje, 
				(case when vp.vp_fecha_salida<DATE_SUB(now(),INTERVAL 3 DAY) then 1 else 0 end) do_terminate 
				from z_viajes v, z_viajespasajero vp,z_sector s1,z_sector s2
				where v.v_viaje_id like '%".$viajeId."%' and v.v_viaje_id=vp.vp_viaje_id and s1.id=vp.vp_sector_inicio and s2.id=vp.vp_sector_destino";
			if($estado!=99 && $estado!=3)
				$sql=$sql." and v_estado=".$estado;
			if($estado==3)
				$sql=$sql." and (v_estado=".$estado." or datediff(now(),vp.vp_fecha_salida)>3)";

			$sql=$sql." group by vp.vp_viaje_id";
			//echo 'SQL:'.$sql.'<br>';
			$misreservas=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$misreservas[$count] = array(	$row["v_viaje_id"],
												$row["desde"],
												$row["hasta"],
												$row["vp_fecha_salida"],
												$row["vp_estado_viaje"],
												$row["valor_total_pago"],
												$row["vp_nro_pasajeros"],
												$row["vp_doc_paymet_to_client"],
												$row["vp_dt_payment_to_client"],
												$row["v_id_conductor"],
												$row["vp_codigo_estado_viaje"],
												$row["do_terminate"]);
					$count++;
				}
			}
			return $misreservas;
		}

		public function micuenta($dbcon,$userId,$DEBUG_STATUS)
		{
			$sql="select c_id,c_nro_cuenta, c_banco_id, c_tipo_cuenta from z_cuenta where c_userid=".$userId;
			$micuenta=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$micuenta[$count] = array($row["c_id"],$row["c_nro_cuenta"],$row["c_banco_id"],$row["c_tipo_cuenta"]);
					$count++;
				}
			}
			return $micuenta;
		}

		public function micuentaDtl($dbcon,$userId,$DEBUG_STATUS)
		{
			$sql="select zc.c_nro_cuenta,zb.b_name,zt.tc_desc from z_cuenta zc, z_bancos zb,z_tipo_cuenta zt
					where zc.c_userid=".$userId." and zc.c_banco_id=zb.b_id and zc.c_tipo_cuenta=zt.tc_id";
			$micuenta=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$micuenta[$count] = array($row["c_nro_cuenta"],$row["b_name"],$row["tc_desc"]);
					$count++;
				}
			}
			return $micuenta;
		}

		public function getPagosConductorDtl($dbcon,$viajeId,$DEBUG_STATUS)
		{
			$sql="select vp.vp_viaje_id,c.c_userid,c.c_nro_cuenta,b.b_name,t.tc_desc,vp.vp_valor_total_pago,vp.vp_doc_paymet_to_client,vp_dt_payment_to_client    
				from z_viajespasajero vp,z_viajes v, z_cuenta c, z_bancos b,z_tipo_cuenta t
				where vp.vp_viaje_id=".$viajeId." and vp.vp_viaje_id=v.v_viaje_id and v.v_id_conductor=c.c_userid and c.c_banco_id=b.b_id and c.c_tipo_cuenta=t.tc_id";
			$micuenta=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$micuenta[$count] = array($row["vp_viaje_id"],$row["c_userid"],$row["c_nro_cuenta"],$row["b_name"],$row["tc_desc"],$row["vp_valor_total_pago"],$row["vp_doc_paymet_to_client"],$row["vp_dt_payment_to_client"]);
					$count++;
				}
			}
			return $micuenta;
		}


		
		public function actualizarCuenta($dbcon,$id,$nroCuenta,$bancoId,$tipoCuenta,$userid,$DEBUG_STATUS)
		{
			//echo '<br><br><br><br>'.$id;
			if($id==0)
			{
				$sql = "insert into z_cuenta(c_userid, c_nro_cuenta,c_banco_id, c_tipo_cuenta,c_created_on,c_created_by)
				 		values(".$userid.",'".$nroCuenta."',".$bancoId.",".$tipoCuenta.",now(),".$userid.")";
			}
			else
			{
				$sql="update z_cuenta set c_nro_cuenta='".$nroCuenta."',c_banco_id=".$bancoId.",c_tipo_cuenta=".$tipoCuenta.",c_modified_on=now(),c_modified_by=".$userid." where c_id=".$id;
			}
			if(mysqli_query($dbcon,$sql))
            {
				return 0;
			}
			else
				return 1;
		}

		public function configNotificacion($dbcon,$userId,$DEBUG_STATUS)
		{
			$sql="select n_id,n_noti_publicacion,n_noti_reservacion,n_noti_publicacion_cambio,n_noti_reservacion_cambio,
			n_noti_publicos,n_noti_privados from z_notificacion where n_user_id=".$userId;
			$minotificacionsettings=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$minotificacionsettings[$count] = array($row["n_id"],$row["n_noti_publicacion"],$row["n_noti_reservacion"],
						$row["n_noti_publicacion_cambio"],$row["n_noti_reservacion_cambio"],$row["n_noti_publicos"],$row["n_noti_privados"]);
					$count++;
				}
			}
			return $minotificacionsettings;
		}
		public function configurarPermisosNotificaciones($dbcon,$userId,$id,$n_noti_publicacion,$n_noti_reservacion,$n_noti_publicacion_cambio,$n_noti_reservacion_cambio,$n_noti_publicos,$n_noti_privados,$DEBUG_STATUS)
		{
			$sql="update z_notificacion set n_noti_publicacion=".$n_noti_publicacion.",n_noti_reservacion=".$n_noti_reservacion.",
				n_noti_publicacion_cambio=".$n_noti_publicacion_cambio.",n_noti_reservacion_cambio=".$n_noti_reservacion_cambio.",
				n_noti_publicos=".$n_noti_publicos.",n_noti_privados=".$n_noti_privados.",n_modified_on=now(),n_modified_by=".$userId." where n_id=".$id;
			
			if(mysqli_query($dbcon,$sql))
            {
				return 0;
			}
			else
				return 1;
		}

		public function getBancos($dbcon,$DEBUG_STATUS)
		{
			$sql="select b_id,b_name from z_bancos where b_estado=0 order by b_name ";
			$bancos=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$bancos[$count] = array($row["b_id"],$row["b_name"]);
					$count++;
				}
			}
			return $bancos;

		}

		public function getTipoCuentas($dbcon,$DEBUG_STATUS)
		{
			$sql="select tc_id,tc_desc from z_tipo_cuenta order by tc_desc ";
			$tipocuentas=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$tipocuentas[$count] = array($row["tc_id"],$row["tc_desc"]);
					$count++;
				}
			}
			return $tipocuentas;

		}

		public function actualizarClave($dbcon,$newpwd,$oldpwd,$userid,$DEBUG_STATUS)
		{
			//echo '<br><br><br><br>'.$id;
			$sql="update z_login set l_pwd='".$newpwd."',l_modified_on=now(),l_modified_by=".$userid." where l_id=".$userid." and l_pwd='".$oldpwd."'";
			if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
            {
				return 0;
			}
			else
				return 1;
		}

		public function eliminarCuenta($dbcon,$obser,$userid,$DEBUG_STATUS)
		{
			//echo '<br><br><br><br>'.$id;
			mysqli_autocommit($dbcon,FALSE);
			$err_code=0;
			$sql = "UPDATE z_login SET L_IN_USE=1,L_SESSION_ID='',l_modified_by=".$userid.",l_modified_on=now(),
			l_is_eliminado_por_usuario=0, l_observacion='".$obser."'
				WHERE L_ID=".$userid;
			if($DEBUG_STATUS)
				echo '$sql-1::'.$sql.'<br>';
	        if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
	        {
	        	mysqli_commit($dbcon);
	        	$err_code=0;
	        	if($DEBUG_STATUS)
					echo 'LOGOUT SUCCESSFUL<br>';
				session_destroy();
	        }
	        else
	        {
	        	$err_code=1;// ERROR EN LOGOUT
	        	if($DEBUG_STATUS)
					echo 'ERROR EN LOGOUT<br>';
	        }
	        return $err_code;
		}


		//ADMIN
		public function controlDocuments($dbcon,$DEBUG_STATUS)
		{
			$sql="select u.u_id,u.u_emailId,d.d_id,c.d_desc,d.d_document_name,d_is_doc_verified, d_observacion,d_document_type 
					from z_userdocs d, z_users u,z_docs c
					where u.u_id=d.d_user and c.d_id=d.d_document_type 
					and d_is_doc_verified=9
					and d_document_type in(1,3,4) order by d.d_created_on";
			$docs=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$docs[$count] = array($row["u_id"],$row["u_emailId"],$row["d_id"],$row["d_desc"],$row["d_document_name"],$row["d_is_doc_verified"],$row["d_observacion"],$row["d_document_type"]);
					$count++;
				}
			}
			return $docs;

		}

		public function controlDocumentsById($dbcon,$docId,$DEBUG_STATUS)
		{
			$sql="select u.u_id,u.u_emailId,d.d_id,c.d_desc,d.d_document_name,d_is_doc_verified, d_observacion,d_document_type,date_format(d_ultimo_verificacion,'%d-%m-%Y %H:%i-%s') d_ultimo_verificacion 
					from z_userdocs d, z_users u,z_docs c
					where u.u_id=d.d_user and c.d_id=d.d_document_type 
					and d.d_id=".$docId."
					and d_document_type in(1,3,4) order by d.d_created_on";
			$docs=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$docs[$count] = array($row["u_id"],$row["u_emailId"],$row["d_id"],$row["d_desc"],$row["d_document_name"],$row["d_is_doc_verified"],$row["d_observacion"],$row["d_document_type"],$row["d_ultimo_verificacion"]);

					$count++;
				}
			}
			return $docs;

		}

		public function controlDocumentsByUserId($dbcon,$userId,$estado,$DEBUG_STATUS)
		{
			$sql="select u.u_id,u.u_emailId,d.d_id,c.d_desc,d.d_document_name,d_is_doc_verified, d_observacion,d_document_type 
					from z_userdocs d, z_users u,z_docs c
					where u.u_id=d.d_user and c.d_id=d.d_document_type 
					and u.u_id=".$userId."
					and d.d_is_doc_verified=".$estado." 
					and d_document_type in(1,3,4) order by d.d_created_on";
			$docs=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$docs[$count] = array($row["u_id"],$row["u_emailId"],$row["d_id"],$row["d_desc"],$row["d_document_name"],$row["d_is_doc_verified"],$row["d_observacion"],$row["d_document_type"]);
					$count++;
				}
			}
			return $docs;

		}

		public function getVehicleDetailsByMatriculationDoc($dbcon,$docId,$DEBUG_STATUS)
		{
			$sql="select a.a_id,a.a_marca,a.a_modelo,a.a_ano,a.a_capacidad,a.a_placa,a.a_nro_matricula,a.a_pic_automovil,a.a_observation,a.a_is_approved from z_automovil a, z_userdocs d where d.d_id=".$docId." and d.d_veh_id=a.a_id";
			$docs=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$docs[$count] = array($row["a_id"],$row["a_marca"],$row["a_modelo"],$row["a_ano"],$row["a_capacidad"],$row["a_placa"],$row["a_nro_matricula"],$row["a_pic_automovil"],$row["a_observation"],$row["a_is_approved"]);
					$count++;
				}
			}
			return $docs;

		}


		public function controlPagos($dbcon,$DEBUG_STATUS)
		{
			/*$sql="select vp.vp_id,vp.vp_codigo_viaje,vp.vp_fecha_pago,vp.vp_tipo_pago,vp.vp_pic_pago,u.u_name,vp.vp_observacion,vp.vp_pago_verificado  
					from z_viajespasajero vp,z_users u 
					where vp.vp_pago_verificado=99
					and vp.vp_pass_id=u.u_id
					order by vp.vp_fecha_pago";*/
			/*$sql="select distinct vp.vp_viaje_id,vp.vp_codigo_pago,vp.vp_fecha_pago,vp.vp_tipo_pago,vp.vp_pic_pago,u.u_name,vp.vp_observacion,
					vp.vp_pago_verificado,vp.vp_valor_total_pago,vp.vp_fecha_pago_en_banco from z_viajespasajero vp,z_users u where vp.vp_pago_verificado=99 and 
					vp.vp_comprado_por=u.u_id and vp.vp_codigo_pago not like'%TMP_%' order by vp.vp_fecha_pago";*/

			$sql = "select vp.vp_viaje_id,vp.vp_codigo_pago,vp.vp_fecha_pago,vp.vp_tipo_pago,vp.vp_pic_pago,u.u_name,vp.vp_observacion,
						vp.vp_pago_verificado,sum(vp.vp_valor_total_pago) vp_valor_total_pago,vp.vp_fecha_pago_en_banco from z_viajespasajero vp,z_users u where vp.vp_pago_verificado=99 and 
						vp.vp_comprado_por=u.u_id and vp.vp_codigo_pago not like'%TMP_%' 
						group by vp.vp_viaje_id,vp.vp_codigo_pago,vp.vp_fecha_pago,vp.vp_tipo_pago,vp.vp_pic_pago,u.u_name,vp.vp_observacion,
						vp.vp_pago_verificado,vp.vp_fecha_pago_en_banco order by vp.vp_fecha_pago";
			$docs=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$strPago='';
					if($row["vp_tipo_pago"]==1)
						$strPago='Transferencia Bancaria';
					else if($row["vp_tipo_pago"]==2)
						$strPago='Deposito en Banco';
					else if($row["vp_tipo_pago"]==3)
						$strPago='Tarjeta Debito';
					else if($row["vp_tipo_pago"]==4)
						$strPago='Tarjeta Credito';

					$docs[$count] = array(1,$row["vp_codigo_pago"],$row["vp_fecha_pago"],$strPago,$row["vp_pic_pago"],$row["u_name"],$row["vp_observacion"],$row["vp_pago_verificado"],$row["vp_valor_total_pago"],$row["vp_fecha_pago_en_banco"]);
					$count++;
				}
			}
			return $docs;

		}

		public function controlPagosById($dbcon,$pago_id,$DEBUG_STATUS)
		{
			/*$sql="select vp.vp_id,vp.vp_codigo_viaje,vp.vp_fecha_pago,vp.vp_tipo_pago,vp.vp_pic_pago,u.u_name,vp.vp_observacion,vp.vp_pago_verificado  
					from z_viajespasajero vp,z_users u 
					where vp.vp_pass_id=u.u_id and vp.vp_codigo_viaje='".$pago_id."' 
					order by vp.vp_fecha_pago";*/
			/*$sql="select distinct a.vp_codigo_viaje,a.vp_fecha_pago,a.vp_fecha_pago_en_banco,a.vp_tipo_pago,a.vp_pic_pago,a.u_name,a.vp_observacion,a.vp_pago_verificado,
					sum(a.v_costo_viaje) v_costo_viaje from 
					(select vp.vp_viaje_id,vp.vp_codigo_viaje,vp.vp_fecha_pago,vp.vp_tipo_pago,vp.vp_pic_pago,u.u_name,vp.vp_observacion,
					vp.vp_pago_verificado,v.v_costo_viaje,vp.vp_fecha_pago from z_viajespasajero vp,z_users u,z_viajes v where vp.vp_codigo_viaje='".$pago_id."' and  
					vp.vp_pass_id=u.u_id and vp.vp_viaje_id=v.v_id order by vp.vp_fecha_pago) a 
					group by a.vp_codigo_viaje,a.vp_fecha_pago,a.vp_fecha_pago_en_banco,a.vp_tipo_pago,a.vp_pic_pago,a.u_name,a.vp_observacion,a.vp_pago_verificado";*/
			$sql="select vp.vp_codigo_pago,vp.vp_fecha_pago,vp.vp_fecha_pago_en_banco,vp.vp_tipo_pago,vp.vp_pic_pago,u.u_name,vp.vp_observacion,
					vp.vp_pago_verificado,sum(vp.vp_valor_total_pago) vp_valor_total_pago from z_viajespasajero vp,z_users u where";
			if(!empty($pago_id))
				$sql=$sql." vp.vp_codigo_pago like '%".$pago_id."%' and";  
			$sql=$sql." vp.vp_comprado_por=u.u_id group by vp.vp_codigo_pago order by vp.vp_fecha_pago";
			$docs=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$strPago='';
					if($row["vp_tipo_pago"]==1)
						$strPago='Transferencia Bancaria';
					else if($row["vp_tipo_pago"]==1)
						$strPago='Deposito en Banco';
					else if($row["vp_tipo_pago"]==3)
						$strPago='Tarjeta Debito';
					else if($row["vp_tipo_pago"]==4)
						$strPago='Tarjeta Credito';

					$docs[$count] = array(1,$row["vp_codigo_pago"],$row["vp_fecha_pago"],$strPago,$row["vp_pic_pago"],$row["u_name"],$row["vp_observacion"],$row["vp_pago_verificado"],$row["vp_valor_total_pago"],$row["vp_fecha_pago_en_banco"]);
					$count++;
				}
			}
			return $docs;

		}

		public function getConductorIdFromCodigoViaje($dbcon,$codigoViaje,$DEBUG_STATUS)
		{
			/*$sql="select distinct v.v_created_by,v_automovil_id from z_viajes v where v.v_codigo_viaje='".$codigoViaje."'";*/
			$sql="select distinct v.v_id_conductor,a.a_id v_automovil_id from z_viajes v,z_automovil a where v.v_viaje_id=".$codigoViaje." and v.v_id_conductor=a.a_userid";
			$conductor=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$conductor[$count] = array($row["v_id_conductor"],$row["v_automovil_id"]);
					$count++;
				}
			}
			return $conductor;
		}

		public function updateDocumentVerification($dbcon,$docId,$estado,$observacion,$docType,$DEBUG_STATUS)
		{
			$sql="update z_userdocs set d_is_doc_verified=".$estado.", d_observacion='".$observacion."',d_ultimo_verificacion=now() 
					where d_id=".$docId;
			if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
            {
            	if($docType==4)
            	{
            		/*$sql="update z_automovil a set a.a_is_approved=".(($estado-1)*(-1)).",a.a_observation='".$observacion."' where a.a_id in(select d.d_veh_id from z_userdocs d where d.d_id=".$docId.")";*/
            		$sql="update z_automovil a set a.a_is_approved=".$estado.",a.a_observation='".$observacion."' where a.a_id in(select d.d_veh_id from z_userdocs d where d.d_id=".$docId.")";
            		if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
            		{
            			return 0;
            		}
	            	else
	            		return 1;	
	            }			
			}
			else
				return 1;
			//return $docs;

		}

		public function updatePagoVerification($dbcon,$Id,$estado,$observacion,$DEBUG_STATUS)
		{
			/*$sql="update z_viajespasajero set vp_pago_verificado=".$estado.",vp_observacion='".$observacion."' where vp_codigo_pago='".$Id."'";
			if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
            {
				return 0;
			}
			else
				return 1;*/
			//return $docs;
			if($estado==1)
			{
				$sql="update z_viajespasajero set vp_pago_verificado=".$estado.",vp_estado_viaje=2,vp_observacion='".$observacion."' where vp_codigo_pago='".$Id."' and vp_sector_destino=1";
				if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
	            {
					$sql="update z_viajespasajero set vp_pago_verificado=".$estado.",vp_estado_viaje=0,vp_observacion='".$observacion."' where vp_codigo_pago='".$Id."' and vp_sector_inicio=1";
					if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>=0)
		            {
						return 0;
					}
					else
						return 1;
				}
				else
					return 1;	
			}
			else if($estado==0)
			{
				$sql="update z_viajespasajero set vp_pago_verificado=".$estado.",vp_estado_viaje=7,vp_observacion='".$observacion."' where vp_codigo_pago='".$Id."'";
				if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
	            {
					return 0;
				}
				else
					return 1;	
			}
			

		}

		
		
		public function getCoductorRating($dbcon,$conductorID,$DEBUG_STATUS)
		{
			$sql="select round((a.rating_total/a.ctr),2) rating from 
				(select count(*) ctr, sum(r_calificacion_conductor) rating_total from z_ratings where r_conductor_id=".$conductorID.") a";
			$rating= 0; 
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					if(isset($row["rating"]))
						$rating=$row["rating"];
				}
			}
			return $rating;
		}

		public function getCoductorRatingByUser($dbcon,$conductorID,$viajeId,$userId,$DEBUG_STATUS)
		{
			$sql="select r_calificacion_conductor rating from z_ratings r where r_conductor_id=".$conductorID." and r.r_viaje_id=".$viajeId." and 
					(r_calificado_por=".$userId." or r_modificado_por=".$userId.")";
			$rating= 0; 
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					if(isset($row["rating"]))
						$rating=$row["rating"];
				}
			}
			return $rating;
		}

		public function updateConductorRating($dbcon,$condustorID,$viajeID,$userId,$rating,$DEBUG_STATUS)
		{
			$sql="select count(*) ctr from z_ratings where r_viaje_id=".$viajeID." 
				and (r_calificado_por=".$userId." or r_modificado_por=".$userId.")";
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					if($row["ctr"]>0)
					{
						//echo '1';
						$sql="update z_ratings set r_calificacion_conductor=".$rating.",r_modificado_on=now(),r_modificado_por=".$userId."
							where r_viaje_id=".$viajeID." and r_conductor_id=".$condustorID." and 
							(r_calificado_por=".$userId." or r_modificado_por=".$userId.")";
						if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
			            {
			            	//echo '2';
							return 0;
						}
						else
							return 1;
					}
					else
					{
						$sql = "insert into z_ratings(r_viaje_id, r_conductor_id, r_calificacion_conductor, r_calificado_on, r_calificado_por)
								values(".$viajeID.",".$condustorID.",".$rating.",now(),".$userId.")";
						if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
			            {
			            	//echo '3';
							return 0;
						}
						else
							return 1;
					}
				}
			}
			else
			{
				//echo '0';
				return 1;
			}
		}

		public function automovilRating($dbcon,$vehicleID,$DEBUG_STATUS)
		{
			$sql="select round((a.rating_total/a.ctr),2) rating from 
				(select count(*) ctr, sum(r_calificacion_vehicle) rating_total from z_ratings where r_vehicle_id=".$vehicleID.") a";
			$rating= 0; 
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					if(isset($row["rating"]))
						$rating=$row["rating"];
				}
			}
			return $rating;
		}

		public function getVehicleRatingByUser($dbcon,$vehicleID,$viajeId,$userId,$DEBUG_STATUS)
		{
			$sql="select r_calificacion_vehicle rating from z_ratings r where r_vehicle_id=".$vehicleID." and r.r_viaje_id=".$viajeId." and 
					(r_calificado_veh_por=".$userId." or r_modificado_veh_por=".$userId.")";
			$rating= 0; 
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					if(isset($row["rating"]))
						$rating=$row["rating"];
				}
			}
			return $rating;
		}

		public function updateVehicleRating($dbcon,$vehicleID,$viajeID,$userId,$rating,$DEBUG_STATUS)
		{
			$sql="select count(*) ctr from z_ratings where r_vehicle_id=".$vehicleID." and r_viaje_id=".$viajeID." 
				and (r_calificado_veh_por=".$userId." or r_modificado_veh_por=".$userId.")";
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					if($row["ctr"]>0)
					{
						//echo '1';
						$sql="update z_ratings set r_calificacion_vehicle=".$rating.",r_modificado_veh_on=now(),r_modificado_veh_por=".$userId."
							where r_viaje_id=".$viajeID." and r_vehicle_id=".$vehicleID." and 
							(r_calificado_veh_por=".$userId." or r_modificado_veh_por=".$userId.")";
						if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
			            {
			            	//echo '2';
							return 0;
						}
						else
							return 1;
					}
					else
					{
						$sql = "insert into z_ratings(r_viaje_id, r_vehicle_id, r_calificacion_vehicle, r_calificado_veh_on, r_calificado_veh_por)
								values(".$viajeID.",".$vehicleID.",".$rating.",now(),".$userId.")";
						if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
			            {
			            	//echo '3';
							return 0;
						}
						else
							return 1;
					}
				}
			}
			else
			{
				//echo '0';
				return 1;
			}
		}


		public function getGalleryByUserId($dbcon,$viajeId,$userId,$DEBUG_STATUS)
		{
			$sql="select g.g_caption,g.g_desc,g.g_image_path,g.g_img_uploaded_by,g.g_img_uploaded_on 
				from z_gallery g where g.g_viaje_id=".$viajeId;
			$gallery=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$gallery[$count] = array($viajeId,$userId,$row["g_caption"],$row["g_desc"],$row["g_image_path"],$row["g_img_uploaded_by"],$row["g_img_uploaded_on"]);
					$count++;
				}
			}
			return $gallery;

		}

		
		public function insertGalleryImage($dbcon,$viajeIDGallery,$userId,$img_caption,$img_desc,$target_file,$DEBUG_STATUS)
		{
			$sql="insert into z_gallery(g_viaje_id,g_userId,g_caption,g_desc,g_image_path,g_img_uploaded_by,g_img_uploaded_on) 
			 values(".$viajeIDGallery.",".$userId.",'".$img_caption."','".$img_desc."','".$target_file."',".$userId.",now())";
			//echo $sql.'<br>';
			if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
            {
				return 0;
			}
			else
				return 1;
			//return $docs;

		}

		public function getTopCommentsForHomePage($dbcon,$DEBUG_STATUS)
		{
			$sql="select c_comments, c_commented_by,c_commented_on,u.u_name,u.u_profile_pic 
				from z_comments c,z_users u where c.c_enable_for_home_page=1 and c.c_commented_by=u.u_id";
			$comments=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$comments[$count] = array(0,0,$row["c_comments"],$row["c_commented_by"],$row["c_commented_on"],$row["u_name"],$row["u_profile_pic"]);
					$count++;
				}
			}
			return $comments;

		}

		public function getCommentsByUserId($dbcon,$viajeId,$userId,$DEBUG_STATUS)
		{
			$sql="select c_comments, c_commented_by,c_commented_on,u.u_name,u.u_profile_pic 
				from z_comments c,z_users u where c.c_viaje_id=".$viajeId." and c.c_commented_by=u.u_id";
			$comments=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$comments[$count] = array($viajeId,$userId,$row["c_comments"],$row["c_commented_by"],$row["c_commented_on"],$row["u_name"],$row["u_profile_pic"]);
					$count++;
				}
			}
			return $comments;

		}


		public function insertComments($dbcon,$viajeIDComment,$userId,$comment,$DEBUG_STATUS)
		{
			$sql="insert into z_comments(c_viaje_id,c_comments,c_commented_by,c_commented_on) 
			 values(".$viajeIDComment.",'".$comment."',".$userId.",now())";
			//echo $sql.'<br>';
			if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
            {
				return 0;
			}
			else
				return 1;
			//return $docs;

		}

		public function getGalleryForHomePage($dbcon,$DEBUG_STATUS)
		{
			$sql="select g.g_viaje_id,g.g_caption,g.g_desc,g.g_image_path,g.g_img_uploaded_by,g.g_img_uploaded_on 
				from z_gallery g , z_users u where g.g_enable_for_home_page=1 and g.g_img_uploaded_by=u.u_id ";
			$gallery=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$gallery[$count] = array(0,0,$row["g_caption"],$row["g_desc"],$row["g_image_path"],$row["g_img_uploaded_by"],$row["g_img_uploaded_on"]);
					$count++;
				}
			}
			return $gallery;

		}

		public function terminateViaje($dbcon,$codigo_viaje,$codigo_pago,$userId,$DEBUG_STATUS)
		{
			//session_start();
			mysqli_autocommit($dbcon,FALSE);
			$err_code=1;
			$sql = "UPDATE z_viajespasajero SET vp_estado_viaje=3 WHERE vp_viaje_id=$codigo_viaje and vp_codigo_pago='".$codigo_pago."' and vp_comprado_por=$userId";
			//if($DEBUG_STATUS)
				echo '$sql-1::'.$sql.'<br>';
	        if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
	        {
	        	/*$terminated = 0;
	        	$sql="select count(*) terminado from z_viajespasajero vp where vp_viaje_id=$codigo_viaje";
	        	$result = mysqli_query($dbcon,$sql);
	            if(mysqli_num_rows($result) > 0)  
	            {
					if($row = mysqli_fetch_assoc($result)) 
					{
						$terminated = $row["terminado"];
					}
				}
	        	$sql = "update z_viajes set v_estado=4 where v_id=$codigo_viaje and v_ocupado<=(select count(*) terminado from z_viajespasajero vp where vp_viaje_id=$codigo_viaje)";
	        	if(mysqli_query($dbcon,$sql))
	        	{
		        	mysqli_commit($dbcon);
		        	$err_code=0;
		        	if($DEBUG_STATUS)
						echo 'VIAJE TERMINATED SUCCESSFULLY<br>';
				}*/
				mysqli_commit($dbcon);
		        	$err_code=0;
			
	        }
	        return $err_code;
		}

		public function confirmarRetorno($dbcon,$codigo_viaje,$fechaViaje,$userId,$DEBUG_STATUS)
		{
			//session_start();
			mysqli_autocommit($dbcon,FALSE);
			$err_code=1;
			$sql = "UPDATE z_viajespasajero SET vp_estado_viaje=2,vp_fecha_salida=DATE_FORMAT('".$fechaViaje."','%Y-%m-%d %H:%i:%s') WHERE vp_id=".$codigo_viaje;
			if($DEBUG_STATUS)
				echo '$sql-1::'.$sql.'<br>';
	        if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
	        {
	        	mysqli_commit($dbcon);
		        	$err_code=0;
			
	        }
	        return $err_code;
		}

		public function pagarConductor($dbcon,$id,$codigo_viaje,$docPago,$fechaPago,$DEBUG_STATUS)
		{
			//session_start();
			mysqli_autocommit($dbcon,FALSE);
			$err_code=1;
			$sql = "UPDATE z_viajespasajero SET vp_estado_viaje=4,vp_doc_paymet_to_client='".$docPago."',vp_dt_payment_to_client=date_format('".$fechaPago."','%Y-%m-%d') 
			WHERE vp_viaje_id=".$id;
			if($DEBUG_STATUS)
				echo '$sql-1::'.$sql.'<br>';
	        if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
	        {
	        	$terminated = 0;
	        	/*$sql="select count(*) pagado from z_viajespasajero vp where vp_viaje_id=$codigo_viaje and vp_doc_paymet_to_client>0";
	        	$result = mysqli_query($dbcon,$sql);
	            if(mysqli_num_rows($result) > 0)  
	            {
					if($row = mysqli_fetch_assoc($result)) 
					{
						$terminated = $row["terminado"];
					}
				}*/
	        	$sql = "update z_viajes set v_estado=4 where v_viaje_id=$codigo_viaje and 
	        		v_ocupado<=(select count(*) pagado from z_viajespasajero vp where vp_viaje_id=$codigo_viaje and vp_doc_paymet_to_client>0)";
	        	if($DEBUG_STATUS)
					echo '$sql-1::'.$sql.'<br>';
	        	if(mysqli_query($dbcon,$sql))
	        	{
		        	mysqli_commit($dbcon);
		        	$err_code=0;
		        	if($DEBUG_STATUS)
						echo 'VIAJE PAGADO SUCCESSFULLY<br>';
				}
			
	        }
	        return $err_code;
		}

		public function miBlogs($dbcon,$userId,$DEBUG_STATUS)
		{
			$sql="select b_id,b_last_modified_dt,b_banner_img_path,b_main_title,t1,substring(p1,1,100) descripcion from z_blogs where b_user_id=".$userId;
			$blogs=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$blogs[$count] = array($row["b_id"],$row["b_last_modified_dt"],$row["b_banner_img_path"],$row["b_main_title"],$row["t1"],$row["descripcion"]);
					$count++;
				}
			}
			return $blogs;

		}


		public function addBlog($dbcon,$userId,$blog_img,$blog_title,$title01,$para01,$title02,$para02,$title03,$para03,$title04,$para04,$title05,$para05,$title06,$para06,$title07,$para07,$title08,$para08,$title09,$para09,$title10,$para10,$DEBUG_STATUS)
		{
			mysqli_autocommit($dbcon,FALSE);
			$err_code=0;
			$sql = "insert into z_blogs(b_user_id,b_last_modified_dt,b_banner_img_path,b_main_title,t1,p1,t2,p2,t3,p3,t4,p4,t5,p5,t6,p6,t7,p7,t8,p8,t9,p9,t10,p10) values 
			(".$userId.",now(),'".$blog_img."','".mysql_real_escape_string($blog_title)."','".mysql_real_escape_string($title01)."','".mysql_real_escape_string($para01)."','".mysql_real_escape_string($title02)."','".mysql_real_escape_string($para02)."','".mysql_real_escape_string($title03)."','".mysql_real_escape_string($para03)."','".mysql_real_escape_string($title04)."','".mysql_real_escape_string($para04)."','".mysql_real_escape_string($title05)."','".mysql_real_escape_string($para05)."','".mysql_real_escape_string($title06)."','".mysql_real_escape_string($para06)."','".mysql_real_escape_string($title07)."','".mysql_real_escape_string($para07)."','".mysql_real_escape_string($title08)."','".mysql_real_escape_string($para08)."','".mysql_real_escape_string($title09)."','".mysql_real_escape_string($para09)."','".mysql_real_escape_string($title10)."','".mysql_real_escape_string($para10)."')";
			if($DEBUG_STATUS)
				echo '$sql-1::'.$sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$err_code=0;
	        	if($DEBUG_STATUS)
					echo 'BLOG CREATED SUCCESSFULLY<br>';			
	        }
	        else
	        	$err_code=1;
	        return $err_code;
		} 

		public function getBlogById($dbcon,$id,$DEBUG_STATUS)
		{
			$sql="select b_id,u_name,b_last_modified_dt,b_banner_img_path,b_main_title,t1,p1,t2,p2,t3,p3,t4,p4,t5,p5,t6,p6,t7,p7,t8,p8,t9,p9,t10,p10 from z_blogs,z_users where b_id=".$id." and b_user_id=u_id";
			$blogs=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$blogs[$count] = array($row["b_id"],$row["u_name"],$row["b_last_modified_dt"],$row["b_banner_img_path"],$row["b_main_title"],$row["t1"],$row["p1"],$row["t2"],$row["p2"],$row["t3"],$row["p3"],$row["t4"],$row["p4"],$row["t5"],$row["p5"],$row["t6"],$row["p6"],$row["t7"],$row["p7"],$row["t8"],$row["p8"],$row["t9"],$row["p9"],$row["t10"],$row["p10"]);
					$count++;
				}
			}
			return $blogs;

		}


		public function regsiterViajePlanificado($dbcon,$sector,$nroasientessearch,$fechaviajesearch,$calle_principal,$numeracion,$calle_secundario,$referencia,$cantidadRetorno,$cedulas,$DEBUG_STATUS)
		{
			mysqli_autocommit($dbcon,FALSE);
			$err_code=0;
			$ctr=0;
			$vp_valor_total_pago=0;
			if($nroasientessearch==1)
			{
				$valorViaje=12.00;
			}
			else if($nroasientessearch==2)
			{
				$valorViaje=20.00;
			}
			else if($nroasientessearch==5)
			{
				$valorViaje=25.00;
				$nroasientessearch=3;
			}
			/*$vp_valor_total_pago=$valorViaje+(6.00*$cantidadRetorno);
			$codigo_pago_temporal=mt_rand();
       		$sql = "insert into z_viajespasajero(vp_sector_inicio,vp_sector_destino,vp_codigo_pago,vp_valor_total_pago,vp_nro_pasajeros,vp_comprado_por,vp_codigo_identification,vp_fecha_salida,vp_calle_principal,vp_numeracion,vp_calle_secundaria,vp_referencia,vp_estado_viaje,vp_codigo_confirmacion,vp_fecha_acceptation) values 
					(".$sector.",1,'TMP_".$codigo_pago_temporal."',".$vp_valor_total_pago.",".$nroasientessearch.",".$_SESSION['userid'].",(select u_cedula from z_users where u_id='".$_SESSION['userid']."'),DATE_FORMAT('".$fechaviajesearch."','%Y-%m-%d %H:%i:%s'),'".$calle_principal."','".$numeracion."','".$calle_secundario."','".$referencia."',1,'".mt_rand()."',now())";
			if($DEBUG_STATUS)
				echo '$sql-1::'.$sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	while($ctr<$cantidadRetorno)
	        	{
	        		$sql = "insert into z_viajespasajero(vp_sector_inicio,vp_sector_destino,vp_codigo_pago,vp_valor_total_pago,vp_nro_pasajeros,vp_comprado_por,vp_codigo_identification,vp_calle_principal,vp_numeracion,vp_calle_secundaria,vp_referencia,vp_estado_viaje,vp_codigo_confirmacion) values 
						(1,".$sector.",'TMP_".$codigo_pago_temporal."',".$vp_valor_total_pago.",1,".$_SESSION['userid'].",'".$cedulas[$ctr]."','".$calle_principal."','".$numeracion."','".$calle_secundario."','".$referencia."',1,'".mt_rand()."')";
					if($DEBUG_STATUS)
						echo '$sql-2::'.$sql.'<br>';
			        if(mysqli_query($dbcon,$sql))
			        {
			        	$ctr++;	        				
			        }	
	        	}	 
	        	if($ctr==$cantidadRetorno) 
	        	{
	        		mysqli_commit($dbcon);
	        		$err_code=$codigo_pago_temporal;
	        	} 
	        	else
	        	{
	        		mysqli_rollback($dbcon);
	        	}
        	}*/

        	//$vp_valor_total_pago=$valorViaje+(6.00*$cantidadRetorno);
        	$valorViajeRetorno=6.00;
			$codigo_pago_temporal=mt_rand();
       		$sql = "insert into z_viajespasajero(vp_sector_inicio,vp_sector_destino,vp_codigo_pago,vp_valor_total_pago,vp_nro_pasajeros,vp_comprado_por,vp_codigo_identification,vp_fecha_salida,vp_calle_principal,vp_numeracion,vp_calle_secundaria,vp_referencia,vp_estado_viaje,vp_codigo_confirmacion,vp_fecha_acceptation) values 
					(".$sector.",1,'TMP_".$codigo_pago_temporal."',".$valorViaje.",".$nroasientessearch.",".$_SESSION['userid'].",(select u_cedula from z_users where u_id='".$_SESSION['userid']."'),DATE_FORMAT('".$fechaviajesearch."','%Y-%m-%d %H:%i:%s'),'".$calle_principal."','".$numeracion."','".$calle_secundario."','".$referencia."',1,'".mt_rand()."',now())";
			if($DEBUG_STATUS)
				echo '$sql-1::'.$sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	while($ctr<$cantidadRetorno)
	        	{
	        		$sql = "insert into z_viajespasajero(vp_sector_inicio,vp_sector_destino,vp_codigo_pago,vp_valor_total_pago,vp_nro_pasajeros,vp_comprado_por,vp_codigo_identification,vp_calle_principal,vp_numeracion,vp_calle_secundaria,vp_referencia,vp_estado_viaje,vp_codigo_confirmacion) values 
						(1,".$sector.",'TMP_".$codigo_pago_temporal."',".$valorViajeRetorno.",1,".$_SESSION['userid'].",'".$cedulas[$ctr]."','".$calle_principal."','".$numeracion."','".$calle_secundario."','".$referencia."',1,'".mt_rand()."')";
					if($DEBUG_STATUS)
						echo '$sql-2::'.$sql.'<br>';
			        if(mysqli_query($dbcon,$sql))
			        {
			        	$ctr++;	        				
			        }	
	        	}	 
	        	if($ctr==$cantidadRetorno) 
	        	{
	        		mysqli_commit($dbcon);
	        		$err_code=$codigo_pago_temporal;
	        	} 
	        	else
	        	{
	        		mysqli_rollback($dbcon);
	        	}
        	}
	        return $err_code;
		}

		
		public function getDetallesPago($dbcon,$tipoPago,$temp_codigo_pago,$DEBUG_STATUS)
		{
			$sql="select sum(vp.vp_valor_total_pago) vp_valor_total_pago from z_viajespasajero vp where vp.vp_codigo_pago like '%$temp_codigo_pago%'";
			$detallesPago=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$detallesPago[$count] = array($row["vp_valor_total_pago"]);
					$count++;
				}
			}
			return $detallesPago;
		}

		
		public function getPassengerList($dbcon,$viaje_id,$DEBUG_STATUS)
		{
			$sql="select u.u_profile_pic,u.u_name,u.u_cedula,vp.vp_nro_pasajeros,u.u_celular,u.u_conventional,
			concat(vp.vp_calle_principal,' ',vp.vp_numeracion,' ',vp.vp_calle_secundaria) direccion,vp.vp_referencia 
			from z_users u,z_viajespasajero vp where vp.vp_viaje_id=".$viaje_id." and vp.vp_comprado_por=u.u_id";
			$passengerList=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$passengerList[$count] = array(	$row["u_profile_pic"],
													$row["u_name"],
													$row["u_cedula"],
													$row["vp_nro_pasajeros"],
													$row["u_celular"],
													$row["u_conventional"],
													$row["direccion"],
													$row["vp_referencia"]);
					$count++;
				}
			}
			return $passengerList;
		}

		public function getConductorId($dbcon,$viaje_id,$DEBUG_STATUS)
		{
			$sql="select z.v_id_conductor from z_viajes z where z.v_viaje_id=".$viaje_id;
			$conductorId=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$conductorId=$row["v_id_conductor"];
				}
			}
			return $conductorId;
		}

		public function registrarPago($dbcon,$tipoPago,$temp_codigo_pago,$nroDocPago,$tipoPago,$nombreArchivo,$fechaDocumentoPago,$montoDocumentoPago,$DEBUG_STATUS)
		{
			$codigoErr=0;
			mysqli_autocommit($dbcon,FALSE);
			$sql = "update z_viajespasajero set vp_codigo_pago='".$nroDocPago."',vp_fecha_pago_en_banco=DATE_FORMAT('".$fechaDocumentoPago."','%Y-%m-%d'),vp_tipo_pago='".$tipoPago."',vp_pic_pago='".$nombreArchivo."',vp_fecha_pago=now(),vp_estado_viaje=6 where vp_codigo_pago like'%".$temp_codigo_pago."%' and vp_sector_destino=1";
			if($DEBUG_STATUS)
				echo '$sql-2::'.$sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	$sql = "update z_viajespasajero set vp_codigo_pago='".$nroDocPago."',vp_fecha_pago_en_banco=DATE_FORMAT('".$fechaDocumentoPago."','%Y-%m-%d'),vp_tipo_pago='".$tipoPago."',vp_pic_pago='".$nombreArchivo."',vp_fecha_pago=now(),vp_estado_viaje=6 where vp_codigo_pago like'%".$temp_codigo_pago."%' and vp_sector_destino<>1";
				if($DEBUG_STATUS)
					echo '$sql-2::'.$sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        	$codigoErr=1;        				
		        }	
		        else    
		        	mysqli_rollback($dbcon); 				
	        }	
			return $codigoErr;
		}


		public function getConductorsConCorrectDocuments($dbcon,$hora_viaje,$from_airport,$DEBUG_STATUS)
		{
			/*$sql = "select * from (
					select distinct u.u_id,u.u_name from z_users u,z_userdocs ud where u_is_email_verified=0 
					and ((u_celular is not null and u_celular!='') or (u_conventional is not null and u_conventional!=''))
					and u.u_id=ud.d_user and ud.d_document_name is not null  and ud.d_document_type=1 and ud.d_is_doc_verified=0) a,


					(select distinct u.u_id,u.u_name from z_users u,z_userdocs ud where u_is_email_verified=0 
					and ((u_celular is not null and u_celular!='') or (u_conventional is not null and u_conventional!=''))
					and u.u_id=ud.d_user and ud.d_document_name is not null  and ud.d_document_type=3 and ud.d_is_doc_verified=0) b,

					(select distinct u.u_id,u.u_name from z_users u,z_userdocs ud where u_is_email_verified=0 
					and ((u_celular is not null and u_celular!='') or (u_conventional is not null and u_conventional!=''))
					and u.u_id=ud.d_user and ud.d_document_name is not null  and ud.d_document_type=4 and ud.d_is_doc_verified=0) c,
					(select u.u_id,u.u_name from z_users u,z_automovil a where a.a_created_by=u.u_id and a_is_approved=0 and a_pic_automovil is not null) d
					where a.u_id=b.u_id and b.u_id=c.u_id and c.u_id=d.u_id";

			$conductors=array();
			$count=0;
			$capacity=3;
			$codigo_viaje=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$sql2="select 3-sum(vp.vp_nro_pasajeros) ctr,v_viaje_id from z_viajespasajero vp, z_sector s1,z_sector s2,z_viajes z 
						where z.v_viaje_id=vp.vp_viaje_id and vp.vp_sector_inicio=s1.id and vp.vp_sector_destino=s2.id and vp.vp_estado_viaje=2 
						and z.v_id_conductor=".$row["u_id"]." and date_format(vp.vp_fecha_salida,'%Y%m%d%h%i%s')=date_format('".$hora_viaje."','%Y%m%d%h%i%s') 	group by z.v_id_conductor";
					$result2 = mysqli_query($dbcon,$sql2);
					if(mysqli_num_rows($result2) > 0)  
		            {
						if($row2 = mysqli_fetch_assoc($result2)) 
						{
							$capacity = $row2["ctr"];
							$codigo_viaje=$row2["v_viaje_id"];
						}
					}
					$conductors[$count] = array($row["u_id"],$row["u_name"],$capacity,$codigo_viaje);
					$capacity=3;
					$codigo_viaje=0;
					$count++;
				}
			}
			return $conductors;*/

			$sql = "select * from (
					select distinct u.u_id,u.u_name from z_users u,z_userdocs ud where u_is_email_verified=0 
					and ((u_celular is not null and u_celular!='') or (u_conventional is not null and u_conventional!=''))
					and u.u_id=ud.d_user and ud.d_document_name is not null  and ud.d_document_type=1 and ud.d_is_doc_verified=0) a,


					(select distinct u.u_id,u.u_name from z_users u,z_userdocs ud where u_is_email_verified=0 
					and ((u_celular is not null and u_celular!='') or (u_conventional is not null and u_conventional!=''))
					and u.u_id=ud.d_user and ud.d_document_name is not null  and ud.d_document_type=3 and ud.d_is_doc_verified=0) b,

					(select distinct u.u_id,u.u_name from z_users u,z_userdocs ud where u_is_email_verified=0 
					and ((u_celular is not null and u_celular!='') or (u_conventional is not null and u_conventional!=''))
					and u.u_id=ud.d_user and ud.d_document_name is not null  and ud.d_document_type=4 and ud.d_is_doc_verified=0) c,
					(select u.u_id,u.u_name from z_users u,z_automovil a where a.a_created_by=u.u_id and a_is_approved=0 and a_pic_automovil is not null) d
					where a.u_id=b.u_id and b.u_id=c.u_id and c.u_id=d.u_id";

			$conductors=array();
			$count=0;
			$capacity=3;
			$codigo_viaje=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					if($from_airport==1)
					{
						$sqlCheckAvail = "select vp.* from z_viajespasajero vp,z_viajes z where vp.vp_viaje_id=z.v_viaje_id and
									date_format(vp.vp_fecha_salida,'%Y-%m-%d %h:%i:%s')=DATE_SUB(date_format('".$hora_viaje."','%Y%m%d%h%i%s'),INTERVAL 60 MINUTE) and
									vp.vp_sector_destino=1 and 
									z.v_id_conductor=".$row["u_id"]." and vp.vp_estado_viaje in (2,3,4);";
					}
					else
					{
						$sqlCheckAvail = "select vp.* from z_viajespasajero vp,z_viajes z where vp.vp_viaje_id=z.v_viaje_id and
									date_format(vp.vp_fecha_salida,'%Y-%m-%d %h:%i:%s')>DATE_SUB(date_format('".$hora_viaje."','%Y%m%d%h%i%s'),INTERVAL 150 MINUTE) and
									date_format(vp.vp_fecha_salida,'%Y-%m-%d %h:%i:%s')<DATE_ADD(date_format('".$hora_viaje."','%Y%m%d%h%i%s'),INTERVAL 150 MINUTE) and 
									date_format(vp.vp_fecha_salida,'%Y%m%d%h%i%s')!=date_format('".$hora_viaje."','%Y%m%d%h%i%s') and 
									z.v_id_conductor=".$row["u_id"]." and vp.vp_estado_viaje in (2,3,4);";
					}
					
					$resultCheckAvail = mysqli_query($dbcon,$sqlCheckAvail);
					if(mysqli_num_rows($resultCheckAvail) > 0)  
		            {
		            	if($from_airport==1)
						{
							$sql2="select 3-sum(vp.vp_nro_pasajeros) ctr,v_viaje_id from z_viajespasajero vp, z_sector s1,z_sector s2,z_viajes z 
								where z.v_viaje_id=vp.vp_viaje_id and vp.vp_sector_inicio=s1.id and vp.vp_sector_destino=s2.id and vp.vp_estado_viaje=2 
								and z.v_id_conductor=".$row["u_id"]." and date_format(vp.vp_fecha_salida,'%Y%m%d%h%i%s')=date_format('".$hora_viaje."','%Y%m%d%h%i%s') 	group by z.v_id_conductor";
							$result2 = mysqli_query($dbcon,$sql2);
							if(mysqli_num_rows($result2) > 0)  
				            {
								if($row2 = mysqli_fetch_assoc($result2)) 
								{
									$capacity = $row2["ctr"];
									$codigo_viaje=$row2["v_viaje_id"];
								}
							}

							$conductors[$count] = array($row["u_id"],$row["u_name"],$capacity,$codigo_viaje);
							$capacity=3;
							$codigo_viaje=0;
							$count++;
						}
		            }
		            else
		            {
						if($from_airport==0)
						{							
							$sql2="select 3-sum(vp.vp_nro_pasajeros) ctr,v_viaje_id from z_viajespasajero vp, z_sector s1,z_sector s2,z_viajes z 
								where z.v_viaje_id=vp.vp_viaje_id and vp.vp_sector_inicio=s1.id and vp.vp_sector_destino=s2.id and vp.vp_estado_viaje=2 
								and z.v_id_conductor=".$row["u_id"]." and date_format(vp.vp_fecha_salida,'%Y%m%d%h%i%s')=date_format('".$hora_viaje."','%Y%m%d%h%i%s') 	group by z.v_id_conductor";
							$result2 = mysqli_query($dbcon,$sql2);
							if(mysqli_num_rows($result2) > 0)  
				            {
								if($row2 = mysqli_fetch_assoc($result2)) 
								{
									$capacity = $row2["ctr"];
									$codigo_viaje=$row2["v_viaje_id"];
								}
							}

							$conductors[$count] = array($row["u_id"],$row["u_name"],$capacity,$codigo_viaje);
							$capacity=3;
							$codigo_viaje=0;
							$count++;
						}
					}
				}
			}
			return $conductors;
		}

		public function viajesPendientesAsignarList($dbcon,$DEBUG_STATUS)
		{
			/*$sql="select date_format(vp.vp_fecha_salida,'%h:%i') hr_viaje,count(*) ctr from z_viajespasajero vp where vp.vp_estado_viaje=2 and 
					date_format(vp.vp_fecha_salida,'%Y%m%d%h%i%s')>now() 
					group by(date_format(vp.vp_fecha_salida,'%h:%i'))";*/
			$sql="select a.display_hr_viaje,a.fecha_salida,a.ctr,a.vp_sector_inicio from (
			select date_format(vp.vp_fecha_salida,'%d-%m-%Y %H:%i:%s') display_hr_viaje,date_format(vp.vp_fecha_salida,'%Y%m%d%H%i%s') fecha_salida,
					count(*) ctr,vp_sector_inicio from z_viajespasajero vp where vp.vp_estado_viaje=2 and vp.vp_viaje_id=0 and 
					date_format(vp.vp_fecha_salida,'%Y%m%d%h%i%s')>now() 
					group by(date_format(vp.vp_fecha_salida,'%d-%m-%Y %h:%i:%s')),vp_sector_inicio
					) a order by a.display_hr_viaje asc";
			$viajesPendientesAsignar=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$viajesPendientesAsignar[$count] = array($row["display_hr_viaje"],$row["fecha_salida"],$row["ctr"],$row["vp_sector_inicio"]);
					$count++;
				}
			}
			return $viajesPendientesAsignar;
		}

		public function asignarConductorParaViaje($dbcon,$id_pagos_list,$id_conductor,$total_asientos,$DEBUG_STATUS)
		{
			$codigoErr=0;
			$conductorArr=explode(":", $id_conductor);
			$conductor=$conductorArr[0];
			$viaje_id=$conductorArr[2];
			$id_pagos = explode(",",$id_pagos_list);
			$str_id_pagos="";
			for($t=0;$t<count($id_pagos);$t++)
			{
				$str_id_pagos=$str_id_pagos."'".$id_pagos[$t]."',";
			}
			$str_id_pagos=$str_id_pagos."'0'";
			//echo $str_id_pagos.'<br>';
			//echo $_SESSION['userid'].'<br>';
			mysqli_autocommit($dbcon,FALSE);
			if($viaje_id==0)
			{
				$sql = "insert into z_viajes(v_id_conductor,v_estado,v_created_by,v_created_on) 
						values(".$conductor.",2,".$_SESSION['userid'].",now())";
				if($DEBUG_STATUS)
					echo '$sql-2::'.$sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	$last_id = mysqli_insert_id($dbcon);
		        	$sql = "update z_viajespasajero set vp_viaje_id=".$last_id." where vp_id in(".$str_id_pagos.")";
					if($DEBUG_STATUS)
						echo '$sql-2::'.$sql.'<br>';
			        if(mysqli_query($dbcon,$sql))
			        {
			        	mysqli_commit($dbcon);
			        	$codigoErr=1;        				
			        }	
			        else    
			        	mysqli_rollback($dbcon); 				
		        }	
	    	}
	    	else
	    	{
	    		$sql = "update z_viajespasajero set vp_viaje_id=".$viaje_id." where vp_id in(".$str_id_pagos.")";
				if($DEBUG_STATUS)
					echo '$sql-2::'.$sql.'<br>';
		        if(mysqli_query($dbcon,$sql))
		        {
		        	mysqli_commit($dbcon);
		        	$codigoErr=1;        				
		        }	
		        else    
		        	mysqli_rollback($dbcon); 
	    	}
	        //echo $codigoErr.'<br>';
			return $codigoErr;
		}

		public function getCurDate($dbcon,$DEBUG_STATUS)
		{
			$sql="select date_format(now(),'%Y-%m-%d') dt_time from dual";
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result))
				{
					$dt_time =$row["dt_time"];
				}
			}
			return $dt_time;
		}

		


	}	
?>
