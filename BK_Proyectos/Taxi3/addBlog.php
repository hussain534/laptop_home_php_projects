<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    //include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    $target_dir=$blogs_location;
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
  	if(isset($_SESSION['LAST_ACTIVITY']))
    {
    	if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
		{
			$url="userlogin.php";
			header("Location:$url"); 
		}
        else
              $_SESSION['LAST_ACTIVITY'] = time();
	}
	else
		$_SESSION['LAST_ACTIVITY'] = time();

    $_SESSION["session_msg"]="ERROR EN CREACION DE BLOG. POR FAVOR INTENTAR NUEVAMENTE.";
    if(basename($_FILES["fileToUpload"]["name"]))
    {
        
        $target_file = $target_dir .'/BlogPic-'.$_SESSION['userid'].'-'.mt_rand().'.jpg';
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
        if(isset($target_file))
        {
            $err_code = $controller->addBlog($databasecon,$_SESSION["userid"],$target_file,$_POST["blog_title"],$_POST["title01"],$_POST["para01"],$_POST["title02"],$_POST["para02"],$_POST["title03"],$_POST["para03"],$_POST["title04"],$_POST["para04"],$_POST["title05"],$_POST["para06"],$_POST["title06"],$_POST["para06"],$_POST["title07"],$_POST["para07"],$_POST["title08"],$_POST["para08"],$_POST["title09"],$_POST["para09"],$_POST["title10"],$_POST["para10"],$DEBUG_STATUS);
            //echo '<br><br><br><br>'.$err_code;
            if(isset($err_code) and $err_code==0)
            {
                $url='blogadmin.php';
                $_SESSION["session_msg"]="SU NUEVO BLOG CREADO CORRECTAMENTE.";
            }
            else
            {
                $url='blog01.php';               
            }    
        }
        else
            $url='blog01.php';                
    }
    header("Location:$url"); 
?>