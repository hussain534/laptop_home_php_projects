<?php

// Data functions (insert, update, delete, form) for table reglamento

// This script and data application were generated by AppGini 5.51
// Download AppGini for free from http://bigprof.com/appgini/download/

function reglamento_insert(){
	global $Translation;

	// mm: can member insert record?
	$arrPerm=getTablePermissions('reglamento');
	if(!$arrPerm[1]){
		return false;
	}

	$data['descripcion'] = makeSafe($_REQUEST['descripcion']);
		if($data['descripcion'] == empty_lookup_value){ $data['descripcion'] = ''; }
	$data['archivo'] = PrepareUploadedFile('archivo', 52428800,'txt|doc|docx|docm|odt|pdf|rtf', false, '');
	if($data['archivo']== ''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">" . $Translation['error:'] . " 'Archivo': " . $Translation['field not null'] . '<br><br>';
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	if($data['descripcion']== ''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">" . $Translation['error:'] . " 'Descripcion': " . $Translation['field not null'] . '<br><br>';
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}

	/* for empty upload fields, when saving a copy of an existing record, copy the original upload field */
	if($_REQUEST['SelectedID']){
		$res = sql("select * from reglamento where id='" . makeSafe($_REQUEST['SelectedID']) . "'", $eo);
		if($row = db_fetch_assoc($res)){
			if(!$data['archivo']) $data['archivo'] = makeSafe($row['archivo']);
		}
	}

	// hook: reglamento_before_insert
	if(function_exists('reglamento_before_insert')){
		$args=array();
		if(!reglamento_before_insert($data, getMemberInfo(), $args)){ return false; }
	}

	$o = array('silentErrors' => true);
	sql('insert into `reglamento` set       ' . ($data['archivo'] != '' ? "`archivo`='{$data['archivo']}'" : '`archivo`=NULL') . ', `descripcion`=' . (($data['descripcion'] !== '' && $data['descripcion'] !== NULL) ? "'{$data['descripcion']}'" : 'NULL'), $o);
	if($o['error']!=''){
		echo $o['error'];
		echo "<a href=\"reglamento_view.php?addNew_x=1\">{$Translation['< back']}</a>";
		exit;
	}

	$recID = db_insert_id(db_link());

	// hook: reglamento_after_insert
	if(function_exists('reglamento_after_insert')){
		$res = sql("select * from `reglamento` where `id`='" . makeSafe($recID, false) . "' limit 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=array();
		if(!reglamento_after_insert($data, getMemberInfo(), $args)){ return $recID; }
	}

	// mm: save ownership data
	sql("insert ignore into membership_userrecords set tableName='reglamento', pkValue='" . makeSafe($recID, false) . "', memberID='" . makeSafe(getLoggedMemberID(), false) . "', dateAdded='" . time() . "', dateUpdated='" . time() . "', groupID='" . getLoggedGroupID() . "'", $eo);

	return $recID;
}

function reglamento_delete($selected_id, $AllowDeleteOfParents=false, $skipChecks=false){
	// insure referential integrity ...
	global $Translation;
	$selected_id=makeSafe($selected_id);

	// mm: can member delete record?
	$arrPerm=getTablePermissions('reglamento');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='reglamento' and pkValue='$selected_id'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='reglamento' and pkValue='$selected_id'");
	if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
		// delete allowed, so continue ...
	}else{
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: reglamento_before_delete
	if(function_exists('reglamento_before_delete')){
		$args=array();
		if(!reglamento_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'];
	}

	// delete file stored in the 'archivo' field
	$res = sql("select `archivo` from `reglamento` where `id`='$selected_id'", $eo);
	if($row=@db_fetch_row($res)){
		if($row[0]!=''){
			@unlink(getUploadDir('').$row[0]);
		}
	}

	sql("delete from `reglamento` where `id`='$selected_id'", $eo);

	// hook: reglamento_after_delete
	if(function_exists('reglamento_after_delete')){
		$args=array();
		reglamento_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("delete from membership_userrecords where tableName='reglamento' and pkValue='$selected_id'", $eo);
}

function reglamento_update($selected_id){
	global $Translation;

	// mm: can member edit record?
	$arrPerm=getTablePermissions('reglamento');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='reglamento' and pkValue='".makeSafe($selected_id)."'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='reglamento' and pkValue='".makeSafe($selected_id)."'");
	if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){ // allow update?
		// update allowed, so continue ...
	}else{
		return false;
	}

	$data['archivo'] = PrepareUploadedFile('archivo', 52428800, 'txt|doc|docx|docm|odt|pdf|rtf', false, "");
	$existing_archivo = sqlValue("select `archivo` from `reglamento` where `id`='" . makeSafe($selected_id) . "'");
	if($data['archivo'] == '' && !$existing_archivo){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Archivo': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	$data['descripcion'] = makeSafe($_REQUEST['descripcion']);
		if($data['descripcion'] == empty_lookup_value){ $data['descripcion'] = ''; }
	if($data['descripcion']==''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Descripcion': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	$data['selectedID']=makeSafe($selected_id);
		// delete file from server
		if($data['archivo'] != ''){
			$res = sql("select `archivo` from `reglamento` where `id`='".makeSafe($selected_id)."'", $eo);
			if($row=@db_fetch_row($res)){
				if($row[0]!=''){
					@unlink(getUploadDir('').$row[0]);
				}
			}
		}

	// hook: reglamento_before_update
	if(function_exists('reglamento_before_update')){
		$args=array();
		if(!reglamento_before_update($data, getMemberInfo(), $args)){ return false; }
	}

	$o=array('silentErrors' => true);
	sql('update `reglamento` set       ' . ($data['archivo']!='' ? "`archivo`='{$data['archivo']}'" : '`archivo`=`archivo`') . ', `descripcion`=' . (($data['descripcion'] !== '' && $data['descripcion'] !== NULL) ? "'{$data['descripcion']}'" : 'NULL') . " where `id`='".makeSafe($selected_id)."'", $o);
	if($o['error']!=''){
		echo $o['error'];
		echo '<a href="reglamento_view.php?SelectedID='.urlencode($selected_id)."\">{$Translation['< back']}</a>";
		exit;
	}


	// hook: reglamento_after_update
	if(function_exists('reglamento_after_update')){
		$res = sql("SELECT * FROM `reglamento` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = $data['id'];
		$args = array();
		if(!reglamento_after_update($data, getMemberInfo(), $args)){ return; }
	}

	// mm: update ownership data
	sql("update membership_userrecords set dateUpdated='".time()."' where tableName='reglamento' and pkValue='".makeSafe($selected_id)."'", $eo);

}

function reglamento_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0){
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm=getTablePermissions('reglamento');
	if(!$arrPerm[1] && $selected_id==''){ return ''; }
	$AllowInsert = ($arrPerm[1] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != ''){
		$dvprint = true;
	}


	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');

	if($selected_id){
		// mm: check member permissions
		if(!$arrPerm[2]){
			return "";
		}
		// mm: who is the owner?
		$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='reglamento' and pkValue='".makeSafe($selected_id)."'");
		$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='reglamento' and pkValue='".makeSafe($selected_id)."'");
		if($arrPerm[2]==1 && getLoggedMemberID()!=$ownerMemberID){
			return "";
		}
		if($arrPerm[2]==2 && getLoggedGroupID()!=$ownerGroupID){
			return "";
		}

		// can edit?
		if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){
			$AllowUpdate=1;
		}else{
			$AllowUpdate=0;
		}

		$res = sql("select * from `reglamento` where `id`='".makeSafe($selected_id)."'", $eo);
		if(!($row = db_fetch_array($res))){
			return error_message($Translation['No records found']);
		}
		$urow = $row; /* unsanitized data */
		$hc = new CI_Input();
		$row = $hc->xss_clean($row); /* sanitize data */
	}else{
	}

	// code for template based detail view forms

	// open the detail view template
	$templateCode = @file_get_contents('./templates/reglamento_templateDV.html');

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Listado de Reglamentos', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert){
		if(!$selected_id) $templateCode=str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return reglamento_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode=str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return reglamento_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
	}else{
		$templateCode=str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if($_REQUEST['Embedded']){
		$backAction = 'window.parent.jQuery(\'.modal\').modal(\'hide\'); return false;';
	}else{
		$backAction = '$$(\'form\')[0].writeAttribute(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($selected_id){
		if($AllowUpdate){
			$templateCode=str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return reglamento_validateData();"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
		}else{
			$templateCode=str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		}
		if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
			$templateCode=str_replace('<%%DELETE_BUTTON%%>', '<button type="submit" class="btn btn-danger" id="delete" name="delete_x" value="1" onclick="return confirm(\'' . $Translation['are you sure?'] . '\');"><i class="glyphicon glyphicon-trash"></i> ' . $Translation['Delete'] . '</button>', $templateCode);
		}else{
			$templateCode=str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		}
		$templateCode=str_replace('<%%DESELECT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>', $templateCode);
	}else{
		$templateCode=str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		$templateCode=str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		$templateCode=str_replace('<%%DESELECT_BUTTON%%>', ($ShowCancel ? '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>' : ''), $templateCode);
	}

	// set records to read only if user can't insert new records and can't edit current record
	if(($selected_id && !$AllowUpdate && !$AllowInsert) || (!$selected_id && !$AllowInsert)){
		$jsReadOnly .= "\tjQuery('#archivo').replaceWith('<div class=\"form-control-static\" id=\"archivo\">' + (jQuery('#archivo').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#archivo, #archivo-edit-link').hide();\n";
		$jsReadOnly .= "\tjQuery('#descripcion').replaceWith('<div class=\"form-control-static\" id=\"descripcion\">' + (jQuery('#descripcion').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	}elseif($AllowInsert){
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
			$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array();
	foreach($lookup_fields as $luf => $ptfc){
		$pt_perm = getTablePermissions($ptfc[0]);

		// process foreign key links
		if($pt_perm['view'] || $pt_perm['edit']){
			$templateCode = str_replace("<%%PLINK({$luf})%%>", '<button type="button" class="btn btn-default view_parent hspacer-md" id="' . $ptfc[0] . '_view_parent" title="' . html_attr($Translation['View'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-eye-open"></i></button>', $templateCode);
		}

		// if user has insert permission to parent table of a lookup field, put an add new button
		if($pt_perm['insert'] && !$_REQUEST['Embedded']){
			$templateCode = str_replace("<%%ADDNEW({$ptfc[0]})%%>", '<button type="button" class="btn btn-success add_new_parent hspacer-md" id="' . $ptfc[0] . '_add_new" title="' . html_attr($Translation['Add New'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-plus-sign"></i></button>', $templateCode);
		}
	}

	// process images
	$templateCode=str_replace('<%%UPLOADFILE(id)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(archivo)%%>', ($noUploads ? '' : '<input type=hidden name=MAX_FILE_SIZE value=52428800>'.$Translation['upload image'].' <input type="file" name="archivo" id="archivo">'), $templateCode);
	if($AllowUpdate && $row['archivo']!=''){
		$templateCode=str_replace('<%%REMOVEFILE(archivo)%%>', '<br><input type="checkbox" name="archivo_remove" id="archivo_remove" value="1"> <label for="archivo_remove" style="color: red; font-weight: bold;">'.$Translation['remove image'].'</label>', $templateCode);
	}else{
		$templateCode=str_replace('<%%REMOVEFILE(archivo)%%>', '', $templateCode);
	}
	$templateCode=str_replace('<%%UPLOADFILE(descripcion)%%>', '', $templateCode);

	// process values
	if($selected_id){
		$templateCode=str_replace('<%%VALUE(id)%%>', html_attr($row['id']), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		$templateCode=str_replace('<%%VALUE(archivo)%%>', html_attr($row['archivo']), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(archivo)%%>', urlencode($urow['archivo']), $templateCode);
		$templateCode=str_replace('<%%VALUE(descripcion)%%>', html_attr($row['descripcion']), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(descripcion)%%>', urlencode($urow['descripcion']), $templateCode);
	}else{
		$templateCode=str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(archivo)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(archivo)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(descripcion)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(descripcion)%%>', urlencode(''), $templateCode);
	}

	// process translations
	foreach($Translation as $symbol=>$trans){
		$templateCode=str_replace("<%%TRANSLATION($symbol)%%>", $trans, $templateCode);
	}

	// clear scrap
	$templateCode=str_replace('<%%', '<!-- ', $templateCode);
	$templateCode=str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if($_REQUEST['dvprint_x'] == ''){
		$templateCode .= "\n\n<script>\$j(function(){\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption){
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$selected_id){
			$templateCode.="\n\tif(document.getElementById('archivoEdit')){ document.getElementById('archivoEdit').style.display='inline'; }";
			$templateCode.="\n\tif(document.getElementById('archivoEditLink')){ document.getElementById('archivoEditLink').style.display='none'; }";
		}

		$templateCode.="\n});</script>\n";
	}

	// ajaxed auto-fill fields
	$templateCode .= '<script>';
	$templateCode .= '$j(function() {';


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	// hook: reglamento_dv
	if(function_exists('reglamento_dv')){
		$args=array();
		reglamento_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}
?>