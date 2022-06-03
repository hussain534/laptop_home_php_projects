<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    include_once('util.php');
	include_once('config.php'); 
	$session_time=$session_expirry_time;
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
  	$_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }
	include_once('header.php');

?>
<br>
<br>
<div class="container">
	<br>
	<?php
		if(isset($_SESSION['userid']))
				include_once('submenu.php');
	?>
	<div class="row">
		<div class="col-sm-12 banner" style="padding:0" id="title_servicios_aeropuerto">
			<img src="images/nacional2.jpg"style="width:100%;max-height:400px;">
			<span class="caption_banner option animated bounceInDown">
				<span style="font-size:50px;color:cornsilk">VIAJES NACIONALES</span>				
			</span>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 bg-warning">	
			<br>		
			<br>
			<br>
			<div class="row">
				<div class="col-sm-12 text-center option animated slideInLeft" style="letter-spacing:.1em">					
					<h1>¡AHORRA DINERO Y SÁCALE EL MEJOR PROVECHO A TUS VIAJES!</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center option animated slideInRight" style="letter-spacing:.1em">
					<h3>INFORMACION GENERAL</h3>
				</div>
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-2">
				</div>			
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center option animated slideInUp">	
							<img src="images/buscar.png" class="img_rounded">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>BUSCAR</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Busca el viaje que se acomode a tu tiempo, viaja compartiendo el gasto de viaje</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center option animated slideInUp">	
							<img src="images/dollar.png" class="img_rounded">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>AHORRAR</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Compartir tus gastos de viaje con otros pasajeros.</h5>
						</div>
					</div>				
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center option animated slideInUp">	
							<img src="images/computer3.png" class="img_rounded">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>VAIJE SMART</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Evita complicaciones de planificar tu viaje a cualquier cuidad nacional o internacional</h5>
						</div>
					</div>				
				</div>				
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center option animated slideInUp">	
							<img src="images/conocer.png" class="img_rounded">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>HACER AMIGOS</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Sácale el mayor provecho a tu viaje creando amistades y contactos de interés a lo largo del trayecto</h5>
						</div>
					</div>
				</div>	
				<div class="col-sm-2">
				</div>
			</div>
			
			<br>
			<br>
			<br>		
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12" style="background:antiquewhite">
			<br>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-12 text-center" style="letter-spacing:.1em">
					<h1>PASAJEROS</h1>
				</div>
			</div>			
			<div class="row">
				<div class="col-sm-12 text-center">
					<h3>¿CÓMO FUNCIONA PARA PASAJEROS?</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-1 text-center">
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/plataforma.png" class="img_rounded_e2552a">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>BUSCA TU VIAJE</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Ingresa a la plataforma y indicar su lugar/sector de salida.</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/Horario.png" class="img_rounded_e2552a">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>ESCOGE HORARIO</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Ingresa el fecha y horario que más se ajusta para iniciar tu viaje</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/equipaje.png" class="img_rounded_e2552a">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>INDICAR EQUIPAJE</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Especifica la cantidad de equipaje que llevas.</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/pagar.png" class="img_rounded_e2552a">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>REALIZAR PAGO</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Realizarás tu pago por medio de transferencia bancaria, deposito en banco, payPhone, etc.</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/notificar.png" class="img_rounded_e2552a">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>NOTIFICACION</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Recibirás un correo electrónico indicando detalles del vehículo, placa y perfil del conductor.</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-1 text-center">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6 text-left">
					<h5><strong>*&nbsp;&nbsp;&nbsp;El conductor se pondrá en contacto contigo para ultimar detalles de tu recogida</strong></h5>
					<h5><strong>**&nbsp;&nbsp;En el viaje debes facilitarle al conductor tu codigo de viaje para que él pueda recibir su pago</strong></h5>
					<h5><strong>***&nbsp;Una vez terminado el viaje, puedes dejar comentarios y opiniones acerca del conductor</strong></h5>
				</div>
				<div class="col-sm-3">
				</div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-3 text-center">
				</div>
				<div class="col-sm-6 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/disponibiliad.png" class="img_rounded_e2552a">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>TIEMPO DE RECOGER</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Ten en cuenta que debes tener 30 minutos de disponibilidad antes del horario de la reserva para que el conductor puede recogerte a ti y a los demás acompañantes.</h5>
						</div>
					</div>
				</div>				
				<div class="col-sm-3 text-center">
				</div>
			</div>
			<br>
			<br>
			<br>			
			<!-- <div class="row">
				<div class="col-sm-12 text-center">
					<h3>PREGUNTAS FRECUENTES</h3>
				</div>
			</div> -->
			<div class="row">
				<div class="col-sm-12 text-center">
				</div>
			</div>
			<br>
			<br>
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12" style="background:burlywood">
			<br>
			<br>
			<br>	
			<div class="row">
				<div class="col-sm-12 text-center" style="letter-spacing:.1em">
					<h1>CONDUCTORES</h1>
				</div>
			</div>		
			<div class="row">
				<div class="col-sm-12 text-center">
					<h3>¿CÓMO FUNCIONA PARA CONDUCTORES?</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-1 text-center">
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/publicar_viaje.png" class="img_rounded_fafafa">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>PUBLICACION TU VIAJE</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Genera un viaje a cualquier destino nacional o internacional.Ingresa fecha-hora, lugar de salida y lugar o sector destino.</h5> 
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/detalles.png" class="img_rounded_fafafa">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>DETALLES DEL VIAJE</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Ingresa disponibilidad de asientos, limite e equipaje (cantidad de maletas)</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/email2.png" class="img_rounded_fafafa">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>EMAIL DE ACCEPTACION</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Recibirás la información correspondiente a tu correo electrónico y por mensaje una vez un usuario haya realizado una reserva</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/contact.png" class="img_rounded_fafafa">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>PONTE EN CONTACTO</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Ponte en contacto y recoge a los usuarios en su  domicilio o lugar de preferencia respectivo en los horarios establecidos</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/pagos2.png" class="img_rounded_fafafa">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>RECEPCION DE PAGOS</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Recibe tu pago correspondiente según tus preferencias de cobro una vez los usuarios hayan confirmado que el viaje ha sido exitoso</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-1 text-center">
				</div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-12 text-center">
					<h3>NORMATIVIDAD DEL SERVICIO</h3>
					<h5>Todas las personas que decidan viajar como conductores, deben tener en cuenta estos tres principios elementales con el fin de brindar la mejor experiencia de viaje posible:</h5>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 text-center">
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/documentos.png" class="img_rounded_fafafa">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>DOCUMENTOS EN REGLA</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Todos los conductores deben tener sus papeles en regla (Matricula, licencia,). sin excepciones</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/feliz.png" class="img_rounded_fafafa">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>CONDUCCION RESPONSABLE</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Respetar los límites de velocidad, así como una conducción prudente que no ponga en peligro la vida de tus acompañantes es elemental.</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/puntualidad.png" class="img_rounded_fafafa">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>PUNTUALIDAD Y VEHICULO</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Tan solo debes cumplir con tus horarios pactados, así como ofrecer tu vehículo de la misma manera en que te gustaría encontrarlo para tu propio beneficio.</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-3 text-center">
				</div>
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6 text-center">
					<h5><strong>*  Los pasajeros deberán ser recogidos media hora antes del horario de la reserva.</strong></h5>
				</div>
				<div class="col-sm-3">
				</div>
			</div>
			<br>
			<br>
			<br>			
			<!-- <div class="row">
				<div class="col-sm-12 text-center">
					<h3>PREGUNTAS FRECUENTES</h3>
				</div>
			</div> -->
			
			<br>
			<br>
			<br>
		</div>
	</div>
</div>
<?php
include_once('services.php');
include_once('footer.php');
?>