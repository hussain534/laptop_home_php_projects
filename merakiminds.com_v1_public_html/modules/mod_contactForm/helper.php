<?php
defined('_JEXEC') or die('Access Deny');
class modMyContactHelper
{
	public static function sendEmail($name, $email, $message, $nrocontacto)
	{
		$mailer=JFactory::getMailer();
		$config=JFactory::getConfig();
		$sender=array($config->get('mailfrom'),$config->get('fromname'));
		$mailer->setSender($sender);
		$mailer->addRecipient('info@merakiminds.com');
		$mailer->setSubject('New Contact Form recieved from Web Page');
		$body="<h2>You have recieved a new contact form:</h2><br>";
		$body.="<h3>Name:$name</h3>";
		$body.="<h3>Email:$email</h3>";
		$body.="<h3>Contact Number:$nrocontacto</h3><br>";
		$body.="----------------------------------------------------------------------------<br>";
		$body.="<h3>Message:$message</h3><br>";
		$mailer->setBody($body);
		$mailer->isHTML(true);
		$mailer->send();

	}
}


?>