<?php


defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();
    
    $serviceId=$_GET["serviceId"];
    $clientId=$_GET["clientId"];
    $dt_ini=$_GET["dt_ini"];
    $dt_fin=$_GET["dt_fin"];
    $serviceDesc='';

    $sql0="select ts.desc from p_tipo_servicios ts where ts.id=".$serviceId;
    $result0 = mysqli_query($databasecon,$sql0);
    if(mysqli_num_rows($result0) > 0)  
    {
        if($row0 = mysqli_fetch_assoc($result0))
        {
            $serviceDesc=$row0["desc"];
        }
    }

    if($clientId==9999)
    {
        if($serviceId==6)
            $sql="select c.id,c.nombre from p_clientes c where c.habilitado=1 and c.tipo_cliente=2 and id>1";
        else if($serviceId==7)
            $sql="select c.id,c.nombre from p_clientes c where c.habilitado=1 and c.tipo_cliente=1 and id>1";
        else
            $sql="select c.id,c.nombre from p_clientes c where c.habilitado=1 and id>1";
    }
    else
    {
        $sql="select c.id,c.nombre from p_clientes c where c.habilitado=1 and c.id=".$clientId;
    }



    //$sql="select period_diff(date_format('".$dt_fin."','%Y%m'),date_format('".$dt_ini."','%Y%m')) total_meses from dual";
    $total_meses=0;
    $strUsers='{"id":"","label":"Meses","pattern":"","type":"string"}';
    $strUsers=$strUsers.',{"id":"","label":"'.$serviceDesc.'","pattern":"","type":"number"}';
    $strData="";
    $strTemp="";
    $result = mysqli_query($databasecon,$sql);
    if(mysqli_num_rows($result) > 0)  
    {
        //if($row = mysqli_fetch_assoc($result)) 
        //{
            //$total_meses=$row["total_meses"];
            $clientes=array();
            //$count=0;
            while($row = mysqli_fetch_assoc($result))
            {


                $sql="select count(*) ctr from p_solicitud ps where ps.service_id=".$serviceId." and ps.client_id =".$row["id"]." and ps.habilitado=1 
                    and date_format(ps.fecha_creacion,'%Y%m')>=date_format('".$dt_ini."','%Y%m') 
                    and date_format(ps.fecha_creacion,'%Y%m')<=date_format('".$dt_fin."','%Y%m')";
                $result1 = mysqli_query($databasecon,$sql);
                if(mysqli_num_rows($result1) > 0)  
                {
                    if($row1 = mysqli_fetch_assoc($result1)) 
                    {
                        if($row1["ctr"]>0)
                        {
                            //$strUsers=$strUsers.',{"id":"","label":"'.$row["id"].'","pattern":"","type":"number"}';
                            $strTemp=$strTemp.'{"c":[{"v":"'.$row["nombre"].'","f":null}';
                            $strTemp=$strTemp.',{"v":'.$row1["ctr"].',"f":null}';
                            $strTemp=$strTemp.']},';
                        }
                    }
                }
                else
                {
                    $strTemp=$strTemp.',{"v":0,"f":null}';
                }
                
            }
            //$strTemp=$strTemp.','.$strTemp;
            $strData=$strData.'"rows": ['.$strTemp.']';
        //}
    }
    $strUsers='"cols": ['.$strUsers.']';
    echo '{'.$strUsers.','.$strData.'}';
?>