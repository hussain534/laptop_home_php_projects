<?php
	@header("Content-Type: text/javascript; charset=UTF-8");
	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
?>
/* initials and fixes */
jQuery(function(){
	$j(window).resize(function(){
		var window_width = $j(window).width();
		var max_width = $j('body').width() * 0.5;

		if($j('fieldset .col-xs-11').length) max_width = $j('fieldset .col-xs-11').width() - 99;
		$j('.select2-container:not(.option_list)').css({ 'max-width' : max_width + 'px', 'width': '100%' });
		fix_table_responsive_width();

		var full_img_factor = 0.9; /* xs */
		if(window_width >= 992) full_img_factor = 0.6; /* md, lg */
		else if(window_width >= 768) full_img_factor = 0.9; /* sm */

		$j('.detail_view .img-responsive').css({'max-width' : parseInt($j('.detail_view').width() * full_img_factor) + 'px'});
	});

	setTimeout(function(){ $j(window).resize(); }, 1000);
	setTimeout(function(){ $j(window).resize(); }, 3000);

	/* don't allow saving detail view while an ajax request is in progress */
	jQuery(document).ajaxStart(function(){ jQuery('#update, #insert').prop('disabled', true); });
	jQuery(document).ajaxStop(function(){ jQuery('#update, #insert').prop('disabled', false); });

	/* don't allow responsive images to initially exceed the smaller of their actual dimensions, or .6 container width */
	jQuery('.detail_view .img-responsive').each(function(){
		 var pic_real_width, pic_real_height;
		 var img = jQuery(this);
		 jQuery('<img/>') // Make in memory copy of image to avoid css issues
				.attr('src', img.attr('src'))
				.load(function() {
					pic_real_width = this.width;
					pic_real_height = this.height;

					if(pic_real_width > $j('.detail_view').width() * .6) pic_real_width = $j('.detail_view').width() * .6;
					img.css({ "max-width": pic_real_width });
				});
	});

	jQuery('.table-responsive .img-responsive').each(function(){
		 var pic_real_width, pic_real_height;
		 var img = jQuery(this);
		 jQuery('<img/>') // Make in memory copy of image to avoid css issues
				.attr('src', img.attr('src'))
				.load(function() {
					pic_real_width = this.width;
					pic_real_height = this.height;

					if(pic_real_width > $j('.table-responsive').width() * .6) pic_real_width = $j('.table-responsive').width() * .6;
					img.css({ "max-width": pic_real_width });
				});
	});

	/* toggle TV action buttons based on selected records */
	jQuery('.record_selector').click(function(){
		var id = jQuery(this).val();
		var checked = jQuery(this).prop('checked');
		update_action_buttons();
	});

	/* select/deselect all records in TV */
	jQuery('#select_all_records').click(function(){
		jQuery('.record_selector').prop('checked', jQuery(this).prop('checked'));
		update_action_buttons();
	});

	/* fix behavior of select2 in bootstrap modal. See: https://github.com/ivaynberg/select2/issues/1436 */
	jQuery.fn.modal.Constructor.prototype.enforceFocus = function(){};

	/* remove empty navbar menus */
	$j('nav li.dropdown').each(function(){
		var num_items = $j(this).children('.dropdown-menu').children('li').length;
		if(!num_items) $j(this).remove();
	})

	update_action_buttons();
});

/* show/hide TV action buttons based on whether records are selected or not */
function update_action_buttons(){
	if(jQuery('.record_selector:checked').length){
		jQuery('.selected_records').removeClass('hidden');
		jQuery('#select_all_records')
			.prop('checked', (jQuery('.record_selector:checked').length == jQuery('.record_selector').length));
	}else{
		jQuery('.selected_records').addClass('hidden');
	}
}

/* fix table-responsive behavior on Chrome */
function fix_table_responsive_width(){
	var resp_width = jQuery('div.table-responsive').width();
	var table_width;

	if(resp_width){
		jQuery('div.table-responsive table').width('100%');
		table_width = jQuery('div.table-responsive table').width();
		resp_width = jQuery('div.table-responsive').width();
		if(resp_width == table_width){
			jQuery('div.table-responsive table').width(resp_width - 1);
		}
	}
}

function cargo_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre", close: function(){ $j('[name=nombre]').focus(); $j('[name=nombre]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function categoria_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre", close: function(){ $j('[name=nombre]').focus(); $j('[name=nombre]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#descripcion').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Descripci&#243;n", close: function(){ $j('[name=descripcion]').focus(); $j('[name=descripcion]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function financiamiento_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre", close: function(){ $j('[name=nombre]').focus(); $j('[name=nombre]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function modalidad_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre", close: function(){ $j('[name=nombre]').focus(); $j('[name=nombre]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function campo_amplio_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre", close: function(){ $j('[name=nombre]').focus(); $j('[name=nombre]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function manual_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#descripcion').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Descripci&#243;n", close: function(){ $j('[name=descripcion]').focus(); $j('[name=descripcion]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#youtube_video').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Youtube video", close: function(){ $j('[name=youtube_video]').focus(); $j('[name=youtube_video]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function pais_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre", close: function(){ $j('[name=nombre]').focus(); $j('[name=nombre]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function provincia_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre", close: function(){ $j('[name=nombre]').focus(); $j('[name=nombre]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#pais').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Pa&#237;s", close: function(){ $j('[name=pais]').focus(); $j('[name=pais]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#zona').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Zona", close: function(){ $j('[name=zona]').focus(); $j('[name=zona]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function localidad_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre", close: function(){ $j('[name=nombre]').focus(); $j('[name=nombre]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#provincia').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Provincia", close: function(){ $j('[name=provincia]').focus(); $j('[name=provincia]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function tipo_posgrado_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre", close: function(){ $j('[name=nombre]').focus(); $j('[name=nombre]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function ies_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre", close: function(){ $j('[name=nombre]').focus(); $j('[name=nombre]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#siglas').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Siglas", close: function(){ $j('[name=siglas]').focus(); $j('[name=siglas]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#provincia').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Provincia", close: function(){ $j('[name=provincia]').focus(); $j('[name=provincia]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#localidad').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Localidad", close: function(){ $j('[name=localidad]').focus(); $j('[name=localidad]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#logo').val() == '' && $j('#logo-image').attr('src').match(/blank\.gif/)){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Logo", close: function(){ $j('[name=logo]').focus(); $j('[name=logo]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#usuario').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Usuario del Sistema", close: function(){ $j('[name=usuario]').focus(); $j('[name=usuario]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#rector').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Rector", close: function(){ $j('[name=rector]').focus(); $j('[name=rector]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#financiamiento').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Financiamiento", close: function(){ $j('[name=financiamiento]').focus(); $j('[name=financiamiento]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#categoria').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Categor&#237;a", close: function(){ $j('[name=categoria]').focus(); $j('[name=categoria]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#codigo_sniese').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> C&#243;digo SNIESE", close: function(){ $j('[name=codigo_sniese]').focus(); $j('[name=codigo_sniese]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function zona_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre", close: function(){ $j('[name=nombre]').focus(); $j('[name=nombre]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function persona_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_1').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre 1", close: function(){ $j('[name=nombre_1]').focus(); $j('[name=nombre_1]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#apellido_1').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Apellido 1", close: function(){ $j('[name=apellido_1]').focus(); $j('[name=apellido_1]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#cedula').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Cedula", close: function(){ $j('[name=cedula]').focus(); $j('[name=cedula]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#cargo').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Cargo", close: function(){ $j('[name=cargo]').focus(); $j('[name=cargo]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function matricula_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#costo_apro').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Costo Aprobado de acuerdo a los par&#225;metros definidos", close: function(){ $j('[name=costo_apro]').focus(); $j('[name=costo_apro]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#matricula').val() == '' && !$j('#matricula-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Facturas", close: function(){ $j('[name=matricula]').focus(); $j('[name=matricula]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function colegiatura_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#costo_aprobado').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Costos aprobados de acuerdo a los par&#225;metros definidos", close: function(){ $j('[name=costo_aprobado]').focus(); $j('[name=costo_aprobado]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#facturas').val() == '' && !$j('#facturas-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Facturas", close: function(){ $j('[name=facturas]').focus(); $j('[name=facturas]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function costos_irregulares_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#costo_optimo').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Aranceles &#8211; costo &#243;ptimo definido por la normativa", close: function(){ $j('[name=costo_optimo]').focus(); $j('[name=costo_optimo]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#documento_habilitante').val() == '' && !$j('#documento_habilitante-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Documento Habilitante", close: function(){ $j('[name=documento_habilitante]').focus(); $j('[name=documento_habilitante]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function perfil_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#nro_estudiantes').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nro. Estudiantes que ingresaron con el Perfil Requerido", close: function(){ $j('[name=nro_estudiantes]').focus(); $j('[name=nro_estudiantes]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#expediente').val() == '' && !$j('#expediente-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Expediente", close: function(){ $j('[name=expediente]').focus(); $j('[name=expediente]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function requisitos_s_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#nro_estudiantes').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nro. Estudiantes que ingresaron con Requisitos Requeridos", close: function(){ $j('[name=nro_estudiantes]').focus(); $j('[name=nro_estudiantes]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#expediente').val() == '' && !$j('#expediente-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Expediente", close: function(){ $j('[name=expediente]').focus(); $j('[name=expediente]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function formacion_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#num_estudiantes').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> % de estudiantes que al ingreso al programa cuenta con un nivel de formaci&#243;n igual o superior al ofertado", close: function(){ $j('[name=num_estudiantes]').focus(); $j('[name=num_estudiantes]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#expediente').val() == '' && !$j('#expediente-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Expediente", close: function(){ $j('[name=expediente]').focus(); $j('[name=expediente]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function rendimiento_malla_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#creditos_superados').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Creditos Superados", close: function(){ $j('[name=creditos_superados]').focus(); $j('[name=creditos_superados]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#documento_habilitante').val() == '' && !$j('#documento_habilitante-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Documento Habilitante", close: function(){ $j('[name=documento_habilitante]').focus(); $j('[name=documento_habilitante]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function eficiencia_graduacion_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#estudiantes_titulacion').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nro. Estudiantes que obtienen la titulaci&#243;n (en el tiempo del programa m&#225;s un a&#241;o)", close: function(){ $j('[name=estudiantes_titulacion]').focus(); $j('[name=estudiantes_titulacion]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#estudiantes_iniciaron').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nro. Estudiantes que Iniciaron el programa (en el tiempo del Programa M&#225;s un a&#241;o)", close: function(){ $j('[name=estudiantes_iniciaron]').focus(); $j('[name=estudiantes_iniciaron]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#documento_habilitante').val() == '' && !$j('#documento_habilitante-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Documento Habilitante", close: function(){ $j('[name=documento_habilitante]').focus(); $j('[name=documento_habilitante]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function desarrollador_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre", close: function(){ $j('[name=nombre]').focus(); $j('[name=nombre]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#apellido').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Apellido", close: function(){ $j('[name=apellido]').focus(); $j('[name=apellido]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#email').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Email", close: function(){ $j('[name=email]').focus(); $j('[name=email]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#numero').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Numero de Contacto ", close: function(){ $j('[name=numero]').focus(); $j('[name=numero]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#foto').val() == '' && $j('#foto-image').attr('src').match(/blank\.gif/)){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Foto", close: function(){ $j('[name=foto]').focus(); $j('[name=foto]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function cohorte_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#numero_cohorte').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Numero Cohorte", close: function(){ $j('[name=numero_cohorte]').focus(); $j('[name=numero_cohorte]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#reporte').val() == '' && !$j('#reporte-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Reporte de estudiantes Matriculados", close: function(){ $j('[name=reporte]').focus(); $j('[name=reporte]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function paralelo_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#numero_paraleloxcohorte').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Numero Paralelos por Cohorte", close: function(){ $j('[name=numero_paraleloxcohorte]').focus(); $j('[name=numero_paraleloxcohorte]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#reporte').val() == '' && !$j('#reporte-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Reporte de Estudiantes Matriculados", close: function(){ $j('[name=reporte]').focus(); $j('[name=reporte]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function docente_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#docente').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Persona", close: function(){ $j('[name=docente]').focus(); $j('[name=docente]').parents('.form-group').addClass('has-error'); } }); return false; };
	if(!$j('[name=tipo]:checked').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Tipo", close: function(){ $j('[name=tipo]').focus(); $j('[name=tipo]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#evidencia').val() == '' && !$j('#evidencia-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Contrato/Acci&#243;n de Personal", close: function(){ $j('[name=evidencia]').focus(); $j('[name=evidencia]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function contrato_docentes_tutores_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#num_tiemp_comp').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> # Docentes Tiempo Completo", close: function(){ $j('[name=num_tiemp_comp]').focus(); $j('[name=num_tiemp_comp]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#contrato_ac_per').val() == '' && !$j('#contrato_ac_per-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Contrato/Acci&#243;n de personal", close: function(){ $j('[name=contrato_ac_per]').focus(); $j('[name=contrato_ac_per]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function cuerpo_docentes_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#num_total_doc').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> # Total de Docentes", close: function(){ $j('[name=num_total_doc]').focus(); $j('[name=num_total_doc]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#num_total_doc_med').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> # Total de Docentes Medio Tiempo", close: function(){ $j('[name=num_total_doc_med]').focus(); $j('[name=num_total_doc_med]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#contrato_ac_per_med').val() == '' && !$j('#contrato_ac_per_med-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Contrato Medio Tiempo", close: function(){ $j('[name=contrato_ac_per_med]').focus(); $j('[name=contrato_ac_per_med]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#doc_phd').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> % Docentes a Ph.D", close: function(){ $j('[name=doc_phd]').focus(); $j('[name=doc_phd]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#contrato_ac_per_phd').val() == '' && !$j('#contrato_ac_per_phd-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Contrato/Acci&#243;n de Personal (Ph.D.)", close: function(){ $j('[name=contrato_ac_per_phd]').focus(); $j('[name=contrato_ac_per_phd]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#num_total_doc_med_1').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> % Profesores Internacionales invitados al Programa", close: function(){ $j('[name=num_total_doc_med_1]').focus(); $j('[name=num_total_doc_med_1]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#contrato_ac_per_int').val() == '' && !$j('#contrato_ac_per_int-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Contrato/Acci&#243;n de Personal (internacionales)", close: function(){ $j('[name=contrato_ac_per_int]').focus(); $j('[name=contrato_ac_per_int]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function programa_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#tipo_posgrado').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Tipo Posgrado", close: function(){ $j('[name=tipo_posgrado]').focus(); $j('[name=tipo_posgrado]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#modalidad').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Modalidad", close: function(){ $j('[name=modalidad]').focus(); $j('[name=modalidad]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#campo_amplio').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Campo Amplio", close: function(){ $j('[name=campo_amplio]').focus(); $j('[name=campo_amplio]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function acceso_tecnologia_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#numero_equipos').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> N&#250;mero de Equipos por Estudiante", close: function(){ $j('[name=numero_equipos]').focus(); $j('[name=numero_equipos]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#evidencia').val() == '' && !$j('#evidencia-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Registro fotogr&#225;fico", close: function(){ $j('[name=evidencia]').focus(); $j('[name=evidencia]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function recursos_aprendizajez_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#porcentaje_estudiantes_virtuales').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> % Estudiantes con acceso a la plataforma virtual", close: function(){ $j('[name=porcentaje_estudiantes_virtuales]').focus(); $j('[name=porcentaje_estudiantes_virtuales]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#act_aprendizaje').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Numero Actividades de Aprendizaje", close: function(){ $j('[name=act_aprendizaje]').focus(); $j('[name=act_aprendizaje]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#reporte_usuarios').val() == '' && !$j('#reporte_usuarios-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Reporte de Usuarios", close: function(){ $j('[name=reporte_usuarios]').focus(); $j('[name=reporte_usuarios]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#reporte_actividades').val() == '' && !$j('#reporte_actividades-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Reporte de Actividades", close: function(){ $j('[name=reporte_actividades]').focus(); $j('[name=reporte_actividades]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function aulas_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#numero_aulas').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Numero aulas", close: function(){ $j('[name=numero_aulas]').focus(); $j('[name=numero_aulas]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#evidencia_fotografica').val() == '' && !$j('#evidencia_fotografica-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Evidencia fotografica", close: function(){ $j('[name=evidencia_fotografica]').focus(); $j('[name=evidencia_fotografica]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function inversion_programa_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#presupuesto_ies').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Presupuesto IES", close: function(){ $j('[name=presupuesto_ies]').focus(); $j('[name=presupuesto_ies]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#presupuesto_inv_prog').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Presupuesto Invertido en Programa", close: function(){ $j('[name=presupuesto_inv_prog]').focus(); $j('[name=presupuesto_inv_prog]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#estados_financieros').val() == '' && !$j('#estados_financieros-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Estados Financieros", close: function(){ $j('[name=estados_financieros]').focus(); $j('[name=estados_financieros]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function unidad_titulacion_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#num_horas_exe').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Numero de horas Ejecutadas", close: function(){ $j('[name=num_horas_exe]').focus(); $j('[name=num_horas_exe]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#reporte_asistencia').val() == '' && !$j('#reporte_asistencia-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Reporte de Asistencia", close: function(){ $j('[name=reporte_asistencia]').focus(); $j('[name=reporte_asistencia]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#reporte_syllabus').val() == '' && !$j('#reporte_syllabus-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Reporte de Syllabus", close: function(){ $j('[name=reporte_syllabus]').focus(); $j('[name=reporte_syllabus]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function carga_horaria_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#num_horas_impartidas').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Numero de horas impartidas", close: function(){ $j('[name=num_horas_impartidas]').focus(); $j('[name=num_horas_impartidas]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#reporte_asistencia').val() == '' && !$j('#reporte_asistencia-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Reporte de Asistencia", close: function(){ $j('[name=reporte_asistencia]').focus(); $j('[name=reporte_asistencia]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#reporte_syllabus').val() == '' && !$j('#reporte_syllabus-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Reporte de Syllabus", close: function(){ $j('[name=reporte_syllabus]').focus(); $j('[name=reporte_syllabus]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function materia_impartida_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#nombre').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre de la Materia Impartida", close: function(){ $j('[name=nombre]').focus(); $j('[name=nombre]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#reporte_notas_1').val() == '' && !$j('#reporte_notas_1-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Reporte de Notas", close: function(){ $j('[name=reporte_notas_1]').focus(); $j('[name=reporte_notas_1]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#reporte_syllabus_1').val() == '' && !$j('#reporte_syllabus_1-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Reporte de Syllabus", close: function(){ $j('[name=reporte_syllabus_1]').focus(); $j('[name=reporte_syllabus_1]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function laboratorios_validateData(){
	$j('.has-error').removeClass('has-error');
	if($j('#nombre_programa').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Nombre Programa", close: function(){ $j('[name=nombre_programa]').focus(); $j('[name=nombre_programa]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#numero_laboratios').val() == ''){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Numero Laboratios", close: function(){ $j('[name=numero_laboratios]').focus(); $j('[name=numero_laboratios]').parents('.form-group').addClass('has-error'); } }); return false; };
	if($j('#evidencia_fotografica').val() == '' && !$j('#evidencia_fotografica-link:visible').length){ modal_window({ message: '<div class="alert alert-danger"><?php echo addslashes($Translation['field not null']); ?></div>', title: "<?php echo addslashes($Translation['error:']); ?> Evidencia fotografica", close: function(){ $j('[name=evidencia_fotografica]').focus(); $j('[name=evidencia_fotografica]').parents('.form-group').addClass('has-error'); } }); return false; };
	return true;
}
function post(url, params, update, disable, loading){
	new Ajax.Request(
		url, {
			method: 'post',
			parameters: params,
			onCreate: function() {
				if($(disable) != undefined) $(disable).disabled=true;
				if($(loading) != undefined && update != loading) $(loading).update('<div style="direction: ltr;"><img src="loading.gif"> <?php echo $Translation['Loading ...']; ?></div>');
			},
			onSuccess: function(resp) {
				if($(update) != undefined) $(update).update(resp.responseText);
			},
			onComplete: function() {
				if($(disable) != undefined) $(disable).disabled=false;
				if($(loading) != undefined && loading != update) $(loading).update('');
			}
		}
	);
}
function post2(url, params, notify, disable, loading, redirectOnSuccess){
	new Ajax.Request(
		url, {
			method: 'post',
			parameters: params,
			onCreate: function() {
				if($(disable) != undefined) $(disable).disabled=true;
				if($(loading) != undefined) $(loading).show();
			},
			onSuccess: function(resp) {
				/* show notification containing returned text */
				if($(notify) != undefined) $(notify).removeClassName('Error').appear().update(resp.responseText);

				/* in case no errors returned, */
				if(!resp.responseText.match(/<?php echo $Translation['error:']; ?>/)){
					/* redirect to provided url */
					if(redirectOnSuccess != undefined){
						window.location=redirectOnSuccess;

					/* or hide notification after a few seconds if no url is provided */
					}else{
						if($(notify) != undefined) window.setTimeout(function(){ $(notify).fade(); }, 15000);
					}

				/* in case of error, apply error class */
				}else{
					$(notify).addClassName('Error');
				}
			},
			onComplete: function() {
				if($(disable) != undefined) $(disable).disabled=false;
				if($(loading) != undefined) $(loading).hide();
			}
		}
	);
}
function passwordStrength(password, username){
	// score calculation (out of 10)
	var score = 0;
	re = new RegExp(username, 'i');
	if(username.length && password.match(re)) score -= 5;
	if(password.length < 6) score -= 3;
	else if(password.length > 8) score += 5;
	else score += 3;
	if(password.match(/(.*[0-9].*[0-9].*[0-9])/)) score += 3;
	if(password.match(/(.*[!,@,#,$,%,^,&,*,?,_,~].*[!,@,#,$,%,^,&,*,?,_,~])/)) score += 5;
	if(password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) score += 2;

	if(score >= 9)
		return 'strong';
	else if(score >= 5)
		return 'good';
	else
		return 'weak';
}
function validateEmail(email) { 
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}
function loadScript(jsUrl, cssUrl, callback){
	// adding the script tag to the head
	var head = document.getElementsByTagName('head')[0];
	var script = document.createElement('script');
	script.type = 'text/javascript';
	script.src = jsUrl;

	if(cssUrl != ''){
		var css = document.createElement('link');
		css.href = cssUrl;
		css.rel = "stylesheet";
		css.type = "text/css";
		head.appendChild(css);
	}

	// then bind the event to the callback function 
	// there are several events for cross browser compatibility
	if(script.onreadystatechange != undefined){ script.onreadystatechange = callback; }
	if(script.onload != undefined){ script.onload = callback; }

	// fire the loading
	head.appendChild(script);
}
/**
 * options object. The following members can be provided:
 *    url: iframe url to load
 *    message: instead of a url to open, you could pass a message. HTML tags allowed.
 *    id: id attribute of modal window
 *    title: optional modal window title
 *    size: 'default', 'full'
 *    close: optional function to execute on closing the modal
 *    footer: optional array of objects describing the buttons to display in the footer.
 *       Each button object can have the following members:
 *          label: string, label of button
 *          bs_class: string, button bootstrap class. Can be 'primary', 'default', 'success', 'warning' or 'danger'
 *          click: function to execute on clicking the button. If the button closes the modal, this
 *                 function is executed before the close handler
 *          causes_closing: boolean, default is true.
 */
function modal_window(options){
	var id = options.id;
	var url = options.url;
	var title = options.title;
	var footer = options.footer;
	var message = options.message;

	if(typeof(id) == 'undefined') id = random_string(20);
	if(typeof(footer) == 'undefined') footer = [];

	if(jQuery('#' + id).length){
		/* modal exists -- remove it first */
		jQuery('#' + id).remove();
	}

	/* prepare footer buttons, if any */
	var footer_buttons = '';
	for(i = 0; i < footer.length; i++){
		if(typeof(footer[i].causes_closing) == 'undefined'){ footer[i].causes_closing = true; }
		if(typeof(footer[i].bs_class) == 'undefined'){ footer[i].bs_class = 'default'; }
		footer[i].id = id + '_footer_button_' + random_string(10);

		footer_buttons += '<button type="button" class="btn btn-' + footer[i].bs_class + '" ' +
				(footer[i].causes_closing ? 'data-dismiss="modal" ' : '') +
				'id="' + footer[i].id + '" ' +
				'>' + footer[i].label + '</button>';
	}

	jQuery('body').append(
		'<div class="modal fade" id="' + id + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
			'<div class="modal-dialog">' +
				'<div class="modal-content">' +
					( title != undefined ?
						'<div class="modal-header">' +
							'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
							'<h3 class="modal-title" id="myModalLabel">' + title + '</h3>' +
						'</div>'
						: ''
					) +
					'<div class="modal-body" style="-webkit-overflow-scrolling:touch !important; overflow-y: auto;">' +
						( url != undefined ?
							'<iframe width="100%" height="100%" sandbox="allow-modals allow-forms allow-scripts allow-same-origin allow-popups" src="' + url + '"></iframe>'
							: message
						) +
					'</div>' +
					( footer != undefined ?
						'<div class="modal-footer">' + footer_buttons + '</div>'
						: ''
					) +
				'</div>' +
			'</div>' +
		'</div>'
	);

	for(i = 0; i < footer.length; i++){
		if(typeof(footer[i].click) == 'function'){
			jQuery('#' + footer[i].id).click(footer[i].click);
		}
	}

	jQuery('#' + id).modal();

	if(typeof(options.close) == 'function'){
		jQuery('#' + id).on('hidden.bs.modal', options.close);
	}

	if(typeof(options.size) == 'undefined') options.size = 'default';

	if(options.size == 'full'){
		jQuery(window).resize(function(){
			jQuery('#' + id + ' .modal-dialog').width(jQuery(window).width() * 0.95);
			jQuery('#' + id + ' .modal-body').height(jQuery(window).height() * 0.7);
		}).trigger('resize');
	}

	return id;
}

function random_string(string_length){
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	for(var i = 0; i < string_length; i++)
		text += possible.charAt(Math.floor(Math.random() * possible.length));

	return text;
}

function get_selected_records_ids(){
	return jQuery('.record_selector:checked').map(function(){ return jQuery(this).val() }).get();
}

function print_multiple_dv_tvdv(t, ids){
	document.myform.NoDV.value=1;
	document.myform.PrintDV.value=1;
	document.myform.SelectedID.value = '';
	document.myform.submit();
	return true;
}

function print_multiple_dv_sdv(t, ids){
	document.myform.NoDV.value=1;
	document.myform.PrintDV.value=1;
	document.myform.writeAttribute('novalidate', 'novalidate');
	document.myform.submit();
	return true;
}

function mass_delete(t, ids){
	if(ids == undefined) return;
	if(!ids.length) return;

	var confirm_message = '<div class="alert alert-danger">' +
			'<i class="glyphicon glyphicon-warning-sign"></i> ' + 
			'<?php echo addslashes($Translation['<n> records will be deleted. Are you sure you want to do this?']); ?>' +
		'</div>';
	var confirm_title = '<?php echo addslashes($Translation['Confirm deleting multiple records']); ?>';
	var label_yes = '<?php echo addslashes($Translation['Yes, delete them!']); ?>';
	var label_no = '<?php echo addslashes($Translation['No, keep them.']); ?>';
	var progress = '<?php echo addslashes($Translation['Deleting record <i> of <n>']); ?>';
	var continue_delete = true;

	// request confirmation of mass delete operation
	modal_window({
		message: confirm_message.replace(/\<n\>/, ids.length),
		title: confirm_title,
		footer: [ /* shows a 'yes' and a 'no' buttons .. handler for each follows ... */
			{
				label: '<i class="glyphicon glyphicon-trash"></i> ' + label_yes,
				bs_class: 'danger',
				// on confirming, start delete operations
				click: function(){

					// show delete progress, allowing user to abort operations by closing the window or clicking cancel
					var progress_window = modal_window({
						title: '<?php echo addslashes($Translation['Delete progress']); ?>',
						message: '' +
							'<div class="progress">' +
								'<div class="progress-bar progress-bar-warning" role="progressbar" style="width: 0;"></div>' +
							'</div>' + 
							'<button type="button" class="btn btn-default details_toggle" onclick="' +
								'jQuery(this).children(\'.glyphicon\').toggleClass(\'glyphicon-chevron-right glyphicon-chevron-down\'); ' +
								'jQuery(\'.well.details_list\').toggleClass(\'hidden\');'
								+ '">' +
								'<i class="glyphicon glyphicon-chevron-right"></i> ' +
								'<?php echo addslashes($Translation['Show/hide details']); ?>' +
							'</button>' +
							'<div class="well well-sm details_list hidden"><ol></ol></div>',
						close: function(){
							// stop deleting further records ...
							continue_delete = false;
						},
						footer: [
							{
								label: '<i class="glyphicon glyphicon-remove"></i> <?php echo addslashes($Translation['Cancel']); ?>',
								bs_class: 'warning'
							}
						]
					});

					// begin deleting records, one by one
					progress = progress.replace(/\<n\>/, ids.length);
					var delete_record = function(itrn){
						if(!continue_delete) return;
						jQuery.ajax(t + '_view.php', {
							type: 'POST',
							data: { delete_x: 1, SelectedID: ids[itrn] },
							success: function(resp){
								if(resp == 'OK'){
									jQuery(".well.details_list ol").append('<li class="text-success"><?php echo addslashes($Translation['The record has been deleted successfully']); ?></li>');
									jQuery('#record_selector_' + ids[itrn]).prop('checked', false).parent().parent().fadeOut(1500);
									jQuery('#select_all_records').prop('checked', false);
								}else{
									jQuery(".well.details_list ol").append('<li class="text-danger">' + resp + '</li>');
								}
							},
							error: function(){
								jQuery(".well.details_list ol").append('<li class="text-warning"><?php echo addslashes($Translation['Connection error']); ?></li>');
							},
							complete: function(){
								jQuery('#' + progress_window + ' .progress-bar').attr('style', 'width: ' + (Math.round((itrn + 1) / ids.length * 100)) + '%;').html(progress.replace(/\<i\>/, (itrn + 1)));
								if(itrn < (ids.length - 1)){
									delete_record(itrn + 1);
								}else{
									if(jQuery('.well.details_list li.text-danger, .well.details_list li.text-warning').length){
										jQuery('button.details_toggle').removeClass('btn-default').addClass('btn-warning').click();
										jQuery('.btn-warning[id^=' + progress_window + '_footer_button_]')
											.toggleClass('btn-warning btn-default')
											.html('<?php echo addslashes($Translation['ok']); ?>');
									}else{
										setTimeout(function(){ jQuery('#' + progress_window).modal('hide'); }, 500);
									}
								}
							}
						});
					}

					delete_record(0);
				}
			},
			{
				label: '<i class="glyphicon glyphicon-ok"></i> ' + label_no,
				bs_class: 'success' 
			}
		]
	});
}

function mass_change_owner(t, ids){
	if(ids == undefined) return;
	if(!ids.length) return;

	var update_form = '<?php echo addslashes($Translation['Change owner of <n> selected records to']); ?> ' + 
		'<span id="new_owner_for_selected_records"></span><input type="hidden" name="new_owner_for_selected_records" value="">';
	var confirm_title = '<?php echo addslashes($Translation['Change owner']); ?>';
	var label_yes = '<?php echo addslashes($Translation['Continue']); ?>';
	var label_no = '<?php echo addslashes($Translation['Cancel']); ?>';
	var progress = '<?php echo addslashes($Translation['Updating record <i> of <n>']); ?>';
	var continue_updating = true;

	// request confirmation of mass update operation
	modal_window({
		message: update_form.replace(/\<n\>/, ids.length),
		title: confirm_title,
		footer: [ /* shows a 'continue' and a 'cancel' buttons .. handler for each follows ... */
			{
				label: '<i class="glyphicon glyphicon-ok"></i> ' + label_yes,
				bs_class: 'success',
				// on confirming, start update operations
				click: function(){
					var memberID = jQuery('input[name=new_owner_for_selected_records]').eq(0).val();
					if(!memberID.length) return;

					// show update progress, allowing user to abort operations by closing the window or clicking cancel
					var progress_window = modal_window({
						title: '<?php echo addslashes($Translation['Update progress']); ?>',
						message: '' +
							'<div class="progress">' +
								'<div class="progress-bar progress-bar-success" role="progressbar" style="width: 0;"></div>' +
							'</div>' + 
							'<button type="button" class="btn btn-default details_toggle" onclick="' +
								'jQuery(this).children(\'.glyphicon\').toggleClass(\'glyphicon-chevron-right glyphicon-chevron-down\'); ' +
								'jQuery(\'.well.details_list\').toggleClass(\'hidden\');'
								+ '">' +
								'<i class="glyphicon glyphicon-chevron-right"></i> ' +
								'<?php echo addslashes($Translation['Show/hide details']); ?>' +
							'</button>' +
							'<div class="well well-sm details_list hidden"><ol></ol></div>',
						close: function(){
							// stop updating further records ...
							continue_updating = false;
						},
						footer: [
							{
								label: '<i class="glyphicon glyphicon-remove"></i> <?php echo addslashes($Translation['Cancel']); ?>',
								bs_class: 'warning'
							}
						]
					});

					// begin updating records, one by one
					progress = progress.replace(/\<n\>/, ids.length);
					var update_record = function(itrn){
						if(!continue_updating) return;
						jQuery.ajax('admin/pageEditOwnership.php', {
							type: 'POST',
							data: {
								pkValue: ids[itrn],
								t: t,
								memberID: memberID,
								saveChanges: 'Save changes'
							},
							success: function(resp){
								if(resp == 'OK'){
									jQuery(".well.details_list ol").append('<li class="text-success"><?php echo addslashes($Translation['record updated']); ?></li>');
									jQuery('#record_selector_' + ids[itrn]).prop('checked', false);
									jQuery('#select_all_records').prop('checked', false);
								}else{
									jQuery(".well.details_list ol").append('<li class="text-danger">' + resp + '</li>');
								}
							},
							error: function(){
								jQuery(".well.details_list ol").append('<li class="text-warning"><?php echo addslashes($Translation['Connection error']); ?></li>');
							},
							complete: function(){
								jQuery('#' + progress_window + ' .progress-bar').attr('style', 'width: ' + (Math.round((itrn + 1) / ids.length * 100)) + '%;').html(progress.replace(/\<i\>/, (itrn + 1)));
								if(itrn < (ids.length - 1)){
									update_record(itrn + 1);
								}else{
									if(jQuery('.well.details_list li.text-danger, .well.details_list li.text-warning').length){
										jQuery('button.details_toggle').removeClass('btn-default').addClass('btn-warning').click();
										jQuery('.btn-warning[id^=' + progress_window + '_footer_button_]')
											.toggleClass('btn-warning btn-default')
											.html('<?php echo addslashes($Translation['ok']); ?>');
									}else{
										jQuery('button.btn-warning[id^=' + progress_window + '_footer_button_]')
											.toggleClass('btn-warning btn-success')
											.html('<i class="glyphicon glyphicon-ok"></i> <?php echo addslashes($Translation['ok']); ?>');
									}
								}
							}
						});
					}

					update_record(0);
				}
			},
			{
				label: '<i class="glyphicon glyphicon-remove"></i> ' + label_no,
				bs_class: 'warning' 
			}
		]
	});

	/* show drop down of users */
	var populate_new_owner_dropdown = function(){

		jQuery('[id=new_owner_for_selected_records]').select2({
			width: '100%',
			formatNoMatches: function(term){ return '<?php echo addslashes($Translation['No matches found!']); ?>'; },
			minimumResultsForSearch: 10,
			loadMorePadding: 200,
			escapeMarkup: function(m){ return m; },
			ajax: {
				url: 'admin/getUsers.php',
				dataType: 'json',
				cache: true,
				data: function(term, page){ return { s: term, p: page, t: t }; },
				results: function(resp, page){ return resp; }
			}
		}).on('change', function(e){
			jQuery('[name="new_owner_for_selected_records"]').val(e.added.id);
		});

	}

	populate_new_owner_dropdown();
}

function add_more_actions_link(){
	window.open('http://www.google.com');
}

/* detect current screen size (xs, sm, md or lg) */
function screen_size(sz){
	if(!$j('.device-xs').length){
		$j('body').append(
			'<div class="device-xs visible-xs"></div>' +
			'<div class="device-sm visible-sm"></div>' +
			'<div class="device-md visible-md"></div>' +
			'<div class="device-lg visible-lg"></div>'
		);
	}
	return $j('.device-' + sz).is(':visible');
}

/* enable floating of action buttons in DV so they are visible on vertical scrolling */
function enable_dvab_floating(){
	/* already run? */
	if(window.enable_dvab_floating_run != undefined) return;

	/* scroll action buttons of DV on scrolling DV */
	$j(window).scroll(function(){
		if(!screen_size('md') && !screen_size('lg')) return;
		if(!$j('.detail_view').length) return;

		/* get vscroll amount, DV form height, button toolbar height and position */
		var vscroll = $j(window).scrollTop();
		var dv_height = $j('[id$="_dv_form"]').eq(0).height();
		var bt_height = $j('.detail_view .btn-toolbar').height();
		var form_top = $j('.detail_view .form-group').eq(0).offset().top;
		var bt_top_max = dv_height - bt_height - 10;

		if(vscroll > form_top){
			var tm = parseInt(vscroll - form_top) + 60;
			if(tm > bt_top_max) tm = bt_top_max;

			$j('.detail_view .btn-toolbar').css({ 'margin-top': tm + 'px' });
		}else{
			$j('.detail_view .btn-toolbar').css({ 'margin-top': 0 });
		}
	});
	window.enable_dvab_floating_run = true;
}

/* check if a given field's value is unique and reflect this in the DV form */
function enforce_uniqueness(table, field){
	$j('#' + field).on('change', function(){
		/* check uniqueness of field */
		var data = {
			t: table,
			f: field,
			value: $j('#' + field).val()
		};

		if($j('[name=SelectedID]').val().length) data.id = $j('[name=SelectedID]').val();

		$j.ajax({
			url: 'ajax_check_unique.php',
			data: data,
			complete: function(resp){
				if(resp.responseJSON.result == 'ok'){
					$j('#' + field + '-uniqueness-note').hide();
					$j('#' + field).parents('.form-group').removeClass('has-error');
				}else{
					$j('#' + field + '-uniqueness-note').show();
					$j('#' + field).parents('.form-group').addClass('has-error');
					$j('#' + field).focus();
					setTimeout(function(){ $j('#update, #insert').prop('disabled', true); }, 500);
				}
			}
		})
	});
}
