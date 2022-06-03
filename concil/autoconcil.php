<?php
	
    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'controladorDB.php';
    $controladorDB = new controladorDB();
    mysqli_autocommit($databasecon,FALSE);

    //echo "INICIO PROCESO AUTOCONCILIACION<br><br>";
    
    $sql="select date_format(now(),'%Y%m%d') curr_dt";
    //$sql="select date_format(DATE_ADD(now(), INTERVAL -28 DAY),'%Y%m%d') curr_dt";
    $resultSet = mysqli_query($databasecon,$sql);
    if(mysqli_num_rows($resultSet) > 0)  
    {
        while($row = mysqli_fetch_assoc($resultSet)) 
        {
            $fecha_venta=$row["curr_dt"];
        }
    }

	$port = 22;
	$connection = NULL;

    $param_fecha_conciliacion=$fecha_venta;
    $proveedores = $controladorDB->listaProveedores($databasecon,0,$DEBUG_STATUS);
    //echo count($proveedores);
    //for($a=0;$a<1;$a++)
    for($a=0;$a<count($proveedores);$a++)
    {
    	//echo 'i::'.$a.'<br>';
    	$fileCtr=0;
    	$result="";
    	$estadoConcil=0;
    	$param_integrador=$proveedores[$a][0];


    	$sql="select id, id_integrador, ip_servidor, ruta, usuario, clave from c_config_file_server where id_integrador=".$param_integrador." and habilitado=1";
		$resultSet = mysqli_query($databasecon,$sql);
		if(mysqli_num_rows($resultSet) > 0)  
		{
		    while($row = mysqli_fetch_assoc($resultSet)) 
		    {
		        $host=$row["ip_servidor"];
		        $remote_file_dir="/".$row["ruta"];
		        $username=$row["usuario"];
		        $password=$row["clave"];
		    }
		}

    	
    	$result=$result.  $proveedores[$a][1].'<br>';
		$estadoConcil=$controladorDB->estadoConciliacion($databasecon,$fecha_venta,$proveedores[$a][0],$DEBUG_STATUS);
		//$estadoConcil=0;
		$result=$result.  'ESTADO CONCIL:'.$estadoConcil.'<br>';
		if($estadoConcil==3)
            $result=$result.  "CONCILIADO<br>";
        else if($estadoConcil==6 || $estadoConcil==8)
            $result=$result.  "CONCILIACION INCONSISTENTE<br>";
        else if($estadoConcil==7)
            $result=$result.  "CONCILIACION CERRADO FORZADA<br>";
        else
        {
            $result=$result.  "CONCILIACION PENDIENTE. PROCEDA CON CONCILIACION AUTOMATICA<br>";


            
            
            if(!empty($host) && !empty($remote_file_dir) && !empty($username) && !empty($password))
            {
		        $cnt_conciliacion=0;
		        $cnt_conciliacion_err=0;
		        $monto_txn_integradores=0;
		        $monto_txn_ventas=0;
		        $txn_integradores=$controladorDB->listaTxnIntegradores($databasecon,$param_fecha_conciliacion,$param_integrador,$DEBUG_STATUS);
		        $txn_ventas=$controladorDB->listaTxnVentas($databasecon,$param_fecha_conciliacion,$param_integrador,$DEBUG_STATUS);
		        if(count($txn_ventas)>0)
		        {
		        	//consult ventas internas
		        }
		        if(count($txn_integradores)==0)
	        	{
	        		//$result=$result."NO HAY ARCHIVO CARGADO<br>";
	        		$result=$result.  "NO HAY ARCHIVO CARGADO<br>";
	        		//$remote_file_path = "/C:/hussain/PERSONAL/Proyectos/CONCILIACION/INT0004_20190102.txt";
					//$remote_file_dir = "/C:/hussain/PERSONAL/Proyectos/CONCILIACION";
					try 
					{
					    if (!function_exists("ssh2_connect"))
					        die('Function ssh2_connect does not exist.');

					    $connection = ssh2_connect($host, $port);
					    if(!$connection)
					    {
					        throw new \Exception("Could not connect to $host on port $port");
					    }
					    $auth  = ssh2_auth_password($connection, $username, $password);
					    if(!$auth)
					    {
					        throw new \Exception("Could not authenticate with username $username and password ");  
					    }
					    $sftp = ssh2_sftp($connection);
					    
					    if(!$sftp)
					    {
					        throw new \Exception("Could not initialize SFTP subsystem.");  
					    }
					    
					    //$pattern = "/INT".ltrim($param_integrador,"0")."_".$param_fecha_conciliacion.".txt/";
					    //$pattern = "/INT".ltrim('4',"0")."_20190102.txt/";
					    $pattern = "/INT".str_pad($param_integrador,4,"0",STR_PAD_LEFT)."_".$param_fecha_conciliacion.".txt/";
					    //$pattern = "/INT0004_20190102.txt/";
					    $result=$result.  'PATTERN:'.$pattern.'<br>';
					    
					    $sftp_fd = intval($sftp);
					    //echo $sftp_fd.'<br>';
					    $handle = opendir("ssh2.sftp://".$sftp.$remote_file_dir);
					    //echo "Directory handle: $handle".'<br>';
					    //echo "Entries:".'<br>';
					    while (false != ($entry = readdir($handle)))
					    {
					        //echo "$entry".'<br>';
					        if(preg_match($pattern, $entry))
					        {
					        	$fileCtr++;
					            $fecha_conciliacion=substr(explode("_",$entry)[1],0,8);
					            $antegrador_archivo=substr($entry,3,4);
					            $linectr=1;
					            $data_cantidad_registros_total=0;
					            //echo "$entry".'<br>';
					            $stream = fopen("ssh2.sftp://".$sftp.$remote_file_dir.'/'.$entry, 'r');
					            if (! $stream) 
					            {
					                throw new \Exception("Could not open file: ");
					            }


					            $sql="select id id_conciliacion from c_conciliacion where DATE_FORMAT(fecha_venta,'%Y%m%d')='".$fecha_conciliacion."' and id_integrador=".$antegrador_archivo." and habilitado in (1,3)";
					            $ad_conciliacion=0;
					            $resultSet = mysqli_query($databasecon,$sql);
					            if(mysqli_num_rows($resultSet) > 0)  
					            {
					                while($row = mysqli_fetch_assoc($resultSet)) 
					                {
					                    $ad_conciliacion=$row["id_conciliacion"];
					                }
					            }

					            //DESHABILITAR LOS DATOS DE CONCILIACION ANTERIOR
					            $sql="update c_conciliacion set habilitado=0 where id=".$ad_conciliacion;
					            if(mysqli_query($databasecon,$sql))
					            {
					                $updStatus = 1;
					            }
					            $sql="update c_contenido_archivo_conciliacion set habilitado=0 where id_conciliacion=".$ad_conciliacion;
					            if(mysqli_query($databasecon,$sql))
					            {
					                $updStatus = 1;
					            }

					            $sql="update c_ventas_integrador set habilitado=0 where id_conciliacion=".$ad_conciliacion;
					            if(mysqli_query($databasecon,$sql))
					            {
					                $updStatus = 1;
					            }

					            $sql="update c_ventas_interna set id_conciliacion=0 where id_conciliacion=".$ad_conciliacion;
					            if(mysqli_query($databasecon,$sql))
					            {
					                $updStatus = 1;
					            }
					            while (($line_data = fgets($stream, 4096)) !== false) 
					            {
					                //echo $line_data.'<br>';

					                if(strcmp(substr($line_data,0,1),"C")==0)
					                {
					                    //VALIDAR SI TAMANO DE CABECERA ES CORRECTO
					                    if(strlen($line_data)-2==27)
					                    {
					                        $cabecera_id_integrador=ltrim(substr($line_data,1,4),"0");
					                        $cabecera_fecha=ltrim(substr($line_data,5,8),"0");
					                        $cabecera_cantidad_registros=ltrim(substr($line_data,13,4),"0");
					                        $cabecera_monto_total=round((ltrim(substr($line_data,17,10),"0")/100),2);
					                        //echo $cabecera_id_integrador.'<br>';
					                        //echo $cabecera_fecha.'<br>';
					                        //echo $cabecera_cantidad_registros.'<br>';
					                        //echo $cabecera_monto_total.'<br>';

					                        //INSERT REGISTRO RESUMEN DE ARCHIVO CONCILIACION
					                        $sql="insert into c_conciliacion(id_integrador, monto,cantidad, fecha_venta, fecha_carga_archivo, forma_carga_archivo, habilitado) values(".$cabecera_id_integrador.",".$cabecera_monto_total.",".$cabecera_cantidad_registros.",DATE_FORMAT('".$cabecera_fecha."','%Y%m%d'),now(),1,1)";  
					                            
					                        if(mysqli_query($databasecon,$sql))
					                        {
					                            $updStatus = 1;
					                            $last_concil_id = mysqli_insert_id($databasecon);
					                        }
					                        else
					                        {
					                            $updStatus = 0;
					                            $result=$result.  "ERROR:".$sql."<br>";
					                        }
					                    }
					                }

					                // INSERT CONTENIDO DE ARCHIVO CONCILIACION
					                $sql="insert into c_contenido_archivo_conciliacion(id_conciliacion,id_integrador, nro_linea,contenido, fecha_venta, nombre_archivo, habilitado) values(".$last_concil_id.",".$antegrador_archivo.",".$linectr.",'".$line_data."','".$fecha_conciliacion."','".$entry."',1)";
					                if(mysqli_query($databasecon,$sql))
					                {
					                    $updStatus = 2;
					                }
					                $linectr++; 
					            }


					            if($updStatus==2)
					            {
					                //LEAR TODO CONTENIDO DE ARCHIVO DESDE BDD Y PROCESAR
					                $sql="select * from c_contenido_archivo_conciliacion where fecha_venta='".$fecha_conciliacion."' and id_integrador=".$antegrador_archivo." and habilitado =1 order by nro_linea";
					                $registros=array();
					                $count=0;
					                $resultSet = mysqli_query($databasecon,$sql);
					                if(mysqli_num_rows($resultSet) > 0)  
					                {
					                    while($row = mysqli_fetch_assoc($resultSet)) 
					                    {
					                        $registros[$count] = array($row["id"],$row["id_integrador"],$row["nro_linea"],$row["contenido"],$row["fecha_venta"],$row["nombre_archivo"]);
					                        $count++;
					                    }
					                }

					                //PARA CADA REGISTRO OBTENIDO DEL ARCHIVO CONCILIACION DESDE BDD, IDENTIFICAR CADA CAMPO Y GUARDAR EN BDD
					                for($t=0;$t<count($registros);$t++)
					                {

					                    //VALIDAR SI ES CABECERA
					                    if(strcmp(substr($registros[$t][3],0,1),"C")==0)
					                    {
					                        //VALIDAR SI TAMANO DE CABECERA ES CORRECTO
					                        if(strlen($registros[$t][3])-2!=27)
					                        {
					                            $result= $result."TAMANO DE CABECERA INCORRECTO. TAMANO DEBE SER 27.".$registros[$t][3];
					                            //echo "TAMANO DE CABECERA INCORRECTO. TAMANO DEBE SER 27.".$registros[$t][3];
					                            //echo "TAMANO DE CABECERA INCORRECTO. TAMANO DEBE SER 27.".$registros[$a][3]."<br>";
					                            //echo strlen($registros[$a][3])."<br>";
					                            $updStatus=0;
					                        }
					                        else
					                        {
					                            $cabecera_id_integrador=ltrim(substr($registros[$t][3],1,4),"0");
					                            $cabecera_fecha=ltrim(substr($registros[$t][3],5,8),"0");
					                            $cabecera_cantidad_registros=ltrim(substr($registros[$t][3],13,4),"0");
					                            $cabecera_monto_total=round((ltrim(substr($registros[$t][3],17,10),"0")/100),2);
					                            $updStatus=2;
					                        } 
					                    }
					                    //VALIDAR SI ES DATA
					                    else if(strcmp(substr($registros[$t][3],0,1),"D")==0)
					                    {
					                        $data_cantidad_registros_total++;

					                        //VALIDAR SI TAMANO DE CABECERA ES CORRECTO
					                        if(strlen($registros[$t][3])-2!=68)//TODO-get tamano total de data instead of 68
					                        {
					                            $result= $result."TAMANO DE DATA INCORRECTO. TAMANO DEBE SER 68.".$registros[$t][3];
					                            //echo "TAMANO DE DATA INCORRECTO. TAMANO DEBE SER 68.".$registros[$t][3];
					                            //echo "TAMANO DE DATA INCORRECTO. TAMANO DEBE SER 68.".$registros[$a][3]."<br>";//TODO-get tamano total de data instead of 68
					                            //echo strlen($registros[$a][3])."<br>";
					                            $updStatus=0;
					                        }
					                        else
					                        {
					                            $data_txn_integrador=ltrim(substr($registros[$t][3],1,20),"0");
					                            $data_id_integrador=ltrim(substr($registros[$t][3],21,4),"0");
					                            $data_id_canal=ltrim(substr($registros[$t][3],25,4),"0");
					                            $data_id_plan=ltrim(substr($registros[$t][3],29,15),"0");
					                            $data_monto=round((ltrim(substr($registros[$t][3],44,10),"0")/100),2);
					                            $data_fecha_venta=ltrim(substr($registros[$t][3],54,14),"0");

					                            //$data_monto_total=$data_monto_total+$data_monto;

					                            //GUARDAR EN BDD CADA DETALLE DE TXN
					                            $sql="insert into c_ventas_integrador(id_conciliacion, id_txn_integrador,id_integrador, id_canal,id_plan, monto,fecha_venta, fecha_carga_archivo, forma_carga_archivo, habilitado) values(".$last_concil_id.",".$data_txn_integrador.",".$data_id_integrador.",".$data_id_canal.",'".$data_id_plan."',".$data_monto.",DATE_FORMAT('".$data_fecha_venta."','%Y%m%d%H%i%s'),now(),1,1)";  
					                            
					                            if(mysqli_query($databasecon,$sql))
					                            {
					                                $updStatus = 2;
					                            }
					                            else
					                            {
					                                $updStatus = 0;
					                                $result=$result. "ERROR:".$sql."<br>";
					                            }
					                        }
					                    }
					                }
					            }


					            //ENVIAR ESTADO DE CARGA ARCHIVO CONCILIACION - EXITOSO
					            if($updStatus==2)
					            {
					                //mysqli_commit($databasecon);
					                $result=$result."ARCHIVO CARGADO CORRECTAMENTE<br>";
					                //echo "ARCHIVO CARGADO CORRECTAMENTE<br>";
					                //echo "ARCHIVO CARGADO CORRECTAMENTE<br>";                
					            }
					            else
					                mysqli_rollback($databasecon);

					            if (!feof($stream)) 
					            {
					                $result=$result.  "Error: unexpected fgets() fail\n";
					            }

					            //$contents = stream_get_contents($stream);
					            //echo $contents;
					            //echo "<pre>"; 
					            //print_r($contents); 
					            //echo "</pre>";
					            @fclose($stream);
					            $connection = NULL;
					        }				        
					    }
					    if($fileCtr==0)
				        {
				        	$result=$result."NO HAY ARCHIVO EN SFTP<br>";
				        	//echo "NO HAY ARCHIVO EN SFTP<br>";
				        }				   
					} 
					catch (Exception $e) 
					{
					    $result=$result.  "Error due to :".$e->getMessage();
					}

					//Carga archivo end
	        	}


	        	$txn_integradores=$controladorDB->listaTxnIntegradores($databasecon,$param_fecha_conciliacion,$param_integrador,$DEBUG_STATUS);
		        $txn_ventas=$controladorDB->listaTxnVentas($databasecon,$param_fecha_conciliacion,$param_integrador,$DEBUG_STATUS);
		        
		        if(count($txn_integradores)>0)
		        	$ad_conciliacion=$txn_integradores[0][7];
		        else
		        	$ad_conciliacion=0;

	        	$sql="update c_ventas_integrador set habilitado=1 where id_conciliacion=".$ad_conciliacion;
		        if(mysqli_query($databasecon,$sql))
		        {
		            $updStatus = 1;
		        }

		        $sql="update c_ventas_interna set id_conciliacion=1 where id_conciliacion=".$ad_conciliacion;
		        if(mysqli_query($databasecon,$sql))
		        {
		            $updStatus = 1;
		        }


		        //VALIDAR CANTIDAD REGISTROS
		        $result=$result.  'TXN_INTEGRADORES::'.count($txn_integradores).'<br>';
		        $result=$result.  'TXN INTERNAS::'.count($txn_ventas).'<br>';
		        if(count($txn_integradores)>0)
		        {
			        if(count($txn_integradores)==count($txn_ventas))
			        {
			            $result=$result."CANTIDAD DE TRANSACCIONES:IGUAL<br>";
			            //echo "CANTIDAD DE TRANSACCIONES:IGUAL<br>";
			        }
			        else
			        {
			            $result=$result."CANTIDAD DE TRANSACCIONES:DIFERENTES<br>";
			            //echo "CANTIDAD DE TRANSACCIONES:DIFERENTES<br>";
			            $count=$controladorDB->actualizarEstadoConciliacion($databasecon,4, $ad_conciliacion,$fecha_venta,$DEBUG_STATUS);
			            //$result= "ERROR EN CONCILIACION : CANTIDAD DE TRANSACCIONES:DIFERENTES";   
			        }
			    }
		        //SUMAR MONTO DESDE REGISTROS DE ARCHIVO CONCILIACION GUARDADO EN BDD
		        for($x=0;$x<count($txn_integradores);$x++)
		        {
		            $monto_txn_integradores=$monto_txn_integradores+$txn_integradores[$x][4];
		        }
		        //SUMAR MONTO DESDE VENTAS REGISTRADOS EN SISTEMA INTERNA
		        for($y=0;$y<count($txn_ventas);$y++)
		        {
		            $monto_txn_ventas=$monto_txn_ventas+$txn_ventas[$y][5];
		        }

		        //VALIDAR LOS MONTOS
		        if($monto_txn_integradores>0)
		        {
			        if($monto_txn_integradores==$monto_txn_ventas)
			        {
			            $result=$result."MONTO DE TRANSACCIONES:IGUAL<br>";
			            //echo "MONTO DE TRANSACCIONES:IGUAL<br>";
			        }
			        else
			        {
			            $result=$result."MONTO DE TRANSACCIONES:DIFERENTES<br>";
			            //echo "MONTO DE TRANSACCIONES:DIFERENTES<br>";
			            $count=$controladorDB->actualizarEstadoConciliacion($databasecon,5, $ad_conciliacion,$fecha_venta,$DEBUG_STATUS);
			            //$result= "ERROR EN CONCILIACION : MONTO DE TRANSACCIONES:DIFERENTES";   
			        }
		        }
		        //REALIZAR CONCILIACION
		        if(count($txn_integradores)>0)
		        {
			        for($z=0;$z<count($txn_integradores);$z++)
			        {
			            $count=$controladorDB->realizarConciliacion($databasecon,$txn_integradores[$z],$fecha_venta,$DEBUG_STATUS);
			            if($count==1)
			                $cnt_conciliacion++;
			            else
			                $cnt_conciliacion_err++;
			        }
			        $result=$result."CANTITAD DE TRANSACCIONES CONCILIADO:".$cnt_conciliacion."<br>";
			        //echo "CANTITAD DE TRANSACCIONES CONCILIADO:".$cnt_conciliacion."<br>";
			        $result=$result."CANTITAD DE TRANSACCIONES NO CONCILIADO:".$cnt_conciliacion_err."<br>";
			        //echo "CANTITAD DE TRANSACCIONES NO CONCILIADO:".$cnt_conciliacion_err."<br>";
		        }
		        //ACTUALIZAR ESTADO DE CONCILIACION
		        if(count($txn_integradores)>0)
		        {
		        	if(count($txn_integradores)==$cnt_conciliacion && count($txn_ventas)==$cnt_conciliacion)
			        {
			            $count=$controladorDB->actualizarEstadoConciliacion($databasecon,3,$ad_conciliacion,$fecha_venta,$DEBUG_STATUS);
			            $result=$result. "CONCILIACION REALIZADO EXITOSAMENTE<br>";
			            //echo "CONCILIACION REALIZADO EXITOSAMENTE<br>";
			        }
			        else
			        {
			            $count=$controladorDB->actualizarEstadoConciliacion($databasecon,6, $ad_conciliacion,$fecha_venta,$DEBUG_STATUS);
			            $result=$result. "ERROR EN CONCILIACION : ALGUNOS REGISTROS NO FUERON CONCILIADOS POR DIFERENCIA EN DATOS<br>";   
			            //echo "ERROR EN CONCILIACION : ALGUNOS REGISTROS NO FUERON CONCILIADOS POR DIFERENCIA EN DATOS<br>";   
			        }
		        }
		        else
		        {
		        	$result=$result.  "NO HAY NADA QUE CONCILIAR<br>";   
		        }		        
	        }
	        else
	        {
	        	$result=$result."NO HAY DETALLES DE UBICACION ARCHIVO PARA INTEGRADOR:".$proveedores[$a][1]."<br>";
	        	//echo "NO HAY DETALLES DE UBICACION ARCHIVO PARA INTEGRADOR:".$proveedores[$a][1]."<br>";
	        }
	        
	        
        }
        //$result=$result.  '====================================<br>';
        //echo $result;


        $sql="insert into c_log_concil_auto(ctr,id_integrador,fecha_venta,fecha_actualizacion, resumen) values(".$a.",".$param_integrador.",DATE_FORMAT('".$fecha_venta."','%Y%m%d%H%i%s'),now(),'".$result."')";
        if(mysqli_query($databasecon,$sql))
        {
        	$result="";
        	mysqli_commit($databasecon);
        }
    }
?>