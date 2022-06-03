<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;

    if(isset($_GET['itemId']))
        $itemId = $_GET['itemId'];
    else
        $itemId = 0;

    if(!isset($_SESSION['Order_id']))
        $_SESSION['Order_id']=mt_rand();

    if(isset($_GET['itemId']))
    {
        //$sql = "UPDATE RN_ORDER_MANAGEMENT SET order_status=1,order_cancel=now(), order_canceled_by='".$_SESSION["userid"]."' where order_num=".$_GET['orderId'];

        $sql="INSERT INTO rn_order_management(order_num,user_id,user_name,item_id,item_name,client_id,client_name,
            price_per_unit,total_units,total_price,registration_portal) 
            select ".$_SESSION['Order_id'].",'".$_SESSION["userid"]."','".$_SESSION['userName']."', ri.rn_id,ri.rn_item_name,rc.rn_client_id,rc.rn_client_name,
            ri.rn_price,1,ri.rn_price, now() from rn_items ri, rn_clients rc where ri.rn_client_id=rc.rn_client_id and ri.rn_id=".$itemId;
        if(mysqli_query($dbcon,$sql))
        {
              $_SESSION["session_add_to_cart_msg"]="Product successfully added to cart";          
        }    
        else
            $_SESSION["session_add_to_cart_msg"]="Error while adding product to cart.Please contact our call center.";
    }	
    else
    {
        $_SESSION["session_add_to_cart_msg"]="Error while adding product to cart.Please contact our call center.";
    }
    $url="index.php?view=shop&layout=managecart";

	header("Location:$url"); 
?>