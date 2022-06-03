<?php
    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'controladorDB.php';
    $controladorDB = new controladorDB();
    
    $sql="select cp.nombre ,cn.id,cp.email,cp.email_adicionales,cn.nombre_job,cn.mensaje,cn.fecha_hora_registro from c_proveedor cp, c_notificacion_jobs cn
    where cp.id=cn.id_integrador and cn.estado=0 and cn.nombre_job!='CARGA VENTAS ETAPA'
    union
    select 'ETAPA' nombre,cn.id,'hussain.mm.2006@gmail.com' email,'hussain.mm.2006@gmail.com' email_adicionales,cn.nombre_job,cn.mensaje,cn.fecha_hora_registro from c_notificacion_jobs cn
    where cn.estado=0 and cn.nombre_job='CARGA VENTAS ETAPA'";
    //echo $sql.'<br>';
    
    $result = mysqli_query($databasecon,$sql);
    if(mysqli_num_rows($result) > 0)  
    {
        while($row = mysqli_fetch_assoc($result)) 
        {            
            $to = $row["email"];
            echo 'PARA:'.$to.','.$row["email_adicionales"].'\r\n';
            $subject = 'METROWIFI CONCIL - RESULTADOS :'.$row["nombre_job"];
            echo 'ASUNTO:'.$subject.'\r\n';
            $txt = 'ESTIMADOS!'."<br><br>";
            $txt=$txt.'Se indica los resultados del proceso automatico : '.$row["nombre_job"].' ejecutado al '.$row["fecha_hora_registro"]."<br><br>";
            $txt=$txt."---------------".$row["nombre"]."---------------<br><br>";
            $txt=$txt.$row["mensaje"]."<br><br>";
            $txt=$txt.'MUCHAS GRACIAS'."<br><br>";
            echo 'MENSAJE:'.$txt.'\r\n';
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
            $headers .= 'From:METROWIFI CONCIL <concil@conciliacion-metrowifi.etapa.net.ec>' . "\r\n";
            $headers .= 'BCC: '.$row["email_adicionales"];
            $res=mail($to,$subject,$txt,$headers);


            $sql = "update c_notificacion_jobs set estado=1,fecha_hora_notificacion=now() where id=".$row["id"];
            if(mysqli_query($databasecon,$sql))
            {
                $updStatus = 1;      
            }
        }
    }
    else
        echo "NO NOTIFICACIONES PENDIENTES! FELICITACIONES";

    

?>

