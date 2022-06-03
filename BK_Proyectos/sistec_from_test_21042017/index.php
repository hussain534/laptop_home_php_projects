<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    include_once('util.php');
	include_once('config.php');	
	$DEBUG_STATUS = $PRINT_LOG;

	require 'dbcontroller.php';
	$controller = new controller();
	
	include_once('menuPanel.php');

	
?>
<div class="container">
	<div class="row">
		<div class="row">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-6 text-center">
				<?php
			 		if(isset($_GET["error"]) && $_GET["error"]==1) 
					{
						echo '<h5 style="background:cornsilk; color:red;padding:5px 15px;">SESION TERMINADO O ACCESO DENEGADO. INGRESA NUEVAMENTE CON SU USUARIO REGISTRADO</h5>';
					}
				?>
			</div>
			<div class="col-sm-3">
			</div>
		</div>
		<div class="col-sm-6">
			<img src="images/support.png" style="width:500px;margin:50px;">	
		</div>
		<div class="col-sm-6">
			<br>
			<br>
			<br>
			<br>
			<br>
			<!-- <span class="banner_title">PMC</span>	
			<h1 class="banner_sub_title">PLATAFORMA PARA GESTION DE INCIDENTES</h1> -->
			<span class="banner_title"><img src="images/logo.png"></span>
			<ul>
				<li>Registra su peticiones online</li>
				<li>Monitoreo online de estados de peticiones</li>
				<li>Comunicar con tecnicos sin gastar saldos telefonico</li>
				<li>Registar una historico del mantenimiento de equipos</li>
				<li>Organiza su grupo de trabajo en maera hirarchia de perfil</li>
			</ul>
			<br>
			<button type="button" class="btn btn-big"><a href="registrar.php">REGISTRARSE</a><span class="glyphicon glyphicon-chevron-right"></span></button>			

		</div>		
	</div>
	<!-- <div class="row">
		<div class="col-sm-12" style="background:#fff">
			<div class="row">
				<div class="col-sm-4">
					<br>
					<br>
					<br>
					<br>
					<br>
					<h3 style="font-size:48px;text-align:center;color:#1E84C9">PROCESO DE GESTION DE INCIDENTES</h3>
				</div>
				<div class="col-sm-8">
					<img src="images/proceso.png" style="width:500px;margin:50px;">
				</div>
			</div>
		</div>
	</div> -->
	<div class="row">
		<div class="col-sm-6 text-center" style="background:#fff;height:350px;padding:4% 10%">
			<h3>UBICANOS AQUI</h3>
			<p>
				Calle El Arenal OE11-192 y Panamericana Norte<br>
				Telfs Quito: (02) 23477-164 / 2420-098 / 2428-005<br>
				Guayaquil: (04) 2082-809 / 2082-149<br>
				e-mail: ventasecuador@nipromed.com<br> 
				www.nipro.com.ec<br>
				Quito - Ecuador<br>
			</p>
		</div>
		<div class="col-sm-6 text-center" style="background:#fff;height:350px;padding:1% 10%">
			<form method="post" action="contact.php">
				<input type="hidden" name="submitted" value="true" />						
				
				<h3>ENVIAR SU MENSAJE</h3>
				<?php
					if(isset($messsage))
						echo '<h4>'.$messsage.'</h4>';
				?>
				<input type="text" class="form-control" style="margin-bottom: 5px;" id="contact_user" name="contact_user" placeholder="Escribe su nombre" required>
  				<input type="text" class="form-control" style="margin-bottom: 5px;" id="contact_email" name="contact_email" placeholder="Escribe su correo electronico" required>
  				<textarea class="form-control" style="margin-bottom: 5px;" name="contact_msg" placeholder="Escribe su mensaje" rows="5" required></textarea>
				<button type="submit" class="btn btn-default"  style="margin:5px" onclick="return validateEmail();">ENVIAR</button>
			</form>	
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 text-left" style="background:#291C71;color:#F5F5F5;font-size: 18px">
			<span style="color:#f5f5f5;font-size:12px;font-weight:bold;font-family: 'Taviraj', serif">SISTEC ECUADOR &copy;2016.</span><span style="color:#f5f5f5;font-size:9px;font-family: 'Taviraj', serif">&nbsp;&nbsp;&nbsp;TODOS LOS DERECHOS RESERVADOS</span>
		</div>
		<div class="col-sm-6 text-right" style="background:#291C71;color:#F5F5F5;font-size: 10px">
			<span style="color:#f5f5f5;font-size:12px;font-family: 'Taviraj', serif">DISEÑADO Y DESARROLLADO POR -<a href="http://www.merakiminds.com" style="color:#00b0f0;font-size:18px">MERAKI MINDS</a></span>
		</div>
	</div>
</div>
<script>
  function validateEmail() 
    {
        //alert("HI");
        var x = document.getElementById("contact_email").value;
        var atpos = x.indexOf("@");
        var dotpos = x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
            alert("ERROR FORMATO EMAIL");
            return false;
        }
        else
            return true;
}
</script>