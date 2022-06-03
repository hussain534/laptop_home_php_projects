<?php
    /*echo '{
        "cols": [
            {"id":"","label":"Peticiones","pattern":"","type":"string"},
            {"id":"","label":"Peticiones","pattern":"","type":"number"}
            ],
            "rows": [
                {"c":[{"v":"User 1","f":null},{"v":10,"f":null}]},
                {"c":[{"v":"User 2","f":null},{"v":20,"f":null}]},
                {"c":[{"v":"User 3","f":null},{"v":30,"f":null}]}
            ]
        }';*/
    
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();

    $estado=$_GET["estadoPeticion"];
    $id_tecnico=$_GET["clientId"];
    $clId=$_GET["clId"];
    $dt_ini=$_GET["dt_ini"];
    $dt_fin=$_GET["dt_fin"];

    $total_meses=0;
    $strMeses='{"id":"","label":"Peticiones","pattern":"","type":"string"},{"id":"","label":"Peticiones","pattern":"","type":"number"}';
    $strData="";
    $iterrator=0;
    $sql="select ps.id, IFNULL(datediff((select max(pc.fecha_creacion) from p_peticion_comments pc where pc.id=ps.id),ps.fecha_creacion),0) nro_dias
            from p_solicitud ps where  ps.client_id=".$clId." and 
            ps.id_tecnico=".$id_tecnico." and ps.estado=".$estado." and
            date_format(ps.fecha_creacion,'%Y%m')>=date_format('".$dt_ini."','%Y%m')
            and date_format(ps.fecha_creacion,'%Y%m')<=date_format('".$dt_fin."','%Y%m') ";
    $result = mysqli_query($databasecon,$sql);
    if(mysqli_num_rows($result) > 0)  
    {
        while($row = mysqli_fetch_assoc($result)) 
        {
            
            $strData = $strData.'{"c":[{"v":"'.$row["id"].'","f":null},{"v":"'.$row["nro_dias"].'","f":null}]},';
        }
    }
    if(isset($strData) && strlen($strData)>1)
    {
        $strData=substr($strData,0,strlen($strData)-1);
    }
    $strData='"rows": ['.$strData.']';
     $strMeses='"cols": ['.$strMeses.']';
    echo '{'.$strMeses.','.$strData.'}';
?>