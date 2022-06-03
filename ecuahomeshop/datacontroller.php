<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;
    $clients_location=$clients_location;
    $default_location=$default_location;
    $uploadSize=$uploadSize;
    $databasecon = $databasecon;
    require 'dbcontroller.php';
    $controller = new controller();

    if(isset($_GET["job"]))
    {
        if($_GET["job"]==21)
        {    
            echo 'job:21<br>';
            
            $updStatus = $controller->addEditBusiness($databasecon,$_POST["business_id"],$_POST["business_name"],$_POST["business_category"],$_POST["business_hint"],$_POST["business_address"],$_POST["business_celular"],$_POST["business_tele"],$_POST["business_email"],$_POST["business_latitud"],$_POST["business_longitud"],$_POST["business_desc"],$clients_location,$DEBUG_STATUS);
            $url = 'editBusiness.php?business_id='.$updStatus;
            //if($DEBUG_STATUS)
                echo $updStatus.'<br>';
            if($updStatus==0 && $_POST["business_id"]>0)
            {
                $_SESSION["session_msg"]= "ERROR EN ACTUALIZAR CLIENTE";
            }
            else if($updStatus==0 && $_POST["business_id"]==0)
            {
                $_SESSION["session_msg"]= "ERROR EN CREAR CLIENTE";
            }
            else if($updStatus>0)
            {
                
            
                if(basename($_FILES["fileToUpload"]["name"]))
                {
                    $target_file = $clients_location .$updStatus.'-logo.jpg';
                    $uploadOk = 1;
                    
                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                    
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
                            $_SESSION["session_msg"]="Archivo No es un imagen";
                        }
                    }
               
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
                    {
                        $messsage= "Archivo no es tipo : jpg, png,jpeg,gif";
                        $uploadOk = 0;
                    }
                    if ($_FILES["fileToUpload"]["size"] > $uploadSize) 
                    {
                        $messsage= "Archivo grande. solo permitido hasta ".$uploadSize." bytes";
                        $uploadOk = 0;
                    }
                    if ($uploadOk == 0) 
                    {
                        $_SESSION["session_msg"]="ERROR:".$messsage;
                    } 
                    else 
                    {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                        {
                            $_SESSION["session_msg"]="CLIENTE CREADO CORRECTAMENTE";
                        } 
                        else 
                        {
                            $_SESSION["session_msg"]="ERROR:ERROR EN CARGAR ARCHIVO/IMAGEN";
                        }
                    }
                }
                else
                {
                    $_SESSION["session_msg"]= 'CLIENTE CREADO/ACTUALIZADO CORRECTAMENTE';                    
                }
                if ($uploadOk == 0) 
                {
                      #$_SESSION["session_msg"]=$MESSAGE_ERROR_FILE_UPLOAD;
                }
                else
                {
                    $_SESSION["session_msg"]= 'CLIENTE CREADO CORRECTAMENTE';                    
                }
            }
            echo 'MESSAGE:'.$_SESSION["session_msg"].'<br>';
            header("Location:$url");
        }        
        else
        {
            $_SESSION["session_msg"]='ERROR EN DATA.';    
        }        
    }
    else
    {
        //echo '<h3>[ERROR:addEntidad]:input invalido</h3>';
        $_SESSION["session_msg"]='ERROR EN DATA.';
    }
    
?>
                        