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


    /*echo '{
        "cols": [
            {"id":"","label":"Users","pattern":"","type":"string"},
            {"id":"","label":"Abiertto","pattern":"","type":"number"},
            {"id":"","label":"En Curso","pattern":"","type":"number"},
            {"id":"","label":"Cerrada","pattern":"","type":"number"}
            ],
            "rows": [
                {"c":[{"v":"User 1","f":null},{"v":10,"f":null},{"v":10,"f":null},{"v":10,"f":null}]},
                {"c":[{"v":"User 2","f":null},{"v":20,"f":null},{"v":40,"f":null},{"v":20,"f":null}]},
                {"c":[{"v":"User 3","f":null},{"v":30,"f":null},{"v":20,"f":null},{"v":15,"f":null}]}
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
    $estado=3;

    //$sql="select period_diff(date_format('".$dt_fin."','%Y%m'),date_format('".$dt_ini."','%Y%m')) total_meses from dual";
    $total_meses=0;
    $strUsers='{"id":"","label":"Users","pattern":"","type":"string"},
            {"id":"","label":"ABIERTO","pattern":"","type":"number"},
            {"id":"","label":"EN CURSO","pattern":"","type":"number"},
            {"id":"","label":"CERRADA","pattern":"","type":"number"}';
    $strData="";
            $clientes=array();
            $count=0;                    
            $sqlUsers= "select id user_id,nombre user_name from p_usuario p where p.perfil_id=42 and p.client_id=1 order by user_name";
            $resultUsers = mysqli_query($databasecon,$sqlUsers);
            if(mysqli_num_rows($resultUsers) > 0)  
            {
                while($rowUsers = mysqli_fetch_assoc($resultUsers)) 
                {
                    $strTemp='{"c":[{"v":"'.$rowUsers["user_name"].'","f":null}';
                    for($j=1;$j<=3;$j++)
                    {
                        $sql="select ps.id_tecnico,count(*) ctr from p_solicitud ps 
                        where date_format(ps.fecha_creacion,'%Y%m')>=date_format('".$dt_ini."','%Y%m')
                        and date_format(ps.fecha_creacion,'%Y%m')<=date_format('".$dt_fin."','%Y%m') 
                        and estado=".$j." and ps.id_tecnico=".$rowUsers["user_id"]." group by ps.id_tecnico order by ps.id_tecnico";
                        //echo 'sql:'.$sql.'<br>';
                        $result = mysqli_query($databasecon,$sql);
                        if(mysqli_num_rows($result) > 0)  
                        {
                            while($row = mysqli_fetch_assoc($result)) 
                            {
                                $strTemp=$strTemp.',{"v":'.$row["ctr"].',"f":null}';                                    
                            }
                        }
                        else
                        {
                            $strTemp=$strTemp.',{"v":0,"f":null}'; 
                        }
                    }
                    $strData=$strData.$strTemp.']},';
                    $count++;
                }
            }
            if(isset($strData) && strlen($strData)>1)
            {
                $strData=substr($strData,0,strlen($strData)-1);
            }
            $strData='"rows": ['.$strData.']';
            
            $strUsers='"cols": ['.$strUsers.']';
            echo '{'.$strUsers.','.$strData.'}';

    
?>