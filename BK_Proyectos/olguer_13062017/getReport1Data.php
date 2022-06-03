
<?php


defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();
    
    $estado=$_GET["estado"];
    $dt_ini=$_GET["dt_ini"];
    $dt_fin=$_GET["dt_fin"];

    $sql="select period_diff(date_format('".$dt_fin."','%Y%m'),date_format('".$dt_ini."','%Y%m')) total_meses from dual";
    $total_meses=0;
    $strUsers='{"id":"","label":"Meses","pattern":"","type":"string"}';
    $strData="";
    $strTemp="";
    $result = mysqli_query($databasecon,$sql);
    if(mysqli_num_rows($result) > 0)  
    {
        if($row = mysqli_fetch_assoc($result)) 
        {
            $total_meses=$row["total_meses"];
            $clientes=array();
            $count=0;
            for($x=0;$x<=$total_meses;$x++)
            {
                
                $sqlPeriod = "select date_format(date_add(date_format('".$dt_ini."','%Y%m%d'),interval ".$x." month),'%b %Y') period from dual";
                $resultPeriod = mysqli_query($databasecon,$sqlPeriod);
                if(mysqli_num_rows($resultPeriod) > 0)  
                {
                    if($rowPeriod = mysqli_fetch_assoc($resultPeriod)) 
                    {
                        $period=$rowPeriod["period"];
                    }
                }
                if($x==0)
                {
                     $strTemp=$strTemp.'{"c":[{"v":"'.$period.'","f":null}';
                }
                else
                {
                     $strTemp=$strTemp.',{"c":[{"v":"'.$period.'","f":null}';
                }               

                $sqlUsers= "select id user_id,nombre user_name from p_usuario p where p.perfil_id=42 
                and p.client_id=1 
                order by user_name";
                $resultUsers = mysqli_query($databasecon,$sqlUsers);
                if(mysqli_num_rows($resultUsers) > 0)  
                {
                    while($rowUsers = mysqli_fetch_assoc($resultUsers)) 
                    {
                        if($x==0)
                        {
                            $strUsers=$strUsers.',{"id":"","label":"'.$rowUsers["user_name"].'","pattern":"","type":"number"}';
                        }

                        $sql="select date_format(ps.fecha_creacion,'%b %Y') periodo,'".$rowUsers["user_name"]."',count(*) ctr 
                        from p_solicitud ps where  ps.id_tecnico=".$rowUsers["user_id"]." and 
                        date_format(ps.fecha_creacion,'%Y%m')=date_format(date_add(date_format('".$dt_ini."','%Y%m%d'),interval ".$x." month),'%Y%m') and ps.estado=".$estado." 
                        group by date_format(ps.fecha_creacion,'%Y%m') 
                        order by date_format(ps.fecha_creacion,'%Y%m')";
                        $result = mysqli_query($databasecon,$sql);
                        if(mysqli_num_rows($result) > 0)  
                        {
                            while($row = mysqli_fetch_assoc($result)) 
                            {
                                $strTemp=$strTemp.',{"v":'.$row["ctr"].',"f":null}';
                                $count++;
                            }
                        }
                        else
                        {
                            $strTemp=$strTemp.',{"v":0,"f":null}';
                        }
                    }
                    $strTemp=$strTemp.']}';
                }                
            }
            $strData=$strData.'"rows": ['.$strTemp.']';
        }
    }
    $strUsers='"cols": ['.$strUsers.']';
    echo '{'.$strUsers.','.$strData.'}';
?>