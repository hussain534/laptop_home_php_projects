<?php
defined('_JEXEC') or die('Access Deny');
if(!defined('DS')){
    define('DS',DIRECTORY_SEPARATOR);
}
require_once(dirname(__FILE__).DS.'helper.php');
if(isset($_POST['mycontact_btn']))
{
	$jinput=JFactory::getApplication()->input;
	$name=$jinput->get('name','','STRING');
	$nrocontacto=$jinput->get('nrocontacto','','STRING');
	$email=$jinput->get('email','','RAW');
	$message=$jinput->get('message','','RAW');
	
	modMyContactHelper::sendEmail($name, $email, $message,$nrocontacto);
	?>
	<div style="width:100%;margin:30px auto;">
		<p style="text-align:center; color:green;"> Gracias <?php echo $name; ?> para contactarnos. Se pondrá en contacto con usted lo antes posible.</p>
	</div>
	<?php
}

require(JModuleHelper::getLayoutPath('mod_contactForm'));
?>