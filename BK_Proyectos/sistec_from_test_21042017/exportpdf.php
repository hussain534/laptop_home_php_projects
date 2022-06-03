<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    include_once('config.php');	
	require 'dbcontroller.php';
	$controller = new controller();
	if(!isset($_SESSION["user_name"]))
	{
		$url='index.php?error=1';
		header("Location:$url");
	}
	$peticionId=0;
	if(isset($_GET["peticion"]))
		$peticionId=$_GET["peticion"];
	$DEBUG_STATUS=false;
	$peticionDtl = $controller->getPeticionDtl($databasecon,$peticionId,$DEBUG_STATUS);
	$peticionHist = $controller->getPeticionCommentsPDF($databasecon,$peticionId,$DEBUG_STATUS);
	require("writeToPDF/fpdf.php");
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->Image('images/logo.png',10,10,32);
	$pdf->SetFont("Arial","B","14");
	$pdf->Cell(140,10,"NIPRO MEDICAL CORPORATION",0,0,"R");
	$pdf->SetFont("Arial","","10");
	date_default_timezone_set('America/Bogota');

    // Then call the date functions
    $date = date('d-m-Y H:i:s A');

	$pdf->Cell(0,7,$date,0,1,"R");

	$pdf->Cell(0,7,"Informe de visitas",0,1,"C");
	if(isset($peticionHist) && count($peticionHist)>0)
	{
		$pdf->Cell(0,7,$peticionHist[0][2],1,0,"L");
		$pdf->Cell(0,7,$peticionDtl[0][8],1,1,"R");
	}


	

	$pdf->Cell(0,7,$peticionDtl[0][2],1,1,"C");

	$pdf->SetFont("Arial","B","10");
	$pdf->Cell(35,7,"DETALLE PETICION:",0,0,"L");
	$pdf->SetFont("Arial","","10");
	$pdf->MultiCell(160,7,$peticionDtl[0][6]);

	$pdf->SetFont("Arial","B","10");
	$pdf->Cell(35,7,"DIRECCION:",0,0,"L");
	$pdf->SetFont("Arial","","10");
	$pdf->Cell(0,7,$peticionDtl[0][3].",".$peticionDtl[0][4].",".$peticionDtl[0][5],0,1,"L");

	$pdf->SetFont("Arial","B","10");
	$pdf->Cell(35,7,"PETICION:",0,0,"L");
	$pdf->SetFont("Arial","","10");
	$pdf->Cell(0,7,$peticionId,0,1,"L");

	$pdf->SetFont("Arial","B","10");
	$pdf->Cell(35,7,"TIPO SERVICIO:",0,0,"L");
	$pdf->SetFont("Arial","","10");
	$pdf->Cell(0,7,$peticionDtl[0][1],0,1,"L");

	for($x=0;$x<count($peticionHist);$x++)
	{
		$pdf->SetFont("Arial","B","10");
		$pdf->Cell(35,7,"Fecha-Hora visita:",0,0,"L");
		$pdf->SetFont("Arial","","10");
		$pdf->Cell(0,7,$peticionHist[$x][1],0,1,"L");
		/*$pdf->SetFont("Arial","B","10");
		$pdf->Cell(70,7,"Formulario:",0,0,"R");
		$pdf->SetFont("Arial","","10");
		$pdf->Cell(0,7,"Registro de Visita y Gestion",0,1,"R");*/

		

		$pdf->SetFont("Arial","B","10");
		$pdf->Cell(35,7,"ESTADO:",0,0,"L");
		$pdf->SetFont("Arial","","10");
		$pdf->Cell(0,7,$peticionHist[$x][4],0,1,"L");

		$pdf->SetFont("Arial","B","10");
		$pdf->Cell(35,7,"EQUIPO:",0,0,"L");
		$pdf->SetFont("Arial","","10");
		$pdf->Cell(0,7,$peticionHist[$x][3],0,1,"L");

		$pdf->SetFont("Arial","B","10");
		$pdf->Cell(35,7,"OBSERVACION:",0,0,"L");
		$pdf->SetFont("Arial","","10");
		$pdf->MultiCell(160,7,$peticionHist[$x][0]);

		$pdf->Cell(0,7,"",0,1,"C");
	}
	
	$pdf->Output();
?>