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
            $err = $controller->registerUser($databasecon,1,$_POST["userEmail"],$_POST["userName"],$_POST["userContact"],$_POST["userPwd"],$_POST["userProfile"],$DEBUG_STATUS);    
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
                $url='login.php?err='.$err;
            }
            else if($err==2)
            {
                $url='login.php?err='.$err;
            }
            else
            {
                $url='login.php?err='.$err;
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
            $err = $controller->registerUser($databasecon,1,$_POST["userEmail"],$_POST["userName"],$_POST["userContact"],'password',2,$DEBUG_STATUS);    
            //echo $err.'<br>';
            
            $nextView='users-teacher-admin.php?err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==1 && $_GET["task"]==1)
        {
            $err = $controller->enableDisableTeacher($databasecon,$_GET["id"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            $_SESSION["err_code"]=$err;
            $nextView='users-teacher-admin.php?err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==1 && $_GET["task"]==2)
        {
            $err = $controller->updateTeacher($databasecon,$_POST["userId"],$_POST["userName"],$_POST["userEmail"],$_POST["userContact"],$_POST["userPwd"],$_POST["userStatus"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            //$err=3;
            $_SESSION["err_code"]=$err;
            $nextView='users-teacher-admin-edit.php?id='.$_POST["userId"].'&err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==2 && $_GET["task"]==0)
        {
            $err = $controller->registerUser($databasecon,1,$_POST["userEmail"],$_POST["userName"],$_POST["userContact"],'password',3,$DEBUG_STATUS);    
            //echo $err.'<br>';
            
            $nextView='users-student-admin.php?err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==2 && $_GET["task"]==1)
        {
            $err = $controller->enableDisableStudent($databasecon,$_GET["id"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            $_SESSION["err_code"]=$err;
            $nextView='users-student-admin.php?err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==2 && $_GET["task"]==2)
        {
            $err = $controller->updateStudent($databasecon,$_POST["userId"],$_POST["userName"],$_POST["userEmail"],$_POST["userContact"],$_POST["userPwd"],$_POST["userStatus"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            //$err=3;
            $_SESSION["err_code"]=$err;
            $nextView='users-student-admin-edit.php?id='.$_POST["userId"].'&err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==3 && $_GET["task"]==0)
        {
            $err = $controller->addNewClassRoomCourseDtl($databasecon,$_POST["name"],$_POST["description"],$_POST["start_from"],$_POST["ends_on"],$_POST["capacity"],$_POST["teacher_id"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            if($_SESSION["user_perfil"]==2)
                $nextView='mycourses.php?err='.$err;
            else
                $nextView='courses-classroom-admin.php?err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==3 && $_GET["task"]==1)
        {
            $err = $controller->enableDisableClassRoomCourse($databasecon,$_GET["id"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            $_SESSION["err_code"]=$err;
            $nextView='courses-classroom-admin.php?err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==3 && $_GET["task"]==2)
        {
            $err = $controller->updateClassRoomCourse($databasecon,$_POST["userId"],$_POST["name"],$_POST["description"],$_POST["start_from"],$_POST["ends_on"],$_POST["userStatus"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            //$err=3;
            $_SESSION["err_code"]=$err;
            $nextView='courses-classroom-admin-edit.php?id='.$_POST["userId"].'&err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==4 && $_GET["task"]==0)
        {
            $err = $controller->addNewOnlineCourseDtl($databasecon,$_POST["name"],$_POST["description"],$_POST["start_from"],$_POST["ends_on"],$_POST["capacity"],$_POST["teacher_id"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            
            if($_SESSION["user_perfil"]==2)
                $nextView='mycourses.php?err='.$err;
            else
                $nextView='courses-online-admin.php?err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==4 && $_GET["task"]==1)
        {
            $err = $controller->enableDisableOnlineCourse($databasecon,$_GET["id"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            $_SESSION["err_code"]=$err;
            $nextView='courses-online-admin.php?err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==4 && $_GET["task"]==2)
        {
            $err = $controller->updateOnlineCourse($databasecon,$_POST["userId"],$_POST["name"],$_POST["description"],$_POST["start_from"],$_POST["ends_on"],$_POST["userStatus"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            //$err=3;
            $_SESSION["err_code"]=$err;
            $nextView='courses-online-admin-edit.php?id='.$_POST["userId"].'&err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==5 && $_GET["task"]==0)
        {
            $err = $controller->addNewSelfStudyCourseDtl($databasecon,$_POST["name"],$_POST["description"],$_POST["start_from"],$_POST["ends_on"],$_POST["teacher_id"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            
            if($_SESSION["user_perfil"]==2)
                $nextView='mycourses.php?err='.$err;
            else
                $nextView='courses-selfstudy-admin.php?err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==5 && $_GET["task"]==1)
        {
            $err = $controller->enableDisableSelfStudyCourse($databasecon,$_GET["id"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            $_SESSION["err_code"]=$err;
            $nextView='courses-selfstudy-admin.php?err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==5 && $_GET["task"]==2)
        {
            $err = $controller->updateSelfStudyCourse($databasecon,$_POST["userId"],$_POST["name"],$_POST["description"],$_POST["start_from"],$_POST["ends_on"],$_POST["userStatus"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            //$err=3;
            $_SESSION["err_code"]=$err;
            $nextView='courses-selfstudy-admin-edit.php?id='.$_POST["userId"].'&err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==6 && $_GET["task"]==0)
        {
            $err = $controller->updateUser($databasecon,$_POST["userId"],$_POST["userName"],$_POST["userEmail"],$_POST["userContact"],$_POST["userPwd"],$_POST["userStatus"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            //$err=3;
            $_SESSION["err_code"]=$err;
            $nextView='myprofile.php?id='.$_POST["userId"].'&err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==7 && $_GET["task"]==1)
        {
            $err = $controller->manageEnrollmentCourse($databasecon,$_GET["id"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            $_SESSION["err_code"]=$err;
            $nextView='mycourses.php?err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==8 && $_GET["task"]==1)
        {
            $err = $controller->enrollInCourse($databasecon,$_GET["id"],$DEBUG_STATUS);    
            //echo $err.'<br>';
            $_SESSION["err_code"]=$err;
            $nextView='allcourses.php?err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==99 && $_GET["task"]==1)
        {
            if(isset($_FILES["fileToUpload"]["name"]) && !empty($_FILES["fileToUpload"]["name"]))
            {
                $fileUploadData = $commoncontroller->singleFileUpload("uploads/",$_FILES["fileToUpload"]["name"],$_FILES["fileToUpload"]["tmp_name"],$_FILES["fileToUpload"]["size"],50000000);
                $data=explode(":", $fileUploadData);
            }
            else
            {
                $data[0]=99;
                $data[1]="";
            }

            //print_r($data);
            
            $err = $controller->addContentDtl($databasecon,$_POST["course_id"],$_POST["content-type"],$data[1],$DEBUG_STATUS);    
            
            $_SESSION["err"]=$err;
            $nextView='content-design.php?id='.$_POST["course_id"].'&err='.$err;
            header("Location:$nextView");
        }
        else if($_GET["controller"]==99 && $_GET["task"]==2)
        {
            $err = $controller->addContentDtl($databasecon,$_POST["course_id2"],$_POST["content-type2"],$_POST["fileToUpload2"],$DEBUG_STATUS);    
            
            $_SESSION["err"]=$err;
            $nextView='content-design.php?id='.$_POST["course_id"].'&err='.$err;
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
                        
