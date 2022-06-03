<?php

defined('_JEXEC') or die('Restricted access');

class ShopModelShop extends JModelItem
{
	public $dataset1=array('10','Hussain');
	public $dataset2=array('10','Paulina');
	
	public function getDefaultPageData()
	{
		$this->data=array($this->dataset1,$this->dataset2);
		return $this->data;
	}

}