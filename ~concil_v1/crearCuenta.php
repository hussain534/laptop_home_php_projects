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
?>

<style type="text/css">
    body
    {
        //background-image: url('images/merakipm_background_sm.jpg');
        background-size: cover;
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
                    <form method="post" action="controladorProceso.php?proceso=0&task=0">
                        <input type="hidden" name="submitted" value="true" /> 
                        <h3 class="modal-title text-center">CREAR CUENTA</h3>
                        <input type="text" class="form-control navbar-btn" id="nombre" placeholder="Nombre Completo" name="userNombre" required>
                        <input type="email" class="form-control navbar-btn" id="email" placeholder="Email" name="userEmail" required>
                        <input type="password" class="form-control navbar-btn" id="pwd" placeholder="Clave" name="userPwd" required>
                        <input type="text" class="form-control navbar-btn" id="telefono" placeholder="Telefono" name="userTelefono" required>
                        <input type="text" class="form-control navbar-btn" id="celular" placeholder="Celular" name="userCelular" required>
                        <input type="text" class="form-control navbar-btn" id="ubicacion" placeholder="Ubicacion" name="userUbicacion" required>
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
                            <option value=0>ALEPO</option>
                            <?php 
                                $lista_integrador = $controladorDB->listaProveedores($databasecon,0,$DEBUG_STATUS);
                                for($i=0;$i<count($lista_integrador);$i++)
                                {
                            ?>
                                    <option value=<?php echo $lista_integrador[$i][0];?>><?php echo $lista_integrador[$i][1];?></option>
                            <?php        
                                }
                            ?>
                        </select>
                        <br>                        
                        <center>
                            <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">CREAR CUENTA<span class="glyphicon glyphicon-chevron-right"></span></button>
                        
                        </center>
                    </form>
                </div>
                <div class="col-sm-1"></div>    
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>