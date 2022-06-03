<?php
    defined('__JEXEC') or ('Access denied');
    //session_start();
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
            $_SESSION['ERR']=$err;
            $nextView='index.php';
            header("Location:$nextView");
        }
        else if($_GET["controller"]==0 && $_GET["task"]==1)
        {    
            $err = $controller->loginUser($databasecon,$_POST['userEmail'],$_POST['userPwd'],$DEBUG_STATUS);   
            $_SESSION['ERR']=$err;
            if($err==0)
            {                
                $_SESSION["ERR"]='<center>BIENVENIDO  '.$_SESSION['user_name'].'.</center>';
                $url='portal-index.php';
            }
            else
            {
                if($err==9999)
                {
                    $_SESSION["ERR"]='<center>EMAIL- '.$_POST['userEmail'].' NO SE ENCUENTRA REGISTRADO EN SISTEMA.INGRESA CON DATOS CORRECTOS.</center>';                
                }
                else if($err==2)
                {
                    $_SESSION["ERR"]='<center>CLAVE INCORRECTO.INGRESA CON DATOS CORRECTOS.</center>';                
                }
                $url='index.php';
            }
            header("Location:$url");
        }
        else if($_GET["controller"]==0 && $_GET["task"]==2)
        {    
            $err = $controller->recuperarClave($databasecon,$_POST['userEmail'],$DEBUG_STATUS);    
            //echo 'FINAL:'.$err.'<br>';
            if($err==0)
            {
                $_SESSION["ERR"]="<center>ERROR EN RECUPERAR CLAVE. INTENTA MAS TARDE</center>";                
            }
            else if($err==2)
            {
                $_SESSION["ERR"]="<center>CLAVE RECUPERADO PERO ERROR EN ENVIAR EMAIL.</center>";
            }
            else if($err==3)
            {
                $_SESSION["ERR"]='<center>EMAIL- '.$_POST['userEmail'].' NO SE ENCUENTRA REGISTRADO EN SISTEMA.INGRESA CON DATOS CORRECTOS.</center>';
            }
            else
            {
                $_SESSION["ERR"]="<center>CLAVE RECUPERADO Y ENVIADO A SU CORREO. PORFA REVISAR SU CORREO Y USA LA CLAVE ENVIADO PARA INGRESAR EN SISTEMA</center>";
            }
            $url='index.php';
            header("Location:$url");
        }
        else if($_GET["controller"]==0 && $_GET["task"]==3)
        {    
            $err = $controller->cambiarClave($databasecon,$_POST['clave_anterior'],$_POST['clave_nuevo'],$DEBUG_STATUS);    
            //echo 'FINAL:'.$err.'<br>';
            if($err==0)
            {
                $_SESSION["ERR1"]="ERR:ERROR EN ACTUALIZAR CLAVE. INTENTA MAS TARDE";
            }
            else if($err==2)
            {
                $_SESSION["ERR1"]="ERR:ERROR EN ENVIAR EMAIL.CLAVE NO ACTUALIZADO";
            }
            else if($err==3)
            {
                $_SESSION["ERR1"]='ERR:CLAVE ACTUAL NO RELACIONADO CON EMAIL- '.$_SESSION["user_email"].'. INGRESA CON DATOS CORRECTOS.';
            }
            else
            {
                $_SESSION["ERR1"]="OK:CLAVE ACTUALIZADO. PROXIMA VEZ USA ESE CLAVE PARA INGRESAR EN SISTEMA";
            }
            if($_SESSION["user_role"]==1)
                $url='admin-clave-super-admin.php';
            else
                $url='admin-clave.php';
            header("Location:$url");
        }
        else if($_GET["controller"]==1 && $_GET["task"]==0)
        {    
            $err = $controller->gestionCliente($databasecon,1,$_POST['client_name'],$_POST['client_ruc'],$_POST['client_address'],$_POST['client_phone'],$_POST['client_email'],$DEBUG_STATUS); 
            if($err==0)
            {
                $_SESSION["ERR1"]="ERR:ERROR EN ACTUALIZAR / CREAR CLIENTE. INTENTA MAS TARDE";
            }
            else if($err==2)
            {
                $_SESSION["ERR1"]="OK:DATOS DE CLIENTE ACTUALIZADO CORRECTAMENTE";
            }
            else if($err==1)
            {
                $_SESSION["ERR1"]='OK:DATOS DE CLIENTE REGISTRADO CORRECTAMENTE.';
            }
            else
            {
                $_SESSION["ERR1"]="ERR:ERROR OCURIDO. INTENTA MAS TARDE";
            }
            if($_SESSION["user_role"]==1)
                $url='gestion-cliente.php';
            else
                $url='admin-cliente.php';
            header("Location:$url");
        }
        else if($_GET["controller"]==1 && $_GET["task"]==1)
        {    
            $err = $controller->deleteCliente($databasecon,$_GET['id_cliente'],$DEBUG_STATUS); 
            if($err==0)
            {
                $_SESSION["ERR1"]="ERR:ERROR EN DESHABILITAR CLIENTE. INTENTA MAS TARDE";
            }
            else if($err==1)
            {
                $_SESSION["ERR1"]='OK:CLIENTE DESHABILITADO CORRECTAMENTE.';
            }
            else
            {
                $_SESSION["ERR1"]="ERR:ERROR OCURIDO. INTENTA MAS TARDE";
            }
            /*if($_SESSION["user_role"]==1)
                $url='gestion-cliente.php';
            else
                $url='admin-cliente.php';
            header("Location:$url");*/
        }
        else if($_GET["controller"]==2 && $_GET["task"]==0)
        {    
            $err = $controller->gestionDistributor($databasecon,2,$_POST['client_doc_type'],$_POST['client_name'],$_POST['client_ruc'],$_POST['client_address'],$_POST['client_phone'],$_POST['client_email'],$DEBUG_STATUS); 
            if($err==0)
            {
                $_SESSION["ERR1"]="ERR:ERROR EN ACTUALIZAR / CREAR DISTRIBUIDOR. INTENTA MAS TARDE";
            }
            else if($err==2)
            {
                $_SESSION["ERR1"]="OK:DATOS DE DISTRIBUIDOR ACTUALIZADO CORRECTAMENTE";
            }
            else if($err==1)
            {
                $_SESSION["ERR1"]='OK:DATOS DE DISTRIBUIDOR REGISTRADO CORRECTAMENTE.';
            }
            else
            {
                $_SESSION["ERR1"]="ERR:ERROR OCURIDO. INTENTA MAS TARDE";
            }
            //echo $err;
            $url='admin-distribuidor.php';
            header("Location:$url");
        }
        else if($_GET["controller"]==2 && $_GET["task"]==1)
        {    
            $err = $controller->deleteDistributor($databasecon,$_GET['id_cliente'],$DEBUG_STATUS); 
            if($err==0)
            {
                $_SESSION["ERR1"]="ERR:ERROR EN DESHABILITAR DISTRIBUIDOR. INTENTA MAS TARDE";
            }
            else if($err==1)
            {
                $_SESSION["ERR1"]='OK:DISTRIBUIDOR DESHABILITADO CORRECTAMENTE.';
            }
            else
            {
                $_SESSION["ERR1"]="ERR:ERROR OCURIDO. INTENTA MAS TARDE";
            }
            /*if($_SESSION["user_role"]==1)
                $url='gestion-cliente.php';
            else
                $url='admin-cliente.php';
            header("Location:$url");*/
        }
        else if($_GET["controller"]==3 && $_GET["task"]==0)
        {    
            $err = $controller->gestionBranch($databasecon,$_POST['branch_id'],$_POST['branch_name'],$_POST['branch_address'],$_POST['branch_telephone'],$_POST['branch_email'],$_POST['branch_emision_code'],$_POST['branch_bill_start_num'],$_POST['branch_bill_end_num'],$DEBUG_STATUS); 
            if($err==0)
            {
                $_SESSION["ERR1"]="ERR:ERROR EN ACTUALIZAR / CREAR DISTRIBUIDOR. INTENTA MAS TARDE";
            }
            else if($err==2)
            {
                $_SESSION["ERR1"]="OK:DATOS DE DISTRIBUIDOR ACTUALIZADO CORRECTAMENTE";
            }
            else if($err==1)
            {
                $_SESSION["ERR1"]='OK:DATOS DE DISTRIBUIDOR REGISTRADO CORRECTAMENTE.';
            }
            else
            {
                $_SESSION["ERR1"]="ERR:ERROR OCURIDO. INTENTA MAS TARDE";
            }
            //echo $err;
            $url='admin-punto.php';
            header("Location:$url");
        }
        else if($_GET["controller"]==3 && $_GET["task"]==1)
        {    
            $err = $controller->deleteBranch($databasecon,$_GET['id_cliente'],$DEBUG_STATUS); 
            if($err==0)
            {
                $_SESSION["ERR1"]="ERR:ERROR EN DESHABILITAR DISTRIBUIDOR. INTENTA MAS TARDE";
            }
            else if($err==1)
            {
                $_SESSION["ERR1"]='OK:DISTRIBUIDOR DESHABILITADO CORRECTAMENTE.';
            }
            else
            {
                $_SESSION["ERR1"]="ERR:ERROR OCURIDO. INTENTA MAS TARDE";
            }
            /*if($_SESSION["user_role"]==1)
                $url='gestion-cliente.php';
            else
                $url='admin-cliente.php';
            header("Location:$url");*/
        }
        else if($_GET["controller"]==4 && $_GET["task"]==0)
        {    
            $err = $controller->gestionUser($databasecon,$_POST['user_id'],$_POST['user_name'],$_POST['user_email'],$_POST['user_phone'],$_POST['user_perfil'],$_POST['user_branch'],$DEBUG_STATUS); 
            if($err==0)
            {
                $_SESSION["ERR1"]="ERR:ERROR EN ACTUALIZAR / CREAR USUARIO. INTENTA MAS TARDE";
            }
            else if($err==2)
            {
                $_SESSION["ERR1"]="OK:DATOS DE USUARIO ACTUALIZADO CORRECTAMENTE";
            }
            else if($err==1)
            {
                $_SESSION["ERR1"]='OK:DATOS DE USUARIO REGISTRADO CORRECTAMENTE.';
            }
            else
            {
                $_SESSION["ERR1"]="ERR:ERROR OCURIDO. INTENTA MAS TARDE";
            }
            //echo $err;
            $url='admin-user.php';
            header("Location:$url");
        }
        else if($_GET["controller"]==4 && $_GET["task"]==1)
        {    
            $err = $controller->deleteUser($databasecon,$_GET['user_id'],$DEBUG_STATUS); 
            if($err==0)
            {
                $_SESSION["ERR1"]="ERR:ERROR EN DESHABILITAR USUARIO. INTENTA MAS TARDE";
            }
            else if($err==1)
            {
                $_SESSION["ERR1"]='OK:USUARIO DESHABILITADO CORRECTAMENTE.';
            }
            else
            {
                $_SESSION["ERR1"]="ERR:ERROR OCURIDO. INTENTA MAS TARDE";
            }
        }
        else if($_GET["controller"]==5 && $_GET["task"]==0)
        {    
            $err = $controller->gestionInventoryItems($databasecon,$_POST['item_id'],$_POST['item_name'],$_POST['item_category'],$_POST['item_desc'],$_POST['item_qty'],$_POST['item_ppu'],$_POST['item_iva'],$_POST['item_prov_ruc'],$_POST['item_accion'],$_POST['item_exp_dt'],$DEBUG_STATUS); 
            if($err==0)
            {
                $_SESSION["ERR1"]="ERR:ERROR EN ACTUALIZAR / CREAR ITEM. INTENTA MAS TARDE";
            }
            else if($err==2)
            {
                $_SESSION["ERR1"]="OK:DATOS DE ITEM ACTUALIZADO CORRECTAMENTE";
            }
            else if($err==1)
            {
                $_SESSION["ERR1"]='OK:DATOS DE ITEM REGISTRADO CORRECTAMENTE.';
            }
            else
            {
                $_SESSION["ERR1"]="ERR:ERROR OCURIDO. INTENTA MAS TARDE";
            }
            //echo $err;
            $url='admin-inventario.php';
            header("Location:$url");
        }
        else if($_GET["controller"]==5 && $_GET["task"]==1)
        {    
            $err = $controller->deleteInventoryItem($databasecon,$_GET['item_id'],$DEBUG_STATUS); 
            if($err==0)
            {
                $_SESSION["ERR1"]="ERR:ERROR EN DESHABILITAR ITEM. INTENTA MAS TARDE";
            }
            else if($err==1)
            {
                $_SESSION["ERR1"]='OK:ITEM DESHABILITADO CORRECTAMENTE.';
            }
            else
            {
                $_SESSION["ERR1"]="ERR:ERROR OCURIDO. INTENTA MAS TARDE";
            }
        }
        else if($_GET["controller"]==5 && $_GET["task"]==2)
        {    
            $err = $controller->buscarInventoryItems($databasecon,$_POST['item_name_busqueda'],$_POST['item_category_busqueda'],$_POST['item_desc_busqueda'],$_POST['item_prov_ruc_busqueda'],$DEBUG_STATUS); 
            if($err==0)
            {
                $_SESSION["ERR1"]="ERR:ERROR EN ACTUALIZAR / CREAR ITEM. INTENTA MAS TARDE";
            }
            else if($err==2)
            {
                $_SESSION["ERR1"]="OK:DATOS DE ITEM ACTUALIZADO CORRECTAMENTE";
            }
            else if($err==1)
            {
                $_SESSION["ERR1"]='OK:DATOS DE ITEM REGISTRADO CORRECTAMENTE.';
            }
            else
            {
                $_SESSION["ERR1"]="ERR:ERROR OCURIDO. INTENTA MAS TARDE";
            }
            //echo $err;
            $url='admin-inventario.php';
            header("Location:$url");
        }
        else if($_GET["controller"]==6 && $_GET["task"]==0)
        {   
            $err = $controller->buscarCustByDoc($databasecon,$_GET['cust_id_type'],$_GET['cust_id_num'],$DEBUG_STATUS); 
            //print_r($err);
            echo json_encode($err);
            /*if($err==0)
            {
                $_SESSION["ERR1"]="ERR:ERROR EN ACTUALIZAR / CREAR ITEM. INTENTA MAS TARDE";
            }
            else if($err==2)
            {
                $_SESSION["ERR1"]="OK:DATOS DE ITEM ACTUALIZADO CORRECTAMENTE";
            }
            else if($err==1)
            {
                $_SESSION["ERR1"]='OK:DATOS DE ITEM REGISTRADO CORRECTAMENTE.';
            }
            else
            {
                $_SESSION["ERR1"]="ERR:ERROR OCURIDO. INTENTA MAS TARDE";
            }
            //echo $err;
            $url='admin-inventario.php';
            header("Location:$url");*/
        }
        else if($_GET["controller"]==6 && $_GET["task"]==1)
        {    
            $err = $controller->gestionDistributor($databasecon,2,$_GET['client_doc_type'],$_GET['client_name'],$_GET['client_ruc'],$_GET['client_address'],$_GET['client_phone'],$_GET['client_email'],$DEBUG_STATUS); 
            if($err==0)
            {
                echo "ERR:ERROR EN ACTUALIZAR / CREAR DATA. INTENTA MAS TARDE";
            }
            else if($err==2)
            {
                echo "OK:DATA ACTUALIZADO CORRECTAMENTE";
            }
            else if($err==1)
            {
                echo 'OK:DATA REGISTRADO CORRECTAMENTE.';
            }
            else
            {
                echo "ERR:ERROR OCURIDO. INTENTA MAS TARDE";
            }
            //echo $err;
            //$url='admin-distribuidor.php';
            //header("Location:$url");
        }
        else if($_GET["controller"]==6 && $_GET["task"]==2)
        {    
            $err = $controller->addItemForSale($databasecon,$_GET['id'],$_GET['item_id'],$_GET['item_qty'],$DEBUG_STATUS); 
            //echo $err.'<br>';
            if(explode(":", $err)[0]=="1")
            {
                //echo 'OK:DATA REGISTRADO CORRECTAMENTE.';
            }
            else if(explode(":", $err)[0]=="2")
            {
                echo 'INFO:INSUFICIENTE CANTIDAD. SOLO EXISTE-'.explode(":", $err)[1];
            }
            else
            {
                //echo "ERR:ERROR OCURIDO. INTENTA MAS TARDE";
            }
            //echo $err;
            //$url='admin-distribuidor.php';
            //header("Location:$url");
        }
        else if($_GET["controller"]==6 && $_GET["task"]==3)
        {    
            $err = $controller->deleteItemEnVentas($databasecon,$_GET['id'],$DEBUG_STATUS); 
            if($err==0)
            {
                echo "ERR:ERROR EN ELIMINAR ITEM. INTENTA MAS TARDE";
            }
            else if($err==1)
            {
                //echo 'OK:ITEM ELIMINADO CORRECTAMENTE.';
            }
            else
            {
                echo "ERR:ERROR OCURIDO. INTENTA MAS TARDE";
            }
        }
        else if($_GET["controller"]==6 && $_GET["task"]==4)
        {    
            $_SESSION["user_basket_id"]=0;
            /*$err = $controller->addItemForSale($databasecon,$_GET['item_id'],$_GET['item_qty'],$DEBUG_STATUS); 
            if($err==1)
            {
                echo 'OK:DATA REGISTRADO CORRECTAMENTE.';
            }
            else
            {
                echo "ERR:ERROR OCURIDO. INTENTA MAS TARDE";
            }*/
            //echo $err;
            $url='ventas.php';
            header("Location:$url");
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
                        
