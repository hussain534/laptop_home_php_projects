<?php
// This script and data application were generated by AppGini 5.51
// Download AppGini for free from http://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/puntos.php");
	include("$currDir/puntos_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('puntos');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "puntos";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV=array(   
		"`puntos`.`id`" => "id",
		"if(`puntos`.`fecha_actividad`,date_format(`puntos`.`fecha_actividad`,'%m/%d/%Y'),'')" => "fecha_actividad",
		"`puntos`.`fecha_ingreso`" => "fecha_ingreso",
		"`puntos`.`motivo`" => "motivo",
		"`puntos`.`puntaje`" => "puntaje",
		"IF(    CHAR_LENGTH(`impactos1`.`impactos`), CONCAT_WS('',   `impactos1`.`impactos`), '') /* Impacto */" => "impacto",
		"IF(    CHAR_LENGTH(`impactos1`.`imagen`), CONCAT_WS('',   `impactos1`.`imagen`), '') /* Emblema */" => "emblema",
		"IF(    CHAR_LENGTH(`persona1`.`nombre`) || CHAR_LENGTH(`persona1`.`apellido`), CONCAT_WS('',   `persona1`.`nombre`, ' ', `persona1`.`apellido`), '') /* Postulante */" => "postulante",
		"IF(    CHAR_LENGTH(`persona2`.`usuario`), CONCAT_WS('',   `persona2`.`usuario`, ' '), '') /* Ganador */" => "persona"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`puntos`.`id`',
		2 => '`puntos`.`fecha_actividad`',
		3 => 3,
		4 => 4,
		5 => '`puntos`.`puntaje`',
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV=array(   
		"`puntos`.`id`" => "id",
		"if(`puntos`.`fecha_actividad`,date_format(`puntos`.`fecha_actividad`,'%m/%d/%Y'),'')" => "fecha_actividad",
		"`puntos`.`fecha_ingreso`" => "fecha_ingreso",
		"`puntos`.`motivo`" => "motivo",
		"`puntos`.`puntaje`" => "puntaje",
		"IF(    CHAR_LENGTH(`impactos1`.`impactos`), CONCAT_WS('',   `impactos1`.`impactos`), '') /* Impacto */" => "impacto",
		"IF(    CHAR_LENGTH(`impactos1`.`imagen`), CONCAT_WS('',   `impactos1`.`imagen`), '') /* Emblema */" => "emblema",
		"IF(    CHAR_LENGTH(`persona1`.`nombre`) || CHAR_LENGTH(`persona1`.`apellido`), CONCAT_WS('',   `persona1`.`nombre`, ' ', `persona1`.`apellido`), '') /* Postulante */" => "postulante",
		"IF(    CHAR_LENGTH(`persona2`.`usuario`), CONCAT_WS('',   `persona2`.`usuario`, ' '), '') /* Ganador */" => "persona"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters=array(   
		"`puntos`.`id`" => "ID",
		"`puntos`.`fecha_actividad`" => "Fecha de la Actividad",
		"`puntos`.`fecha_ingreso`" => "Fecha ingreso",
		"`puntos`.`motivo`" => "Motivo",
		"`puntos`.`puntaje`" => "Puntaje",
		"IF(    CHAR_LENGTH(`impactos1`.`impactos`), CONCAT_WS('',   `impactos1`.`impactos`), '') /* Impacto */" => "Impacto",
		"IF(    CHAR_LENGTH(`impactos1`.`imagen`), CONCAT_WS('',   `impactos1`.`imagen`), '') /* Emblema */" => "Emblema",
		"IF(    CHAR_LENGTH(`persona1`.`nombre`) || CHAR_LENGTH(`persona1`.`apellido`), CONCAT_WS('',   `persona1`.`nombre`, ' ', `persona1`.`apellido`), '') /* Postulante */" => "Postulante",
		"IF(    CHAR_LENGTH(`persona2`.`usuario`), CONCAT_WS('',   `persona2`.`usuario`, ' '), '') /* Ganador */" => "Ganador"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS=array(   
		"`puntos`.`id`" => "id",
		"if(`puntos`.`fecha_actividad`,date_format(`puntos`.`fecha_actividad`,'%m/%d/%Y'),'')" => "fecha_actividad",
		"`puntos`.`fecha_ingreso`" => "fecha_ingreso",
		"`puntos`.`motivo`" => "motivo",
		"`puntos`.`puntaje`" => "puntaje",
		"IF(    CHAR_LENGTH(`impactos1`.`impactos`), CONCAT_WS('',   `impactos1`.`impactos`), '') /* Impacto */" => "impacto",
		"IF(    CHAR_LENGTH(`impactos1`.`imagen`), CONCAT_WS('',   `impactos1`.`imagen`), '') /* Emblema */" => "emblema",
		"IF(    CHAR_LENGTH(`persona1`.`nombre`) || CHAR_LENGTH(`persona1`.`apellido`), CONCAT_WS('',   `persona1`.`nombre`, ' ', `persona1`.`apellido`), '') /* Postulante */" => "postulante",
		"IF(    CHAR_LENGTH(`persona2`.`usuario`), CONCAT_WS('',   `persona2`.`usuario`, ' '), '') /* Ganador */" => "persona"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'impacto' => 'Impacto', 'postulante' => 'Postulante', 'persona' => 'Ganador');

	$x->QueryFrom="`puntos` LEFT JOIN `impactos` as impactos1 ON `impactos1`.`id`=`puntos`.`impacto` LEFT JOIN `persona` as persona1 ON `persona1`.`id`=`puntos`.`postulante` LEFT JOIN `persona` as persona2 ON `persona2`.`id`=`puntos`.`persona` ";
	$x->QueryWhere='';
	$x->QueryOrder='';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = false;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 1;
	$x->AllowFilters = 0;
	$x->AllowSavingFilters = 0;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "puntos_view.php";
	$x->RedirectAfterInsert = "puntos_view.php?#";
	$x->TableTitle = "Mi Puntaje";
	$x->TableIcon = "resources/table_icons/dashboard.png";
	$x->PrimaryKey = "`puntos`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Fecha de la Actividad", "Fecha ingreso", "Motivo", "Puntaje", "Impacto", "Emblema", "Postulante", "Ganador");
	$x->ColFieldName = array('fecha_actividad', 'fecha_ingreso', 'motivo', 'puntaje', 'impacto', 'emblema', 'postulante', 'persona');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9);

	$x->Template = 'templates/puntos_templateTV.html';
	$x->SelectedTemplate = 'templates/puntos_templateTVS.html';
	$x->ShowTableHeader = 1;
	$x->ShowRecordSlots = 0;
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `puntos`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='puntos' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `puntos`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='puntos' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`puntos`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: puntos_init
	$render=TRUE;
	if(function_exists('puntos_init')){
		$args=array();
		$render=puntos_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// column sums
	if(strpos($x->HTML, '<!-- tv data below -->')){
		// if printing multi-selection TV, calculate the sum only for the selected records
		if(isset($_REQUEST['Print_x']) && is_array($_REQUEST['record_selector'])){
			$QueryWhere = '';
			foreach($_REQUEST['record_selector'] as $id){   // get selected records
				if($id != '') $QueryWhere .= "'" . makeSafe($id) . "',";
			}
			if($QueryWhere != ''){
				$QueryWhere = 'where `puntos`.`id` in ('.substr($QueryWhere, 0, -1).')';
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery="select sum(`puntos`.`puntaje`) from ".$x->QueryFrom.' '.$QueryWhere;
		$res=sql($sumQuery, $eo);
		if($row=db_fetch_row($res)){
			$sumRow ="<tr class=\"success\">";
			if(!isset($_REQUEST['Print_x'])) $sumRow.="<td class=\"text-center\"><strong>&sum;</strong></td>";
			$sumRow.="<td></td>";
			$sumRow.="<td></td>";
			$sumRow.="<td></td>";
			$sumRow.="<td style='font-size: 30px' class=\"text-right\">{$row[0]}</td>";
			$sumRow.="<td></td>";
			$sumRow.="<td></td>";
			$sumRow.="<td></td>";
			$sumRow.="<td></td>";
			$sumRow.="</tr>";

			$x->HTML=str_replace("<!-- tv data below -->", '', $x->HTML);
			$x->HTML=str_replace("<!-- tv data above -->", $sumRow, $x->HTML);
		}
	}

	// hook: puntos_header
	$headerCode='';
	if(function_exists('puntos_header')){
		$args=array();
		$headerCode=puntos_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: puntos_footer
	$footerCode='';
	if(function_exists('puntos_footer')){
		$args=array();
		$footerCode=puntos_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>