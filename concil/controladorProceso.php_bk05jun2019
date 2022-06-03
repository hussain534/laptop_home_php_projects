<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    //require 'doUpload.php';
    require 'controladorDB.php';
    $controladorDB = new controladorDB();
    //$commoncontroladorDB = new commoncontroladorDB();
    $adminUserIdConstant=1;

    //CREAR NUEVA CUENTA
    if($_GET["proceso"]==0 && $_GET["task"]==0)
    {
        //OK
        $err = $controladorDB->registerUser($databasecon,$_POST["userNombre"],$_POST["userEmail"],$_POST["userPwd"],$_POST["userTelefono"],$_POST["userCelular"],
            $_POST["userUbicacion"],$_POST["userPerfil"],$_POST["id_integrador"],$DEBUG_STATUS);    
        //echo $err.'<br>';
        
        //$nextView='crearUsuario.php?err='.$err;
        $nextView='crearCuenta.php?err='.$err;
        header("Location:$nextView");
    }
    //INICIAR SESSION
    else if($_GET["proceso"]==0 && $_GET["task"]==1)
    {    
        //OK
        $err = $controladorDB->loginUser($databasecon,$_POST['userEmail'],$_POST['userPwd'],$DEBUG_STATUS);   
        if($err==1)
        {
            $url='dashboard.php?err='.$err;
        }
        else if($err==0)
        {
            $url='index.php?err='.$err;
        }
        else
        {
            $url='index.php?err='.$err;
        }
        header("Location:$url");
    }
    //RECUPERAR CLAVE
    else if($_GET["proceso"]==0 && $_GET["task"]==2)
    {    
        $err = $controladorDB->recuperarClave($databasecon,$_POST['user_email'],$DEBUG_STATUS);    
        //echo 'FINAL:'.$err.'<br>';
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN RECUPERAR CLAVE. INTENTA MAS TARDE</center>";                
        }
        else if($err==2)
        {
            $_SESSION["message"]="<center>CLAVE RECUPERADO PERO ERROR EN ENVIAR EMAIL.</center>";
        }
        else if($err==3)
        {
            $_SESSION["message"]='<center>EMAIL- '.$_POST['user_email'].' NO SE ENCUENTRA REGISTRADO EN SISTEMA.INGRESA DATOS CORRECTOS.</center>';
        }
        else
        {
            $_SESSION["message"]="<center>CLAVE RECUPERADO Y ENVIADO A SU CORREO. PORFA REVISAR SU CORREO Y USA LA CLAVE ENVIADO PARA INGRESAR EN SISTEMA</center>";
        }
        $url='recuperarClave.php';
        header("Location:$url");
    }
    //CAMBIAR CLAVE
    else if($_GET["proceso"]==0 && $_GET["task"]==3)
    {    
        $err = $controladorDB->cambiarClave($databasecon,$_POST['clave_anterior'],$_POST['clave_nuevo'],$DEBUG_STATUS);    
        
        $url='admin-usuario.php?err='.$err;
        header("Location:$url");
    }
    //ACTUALIZAR DATA DEL INTEGRADOR
    else if($_GET["proceso"]==1 && $_GET["task"]==0)
    {   
        $err = $controladorDB->actualizarProveedorData($databasecon,$_POST["id"],$_POST["ruc"],$_POST["nombre"],$_POST["email"],$_POST["contacto"],$_POST["emailAdicionales"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>INTEGRADOR DATA ACTUALIZADO</center>";
        }

        $url='proveedores.php';
        header("Location:$url");
    }
    //DESHABILITAR INTEGRADOR
    else if($_GET["proceso"]==1 && $_GET["task"]==1)
    {   
        $err = $controladorDB->deshabilitarProveedorData($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>INTEGRADOR DATA ELIMINADO</center>";
        }

        $url='proveedores.php';
        header("Location:$url");
    }
    //ACTUALIZAR DATA DEL CANAL
    else if($_GET["proceso"]==2 && $_GET["task"]==0)
    {   
        $err = $controladorDB->actualizarCanalData($databasecon,$_POST["iid"],$_POST["cid"],$_POST["nombre"],$_POST["email"],$_POST["contacto"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>CANAL DATA ACTUALIZADO</center>";
        }

        $url='canales.php?id='.$_POST["iid"];
        header("Location:$url");
    }
    //DESHABILITAR CANAL
    else if($_GET["proceso"]==2 && $_GET["task"]==1)
    {   
        $err = $controladorDB->deshabilitarCanalData($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>CANAL DATA ELIMINADO</center>";
        }

        $url='canales.php?id='.$_POST["iid"];
        header("Location:$url");
    }
    //CARGAR ARCHIVO CONCILIACION
    else if($_GET["proceso"]==3 && $_GET["task"]==0)
    {   
        $updStatus = 0;
        $linectr=1;
        $fecha_conciliacion=str_replace("-","",$_POST["fecha_archivo"]);
        $_SESSION["FECHA_CONCILIACION"]=$fecha_conciliacion;
        $_SESSION["INTEGRADOR"]=$_POST["integrador_carga"];
        $fecha_archivo=substr(explode("_",$_FILES["fileToUpload"]["name"])[1],0,8);
        $integrador_archivo=substr($_FILES["fileToUpload"]["name"],3,4);
        mysqli_autocommit($databasecon,FALSE);
        $cabecera_monto_total=0;
        $data_monto_total=0;
        $cabecera_cantidad_registros=0;
        $data_cantidad_registros_total=0;
        //$fecha_carga_archivo=date("YmdHis");
        $sql="select now() curr_dt from dual";
        $resultSet = mysqli_query($databasecon,$sql);
        if(mysqli_num_rows($resultSet) > 0)  
        {
            while($row = mysqli_fetch_assoc($resultSet)) 
            {
                $fecha_carga_archivo=$row["curr_dt"];
            }
        }

        //VALIDAR SI FECHA SELECCIONADO ES MISMA DEL FECHA INDICADO EN NOMBRE DE ARCHIVO CONCILIACION
        if(strcmp($fecha_conciliacion, $fecha_archivo)==0)
        {
            //VALIDAR SI INTEGRADOR SELECCIONADO ES MISMA DEL INTEGRADOR INDICADO EN NOMBRE DE ARCHIVO CONCILIACION
            if(strcmp($integrador_archivo, str_pad($_POST["integrador_carga"],4,"0",STR_PAD_LEFT))==0)
            {
                $file=file($_FILES["fileToUpload"]["tmp_name"]);

                //BUSCAR SI EXISTE TXNs DE INTEGRADOR y CONCILIACION REALIZADA PARA MISMO FECHA SELECCIONADO
                $sql="select id id_conciliacion from c_conciliacion where DATE_FORMAT(fecha_venta,'%Y%m%d')='".$fecha_conciliacion."' and id_integrador=".$_POST["integrador_carga"]." and habilitado in (1,3)";
                $id_conciliacion=0;
                $resultSet = mysqli_query($databasecon,$sql);
                if(mysqli_num_rows($resultSet) > 0)  
                {
                    while($row = mysqli_fetch_assoc($resultSet)) 
                    {
                        $id_conciliacion=$row["id_conciliacion"];
                    }
                }

                //DESHABILITAR LOS DATOS DE CONCILIACION ANTERIOR
                $sql="update c_conciliacion set habilitado=0 where id=".$id_conciliacion;
                if(mysqli_query($databasecon,$sql))
                {
                    $updStatus = 1;
                }
                $sql="update c_contenido_archivo_conciliacion set habilitado=0 where id_conciliacion=".$id_conciliacion;
                if(mysqli_query($databasecon,$sql))
                {
                    $updStatus = 1;
                }

                $sql="update c_ventas_integrador set habilitado=0 where id_conciliacion=".$id_conciliacion;
                if(mysqli_query($databasecon,$sql))
                {
                    $updStatus = 1;
                }

                $sql="update c_ventas_interna set id_conciliacion=0 where id_conciliacion=".$id_conciliacion;
                if(mysqli_query($databasecon,$sql))
                {
                    $updStatus = 1;
                }

                //PARA CADA LINEA EN NUEVA ARCHIVO CONCILIACION
                foreach($file as $line_data)
                {
                    //VALIDAR SI ES CABECERA
                    if(strcmp(substr($line_data,0,1),"C")==0)
                    {
                        //VALIDAR SI TAMANO DE CABECERA ES CORRECTO
                        if(strlen($line_data)-2==27)
                        {
                            $cabecera_id_integrador=ltrim(substr($line_data,1,4),"0");
                            $cabecera_fecha=ltrim(substr($line_data,5,8),"0");
                            $cabecera_cantidad_registros=ltrim(substr($line_data,13,4),"0");
                            $cabecera_monto_total=round((ltrim(substr($line_data,17,10),"0")/100),2);

                            //INSERT REGISTRO RESUMEN DE ARCHIVO CONCILIACION
                            $sql="insert into c_conciliacion(id_integrador, monto,cantidad, fecha_venta, fecha_carga_archivo, forma_carga_archivo, habilitado) values(".$cabecera_id_integrador.",".$cabecera_monto_total.",".$cabecera_cantidad_registros.",DATE_FORMAT('".$cabecera_fecha."','%Y%m%d'),now(),1,1)";  
                                
                            if(mysqli_query($databasecon,$sql))
                            {
                                $updStatus = 1;
                                $_SESSION["last_concil_id"] = mysqli_insert_id($databasecon);
                            }
                            else
                            {
                                $updStatus = 0;
                                //echo "ERROR:".$sql."<br>";
                            }
                        }
                    }

                    // INSERT CONTENIDO DE ARCHIVO CONCILIACION
                    $sql="insert into c_contenido_archivo_conciliacion(id_conciliacion,id_integrador, nro_linea,contenido, fecha_venta, nombre_archivo, habilitado) values(".$_SESSION["last_concil_id"].",".$_POST["integrador_carga"].",".$linectr.",'".$line_data."','".$fecha_conciliacion."','".$_FILES["fileToUpload"]["name"]."',1)";
                    if(mysqli_query($databasecon,$sql))
                    {
                        $updStatus = 2;
                    }
                    $linectr++;                    
                }


                //VALIDAR SI LOS TAREAS ANTERIORES SE EJECUTARON EXITOSAMENTE
                if($updStatus==2)
                {
                    //LEAR TODO CONTENIDO DE ARCHIVO DESDE BDD Y PROCESAR
                    $sql="select * from c_contenido_archivo_conciliacion where fecha_venta='".$fecha_conciliacion."' and id_integrador=".$_POST["integrador_carga"]." and habilitado =1 order by nro_linea";
                    $registros=array();
                    $count=0;
                    $result = mysqli_query($databasecon,$sql);
                    if(mysqli_num_rows($result) > 0)  
                    {
                        while($row = mysqli_fetch_assoc($result)) 
                        {
                            $registros[$count] = array($row["id"],$row["id_integrador"],$row["nro_linea"],$row["contenido"],$row["fecha_venta"],$row["nombre_archivo"]);
                            $count++;
                        }
                    }

                    //PARA CADA REGISTRO OBTENIDO DEL ARCHIVO CONCILIACION DESDE BDD, IDENTIFICAR CADA CAMPO Y GUARDAR EN BDD
                    for($i=0;$i<count($registros);$i++)
                    {

                        //VALIDAR SI ES CABECERA
                        if(strcmp(substr($registros[$i][3],0,1),"C")==0)
                        {
                            //VALIDAR SI TAMANO DE CABECERA ES CORRECTO
                            if(strlen($registros[$i][3])-2!=27)
                            {
                                $_SESSION["result"]= $_SESSION["result"]."<br><span class='glyphicon glyphicon-floppy-remove'></span>TAMANO DE CABECERA INCORRECTO. TAMANO DEBE SER 27.".$registros[$i][3];
                                //echo "TAMANO DE CABECERA INCORRECTO. TAMANO DEBE SER 27.".$registros[$i][3]."<br>";
                                //echo strlen($registros[$i][3])."<br>";
                                $updStatus=0;
                            }
                            else
                            {
                                $cabecera_id_integrador=ltrim(substr($registros[$i][3],1,4),"0");
                                $cabecera_fecha=ltrim(substr($registros[$i][3],5,8),"0");
                                $cabecera_cantidad_registros=ltrim(substr($registros[$i][3],13,4),"0");
                                $cabecera_monto_total=round((ltrim(substr($registros[$i][3],17,10),"0")/100),2);
                                $updStatus=2;
                            } 
                        }
                        //VALIDAR SI ES DATA
                        else if(strcmp(substr($registros[$i][3],0,1),"D")==0)
                        {
                            $data_cantidad_registros_total++;

                            //VALIDAR SI TAMANO DE CABECERA ES CORRECTO
                            if(strlen($registros[$i][3])-2!=68)//TODO-get tamano total de data instead of 68
                            {
                                $_SESSION["result"]= $_SESSION["result"]."<br><span class='glyphicon glyphicon-floppy-remove'></span>TAMANO DE DATA INCORRECTO. TAMANO DEBE SER 68.".$registros[$i][3];
                                //echo "TAMANO DE DATA INCORRECTO. TAMANO DEBE SER 68.".$registros[$i][3]."<br>";//TODO-get tamano total de data instead of 68
                                //echo strlen($registros[$i][3])."<br>";
                                $updStatus=0;
                            }
                            else
                            {
                                $data_txn_integrador=ltrim(substr($registros[$i][3],1,20),"0");
                                $data_id_integrador=ltrim(substr($registros[$i][3],21,4),"0");
                                $data_id_canal=ltrim(substr($registros[$i][3],25,4),"0");
                                $data_id_plan=ltrim(substr($registros[$i][3],29,15),"0");
                                $data_monto=round((ltrim(substr($registros[$i][3],44,10),"0")/100),2);
                                $data_fecha_venta=ltrim(substr($registros[$i][3],54,14),"0");

                                //$data_monto_total=$data_monto_total+$data_monto;

                                //GUARDAR EN BDD CADA DETALLE DE TXN
                                $sql="insert into c_ventas_integrador(id_conciliacion, id_txn_integrador,id_integrador, id_canal,id_plan, monto,fecha_venta, fecha_carga_archivo, forma_carga_archivo, habilitado) values(".$_SESSION["last_concil_id"].",".$data_txn_integrador.",".$data_id_integrador.",".$data_id_canal.",'".$data_id_plan."',".$data_monto.",DATE_FORMAT('".$data_fecha_venta."','%Y%m%d%H%i%s'),DATE_FORMAT('".$fecha_carga_archivo."','%Y%m%d%H%i%s'),1,1)";  
                                
                                if(mysqli_query($databasecon,$sql))
                                {
                                    $updStatus = 5;
                                }
                                else
                                {
                                    $updStatus = 0;
                                    //echo "ERROR:".$sql."<br>";
                                }
                            }
                        }
                    }

                    /*//VALIDAR SI CANTIDAD DE REGISTROS INDICADA EN CABECERA ES IGUAL A TOTAL NRO DE REGISTROS(DATA) EN ARCHIVO CONCILIACION
                    if($cabecera_cantidad_registros==$data_cantidad_registros_total)
                    {
                        $updStatus=5;
                    }
                    else
                    {    
                        $updStatus=0;                    
                        $_SESSION["result"]= $_SESSION["result"]."<br><span class='glyphicon glyphicon-floppy-remove'></span>CANTIDAD EN CABECERA(".$cabecera_cantidad_registros.") Y CANTIDAD DE REGISTROS(".$data_cantidad_registros_total.") SON DIFERENTES";
                        echo "CANTIDAD EN CABECERA(".$cabecera_cantidad_registros.") Y CANTIDAD DE REGISTROS(".$data_cantidad_registros_total.") SON DIFERENTES";
                    }


                    //VALIDAR SI MONTO TOTAL DE TXNS INDICADA EN CABECERA ES IGUAL A TOTAL DE MONTOS EN CADA REGISTROS(DATA) EN ARCHIVO CONCILIACION
                    if($cabecera_monto_total==$data_monto_total)
                    {
                        $updStatus=5;
                    }
                    else
                    {    
                        $updStatus=0;                    
                        $_SESSION["result"]= $_SESSION["result"]."<br><span class='glyphicon glyphicon-floppy-remove'></span>MONTO EN CABECERA(".$cabecera_monto_total.") Y SUMA DE MONTO EN DATA(".$data_monto_total.") SON DIFERENTES";
                        echo "MONTO EN CABECERA(".$cabecera_monto_total.") Y SUMA DE MONTO EN DATA(".$data_monto_total.") SON DIFERENTES";
                    }*/
                }


                //ENVIAR ESTADO DE CARGA ARCHIVO CONCILIACION - EXITOSO
                if($updStatus==5)
                {
                    mysqli_commit($databasecon);
                    $_SESSION["result"]= $_SESSION["result"]."ARCHIVO CARGADO CORRECTAMENTE:";
                    //echo "ARCHIVO CARGADO CORRECTAMENTE Y VALIDACION OK<br>";                
                }
                else
                {
                    mysqli_rollback($databasecon);
                    $_SESSION["result"]= $_SESSION["result"]."ERROR EN CARGAR ARCHIVO CONCILIACION.";
                }
            }
            //ENVIAR ESTADO DE CARGA ARCHIVO CONCILIACION - ERROR
            else
            {
                $_SESSION["result"]= $_SESSION["result"]."<br><span class='glyphicon glyphicon-floppy-remove'></span>INTEGRADOR SON DIFERENTES";
                //echo "INTEGRADOR SON DIFERENTES<br>";
            }
            
        }
        //ENVIAR ESTADO DE CARGA ARCHIVO CONCILIACION - ERROR
        else
        {
            $_SESSION["result"]= $_SESSION["result"]."<br><span class='glyphicon glyphicon-floppy-remove'></span>FECHA ARCHIVO CONCILIACION Y FECHA PARA CONCILIACION SON DIFERENTES";
            //echo "FECHA ARCHIVO CONCILIACION Y FECHA PARA CONCILIACION SON DIFERENTES<br>";
        }

        if($_SESSION["user_empresa"]==0)
            $url='conciliacion.php';
        else
            $url='subirArchivoConciliacion.php';
        header("Location:$url");
    }

    //CONSULTAR TXNS de VENTA PARA LA INTEGRADOR Y FECHA SELECCIONADO
    else if($_GET["proceso"]==3 && $_GET["task"]==1)
    {
        $_SESSION["FECHA_CONCILIACION"]=str_replace("-","",$_POST["consulta_fecha_conciliacion"]);;
        $_SESSION["INTEGRADOR"]=$_POST["consulta_integrador"];
        //echo "FECHA CONCILIACION:".$_SESSION["FECHA_CONCILIACION"]."<br>";
        //echo "INTEGRADOR:".$_SESSION["INTEGRADOR"]."<br>";
        if($_SESSION["user_empresa"]==0)
            $url='conciliacion.php';
        else
            $url='subirArchivoConciliacion.php';
        header("Location:$url");
    }
    //REALIZAR CONCILIACION
    else if($_GET["proceso"]==3 && $_GET["task"]==2)
    {
        $result="";
        $cnt_conciliacion=0;
        $cnt_conciliacion_err=0;
        $monto_txn_integradores=0;
        $monto_txn_ventas=0;
        $txn_integradores=$controladorDB->listaTxnIntegradores($databasecon,$_SESSION["FECHA_CONCILIACION"],$_SESSION["INTEGRADOR"],$DEBUG_STATUS);
        $txn_ventas=$controladorDB->listaTxnVentas($databasecon,$_SESSION["FECHA_CONCILIACION"],$_SESSION["INTEGRADOR"],$DEBUG_STATUS);
        $id_conciliacion=$txn_integradores[0][7];
        
        $sql="select now() curr_dt from dual";
        $resultSet = mysqli_query($databasecon,$sql);
        if(mysqli_num_rows($resultSet) > 0)  
        {
            while($row = mysqli_fetch_assoc($resultSet)) 
            {
                $curr_dt=$row["curr_dt"];
            }
        }


        $sql="update c_ventas_integrador set habilitado=1 where id_conciliacion=".$id_conciliacion;
        if(mysqli_query($databasecon,$sql))
        {
            $updStatus = 1;
        }

        $sql="update c_ventas_interna set id_conciliacion=1 where id_conciliacion=".$id_conciliacion;
        if(mysqli_query($databasecon,$sql))
        {
            $updStatus = 1;
        }


        //VALIDAR CANTIDAD REGISTROS
        if(count($txn_integradores)==count($txn_ventas))
        {
            $result=$result."<span class='glyphicon glyphicon-floppy-saved'></span>CANTIDAD DE TRANSACCIONES:IGUAL<br>";
        }
        else
        {
            $result=$result."<span class='glyphicon glyphicon-floppy-remove'></span>CANTIDAD DE TRANSACCIONES:DIFERENTES<br>";
            $count=$controladorDB->actualizarEstadoConciliacion($databasecon,4, $id_conciliacion,$curr_dt,$DEBUG_STATUS);
            //$_SESSION["message"]= "ERROR EN CONCILIACION : CANTIDAD DE TRANSACCIONES:DIFERENTES";   
        }
        //SUMAR MONTO DESDE REGISTROS DE ARCHIVO CONCILIACION GUARDADO EN BDD
        for($i=0;$i<count($txn_integradores);$i++)
        {
            $monto_txn_integradores=$monto_txn_integradores+$txn_integradores[$i][4];
        }
        //SUMAR MONTO DESDE VENTAS REGISTRADOS EN SISTEMA INTERNA
        for($i=0;$i<count($txn_ventas);$i++)
        {
            $monto_txn_ventas=$monto_txn_ventas+$txn_ventas[$i][5];
        }

        //VALIDAR LOS MONTOS
        if($monto_txn_integradores==$monto_txn_ventas)
        {
            $result=$result."<span class='glyphicon glyphicon-floppy-saved'></span>MONTO DE TRANSACCIONES:IGUAL<br>";
        }
        else
        {
            $result=$result."<span class='glyphicon glyphicon-floppy-remove'></span>MONTO DE TRANSACCIONES:DIFERENTES<br>";
            $count=$controladorDB->actualizarEstadoConciliacion($databasecon,5, $id_conciliacion,$curr_dt,$DEBUG_STATUS);
            //$_SESSION["message"]= "ERROR EN CONCILIACION : MONTO DE TRANSACCIONES:DIFERENTES";   
        }
            
        //REALIZAR CONCILIACION
        for($i=0;$i<count($txn_integradores);$i++)
        {
            $count=$controladorDB->realizarConciliacion($databasecon,$txn_integradores[$i],$curr_dt,$DEBUG_STATUS);
            if($count==1)
                $cnt_conciliacion++;
            else
                $cnt_conciliacion_err++;
        }
        $result=$result."<span class='glyphicon glyphicon-floppy-saved'></span>CANTITAD DE TRANSACCIONES CONCILIADO:".$cnt_conciliacion."<br>";
        $result=$result."<span class='glyphicon glyphicon-floppy-saved'></span>CANTITAD DE TRANSACCIONES NO CONCILIADO:".$cnt_conciliacion_err."<br>";
        
        //ACTUALIZAR ESTADO DE CONCILIACION
        if(count($txn_integradores)==$cnt_conciliacion && count($txn_ventas)==$cnt_conciliacion)
        {
            $count=$controladorDB->actualizarEstadoConciliacion($databasecon,3,$id_conciliacion,$curr_dt,$DEBUG_STATUS);
            //$_SESSION["message"]= "CONCILIACION REALIZADO EXITOSAMENTE";
            $result=$result."CONCILIACION REALIZADO EXITOSAMENTE<br>";
        }
        else
        {
            $count=$controladorDB->actualizarEstadoConciliacion($databasecon,6, $id_conciliacion,$curr_dt,$DEBUG_STATUS);
            //$_SESSION["message"]= "ERROR EN CONCILIACION : ALGUNOS REGISTROS NO FUERON CONCILIADOS POR DIFERENCIA EN DATOS";   
            $result=$result."ERROR EN CONCILIACION : ALGUNOS REGISTROS NO FUERON CONCILIADOS POR DIFERENCIA EN DATOS<br>";   
        }
        if(strlen($result)>0)
        {
            $_SESSION["result"]= $result;


            $sql="select id,nombre,email,email_adicionales from c_proveedor u where u.id = ".$_SESSION["INTEGRADOR"];
            $updStatus=0;
            $id=0;
            $nombre='';
            $password='';
            $resultSet = mysqli_query($databasecon,$sql);
            if(mysqli_num_rows($resultSet) > 0)
            {               
                if($row = mysqli_fetch_assoc($resultSet)) 
                {
                    $id=$row["id"];
                    $nombre=$row["nombre"];
                    $email=$row["email"];
                    $email_adicionales=$row["email_adicionales"];
                    
                    $to = $email;
                    $subject = 'SMART CONCIL - RESULTADO CONCILIACION : '.$_SESSION["FECHA_CONCILIACION"];
                    $txt = '¡HOLA, '.$nombre.'!'."<br><br>";
                    $txt=$txt.'Se ha realizado su conciliacion en SMART CONCIL de los ventas del '.$_SESSION["FECHA_CONCILIACION"]."<br><br>";
                    $txt=$txt.'RESULTADOS::'."<br><br>";
                    $txt=$txt.$result."<br><br>";
                    $txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en support@smart-concil.com'."<br><br>";
                    $txt=$txt.'MUCHAS GRACIAS'."<br><br>";

                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
                    //$headers .= 'From:info@hutesol.com' . "\r\n";
                    //$headers .= 'CC: olguercalvache@gmail.com';
                    $headers .= 'From:SMART CONCIL <concil@merakiminds.com>' . "\r\n";
                    //$headers .= 'CC: fernandoa@nipromed.com';
                    $headers .= 'BCC: '.$_SESSION["user_email"].','.$email_adicionales;
                    $res=mail($to,$subject,$txt,$headers);
                }
            }
        }
        $url='conciliacion.php';
        header("Location:$url");
    }
    //CERRAR CONCILIACION FORZADA
    else if($_GET["proceso"]==3 && $_GET["task"]==3)
    {
        $result="";
        $cnt_conciliacion_integrador=0;
        $cnt_conciliacion_integrador_err=0;
        $cnt_conciliacion_interna=0;
        $cnt_conciliacion_interna_err=0;
        $txn_integradores=$controladorDB->listaTxnIntegradores($databasecon,$_SESSION["FECHA_CONCILIACION"],$_SESSION["INTEGRADOR"],$DEBUG_STATUS);
        $txn_ventas=$controladorDB->listaTxnVentas($databasecon,$_SESSION["FECHA_CONCILIACION"],$_SESSION["INTEGRADOR"],$DEBUG_STATUS);
        $id_conciliacion=$txn_integradores[0][7];
        
        $sql="select now() curr_dt from dual";
        $resultSet = mysqli_query($databasecon,$sql);
        if(mysqli_num_rows($resultSet) > 0)  
        {
            while($row = mysqli_fetch_assoc($resultSet)) 
            {
                $curr_dt=$row["curr_dt"];
            }
        }
            
        //REALIZAR CONCILIACION
        for($i=0;$i<count($txn_integradores);$i++)
        {
            $count=$controladorDB->cerrarConciliacionForzadaIntegrador($databasecon,$txn_integradores[$i],$curr_dt,$DEBUG_STATUS);
            if($count==1)
                $cnt_conciliacion_integrador++;
            else
                $cnt_conciliacion_integrador_err++;
        }
        for($i=0;$i<count($txn_ventas);$i++)
        {
            $count=$controladorDB->cerrarConciliacionForzadaInterna($databasecon,$txn_ventas[$i],$curr_dt,$DEBUG_STATUS);
            if($count==1)
                $cnt_conciliacion_interna++;
            else
                $cnt_conciliacion_interna_err++;
        }
        $result=$result."<span class='glyphicon glyphicon-floppy-saved'></span>CANTITAD DE TRANSACCIONES DE INTEGRADOR CONCILIADO:".$cnt_conciliacion_integrador."<br>";
        $result=$result."<span class='glyphicon glyphicon-floppy-saved'></span>CANTITAD DE TRANSACCIONES DE INTEGRADOR NO CONCILIADO:".$cnt_conciliacion_integrador_err."<br>";
        $result=$result."<span class='glyphicon glyphicon-floppy-saved'></span>CANTITAD DE TRANSACCIONES INTERNOS CONCILIADO:".$cnt_conciliacion_interna."<br>";
        $result=$result."<span class='glyphicon glyphicon-floppy-saved'></span>CANTITAD DE TRANSACCIONES INTERNOS NO CONCILIADO:".$cnt_conciliacion_interna_err."<br>";
        
        //ACTUALIZAR ESTADO DE CONCILIACION
        if(count($txn_integradores)==$cnt_conciliacion_integrador && count($txn_ventas)==$cnt_conciliacion_interna)
        {
            $count=$controladorDB->actualizarEstadoConciliacion($databasecon,7,$id_conciliacion,$curr_dt,$DEBUG_STATUS);
            //$_SESSION["message"]= "CONCILIACION REALIZADO EXITOSAMENTE";
            $result=$result."CONCILIACION REALIZADO EXITOSAMENTE<br>";
        }
        else
        {
            $count=$controladorDB->actualizarEstadoConciliacion($databasecon,8, $id_conciliacion,$curr_dt,$DEBUG_STATUS);
            //$_SESSION["message"]= "ERROR EN CONCILIACION : ALGUNOS REGISTROS NO FUERON CONCILIADOS POR DIFERENCIA EN DATOS";  
            $result=$result."ERROR EN CONCILIACION : ALGUNOS REGISTROS NO FUERON CONCILIADOS POR DIFERENCIA EN DATOS<br>";    
        }
        if(strlen($result)>0)
        {
            $_SESSION["result"]= $result;

            $sql="select id,nombre,email from c_proveedor u where u.id = ".$_SESSION["INTEGRADOR"];
            $updStatus=0;
            $id=0;
            $nombre='';
            $password='';
            $resultSet = mysqli_query($databasecon,$sql);
            if(mysqli_num_rows($resultSet) > 0)
            {               
                if($row = mysqli_fetch_assoc($resultSet)) 
                {
                    $id=$row["id"];
                    $nombre=$row["nombre"];
                    $email=$row["email"];

                    
                    $to = $email;
                    $subject = 'SMART CONCIL - RESULTADO CONCILIACION : '.$_SESSION["FECHA_CONCILIACION"];
                    $txt = '¡HOLA, '.$nombre.'!'."<br><br>";
                    $txt=$txt.'Se encuentra inconsistencias en concil, pero se ha realizado su conciliacion de manera forzada en SMART CONCIL de los ventas del '.$_SESSION["FECHA_CONCILIACION"]."<br><br>";
                    $txt=$txt.'RESULTADOS::'."<br><br>";
                    $txt=$txt.$result."<br><br>";
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
                }
            }
        }
        $url='conciliacion.php';
        header("Location:$url");
    }
    //CONSULTAR DATA DESDE ALEPO
    else if($_GET["proceso"]==3 && $_GET["task"]==4)
    {
        $_SESSION["FECHA_CONCILIACION"]=str_replace("-","",$_GET["consulta_fecha_conciliacion"]);;
        $_SESSION["INTEGRADOR"]=$_GET["consulta_integrador"];
        //echo "FECHA CONCILIACION:".$_SESSION["FECHA_CONCILIACION"]."<br>";
        //echo "INTEGRADOR:".$_SESSION["INTEGRADOR"]."<br>";

        //
         $sql="update c_ventas_interna cvi set cvi.habilitado=9 where DATE_FORMAT(cvi.fecha_venta,'%Y%m%d')=DATE_FORMAT('".$_GET["consulta_fecha_conciliacion"]."','%Y%m%d') and cvi.id_integrador=".$_GET["consulta_integrador"]." and cvi.habilitado in (1,3)";
        //echo $sql;
        if(mysqli_query($databasecon,$sql))
        {
            $sql="insert into c_ventas_interna(id_txn_interna,id_txn_integrador,id_integrador,id_canal,id_plan,monto,fecha_venta, id_conciliacion, habilitado) select cvt.id_txn_interna,cvt.id_txn_integrador,cvt.id_integrador,cvt.id_canal,cvt.id_plan,cvt.monto,cvt.fecha_venta,0,cvt.habilitado from c_ventas_temp cvt where DATE_FORMAT(cvt.fecha_venta,'%Y%m%d')=DATE_FORMAT('".$_GET["consulta_fecha_conciliacion"]."','%Y%m%d') and cvt.id_integrador=".$_GET["consulta_integrador"]." and cvt.habilitado=1";
            //echo $sql;
            if(mysqli_query($databasecon,$sql))
            {
                mysqli_commit($databasecon);
                $_SESSION["message"]= "CONSULTA REALIZADO EXITOSAMENTE";                
            }
            else
            {
                mysqli_rollback($databasecon);
                $_SESSION["message"]= "ERROR EN CONSULTAR DATA";
            }                   
        }
        else
        {
            mysqli_rollback($databasecon);
            $_SESSION["message"]= "ERROR EN ACTUALIZAR DATA";
        }   

        //OBTENER DATOS DE VENTA EN BASE DE DATOS DE ALEPO.
        
        //return $sql;
    }
    //ACTUALIZAR MENU
    else if($_GET["proceso"]==4 && $_GET["task"]==0)
    {   
        $err = $controladorDB->actualizarMenuData($databasecon,$_POST["id"],$_POST["id_menu"],$_POST["nombre"],$_POST["url"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR MENU. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>MENU DATA ACTUALIZADO</center>";
        }

        $url='menu.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==4 && $_GET["task"]==1)
    {   
        $err = $controladorDB->deshabilitarMenuData($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR MENU. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>MENU DATA ELIMINADO</center>";
        }

        $url='menu.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==5 && $_GET["task"]==0)
    {   
        $err = $controladorDB->actualizarPerfilData($databasecon,$_POST["id"],$_POST["nombre"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR PERFIL. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>PERFIL DATA ACTUALIZADO</center>";
        }

        $url='perfil.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==5 && $_GET["task"]==1)
    {   
        $err = $controladorDB->deshabilitarPerfilData($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR PERFIL. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>PERFIL DATA ELIMINADO</center>";
        }

        $url='perfil.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==6 && $_GET["task"]==0)
    {   
        $err = $controladorDB->actualizarPerfilPermisos($databasecon,$_POST["id"],$_POST["idPerfil"],$_POST["idMenu"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR PERMISOS. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>PERMISOS DATA ACTUALIZADO</center>";
        }

        $url='permisos.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==6 && $_GET["task"]==1)
    {   
        $err = $controladorDB->deshabilitarPerfilPermisos($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR PERMISOS. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>PERMISOS DATA ELIMINADO</center>";
        }

        $url='permisos.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==6 && $_GET["task"]==3)
    {   
        $_SESSION["PERMISOS_IDPERFIL"]=$_GET["idPerfil"];
        $_SESSION["PERMISOS_IDMENU"]=$_GET["idMenu"];
    }
    else if($_GET["proceso"]==7 && $_GET["task"]==0)
    {   
        $err = $controladorDB->actualizarFileServerData($databasecon,$_POST["id"],$_POST["id_integrador"],$_POST["ip_servidor"],$_POST["ruta"],$_POST["usuario"],$_POST["clave"],$_POST["intervalo"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR FILE SERVER CONFIGURACION. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>FILE SERVER CONFIGURACION ACTUALIZADO</center>";
        }

        $url='ubicacionArchivos.php ';
        header("Location:$url");
    }
    else if($_GET["proceso"]==7 && $_GET["task"]==1)
    {   
        $err = $controladorDB->deshabilitarFileServerData($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR FILE SERVER CONFIGURACION. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>FILE SERVER CONFIGURACION ELIMINADO</center>";
        }

        $url='ubicacionArchivos.php ';
        header("Location:$url");
    }
    else
    {
        //echo '<h3>[ERROR:addEntidad]:input invalido</h3>';
        $_SESSION["message"]='ERROR EN DATA.';
    }
    
?>