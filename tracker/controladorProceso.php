<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;
    require 'controladorDB.php';
    $controladorDB = new controladorDB();
    $adminUserIdConstant=1;
    //CREAR NUEVA CUENTA
    if($_GET["proceso"]==0 && $_GET["task"]==0)
    {
        //OK
        $err = $controladorDB->registerUser($databasecon,$_POST["userNombre"],$_POST["userEmail"],$_POST["userPwd"],$_POST["userTelefono"],$_POST["userCelular"],
            $_POST["userUbicacion"],$_POST["userPerfil"],$_POST["usuarioRed"],$_POST["userParalelo"],$DEBUG_STATUS);    
        $nextView='crearCuenta.php?err='.$err;
        header("Location:$nextView");
    }
    //INICIAR SESSION
    else if($_GET["proceso"]==0 && $_GET["task"]==1)
    {    
        //OK
        $err = $controladorDB->loginUser($databasecon,$_POST['userEmail'],$_POST['userPwd'],$DEBUG_STATUS);   
        if($err==1)
        {
            $url='dashboard.php?err='.$err;
        }
        else if($err==0)
        {
            $url='index.php?err='.$err;
        }
        else
        {
            $url='index.php?err='.$err;
        }
        header("Location:$url");
    }
    //RECUPERAR CLAVE
    else if($_GET["proceso"]==0 && $_GET["task"]==2)
    {    
        $err = $controladorDB->recuperarClave($databasecon,$_POST['user_email'],$DEBUG_STATUS);    
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
    //CAMBIAR CLAVE
    else if($_GET["proceso"]==0 && $_GET["task"]==3)
    {    
        $err = $controladorDB->cambiarClave($databasecon,$_POST['clave_anterior'],$_POST['clave_nuevo'],$DEBUG_STATUS);    
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR CLAVE. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>CLAVE ACTUALIZADO</center>";
        }        
        else if($err==3)
        {
            $_SESSION["message"]="<center>CLAVE ANTERIOR NO COINCIDE. INTENTA CON DATOS CORRECTOS</center>";
        }
        $url='cambiarClave.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==0 && $_GET["task"]==4)
    {   
        $err = $controladorDB->deshabilitarUser($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN DESHABILITAR USUARIO. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>USUARIO DESHABILITADO</center>";
        }
        $url='crearCuenta.php';
        header("Location:$url");
    }
    //MODIFICAR CUENTA
    else if($_GET["proceso"]==0 && $_GET["task"]==5)
    {    
        $err = $controladorDB->modificarCuenta($databasecon,$_POST['userNombre'],$_POST['userEmail'],$_POST['userTelefono'],$_POST['userCelular'],$_POST['userUbicacion'],$_POST['userId'],$DEBUG_STATUS);    
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN MODIFICAR CUENTA. INTENTA MAS TARDE</center>";                
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>CUENTA MODIFICADO</center>";
        }
        $url='editCuenta.php?uid='.$_POST['userId'];
        header("Location:$url");
    }
    //LIPIAR CACHE EN APLICACION
    else if($_GET["proceso"]==0 && $_GET["task"]==999)
    {
        unset($_SESSION["message"]);
        unset($_SESSION["PERMISOS_IDPERFIL"]);
        unset($_SESSION["PERMISOS_IDMENU"]);
        unset($_SESSION["ID_SECCION"]);
        unset($_SESSION["ID_PREGUNTA"]);
        unset($_SESSION["ID_COMPONENTE"]);
        unset($_SESSION["ID_TIPOPAR"]);
        unset($_SESSION["ID_EVALUADO"]);
        unset($_SESSION["ID_EVALUADOR"]);
        unset($_SESSION["ID_DESC_ANO_EVAL"]);
        unset($_SESSION["ID_TIPOEVALUACION"]);
        unset($_SESSION["ID_SATISFACCION_NIVEL"]);

        $url=$_SERVER[HTTP_REFERER];
        header("Location:$url");
    }
    //ACTUALIZAR MENU
    else if($_GET["proceso"]==4 && $_GET["task"]==0)
    {   
        $err = $controladorDB->actualizarMenuData($databasecon,$_POST["id"],$_POST["id_menu"],$_POST["nombre"],$_POST["url"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR MENU. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>MENU DATA ACTUALIZADO</center>";
        }
        $url='menu.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==4 && $_GET["task"]==1)
    {   
        $err = $controladorDB->deshabilitarMenuData($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR MENU. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>MENU DATA ELIMINADO</center>";
        }
        $url='menu.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==5 && $_GET["task"]==0)
    {   
        $err = $controladorDB->actualizarPerfilData($databasecon,$_POST["id"],$_POST["nombre"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR PERFIL. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>PERFIL DATA ACTUALIZADO</center>";
        }
        $url='perfil.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==5 && $_GET["task"]==1)
    {   
        $err = $controladorDB->deshabilitarPerfilData($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR PERFIL. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>PERFIL DATA ELIMINADO</center>";
        }
        $url='perfil.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==6 && $_GET["task"]==0)
    {   
        $err = $controladorDB->actualizarPerfilPermisos($databasecon,$_POST["id"],$_POST["idPerfil"],$_POST["idMenu"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR PERMISOS. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>PERMISOS DATA ACTUALIZADO</center>";
        }
        $url='permisos.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==6 && $_GET["task"]==1)
    {   
        $err = $controladorDB->deshabilitarPerfilPermisos($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR PERMISOS. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>PERMISOS DATA ELIMINADO</center>";
        }
        $url='permisos.php';
        header("Location:$url");
    }  
    else if($_GET["proceso"]==6 && $_GET["task"]==3)
    {   
        $_SESSION["PERMISOS_IDPERFIL"]=$_GET["idPerfil"];
        $_SESSION["PERMISOS_IDMENU"]=$_GET["idMenu"];
    }
    /*---------------------------------NEW----------------------------*/
    else if($_GET["proceso"]==7 && $_GET["task"]==0)
    {   
        $err = $controladorDB->actualizarData($databasecon,$_POST["id"],$_POST["nombre"],$_POST["dbTable"],$DEBUG_STATUS);
        
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA -  (SECCION-DUPLICADO)</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA ACTUALIZADO</center>";
        }
        $url=$_POST["dbTable"].'.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==7 && $_GET["task"]==1)
    {   
        $err = $controladorDB->deshabilitarData($databasecon,$_GET["id"],$_GET["tid"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA ELIMINADO</center>";
        }
        $url=$_GET["tid"].'.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==7 && $_GET["task"]==2)
    {   
        $err = $controladorDB->actualizarPreguntasData($databasecon,$_POST["id"],$_POST["nombre"],$_POST["seccion"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA ACTUALIZADO</center>";
        }
        $url=$_POST["dbTable"].'.php';
        header("Location:$url");
    }      
    else if($_GET["proceso"]==7 && $_GET["task"]==3)
    {   
        $_SESSION["ID_SECCION"]=$_GET["idSec"];
    }
    else if($_GET["proceso"]==7 && $_GET["task"]==4)
    {   
        $err = $controladorDB->actualizarPreguntasDataConUsoDeTipoEvaluacionySeccion($databasecon,$_POST["id"],$_POST["idTipoEvaluacion"],$_POST["idSeccion"],preg_replace('/\s+/', ' ',$_POST["nombre"]),$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN INGRESAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA INGRESADO / ACTUALIZADO</center>";
        }
        else if($err==2)
        {
            $_SESSION["message"]="<center>ERROR EN INGRESAR DATA. EXISTE MISMO PREGUNTA EN BASE CON MISMO TIPO EVALUACION Y SECCION SELECIONADA</center>";
        }
        if($_POST["id"]==0)
            $url='preguntas.php';
        else
            $url="preguntas.php?pid=".$_POST["id"]."&pregunta=".$_POST["nombre"];
        header("Location:$url");
    }
    else if($_GET["proceso"]==7 && $_GET["task"]==5)
    {   
        $err = $controladorDB->deshabilitarPreguntasDataConUsoDeTipoEvaluacionySeccion($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA ELIMINADO</center>";
        }
        else if($err==2)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR DATA. EXISTE MISMO PREGUNTA EN EVALUACION ACTIVO</center>";
        }
        $url='preguntas.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==8 && $_GET["task"]==0)
    {   
        $err = $controladorDB->actualizarDataTipoEvaluacion($databasecon,$_POST["id"],$_POST["nombre"],$_POST["peso"],$_POST["idEvalr"],$_POST["idEvalo"],$_POST["dbTable"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA ACTUALIZADO</center>";
        }
        $url=$_POST["dbTable"].'.php';
        header("Location:$url");
    }
    /*else if($_GET["proceso"]==8 && $_GET["task"]==1)
    {   
        $err = $controladorDB->deshabilitarData($databasecon,$_GET["id"],$_GET["tid"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA ELIMINADO</center>";
        }
        $url=$_GET["tid"].'.php';
        header("Location:$url");
    } */ 
    else if($_GET["proceso"]==9 && $_GET["task"]==0)
    {
        /*if(isset($_POST["idPlanEvaluacion"]))
            $idPlanEvaluacion=$_POST["idPlanEvaluacion"];*/
        /*$err = $controladorDB->actualizarDataDatos($databasecon,$_POST["idPreg"],$_POST["idSec"],$_POST["idTiEv"],$_POST["idEvalo"],$_POST["idEvalr"],$_POST["idPlanEvaluacion"],$_POST["dbTable"],$DEBUG_STATUS);*/
        $err = $controladorDB->actualizarDataDatos($databasecon,$_POST["preg"],$_POST["idSec"],$_POST["idTiEv"],$_POST["idEvalo"],$_POST["idEvalr"],$_POST["idPlanEvaluacion"],$_POST["dbTable"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA ACTUALIZADO</center>";
        }
        else if($err==2)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA. EXISTE MISMO PREGUNTA</center>";
        }        
        else if($err==3)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA POR DUPLICACION. PLAN_EVALUACION - PREGUNTA - TIPOEVALUACION - SECCION</center>";
        }

        if(isset($_POST["idPlanEvaluacion"]))
            $url=$_POST["dbTable"].'.php?pid='.$_POST["idPlanEvaluacion"];
        else
            $url=$_POST["dbTable"].'.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==9 && $_GET["task"]==1)
    {   
        $err = $controladorDB->deshabilitarData($databasecon,$_GET["id"],$_GET["tid"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $err = $controladorDB->deshabilitarDatosDtl($databasecon,$_GET["id"],'datos_dtl',$DEBUG_STATUS);
            if($err==0)
            {
                $_SESSION["message"]="<center>ERROR EN ELIMINAR DETALLES DE DATA. INTENTA MAS TARDE</center>";
            }
            else if($err==1)
            {
                $_SESSION["message"]="<center>DATA ELIMINADO</center>";
            }
        }
       if(isset($_GET["pid"]))
            $url=$_GET["tid"].'.php?pid='.$_GET["pid"];
        else
            $url=$_GET["tid"].'.php';
        header("Location:$url");
    }
    /*else if($_GET["proceso"]==9 && $_GET["task"]==2)
    {
        $err = $controladorDB->asignarEvaluadoresParaEvaluacion($databasecon,$_GET["idEval"],$_GET["idTipoEval"],$_GET["idSec"],$_GET["idEvalo"],$_GET["idEvalr"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA ACTUALIZADO</center>";
        }

        // $url='asignarEvaluadoresInDatosDtl.php?pid='.$_GET["idEval"];
        // header("Location:$url");
    }*/
    else if($_GET["proceso"]==9 && $_GET["task"]==2)
    {
        $err = $controladorDB->asignarEvaluadoresParaEvaluacion($databasecon,$_GET["idEval"],$_GET["idTipoEval"],$_GET["idEvalo"],$_GET["idEvalr"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA ACTUALIZADO</center>";
        }

        // $url='asignarEvaluadoresInDatosDtl.php?pid='.$_GET["idEval"];
        // header("Location:$url");
    }
    else if($_GET["proceso"]==9 && $_GET["task"]==3)
    {   
        $_SESSION["ID_PREGUNTA"]=$_GET["idPreg"];
        $_SESSION["ID_COMPONENTE"]=$_GET["idComp"];
        $_SESSION["ID_TIPOPAR"]=$_GET["idTiPa"];
        $_SESSION["ID_TIPOEVALUACION"]=$_GET["idTiEv"];
        $_SESSION["ID_SECCION"]=$_GET["idSec"];
        $_SESSION["ID_EVALUADO"]=$_GET["idEvalo"];
        $_SESSION["ID_EVALUADOR"]=$_GET["idEvalr"];
    }
    /*else if($_GET["proceso"]==9 && $_GET["task"]==4)
    {
        $err = $controladorDB->liberarEvaluadoresParaEvaluacion($databasecon,$_GET["idEval"],$_GET["idTipoEval"],$_GET["idSec"],$_GET["idEvalo"],$_GET["idEvalr"],$DEBUG_STATUS);

        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA ACTUALIZADO</center>";
        }

        // $url='asignarEvaluadoresInDatosDtl.php?pid='.$_GET["idEval"];
        // header("Location:$url");
    }*/
    else if($_GET["proceso"]==9 && $_GET["task"]==4)
    {
        $err = $controladorDB->liberarEvaluadoresParaEvaluacion($databasecon,$_GET["idEval"],$_GET["idTipoEval"],$_GET["idEvalo"],$_GET["idEvalr"],$DEBUG_STATUS);

        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA ACTUALIZADO</center>";
        }

        // $url='asignarEvaluadoresInDatosDtl.php?pid='.$_GET["idEval"];
        // header("Location:$url");
    }
    else if($_GET["proceso"]==9 && $_GET["task"]==5)
    {
        $err = $controladorDB->deshabilitarPreguntasSinEvaluadores($databasecon,$_GET["pid"],$DEBUG_STATUS);

        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN DESHABILTAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA DESHABILITADO</center>";
        }

        $url='asignarEvaluadoresInDatosDtl.php?pid='.$_GET["pid"];
        header("Location:$url");
    }
    else if($_GET["proceso"]==10 && $_GET["task"]==0)
    {   
        $err = $controladorDB->actualizarDataPlanEvaluacion($databasecon,$_POST["id"],$_POST["nombre"],$_POST["ano"],$_POST["dbTable"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA ACTUALIZADO</center>";
        }
        else if($err==2)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA. EXISTE OTRO EVALUACION CON MISMO DESCRIPCION</center>";
        }
        $url=$_POST["dbTable"].'.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==10 && $_GET["task"]==1)
    {   
        $err = $controladorDB->iniciarDataPlanEvaluacion($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN INICIAR EVALUACION. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>EVALUACION INICIADA</center>";
        }
        else if($err==2)
        {
            $_SESSION["message"]="<center>ERROR EN INICIAR EVALUACION. EXISTE OTRO EVALUACION ACTIVO Y DEBES FINALIZAR/DESHABILITAR PARA ACTIVAR NUEVA EVALUACION</center>";
        }
        $url='planevaluacion.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==10 && $_GET["task"]==2)
    {   
        $err = $controladorDB->finalizarDataPlanEvaluacion($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN FINALIZAR EVALUACION. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>EVALUACION FINALIZADA</center>";
        }
        $url='planevaluacion.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==10 && $_GET["task"]==3)
    {   
        $err = $controladorDB->deshabilitarDataPlanEvaluacion($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN DESHABILITAR EVALUACION. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>EVALUACION DESHABILITADA</center>";
        }
        $url='planevaluacion.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==11 && $_GET["task"]==0)
    {   
        $err = $controladorDB->actualizarDataResEvaluacion($databasecon,$_POST["id"],$_POST["nombre"],$_POST["nivel"],$_POST["dbTable"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA ACTUALIZADO</center>";
        }
        $url=$_POST["dbTable"].'.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==11 && $_GET["task"]==3)
    {   
        $_SESSION["ID_DESC_ANO_EVAL"]=$_GET["idDescAno"];
    }
    else if($_GET["proceso"]==12 && $_GET["task"]==0)
    {   
        $err = $controladorDB->actualizarDataResEvaluacion($databasecon,$_POST["id"],$_POST["nombre"],$_POST["nivel"],$_POST["dbTable"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA ACTUALIZADO</center>";
        }
        $url=$_POST["dbTable"].'.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==12 && $_GET["task"]==3)
    {   
        //$_SESSION["ID_SATISFACCION_NIVEL"]=$_GET["idrespuestaevaluacion"];
        $err = $controladorDB->actualizarPreguntasDeEvaluacion($databasecon,$_POST["respuestas"],'datos_dtl',$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA ACTUALIZADO</center>";
        }
        else
        {
            $_SESSION["message"]="<center>ERROR</center>";
        }
        $url='evaluar.php?pid='.$_GET["pid"]."&uid=".$_GET["uid"];
        header("Location:$url");
    }
    else if($_GET["proceso"]==13 && $_GET["task"]==0)
    {   
        $err = $controladorDB->actualizarParaleloData($databasecon,$_POST["id"],$_POST["nombre"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR PARALELO (PARALELO-DUPLICADO)</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>PARALELO DATA ACTUALIZADO</center>";
        }
        $url='paralelo.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==13 && $_GET["task"]==1)
    {   
        $err = $controladorDB->deshabilitarParaleloData($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR PARALELO. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>PARALELO DATA ELIMINADO</center>";
        }
        else if($err==2)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR PARALELO. EXISTEN ESTUDIANTES ACTIVOS ASIGNADO A PARALELO QUE QUIERES ELIMINAR.</center>";
        }
        $url='paralelo.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==14 && $_GET["task"]==0)
    {   
        $err = $controladorDB->actualizarDataTipoEvaluacionYSeccion($databasecon,$_POST["idTiEv"],$_POST["idSec"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR MAPPING (TIPO EVALUACION-SECCION)</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>MAPPING (TIPO EVALUACION-SECCION) ACTUALIZADO</center>";
        }
        $url='mappingTipoEvaluacionSecion.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==14 && $_GET["task"]==1)
    {   
        $err = $controladorDB->deshabilitarDataTipoEvaluacionYSeccion($databasecon,$_GET["id"],$_GET["tid"],$_GET["sid"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR MAPPING (TIPO EVALUACION-SECCION). INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>MAPPING (TIPO EVALUACION-SECCION) DATA ELIMINADO</center>";
        }
        else if($err==2)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR MAPPING. EXISTEN MAPPING (TIPO EVALUACION-SECCION) ACTIVOS EN EVALUACION.</center>";
        }
        $url='mappingTipoEvaluacionSecion.php';
        header("Location:$url");
    }

    else if($_GET["proceso"]==14 && $_GET["task"]==2)
    {   
        $_SESSION["ID_TIPOEVALUACION"]=$_GET["tid"];
        $_SESSION["ID_SECCION"]=$_GET["sid"];
        $url='preguntas.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==14 && $_GET["task"]==3)
    {   
        $_SESSION["ID_TIPOEVALUACION"]=$_GET["idTiEv"];
        $_SESSION["ID_SECCION"]=$_GET["idSec"];
    }
    else if($_GET["proceso"]==15 && $_GET["task"]==0)
    {   
        //$err = $controladorDB->actualizarData($databasecon,$_POST["id"],$_POST["nombre"],$_POST["dbTable"],$DEBUG_STATUS);
        $err = $controladorDB->actualizarDataSeccion($databasecon,$_POST["id"],$_POST["nombre"],$_POST["dbTable"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ACTUALIZAR DATA -  (SECCION-DUPLICADO)</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>DATA ACTUALIZADO</center>";
        }
        $url=$_POST["dbTable"].'.php';
        header("Location:$url");
    }
    else if($_GET["proceso"]==15 && $_GET["task"]==1)
    {   
        $err = $controladorDB->deshabilitarSeccionData($databasecon,$_GET["id"],$DEBUG_STATUS);
        if($err==0)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR SECCION. INTENTA MAS TARDE</center>";
        }
        else if($err==1)
        {
            $_SESSION["message"]="<center>SECCION DATA ELIMINADO</center>";
        }
        else if($err==2)
        {
            $_SESSION["message"]="<center>ERROR EN ELIMINAR SECCION. EXISTE MISMO SECCION EN EVALUACION ACTIVO.</center>";
        }
        $url='seccion.php';
        header("Location:$url");
    }
    else
    {
        $_SESSION["message"]='ERROR EN DATA.';
    }
?>