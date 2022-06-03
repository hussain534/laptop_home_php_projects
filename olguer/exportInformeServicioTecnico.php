<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php');    
    require 'dbcontroller.php';
    $session_time=$session_expirry_time;
    $DEBUG_STATUS = $PRINT_LOG;
    $controller = new controller();
    if(!isset($_SESSION["user_name"]))
    {
        $url='index.php?error=1';
        header("Location:$url");
    }
   $peticionId=0;
    if(isset($_GET["peticion"]))
        $peticionId=$_GET["peticion"];
    
    $reportDtl = $controller->getInformeST($databasecon,$peticionId,$DEBUG_STATUS);
    $partesDtl = $controller->getInformeSTPartes($databasecon,$peticionId,$DEBUG_STATUS);
    $detalle = $controller->getDetallesForInformeST($databasecon,$peticionId,$DEBUG_STATUS);



    require("writeToPDF/fpdf.php");
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->Image('images/logo.png',10,16,32);
    $pdf->SetFont("Arial","B","8");
    
    $pdf->Cell(0,5,"Calle El Arenal OE11-192 y Panamericana Norte",0,1,"C");
    $pdf->Cell(0,5,"Telfs Quito: (02) 23477-164 / 2420-098 / 2428-005",0,1,"C");
    $pdf->Cell(120,5,"Guayaquil: (04) 2082-809 / 2082-149",0,0,"R");
    $pdf->Cell(100,5,"REPORTE DE SERVICIO TECNICO",0,1,"C");    
    $pdf->Cell(122,5,"e-mail: ventasecuador@nipromed.com",0,0,"R");
    $pdf->Cell(100,5,"No.".$reportDtl[0][0],0,1,"C"); 
    $pdf->Cell(0,5,"www.nipro.com.ec",0,1,"C");
    $pdf->Cell(0,5,"Quito - Ecuador",0,1,"C");
    
    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->SetFont("Arial","B","14");
    $pdf->Cell(0,5,"INFORME DE SERVICIO TECNICO",0,1,"C");

    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->SetFont("Arial","B","10");
    $pdf->MultiCell(0,5,"DATOS DEL EQUIPO" ,0,'L',false);

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"RESPONSABLE:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$detalle[0][1],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"CIUDAD:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$detalle[0][2],1,1,"L");


    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"CLIENTE:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$detalle[0][3],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"EQUIPO:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$detalle[0][4],1,1,"L");


    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"SERIE:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$detalle[0][5],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"CICLOS:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$reportDtl[0][3],1,1,"L");


    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"CONTACTO:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(145,8,$reportDtl[0][4],1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"FECHA(AAAA-MM-DD):",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$detalle[0][7],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"DESDE:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$reportDtl[0][5],1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"HASTA:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$reportDtl[0][6],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"HORA VIAJE:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$reportDtl[0][7],1,1,"L");

    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->SetFont("Arial","B","10");
    $pdf->MultiCell(0,5,"DIAGNOSTICO Y/O FALLA REPORTADA" ,0,'L',false);


    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"CODIGO DEL SERVICIO:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(145,8,$detalle[0][0],1,1,"L");

    $pdf->Cell(0,5,"",0,1,"C");

    $pdf->SetFont("Arial","B","10");
    $pdf->MultiCell(0,5,"DESCRIPCION DEL SERVICIO" ,1,'L',false);
    $pdf->SetFont("Arial","","10");
    $pdf->MultiCell(0,5,$detalle[0][6] ,1,'L',false);

    $pdf->Cell(0,5,"",0,1,"C");

    $pdf->SetFont("Arial","B","10");
    $pdf->MultiCell(0,5,"El equipo ha sido validado siguiendo las especificaciones de fábrica del mantenimiento preventivo y/o correctivo" ,1,'L',false);
    $pdf->SetFont("Arial","","10");
    if($reportDtl[0][8]==1)
        $pdf->MultiCell(0,5,"SI" ,1,'L',false);
    else
        $pdf->MultiCell(0,5,"NO" ,1,'L',false);

    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->SetFont("Arial","B","10");
    $pdf->MultiCell(0,5,"PARTES UTILIZADOS EN SERVICIO" ,0,'L',false);


    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"NOMBRE PARTE:",1,0,"L");    
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(50,8,"CANTIDAD:",1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,8,"DESCRIPCION",1,1,"L");

    for($z=0;$z<count($partesDtl);$z++)
    {
        $pdf->SetFont("Arial","","10");
        $pdf->Cell(45,8,$partesDtl[$z][0],1,0,"L");    
        $pdf->SetFont("Arial","","10");
        $pdf->Cell(50,8,$partesDtl[$z][1],1,0,"L");
        $pdf->SetFont("Arial","","10");
        $pdf->Cell(95,8,$partesDtl[$z][2],1,1,"L");
    }

    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->SetFont("Arial","B","10");
    $pdf->MultiCell(0,5,"FIRMAS DE CONFORMIDAD" ,0,'L',false);

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(65,8,"FIRMA INGENIERO RESPONSABLE:",1,0,"L");    
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(65,8,"FIRMA DEL CLIENTE:",1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(60,8,"TRABAJO TERMINADO",1,1,"L");


    $pdf->SetFont("Arial","B","10");
    $pdf->MultiCell(0,5,"Recibimos a satisfaccion los trabajos y materiales relacionados con este reporte." ,0,'C',false);

    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->Cell(0,5,"",0,1,"C");

    $pdf->SetFont("Arial","","10");
    $pdf->Cell(65,5,$detalle[0][1],0,0,"C");
    $pdf->Cell(65,5,$reportDtl[0][9],0,0,"C");
    if($reportDtl[0][10]==1)
        $pdf->Cell(60,5,"SI",0,1,"C");
    else
        $pdf->Cell(60,5,"NO",0,1,"C");
    
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(65,5,$_SESSION["client_name"],0,0,"C");
    $pdf->Cell(65,5,$detalle[0][3],0,0,"C");
    $pdf->Cell(60,5,"",0,1,"C");

    
    

    $pdf->Output();
?>