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
		echo 'ROLE::'.$_SESSION['userRole'].'<br>';
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
    	$userId = $_SESSION['userid'];
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
            $target_file = $target_dir .'Cedula-'.$userId.'.jpg';
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
                    //echo "File is not an image.";
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
                $url = "editDocumentosConductor.php";
            } 
            else 
            {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                {
                    #$messsage= "The profile image and data has been uploaded.";
                    $_SESSION["session_msg"]="Documentos actualizados exitosamente.";
                    $controller = new controller();
                    $docId=$_POST['docId'];
                    if(isset($target_file))
                        $updStatus = $controller->updateDocument($databasecon,0,$userId,$docId,1,$target_file,$DEBUG_STATUS);
                    if($updStatus==0)
                    {
                        $_SESSION["session_msg"]= "Documentos de usuario actualizados existosamente";
                    }
                    else
                    {
                        $_SESSION["session_msg"]= 'ERROR UPDATING DOCUMENTS';
                        $url = "editDocumentosConductor.php";
                    }
                } 
                else 
                {
                    #$messsage= "Sorry, there was an error uploading your file.";
                    $_SESSION["session_msg"]=$MESSAGE_ERROR_FILE_UPLOAD;
                    $url = "editDocumentosConductor.php";
                }
            }
        } 

        //LICENCIA
        if(basename($_FILES["fileToUpload2"]["name"]))
        {
            
            /*$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);*/
            $target_file = $target_dir .'Licencia-'.$userId.'.jpg';
            $uploadOk = 1;
            
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            

            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) 
            {
                $check = getimagesize($_FILES["fileToUpload2"]["tmp_name"]);
                if($check !== false) 
                {
                    $messsage= "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } 
                else 
                {
                    //echo "File is not an image.";
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
            if ($_FILES["fileToUpload2"]["size"] > $uploadSize) 
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
                $url = "editDocumentosConductor.php";
            } 
            else 
            {
                if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file)) 
                {
                    #$messsage= "The profile image and data has been uploaded.";
                    $_SESSION["session_msg"]="Imagen y detalles de perfil actualizados exitosamente.";
                    $controller = new controller();
                    $docId2=$_POST['docId2'];
                    if(isset($target_file))
                        $updStatus = $controller->updateDocument($databasecon,0,$userId,$docId2,3,$target_file,$DEBUG_STATUS);
                    if($updStatus==0)
                    {
                        $_SESSION["session_msg"]= "Documentos de usuario actualizados existosamente";
                    }
                    else
                    {
                        $_SESSION["session_msg"]= 'ERROR UPDATING DOCUMENTS PASAJERO';
                        $url = "editDocumentosConductor.php";
                    }
                } 
                else 
                {
                    #$messsage= "Sorry, there was an error uploading your file.";
                    $_SESSION["session_msg"]=$MESSAGE_ERROR_FILE_UPLOAD;
                    $url = "editDocumentosConductor.php";
                }
            }
        }      
    }
    //echo $url;
    header("Location:$url");
?>