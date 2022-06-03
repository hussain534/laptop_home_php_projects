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
    $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'CLIENTE'); 
    $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'TIPO CLIENTE'); 
    $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'ESTADO');
    $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'PETICION');
    session_start();
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();
    
    $dt_ini=$_POST["dt_ini"];
    $dt_fin=$_POST["dt_fin"];
    //$tipo_cliente=1;
    $estado=$_POST["estadoPeticion"];
    $tipo_cliente=$_POST["tipoCliente"];

    if($estado==1)
        $estadoTsxt="ABIERTO";
    else if($estado==2)
        $estadoTsxt="EN CURSO";
    else if($estado==3)
        $estadoTsxt="CERRADO";
    else if($estado==99)
        $estadoTsxt="TODOS";

    //echo 'dt_ini:'.$dt_ini.'<br>';
    //echo 'dt_fin:'.$dt_fin.'<br>';
    
    $clientes=array();
    $count=2;    
    $total=0;                
    //$strTemp="";
    try
    {    
        if($estado==99)
        {
            $sql="select pc.nombre client_name,ps.id id_solicitud ,
                (case when pc.tipo_cliente=1 then 'RENAL' when pc.tipo_cliente=2 then 'LABORATORIO' else 'NA' end) tipo_cliente,
                (case when ps.estado=1 then 'ABIERTO' when ps.estado=2 then 'EN CURSO' when ps.estado=3 then 'CERRADO' else 'NA' end) label_estado 
                    from p_solicitud ps,p_clientes pc where ps.client_id=pc.id 
                and date_format(ps.fecha_creacion,'%Y%m')>=date_format('".$dt_ini."','%Y%m')
                and date_format(ps.fecha_creacion,'%Y%m')<=date_format('".$dt_fin."','%Y%m') and ps.habilitado=1";
        }
        else
        {
            $sql="select pc.nombre client_name,ps.id id_solicitud ,
                (case when pc.tipo_cliente=1 then 'RENAL' when pc.tipo_cliente=2 then 'LABORATORIO' else 'NA' end) tipo_cliente,'".$estadoTsxt."' label_estado 
                from p_solicitud ps,p_clientes pc where ps.client_id=pc.id 
            and date_format(ps.fecha_creacion,'%Y%m')>=date_format('".$dt_ini."','%Y%m')
            and date_format(ps.fecha_creacion,'%Y%m')<=date_format('".$dt_fin."','%Y%m') and ps.habilitado=1 
            and ps.estado=".$estado;
        }
        if($tipo_cliente!=99)
            $sql=$sql." and pc.tipo_cliente=".$tipo_cliente;
        $sql=$sql." order by client_name";
        //echo 'sql:'.$sql.'<br>';
        $result = mysqli_query($databasecon,$sql);
        if(mysqli_num_rows($result) > 0)  
        {
            while($row = mysqli_fetch_assoc($result)) 
            {
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$count, $row["client_name"]);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$count, $row["tipo_cliente"]);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$count, $row["label_estado"]);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$count, $row["id_solicitud"]);
                $count++;
            }
        }
        //echo print_r($clientes).'<br>';

        /*for($x=0;$x<count($clientes);$x++)
        {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'."(2+$x)", $clientes[$x][0]);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'."(2+$x)", $clientes[$x][2]);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'."(2+$x)", $estadoTsxt);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'."(2+$x)", round($clientes[$x][1]*100/$total,2));
        }  */
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
        
        $savedFileName='PETICIONES_GESTIONADAS_POR_CLIENTES_'.date("Ymdhis").'.xlsx';

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
