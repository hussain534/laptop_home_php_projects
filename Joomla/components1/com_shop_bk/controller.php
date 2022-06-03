<?php

defined('_JEXEC') or die('Restricted access');

class ShopController extends JControllerLegacy
{
	//task : sayHello
	function sayHello()
	{
		$doc=JFactory::getDocument();
		$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
		echo '<div id="welcome">WELCOME TO SHOP 534</div>';
	}
}