<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'doUpload.php';
    require 'dbcontroller.php';
    $controller = new controller();
    $commoncontroller = new commoncontroller();
    $adminUserIdConstant=1;
    if(isset($_GET["controller"]))
    {
        if($_GET["controller"]==0 && $_GET["task"]==0)
        {
            $err = $controller->registerUser($databasecon,1,$_POST["userEmail"],$_POST["userName"],$_POST["userPwd"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            
            $nextView='userRegister.php?err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==0 && $_GET["task"]==1)
        {    
            $err = $controller->loginUser($databasecon,$_POST['userEmail'],$_POST['userPwd'],$DEBUG_STATUS);   
            if($err==1)
            {
                $url='home.php?err='.$err;
            }
            else if($err==0)
            {
                $url='index.php?err='.$err;
            }
            else if($err==2)
            {
                $url='index.php?err='.$err;
            }
            else
            {
                $url='index.php?err='.$err;
            }
            header("Location:$url");
        }
        if($_GET["controller"]==0 && $_GET["task"]==2)
        {
            $_SESSION["table_view"]=($_SESSION["table_view"]*(-1))+1;
            $nextView='mostrarTrabajos.php';
            header("Location:$nextView");
        }
        else if($_GET["controller"]==98 && $_GET["task"]==1)
        {    
            $err = $controller->recuperarClave($databasecon,$_POST['user_email'],$DEBUG_STATUS);    
            //echo 'FINAL:'.$err.'<br>';
            if($err==0)
            {
                $_SESSION["message"]="<center>ERROR EN RECUPERAR CLAVE. INTENTA MAS TARDE</center>";                
            }
            else if($err==2)
            {
                $_SESSION["message"]="<center>CLAVE RECUPERADO PERO ERROR EN ENVIAR EMAIL.</center>";
            }
            else if($err==3)
            {
                $_SESSION["message"]='<center>EMAIL- '.$_POST['user_email'].' NO SE ENCUENTRA REGISTRADO EN SISTEMA.INGRESA DATOS CORRECTOS.</center>';
            }
            else
            {
                $_SESSION["message"]="<center>CLAVE RECUPERADO Y ENVIADO A SU CORREO. PORFA REVISAR SU CORREO Y USA LA CLAVE ENVIADO PARA INGRESAR EN SISTEMA</center>";
            }
            $url='recuperarClave.php';
            header("Location:$url");
        }
        else if($_GET["controller"]==98 && $_GET["task"]==2)
        {    
            $err = $controller->cambiarClave($databasecon,$_GET['clave_anterior'],$_GET['clave_nuevo'],$DEBUG_STATUS);    
            echo 'FINAL:'.$err.'<br>';
            if($err==0)
            {
                $_SESSION["message"]="<center>ERROR EN ACTUALIZAR CLAVE. INTENTA MAS TARDE</center>";
            }
            else if($err==2)
            {
                $_SESSION["message"]="<center>ERROR EN ENVIAR EMAIL.CLAVE NO ACTUALIZADO</center>";
            }
            else if($err==3)
            {
                $_SESSION["message"]='<center>CLAVE ANTERIOR INGRESADO NO RELACIONADO CON EMAIL- '.$_SESSION["user_email"].'. INGRESA DATOS CORRECTOS.</center>';
            }
            else
            {
                $_SESSION["message"]="<center>CLAVE ACTUALIZADO Y ENVIADO A SU CORREO. PORFA REVISAR SU CORREO Y USA LA CLAVE ENVIADO PARA INGRESAR EN SISTEMA</center>";
            }
            $url='cambiarClave.php';
            //header("Location:$url");
        }
        else if($_GET["controller"]==1 && $_GET["task"]==0)
        {
            if(isset($_FILES["fileToUpload"]["name"]))
            {
                $fileUploadData = $commoncontroller->singleFileUpload("uploads/",$_FILES["fileToUpload"]["name"],$_FILES["fileToUpload"]["tmp_name"],$_FILES["fileToUpload"]["size"],5000000);
                $data=explode(":", $fileUploadData);    
            }
            else
            {
                $data[0]=99;
                $data[1]='';
            }
            
            //echo 'File Upload result::'.$data[0].'<br>';
            //echo 'File Path::'.$data[1].'<br>';
            $err = $controller->registerNewTask($databasecon,$_POST["projectCode"],$_POST["id_ambiente"],$_POST["aprobacion_Cliente"],$_POST["categorea_tarea"],$_POST["taskDate"],$_POST["horaInicioTarea"],$_POST["horaFinTarea"],$_POST["tiempo_indisponibilidad"],$_POST["descBreveTarea"],$_POST["descCompTarea"],$data[1],$DEBUG_STATUS);    
            $_SESSION["err_code"]=$err;
            $nextView='registerNewWork.php';
            header("Location:$nextView");
        }
        else if($_GET["controller"]==1 && $_GET["task"]==1)
        {
            $err = $controller->deleteTask($databasecon,$_GET["id"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            $_SESSION["err_code"]=$err;
            $nextView='mostrarTrabajos.php';
            header("Location:$nextView");
        }
        else if($_GET["controller"]==1 && $_GET["task"]==2)
        {
            //echo $_FILES["fileToUpload"]["name"];
            if(isset($_FILES["fileToUpload"]["name"]) && !empty($_FILES["fileToUpload"]["name"]))
            {
                $fileUploadData = $commoncontroller->singleFileUpload("uploads/",$_FILES["fileToUpload"]["name"],$_FILES["fileToUpload"]["tmp_name"],$_FILES["fileToUpload"]["size"],5000000);
                $data=explode(":", $fileUploadData);    
            }
            else
            {
                $data[0]=99;
                $data[1]=$_POST["doc_path_prev"];
            }
            //print_r($data);
            $err = $controller->updateTask($databasecon,$_POST["id"],$_POST["taskId"],$_POST["projectCode"],$_POST["id_ambiente"],$_POST["aprobacion_Cliente"],$_POST["categorea_tarea"],$_POST["taskDate"],$_POST["horaInicioTarea"],$_POST["horaFinTarea"],$_POST["tiempo_indisponibilidad"],$_POST["descBreveTarea"],$_POST["descCompTarea"],$data[1],$DEBUG_STATUS);    
            //echo $err.'<br>';
            //$err=3;
            $_SESSION["err_code"]=$err;
            $nextView='mostrarTrabajos.php';
            header("Location:$nextView");
        }
        else if($_GET["controller"]==1 && $_GET["task"]==3)
        {
            $_SESSION["codProyecto"]=$_POST["projectCode"];
            $_SESSION["fechaInicio"]=$_POST["taskDateInicial"];
            $_SESSION["fechaFin"]=$_POST["taskDateFinal"];
            $_SESSION["user"]=$_POST["taskOwner"];
            $tasks = $controller->getTaskDetailBySearchParam($databasecon,1,$_POST["projectCode"],$_POST["id_ambiente"],$_POST["taskDateInicial"],$_POST["taskDateFinal"],$_POST["taskOwner"],$_POST["categorea_tarea"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            $_SESSION["tasks"]=$tasks;
            $nextView='mostrarTrabajos.php';
            header("Location:$nextView");
        }
        else
        {
            $_SESSION["message"]='ERROR EN DATA.';    
        }        
    }
    else
    {
        //echo '<h3>[ERROR:addEntidad]:input invalido</h3>';
        $_SESSION["message"]='ERROR EN DATA.';
    }
    
?>
                        
