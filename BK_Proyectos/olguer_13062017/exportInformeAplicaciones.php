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
    $reportDtl = $controller->getReport6($databasecon,$peticionId,$DEBUG_STATUS);

    $peticionDtl = $controller->getReport6PeticionDtl($databasecon,$peticionId,$DEBUG_STATUS);



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
    $pdf->Cell(0,5,"REPORTE DE VISITA / SERVICIO",0,1,"C");

    $pdf->Cell(0,5,"",0,1,"C");

    
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"CLIENTE:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$peticionDtl[0][0],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"CIUDAD:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$peticionDtl[0][1],1,1,"L");


    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"UBICACION:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$peticionDtl[0][2],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"TELEFONO:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$peticionDtl[0][3],1,1,"L");


    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"FECHA SOLICITUD:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$peticionDtl[0][4],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"FECHA INICIO:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$peticionDtl[0][5],1,1,"L");


    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"FECHA ENTREGA:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$peticionDtl[0][6],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"EQUIPO:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$peticionDtl[0][7],1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"MODELO:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$peticionDtl[0][8],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"SERIE:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$peticionDtl[0][9],1,1,"L");

    if($reportDtl[0][5]==0)
        $strId1="NO";
    else
        $strId1="SI";

    if($reportDtl[0][6]==0)
        $strId2="NO";
    else
        $strId2="SI";

    if($reportDtl[0][7]==0)
        $strId3="NO";
    else
        $strId3="SI";

    if($reportDtl[0][8]==0)
        $strId4="NO";
    else
        $strId4="SI";

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(30,8,"SERV FACT:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(15,8,$strId1,1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(30,8,"COMODOTO:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(15,8,$strId2,1,0,"L");
    
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(30,8,"GARANTIA:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(20,8,$strId3,1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(30,8,"CONTRATO:",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(20,8,$strId4,1,1,"L");

    
    $pdf->Cell(0,5,"",0,1,"C");

    $pdf->SetFont("Arial","B","10");
    $pdf->MultiCell(0,5,"PROBLEMA REPORTADO" ,1,'L',false);
    $pdf->SetFont("Arial","","10");
    $pdf->MultiCell(0,5,$peticionDtl[0][10] ,1,'L',false);

    $pdf->SetFont("Arial","B","10");
    $pdf->MultiCell(0,5,"ACCION TOMADO" ,1,'L',false);
    $pdf->SetFont("Arial","","10");
    $pdf->MultiCell(0,5,$peticionDtl[0][11] ,1,'L',false);

    $pdf->Cell(0,5,"",0,1,"C");


    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,8,"DEPARTAMENTO DE ASESORIA:",0,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,8,"RECIBIDO A SATISFACCION POR:",0,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(25,8,"NOMBRE:",0,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(70,8,$_SESSION["user_name"],0,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(25,8,"NOMBRE:",0,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(70,8,$peticionDtl[0][2],0,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,8,"",0,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(25,8,"CEDULA:",0,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(70,8,$peticionDtl[0][3],0,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(25,8,"FIRMA:",0,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(70,8,"",0,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(25,8,"FIRMA:",0,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(70,8,"",0,1,"L");

    
    

    $pdf->Output();
?>