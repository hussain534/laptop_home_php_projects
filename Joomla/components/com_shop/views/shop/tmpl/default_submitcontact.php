<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;
    #echo 'contact_user::'.$_POST['contact_user'].'<br>';
    #echo 'contact_email::'.$_POST['contact_email'].'<br>';
    #echo 'contact_msg::'.$_POST['contact_msg'].'<br>';

	$sql = "INSERT INTO rn_mails(user_name, email_id,message,sent_on) values('".$_POST['contact_user']."','".$_POST['contact_email']."','".$_POST['contact_msg']."',now())";
    #echo 'SQL::'.$sql.'<br>';
    if(mysqli_query($dbcon,$sql))
    {   
        $_SESSION["contact_sent"]="<div class='alert alert-success shopAlert'>Your Message sent successfully.</div>";
    }
    else
    {
        $_SESSION["contact_sent"]="<div class='alert alert-danger shopAlert'>Message sending Failed. Please try Again</div>";
    }
    mysqli_close($dbcon);
    $url = "index.php?view=shop&layout=contactus"; 
    #echo 'status::'.$_SESSION["contact_sent"].'<br>';

	header("Location:$url"); 
?>