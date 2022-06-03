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
        $sql = "UPDATE rn_order_management SET order_status=1,order_cancel=now(), order_canceled_by='".$_SESSION["userid"]."' where order_num=".$_GET['orderId'];
        if(mysqli_query($dbcon,$sql))
        {
              $_SESSION["message"]="Your order ".$_GET['orderId']." canceled successfully";  


              $to = $_SESSION['userEmail'];
					$subject = "ORDER CANCELLED - ".$_GET['orderId'];
					$txt = "Hello ".$_SESSION['userName']."!\n\n";
					$txt=$txt."You cancelled your order :".$_GET['orderId'].".\n\n";
					$txt=$txt."NOTE: If you didnot cancelled this order, please contact to our customer care.\n";
					$headers = "From: info@shop534.com";
					$res=mail($to,$subject,$txt,$headers);
    				#$messsage="Your order is cancelled.Your Order ID is:".$_GET['orderId'].". Please keep this order number safe with you. We will call you shortly to confirm the order and start delivery.";
    				$doShowCurrentItem=1;
    				#$_SESSION["session_msg"]=$messsage;        
        }    
        else
            $_SESSION["message"]="Error while canceling your order ".$_GET['orderId'].".Please contact our call center.";
    }	
    else
    {
        $_SESSION["message"]="Error while canceling your order ".$_GET['orderId'].".Please contact our call center.";
    }
    $url="index.php?view=shop&layout=orderhistory";

	header("Location:$url"); 
?>