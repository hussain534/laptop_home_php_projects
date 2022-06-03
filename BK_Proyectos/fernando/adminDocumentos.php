<?php
    defined('__JEXEC') or ('Access denied');
    session_start();

    //PARAMETROS COMUNES PARA PAGINAS EN SESSION
    include_once('config.php'); 
    $DEBUG_STATUS = $PRINT_LOG;
    $session_time = $session_expirry_time;
    $target_dir=$docs_location;
    
    


    //VALIDAR SESSION
    if(!isset($_SESSION["user_name"]) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
    {
        $url='cerrarSesion.php';
        header("Location:$url");
    }
    else
    {
        include_once('util.php');
    }
    $_SESSION['LAST_ACTIVITY'] = time();


    //CARGAR MENU PRINCIPAL
    include_once('menuPanel.php');

    //PARAMETROS DE MENSAJE/ERRORES
    $message='';
    if(isset($_SESSION["message"])) 
    {
        //echo $_SESSION["message"];
        $message=$_SESSION["message"];
        unset($_SESSION["message"]);
    }

    //CARGAR CLASE DE BDD
    require 'dbcontroller.php';
    $controller = new controller();

    if(isset($_POST["submitted"]) && $_POST["submitted"])
    {
        //$target_file = $target_dir .mt_rand().'.pdf';
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        //echo 'FILE NAME:'.basename($_FILES["fileToUpload"]["name"]).'<br>';
        if(basename($_FILES["fileToUpload"]["name"]))
        {
            
            /*$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);*/

            
            $uploadOk = 1;
            
            //$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            

            /*// Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) 
            {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) 
                {
                    $message= "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } 
                else 
                {
                    echo "File is not an image.";
                    $uploadOk = 0;
                    $_SESSION["session_msg"]=$MESSAGE_FILE_IS_NOT_IMG;
                }
            }*/
            // Check if file already exists
            /*if (file_exists($target_file)) 
            {
                echo "Sorry, file already exists.".'<br>';
                if (!unlink($target_file))
                {
                    echo ("Error deleting $target_file").'<br>';
                    $uploadOk = 0;
                }
                else
                {
                    echo ("Deleted $target_file").'<br>';
                }           
            }*/
            // Check file size
            /*if($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "xlsx" ) 
            {
                $message= "SOLO PERMITIDO SUBIR DOCUMENTO TIPO PDF,DOC,DOCX,XLS,XLSX";
                $uploadOk = 0;
                #$_SESSION["session_msg"]="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }*/
            /*echo 'FILE TYPE:'.$_FILES["fileToUpload"]["type"].'<br>';
            if(($_FILES["fileToUpload"]["type"] != "application/pdf") && ($_FILES["fileToUpload"]["type"] != "application/msword")  && ($_FILES["fileToUpload"]["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document"))
            {
                $message= "SOLO PERMITIDO SUBIR DOCUMENTO TIPO PDF,DOC,DOCX,XLS,XLSX";
                $uploadOk = 0;
            }*/

            if ($_FILES["fileToUpload"]["size"] > 5000000) 
            {
                $message= "DOCUMNETO MUY GRANDE. DEBE SER MENOS DE 5MB";
                $uploadOk = 0;
                #$_SESSION["session_msg"]="Sorry, your file is too large.";
            }
            // Allow certain file formats
            
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) 
            {
                #$message= "Sorry, your file was not uploaded.";
                $message="ERROR: ".$message;
                // if everything is ok, try to upload file
            } 
            else 
            {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                {
                    #$message= "The profile image and data has been uploaded.";
                    $message="DOCUMENTO GRABADO CORRECTAMENTE1";
                } 
                else 
                {
                    #$message= "Sorry, there was an error uploading your file.";
                    $message="ERROR EN SUBIR DOCUMENTO:".$target_file;
                    $uploadOk = 0;
                }
            }
        }
        if ($uploadOk == 0) 
        {
              $message="ERROR-. ".$message;
        }
        else
        {

            
            $err_code = $controller->addDocument($databasecon,$_POST['descripcion'],$target_file,$DEBUG_STATUS);
            //echo 'SQL:'.$err_code.'<br>';
            if($err_code==1)
            {
                $message="DOCUMENTO GRABADO CORRECTAMENTE2";
            }
            else if($err_code==3)
            {
                $message='DOCUMENTO '.$target_file.' EXISTE.';
            }
            else
            {
                $message="ERROR EN GRABAR DOCUMENTO";   
            }
        }        
    }
        
?>
<style>
    body
    {
        background-color: #2b3e50;
    }
</style>
<div class="container"  id="home">    
    <?php 
        if(isset($message) && strcmp($message, '')!=0)
        {
    ?>
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="errblock">
                    <?php echo $message;?>
                </div>
            </div>
        </div>
    <?php
        }
    ?>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <!-- TITULO -->
            <div class="row">
                <div class="col-sm-1 text-right">
                    <img src="images/apple-icon-72x72.png" style="width:50px;">
                </div>
                <div class="col-sm-6">
                    <p style="font-size:36px">CREAR DOCUMENTO</p>
                </div>
            </div>     
            <hr>
            <br>

            <!-- BOTONES -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group">
                        <a href="documentos.php"><button type="button" class="btn btn-lg"><span class="glyphicon glyphicon-arrow-left my-glyphicon"></span>ATRAS</button></a>
                    </div>    
                </div>
            </div> 
            <hr>
            <br>
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <form action="adminDocumentos.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="submitted" value="true">

                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <br>

                        <label for="descripcion">DESCRIPCION</label>
                        <textarea class="form-control" name="descripcion" placeholder="Escribe su mensaje" maxlength="500" rows="4" required></textarea>
                        <div class="errmsg" id="error_descripcion"></div>
                        <br>

                        <button type="submit" class="btn btn-small btn_center" onclick="return validateEmail();">GRABAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                        <br>
                    </form>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <br>
            <br>
               
        </div>
    </div>
</div>

<?php
    include_once('footer.php');
?>