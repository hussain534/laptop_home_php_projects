<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;
    if(isset($_SESSION["userid"]))
    {
    	$session_time=$session_expirry_time;
    	if(isset($_SESSION['LAST_ACTIVITY']))
	    {
			if(($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
			{
				$url="index.php?view=shop&layout=userlogout&tipo=2";
				header("Location:$url"); 
			}
            else
                $_SESSION['LAST_ACTIVITY'] = time();
		}
		else
			$_SESSION['LAST_ACTIVITY'] = time();
	}
    
    /*$pageURL = 'http://';
    if ($_SERVER["SERVER_PORT"] != "80") 
    {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } 
    else 
    {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    
    echo $pageURL;*/

    $pageURL="index.php";

    mysqli_autocommit($dbcon,FALSE);


    $sql = "SELECT * FROM rn_subscribe WHERE SUBSCRIBER_EMAIL='".$_POST['subscriber_email']."'";
    $result = mysqli_query($dbcon,$sql);
    //echo 'RESULT::'.mysqli_num_rows($result);
    if(mysqli_num_rows($result) <= 0)  
    {
        
    	$sql = "INSERT INTO rn_subscribe(SUBSCRIBER_EMAIL) VALUES('".$_POST['subscriber_email']."')";
        if(mysqli_query($dbcon,$sql))
        {
            $to = $_POST['subscriber_email'];
            $subject = "SUBSCRIPTION NOTIFICATION";
            $txt = "Dear Subscriber!\n\n\n";
            $txt=$txt."Your subsciption request is registered successfully.\n\n\n";
            $txt=$txt."NOTE: If you didnot requested for subscription, please contact to our customer care.\n";
            $headers = "From: webmaster@example.com";
            $res=mail($to,$subject,$txt,$headers);
            if($res==true)
            {
                mysqli_commit($dbcon);
                //echo 'OK-1';
                ?>
                <div class="col-sm-12">
                <?php 
                    echo "<div class='alert alert-success shopAlert'>";
                ?>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                    echo 'Your email registered successfully in our database. Thanks for subscribing with Us.<a href='.$pageURL.' class="submit_button">Continue</a>';
                    echo "</div>";    
            }
            else
            {
                //echo 'OK-2';
                mysqli_rollback($dbcon);

                ?>
                <div class="col-sm-12">
                <?php 
                    echo "<div class='alert alert-danger shopAlert'>";
                ?>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                    echo 'Error registering your email in our database. Please try again later or contact our customer care.<a href='.$pageURL.' class="submit_button">Continue</a>';
                    echo "</div>";    
            }      
        }
        else
        {
            //echo 'OK-3';
            mysqli_rollback($dbcon);
            ?>
            <div class="col-sm-12">
                <?php 
                    echo "<div class='alert alert-danger shopAlert'>";
                ?>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                    echo 'Error registering your email in our database. Please try again later or contact our customer care.<a href='.$pageURL.' class="submit_button">Continue</a>';
                    echo "</div>";

        }
    }
    else
    {
        //echo 'OK-4';
        ?>
        <div class="col-sm-12">
            <?php 
                echo "<div class='alert alert-danger shopAlert'>";
            ?>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php
                echo 'Your email is already registered in our database.<a href='.$pageURL.' class="submit_button">Continue</a>';
                echo "</div>";

    }
    mysqli_close($dbcon);


	//header("Location:$url"); 
?>
<!-- <a href="javascript:history.go(-1);" class="submit_button">Go Back</a> -->
