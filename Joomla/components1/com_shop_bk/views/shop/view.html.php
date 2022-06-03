<?php

defined('_JEXEC') or die('Restricted access');
 

class ShopViewShop extends JViewLegacy
{
	function display($tpl = null)
	{
		// Assign data to the view
		$this->data = $this->get('DefaultPageData');


		$tpl=JRequest::getCmd('layout',null);
		parent::display($tpl);
	}
}