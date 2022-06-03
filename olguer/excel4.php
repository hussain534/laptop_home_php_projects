<?php
    error_reporting(0);
    require_once 'Classes/PHPExcel.php';
    require_once 'Classes/PHPExcel/Writer/Excel2007.php';

    $objPHPExcel = new PHPExcel();

    $objPHPExcel->setActiveSheetIndex(0); 

    $style = array('font' => array('size' => 10,'bold' => true,'color' => array('rgb' => 'ccb0f0')));

    //apply the style on column A row 1 to Column B row 1
    $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($style);

    // Add some data 
    $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'TECNICO'); 
    $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'CLIENTE'); 
    $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'MES');
    $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'PETICIONES');

    session_start();
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();

    $estado=$_POST["estadoPeticion"];
    $id_tecnico=$_POST["clientId"];//id_tecnico is recieved in param-clientId
    $dt_ini=$_POST["dt_ini"];
    $dt_fin=$_POST["dt_fin"];
    $tec_name=$_POST["tec_name"];

    if($estado==1)
        $estadoTsxt="ABIERTO";
    else if($estado==2)
        $estadoTsxt="EN CURSO";
    else if($estado==3)
        $estadoTsxt="CERRADO";
    else if($estado==4)
        $estadoTsxt="TODOS";
    
    //echo 'dt_ini:'.$dt_ini.'<br>';
    //echo 'dt_fin:'.$dt_fin.'<br>';

    try
    {
        $total_meses=0;
        //$strMeses='{"id":"","label":"Meses","pattern":"","type":"string"}';
        $strData="";
        $iterrator=0;
        $count=2;
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
                //$strData = $strData.'{"c":[{"v":"'.$clientName.'","f":null}';

                $sql="select period_diff(date_format('".$dt_fin."','%Y%m'),date_format('".$dt_ini."','%Y%m')) total_meses from dual";
                
                $result = mysqli_query($databasecon,$sql);
                if(mysqli_num_rows($result) > 0)  
                {
                    if($row = mysqli_fetch_assoc($result)) 
                    {
                        $clientes=array();
                        
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
                            
                                                                            
                            $sql="select ps.client_id,ps.id id_solicitud from p_solicitud ps
                            where date_format(ps.fecha_creacion,'%Y%m')=date_format(date_add(date_format('".$dt_ini."','%Y%m%d'),interval ".$x." month),'%Y%m') 
                            and ps.estado=".$estado." and ps.client_id=".$client." and ps.id_tecnico=".$id_tecnico." and ps.habilitado=1";
                            //echo 'sql:'.$sql.'<br>';
                            $result = mysqli_query($databasecon,$sql);
                            /*if(mysqli_num_rows($result) > 0)  
                            {
                                while($row = mysqli_fetch_assoc($result)) 
                                {
                                    $objPHPExcel->getActiveSheet()->SetCellValue('A'."((($iterrator-1)*($total_meses+1))+($x+1))", $tec_name);
                                    $objPHPExcel->getActiveSheet()->SetCellValue('B'."((($iterrator-1)*($total_meses+1))+($x+1))", $clientName);
                                    $objPHPExcel->getActiveSheet()->SetCellValue('C'."((($iterrator-1)*($total_meses+1))+($x+1))", $period);
                                    $objPHPExcel->getActiveSheet()->SetCellValue('D'."((($iterrator-1)*($total_meses+1))+($x+1))", $row["id_solicitud"]);
                                    $count++;
                                }
                            }
                            else
                            {
                                $objPHPExcel->getActiveSheet()->SetCellValue('A'."((($iterrator-1)*($total_meses+1))+($x+1))", $tec_name);
                                $objPHPExcel->getActiveSheet()->SetCellValue('B'."((($iterrator-1)*($total_meses+1))+($x+1))", $clientName);
                                $objPHPExcel->getActiveSheet()->SetCellValue('C'."((($iterrator-1)*($total_meses+1))+($x+1))", $period);
                                $objPHPExcel->getActiveSheet()->SetCellValue('D'."((($iterrator-1)*($total_meses+1))+($x+1))", 0);
                                $count++;
                            }*/       

                            if(mysqli_num_rows($result) > 0)  
                            {
                                while($row = mysqli_fetch_assoc($result)) 
                                {
                                    $objPHPExcel->getActiveSheet()->SetCellValue('A'."$count", $tec_name);
                                    $objPHPExcel->getActiveSheet()->SetCellValue('B'."$count", $clientName);
                                    $objPHPExcel->getActiveSheet()->SetCellValue('C'."$count", $period);
                                    $objPHPExcel->getActiveSheet()->SetCellValue('D'."$count", $row["id_solicitud"]);
                                    $count++;
                                }
                            }            
                        }
                    }
                }
            }
        }
        
        $objPHPExcel->getActiveSheet()->setTitle('Resumen'); 

        /*if(isset($_POST["cltest"]))
        {
            $clId=$_POST["cltest"];         

            $objPHPExcel->createSheet(1);
            $objPHPExcel->setActiveSheetIndex(1); 
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'PETICIONES'); 
            $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'DIAS'); 
            $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'FECHA INICIO');
            $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'FECHA FIN');
           

             $sql="select ps.id, IFNULL(datediff((select max(pc.fecha_creacion) from p_peticion_comments pc where pc.id=ps.id),ps.fecha_creacion),0) nro_dias,
                     ps.fecha_creacion,(select max(pc.fecha_creacion) from p_peticion_comments pc where pc.id=ps.id) fecha_fin
                    from p_solicitud ps where  ps.client_id=".$clId." and 
                    ps.id_tecnico=".$_POST["clientId"]." and ps.estado=".$estado." and date_format(ps.fecha_creacion,'%Y%m')>=date_format('".$dt_ini."','%Y%m') 
                    and date_format(ps.fecha_creacion,'%Y%m')<=date_format('".$dt_fin."','%Y%m') ";
            $result = mysqli_query($databasecon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
                $ctr=2;
                
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $objPHPExcel->getActiveSheet()->SetCellValue('A'."$ctr", $row["id"]); 
                    $objPHPExcel->getActiveSheet()->SetCellValue('B'."$ctr", $row["nro_dias"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('C'."$ctr", $row["fecha_creacion"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('D'."$ctr", $row["fecha_fin"]);
                    $ctr++;
                }
            }
            $objPHPExcel->getActiveSheet()->setTitle('Report-4-PETICIONES');
        }*/
    }
    catch(Exception $e)
    {
        //$worksheet->write(1, 5, 'EXCEPTION');
    }
    finally
    {
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 

        // save to a file 
        //$objWriter->save('/home/jasbir/Documents/Employees.xls'); 
        $savedFileName='PETICIONES_GESTIONADAS_POR_CLIENTE_MES_'.date("Ymdhis").'.xlsx';

        // You may optionally output the data directly to a browser, here's how 
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter->save('php://output');

        // save to a file 
        
        
        /* try
        {
            $objWriter->save($savedFilePath.$savedFileName);
            echo 'Reporte -'.$savedFileName.' guardado correctamente en ruta: '.$savedFilePath;
        }
        catch(Exception $e)
        {
            echo 'Error en guardar reporte.';
        }*/

    }
?>
