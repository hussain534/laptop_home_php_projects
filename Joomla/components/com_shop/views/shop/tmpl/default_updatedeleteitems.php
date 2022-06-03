<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$user_items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;
	$target_dir = 'media/com_shop/images/clients/'.$_SESSION["clientid"].'/';
	if(isset($_POST['submitted']))
    {
        if($DEBUG_STATUS)
        {
            echo "Inside submitted check<br>";
            echo 'ID:'.$_POST['rn_id'].'<br>';
            echo 'Client ID:'.$_POST['rn_client_id'].'<br>';
            echo 'Price:'.$_POST['rn_price'].'<br>';
            echo 'Offer:'.$_POST['rn_offer'].'<br>';
		    echo 'Offer start dt:'.$_POST['rn_offer_start_dt'].'<br>';
		    echo 'Offer end dt:'.$_POST['rn_offer_end_dt'].'<br>';
        }
    }
    #echo $_GET['itemaction'];
    
    if(isset($_GET['itemaction']) and $_GET['itemaction']==2)
    {
        echo 'DELETE'.$_GET['rnid'];
        $sql = "UPDATE RN_ITEMS SET RN_ENABLE='N' WHERE rn_id=".$_GET['rnid'];        
    }
    else
    {
        echo 'UPDATE';
        $sql = "UPDATE rn_items SET rn_item_name='".$_POST['rn_item_name']."',rn_item_desc='".$_POST['rn_item_desc']."',
            rn_price=".$_POST['rn_price'].",rn_enable='".$_POST['rn_enable']."',
            rn_stock_qty=".$_POST['rn_stock_qty'].",rn_delivery_time=".$_POST['rn_delivery_time'].",
            rn_modified_on=now(), rn_modified_by='".$_SESSION['userid']."', rn_offer='".$_POST['rn_offer']."',rn_item_category='".$_POST['rn_item_category']."',rn_subcategory='".$_POST['rn_subcategory']."',rn_tags='".$_POST['rn_tags']."',
            rn_offer_start_dt=DATE_FORMAT('".$_POST['rn_offer_start_dt']."','%Y-%m-%d'),rn_offer_end_dt=DATE_FORMAT('".$_POST['rn_offer_end_dt']."','%Y-%m-%d') where rn_id=".$_POST['rn_id'];
    }

    /* image upload starts*/
    #echo 'upload file::'.basename($_FILES["fileToUpload"]["name"]).'<br>';
    if(basename($_FILES["fileToUpload"]["name"]))
    {
        
        /*$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);*/
        $target_file = $target_dir . $_SESSION["clientid"].'-'.$_POST['rn_id'].'.jpg';
        $uploadOk = 1;
        
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) 
        {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) 
            {
                $messsage= "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } 
            else 
            {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        /*if (file_exists($target_file)) 
        {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }*/
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) 
        {
            $messsage= "Sorry, your file is too large.";
            $_SESSION["session_msg"]= "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
        {
            $messsage= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $_SESSION["session_msg"]= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) 
        {
            $messsage= "Sorry, your file was not uploaded.";
            $_SESSION["session_msg"]= "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } 
        else 
        {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
            {
                $messsage= "The profile image and data has been uploaded.";
                $_SESSION["session_msg"]= "The profile image and data has been uploaded successfully.";
            } 
            else 
            {
                $messsage= "Sorry, there was an error uploading your file.";
                $_SESSION["session_msg"]= "Sorry, there was an error uploading your file.";
            }
        }
    }
    
    /* image upload end*/
	echo $sql.'<br>';
    if(mysqli_query($dbcon,$sql))
    {
    	$_SESSION["session_msg"]= "The data has been updated successfully.";
    }
    $url = "index.php?view=shop&layout=manageitems&pagecount=".$_GET["pno"];

    header("Location:$url"); 
?>