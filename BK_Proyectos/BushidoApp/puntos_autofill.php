<?php
// This script and data application were generated by AppGini 5.51
// Download AppGini for free from http://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	handle_maintenance();

	header("Content-type: text/javascript; charset=UTF-8");

	if(!get_sql_from('puntos')){ die('// Access denied!'); }

	$mfk=$_GET['mfk'];
	$id=makeSafe($_GET['id']);
	$rnd1=intval($_GET['rnd1']); if(!$rnd1) $rnd1='';

	if(!$mfk){
		die('// No js code available!');
	}

	switch($mfk){

		case 'impacto':
			if(!$id){
				?>
				$('emblema<?php echo $rnd1; ?>').innerHTML='&nbsp;';
				<?php
				break;
			}
			$res = sql("SELECT `impactos`.`id` as 'id', `impactos`.`puntaje` as 'puntaje', `impactos`.`impactos` as 'impactos', `impactos`.`imagen` as 'imagen' FROM `impactos`  WHERE `impactos`.`id`='$id' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			<?php if($row['imagen']){ ?> 
				$j('#emblema<?php echo $rnd1; ?>').html('<a href="<?php echo $Translation['ImageFolder'] . addslashes(str_replace(array("\r", "\n"), '', $row['imagen'])); ?>" data-lightbox="puntos_dv"><img src="thumbnail.php?i=<?php echo urlencode($row['imagen']); ?>&t=impactos&f=imagen&v=dv" class="img-thumbnail"></a>');
			<?php }else{ ?>
				$j('#emblema<?php echo $rnd1; ?>').html('<img src="thumbnail.php?i=&t=impactos&f=imagen&v=dv" class="img-thumbnail">');
			<?php } ?>
			<?php
			break;


	}

?>