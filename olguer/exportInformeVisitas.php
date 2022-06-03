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
    $reportDtl = $controller->getReport7($databasecon,$peticionId,$DEBUG_STATUS);

    $peticionDtl = $controller->getReport7PeticionDtl($databasecon,$peticionId,$DEBUG_STATUS);



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
    $pdf->Cell(0,5,"VISITA DE CONTROL",0,1,"C");

    $pdf->Cell(0,5,"",0,1,"C");

    
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(60,8,"CLIENTE:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(130,8,$peticionDtl[0][0],1,1,"L");


    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(60,8,"FECHA-HORA SOLICITUD:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(130,8,$peticionDtl[0][1],1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(60,8,"FECHA-HORA INICIO:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(130,8,$peticionDtl[0][2],1,1,"L");


    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(60,8,"FECHA-HORA FINALIZACION:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(130,8,$peticionDtl[0][3],1,1,"L");


    $pdf->SetFont("Arial","B","10");
    $pdf->MultiCell(0,5,"DESCRIPCION DEL TRABAJO" ,1,'L',false);
    $pdf->SetFont("Arial","","10");
    $pdf->MultiCell(0,5,$peticionDtl[0][4] ,1,'L',false);

    

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(60,8,"TECNICO A CARGO:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(130,8,$_SESSION["user_name"],1,1,"L");

    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->Cell(0,5,"",0,1,"C");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,8,$peticionDtl[0][0],0,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,8,$_SESSION["client_name"],0,1,"C");

    
    

    $pdf->Output();
?>