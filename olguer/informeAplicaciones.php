<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php');    
    $session_time=$session_expirry_time;
    $DEBUG_STATUS = $PRINT_LOG;
    $target_dir=$pdf_location;

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
    

    if(isset($_POST['submitted']))
    {
        $updStatus = $controller->updateReport6($databasecon,$_POST["id"],$_POST["rep_recibido_por"],$_POST["cedula_recibido_por"],$_POST["id1"],$_POST["id2"],$_POST["id3"],$_POST["id4"],$DEBUG_STATUS);
        
        if($updStatus==0)
        {
            $message="DATA GUARDADO CORRECTAMENTE. EJECUTAR REPORTE AHORA";            
        }
        else
            $message="ERROR EN GUARDAR REPORTE y NO SE PUEDE EJECUTAR REPORTE";

    }

    if(isset($_POST['submittedFile']))
    {
        if(basename($_FILES["fileToUpload"]["name"]))
        {            
            /*$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);*/
            $target_file = $target_dir .$_GET["peticion"].'.pdf';
            $uploadOk = 1;
            
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);            

            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) 
            {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) 
                {
                    $messsage= "File is an pdf - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } 
                else 
                {
                    echo "File is not a pdf.";
                    $uploadOk = 0;
                    $_SESSION["message"]="ARCHIVO NO ES PDF";
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) 
            {
                            
            }
            // Check file size
            if($imageFileType != "pdf") 
            {
                $messsage= "ARCHIVO NO ES PDF. SOLO ARCHIVOS TIPO PDF PERMITIDO ALMACENAR EN SITIO";
                $uploadOk = 0;
            }
            
            
            if ($uploadOk == 0) 
            {
                $_SESSION["message"]="ERROR: ".$messsage;
                
            } 
            else 
            {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                    $_SESSION["message"]="PDF ALMACENADO EN SITIO";
                else
                    $_SESSION["message"]="ERROR ALMACENAR PDF EN SITIO";
            }
        }
        if ($uploadOk != 0)
        {
            $updStatus = $controller->uploadPdfInWeb($databasecon,$_GET["peticion"],$DEBUG_STATUS);

            if($DEBUG_STATUS)
                echo $updStatus.'<br>';
            if($updStatus==0)
                $_SESSION["message"]= "PDF ALMACENADO EN SITIO.";
            else
                $_SESSION["message"]= 'ERROR ALMACENAR PDF EN SITIO.';
        } 
        
    }
    
    if(isset($_SESSION["message"])) 
    {
        $message=$_SESSION["message"];
        unset($_SESSION["message"]);
    }


    $peticionId=0;
    if(isset($_GET["peticion"]))
        $peticionId=$_GET["peticion"];
    $reportDtl = $controller->getReport6($databasecon,$peticionId,$DEBUG_STATUS);

    $peticionDtl = $controller->getReport6PeticionDtl($databasecon,$peticionId,$DEBUG_STATUS);
?>
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
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="page_title">GENERAR REPORTE DE VISITA / SERVICIO</h2>                    
                </div>
            </div>
            <br>
            <?php 
                if(isset($message) && strcmp($message, '')!=0)
                {
            ?>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="errblock">
                            <?php echo $message;?>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
            <br>
            <!-- <?php
                include_once('cabeceraReporte.php');
            ?> -->
            <br>
            <form action="informeAplicaciones.php?peticion=<?php echo $peticionId;?>&report=<?php echo $reportDtl[0][0];?>" method="post" onsubmit="return validateReport6DataBeforeSubmit()"  enctype="multipart/form-data">
                
                <input type="hidden" name="id" value="<?php echo $reportDtl[0][1];?>">
                
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <label for="client_name">CLIENTE:</label>
                        <input type="text" class="form-control" id="client_name" value="<?php echo $peticionDtl[0][0];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_client_name"></div>
                    </div>
                    <div class="col-sm-6 text-left">
                        <label for="ciudad_name">CIUDAD:</label>
                        <input type="text" class="form-control" id="ciudad_name" value="<?php echo $peticionDtl[0][1];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_ciudad_name"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <label for="ubicacion">UBICACION:</label>
                        <input type="text" class="form-control" id="ubicacion" value="<?php echo $peticionDtl[0][2];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_ubicacion"></div>
                    </div>

                    <div class="col-sm-6 text-left">
                        <label for="telefono">TELEFONO:</label>
                        <input type="text" class="form-control" id="telefono" value="<?php echo $peticionDtl[0][3];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_telefono"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="fecha_solicitud">FECHA SOLICITUD (DD-MM-YYYY HH:MI:SS):</label>
                        <input type="text" class="form-control" id="fecha_solicitud" value="<?php echo $peticionDtl[0][4];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_fecha_solicitud"></div>
                    </div>
                     <div class="col-sm-6">
                        <label for="fecha_inicio">FECHA INICIO (DD-MM-YYYY HH:MI:SS):</label>
                        <input type="text" class="form-control" id="fecha_inicio" value="<?php echo $peticionDtl[0][5];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_fecha_inicio"></div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-sm-6">
                        <label for="fecha_entrega">FECHA ENTREGA (DD-MM-YYYY HH:MI:SS):</label>
                        <input type="text" class="form-control" id="fecha_entrega" value="<?php echo $peticionDtl[0][6];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_fecha_entrega"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-4 text-left">
                        <label for="equipo_name">EQUIPO:</label>
                        <input type="text" class="form-control" id="equipo_name" value="<?php echo $peticionDtl[0][7];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_equipo_name"></div>
                    </div>

                    <div class="col-sm-4 text-left">
                        <label for="modelo">MODELO:</label>
                        <input type="text" class="form-control" id="modelo" value="<?php echo $peticionDtl[0][8];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_modelo"></div>
                    </div>

                    <div class="col-sm-4 text-left">
                        <label for="derie">SERIE:</label>
                        <input type="text" class="form-control" id="derie" value="<?php echo $peticionDtl[0][9];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_derie"></div>
                    </div>
                </div>
                <br>
                <input type="hidden" value="<?php  if(isset($reportDtl[0][5])) echo $reportDtl[0][5]; else echo 0;?>" id="id1" name="id1">
                <input type="hidden" value="<?php  if(isset($reportDtl[0][6])) echo $reportDtl[0][6]; else echo 0;?>" id="id2" name="id2">
                <input type="hidden" value="<?php  if(isset($reportDtl[0][7])) echo $reportDtl[0][7]; else echo 0;?>" id="id3" name="id3">
                <input type="hidden" value="<?php  if(isset($reportDtl[0][8])) echo $reportDtl[0][8]; else echo 0;?>" id="id4" name="id4">
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;font-weight:bold">
                        <label for="problema">SERVICIOS:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <?php
                            if($reportDtl[0][5]==0)
                            {
                        ?>
                            <input type="checkbox" onchange="addIdReport6(1)"><span style="color:#f5f5f5">&nbsp;SERV. FACT.</span>
                        <?php        
                            }
                            else
                            {
                        ?>
                            <input type="checkbox" checked="true"><span style="color:#f5f5f5">&nbsp;SERV. FACT.</span>
                        <?php        
                            }
                        ?>
                    </div>
                    <div class="col-sm-3">
                        <?php
                            if($reportDtl[0][6]==0)
                            {
                        ?>
                            <input type="checkbox" onchange="addIdReport6(2)"><span style="color:#f5f5f5">&nbsp;COMODATO</span>
                        <?php        
                            }
                            else
                            {
                        ?>
                            <input type="checkbox" checked="true"><span style="color:#f5f5f5">&nbsp;COMODATO</span>
                        <?php        
                            }
                        ?>
                    </div>
                    <div class="col-sm-3">
                        <?php
                            if($reportDtl[0][7]==0)
                            {
                        ?>
                            <input type="checkbox" onchange="addIdReport6(3)"><span style="color:#f5f5f5">&nbsp;GARANTIA</span>
                        <?php        
                            }
                            else
                            {
                        ?>
                            <input type="checkbox" checked="true"><span style="color:#f5f5f5">&nbsp;GARANTIA</span>
                        <?php        
                            }
                        ?>
                    </div>
                    <div class="col-sm-3">
                        <?php
                            if($reportDtl[0][8]==0)
                            {
                        ?>
                            <input type="checkbox" onchange="addIdReport6(4)"><span style="color:#f5f5f5">&nbsp;CONTRATO</span>
                        <?php        
                            }
                            else
                            {
                        ?>
                            <input type="checkbox" checked="true"><span style="color:#f5f5f5">&nbsp;CONTRATO</span>
                        <?php        
                            }
                        ?>
                    </div>
                </div>
                <div class="row">
                     <div class="col-sm-12 text-left">
                        <div class="errmsg" id="error_servicios"></div>
                    </div>
                </div>
                <br>
                <br>


                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <label for="problema">PROBLEMA REPORTADO:</label><div class="errorMsg" id="text_size"></div>
                        <textarea class="form-control" name="problema" maxlength="200" id="problema" value="" rows="10" onkeypress="countTextSize()" placeholder="Ingresar observacion-200 caracteres" maxlength=200 style="background: lightgrey;" readonly="true"><?php echo $peticionDtl[0][10];?></textarea> 
                        <div class="errmsg" id="error_problema"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#f5f5f5;">
                        <label for="accion_tomada">ACCION TOMADA:</label><div class="errorMsg" id="text_size"></div>
                        <textarea class="form-control" name="accion_tomada" maxlength="200" id="rep_obser" valueaccion_tomada="" rows="10" onkeypress="countTextSize()" placeholder="Ingresar observacion-200 caracteres" maxlength=200 style="background: lightgrey;" readonly="true"><?php echo $peticionDtl[0][11];?></textarea> 
                        <div class="errmsg" id="error_accion_tomada"></div>
                    </div>
                </div>
                <br>
                


                 <div class="row">                    
                    <div class="col-sm-6">                          
                        <label for="permisos">DEPARTAMENTO DE ASESORIA</label><div class="errorMsg" id="text_size"></div>
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-sm-8">                          
                        <label for="user_name">NOMBRE</label><div class="errorMsg" id="text_size"></div>                    
                        <input type="text" class="form-control" id="user_name" value="<?php echo $_SESSION["user_name"];?>" style="background: lightgrey;" readonly="true">
                        <div class="errmsg" id="error_user_name"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">       
                        <label for="rep_recibido_por">RECIBIDO A SATISFACCION POR:</label><div class="errorMsg" id="text_size"></div>
                    </div>
                <div class="row">
                    <div class="col-sm-8">       
                        <label for="rep_recibido_por">NOMBRE:</label><div class="errorMsg" id="text_size"></div>                    
                        <input type="text" class="form-control bg_lightgreen" maxlength="100" id="rep_recibido_por" name="rep_recibido_por" value="<?php echo $reportDtl[0][3];?>" required>
                        <div class="errmsg" id="error_rep_recibido_por"></div>
                    </div>
                    <div class="col-sm-4">       
                        <label for="cedula_recibido_por">CEDULA:</label><div class="errorMsg" id="text_size"></div>                    
                        <input type="text" class="form-control bg_lightgreen" maxlength="20" id="cedula_recibido_por" name="cedula_recibido_por" value="<?php echo $reportDtl[0][4];?>" required>
                        <div class="errmsg" id="error_cedula_recibido_por"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">       
                        <?php
                        if(empty($reportDtl[0][4]))
                        {
                        ?>
                        <input type="hidden" name="submitted" value="true">
                        <input type="submit" class="btn btn-small btn_center" value="GUARDAR">
            
                        <?php
                        }  
                        else
                        {  
                        ?> 

                        <br>
                        <br>
        
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <a href=exportInformeAplicaciones.php?peticion=<?php echo $peticionId;?> target="_blank">
                                    <input type="button" class="btn btn-small btn_center" value="EXPORTAR">  
                                </a>
                            </div>
                            
                            <input type="hidden" name="submittedFile" value="true">
                            <div class="col-sm-4 text-center">
                                <label for="fileToUpload" class="btn btn-small btn_center"><span class="glyphicon glyphicon-download-alt" style="font-size:16px;"></span> ELIGE PDF</label>
                                <input type="file" name="fileToUpload" id="fileToUpload" style="visibility:hidden">
                            </div>
                            <div class="col-sm-4 text-center">
                                <input type="submit" class="btn btn-small btn_center" value="ALMACENAR"></center>
                            </div>
                            
                        </div>

                        <?php
                        }
                        ?>
                    </div>
                </div>
                </div>
            </form>
            <br>

        </div>
    </div>
</div>