<?php
defined('_JEXEC') or die('Access Deny');
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_contactForm/css/contactStyle.css');

?>

<form name="mycontact" id="mycontact" method="post">


<fieldset>
	<legend>CONTÁCTENOS</legend>
	<div class="data">
		<div class="datarow">
			<label for="name">Nombre</label>
			<input type="text" size=50 name="name" id="name">
		</div>
		<div class="datarow">
			<label for="email">Correo - Electronico</label>
			<input type="email" size=50 name="email" id="email">
		</div>
		<div class="datarow">
			<label for="nrocontacto">Nro.Contacto</label>
			<input type="text" size=50 name="nrocontacto" id="nrocontacto">
		</div>
		<div class="datarow">
			<label for="message">Mensaje</label>
			<textarea name="message" id="message" cols="50" rows="17"></textarea>
		</div>
		<div class="datarow">
			<input type="submit" name="mycontact_btn" id="my_contact_btn" value="Enviar" class="submit_button" />
		</div>
	</div>
	
</fieldset>  
</form>