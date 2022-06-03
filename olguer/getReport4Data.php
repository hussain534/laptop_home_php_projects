<?php


defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();

    $estado=$_GET["estadoPeticion"];
    //$client=$_GET["clientId"];
    $id_tecnico=$_GET["clientId"];//id_tecnico is recieved in param-clientId
    $dt_ini=$_GET["dt_ini"];
    $dt_fin=$_GET["dt_fin"];
    
    //echo 'dt_ini:'.$dt_ini.'<br>';
    //echo 'dt_fin:'.$dt_fin.'<br>';

    $total_meses=0;
    $strMeses='{"id":"","label":"Meses","pattern":"","type":"string"}';
    $strData="";
    $iterrator=0;
    //$sqlClientes= "select id client_id,nombre client_name from p_clientes pc where pc.id>1 and pc.habilitado=1 order by pc.nombre";
    $sqlClientes="select distinct pc.id client_id,pc.nombre client_name from p_solicitud ps,p_clientes pc where ps.client_id=pc.id and ps.id_tecnico=".$id_tecnico;
    $resultClientes = mysqli_query($databasecon,$sqlClientes);
    if(mysqli_num_rows($resultClientes) > 0)  
    {
        while($rowClientes = mysqli_fetch_assoc($resultClientes)) 
        {
            $iterrator++;
            $clientName = $rowClientes["client_name"];
            $client = $rowClientes["client_id"];
            $strData = $strData.'{"c":[{"v":"'.$clientName.'","f":null}';

            $sql="select period_diff(date_format('".$dt_fin."','%Y%m'),date_format('".$dt_ini."','%Y%m')) total_meses from dual";
            
            $result = mysqli_query($databasecon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
                if($row = mysqli_fetch_assoc($result)) 
                {
                    $clientes=array();
                    $count=0;
                    $strTemp="";
                    $total_meses=$row["total_meses"];
                    for($x=0;$x<=$total_meses;$x++)
                    {
                        $sqlMes = "select date_format(date_add(date_format('".$dt_ini."','%Y%m%d'),interval ".$x." month),'%b %Y') period from dual";
                        $resultMes = mysqli_query($databasecon,$sqlMes);
                        if(mysqli_num_rows($resultMes) > 0)  
                        {
                            if($rowMes = mysqli_fetch_assoc($resultMes)) 
                            {
                                $period= $rowMes["period"];
                            }
                        }
                        if($iterrator<=1)
                            $strMeses = $strMeses.',{"id":"","label":"'.$period.'","pattern":"","type":"number"}';

                                                                        
                        $sql="select ps.client_id,count(*) ctr from p_solicitud ps
                        where date_format(ps.fecha_creacion,'%Y%m')=date_format(date_add(date_format('".$dt_ini."','%Y%m%d'),interval ".$x." month),'%Y%m') 
                        and ps.estado=".$estado." and ps.client_id=".$client." and ps.id_tecnico=".$id_tecnico." and ps.habilitado=1 group by ps.client_id";
                        //echo 'sql:'.$sql.'<br>';
                        $result = mysqli_query($databasecon,$sql);
                        if(mysqli_num_rows($result) > 0)  
                        {
                            if($row = mysqli_fetch_assoc($result)) 
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
                    $strData=$strData.$strTemp.']},';
                }
            }
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