<?php
error_reporting(0);
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/Writer/Excel2007.php';

$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0); 

 $style = array('font' => array('size' => 10,'bold' => true,'color' => array('rgb' => 'ccb0f0')));

//apply the style on column A row 1 to Column B row 1
$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($style);

// Add some data 
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'MES'); 
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'TECNICO'); 
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'PETICIONES');


    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();
    
    $estado=$_POST["estado"];
    $dt_ini=$_POST["dt_ini"];
    $dt_fin=$_POST["dt_fin"];
    try
    {
        $sql="select period_diff(date_format('".$dt_fin."','%Y%m'),date_format('".$dt_ini."','%Y%m')) total_meses from dual";
        $total_meses=0;
        
        $result = mysqli_query($databasecon,$sql);
        if(mysqli_num_rows($result) > 0)  
        {
            if($row = mysqli_fetch_assoc($result)) 
            {
                $total_meses=$row["total_meses"];
                $count=2;
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

                    //Fase3-change perfil id
                    $sqlUsers= "select id user_id,nombre user_name from p_usuario p where p.perfil_id in (28,29) and p.client_id=1 order by user_name";
                    $resultUsers = mysqli_query($databasecon,$sqlUsers);
                    if(mysqli_num_rows($resultUsers) > 0)  
                    {
                        while($rowUsers = mysqli_fetch_assoc($resultUsers)) 
                        {

                            /*if($estado==4)
                            {
                                $sql="select date_format(ps.fecha_creacion,'%b %Y') periodo,'".$rowUsers["user_name"]."',count(*) ctr 
                                from p_solicitud ps where  ps.id_tecnico=".$rowUsers["user_id"]." and ps.habilitado=1 and  
                                date_format(ps.fecha_creacion,'%Y%m')=date_format(date_add(date_format('".$dt_ini."','%Y%m%d'),interval ".$x." month),'%Y%m')  
                                group by date_format(ps.fecha_creacion,'%Y%m') order by date_format(ps.fecha_creacion,'%Y%m')";
                            }
                            else
                            {
                                $sql="select date_format(ps.fecha_creacion,'%b %Y') periodo,'".$rowUsers["user_name"]."',count(*) ctr 
                                from p_solicitud ps where  ps.id_tecnico=".$rowUsers["user_id"]." and ps.habilitado=1 and  
                                date_format(ps.fecha_creacion,'%Y%m')=date_format(date_add(date_format('".$dt_ini."','%Y%m%d'),interval ".$x." month),'%Y%m') and ps.estado=".$estado." 
                                group by date_format(ps.fecha_creacion,'%Y%m') order by date_format(ps.fecha_creacion,'%Y%m')";
                            }
                            $result = mysqli_query($databasecon,$sql);
                            
                            if(mysqli_num_rows($result) > 0)  
                            {
                                if($row = mysqli_fetch_assoc($result)) 
                                {
                                    $objPHPExcel->getActiveSheet()->SetCellValue('A'."$count", $period); 
                                    $objPHPExcel->getActiveSheet()->SetCellValue('B'."$count", $rowUsers["user_name"]); 
                                    $objPHPExcel->getActiveSheet()->SetCellValue('C'."$count", $row["ctr"]);
                                }
                            }
                            else
                            {
                                $objPHPExcel->getActiveSheet()->SetCellValue('A'."$count", $period); 
                                $objPHPExcel->getActiveSheet()->SetCellValue('B'."$count", $rowUsers["user_name"]); 
                                $objPHPExcel->getActiveSheet()->SetCellValue('C'."$count", 0);
                            } 
                            $count=$count+1;*/    

                            if($estado==4)
                            {
                                $sql="select date_format(ps.fecha_creacion,'%b %Y') periodo,'".$rowUsers["user_name"]."',ps.id nro_peticion  
                                from p_solicitud ps where  ps.id_tecnico=".$rowUsers["user_id"]." and ps.habilitado=1 and  
                                date_format(ps.fecha_creacion,'%Y%m')=date_format(date_add(date_format('".$dt_ini."','%Y%m%d'),interval ".$x." month),'%Y%m')  
                                order by date_format(ps.fecha_creacion,'%Y%m')";
                            }
                            else
                            {
                                $sql="select date_format(ps.fecha_creacion,'%b %Y') periodo,'".$rowUsers["user_name"]."',ps.id nro_peticion  
                                from p_solicitud ps where  ps.id_tecnico=".$rowUsers["user_id"]." and ps.habilitado=1 and  
                                date_format(ps.fecha_creacion,'%Y%m')=date_format(date_add(date_format('".$dt_ini."','%Y%m%d'),interval ".$x." month),'%Y%m') and ps.estado=".$estado." 
                                order by date_format(ps.fecha_creacion,'%Y%m')";
                            }
                            $result = mysqli_query($databasecon,$sql);
                            
                            if(mysqli_num_rows($result) > 0)  
                            {
                                while($row = mysqli_fetch_assoc($result)) 
                                {
                                    $objPHPExcel->getActiveSheet()->SetCellValue('A'."$count", $period); 
                                    $objPHPExcel->getActiveSheet()->SetCellValue('B'."$count", $rowUsers["user_name"]); 
                                    $objPHPExcel->getActiveSheet()->SetCellValue('C'."$count", $row["nro_peticion"]);
                                    $count=$count+1;
                                }
                            }
                                         
                        }
                    }                
                }
            }
        }
    }
    catch(Exception $e)
    {
        //$worksheet->write(1, 5, 'EXCEPTION');
    }
    finally
    {
        //$workbook->close();
        $objPHPExcel->getActiveSheet()->setTitle('Resumen'); 


        /*
            Create Addtional sheet        
        */

        /*$objPHPExcel->createSheet(1);
        $objPHPExcel->setActiveSheetIndex(1); 
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'MES'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'USUARIO'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'PETICIONES');
        $objPHPExcel->getActiveSheet()->setTitle('Report-1.1');*/
       
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 

        // save to a file 
        //$objWriter->save('/home/jasbir/Documents/Employees.xls'); 
        
        $savedFileName='PETICIONES_GESTIONADAS_POR_USUARIOS_POR_MES_'.date("Ymdhis").'.xlsx';
        // You may optionally output the data directly to a browser, here's how 
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
        header('Content-Disposition: attachment;filename="'.$savedFileName.'"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter->save('php://output');

        
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
