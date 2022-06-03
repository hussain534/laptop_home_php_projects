<?php
	defined('__JEXEC') or ('Access denied');
	include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'controladorDB.php';
    $controladorDB = new controladorDB();
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
		<?php
			include_once('logopanel.php');
		?>			
		</div>
	</div>
</div>