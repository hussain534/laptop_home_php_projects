<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    $target_dir=$pics_location;
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
    $costo_uio_aero=$costo_quito_aeropuerto;
    $costo_aero_uio=$costo_aeropuerto_quito;
  	if(isset($_SESSION['LAST_ACTIVITY']))
    {
    	/*if(isset($_SESSION['userid']))
    		echo 'TRUE<br>';
    	else
    		echo 'FALSE<br>';
    	echo $_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'].'<br>';*/
		if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
		{
			//echo 'inside<br>';
			$url="userlogin.php";
			/*if(isset($_GET["idviaje"]))
				$_SESSION["last_url"]=$_SERVER['REQUEST_URI'];*/
			//echo $_SESSION["last_url"];
			header("Location:$url"); 
		}
        else
              $_SESSION['LAST_ACTIVITY'] = time();
	}
	else
		$_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }
    if(isset($_POST['submitted']))
    {
    	$userId = $_SESSION['userid'];
        if($DEBUG_STATUS)
        {
            echo "Inside submitted check<br>";
        }

        if(isset($_POST["idviaje"]))
            $idviaje=$_POST["idviaje"];
        else
            $idviaje=0;
        if(isset($_POST["tipoPago"]))
            $tipoPago=$_POST["tipoPago"];
        else
            $tipoPago=0;
        if(isset($_POST["direccion"]))
            $direccion=$_POST["direccion"];
        else
            $direccion=0;

        if(isset($_POST["cantpass"]))
            $cantpass=$_POST["cantpass"];
        else
            $cantpass=0;

        if(isset($_POST["eligoretorno"]))
            $eligoretorno=$_POST["eligoretorno"];
        else
            $eligoretorno=0;

        if(isset($_POST["costoAsiento"]))
            $costo_uio_aero=$_POST["costoAsiento"];

    }
    include_once('header.php');
    
        $controller = new controller();

        $id = $controller->reservarViaje($databasecon,$idviaje,$target_dir,$tipoPago,$direccion,$cantpass,$_SESSION["userid"],$eligoretorno,$costo_uio_aero,$costo_aero_uio,$DEBUG_STATUS);
        
        if($id>0)
        { 
            $target_file = $target_dir .'PagoPic-'.$id.'-'.$_SESSION["userid"].'.jpg';
            if(basename($_FILES["fileToUpload"]["name"]))
            {
                
                /*$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);*/
                //$target_file = $target_dir .'ProfilePic-'.$userId.'.jpg';
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
                    //$url = "editDetallesPersonales.php";
                } 
                else 
                {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                    {
                        #$messsage= "The profile image and data has been uploaded.";
                        $_SESSION["session_msg"]='Su reserva ha sido guardado exitosamente.';
                    } 
                    else 
                    {
                        #$messsage= "Sorry, there was an error uploading your file.";
                        $_SESSION["session_msg"]=$MESSAGE_ERROR_FILE_UPLOAD;
                        //$url = "editDetallesPersonales.php";
                    }
                }
            }  
?>
<br>

<div class="container inner_body" id="estadoReservarViaje">
    <br>
    <br>
    <?php
        if(isset($_SESSION['userid']))
                include_once('submenu.php');
    ?>
    
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10 inner_body-block">
            <div class="row">
                <div class="col-sm-12">
                    <center><img src="images/icon_success.png"></center>
                    <div class='alert alert-success shopAlert'>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php  echo $_SESSION["session_msg"]; ?>
                     </div>
                </div>
            </div>
        	<div class="row">
                <div class="col-sm-12">
                	<div class='alert alert-info shopAlert'>
                    	<?php  echo 'Gracias por reservar viaje con ZIELUS. Numero de boleto de su viaje es '.$id.'.<br>Ahora recibirás 
                        los datos de tu conductor y el los tuyos a tu correo electrónico. Deben comunicarse para confirmar la hora de viaje 
                        según sea vuestra propia preferencia. <br>Te damos las siguientes recomendaciones para que el viaje sea lo más placentero y provechoso para todos'; ?>
                		<ul>
                			<li><span class="doBold">Puntualidad:</span> Si pasados 10 minutos no has salido al encuentro de tu conductor según fue acordado, el conductor podrá irse y no se te hará devolución de tu dinero. Si se te presenta algún imprevisto, debes notificar con un día de anterioridad para notificar al conductor. Solo en este caso se te devolverá tu dinero o si lo prefieres lo podrás usar para otro viaje a futuro</li>
                			<li>Comparte tus intereses y profesión con el fin de generar contactos según tus intereses en tiempo real. Sácale el mayor provecho a tu viaje, generando contactos de gran valor</li>
                		</ul>    	
        	         </div>
                </div>
            </div>
            <div class="row">
        	 	<div class="col-sm-12">
        	       	<a href="misreservas.php"><button type="button" class="btn btn-success btn_center">MIS RESERVAS <span class="glyphicon glyphicon-chevron-right"></span></button></a>
        	    </div>
        	</div>
        	<?php
        		}
        		else
        		{
        	?>
            <br>
            <br>
            <br>
        	<div class="row">
                <div class="col-sm-12">
                    <center><img src="images/icon_error.png"></center>
                	<div class='alert alert-danger shopAlert'>
                        El sistema presenta error en este momento. Por favor intenta nuevamente.    	
        	         </div>
                </div>
            </div>
            <div class="row">
        	 	<div class="col-sm-12">
        	       	<a href="iniciarviaje.php"><button type="button" class="btn btn-success btn_center">BUSCAR VIAJE <span class="glyphicon glyphicon-chevron-right"></span></button></a>
        	    </div>
        	</div>
            
        	<?php		
        		}
        	?>
            
        </div>
         <div class="col-sm-1">
        </div>
    </div>
    <br>
    <br>
</div>
<?php
include_once('container_footer.php');
?>