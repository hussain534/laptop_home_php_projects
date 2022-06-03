<?php

    /*echo '{
            "cols": [
                {"id":"","label":"A","pattern":"","type":"string"},
                {"id":"","label":"USER 1","pattern":"","type":"number"},
                {"id":"","label":"USER 2","pattern":"","type":"number"}
               ],
               "rows": [
                   {"c":[{"v":"ABC","f":null},{"v":10,"f":null}]},
                   {"c":[{"v":"XYZ","f":null},{"v":90,"f":null}]},
                   {"c":[{"v":"XYZ","f":null},{"v":50,"f":null}]},
                   {"c":[{"v":"XYZ","f":null},{"v":30,"f":null}]},
                   {"c":[{"v":"XYZ","f":null},{"v":75,"f":null}]}
                   ]
               }';*/



    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();
    
    $dt_ini=$_GET["dt_ini"];
    $dt_fin=$_GET["dt_fin"];
    //$tipo_cliente=1;
    $estado=$_GET["estadoPeticion"];
    $tipo_cliente=$_GET["tipoCliente"];

    //echo 'dt_ini:'.$dt_ini.'<br>';
    //echo 'dt_fin:'.$dt_fin.'<br>';
    $strHeader='{"id":"","label":"A","pattern":"","type":"string"},
                {"id":"","label":"CLIENTES","pattern":"","type":"string"},
                {"id":"","label":"NRO","pattern":"","type":"number"}';
    $strData="";
    $clientes=array();
    $count=0;    
    $total=0;                
    //$strTemp="";
    $sql="select pc.nombre client_name,count(*) ctr from p_solicitud ps,p_clientes pc where ps.client_id=pc.id 
        and date_format(ps.fecha_creacion,'%Y%m')>=date_format('".$dt_ini."','%Y%m')
        and date_format(ps.fecha_creacion,'%Y%m')<=date_format('".$dt_fin."','%Y%m') 
        and ps.estado=".$estado;
    if($tipo_cliente!=99)
        $sql=$sql." and pc.tipo_cliente=".$tipo_cliente;
    $sql=$sql." group by client_name order by client_name";
    //echo 'sql:'.$sql.'<br>';
    $result = mysqli_query($databasecon,$sql);
    if(mysqli_num_rows($result) > 0)  
    {
        while($row = mysqli_fetch_assoc($result)) 
        {
            $clientes[$count] = array($row["client_name"],$row["ctr"]);
            $total=$total+$row["ctr"];
            $count++;
            
        }
    }
    //echo print_r($clientes).'<br>';

    for($x=0;$x<count($clientes);$x++)
    {
        $strData=$strData.'{"c":[{"v":"'.$clientes[$x][0].'","f":null},{"v":'.round($clientes[$x][1]*100/$total,2).',"f":null}]},';                                    
    }

    if(isset($strData) && strlen($strData)>1)
    {
        $strData=substr($strData,0,strlen($strData)-1);
    }
    $strData='"rows": ['.$strData.']';
    
    $strHeader='"cols": ['.$strHeader.']';
    echo '{'.$strHeader.','.$strData.'}';
            

    
?>