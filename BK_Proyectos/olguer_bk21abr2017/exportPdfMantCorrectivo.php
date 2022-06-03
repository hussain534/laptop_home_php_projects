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
    
    $reportDtl = $controller->getReport5($databasecon,$peticionId,$DEBUG_STATUS);

    $peticionHist = $controller->getPeticionComments2($databasecon,$peticionId,$DEBUG_STATUS);
    $peticionDtl = $controller->getPeticionDtl($databasecon,$peticionId,$DEBUG_STATUS);
    $cur_date = $controller->getCurDate($databasecon,$DEBUG_STATUS);



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

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(50,8,"CLIENTE",1,0,"L");
    $pdf->Cell(90,8,"CIUDAD",1,0,"C");
    $pdf->Cell(50,8,"TELEFONO",1,1,"R");


    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,5,$peticionDtl[0][2],1,0,"L");
    $pdf->Cell(90,5,$peticionDtl[0][3],1,0,"C");
    $pdf->Cell(50,5,$peticionDtl[0][10],1,1,"R");

    $pdf->Cell(0,5,"",0,1,"C");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(50,8,"FECHA(DDMMAAAA)",1,0,"L");
    $pdf->Cell(90,8,"HORA ENTRADA",1,0,"C");
    $pdf->Cell(50,8,"HORA SALIDA",1,1,"R");

    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,5,$cur_date,1,0,"L");
    $pdf->Cell(90,5,$reportDtl[0][3],1,0,"C");
    $pdf->Cell(50,5,$reportDtl[0][4],1,1,"R");

    $pdf->Cell(0,5,"",0,1,"C");
    
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(50,8,"EQUIPO",1,0,"L");
    $pdf->Cell(90,8,"SERIE",1,0,"C");
    $pdf->Cell(50,8,"CICLOS",1,1,"R");

    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,5,$peticionHist[0][3],1,0,"L");
    $pdf->Cell(90,5,$peticionHist[0][6],1,0,"C");
    $pdf->Cell(50,5,$reportDtl[0][5],1,1,"R");

    $pdf->Cell(0,5,"",0,1,"C");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(0,8,"MOTIVO DE LLAMADA",1,1,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->MultiCell(0,5,$peticionDtl[0][6] ,1,'L',false);

    $pdf->Cell(0,5,"",0,1,"C");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(0,8,"ACCION TOMADA",1,1,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->MultiCell(0,5,$peticionHist[0][0] ,1,'L',false);

    $pdf->Cell(0,5,"",0,1,"C");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(0,8,"REPUESTOS UTILIZADOS",1,1,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->MultiCell(0,5,"DESCRIPCION  :  ".$reportDtl[0][6] ,1,'L',false);
    $pdf->MultiCell(0,5,"CODIGO            :  ".$reportDtl[0][7] ,1,'L',false);
    $pdf->MultiCell(0,5,"CANTIDAD        :  ".$reportDtl[0][8] ,1,'L',false);

    $pdf->Cell(0,5,"",0,1,"C");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(0,8,"OBSERVACIONES",1,1,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->MultiCell(0,5,$reportDtl[0][9] ,1,'L',false);

    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->Cell(0,5,"",0,1,"C");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,5,"----------------------------",0,0,"C");
    $pdf->Cell(95,5,"----------------------------",0,1,"C");

    $pdf->SetFont("Arial","","10");
    $pdf->Cell(95,5,$reportDtl[0][10],0,0,"C");
    $pdf->Cell(95,5,$peticionHist[0][2],0,1,"C");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,5,$peticionDtl[0][2],0,0,"C");
    $pdf->Cell(95,5,$_SESSION["client_name"],0,1,"C");
    

    $pdf->Output();
?>