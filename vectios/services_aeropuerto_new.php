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
<div class="container">
	<br>
	<?php
		if(isset($_SESSION['userid']))
				include_once('submenu.php');
	?>
	<div class="row">
		<div class="col-sm-12 banner" style="padding:0" id="title_servicios_aeropuerto">
			<img src="images/airport3.jpg"style="width:100%;max-height:300px;">
			<span class="caption_banner option animated bounceInDown">
				<span style="font-size:50px;color:cornsilk">VIAJES A AEROPUERTO</span>				
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
					<!-- <h1>¡VIAJAR AL AEROPUERTO NUNCA A SIDO TAN FÁCIL NI PROVECHOSO PARA TUS PROPIOS INTERESES!</h1> -->
					<h1>AHORRA DINERO Y VIAJA DE UNA MANERA FÁCIL, CÓMODA Y SEGURA. <br>¡GENERA TAMBIÉN NUEVOS CONTACTOS EN TIEMPO REAL!</h1>
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
				<!-- <div class="col-sm-2">
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
							<h5>Busca el vectios que mas se acomode a la hora de tu vuelo y haz tu reserva compartiendo el costo de tu ida asi al aeropuerto</h5>
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
							<h5>Viaja por tan solo 12 dólares desde la puerta de tu domicilio o oficina asi al aeropuerto y reserva tu retorno por $8.00  más asi a Quito.</h5>
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
							<h5>Evita complicaciones de tiempo programando tu viaje haciendo una reserva en VECTIOS</h5>
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
							<h5>Sácale el mayor provecho a tu viaje creando amistades y contactos de interés a lo largo del trayecto viajando con VECTIOS</h5>
						</div>
					</div>
				</div>	
				<div class="col-sm-2">
				</div> -->
				<div class="col-sm-3">
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
							<h5>Viaja por 12 dólares hacia el aeropuerto y reserva tu retorno por 8 dólares más. Desde la puerta de tu hogar y/o oficina</h5>
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
							<h5>Evita complicaciones programando tu viaje con seguridad y eficiencia</h5>
						</div>
					</div>				
				</div>				
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center option animated slideInUp">	
							<img src="images/conocer.png" class="img_rounded">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>NETWORKING</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Genera contactos de interés durante y después del trayecto</h5>
						</div>
					</div>
				</div>	
				<div class="col-sm-3">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
				</div>			
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/amigos.png" class="img_rounded">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>AMIGOS</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Si viajan dos personas conocidos pagarás solo uno tarifa de $20.00 por los dos.</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/familiar.png" class="img_rounded">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>FAMILIAR</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Si viajas en plan familiar,pagarás $25.00.</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/retorno.png" class="img_rounded">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>RETORNO</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Reserva tu viaje de retorno al comprar tu viaje de ida por tan solo 8 dólares más.</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
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
							<h5>Busca el viaje que más te convenga hacia el aeropuerto y/o de retorno.</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/Horario.png" class="img_rounded_e2552a">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>ELIGE HORARIO</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Ingresa la fecha y hora de viaje que más se ajuste a tu vuelo.Vuelos nacionales ( 1h30) internacional ( 2h30)</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/equipaje.png" class="img_rounded_e2552a">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>INDICA EQUIPAJE</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Indica la cantidad exacta de equipaje así como el tamaño.</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/pagar.png" class="img_rounded_e2552a">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>REALIZA TU PAGO</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Transferencias, depósitos y Payphone para tarjetas de crédito y débito.</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/notificar.png" class="img_rounded_e2552a">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>NOTIFICACIÓN</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Vía email recibirás detalles del vehículo, conductor y código de viaje para tu seguridad.</h5>
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
				<div class="col-sm-12 text-center">
					<h3>HORARIOS DE SALIDA</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2 text-center">
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/buscar2.png" class="img_rounded_e2552a">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>FRECUENCIAS DE VIAJE</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Cada 30 minutos se realizan viajes pero debes reservar mínimo con 90 minutos de anticipación para evitar contratiempos.</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/disponibiliad.png" class="img_rounded_e2552a">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>TIEMPO DE RECOGIDA</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Debes tener 30 minutos de disponibilidad antes del horario de reserva para ser recogido junto a los demás pasajeros a tiempo.</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/emergente.png" class="img_rounded_e2552a">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>VIAJE EN TEIMPO CORTO</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Si deseas viajar de forma inmediata, podrás reservar tu viaje con una tarifa de $25.00, recogiendote en el lugar donde te encunetres en un tiempo récord.</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
					<div class="row">
						<div class="col-sm-12 text-center">	
							<img src="images/emergente.png" class="img_rounded_e2552a">
						</div>
						<div class="col-sm-12 text-center">	
							<h4>VIAJE PREMIUM</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Viaja solo y de manera inmediata por una tarifa especial.</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-center">
				</div>
			</div>
			<br>
			<br>
			<br>			
			<div class="row">
				<div class="col-sm-12 text-center">
					<h3>PREGUNTAS FRECUENTES</h3>
				</div>
			</div>
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
							<h4>PUBLICAR TU DISPONIBILIDAD</h4>
						</div>
						<div class="col-sm-12 text-justify">
							<h5>Indicar su horarios de disponibilidad y la plataforma te asigna un viaje según su disponibilidad indicado.</h5> 
							<h5>La periodo maximo de su disponibilidad es 3 horas.</h5> 
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
							<h5>Ingresa todos los detalles de tu viaje, tanto en términos de máximo de personas (3 personas máximo, 4 en plan familiar), como de espacio para el equipaje (cantidad de maletas)</h5>
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
			<div class="row">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6 text-center">
					<h5>*   El plataforma asigan un viaje según orden de publicacion de cada conductor.</h5>
				</div>
				<div class="col-sm-3">
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
					<h5><strong>** En dicha hora estipulada se debe estar ya en el punto de salida(Intercambiador Carcelen - Tunel Guayasamin - Guápulo) hacia el aeropuerto correspondiente.</strong></h5>
				</div>
				<div class="col-sm-3">
				</div>
			</div>
			<br>
			<br>
			<br>			
			<div class="row">
				<div class="col-sm-12 text-center">
					<h3>PREGUNTAS FRECUENTES</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center">
				</div>
			</div>
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