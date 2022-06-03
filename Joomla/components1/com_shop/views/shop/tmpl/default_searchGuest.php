<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;

	$searchGuestParam = $_POST['searchGuestParam'];

    

    $url="index.php?view=shop&layout=searchGuestContainer&pagecount=0&searchGuest=".$searchGuestParam;
	header("Location:$url"); 
?>