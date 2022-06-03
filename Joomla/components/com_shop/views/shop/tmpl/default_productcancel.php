<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;

    if(isset($_GET['orderId']) and isset($_GET['prodId']))
    {
        $sql = "DELETE FROM rn_order_management where ITEM_ID=".$_GET['prodId']." and order_num=".$_GET['orderId'];
        if(mysqli_query($dbcon,$sql))
        {
              $_SESSION["message_product_delete"]="Product removed from cart successfully";          
        }    
        else
            $_SESSION["message_product_delete"]="Error while removing product from cart.Please contact our call center.";
    }	
    else
    {
        $_SESSION["message_product_delete"]="Error while removing product from cart.Please contact our call center.";
    }
    $url="index.php?view=shop&layout=managecart";

	header("Location:$url"); 
?>