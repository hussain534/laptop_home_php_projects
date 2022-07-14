<?php
    session_start();
    if(!isset($_SESSION['LAST_ACTIVITY']))
    {
        session_destroy();
        $url='index.php?err=98';
        header("Location:$url");
    }
    include_once('util.php');
    include_once('header.php');
    if(isset($_SESSION["message"]))
    {
        $msg=$_SESSION["message"];
        unset($_SESSION["message"]);
    }
    /*include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'controladorDB.php';
    $controladorDB = new controladorDB();*/
    if(isset($_SESSION["PERMISOS_IDPERFIL"]))
        $idPerfil=$_SESSION["PERMISOS_IDPERFIL"];
    else
        $idPerfil=0;
    if(isset($_SESSION["PERMISOS_IDMENU"]))
        $idMenu=$_SESSION["PERMISOS_IDMENU"];
    else
        $idMenu=0;    
    $permisos = $controladorDB->obtenerPerfilPermisos($databasecon,$idPerfil,$idMenu,$DEBUG_STATUS);
    //echo 'count::'.count($permisos);
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
            PERMISOS
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center">
            <?php
            if(isset($msg))
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
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form method="post" action="controladorProceso.php?proceso=6&task=0">
                <div class="row">
                    <div class="col-sm-6">
                        <label>PERFIL</label>
                        <select name="idPerfil" class="form-control" id="idPerfil" onChange="buscarPermisos()" required>
                            <option value=0><?php echo '[0]:TODO';?></option>
                            <?php 
                                $perfil = $controladorDB->listaPerfil($databasecon,0,$DEBUG_STATUS);
                                for($i=0;$i<count($perfil);$i++)
                                {
                                    if($idPerfil==$perfil[$i][0])
                                    {
                                        ?>
                                            <option value=<?php echo $perfil[$i][0];?> selected="true"><?php echo '['.$perfil[$i][0].']:'.$perfil[$i][1];?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value=<?php echo $perfil[$i][0];?>><?php echo '['.$perfil[$i][0].']:'.$perfil[$i][1];?></option>
                                        <?php
                                    }                                    
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>MENU</label>
                        <select name="idMenu" class="form-control" id="idMenu"  onChange="buscarPermisos()" required>
                            <option value=0><?php echo '[0][0]:TODO';?></option>
                            <?php 
                                $menu = $controladorDB->getMenuList($databasecon,0,$DEBUG_STATUS);
                                for($i=0;$i<count($menu);$i++)
                                {
                                    if($idMenu==$menu[$i][0])
                                    {
                                        ?>
                                            <option value=<?php echo $menu[$i][0];?> selected="true"><?php echo '['.$menu[$i][0].']['.$menu[$i][1].']:'.$menu[$i][2];?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value=<?php echo $menu[$i][0];?>><?php echo '['.$menu[$i][0].']['.$menu[$i][1].']:'.$menu[$i][2];?></option>
                                        <?php
                                    }                                    
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row text-center">
                    <button type="submit" class="btn btn-info" title="Click to enter our portal">AGREGAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                </div>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
    <?php
        if(isset($permisos))
        {
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>PERFIL</td>
                            <td>MENU</td>
                            <td>ACCION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($permisos);$x++)
                {
            ?>
                        <tr class="table-body">
                            <td><?php echo $permisos[$x][2];?></td> 
                            <td><?php echo $permisos[$x][4];?></td>
                            <td>
                                <!-- <a href="permisos.php?pid=<?php echo $permisos[$x][1];?>&mid=<?php echo $permisos[$x][3];?>"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a> -->
                                <a href="controladorProceso.php?proceso=6&task=1&id=<?php echo $permisos[$x][0];?>"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
                            </td>
                        </tr>
            <?php
                }
            ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
    ?>
        </div>
        <div class="col-sm-2"></div>
    </div>
    <br>
</div>