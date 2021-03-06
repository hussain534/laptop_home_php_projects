<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    //include_once('util.php');
	include_once('config.php');
	$session_time=$session_expirry_time;	
	$DEBUG_STATUS = $PRINT_LOG;
	$PERFIL_ID_JEFE_RENAL=$PERFIL_JEFE_RENAL;
	$PERFIL_ID_JEFE_LAB=$PERFIL_JEFE_LAB;
	require 'dbcontroller.php';
	$controller = new controller();
	if(!isset($_SESSION["user_name"]) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
	{
		$url='cerrarSesion.php';
		header("Location:$url");
	}
	else
	{
		include_once('util.php');
	}
	$_SESSION['LAST_ACTIVITY'] = time();

	include_once('menuPanel.php');
	$message='';
	if(isset($_SESSION["message"])) 
	{
		//echo $_SESSION["message"];
		$message=$_SESSION["message"];
		unset($_SESSION["message"]);
	}
	if($_SESSION["client_id"]==1 || $_SESSION["tipo_cliente"]==1)
	{
		$peticiones_pending_renales = $controller->getPeticiones($databasecon,0,1,1,$DEBUG_STATUS);
		$peticiones_en_curso_renales = $controller->getPeticiones($databasecon,0,2,1,$DEBUG_STATUS);
		$peticiones_atendidas_renales = $controller->getPeticiones($databasecon,0,3,1,$DEBUG_STATUS);
	}

	if($_SESSION["client_id"]==1 || $_SESSION["tipo_cliente"]==2)
	{
		$peticiones_pending_laboratorio = $controller->getPeticiones($databasecon,0,1,2,$DEBUG_STATUS);
		$peticiones_en_curso_laboratorio = $controller->getPeticiones($databasecon,0,2,2,$DEBUG_STATUS);
		$peticiones_atendidas_laboratorio = $controller->getPeticiones($databasecon,0,3,2,$DEBUG_STATUS);
	}

	if($_SESSION["client_id"]==1 || $_SESSION["tipo_cliente"]==0)
	{
		$peticiones_pending_no_clasificados = $controller->getPeticiones($databasecon,0,1,0,$DEBUG_STATUS);
		$peticiones_en_curso_no_clasificados = $controller->getPeticiones($databasecon,0,2,0,$DEBUG_STATUS);
		$peticiones_atendidas_no_clasificados = $controller->getPeticiones($databasecon,0,3,0,$DEBUG_STATUS);
	}
?>
<div class="container">
	<div class="row">
		<div class="col-sm-2 sidebar">
			<?php include_once('menu.php');?>
		</div>
		<div class="col-sm-10">
			<div class="row">
				<div class="col-sm-12">
					<?php include_once('mysession.php');?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center">
					<span style="font-size:56px;color:#f5f5f5;">PETICIONES&nbsp;&nbsp;&nbsp;</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12 text-center">
					<!-- <h3><?php if(($_SESSION["client_id"]==1 && $_SESSION["user_perfil"]!=$PERFIL_ID_JEFE_LAB) || $_SESSION["tipo_cliente"]==1) echo 'CLIENTE RENALES';?></h3> -->
					<h3><?php if(($_SESSION["client_id"]==1 && $_SESSION["gestion_cliente"]!=2) || $_SESSION["tipo_cliente"]==1) echo 'CLIENTE RENALES';?></h3>
				</div>
			</div>
			
			<?php 
				/*if(($_SESSION["client_id"]==1 && $_SESSION["user_perfil"]!=$PERFIL_ID_JEFE_LAB) || $_SESSION["tipo_cliente"]==1)*///40 is the perfil id of jefe laboratory
			if(($_SESSION["client_id"]==1 && $_SESSION["gestion_cliente"]!=2) || $_SESSION["tipo_cliente"]==1)
			{
			?>
			<br>
			<div class="row">
				<div class="col-sm-4 text-center">
					<a href="gestionPeticion.php?estado=1&tipo_cliente=1">
						<img src="images/icons/tasks.png" id="dash_img">
						<span class="badge"><?php echo count($peticiones_pending_renales);?></span><br>
						<!-- <button type="button">PENDIENTES</button> -->
						<button type="button" class="btn btn-small btn_center">ABIERTA<span class="glyphicon glyphicon-chevron-right"></span></button>
					</a>
				</div>
				<div class="col-sm-4 text-center">
					<a href="gestionPeticion.php?estado=2&tipo_cliente=1">
						<img src="images/icons/tasks.png" id="dash_img">
						<span class="badge"><?php echo count($peticiones_en_curso_renales);?></span><br>
						<!-- <button type="button">EN CURSO</button> -->
						<button type="button" class="btn btn-small btn_center">EN CURSO<span class="glyphicon glyphicon-chevron-right"></span></button>
					</a>
				</div>
				<div class="col-sm-4 text-center">
					<a href="gestionPeticion.php?estado=3&tipo_cliente=1">
						<img src="images/icons/tasks.png" id="dash_img">
						<span class="badge"><?php echo count($peticiones_atendidas_renales);?></span><br>
						<!-- <button type="button">ATENDIDAS </button> -->
						<button type="button" class="btn btn-small btn_center">CERRADA<span class="glyphicon glyphicon-chevron-right"></span></button>
					</a>
				</div>
			</div>
			<br>
			<?php
			}
			?>
			
			<div class="row">
				<div class="col-sm-12 text-center">
					<!-- <h3><?php if(($_SESSION["client_id"]==1 && $_SESSION["user_perfil"]!=$PERFIL_ID_JEFE_RENAL) || $_SESSION["tipo_cliente"]==2) echo 'CLIENTE LABORATORIOS'; ?></h3> -->
					<h3><?php if(($_SESSION["client_id"]==1 && $_SESSION["gestion_cliente"]!=1) || $_SESSION["tipo_cliente"]==2) echo 'CLIENTE LABORATORIOS'; ?></h3>
				</div>
			</div>
			
			<?php 
			/*if(($_SESSION["client_id"]==1 && $_SESSION["user_perfil"]!=$PERFIL_ID_JEFE_RENAL) || $_SESSION["tipo_cliente"]==2)*///41 is the perfil id of jefe renal
			if(($_SESSION["client_id"]==1 && $_SESSION["gestion_cliente"]!=1) || $_SESSION["tipo_cliente"]==2)
			{
			?>
			<br>
			<div class="row">
				<div class="col-sm-4 text-center">
					<a href="gestionPeticion.php?estado=1&tipo_cliente=2">
						<img src="images/icons/tasks.png" id="dash_img">
						<span class="badge"><?php echo count($peticiones_pending_laboratorio);?></span><br>
						<!-- <button type="button">PENDIENTES</button> -->
						<button type="button" class="btn btn-small btn_center">ABIERTA<span class="glyphicon glyphicon-chevron-right"></span></button>
					</a>
				</div>
				<div class="col-sm-4 text-center">
					<a href="gestionPeticion.php?estado=2&tipo_cliente=2">
						<img src="images/icons/tasks.png" id="dash_img">
						<span class="badge"><?php echo count($peticiones_en_curso_laboratorio);?></span><br>
						<!-- <button type="button">EN CURSO</button> -->
						<button type="button" class="btn btn-small btn_center">EN CURSO<span class="glyphicon glyphicon-chevron-right"></span></button>
					</a>
				</div>
				<div class="col-sm-4 text-center">
					<a href="gestionPeticion.php?estado=3&tipo_cliente=2">
						<img src="images/icons/tasks.png" id="dash_img">
						<span class="badge"><?php echo count($peticiones_atendidas_laboratorio);?></span><br>
						<!-- <button type="button">ATENDIDAS </button> -->
						<button type="button" class="btn btn-small btn_center">CERRADA<span class="glyphicon glyphicon-chevron-right"></span></button>
					</a>
				</div>
			</div>
			<br>
			<?php
			}
			?>

			<div class="row">
				<div class="col-sm-12 text-center">
					<!-- <h3><?php if(($_SESSION["client_id"]==1 && $_SESSION["user_perfil"]!=$PERFIL_ID_JEFE_RENAL && $_SESSION["user_perfil"]!=$PERFIL_ID_JEFE_LAB)) echo 'CLIENTE NO CLASIFICADOS';?></h3> -->
					<h3><?php if(($_SESSION["client_id"]==1 && $_SESSION["gestion_cliente"]==0)) echo 'CLIENTE NO CLASIFICADOS';?></h3>
				</div>
			</div>
			
			<?php 
			/*if(($_SESSION["client_id"]==1 && $_SESSION["user_perfil"]!=$PERFIL_ID_JEFE_RENAL && $_SESSION["user_perfil"]!=$PERFIL_ID_JEFE_LAB))*/
			if(($_SESSION["client_id"]==1 && $_SESSION["gestion_cliente"]==0))
			{
			?>
			<br>
			<div class="row">
				<div class="col-sm-4 text-center">
					<a href="gestionPeticion.php?estado=1&tipo_cliente=0">
						<img src="images/icons/tasks.png" id="dash_img">
						<span class="badge"><?php echo count($peticiones_pending_no_clasificados);?></span><br>
						<!-- <button type="button">PENDIENTES</button> -->
						<button type="button" class="btn btn-small btn_center">ABIERTA<span class="glyphicon glyphicon-chevron-right"></span></button>
					</a>
				</div>
				<div class="col-sm-4 text-center">
					<a href="gestionPeticion.php?estado=2&tipo_cliente=0">
						<img src="images/icons/tasks.png" id="dash_img">
						<span class="badge"><?php echo count($peticiones_en_curso_no_clasificados);?></span><br>
						<!-- <button type="button">EN CURSO</button> -->
						<button type="button" class="btn btn-small btn_center">EN CURSO<span class="glyphicon glyphicon-chevron-right"></span></button>
					</a>
				</div>
				<div class="col-sm-4 text-center">
					<a href="gestionPeticion.php?estado=3&tipo_cliente=0">
						<img src="images/icons/tasks.png" id="dash_img">
						<span class="badge"><?php echo count($peticiones_atendidas_no_clasificados);?></span><br>
						<!-- <button type="button">ATENDIDAS </button> -->
						<button type="button" class="btn btn-small btn_center">CERRADA<span class="glyphicon glyphicon-chevron-right"></span></button>
					</a>
				</div>
			</div>
			<?php
			}
			?>
		</div>
	</div>
</div>