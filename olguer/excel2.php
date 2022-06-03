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
    $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'TECNICO'); 
    $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'ESTADO'); 
    $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'PETICIONES');
    session_start();
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();



    
    $dt_ini=$_POST["dt_ini"];
    $dt_fin=$_POST["dt_fin"];
    $estado=3;

    $total_meses=0;
    $strUsers='{"id":"","label":"Users","pattern":"","type":"string"},
            {"id":"","label":"ABIERTO","pattern":"","type":"number"},
            {"id":"","label":"EN CURSO","pattern":"","type":"number"},
            {"id":"","label":"CERRADA","pattern":"","type":"number"}';
    $strData="";
    try
    {
        $clientes=array();
        $count=2; 
        //Fase3-change perfil id                   
        $sqlUsers= "select id user_id,nombre user_name from p_usuario p where p.perfil_id in (28,29) and p.client_id=1 order by user_name";
        $resultUsers = mysqli_query($databasecon,$sqlUsers);
        if(mysqli_num_rows($resultUsers) > 0)  
        {
            while($rowUsers = mysqli_fetch_assoc($resultUsers)) 
            {
                for($j=1;$j<=3;$j++)
                {
                    if($j==1)
                        $estadoText="ABIERTO";
                    else if($j==2)
                        $estadoText="EN CURSO";
                    else if($j==3)
                        $estadoText="CERRADA";

                    /*$sql="select ps.id_tecnico,count(*) ctr from p_solicitud ps 
                    where date_format(ps.fecha_creacion,'%Y%m')>=date_format('".$dt_ini."','%Y%m')
                    and date_format(ps.fecha_creacion,'%Y%m')<=date_format('".$dt_fin."','%Y%m') 
                    and estado=".$j." and ps.id_tecnico=".$rowUsers["user_id"]." and ps.habilitado=1 group by ps.id_tecnico order by ps.id_tecnico";
                    //echo 'sql:'.$sql.'<br>';
                    $result = mysqli_query($databasecon,$sql);
                    if(mysqli_num_rows($result) > 0)  
                    {
                        while($row = mysqli_fetch_assoc($result)) 
                        {
                            $objPHPExcel->getActiveSheet()->SetCellValue('A'."$count", $rowUsers["user_name"]); 
                            $objPHPExcel->getActiveSheet()->SetCellValue('B'."$count", $estadoText); 
                            $objPHPExcel->getActiveSheet()->SetCellValue('C'."$count", $row["ctr"]);

                            $count++;                              
                        }
                    }
                    else
                    {
                        $objPHPExcel->getActiveSheet()->SetCellValue('A'."$count", $rowUsers["user_name"]); 
                        $objPHPExcel->getActiveSheet()->SetCellValue('B'."$count", $estadoText); 
                        $objPHPExcel->getActiveSheet()->SetCellValue('C'."$count", 0);

                        $count++;
                    }*/

                    $sql="select ps.id_tecnico,ps.id nro_peticion from p_solicitud ps 
                    where date_format(ps.fecha_creacion,'%Y%m')>=date_format('".$dt_ini."','%Y%m')
                    and date_format(ps.fecha_creacion,'%Y%m')<=date_format('".$dt_fin."','%Y%m') 
                    and estado=".$j." and ps.id_tecnico=".$rowUsers["user_id"]." and ps.habilitado=1 order by ps.id_tecnico";
                    //echo 'sql:'.$sql.'<br>';
                    $result = mysqli_query($databasecon,$sql);
                    if(mysqli_num_rows($result) > 0)  
                    {
                        while($row = mysqli_fetch_assoc($result)) 
                        {
                            $objPHPExcel->getActiveSheet()->SetCellValue('A'."$count", $rowUsers["user_name"]); 
                            $objPHPExcel->getActiveSheet()->SetCellValue('B'."$count", $estadoText); 
                            $objPHPExcel->getActiveSheet()->SetCellValue('C'."$count", $row["nro_peticion"]);

                            $count++;                              
                        }
                    }
                    /*else
                    {
                        $objPHPExcel->getActiveSheet()->SetCellValue('A'."$count", $rowUsers["user_name"]); 
                        $objPHPExcel->getActiveSheet()->SetCellValue('B'."$count", $estadoText); 
                        $objPHPExcel->getActiveSheet()->SetCellValue('C'."$count", 0);

                        $count++;
                    }*/
                }
                //$count++;
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

        $savedFileName='PETICIONES_GESTIONADAS_POR_USUARIOS_'.date("Ymdhis").'.xlsx';
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
