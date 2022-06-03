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
    
    $reportDtl = $controller->getReport2($databasecon,$peticionId,$DEBUG_STATUS);

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
    $pdf->SetFont("Arial","B","12");
    $pdf->Cell(0,5,"FORMULARIO DE MANTENIMIENTO PREVENTIVO",0,1,"C");
    $pdf->Cell(0,5,"",0,1,"C");

    
    $pdf->SetFont("Arial","B","10");
    $pdf->MultiCell(0,5,"Para su seguridad y cumplimiento de normas internacionales siempre que manipule dispositivos medicos es OBLIGATORIO utilizar equipos y medidas de proteccion." ,1,'C',false);
    $pdf->Cell(0,5,"",0,1,"C");



    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Cliente",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(145,8,$peticionDtl[0][2],1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Responsable",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$reportDtl[0][3],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Cargo",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$reportDtl[0][4],1,1,"L");
    
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Nombre de hospital",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$reportDtl[0][5],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Telefono",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$reportDtl[0][7],1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(55,8,"Direccion fisica de instalacion",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(135,8,$reportDtl[0][8],1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Pais",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,"ECUADOR",1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Rep.Ventas/Distri.",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$reportDtl[0][9],1,1,"L");

    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->SetFont("Arial","B","10");
    $pdf->MultiCell(0,5,"Identificacion del Equipo" ,0,'L',false);

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Modelo",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$peticionHist[0][7],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Nro. Serie",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$peticionHist[0][6],1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->MultiCell(0,5,"Breve descripcion del incidente o reporte" ,1,'L',false);
    $pdf->SetFont("Arial","","10");
    $pdf->MultiCell(0,5,$peticionDtl[0][6] ,1,'L',false);

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Fecha de instalacion",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$reportDtl[0][10],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Fecha del problema",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$reportDtl[0][11],1,1,"L");


    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(25,8,"Horas de uso",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(35,8,$reportDtl[0][12],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(30,8,"Version SW",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(35,8,$reportDtl[0][13],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(30,8,"Codigo/error",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(35,8,$reportDtl[0][14],1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Turnos Por Dia",1,0,"L");
    $pdf->SetFont("Arial","","10");
    //$pdf->Cell(50,8, ,1,0,"L");
    if($reportDtl[0][19]==1)
        $pdf->Cell(50,8,"1-2",1,0,"L");
    else if($reportDtl[0][19]==2)
        $pdf->Cell(50,8,"3-4",1,0,"L");
    else if($reportDtl[0][19]==3)
        $pdf->Cell(50,8,"Mas de 4",1,0,"L");
    else if($reportDtl[0][19]==4)
        $pdf->Cell(50,8,"Cont.",1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Numero/Sala",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$peticionDtl[0][5],1,1,"L");


    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Garantia",1,0,"L");
    $pdf->SetFont("Arial","","10");
    //$pdf->Cell(50,8, ,1,0,"L");
    if($reportDtl[0][15]==1)
        $pdf->Cell(50,8,"SI",1,0,"L");
    else if($reportDtl[0][15]==2)
        $pdf->Cell(50,8,"NO",1,0,"L");
    else if($reportDtl[0][15]==3)
        $pdf->Cell(50,8,"NA",1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Reportado Por",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$reportDtl[0][16],1,1,"L");


    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Maquina Tipo",1,0,"L");
    $pdf->SetFont("Arial","","10");
    //$pdf->Cell(50,8, ,1,0,"L");
    if($reportDtl[0][17]==1)
        $pdf->Cell(50,8,"NEGATIVA",1,0,"L");
    else if($reportDtl[0][17]==2)
        $pdf->Cell(50,8,"POSITIVA",1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Detalle",1,0,"L");
    $pdf->SetFont("Arial","","10");
    //$pdf->Cell(50,8, ,1,0,"L");
    if($reportDtl[0][18]==1)
        $pdf->Cell(50,8,"SALA",1,1,"L");
    else if($reportDtl[0][18]==2)
        $pdf->Cell(50,8,"UCI",1,1,"L");
    else if($reportDtl[0][18]==3)
        $pdf->Cell(50,8,"AMBULANCIA",1,1,"L");


    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(55,8,"Fecha de ultimo mantenimiento",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(40,8,$reportDtl[0][20],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,8,"Reporte Tecnico No.",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,8,$peticionId,1,1,"L");


    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,8,"Frecuencia de la desinfeccion",1,0,"L");
    $pdf->SetFont("Arial","","10");
    //$pdf->Cell(95,8,$reportDtl[0][20],1,1,"L");
    if($reportDtl[0][21]==1)
        $pdf->Cell(95,8,"DIARIA",1,1,"L");
    else if($reportDtl[0][21]==2)
        $pdf->Cell(95,8,"INTERDIALISIS",1,1,"L");
    else if($reportDtl[0][21]==0)
        $pdf->Cell(95,8,"NINGUNA",1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,8,"Frecuencia de la desincrustacion.",1,0,"L");
    $pdf->SetFont("Arial","","10");
    //$pdf->Cell(95,8,$peticionId,1,1,"L");
    if($reportDtl[0][22]==1)
        $pdf->Cell(95,8,"DIARIA",1,1,"L");
    else if($reportDtl[0][22]==2)
        $pdf->Cell(95,8,"SEMANAL",1,1,"L");
    else if($reportDtl[0][22]==0)
        $pdf->Cell(95,8,"NINGUNA",1,1,"L");
    
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,8,"Operatividad General del equipo.",1,0,"L");
    $pdf->SetFont("Arial","","10");
    //$pdf->Cell(95,8,$peticionId,1,1,"L");
    if($reportDtl[0][23]==1)
        $pdf->Cell(95,8,"FUNCIONANDO",1,1,"L");
    else if($reportDtl[0][23]==2)
        $pdf->Cell(95,8,"FALLAS DEL SISTEMA",1,1,"L");

    



    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->SetFont("Arial","B","10");
    $pdf->MultiCell(0,5,"INSPECCIONES" ,0,'L',false);


    
    $con_ext='';
    $sis_ele='';
    $ver_par='';
    $sis_hyd='';
    $ver_fun='';
    $sis_apo='';



    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(0,8,"CONDICION EXTERNA",1,1,"L");
    $pdf->SetFont("Arial","","10");

    
    if(preg_match('/1/',$reportDtl[0][24]))
        $con_ext=$con_ext.'Conexion de tuberias,';
    if(preg_match('/2/',$reportDtl[0][24]))
        $con_ext=$con_ext.'Fugas y Goteos,';
    if(preg_match('/3/',$reportDtl[0][24]))
        $con_ext=$con_ext.'Danos estructurales,';
    if(preg_match('/4/',$reportDtl[0][24]))
        $con_ext=$con_ext.'Deteccion de Oxido y corrosion';
    if(preg_match('/5/',$reportDtl[0][24]))
        $con_ext=$con_ext.'Ruedas de transporte';

    $pdf->SetFont("Arial","","10");
    $pdf->MultiCell(0,5,$con_ext ,1,'L',false);


    

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(0,8,"SISTEMAS ELECTRONICOS",1,1,"L");
    $pdf->SetFont("Arial","","10");

    if(preg_match('/1/',$reportDtl[0][25]))
        $sis_ele=$sis_ele.'Cable de alimentacion electrica,';
    if(preg_match('/2/',$reportDtl[0][25]))
        $sis_ele=$sis_ele.'Toma corriente y bateria de respaldo,';
    if(preg_match('/3/',$reportDtl[0][25]))
        $sis_ele=$sis_ele.'Tarjetas de control,';
    if(preg_match('/4/',$reportDtl[0][25]))
        $sis_ele=$sis_ele.'Sensores y sistemas,';
    if(preg_match('/5/',$reportDtl[0][25]))
        $sis_ele=$sis_ele.'Corriente de fuga,';

    $pdf->SetFont("Arial","","10");
    $pdf->MultiCell(0,5,$sis_ele ,1,'L',false);


    

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(0,8,"VERIFICACION DE PARAMETROS",1,1,"L");
    $pdf->SetFont("Arial","","10");

    if(preg_match('/1/',$reportDtl[0][26]))
        $ver_par=$ver_par.'Ajustes y activacion de alarmas,';
    if(preg_match('/2/',$reportDtl[0][26]))
        $ver_par=$ver_par.'Verificacion de lavados/desinfeccion,';
    if(preg_match('/3/',$reportDtl[0][26]))
        $ver_par=$ver_par.'Calibracion de conductividad,';
    if(preg_match('/4/',$reportDtl[0][26]))
        $ver_par=$ver_par.'Calibracion de temperatura,';
    if(preg_match('/5/',$reportDtl[0][26]))
        $ver_par=$ver_par.'Exactitud de UF/Pres. Ven/Pres. Art.,';

    $pdf->SetFont("Arial","","10");
    $pdf->MultiCell(0,5,$ver_par ,1,'L',false);


    

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(0,8,"SISTEMA HIDRAULICO",1,1,"L");
    $pdf->SetFont("Arial","","10");

    if(preg_match('/1/',$reportDtl[0][27]))
        $sis_hyd=$sis_hyd.'Limpieza e integridad,';
    if(preg_match('/2/',$reportDtl[0][27]))
        $sis_hyd=$sis_hyd.'PR1,';
    if(preg_match('/3/',$reportDtl[0][27]))
        $sis_hyd=$sis_hyd.'BLD,';
    if(preg_match('/4/',$reportDtl[0][27]))
        $sis_hyd=$sis_hyd.'PG,';
    if(preg_match('/5/',$reportDtl[0][27]))
        $sis_hyd=$sis_hyd.'Valvulas de control,';

    $pdf->SetFont("Arial","","10");
    $pdf->MultiCell(0,5,$sis_hyd ,1,'L',false);


    

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(0,8,"VERIFICACION DE FUNCIONAMIENTO",1,1,"L");
    $pdf->SetFont("Arial","","10");

    if(preg_match('/1/',$reportDtl[0][28]))
        $ver_fun=$ver_fun.'Bomba de sangre,';
    if(preg_match('/2/',$reportDtl[0][28]))
        $ver_fun=$ver_fun.'Bomba de heparina,';
    if(preg_match('/3/',$reportDtl[0][28]))
        $ver_fun=$ver_fun.'Touch screen/teclado de pantalla,';
    if(preg_match('/4/',$reportDtl[0][28]))
        $ver_fun=$ver_fun.'Lampara indicadora de estado,';
    if(preg_match('/5/',$reportDtl[0][28]))
        $ver_fun=$ver_fun.'Simulacion de tratamiento,';
 
    $pdf->SetFont("Arial","","10");
    $pdf->MultiCell(0,5,$ver_fun ,1,'L',false);





    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(0,8,"SISTEMA DE APOYO / OPCIONES",1,1,"L");
    $pdf->SetFont("Arial","","10");

    if(preg_match('/1/',$reportDtl[0][28]))
        $ver_fun=$ver_fun.'BPM,';
    if(preg_match('/2/',$reportDtl[0][28]))
        $ver_fun=$ver_fun.'Filtro de endotoxinas,';
    if(preg_match('/3/',$reportDtl[0][28]))
        $ver_fun=$ver_fun.'Red de computo/LAN,';
    if(preg_match('/4/',$reportDtl[0][28]))
        $ver_fun=$ver_fun.'Documentacion de soporte,';
    if(preg_match('/5/',$reportDtl[0][28]))
        $ver_fun=$ver_fun.'Verificacion de uso/operador,';

    $pdf->SetFont("Arial","","10");
    $pdf->MultiCell(0,5,$ver_fun ,1,'L',false);
    $pdf->Cell(0,5,"",0,1,"C");



    /*$pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,8,"Condicion Externa",1,0,"L");
    $pdf->SetFont("Arial","","10");
    //$pdf->Cell(95,8,$peticionId,1,1,"L");
    if($reportDtl[0][24]==1)
        $pdf->Cell(95,8,"Conexion de tuberias",1,1,"L");
    else if($reportDtl[0][24]==2)
        $pdf->Cell(95,8,"Fugas y Goteos",1,1,"L");
    else if($reportDtl[0][24]==3)
        $pdf->Cell(95,8,"Danos estructurales",1,1,"L");
    else if($reportDtl[0][24]==4)
        $pdf->Cell(95,8,"Deteccion de Oxido y corrosion",1,1,"L");
    else if($reportDtl[0][24]==5)
        $pdf->Cell(95,8,"Ruedas de transporte",1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,8,"Sistema electronicos",1,0,"L");
    $pdf->SetFont("Arial","","10");
    //$pdf->Cell(95,8,$peticionId,1,1,"L");
    if($reportDtl[0][25]==1)
        $pdf->Cell(95,8,"Cable de alimentación electrica",1,1,"L");
    else if($reportDtl[0][25]==2)
        $pdf->Cell(95,8,"Toma corriente y bateria de respaldo",1,1,"L");
    else if($reportDtl[0][25]==3)
        $pdf->Cell(95,8,"Tarjetas de control",1,1,"L");
    else if($reportDtl[0][25]==4)
        $pdf->Cell(95,8,"Sensores y sistemas",1,1,"L");
    else if($reportDtl[0][25]==5)
        $pdf->Cell(95,8,"Corriente de fuga",1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,8,"Verificacion de parametros",1,0,"L");
    $pdf->SetFont("Arial","","10");
    //$pdf->Cell(95,8,$peticionId,1,1,"L");
    if($reportDtl[0][26]==1)
        $pdf->Cell(95,8,"Ajustes y activacion de alarmas",1,1,"L");
    else if($reportDtl[0][26]==2)
        $pdf->Cell(95,8,"Verificacion de lavados/desinfeccion",1,1,"L");
    else if($reportDtl[0][26]==3)
        $pdf->Cell(95,8,"Calibracion de conductividad",1,1,"L");
    else if($reportDtl[0][26]==4)
        $pdf->Cell(95,8,"Calibracion de temperatura",1,1,"L");
    else if($reportDtl[0][26]==5)
        $pdf->Cell(95,8,"Exactitud de UF/Pres. Ven/Pres. Art.",1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,8,"Sistema hidraulico",1,0,"L");
    $pdf->SetFont("Arial","","10");
    //$pdf->Cell(95,8,$peticionId,1,1,"L");
    if($reportDtl[0][27]==1)
        $pdf->Cell(95,8,"Limpieza e integridad",1,1,"L");
    else if($reportDtl[0][27]==2)
        $pdf->Cell(95,8,"PR1",1,1,"L");
    else if($reportDtl[0][27]==3)
        $pdf->Cell(95,8,"BLD",1,1,"L");
    else if($reportDtl[0][27]==4)
        $pdf->Cell(95,8,"PG",1,1,"L");
    else if($reportDtl[0][27]==5)
        $pdf->Cell(95,8,"Valvulas de control",1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,8,"Verificacion de funcionamiento",1,0,"L");
    $pdf->SetFont("Arial","","10");
    //$pdf->Cell(95,8,$peticionId,1,1,"L");
    if($reportDtl[0][28]==1)
        $pdf->Cell(95,8,"Bomba de sangre",1,1,"L");
    else if($reportDtl[0][28]==2)
        $pdf->Cell(95,8,"Bomba de heparina",1,1,"L");
    else if($reportDtl[0][28]==3)
        $pdf->Cell(95,8,"Touch screen/teclado de pantalla",1,1,"L");
    else if($reportDtl[0][28]==4)
        $pdf->Cell(95,8,"Lampara indicadora de estado",1,1,"L");
    else if($reportDtl[0][28]==5)
        $pdf->Cell(95,8,"Simulacion de tratamiento",1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(95,8,"Sistema de apoyo / opciones",1,0,"L");
    $pdf->SetFont("Arial","","10");
    //$pdf->Cell(95,8,$peticionId,1,1,"L");
    if($reportDtl[0][28]==1)
        $pdf->Cell(95,8,"BPM",1,1,"L");
    else if($reportDtl[0][28]==2)
        $pdf->Cell(95,8,"Filtro de endotoxinas",1,1,"L");
    else if($reportDtl[0][28]==3)
        $pdf->Cell(95,8,"Red de computo/LAN",1,1,"L");
    else if($reportDtl[0][28]==4)
        $pdf->Cell(95,8,"Documentacion de soporte",1,1,"L");
    else if($reportDtl[0][28]==5)
        $pdf->Cell(95,8,"Verificacion de uso/operador",1,1,"L");*/
    
    $pdf->Cell(0,5,"",0,1,"C");
    $pdf->SetFont("Arial","B","10");
    $pdf->MultiCell(0,5,"INFORMACION ADICIONAL" ,0,'L',false);
    $pdf->MultiCell(0,5,"Observaciones" ,1,'L',false);
    $pdf->SetFont("Arial","","10");
    $pdf->MultiCell(0,5,$reportDtl[0][30] ,1,'L',false);

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(55,12,"Nombre de tecnico / Ing.",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(40,12,$peticionHist[0][2],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,12,"Firma / Sello",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,12,"",1,1,"L");
   
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(55,12,"Nombre Recibe",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(40,12,$reportDtl[0][31],1,0,"L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(45,12,"Firma / Sello.",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(50,12,"",1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(35,8,"Hora de Inicio",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(20,8,$reportDtl[0][32],1,0,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,8,"Hora de finalizacion",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(20,8,$reportDtl[0][33],1,0,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,8,"Fecha(AAAA/MM/DD)",1,0,"L");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(35,8,$reportDtl[0][34],1,1,"L");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(120,8,"Equipo apto para uso con paciente?",1,0,"L");
    $pdf->SetFont("Arial","","10");
    
    if($reportDtl[0][35]==1)
        $pdf->Cell(70,8,"SI",1,0,"L");
    else if($reportDtl[0][35]==2)
        $pdf->Cell(70,8,"NO",1,0,"L");
    else if($reportDtl[0][35]==3)
        $pdf->Cell(70,8,"RETENIDO",1,0,"L");



    $pdf->Output();
?>