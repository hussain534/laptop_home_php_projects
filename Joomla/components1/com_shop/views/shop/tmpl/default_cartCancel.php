<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;

    if(isset($_GET['orderId']))
    {
        $sql = "UPDATE RN_ORDER_MANAGEMENT SET order_status=1,order_cancel=now(), order_canceled_by='".$_SESSION["userid"]."' where order_num=".$_GET['orderId'];
        if(mysqli_query($dbcon,$sql))
        {
              $_SESSION["message"]="Your order ".$_GET['orderId']." canceled successfully"; 
              unset($_SESSION['Order_id']);         
        }    
        else
            $_SESSION["message"]="Error while canceling your order ".$_GET['orderId'].".Please contact our call center.";
    }	
    else
    {
        $_SESSION["message"]="Error while canceling your order ".$_GET['orderId'].".Please contact our call center.";
    }
    $url="index.php?view=shop&layout=manageCart";

	header("Location:$url"); 
?>