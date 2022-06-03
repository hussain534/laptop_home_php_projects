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

    if(isset($_GET["id"]))
        $id=$_GET["id"];

    if(isset($_POST["submitted"]) && $_POST["submitted"])
    {
        //$target_file = $target_dir .mt_rand().'.pdf';
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        echo 'FILE NAME:'.basename($_FILES["fileToUpload"]["name"]).'<br>';
        if(basename($_FILES["fileToUpload"]["name"]))
        {
            $uploadOk = 1;
            
            if ($_FILES["fileToUpload"]["size"] > 5000000) 
            {
                $message= "DOCUMNETO MUY GRANDE. DEBE SER MENOS DE 5MB";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) 
            {
               $message="ERROR: ".$message;
            } 
            else 
            {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                {
                    $message="DOCUMENTO GRABADO CORRECTAMENTE1";
                } 
                else 
                {
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
            $err_code = $controller->updateDocument($databasecon,$_POST['id'],$_POST['descripcion'],$target_file,$DEBUG_STATUS);
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
    $userList = $controller->getDocumentById($databasecon,$id,$DEBUG_STATUS);  
        
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
                    <form action="updateDocumentos.php?id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="submitted" value="true">
                        <input type="text" name="id" value="<?=$id;?>">

                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <br>

                        <label for="descripcion">DESCRIPCION</label>
                        <textarea class="form-control" name="descripcion" placeholder="Escribe su mensaje" maxlength="500" rows="4" required><?=$userList[0][2];?></textarea>
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