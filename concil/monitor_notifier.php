<?php
    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'controladorDB.php';
    $controladorDB = new controladorDB();
    
    $sql="select md.id,ms.ip,mp.param,md.data_entry_time,ROUND(md.`data`,2) data,md.data_2,sp.id_mon_param from mon_data md, mon_param mp, mon_servers ms, mon_server_param_rn sp, server_types st
        where sp.id_mon_param in (1,2,3,4)
        and md.server_param_rn_id=sp.id
        and sp.id_server=ms.id
        and sp.id_mon_param=mp.id
        and ms.server_type=st.id
        and md.data>".$monitor_notification_umbral." and md.is_notified=0 and md.enabled=1
        union
        select md.id,ms.ip,mp.param,md.data_entry_time,md.`data`,md.data_2,sp.id_mon_param from mon_data md, mon_param mp, mon_servers ms, mon_server_param_rn sp, server_types st
        where sp.id_mon_param in (5)
        and md.server_param_rn_id=sp.id
        and sp.id_server=ms.id
        and sp.id_mon_param=mp.id
        and ms.server_type=st.id
        and md.data!=200
        and md.is_notified=0
        and md.enabled=1";
    //echo $sql.'<br>';
    
    $result = mysqli_query($mon_databasecon,$sql);
    echo "#ALERTAS:".mysqli_num_rows($result)."\r\n";
    if(mysqli_num_rows($result) > 0)  
    {
        while($row = mysqli_fetch_assoc($result)) 
        {
            //print_r($row);
            if($row["id_mon_param"]==5)
            {
                $to = $monitor_notification_reciever_email;
                $subject = 'METROWIFI MONITOR - ['.$row["param"].':'.$row["ip"].'] - OFFLINE';
                $txt = 'ESTIMADOS!'."<br><br>";
                $txt=$txt.'Se require su atencion '.$row["param"].' - '.$row["ip"]."<br><br>";
                $txt=$txt."ESTADO::OFFLINE<br><br>";
                $txt=$txt.'FECHA-HORA::'.$row["data_entry_time"]."<br><br>";
                $txt=$txt.'MUCHAS GRACIAS'."<br><br>";

                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
                $headers .= 'From:METROWIFI MONITOR <'.$monitor_notification_sender_email.'>' . "\r\n";
                //$headers .= 'BCC: '.$_SESSION["user_email"].','.$email_adicionales;
                $res=mail($to,$subject,$txt,$headers);
                echo "RESULTADO::[".$row["id"]."]::".$res."\r\n";
            }
            else
            {
                $to = $monitor_notification_reciever_email;
                $subject = 'METROWIFI MONITOR - ['.$row["param"].':'.$row["ip"].'] - '.$row["data"].'%';
                $txt = 'ESTIMADOS!'."<br><br>";
                $txt=$txt.'Se require su atencion para alerta de '.$row["param"].' presentado en '.$row["ip"]."<br><br>";
                $txt=$txt.'VALOR::'.$row["data"]."%<br><br>";
                $txt=$txt.'FECHA-HORA::'.$row["data_entry_time"]."<br><br>";
                $txt=$txt.'MUCHAS GRACIAS'."<br><br>";

                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
                $headers .= 'From:METROWIFI MONITOR <'.$monitor_notification_sender_email.'>' . "\r\n";
                //$headers .= 'BCC: '.$_SESSION["user_email"].','.$email_adicionales;
                $res=mail($to,$subject,$txt,$headers);
                echo "RESULTADO::[".$row["id"]."]::".$res."\r\n";
            }


            $sql = "update mon_data set is_notified=1,notified_on=now() where id=".$row["id"];
            if(mysqli_query($mon_databasecon,$sql))
            {
                $updStatus = 1;      
            }
            /*if($res==true)
            {
                $sql = "update mon_data set is_notified=1 where id=".$row["id"];
                if(mysqli_query($dbcon,$sql))
                {
                    $updStatus = 1;      
                }
            }
            else
            {
                 $sql = "update mon_data set is_notified=99 where id=".$row["id"];
                if(mysqli_query($dbcon,$sql))
                {
                    $updStatus = 1;      
                }
            }*/
        }
    }
    else
        echo "NO ALERTAS! FELICITACIONES";

    

?>

