<?php
    session_start();
    include_once('util.php');
    include_once('header.php');

    $msg='';
    
    if(isset($_GET["err"]))
        $err=$_GET["err"];
    else 
        $err=99;
    
    if($err==1)    
    {
        $msg= '<center>USUARIO REGISTRADO CORRECTAMENTE.</center>';
    }
    else if($err==0)
    {
         $msg= '<center>ERROR OCURIDO. INTENTA NUEVAMENTE</center>';
    }
    else if($err<0)
    {
         $msg= '<center>USUARIO EXISTE. REGISTRAR CON OTROS DATOS</center>';
    }
    else if($err==9)
    {
         $msg= '<center>ERROR EN ENVIAR CORREO DE CONFIRMACION DE REGISTRO EXITOSO DEL USUARIO.</center>';
    }
    else if($err==8)
    {
         $msg= '<center>ERROR OCURIDO EN REGISTRAR USUARIO. INTENTA NUEVAMENTE</center>';
    }

    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'controladorDB.php';
    $controladorDB = new controladorDB();
    if(isset($_POST["userNombre"]))
    {
        /*LDAP*/
        $server = "ldap://192.168.16.8/";
        $user = "ETAPA-NET\authalepo";
        $psw = "4lgRG*l1x4PXJwn";
        $dn = "OU=empresa,DC=etapa,DC=net,DC=ec";
        $search ="samaccountname=".$_POST["userNombre"];
        error_log("userNombre!".$_POST["userNombre"], 0);
        $ds=ldap_connect($server);
        $sr=ldap_bind($ds, $user , $psw); 
        $sr=ldap_search($ds, $dn,$search);
        $data = ldap_get_entries($ds, $sr);    
        for ($i=0; $i<$data["count"]; $i++) 
        {
            //$description = $data[$i]["description"][0];
            $description = $data[$i]["cn"][0];
            $distinguishedName = $data[$i]["dn"];
            $user_email = $data[$i]["mail"][0];
        }
        error_log("distinguishedName!".$distinguishedName, 0);
        error_log("user_email!".$user_email, 0);
        $user=$distinguishedName;
        ldap_close($ds);
        /*LDAP*/
    }

?>

<style type="text/css">
    body
    {
        background-image: none !important;
    }
</style>
<div class="container">
    <br>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center">
            <?php
            if(strlen($msg)>0)
            {
            ?>
            <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $msg;?>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 login-register-block">
            <div class="row">
                 <div class="col-sm-1"></div>
                 <div class="col-sm-10">
                     <?php
                     {
                         if(isset($_POST["userNombre"]))
                         {
                            if(is_null($user_email) || empty($user_email))
                             {
                                 echo "No existe usaurio";
                        ?>
                        <form method="post">
                            <input type="hidden" name="submitted" value="true" /> 
                            <h3 class="modal-title text-center">CREAR USUARIO ETAPA</h3>
                            <input type="text" class="form-control navbar-btn" id="nombre" placeholder="Usuario Red" name="userNombre" required>
                            
                            <br>                        
                            <center>
                                <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">BUSQUEDA USUARIO RED<span class="glyphicon glyphicon-chevron-right"></span></button>
                            
                            </center>
                        </form>
                        <?php
                             } 
                             else
                             {
                            ?>
                                <form method="post" action="controladorProceso.php?proceso=0&task=0">
                                <input type="hidden" name="submitted" value="true" /> 
                                <h3 class="modal-title text-center">CREAR USUARIO ETAPA</h3>
                                <input type="text" class="form-control navbar-btn" id="nombre" name="userNombre" value="<?php echo $description;?>" readonly="true">
                                <input type="email" class="form-control navbar-btn" id="email" name="userEmail"  value=<?php echo $user_email;?>>
                                <input type="text" class="form-control navbar-btn" id="pwd" name="userPwd" value="" readonly="true">
                                <input type="text" class="form-control navbar-btn" id="telefono" name="userTelefono" value="" readonly="true">
                                <input type="text" class="form-control navbar-btn" id="celular" name="userCelular" value="" readonly="true">
                                <input type="text" class="form-control navbar-btn" id="ubicacion" name="userUbicacion" value="" readonly="true">
                                <input type="text" class="form-control navbar-btn" id="usuarioRed" name="usuarioRed" value=<?php echo $_POST["userNombre"];?> readonly="true">
                                <select name="userPerfil" class="form-control" id="perfil" required>
                                    <?php 
                                        $perfil = $controladorDB->listaPerfil($databasecon,0,$DEBUG_STATUS);
                                        for($i=0;$i<count($perfil);$i++)
                                        {
                                            ?>
                                                <option value=<?php echo $perfil[$i][0];?>><?php echo '['.$perfil[$i][0].']:'.$perfil[$i][1];?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                <select name="id_integrador" class="form-control" id="id_integrador" required>
                                    <option value=0>ETAPA</option>
                                </select>
                                <br>                        
                                <center>
                                    <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">CONFIGURAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                                
                                </center>
                            </form>
                            <?php
                             }
                         }
                         else
                         {
                        ?>
                        <form method="post">
                            <input type="hidden" name="submitted" value="true" /> 
                            <h3 class="modal-title text-center">CREAR USUARIO ETAPA</h3>
                            <input type="text" class="form-control navbar-btn" id="nombre" placeholder="Usuario Red" name="userNombre" required>
                            
                            <br>                        
                            <center>
                                <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">BUSQUEDA USUARIO RED<span class="glyphicon glyphicon-chevron-right"></span></button>
                            
                            </center>
                        </form>
                        <?php
                         }                         
                     }
                    ?>
                </div>
                <div class="col-sm-1"></div>    
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>