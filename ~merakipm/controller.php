<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();
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
            $err = $controller->registerNewTask($databasecon,1,$_POST["projectCode"],$_POST["taskDate"],$_POST["horaInicioTarea"],$_POST["horaFinalTarea"],$_POST["descBreveTarea"],$_POST["descCompTarea"],$DEBUG_STATUS);    
            //echo $err.'<br>';
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
            $err = $controller->updateTask($databasecon,1,$_POST["taskId"],$_POST["projectCode"],$_POST["taskDate"],$_POST["horaInicioTarea"],$_POST["descBreveTarea"],$_POST["descCompTarea"],$DEBUG_STATUS);    
            //echo $err.'<br>';
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
            $tasks = $controller->getTaskDetailBySearchParam($databasecon,1,$_POST["projectCode"],$_POST["taskDateInicial"],$_POST["taskDateFinal"],$_POST["taskOwner"],$DEBUG_STATUS);    
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
                        
