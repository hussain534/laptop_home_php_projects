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
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'SERVICIO'); 
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'CLIENTE'); 
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'PETICIONES');


    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();
    
    try
    {
        $serviceId=$_POST["serviceId"];
        $clientId=$_POST["clientId"];
        $dt_ini=$_POST["dt_ini"];
        $dt_fin=$_POST["dt_fin"];
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


        $total_meses=0;
        $strUsers='{"id":"","label":"Meses","pattern":"","type":"string"}';
        $strUsers=$strUsers.',{"id":"","label":"'.$serviceDesc.'","pattern":"","type":"number"}';
        $strData="";
        $strTemp="";
        $count=2;
        $result = mysqli_query($databasecon,$sql);
        if(mysqli_num_rows($result) > 0)  
        {
            
            $clientes=array();
            while($row = mysqli_fetch_assoc($result))
            {


                $sql="select id from p_solicitud ps where ps.service_id=".$serviceId." and ps.client_id =".$row["id"]." and ps.habilitado=1 
                    and date_format(ps.fecha_creacion,'%Y%m')>=date_format('".$dt_ini."','%Y%m') 
                    and date_format(ps.fecha_creacion,'%Y%m')<=date_format('".$dt_fin."','%Y%m')";
                $result1 = mysqli_query($databasecon,$sql);
                if(mysqli_num_rows($result1) > 0)  
                {
                    while($row1 = mysqli_fetch_assoc($result1)) 
                    {
                        //$strTemp=$strTemp.'{"c":[{"v":"'.$row["nombre"].'","f":null}';
                        //$strTemp=$strTemp.',{"v":'.$row1["ctr"].',"f":null}';
                        //$strTemp=$strTemp.']},';

                        $objPHPExcel->getActiveSheet()->SetCellValue('A'."$count", $serviceDesc); 
                        $objPHPExcel->getActiveSheet()->SetCellValue('B'."$count", $row["nombre"]); 
                        $objPHPExcel->getActiveSheet()->SetCellValue('C'."$count", $row1["id"]);
                        $count=$count+1;

                    }
                }                   
            }
            //$strData=$strData.'"rows": ['.$strTemp.']';
        }
        //$strUsers='"cols": ['.$strUsers.']';
        //echo '{'.$strUsers.','.$strData.'}';
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
        
        $savedFileName='GESTION_SERVICIOS_POR_CLIENTE_'.date("Ymdhis").'.xlsx';
        
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
