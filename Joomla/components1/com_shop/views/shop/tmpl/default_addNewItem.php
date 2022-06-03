<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$user_items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;
	$target_dir = 'media/com_shop/images/clients/'.$_SESSION["clientid"].'/';


    if(!isset($_SESSION["userid"]))
    {   
        if($DEBUG_STATUS)
        {
            echo "Invalid session<br>";    
        }        
        $err_code=1;
        $messsage= "Invalid credentials or you are accessing this page directly. Try with correct login details.<a href='index.php?view=shop&amp;layout=login'><span class='glyphicon glyphicon-log-in'></span> LOGIN</a>";
    }
    else
    {
        $session_time=$session_expirry_time;
        if(isset($_SESSION['LAST_ACTIVITY']))
        {
            if(($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
            {
                $url="index.php?view=shop&layout=userLogout&tipo=2";
                header("Location:$url"); 
            }
            else
                $_SESSION['LAST_ACTIVITY'] = time();
        }
        else
            $_SESSION['LAST_ACTIVITY'] = time();
        //$err_code=0;
        if($DEBUG_STATUS)
        {
            echo 'UserID in Session:'.$_SESSION["userid"].'<br>';
        }
        #$messsage='User ID : '.$_SESSION["userid"];
        //$messsage='User Name : '.$_SESSION['userName'];
    



    	if(isset($_POST['submitted']))
        {
            if($DEBUG_STATUS)
            {
                echo "Inside submitted check<br>";
            }
            /*$userId= $_POST['userId'];
            $userName = $_POST['userName'];
            $userEmail = $_POST['emailId'];
            $userMobile = $_POST['mobile'];*/
            if($DEBUG_STATUS)
            {
                echo 'ID:'.$_POST['rn_id'].'<br>';
                echo 'Client ID:'.$_POST['rn_client_id'].'<br>';
                echo 'Price:'.$_POST['rn_price'].'<br>';
            }
        

            
            $url = "index.php?view=shop&layout=manageItems";


        	$sql = "INSERT INTO RN_ITEMS(RN_CLIENT_ID,RN_ITEM_NAME,RN_ITEM_DESC,RN_RATE,RN_PRICE,RN_IS_APPROVED,
                    RN_ITEM_CATEGORY,RN_SUBCATEGORY,RN_TAGS,RN_OFFER,RN_OFFER_START_DT,RN_OFFER_END_DT,
                    RN_STOCK_QTY,RN_DELIVERY_TIME,
                    RN_CREATED_ON,RN_MODIFIED_ON,
                    RN_CREATED_BY,RN_MODIFIED_BY,RN_ENABLE,RN_LANG_ID) 
                    VALUES(".$_SESSION["clientid"].",'".$_POST['rn_item_name']."','".$_POST['rn_item_desc']."',0,".$_POST['rn_price'].",'N',
                        '".$_POST['rn_item_category']."','".$_POST['rn_subcategory']."','".$_POST['rn_tags']."','".$_POST['rn_offer']."',
                        DATE_FORMAT('".$_POST['rn_offer_start_dt']."','%Y-%m-%d'),DATE_FORMAT('".$_POST['rn_offer_end_dt']."','%Y-%m-%d'),
                        ".$_POST['rn_stock_qty'].",".$_POST['rn_delivery_time'].",
                        now(),now(),
                        '".$_SESSION["userid"]."','".$_SESSION["userid"]."','".$_POST['rn_enable']."',2)";

            //echo $sql;
            if(mysqli_query($dbcon,$sql))
            {
                $sql = "SELECT rn_id FROM RN_ITEMS WHERE rn_item_name='".$_POST['rn_item_name']."'";
                $result = mysqli_query($dbcon,$sql);
                if(mysqli_num_rows($result) > 0)  
                {
                     while($row = mysqli_fetch_assoc($result)) 
                    {
                        $err_code=0; 
                        $rn_id=$row["rn_id"];
                    }
                }
                //echo $rn_id;
                $uploadOk = 1;
                $_SESSION["session_msg"]="New Product details uploaded successfully.";



                /* image upload starts*/
                //echo 'upload file::'.basename($_FILES["fileToUpload"]["tmp_name"]).'<br>';
                //echo 'uploaded file path::'.$_FILES["fileToUpload"]["tmp_name"].'<br>';
                if(basename($_FILES["fileToUpload"]["name"]))
                {
                    
                    /*$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);*/
                    $target_file = $target_dir . $_SESSION["clientid"].'-'.$rn_id.'.jpg';
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
                            $_SESSION["session_msg"]="File is not an image.";
                        }
                    }
                    // Check if file already exists
                    /*if (file_exists($target_file)) 
                    {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }*/
                    // Check file size
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
                    {
                        $messsage= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                        #$_SESSION["session_msg"]="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    }
                    if ($_FILES["fileToUpload"]["size"] > 500000) 
                    {
                        $messsage= "Sorry, your file is too large.";
                        $uploadOk = 0;
                        #$_SESSION["session_msg"]="Sorry, your file is too large.";
                    }
                    // Allow certain file formats
                    
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) 
                    {
                        #$messsage= "Sorry, your file was not uploaded.";
                        $_SESSION["session_msg"]="Sorry, your file was not uploaded.".$messsage;
                        // if everything is ok, try to upload file
                        $url = "index.php?view=shop&layout=addItemsForm";
                    } 
                    else 
                    {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                        {
                            #$messsage= "The profile image and data has been uploaded.";
                            $_SESSION["session_msg"]="The profile image and data has been uploaded successfully.Please update category, sub category and tags";
                        } 
                        else 
                        {
                            #$messsage= "Sorry, there was an error uploading your file.";
                            $_SESSION["session_msg"]="Sorry, there was an error uploading your file.";
                            $url = "index.php?view=shop&layout=addItemsForm";
                        }
                    }
                }
                if ($uploadOk == 0) 
                {
                    $sql = "DELETE FROM RN_ITEMS WHERE RN_ID=".$rn_id;
                    if(mysqli_query($dbcon,$sql))
                    {
                        
                    }    
                }
            }
        }
    }
    

    header("Location:$url"); 
?>