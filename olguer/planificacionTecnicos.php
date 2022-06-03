<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    //include_once('util.php');
    include_once('config.php');    
    $session_time=$session_expirry_time;
    $DEBUG_STATUS = $PRINT_LOG;
    $target_dir=$plan_location;

    require 'dbcontroller.php';
    $controller = new controller();
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

    include_once('menuPanel.php');
    $message='';
    if(isset($_SESSION["message"])) 
    {
        //echo $_SESSION["message"];
        $message=$_SESSION["message"];
        unset($_SESSION["message"]);
    }

    $clientes = $controller->getPlanificacionClientes($databasecon,$DEBUG_STATUS);
    $tecnicos = $controller->getTecnicosPlan($databasecon,$DEBUG_STATUS);

    if(isset($_POST['submittedFile']))
    {
        if(isset($_POST["client_id"]) && $_POST["client_id"]!=99)
        {
            //echo 'BASENAME:'.basename($_FILES["fileToUpload"]["name"]).'<br>';
            //echo 'BASENAME:'.pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION).'<br>';
            $fileNameUploaded=basename($_FILES["fileToUpload"]["name"]);
            if(basename($_FILES["fileToUpload"]["name"]))
            {            
                //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $currDt = $controller->getCurrDateValuesAsPerFormat($databasecon,'%Y',$DEBUG_STATUS);
                $target_file = $target_dir .$_POST["client_id"].'_'.$_SESSION["user_id"].'_'.$currDt.'.'.pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION);
                //echo 'target_file:'.$target_file.'<br>';
                //$uploadOk = 0;
                $uploadOk = 0;
                
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                {
                        //$_SESSION["message"]="PLANIFICACION ALMACENADO EN SITIO";
                        $message= "PLANIFICACION ALMACENADO EN SITIO.";
                        $uploadOk = 1;
                }
                else
                {
                    //$_SESSION["message"]="ERROR ALMACENAR PLANIFICACION EN SITIO";
                    $message= 'ERROR ALMACENAR PLANIFICACION EN SITIO.';
                }
            }
            if ($uploadOk != 0)
            {
                $updStatus = $controller->uploadPlanInWeb($databasecon,$_POST["client_id"],$fileNameUploaded,$target_file,$DEBUG_STATUS);

                //if($DEBUG_STATUS)
                    //echo $updStatus.'<br>';
                if($updStatus==0)
                {
                    //$_SESSION["message"]= "PLANIFICACION ALMACENADO EN SITIO.";
                    $message= "PLANIFICACION ALMACENADO EN SITIO Y REGISTRO GUARDADO EN BDD.";
                }
                else
                {
                    //$_SESSION["message"]= 'ERROR ALMACENAR PLANIFICACION EN SITIO.';
                    $message= 'ERROR EN GUARDAR REGISTRO EN BDD';
                }
            }
        }
        else
        {
            $message= 'ERROR ALMACENAR PLANIFICACION EN SITIO.NO ELIGIDO CLIENTE.';
        }
        
    }
    
?>
<form action="planificacionTecnicos.php" method="post"  enctype="multipart/form-data">
<div class="container">
    <div class="row">
        <div class="col-sm-2 sidebar">
            <?php include_once('menu.php');?>
        </div>
        <div class="col-sm-10">



            <div class="row">
                <div class="col-sm-12">
                    <?php include_once('mysession.php');?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="page_title">PLANIFICACION ANUAL DE TECNICOS</h2>
                </div>
            </div>
            <br>
            <div class="row">                
                <div class="col-sm-6">
                    <label for="client_id">CLIENTE:</label>
                    <select name="client_id" class="form-control" id="client_id" onchange="getTecnicosForClient()" required>
                        <option value='99'>[99][TODOS]</option>
                        <?php                                 
                            if(isset($clientes) && count($clientes)>0)
                            {
                                for($x=0;$x<count($clientes);$x++)
                                {
                                    echo '<option value='.$clientes[$x][0].'>['.$clientes[$x][0].']['.$clientes[$x][1].']</option>';
                                }
                            }
                        ?>
                    </select>
                    <div class="errmsg" id="error_cliente"></div>
                </div>
                 <div class="col-sm-6">
                    <label for="tecnico_id">TECNICO:</label>
                    <select name="tecnico_id" class="form-control" id="tecnico_id" required>
                        <option value='99'>[99][TODOS]</option>
                        
                    </select>
                    <div class="errmsg" id="error_tecnico_id"></div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <?php
                        if(isset($message))
                            echo '<h4>'.$message.'</h4>'
                    ?>
                    <button type="button" id="buscarPlanificaciones" class="btn btn-small btn_center">BUSCAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                    <?php
                        if($_SESSION["client_id"]==1 && ($_SESSION["user_perfil"]==28 || $_SESSION["user_perfil"]==29))
                        {
                    ?>
                    <input type="button" class="btn btn-small btn_center"  data-toggle="modal" data-target="#myModal" value="CARGAR ARCHIVO">
                    <?php
                        }
                    ?>
                    <div class="progress" id="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:100%">BUSCANDO</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div id="tbl_entidad_gestion">                        
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background:darkgrey !important">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">CARGAR ARCHIVO PLANIFICACION</h4>
                </div>
                <div class="modal-body">                    
                    <input type="hidden" name="submittedFile" value="true">
                    <div class="col-sm-4 text-center">
                        <label for="fileToUpload" class="btn btn-small btn_center"><span class="glyphicon glyphicon-download-alt" style="font-size:16px;"></span> ELIGE PDF</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" style="visibility:hidden">
                    </div>
                    <div class="col-sm-4 text-center">
                        <input type="submit" class="btn btn-small btn_center" value="ALMACENAR"></center>
                    </div>
                </div>
                <br>
                <br>
            
        </div>

    </div>
</div>

</form>