<?php
	//avoid direct access
	defined('__JEXEC') or ('Access denied');
	session_start();
    //include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
	$target_dir=$pics_location;
	$uploadSize=$uploadSize;
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
	if($DEBUG_STATUS)
	{
		echo 'USERID::'.$_SESSION['userid'].'<br>';
		echo 'EMAIL::'.$_SESSION['userEmail'].'<br>';
		//echo 'ROLE::'.$_SESSION['userRole'].'<br>';
	}
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
    $uploadOk=1;
	if(isset($_POST['submitted']))
    {
    	$userId = $_POST['user_id'];
        if($DEBUG_STATUS)
        {
            echo "Inside submitted check<br>";
        }

        if($DEBUG_STATUS)
        {
            /*echo 'ID:'.$_POST['rn_id'].'<br>';
            echo 'Client ID:'.$_POST['rn_client_id'].'<br>';
            echo 'Price:'.$_POST['rn_price'].'<br>';*/
        }
    

        $url = "perfilConductor.php";
        

        /* image upload starts*/
        //echo 'upload file::'.basename($_FILES["fileToUpload"]["tmp_name"]).'<br>';
        //echo 'uploaded file path::'.$_FILES["fileToUpload"]["tmp_name"].'<br>';
        if(basename($_FILES["fileToUpload"]["name"]))
        {
            
            /*$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);*/
            $target_file = $target_dir .'ProfilePic-'.$userId.'.jpg';
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
                    $_SESSION["session_msg"]=$MESSAGE_FILE_IS_NOT_IMG;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) 
            {
                /*echo "Sorry, file already exists.".'<br>';
                if (!unlink($target_file))
                {
                    echo ("Error deleting $target_file").'<br>';
                    $uploadOk = 0;
                }
                else
                {
                    echo ("Deleted $target_file").'<br>';
                }*/                
            }
            // Check file size
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
            {
                $messsage= $MESSAGE_FILES_ALLOWED;
                $uploadOk = 0;
                #$_SESSION["session_msg"]="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
            if ($_FILES["fileToUpload"]["size"] > $uploadSize) 
            {
                $messsage= $MESSAGE_FILE_TOO_LARGE;
                $uploadOk = 0;
                #$_SESSION["session_msg"]="Sorry, your file is too large.";
            }
            // Allow certain file formats
            
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) 
            {
                #$messsage= "Sorry, your file was not uploaded.";
                $_SESSION["session_msg"]=$MESSAGE_ERROR_FILE_UPLOAD.$messsage;
                // if everything is ok, try to upload file
                $url = "editDetallesPersonales.php";
            } 
            else 
            {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                {
                    #$messsage= "The profile image and data has been uploaded.";
                    $_SESSION["session_msg"]=$MESSAGE_PRODUCT_IMG_UPLOAD_OK;
                } 
                else 
                {
                    #$messsage= "Sorry, there was an error uploading your file.";
                    $_SESSION["session_msg"]=$MESSAGE_ERROR_FILE_UPLOAD;
                    $url = "editDetallesPersonales.php";
                }
            }
        }
        if ($uploadOk == 0) 
        {
              #$_SESSION["session_msg"]=$MESSAGE_ERROR_FILE_UPLOAD;
        }
        else
        {

        	$controller = new controller();
        	$username=$_POST['user_name'];
        	$celular=$_POST['user_celular'];
        	$userConventional=$_POST['user_landline'];
        	$userCedula=$_POST['user_cedula'];
        	if(isset($_POST['user_licence']))
    			$userLicence=$_POST['user_licence'];
    		else
    			$userLicence=0;
            
            if(isset($target_file))
                $updStatus = $controller->updateProfileDetails($databasecon,$userId,$username,$celular,$userConventional,$userCedula,$userLicence,$target_file,$DEBUG_STATUS);
            else
                $updStatus = $controller->updateProfileDetails($databasecon,$userId,$username,$celular,$userConventional,$userCedula,$userLicence,null,$DEBUG_STATUS);

        	if($DEBUG_STATUS)
                echo $updStatus.'<br>';
	        if($updStatus==0)
	        {
	            $_SESSION["session_msg"]= $MESSAGE_PRODUCT_UPD_OK;
	        }
	        else
	        {
	        	$_SESSION["session_msg"]= 'ERROR UPDATING USER DETAILS';
	        	$url = "editDetallesPersonales.php";
	        }
        }        
    }
    header("Location:$url");
?>
