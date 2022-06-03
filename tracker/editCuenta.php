<?php
    session_start();
    include_once('util.php');
    include_once('header.php');
    $msg='';
    if(isset($_SESSION["message"]))
    {
        $msg=$_SESSION["message"];
        unset($_SESSION["message"]);
    }
    if(isset($_GET["uid"]))
    {
        $data = $controladorDB->listaUsers($databasecon,$_GET["uid"],$DEBUG_STATUS);
        $userId=$data[0][0];
        $userNombre=$data[0][1];
        $userEmail=$data[0][2];
        $userPerfil=$data[0][3];
        $userTelefono=$data[0][4];
        $userCelular=$data[0][5];
        $userUbicacion=$data[0][6];
        $userParalelo=$data[0][9];
    }
    else
    {
        $data = $controladorDB->listaUsers($databasecon,0,$DEBUG_STATUS);
        $userId=0;
        $userNombre='';
        $userEmail='';
        $userTelefono='';
        $userCelular='';
        $userUbicacion='';
    }
?>
<style type="text/css">
    body
    {
        background-image: none !important;
    }
</style>
<div class="container">
    <?php
    include_once('sessionData.php');
    ?>
    <div class="row pageTitle">
        <div class="col-sm-12">
            CREAR NUEVA CUENTA
        </div>
    </div>
    <br>
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
         <div class="col-sm-1"></div>
         <div class="col-sm-10">
            <form method="post" action="controladorProceso.php?proceso=0&task=5">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" name="submitted" value="true" />
                        <input type="hidden" class="form-control navbar-btn" id="userId" name="userId" value="<?php echo $userId;?>"> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>NOMBRE*</label>
                        <input type="text" class="form-control navbar-btn" id="nombre" placeholder="Nombre Completo" name="userNombre" value="<?php echo $userNombre;?>" required> 
                    </div>
                    <div class="col-sm-4">
                        <label>EMAIL*</label>
                        <input type="email" class="form-control navbar-btn" id="email" placeholder="Email" name="userEmail" value="<?php echo $userEmail;?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>TELEFONO 1*</label>
                        <input type="text" class="form-control navbar-btn" id="telefono" placeholder="Telefono" name="userTelefono" value="<?php echo $userTelefono;?>" required>
                    </div>
                    <div class="col-sm-4">
                        <label>TELEFONO 2 (opcional)</label>
                        <input type="text" class="form-control navbar-btn" id="celular" placeholder="Celular" name="userCelular" value="<?php echo $userCelular;?>">
                    </div>
                    <div class="col-sm-4">
                        <label>DIRECCION (opcional)</label>
                        <input type="text" class="form-control navbar-btn" id="ubicacion" placeholder="Ubicacion" name="userUbicacion" value="<?php echo $userUbicacion;?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>PERFIL</label>
                        <input type="text" class="form-control navbar-btn" id="userPerfil" placeholder="userPerfil" name="userPerfil" value="<?php echo $userPerfil;?>" readonly="true">
                    </div>
                    <div class="col-sm-4">
                        <label>PARALELO</label>
                        <input type="text" class="form-control navbar-btn" id="userParalelo" placeholder="userParalelo" name="userParalelo" value="<?php echo $userParalelo;?>" readonly="true">
                    </div>
                </div>
                <br>                        
                <!-- <center> -->
                    <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">MODIFICAR CUENTA<span class="glyphicon glyphicon-chevron-right"></span></button>
                    <a href="crearCuenta.php" class="btn btn-info btn_center">REGRESAR</a>
                <!-- </center> -->
            </form>
        </div>
        <div class="col-sm-1"></div>    
    </div>
    <br>
    
</div>